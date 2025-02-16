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
            placeholder="Tìm kiếm sách, mã sách, tác giả..." />
        <button class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-300 editBookBtn">Tìm
            kiếm</button>

    </div>

    <!-- Table -->
    <div class="overflow-x-auto bg-white rounded-lg shadow-md">
        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-primary text-white">
                    <th class="p-4 text-left">Ảnh bìa sách</th>
                    <th class="p-4 text-left">Mã sách</th>
                    <th class="p-4 text-left">Tên sách</th>
                    <th class="p-4 text-left">Kiểu tài liệu</th>
                    <th class="p-4 text-left">Tác giả</th>
                    <th class="p-4 text-left">Số lượng</th>
                    <th class="p-4 text-left">Sẵn sàng mượn</th>
                    <th class="p-4 text-left">Mô tả</th>
                    <th class="p-4 text-left">Hành động</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-b hover:bg-gray-50 transition duration-200">
                    <td class="p-4">
                        <img class="w-16 h-16 object-cover rounded-lg" src="{{ asset('asset/image/1.jpg') }}"
                            alt="Ảnh bìa sách">
                    </td>
                    <td class="p-4">DC12321</td>
                    <td class="p-4">Ứng dụng công nghệ thông tin trong dạy học</td>
                    <td class="p-4">Giáo trình</td>
                    <td class="p-4">ThS. Đỗ Mạnh Cường</td>
                    <td class="p-4">10</td>
                    <td class="p-4">10</td>
                    <td class="p-4">200 trang</td>
                    <td class="p-4">
                        <div class="flex space-x-2">
                            <button
                                class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-300 editBookBtn">Sửa</button>
                            <button
                                class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition duration-300 deleteBookBtn">Xóa</button>
                        </div>
                    </td>
                </tr>
                <tr class="border-b hover:bg-gray-50 transition duration-200">
                    <td class="p-4">
                        <img class="w-16 h-16 object-cover rounded-lg" src="{{ asset('asset/image/2.jpg') }}"
                            alt="Ảnh bìa sách">
                    </td>
                    <td class="p-4">DC12321</td>
                    <td class="p-4">Lập trình Python cơ bản</td>
                    <td class="p-4">Giáo trình</td>
                    <td class="p-4">TS. Nguyễn Văn A</td>
                    <td class="p-4">15</td>
                    <td class="p-4">12</td>
                    <td class="p-4">300 trang</td>
                    <td class="p-4">
                        <div class="flex space-x-2">
                            <button
                                class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-300 editBookBtn">Sửa</button>
                            <button
                                class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition duration-300 deleteBookBtn">Xóa</button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Modal Sửa thông tin sách -->
    <div id="editBookModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold text-primary">Sửa thông tin sách</h2>
                <button id="closeModal" class="text-gray-600 text-2xl leading-none p-4">&times;</button>
            </div>
            <form id="editBookForm">
                <div class="mb-4">
                    <label class="block text-gray-700">Ảnh bìa sách</label>
                    <input type="file" name="book_image" id="bookImageInput" class="w-full border rounded-lg p-2"
                        accept="image/*">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Tên sách</label>
                    <input type="text" name="book_name" class="w-full border rounded-lg p-2"
                        value="Ứng dụng công nghệ thông tin trong dạy học">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Kiểu tài liệu</label>
                    <input type="text" name="book_name" class="w-full border rounded-lg p-2"
                        value="Ứng dụng công nghệ thông tin trong dạy học">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Tác giả</label>
                    <input type="text" name="author" class="w-full border rounded-lg p-2" value="ThS. Đỗ Mạnh Cường">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Số lượng</label>
                    <input type="number" name="quantity" class="w-full border rounded-lg p-2" value="10">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Mô tả</label>
                    <textarea name="description" class="w-full border rounded-lg p-2" rows="3">200 trang</textarea>
                </div>
                <div class="flex justify-end space-x-2">
                    <button type="button" id="cancelModal" class="px-4 py-2 bg-gray-500 text-white rounded-lg">Hủy</button>
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg">Lưu</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Xóa sách -->
    <div id="deleteBookModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold text-primary">Xóa sách</h2>
                <button id="closeDeleteModal" class="text-gray-600 text-2xl leading-none p-4">&times;</button>
            </div>
            <p class="mb-4">Bạn có chắc chắn muốn xóa sách này không?</p>
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
        // Xử lý modal sửa
        const editBookBtns = document.querySelectorAll('.editBookBtn');
        const editBookModal = document.getElementById('editBookModal');
        const closeModalBtn = document.getElementById('closeModal');
        const cancelModalBtn = document.getElementById('cancelModal');
        const editBookForm = document.getElementById('editBookForm');

        function openModal() {
            editBookModal.classList.remove('hidden');
        }

        function closeModal() {
            editBookModal.classList.add('hidden');
        }

        editBookBtns.forEach(btn => {
            btn.addEventListener('click', openModal);
        });

        closeModalBtn.addEventListener('click', closeModal);
        cancelModalBtn.addEventListener('click', closeModal);

        editBookForm.addEventListener('submit', function(e) {
            e.preventDefault();
            alert('Thông tin sách đã được cập nhật!');
            closeModal();
        });

        window.addEventListener('click', function(e) {
            if (e.target === editBookModal) {
                // closeModal();
                e.preventDefault();
            }
        });

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
