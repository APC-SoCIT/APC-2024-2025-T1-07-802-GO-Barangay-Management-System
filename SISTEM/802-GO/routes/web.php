<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\DocumentRequestController as UserDocumentRequestController;
use App\Http\Controllers\Admin\DocumentRequestController as AdminDocumentRequestController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/document-requests', [AdminDocumentRequestController::class, 'index'])->name('document-requests.index');
    Route::get('/document-requests/{id}', [AdminDocumentRequestController::class, 'show'])->name('document-requests.show');
    Route::get('/document-requests/{id}/edit', [AdminDocumentRequestController::class, 'edit'])->name('document-requests.edit');
    Route::patch('/document-requests/{id}', [AdminDocumentRequestController::class, 'update'])->name('document-requests.update');
    Route::delete('/document-requests/{id}', [AdminDocumentRequestController::class, 'destroy'])->name('document-requests.destroy');
});

// Force URL Configuration
$url = config('app.url');
URL::forceRootUrl($url);

// Home Page
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Dashboard (Authenticated Users Only)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// News Pages
Route::get('/news-page', function () {
    return view('news.news-page');
})->name('news-page');
Route::get('/sample-news-1', function () {
    return view('news.sample-news-1');
})->name('sample-news-1');
Route::get('/sample-news-2', function () {
    return view('news.sample-news-2');
})->name('sample-news-2');
Route::get('/sample-news-3', function () {
    return view('news.sample-news-3');
})->name('sample-news-3');

// User News Routes
Route::get('/index', [NewsController::class, 'index'])->name('news.index');
Route::get('/news/{news}', [NewsController::class, 'show'])->name('news.show');

// Document Request Pages
Route::get('/document-request', [UserDocumentRequestController::class, 'index'])->name('document-request');
Route::get('/barangay-clearance', [UserDocumentRequestController::class, 'barangayClearance'])->name('barangay-clearance');
Route::get('/certificate-of-residency', [UserDocumentRequestController::class, 'certificateOfResidency'])->name('certificate-of-residency');
Route::get('/indigency-certificate', [UserDocumentRequestController::class, 'indigencyCertificate'])->name('indigency-certificate');
Route::get('/barangay-id', [UserDocumentRequestController::class, 'barangayID'])->name('barangay-id');
Route::get('/business-permit', [UserDocumentRequestController::class, 'businessPermit'])->name('business-permit');
Route::get('/cedula', [UserDocumentRequestController::class, 'cedula'])->name('cedula');

// Form Submission Routes
Route::post('/submit-barangay-clearance', [UserDocumentRequestController::class, 'submitBarangayClearance'])->name('submit-barangay-clearance');
Route::post('/submit-certificate-of-residency', [UserDocumentRequestController::class, 'submitCertificateOfResidency'])->name('submit-certificate-of-residency');
Route::post('/submit-indigency-certificate', [UserDocumentRequestController::class, 'submitIndigencyCertificate'])->name('submit-indigency-certificate');
Route::post('/submit-barangay-id', [UserDocumentRequestController::class, 'submitBarangayID'])->name('submit-barangay-id');
Route::post('/submit-business-permit', [UserDocumentRequestController::class, 'submitBusinessPermit'])->name('submit-business-permit');
Route::post('/submit-cedula', [UserDocumentRequestController::class, 'submitCedula'])->name('submit-cedula');

// Resident Database Management
Route::prefix('admin/residents')->name('admin.residents.')->group(function () {
    Route::get('/', [\App\Http\Controllers\Admin\ResidentController::class, 'index'])->name('index'); // List all residents
    Route::get('/create', [\App\Http\Controllers\Admin\ResidentController::class, 'create'])->name('create'); // Show form to add a resident
    Route::post('/', [\App\Http\Controllers\Admin\ResidentController::class, 'store'])->name('store'); // Store new resident
    Route::get('/{user}', [\App\Http\Controllers\Admin\ResidentController::class, 'show'])->name('show'); // View a resident
    Route::get('/{user}/edit', [\App\Http\Controllers\Admin\ResidentController::class, 'edit'])->name('edit'); // Show edit form
    Route::put('/{user}', [\App\Http\Controllers\Admin\ResidentController::class, 'update'])->name('update'); // Update resident details
    Route::patch('/{user}', [\App\Http\Controllers\Admin\ResidentController::class, 'update']); // Alternative update method
    Route::delete('/{user}', [\App\Http\Controllers\Admin\ResidentController::class, 'destroy'])->name('destroy'); // Delete a resident
});

// News Management
Route::prefix('admin/news')->name('admin.news.')->group(function () {
    Route::get('/', [\App\Http\Controllers\Admin\NewsController::class, 'index'])->name('index');
    Route::get('/create', [\App\Http\Controllers\Admin\NewsController::class, 'create'])->name('create');
    Route::post('/', [\App\Http\Controllers\Admin\NewsController::class, 'store'])->name('store');
    Route::get('/{news}', [\App\Http\Controllers\Admin\NewsController::class, 'show'])->name('show');
    Route::get('/{news}/edit', [\App\Http\Controllers\Admin\NewsController::class, 'edit'])->name('edit');
    Route::put('/{news}', [\App\Http\Controllers\Admin\NewsController::class, 'update'])->name('update');
    Route::patch('/{news}', [\App\Http\Controllers\Admin\NewsController::class, 'update']);
    Route::delete('/{news}', [\App\Http\Controllers\Admin\NewsController::class, 'destroy'])->name('destroy');
});


// Admin Authentication Routes (place these before other admin routes)
Route::middleware('guest')->group(function () {
    Route::get('admin/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('admin/login', [AdminLoginController::class, 'login'])->name('admin.login.submit');
});

// Admin Protected Routes
Route::prefix('admin/news')->name('admin.news')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/news', [AdminController::class, 'index'])->name('news');
    Route::get('/news', [AdminNewsController::class, 'index'])->name('admin.news.index');
});


// Profile Management (Authenticated Users Only)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Authentication Routes
require __DIR__.'/auth.php';

