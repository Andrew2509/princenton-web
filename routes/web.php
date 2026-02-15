<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminProjectController;
use App\Http\Controllers\Admin\AdminSkillController;
use App\Http\Controllers\Admin\AdminMethodologyController;
use App\Http\Controllers\Admin\AdminAboutController;
use App\Http\Controllers\Admin\AdminSettingsController;
use App\Http\Controllers\Admin\AdminContactController;



use App\Http\Controllers\PortfolioController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::get('/debug-ssl', function () {
    $path = env('MYSQL_ATTR_SSL_CA');
    $testPaths = [
        'env_original' => $path,
        'base_path_env' => base_path($path),
        'storage_app_ca' => storage_path('app/ca.pem'),
        'base_storage_app_ca' => base_path('storage/app/ca.pem'),
        'public_ca' => public_path('ca.pem'),
    ];

    $results = [];
    foreach ($testPaths as $key => $p) {
        $results[$key] = [
            'path' => $p,
            'exists' => file_exists($p),
            'readable' => is_readable($p),
            'realpath' => realpath($p),
        ];
    }

    return [
        'extension_loaded' => extension_loaded('pdo_mysql'),
        'openssl_loaded' => extension_loaded('openssl'),
        'paths' => $results,
        'dir_storage_app' => is_dir(storage_path('app')) ? scandir(storage_path('app')) : 'not a dir',
        'dir_base' => scandir(base_path()),
        'env_vars' => [
            'MYSQL_ATTR_SSL_CA' => env('MYSQL_ATTR_SSL_CA'),
            'DB_HOST' => env('DB_HOST'),
        ]
    ];
});

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
], function() {
    Route::get('/', [PortfolioController::class, 'index'])->name('home');
    Route::get('/projects', [PortfolioController::class, 'projects'])->name('projects');
    Route::get('/process', [PortfolioController::class, 'process'])->name('process');
    Route::get('/about', [PortfolioController::class, 'about'])->name('about');
    Route::get('/contact', [PortfolioController::class, 'contact'])->name('contact');
    Route::post('/contact', [PortfolioController::class, 'submitContact'])->name('contact.submit');
});

// Auth Routes
use App\Http\Controllers\Auth\AuthController;
Route::get('login', [AuthController::class, 'showLogin'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// Admin Panel Routes
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::resource('projects', AdminProjectController::class)->except(['show']);
    Route::resource('skills', AdminSkillController::class)->except(['show']);
    Route::resource('methodology', AdminMethodologyController::class)->except(['show']);
    Route::put('methodology-bulk', [AdminMethodologyController::class, 'bulkUpdate'])->name('methodology.bulkUpdate');

    Route::get('about', [AdminAboutController::class, 'edit'])->name('about.edit');
    Route::put('about', [AdminAboutController::class, 'update'])->name('about.update');

    Route::get('settings', [AdminSettingsController::class, 'edit'])->name('settings.edit');
    Route::put('settings', [AdminSettingsController::class, 'update'])->name('settings.update');

    Route::resource('contact', AdminContactController::class)->only(['index', 'show', 'destroy']);
    Route::post('contact/mark-all-read', [AdminContactController::class, 'markAllRead'])->name('contact.markAllRead');
    Route::put('contact/{contact}/archive', [AdminContactController::class, 'archive'])->name('contact.archive');
    Route::put('contact/{contact}/unarchive', [AdminContactController::class, 'unarchive'])->name('contact.unarchive');
});
