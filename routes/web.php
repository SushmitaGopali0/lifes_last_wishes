<?php

use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\RoleController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\NewsletterController;
use App\Http\Controllers\admin\TestimonialController;
use App\Http\Controllers\admin\UserManagementController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('login');
});



Route::prefix('/admin')->group(function(){
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.index');

    //users and roles
    Route::resource('allusers', UserController::class)->names('users');
    Route::resource('allroles', RoleController::class)->names('roles');

    //Testimonials
    Route::get('/testimonial', [TestimonialController::class, 'index'])->name('admin.testimonial.index');
    Route::get('/testimonial/create', [TestimonialController::class, 'create'])->name('admin.testimonial.create');
    Route::post('/testimonial', [TestimonialController::class, 'store'])->name('admin.testimonial.store');
    Route::get('/testimonial/show/{id}', [TestimonialController::class, 'show'])->name('admin.testimonial.show');
    Route::get('/testimonial/edit/{id}', [TestimonialController::class, 'edit'])->name('admin.testimonial.edit');
    Route::put('/testimonial/{id}', [TestimonialController::class, 'update'])->name('admin.testimonial.update');
    Route::delete('/testimonial/{id}', [TestimonialController::class, 'destroy'])->name('admin.testimonial.destroy');

    //Newsletter
    Route::get('/newsletter', [NewsletterController::class, 'index'])->name('admin.newsletter.index');
    Route::get('/newsletter/create', [NewsletterController::class, 'create'])->name('admin.newsletter.create');
    Route::post('/newsletter', [NewsletterController::class, 'store'])->name('admin.newsletter.store');
    Route::get('/newsletter/show/{id}', [NewsletterController::class, 'show'])->name('admin.newsletter.show');
    Route::get('/newsletter/edit/{id}', [NewsletterController::class, 'edit'])->name('admin.newsletter.edit');
    Route::put('/newsletter/{id}', [NewsletterController::class, 'update'])->name('admin.newsletter.update');
    Route::delete('/newsletter/{id}', [NewsletterController::class, 'destroy'])->name('admin.newsletter.destroy');

    // //User management
    // Route::get('/user-management', [UserManagementController::class, 'index'])->name('admin.user-management.index');
    // Route::get('/user-management/create', [UserManagementController::class, 'create'])->name('admin.user-management.create');
    // Route::post('/user-management', [UserManagementController::class, 'store'])->name('admin.user-management.store');
    // Route::get('/user-management/edit/{id}', [UserManagementController::class, 'edit'])->name('admin.user-management.edit');
    // Route::put('/user-management/{id}', [UserManagementController::class, 'update'])->name('admin.user-management.update');
    // Route::delete('/user-management/{id}', [UserManagementController::class, 'destroy'])->name('admin.user-management.destroy');
});
