import axios from "axios";

window.updateCart = function updateCart(cartId, action) {
    var totalAmount = document.getElementById("totalAmount");
    var fromTotalAmount = document.getElementById("fromTotalAmount");

    var currentCartCount = document.getElementById("currentCartCount" + cartId);
    var loadingBtn = document.getElementById("loading_btn" + cartId);
    var updateDiv = document.getElementById("update_div" + cartId);

    var updateActionInput = document.getElementById("updateAction" + cartId);
    updateActionInput.value = action;

    var form = document.getElementById("cart_form" + cartId);
    var formData = new FormData(form);

    updateDiv.classList.remove("d-inline-flex");
    updateDiv.classList.add("d-none");
    loadingBtn.classList.remove("d-none");
    loadingBtn.classList.add("d-flex");

    axios
        .post(form.action, formData)
        .then(function (response) {
            // Handle response
            setTimeout(function () {
                updateDiv.classList.remove("d-none");
                updateDiv.classList.add("d-inline-flex");
                loadingBtn.classList.remove("d-flex");
                loadingBtn.classList.add("d-none");
                showToast(response.data.message);
                currentCartCount.innerText = response.data.newQty;
                if (response.data.newQty == 0) {
                    window.location.reload();
                }
                totalAmount.innerText = response.data.totalCost + " Kyats";
                fromTotalAmount.value = response.data.totalCost;
            }, 1000);
        })
        .catch(function (error) {
            // Handle error
        });
};
