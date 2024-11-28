<?php

use App\Http\Controllers\ApprovalPeminjamanController;
use App\Http\Controllers\ApprovalPengajuanController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MatakuliahController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PengajuanController;
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

/** BARANG */
Route::prefix('barang')->group(function () {
    Route::name('barang.')->group(function () {
        Route::controller(BarangController::class)->group(function(){
            Route::get('/', 'index')->name('index')->middleware('role_or_permission:superadmin|view barang');
            Route::post('/', 'create')->name('create')->middleware('role_or_permission:superadmin|create barang');
            Route::post('/{id}/edit', 'edit')->name('edit')->middleware('role_or_permission:superadmin|edit barang');
            Route::put('/{id}/edit', 'update')->name('update')->middleware('role_or_permission:superadmin|edit barang');
            Route::delete('/{id}/delete', 'destroy')->name('delete')->middleware('role_or_permission:superadmin|delete barang');
            Route::get('/barang/export', [BarangController::class, 'export'])->name('export');
          
        });
        
    });
    Route::post('/barang/import', [BarangController::class, 'import'])->name('barang.import');

});

/** MATAKULIAH */
Route::prefix('matakuliah')->group(function () {
    Route::name('matakuliah.')->group(function () {
        Route::controller(MatakuliahController::class)->group(function(){
            Route::get('/', 'index')->name('index')->middleware('role_or_permission:superadmin|view matakuliah');
            Route::post('/', 'create')->name('create')->middleware('role_or_permission:superadmin|create matakuliah');
            Route::post('/{id}/edit', 'edit')->name('edit')->middleware('role_or_permission:superadmin|edit matakuliah');
            Route::put('/{id}/edit', 'update')->name('update')->middleware('role_or_permission:superadmin|edit matakuliah');
            Route::delete('/{id}/delete', 'destroy')->name('delete')->middleware('role_or_permission:superadmin|delete matakuliah');
        });
    });
});

/** PENGAJUAN */
Route::prefix('pengajuan')->group(function () {
    Route::name('pengajuan.')->group(function () {
        Route::controller(PengajuanController::class)->group(function(){

            Route::get('/', 'index')->name('index')->middleware('role_or_permission:superadmin|view pengajuan');
            Route::get('/form', 'form')->name('form')->middleware('role_or_permission:superadmin|create pengajuan');
            Route::post('/', 'create')->name('create')->middleware('role_or_permission:superadmin|create pengajuan');
            Route::get('/{id}/edio', 'edit')->name('edit')->middleware('role_or_permission:superadmin|edit pengajuan');
            Route::get('/{id}', 'show')->name('show')->middleware('role_or_permission:superadmin|view pengajuan');
            Route::put('/{id}/edit', 'update')->name('update')->middleware('role_or_permission:superadmin|edit pengajuan');
            Route::delete('/{id}/delete', 'destroy')->name('delete')->middleware('role_or_permission:superadmin|delete pengajuan');
            Route::get('/{id}/download', 'download')->name('download')->middleware('role_or_permission:superadmin|view pengajuan');
            // test
        });
        
        Route::post('/{id}/approve', [ApprovalPengajuanController::class, 'approve'])->name('approve')->middleware('role_or_permission:superadmin|approval pengajuan');
    });
});

/** PEMINJAMAN */
Route::prefix('peminjaman')->group(function () {
    Route::name('peminjaman.')->group(function () {
        Route::controller(PeminjamanController::class)->group(function(){
            Route::get('/', 'index')->name('index')->middleware('role_or_permission:superadmin|view peminjaman');
            Route::post('/', 'create')->name('create')->middleware('role_or_permission:superadmin|create peminjaman');
            Route::get('/test/form','form')->name('form')->middleware('role_or_permission:superadmin|create peminjaman');
            Route::get('/{id}/edit', 'edit')->name('edit')->middleware('role_or_permission:superadmin|edit peminjaman');
            Route::get('/{id}', 'show')->name('show')->middleware('role_or_permission:superadmin|view peminjaman');
            Route::put('/{id}/edit', 'update')->name('update')->middleware('role_or_permission:superadmin|edit peminjaman');
            Route::delete('/{id}/delete', 'destroy')->name('delete')->middleware('role_or_permission:superadmin|delete peminjaman');
            Route::get('/{id}/download', 'download')->name('download')->middleware('role_or_permission:superadmin|view peminjaman');
        });
        Route::post('/{id}/approve', [ApprovalPeminjamanController::class, 'approve'])->name('approve')->middleware('role_or_permission:superadmin|approval peminjaman');
    });
});