@extends('layout.main')
@section('title')
    {{ $title }}
@endsection
@section('titleWeb')
    {{ $titleWeb }}
@endsection
@section('content')
    <!-- Search Box -->
    <div class="mb-6 flex items-center gap-2">
        <input type="text"
            class="flex-grow max-w-md px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-primary shadow-sm"
            placeholder="Tìm kiếm bạn đọc, giáo trình..." />
        <button class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-300"><i
                class="fas fa-search"></i> <!-- Icon tìm kiếm -->
            <span>Tìm kiếm</span></button>
        <button class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition duration-300 loanBookBtn">
            <i class="fas fa-plus"></i> <!-- Icon thêm -->
            <span>Ghi mượn</span>
        </button>
        <!-- Nút Làm mới -->
        <button onclick="event.preventDefault(); window.location.reload();"
            class="bg-amber-500 text-white px-4 py-2 rounded-lg hover:bg-amber-600 transition duration-300 flex items-center gap-2">
            <i class="fas fa-sync-alt"></i> <!-- Icon làm mới -->
            <span>Làm mới</span>
        </button>

    </div>

    <!-- Table -->
    <div class="overflow-x-auto max-w-7xl bg-white rounded-lg shadow-md">
        <table class="w-full border-collapse ">
            <thead>
                <tr class="bg-primary text-white">
                    <th class="p-4 text-left text-nowrap">Ngày hết hạn</th>
                    <th class="p-4 text-left">Mã sách</th>
                    <th class="p-4 text-left ">Tên sách</th>
                    <th class="p-4 text-left text-nowrap">Kiểu tài liệu</th>
                    <th class="p-4 text-left text-nowrap">Ngày ghi mượn</th>
                    <th class="p-4 text-left">Bạn đọc</th>
                    <th class="p-4 text-left">Mã sinh viên</th>
                    <th class="p-4 text-left">Số lượng sách mượn</th>
                    <th class="p-4 text-left">Quá hạn</th>
                    <th class="p-4 text-left">Đã trả</th>
                    <th class="p-4 text-left">Ghi chú</th>
                    <th class="p-4 text-center sticky right-0 bg-primary z-2">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @if (isset($transactions) && $transactions->isNotEmpty())
                    @foreach ($transactions as $transaction)
                        <tr class="border-b hover:bg-gray-50 transition duration-200">
                            <td class="p-4">{{ formatDate($transaction->return_day, 'd-m-Y') }}</td>
                            <td class="p-4">{{ $transaction->book_code }}</td>
                            <td class="p-4 text-nowrap">{{ $transaction->book_name }}</td>
                            <td class="p-4">{{ $transaction->book_type }}</td>
                            <td class="p-4">{{ formatDate($transaction->borrow_day, 'd-m-Y') }}</td>
                            <td class="p-4 text-nowrap">{{ $transaction->student_name }}</td>
                            <td class="p-4">{{ $transaction->student_code }}</td>
                            <td class="p-4">{{ $transaction->quantity_borrow }}</td>
                            <td class="p-4">
                                @if ($transaction->overdue)
                                    <div
                                        class="font-bold text-red-500 w-[116px] px-4 py-2 rounded-lg transition duration-300 text-left">
                                        Đã quá hạn
                                    </div>
                                @else
                                    <div
                                        class="font-bold text-green-500 w-[116px] px-4 py-2 rounded-lg transition duration-300 text-left">
                                        Không
                                    </div>
                                @endif
                            </td>
                            <td class="p-4">
                                @if ($transaction->is_return)
                                    <div
                                        class="font-bold text-green-500 w-[116px] px-4 py-2 rounded-lg transition duration-300 text-left">
                                        Đã trả
                                    </div>
                                @else
                                    <div
                                        class="font-bold text-red-500 w-[116px] px-4 py-2 rounded-lg transition duration-300 text-left">
                                        Chưa trả
                                    </div>
                                @endif

                            </td>
                            <td class="p-4"></td>
                            <td class="p-4 sticky right-0 bg-white z-2">
                                @if ($transaction->is_return)
                                    <div class="flex space-x-2 justify-center">
                                        <button
                                            class="bg-blue-500 text-white w-[175px] px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-300">Không
                                            hành động</button>
                                    </div>
                                @else
                                    <div class="flex space-x-2">
                                        <button
                                            class="bg-blue-500 text-white  text-nowrap px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-300 extendBtn">Gia
                                            hạn</button>
                                        <button
                                            class="bg-red-500 text-white  text-nowrap px-4 py-2 rounded-lg hover:bg-red-600 transition duration-300 returnBookBtn">Ghi
                                            trả</button>
                                    </div>
                                @endif

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
    @if (isset($transactions) && $transactions->isNotEmpty())
        <div class="py-8">
            {{ $transactions->links() }}
        </div>
    @endif
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
                <div class="flex items-center p-2">
                    <div class="flex flex-col">
                        <div>
                            <span class="text-xl text-primary font-bold">DC12323</span>
                            <span>Ứng dụng công nghệ thông tin trong dạy học</span>
                        </div>
                        <div class="mt-2 flex items-center">
                            <label for="returnQuantity1" class="mr-2 text-sm text-gray-600">Số lượng trả:</label>
                            <input id="returnQuantity1" type="number" name="return_quantity_1" min="1"
                                value="1" class="w-16 border rounded-md p-1">
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex justify-end space-x-2">
                <button id="cancelReturnModal" type="button"
                    class="px-4 py-2 bg-gray-500 text-white rounded-lg">Hủy</button>

                <button id="returnAllBtn" type="button" class="px-4 py-2 bg-green-500 text-white rounded-lg">Ghi
                    trả</button>
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
                    <label class="block text-gray-700">Mã sinh viên</label>
                    <input type="text" name="student_code" class="w-full border rounded-lg p-2"
                        placeholder="Nhập tên sách" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Mã sách</label>
                    <input type="text" name="book_code" class="w-full border rounded-lg p-2"
                        placeholder="Nhập tên sách" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Số lượng mượn</label>
                    <input type="number" name="quantity" class="w-full border rounded-lg p-2"
                        placeholder="Nhập số lượng" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Ngày mượn</label>
                    <input type="date" name="borrow_date" class="w-full border rounded-lg p-2"
                        min="{{ date('Y-m-d') }}" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Ngày trả</label>
                    <input type="date" name="return_date" class="w-full border rounded-lg p-2"
                        min="{{ date('Y-m-d') }}" required>
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Modal Gia hạn (Extend Modal)
            const extendBtns = document.querySelectorAll('.extendBtn');
            const extendModal = document.getElementById('extendModal');
            const closeExtendModal = document.getElementById('closeExtendModal');
            const cancelExtendModal = document.getElementById('cancelExtendModal');
            const extendForm = document.getElementById('extendForm');

            function openExtendModal() {
                extendModal.classList.remove('hidden');
            }

            function closeExtendModalFunc() {
                extendModal.classList.add('hidden');
            }

            extendBtns.forEach(btn => {
                btn.addEventListener('click', openExtendModal);
            });
            closeExtendModal.addEventListener('click', closeExtendModalFunc);
            cancelExtendModal.addEventListener('click', closeExtendModalFunc);
            extendForm.addEventListener('submit', function(e) {
                e.preventDefault();
                alert('Gia hạn thành công!');
                closeExtendModalFunc();
            });

            // Modal Ghi Trả (Return Modal)
            const returnBtns = document.querySelectorAll('.returnBookBtn');
            const returnModal = document.getElementById('returnModal');
            const closeReturnModal = document.getElementById('closeReturnModal');
            const cancelReturnModal = document.getElementById('cancelReturnModal');
            const returnAllBtn = document.getElementById('returnAllBtn');

            function openReturnModal() {
                returnModal.classList.remove('hidden');
            }

            function closeReturnModalFunc() {
                returnModal.classList.add('hidden');
            }

            returnBtns.forEach(btn => {
                btn.addEventListener('click', openReturnModal);
            });
            closeReturnModal.addEventListener('click', closeReturnModalFunc);
            cancelReturnModal.addEventListener('click', closeReturnModalFunc);

            returnAllBtn.addEventListener('click', function() {
                alert('Ghi trả tất cả các sách!');
                closeReturnModalFunc();
            });

            // Modal Ghi Mượn (Loan Modal)
            const loanBtn = document.querySelector('.loanBookBtn');
            const loanModal = document.getElementById('loanModal');
            const closeLoanModal = document.getElementById('closeLoanModal');
            const cancelLoanModal = document.getElementById('cancelLoanModal');
            const loanForm = document.getElementById('loanForm');

            function openLoanModal() {
                loanModal.classList.remove('hidden');
            }

            function closeLoanModalFunc() {
                loanModal.classList.add('hidden');
            }



            loanBtn.addEventListener('click', openLoanModal);


            closeLoanModal.addEventListener('click', closeLoanModalFunc);
            cancelLoanModal.addEventListener('click', closeLoanModalFunc);
            loanForm.addEventListener('submit', function(e) {
                e.preventDefault();
                alert('Ghi mượn thành công!');
                closeLoanModalFunc();
            });
        });
    </script>
@endsection
