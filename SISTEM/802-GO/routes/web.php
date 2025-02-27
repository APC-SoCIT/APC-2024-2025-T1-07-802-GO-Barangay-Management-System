<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\DocumentRequestController;
use App\Http\Controllers\DocumentController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;


// Admin Routes
// routes/web.php
Route::prefix('admin')->group(function () {
    // List all news (GET)
    Route::get('/news', [\App\Http\Controllers\Admin\NewsController::class, 'index'])->name('admin.news.index');

    // Show the create form (GET)
    Route::get('/news/create', [\App\Http\Controllers\Admin\NewsController::class, 'create'])->name('admin.news.create');

    // Store a new news article (POST)
    Route::post('/news', [\App\Http\Controllers\Admin\NewsController::class, 'store'])->name('admin.news.store');

    // Show a single news article (GET) - Optional (exclude if not needed)
    Route::get('/news/{news}', [\App\Http\Controllers\Admin\NewsController::class, 'show'])->name('admin.news.show');

    // Show the edit form (GET)
    Route::get('/news/{news}/edit', [\App\Http\Controllers\Admin\NewsController::class, 'edit'])->name('admin.news.edit');

    // Update a news article (PUT/PATCH)
    Route::put('/news/{news}', [\App\Http\Controllers\Admin\NewsController::class, 'update'])->name('admin.news.update');
    Route::patch('/news/{news}', [\App\Http\Controllers\Admin\NewsController::class, 'update']);

    // Delete a news article (DELETE)
    Route::delete('/news/{news}', [\App\Http\Controllers\Admin\NewsController::class, 'destroy'])->name('admin.news.destroy');

   });

// User Routes
Route::get('/index', [\App\Http\Controllers\NewsController::class, 'index'])->name('news.index');
Route::get('/news/{news}', [\App\Http\Controllers\NewsController::class, 'show'])->name('news.show');

Route::get('/document-request', [DocumentRequestController::class, 'index'])->name('document-request');

Route::get('/barangay-clearance', [DocumentRequestController::class, 'barangayClearance'])->name('barangay-clearance');
Route::get('/certificate-of-residency', [DocumentRequestController::class, 'certificateOfResidency'])->name('certificate-of-residency');
Route::get('/indigency-certificate', [DocumentRequestController::class, 'indigencyCertificate'])->name('indigency-certificate');
Route::get('/barangay-id', [DocumentRequestController::class, 'barangayID'])->name('barangay-id');
Route::get('/business-permit', [DocumentRequestController::class, 'businessPermit'])->name('business-permit');
Route::get('/cedula', [DocumentRequestController::class, 'cedula'])->name('cedula'); // ✅ Added Cedula Route

$url = config('app.url');
URL::forceRootUrl($url);

Route::get('/', function () {
    return view('welcome');
});

Route::get('/sample-news-1', function () {
    return view('news.sample-news-1');
})->name('sample-news-1');

Route::get('/sample-news-2', function () {
    return view('news.sample-news-2');
})->name('sample-news-2');

Route::get('/sample-news-3', function () {
    return view('news.sample-news-3');
})->name('sample-news-3');

Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');

Route::get('/news-page', function () {
    return view('news.news-page');
})->name('news-page');

Route::get('/document-request', function () {
    return view('document-request');
})->name('document-request');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::post('/submit-barangay-clearance', [DocumentController::class, 'submitBarangayClearance'])->name('submit-barangay-clearance');
Route::post('/submit-certificate-of-residency', [DocumentController::class, 'submitCertificateOfResidency'])->name('submit-certificate-of-residency');
Route::post('/submit-indigency-certificate', [DocumentController::class, 'submitIndigencyCertificate'])->name('submit-indigency-certificate');
Route::post('/submit-barangay-id', [DocumentController::class, 'submitBarangayId'])->name('submit-barangay-id');
Route::post('/submit-business-permits', [DocumentController::class, 'submitBusinessPermits'])->name('submit-business-permits');
Route::post('/submit-cedula', [DocumentController::class, 'submitCedula'])->name('submit-cedula'); // ✅ Added Cedula Submission Route

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

require __DIR__.'/auth.php';