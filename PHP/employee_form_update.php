<?php
// Database connection
include 'ConnectionToDatabase.php';

// Fetch employee data based on the ID passed via GET parameter
$employee_id = $_GET['ID'];
$sql = "SELECT * FROM employee_register WHERE ID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $employee_id);
$stmt->execute();
$result = $stmt->get_result();
$employee = $result->fetch_assoc();

// Check if the form is submitted
if (isset($_POST['update'])) {
    $id = $_POST['ID'];
    $name = $_POST['Name'];
    $lastName = $_POST['LastName'];
    $fatherName = $_POST['FatherName'];
    $username = $_POST['Username'];
    $password = $_POST['Password'];
    $confirmPassword = $_POST['Conform_Password'];
    $postType = $_POST['PostType'];
    $jobType = $_POST['JobType'];
    $postNo = $_POST['PostNo'];
    $releventDep = $_POST['ReleventDep'];
    $observation = $_POST['Observation'];
    $email = $_POST['Email']; // Added Email field
    $phone = $_POST['Phone']; // Added Phone field

    // Check if the password and confirm password match
    if ($password !== $confirmPassword) {
        echo "<script>
            alert('رمز عبور و تایید رمز عبور مطابقت ندارند!');
        </script>";
    } else {
        // Update query with email and phone
        $sql = "UPDATE employee_register SET 
                    Name = ?, 
                    LastName = ?, 
                    FatherName = ?, 
                    Username = ?, 
                    Password = ?, 
                    PostType = ?, 
                    JobType = ?, 
                    PostNo = ?, 
                    ReleventDep = ?, 
                    Observation = ?, 
                    Email = ?, 
                    Phone = ? 
                WHERE ID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssssssssi", $name, $lastName, $fatherName, $username, $password, $postType, $jobType, $postNo, $releventDep, $observation, $email, $phone, $id);
        
        // Execute the update
        if ($stmt->execute()) {
            echo "<script>
                alert('موفقانه ویرایش شد!');
                window.location.href = '../dashboardpages/ShowEmployee.php';
            </script>";
        } else {
            echo "<script>
                alert('خطا در ویرایش!');
            </script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ویرایش کارمند</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="../Css/dash.css" type="text/css">
</head>
<body dir="rtl">
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-2 sidebar">
                <img src="../img/logo.png" alt="لوگوی داشبورد" class="logo-img">
                <a href="../index.php"><i class="bi bi-house-door"></i> داشبورد</a>
                
                <a href="#employeesMenu" data-bs-toggle="collapse" aria-expanded="false" class="d-flex align-items-center">
                    <i class="bi bi-person"></i> کارمندان
                    <i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <div id="employeesMenu" class="collapse">
                    <ul>
                        <li><a href="../dashboardpages/EmployeeRegister.php" class="d-block">ثبت کارمند</a></li>
                        <li><a href="../dashboardpages/ShowEmployee.php" class="d-block">لیست کارمندان</a></li>
                    </ul>
                </div>

                <a href="#reportsMenu" data-bs-toggle="collapse" aria-expanded="false" class="d-flex align-items-center">
                    <i class="bi bi-file-earmark-text"></i> گزارشات
                    <i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <div id="reportsMenu" class="collapse">
                    <ul>
                        <li><a href="../dashboardpages/EmployeeReport.php" class="d-block">ثبت گزارش</a></li>
                        <li><a href="../dashboardpages/ShowEmployeeReport.php" class="d-block">لیست گزارشات</a></li>
                    </ul>
                </div>

                <a href="logout.html"><i class="bi bi-box-arrow-right"></i> خروج</a>
            </div>

            <div class="col-md-10 content mr-2">
            <div class="header text-center mt-3 mb-4">
                <h1><b>ویرایش فرم</b></h1>
            </div>
                <form action="employee_form_update.php" method="post" id="form" onsubmit="return validateForm()">
                    <input type="hidden" name="ID" value="<?php echo $employee['ID']; ?>">
                    
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="UserName">آي دی</label>
                            <input type="number" id="UserName" name="ID" class="form-control" value="<?php echo $employee['ID']; ?>" disabled>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="Report">اسم</label>
                            <input type="text" id="Report" name="Name" class="form-control" value="<?php echo isset($employee['Name']) ? htmlspecialchars($employee['Name']) : ''; ?>" required>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="Time">تخلص</label>
                            <input type="text" id="Time" name="LastName" class="form-control" value="<?php echo isset($employee['LastName']) ? htmlspecialchars($employee['LastName']) : ''; ?>" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="Plane">ولد</label>
                            <input type="text" id="Plane" name="FatherName" class="form-control" value="<?php echo isset($employee['FatherName']) ? htmlspecialchars($employee['FatherName']) : ''; ?>" required>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="solve">عنوان بست</label>
                            <input type="text" id="solve" name="PostType" class="form-control" value="<?php echo isset($employee['PostType']) ? htmlspecialchars($employee['PostType']) : ''; ?>" required>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="signature">نوعیت وظیفه</label>
                            <input type="text" id="signature" name="JobType" class="form-control" value="<?php echo isset($employee['JobType']) ? htmlspecialchars($employee['JobType']) : ''; ?>" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="persent">کاربر</label>
                            <input type="text" id="persent" name="Username" class="form-control" value="<?php echo isset($employee['Username']) ? htmlspecialchars($employee['Username']) : ''; ?>" required>
                        </div>

                        <div class="col-md-4 mb-3 position-relative">
                            <label for="state">رمز عبور</label>
                            <input type="password" id="state" name="Password" class="form-control" value="<?php echo isset($employee['Password']) ? htmlspecialchars($employee['Password']) : ''; ?>" required>
                            <i class="bi bi-eye-slash position-absolute top-50 start-0 me-2 toggle-icon" style="cursor: pointer;margin-left:10px;margin-top:5px;" id="togglePassword1" onclick="togglePassword('state', 'togglePassword1')"></i>
                        </div>

                        <div class="col-md-4 mb-3 position-relative">
                            <label for="prob">تایید رمز عبور</label>
                            <input type="password" id="prob" name="Conform_Password" class="form-control" value="<?php echo isset($employee['Password']) ? htmlspecialchars($employee['Password']) : ''; ?>" required>
                            <i class="bi bi-eye-slash position-absolute top-50 start-0 me-3 toggle-icon" style="cursor: pointer;margin-left:10px;margin-top:5px;" id="togglePassword2" onclick="togglePassword('prob', 'togglePassword2')"></i>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="email">ایمیل</label>
                            <input type="email" id="email" name="Email" class="form-control" value="<?php echo isset($employee['Email']) ? htmlspecialchars($employee['Email']) : ''; ?>" required>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="phone">شماره تماس</label>
                            <input type="text" id="phone" name="Phone" class="form-control" value="<?php echo isset($employee['Phone']) ? htmlspecialchars($employee['Phone']) : ''; ?>" required>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="filling">شماره بست</label>
                            <input type="text" id="filling" name="PostNo" class="form-control" value="<?php echo isset($employee['PostNo']) ? htmlspecialchars($employee['PostNo']) : ''; ?>" required>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="remark">بخش مربوطه</label>
                            <input type="text" id="remark" name="ReleventDep" class="form-control" value="<?php echo isset($employee['ReleventDep']) ? htmlspecialchars($employee['ReleventDep']) : ''; ?>" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="notes">ملاحضات</label>
                            <input type="text" id="signature" name="Observation" class="form-control" value="<?php echo isset($employee['Observation']) ? htmlspecialchars($employee['Observation']) : ''; ?>">
                        </div>
                    </div>

                    <div class="col-md-4 mb-3">
                        <button type="submit" name="update" class="btnn">بروز رسانی</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function togglePassword(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);
            input.type = input.type === 'password' ? 'text' : 'password';
            icon.classList.toggle('bi-eye');
            icon.classList.toggle('bi-eye-slash');
        }

        function validateForm() {
            return true; // Add any form validation if needed
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
