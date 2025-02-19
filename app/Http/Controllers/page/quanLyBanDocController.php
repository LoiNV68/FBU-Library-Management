<?php

namespace App\Http\Controllers\page;

use App\Http\Controllers\Controller;
use App\Models\StudentModel;
use App\Services\ReaderManagementService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class quanLyBanDocController extends Controller
{
    public function __construct(
        private readonly ReaderManagementService $readerService
    ) {}
    public function index(): View
    {
        $data = [
            'title' => 'Quản Lý Bạn Đọc',
            'titleWeb' => 'Quản Lý Thư Viện- Bạn đọc',
            'readers' => $this->readerService->getReaders()
        ];
        return view('page.QuanLyBanDoc', $data); //
    }

    public function searchReader(Request $request)
    {
        $query = $request->input('query'); // Lấy từ khóa tìm kiếm

        // Nếu không có từ khóa, trả về danh sách tất cả sách
        // dd($query);
        $readers = StudentModel::whereRaw('LOWER(student_name) LIKE ?', ['%' . strtolower($query) . '%'])
            ->orWhereRaw('LOWER(student_code) LIKE ?', ['%' . strtolower($query) . '%'])
            ->orWhereRaw('LOWER(institute) LIKE ?', ['%' . strtolower($query) . '%'])
            ->orWhereRaw('LOWER(class) LIKE ?', ['%' . strtolower($query) . '%'])
            ->orWhereRaw('LOWER(school_year) LIKE ?', ['%' . strtolower($query) . '%'])
            ->orWhereRaw('LOWER(ban) LIKE ?', ['%' . strtolower($query) . '%'])
            ->paginate(10)
            ->appends(['query' => $query]);

        // foreach($readers as $reader) {
        //     dd($reader);

        // }
        $data = [
            'title' => 'Quản Lý Bạn Đọc',
            'titleWeb' => 'Quản Lý Thư Viện - Bạn đọc',
            'readers' => $readers
        ];
        // dd($data);
        // dd($data['books']->first()->book_cover); 
        return view('page.QuanLyBanDoc', $data);
    }

    public function banReader(Request $request)
    {
        $student_code = $request->student_code;
        $action = $request->action;
        try {
            // Tìm sinh viên theo student_code
            $student = StudentModel::where('student_code', $student_code)->firstOrFail();

            // Cập nhật trạng thái ban or unban
            if ($action == 'unban') {
                $student->ban = 0;
            } else {
                $student->ban = 1;
            }
            $student->save();

            // Trả về thông báo thành công
            return response()->json([
                'type' => 'success',
                'message' => 'Cấm bạn đọc thành công!'
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Trả về thông báo lỗi nếu không tìm thấy sinh viên
            return response()->json([
                'type' => 'error',
                'message' => 'Không tìm thấy bạn đọc!'
            ], 404);
        } catch (\Exception $e) {
            // Trả về thông báo lỗi nếu có lỗi khác xảy ra
            return response()->json([
                'type' => 'error',
                'message' => 'Đã xảy ra lỗi khi cấm bạn đọc!'
            ], 500);
        }
    }
}
