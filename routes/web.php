<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminArefTrainingController;
use App\Http\Controllers\Admin\AdminRagebTrainingController;
use App\Http\Controllers\Admin\AdminSalekTrainingController;
use App\Http\Controllers\Admin\AdminSalehTrainingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\NoticeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DonateController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\CentralController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ResponsibleController;
use App\Http\Controllers\FacilitiesController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\NewsLikeController;
use App\Http\Controllers\NewsCommentController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\NewsCommentController as AdminNewsCommentController;
use App\Http\Controllers\Admin\PublicationController as AdminPublicationController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\VideoController as AdminVideoController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\OfficialController;
use App\Http\Controllers\Admin\ManagementController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\PublicationController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\BkashPaymentController;
use App\Http\Controllers\NagadPaymentController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\UserProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/sitemap.xml', [App\Http\Controllers\SitemapController::class, 'index'])->name('sitemap');

// ==========================================
// User Authentication & Guest Access Routes
// ==========================================
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});

// Guest Access Route
Route::get('/guest', function (\Illuminate\Http\Request $request) {
    session(['guest_mode' => true]);
    return redirect($request->query('redirect', '/'))->with('guest_info', 'স্বাগতম! আপনি গেস্ট হিসেবে ওয়েবসাইট ব্রাউজ করছেন।');
})->name('guest');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// User Dashboard & Organizational Portal Routes (Authenticated Users)
Route::middleware('auth')->prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', [UserProfileController::class, 'index'])->name('dashboard');
    Route::get('/profile', [UserProfileController::class, 'index'])->name('profile');
    Route::post('/profile/update', [UserProfileController::class, 'updateProfile'])->name('profile.update');
    Route::post('/profile/password', [UserProfileController::class, 'updatePassword'])->name('password.update');
    
    // Monthly Iyanat Routes
    Route::post('/iyanat', [UserProfileController::class, 'storeIyanat'])->name('iyanat.store');
    Route::get('/iyanat/{iyanat}/receipt', [UserProfileController::class, 'printIyanatReceipt'])->name('iyanat.receipt');

    // Program Report Submission
    Route::post('/report', [UserProfileController::class, 'storeProgramReport'])->name('report.store');

    // Tier Promotion Application
    Route::post('/promotion', [UserProfileController::class, 'applyTierPromotion'])->name('promotion.apply');

    // Syllabus Checklist Progress Toggle
    Route::post('/syllabus/toggle', [UserProfileController::class, 'toggleSyllabusItem'])->name('syllabus.toggle');
});
Route::get('/dashboard', fn() => redirect()->route('user.dashboard'));
Route::get('/home', fn() => redirect()->route('home'));

// Donation Routes
Route::prefix('donate')->name('donate.')->group(function () {
    Route::get('/', [DonateController::class, 'index'])->name('index');
    Route::post('/', [DonateController::class, 'store'])->name('store');
    Route::get('/receipt/{receipt_no}', [DonateController::class, 'receipt'])->name('receipt');
    Route::get('/success', [DonateController::class, 'success'])->name('success');
    Route::get('/failed', [DonateController::class, 'failed'])->name('failed');
});

// bKash Payment Routes
Route::post('bkash/create', [BkashPaymentController::class, 'createPayment'])->name('bkash.create');
Route::post('bkash/execute', [BkashPaymentController::class, 'executePayment'])->name('bkash.execute');

// Nagad Payment Routes
Route::prefix('nagad')->name('nagad.')->group(function () {
    Route::post('/create', [NagadPaymentController::class, 'createPayment'])->name('create');
    Route::get('/callback', [NagadPaymentController::class, 'callback'])->name('callback');
});

// About Routes
Route::prefix('about')->group(function () {
    Route::get('/', [AboutController::class, 'index'])->name('about.index');
    Route::get('/history', [AboutController::class, 'history'])->name('about.history');
    Route::get('/introduction', [AboutController::class, 'introduction'])->name('about.introduction');
    Route::get('/mission', [AboutController::class, 'mission'])->name('about.mission');
    Route::get('/committee', [AboutController::class, 'committee'])->name('about.committee');
    Route::get('/goals', [AboutController::class, 'goals'])->name('about.goals');
    Route::get('/activities', [AboutController::class, 'activities'])->name('about.activities');
});

// Notice Routes
Route::prefix('notice')->group(function () {
    Route::get('/', [NoticeController::class, 'index'])->name('notice.index');
    Route::get('/category/{category}', [NoticeController::class, 'category'])->name('notice.category');
    Route::get('/archive/{year}/{month}', [NoticeController::class, 'archive'])->name('notice.archive');
});

// Education Routes
Route::prefix('education')->group(function () {
    Route::get('/quran', [EducationController::class, 'quran'])->name('education.quran');
    Route::get('/hadith', [EducationController::class, 'hadith'])->name('education.hadith');
    Route::get('/fiqh', [EducationController::class, 'fiqh'])->name('education.fiqh');
    Route::get('/arabic', [EducationController::class, 'arabic'])->name('education.arabic');
    Route::get('/exam-schedule', [EducationController::class, 'examSchedule'])->name('education.exam-schedule');
    Route::get('/syllabus', [EducationController::class, 'syllabus'])->name('education.syllabus');
    Route::get('/results', [EducationController::class, 'results'])->name('education.results');
});

// Educational Activities Routes
Route::prefix('education')->group(function () {
    Route::get('/quran', [App\Http\Controllers\Education\QuranController::class, 'index'])->name('education.quran');
    Route::get('/hadith', [App\Http\Controllers\Education\HadithController::class, 'index'])->name('education.hadith');
    Route::get('/islamic-studies', [App\Http\Controllers\Education\IslamicStudiesController::class, 'index'])->name('education.islamic-studies');
    Route::get('/arabic', [App\Http\Controllers\Education\ArabicController::class, 'index'])->name('education.arabic');
});

// Services Routes
Route::prefix('services')->group(function () {
    Route::get('/social', [ServicesController::class, 'social'])->name('services.social');
    Route::get('/charity', [ServicesController::class, 'charity'])->name('services.charity');
    Route::get('/medical', [ServicesController::class, 'medical'])->name('services.medical');
    Route::get('/education', [ServicesController::class, 'education'])->name('services.education');
});

// Media Routes
Route::prefix('media')->name('media.')->group(function () {
    Route::get('/publications', [MediaController::class, 'publications'])->name('publications');
    Route::get('/press', [MediaController::class, 'press'])->name('press');
    Route::get('/news', [MediaController::class, 'news'])->name('news');
});

// Gallery Routes
Route::name('gallery.')->prefix('gallery')->group(function () {
    Route::get('/', [App\Http\Controllers\GalleryController::class, 'index'])->name('index');
    Route::get('/photos', [App\Http\Controllers\GalleryController::class, 'photos'])->name('photos');
    Route::get('/videos', [App\Http\Controllers\GalleryController::class, 'videos'])->name('videos');
    Route::get('/archives', [App\Http\Controllers\MediaController::class, 'archives'])->name('archives');
    Route::get('/archives/{archive}', [App\Http\Controllers\MediaController::class, 'showArchive'])->name('archives.show');
});

// Central Committee Routes
Route::prefix('central')->group(function () {
    Route::get('/committee', [CentralController::class, 'committee'])->name('central.committee');
    Route::get('/departments', [CentralController::class, 'departments'])->name('central.departments');
    Route::get('/officials', [CentralController::class, 'officials'])->name('central.officials');
    Route::get('/committee', [CentralController::class, 'committee'])->name('central.committee');
});

// Posts Routes
Route::prefix('posts')->group(function () {
    Route::get('/', [PostController::class, 'index'])->name('posts.index');
    Route::get('/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/', [PostController::class, 'store'])->name('posts.store');
    Route::get('/{post}', [PostController::class, 'show'])->name('posts.show');
});

// Contact Routes
Route::prefix('contact')->group(function () {
    Route::get('/', [ContactController::class, 'index'])->name('contact.index');
    Route::post('/', [ContactController::class, 'submit'])->name('contact.submit');
});

// AI Assistant & Chat API Routes
Route::prefix('ai-chat')->name('ai-chat.')->group(function () {
    Route::get('/init', [App\Http\Controllers\AIChatController::class, 'init'])->name('init');
    Route::post('/send', [App\Http\Controllers\AIChatController::class, 'send'])->name('send');
    Route::post('/feedback', [App\Http\Controllers\AIChatController::class, 'feedback'])->name('feedback');
});



// Search Routes
Route::get('/search', [SearchController::class, 'index'])->name('search');
Route::get('/search/live', [SearchController::class, 'live'])->name('search.live');

// Language Routes
Route::get('/language/{lang}', [LanguageController::class, 'switchLang'])->name('language.switch');

// Institution Routes
Route::prefix('institutions')->name('institutions.')->group(function () {
    Route::get('/madrasas', function () {
        return view('institutions.madrasas');
    })->name('madrasas');

    Route::get('/mosques', function () {
        return view('institutions.mosques');
    })->name('mosques');

    Route::get('/orphanages', function () {
        return view('institutions.orphanages');
    })->name('orphanages');

    Route::get('/libraries', function () {
        return view('institutions.libraries');
    })->name('libraries');
});

// Facilities Routes
Route::prefix('facilities')->group(function () {
    Route::get('/shekor', [FacilitiesController::class, 'shekor'])->name('facilities.shekor');
    Route::get('/as-shifa', [FacilitiesController::class, 'asShifa'])->name('facilities.as-shifa');
    Route::get('/research-center', [FacilitiesController::class, 'researchCenter'])->name('facilities.research-center');
    Route::get('/maktabah', [FacilitiesController::class, 'maktabah'])->name('facilities.maktabah');
});

// Responsible Persons Routes
Route::prefix('responsible')->name('responsible.')->group(function () {
    Route::get('/central', [ResponsibleController::class, 'central'])->name('central');
    Route::get('/district', [ResponsibleController::class, 'district'])->name('district');
    Route::get('/upazila', [ResponsibleController::class, 'upazila'])->name('upazila');
    Route::get('/thana', [ResponsibleController::class, 'thana'])->name('thana');
    Route::get('/branch', [ResponsibleController::class, 'branch'])->name('branch');
});

// News Routes
Route::get('/news', [NewsController::class, 'index'])->name('news.index');
Route::get('/news/{news}', [NewsController::class, 'show'])->name('news.show');

// News Like & Comments
Route::post('news/{news}/like', [NewsLikeController::class, 'toggle'])->name('news.like');
Route::post('news/{news}/comment', [NewsCommentController::class, 'store'])->name('news.comment');

// Events Routes
Route::prefix('events')->name('events.')->group(function () {
    Route::get('/annual', [EventController::class, 'annual'])->name('annual');
    Route::get('/upcoming', [EventController::class, 'upcoming'])->name('upcoming');
    Route::get('/past', [EventController::class, 'past'])->name('past');
    Route::get('/{event}', [EventController::class, 'show'])->name('show');
    Route::get('/{event}/register', [EventController::class, 'register'])->name('register');
});

// Activities routes
Route::get('/activities', [ActivityController::class, 'publicIndex'])->name('activities.index');
Route::get('/activities/{activity}', [ActivityController::class, 'show'])->name('activities.show');

// Admin Auth Routes
Route::get('/admin/login', [App\Http\Controllers\Admin\AuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [App\Http\Controllers\Admin\AuthController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [App\Http\Controllers\Admin\AuthController::class, 'logout'])->name('admin.logout');

// Admin Routes
Route::middleware(['auth:admin'])->group(function () {
    Route::prefix('admin')->name('admin.')->group(function () {
        // Protected routes
        Route::post('logout', [App\Http\Controllers\Admin\AuthController::class, 'logout'])->name('logout');
        Route::get('/dashboard/index', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard.index');
        Route::get('dashboard', [App\Http\Controllers\Admin\AdminController::class, 'dashboard'])->name('dashboard');

        // Committee Routes
        Route::resource('committee', App\Http\Controllers\Admin\CommitteeController::class);

        // Management Routes
        Route::prefix('management')->name('management.')->group(function () {
            Route::get('/central', [App\Http\Controllers\Admin\ManagementController::class, 'central'])->name('central');
            Route::get('/district', [App\Http\Controllers\Admin\ManagementController::class, 'district'])->name('district');
            Route::get('/upazila', [App\Http\Controllers\Admin\ManagementController::class, 'upazila'])->name('upazila');
            Route::get('/thana', [App\Http\Controllers\Admin\ManagementController::class, 'thana'])->name('thana');
            Route::get('/branch', [App\Http\Controllers\Admin\ManagementController::class, 'branch'])->name('branch');
            Route::get('/create', [App\Http\Controllers\Admin\ManagementController::class, 'create'])->name('create');
            Route::post('/store', [App\Http\Controllers\Admin\ManagementController::class, 'store'])->name('store');
            Route::get('/{management}/edit', [App\Http\Controllers\Admin\ManagementController::class, 'edit'])->name('edit');
            Route::put('/{management}', [App\Http\Controllers\Admin\ManagementController::class, 'update'])->name('update');
            Route::delete('/{management}', [App\Http\Controllers\Admin\ManagementController::class, 'destroy'])->name('destroy');
        });

        // Department Routes
        Route::resource('departments', App\Http\Controllers\Admin\DepartmentController::class);

        // Officials Routes
        Route::resource('officials', OfficialController::class);

        // Publications Routes
        Route::prefix('publications')->name('publications.')->group(function () {
            // Image Upload Route
            Route::post('/upload-image', [AdminPublicationController::class, 'uploadImage'])->name('upload.image');
            
            // Books
            Route::get('books', [AdminPublicationController::class, 'books'])->name('books.index');
            Route::get('books/create', [AdminPublicationController::class, 'createBook'])->name('books.create');
            Route::post('books', [AdminPublicationController::class, 'storeBook'])->name('books.store');
            Route::get('books/{book}', [AdminPublicationController::class, 'showBook'])->name('books.show');
            Route::get('books/{book}/edit', [AdminPublicationController::class, 'editBook'])->name('books.edit');
            Route::put('books/{book}', [AdminPublicationController::class, 'updateBook'])->name('books.update');
            Route::delete('books/{book}', [AdminPublicationController::class, 'destroyBook'])->name('books.destroy');

            // Magazines
            Route::get('magazines', [AdminPublicationController::class, 'magazines'])->name('magazines.index');
            Route::get('magazines/create', [AdminPublicationController::class, 'createMagazine'])->name('magazines.create');
            Route::post('magazines', [AdminPublicationController::class, 'storeMagazine'])->name('magazines.store');
            Route::get('magazines/{magazine}', [AdminPublicationController::class, 'showMagazine'])->name('magazines.show');
            Route::get('magazines/{magazine}/edit', [AdminPublicationController::class, 'editMagazine'])->name('magazines.edit');
            Route::put('magazines/{magazine}', [AdminPublicationController::class, 'updateMagazine'])->name('magazines.update');
            Route::delete('magazines/{magazine}', [AdminPublicationController::class, 'destroyMagazine'])->name('magazines.destroy');
            
            // Articles
            Route::get('articles', [AdminPublicationController::class, 'articles'])->name('articles.index');
            Route::get('articles/create', [AdminPublicationController::class, 'createArticle'])->name('articles.create');
            Route::post('articles', [AdminPublicationController::class, 'storeArticle'])->name('articles.store');
            Route::get('articles/{article}/edit', [AdminPublicationController::class, 'editArticle'])->name('articles.edit');
            Route::put('articles/{article}', [AdminPublicationController::class, 'updateArticle'])->name('articles.update');
            Route::delete('articles/{article}', [AdminPublicationController::class, 'destroyArticle'])->name('articles.destroy');
        });

        // News Comments Routes
        Route::prefix('news')->name('news.')->group(function () {
            Route::get('comments', [AdminNewsCommentController::class, 'index'])->name('comments.index');
            Route::post('comments/{comment}/approve', [AdminNewsCommentController::class, 'approve'])->name('comments.approve');
            Route::delete('comments/{comment}', [AdminNewsCommentController::class, 'destroy'])->name('comments.destroy');
        });

        // Profile Routes
        Route::get('profile', [App\Http\Controllers\Admin\ProfileController::class, 'edit'])->name('profile');
        Route::put('profile', [App\Http\Controllers\Admin\ProfileController::class, 'update'])->name('profile.update');
        Route::put('profile/password', [App\Http\Controllers\Admin\ProfileController::class, 'password'])->name('profile.password');

        // Settings Routes
        Route::get('settings', [App\Http\Controllers\Admin\SettingsController::class, 'edit'])->name('settings');
        Route::put('settings', [App\Http\Controllers\Admin\SettingsController::class, 'update'])->name('settings.update');
        Route::put('settings/social', [App\Http\Controllers\Admin\SettingsController::class, 'social'])->name('settings.social');

        // Theme & Night/Day Mode Manager
        Route::get('theme', [App\Http\Controllers\Admin\SettingsController::class, 'theme'])->name('theme.index');
        Route::put('theme', [App\Http\Controllers\Admin\SettingsController::class, 'updateTheme'])->name('theme.update');

        // Homepage Section & Layout Manager
        Route::prefix('homepage')->name('homepage.')->group(function () {
            Route::get('/', [App\Http\Controllers\Admin\HomepageController::class, 'index'])->name('index');
            Route::post('/', [App\Http\Controllers\Admin\HomepageController::class, 'update'])->name('update');
            Route::patch('/{section}/toggle', [App\Http\Controllers\Admin\HomepageController::class, 'toggle'])->name('toggle');
            Route::post('/reorder', [App\Http\Controllers\Admin\HomepageController::class, 'reorder'])->name('reorder');
            Route::post('/reset', [App\Http\Controllers\Admin\HomepageController::class, 'reset'])->name('reset');
        });

        // AI Assistant & Chat Manager
        Route::prefix('ai-chat')->name('ai-chat.')->group(function () {
            Route::get('/', [App\Http\Controllers\Admin\AdminAIChatController::class, 'index'])->name('index');
            Route::post('/settings', [App\Http\Controllers\Admin\AdminAIChatController::class, 'updateSettings'])->name('settings.update');
            Route::get('/knowledge', [App\Http\Controllers\Admin\AdminAIChatController::class, 'knowledgeIndex'])->name('knowledge.index');
            Route::post('/knowledge', [App\Http\Controllers\Admin\AdminAIChatController::class, 'knowledgeStore'])->name('knowledge.store');
            Route::put('/knowledge/{item}', [App\Http\Controllers\Admin\AdminAIChatController::class, 'knowledgeUpdate'])->name('knowledge.update');
            Route::delete('/knowledge/{item}', [App\Http\Controllers\Admin\AdminAIChatController::class, 'knowledgeDestroy'])->name('knowledge.destroy');
            Route::patch('/knowledge/{item}/toggle', [App\Http\Controllers\Admin\AdminAIChatController::class, 'knowledgeToggle'])->name('knowledge.toggle');
            Route::post('/knowledge/reset', [App\Http\Controllers\Admin\AdminAIChatController::class, 'knowledgeReset'])->name('knowledge.reset');
            Route::get('/logs', [App\Http\Controllers\Admin\AdminAIChatController::class, 'logsIndex'])->name('logs.index');
            Route::post('/logs/{message}/convert', [App\Http\Controllers\Admin\AdminAIChatController::class, 'convertLogToKnowledge'])->name('logs.convert');
            Route::post('/logs/clear', [App\Http\Controllers\Admin\AdminAIChatController::class, 'clearLogs'])->name('logs.clear');
            Route::post('/test', [App\Http\Controllers\Admin\AdminAIChatController::class, 'testQuery'])->name('test');
        });

        // AI Site Manager & Design Copilot
        Route::prefix('ai-copilot')->name('ai-copilot.')->group(function () {
            Route::get('/', [App\Http\Controllers\Admin\AdminAICopilotController::class, 'index'])->name('index');
            Route::post('/execute', [App\Http\Controllers\Admin\AdminAICopilotController::class, 'execute'])->name('execute');
            Route::post('/rollback/{id?}', [App\Http\Controllers\Admin\AdminAICopilotController::class, 'rollback'])->name('rollback');
            Route::post('/reset-css', [App\Http\Controllers\Admin\AdminAICopilotController::class, 'resetCss'])->name('reset-css');
        });

        // Progressive Web App (PWA) Manager
        Route::prefix('pwa')->name('pwa.')->group(function () {
            Route::get('/', [App\Http\Controllers\Admin\PwaController::class, 'index'])->name('index');
            Route::post('/', [App\Http\Controllers\Admin\PwaController::class, 'update'])->name('update');
            Route::post('/regenerate-icons', [App\Http\Controllers\Admin\PwaController::class, 'regenerateIcons'])->name('regenerate-icons');
            Route::post('/bump-cache', [App\Http\Controllers\Admin\PwaController::class, 'bumpCache'])->name('bump-cache');
            Route::post('/reset', [App\Http\Controllers\Admin\PwaController::class, 'reset'])->name('reset');
        });

        // Sliders
        Route::resource('sliders', App\Http\Controllers\Admin\SliderController::class);

        // News
        Route::resource('news', App\Http\Controllers\Admin\NewsController::class);

        // Notices
        Route::resource('notices', App\Http\Controllers\Admin\NoticeController::class);

        // Activities
        Route::resource('activities', App\Http\Controllers\Admin\ActivityController::class);

        // Members
        Route::resource('members', App\Http\Controllers\Admin\MemberController::class);

        // Contacts
        Route::resource('contacts', App\Http\Controllers\Admin\ContactController::class)->only(['index', 'show', 'destroy']);



        // Gallery
        Route::resource('gallery', App\Http\Controllers\Admin\GalleryController::class);
        
        // Gallery Archives
        Route::resource('gallery-archives', App\Http\Controllers\Admin\GalleryArchiveController::class);

        // Photos
        Route::resource('photos', App\Http\Controllers\Admin\PhotoController::class);

        // Videos
        Route::resource('videos', AdminVideoController::class);

        // Centralized Media & File Manager
        Route::prefix('media')->name('media.')->group(function () {
            Route::get('/', [App\Http\Controllers\Admin\MediaManagerController::class, 'index'])->name('index');
            Route::post('upload', [App\Http\Controllers\Admin\MediaManagerController::class, 'upload'])->name('upload');
            Route::delete('delete', [App\Http\Controllers\Admin\MediaManagerController::class, 'destroy'])->name('destroy');
        });

        // Training Routes
        Route::prefix('training')->name('training.')->group(function () {
            // Aref Training
            Route::prefix('aref')->name('aref.')->group(function () {
                Route::get('/', [AdminArefTrainingController::class, 'index'])->name('index');
                Route::get('create', [AdminArefTrainingController::class, 'create'])->name('create');
                Route::post('/', [AdminArefTrainingController::class, 'store'])->name('store');
                Route::get('download-all', [AdminArefTrainingController::class, 'downloadAll'])->name('download.all');
                Route::get('{id}', [AdminArefTrainingController::class, 'show'])->name('show');
                Route::get('{registration}/download', [AdminArefTrainingController::class, 'download'])->name('download');
                Route::get('{id}/edit', [AdminArefTrainingController::class, 'edit'])->name('edit');
                Route::put('{id}', [AdminArefTrainingController::class, 'update'])->name('update');
                Route::delete('{id}', [AdminArefTrainingController::class, 'destroy'])->name('destroy');
            });

            // Rageb Training
            Route::prefix('rageb')->name('rageb.')->group(function () {
                Route::get('/', [AdminRagebTrainingController::class, 'index'])->name('index');
                Route::get('create', [AdminRagebTrainingController::class, 'create'])->name('create');
                Route::post('/', [AdminRagebTrainingController::class, 'store'])->name('store');
                Route::get('download-all', [AdminRagebTrainingController::class, 'downloadAll'])->name('download.all');
                Route::get('{id}', [AdminRagebTrainingController::class, 'show'])->name('show');
                Route::get('{registration}/download', [AdminRagebTrainingController::class, 'download'])->name('download');
                Route::get('{id}/edit', [AdminRagebTrainingController::class, 'edit'])->name('edit');
                Route::put('{id}', [AdminRagebTrainingController::class, 'update'])->name('update');
                Route::delete('{id}', [AdminRagebTrainingController::class, 'destroy'])->name('destroy');
            });

            // Salek Training
            Route::prefix('salek')->name('salek.')->group(function () {
                Route::get('/', [AdminSalekTrainingController::class, 'index'])->name('index');
                Route::get('create', [AdminSalekTrainingController::class, 'create'])->name('create');
                Route::post('/', [AdminSalekTrainingController::class, 'store'])->name('store');
                Route::get('download-all', [AdminSalekTrainingController::class, 'downloadAll'])->name('download.all');
                Route::get('{id}', [AdminSalekTrainingController::class, 'show'])->name('show');
                Route::get('{registration}/download', [AdminSalekTrainingController::class, 'download'])->name('download');
                Route::get('{id}/edit', [AdminSalekTrainingController::class, 'edit'])->name('edit');
                Route::put('{id}', [AdminSalekTrainingController::class, 'update'])->name('update');
                Route::delete('{id}', [AdminSalekTrainingController::class, 'destroy'])->name('destroy');
            });

            // Saleh Training
            Route::prefix('saleh')->name('saleh.')->group(function () {
                Route::get('/', [AdminSalehTrainingController::class, 'index'])->name('index');
                Route::get('create', [AdminSalehTrainingController::class, 'create'])->name('create');
                Route::post('/', [AdminSalehTrainingController::class, 'store'])->name('store');
                Route::get('download-all', [AdminSalehTrainingController::class, 'downloadAll'])->name('download.all');
                Route::get('{id}', [AdminSalehTrainingController::class, 'show'])->name('show');
                Route::get('{registration}/download', [AdminSalehTrainingController::class, 'download'])->name('download');
                Route::get('{id}/edit', [AdminSalehTrainingController::class, 'edit'])->name('edit');
                Route::put('{id}', [AdminSalehTrainingController::class, 'update'])->name('update');
                Route::delete('{id}', [AdminSalehTrainingController::class, 'destroy'])->name('destroy');
            });
        });

        // Comprehensive Donation & Causes Management
        Route::prefix('donations')->name('donations.')->group(function () {
            // Donation Causes / Funds Management
            Route::get('causes', [App\Http\Controllers\Admin\DonationController::class, 'causesIndex'])->name('causes.index');
            Route::get('causes/create', [App\Http\Controllers\Admin\DonationController::class, 'causesCreate'])->name('causes.create');
            Route::post('causes', [App\Http\Controllers\Admin\DonationController::class, 'causesStore'])->name('causes.store');
            Route::get('causes/{cause}/edit', [App\Http\Controllers\Admin\DonationController::class, 'causesEdit'])->name('causes.edit');
            Route::put('causes/{cause}', [App\Http\Controllers\Admin\DonationController::class, 'causesUpdate'])->name('causes.update');
            Route::patch('causes/{cause}/toggle', [App\Http\Controllers\Admin\DonationController::class, 'causesToggleStatus'])->name('causes.toggle');
            Route::delete('causes/{cause}', [App\Http\Controllers\Admin\DonationController::class, 'causesDestroy'])->name('causes.destroy');

            // Payment Accounts Configuration
            Route::get('accounts', [App\Http\Controllers\Admin\DonationController::class, 'paymentAccounts'])->name('accounts');
            Route::post('accounts', [App\Http\Controllers\Admin\DonationController::class, 'updatePaymentAccounts'])->name('accounts.update');

            // Donations CRUD
            Route::get('/', [App\Http\Controllers\Admin\DonationController::class, 'index'])->name('index');
            Route::get('create', [App\Http\Controllers\Admin\DonationController::class, 'create'])->name('create');
            Route::post('/', [App\Http\Controllers\Admin\DonationController::class, 'store'])->name('store');
            Route::get('{donation}', [App\Http\Controllers\Admin\DonationController::class, 'show'])->name('show');
            Route::get('{donation}/edit', [App\Http\Controllers\Admin\DonationController::class, 'edit'])->name('edit');
            Route::put('{donation}', [App\Http\Controllers\Admin\DonationController::class, 'update'])->name('update');
            Route::patch('{donation}/status', [App\Http\Controllers\Admin\DonationController::class, 'updateStatus'])->name('status');
            Route::get('{donation}/print', [App\Http\Controllers\Admin\DonationController::class, 'printReceipt'])->name('print');
            Route::get('{donation}/receipt', [App\Http\Controllers\Admin\DonationController::class, 'printReceipt'])->name('receipt');
            Route::delete('{donation}', [App\Http\Controllers\Admin\DonationController::class, 'destroy'])->name('destroy');
        });

        // Page Access Control & Permissions Management
        Route::prefix('page-access')->name('page-access.')->group(function () {
            Route::get('/', [App\Http\Controllers\Admin\PageAccessController::class, 'index'])->name('index');
            Route::post('/', [App\Http\Controllers\Admin\PageAccessController::class, 'store'])->name('store');
            Route::put('/{pageAccess}', [App\Http\Controllers\Admin\PageAccessController::class, 'update'])->name('update');
            Route::post('/bulk-update', [App\Http\Controllers\Admin\PageAccessController::class, 'bulkUpdate'])->name('bulk-update');
            Route::delete('/{pageAccess}', [App\Http\Controllers\Admin\PageAccessController::class, 'destroy'])->name('destroy');
        });

        // Registered Users & Roles Management
        Route::prefix('users-access')->name('users-access.')->group(function () {
            Route::get('/', [App\Http\Controllers\Admin\PageAccessController::class, 'usersIndex'])->name('index');
            Route::put('/{user}', [App\Http\Controllers\Admin\PageAccessController::class, 'updateUserRole'])->name('update');
        });

        // Organizational Members, Iyanats & Reports Management
        Route::prefix('organization')->name('organization.')->group(function () {
            // Iyanats
            Route::get('/iyanats', [App\Http\Controllers\Admin\OrganizationController::class, 'iyanats'])->name('iyanats');
            Route::patch('/iyanats/{iyanat}/status', [App\Http\Controllers\Admin\OrganizationController::class, 'updateIyanatStatus'])->name('iyanats.status');

            // Reports
            Route::get('/reports', [App\Http\Controllers\Admin\OrganizationController::class, 'programReports'])->name('reports');
            Route::patch('/reports/{report}/status', [App\Http\Controllers\Admin\OrganizationController::class, 'updateReportStatus'])->name('reports.status');

            // Tier Promotions
            Route::get('/promotions', [App\Http\Controllers\Admin\OrganizationController::class, 'tierPromotions'])->name('promotions');
            Route::patch('/promotions/{promotion}/status', [App\Http\Controllers\Admin\OrganizationController::class, 'updatePromotionStatus'])->name('promotions.status');
        });
    });
});

// Training Routes
Route::prefix('training')->name('training.')->group(function () {
    Route::get('self-development', [TrainingController::class, 'selfDevelopment'])->name('self-development');
    Route::get('courses', [TrainingController::class, 'courses'])->name('courses');
    Route::get('aref', [TrainingController::class, 'aref'])->name('aref');
    Route::get('rageb', [TrainingController::class, 'rageb'])->name('rageb');
    Route::get('salek', [TrainingController::class, 'salek'])->name('salek');
    Route::get('saleh', [TrainingController::class, 'saleh'])->name('saleh');
    Route::get('register/{type}', [TrainingController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [TrainingController::class, 'storeRegistration'])->name('register.store');
    Route::get('print/{id}', [TrainingController::class, 'printPdf'])->name('print');
    Route::get('download/{id}', [TrainingController::class, 'downloadPdf'])->name('download');
});

// Public Publications Routes
Route::prefix('publications')->name('publications.')->group(function () {
    Route::get('/books', [App\Http\Controllers\PublicationController::class, 'books'])->name('books');
    Route::get('/books/{book}/read', [App\Http\Controllers\PublicationController::class, 'readBook'])->name('books.read');
    Route::get('/magazines', [App\Http\Controllers\PublicationController::class, 'magazines'])->name('magazines');
    Route::get('/magazines/{magazine}/read', [App\Http\Controllers\PublicationController::class, 'readMagazine'])->name('magazines.read');
    Route::get('/magazines/{magazine}/details', [App\Http\Controllers\PublicationController::class, 'magazineDetails'])->name('magazines.details');
    Route::get('/articles', [App\Http\Controllers\PublicationController::class, 'articles'])->name('articles');
    Route::get('/articles/{id}/read', [App\Http\Controllers\PublicationController::class, 'readArticle'])->name('articles.read');
});
