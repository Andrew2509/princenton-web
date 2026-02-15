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
