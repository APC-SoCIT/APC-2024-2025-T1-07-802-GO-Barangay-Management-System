<?php


use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\DocumentRequestController as UserDocumentRequestController;
use App\Http\Controllers\Admin\DocumentRequestController as AdminDocumentRequestController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;


// Force URL Configuration

$url = config('app.url');

URL::forceRootUrl($url);



// Home Page

Route::get('/', function () {

    $documentRequests = auth()->check() 

        ? auth()->user()->documentRequests()
            ->latest()
            ->select('id', 'reference_number', 'document_type', 'status', 'created_at')
            ->get() 
        : collect([]);
    return view('welcome', compact('documentRequests'));
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



// Admin Authentication Routes (place these before other admin routes)

Route::middleware('guest')->group(function () {
    Route::get('admin/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('admin/login', [AdminLoginController::class, 'login'])->name('admin.login.submit');

});



// Admin Protected Routes - Fix the middleware and routes structure
Route::middleware(['web', 'auth'])->prefix('admin')->name('admin.')->group(function () {

    // Reports Route
    Route::get('/reports', [\App\Http\Controllers\Admin\ReportsController::class, 'index'])->name('reports.index');
    

    // Other admin routes...
    Route::resource('residents', \App\Http\Controllers\Admin\ResidentController::class);
    Route::resource('news', \App\Http\Controllers\Admin\NewsController::class);
    Route::resource('document-requests', \App\Http\Controllers\Admin\DocumentRequestController::class);

});



// Profile Management (Authenticated Users Only)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

Route::patch('/admin/document-requests/{id}/status', [AdminDocumentRequestController::class, 'updateStatus'])
    ->name('admin.update-status');

// Authentication Routes
require __DIR__.'/auth.php';



// Fix the routes for document requests
Route::middleware(['auth'])->group(function () {
    Route::get('/document-requests', [UserDocumentRequestController::class, 'getUserRequests'])->name('document-requests.index');
    Route::put('/document-requests/{id}', [UserDocumentRequestController::class, 'update'])->name('document-requests.update');
    Route::delete('/document-requests/{id}', [UserDocumentRequestController::class, 'cancel'])->name('document-requests.cancel');

    

    // Fix the route for marking notifications as read

    Route::post('/mark-notifications-as-read', [UserDocumentRequestController::class, 'markNotificationsAsRead'])
        ->name('notifications.mark-read');

    

    Route::post('/document-requests/{referenceNumber}/cancel', [UserDocumentRequestController::class, 'cancel'])
        ->name('document-requests.cancel');

        

    Route::get('/document-requests/{referenceNumber}/status', [UserDocumentRequestController::class, 'checkStatus'])
        ->name('document-requests.status');

});
