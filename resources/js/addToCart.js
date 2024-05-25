import axios from "axios";

document.addEventListener("DOMContentLoaded", function () {
    // Listen for form submissions
    var forms = document.querySelectorAll(".addToCartForm");

    forms.forEach(function (form) {
        form.addEventListener("submit", function (event) {
            event.preventDefault(); // Prevent the default form submission
            var formData = new FormData(this); // Create FormData object to send form data
            var productId = this.querySelector(
                'input[name="product_id"]'
            ).value;
            var submitBtn = document.getElementById(
                "cart_submit_btn" + productId
            );
            var loadingBtn = document.getElementById("loading_btn" + productId);
            submitBtn.classList.add("d-none");
            loadingBtn.classList.remove("d-none");
            loadingBtn.classList.add("d-flex");
            axios
                .post(this.action, formData) // Use axios to send a POST request
                .then(function (response) {
                    // Hide the loading button when the cart is finished updating
                    setTimeout(function () {
                        submitBtn.classList.remove("d-none");
                        loadingBtn.classList.remove("d-flex");
                        loadingBtn.classList.add("d-none");
                        showToast(response.data.message); // updateCartCount
                        var cartCountSpan =
                            document.getElementById("cartCount");
                        var cartCountBtn =
                            document.getElementById("cart_count_btn");
                        cartCountBtn.classList.add(
                            "animate__animated",
                            "animate__rubberBand"
                        );
                        cartCountBtn.addEventListener("animationend", () => {
                            cartCountBtn.classList.remove(
                                "animate__animated",
                                "animate__rubberBand"
                            );
                        });
                        cartCountSpan.innerText = response.data.count;
                    }, 1000);
                })
                .catch(function (error) {
                    console.error(error);
                });
        });
    });
});
