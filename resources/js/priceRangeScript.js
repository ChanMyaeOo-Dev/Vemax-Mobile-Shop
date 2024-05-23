document.addEventListener("DOMContentLoaded", function () {
    const priceRange = document.getElementById("priceRange");
    const priceRangeLabel = document.getElementById("priceRangeLabel");

    // const product_card = document.getElementById("product_card");
    // const category_label = document.getElementById("category_label");

    // product_card.addEventListener("mouseenter", function () {
    //     category_label.classList.add("animate__slideInRight");
    // });

    const handlePriceRangeLabel = () => {
        priceRangeLabel.innerHTML = "5000 - " + priceRange.value + " MMK";
    };
    priceRange.addEventListener("input", handlePriceRangeLabel);
});
