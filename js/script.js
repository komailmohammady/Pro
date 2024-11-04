// Client-side validation for password match
document.getElementById('registrationForm').addEventListener('submit', function (event) {
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirm_password').value;

    // Check if passwords match
    if (password !== confirmPassword) {
        alert('Passwords do not match');
        event.preventDefault(); // Prevent form submission
    }
});

function closeForm() {
    window.location.href = "../index.php";
}

function togglePassword(id, iconId) {
    const passwordInput = document.getElementById(id);
    const toggleIcon = document.getElementById(iconId);

    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        toggleIcon.classList.add("bi-eye");
        toggleIcon.classList.remove("bi-eye-slash");
    } else {
        passwordInput.type = "password";
        toggleIcon.classList.add("bi-eye-slash");
        toggleIcon.classList.remove("bi-eye");
    }
}

