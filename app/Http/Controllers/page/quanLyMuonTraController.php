<?php

namespace App\Http\Controllers\page;

use App\Http\Controllers\Controller;
use App\Services\BorrowReBorrowManagementService;
use Illuminate\Http\Request;

class quanLyMuonTraController extends Controller
{
    public function __construct(
        private readonly BorrowReBorrowManagementService $borrowService
    ) {}
    public function index()
    {
        $data = [
            'title' => 'Quản Lý Mượn trả',
            'titleWeb' => 'Quản Lý Thư Viện- Mượn trả',
            'transactions' => $this->borrowService->getAllTransactions()
        ];

        return view('page.QuanLyMuonTra', $data);
    }

    public function handleBorrow(Request $request)
    {
        $student_code = null;
        $student_code = $request->student_code;
        // dd($student_code);
        $data = [
            'title' => 'Quản Lý Mượn trả',
            'titleWeb' => 'Quản Lý Thư Viện- Mượn trả',
            'transactions' => $this->borrowService->getAllTransactions()
        ];
        dd($this->borrowService->getAllTransactions());
        foreach ($data['transactions'] as $transaction) {
            dd($transaction);
        }

        return view('page.QuanLyMuonTra', $data);
    }

}
