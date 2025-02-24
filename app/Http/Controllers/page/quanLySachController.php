<?php

namespace App\Http\Controllers\page;

use App\Http\Controllers\Controller;
use App\Models\BookModel;
use App\Services\BookManagementService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class quanLySachController extends Controller
{
    public function __construct(
        private readonly BookManagementService $bookService
    ) {}
    public function index(): View
    {
        $data = [
            'title' => 'Quản Lý Tài Liệu',
            'titleWeb' => 'Quản Lý Thư Viện - Sách',
            'books' => $this->bookService->getAllBooks()
        ];
        // dd($data['books']->first()->book_cover); 
        return view('page.QuanLySach', $data);
    }


    public function addBook(Request $request)
    {
        $validatedData = Validator::make(
            $request->all(),
            [
                'book_code'   => ['required', 'string', 'max:255', 'unique:books,book_code'],
                'book_name'   => ['required', 'string', 'max:255'],
                'book_type'   => ['required', 'string', 'max:255'],
                'quantity'    => 'required|integer|min:1',
                'description' => 'nullable|string',
                'book_cover'  => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ],
            [
                'book_code.required' => 'Mã sách không được để trống.',
                'book_code.string'   => 'Mã sách phải là chữ.',
                'book_code.max'      => 'Mã sách không quá 255 ký tự.',
                'book_code.unique'      => 'Mã sách không được trùng.',

                'book_name.required' => 'Tên sách không được để trống.',
                'book_name.string'   => 'Tên sách phải là chữ.',
                'book_name.max'      => 'Tên sách không quá 255 ký tự.',

                'book_type.required' => 'Loại sách không được để trống.',
                'book_type.string'   => 'Loại sách phải là chữ.',
                'book_type.max'      => 'Loại sách không quá 255 ký tự.',

                'author.required'    => 'Tác giả không được để trống.',
                'author.string'      => 'Tác giả phải là chữ.',
                'author.max'         => 'Tác giả không quá 255 ký tự.',

                'quantity.required'  => 'Số lượng sách không được để trống.',
                'quantity.integer'   => 'Số lượng sách phải là số.',
                'quantity.min'       => 'Số lượng sách phải lớn hơn 0.',
            ]
        );

        if ($validatedData->fails()) {
            return redirect()->back()->withErrors($validatedData)->withInput();
        }
        // dd($request->all());
        // Xử lý tạo mới sách
        $newBook = new BookModel();

        $newBook->book_code = $request->input('book_code');
        $newBook->book_name = $request->input('book_name');
        $newBook->book_type = $request->input('book_type');
        $newBook->author = $request->input('author');
        $newBook->quantity = $request->input('quantity');

        $newBook->broken = $request->input('broken');
        $newBook->description = $request->input('description');
        // Xử lý upload ảnh (nếu có)
        if ($request->hasFile('book_cover')) {
            $file = $request->file('book_cover');
            // Tạo tên file duy nhất, ví dụ kết hợp thời gian và tên gốc
            $filename = time() . '_' . $file->getClientOriginalName();
            // Lưu file vào thư mục 'book_cover' trong disk 'public' với tên file đã chỉ định
            $file->storeAs('image', $filename, 'public');
            // Chỉ lưu tên file vào cơ sở dữ liệu
            $newBook->book_cover = $filename;
        }
        // dd($newBook);
        $create = $newBook->save();
        if (!$create) {
            return redirect()->route('qls')->with(['type' => 'error', 'message' =>  'Thêm sách không thành công!']);
        }
        return redirect()->route('qls')->with(['type' => 'success', 'message' =>  'Thêm sách thành công!']);
    }
    public function updateBook(Request $request)
    {
        // dd($request->all());
        // Validate dữ liệu
        $validatedData = Validator::make(
            $request->all(),
            [
                'book_code'   => ['required', 'string', 'max:255'],
                'book_name'   => ['required', 'string', 'max:255'],
                'book_type'   => ['required', 'string', 'max:255'],
                'quantity'    => 'required|integer|min:1',
                'description' => 'nullable|string',
                'book_cover'  => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ],
            [
                'book_code.required' => 'Mã sách không được để trống.',
                'book_code.string'   => 'Mã sách phải là chữ.',
                'book_code.max'      => 'Mã sách không quá 255 ký tự.',

                'book_name.required' => 'Tên sách không được để trống.',
                'book_name.string'   => 'Tên sách phải là chữ.',
                'book_name.max'      => 'Tên sách không quá 255 ký tự.',

                'book_type.required' => 'Loại sách không được để trống.',
                'book_type.string'   => 'Loại sách phải là chữ.',
                'book_type.max'      => 'Loại sách không quá 255 ký tự.',

                'author.required'    => 'Tác giả không được để trống.',
                'author.string'      => 'Tác giả phải là chữ.',
                'author.max'         => 'Tác giả không quá 255 ký tự.',

                'quantity.required'  => 'Số lượng sách không được để trống.',
                'quantity.integer'   => 'Số lượng sách phải là số.',
                'quantity.min'       => 'Số lượng sách phải lớn hơn 0.',
            ]
        );

        if ($validatedData->fails()) {
            return redirect()->back()->withErrors($validatedData)->withInput();
        }


        // Tìm sách cần cập nhật        
        $book = BookModel::where('book_code', $request->book_code)->firstOrFail();

        // dd($book);
        // Cập nhật dữ liệu
        $book->book_code = $request->input('book_code');
        $book->book_name = $request->input('book_name');
        $book->book_type = $request->input('book_type');
        $book->author = $request->input('author');
        $book->quantity = $request->input('quantity');

        $book->broken = $request->input('broken');
        $book->description = $request->input('description');

        // Xử lý upload ảnh (nếu có)
        if ($request->hasFile('book_cover')) {
            $file = $request->file('book_cover');
            // Tạo tên file duy nhất, ví dụ kết hợp thời gian và tên gốc
            $filename = time() . '_' . $file->getClientOriginalName();
            // Lưu file vào thư mục 'book_cover' trong disk 'public' với tên file đã chỉ định
            $file->storeAs('image', $filename, 'public');
            // Chỉ lưu tên file vào cơ sở dữ liệu
            $book->book_cover = $filename;
        }
        // dd($filename);
        // Lưu thay đổi

        $update = $book->save();
        if (!$update) {
            return redirect()->route('qls')->with(['type' => 'error', 'message' =>  'Sửa sách không thành công!']);
        }

        return redirect()->route('qls')->with(['type' => 'success', 'message' =>  'Sửa sách thành công!']);
    }


    public function deleteBook(Request $request, $id)
    {
        $delete = BookModel::where('book_code', $id)->delete();
        // dd(12);
        if ($delete) {
            return response()->json(['message' => 'Xóa sách thành công!'], 200);
        } else {
            return response()->json(['message' => 'Không tìm thấy sách để xóa!'], 404);
        }
    }


    public function searchBook(Request $request)
    {
        $query = $request->input('query'); // Lấy từ khóa tìm kiếm

        // Nếu không có từ khóa, trả về danh sách tất cả sách
        // dd($query);
        $books = BookModel::where('book_name', 'LIKE', "%{$query}%")
            ->orWhere('book_code', 'LIKE', "%{$query}%")
            ->orWhere('author', 'LIKE', "%{$query}%")
            ->orWhere('book_type', 'LIKE', "%{$query}%")
            ->paginate(10)->onEachSide(3)->appends(['query' => $query]);
        // dd($books);
        $data = [
            'title' => 'Quản Lý Tài Liệu',
            'titleWeb' => 'Quản Lý Thư Viện - Sách',
            'books' => $books
        ];
        // dd($data);
        // dd($data['books']->first()->book_cover); 
        return view('page.QuanLySach', $data);
    }
}
