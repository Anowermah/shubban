# COMPLETE ROUTE MAPPING SPECIFICATION

This document provides a 1-to-1 mapping of every route from the Laravel application (`routes/web.php`, `routes/menu.php`, and `routes/api.php`) to the corresponding Next.js 15+ App Router endpoints, pages, and Server Actions.

---

## 1. Public Portal Web Routes

| HTTP Method | Laravel URI | Laravel Route Name | Laravel Controller & Action | Next.js 15+ Target | Auth Guard | Notes / Purpose |
| :--- | :--- | :--- | :--- | :--- | :--- | :--- |
| `GET` | `/` | `home` | `HomeController@index` | `app/[locale]/page.tsx` | Public | Homepage with sliders, notices, news, media |
| `GET` | `/search` | `search` | `SearchController@index` | `app/[locale]/search/page.tsx` | Public | Search query results page |
| `GET` | `/language/{lang}` | `language.switch` | `LanguageController@switchLang` | Handled via Next.js i18n locale subpath (`/bn`, `/en`, `/ar`) | Public | Locale switcher (Bengali, English, Arabic) |
| `GET` | `/posts` | `posts.index` | `PostController@index` | `app/[locale]/posts/page.tsx` | Public | Post list |
| `GET` | `/posts/create` | `posts.create` | `PostController@create` | `app/[locale]/posts/create/page.tsx` | Public | Post creation form |
| `POST` | `/posts` | `posts.store` | `PostController@store` | `Server Action: createPost` | Public | Store new post |
| `GET` | `/posts/{post}` | `posts.show` | `PostController@show` | `app/[locale]/posts/[slug]/page.tsx` | Public | Single post view |

### 1.1 About Us & Facilities

| HTTP Method | Laravel URI | Laravel Route Name | Laravel Controller & Action | Next.js 15+ Target | Auth Guard | Notes / Purpose |
| :--- | :--- | :--- | :--- | :--- | :--- | :--- |
| `GET` | `/about` | `about.index` | `AboutController@index` | `app/[locale]/about/page.tsx` | Public | About Us overview |
| `GET` | `/about/history` | `about.history` | `AboutController@history` | `app/[locale]/about/history/page.tsx` | Public | Organization history |
| `GET` | `/about/introduction` | `about.introduction` | `AboutController@introduction` | `app/[locale]/about/introduction/page.tsx` | Public | Organization introduction |
| `GET` | `/about/mission` | `about.mission` | `AboutController@mission` | `app/[locale]/about/mission/page.tsx` | Public | Mission statement |
| `GET` | `/about/committee` | `about.committee` | `AboutController@committee` | `app/[locale]/about/committee/page.tsx` | Public | Central committee display |
| `GET` | `/about/goals` | `about.goals` | `AboutController@goals` | `app/[locale]/about/goals/page.tsx` | Public | Organization goals & objectives |
| `GET` | `/about/activities` | `about.activities` | `AboutController@activities` | `app/[locale]/about/activities/page.tsx` | Public | Overview of activities |
| `GET` | `/facilities/shekor` | `facilities.shekor` | `FacilitiesController@shekor` | `app/[locale]/facilities/shekor/page.tsx` | Public | Shekor facility page |
| `GET` | `/facilities/as-shifa` | `facilities.as-shifa` | `FacilitiesController@asShifa` | `app/[locale]/facilities/as-shifa/page.tsx` | Public | As-Shifa medical service page |
| `GET` | `/facilities/research-center` | `facilities.research-center` | `FacilitiesController@researchCenter` | `app/[locale]/facilities/research-center/page.tsx` | Public | Research Center facility page |
| `GET` | `/facilities/maktabah` | `facilities.maktabah` | `FacilitiesController@maktabah` | `app/[locale]/facilities/maktabah/page.tsx` | Public | Maktabah library facility page |

### 1.2 Institutions & Central Office

| HTTP Method | Laravel URI | Laravel Route Name | Laravel Controller & Action | Next.js 15+ Target | Auth Guard | Notes / Purpose |
| :--- | :--- | :--- | :--- | :--- | :--- | :--- |
| `GET` | `/institutions/madrasas` | `institutions.madrasas` | Closure (view) / `InstitutionController@madrasas` | `app/[locale]/institutions/madrasas/page.tsx` | Public | Madrasa institutions directory |
| `GET` | `/institutions/mosques` | `institutions.mosques` | Closure (view) / `InstitutionController@mosques` | `app/[locale]/institutions/mosques/page.tsx` | Public | Mosque institutions directory |
| `GET` | `/institutions/orphanages` | `institutions.orphanages` | Closure (view) / `InstitutionController@orphanages` | `app/[locale]/institutions/orphanages/page.tsx` | Public | Orphanage facilities directory |
| `GET` | `/institutions/libraries` | `institutions.libraries` | Closure (view) / `InstitutionController@libraries` | `app/[locale]/institutions/libraries/page.tsx` | Public | Library facilities directory |
| `GET` | `/central/committee` | `central.committee` | `CentralController@committee` | `app/[locale]/central/committee/page.tsx` | Public | Central Committee roster |
| `GET` | `/central/departments` | `central.departments` | `CentralController@departments` | `app/[locale]/central/departments/page.tsx` | Public | Department divisions |
| `GET` | `/central/officials` | `central.officials` | `CentralController@officials` | `app/[locale]/central/officials/page.tsx` | Public | Office staff and officials |

### 1.3 Multi-Tier Leadership / Responsible Persons

| HTTP Method | Laravel URI | Laravel Route Name | Laravel Controller & Action | Next.js 15+ Target | Auth Guard | Notes / Purpose |
| :--- | :--- | :--- | :--- | :--- | :--- | :--- |
| `GET` | `/responsible/central` | `responsible.central` | `ResponsibleController@central` | `app/[locale]/responsible/central/page.tsx` | Public | Central Leadership roster |
| `GET` | `/responsible/district` | `responsible.district` | `ResponsibleController@district` | `app/[locale]/responsible/district/page.tsx` | Public | District-level leadership |
| `GET` | `/responsible/upazila` | `responsible.upazila` | `ResponsibleController@upazila` | `app/[locale]/responsible/upazila/page.tsx` | Public | Upazila-level leadership |
| `GET` | `/responsible/thana` | `responsible.thana` | `ResponsibleController@thana` | `app/[locale]/responsible/thana/page.tsx` | Public | Thana-level leadership |
| `GET` | `/responsible/branch` | `responsible.branch` | `ResponsibleController@branch` | `app/[locale]/responsible/branch/page.tsx` | Public | Branch-level leadership |

### 1.4 Publications & Online Reader

| HTTP Method | Laravel URI | Laravel Route Name | Laravel Controller & Action | Next.js 15+ Target | Auth Guard | Notes / Purpose |
| :--- | :--- | :--- | :--- | :--- | :--- | :--- |
| `GET` | `/publications/books` | `publications.books` | `PublicationController@books` | `app/[locale]/publications/books/page.tsx` | Public | Books catalog with search & pagination |
| `GET` | `/publications/books/{book}/read` | `publications.books.read` | `PublicationController@readBook` | `app/[locale]/publications/books/[id]/read/page.tsx` | Public | PDF.js embedded reader for books |
| `GET` | `/publications/magazines` | `publications.magazines` | `PublicationController@magazines` | `app/[locale]/publications/magazines/page.tsx` | Public | Magazines catalog with featured issue |
| `GET` | `/publications/magazines/{magazine}/read` | `publications.magazines.read` | `PublicationController@readMagazine` | `app/[locale]/publications/magazines/[id]/read/page.tsx` | Public | PDF.js embedded reader for magazines |
| `GET` | `/publications/magazines/{magazine}/details` | `publications.magazines.details` | `PublicationController@magazineDetails` | `app/[locale]/publications/magazines/[id]/details/page.tsx` | Public | Single magazine details & related issues |
| `GET` | `/publications/articles` | `publications.articles` | `PublicationController@articles` | `app/[locale]/publications/articles/page.tsx` | Public | Research articles list |
| `GET` | `/publications/articles/{id}/read` | `publications.articles.read` | `PublicationController@readArticle` | `app/[locale]/publications/articles/[id]/read/page.tsx` | Public | Article detail & full text reading |

### 1.5 News, Notices, Activities & Media

| HTTP Method | Laravel URI | Laravel Route Name | Laravel Controller & Action | Next.js 15+ Target | Auth Guard | Notes / Purpose |
| :--- | :--- | :--- | :--- | :--- | :--- | :--- |
| `GET` | `/news` | `news.index` | `NewsController@index` | `app/[locale]/news/page.tsx` | Public | News feed |
| `GET` | `/news/{news}` | `news.show` | `NewsController@show` | `app/[locale]/news/[id]/page.tsx` | Public | News article details |
| `POST` | `/news/{news}/like` | `news.like` | `NewsLikeController@toggle` | `app/api/news/[id]/like/route.ts` | Public | IP-based like/unlike toggle |
| `POST` | `/news/{news}/comment` | `news.comment` | `NewsCommentController@store` | `Server Action: submitComment` | Public | Visitor comment submission |
| `GET` | `/notice` | `notice.index` | `NoticeController@index` | `app/[locale]/notice/page.tsx` | Public | Notice board |
| `GET` | `/notice/category/{category}` | `notice.category` | `NoticeController@category` | `app/[locale]/notice/category/[category]/page.tsx` | Public | Filter notices by category |
| `GET` | `/notice/archive/{year}/{month}` | `notice.archive` | `NoticeController@archive` | `app/[locale]/notice/archive/[year]/[month]/page.tsx` | Public | Monthly notice archive |
| `GET` | `/activities` | `activities.index` | `ActivityController@publicIndex` | `app/[locale]/activities/page.tsx` | Public | Public activities catalog |
| `GET` | `/activities/{activity}` | `activities.show` | `ActivityController@show` | `app/[locale]/activities/[id]/page.tsx` | Public | Single activity detail |
| `GET` | `/gallery` | `gallery.index` | `GalleryController@index` | `app/[locale]/gallery/page.tsx` | Public | Gallery main hub |
| `GET` | `/gallery/photos` | `gallery.photos` | `GalleryController@photos` | `app/[locale]/gallery/photos/page.tsx` | Public | Photo gallery |
| `GET` | `/gallery/videos` | `gallery.videos` | `GalleryController@videos` | `app/[locale]/gallery/videos/page.tsx` | Public | Video gallery (YouTube embeds) |
| `GET` | `/gallery/archives` | `gallery.archives` | `MediaController@archives` | `app/[locale]/gallery/archives/page.tsx` | Public | Photo archive albums by year |
| `GET` | `/gallery/archives/{archive}` | `gallery.archives.show` | `MediaController@showArchive` | `app/[locale]/gallery/archives/[id]/page.tsx` | Public | Photos inside specific archive |

### 1.6 Events & Education

| HTTP Method | Laravel URI | Laravel Route Name | Laravel Controller & Action | Next.js 15+ Target | Auth Guard | Notes / Purpose |
| :--- | :--- | :--- | :--- | :--- | :--- | :--- |
| `GET` | `/events/annual` | `events.annual` | `EventController@annual` | `app/[locale]/events/annual/page.tsx` | Public | Annual events |
| `GET` | `/events/upcoming` | `events.upcoming` | `EventController@upcoming` | `app/[locale]/events/upcoming/page.tsx` | Public | Upcoming events schedule |
| `GET` | `/events/past` | `events.past` | `EventController@past` | `app/[locale]/events/past/page.tsx` | Public | Past events record |
| `GET` | `/events/{event}` | `events.show` | `EventController@show` | `app/[locale]/events/[slug]/page.tsx` | Public | Single event detail (by slug) |
| `GET` | `/events/{event}/register` | `events.register` | `EventController@register` | `app/[locale]/events/[slug]/register/page.tsx` | Public | Event attendee registration |
| `GET` | `/education/quran` | `education.quran` | `Education\QuranController@index` | `app/[locale]/education/quran/page.tsx` | Public | Quran studies curriculum |
| `GET` | `/education/hadith` | `education.hadith` | `Education\HadithController@index` | `app/[locale]/education/hadith/page.tsx` | Public | Hadith studies curriculum |
| `GET` | `/education/islamic-studies`| `education.islamic-studies`| `Education\IslamicStudiesController@index`| `app/[locale]/education/islamic-studies/page.tsx`| Public | Islamic studies curriculum |
| `GET` | `/education/arabic` | `education.arabic` | `Education\ArabicController@index` | `app/[locale]/education/arabic/page.tsx` | Public | Arabic language curriculum |
| `GET` | `/education/exam-schedule` | `education.exam-schedule` | `EducationController@examSchedule` | `app/[locale]/education/exam-schedule/page.tsx` | Public | Board exam schedule |
| `GET` | `/education/syllabus` | `education.syllabus` | `EducationController@syllabus` | `app/[locale]/education/syllabus/page.tsx` | Public | Academic syllabus |
| `GET` | `/education/results` | `education.results` | `EducationController@results` | `app/[locale]/education/results/page.tsx` | Public | Board exam results |

### 1.7 Training Courses & Registration

| HTTP Method | Laravel URI | Laravel Route Name | Laravel Controller & Action | Next.js 15+ Target | Auth Guard | Notes / Purpose |
| :--- | :--- | :--- | :--- | :--- | :--- | :--- |
| `GET` | `/training/self-development` | `training.self-development` | `TrainingController@selfDevelopment` | `app/[locale]/training/self-development/page.tsx` | Public | Self-development courses |
| `GET` | `/training/courses` | `training.courses` | `TrainingController@courses` | `app/[locale]/training/courses/page.tsx` | Public | General courses list |
| `GET` | `/training/aref` | `training.aref` | `TrainingController@aref` | `app/[locale]/training/aref/page.tsx` | Public | Aref training level info |
| `GET` | `/training/rageb` | `training.rageb` | `TrainingController@rageb` | `app/[locale]/training/rageb/page.tsx` | Public | Rageb training level info |
| `GET` | `/training/salek` | `training.salek` | `TrainingController@salek` | `app/[locale]/training/salek/page.tsx` | Public | Salek training level info |
| `GET` | `/training/saleh` | `training.saleh` | `TrainingController@saleh` | `app/[locale]/training/saleh/page.tsx` | Public | Saleh training level info |
| `GET` | `/training/register/{type}` | `training.register` | `TrainingController@showRegistrationForm` | `app/[locale]/training/register/[type]/page.tsx` | Public | Application form |
| `POST` | `/training/register` | `training.register.store` | `TrainingController@storeRegistration` | `app/api/training/register/route.ts` | Public | Process applicant registration |
| `GET` | `/training/download/{id}` | `training.download` | `TrainingController@downloadPdf` | `app/api/training/download/[id]/route.ts` | Public | Download applicant PDF admit slip |
| `GET` | `/training/print/{id}` | `training.print` | `TrainingController@printPdf` | `app/api/training/print/[id]/route.ts` | Public | Stream PDF for direct printing |

### 1.8 Donations & Digital Payment Gateways

| HTTP Method | Laravel URI | Laravel Route Name | Laravel Controller & Action | Next.js 15+ Target | Auth Guard | Notes / Purpose |
| :--- | :--- | :--- | :--- | :--- | :--- | :--- |
| `GET` | `/donate` | `donate.index` | `DonateController@index` | `app/[locale]/donate/page.tsx` | Public | Main donation portal |
| `POST` | `/donate` | `donate.store` | `DonateController@store` | `Server Action: submitDonation` | Public | Process manual donation |
| `GET` | `/donate/success` | `donate.success` | View closure / `DonateController@success` | `app/[locale]/donate/success/page.tsx` | Public | Successful donation confirmation |
| `GET` | `/donate/failed` | `donate.failed` | View closure / `DonateController@failed` | `app/[locale]/donate/failed/page.tsx` | Public | Payment error / retry screen |
| `POST` | `/bkash/create` | `bkash.create` | `BkashPaymentController@createPayment` | `app/api/payment/bkash/create/route.ts` | Public | bKash tokenized payment grant & create |
| `POST` | `/bkash/execute` | `bkash.execute` | `BkashPaymentController@executePayment` | `app/api/payment/bkash/execute/route.ts` | Public | bKash tokenized payment execution |
| `POST` | `/nagad/create` | `nagad.create` | `NagadPaymentController@createPayment` | `app/api/payment/nagad/create/route.ts` | Public | Nagad RSA encrypted payment checkout |
| `GET` | `/nagad/callback` | `nagad.callback` | `NagadPaymentController@callback` | `app/api/payment/nagad/callback/route.ts` | Public | Nagad callback verification redirect |
| `GET` | `/contact` | `contact.index` | `ContactController@index` | `app/[locale]/contact/page.tsx` | Public | Contact Us form & map |
| `POST` | `/contact` | `contact.submit` | `ContactController@submit` | `Server Action: submitContact` | Public | Contact inquiry submission |

---

## 2. Administrative Control Panel Routes (`/admin/*`)

All routes below require administrative authentication (`auth:admin` guard in Laravel; Auth.js session with `role === 'ADMIN'` in Next.js).

| HTTP Method | Laravel URI | Laravel Route Name | Laravel Controller & Action | Next.js 15+ Target | Auth Guard | Notes / Purpose |
| :--- | :--- | :--- | :--- | :--- | :--- | :--- |
| `GET` | `/admin/login` | `admin.login` | `Admin\AuthController@showLoginForm` | `app/admin/login/page.tsx` | Guest | Admin login form |
| `POST` | `/admin/login` | `admin.login.submit` | `Admin\AuthController@login` | Auth.js credentials provider | Guest | Process admin login |
| `POST` | `/admin/logout` | `admin.logout` | `Admin\AuthController@logout` | Auth.js sign out | Admin | Admin logout action |
| `GET` | `/admin/dashboard` | `admin.dashboard` | `Admin\AdminController@dashboard` (redirect) | Redirects to dashboard index | Admin | Dashboard alias |
| `GET` | `/admin/dashboard/index` | `admin.dashboard.index` | `Admin\DashboardController@index` | `app/admin/(dashboard)/page.tsx` | Admin | Main Admin Dashboard with 10 KPI widgets |
| `GET` | `/admin/profile` | `admin.profile` | `Admin\ProfileController@edit` | `app/admin/profile/page.tsx` | Admin | Edit profile |
| `PUT` | `/admin/profile` | `admin.profile.update` | `Admin\ProfileController@update` | `Server Action: updateProfile` | Admin | Update name and email |
| `PUT` | `/admin/profile/password`| `admin.profile.password` | `Admin\ProfileController@password` | `Server Action: updatePassword` | Admin | Update password |
| `GET` | `/admin/settings` | `admin.settings` | `Admin\SettingsController@edit` | `app/admin/settings/page.tsx` | Admin | General settings |
| `PUT` | `/admin/settings` | `admin.settings.update` | `Admin\SettingsController@update` | `Server Action: updateSettings` | Admin | Update site title, contact, logo |
| `PUT` | `/admin/settings/social` | `admin.settings.social` | `Admin\SettingsController@social` | `Server Action: updateSocial` | Admin | Update social media links |

### 2.1 Admin CRUD Subsystems

| Subsystem | HTTP Methods & Laravel URIs | Laravel Controller | Next.js 15+ Target |
| :--- | :--- | :--- | :--- |
| **Sliders** | `GET /admin/sliders`, `POST /admin/sliders`, `GET /admin/sliders/create`, `GET /admin/sliders/{id}/edit`, `PUT /admin/sliders/{id}`, `DELETE /admin/sliders/{id}` | `Admin\SliderController` | `app/admin/sliders/page.tsx` & Actions |
| **Committee** | Full Resource: `admin/committee` (`index, create, store, edit, update, destroy`) | `Admin\CommitteeController` | `app/admin/committee/page.tsx` & Actions |
| **Management** | `GET /admin/management/{level}` (`central, district, upazila, thana, branch`), `GET /admin/management/create`, `POST /admin/management/store`, `GET /admin/management/{id}/edit`, `PUT /admin/management/{id}`, `DELETE /admin/management/{id}` | `Admin\ManagementController` | `app/admin/management/[level]/page.tsx` & Actions |
| **Departments** | Full Resource: `admin/departments` (`index, create, store, edit, update, destroy`) | `Admin\DepartmentController` | `app/admin/departments/page.tsx` & Actions |
| **Officials** | Full Resource: `admin/officials` (`index, create, store, edit, update, destroy`) | `Admin\OfficialController` | `app/admin/officials/page.tsx` & Actions |
| **Books** | `GET /admin/publications/books`, `GET /admin/publications/books/create`, `POST /admin/publications/books`, `GET /admin/publications/books/{id}`, `GET /admin/publications/books/{id}/edit`, `PUT /admin/publications/books/{id}`, `DELETE /admin/publications/books/{id}` | `Admin\PublicationController` | `app/admin/publications/books/page.tsx` & Actions |
| **Magazines** | `GET /admin/publications/magazines`, `GET /admin/publications/magazines/create`, `POST /admin/publications/magazines`, `GET /admin/publications/magazines/{id}`, `GET /admin/publications/magazines/{id}/edit`, `PUT /admin/publications/magazines/{id}`, `DELETE /admin/publications/magazines/{id}` | `Admin\PublicationController` | `app/admin/publications/magazines/page.tsx` & Actions |
| **Articles** | `GET /admin/publications/articles`, `GET /admin/publications/articles/create`, `POST /admin/publications/articles`, `GET /admin/publications/articles/{id}/edit`, `PUT /admin/publications/articles/{id}`, `DELETE /admin/publications/articles/{id}`, `POST /admin/publications/upload-image` | `Admin\PublicationController` | `app/admin/publications/articles/page.tsx`, `app/api/admin/upload-image/route.ts` |
| **News** | Full Resource: `admin/news` (`index, create, store, edit, update, destroy`) | `Admin\NewsController` | `app/admin/news/page.tsx` & Actions |
| **News Comments**| `GET /admin/news/comments`, `POST /admin/news/comments/{id}/approve`, `DELETE /admin/news/comments/{id}` | `Admin\NewsCommentController` | `app/admin/news/comments/page.tsx` & Actions |
| **Notices** | Full Resource: `admin/notices` (`index, create, store, edit, update, destroy`) | `Admin\NoticeController` | `app/admin/notices/page.tsx` & Actions |
| **Activities** | Full Resource: `admin/activities` (`index, create, store, edit, update, destroy`) | `Admin\ActivityController` | `app/admin/activities/page.tsx` & Actions |
| **Members** | Full Resource: `admin/members` (`index, create, store, edit, update, destroy`) | `Admin\MemberController` | `app/admin/members/page.tsx` & Actions |
| **Contacts** | `GET /admin/contacts`, `GET /admin/contacts/{id}`, `DELETE /admin/contacts/{id}` | `Admin\ContactController` | `app/admin/contacts/page.tsx` & Actions |
| **Donations** | `GET /admin/donations`, `GET /admin/donations/{id}`, `PATCH /admin/donations/{id}/status` | `Admin\AdminDonationController` | `app/admin/donations/page.tsx` & Actions |
| **Gallery** | Full Resource: `admin/gallery` (`index, create, store, edit, update, destroy`) | `Admin\GalleryController` | `app/admin/gallery/page.tsx` & Actions |
| **Archives** | Full Resource: `admin/gallery-archives` (`index, create, store, edit, update, destroy`) | `Admin\GalleryArchiveController` | `app/admin/gallery-archives/page.tsx` & Actions |
| **Photos** | Full Resource: `admin/photos` (`index, create, store, edit, update, destroy`) | `Admin\PhotoController` | `app/admin/photos/page.tsx` & Actions |
| **Videos** | Full Resource: `admin/videos` (`index, create, store, edit, update, destroy`) | `Admin\VideoController` | `app/admin/videos/page.tsx` & Actions |
| **Training (Aref)**| `GET /admin/training/aref`, `GET /admin/training/aref/create`, `POST /admin/training/aref`, `GET /admin/training/aref/download-all`, `GET /admin/training/aref/{id}`, `GET /admin/training/aref/{id}/download`, `GET /admin/training/aref/{id}/edit`, `PUT /admin/training/aref/{id}`, `DELETE /admin/training/aref/{id}` | `Admin\AdminArefTrainingController` | `app/admin/training/aref/page.tsx` & Actions |
| **Training (Rageb)**| Same 9 routes under prefix `/admin/training/rageb` | `Admin\AdminRagebTrainingController` | `app/admin/training/rageb/page.tsx` & Actions |
| **Training (Salek)**| Same 9 routes under prefix `/admin/training/salek` | `Admin\AdminSalekTrainingController` | `app/admin/training/salek/page.tsx` & Actions |
| **Training (Saleh)**| Same 9 routes under prefix `/admin/training/saleh` | `Admin\AdminSalehTrainingController` | `app/admin/training/saleh/page.tsx` & Actions |

---

## 3. Mobile REST API Routes (`routes/api.php`)

| HTTP Method | Laravel URI | Laravel Controller & Action | Next.js 15+ Target | Auth Guard | Notes / Purpose |
| :--- | :--- | :--- | :--- | :--- | :--- |
| `POST` | `/api/login` | `API\AuthController@login` | `app/api/v1/auth/login/route.ts` | Public | Mobile user login -> Returns Bearer Token |
| `POST` | `/api/register` | `API\AuthController@register` | `app/api/v1/auth/register/route.ts` | Public | Mobile user register -> Returns Bearer Token |
| `GET` | `/api/user` | `API\AuthController@user` | `app/api/v1/auth/user/route.ts` | Sanctum / JWT Bearer | Get authenticated user info |
| `POST` | `/api/user/update` | `API\AuthController@update` | `app/api/v1/auth/user/update/route.ts` | Sanctum / JWT Bearer | Update user profile |
| `POST` | `/api/logout` | `API\AuthController@logout` | `app/api/v1/auth/logout/route.ts` | Sanctum / JWT Bearer | Invalidate access token |
| `GET` | `/api/products` | `API\ProductController@index` | `app/api/v1/products/route.ts` | Sanctum / JWT Bearer | Paginated products list |
| `GET` | `/api/products/{id}`| `API\ProductController@show` | `app/api/v1/products/[id]/route.ts` | Sanctum / JWT Bearer | Single product details |
| `GET` | `/api/news` | `API\NewsController@index` | `app/api/v1/news/route.ts` | Sanctum / JWT Bearer | Paginated news list |
| `GET` | `/api/news/{id}` | `API\NewsController@show` | `app/api/v1/news/[id]/route.ts` | Sanctum / JWT Bearer | Single news details |
| `POST` | `/api/admin/login` | `Admin\AuthController@login` | `app/api/v1/admin/login/route.ts` | Public | Admin API token login |
| `POST` | `/api/admin/logout`| `Admin\AuthController@logout` | `app/api/v1/admin/logout/route.ts` | Sanctum / JWT Bearer | Admin API token logout |

---

## 4. Discovered Route Inconsistencies & Resolutions

1. **Duplicate Route Declarations**:
   * `routes/web.php` and `routes/menu.php` both define `/institutions/madrasas`, `/institutions/mosques`, etc. In Next.js, these collapse into a single unambiguous App Router route at `app/[locale]/institutions/.../page.tsx`.
2. **Donation Status Route Collision in `web.php`**:
   * In `web.php`, `Route::resource('donations', ...)` is declared first with `donations/{donation}/status` (PUT). Later, lines 403-407 define `Route::prefix('donations')` with `PATCH /{donation}/status`.
   * Next.js resolution: A unified Server Action / Route Handler `updateDonationStatus` accepting status string (`pending`, `completed`/`approved`, `failed`/`rejected`).
3. **Training Admin Edit vs Update Registration**:
   * `AdminArefTrainingController` has two update methods: `update` and `updateRegistration`. Next.js consolidates this into a single atomic Server Action.
