<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientRoutes;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\RolesController;

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
    Route::get('roles', [RolesController::class, 'rolesIndex'])->name('roles.index');
    Route::get('groups', [RolesController::class, 'groupsIndex'])->name('groups.index');
    Route::get('permissions', [RolesController::class, 'permissionsIndex'])->name('permissions.index');

    // group post
    Route::post('group/store', [RolesController::class, 'groupStore'])->name('group.store');
    Route::patch('group/update/{id}', [RolesController::class, 'groupUpdate'])->name('group.update');
    Route::delete('group/delete', [RolesController::class, 'groupDelete'])->name('group.delete');

    // permission post
    Route::post('permission/store', [RolesController::class, 'permissionStore'])->name('permission.store');
    Route::patch('permission/update', [RolesController::class, 'permissionUpdate'])->name('permission.update');
    Route::delete('permission/delete', [RolesController::class, 'permissionDelete'])->name('permission.delete');

    // role post
    Route::get('role/create', [RolesController::class, 'roleCreate'])->name('role.create');
    Route::post('role/store', [RolesController::class, 'roleStore'])->name('role.store');
    Route::get('role/edit/{name}', [RolesController::class, 'roleEdit'])->name('role.edit');
    Route::patch('role/update', [RolesController::class, 'roleUpdate'])->name('role.update');
    Route::delete('role/delete', [RolesController::class, 'roleDelete'])->name('role.delete');
});
