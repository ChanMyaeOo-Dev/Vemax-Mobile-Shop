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
const order_count_chart = document.getElementById("order_count_chart");
window.showOrderCountChart = function showOrderCountChart(
    orderCountsInLastSixMonth
) {
    const data = Object.keys(orderCountsInLastSixMonth)
        .reverse()
        .reduce((acc, key) => {
            acc[key] = orderCountsInLastSixMonth[key];
            return acc;
        }, {});

    new Chart(order_count_chart, {
        type: "line",
        data: {
            // labels: ["Day 1", "Day 2", "Day 3", "Day 4", "Day 5", "Day 6"],
            datasets: [
                {
                    data: data,
                    fill: false,
                    tension: 0.4,
                    borderColor: "#2275fc",
                    backgroundColor: "#2275fc50",
                    fill: true,
                    pointStyle: "circle",
                    pointRadius: 6,
                    pointHoverRadius: 10,
                },
            ],
        },
        options: {
            responsive: true,
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
