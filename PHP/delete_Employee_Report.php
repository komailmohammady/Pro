
<?php
// اتصال به پایگاه‌داده
include '../PHP/ConnectionToDatabase.php';

// بررسی اینکه آیا شناسه کارمند در URL وجود دارد
if (isset($_GET['ID'])) {
    $ID = $_GET['ID'];

    // کوئری حذف کارمند
    $sql = "DELETE FROM employeereport WHERE ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $ID);

    // اجرای کوئری و بررسی موفقیت آن
    if ($stmt->execute()) {
        // نمایش پیام موفقیت در حذف و هدایت به لیست کارمندان
        echo "<script>
            alert('موفقانه حذف شد!');
            window.location.href = '../dashboardpages/ShowEmployeeReport.php';
        </script>";
    } else {
        // نمایش پیام خطا در حذف
        echo "<script>
            alert('خطا در حذف : " . $stmt->error . "');
            window.location.href = '../dashboardpages/ShowEmployeeReport.php';
        </script>";
    }
} else {
    // پیام خطا در صورت نبودن شناسه کارمند
    echo "<script>
        alert('آی دی کارمند موجود نیست.');
        window.location.href = '../dashboardpages/ShowEmployee.php';
    </script>";
}
?>
