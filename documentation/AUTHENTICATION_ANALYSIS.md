# AUTHENTICATION & ACCESS CONTROL ANALYSIS

This document provides a comprehensive reverse engineering audit of the authentication mechanisms in the Laravel project and defines the complete security, session management, and RBAC architecture for Next.js 15+ and PostgreSQL.

---

## 1. Audit of Current Laravel Authentication Architecture

### 1.1 Multi-Guard Configuration (`config/auth.php`)

Laravel employs a dual-provider, multi-guard authentication structure:

```php
'guards' => [
    'web' => [
        'driver' => 'session',
        'provider' => 'users',
    ],
    'admin' => [
        'driver' => 'session',
        'provider' => 'admins',
    ],
    'api' => [
        'driver' => 'token',
        'provider' => 'users',
        'hash' => false,
    ],
],
'providers' => [
    'users' => [
        'driver' => 'eloquent',
        'model' => App\Models\User::class,
    ],
    'admins' => [
        'driver' => 'eloquent',
        'model' => App\Models\Admin::class,
    ],
],
```

### 1.2 Administrative Web Authentication
* **Model**: `App\Models\Admin` (`admins` table).
* **Guards & Middleware**: Routes within `Route::middleware(['auth:admin'])` require an active session authenticated against the `admin` guard.
* **Redirection Logic (`app/Http/Middleware/Authenticate.php`)**:
  ```php
  protected function redirectTo($request)
  {
      if (! $request->expectsJson()) {
          if ($request->is('admin*')) {
              return route('admin.login');
          }
          return route('login');
      }
      return null;
  }
  ```
* **Login Controller (`Admin\AuthController.php`)**:
  * Validates email format and required password.
  * Attempts `Auth::guard('admin')->attempt($credentials)`.
  * On success: calls `$request->session()->regenerate()` and redirects to `admin.dashboard`.
  * On failure: returns `back()->withErrors(['email' => 'ইমেইল অথবা পাসওয়ার্ড সঠিক নয়।'])`.
* **Password Hashing**: Bcrypt (`$2y$10$...` / `$2a$...`).

### 1.3 Mobile API Authentication (Laravel Sanctum)
* **Model**: `App\Models\User` (`users` table).
* **Endpoints (`routes/api.php`)**:
  * `POST /api/register`: Validates name, email (unique:users), password (min:8, confirmed), and `device_name`. Hashes password with `Hash::make()` and creates token: `$user->createToken($request->device_name)->plainTextToken`.
  * `POST /api/login`: Verifies email and password using `Hash::check()`. Returns plaintext token and serialized user object.
  * `POST /api/logout`: Revokes token via `$request->user()->currentAccessToken()->delete()`.
  * `GET /api/user`: Returns current authenticated user record.
* **Token Storage**: `personal_access_tokens` table storing SHA-256 token hash, tokenable ID, device name, and timestamps.

### 1.4 Critical Inconsistencies Discovered
1. **Broken `/api/admin/login` Route**:
   In `routes/api.php`, line 22 points `/api/admin/login` directly to `AdminAuthController@login`. That controller is coded strictly for web session redirects and throws exceptions or returns 302 redirects when called via an API client expecting JSON.
2. **Scaffolded but Unused Public Web Auth**:
   The controllers `Auth\LoginController`, `Auth\RegisterController`, `Auth\ForgotPasswordController`, etc. exist in `app/Http/Controllers/Auth/`, but standard public web authentication routes are not exposed in `routes/web.php`. Public users interact anonymously, while the `users` table is populated exclusively via `/api/register` by the Flutter mobile application.

---

## 2. Next.js 15+ Target Security & Authentication Architecture

To ensure 100% parity with both administrative access and mobile API clients, Next.js will implement a unified, multi-mode security layer:

```
                            ┌────────────────────────────────────────┐
                            │           Incoming Request             │
                            └───────────────────┬────────────────────┘
                                                │
                       ┌────────────────────────┴────────────────────────┐
                       ▼                                                 ▼
            Path starts with /admin                            Path starts with /api/v1
                       │                                                 │
            ┌──────────┴──────────┐                           ┌──────────┴──────────┐
            ▼                     ▼                           ▼                     ▼
       /admin/login         /admin/*                     /api/v1/auth/*        /api/v1/*
     (Guest allowed)   (Session Required)              (Public Endpoints)  (Bearer Token Req)
                              │                                                     │
                   ┌──────────┴──────────┐                               ┌──────────┴──────────┐
                   ▼                     ▼                               ▼                     ▼
             Valid Admin?           No Session                      Valid JWT?             No/Invalid
                   │                     │                               │                     │
                Allowed           Redirect to                     NextHandler             Return 401
                                  /admin/login                                            Unauthorized
```

### 2.1 Technology Selection
* **Core Auth**: **Auth.js v5 (NextAuth.js)** with Credentials Provider.
* **Session Strategy**: Stateless, tamper-proof JSON Web Tokens (JWT) encrypted using `next-auth` JWE encryption (A256GCM) stored in HttpOnly, Secure, SameSite=Lax cookies.
* **Password Verification**: `bcryptjs` / `node-bcrypt` ensuring 100% backward compatibility with all existing hashes in `admins` and `users` tables.

### 2.2 Role-Based Access Control (RBAC)
```typescript
export enum UserRole {
  SUPER_ADMIN = 'SUPER_ADMIN',
  ADMIN = 'ADMIN',
  USER = 'USER'
}

export interface AuthSessionUser {
  id: string;
  name: string;
  email: string;
  role: UserRole;
  guard: 'admin' | 'user';
}
```

### 2.3 Next.js Route Protection Middleware (`middleware.ts`)

```typescript
import { NextResponse } from 'next/server';
import type { NextRequest } from 'next/server';
import { getToken } from 'next-auth/jwt';

export async function middleware(request: NextRequest) {
  const { pathname } = request.nextUrl;

  // 1. Admin route protection
  if (pathname.startsWith('/admin')) {
    // Exclude login page and static assets
    if (pathname === '/admin/login' || pathname.startsWith('/admin/login/')) {
      return NextResponse.next();
    }

    const token = await getToken({
      req: request,
      secret: process.env.NEXTAUTH_SECRET,
    });

    if (!token || token.role !== 'ADMIN') {
      const loginUrl = new URL('/admin/login', request.url);
      loginUrl.searchParams.set('callbackUrl', pathname);
      return NextResponse.redirect(loginUrl);
    }
  }

  // 2. Mobile API Bearer Token protection
  if (pathname.startsWith('/api/v1/')) {
    const isPublicApi = 
      pathname.startsWith('/api/v1/auth/login') ||
      pathname.startsWith('/api/v1/auth/register') ||
      pathname.startsWith('/api/v1/payment/');

    if (!isPublicApi) {
      const authHeader = request.headers.get('Authorization');
      if (!authHeader || !authHeader.startsWith('Bearer ')) {
        return NextResponse.json(
          { message: 'Unauthenticated.' },
          { status: 401 }
        );
      }
      // Token validation logic handled in route handler / helper
    }
  }

  return NextResponse.next();
}

export const config = {
  matcher: ['/admin/:path*', '/api/v1/:path*'],
};
```

### 2.4 Mobile API Sanctum Compatibility Layer

To ensure the Flutter mobile app operates without modification:
1. `POST /api/v1/auth/login`: Accepts `{ email, password, device_name }`. Verifies credentials against `users` table via Bcrypt.
2. Generates an RFC 7519 compliant JWT or database token stored in `personal_access_tokens`:
   ```json
   {
     "token": "1|qW3...xyz",
     "user": {
       "id": 1,
       "name": "Mobile User",
       "email": "user@example.com",
       "created_at": "2025-02-24T15:00:00.000000Z"
     }
   }
   ```
3. Subsequent mobile requests supply `Authorization: Bearer <token>`, validated via a lightweight token verifier middleware utility.

### 2.5 Security Best Practices & Hardening
* **Bcrypt Password Compatibility**: Bcrypt hashes starting with `$2y$` (PHP Blowfish) are transparently read by Node.js Bcrypt libraries by normalizing the prefix to `$2a$`.
* **CSRF Defense**: Automatic CSRF token generation and validation for all Next.js Server Actions and mutation forms.
* **Rate Limiting**: IP-based rate limiting on sensitive routes (`/admin/login`, `/api/v1/auth/login`, `/training/register`) preventing brute force credential stuffing.
