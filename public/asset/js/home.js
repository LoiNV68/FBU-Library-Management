function initDashboard (stats) {
    // Biểu đồ quản lý sách
    const ctxBooks = document.getElementById("chartBooks").getContext("2d");
    const chartBooks = new Chart(ctxBooks, {
        type: "bar",
        data: {
            labels: [
                "Tổng số sách",
                "Sách sẵn sàng cho mượn",
                "Sách đang mượn",
                "Sách bị mất, hỏng",
            ],
            datasets: [
                {
                    label: "Số lượng",
                    data: [
                        stats.totalBooks,
                        stats.availableBooks,
                        stats.borrowedBooks,
                        stats.brokenBooks,
                    ],
                    backgroundColor: [
                        "rgba(50, 148, 201, 0.2)",
                        "rgba(75, 192, 192, 0.2)",
                        "rgba(255, 159, 64, 0.2)",
                        "rgba(255, 99, 132, 0.2)",
                    ],
                    borderColor: [
                        "rgba(50, 148, 201, 1)",
                        "rgba(75, 192, 192, 1)",
                        "rgba(255, 159, 64, 1)",
                        "rgba(255, 99, 132, 1)",
                    ],
                    borderWidth: 1,
                },
            ],
        },
        options: {
            plugins: {
                legend: { display: false },
            },
            scales: {
                y: { beginAtZero: true },
            },
        },
    });

    // Biểu đồ quản lý bạn đọc
    const ctxReaders = document.getElementById("chartReaders").getContext("2d");
    const chartReaders = new Chart(ctxReaders, {
        type: "bar",
        data: {
            labels: [
                "Tổng số bạn đọc",
                "Bạn đọc đang mượn",
                "Bạn đọc mới (tháng)",
                "Bạn đọc vi phạm",
            ],
            datasets: [
                {
                    label: "Số lượng",
                    data: [
                        stats.totalReaders,
                        stats.borrowedReaders,
                        stats.newReaders,
                        stats.banedReaders,
                    ],
                    backgroundColor: [
                        "rgba(153, 102, 255, 0.2)",
                        "rgba(54, 162, 235, 0.2)",
                        "rgba(255, 99, 132, 0.2)",
                        "rgba(255, 206, 86, 0.2)",
                    ],
                    borderColor: [
                        "rgba(153, 102, 255, 1)",
                        "rgba(54, 162, 235, 1)",
                        "rgba(255, 99, 132, 1)",
                        "rgba(255, 206, 86, 1)",
                    ],
                    borderWidth: 1,
                },
            ],
        },
        options: {
            plugins: {
                legend: { display: false },
            },
            scales: {
                y: { beginAtZero: true },
            },
        },
    });

    // Biểu đồ quản lý mượn/trả
    const ctxLoan = document.getElementById("chartLoan").getContext("2d");
    const chartLoan = new Chart(ctxLoan, {
        type: "bar",
        data: {
            labels: ["Sách đã mượn", "Sách đã trả", "Sách quá hạn chưa trả"],
            datasets: [
                {
                    label: "Số lượng",
                    data: [
                        stats.borrowedBooks,
                        stats.returnedBooks,
                        stats.overdueBooks,
                    ],
                    backgroundColor: [
                        "rgba(255, 206, 86, 0.2)",
                        "rgba(75, 192, 192, 0.2)",
                        "rgba(255, 99, 132, 0.2)",
                    ],
                    borderColor: [
                        "rgba(255, 206, 86, 1)",
                        "rgba(75, 192, 192, 1)",
                        "rgba(255, 99, 132, 1)",
                    ],
                    borderWidth: 1,
                },
            ],
        },
        options: {
            plugins: {
                legend: { display: false },
            },
            scales: {
                y: { beginAtZero: true },
            },
        },
    });
};
