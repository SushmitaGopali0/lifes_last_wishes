<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\RoleController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\FormGroupController;
use App\Http\Controllers\admin\NewsletterController;
use App\Http\Controllers\admin\PermissionController;
use App\Http\Controllers\admin\FormElementController;
use App\Http\Controllers\admin\TestimonialController;


Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', function () {
    return view('login');
});


//users, roles, and permissions using resource route
Route::prefix('/admin')->group(function(){
Route::resource('allusers', UserController::class)->names('users');
Route::resource('allroles', RoleController::class)->names('roles');
Route::resource('allpermissions', PermissionController::class)->names('permissions');
Route::resource('allformgroups', FormGroupController::class)->names('formgroups');
Route::get('/formgroups/{formgroup}/customize', [FormGroupController::class, 'customize'])->name('formgroups.customize');
Route::resource('allformelements', FormElementController::class)->names('formelements');

});

   Route::prefix('/admin')->group(function(){
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.index');

    //Testimonials
    Route::get('/testimonial', [TestimonialController::class, 'index'])->name('admin.testimonial.index');
    Route::get('/testimonial/create', [TestimonialController::class, 'create'])->name('admin.testimonial.create');
    Route::post('/testimonial', [TestimonialController::class, 'store'])->name('admin.testimonial.store');
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


});