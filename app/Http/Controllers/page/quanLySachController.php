<?php

namespace App\Http\Controllers\page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class quanLySachController extends Controller
{
    public function index()
    {
        $title = 'Quản Lý Tài Liệu';
        $titleWeb = 'Quản Lý Thư Viện- Sách';
        return view('page/quanLySach', compact('title', 'titleWeb'));
    }
}
