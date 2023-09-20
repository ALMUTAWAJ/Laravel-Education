document.addEventListener('DOMContentLoaded', function () {
    const passwordInput1 = document.getElementById('form3Example4');
    const passwordInput2 = document.getElementById('form3Example5');
    const showPasswordCheckbox1 = document.getElementById('showPassword1');
    const showPasswordCheckbox2 = document.getElementById('showPassword2');

    showPasswordCheckbox1.addEventListener('change', function () {
        if (showPasswordCheckbox1.checked) {
            passwordInput1.type = 'text';
        } else {
            passwordInput1.type = 'password';
        }
    });


    showPasswordCheckbox2.addEventListener('change', function () {
        if (showPasswordCheckbox2.checked) {
            passwordInput2.type = 'text';
        } else {
            passwordInput2.type = 'password';
        }
    });
    const agreeCheckbox = document.getElementById('form2Example33');
    const signupButton = document.getElementById('signup');
    agreeCheckbox.addEventListener('change', function () {
        if (agreeCheckbox.checked) {
            signupButton.disabled = false;
        } else {
            signupButton.disabled = true;
        }
    });


});

