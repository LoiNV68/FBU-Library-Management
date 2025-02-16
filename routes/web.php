<?php

use App\Http\Controllers\homeController;
use App\Http\Controllers\loginOut\loginController;
use App\Http\Controllers\loginOut\LogoutController;
use App\Http\Controllers\page\quanLyBanDocController;
use App\Http\Controllers\page\quanLyMuonTraController;
use App\Http\Controllers\page\quanLySachController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;


Route::middleware(['ShareData'])->group(function () {

    Route::get('/login', [loginController::class, 'login'])->name('login');
    Route::post('/login', [loginController::class, 'handleLogin'])->name('handle-login');
});

Route::middleware(['CheckLogin', 'ShareData'])->group(function () {
    Route::get('/', [homeController::class, 'index'])->name('home');
    Route::get('/logout', [LogoutController::class, 'handleLogout'])->name('logout');
    Route::get('/quan-ly-sach', [quanLySachController::class, 'index'])->name('qls');
    Route::get('/quan-ly-ban-doc', [quanLyBanDocController::class, 'index'])->name('qlbd');
    Route::get('/quan-ly-muon-tra', [quanLyMuonTraController::class, 'index'])->name('qlmt');
});
Route::get('/check-db', function () {
    try {
        DB::connection()->getPdo();
        return 'Kết nối đến database thành công!';
    } catch (\Exception $e) {
        return 'Không thể kết nối đến database: ' . $e->getMessage();
    }
});
