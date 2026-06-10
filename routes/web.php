<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\SocialAuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RfqController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\UserController as AdminUser;
use App\Http\Controllers\Admin\VendorController as AdminVendor;
use App\Http\Controllers\Admin\VendorCategoryController as AdminVendorCategory;
use App\Http\Controllers\Admin\ProductController as AdminProduct;
use App\Http\Controllers\Admin\ProductCategoryController as AdminProductCategory;
use App\Http\Controllers\Admin\ProductSubcategoryController as AdminProductSubcategory;
use App\Http\Controllers\Admin\RfqController as AdminRfq;
use App\Http\Controllers\Admin\ContactController as AdminContact;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');

// Vendors
Route::get('/vendors', [VendorController::class, 'index'])->name('vendors.index');
Route::get('/vendors/{slug}', [VendorController::class, 'show'])->name('vendors.show');

// Products
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{slug}', [ProductController::class, 'show'])->name('products.show');

// Contact
Route::get('/contact', [ContactController::class, 'show'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// RFQ
Route::get('/rfq', [RfqController::class, 'create'])->name('rfq.create');
Route::post('/rfq', [RfqController::class, 'store'])->name('rfq.store');

// API: Get vendor's product categories
Route::get('/api/vendor/{vendor}/categories', [VendorController::class, 'getCategories'])->name('api.vendor.categories');

// Auth routes
Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterController::class, 'showForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
    Route::get('/login', [LoginController::class, 'showForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

// Social Auth
Route::get('/auth/google', [SocialAuthController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback', [SocialAuthController::class, 'handleGoogleCallback']);

// Authenticated user routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
});

// Admin routes
Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/', [AdminDashboard::class, 'index'])->name('dashboard');

    // Users
    Route::get('/users', [AdminUser::class, 'index'])->name('users.index');
    Route::get('/users/{user}', [AdminUser::class, 'show'])->name('users.show');
    Route::get('/users/{user}/edit', [AdminUser::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [AdminUser::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [AdminUser::class, 'destroy'])->name('users.destroy');
    Route::patch('/users/{user}/toggle-status', [AdminUser::class, 'toggleStatus'])->name('users.toggle-status');

    // Vendor Categories
    Route::resource('vendor-categories', AdminVendorCategory::class);

    // Vendors
    Route::resource('vendors', AdminVendor::class);
    Route::patch('/vendors/{vendor}/status', [AdminVendor::class, 'updateStatus'])->name('vendors.status');

    // Product Categories
    Route::resource('product-categories', AdminProductCategory::class);

    // Product Subcategories
    Route::resource('product-subcategories', AdminProductSubcategory::class);

    // Products
    Route::resource('products', AdminProduct::class);

    // RFQs
    Route::get('/rfqs', [AdminRfq::class, 'index'])->name('rfqs.index');
    Route::get('/rfqs/{rfq}', [AdminRfq::class, 'show'])->name('rfqs.show');
    Route::patch('/rfqs/{rfq}/status', [AdminRfq::class, 'updateStatus'])->name('rfqs.status');
    Route::delete('/rfqs/{rfq}', [AdminRfq::class, 'destroy'])->name('rfqs.destroy');

    // Contacts
    Route::get('/contacts', [AdminContact::class, 'index'])->name('contacts.index');
    Route::get('/contacts/{contact}', [AdminContact::class, 'show'])->name('contacts.show');
    Route::delete('/contacts/{contact}', [AdminContact::class, 'destroy'])->name('contacts.destroy');
});
