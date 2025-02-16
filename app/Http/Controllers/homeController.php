<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class homeController extends Controller
{
    public function index()
    {
        $title = 'Quản Lý Thư Viện';
        $titleWeb = 'Quản Lý Thư Viện';
        return view('home', compact('title', 'titleWeb'));
    }
}
