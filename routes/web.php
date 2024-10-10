<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientRoutes;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ProductsCategoryController;


Route::controller(ClientRoutes::class)->group(function () {
    Route::get('/', 'home')->name('home');
    Route::get('shop', 'shop')->name('shop');
    Route::get('product', 'productDetails')->name('productDetails');
    Route::get('contact', 'contact')->name('contact');
    Route::get('about', 'about')->name('about');
    //    Route::get('blog', 'blog')->name('blog');
    Route::get('cart', 'cart')->name('cart');
    Route::get('checkout', 'checkout')->name('checkout');
    Route::get('wishlist', 'wishlist')->name('wishlist');
    Route::get('login', 'login')->name('login-client');
    Route::get('register', 'register')->name('register');
});

Route::prefix('panel')->middleware('auth')->group(function () {
    Route::get('dashboard', [Dashboard::class, 'index'])->name('dashboard');


    // Products
    Route::prefix('products')->group(function () {

        // Categories
        Route::get('categories', [ProductsCategoryController::class, 'index'])->name('products.categories.index');
        Route::post('store', [ProductsCategoryController::class, 'store'])->name('products.category.store');
        Route::delete('delete', [ProductsCategoryController::class, 'destroy'])->name('products.category.delete');

    });




    // users & customers
    Route::get('users', [UsersController::class, 'index'])->name('users.index');
    Route::post('users/store', [UsersController::class, 'store'])->name('users.store');
    Route::delete('users/delete', [UsersController::class, 'destroy'])->name('users.delete');
    Route::get('users/edit/{email}', [UsersController::class, 'edit'])->name('users.edit');
    Route::patch('users/update', [UsersController::class, 'update'])->name('users.update');

    // group post
    Route::get('groups', [RolesController::class, 'groupsIndex'])->name('groups.index');
    Route::post('group/store', [RolesController::class, 'groupStore'])->name('group.store');
    Route::patch('group/update/{id}', [RolesController::class, 'groupUpdate'])->name('group.update');
    Route::delete('group/delete', [RolesController::class, 'groupDelete'])->name('group.delete');

    // permission post
    Route::get('permissions', [RolesController::class, 'permissionsIndex'])->name('permissions.index');
    Route::post('permission/store', [RolesController::class, 'permissionStore'])->name('permission.store');
    Route::patch('permission/update', [RolesController::class, 'permissionUpdate'])->name('permission.update');
    Route::delete('permission/delete', [RolesController::class, 'permissionDelete'])->name('permission.delete');

    // role post
    Route::get('roles', [RolesController::class, 'rolesIndex'])->name('roles.index');
    Route::get('role/create', [RolesController::class, 'roleCreate'])->name('role.create');
    Route::post('role/store', [RolesController::class, 'roleStore'])->name('role.store');
    Route::get('role/edit/{name}', [RolesController::class, 'roleEdit'])->name('role.edit');
    Route::patch('role/update', [RolesController::class, 'roleUpdate'])->name('role.update');
    Route::delete('role/delete', [RolesController::class, 'roleDelete'])->name('role.delete');
});
