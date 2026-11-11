# COMPLETE FEATURE LIST & FUNCTIONAL SPECIFICATION

This document details every feature, user capability, administrative tool, interaction pattern, and background workflow present across the application.

---

## 1. Public Portal (Frontend Website)

### 1.1 Global Layout & Navigation
* **Top Contact & Info Bar**:
  * Direct clickable email link (`mailto:`) and telephone link (`tel:`) reading dynamically from localization strings or settings.
  * Social media icon links (Facebook, Twitter, YouTube, Instagram) opening in new tabs.
  * Multi-language switcher supporting three locales:
    * Bengali (`bn`) - Default application locale.
    * English (`en`) - English translation dictionary.
    * Arabic (`ar`) - Arabic translation with automatic RTL (right-to-left) document direction and Arabic typography (`Noto Sans Arabic`).
* **Main Header & Search**:
  * Organization Logo linked to homepage.
  * Bilingual Organization Name: Bengali header and English sub-header.
  * Global Search Bar: Keyword search submitting to `/search?q=...`.
  * Quick Donate CTA button routing to `/donate`.
* **Responsive Mega-Navigation Bar**:
  * Dropdown navigation with hover-delay animation (200ms debounce, 300ms fade) and active path highlighting.
  * Nav items:
    1. **হোম (Home)**
    2. **আমাদের সম্পর্কে (About Us)**: ইতিহাস (History), পরিচিতি (Introduction), লক্ষ্য ও উদ্দেশ্য (Goals), গবেষণা কেন্দ্র (Research Center), শেকড় (Shekor), আশ-শিফা (As-Shifa), মাকতাবা (Maktabah).
    3. **গ্যালারি (Gallery)**: ফটো গ্যালারি (Photo Gallery), ভিডিও গ্যালারি (Video Gallery), আর্কাইভ (Archive).
    4. **প্রকাশনা (Publications)**: বই সমূহ (Books), ম্যাগাজিন সমূহ (Magazines), প্রবন্ধ সমূহ (Articles), লাইব্রেরি (Libraries).
    5. **দায়িত্বপ্রাপ্ত ব্যক্তিবর্গ (Responsible Persons)**: কেন্দ্রীয় (Central), জেলা (District), উপজেলা (Upazila), থানা (Thana), শাখা (Branch).
    6. **অনুষ্ঠান সমূহ (Events)**: আসন্ন অনুষ্ঠান (Upcoming Events), বিগত অনুষ্ঠান (Past Events), বার্ষিক অনুষ্ঠান (Annual Events).
    7. **কেন্দ্রীয় কার্যালয় (Central Office)**: কমিটি (Committee), বিভাগ সমূহ (Departments), কর্মকর্তাবৃন্দ (Officials).
    8. **প্রশিক্ষণ (Training)**: আত্মকর্ম (Self-Development), প্রশিক্ষণ কোর্স (Training Courses), আরেফ প্রশিক্ষণ (Aref), রাগেব প্রশিক্ষণ (Rageb), সালেক প্রশিক্ষণ (Salek), সালেহ প্রশিক্ষণ (Saleh).
    9. **যোগাযোগ (Contact Us)**
    10. **দান করুন (Donate)**
* **Global Footer**:
  * Quick links to About, Photos, Videos, and Contact.
  * Useful links to Education, Hadith, and Committee.
  * Organization physical address, contact telephone, and support email.
  * Social media links and Newsletter email subscription input form.
  * Dynamic copyright notice with current year.

---

### 1.2 Home Page (`/`)
* **Dynamic Hero Carousel / Slider**:
  * Displays active sliders (`status = true`) ordered by display order or recency.
  * Features slide title, subtitle, call-to-action button with custom destination URL, and full-width background imagery.
* **Top Notice Marquee / View Composer**:
  * Automatically fetches the top 5 most recent active notices (`Notice::where('status', 1)->latest()->take(5)`) injected into the layout header.
* **Latest News Section**:
  * 3 most recent active news items displaying thumbnail image, title, excerpt, publication date, and link to single news article.
* **Notice Board Highlights**:
  * 5 latest active notices displaying title, publish date, category badge, and direct download/view link.
* **Photo Highlights**:
  * Grid of 8 active gallery photos with lightbox / hover zoom preview.
* **Video Showcase**:
  * Grid of 4 active YouTube video entries with embedded modal player or thumbnail redirect.
* **Yearly Archive Showcase**:
  * 4 most recent photo collection archives featuring year badge, album title, and cover image.
* **Recent Activities**:
  * 6 most recent organizational activities displayed with date, thumbnail, and detailed modal or detail page link.

---

### 1.3 Publications Management & Reading Experience
* **Books Catalog (`/publications/books`)**:
  * Paginated list (12 per page) of published books (`status = 'published'`).
  * Real-time search by title, author, or description.
  * Cover image preview, author name, ISBN, publication date, and price (if applicable).
  * Direct action: "পড়ুন" (Read Online) or Download PDF.
* **Online Book Reader (`/publications/books/{book}/read`)**:
  * Renders Mozilla PDF.js viewer interface (`public/pdfjs/viewer.html?file=...`).
  * Validates file existence on disk before loading; displays Bengali flash error if PDF is missing.
  * Provides full-screen reading, zoom in/out, page jump, and text search within the document.
* **Magazines Catalog (`/publications/magazines`)**:
  * Displays the latest published issue as a prominent featured hero magazine.
  * Paginated grid of 12 past issues excluding the featured issue.
  * Information displayed: Issue number, publication date, description, price, and cover image.
* **Magazine Details & Related Issues (`/publications/magazines/{magazine}/details`)**:
  * Dedicated detail view showing full issue synopsis, metadata, and 4 related magazine recommendations.
* **Online Magazine Reader (`/publications/magazines/{magazine}/read`)**:
  * Embedded PDF.js reader for full-issue viewing.
* **Articles & Research Papers (`/publications/articles`)**:
  * Paginated list (12 per page) of research articles and essays.
  * Search by title and author; sorting by date or title.
* **Article Reader (`/publications/articles/{id}/read`)**:
  * Rich HTML article content rendered directly in reader layout.
  * Top metadata: author, publish date, estimated read time, cover image.
  * 2 related article suggestions at bottom of page.
  * PDF download button if article includes an uploaded PDF version.

---

### 1.4 News & Social Community Interactions
* **News Feed (`/news`)**: Paginated list of active news items with publication dates and featured thumbnails.
* **News Details (`/news/{news}`)**: Full news story with rich formatted text and associated media.
* **IP-based Like Toggle (`POST /news/{news}/like`)**:
  * Allows any visitor to like/unlike an article without requiring account creation.
  * Records the visitor's IP address (`$request->ip()`) in `news_likes` table.
  * Asynchronously returns JSON response: `{ action: 'liked' | 'unliked', likes_count: N }`.
* **Visitor Comments (`POST /news/{news}/comment`)**:
  * Comment submission form: Visitor Name, Visitor Email, and Comment text.
  * Comments are submitted with `status = 0` (unapproved) for administrative moderation.
  * Only approved comments (`status = 1`) are displayed publicly.

---

### 1.5 Notice Board (`/notice`)
* **Notice List**: All published notices with category filters, publish timestamps, and file download links.
* **Category Filter (`/notice/category/{category}`)**: Filter notices by type (e.g. General, Examination, Press, Emergency).
* **Archive Explorer (`/notice/archive/{year}/{month}`)**: Archive navigation filtering notices by month and year.

---

### 1.6 Organizational Hierarchy & Central Office
* **Central Committee (`/central/committee` & `/about/committee`)**:
  * Renders active central committee members (`committee_members` table) ordered by designated hierarchical order.
  * Displays member photo, designation, full name, contact phone, email, and address.
* **Departments (`/central/departments`)**:
  * Lists organizational divisions (e.g., Dawah, Education, Relief, IT).
  * Shows department head, staff count, office location, contact information, and bulleted responsibilities (stored as JSON array).
* **Officials (`/central/officials`)**:
  * Key administrative staff with profile photo, designation, educational background, professional experience, and key areas of expertise (stored as JSON array).
* **Multi-tier Responsible Persons (`/responsible/*`)**:
  * Central Leadership (`/responsible/central`): Pulls from `Committee` model.
  * District Leadership (`/responsible/district`): Pulls from `Management` model (`level = 'district'`).
  * Upazila Leadership (`/responsible/upazila`): Pulls from `Management` model (`level = 'upazila'`).
  * Thana Leadership (`/responsible/thana`): Pulls from `Management` model (`level = 'thana'`).
  * Branch Leadership (`/responsible/branch`): Pulls from `Management` model (`level = 'branch'`).

---

### 1.7 Training Center & Course Applications
* **Course Overview Pages**:
  * Self-Development (`/training/self-development`)
  * Course Catalog (`/training/courses`)
  * Specialized Training Levels:
    * আরেফ প্রশিক্ষণ (Aref Course) - `/training/aref`
    * রাগেব প্রশিক্ষণ (Rageb Course) - `/training/rageb`
    * সালেক প্রশিক্ষণ (Salek Course) - `/training/salek`
    * সালেহ প্রশিক্ষণ (Saleh Course) - `/training/saleh`
* **Public Course Registration Form (`/training/register/{type}`)**:
  * Course type pre-selected based on URL parameter (`aref`, `rageb`, `salek`, `saleh`).
  * Personal Information: Full Name, Father's Name, Mother's Name, Date of Birth (must be before today), Gender (male/female), Blood Group (A+, A-, B+, B-, AB+, AB-, O+, O-), National ID (10, 13, or 17 digits regex validation).
  * Contact Info: 11-digit Bangladeshi mobile number (`01[3-9]\d{8}`), Email, Emergency Contact number & relation.
  * Address Details: Present Address (Village, Post, Thana, District) and Permanent Address. "Same as Present Address" checkbox automatically mirrors address fields.
  * Educational Qualifications: Last degree, Institute, Passing Year (1900 to current+1), Result/GPA.
  * Professional Details: Father's Occupation, Organization Name, Designation, Joining Date, Organization Address.
  * Passport-size Applicant Photo upload (max 2MB, jpeg/png/jpg).
  * **Duplicate Registration Guard**: Prevents re-submission if applicant mobile number OR combination of (Name + Father Name + Mother Name) already exists for that course type.
* **Dynamic PDF Admit Card / Registration Slip Generation**:
  * Automatically compiles submitted data into an official A4 document with applicant photograph, registration ID, and organizational seal.
  * Bengali typography rendered using `Nikosh` / `SolaimanLipi` TrueType fonts.
  * Stored on disk at `uploads/pdfs/registration_{id}.pdf`.
  * Actions available to user: Immediate PDF download (`/training/download/{id}`) and in-browser print stream (`/training/print/{id}`).

---

### 1.8 Donations & Financial Contributions
* **Donation Portal (`/donate`)**:
  * Causes / Categories: Orphan Care (এতিমখানা), Student Scholarship (ছাত্র বৃত্তি), Ramadan Relief (রমজান তহবিল), Eid Gifts (ঈদ উপহার), Quran Distribution (কুরআন বিতরণ), General Donation (সাধারণ তহবিল).
  * Preset donation amounts (e.g. 500, 1000, 2000, 5000 BDT) or custom amount input.
  * Donor details: Full Name, Phone Number, Email, Optional Message.
* **bKash Tokenized Checkout Integration**:
  * Direct API checkout using bKash Tokenized Checkout v1.2.0 API.
  * Grant token -> Create Payment -> Redirect to bKash WebView -> Execute Payment -> Auto-update donation status.
* **Nagad Payment Gateway Integration**:
  * Custom 2048-bit RSA encrypted checkout.
  * Generates random challenge, encrypts order payload with Nagad public key, signs with merchant private key, processes callback verification.
* **Manual Mobile Banking & Bank Transfer**:
  * Displays official organization merchant / agent numbers for bKash, Nagad, Rocket, and Bank Account details.
  * User submits selected method and Transaction ID (TrxID).
  * Record saved with `status = 'pending'` for administrative verification.
* **Success & Failure Redirection**:
  * Dedicated confirmation screen (`/donate/success`) with thank you message and transaction summary.
  * Dedicated error screen (`/donate/failed`) with retry options.

---

### 1.9 Contact Form & Communication
* **Contact Us (`/contact`)**:
  * Submission form: Name, Phone Number, Email, Subject, Message.
  * Stores message in `contacts` table with `status = 0` (unread).
  * Success notification shown via flash session.

---

## 2. Administrative Control Panel (`/admin/*`)

### 2.1 Admin Authentication & Security
* Multi-guard isolated authentication (`auth:admin` guard querying `admins` table).
* Dedicated Admin Login screen at `/admin/login`.
* Session invalidation and regeneration upon login and logout.
* Admin Profile management: Edit full name and email address.
* Admin Password Change: Secure password update with current password validation.

### 2.2 Dashboard Analytics & Metric Widgets
* 10 Real-time KPI Metric Cards:
  * Sliders: Total slides & Active count.
  * Members: Total registered members & Active count.
  * Management: Total officers, active count, break-down by tier (Central, District, Upazila, Thana, Branch), and new members enrolled this month.
  * Donations: Total donations count, pending verification count, and total approved revenue sum in BDT.
  * Contact Inquiries: Total messages and unread inquiry count.
  * News: Total news articles and active published count.
  * Notices: Total notices and active count.
  * Activities: Total activities count and active count.
  * Gallery: Total gallery media items.
  * Publications: Total books, magazines, and research articles with active counts.
* Recent Activity Feed: List of 5 latest organization events/activities with quick action buttons.

### 2.3 Slider Management (`/admin/sliders`)
* Full CRUD (Create, Read, Update, Delete) for homepage banner sliders.
* Fields: Title, Subtitle, Image file (stored in `sliders/`), Button text, Button link, Status toggle, Display order.

### 2.4 Committee Management (`/admin/committee`)
* CRUD operations for Central Committee members (`committee_members` table).
* Fields: Name, Designation, Phone, Email, Address, Profile Image (`committee/`), Display order, Active toggle (`is_active`).

### 2.5 Multi-Level Management (`/admin/management/*`)
* Filtered management views by level:
  * Central (`/admin/management/central`)
  * District (`/admin/management/district`)
  * Upazila (`/admin/management/upazila`)
  * Thana (`/admin/management/thana`)
  * Branch (`/admin/management/branch`)
* Dedicated creation and editing interfaces.
* Automatic image aspect ratio fitting (300x300 square crop via image processing).
* Fields: Name, Designation, Level, Area, Phone, Email, Address, Profile image, Display order, Status.

### 2.6 Departments & Officials Management
* **Departments (`/admin/departments`)**: Department name, department head, designation, description, bulleted responsibilities (JSON array), contact phone, email, office location, staff count, order, active status.
* **Officials (`/admin/officials`)**: Officer name, designation, education credentials, work experience, expertise tags (JSON array), assigned responsibilities (JSON array), email, phone, office room, portrait image, active status, order.

### 2.7 Publications CMS
* **Books Management (`/admin/publications/books`)**:
  * Title, Author, Description, Publication Date, ISBN, Price, Cover Image upload (`books/covers`), PDF file upload (`books/pdfs`), Status (`draft` vs `published`).
* **Magazines Management (`/admin/publications/magazines`)**:
  * Title, Issue number, Publication Date, Synopsis, Price, Cover Image upload (`magazines/covers`), PDF file upload (`magazines/pdfs`), Status (`draft` vs `published`).
* **Articles & Essays Management (`/admin/publications/articles`)**:
  * Title, Author, Excerpt / Description, Full HTML Content via TinyMCE editor, Cover Image upload (`articles/covers`), PDF file upload (`articles/pdfs`), Publication Date, Category, Status.
  * Inline image upload endpoint (`/admin/publications/upload-image`) handling TinyMCE asset insertions.

### 2.8 News & Moderation
* **News CRUD (`/admin/news`)**: Headline, full story description, news photo upload (`news/`), published status toggle.
* **News Comments Moderation (`/admin/news/comments`)**:
  * Displays user-submitted comments linked to news articles.
  * Actions: "অনুমোদন করুন" (Approve) to make comment visible on public site; "মুছে ফেলুন" (Delete) to remove spam.

### 2.9 Notice Board Management (`/admin/notices`)
* CRUD for official circulars and notices.
* Fields: Title, Description, Category, Notice Image attachment, Official PDF/document attachment (`notices/files`), Status toggle.

### 2.10 Media & Gallery CMS
* **Gallery Images (`/admin/gallery`)**: Title, Description, Image upload (`gallery/`), Featured toggle (`is_featured`).
* **Gallery Archives (`/admin/gallery-archives`)**: Year-based photo collection albums with Title, Description, Year, Cover image, and active status.
* **Photos (`/admin/photos`)**: Upload photos linked to specific archive albums with multilingual title and description.
* **Videos (`/admin/videos`)**: Video Title, Description, YouTube URL, Thumbnail URL, Category, Date, Status.

### 2.11 Training Applicant Administration
* Separate administrative interfaces for each training category:
  * Aref Registrations (`/admin/training/aref`)
  * Rageb Registrations (`/admin/training/rageb`)
  * Salek Registrations (`/admin/training/salek`)
  * Saleh Registrations (`/admin/training/saleh`)
* Features:
  * Table of all applicants with search, filtering, and registration dates.
  * Modal quick view of applicant biodata via JSON endpoint.
  * Edit applicant information and replace applicant photo.
  * Individual Applicant PDF Card Download with SolaimanLipi font.
  * **Bulk Export / Master List PDF Download (`download-all`)**: Generates consolidated A4 roster PDF of all registered students for event attendance and administrative record-keeping.

### 2.12 Donation Verification (`/admin/donations`)
* List of all online and manual donations with pagination.
* Details view: Donor Name, Phone, Amount, Payment Gateway, Transaction ID, Category, Submission timestamp.
* Status update action: `pending` -> `approved` / `completed` or `rejected` / `failed`.

### 2.13 Inquiries & Members Management
* **Contacts Inbox (`/admin/contacts`)**: View visitor messages, mark as read, delete inquiries.
* **Members Directory (`/admin/members`)**: Member registry with contact info and active status.

### 2.14 Application Global Settings (`/admin/settings`)
* General settings: Organization site title, Site meta description, Contact email, Contact phone number, Physical address, Organization logo upload.
* Social media links: Facebook URL, Twitter URL, YouTube channel URL.

---

## 3. Mobile API Specification (`/api/*`)

Used by the cross-platform Flutter application located in `mobile_app/`:
1. `POST /api/login`: Mobile user login with email, password, and `device_name`. Returns Sanctum bearer token and user object.
2. `POST /api/register`: Mobile user registration with name, email, password confirmation, and `device_name`. Returns token and user object.
3. `POST /api/logout`: Revokes the mobile user's current access token.
4. `GET /api/user`: Returns authenticated user profile.
5. `POST /api/user/update`: Updates user profile information.
6. `GET /api/products`: Paginated list of products for mobile catalog.
7. `GET /api/products/{id}`: Detailed product view.
8. `GET /api/news`: Paginated news feed formatted for mobile consumption.
9. `GET /api/news/{id}`: News article detail.
10. `FCM Push Notifications`: Firebase Cloud Messaging token storage on users table and broadcast notification delivery.
