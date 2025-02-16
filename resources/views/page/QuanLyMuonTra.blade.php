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
            placeholder="Tìm kiếm bạn đọc, giáo trình..." />
        <button class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-300">Tìm
            kiếm</button>
        <button
            class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition duration-300 loanBookBtn">Ghi
            mượn</button>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto max-w-7xl bg-white rounded-lg shadow-md">
        <table class="w-full border-collapse ">
            <thead>
                <tr class="bg-primary text-white">
                    <th class="p-4 text-left">Ngày hết hạn</th>
                    <th class="p-4 text-left">Mã sách</th>
                    <th class="p-4 text-left">Tên sách</th>
                    <th class="p-4 text-left">Kiểu tài liệu</th>
                    <th class="p-4 text-left">Ngày ghi mượn</th>
                    <th class="p-4 text-left">Bạn đọc</th>
                    <th class="p-4 text-left">Mã sinh viên</th>
                    <th class="p-4 text-left">Số lượng sách mượn</th>
                    <th class="p-4 text-left">Ghi chú</th>
                    <th class="p-4 text-left">Hành động</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-b hover:bg-gray-50 transition duration-200">
                    <td class="p-4">02/10/2025</td>
                    <td class="p-4">DC12321</td>
                    <td class="p-4">Lập trình Python cơ bản</td>
                    <td class="p-4">Giáo trình</td>
                    <td class="p-4">02/10/2024</td>
                    <td class="p-4">Phạm Thanh Tươi</td>
                    <td class="p-4">2254800008</td>
                    <td class="p-4">5</td>
                    <td class="p-4"></td>
                    <td class="p-4">
                        <div class="flex space-x-2">
                            <!-- Sử dụng class extendBtn cho nút Gia hạn -->
                            <button
                                class="bg-blue-500 text-white text-nowrap px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-300 extendBtn">Gia
                                hạn</button>
                            <button
                                class="bg-red-500 text-white text-nowrap px-4 py-2 rounded-lg hover:bg-red-600 transition duration-300 returnBookBtn">Ghi
                                trả</button>
                        </div>
                    </td>
                </tr>
                <tr class="border-b hover:bg-gray-50 transition duration-200">
                    <td class="p-4">02/10/2025</td>
                    <td class="p-4">DC12322</td>
                    <td class="p-4">Lập trình Python cơ bản</td>
                    <td class="p-4">Giáo trình</td>
                    <td class="p-4">02/10/2024</td>
                    <td class="p-4">Phạm Thanh Tươi</td>
                    <td class="p-4">2254800008</td>
                    <td class="p-4">6</td>
                    <td class="p-4"></td>
                    <td class="p-4">
                        <div class="flex space-x-2">
                            <button
                                class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-300 extendBtn">Gia
                                hạn</button>
                            <button
                                class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition duration-300 returnBookBtn">Ghi
                                trả</button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Modal Gia hạn -->
    <div id="extendModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold text-primary">Gia hạn mượn sách</h2>
                <button id="closeExtendModal" class="text-gray-600 text-2xl  leading-none p-4">&times;</button>
            </div>
            <form id="extendForm">
                <div class="mb-4">
                    <label class="block text-gray-700">Ngày gia hạn mới</label>
                    <input type="date" name="new_due_date" class="w-full border rounded-lg p-2" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Ghi chú</label>
                    <textarea name="note" class="w-full border rounded-lg p-2" rows="3"></textarea>
                </div>
                <div class="flex justify-end space-x-2">
                    <button type="button" id="cancelExtendModal"
                        class="px-4 py-2 bg-gray-500 text-white rounded-lg">Hủy</button>
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg">Lưu</button>
                </div>
            </form>
        </div>
    </div>
    <!-- Modal Ghi Trả -->
    <div id="returnModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold text-primary">Ghi Trả Sách</h2>
                <button id="closeReturnModal" class="text-gray-600 text-2xl leading-none p-4">&times;</button>
            </div>
            <div class="mb-12">
                <p class="mb-4">Danh sách các sách đang mượn:</p>
                <!-- Danh sách sách đang mượn (có thể render động từ dữ liệu) -->
                <ul id="borrowedBooksList" class="mb-4 space-y-2">
                    <li class="flex items-center">
                        <input type="checkbox" name="books[]" value="1" class="mr-2 transform scale-150">
                        <span>Ứng dụng công nghệ thông tin trong dạy học</span>
                    </li>
                    <li class="flex items-center">
                        <input type="checkbox" name="books[]" value="2" class="mr-2 transform scale-150">
                        <span>Lập trình Python cơ bản</span>
                    </li>
                    <!-- Thêm mục khác nếu cần -->
                </ul>
            </div>

            <div class="flex justify-end space-x-2">
                <button id="cancelReturnModal" type="button"
                    class="px-4 py-2 bg-gray-500 text-white rounded-lg">Hủy</button>
                <button id="returnSelectedBtn" type="button" class="px-4 py-2 bg-blue-500 text-white rounded-lg">Ghi trả đã
                    chọn</button>
                <button id="returnAllBtn" type="button" class="px-4 py-2 bg-green-500 text-white rounded-lg">Ghi trả tất
                    cả</button>
            </div>
        </div>
    </div>
    <!-- Modal Ghi mượn -->
    <div id="loanModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold text-primary">Ghi Mượn Sách</h2>
                <button id="closeLoanModal" class="text-gray-600 text-2xl leading-none p-4">&times;</button>
            </div>
            <form id="loanForm">
                <div class="mb-4">
                    <label class="block text-gray-700">Mã sách</label>
                    <input type="text" name="book_name" class="w-full border rounded-lg p-2"
                        placeholder="Nhập tên sách" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Số lượng mượn</label>
                    <input type="number" name="quantity" class="w-full border rounded-lg p-2"
                        placeholder="Nhập số lượng" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Ngày mượn</label>
                    <input type="date" name="borrow_date" class="w-full border rounded-lg p-2" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Ngày trả</label>
                    <input type="date" name="borrow_date" class="w-full border rounded-lg p-2" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Ghi chú</label>
                    <textarea name="note" class="w-full border rounded-lg p-2" rows="3" placeholder="Ghi chú (nếu có)"></textarea>
                </div>
                <div class="flex justify-end space-x-2">
                    <button type="button" id="cancelLoanModal"
                        class="px-4 py-2 bg-gray-500 text-white rounded-lg">Hủy</button>
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg">Lưu</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <!-- Đảm bảo rằng bạn đã include Chart.js hoặc các script cần thiết trong layout nếu cần -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Lấy các phần tử cần thiết cho modal gia hạn
            const extendBtns = document.querySelectorAll('.extendBtn');
            const extendModal = document.getElementById('extendModal');
            const closeExtendModal = document.getElementById('closeExtendModal');
            const cancelExtendModal = document.getElementById('cancelExtendModal');
            const extendForm = document.getElementById('extendForm');

            // Hàm mở modal
            function openExtendModal() {
                extendModal.classList.remove('hidden');
            }

            // Hàm đóng modal
            function closeExtendModalFunc() {
                extendModal.classList.add('hidden');
            }

            // Gán sự kiện cho tất cả các nút Gia hạn
            extendBtns.forEach(btn => {
                btn.addEventListener('click', openExtendModal);
            });

            // Gán sự kiện cho nút đóng và nút Hủy
            closeExtendModal.addEventListener('click', closeExtendModalFunc);
            cancelExtendModal.addEventListener('click', closeExtendModalFunc);

            // Xử lý submit form gia hạn
            extendForm.addEventListener('submit', function(e) {
                e.preventDefault();
                // Xử lý lưu thông tin gia hạn (ví dụ: AJAX hoặc submit form)
                alert('Gia hạn thành công!');
                closeExtendModalFunc();
            });

            // Đóng modal khi click bên ngoài nội dung modal
            window.addEventListener('click', function(e) {
                if (e.target === extendModal) {
                    // closeExtendModalFunc();
                    e.preventDefault();
                }
            });
        });

        // Lấy các phần tử liên quan đến modal ghi trả
        const returnModal = document.getElementById('returnModal');
        const closeReturnModal = document.getElementById('closeReturnModal');
        const cancelReturnModal = document.getElementById('cancelReturnModal');
        const returnSelectedBtn = document.getElementById('returnSelectedBtn');
        const returnAllBtn = document.getElementById('returnAllBtn');

        // Khi người dùng nhấn nút "Ghi trả" ở bảng, mở modal
        document.querySelectorAll('.returnBookBtn').forEach(btn => {
            btn.addEventListener('click', () => {
                returnModal.classList.remove('hidden');
            });
        });

        // Hàm đóng modal
        function closeModal() {
            returnModal.classList.add('hidden');
        }

        closeReturnModal.addEventListener('click', closeModal);
        cancelReturnModal.addEventListener('click', closeModal);

        // Xử lý ghi trả đã chọn
        returnSelectedBtn.addEventListener('click', function() {
            // Lấy danh sách sách được chọn
            const selectedBooks = Array.from(document.querySelectorAll(
                    '#borrowedBooksList input[type="checkbox"]:checked'))
                .map(input => input.value);
            if (selectedBooks.length === 0) {
                alert('Vui lòng chọn ít nhất một sách!');
                return;
            }
            // Xử lý ghi trả các sách đã chọn (ví dụ: gửi AJAX)
            alert('Ghi trả sách có ID: ' + selectedBooks.join(', '));
            closeModal();
        });

        // Xử lý ghi trả tất cả
        returnAllBtn.addEventListener('click', function() {
            // Xử lý ghi trả tất cả sách (ví dụ: gửi AJAX)
            alert('Ghi trả tất cả các sách!');
            closeModal();
        });

        // Đóng modal khi click bên ngoài nội dung modal
        window.addEventListener('click', function(e) {
            if (e.target === returnModal) {
                // closeModal();
                e.preventDefault();
            }
        });

        // Lấy các phần tử liên quan đến modal ghi mượn
        const loanBtns = document.querySelectorAll('.loanBookBtn');
        const loanModal = document.getElementById('loanModal');
        const closeLoanModal = document.getElementById('closeLoanModal');
        const cancelLoanModal = document.getElementById('cancelLoanModal');
        const loanForm = document.getElementById('loanForm');

        // Hàm mở modal
        function openLoanModal() {
            loanModal.classList.remove('hidden');
        }

        // Hàm đóng modal
        function closeLoanModalFunc() {
            loanModal.classList.add('hidden');
        }

        // Gán sự kiện cho các nút "Ghi mượn"
        loanBtns.forEach(btn => {
            btn.addEventListener('click', openLoanModal);
        });

        // Gán sự kiện cho nút đóng modal và nút "Hủy"
        closeLoanModal.addEventListener('click', closeLoanModalFunc);
        cancelLoanModal.addEventListener('click', closeLoanModalFunc);

        // Xử lý submit form ghi mượn
        loanForm.addEventListener('submit', function(e) {
            e.preventDefault();
            // Xử lý lưu thông tin ghi mượn (ví dụ: AJAX hoặc gửi form)
            alert('Ghi mượn thành công!');
            closeLoanModalFunc();
        });

        // Đóng modal khi click bên ngoài nội dung modal
        window.addEventListener('click', function(e) {
            if (e.target === loanModal) {
                // closeLoanModalFunc();
                e.preventDefault();
            }
        });
    </script>
@endsection
