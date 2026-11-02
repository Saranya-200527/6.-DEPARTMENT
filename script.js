console.log("Computer Science - Pondicherry University loaded successfully.");

// ========================================
// REGISTRATION FORM VALIDATION
// ========================================

function validateRegistration() {

let password = document.getElementById("password").value;

let confirmPassword =
    document.getElementById("confirm_password").value;


// Check password length

if (password.length < 6) {

    alert("Password must contain at least 6 characters.");

    return false;

}


// Check password match

if (password !== confirmPassword) {

    alert("Passwords do not match.");

    return false;

}


return true;


}
