$(function () {
    // Xử lý modal chỉnh sửa
    const $editButtons = $(".editBookBtn");
    const $modal = $("#editBookModal");
    const closeModal = $("#closeModal");
    const cancelModal = $("#cancelModal");
    const $editForm = $("#editBookForm");
    const $addBookBtn = $("#addBookBtn");
    const $formTitle = $("#formTitle");
    const $inputBroken = $(".book-lost");
    const $errorMessages = $(".error-message");
    let validateUpdate = $("#editBookForm").data("validate-update");
    let validateAdd = $("#editBookForm").data("validate-add");
    function handleAddBook() {
        // Đổi title
        $formTitle.text("Thêm sách mới");
        // Xóa trường broken
        $inputBroken.addClass("hidden");
        // Thay đổi action của form thành route('book.add')
        $editForm.attr("action", "/quan-ly-sach/book/add");
        // Reset form
       
        // Mở modal
        $modal.removeClass("hidden");
    }
    $addBookBtn.on("click", handleAddBook);

    if (validateAdd === 1) {
        handleAddBook();
    }
    function handleEditBook() {
        // Đổi title
        $formTitle.text("Sửa thông tin sách");
        // Thêm trường broken
        $inputBroken.removeClass("hidden");
        // Thay đổi action của form thành route('book.update')
        $editForm.attr("action", "/quan-ly-sach/book/update");
        // Reset Validate
        $errorMessages.text("");
        // Mở modal
        $modal.removeClass("hidden");
    }

    // Nếu có lỗi validateUpdate, tự động mở modal và thiết lập form
    if (validateUpdate === 1) {
        handleEditBook();
    }
    // Khi người dùng bấm vào nút sửa, cũng thực thi hàm
    $editButtons.on("click", handleEditBook);
    // Xử lý đóng modal
    [closeModal, cancelModal].forEach((button) => {
        $(button).on("click", () => {
            $modal.addClass("hidden");
            $editForm.trigger("reset");
        });
    });

    // Hàm mở modal thông báo
    function showNotificationModal(title, message) {
        $("#modalTitle").text(title);
        $("#modalMessage").text(message);
        $("#notificationModal").removeClass("hidden");
    }

    // Hàm reload trang khi người dùng bấm OK
    function reloadPage() {
        window.location.reload(); // Tải lại trang
    }

    $("#modalOkBtn").on("click", reloadPage);

    // Điền data khi open modal
    $editButtons.each(function () {
        $(this).on("click", function () {
            try {
                const row = $(this).closest("tr");
                const bookData = JSON.parse(row.attr("data-book"));

                // Kiểm tra dữ liệu sách
                if (!bookData || !bookData.id) {
                    throw new Error("Dữ liệu sách không hợp lệ");
                }

                // Reset form trước khi điền dữ liệu
                $editForm.trigger("reset");

                // Điền dữ liệu vào form
                const fields = [
                    "book_id",
                    "book_code",
                    "book_name",
                    "book_type",
                    "author",
                    "quantity",
                    "broken",
                    "description",
                ];

                fields.forEach((field) => {
                    const input = $editForm.find(`[name="${field}"]`);

                    if (input.length) {
                        input.val(bookData[field]);
                    }
                });

                $modal.removeClass("hidden");
            } catch (error) {
                console.error(error);
            }
        });
    });

    // Xử lý chức năng xóa
    const deleteBookBtns = $(".deleteBookBtn");
    const deleteBookModal = $("#deleteBookModal");
    const closeDeleteModalBtn = $("#closeDeleteModal");
    const cancelDeleteModalBtn = $("#cancelDeleteModal");
    const confirmDeleteModalBtn = $("#confirmDeleteModal");
    let currentBookId = null;

    function openDeleteModal(bookId) {
        currentBookId = bookId;
        deleteBookModal.removeClass("hidden");
    }

    function closeDeleteModal() {
        deleteBookModal.addClass("hidden");
        currentBookId = null;
    }

    deleteBookBtns.each(function () {
        $(this).on("click", function () {
            const row = $(this).closest("tr");
            const bookData = JSON.parse(row.attr("data-book"));
            openDeleteModal(bookData.book_code);
        });
    });

    [closeDeleteModalBtn, cancelDeleteModalBtn].forEach((btn) => {
        $(btn).on("click", closeDeleteModal);
    });

    confirmDeleteModalBtn.on("click", function () {
        if (!currentBookId) {
            return;
        }

        const token = $('meta[name="csrf-token"]');
        if (!token.length || !token.attr("content")) {
            return;
        }
        console.log(currentBookId);

        $.ajax({
            type: "POST",
            url: `/quan-ly-sach/book/delete/${currentBookId}`,
            headers: {
                "X-CSRF-TOKEN": token.attr("content"),
            },
            success: function (response) {
                console.log("Xóa thành công:", response);
                showNotificationModal("Thành công", "Xóa sách thành công!");

                closeDeleteModal();
                // window.location.reload();
            },
            error: function (xhr) {
                console.log("Lỗi chi tiết:", xhr.responseText);
                closeDeleteModal();
            },
        });
    });

    // Ngăn đóng modal khi click bên ngoài
    $(window).on("click", function (e) {
        if (e.target === deleteBookModal[0] || e.target === $modal[0]) {
            e.preventDefault();
        }
    });
});
