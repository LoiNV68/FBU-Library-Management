$(function () {
    // Modal Gia hạn (Extend Modal)
    const $extendButtons = $(".extendBtn");
    const $extendModal = $("#extendModal");
    const $closeExtendModal = $("#closeExtendModal");
    const $cancelExtendModal = $("#cancelExtendModal");
    const $transactionIdInput = $("input[name='transaction_id']");

    $extendButtons.on("click", function () {
        const transactionId = $(this).attr("data-transaction-id");

        $transactionIdInput.val(transactionId);

        $extendModal.removeClass("hidden");
    });

    $closeExtendModal.on("click", function () {
        $extendModal.addClass("hidden");
    });

    $cancelExtendModal.on("click", function () {
        $extendModal.addClass("hidden");
    });

    // Modal Ghi Trả (Return Modal)
    const $returnBtns = $(".returnBookBtn");
    const $returnModal = $("#returnModal");
    const $closeReturnModal = $("#closeReturnModal");
    const $cancelReturnModal = $("#cancelReturnModal");
    const $inputReturn = $("#returnQuantity");
    function openReturnModal() {
        $returnModal.removeClass("hidden");
    }

    function closeReturnModalFunc() {
        $returnModal.addClass("hidden");
    }

    $returnBtns.on("click", function () {
        const quantityBorrow = parseInt($(this).attr("data-quantity-borrow")); // Chuyển đổi thành số
        const bookCode = $(this).attr("data-book-code"); // Lấy mã sách
        $("#bookCode").text(bookCode);
        $('input[name="book_code_return"]').val(bookCode);
        openReturnModal();

        $inputReturn.val(quantityBorrow);

        // Xóa các trình xử lý sự kiện input trước đó để tránh trùng lặp
        $inputReturn.off("input").on("input", function () {
            const quantityInput = parseInt($(this).val()); // Lấy và chuyển đổi giá trị nhập vào
            if (quantityInput > quantityBorrow) {
                alert("Số lượng bạn nhập không được lớn hơn số lượng mượn!");
                $(this).val(quantityBorrow); // Đặt lại giá trị tối đa cho phép
            }
        });
    });

    $closeReturnModal.on("click", closeReturnModalFunc);
    $cancelReturnModal.on("click", closeReturnModalFunc);

    // Modal Ghi Mượn (Loan Modal)
    // Khi người dùng nhập số lượng
    let debounceTimer;

    $('input[name="quantity"]').on("input", function () {
        clearTimeout(debounceTimer); // Xóa timer trước đó (nếu có)

        debounceTimer = setTimeout(() => {
            console.log("Debounced API Call");

            const bookCode = $('input[name="book_code"]').val(); // Lấy mã sách
            const quantityInput = $(this); // Lưu input quantity

            if (!bookCode) return;

            // Gọi API để kiểm tra số lượng sách còn lại
            $.ajax({
                url: `/quan-ly-muon-tra/check-book-quantity`,
                method: "GET",
                data: { book_code: bookCode },
                success: function (response) {
                    if (response.error) {
                        alert(response.error);
                        return;
                    }

                    const maxQuantity = response.quantity; // Số lượng sách có sẵn
                    let quantity = parseInt(quantityInput.val(), 10) || 0; // Lấy số lượng mượn, tránh NaN

                    console.log("maxQuantity:", maxQuantity);
                    console.log("quantity:", quantity);

                    // Nếu số lượng nhập vào lớn hơn số sách có sẵn
                    if (quantity > maxQuantity) {
                        alert(
                            `Số lượng mượn vượt quá số lượng sách hiện có (${maxQuantity}).`
                        );
                        quantityInput.val(maxQuantity); // Đặt lại giá trị tối đa
                    }
                },
                error: function (message) {
                    alert(message.responseJSON.error);
                },
            });
        }, 200); // Debounce 500ms
    });

    // Khi thay đổi mã sách, tự động reset số lượng về rỗng
    $('input[name="book_code"]').on("change", function () {
        $('input[name="quantity"]').val(""); // Reset số lượng
    });

    const $loanBtn = $(".loanBookBtn");
    const $loanModal = $("#loanModal");
    const $closeLoanModal = $("#closeLoanModal");
    const $cancelLoanModal = $("#cancelLoanModal");
    const $loanForm = $("#loanForm");

    function openLoanModal() {
        $loanModal.removeClass("hidden");
    }

    function closeLoanModalFunc() {
        $loanModal.addClass("hidden");
    }

    $loanBtn.on("click", openLoanModal);
    $closeLoanModal.on("click", closeLoanModalFunc);
    $cancelLoanModal.on("click", closeLoanModalFunc);
});
