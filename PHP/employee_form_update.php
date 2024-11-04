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

if (isset($_POST['update'])) {
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

    $sql = "UPDATE employee_register SET Name=?, LastName=?, FatherName=?, Username=?, Password=?, PostType=?, JobType=?, PostNo=?, ReleventDep=?, Observation=? WHERE ID=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssssssi", $name, $lastName, $fatherName, $username, $password, $postType, $jobType, $postNo, $releventDep, $observation, $id);
    
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
    <link rel="stylesheet" href="../Css/Employee_Report.css" type="text/css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .sidebar {
            height: 100vh; /* Make sidebar full height */
            overflow-y: auto; /* Scroll if content overflows */
        }
        .main-content {
            padding: 20px; /* Add padding to main content */
        }
        .header {
            text-align: center; /* Center the heading */
            margin-bottom: 30px; /* Add margin for spacing */
            background: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
            color: DodgerBlue;
            padding: 20px;
            border-radius: 20px;
        }
        .btn {
            padding: 10px;
            background-color: DodgerBlue;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 20px;
            cursor: pointer;
            transition: background-color 0.3s;
            font-family: 'B Nazanin';
            font-weight: bold;
            width: 330px;
        }
    </style>
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

            <div class="col-md-10 main-content mt-5">
                <form action="employee_form_update.php" method="post" id="form" onsubmit="return validateForm()">
                    <input type="hidden" name="ID" value="<?php echo $employee['ID']; ?>">
                    
                    <div class="form-row">
                        <div class="form-col">
                            <label for="UserName">آي دی</label>
                            <input type="number" id="UserName" name="ID" class="form-control" value="<?php echo $employee['ID']; ?>" disabled>
                        </div>

                        <div class="form-col">
                            <label for="Report">اسم</label>
                            <input type="text" id="Report" name="Name" class="form-control" value="<?php echo $employee['Name']; ?>" required>
                        </div>

                        <div class="form-col">
                            <label for="Time">تخلص</label>
                            <input type="text" id="Time" name="LastName" class="form-control" value="<?php echo $employee['LastName']; ?>" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-col">
                            <label for="Plane">ولد</label>
                            <input type="text" id="Plane" name="FatherName" class="form-control" value="<?php echo $employee['FatherName']; ?>" required>
                        </div>

                        <div class="form-col">
                            <label for="solve">عنوان بست</label>
                            <input type="text" id="solve" name="PostType" class="form-control" value="<?php echo $employee['PostType']; ?>" required>
                        </div>

                        <div class="form-col">
                            <label for="signature">نوعیت وظیفه</label>
                            <input type="text" id="signature" name="JobType" class="form-control" value="<?php echo $employee['JobType']; ?>" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-col">
                            <label for="persent">کاربر</label>
                            <input type="text" id="persent" name="Username" class="form-control" value="<?php echo $employee['Username']; ?>" required>
                        </div>

                        <div class="form-col position-relative">
                            <label for="state">رمز عبور</label>
                            <input type="password" id="state" name="Password" class="form-control" value="<?php echo $employee['Password']; ?>" required>
                            <i class="bi bi-eye-slash position-absolute top-50 start-0 me-2 toggle-icon" style="cursor: pointer;margin-left:10px;margin-top:5px;" id="togglePassword1" onclick="togglePassword('state', 'togglePassword1')"></i>
                        </div>

                        <div class="form-col position-relative">
                            <label for="prob">تایید رمز عبور</label>
                            <input type="password" id="prob" name="Conform_Password" class="form-control" value="<?php echo $employee['Password']; ?>" required>
                            <i class="bi bi-eye-slash position-absolute top-50 start-0 me-3 toggle-icon" style="cursor: pointer;margin-left:10px;margin-top:5px;" id="togglePassword2" onclick="togglePassword('prob', 'togglePassword2')"></i>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-col">
                            <label for="filling">شماره بست</label>
                            <input type="text" id="filling" name="PostNo" class="form-control" value="<?php echo $employee['PostNo']; ?>" required>
                        </div>

                        <div class="form-col">
                            <label for="remark">بخش مربوطه</label>
                            <input type="text" id="remark" name="ReleventDep" class="form-control" value="<?php echo $employee['ReleventDep']; ?>" required>
                        </div>

                        <div class="form-col">
                            <label for="notes">ملاحضات</label>
                            <input type="text" id="signature" name="Observation" class="form-control" value="<?php echo htmlspecialchars($employee['Observation']); ?>">
                        </div>
                    </div>

                    <div class="form-row" style="justify-content: center;">
                    <button type="submit" name="update" class="btn btn-primary">بروز رسانی</button>
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
            // Add any form validation if needed
            return true;
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
