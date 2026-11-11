# REST API & MOBILE CLIENT SPECIFICATION

This document details the REST API specifications consumed by the Flutter mobile application (`mobile_app/`) and public frontend AJAX interactions, alongside the target Next.js Route Handlers (`app/api/.../route.ts`).

---

## 1. Authentication & User API

### 1.1 User Login
* **Endpoint**: `POST /api/v1/auth/login` (Legacy: `POST /api/login`)
* **Access**: Public
* **Headers**: `Content-Type: application/json`, `Accept: application/json`
* **Request Body**:
  ```json
  {
    "email": "user@example.com",
    "password": "userpassword123",
    "device_name": "Pixel 7 Pro"
  }
  ```
* **Validation Rules**:
  * `email`: `required | email`
  * `password`: `required | string`
  * `device_name`: `required | string`
* **Success Response (200 OK)**:
  ```json
  {
    "token": "1|qW3x8Y9zA...",
    "user": {
      "id": 1,
      "name": "Abdullah",
      "email": "user@example.com",
      "fcm_token": null,
      "email_verified_at": null,
      "created_at": "2025-02-24T15:00:00.000000Z",
      "updated_at": "2025-02-24T15:00:00.000000Z"
    }
  }
  ```
* **Error Response (422 Unprocessable Entity)**:
  ```json
  {
    "message": "The provided credentials are incorrect.",
    "errors": {
      "email": ["The provided credentials are incorrect."]
    }
  }
  ```

---

### 1.2 User Registration
* **Endpoint**: `POST /api/v1/auth/register` (Legacy: `POST /api/register`)
* **Access**: Public
* **Request Body**:
  ```json
  {
    "name": "Muhammad",
    "email": "muhammad@example.com",
    "password": "StrongPassword123",
    "password_confirmation": "StrongPassword123",
    "device_name": "iPhone 14"
  }
  ```
* **Validation Rules**:
  * `name`: `required | string | max:255`
  * `email`: `required | string | email | max:255 | unique:users`
  * `password`: `required | string | min:8 | confirmed`
  * `device_name`: `required | string`
* **Success Response (201 Created)**:
  ```json
  {
    "token": "2|eR5t7Y8uI...",
    "user": {
      "id": 2,
      "name": "Muhammad",
      "email": "muhammad@example.com",
      "created_at": "2025-04-14T10:00:00.000000Z",
      "updated_at": "2025-04-14T10:00:00.000000Z"
    }
  }
  ```

---

### 1.3 User Logout
* **Endpoint**: `POST /api/v1/auth/logout` (Legacy: `POST /api/logout`)
* **Access**: Protected (`Authorization: Bearer <token>`)
* **Success Response (200 OK)**:
  ```json
  {
    "message": "Logged out successfully"
  }
  ```
* **Error Response (401 Unauthorized)**:
  ```json
  {
    "message": "Unauthenticated."
  }
  ```

---

### 1.4 Get Authenticated User Profile
* **Endpoint**: `GET /api/v1/auth/user` (Legacy: `GET /api/user`)
* **Access**: Protected (`Authorization: Bearer <token>`)
* **Success Response (200 OK)**: Returns the current user JSON object.

---

### 1.5 Update User Profile
* **Endpoint**: `POST /api/v1/auth/user/update` (Legacy: `POST /api/user/update`)
* **Access**: Protected (`Authorization: Bearer <token>`)
* **Request Body**:
  ```json
  {
    "name": "Muhammad Updated",
    "fcm_token": "fX7z...firebase_token"
  }
  ```
* **Success Response (200 OK)**:
  ```json
  {
    "success": true,
    "user": {
      "id": 2,
      "name": "Muhammad Updated",
      "email": "muhammad@example.com",
      "fcm_token": "fX7z...firebase_token"
    }
  }
  ```

---

## 2. Products API (Mobile Catalog)

### 2.1 List Products
* **Endpoint**: `GET /api/v1/products` (Legacy: `GET /api/products`)
* **Access**: Protected (`Authorization: Bearer <token>`)
* **Query Parameters**: `page` (default: 1)
* **Success Response (200 OK)**:
  ```json
  {
    "success": true,
    "data": {
      "current_page": 1,
      "data": [
        {
          "id": 1,
          "name": "কুরআন তরজমা ও তাফসীর",
          "description": "সহজ সরল বাংলা অনুবাদ ও সংক্ষিপ্ত ব্যাখ্যা।",
          "price": "750.00",
          "image": "products/quran.jpg",
          "is_active": true,
          "created_at": "2025-02-24T13:52:00.000000Z",
          "updated_at": "2025-02-24T13:52:00.000000Z"
        }
      ],
      "first_page_url": "/api/v1/products?page=1",
      "from": 1,
      "last_page": 3,
      "per_page": 10,
      "total": 28
    }
  }
  ```

### 2.2 Show Single Product
* **Endpoint**: `GET /api/v1/products/{id}`
* **Access**: Protected (`Authorization: Bearer <token>`)
* **Success Response (200 OK)**: Returns `{ success: true, data: { ...product } }`.
* **Not Found (404 Not Found)**:
  ```json
  {
    "success": false,
    "message": "Product not found"
  }
  ```

---

## 3. News API (Mobile Newsfeed)

### 3.1 List News
* **Endpoint**: `GET /api/v1/news` (Legacy: `GET /api/news`)
* **Access**: Protected (`Authorization: Bearer <token>`)
* **Query Parameters**: `page` (default: 1)
* **Success Response (200 OK)**: Returns paginated list of news articles matching Laravel pagination structure.

### 3.2 Show Single News Article
* **Endpoint**: `GET /api/v1/news/{id}`
* **Access**: Protected (`Authorization: Bearer <token>`)
* **Success Response (200 OK)**:
  ```json
  {
    "success": true,
    "data": {
      "id": 5,
      "title": "বার্ষিক ইসলামী সম্মেলনের প্রস্তুতি সম্পন্ন",
      "description": "আগামী শুক্রবার হতে কেন্দ্রীয় কার্যালয়ে অনুষ্ঠিত হবে...",
      "image": "news/event.jpg",
      "status": true,
      "created_at": "2025-04-06T08:32:00.000000Z"
    }
  }
  ```

---

## 4. Public Web AJAX Endpoints

### 4.1 News Like Toggle
* **Endpoint**: `POST /api/news/{id}/like` (Legacy: `POST /news/{news}/like`)
* **Access**: Public (Identifies by client IP address)
* **Success Response (200 OK)**:
  ```json
  {
    "action": "liked",
    "likes_count": 42
  }
  ```

### 4.2 Training Course Registration
* **Endpoint**: `POST /api/training/register` (Legacy: `POST /training/register`)
* **Access**: Public
* **Payload**: Form-Data with applicant metadata and `photo` file.
* **Success Response (200 OK)**:
  ```json
  {
    "success": true,
    "message": "রেজিস্ট্রেশন সফল হয়েছে।",
    "registration_id": 142,
    "pdf_url": "https://shubban.org/storage/uploads/pdfs/registration_142.pdf"
  }
  ```
* **Validation Failure (422 Unprocessable Entity)**:
  ```json
  {
    "success": false,
    "message": "ভুল তথ্য দেওয়া হয়েছে।",
    "errors": {
      "mobile": ["মোবাইল নম্বর ১১ ডিজিটের বাংলাদেশি মোবাইল নম্বর হতে হবে।"],
      "photo": ["ছবি JPG, JPEG, বা PNG ফরম্যাটে হতে হবে।"]
    }
  }
  ```

### 4.3 bKash Payment Integration Endpoints
* **Create Payment**: `POST /api/payment/bkash/create`
  * Request: `{ "amount": 500 }`
  * Response: `{ "statusCode": "0000", "paymentID": "TR0011...", "bkashURL": "..." }`
* **Execute Payment**: `POST /api/payment/bkash/execute`
  * Request: `{ "paymentID": "TR0011..." }`
  * Response: `{ "statusCode": "0000", "trxID": "BKA12345678", "transactionStatus": "Completed" }`

### 4.4 Nagad Payment Integration Endpoints
* **Create Payment**: `POST /api/payment/nagad/create`
  * Request: `{ "amount": 1000 }`
  * Response: `{ "success": true, "redirectUrl": "https://sandbox.nagad.com.bd/check-out/..." }`
* **Payment Callback**: `GET /api/payment/nagad/callback?payment_ref_id=...`
  * Decrypts callback payload, updates donation, redirects to `/donate/success` or `/donate/failed`.

### 4.5 TinyMCE Inline Image Upload
* **Endpoint**: `POST /api/admin/upload-image` (Legacy: `POST /admin/publications/upload-image`)
* **Access**: Admin only
* **Payload**: Form-Data containing `file`
* **Success Response (200 OK)**:
  ```json
  {
    "location": "/storage/articles/content-images/65fa_1744619000.jpg"
  }
  ```
