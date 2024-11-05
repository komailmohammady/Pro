<?php
// Database connection
include '../PHP/ConnectionToDatabase.php';

// Fetch all employee records from the database
$sql = "SELECT ID, Name, LastName, FatherName, Phone, Email, Username, PostType, JobType, ReleventDep, PostNo, Observation FROM employee_register";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>جدول کارمندان</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="../Css/dash.css" type="text/css">
    <script src="../js/script.js"></script>
</head>
<body dir="rtl">
        <!-- Sidebar -->
        <div class="col-md-2 sidebar">
            <img src="../img/logo.png" alt="لوگوی داشبورد" class="logo-img mb-3">
            <a href="../index.php"><i class="bi bi-house-door"></i> داشبورد</a>
            <a href="#employeesMenu" data-bs-toggle="collapse" aria-expanded="false" class="d-flex align-items-center">
                <i class="bi bi-person"></i> کارمندان
                <i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <div id="employeesMenu" class="collapse">
                <ul>
                    <li><a href="EmployeeRegister.php" class="d-block">ثبت کارمند</a></li>
                    <li><a href="ShowEmployee.php" class="d-block">لیست کارمندان</a></li>
                </ul>
            </div>
            <a href="#reportsMenu" data-bs-toggle="collapse" aria-expanded="false" class="d-flex align-items-center">
                <i class="bi bi-file-earmark-text"></i> گزارشات
                <i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <div id="reportsMenu" class="collapse">
                <ul>
                    <li><a href="EmployeeReport.php" class="d-block">ثبت گزارش</a></li>
                    <li><a href="ShowEmployeeReport.php" class="d-block">لیست گزارشات</a></li>
                </ul>
            </div>
            <a href="#" data-bs-toggle="modal" data-bs-target="#messageModal"><i class="bi bi-chat-left-text"></i> ارسال پیام</a>
            <a href="../PHP/logout.php"><i class="bi bi-box-arrow-right"></i> خروج</a>
        </div>

        <div class="container">
                <div class="d-flex justify-content-between align-items-center">
                    <h2 class="mb-4"><b>لیست کارمندان ریاست امور متعلمین و محصلین</b></h2>
                    <button type="button" class="btn-close" aria-label="Close" onclick="closeForm()" style="transform: rotate(180deg);"></button>
                </div>
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-custom">
                    <thead>
                        <tr>
                            <th>آی دی</th>
                            <th>اسم</th>
                <th>تخلص</th>
                <th>ولد</th>
                <th>نام کاربر</th>
                <th>عنوان بست</th>
                <th>نوعیت وظیفه</th>
                <th>آمریت مربوطه</th>
                <th>بست</th>
                <th>ملاحظات</th>
                <th>عملیات</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result && $result->num_rows > 0) {
                    // Output data of each row
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                            <td>" . htmlspecialchars($row['ID']) . "</td>
                            <td>" . htmlspecialchars($row['Name']) . "</td>
                            <td>" . htmlspecialchars($row['LastName']) . "</td>
                            <td>" . htmlspecialchars($row['FatherName']) . "</td>
                            <td>" . htmlspecialchars($row['Phone']) . "</td>
                            <td>" . htmlspecialchars($row['Email']) . "</td>
                            <td>" . htmlspecialchars($row['Username']) . "</td>
                            <td>" . htmlspecialchars($row['PostType']) . "</td>
                            <td>" . htmlspecialchars($row['JobType']) . "</td>
                            <td>" . htmlspecialchars($row['ReleventDep']) . "</td>
                            <td>" . htmlspecialchars($row['PostNo']) . "</td>
                            <td>" . htmlspecialchars($row['Observation']) . "</td>
                            <td>
                                <a href='../PHP/employee_form_update.php?ID=" . htmlspecialchars($row['ID']) . "' class='btn btn-warning btn-sm'>ویرایش</a>
                                <button class='btn btn-danger btn-sm' onclick=\"confirmDelete('" . htmlspecialchars($row['ID']) . "')\">حذف</button>
                            </td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='11'>هیچ اطلاعاتی موجود نیست</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<!-- SweetAlert JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
function confirmDelete(id) {
    Swal.fire({
        title: 'آیا مطمئن هستید؟',
        text: "این عمل غیر قابل بازگشت است!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'بله، حذف کن!',
        cancelButtonText: 'خیر، منصرف شدم'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = '../PHP/delete_employee.php?ID=' + id;
        }
    });
}
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
