<?php

use App\Http\Controllers\Dashboard;
use App\Http\Controllers\PolicyController;
use App\Http\Controllers\ProductColorController;
use App\Http\Controllers\ProductsCategoryController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ProductSizeController;
use App\Http\Controllers\ProductSizeGuideController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\WebsiteInformationController;

Route::prefix('panel')->middleware('auth')->group(function () {
    Route::get('dashboard', [Dashboard::class, 'index'])->name('dashboard');


// Products
    Route::prefix('products')->group(function () {

// Categories
        Route::get('categories', [ProductsCategoryController::class, 'index'])->name('products.categories.index');
        Route::post('category/store', [ProductsCategoryController::class, 'store'])->name('products.category.store');
        Route::patch('category/update', [ProductsCategoryController::class, 'update'])->name('products.category.update');
        Route::delete('category/delete', [ProductsCategoryController::class, 'destroy'])->name('products.category.delete');

// Sub Categories
        Route::get('sub-categories', [ProductsCategoryController::class, 'subCategoriesIndex'])->name('products.sub.categories.index');
        Route::post('sub-category/store', [ProductsCategoryController::class, 'subCategoryStore'])->name('products.sub.category.store');
        Route::patch('sub-category/update', [ProductsCategoryController::class, 'updateSubCategory'])->name('products.sub.category.update');


// Products
        Route::get('manage', [ProductsController::class, 'index'])->name('products.index');
        Route::get('create', [ProductsController::class, 'create'])->name('products.create');
        Route::post('store', [ProductsController::class, 'store'])->name('products.store');
        Route::get('edit/{product_code}', [ProductsController::class, 'edit'])->name('products.edit');
        Route::patch('product/update', [ProductsController::class, 'update'])->name('products.update');
        Route::delete('product/delete', [ProductsController::class, 'destroy'])->name('products.delete');
        Route::delete('product/{productId}/variant/media', [ProductsController::class, 'deleteVariantMedia'])->name('products.variant.media.delete');


// Stock Management
        Route::get('manage/stock', [ProductsController::class, 'stockIndex'])->name('products.stock.index');
        Route::get('manage/stock/{product_code}', [ProductsController::class, 'stockEdit'])->name('products.stock.edit');
        Route::patch('manage/stock/update', [ProductsController::class, 'updateStock'])->name('products.stock.update');
    });

    Route::prefix('attributes')->group(function () {
// colors
        Route::get('colors', [ProductColorController::class, 'index'])->name('attributes.colors.index');
        Route::post('color/store', [ProductColorController::class, 'store'])->name('attributes.color.store');
        Route::patch('color/update', [ProductColorController::class, 'update'])->name('attributes.color.update');
        Route::delete('color/delete', [ProductColorController::class, 'destroy'])->name('attributes.color.delete');

// size
        Route::get('sizes', [ProductSizeController::class, 'index'])->name('attributes.size.index');
        Route::post('size/store', [ProductSizeController::class, 'store'])->name('attributes.size.store');
        Route::patch('size/update', [ProductSizeController::class, 'update'])->name('attributes.size.update');
        Route::delete('size/delete', [ProductSizeController::class, 'destroy'])->name('attributes.size.delete');

// size guides
        Route::get('size-guides', [ProductSizeGuideController::class, 'index'])->name('attributes.size.guide.index');
        Route::post('size-guide/store', [ProductSizeGuideController::class, 'store'])->name('attributes.size.guide.store');
        Route::patch('size-guide/update', [ProductSizeGuideController::class, 'update'])->name('attributes.size.guide.update');
        Route::delete('size-guide/delete', [ProductSizeGuideController::class, 'destroy'])->name('attributes.size.guide.delete');
    });

// users & customers
    Route::prefix('users')->group(function () {
        Route::get('/', [UsersController::class, 'index'])->name('users.index');
        Route::post('store', [UsersController::class, 'store'])->name('users.store');
        Route::delete('delete', [UsersController::class, 'destroy'])->name('users.delete');
        Route::get('edit/{email}', [UsersController::class, 'edit'])->name('users.edit');
        Route::patch('update', [UsersController::class, 'update'])->name('users.update');
    });

// Frontend Pages Content
    Route::prefix('pages')->group(function () {

// Policies
        Route::get('policies', [PolicyController::class, 'index'])->name('policies.index');
        Route::patch('privacy', [PolicyController::class, 'privacy'])->name('policies.privacy');
        Route::patch('refund', [PolicyController::class, 'refund'])->name('policies.refund');

// Terms
        Route::get('tos', [PolicyController::class, 'tos'])->name('tos.index');
        Route::patch('tos/update', [PolicyController::class, 'tosUpdate'])->name('tos.update');

// Website Information
        Route::get('info-settings', [WebsiteInformationController::class, 'index'])->name('info.index');
        Route::put('basic-info/update', [WebsiteInformationController::class, 'basicInfo'])->name('basic.info.update');
        Route::put('social-media/update', [WebsiteInformationController::class, 'socialMedia'])->name('social.media.update');
        Route::put('seo-info/update', [WebsiteInformationController::class, 'seo'])->name('seo.info.update');
        Route::put('code-injector/update', [WebsiteInformationController::class, 'injector'])->name('injector.update');
    });


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
