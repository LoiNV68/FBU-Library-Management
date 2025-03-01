@extends('layout.main')
@section('title')
    {{ $title }}
@endsection
@section('titleWeb')
    {{ $titleWeb }}
@endsection
@section('content')
    <!-- Search Box -->
    <div class="mb-6">
        <form action="{{ route('reader.search') }}" method="GET" class="flex items-center gap-2">
            <input type="text"
                class="flex-grow max-w-md px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-primary shadow-sm"
                placeholder="Tìm kiếm bạn đọc, mã sinh viên, viện, lớp..." name="query" />
            <button
                class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-300 editBookBtn"><i
                    class="fas fa-search"></i> <!-- Icon tìm kiếm -->
                <span>Tìm kiếm</span></button>
            <button onclick="() => {window.location.href='{{ route('qlbd') }}';}"
                class="bg-amber-500 text-white px-4 py-2 rounded-lg hover:bg-amber-600 transition duration-300"><i
                    class="fas fa-sync-alt"></i> <!-- Icon làm mới -->
                <span>Làm mới</span></button>
        </form>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto bg-white rounded-lg shadow-md">
        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-primary text-white">
                    <th class="p-4 text-left">Mã sinh viên</th>
                    <th class="p-4 text-left">Tên sinh viên</th>
                    <th class="p-4 text-left">Viện</th>
                    <th class="p-4 text-left">Lớp</th>
                    <th class="p-4 text-left">Khóa</th>
                    <th class="p-4 text-left">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @if (isset($readers) && $readers->isNotEmpty())
                    @foreach ($readers as $reader)
                        <tr class="border-b hover:bg-gray-50 transition duration-200 {{ $reader->ban ? 'ban' : '' }}"
                            data-reader="{{ json_encode($reader) }}">
                            <td class="p-4">{{ $reader->student_code }}</td>
                            <td class="p-4">{{ $reader->student_name }}</td>
                            <td class="p-4">{{ $reader->institute }}</td>
                            <td class="p-4">{{ $reader->class }}</td>
                            <td class="p-4">{{ $reader->school_year }}</td>
                            <td class="p-4">
                                <div class="flex space-x-2">
                                    <button data-student-code="{{ $reader->student_code }}"
                                        class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-300 loanBtn">
                                        Ghi mượn
                                    </button>
                                    @if ($reader->ban)
                                        <button
                                            class="bg-green-500 text-white px-4 py-2 w-[110px] rounded-lg hover:bg-green-600 transition duration-300 unbanReaderBtn">Bỏ
                                            cấm</button>
                                    @else
                                        <button
                                            class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition duration-300 banReaderBtn">Cấm
                                            mượn</button>
                                    @endif

                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="10" class="p-8 text-center">
                            <h3 class="text-gray-500 font-medium text-lg">Không có dữ liệu</h3>
                        </td>
                    </tr>
                @endif

            </tbody>
        </table>
    </div>
    @if (isset($readers) && $readers->isNotEmpty())
        <div class="py-8">
            {{ $readers->links() }}
        </div>
    @endif

    <!-- Modal thông báo -->
    <div id="banModal" class="hidden fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
        <div
            class="bg-white p-8 rounded-lg shadow-2xl max-w-md w-full transform transition-all duration-300 scale-95">
            <!-- Icon cảnh báo -->
            <div class="flex justify-center mb-4">
                <svg class="w-12 h-12 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <!-- Nội dung thông báo -->
            <p class="text-center text-red-600 text-xl font-bold mb-4">Sinh viên này đang bị cấm mượn sách!</p>
            <!-- Nút đóng -->
            <div class="mt-6 text-center">
                <button id="closeModal"
                    class="bg-red-600 text-white px-6 py-2 rounded-lg hover:bg-red-700 transition duration-300 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                    Đóng
                </button>
            </div>
        </div>
    </div>

    <!-- Modal Xóa sách -->
    <div id="deleteBookModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">
            <div class="flex justify-between items-center mb-4">
                <h2 id="modalTitle" class="text-xl font-bold text-primary">Cấm mượn</h2>
                <button id="closeDeleteModal" class="text-gray-600 text-2xl leading-none p-4">&times;</button>
            </div>
            <p id="modalContent" class="mb-4">Bạn có chắc chắn muốn cấm bạn đọc này không?</p>
            <div class="flex justify-end space-x-2">
                <button type="button" id="cancelDeleteModal"
                    class="px-4 py-2 bg-gray-500 text-white rounded-lg">Hủy</button>
                <button type="button" id="confirmDeleteModal"
                    class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition duration-300">Cấm</button>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('asset/js/readerManagement.js') }}"></script>
@endsection
