<?php
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminRoomsController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\BuildingController;


use App\Models\User;
use Illuminate\Support\Facades\Route;


// Route::get('/', function () {
//     return view('homepage.homepage');
// })->name('homepage');

Route::get('/homepage', [HomepageController::class, 'index'])->name('homepage');

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
    Route::get('/admin/users', [AdminController::class, 'AdminUsers'])->name('admin.users');
    Route::post('/admin/users/add', [AdminController::class, 'addUser'])->name('admin.users.add');
    Route::put('/admin/users/{id}', [AdminController::class, 'updateUser'])->name('admin.users.update');
    Route::delete('/admin/users/{id}', [AdminController::class, 'deleteUser'])->name('admin.users.destroy');
    Route::get('/admin/typeaccount', [AdminController::class, 'AdminTypeAccount'])->name('admin.typeaccount');
    Route::get('/admin.owner.buildings', [AdminController::class, 'Bview'])->name('admin.owner-buildings');
    Route::post('/admin/buildings/add', [AdminController::class, 'addBuilding'])->name('admin.buildings.add');
    Route::put('/admin/buildings/{id}', [AdminController::class, 'updateBuilding'])->name('admin.buildings.update');
    Route::delete('/admin/buildings/{id}', [AdminController::class, 'deleteBuilding'])->name('admin.buildings.destroy');
    Route::get('/admin/rooms', [AdminRoomsController::class, 'AdminRooms'])->name('admin.rooms');
});

Route::middleware(['auth', 'role:owner'])->group(function () {
    Route::get('/owner', [OwnerController::class, 'OwnerDashboard'])->name('owner.dashboard');
});

