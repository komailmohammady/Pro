<?php
// Database connection
include 'ConnectionToDatabase.php'; 

// Adding a new user
if (isset($_POST['submit'])) {
    $id = $_POST['ID'];
    $name = $_POST['Name'];
    $lastName = $_POST['LastName'];
    $fatherName = $_POST['FatherName'];
    $username = $_POST['Username'];
    $password = $_POST['Password'];
    $postType = $_POST['PostType'];
    $jobType = $_POST['JobType'];
    $postNo = $_POST['PostNo'];
    $releventDep = $_POST['ReleventDep'];
    $observation = $_POST['Observation'];
    $email = $_POST['email']; // New email field
    $phone = $_POST['phone']; // New phone field

    // Checking if fields are filled
    if (empty($id) || empty($name) || empty($lastName) || empty($fatherName) || empty($username) || empty($password) || empty($postType) || empty($jobType) || empty($postNo) || empty($releventDep) || empty($email) || empty($phone)) {
        ?>
        <script>
            alert("لطفاً تمام فیلدها را پر کنید!");
            window.history.back(); 
        </script>
        <?php
    } else {
        // Hashing the password for security
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Prepare the SQL statement
        $stmt = $conn->prepare("INSERT INTO employee_register (ID, Name, LastName, FatherName, Username, Password, PostType, JobType, PostNo, ReleventDep, Observation, email, phone) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("issssssssssss", $id, $name, $lastName, $fatherName, $username, $hashedPassword, $postType, $jobType, $postNo, $releventDep, $observation, $email, $phone);

        if ($stmt->execute()) {
            ?>
            <script>
                alert("شما موفقانه به سیستم ثبت کردید!!!");
                window.location.href = "../dashboardpages/EmployeeRegister.php";
            </script>
            <?php
        } else {
            ?>
            <script>
                alert("خطایی رخ داد. لطفاً دوباره تلاش کنید.");
                console.error("Error: " + "<?php echo addslashes($stmt->error); ?>");
            </script>
            <?php
        }

        $stmt->close();
    }
}

// Closing the connection
$conn->close();
?>
