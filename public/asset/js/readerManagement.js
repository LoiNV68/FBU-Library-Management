// Xử lý chức năng cấm
const banReaderBtns = $(".banReaderBtn");
const deleteBookModal = $("#deleteBookModal");
const closeDeleteModalBtn = $("#closeDeleteModal");
const cancelDeleteModalBtn = $("#cancelDeleteModal");
const confirmDeleteModalBtn = $("#confirmDeleteModal");
const unbanBookBtns = $(".unbanReaderBtn");
let currentStudentCode = null;
let currentStudent = null;

function openDeleteModal(student_code) {
    currentStudentCode = student_code;
    deleteBookModal.removeClass("hidden");
}

function closeDeleteModal() {
    deleteBookModal.addClass("hidden");
    currentStudentCode = null;
}
// Xử lý cấm
$(document).on("click", ".banReaderBtn", function () {
    const row = $(this).closest("tr");
    currentStudent = row;
    const readerData = JSON.parse(row.attr("data-reader"));
    openDeleteModal(readerData.student_code);
});
// Xử lý bỏ cấm
$(document).on("click", ".unbanReaderBtn", function () {
    $("#modalTitle").text("Gỡ cấm mượn");
    $("#modalContent").text("Bạn có muốn gỡ cấm mượn bạn đọc này không ?");
    const row = $(this).closest("tr");
    currentStudent = row;
    const readerData = JSON.parse(row.attr("data-reader"));
    openDeleteModal(readerData.student_code);
});
[closeDeleteModalBtn, cancelDeleteModalBtn].forEach((btn) => {
    $(btn).on("click", closeDeleteModal);
});

confirmDeleteModalBtn.on("click", function () {
    if (!currentStudentCode) {
        return;
    }

    const token = $('meta[name="csrf-token"]');
    if (!token.length || !token.attr("content")) {
        return;
    }

    const action = currentStudent.hasClass("ban") ? "unban" : "ban";
    const url = `/quan-ly-ban-doc/reader/ban`;

    $.ajax({
        type: "POST",
        url: url,
        headers: {
            "X-CSRF-TOKEN": token.attr("content"),
        },
        data: { student_code: currentStudentCode, action: action },
        dataType: "json",
        success: function (response) {
            currentStudent.toggleClass("ban");
            // Cập nhật nút trong hàng hiện tại
            const actionsDiv = currentStudent.find("td:last-child .flex");

            if (action === "ban") {
                // Nếu vừa cấm: thay thế nút "Cấm mượn" thành nút "Bỏ cấm"
                actionsDiv
                    .find(".banReaderBtn")
                    .replaceWith(
                        '<button class="bg-green-500 text-white px-4 py-2 w-[110px] rounded-lg hover:bg-green-600 transition duration-300 unbanReaderBtn">Bỏ cấm</button>'
                    );
            } else if (action === "unban") {
                // Nếu vừa bỏ cấm: thay thế nút "Bỏ cấm" thành nút "Cấm mượn"
                actionsDiv
                    .find(".unbanReaderBtn")
                    .replaceWith(
                        '<button class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition duration-300 banReaderBtn">Cấm mượn</button>'
                    );
            }
            closeDeleteModal();
        },
        error: function (xhr) {
            console.log("Lỗi chi tiết:", xhr.responseText);
            closeDeleteModal();
        },
    });
});

// check cấm trước khi cho mượn
$(".loanBtn").on("click", function () {
    const studentCode = $(this).data("student-code");

    // Gọi API kiểm tra sinh viên có bị cấm không
    $.ajax({
        url: `/quan-ly-ban-doc/check-student-ban`,
        method: "GET",
        data: { student_code: studentCode },
        success: function (response) {
            if (response.ban) {
                $("#banModal").removeClass("hidden"); // Hiển thị modal
            } else {
                // Nếu không bị cấm, chuyển hướng
                console.log("22");

                window.location.href = `/quan-ly-muon-tra/transaction?student_code=${studentCode}`;
            }
        },
        error: function () {
            alert("Lỗi kiểm tra trạng thái sinh viên!");
        },
    });
});

// Đóng modal khi bấm nút "Đóng"
$("#closeModal").on("click", function () {
    $("#banModal").addClass("hidden");
});

$(window).on("click", function (e) {
    if (e.target === deleteBookModal[0]) {
        e.preventDefault();
        closeDeleteModal();
    }
});
