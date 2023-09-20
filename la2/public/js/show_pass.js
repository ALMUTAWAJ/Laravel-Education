
// Get references to the link and the target div
const toggleLink = document.getElementById("link_to_change_pass");
const targetDiv = document.getElementById("change_pass");

// Add a click event listener to the link
toggleLink.addEventListener("click", function (event) {
    // Prevent the default link behavior (e.g., navigating to a URL)
    event.preventDefault();

    // Toggle the display property of the div
    if (targetDiv.style.display === "none" || targetDiv.style.display === "") {
        targetDiv.style.display = "block";
        toggleLink.innerText = "I don't want to change my password.";
    } else {
        targetDiv.style.display = "none";
        toggleLink.innerText = "Change Password?";

    }
});
