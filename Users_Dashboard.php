<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'user') {
    // اگر کاربر معمولی نیست، به صفحه دسترسی غیرمجاز هدایت شود
    header('Location: unauthorized.php');
    exit;
}
?>
