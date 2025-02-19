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
                class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-300 editBookBtn">Tìm
                kiếm</button>
            <button onclick="() => {event.preventDefault(); window.location.reload();}"
                class="bg-amber-500 text-white px-4 py-2 w-[110px] rounded-lg hover:bg-amber-600 transition duration-300">Làm
                mới</button>
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
                                    <button onclick="() =>{window.location.redirect({{route('')}}}"
                                        class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-300 editBookBtn">Ghi
                                        mượn</button>
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
