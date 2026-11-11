# BUSINESS LOGIC & DOMAIN WORKFLOW ANALYSIS

This document provides a comprehensive reverse-engineered specification of all business rules, domain workflows, validation criteria, mathematical calculations, and edge cases implemented across the application.

---

## 1. Training Registration & Admission Workflow

The training subsystem (`TrainingController` and `Admin\*TrainingController`) is one of the most complex domain workflows in the application.

```
       User Submits Form
               │
               ▼
  Validate Course Type (aref, rageb, salek, saleh)
               │
               ▼
  Check same_as_present (Mirror Present -> Permanent)
               │
               ▼
  Execute Validation Rules (NID, Mobile, DOB, Photo)
               │
               ▼
  Duplicate Check:
  (course_type + mobile) OR (course_type + name + father + mother)
        ├── Found duplicate? ──> Return 422 "আপনি ইতিমধ্যে রেজিস্ট্রেশন করেছেন।"
        └── Not found?
               │
               ▼
  Process Photo Upload (Move to uploads/photos/)
               │
               ▼
  Insert record into training_registrations table
               │
               ▼
  Generate PDF Admit Slip (Dompdf with Nikosh font)
               │
               ▼
  Save PDF to storage/uploads/pdfs/registration_{id}.pdf
               │
               ▼
  Update registration.pdf_path
               │
               ▼
  Return JSON: { success: true, registration_id: N, pdf_url: "..." }
```

### 1.1 Course Types & Enumeration
* Supported courses:
  * `aref`: আরেফ প্রশিক্ষণ (Advanced Islamic Leadership Training)
  * `rageb`: রাগেব প্রশিক্ষণ (Intermediate Spiritual & Dawah Development)
  * `salek`: সালেক প্রশিক্ষণ (Foundational Islamic Knowledge)
  * `saleh`: সালেহ প্রশিক্ষণ (Youth Islamic Character & Ethics)
* Strictly enforced via PHP 8.1 backed enum `App\Enums\CourseType: string`.

### 1.2 Validation Rules & Bengali Error Messaging
* **Mobile Number**: Must be exactly 11 digits and match Bangladeshi telecom prefix:
  `regex: /^(?:\+?88)?01[3-9]\d{8}$/`
  Error: *"মোবাইল নম্বর ১১ ডিজিটের বাংলাদেশি মোবাইল নম্বর হতে হবে।"*
* **Emergency Contact**: Same 11-digit Bangladeshi mobile validation + required emergency relationship.
* **National ID (NID)**: Optional, but if provided must match 10 digits (Smart Card), 13 digits (Old NID), or 17 digits (NID with birth year):
  `regex: /^[0-9]{10}$|^[0-9]{13}$|^[0-9]{17}$/`
  Error: *"জাতীয় পরিচয়পত্র নম্বর সঠিক নয়। ১০, ১৩, বা ১৭ ডিজিটের NID নম্বর দিন।"*
* **Date of Birth**: Required, valid date format, must be strictly before current date (`before:today`).
* **Blood Group**: Optional, restricted to enum: `A+`, `A-`, `B+`, `B-`, `AB+`, `AB-`, `O+`, `O-`.
* **Passing Year**: Valid integer between 1900 and `current_year + 1`.
* **Photo**: Required, valid image format (JPEG, PNG, JPG), maximum size 2048 KB (2MB).

### 1.3 Address Mirroring Business Rule
* If the user ticks the checkbox `same_as_present`:
  ```php
  $validated['permanent_village'] = $validated['present_village'];
  $validated['permanent_post'] = $validated['present_post'];
  $validated['permanent_thana'] = $validated['present_thana'];
  $validated['permanent_district'] = $validated['present_district'];
  ```
  The server skips validation for permanent address fields and sets them equal to present address.

### 1.4 Duplicate Registration Guard
Prevents students from registering twice for the same training session:
```php
$existingRegistration = TrainingRegistration::where('course_type', $request->course_type)
    ->where(function($query) use ($request) {
        $query->where('mobile', $request->mobile)
            ->orWhere(function($q) use ($request) {
                $q->where('name', $request->name)
                  ->where('father_name', $request->father_name)
                  ->where('mother_name', $request->mother_name);
            });
    })->first();
```
If an existing record matches, the server halts registration with error: *"আপনি ইতিমধ্যে রেজিস্ট্রেশন করেছেন।"* (You have already registered).

### 1.5 PDF Generation & File Storage
* Uses Dompdf to render view `training.pdf` with applicant data.
* Applies SolaimanLipi / Nikosh font with UTF-8 Bengali Unicode subsetting.
* Paper size: A4 portrait.
* File is saved at `uploads/pdfs/registration_{id}.pdf` and linked in `pdf_path`.

---

## 2. Digital & Manual Donations Workflow

### 2.1 Donation Categories & Allocation
1. `orphan` (এতিমখানা তহবিল): Support for orphanages and resident orphans.
2. `student` (ছাত্র বৃত্তি তহবিল): Scholarships for underprivileged Islamic students.
3. `ramadan` (রমজান খাদ্য তহবিল): Ramadan Iftar and food aid distribution.
4. `eid` (ঈদ উপহার বিতরণ): Eid clothing and gift parcels.
5. `quran` (কুরআন বিতরণ তহবিল): Printing and distribution of the Holy Quran.
6. `general` (সাধারণ দান): General organizational operations and dawah activities.

### 2.2 Payment Methods & Verification Lifecycle
* **Manual Mobile Banking / Bank Deposit**:
  1. Donor transfers funds to Shubban's official bKash, Nagad, Rocket, or Bank account.
  2. Donor submits donation form with `manual_payment_method` (`bkash`, `nagad`, `rocket`, `bank`) and `transaction_id`.
  3. Stored with `status = 'pending'`.
  4. Admin verifies the transaction in the bank/MFS statement and updates status to `completed` or `failed`.
* **bKash Tokenized Checkout (Online)**:
  1. Frontend sends payment amount to `/bkash/create`.
  2. Backend requests bKash Grant Token with `app_key` and `app_secret`.
  3. Backend calls `/tokenized/checkout/create` with invoice number and callback URL.
  4. Donor enters bKash PIN in bKash WebView.
  5. bKash returns `paymentID` to callback.
  6. Backend calls `/tokenized/checkout/execute`.
  7. On success, donation is updated to `completed` with the bKash TrxID.
* **Nagad Cryptographic Checkout (Online)**:
  1. Backend generates sensitive payload with merchant ID, order ID, timestamp, and 32-byte hex challenge.
  2. Payload is encrypted using Nagad RSA Public Key via `openssl_public_encrypt`.
  3. Digital signature is generated using Merchant Private Key via `openssl_sign` (SHA256).
  4. Backend initializes payment via Nagad DFS endpoint and redirects donor.
  5. On callback, backend decrypts response using Merchant Private Key and updates donation record.

---

## 3. Leadership & Field Management Business Logic

### 3.1 Hierarchical Tiers
* Level 1: **Central (কেন্দ্রীয়)** - National Executive Board.
* Level 2: **District (জেলা)** - District branches across Bangladesh.
* Level 3: **Upazila (উপজেলা)** - Sub-district administrative committees.
* Level 4: **Thana (থানা)** - Police station jurisdiction units.
* Level 5: **Branch (শাখা)** - Grassroots local branch units.

### 3.2 Display Ordering & Status Filtering
* Leaders are displayed in ascending sequence by the integer column `order` (1, 2, 3...).
* Public views display only active records (`status = true` / `is_active = true`).

### 3.3 Critical Laravel Bug Identified & Next.js Fix
* In Laravel's `ResponsibleController.php`:
  ```php
  $responsiblePersons = Management::where('level', $level)
      ->where('is_active', true) // BUG: managements table has 'status', NOT 'is_active'!
      ->orderBy('order')
      ->get();
  ```
* In Next.js, this is resolved by querying `where: { level, status: true }, orderBy: { order: 'asc' }`.

---

## 4. Publications & Reading Architecture

### 4.1 Publication Lifecycle
* **Draft (`draft`)**: Content created by editor, visible only in the Admin panel.
* **Published (`published`)**: Publicly accessible on the catalog, search index, and readers.

### 4.2 Featured Issue Architecture (Magazines)
* The most recently published magazine issue (`Magazine::where('status', 'published')->orderBy('publication_date', 'desc')->first()`) is prominently presented as the hero issue.
* The paginated grid queries all other published issues excluding the ID of the featured magazine.

### 4.3 Related Recommendations
* **Magazines Details View**: Recommends up to 4 other published magazines excluding the current issue.
* **Article Reader View**: Recommends up to 2 other published research articles excluding the current article.

---

## 5. News & Community Interaction Logic

### 5.1 IP-Based Like Mechanism
* Prevents spamming without forcing user registration.
* Checks if `ip_address` already exists for `news_id` in `news_likes` table.
* If found: deletes record (unlike) and decrements counter.
* If not found: creates record (like) and increments counter.
* Atomically returns new `likes_count`.

### 5.2 Comment Moderation Queue
* Guest comments are saved with `status = 0` (unapproved).
* Admin reviews comments in `/admin/news/comments` and clicks "Approve" (`POST .../approve` -> sets `status = 1`).
* Public news views execute `getApprovedComments()`:
  `$this->comments()->where('status', true)->latest()->get()`.

---

## 6. Notice Board & Archive Query Conversion

In Laravel `Notice.php`:
```php
public static function getArchives()
{
    return static::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, 
        DATE_FORMAT(created_at, "%M") as month_name, COUNT(*) as count')
        ->groupBy('year', 'month', 'month_name')
        ->orderByDesc('year')
        ->orderByDesc('month')
        ->get();
}
```

### PostgreSQL Equivalent for Next.js
In PostgreSQL, `YEAR()`, `MONTH()`, and `DATE_FORMAT()` are replaced with `EXTRACT` and `TO_CHAR`:
```sql
SELECT 
    EXTRACT(YEAR FROM created_at)::INTEGER as year,
    EXTRACT(MONTH FROM created_at)::INTEGER as month,
    TO_CHAR(created_at, 'FMMonth') as month_name,
    COUNT(*)::INTEGER as count
FROM notices
WHERE status = TRUE
GROUP BY year, month, month_name
ORDER BY year DESC, month DESC;
```

---

## 7. Administrative Dashboard KPI Metrics

The Admin Dashboard calculates 10 distinct metric cards:
1. **Sliders**: Total count, Active count.
2. **Members**: Total count, Active count.
3. **Management**: Total count, Active count, Breakdown by tier (`central`, `district`, `upazila`, `thana`, `branch`), and new members enrolled in current month (`whereMonth('created_at', now()->month)`).
4. **Donations**: Total count, Pending verification count, and Total approved donation amount in BDT (`where('status', 'approved')->sum('amount')`).
5. **Contacts**: Total messages, Unread inquiries (`where('status', false)`).
6. **News**: Total news count, Active published count.
7. **Notices**: Total circulars, Active count.
8. **Activities**: Total activities count, Active count.
9. **Gallery**: Total media items.
10. **Publications**: Breakdown for Books (total & active), Magazines (total & active), and Articles (total & active).
