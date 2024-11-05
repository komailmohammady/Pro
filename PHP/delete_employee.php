<?php
// اتصال به پایگاه‌داده
include '../PHP/ConnectionToDatabase.php';

// بررسی اینکه آیا شناسه کارمند در URL وجود دارد
if (isset($_GET['ID'])) {
    $ID = $_GET['ID'];

    // کوئری حذف کارمند
    $sql = "DELETE FROM employee_register WHERE ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $ID);

    // نمایش پیام تایید قبل از حذف
    echo "<script>
        if (confirm('آیا مطمئن هستید که می‌خواهید این کارمند را حذف کنید؟')) {
            // اجرای کوئری حذف در صورت تایید
            window.location.href = '../PHP/delete_employee_process.php?ID=" . $ID . "';
        } else {
            // برگشت به صفحه نمایش کارمندان در صورت لغو
            window.location.href = '../dashboardpages/ShowEmployee.php';
        }
    </script>";
} else {
    // پیام خطا در صورت نبودن شناسه کارمند
    echo "<script>
        alert('آی دی کارمند موجود نیست.');
        window.location.href = '../dashboardpages/ShowEmployee.php';
    </script>";
}
?>
