<?php 
// index.php 
session_start(); 

// Database connection details 
$host = 'localhost'; 
$username = 'root'; 
$password = ''; 
$dbname = 'final';  

// Create a connection 
$conn = new mysqli($host, $username, $password, $dbname);  

// Check connection 
if ($conn->connect_error) { 
    die("Connection failed: " . $conn->connect_error); 
}  

// Initialize variables 
$user = ''; 
$error_message = '';  

// Check if cookies exist 
if (isset($_COOKIE['username'])) { 
    $user = $_COOKIE['username']; 
}  

// Check if the user is already logged in 
if (isset($_SESSION['username'])) { 
    header("Location: index.php"); // Redirect to desired page 
    exit(); 
}  

// Check if form is submitted 
if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    $user = $_POST['user']; 
    $pass = $_POST['Password']; 
    
    // Prepare and bind 
    $stmt = $conn->prepare("SELECT Password FROM employee_register WHERE Username = ?"); 
    $stmt->bind_param("s", $user); 
    $stmt->execute(); 
    $stmt->store_result();  

    // Check if user exists 
    if ($stmt->num_rows > 0) { 
        $stmt->bind_result($hashed_password); 
        $stmt->fetch();  

        // Verify the password against the hashed password 
        if (password_verify($pass, $hashed_password)) { 
            // Set session variable 
            $_SESSION['username'] = $user; // Store username in session 

            // Redirect to the desired page 
            header("Location: index.php"); 
            exit(); 
        } else { 
            $error_message = "نام کاربری یا رمز عبور نادرست است."; 
        } 
    } else { 
        $error_message = "نام کاربری یا رمز عبور نادرست است."; 
    }  

    // Close statement 
    $stmt->close(); 
}  

// Close connection 
$conn->close(); 
?>  

<!DOCTYPE html> 
<html lang="fa"> 
<head> 
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>فرم ورود به سیستم</title> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet"> 
    <link rel="stylesheet" href="Css/login.css"> 
</head> 
<body dir="rtl"> 

<div class="login-container"> 
    <h2>ورود به حساب کاربری</h2> 
    <form method="POST" action=""> 
        <div class="mb-3 position-relative"> 
            <label for="user" class="form-label">نام کاربری</label> 
            <input type="text" class="form-control" id="user" name="user" value="<?php echo htmlspecialchars($user); ?>"> 
        </div> 
        <div class="mb-3 position-relative"> 
            <label for="password" class="form-label">رمز عبور</label> 
            <input type="password" class="form-control" id="password" name="Password" autocomplete="off"> 
            <i class="bi bi-eye-slash toggle-password" id="togglePassword" onclick="togglePassword()"></i> 
        </div> 
        <button type="submit" class="btn btn-primary btn-block w-100">ورود</button> 
    </form> 

    <?php if (!empty($error_message)): ?> 
        <div class="alert alert-danger mt-3"> 
            <?php echo $error_message; ?> 
        </div> 
    <?php endif; ?> 
</div> 

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script> 
<script> 
    function togglePassword() { 
        const passwordInput = document.getElementById('password'); 
        const toggleIcon = document.getElementById('togglePassword'); 

        if (passwordInput.type === "password") { 
            passwordInput.type = "text"; 
            toggleIcon.classList.remove("bi-eye-slash"); 
            toggleIcon.classList.add("bi-eye"); 
        } else { 
            passwordInput.type = "password"; 
            toggleIcon.classList.remove("bi-eye"); 
            toggleIcon.classList.add("bi-eye-slash"); 
        } 
    } 
</script> 
</body> 
</html>
