<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\LibraryStatisticsService;
use Illuminate\View\View;

class HomeController extends Controller  // Sửa tên class theo PSR
{
    public function __construct(
        private readonly LibraryStatisticsService $libraryStats
    ) {}

    public function index(): View
    {
        $data = [
            'title' => 'Quản Lý Thư Viện',
            'titleWeb' => 'Quản Lý Thư Viện',
            ...$this->libraryStats->getStatistics()
        ];
        // dd($data);
        return view('home', $data);
    }
}
