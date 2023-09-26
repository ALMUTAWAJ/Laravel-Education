const profileImage = document.getElementById('profileImage');
const profileImageLayout = document.getElementById('profileImageLayout');
var deleteDecision = document.getElementById('delete-profile-image');
var delete_button = document.getElementById('delete-button');
var old_src = profileImage.src;
// Profile Picture Input
const profileImageInput = document.getElementById('profile-image-input'); // the uploaded file

profileImageInput.addEventListener('change', function () {
    const file = profileImageInput.files[0]; // will find the first file input in the page
    if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
            // Update the src attribute of the profile image
            profileImage.src = e.target.result;
            profileImageLayout.src = e.target.result;
        };
        reader.readAsDataURL(file);
    }
});


/**
 * First, if a file exists (i.e., the user has selected a file), we create a FileReader object, which is a built-in class in JavaScript. This FileReader object is used to read the contents of the selected file.

The FileReader object has an onload event handler, which is a function that runs when the file reading operation is successfully completed. This function takes an event object (e) as a parameter, and within this function, we update the src attribute of the profile image element (profileImage.src) with the data from the selected file. This update effectively displays the selected image on the web page.
 */

function toggleDelete() {
    if (deleteDecision.value === '0') {
        profileImage.src = assetUrl; // assetUrl will be found in profile.blade.php because you can't use asset here
        profileImageLayout.src = assetUrl;
        delete_button.textContent="Don't Delete";
        deleteDecision.value = '1'; // change the value to '1'
        profileImageInput.value = null; // to enable re-uploading the image 
    }
    else{
        delete_button.textContent="Delete";
        deleteDecision.value = '0';
        profileImage.src = old_src; // returning the previous image
        profileImageLayout.src = old_src; // returning the previous image
        profileImageInput.value = old_src; // returning the previous image
        
    } 
}




window.addEventListener('load', function hideButton() { // hiding the delete button in case the profile image is the default avatar
    if (profileImage.src==assetUrl) {
        delete_button.style.display = "none"; // Hide the delete button
    }
});
