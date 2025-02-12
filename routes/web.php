<?php

use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\TestimonialController;
use App\Http\Controllers\admin\UserManagementController;
use App\Http\Controllers\PermissionController;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', function () {
    return view('login');
});

//users, roles, and permissions
Route::resource('allusers', UserController::class)->names('users');
Route::resource('allroles', RoleController::class)->names('roles');
Route::resource('allpermissions', PermissionController::class)->names('permissions');


   Route::prefix('/admin')->group(function(){
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.index');

    //Testimonials
    Route::get('/testimonial', [TestimonialController::class, 'index'])->name('admin.testimonial.index');
    Route::get('/testimonial/create', [TestimonialController::class, 'create'])->name('admin.testimonial.create');
    Route::post('/testimonial', [TestimonialController::class, 'store'])->name('admin.testimonial.store');
    Route::get('/testimonial/edit/{id}', [TestimonialController::class, 'edit'])->name('admin.testimonial.edit');
    Route::put('/testimonial/{id}', [TestimonialController::class, 'update'])->name('admin.testimonial.update');
    Route::delete('/testimonial/{id}', [TestimonialController::class, 'destroy'])->name('admin.testimonial.destroy');

    //User management
    Route::get('/user-management', [UserManagementController::class, 'index'])->name('admin.user-management.index');
    Route::get('/user-management/create', [UserManagementController::class, 'create'])->name('admin.user-management.create');
    Route::post('/user-management', [UserManagementController::class, 'store'])->name('admin.user-management.store');
    Route::get('/user-management/edit/{id}', [UserManagementController::class, 'edit'])->name('admin.user-management.edit');
    Route::put('/user-management/{id}', [UserManagementController::class, 'update'])->name('admin.user-management.update');
    Route::delete('/user-management/{id}', [UserManagementController::class, 'destroy'])->name('admin.user-management.destroy');
});
