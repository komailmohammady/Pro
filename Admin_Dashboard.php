<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    // اگر کاربر ادمین نیست، به صفحه دسترسی غیرمجاز هدایت شود
    header('Location: unauthorized.php');
    exit;
}
?>
