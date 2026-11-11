# FILE STORAGE, ASSET PROCESSING & MEDIA MIGRATION

This document provides a comprehensive inventory of all file storage locations, media upload rules, image processing algorithms, and asset delivery patterns, alongside the target Next.js storage and processing architecture.

---

## 1. Inventory of File Uploads & Media Assets

| Module | Asset Description | Storage Path in Laravel | Allowed Formats | Size Limit | Image Processing |
| :--- | :--- | :--- | :--- | :--- | :--- |
| **Books** | Cover Image | `storage/app/public/books/covers/` | JPEG, PNG, JPG | 2 MB | Standard upload |
| **Books** | Full Book PDF | `storage/app/public/books/pdfs/` | PDF | 10 MB | Direct stream |
| **Magazines** | Issue Cover | `storage/app/public/magazines/covers/` | JPEG, PNG, JPG | 2 MB | Standard upload |
| **Magazines** | Magazine PDF | `storage/app/public/magazines/pdfs/` | PDF | 10 MB | Direct stream |
| **Articles** | Header Cover | `storage/app/public/articles/covers/` | Image (JPG/PNG) | 2 MB | Standard upload |
| **Articles** | Research PDF | `storage/app/public/articles/pdfs/` | PDF | 10 MB | Direct stream |
| **Articles** | Inline Editor Image | `storage/app/public/articles/content-images/` | JPG, PNG, GIF | 2 MB | Uniqid naming |
| **Sliders** | Banner Image | `storage/app/public/sliders/` | JPG, PNG | 2 MB | Full-width slide |
| **Gallery** | Gallery Photo | `storage/app/public/gallery/` | JPEG, PNG, JPG, GIF | 2 MB | Lightbox display |
| **Archives** | Album Cover | `storage/app/public/archives/` | Image | 2 MB | Standard upload |
| **Photos** | Archive Photo | `storage/app/public/photos/` | Image | 2 MB | Grid display |
| **Notices** | Circular Document | `storage/app/public/notices/files/` | PDF, DOC, DOCX | 5 MB | Direct download |
| **Notices** | Circular Image | `storage/app/public/notices/images/` | JPG, PNG | 2 MB | Standard display |
| **Activities** | Event Photo | `storage/app/public/activities/` | Image | 2 MB | Standard display |
| **Committee** | Member Portrait | `storage/app/public/committee/` | JPEG, PNG, JPG | 2 MB | Standard display |
| **Management** | Officer Photo | `storage/app/public/management/` | JPEG, PNG, JPG | 2 MB | **300x300 Fit Crop** |
| **Officials** | Staff Portrait | `storage/app/public/officials/` | JPEG, PNG, JPG | 2 MB | Standard display |
| **Trainings** | Course Banner | `storage/app/public/trainings/` | JPEG, PNG, JPG | 2 MB | Standard display |
| **Registration** | Applicant Photo | `public/uploads/photos/` (Public)<br>`public/registrations/` (Admin) | JPEG, PNG, JPG | 2 MB | SolaimanLipi PDF Embed |
| **Registration** | Generated PDF Card | `storage/app/public/uploads/pdfs/` | PDF (Generated) | ~200 KB | Dynamic Dompdf render |
| **Settings** | Site Logo | `storage/app/public/settings/` | JPEG, PNG, JPG, GIF | 2 MB | Transparency preserved |

---

## 2. Storage System Inconsistencies & Legacy Paths

During the audit, significant path discrepancies were identified in Laravel's file handling:
1. **Public vs Symlinked Storage Divergence**:
   * Most modules use `Storage::disk('public')->store('directory', 'public')`, saving files to `storage/app/public/` accessible via `/storage/...`.
   * Public `TrainingController::storeRegistration` moves applicant photos directly to `public_path('uploads/photos')` bypassing Laravel's filesystem disk abstractions:
     ```php
     $photo->move(public_path('uploads/photos'), $filename);
     ```
   * Generated training PDFs are placed inside `Storage::disk('public')->put('uploads/pdfs/' . $pdfPath, ...)`.
   * In the admin controllers (`AdminArefTrainingController`), replacement photos are saved to `public/registrations` using `$photo->storeAs('public/registrations', $photoName)`.
   * `AdminRagebTrainingController` saves to `training/photos/`, while `AdminSalekTrainingController` saves to `training/salek/photos/`.
2. **Old Image Deletion Logic**:
   * Most controllers perform explicit disk deletion:
     ```php
     if ($model->image) {
         Storage::disk('public')->delete($model->image);
     }
     ```
   * However, `TrainingController` does not clean up temporary or superseded applicant photos.

---

## 3. Image Processing & Optimization Audit

### 3.1 Intervention Image in Laravel
* Used exclusively in `App\Http\Controllers\Admin\ManagementController`:
  ```php
  $img = Image::make($image->getRealPath());
  $img->fit(300, 300, function ($constraint) {
      $constraint->aspectRatio();
  });
  Storage::disk('public')->put('management/' . $filename, $img->stream());
  ```
* This operation resizes and crops officer photos to a consistent 1:1 aspect ratio (300x300 pixels).

### 3.2 Target Image Processing with `sharp` in Next.js
In Next.js, Node.js native library `sharp` will replace Intervention Image. `sharp` is 4x-5x faster and produces superior compression:

```typescript
import sharp from 'sharp';
import fs from 'fs/promises';
import path from 'path';

export async function processManagementImage(
  buffer: Buffer,
  filename: string
): Promise<string> {
  const uploadDir = path.join(process.cwd(), 'public/storage/management');
  await fs.mkdir(uploadDir, { recursive: true });

  const targetPath = path.join(uploadDir, filename);

  // Resize to 300x300 with smart crop (cover) and WebP conversion
  await sharp(buffer)
    .resize(300, 300, {
      fit: 'cover',
      position: 'center'
    })
    .webp({ quality: 85 })
    .toFile(targetPath.replace(/\.[^.]+$/, '.webp'));

  return `management/${filename.replace(/\.[^.]+$/, '.webp')}`;
}
```

---

## 4. Next.js 15+ Target File Storage Architecture

### 4.1 Deployment Options
* **Option A: Local Filesystem Storage (Direct Match)**:
  * Store all uploaded assets in `./public/storage/...`.
  * Fully preserves relative paths stored in the database (`books/covers/abc.jpg`, `sliders/xyz.png`).
  * Direct zero-latency serving by Next.js static asset server or Nginx reverse proxy.
* **Option B: Cloud Object Storage (S3 / Cloudflare R2 / MinIO)**:
  * Uses AWS S3 SDK (`@aws-sdk/client-s3`).
  * Recommended for multi-instance production environments.
  * Environment configuration: `S3_BUCKET`, `S3_REGION`, `S3_ACCESS_KEY`, `S3_SECRET_KEY`, `S3_ENDPOINT`.

### 4.2 Security & Validation Guardrails
* File extension verification & MIME-type validation via `file-type` magic bytes inspector.
* Sanitization of filenames using UUID / Nanoid to prevent directory traversal attacks (`../../`).
* Maximum file size limits:
  * Profile & Thumbnail Images: 2 MB
  * Publication Documents & PDFs: 25 MB
  * Video files are not uploaded directly; external YouTube embeds are enforced.

---

## 5. Asset Migration Script (Laravel to Next.js)

To migrate all existing physical files from Laravel to Next.js:

```bash
# Sync storage/app/public/ to Next.js public/storage/
rsync -av "d:/Web Design/ব্যকাপ ফাইল/Shubban-02/storage/app/public/" "d:/Web Design/ব্যকাপ ফাইল/shubban-nextjs/public/storage/"

# Sync public/uploads/ to Next.js public/storage/uploads/
rsync -av "d:/Web Design/ব্যকাপ ফাইল/Shubban-02/public/uploads/" "d:/Web Design/ব্যকাপ ফাইল/shubban-nextjs/public/storage/uploads/"

# Copy static public images (logos, banners, icons)
rsync -av "d:/Web Design/ব্যকাপ ফাইল/Shubban-02/public/images/" "d:/Web Design/ব্যকাপ ফাইল/shubban-nextjs/public/images/"
```
