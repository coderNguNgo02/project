<?php

use App\Http\Controllers\admin\CateController;
use App\Http\Controllers\admin\ProducCatetController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\ContentController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\IndexController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\customer\CartController;
use App\Http\Controllers\customer\HomeController;
use App\Http\Controllers\customer\ProductUserController;
use App\Http\Controllers\admin\OrderController;
use App\Http\Controllers\admin\OrderDetailController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Route::group(['middleware' => 'prevent-login-form'], function () {
    //route auth
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/xl_login', [LoginController::class, 'store'])->name('store');
});

Route::group(['middleware' => 'check-login'], function () {

    //route admin
    Route::prefix('/admin')->middleware('check-role')->group(function () {


        Route::get('/index', [IndexController::class, 'index'])->name('index_admin');
        Route::get('/account', [UserController::class, 'index'])->name('account_admin');
        Route::get('/category', [CateController::class, 'index'])->name('category_admin');
        Route::get('/product', [ProductController::class, 'index'])->name('product_admin');
        Route::get('/order', [OrderController::class, 'index'])->name('order_admin');
        Route::get('/content', [ContentController::class, 'index'])->name('content_admin');
        Route::get('/orderdetail/{id}', [OrderDetailController::class, 'index'])->name('orderd_detail_admin');
        Route::get('/orderdetail/delete/{id}', [OrderDetailController::class, 'delete'])->name('orderd_delete_admin');
        Route::get('/update-order/{id}', [OrderDetailController::class, 'showUpdateFormOrder'])->name('show_update_order');
        Route::post('/update-order/{id}', [OrderDetailController::class, 'updateOrder'])->name('update_order');



        Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
        Route::get('/productcate', [ProducCatetController::class, 'index'])->name('products.index');
        Route::post('/categories/{category}/products', [CategoryController::class, 'addProducts'])->name('categories.addProducts');
        Route::get('/categories/checkbox', [CategoryController::class, 'checkbox'])->name('categories.checkbox');
        Route::get('/categories/insert', [CategoryController::class, 'insert'])->name('categories.insert');
        Route::get('/categories/delete', [CategoryController::class, 'delete'])->name('categories.delete');

        //account
        Route::get('/account/create', [UserController::class, 'create'])->name('account_add');
        Route::post('/account/create', [UserController::class, 'store'])->name('store_account');
        Route::get('/account/edit/{id}', [UserController::class, 'edit'])->name('edit_account');
        Route::post('/account/edit/{id}', [UserController::class, 'update'])->name('update_account');
        Route::get('/account/delete/{id}', [UserController::class, 'destroy'])->name('delete_account');

        //category
        Route::get('/category/create', [CateController::class, 'create'])->name('create_category');
        Route::post('/category/create', [CateController::class, 'store'])->name('store_category');
        Route::get('/category/edit/{id}', [CateController::class, 'edit'])->name('edit_category');
        Route::post('/category/edit/{id}', [CateController::class, 'update'])->name('update_category');
        Route::get('/category/delete/{id}', [CateController::class, 'destroy'])->name('delete_category');

        //product
        Route::get('/product/create', [ProductController::class, 'create'])->name('create_product');
        Route::post('/product/kiem-tra-trung', [ProductController::class, 'kiemTraTrung'])->name('giays.kiem-tra-trung');
        Route::post('/product/create', [ProductController::class, 'store'])->name('store_product');
        Route::get('/product/edit/{id}', [ProductController::class, 'edit'])->name('edit_product');
        Route::post('/product/edit/{id}', [ProductController::class, 'update'])->name('update_product');
        Route::get('/product/delete/{id}', [ProductController::class, 'destroy'])->name('delete_product');
        Route::get('/product/detail/{id}', [ProductController::class, 'getDetailProduct'])->name('get_detail_prd');
        Route::get('/product/editdetail/{id_prd}/{id_size}', [ProductController::class, 'editProductDetail'])->name('edit_product_detail');
        Route::post('/product/editdetail/{id_prd}/{id_size}', [ProductController::class, 'updateProductDetail'])->name('update_product_detail');
        Route::get('/product/deletedetail/{id_prd}/{id_size}', [ProductController::class, 'destroyDetail'])->name('delete_product_detail');
    });

    //route user
    Route::prefix('/user')->middleware('check-role-user')->group(function () {

        Route::get('/index', [HomeController::class, 'index'])->name('index_user');
        Route::get('/product', [ProductUserController::class, 'index'])->name('product_customer');
        Route::get('/product/detail/{id}', [ProductUserController::class, 'detailAction'])->name('product_detail');
        Route::get('/cart', [CartController::class, 'index'])->name('cart_index');
        Route::post('/cart', [CartController::class, 'addToCart'])->name('cart_customer');
        Route::get('/cart/remove/{index}', [CartController::class, 'removeFromCart'])->name('cart_remove');
        Route::post('/oder', [CartController::class, 'order'])->name('order_cart');
        Route::get('/history', [CartController::class, 'getHistory'])->name('history_page');
        Route::get('/destroy-order/{id}', [CartController::class, 'destroyOrder'])->name('destroy_order');
        Route::get('/detail-order/{id}', [CartController::class, 'getDetailOrder'])->name('detail_order');
    });
});
