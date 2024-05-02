var price = document.getElementById("price");
var totalAmount = document.getElementById("total_amount");
var totalAmountShow = document.getElementById("totalAmountShow");
var qtyInput = document.getElementById("qtyInput");
var currentQty = document.getElementById("currentQty");

window.qtyAdd = function qtyAdd() {
    var newQty = parseInt(currentQty.innerText) + 1;
    currentQty.innerText = newQty;
    var total = newQty * price.value + " Kyats";
    totalAmountShow.innerText = total;
    totalAmount.value = total;
    qtyInput.value = newQty;
};

window.qtyMinus = function qtyMinus() {
    var newQty = parseInt(currentQty.innerText) - 1;
    currentQty.innerText = newQty;
    var total = newQty * price.value + " Kyats";
    totalAmountShow.innerText = total;
    totalAmount.value = total;
    qtyInput.value = newQty;
};
