<?php

use App\Http\Controllers\homeController;
use App\Http\Controllers\loginOut\loginController;
use App\Http\Controllers\loginOut\LogoutController;
use App\Http\Controllers\page\quanLyBanDocController;
use App\Http\Controllers\page\quanLyMuonTraController;
use App\Http\Controllers\page\quanLySachController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;



Route::get('/login', [loginController::class, 'login'])->name('login');
Route::post('/login', [loginController::class, 'handleLogin'])->name('handle-login');

Route::middleware(['CheckLogin'])->group(function () {
    Route::get('/', [homeController::class, 'index'])->name('home');
    Route::get('/logout', [LogoutController::class, 'handleLogout'])->name('logout');

    Route::prefix('/quan-ly-sach')->group(function () {
        Route::get('/', [quanLySachController::class, 'index'])->name('qls');
        Route::post('/book/add', [quanLySachController::class, 'addBook'])->name('book.add');
        Route::post('/book/update', [quanLySachController::class, 'updateBook'])->name('book.update');
        Route::post('/book/delete/{id}', [quanLySachController::class, 'deleteBook'])->name('book.delete');
        Route::get('/book/search', [quanLySachController::class, 'searchBook'])->name('book.search');
    });

    Route::prefix('/quan-ly-ban-doc')->group(function () {
        Route::get('/', [quanLyBanDocController::class, 'index'])->name('qlbd');
        Route::get('/reader/search', [quanLyBanDocController::class, 'searchReader'])->name('reader.search');
        Route::post('/reader/ban', [quanLyBanDocController::class, 'banReader'])->name('reader.ban');
    });

    Route::prefix('/quan-ly-muon-tra')->group(function () {

        Route::get('/', [quanLyMuonTraController::class, 'index'])->name('qlmt');
        Route::get('/ghi-muon', [quanLyMuonTraController::class, 'index'])->name('borrow');
    });
});
Route::get('/check-db', function () {
    try {
        DB::connection()->getPdo();
        return 'Kết nối đến database thành công!';
    } catch (\Exception $e) {
        return 'Không thể kết nối đến database: ' . $e->getMessage();
    }
});
