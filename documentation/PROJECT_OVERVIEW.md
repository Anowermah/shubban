# PROJECT OVERVIEW: Laravel to Next.js + PostgreSQL Migration

## 1. Executive Summary

This document provides the foundational architectural audit and project overview for migrating the web application of **জমঈয়ত শুব্বানে আহলে হাদীস বাংলাদেশ (Shubban / শুববান)** from its current PHP/Laravel 10/12 + MySQL implementation to a high-performance, modern full-stack **Next.js 15+ (App Router, React 19, TypeScript) + PostgreSQL** architecture.

The primary objective is to achieve **100% functional, operational, and visual parity** while leaving the original Laravel application completely untouched. The migration will modernize the technology stack, significantly enhance performance, improve database integrity with PostgreSQL's advanced relational and JSONB capabilities, provide native multi-language (Bengali, Arabic, English) with bi-directional layout support (LTR and RTL), and retain complete backward compatibility with the existing Flutter mobile application (`mobile_app/`) that consumes the backend REST APIs.

---

## 2. Organization Context & System Profile

* **Organization**: জমঈয়ত শুব্বানে আহলে হাদীস বাংলাদেশ (Jam'iyat Shubban-e-Ahl-e-Hadith Bangladesh)
* **Website Domain**: Islamic organizational portal, educational resource hub, publication archive, and community management system.
* **Core Public User Base**: Bangladeshi and international visitors accessing Islamic publications (books, research articles, magazines), news, notices, educational syllabi, committee structures, event calendars, and donation facilities.
* **Key Dynamic Features**:
  1. Multi-tier organizational hierarchy (Central, District, Upazila, Thana, Branch).
  2. Training registration management (Aref, Rageb, Salek, Saleh courses) with dynamic Bengali PDF generation.
  3. Integrated Bangladeshi digital payment gateways (bKash Tokenized Checkout and Nagad Cryptographic Checkout) alongside manual donation verification.
  4. Online publication reader utilizing PDF.js for books, magazines, and research articles.
  5. Multi-language localization (`bn` Bengali, `en` English, `ar` Arabic) with RTL layout switching.
  6. Dedicated administrative control center managing 15+ functional subsystems.
  7. Mobile API backend serving a cross-platform Flutter application with Firebase Cloud Messaging (FCM).

---

## 3. Technology Stack Comparison

| Architectural Layer | Current Laravel Stack | Target Next.js + PostgreSQL Stack |
| :--- | :--- | :--- |
| **Framework / Runtime** | Laravel 10.x / 12.0 (PHP 8.2) | Next.js 15+ (App Router, Node.js 22 LTS) |
| **Language** | PHP 8.2 with strict types & Enums | TypeScript 5.x (Strict Type Safety) |
| **Frontend UI / Views** | Blade Templates (199 views) | React 19 Server & Client Components |
| **Styling & CSS** | Bootstrap 5.3, Custom CSS, SCSS, Tailwind v4 | Tailwind CSS v4 / PostCSS + Radix UI / shadcn/ui |
| **Database Engine** | MySQL 5.7+ / MariaDB (InnoDB, utf8mb4) | PostgreSQL 16+ (ACID, JSONB, Extensions) |
| **ORM / Data Access** | Eloquent ORM + DB Facade | Prisma ORM 6.x or Drizzle ORM |
| **Authentication (Admin)** | Multi-guard Session Auth (`auth:admin`, Bcrypt) | Auth.js (NextAuth v5) Credentials Provider (JWT/Session) |
| **Authentication (API)** | Laravel Sanctum (Personal Access Tokens) | Auth.js / Custom JWT Route Handlers (Sanctum Compatible) |
| **PDF Generation** | `barryvdh/laravel-dompdf` (Nikosh/SolaimanLipi fonts) | `@react-pdf/renderer` or Puppeteer Headless Engine |
| **PDF Viewer** | Mozilla PDF.js v2/v3 (`public/pdfjs/viewer.html`) | React PDF.js / `@react-pdf-viewer/core` |
| **Image Processing** | `intervention/image` v2.7 (GD / Imagick) | `sharp` (High-performance native Node.js imaging) |
| **Payment Gateways** | bKash Tokenized v1.2.0 & Nagad RSA Crypto | Native TypeScript bKash SDK & Nagad Crypto Module |
| **Push Notifications** | Google FCM HTTP Legacy Server Key | Google Firebase Admin SDK v1 (Modular Node.js) |
| **Rich Text Editor** | TinyMCE WYSIWYG + Image Upload API | TipTap (ProseMirror) or TinyMCE React |
| **Localization** | `lang/` PHP arrays (`bn`, `ar`, `en`), Spatie Translatable | `next-intl` or `next-i18next` with JSON translation catalogs |

---

## 4. Complete Project Directory Analysis

Inspection of the root Laravel application repository reveals the following structure:

```
Shubban-02/
├── app/
│   ├── Console/
│   │   ├── Commands/
│   │   │   └── MoveSliderImages.php      # Custom Artisan command for moving slider assets
│   │   └── Kernel.php                   # Scheduled tasks definition
│   ├── Enums/
│   │   └── CourseType.php               # PHP 8.1 string backed enum: aref, rageb, salek, saleh
│   ├── Exceptions/
│   │   └── Handler.php                  # Central error and exception reporting
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/                   # 25 Admin Controllers (CRUD for each subsystem)
│   │   │   ├── API/                     # 3 REST API Controllers (Auth, News, Products)
│   │   │   ├── Auth/                    # 6 Standard Laravel UI authentication controllers
│   │   │   ├── Education/               # 4 Education subject controllers (Quran, Hadith, etc.)
│   │   │   └── *.php                    # 23 Public root controllers (Home, Donate, Training, etc.)
│   │   ├── Middleware/
│   │   │   ├── AdminMiddleware.php      # Sanctum token ability check for admin
│   │   │   ├── Authenticate.php         # Multi-guard redirect logic (admin vs user)
│   │   │   ├── Language.php             # Session-based locale setter (defaults to 'bn')
│   │   │   └── ...                      # Default Laravel security middlewares
│   │   └── Kernel.php                   # Global HTTP pipeline and middleware aliases
│   ├── Models/                          # 30 Eloquent Models (User, Admin, News, Training, etc.)
│   ├── Providers/
│   │   ├── AppServiceProvider.php       # Sets locale and shared 'direction' (rtl vs ltr)
│   │   ├── RouteServiceProvider.php     # Loads web.php, api.php, and menu.php
│   │   └── ViewComposerServiceProvider.php # Injects top 5 active notices to header partial
│   └── Services/
│       └── FCMService.php               # Firebase Cloud Messaging token & topic pusher
├── config/                              # Configuration files (auth, bkash, payment, fcm, dompdf, etc.)
├── database/
│   ├── factories/                       # Database model test factories
│   ├── migrations/                      # 54 Migration scripts dating from 2014 to 2025
│   └── seeders/                         # 13 Seeders initializing sample data and admin accounts
├── lang/
│   ├── ar/messages.php                  # Arabic language localization dictionary (33 KB)
│   ├── bn/messages.php                  # Bengali language localization dictionary (37 KB)
│   └── en/messages.php                  # English language localization dictionary (24 KB)
├── mobile_app/                          # Full Flutter Mobile Application project
│   ├── lib/                             # Flutter Dart UI code consuming /api/ endpoints
│   ├── pubspec.yaml                     # Flutter package dependencies
│   └── ...
├── public/
│   ├── css/                             # Compiled and raw CSS files (admin, header, pages, etc.)
│   ├── fonts/                           # Bengali fonts (Nikosh, SolaimanLipi, etc.)
│   ├── images/                          # Static logos, banners, icons, default avatars
│   ├── js/                              # Frontend scripts (donate.js, gallery.js, font-size, etc.)
│   ├── pdfjs/                           # Standalone Mozilla PDF.js web viewer assets
│   ├── storage/                         # Symlink destination for uploaded public files
│   └── uploads/                         # Legacy direct upload folder (photos, pdfs, committee)
├── resources/
│   ├── js/                              # Vite JS build entry points
│   ├── sass/                            # Vite Sass entry points
│   └── views/                           # 199 Blade templates categorized by domain
├── routes/
│   ├── api.php                          # REST API endpoints (Sanctum guarded)
│   ├── console.php                      # Artisan console command routes
│   ├── menu.php                         # Additional web routes loaded by RouteServiceProvider
│   └── web.php                          # Main web routes (public and admin middleware groups)
├── storage/
│   ├── app/public/                      # Actual uploaded files directory (books, articles, etc.)
│   └── logs/                            # Application debug logs
├── bkash-setup.txt                      # Credentials and configuration notes for bKash sandbox
├── weekbieb_final_shubban.sql           # Complete MySQL database export (33 tables)
└── composer.json / package.json         # Dependency configuration files
```

---

## 5. Key Discoveries & Hidden Dependencies

During the Phase 01 deep source code audit, several critical undocumented behaviors, quirks, and subtle legacy issues were identified:

1. **Multiple Route Files Loaded Simultaneously**: `RouteServiceProvider.php` explicitly mounts three route files: `routes/api.php` under `/api`, `routes/web.php` with `web` middleware, and `routes/menu.php` also with `web` middleware. Several routes defined in `menu.php` overlap or mirror routes in `web.php` (e.g. `/institutions/*`, `/events/*`, `/gallery/*`).
2. **Dual Model Duality for Leadership Hierarchy**:
   - The application contains two similar models: `Responsible` (`responsibles` table, created April 7, 2025) and `Management` (`managements` table, created April 10, 2025).
   - In `Admin\ManagementController`, operations target `Management` with levels `central`, `district`, `upazila`, `thana`, `branch`.
   - In `ResponsibleController`, the `central` level queries `Committee` (`committee_members` table), while sub-levels query `Management` using `where('is_active', true)`. However, `managements` table defines column `status`, NOT `is_active`! This causes a runtime query failure in the Laravel app that must be normalized in Next.js + PostgreSQL.
3. **Dual Table Duality for Photo Gallery & Archives**:
   - Early migration created `galleries` (standalone gallery images with `path` and `is_featured`).
   - A subsequent migration created `gallery_archives`, which was later superseded by `archives` and `photos` (`archive_id` foreign key).
   - In the SQL dump, `gallery_archives` is deleted, and `archives` + `photos` are actively used by `Admin\GalleryArchiveController` and `Admin\PhotoController`.
4. **Dual Storage Discrepancies**:
   - Some controllers store files in `storage/app/public/...` via `Storage::disk('public')->store(...)`, which renders via `asset('storage/...')`.
   - Other controllers (notably public `TrainingController`) store uploaded photos directly into `public_path('uploads/photos')` via `$photo->move(...)` and PDFs into `Storage::disk('public')->put('uploads/pdfs/...')`.
   - The Next.js migration will consolidate all file assets into a unified, secure media storage layer.
5. **Session-based Admin Auth vs Sanctum API Auth**:
   - The admin panel uses standard Laravel sessions with the `admin` guard (`auth:admin`), querying the `admins` table.
   - The mobile API in `routes/api.php` attempts to route `/api/admin/login` to `Admin\AuthController::login`, but that method is written for session redirects. In Next.js, this must be separated into a clean JWT token endpoint.
6. **Bangla PDF Rendering & Typography**:
   - PDF generation for training cards requires complex Bengali script ligature rendering (Khariboli, Juktakkhor). The Laravel app relies on Dompdf with `SolaimanLipi` and `Nikosh` font definitions. Next.js must replicate this exact typographical accuracy using `@react-pdf/renderer` or a server-side Chromium/Puppeteer pipeline with embedded TrueType fonts.

---

## 6. Migration Constraints & Non-Negotiables

* **Zero Mutation of Original Code**: The Laravel directory `Shubban-02` must remain 100% read-only throughout the migration. All Next.js source code, assets, and build pipelines must reside in an independent directory.
* **100% Feature & UI Parity**: Every public page, navigation dropdown, language toggle, news interaction, and admin management tool must be recreated with matching visual styling and behaviors.
* **Preservation of Existing Data**: All existing records in `weekbieb_final_shubban.sql` (admin accounts, committee members, publications, news, slider slides, notices, and training registrations) will be migrated to PostgreSQL without data loss.
* **API Compatibility**: The Flutter application in `mobile_app` must remain functional against the Next.js API endpoints without requiring code modifications to the mobile client.
