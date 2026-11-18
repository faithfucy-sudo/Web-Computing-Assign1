// Login and Register Form Validation
// Used by login.php and register.php


// BACKEND INTEGRATION (Faith):
// Keep this as false until the PHP login / register
// processing is ready. While it is false, a valid form
// shows a message instead of being sent to the server.
// Change it to true to let valid forms submit normally.
const backendConnected = false;


// Show an error message under one field.
function showError(inputId, message) {
    const input = document.getElementById(inputId);
    const errorText = document.getElementById(inputId + "-error");

    input.classList.add("input-error");
    errorText.textContent = message;
}


// Remove the error message from one field.
function clearError(inputId) {
    const input = document.getElementById(inputId);
    const errorText = document.getElementById(inputId + "-error");

    input.classList.remove("input-error");
    errorText.textContent = "";
}


// Show a message box at the top of the form.
// type is "error" or "success".
function showFormMessage(message, type) {
    const messageBox = document.getElementById("form-message");

    messageBox.textContent = message;
    messageBox.className = "form-message message-" + type;
}


// Hide the message box at the top of the form.
function hideFormMessage() {
    const messageBox = document.getElementById("form-message");

    messageBox.textContent = "";
    messageBox.className = "form-message";
}


// Check the email format, e.g. name@example.com
function isValidEmail(email) {
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    return emailPattern.test(email);
}


// Check a Malaysian mobile number.
// Accepts 012-3456789, 0123456789, 011-23456789 or +60123456789.
// Spaces and dashes are removed before checking.
function isValidPhone(phone) {
    const digitsOnly = phone.replace(/[\s-]/g, "");
    const phonePattern = /^(\+?60|0)1[0-9]{8,9}$/;

    return phonePattern.test(digitsOnly);
}


// Remove a field's error as soon as the user types in it.
function clearErrorWhenTyping(inputIds) {
    inputIds.forEach(function (inputId) {
        document.getElementById(inputId).addEventListener("input", function () {
            clearError(inputId);
            hideFormMessage();
        });
    });
}


// After the form passes validation, either send it to the
// server or (while the backend is not ready) show a message.
function finishValidForm(form, demoMessage) {
    if (backendConnected) {
        form.submit();
    } else {
        showFormMessage(demoMessage, "success");
    }
}


// ==========================================
// LOGIN FORM
// ==========================================

const loginForm = document.getElementById("loginForm");

if (loginForm) {

    clearErrorWhenTyping(["login-email", "login-password"]);

    loginForm.addEventListener("submit", function (event) {
        event.preventDefault();
        hideFormMessage();

        const email = document.getElementById("login-email").value.trim();
        const password = document.getElementById("login-password").value;

        let isValid = true;

        // Email
        if (email === "") {
            showError("login-email", "Please enter your email address.");
            isValid = false;
        } else if (!isValidEmail(email)) {
            showError("login-email", "Please enter a valid email, e.g. name@example.com.");
            isValid = false;
        } else {
            clearError("login-email");
        }

        // Password
        if (password === "") {
            showError("login-password", "Please enter your password.");
            isValid = false;
        } else {
            clearError("login-password");
        }

        if (!isValid) {
            showFormMessage("Please fix the highlighted fields.", "error");
            return;
        }

        finishValidForm(
            loginForm,
            "Your details look good. Login is not connected to the server yet."
        );
    });
}


// ==========================================
// REGISTER FORM
// ==========================================

const registerForm = document.getElementById("registerForm");

if (registerForm) {

    clearErrorWhenTyping([
        "register-name",
        "register-email",
        "register-phone",
        "register-password",
        "register-confirm"
    ]);

    registerForm.addEventListener("submit", function (event) {
        event.preventDefault();
        hideFormMessage();

        const fullName = document.getElementById("register-name").value.trim();
        const email = document.getElementById("register-email").value.trim();
        const phone = document.getElementById("register-phone").value.trim();
        const password = document.getElementById("register-password").value;
        const confirmPassword = document.getElementById("register-confirm").value;

        const minimumPasswordLength = 8;
        let isValid = true;

        // Full name
        if (fullName === "") {
            showError("register-name", "Please enter your full name.");
            isValid = false;
        } else if (fullName.length < 3) {
            showError("register-name", "Full name must be at least 3 characters.");
            isValid = false;
        } else {
            clearError("register-name");
        }

        // Email
        if (email === "") {
            showError("register-email", "Please enter your email address.");
            isValid = false;
        } else if (!isValidEmail(email)) {
            showError("register-email", "Please enter a valid email, e.g. name@example.com.");
            isValid = false;
        } else {
            clearError("register-email");
        }

        // Phone
        if (phone === "") {
            showError("register-phone", "Please enter your phone number.");
            isValid = false;
        } else if (!isValidPhone(phone)) {
            showError("register-phone", "Please enter a valid Malaysian mobile number, e.g. 012-3456789.");
            isValid = false;
        } else {
            clearError("register-phone");
        }

        // Password
        if (password === "") {
            showError("register-password", "Please enter a password.");
            isValid = false;
        } else if (password.length < minimumPasswordLength) {
            showError("register-password", "Password must be at least " + minimumPasswordLength + " characters.");
            isValid = false;
        } else {
            clearError("register-password");
        }

        // Confirm password
        if (confirmPassword === "") {
            showError("register-confirm", "Please confirm your password.");
            isValid = false;
        } else if (confirmPassword !== password) {
            showError("register-confirm", "Passwords do not match.");
            isValid = false;
        } else {
            clearError("register-confirm");
        }

        if (!isValid) {
            showFormMessage("Please fix the highlighted fields.", "error");
            return;
        }

        finishValidForm(
            registerForm,
            "Your details look good. Registration is not connected to the server yet."
        );
    });
}
