<?php

use App\Http\Controllers\admin\SettingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\RoleController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\FormElementController;
use App\Http\Controllers\admin\FormGroupController;
use App\Http\Controllers\admin\NewsletterController;
use App\Http\Controllers\admin\PageCategoryController;
use App\Http\Controllers\admin\PageController;
use App\Http\Controllers\admin\PermissionController;
use App\Http\Controllers\admin\PostCategoryController;
use App\Http\Controllers\admin\PostController;
use App\Http\Controllers\admin\TestimonialController;
use App\Http\Controllers\admin\UserManagementController;


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

//formgroups and formelements using resource route
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
    Route::get('/testimonial/show/{id}', [TestimonialController::class, 'show'])->name('admin.testimonial.show');
    Route::get('/testimonial/edit/{id}', [TestimonialController::class, 'edit'])->name('admin.testimonial.edit');
    Route::put('/testimonial/{id}', [TestimonialController::class, 'update'])->name('admin.testimonial.update');
    Route::delete('/testimonial/{id}', [TestimonialController::class, 'destroy'])->name('admin.testimonial.destroy');
    Route::delete('/testimonial', [TestimonialController::class, 'destroyAll'])->name('admin.testimonial.destroyall');

    //Newsletter
    Route::get('/newsletter', [NewsletterController::class, 'index'])->name('admin.newsletter.index');
    Route::get('/newsletter/create', [NewsletterController::class, 'create'])->name('admin.newsletter.create');
    Route::post('/newsletter', [NewsletterController::class, 'store'])->name('admin.newsletter.store');
    Route::get('/newsletter/show/{id}', [NewsletterController::class, 'show'])->name('admin.newsletter.show');
    Route::get('/newsletter/edit/{id}', [NewsletterController::class, 'edit'])->name('admin.newsletter.edit');
    Route::put('/newsletter/{id}', [NewsletterController::class, 'update'])->name('admin.newsletter.update');
    Route::delete('/newsletter/{id}', [NewsletterController::class, 'destroy'])->name('admin.newsletter.destroy');
    Route::delete('/newsletter', [NewsletterController::class, 'destroyAll'])->name('admin.newsletter.destroyall');
    Route::get('/newsletter/export', [NewsletterController::class, 'export'])->name('admin.newsletter.export');

    //Page Category
    Route::get('/page-category', [PageCategoryController::class, 'index'])->name('admin.page-category.index');
    Route::get('/page-category/create', [PageCategoryController::class, 'create'])->name('admin.page-category.create');
    Route::post('/page-category', [PageCategoryController::class, 'store'])->name('admin.page-category.store');
    Route::get('/page-category/show/{id}', [PageCategoryController::class, 'show'])->name('admin.page-category.show');
    Route::get('/page-category/edit/{id}', [PageCategoryController::class, 'edit'])->name('admin.page-category.edit');
    Route::put('/page-category/{id}', [PageCategoryController::class, 'update'])->name('admin.page-category.update');
    Route::delete('/page-category/{id}', [PageCategoryController::class, 'destroy'])->name('admin.page-category.destroy');
    Route::delete('/page-category', [PageCategoryController::class, 'destroyAll'])->name('admin.page-category.destroyall');

    //Page
    Route::get('/page', [PageController::class, 'index'])->name('admin.page.index');
    Route::get('/page/create', [PageController::class, 'create'])->name('admin.page.create');
    Route::post('/page', [PageController::class, 'store'])->name('admin.page.store');
    Route::get('/page/show/{id}', [PageController::class, 'show'])->name('admin.page.show');
    Route::get('/page/edit/{id}', [PageController::class, 'edit'])->name('admin.page.edit');
    Route::put('/page/{id}', [PageController::class, 'update'])->name('admin.page.update');
    Route::delete('/page/{id}', [PageController::class, 'destroy'])->name('admin.page.destroy');
    Route::delete('/page', [PageController::class, 'destroyAll'])->name('admin.page.destroyall');

    //Post Categories
    Route::get('/post-category', [PostCategoryController::class, 'index'])->name('admin.post-category.index');
    Route::get('/post-category/create', [PostCategoryController::class, 'create'])->name('admin.post-category.create');
    Route::post('/post-category', [PostCategoryController::class, 'store'])->name('admin.post-category.store');
    Route::get('/post-category/show/{id}', [PostCategoryController::class, 'show'])->name('admin.post-category.show');
    Route::get('/post-category/edit/{id}', [PostCategoryController::class, 'edit'])->name('admin.post-category.edit');
    Route::put('/post-category/{id}', [PostCategoryController::class, 'update'])->name('admin.post-category.update');
    Route::delete('/post-category/{id}', [PostCategoryController::class, 'destroy'])->name('admin.post-category.destroy');
    Route::delete('/post-category', [PostCategoryController::class, 'destroyAll'])->name('admin.post-category.destroyall');

    //Post
    Route::get('/post', [PostController::class, 'index'])->name('admin.post.index');
    Route::get('/post/create', [PostController::class, 'create'])->name('admin.post.create');
    Route::post('/post', [PostController::class, 'store'])->name('admin.post.store');
    Route::get('/post/show/{slug}', [PostController::class, 'show'])->name('admin.post.show');
    Route::get('/post/edit/{slug}', [PostController::class, 'edit'])->name('admin.post.edit');
    Route::put('/post/{slug}', [PostController::class, 'update'])->name('admin.post.update');
    Route::delete('/post/{slug}', [PostController::class, 'destroy'])->name('admin.post.destroy');
    Route::delete('/post', [PostController::class, 'destroyAll'])->name('admin.post.destroyall');

    //Setting
    Route::get('/setting', [SettingController::class, 'index'])->name('admin.setting.index');
    Route::get('/setting/create', [SettingController::class, 'create'])->name('admin.setting.create');
    Route::post('/setting', [SettingController::class, 'store'])->name('admin.setting.store');
    Route::get('/setting/show/{id}', [SettingController::class, 'show'])->name('admin.setting.show');
    Route::get('/setting/edit/{id}', [SettingController::class, 'edit'])->name('admin.setting.edit');
    Route::put('/setting/{id}', [SettingController::class, 'update'])->name('admin.setting.update');
    Route::delete('/setting/{id}', [SettingController::class, 'destroy'])->name('admin.setting.destroy');

});
