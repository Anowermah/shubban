# DATABASE ANALYSIS & POSTGRESQL SCHEMA SPECIFICATION

This document provides a comprehensive structural audit of all 33 database tables found in `weekbieb_final_shubban.sql` and the Laravel migration history, followed by the exact architectural mapping to PostgreSQL 16+.

---

## 1. Complete Audit of MySQL Database Tables (33 Tables)

### 1.1 Core Authentication & System Tables

#### 1. `admins`
* **Purpose**: Administrative credentials for admin dashboard access.
* **Columns**:
  * `id`: `BIGINT UNSIGNED NOT NULL AUTO_INCREMENT` (PK)
  * `name`: `VARCHAR(255) NOT NULL`
  * `email`: `VARCHAR(255) NOT NULL UNIQUE`
  * `password`: `VARCHAR(255) NOT NULL` (Bcrypt hash)
  * `status`: `TINYINT(1) NOT NULL DEFAULT 1`
  * `remember_token`: `VARCHAR(100) NULL DEFAULT NULL`
  * `created_at`, `updated_at`: `TIMESTAMP NULL DEFAULT NULL`

#### 2. `users`
* **Purpose**: Mobile application registered end-users.
* **Columns**:
  * `id`: `BIGINT UNSIGNED NOT NULL AUTO_INCREMENT` (PK)
  * `name`: `VARCHAR(255) NOT NULL`
  * `email`: `VARCHAR(255) NOT NULL UNIQUE`
  * `email_verified_at`: `TIMESTAMP NULL DEFAULT NULL`
  * `password`: `VARCHAR(255) NOT NULL`
  * `fcm_token`: `TEXT NULL DEFAULT NULL` (Firebase Cloud Messaging push token)
  * `remember_token`: `VARCHAR(100) NULL DEFAULT NULL`
  * `created_at`, `updated_at`: `TIMESTAMP NULL DEFAULT NULL`

#### 3. `personal_access_tokens`
* **Purpose**: Laravel Sanctum API bearer tokens for mobile app authentication.
* **Columns**:
  * `id`: `BIGINT UNSIGNED NOT NULL AUTO_INCREMENT` (PK)
  * `tokenable_type`: `VARCHAR(255) NOT NULL` (`App\Models\User`)
  * `tokenable_id`: `BIGINT UNSIGNED NOT NULL`
  * `name`: `VARCHAR(255) NOT NULL` (Device name, e.g. "Pixel 7")
  * `token`: `VARCHAR(64) NOT NULL UNIQUE` (SHA-256 hash)
  * `abilities`: `TEXT NULL DEFAULT NULL` (JSON array: `["*"]`)
  * `last_used_at`: `TIMESTAMP NULL DEFAULT NULL`
  * `expires_at`: `TIMESTAMP NULL DEFAULT NULL`
  * `created_at`, `updated_at`: `TIMESTAMP NULL DEFAULT NULL`

#### 4. `password_resets`
* **Columns**: `email` (`VARCHAR(255) NOT NULL`), `token` (`VARCHAR(255) NOT NULL`), `created_at` (`TIMESTAMP NULL DEFAULT NULL`). Index on `email`.

#### 5. `failed_jobs`
* **Columns**: `id` (PK), `uuid` (`VARCHAR(255) UNIQUE`), `connection`, `queue`, `payload` (`LONGTEXT`), `exception` (`LONGTEXT`), `failed_at` (`TIMESTAMP`).

#### 6. `settings`
* **Purpose**: Singleton store for application global settings.
* **Columns**:
  * `id`: `BIGINT UNSIGNED NOT NULL AUTO_INCREMENT` (PK)
  * `site_title`: `VARCHAR(255) NOT NULL`
  * `site_description`: `TEXT NOT NULL`
  * `contact_email`: `VARCHAR(255) NOT NULL`
  * `contact_phone`: `VARCHAR(20) NOT NULL`
  * `contact_address`: `TEXT NOT NULL`
  * `logo`: `VARCHAR(255) NULL DEFAULT NULL`
  * `facebook_url`: `VARCHAR(255) NULL DEFAULT NULL`
  * `twitter_url`: `VARCHAR(255) NULL DEFAULT NULL`
  * `youtube_url`: `VARCHAR(255) NULL DEFAULT NULL`
  * `created_at`, `updated_at`: `TIMESTAMP NULL DEFAULT NULL`

---

### 1.2 Publications & Educational Content Tables

#### 7. `books`
* **Purpose**: Books catalog for Islamic literature with PDF downloads and online reading.
* **Columns**:
  * `id`: `BIGINT UNSIGNED NOT NULL AUTO_INCREMENT` (PK)
  * `title`: `VARCHAR(255) NOT NULL`
  * `author`: `VARCHAR(255) NOT NULL`
  * `description`: `TEXT NULL DEFAULT NULL`
  * `publication_date`: `DATE NOT NULL`
  * `isbn`: `VARCHAR(13) NULL DEFAULT NULL`
  * `price`: `DECIMAL(10, 2) NULL DEFAULT NULL`
  * `cover_image`: `VARCHAR(255) NULL DEFAULT NULL` (e.g. `books/covers/uuid.jpg`)
  * `pdf_file`: `VARCHAR(255) NULL DEFAULT NULL` (e.g. `books/pdfs/uuid.pdf`)
  * `status`: `ENUM('draft', 'published') NOT NULL DEFAULT 'draft'`
  * `created_at`, `updated_at`: `TIMESTAMP NULL DEFAULT NULL`

#### 8. `magazines`
* **Purpose**: Periodic Islamic journal issues with cover imagery and PDF reader.
* **Columns**:
  * `id`: `BIGINT UNSIGNED NOT NULL AUTO_INCREMENT` (PK)
  * `title`: `VARCHAR(255) NOT NULL`
  * `issue_number`: `VARCHAR(255) NOT NULL`
  * `publication_date`: `DATE NOT NULL`
  * `description`: `TEXT NULL DEFAULT NULL`
  * `price`: `DECIMAL(10, 2) NULL DEFAULT NULL`
  * `cover_image`: `VARCHAR(255) NULL DEFAULT NULL`
  * `pdf_file`: `VARCHAR(255) NULL DEFAULT NULL`
  * `status`: `ENUM('draft', 'published') NOT NULL DEFAULT 'draft'`
  * `created_at`, `updated_at`: `TIMESTAMP NULL DEFAULT NULL`

#### 9. `articles`
* **Purpose**: Scholarly articles, research papers, and essays.
* **Columns**:
  * `id`: `BIGINT UNSIGNED NOT NULL AUTO_INCREMENT` (PK)
  * `title`: `VARCHAR(255) NOT NULL`
  * `description`: `TEXT NOT NULL`
  * `content`: `LONGTEXT NULL DEFAULT NULL` (Rich HTML from TinyMCE)
  * `author`: `VARCHAR(100) NULL DEFAULT NULL`
  * `cover_image`: `VARCHAR(255) NULL DEFAULT NULL`
  * `pdf_file`: `VARCHAR(255) NULL DEFAULT NULL`
  * `publication_date`: `DATE NOT NULL`
  * `category`: `VARCHAR(255) NULL DEFAULT NULL`
  * `status`: `ENUM('draft', 'published') NOT NULL DEFAULT 'draft'`
  * `created_at`, `updated_at`: `TIMESTAMP NULL DEFAULT NULL`

---

### 1.3 Media, Gallery & Archives Tables

#### 10. `archives`
* **Purpose**: Year-based photo collection albums.
* **Columns**:
  * `id`: `BIGINT UNSIGNED NOT NULL AUTO_INCREMENT` (PK)
  * `title`: `VARCHAR(255) NOT NULL`
  * `description`: `TEXT NULL DEFAULT NULL`
  * `year`: `INT(11) NOT NULL`
  * `cover_image`: `VARCHAR(255) NOT NULL`
  * `status`: `TINYINT(1) NOT NULL DEFAULT 1`
  * `created_at`, `updated_at`: `TIMESTAMP NULL DEFAULT NULL`

#### 11. `photos`
* **Purpose**: Individual photographs associated with archives or standalone gallery.
* **Columns**:
  * `id`: `BIGINT UNSIGNED NOT NULL AUTO_INCREMENT` (PK)
  * `image_url`: `VARCHAR(255) NOT NULL`
  * `title`: `LONGTEXT NOT NULL CHECK (json_valid(title))` (Multilingual JSON: `{"bn": "...", "en": "..."}`)
  * `description`: `LONGTEXT NOT NULL CHECK (json_valid(description))` (Multilingual JSON)
  * `category`: `VARCHAR(255) NOT NULL`
  * `date`: `TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP`
  * `status`: `TINYINT(1) NOT NULL DEFAULT 1`
  * `archive_id`: `BIGINT UNSIGNED NULL DEFAULT NULL` (FK -> `archives.id`)
  * `gallery_archive_id`: `BIGINT UNSIGNED NULL DEFAULT NULL` (Legacy column)
  * `created_at`, `updated_at`: `TIMESTAMP NULL DEFAULT NULL`

#### 12. `galleries`
* **Purpose**: Featured homepage gallery highlights.
* **Columns**:
  * `id`: `BIGINT UNSIGNED NOT NULL AUTO_INCREMENT` (PK)
  * `title`: `VARCHAR(255) NOT NULL`
  * `description`: `TEXT NULL DEFAULT NULL`
  * `path`: `VARCHAR(255) NOT NULL`
  * `is_featured`: `TINYINT(1) NOT NULL DEFAULT 0`
  * `created_at`, `updated_at`: `TIMESTAMP NULL DEFAULT NULL`

#### 13. `videos`
* **Purpose**: Video gallery featuring YouTube embeds.
* **Columns**:
  * `id`: `BIGINT UNSIGNED NOT NULL AUTO_INCREMENT` (PK)
  * `title`: `VARCHAR(255) NOT NULL`
  * `description`: `TEXT NULL DEFAULT NULL`
  * `video_url`: `VARCHAR(255) NOT NULL` (YouTube URL)
  * `thumbnail_url`: `VARCHAR(255) NULL DEFAULT NULL`
  * `category`: `VARCHAR(255) NOT NULL`
  * `date`: `DATE NOT NULL`
  * `status`: `TINYINT(1) NOT NULL DEFAULT 1`
  * `created_at`, `updated_at`: `TIMESTAMP NULL DEFAULT NULL`

#### 14. `sliders`
* **Purpose**: Homepage hero carousel slides.
* **Columns**:
  * `id`: `BIGINT UNSIGNED NOT NULL AUTO_INCREMENT` (PK)
  * `title`: `VARCHAR(255) NOT NULL`
  * `subtitle`: `VARCHAR(255) NULL DEFAULT NULL`
  * `image`: `VARCHAR(255) NOT NULL`
  * `button_text`: `VARCHAR(255) NULL DEFAULT NULL`
  * `button_link`: `VARCHAR(255) NULL DEFAULT NULL`
  * `status`: `TINYINT(1) NOT NULL DEFAULT 1`
  * `order`: `INT(11) NOT NULL DEFAULT 0`
  * `created_at`, `updated_at`: `TIMESTAMP NULL DEFAULT NULL`

---

### 1.4 News, Notices & Activities Tables

#### 15. `news`
* **Columns**:
  * `id`: `BIGINT UNSIGNED NOT NULL AUTO_INCREMENT` (PK)
  * `title`: `VARCHAR(255) NOT NULL`
  * `description`: `TEXT NOT NULL`
  * `image`: `VARCHAR(255) NOT NULL`
  * `status`: `TINYINT(1) NOT NULL DEFAULT 1`
  * `created_at`, `updated_at`: `TIMESTAMP NULL DEFAULT NULL`

#### 16. `news_likes`
* **Columns**:
  * `id`: `BIGINT UNSIGNED NOT NULL AUTO_INCREMENT` (PK)
  * `news_id`: `BIGINT UNSIGNED NOT NULL` (FK -> `news.id` ON DELETE CASCADE)
  * `ip_address`: `VARCHAR(45) NOT NULL` (IPv4 or IPv6 string)
  * `created_at`, `updated_at`: `TIMESTAMP NULL DEFAULT NULL`
  * Index on `(news_id, ip_address)`

#### 17. `news_comments`
* **Columns**:
  * `id`: `BIGINT UNSIGNED NOT NULL AUTO_INCREMENT` (PK)
  * `news_id`: `BIGINT UNSIGNED NOT NULL` (FK -> `news.id` ON DELETE CASCADE)
  * `name`: `VARCHAR(255) NOT NULL`
  * `email`: `VARCHAR(255) NOT NULL`
  * `comment`: `TEXT NOT NULL`
  * `status`: `TINYINT(1) NOT NULL DEFAULT 0` (0 = unapproved, 1 = approved)
  * `created_at`, `updated_at`: `TIMESTAMP NULL DEFAULT NULL`

#### 18. `notices`
* **Columns**:
  * `id`: `BIGINT UNSIGNED NOT NULL AUTO_INCREMENT` (PK)
  * `title`: `VARCHAR(255) NOT NULL`
  * `description`: `TEXT NULL DEFAULT NULL`
  * `category`: `VARCHAR(255) NOT NULL DEFAULT 'general'`
  * `file`: `VARCHAR(255) NULL DEFAULT NULL` (PDF circular)
  * `image`: `VARCHAR(255) NULL DEFAULT NULL` (Notice graphic)
  * `status`: `TINYINT(1) NOT NULL DEFAULT 1`
  * `created_at`, `updated_at`: `TIMESTAMP NULL DEFAULT NULL`

#### 19. `activities`
* **Columns**:
  * `id`: `BIGINT UNSIGNED NOT NULL AUTO_INCREMENT` (PK)
  * `title`: `VARCHAR(255) NOT NULL`
  * `description`: `TEXT NOT NULL`
  * `image`: `VARCHAR(255) NULL DEFAULT NULL`
  * `status`: `TINYINT(1) NOT NULL DEFAULT 1`
  * `created_at`, `updated_at`: `TIMESTAMP NULL DEFAULT NULL`

---

### 1.5 Organization Structure & Management Tables

#### 20. `committee_members`
* **Purpose**: Central executive committee members.
* **Columns**:
  * `id`: `BIGINT UNSIGNED NOT NULL AUTO_INCREMENT` (PK)
  * `name`: `VARCHAR(255) NOT NULL`
  * `designation`: `VARCHAR(255) NOT NULL`
  * `phone`: `VARCHAR(255) NULL DEFAULT NULL`
  * `email`: `VARCHAR(255) NULL DEFAULT NULL`
  * `address`: `TEXT NULL DEFAULT NULL`
  * `image`: `VARCHAR(255) NULL DEFAULT NULL`
  * `order`: `INT(11) NOT NULL DEFAULT 0`
  * `is_active`: `TINYINT(1) NOT NULL DEFAULT 1`
  * `created_at`, `updated_at`: `TIMESTAMP NULL DEFAULT NULL`

#### 21. `departments`
* **Purpose**: Organizational functional departments.
* **Columns**:
  * `id`: `BIGINT UNSIGNED NOT NULL AUTO_INCREMENT` (PK)
  * `name`: `VARCHAR(255) NOT NULL`
  * `head`: `VARCHAR(255) NOT NULL`
  * `designation`: `VARCHAR(255) NOT NULL`
  * `description`: `TEXT NULL DEFAULT NULL`
  * `responsibilities`: `LONGTEXT NULL DEFAULT NULL CHECK (json_valid(responsibilities))` (JSON array)
  * `email`: `VARCHAR(255) NULL DEFAULT NULL`
  * `phone`: `VARCHAR(255) NULL DEFAULT NULL`
  * `location`: `VARCHAR(255) NULL DEFAULT NULL`
  * `staff_count`: `INT(11) NOT NULL DEFAULT 0`
  * `is_active`: `TINYINT(1) NOT NULL DEFAULT 1`
  * `order`: `INT(11) NOT NULL DEFAULT 0`
  * `created_at`, `updated_at`: `TIMESTAMP NULL DEFAULT NULL`

#### 22. `officials`
* **Purpose**: Executive administrative officials and directors.
* **Columns**:
  * `id`: `BIGINT UNSIGNED NOT NULL AUTO_INCREMENT` (PK)
  * `name`: `VARCHAR(255) NOT NULL`
  * `designation`: `VARCHAR(255) NOT NULL`
  * `education`: `VARCHAR(255) NULL DEFAULT NULL`
  * `experience`: `VARCHAR(255) NULL DEFAULT NULL`
  * `expertise`: `LONGTEXT NULL DEFAULT NULL CHECK (json_valid(expertise))` (JSON array)
  * `responsibilities`: `LONGTEXT NULL DEFAULT NULL CHECK (json_valid(responsibilities))` (JSON array)
  * `email`: `VARCHAR(255) NULL DEFAULT NULL`
  * `phone`: `VARCHAR(255) NULL DEFAULT NULL`
  * `office`: `VARCHAR(255) NULL DEFAULT NULL`
  * `image`: `VARCHAR(255) NULL DEFAULT NULL`
  * `is_active`: `TINYINT(1) NOT NULL DEFAULT 1`
  * `order`: `INT(11) NOT NULL DEFAULT 0`
  * `created_at`, `updated_at`: `TIMESTAMP NULL DEFAULT NULL`

#### 23. `managements`
* **Purpose**: Tiered field leaders (Central, District, Upazila, Thana, Branch).
* **Columns**:
  * `id`: `BIGINT UNSIGNED NOT NULL AUTO_INCREMENT` (PK)
  * `name`: `VARCHAR(255) NOT NULL`
  * `designation`: `VARCHAR(255) NOT NULL`
  * `level`: `ENUM('central', 'district', 'upazila', 'union', 'thana', 'branch') NOT NULL`
  * `area`: `VARCHAR(255) NULL DEFAULT NULL`
  * `phone`: `VARCHAR(255) NULL DEFAULT NULL`
  * `email`: `VARCHAR(255) NULL DEFAULT NULL`
  * `address`: `TEXT NULL DEFAULT NULL`
  * `image`: `VARCHAR(255) NULL DEFAULT NULL`
  * `status`: `TINYINT(1) NOT NULL DEFAULT 1`
  * `order`: `INT(11) NOT NULL DEFAULT 0`
  * `created_at`, `updated_at`: `TIMESTAMP NULL DEFAULT NULL`

#### 24. `responsibles` (Legacy/Parallel table)
* **Columns**: `id`, `name`, `designation`, `phone`, `email`, `image`, `level`, `order`, `is_active`, `created_at`, `updated_at`. *(Replaced by `managements`)*.

#### 25. `members`
* **Purpose**: General organizational membership directory.
* **Columns**: `id` (PK), `name`, `email`, `phone`, `address`, `status` (`TINYINT(1) DEFAULT 1`), `created_at`, `updated_at`.

---

### 1.6 Training, Events, Donations & Inquiries Tables

#### 26. `trainings`
* **Purpose**: Structured courses and training seminars.
* **Columns**:
  * `id`: `BIGINT UNSIGNED NOT NULL AUTO_INCREMENT` (PK)
  * `title`: `LONGTEXT NOT NULL CHECK (json_valid(title))` (Multilingual JSON)
  * `description`: `LONGTEXT NOT NULL CHECK (json_valid(description))` (Multilingual JSON)
  * `start_date`: `DATETIME NOT NULL`
  * `end_date`: `DATETIME NOT NULL`
  * `location`: `LONGTEXT NOT NULL CHECK (json_valid(location))` (Multilingual JSON)
  * `type`: `VARCHAR(255) NOT NULL` (`aref`, `rageb`, `salek`, `saleh`)
  * `organization_name`: `VARCHAR(255) NULL DEFAULT NULL`
  * `image`: `VARCHAR(255) NULL DEFAULT NULL`
  * `created_at`, `updated_at`: `TIMESTAMP NULL DEFAULT NULL`

#### 27. `training_registrations`
* **Purpose**: Applicant registrations for training courses.
* **Columns**:
  * `id`: `BIGINT UNSIGNED NOT NULL AUTO_INCREMENT` (PK)
  * `course_type`: `VARCHAR(255) NOT NULL` (`aref`, `rageb`, `salek`, `saleh`)
  * `name`: `VARCHAR(255) NOT NULL`
  * `father_name`: `VARCHAR(255) NOT NULL`
  * `mother_name`: `VARCHAR(255) NOT NULL`
  * `date_of_birth`: `DATE NOT NULL`
  * `blood_group`: `VARCHAR(255) NULL DEFAULT NULL`
  * `gender`: `VARCHAR(255) NOT NULL` (`male`, `female`)
  * `mobile`: `VARCHAR(255) NOT NULL`
  * `email`: `VARCHAR(255) NULL DEFAULT NULL`
  * `emergency_contact`: `VARCHAR(255) NOT NULL`
  * `emergency_relation`: `VARCHAR(255) NOT NULL`
  * `nid`: `VARCHAR(255) NULL DEFAULT NULL`
  * `father_occupation`: `VARCHAR(255) NULL DEFAULT NULL`
  * `photo`: `VARCHAR(255) NOT NULL`
  * `present_village`, `present_post`, `present_thana`, `present_district`: `VARCHAR(255) NOT NULL`
  * `permanent_village`, `permanent_post`, `permanent_thana`, `permanent_district`: `VARCHAR(255) NOT NULL`
  * `last_education`, `institute`, `passing_year`, `result`: `VARCHAR(255) NOT NULL`
  * `organization_name`, `designation`, `joining_date`, `organization_address`: `VARCHAR(255) NULL DEFAULT NULL`
  * `pdf_path`: `VARCHAR(255) NULL DEFAULT NULL`
  * `created_at`, `updated_at`: `TIMESTAMP NULL DEFAULT NULL`

#### 28. `events`
* **Purpose**: Organizational calendar events and annual gatherings.
* **Columns**:
  * `id`: `BIGINT UNSIGNED NOT NULL AUTO_INCREMENT` (PK)
  * `title`: `LONGTEXT NOT NULL CHECK (json_valid(title))` (Multilingual JSON)
  * `slug`: `VARCHAR(255) NOT NULL UNIQUE`
  * `description`: `LONGTEXT NOT NULL CHECK (json_valid(description))` (Multilingual JSON)
  * `location`: `LONGTEXT NOT NULL CHECK (json_valid(location))` (Multilingual JSON)
  * `start_date`, `end_date`: `DATE NOT NULL`
  * `start_time`, `end_time`: `TIME NULL DEFAULT NULL`
  * `image`: `VARCHAR(255) NULL DEFAULT NULL`
  * `is_annual`: `TINYINT(1) NOT NULL DEFAULT 0`
  * `registration_required`: `TINYINT(1) NOT NULL DEFAULT 0`
  * `status`: `TINYINT(1) NOT NULL DEFAULT 1`
  * `created_at`, `updated_at`: `TIMESTAMP NULL DEFAULT NULL`

#### 29. `donations`
* **Purpose**: Contributions made online (bKash/Nagad) or submitted manually.
* **Columns**:
  * `id`: `BIGINT UNSIGNED NOT NULL AUTO_INCREMENT` (PK)
  * `name`: `VARCHAR(255) NOT NULL`
  * `email`: `VARCHAR(255) NULL DEFAULT NULL`
  * `phone`: `VARCHAR(20) NOT NULL`
  * `amount`: `DECIMAL(10, 2) NOT NULL`
  * `payment_method`: `VARCHAR(255) NOT NULL` (`bkash`, `nagad`, `rocket`, `bank`, `manual`)
  * `transaction_id`: `VARCHAR(255) NULL DEFAULT NULL`
  * `category`: `VARCHAR(255) NOT NULL DEFAULT 'general'` (`orphan`, `student`, `ramadan`, `eid`, `quran`, `general`)
  * `status`: `VARCHAR(255) NOT NULL DEFAULT 'pending'` (`pending`, `completed`/`approved`, `failed`/`rejected`)
  * `message`: `TEXT NULL DEFAULT NULL`
  * `created_at`, `updated_at`: `TIMESTAMP NULL DEFAULT NULL`

#### 30. `contacts`
* **Purpose**: Inquiries submitted through public contact form.
* **Columns**: `id` (PK), `name` (`VARCHAR(255)`), `phone` (`VARCHAR(255)`), `email` (`VARCHAR(255)`), `subject` (`VARCHAR(255)`), `message` (`TEXT`), `status` (`TINYINT(1) DEFAULT 0` - unread=0, read=1), `created_at`, `updated_at`.

#### 31. `products`
* **Purpose**: Publications / items served via mobile API.
* **Columns**: `id` (PK), `name` (`VARCHAR(255)`), `description` (`TEXT`), `price` (`DECIMAL(10,2)`), `image` (`VARCHAR(255)`), `is_active` (`TINYINT(1) DEFAULT 1`), `created_at`, `updated_at`.

#### 32. `posts`
* **Columns**: `id` (PK), `title` (`VARCHAR(255)`), `content` (`TEXT`), `created_at`, `updated_at`.

#### 33. `migrations`
* **Purpose**: Laravel migration tracker table.

---

## 2. PostgreSQL 16+ Target Schema Architecture

### 2.1 Native PostgreSQL Types & Extensions
1. **Extensions**:
   ```sql
   CREATE EXTENSION IF NOT EXISTS "uuid-ossp";
   CREATE EXTENSION IF NOT EXISTS "pg_trgm"; -- For fuzzy search in Bengali & English
   ```
2. **Custom ENUM Types**:
   ```sql
   CREATE TYPE publication_status AS ENUM ('draft', 'published');
   CREATE TYPE management_level AS ENUM ('central', 'district', 'upazila', 'union', 'thana', 'branch');
   CREATE TYPE course_type_enum AS ENUM ('aref', 'rageb', 'salek', 'saleh');
   CREATE TYPE gender_enum AS ENUM ('male', 'female');
   CREATE TYPE donation_status AS ENUM ('pending', 'completed', 'failed');
   CREATE TYPE donation_category AS ENUM ('orphan', 'student', 'ramadan', 'eid', 'quran', 'general');
   ```

### 2.2 Data Type Mappings Summary

| MySQL 5.7/8 Type | PostgreSQL 16+ Type | Architecture Rationale |
| :--- | :--- | :--- |
| `BIGINT(20) UNSIGNED AUTO_INCREMENT` | `BIGINT GENERATED ALWAYS AS IDENTITY` | Standard SQL identity replacing legacy autoincrement |
| `TINYINT(1)` | `BOOLEAN` | Native Boolean with `TRUE` / `FALSE` values |
| `LONGTEXT CHECK (json_valid(...))` | `JSONB` | Native binary JSON with indexability & efficient querying |
| `DECIMAL(10, 2)` | `NUMERIC(10, 2)` | Exact financial precision without floating point errors |
| `VARCHAR(255)` | `VARCHAR(255)` or `TEXT` | PostgreSQL treats `TEXT` and `VARCHAR` identically in storage |
| `TIMESTAMP NULL DEFAULT NULL` | `TIMESTAMPTZ NULL DEFAULT NULL` | Timezone-aware timestamping (UTC standard) |
| `DATETIME` | `TIMESTAMPTZ` | Standardizes date-time values across server environments |

---

## 3. Data Migration ETL Strategy (MySQL to PostgreSQL)

1. **Extraction**:
   * Parse `weekbieb_final_shubban.sql` dump file using a streaming parser.
   * Sanitize datetime strings (`0000-00-00 00:00:00` mapped to `NULL`).
2. **Transformation**:
   * Convert boolean integer columns (`0`/`1`) to true PostgreSQL booleans (`false`/`true`).
   * Validate JSON strings in translatable fields (`title`, `description`, `location`, `responsibilities`, `expertise`) and parse into valid `JSONB` payloads.
   * Reconcile legacy `responsibles` table data into `managements` table with `status = is_active`.
   * Standardize donation statuses to consistent enum (`pending`, `completed`, `failed`).
3. **Loading**:
   * Execute foreign key disabled loading using `COPY` or batched transactions.
   * Reset PostgreSQL identity sequences to match max `id` values:
     ```sql
     SELECT setval(pg_get_serial_sequence('books', 'id'), COALESCE(MAX(id), 1)) FROM books;
     ```
