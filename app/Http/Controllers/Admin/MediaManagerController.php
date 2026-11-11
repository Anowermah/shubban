<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;

class MediaManagerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of all media files.
     */
    public function index(Request $request)
    {
        $disk = Storage::disk('public');
        $folderFilter = $request->get('folder', 'all');
        $typeFilter = $request->get('type', 'all');
        $search = trim($request->get('search', ''));

        // Known top-level media folders
        $availableFolders = [
            'sliders' => ['label' => 'স্লাইডার', 'icon' => 'fas fa-images'],
            'books' => ['label' => 'বই সম্ভার', 'icon' => 'fas fa-book'],
            'magazines' => ['label' => 'ম্যাগাজিন', 'icon' => 'fas fa-newspaper'],
            'articles' => ['label' => 'প্রবন্ধ ও আর্টিকেল', 'icon' => 'fas fa-feather-alt'],
            'photos' => ['label' => 'ফটো গ্যালারি', 'icon' => 'fas fa-camera'],
            'gallery' => ['label' => 'গ্যালারি অ্যালবাম', 'icon' => 'fas fa-image'],
            'gallery-archives' => ['label' => 'ঐতিহাসিক আর্কাইভ', 'icon' => 'fas fa-archive'],
            'activities' => ['label' => 'সাংগঠনিক কার্যক্রম', 'icon' => 'fas fa-calendar-check'],
            'news' => ['label' => 'সংবাদ ও বুলেটিন', 'icon' => 'fas fa-bullhorn'],
            'notices' => ['label' => 'নোটিশ ও সার্কুলার', 'icon' => 'fas fa-bell'],
            'management' => ['label' => 'দায়িত্বশীল ও পরিষদ', 'icon' => 'fas fa-users'],
            'committee' => ['label' => 'কমিটি', 'icon' => 'fas fa-sitemap'],
            'officials' => ['label' => 'কর্মকর্তাবৃন্দ', 'icon' => 'fas fa-user-tie'],
            'training' => ['label' => 'প্রশিক্ষণ', 'icon' => 'fas fa-graduation-cap'],
            'donations' => ['label' => 'অনুদানের রসিদ/স্লিপ', 'icon' => 'fas fa-hand-holding-usd'],
            'uploads' => ['label' => 'সাধারণ আপলোড', 'icon' => 'fas fa-cloud-upload-alt'],
        ];

        // Retrieve all files in public storage
        $allFilePaths = $disk->allFiles();
        
        $filesCollection = collect();
        $totalBytes = 0;
        $imageCount = 0;
        $pdfCount = 0;
        $otherCount = 0;
        $folderCounts = [];

        foreach ($allFilePaths as $path) {
            // Ignore system or hidden files
            if (Str::startsWith(basename($path), '.') || basename($path) === '.gitignore') {
                continue;
            }

            $size = $disk->size($path);
            $totalBytes += $size;
            $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));
            $isImage = in_array($ext, ['jpg', 'jpeg', 'png', 'webp', 'gif', 'svg']);
            $isPdf = ($ext === 'pdf');

            if ($isImage) {
                $imageCount++;
            } elseif ($isPdf) {
                $pdfCount++;
            } else {
                $otherCount++;
            }

            // Determine folder
            $segments = explode('/', str_replace('\\', '/', $path));
            $topFolder = count($segments) > 1 ? $segments[0] : 'uploads';

            if (!isset($folderCounts[$topFolder])) {
                $folderCounts[$topFolder] = 0;
            }
            $folderCounts[$topFolder]++;

            // Filter by folder if requested
            if ($folderFilter !== 'all' && $topFolder !== $folderFilter) {
                continue;
            }

            // Filter by type if requested
            if ($typeFilter === 'image' && !$isImage) {
                continue;
            }
            if ($typeFilter === 'pdf' && !$isPdf) {
                continue;
            }
            if ($typeFilter === 'other' && ($isImage || $isPdf)) {
                continue;
            }

            // Filter by search query if present
            $fileName = basename($path);
            if (!empty($search) && !str_contains(strtolower($fileName), strtolower($search))) {
                continue;
            }

            $lastModified = $disk->lastModified($path);

            $filesCollection->push([
                'path' => $path,
                'name' => $fileName,
                'url' => asset('storage/' . $path),
                'size' => $size,
                'size_formatted' => $this->formatBytes($size),
                'extension' => $ext,
                'is_image' => $isImage,
                'is_pdf' => $isPdf,
                'folder' => $topFolder,
                'last_modified' => $lastModified,
            ]);
        }

        // Sort latest first
        $sortedFiles = $filesCollection->sortByDesc('last_modified')->values();

        // Manual Pagination (24 items per page)
        $perPage = 24;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentPageItems = $sortedFiles->slice(($currentPage - 1) * $perPage, $perPage)->all();

        $paginatedFiles = new LengthAwarePaginator(
            $currentPageItems,
            $sortedFiles->count(),
            $perPage,
            $currentPage,
            ['path' => LengthAwarePaginator::resolveCurrentPath(), 'query' => $request->query()]
        );

        $stats = [
            'total_files' => count($allFilePaths),
            'total_size' => $this->formatBytes($totalBytes),
            'image_count' => $imageCount,
            'pdf_count' => $pdfCount,
            'other_count' => $otherCount,
        ];

        return view('admin.media.index', compact(
            'paginatedFiles',
            'availableFolders',
            'folderCounts',
            'folderFilter',
            'typeFilter',
            'search',
            'stats'
        ));
    }

    /**
     * Upload one or multiple files into a specific folder.
     */
    public function upload(Request $request)
    {
        $request->validate([
            'folder' => ['required', 'string', 'max:50'],
            'files' => ['required', 'array', 'min:1'],
            'files.*' => ['required', 'file', 'max:51200', 'mimes:jpg,jpeg,png,webp,gif,svg,pdf,doc,docx,xls,xlsx,zip,txt'],
        ], [
            'files.required' => 'কমপক্ষে একটি ফাইল নির্বাচন করুন।',
            'files.*.max' => 'প্রতিটি ফাইলের সাইজ সর্বোচ্চ ৫০ মেগাবাইট হতে পারবে।',
        ]);

        $folder = preg_replace('/[^a-zA-Z0-9_\-]/', '', $request->folder);
        if (empty($folder)) {
            $folder = 'uploads';
        }

        $uploadedCount = 0;
        foreach ($request->file('files') as $file) {
            $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $cleanName = Str::slug($originalName);
            if (empty($cleanName)) {
                $cleanName = 'media_' . time();
            }
            $extension = $file->getClientOriginalExtension();
            $fileName = $cleanName . '_' . time() . '_' . Str::random(4) . '.' . $extension;

            $file->storeAs($folder, $fileName, 'public');
            $uploadedCount++;
        }

        return redirect()->route('admin.media.index', ['folder' => $folder])
            ->with('success', "{$uploadedCount} টি ফাইল '{$folder}' ফোল্ডারে সফলভাবে আপলোড হয়েছে।");
    }

    /**
     * Delete a media file.
     */
    public function destroy(Request $request)
    {
        $request->validate([
            'path' => ['required', 'string'],
        ]);

        $path = $request->path;
        $disk = Storage::disk('public');

        // Prevent directory traversal attacks
        if (str_contains($path, '..') || !$disk->exists($path)) {
            return redirect()->back()->with('error', 'ফাইলটি খুঁজে পাওয়া যায়নি বা অনুপযুক্ত পাথ।');
        }

        $fileName = basename($path);
        $disk->delete($path);

        return redirect()->back()->with('success', "'{$fileName}' ফাইলটি সফলভাবে মুছে ফেলা হয়েছে।");
    }

    /**
     * Helper to format bytes into readable KB, MB, GB.
     */
    private function formatBytes($bytes, $precision = 1)
    {
        if ($bytes <= 0) return '0 B';
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);
        $bytes /= pow(1024, $pow);
        return round($bytes, $precision) . ' ' . $units[$pow];
    }
}
