<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryProductController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/trang-chu', [HomeController::class, 'index'])->name('home.trangchu');
Route::get('/sanpham/{id}', [HomeController::class, 'showproduct'])->name('home.sanpham');
Route::get('/sanpham/{product_id}/detail/{detail_id}', [HomeController::class, 'showdetail'])->name('home.detail');
Route::get('/search', [HomeController::class, 'search'])->name('search');
Route::get('/allproduct', [HomeController::class, 'listproduct'])->name('home.product');

//user
Route::get('/userlogin', [HomeController::class, 'login'])->name('user.login');
Route::get('/userloginpage', [HomeController::class, 'loginpage'])->name('user.loginpage');
Route::get('/userlogout', [HomeController::class, 'logout'])->name('user.logout');
Route::get('/user/profile', [HomeController::class, 'profile'])->name('user.profile')->middleware('auth.check');
Route::get('/user/order', [HomeController::class, 'listorder'])->name('user.order')->middleware('auth.check');
Route::get('/user/order/{OrderID}', [HomeController::class, 'detailorder'])->name('user.detail')->middleware('auth.check');
Route::post('/userregisterpage', [HomeController::class, 'register'])->name('user.register');
Route::get('/userregisterpage', [HomeController::class, 'trangdangki'])->name('user.registerpage');
Route::post('/userverification', [HomeController::class, 'verification'])->name('user.verification');
Route::get('/userforget', [HomeController::class, 'forgetpage'])->name('user.forget');
Route::post('/userforget', [HomeController::class, 'forgetsendmail'])->name('user.forget');
Route::get('/userforgetverification', [HomeController::class, 'forgetverification'])->name('user.forgetverification');
Route::post('/userforgetverification', [HomeController::class, 'xacnhanma'])->name('user.forgetverification');


// cart 
Route::post('/add-to-cart', [HomeController::class, 'addToCart'])->name('cart.add');
Route::get('/delete-cart/{id}', [HomeController::class, 'deleteCart'])->name('cart.delete');
Route::get('/indexcart', [HomeController::class, 'shoppingcart'])->name('cart.page')->middleware('auth.check');

Route::post('/cart/update', [HomeController::class, 'update_cart'])->name('cart.update');
Route::post('/checkout', [HomeController::class, 'checkout'])->name('cart.checkout')->middleware('auth.check');

// Admin 
Route::get('/admin', [AdminController::class, 'index'])->name('admin.login');
Route::get('/dashboard', [AdminController::class, 'show_dashboard'])->name('admin.dashboard');
Route::post('/admin-dashboard', [AdminController::class, 'dashboard']);
Route::get('/logout', [AdminController::class, 'logout'])->name('admin.logout');

Route::get('/admin/discounts', [AdminController::class, 'listDiscounts'])->name('discounts.all');
Route::get('/admin/discounts/toggle/{DiscountID}', [AdminController::class, 'listDiscounts'])->name('discounts.toggle');
Route::get('/admin/discounts/delete/{DiscountID}', [AdminController::class, 'deleteDiscount'])->name('discounts.delete');
Route::get('/admin/discounts/add', [AdminController::class, 'addDiscount'])->name('discounts.add');
Route::post('/admin/discounts/add', [AdminController::class, 'storeDiscount'])->name('discounts.add');
Route::get('/admin/discounts/edit/{DiscountID}', [AdminController::class, 'editDiscount'])->name('discounts.edit');
Route::put('/admin/discounts/edit/{DiscountID}', [AdminController::class, 'updateDiscount'])->name('discounts.update');
// Category Product
Route::get('/add-category-product', [CategoryProductController::class, 'add_category_product'])->name('category.add');
Route::get('/all-category-product', [CategoryProductController::class, 'all_category_product'])->name('category.all')->middleware('redirect.role');
Route::post('/save-category-product', [CategoryProductController::class, 'save_category_product'])->name('category.save');
Route::post('/toggle-category-status', [CategoryProductController::class, 'toggleCategoryStatus'])->name('category.toggle');
Route::get('/edit-category/{id}', [CategoryProductController::class, 'editCategory'])->name('category.edit');
Route::post('/update-category/{id}', [CategoryProductController::class, 'updateCategory'])->name('category.update');
Route::post('/delete-category/{id}', [CategoryProductController::class, 'deleteCategory'])->name('category.delete');

// Brand Product
Route::get('/add-brand-product', [BrandController::class, 'addBrandProduct'])->name('brand.add');
Route::post('/save-brand-product', [BrandController::class, 'saveBrandProduct'])->name('brand.save');
Route::get('/all-brand-product', [BrandController::class, 'allBrandProduct'])->name('brand.all');
Route::get('/edit-brand-product/{id}', [BrandController::class, 'editBrandProduct'])->name('brand.edit');
Route::post('/update-brand-product/{id}', [BrandController::class, 'updateBrandProduct'])->name('brand.update');
Route::post('/delete-brand-product/{id}', [BrandController::class, 'deleteBrandProduct'])->name('brand.delete');
// Product

Route::prefix('products')->group(function () {
    // Lấy tất cả sản phẩm
    Route::get('/all', [ProductController::class, 'index'])->name('products.all');

    // Lấy thông tin chi tiết một sản phẩm
    Route::get('/get/{id}', [ProductController::class, 'edit'])->name('products.edit');
    Route::post('/get/{id}', [ProductController::class, 'save'])->name('products.save');

    // Route để thêm sản phẩm
    Route::get('/add', [ProductController::class, 'create'])->name('products.add');

    // Route để sửa thông tin sản phẩm
    Route::put('/{id}', [ProductController::class, 'update'])->name('products.update');
    Route::post('/store', [ProductController::class, 'store'])->name('products.store');
    // Route để xóa sản phẩm
    Route::delete('/delete/{id}', [ProductController::class, 'destroy'])->name('products.delete');
});
//order
Route::get('/all-order', [OrderController::class, 'showall'])->name('order.all');
Route::get('/all-order/{OrderID}', [OrderController::class, 'showdetail'])->name('order.details');
Route::put('/order/{orderId}/update', [OrderController::class, 'updateOrderStatus'])->name('order.update');
// Route::put('/order/{orderId}/', [OrderController::class, 'updateOrderStatus'])->name('order.update');

// Route::prefix('home_page',[Home])