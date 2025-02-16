<?php

namespace App\Http\Controllers\page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class quanLyMuonTraController extends Controller
{
    public function index()
    {
        $title = "Quản Lý Mượn trả";
        $titleWeb = 'Quản Lý Thư Viện- Mượn trả';
        return view('page.QuanLyMuonTra', compact('title', 'titleWeb'));
    }
}
