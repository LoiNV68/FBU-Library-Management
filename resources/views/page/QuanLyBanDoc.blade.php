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
        <input type="text"
            class="w-full max-w-md px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-primary shadow-sm"
            placeholder="Tìm kiếm bạn đọc, mã sinh viên, viện, lớp..." />
        <button class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-300 editBookBtn">Tìm
            kiếm</button>

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
                <tr class="border-b hover:bg-gray-50 transition duration-200">
                    <td class="p-4">2254800165</td>
                    <td class="p-4">Nguyễn Văn A</td>
                    <td class="p-4">Công nghệ thông tin</td>
                    <td class="p-4">D11.48.02</td>
                    <td class="p-4">11</td>
                    <td class="p-4">
                        <div class="flex space-x-2">
                            <button
                                class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-300 editBookBtn">Ghi
                                mượn</button>
                            <button
                                class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition duration-300 deleteBookBtn">Cấm
                                mượn</button>
                        </div>
                    </td>
                </tr>
                <tr class="border-b hover:bg-gray-50 transition duration-200 ban">
                    <td class="p-4">2254800163</td>
                    <td class="p-4">Nguyễn Văn B</td>
                    <td class="p-4">Công nghệ thông tin</td>
                    <td class="p-4">D11.48.02</td>
                    <td class="p-4">11</td>
                    <td class="p-4">
                        <div class="flex space-x-2">
                            <button
                                class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-300 editBookBtn">Ghi
                                mượn</button>
                            <button
                                class="bg-green-500 text-white px-4 py-2 w-[110px] rounded-lg hover:bg-green-600 transition duration-300 deleteBookBtn">Bỏ cấm</button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <!-- Modal Xóa sách -->
    <div id="deleteBookModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold text-primary">Cấm mượn</h2>
                <button id="closeDeleteModal" class="text-gray-600 text-2xl leading-none p-4">&times;</button>
            </div>
            <p class="mb-4">Bạn có chắc chắn muốn cấm bạn đọc này không?</p>
            <div class="flex justify-end space-x-2">
                <button type="button" id="cancelDeleteModal"
                    class="px-4 py-2 bg-gray-500 text-white rounded-lg">Hủy</button>
                <button type="button" id="confirmDeleteModal"
                    class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition duration-300">Xóa</button>
            </div>
        </div>
    </div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Xử lý modal xóa
        const deleteBookBtns = document.querySelectorAll('.deleteBookBtn');
        const deleteBookModal = document.getElementById('deleteBookModal');
        const closeDeleteModalBtn = document.getElementById('closeDeleteModal');
        const cancelDeleteModalBtn = document.getElementById('cancelDeleteModal');
        const confirmDeleteModalBtn = document.getElementById('confirmDeleteModal');

        function openDeleteModal() {
            deleteBookModal.classList.remove('hidden');
        }

        function closeDeleteModal() {
            deleteBookModal.classList.add('hidden');
        }

        deleteBookBtns.forEach(btn => {
            btn.addEventListener('click', openDeleteModal);
        });

        closeDeleteModalBtn.addEventListener('click', closeDeleteModal);
        cancelDeleteModalBtn.addEventListener('click', closeDeleteModal);

        confirmDeleteModalBtn.addEventListener('click', function() {
            alert('Sách đã được xóa!');
            closeDeleteModal();
        });

        window.addEventListener('click', function(e) {
            if (e.target === deleteBookModal) {
                // closeDeleteModal(); 
                e.preventDefault();
            }
        });
    });
</script>
