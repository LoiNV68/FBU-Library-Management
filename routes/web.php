<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginOut\LoginController;
use App\Http\Controllers\LoginOut\LogoutController;
use App\Http\Controllers\page\QuanLyBanDocController;
use App\Http\Controllers\page\QuanLyMuonTraController;
use App\Http\Controllers\page\QuanLySachController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;



Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/login', [LoginController::class, 'handleLogin'])->name('handle-login');

Route::middleware(['CheckLogin'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/logout', [LogoutController::class, 'handleLogout'])->name('logout');

    Route::prefix('/quan-ly-sach')->group(function () {
        Route::get('/', [QuanLySachController::class, 'index'])->name('qls');
        Route::post('/book/add', [QuanLySachController::class, 'addBook'])->name('book.add');
        Route::post('/book/update', [QuanLySachController::class, 'updateBook'])->name('book.update');
        Route::post('/book/delete/{id}', [QuanLySachController::class, 'deleteBook'])->name('book.delete');
        Route::get('/book/search', [QuanLySachController::class, 'searchBook'])->name('book.search');
    });

    Route::prefix('/quan-ly-ban-doc')->group(function () {
        Route::get('/', [QuanLyBanDocController::class, 'index'])->name('qlbd');
        Route::get('/reader/search', [QuanLyBanDocController::class, 'searchReader'])->name('reader.search');
        Route::post('/reader/ban', [QuanLyBanDocController::class, 'banReader'])->name('reader.ban');
        Route::get('/check-student-ban', [QuanLyBanDocController::class, 'checkBanReader'])->name('reader.check-ban');
    });


    Route::prefix('/quan-ly-muon-tra')->group(function () {

        Route::get('/', [QuanLyMuonTraController::class, 'index'])->name('qlmt');
        Route::get('/transaction', [QuanLyMuonTraController::class, 'handleBorrow'])->name('borrow');
        Route::post('/search', [QuanLyMuonTraController::class, 'searchTransaction'])->name('borrow.search');
        Route::post('/transaction/add', [QuanLyMuonTraController::class, 'handleAddTransaction'])->name('borrow.add');
        Route::get('/check-book-quantity', [QuanLyMuonTraController::class, 'checkBookQuantity'])->name('borrow.checkBook');
        Route::post('/transaction/extend', [QuanLyMuonTraController::class, 'extendBook'])->name('borrow.extend');
        Route::post('/transaction/return-book', [QuanLyMuonTraController::class, 'returnBook'])->name('borrow.returnBook');
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
Route::get('/refresh-csrf', function () {
    return response()->json(['token' => csrf_token()]);
});
