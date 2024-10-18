function validateLoginForm() {
    var email = document.getElementById('email').value;
    var password = document.getElementById('password').value;

    if (email == "" || password == "") {
        alert("Email and Password are required.");
        return false;
    }

    // Add more validations if necessary
    return true;
}
