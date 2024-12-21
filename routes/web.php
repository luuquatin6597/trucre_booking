<?php
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminRoomsController;
use App\Http\Controllers\AdminUsersController;
use App\Http\Controllers\AdminBuildingsController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\BuildingController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

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
});

Route::middleware(['auth', 'role:admin,owner'])->group(function () {
    Route::get('/owner', [OwnerController::class, 'OwnerDashboard'])->name('owner.dashboard');
    Route::get('/admin/owner/autocomplete', [OwnerController::class, 'Autocomplete'])->name('owner.autocomplete');
});

Route::middleware(['auth', 'role:admin,owner'])->group(function () {
    Route::get('/admin/rooms', [AdminRoomsController::class, 'AdminRooms'])->name('admin.rooms');
    Route::get('/admin/rooms/{id}', [AdminRoomsController::class, 'getRoom'])->name('admin.rooms.get');
    Route::post('/admin/rooms/add', [AdminRoomsController::class, 'addRoom'])->name('admin.rooms.add');
    Route::put('/admin/rooms/{id}', [AdminRoomsController::class, 'updateRoom'])->name('admin.rooms.update');
    Route::delete('/admin/rooms/{id}', [AdminRoomsController::class, 'deleteRoom'])->name('admin.rooms.destroy');
});

Route::get('/search', [AdminBuildingsController::class, 'search'])->name('search');
