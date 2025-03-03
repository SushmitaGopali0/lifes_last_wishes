<?php

use App\Http\Controllers\admin\CouponController;
use App\Http\Controllers\admin\SettingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\RoleController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\FormElementController;
use App\Http\Controllers\admin\FormGroupController;
use App\Http\Controllers\admin\NewsletterController;
use App\Http\Controllers\admin\NewsletterSettingController;
use App\Http\Controllers\admin\PageCategoryController;
use App\Http\Controllers\admin\PageController;
use App\Http\Controllers\admin\PageSettingController;
use App\Http\Controllers\admin\PermissionController;
use App\Http\Controllers\admin\PlanController;
use App\Http\Controllers\admin\PostCategoryController;
use App\Http\Controllers\admin\PostController;
use App\Http\Controllers\admin\SubscriptionSettingController;
use App\Http\Controllers\admin\TestimonialController;
use App\Http\Controllers\admin\TestimonialSettingController;
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
    Route::get('/customized-testimonial/create', [TestimonialController::class, 'createCustomized'])->name('admin.customized-testimonial.create');
    Route::post('/testimonial', [TestimonialController::class, 'store'])->name('admin.testimonial.store');
    Route::post('/customized-testimonial', [TestimonialController::class, 'storeCustomized'])->name('admin.customized-testimonial.store');
    Route::get('/testimonial/show/{id}', [TestimonialController::class, 'show'])->name('admin.testimonial.show');
    Route::get('/customized-testimonial/show/{id}', [TestimonialController::class, 'showCustomized'])->name('admin.customized-testimonial.show');
    Route::get('/testimonial/edit/{id}', [TestimonialController::class, 'edit'])->name('admin.testimonial.edit');
    Route::get('/customized-testimonial/edit/{id}', [TestimonialController::class, 'editCustomized'])->name('admin.customized-testimonial.edit');
    Route::put('/testimonial/{id}', [TestimonialController::class, 'update'])->name('admin.testimonial.update');
    Route::put('/customized-testimonial/{id}', [TestimonialController::class, 'updateCustomized'])->name('admin.customized-testimonial.update');
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
    Route::post('/setting', [SettingController::class, 'store'])->name('admin.setting.store');
    Route::put('/setting', [SettingController::class, 'update'])->name('admin.setting.update');
    Route::delete('/setting/{id}', [SettingController::class, 'destroy'])->name('admin.setting.destroy');

    //Testimonial Setting
    Route::get('/testimonial-setting', [TestimonialSettingController::class, 'index'])->name('admin.testimonial-setting.index');
    Route::post('/testimonial-setting', [TestimonialSettingController::class, 'store'])->name('admin.testimonial-setting.store');
    Route::put('/testimonial-setting', [TestimonialSettingController::class, 'update'])->name('admin.testimonial-setting.update');
    Route::delete('/testimonial-setting/{id}', [TestimonialSettingController::class, 'destroy'])->name('admin.testimonial-setting.destroy');

    //Newsletter Setting
    Route::get('/newsletter-setting', [NewsletterSettingController::class, 'index'])->name('admin.newsletter-setting.index');
    Route::post('/newsletter-setting', [NewsletterSettingController::class, 'store'])->name('admin.newsletter-setting.store');
    Route::put('/newsletter-setting', [NewsletterSettingController::class, 'update'])->name('admin.newsletter-setting.update');
    Route::delete('/newsletter-setting/{id}', [NewsletterSettingController::class, 'destroy'])->name('admin.newsletter-setting.destroy');

    //Page Setting
    Route::get('/page-setting', [PageSettingController::class, 'index'])->name('admin.page-setting.index');
    Route::post('/page-setting', [PageSettingController::class, 'store'])->name('admin.page-setting.store');
    Route::put('/page-setting', [PageSettingController::class, 'update'])->name('admin.page-setting.update');
    Route::delete('/page-setting/{id}', [PageSettingController::class, 'destroy'])->name('admin.page-setting.destroy');

    //Subscription Setting
    Route::get('/subscription-setting', [SubscriptionSettingController::class, 'index'])->name('admin.subscription-setting.index');
    Route::post('/subscription-setting', [SubscriptionSettingController::class, 'store'])->name('admin.subscription-setting.store');
    Route::put('/subscription-setting', [SubscriptionSettingController::class, 'update'])->name('admin.subscription-setting.update');
    Route::delete('/subscription-setting/{id}', [SubscriptionSettingController::class, 'destroy'])->name('admin.subscription-setting.destroy');

    //Coupon
    Route::get('/coupon', [CouponController::class, 'index'])->name('admin.coupon.index');
    Route::get('/coupon/create', [CouponController::class, 'create'])->name('admin.coupon.create');
    Route::post('/coupon', [CouponController::class, 'store'])->name('admin.coupon.store');
    Route::get('/coupon/show/{id}', [CouponController::class, 'show'])->name('admin.coupon.show');
    Route::get('/coupon/edit/{id}', [CouponController::class, 'edit'])->name('admin.coupon.edit');
    Route::put('/coupon/{id}', [CouponController::class, 'update'])->name('admin.coupon.update');
    Route::delete('/coupon/{id}', [CouponController::class, 'destroy'])->name('admin.coupon.destroy');
    Route::delete('/coupon', [CouponController::class, 'destroyAll'])->name('admin.coupon.destroyall');

    //Plan
    Route::get('/plan', [PlanController::class, 'index'])->name('admin.plan.index');
    Route::get('/plan/create', [PlanController::class, 'create'])->name('admin.plan.create');
    Route::post('/plan', [PlanController::class, 'store'])->name('admin.plan.store');
    Route::get('/plan/show/{id}', [PlanController::class, 'show'])->name('admin.plan.show');
    Route::get('/plan/edit/{id}', [PlanController::class, 'edit'])->name('admin.plan.edit');
    Route::put('/plan/{id}', [PlanController::class, 'update'])->name('admin.plan.update');
    Route::delete('/plan/{id}', [PlanController::class, 'destroy'])->name('admin.plan.destroy');
    Route::delete('/plan', [PlanController::class, 'destroyAll'])->name('admin.plan.destroyall');
});
