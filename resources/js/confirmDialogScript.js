import axios from "axios";
import Swal from "sweetalert2";
document.addEventListener("DOMContentLoaded", function () {
    const deleteForm = document.getElementById("product_delete_form");

    deleteForm.addEventListener("submit", function (event) {
        event.preventDefault(); // Prevent the default form submission

        const formData = new FormData(deleteForm); // Create a FormData object from the form
        const action = deleteForm.action; // Get the form action URL
        const redirectUrl = deleteForm.getAttribute("data-redirect"); // Get the redirect URL

        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!",
        }).then((result) => {
            if (result.isConfirmed) {
                axios
                    .post(action, formData)
                    .then((response) => {
                        // Handle success
                        console.log(response.data);
                        if (response.data.success) {
                            Swal.fire({
                                title: "Deleted!",
                                text: "Your product has been deleted.",
                                icon: "success",
                            }).then(() => {
                                // Redirect to the index route
                                window.location.href = redirectUrl;
                            });
                        } else {
                            Swal.fire({
                                title: "Warning",
                                text: response.data.message,
                                icon: "warning",
                            });
                        }
                    })
                    .catch((error) => {
                        // Handle error
                        // console.error(error);
                        Swal.fire({
                            title: "Error!",
                            text: "There was a problem deleting the product.",
                            icon: "error",
                        });
                    });
            }
        });
    });
});
