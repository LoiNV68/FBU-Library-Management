<?php

namespace App\Http\Controllers\page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class quanLyBanDocController extends Controller
{
    public function index() {
        $title = 'Quản Lý Bạn Đọc';        
        $titleWeb = 'Quản Lý Thư Viện- Bạn đọc';
        return view('page.QuanLyBanDoc', compact('title', 'titleWeb')); //
    }
}
