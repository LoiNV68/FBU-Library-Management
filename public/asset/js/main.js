$(function () {
    // Toggle sidebar khi click vào nút (nếu có)
    $("#toggleSidebar").on("click", function () {
        $(".sidebar-gradient").toggleClass("collapsed");
    });

    // Tự động thu nhỏ sidebar khi màn hình nhỏ
    function checkWindowSize() {
        if ($(window).width() <= 768) {
            $(".sidebar-gradient").addClass("collapsed");
        } else {
            $(".sidebar-gradient").removeClass("collapsed");
        }
    }

    // Kiểm tra kích thước màn hình khi tải trang và khi thay đổi kích thước
    checkWindowSize();
    $(window).on("resize", checkWindowSize);
});
