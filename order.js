// order.js
document.addEventListener("DOMContentLoaded", function () {
    const orderButton = document.getElementById("orderButton");
    const orderSuccess = document.getElementById("orderSuccess");

    orderButton.addEventListener("click", function () {
        // You can add your order processing logic here.
        // For this example, we're just showing the success message.

        // Display the success message
        orderSuccess.style.display = "block";

        // You can also reset the form or clear any selected items here.
    });
});
