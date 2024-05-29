import "bootstrap";
import "./jquery/jquery.min.js";
import "./bootstrap/js/bootstrap.bundle.js";
import "./jquery-easing/jquery.easing.min.js";
import DataTable from "datatables.net-bs4";
import "animate.css";
// Page Level Js
import Chart from "chart.js/auto";
import Swal from "sweetalert2";
import "../../node_modules/select2/dist/js/select2.full.min.js";

// Chart Js Codes
const book_count_chart = document.getElementById("book_count_chart");
window.showBookCountChart = function showBookCountChart(category_titles) {
    new Chart(book_count_chart, {
        type: "bar",
        data: {
            datasets: [
                {
                    data: category_titles,
                    backgroundColor: [
                        "rgba(255, 99, 132, 0.2)",
                        "rgba(255, 159, 64, 0.2)",
                        "rgba(255, 205, 86, 0.2)",
                        "rgba(75, 192, 192, 0.2)",
                        "rgba(54, 162, 235, 0.2)",
                        "rgba(153, 102, 255, 0.2)",
                        "rgba(201, 203, 207, 0.2)",
                    ],
                    borderColor: [
                        "rgb(255, 99, 132)",
                        "rgb(255, 159, 64)",
                        "rgb(255, 205, 86)",
                        "rgb(75, 192, 192)",
                        "rgb(54, 162, 235)",
                        "rgb(153, 102, 255)",
                        "rgb(201, 203, 207)",
                    ],
                    borderWidth: 1,
                },
            ],
        },
        options: {
            plugins: {
                legend: {
                    display: false,
                },
            },
            scales: {
                y: {
                    beginAtZero: false,
                },
            },
        },
    });
};

function getLastSixMonths() {
    var months = [];
    var currentDate = new Date();

    // Array of month names
    var monthNames = [
        "Jan",
        "Feb",
        "Mar",
        "Apr",
        "May",
        "Jun",
        "Jul",
        "Aug",
        "Sep",
        "Oct",
        "Nov",
        "Dec",
    ];

    for (var i = 0; i < 6; i++) {
        var month = monthNames[currentDate.getMonth()];
        months.unshift(month);

        // Move to the previous month
        currentDate.setMonth(currentDate.getMonth() - 1);
    }

    return months;
}

const transaction_count_chart = document.getElementById(
    "transaction_count_chart"
);
window.showTransactionCountChart = function showTransactionCountChart(
    transactionCountsInLastSixMonth
) {
    const data = Object.keys(transactionCountsInLastSixMonth)
        .reverse()
        .reduce((acc, key) => {
            acc[key] = transactionCountsInLastSixMonth[key];
            return acc;
        }, {});
    new Chart(transaction_count_chart, {
        type: "line",
        data: {
            // labels: getLastSixMonths(),
            datasets: [
                {
                    data: data,
                    fill: false,
                    borderColor: "rgb(75, 192, 192)",
                    tension: 0.1,
                },
            ],
        },
        options: {
            plugins: {
                legend: {
                    display: false,
                },
            },
            scales: {
                y: {
                    beginAtZero: false,
                },
            },
        },
    });
};

// Chart Js Codes

window.showToast = function showToast(message) {
    const Toast = Swal.mixin({
        toast: true,
        position: "bottom-start",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
        },
    });
    Toast.fire({
        icon: "success",
        title: message,
    });
};

(function ($) {
    "use strict"; // Start of use strict
    $(".my_select").select2();
    // Toggle the side navigation
    $("#sidebarToggle, #sidebarToggleTop").on("click", function (e) {
        $("body").toggleClass("sidebar-toggled");
        $(".sidebar").toggleClass("toggled");
        if ($(".sidebar").hasClass("toggled")) {
            $(".sidebar .collapse").collapse("hide");
        }
    });

    // Close any open menu accordions when window is resized below 768px
    $(window).resize(function () {
        if ($(window).width() < 768) {
            $(".sidebar .collapse").collapse("hide");
        }

        // Toggle the side navigation when window is resized below 480px
        if ($(window).width() < 480 && !$(".sidebar").hasClass("toggled")) {
            $("body").addClass("sidebar-toggled");
            $(".sidebar").addClass("toggled");
            $(".sidebar .collapse").collapse("hide");
        }
    });

    // Prevent the content wrapper from scrolling when the fixed side navigation hovered over
    $("body.fixed-nav .sidebar").on(
        "mousewheel DOMMouseScroll wheel",
        function (e) {
            if ($(window).width() > 768) {
                var e0 = e.originalEvent,
                    delta = e0.wheelDelta || -e0.detail;
                this.scrollTop += (delta < 0 ? 1 : -1) * 30;
                e.preventDefault();
            }
        }
    );

    // Scroll to top button appear
    $(document).on("scroll", function () {
        var scrollDistance = $(this).scrollTop();
        if (scrollDistance > 100) {
            $(".scroll-to-top").fadeIn();
        } else {
            $(".scroll-to-top").fadeOut();
        }
    });

    // Smooth scrolling using jQuery easing
    $(document).on("click", "a.scroll-to-top", function (e) {
        var $anchor = $(this);
        $("html, body")
            .stop()
            .animate(
                {
                    scrollTop: $($anchor.attr("href")).offset().top,
                },
                1000,
                "easeInOutExpo"
            );
        e.preventDefault();
    });

    new DataTable("#dataTable");
})(jQuery); // End of use strict
