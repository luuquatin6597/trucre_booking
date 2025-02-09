<?php

use App\Http\Controllers\AdminBookingsController;
use App\Http\Controllers\GoogleCalendarController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PaypalController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminRoomsController;
use App\Http\Controllers\AdminUsersController;
use App\Http\Controllers\AdminBuildingsController;
use App\Http\Controllers\AdminImagesController;
use App\Http\Controllers\AdminCertificatesController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\FrontRoomController;
use App\Http\Controllers\FrontBookingController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Auth;

Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');

Route::get('/', [HomepageController::class, 'index'])->name('homepage');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');
    Route::get('/admin/get-revenue-chart-data', [AdminController::class, 'getRevenueChartData']);
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/users', [AdminUsersController::class, 'AdminUsers'])->name('admin.users');
    Route::get('/admin/users/{id}', [AdminUsersController::class, 'getUser'])->name('admin.users.get');
    Route::post('/admin/users/add', [AdminUsersController::class, 'addUser'])->name('admin.users.add');
    Route::put('/admin/users/{id}', [AdminUsersController::class, 'updateUser'])->name('admin.users.update');
    Route::delete('/admin/users/{id}', [AdminUsersController::class, 'deleteUser'])->name('admin.users.destroy');
    Route::get('/admin/typeaccount', [AdminUsersController::class, 'AdminTypeAccount'])->name('admin.typeaccount');
});

Route::middleware(['auth', 'role:admin,owner'])->group(function () {
    Route::get('/admin/buildings', [AdminBuildingsController::class, 'AdminBuildings'])->name('admin.buildings');
    Route::get('/admin/buildings/{id}', [AdminBuildingsController::class, 'getBuilding'])->name('admin.buildings.get');
    Route::post('/admin/buildings/add', [AdminBuildingsController::class, 'addBuilding'])->name('admin.buildings.add');
    Route::put('/admin/buildings/{id}', [AdminBuildingsController::class, 'updateBuilding'])->name('admin.buildings.update');
    Route::delete('/admin/buildings/{id}', [AdminBuildingsController::class, 'deleteBuilding'])->name('admin.buildings.destroy');
    Route::get('/admin/buildings/{id}/upload', [AdminCertificatesController::class, 'uploadCertificate'])->name('admin.buildings.upload');
    Route::post('/admin/buildings/{id}/upload', [AdminCertificatesController::class, 'storeCertificate'])->name('admin.buildings.store');
    Route::post('/admin/buildings/{id}/remove', [AdminCertificatesController::class, 'deleteCertificate'])->name('admin.building.remove');

});

Route::middleware(['auth', 'role:admin,owner'])->group(function () {
    Route::get('/owner', [OwnerController::class, 'OwnerDashboard'])->name('owner.dashboard');
    Route::get('/owner/autocomplete', [OwnerController::class, 'Autocomplete'])->name('owner.autocomplete');
    Route::get('/owner/get-revenue-chart-data', [OwnerController::class, 'getRevenueChartData']);
});

Route::middleware(['auth', 'role:admin,owner'])->group(function () {
    Route::get('/admin/rooms', [AdminRoomsController::class, 'AdminRooms'])->name('admin.rooms');
    Route::get('/admin/rooms/modal/{id}', [AdminRoomsController::class, 'getRoomModal'])->name('admin.rooms.modal');
    Route::get('/admin/rooms/{id}', [AdminRoomsController::class, 'getRoom'])->name('admin.rooms.get');
    Route::post('/admin/rooms/add', [AdminRoomsController::class, 'addRoom'])->name('admin.rooms.add');
    Route::put('/admin/rooms/{id}', [AdminRoomsController::class, 'updateRoom'])->name('admin.rooms.update');

    Route::delete('/admin/rooms/{id}', [AdminRoomsController::class, 'deleteRoom'])->name('admin.rooms.destroy');
    Route::get('/admin/rooms/{id}/upload', [AdminImagesController::class, 'uploadImage'])->name('admin.rooms.upload');
    Route::post('/admin/rooms/{id}/upload', [AdminImagesController::class, 'storeImage'])->name('admin.rooms.store');
    Route::post('/admin/rooms/{id}/remove', [AdminImagesController::class, 'deleteImage'])->name('admin.rooms.remove');
});

Route::middleware(['auth', 'role:admin,owner'])->group(function () {
    Route::get('/admin/bookings', [AdminBookingsController::class, 'AdminBooking'])->name('admin.booking');
    Route::get('/admin/bookings/{id}', [AdminBookingsController::class, 'getBooking'])->name('admin.booking.get');
    Route::put('/admin/bookings/{id}', [AdminBookingsController::class, 'updateBooking'])->name('admin.booking.update');
    Route::delete('/admin/bookings/{id}', [AdminBookingsController::class, 'deleteBooking'])->name('admin.booking.destroy');
    Route::get('/admin/bookings/pending', [AdminBookingsController::class, 'peddingBooking'])->name('admin.booking.pending');
    Route::get('/admin/bookings/approved', [AdminBookingsController::class, 'approvedBooking'])->name('admin.booking.approved');
    Route::get('/admin/bookings/rejected', [AdminBookingsController::class, 'rejectedBooking'])->name('admin.booking.rejected');
});

Route::post('/switch-account', 'UserController@switchAccount')->middleware('role:admin,owner');
Route::get('/register', [UserController::class, 'showForm'])->name('register');
Route::post('/register', [UserController::class, 'store'])->name('user.store');

Route::get('/login', [UserController::class, 'showLoginForm'])->name('login');
Route::post('/login', [UserController::class, 'login'])->name('login.post');

Route::post('/logout', [UserController::class, 'logout'])->name('logout');

Route::get('/forgot-password', [UserController::class, 'showForgotPasswordForm'])->name('forgot.password');
Route::post('/forgot-password', [UserController::class, 'submitForgotPasswordForm'])->name('forgot.password.post');

Route::get('/verify-otp', [UserController::class, 'showOtpForm'])->name('verify.otp.form');
Route::post('/verify-otp', [UserController::class, 'verifyOtp'])->name('verify.otp');

Route::get('/resend-otp', [UserController::class, 'resendOtp'])->name('resend.otp');

Route::get('/reset-password', [UserController::class, 'showResetPasswordForm'])->name('reset.password');
Route::post('/reset-password', [UserController::class, 'resetPassword'])->name('reset.password.post');

Route::get('/profile', [UserController::class, 'showProfile'])->name('profile');
Route::post('/profile', [UserController::class, 'updateProfile'])->name('profile.post');

Route::get('/room/{id}', [FrontRoomController::class, 'getRoom'])->name('room.room');

Route::get('/booking', [FrontBookingController::class, 'viewBooking'])->name('booking.view');
Route::post('/booking/method', [FrontBookingController::class, 'paymentMethod'])->name('booking.method');
Route::get('/payment/vnpay', [PaymentController::class, 'vnpayPayment'])->name('payment.vnpay');
Route::get('/payment/paypal', [PaypalController::class, 'paypalPayment'])->name('payment.paypal');
Route::get('/booking/checkout-return', [PaymentController::class, 'checkoutReturn'])->name('payment.return');
Route::get('/booking/booking-content', [PaymentController::class, 'sendEmailBooking'])->name('payment.content');
Route::get('paypal/return', [PaypalController::class, 'paypalReturn'])->name('paypal.return');
Route::get('paypal/cancel', [PaypalController::class, 'paypalCancel'])->name('paypal.cancel');


Route::get('/contact', [HomepageController::class, 'contact'])->name('contact');
Route::post('/contact', [HomepageController::class, 'sendMail']);
Route::get('/contact/contact-return', [HomepageController::class, 'contactReturn'])->name('contact.contact-return');

Route::get('/auth/google', [GoogleCalendarController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/auth/google/callback', [GoogleCalendarController::class, 'handleGoogleCallback'])->name('google.callback');
Route::get('/calendar/event/create', [GoogleCalendarController::class, 'createEvent'])->name('calendar.createEvent');


Route::post('/set-currency', [App\Http\Controllers\CurrencyController::class, 'setCurrency'])->name('set.currency');


Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/certificates', [AdminCertificatesController::class, 'index'])->name('admin.certificates');
    Route::post('/certificates/{id}/accept', [AdminCertificatesController::class, 'accept'])->name('admin.certificates.accept');
    Route::post('/certificates/{id}/reject', [AdminCertificatesController::class, 'reject'])->name('admin.certificates.reject');
});
