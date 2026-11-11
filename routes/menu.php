<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\InstitutionController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\PublicationController;
use App\Http\Controllers\EducationBoardController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\CentralOfficeController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\ContactController;

// About Routes
Route::prefix('about')->group(function () {
    Route::get('/introduction', [AboutController::class, 'introduction'])->name('about.introduction');
    Route::get('/history', [AboutController::class, 'history'])->name('about.history');
    Route::get('/goals', [AboutController::class, 'goals'])->name('about.goals');
    Route::get('/activities', [AboutController::class, 'activities'])->name('about.activities');
});

// Institution Routes
Route::prefix('institutions')->group(function () {
    Route::get('/madrasas', [InstitutionController::class, 'madrasas'])->name('institutions.madrasas');
    Route::get('/mosques', [InstitutionController::class, 'mosques'])->name('institutions.mosques');
    Route::get('/orphanages', [InstitutionController::class, 'orphanages'])->name('institutions.orphanages');
    Route::get('/libraries', [InstitutionController::class, 'libraries'])->name('institutions.libraries');
});

// Gallery Routes
Route::prefix('gallery')->group(function () {
    Route::get('/', [GalleryController::class, 'index'])->name('gallery.index');
    Route::get('/photos', [GalleryController::class, 'photos'])->name('gallery.photos');
    Route::get('/videos', [GalleryController::class, 'videos'])->name('gallery.videos');
});

// Publication Routes
Route::prefix('publications')->group(function () {
    Route::get('/books', [PublicationController::class, 'books'])->name('publications.books');
    Route::get('/magazines', [PublicationController::class, 'magazines'])->name('publications.magazines');
    Route::get('/articles', [PublicationController::class, 'articles'])->name('publications.articles');
});

// Education Board Routes
Route::prefix('education-board')->group(function () {
    Route::get('/exam-schedule', [EducationBoardController::class, 'examSchedule'])->name('education-board.exam-schedule');
    Route::get('/results', [EducationBoardController::class, 'results'])->name('education-board.results');
    Route::get('/syllabus', [EducationBoardController::class, 'syllabus'])->name('education-board.syllabus');
});

// Event Routes
Route::prefix('events')->group(function () {
    Route::get('/', [EventController::class, 'index'])->name('events.index');
    Route::get('/{event}', [EventController::class, 'show'])->name('events.show');
    Route::get('/conferences', [EventController::class, 'conferences'])->name('events.conferences');
    Route::get('/seminars', [EventController::class, 'seminars'])->name('events.seminars');
    Route::get('/workshops', [EventController::class, 'workshops'])->name('events.workshops');
});

// Central Office Routes
Route::prefix('central-office')->group(function () {
    Route::get('/committee', [CentralOfficeController::class, 'committee'])->name('central-office.committee');
    Route::get('/departments', [CentralOfficeController::class, 'departments'])->name('central-office.departments');
    Route::get('/officials', [CentralOfficeController::class, 'officials'])->name('central-office.officials');
});

// Training Routes
Route::prefix('training')->group(function () {
    Route::get('/courses', [TrainingController::class, 'courses'])->name('training.courses');
    Route::get('/career', [TrainingController::class, 'career'])->name('training.career');
    Route::get('/volunteer', [TrainingController::class, 'volunteer'])->name('training.volunteer');
});

// Contact Route
// Route::get('/contact', [ContactController::class, 'index'])->name('contact');
