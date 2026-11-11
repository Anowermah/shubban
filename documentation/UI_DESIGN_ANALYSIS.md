# UI DESIGN, FRONTEND ASSETS & INTERACTION ANALYSIS

This document provides a thorough audit of the visual design system, layouts, 199 Blade templates, CSS stylesheets, JavaScript interactions, and bi-directional localization patterns, alongside the component architecture for Next.js 15+ and Tailwind CSS.

---

## 1. Design System & Visual Identity

### 1.1 Color Palette & Semantic Tokens
* **Primary Brand Green**: `#198754` (Bootstrap Success / Emerald Green) - Represents Islamic identity, headers, main navigation, CTA buttons.
* **Secondary Action Blue**: `#0d6efd` (Bootstrap Primary) - Buttons, links, hover states.
* **Dark Contrast Navy / Charcoal**: `#343a40` & `#212529` - Admin sidebar, top bar, typography, and footer background.
* **Light Neutral Backgrounds**: `#f8f9fa` (Admin main body, card canvas), `#ffffff` (Card background).
* **Accent & State Colors**:
  * Success / Active: `#28a745` / `#198754`
  * Warning / Pending: `#ffc107`
  * Danger / Rejected: `#dc3545`
  * Borders & Dividers: `#dee2e6` / `#e9ecef`

### 1.2 Typography System
* **Bengali Primary (`Noto Sans Bengali` / `SolaimanLipi`)**:
  * Used throughout all public content, headlines, card bodies, and administrative tables.
  * Google Fonts embed: `https://fonts.googleapis.com/css2?family=Noto+Sans+Bengali:wght@400;500;600;700&display=swap`.
* **Arabic Typography (`Noto Sans Arabic`)**:
  * Loaded dynamically when `app()->getLocale() === 'ar'`.
  * Google Fonts embed: `https://fonts.googleapis.com/css2?family=Noto+Sans+Arabic:wght@400;500;600;700&display=swap`.
* **PDF Document Rendering Typography**:
  * `Nikosh` and `SolaimanLipi` TrueType fonts stored in `public/fonts/` for complex Bengali script ligature rendering.

### 1.3 Bi-Directional Layouts (LTR & RTL)
* The root `<html>` tag dynamically injects `dir="ltr"` or `dir="rtl"` based on session locale.
* When `locale === 'ar'`:
  * Embeds `bootstrap.rtl.min.css`.
  * Flips navigation bar float order, aligns text to right, reverses carousel indicators, and mirrors chevron arrows.
* In Next.js, this will be handled via Tailwind's native `rtl:` and `ltr:` variant modifiers and dynamic `<html dir={locale === 'ar' ? 'rtl' : 'ltr'} lang={locale}>`.

---

## 2. Layout Structure & Template Hierarchy

The Laravel application features 199 Blade views organized into distinct layout trees:

```
resources/views/
├── layouts/
│   ├── app.blade.php                 # Public portal master wrapper
│   ├── admin.blade.php               # Administrative dashboard master wrapper
│   └── partials/
│       ├── header.blade.php          # Top bar, bilingual logo, search, mega-menu
│       └── footer.blade.php          # Contact details, quick links, newsletter
├── admin/                            # 95+ Admin CRUD and dashboard templates
│   ├── dashboard/                    # KPI metrics index view
│   ├── publications/                 # Books, magazines, articles CMS
│   ├── training/                     # Aref, Rageb, Salek, Saleh applicant management
│   ├── management/                   # Central, District, Upazila, Thana, Branch CRUD
│   ├── committee/                    # Committee members list and forms
│   ├── donations/                    # Financial ledger and status updater
│   ├── gallery/ & gallery-archive/   # Media asset managers
│   └── settings/                     # Global branding and social CMS
├── publications/                     # Public book, magazine, article catalogs & readers
├── training/                         # Public courses, admission form, PDF views
├── responsible/                      # District, Upazila, Thana, Branch leader listings
├── gallery/ & media/                 # Public photo, video, and archive galleries
├── institutions/                     # Madrasas, mosques, orphanages, libraries
├── events/                           # Upcoming, past, and annual gatherings
├── notice/ & news/                   # Notices and blog posts
├── donate/                           # Donation gateway forms & success/failed states
├── contact/                          # Public contact form & map
└── welcome.blade.php                 # Homepage landing view
```

---

## 3. Frontend JavaScript Interactions & AJAX Workflows

### 3.1 Header Navigation & Dropdowns (`public/js/header.js` & inline)
* **Hover Dropdowns**:
  ```javascript
  $('.dropdown').hover(function() {
      $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn(300);
  }, function() {
      $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut(300);
  });
  ```
* **Active Route Marking**: Compares `window.location.pathname` with navigation link `href` attributes and applies `.active` class to parent menu items.

### 3.2 News IP-Based Like Button (`NewsLikeController`)
* Clicking the like button triggers an asynchronous `POST` to `/news/{news}/like` with CSRF header.
* Response: `{ action: 'liked' | 'unliked', likes_count: N }`.
* Client toggles heart icon color (regular vs solid red) and updates the numeric count without page reloading.

### 3.3 Training Registration Form Interaction (`TrainingController`)
* **Address Mirroring**: Checking the "Same as Present Address" (`same_as_present`) checkbox automatically copies values from present village, post, thana, and district into permanent address inputs and disables permanent address fields.
* **Asynchronous Submission**: The registration form is submitted via AJAX `fetch()` / `$.ajax()`.
* **Dynamic Validation Errors**: If validation fails (HTTP 422), JSON errors are mapped to specific form input containers with Bengali validation messages.
* **Success Modal & Auto-Download**: On success (HTTP 200), displays a modal dialog with registration confirmation ID and triggers automatic download of the generated PDF slip.

### 3.4 Online Donation Form Mode Switcher (`public/js/donate.js`)
* Switching between payment methods:
  * "Online Payment" (bKash / Nagad) displays amount presets and triggers gateway checkout.
  * "Manual Payment" toggles visibility of the manual transaction input fields (Mobile Banking Number, Bank Account Number, Transaction ID).

### 3.5 Publication Online Reader (PDF.js Integration)
* Integrated Mozilla PDF.js web viewer (`public/pdfjs/viewer.html`).
* Reads the PDF stream from `storage/books/pdfs/...` or `storage/magazines/pdfs/...`.
* Features full toolbar: zoom, thumbnail navigation, continuous scrolling, search in document, and download.

---

## 4. Next.js 15+ & Tailwind CSS Component Architecture

In the Next.js application, Bootstrap 5 and jQuery will be replaced with React 19 Client & Server Components, Tailwind CSS v4, Lucide React icons, and Radix UI / shadcn/ui primitives.

### 4.1 Component Mapping Matrix

| Laravel / Bootstrap 5 Component | Next.js 15+ Target Component | Implementation Strategy |
| :--- | :--- | :--- |
| `layouts/app.blade.php` | `app/[locale]/layout.tsx` | Root server layout with locale & RTL direction provider |
| `layouts/admin.blade.php` | `app/admin/layout.tsx` | Dedicated admin shell with collapsible sidebar & header |
| `header.blade.php` | `components/layout/Header.tsx` | Responsive navbar with shadcn/ui NavigationMenu |
| `footer.blade.php` | `components/layout/Footer.tsx` | Static server component with newsletter client form |
| Hero Carousel (`sliders`) | `components/home/HeroSlider.tsx` | Embla Carousel / Swiper with auto-play & touch swipe |
| Photo Lightbox | `components/gallery/PhotoLightbox.tsx` | Yet Another React Lightbox (YARL) |
| Video Embed Modal | `components/gallery/VideoModal.tsx` | React Dialog / Modal with YouTube iframe |
| PDF Viewer | `components/publications/PdfViewer.tsx` | `@react-pdf-viewer/core` or custom PDF.js wrapper |
| Training Form | `components/training/RegistrationForm.tsx` | React Hook Form + Zod validation with Bengali errors |
| Donation Form | `components/donation/DonationForm.tsx` | Multi-step interactive client form with bKash/Nagad |
| Admin Data Tables | `components/admin/DataTable.tsx` | TanStack Table v8 with pagination, sort & search |
| Admin Modals | `components/ui/dialog.tsx` | Radix UI accessible Dialog primitive |
| WYSIWYG Editor | `components/admin/RichTextEditor.tsx` | TipTap Editor with image upload plugin |

### 4.2 Tailwind Theme & Utility Tokens (`tailwind.config.ts`)

```typescript
export default {
  darkMode: ["class"],
  content: ["./app/**/*.{ts,tsx}", "./components/**/*.{ts,tsx}"],
  theme: {
    extend: {
      colors: {
        brand: {
          50: "#e8f5e9",
          100: "#c8e6c9",
          500: "#198754", // Official Shubban Green
          600: "#157347",
          700: "#0f5132",
        },
        primary: {
          DEFAULT: "#198754",
          foreground: "#ffffff",
        },
        sidebar: {
          DEFAULT: "#343a40",
          foreground: "#ffffff",
          muted: "rgba(255,255,255,0.75)",
        }
      },
      fontFamily: {
        bengali: ["var(--font-noto-bengali)", "sans-serif"],
        arabic: ["var(--font-noto-arabic)", "sans-serif"],
      }
    }
  }
}
```
