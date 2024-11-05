<?php
session_start();
include '../PHP/ConnectionToDatabase.php'; // Adjusted path

// Set default date and name filter values
$startDate = isset($_GET['start_date']) ? $_GET['start_date'] : '';
$endDate = isset($_GET['end_date']) ? $_GET['end_date'] : '';
$searchName = isset($_GET['search_name']) ? $_GET['search_name'] : '';

// Modify the SQL query to add name filtering if a name is provided
$sql = "SELECT ID, Username, Did_Reports, Activity_Time, Plane, Improve_Precentage, Result, Problems, Resolve_Sugestion, Date, Observation FROM employeereport";
$filters = [];
if ($startDate && $endDate) {
    $filters[] = "Date BETWEEN '$startDate' AND '$endDate'";
}
if ($searchName) {
    $filters[] = "Username LIKE '%$searchName%'";
}
if ($filters) {
    $sql .= " WHERE " . implode(" AND ", $filters);
}

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
    <link rel="stylesheet" href="../Css/kamadatepicker.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
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
    <!-- Header with Logo Placeholders -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <img src="../img/emarat.jpg " alt="Left Logo" style="height:80px;">
        </div>
        <h6 class="mb-0 text-center"> 
            <b>
                <p>امارت اسلامی افغانستان</p>   
                <p>اداره تعلیمات تخنیکی و مسلکی</p>   
                <p>معاونیت امور تخنیکی و مسلکی</p>   
                <p>گزارش ماه (&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;) سال (&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;) </p>
            </b>
        </h6>
        <div>
            <img src="../img/thakhnik.png" alt="Right Logo" style="height:80px;">
        </div>
    </div>

    <!-- Print Buttons -->
    <div class="print-buttons mb-4">
        <button type="button" class="btn btn-primary" onclick="window.location.href='EmployeeReport.php'">ثبت گزارش جدید</button>
        <button type="button" class="btn btn-info" onclick="printPage()">چاپ گزارش</button>
    </div>

    <!-- Date Filter Form with Name Search Field -->
    <div class="filter-form mb-4">
        <form method="GET" class="d-flex justify-content-between align-items-center">
            <div class="me-3">
                <label for="start_date" class="form-label">از تاریخ:</label>
                <input type="text" id="datepicker" name="start_date" value="<?= htmlspecialchars($startDate) ?>" class="form-control" placeholder="انتخاب تاریخ">
            </div>
            <div class="me-3">
                <label for="end_date" class="form-label">تا تاریخ:</label>
                <input type="text" id="enddatepicker" name="end_date" value="<?= htmlspecialchars($endDate) ?>" class="form-control" placeholder="انتخاب تاریخ">
            </div>
            <div class="me-3">
                <label for="search_name" class="form-label">جستجو با نام:</label>
                <input type="text" name="search_name" value="<?= htmlspecialchars($searchName) ?>" class="form-control" placeholder="نام کاربر">
            </div>
            <button type="submit" class="btn btn-success">جستجو</button>
        </form>
    </div>

    <div class="table-responsive mb-4">
        <table class="table table-bordered table-custom">
            <thead>
                <tr>
                    <th>آی دی</th>
                    <th>نام کاربر</th>
                    <th>گزارش فعالیت های انجام شده</th>
                    <th>زمان اجرای فعالیت</th>
                    <th>پلان</th>
                    <th>فیصدی پیشرفت</th>
                    <th>نتیجه/دستاورد</th>
                    <th>مشکلات/نواقص و کمبودات</th>
                    <th> راه حل پیشنهادی</th>
                    <th>تاریخ</th>
                    <th>ملاحظات</th>
                    <th class="hide-on-print">عملیات</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['ID']) ?></td>
                        <td><?= htmlspecialchars($row['Username']) ?></td>
                        <td><?= htmlspecialchars($row['Did_Reports']) ?></td>
                        <td><?= htmlspecialchars($row['Activity_Time']) ?></td>
                        <td><?= htmlspecialchars($row['Plane']) ?></td>
                        <td><?= htmlspecialchars($row['Improve_Precentage']) ?></td>
                        <td><?= htmlspecialchars($row['Result']) ?></td>
                        <td><?= htmlspecialchars($row['Problems']) ?></td>
                        <td><?= htmlspecialchars($row['Resolve_Sugestion']) ?></td>
                        <td><?= htmlspecialchars($row['Date']) ?></td>
                        <td><?= htmlspecialchars($row['Observation']) ?></td>
                        <td class="hide-on-print">
                            <a href='../PHP/Update_Employee_Report.php?ID=<?= $row['ID'] ?>' class='btn btn-warning btn-icon'>
                                <i class="fas fa-edit"></i>
                            </a>
                            <button class='btn btn-danger btn-icon' onclick="confirmDelete('../PHP/delete_Employee_Report.php?ID=<?= $row['ID'] ?>');">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmDelete(url) {
        Swal.fire({
            title: "آیا مطمئن هستید؟",
            text: "این گزارش قابل بازگشت نیست!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'بله، حذف کن!',
            cancelButtonText: 'خیر، منصرف شدم'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        });
    }
    function printPage() {
        window.print();
    }
</script>
</body>
</html>
