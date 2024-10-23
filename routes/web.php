<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\ThumbnailController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    
    /** ROLE */
    Route::prefix('role')->group(function () {
        Route::name('role.')->group(function () {
            Route::controller(RoleController::class)->group(function(){
                Route::get('/', 'index')->name('index')->middleware('role_or_permission:superadmin|view role');
                Route::post('/', 'create')->name('create')->middleware('role_or_permission:superadmin|create role');
                Route::post('/{id}/edit', 'edit')->name('edit')->middleware('role_or_permission:superadmin|edit role');
                Route::put('/{id}/edit', 'update')->name('update')->middleware('role_or_permission:superadmin|edit role');
                Route::delete('/{id}/delete', 'destroy')->name('delete')->middleware('role_or_permission:superadmin|delete role');
                
                Route::get('/{id}/permission', 'permission')->name('permission')->middleware('role_or_permission:superadmin|view role');
                Route::put('/{id}/permission', 'updatePermission')->name('permission.update')->middleware('role_or_permission:superadmin|edit role');
            });
        });
    });
    
    /** USER */
    Route::prefix('user')->group(function () {
        Route::name('user.')->group(function () {
            Route::controller(UserController::class)->group(function(){
                Route::get('/', 'index')->name('index')->middleware('role_or_permission:superadmin|view user');
                Route::post('/', 'create')->name('create')->middleware('role_or_permission:superadmin|create user');
                Route::post('/{id}/edit', 'edit')->name('edit')->middleware('role_or_permission:superadmin|edit user');
                Route::put('/{id}/edit', 'update')->name('update')->middleware('role_or_permission:superadmin|edit user');
                Route::delete('/{id}/delete', 'destroy')->name('delete')->middleware('role_or_permission:superadmin|delete user');
            });
        });
    });

    /** SETTING */
    Route::prefix('settings')->group(function () {
        Route::name('setting.')->group(function () {
            
            /** ACCOUNT SETTING */
            Route::controller(SettingController::class)->group(function(){
                Route::get('/account', 'account')->name('account');
                Route::post('/account/update', 'updateAccount')->name('account.update');
            });
        });
    });
});

require __DIR__.'/auth.php';