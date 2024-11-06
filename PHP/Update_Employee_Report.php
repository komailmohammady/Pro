<?php
// Database connection
include 'ConnectionToDatabase.php';

// Fetch employee data based on the ID passed via GET parameter
$employee_id = $_GET['ID'];
$sql = "SELECT * FROM employeereport WHERE ID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $employee_id);
$stmt->execute();
$result = $stmt->get_result();
$employee = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the data from the form
    $id = $_POST['ID'];
    $username = $_POST['Username'];
    $didReports = $_POST['Did_Reports'];
    $activityTime = $_POST['Activity_Time'];
    $plane = $_POST['Plane'];
    $improvePercentage = $_POST['Improve_Precentage'];
    $result = $_POST['Result'];
    $problems = $_POST['Problems'];
    $resolveSuggestion = $_POST['Resolve_Sugestion'];
    $date = $_POST['Date'];
    $observation = $_POST['Observation'];

    // Prepare the SQL update query
    $sql = "UPDATE employeereport SET Username=?, Did_Reports=?, Activity_Time=?, Plane=?, Improve_Precentage=?, Result=?, Problems=?, Resolve_Sugestion=?, Date=?, Observation=? WHERE ID=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssssssi", $username, $didReports, $activityTime, $plane, $improvePercentage, $result, $problems, $resolveSuggestion, $date, $observation, $id);

    if ($stmt->execute()) {
        echo "<script>alert('گزارش موفقانه ویرایش شد!'); window.location.href = '../dashboardpages/ShowEmployeeReport.php';</script>";
    } else {
        echo "<script>alert('خطا در ویرایش گزارش: " . $stmt->error . "');</script>"; // Display error message
    }
}
?>

<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>گزارشدهی کارمندان</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="../Css/dash.css" type="text/css">
    <link rel="stylesheet" href="../Css/kamadatepicker.min.css" type="text/css">
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
        <!-- Main Content Area -->
        <div class="col-md-10 content mr-2">
            <div class="header text-center mt-3 mb-4">
                <h1><b>ویرایش فرم</b></h1>
            </div>
            <form action="Update_Employee_Report.php" method="post" id="form">
                <!-- Hidden field to hold the employee ID -->
                <input type="hidden" name="ID" value="<?php echo $employee['ID']; ?>">

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="UserName">نام کاربر</label>
                        <input type="text" id="UserName" name="Username" class="form-control" value="<?php echo htmlspecialchars($employee['username']); ?>">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="Report">گزارش فعالیت های انجام شده</label>
                        <input type="text" id="Report" name="Did_Reports" class="form-control" value="<?php echo htmlspecialchars($employee['Did_Reports']); ?>">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="Time">زمان اجرای فعالیت</label>
                        <input type="text" id="Time" name="Activity_Time" class="form-control" value="<?php echo htmlspecialchars($employee['Activity_Time']); ?>">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="Plane">پلان</label>
                        <select name="Plane" class="form-control">
                            <option value="پلان عملیاتی" <?php echo $employee['Plane'] == 'پلان مربوطه' ? 'selected' : ''; ?>>پلان مربوطه</option>
                            <option value="خارج از پلان" <?php echo $employee['Plane'] == 'خارج از پلان' ? 'selected' : ''; ?>>خارج از پلان</option>
                        </select>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="persent">فیصدی پیشرفت</label>
                        <input type="text" id="persent" name="Improve_Precentage" class="form-control" value="<?php echo htmlspecialchars($employee['Improve_Precentage']); ?>">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="state">نتیجه/دستاورد</label>
                        <input type="text" id="state" name="Result" class="form-control" value="<?php echo htmlspecialchars($employee['Result']); ?>">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="prob">مشکلات/نواقص و کمبودات</label>
                        <input type="text" id="prob" name="Problems" class="form-control" value="<?php echo htmlspecialchars($employee['Problems']); ?>">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="solve">راه حل پیشنهادی</label>
                        <input type="text" id="solve" name="Resolve_Sugestion" class="form-control" value="<?php echo htmlspecialchars($employee['Resolve_Sugestion']); ?>">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="date">تاریخ</label>
                        <input type="text" id="datepacker" name="Date" class="form-control" value="<?php echo htmlspecialchars($employee['Date']); ?>">
                    </div>
                </div>

                <div class="form-col-12 mb-3">
                    <label for="signature">ملاحظات</label>
                    <input type="text" id="signature" name="Observation" class="form-control" value="<?php echo htmlspecialchars($employee['Observation']); ?>">
                </div>

                <div class="text-center col-md-3">
                    <button type="submit" class="btnn">ویرایش گزارش</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="../js/assits/jquery.js"></script>
    <script src="../js/assits/kamadatepicker.min.js"></script>
    <script>
        let options = {
    placeholder: "تاریخ",
    twodigit: false,
    closeAfterSelect: false,
    nextButtonIcon : "../img/timeir_next.png",
    previousButtonIcon : "../img/timeir_prev.png",
    buttonsColor:"blue",
    forceFarsiDigits : true,
    markToday: true,
    markHolidays:true,
    sync:true,
    gotoToday:true
}


        kamaDatepicker('datepacker',options);
        $("#datepacker").vla("1403/8/3")
    </script>
</body>
</html>
