<?php
session_start();
include 'PHP/ConnectionToDatabase.php';

// بررسی ورود کاربر
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// بررسی نقش کاربر
if ($_SESSION['role'] == 'admin') {
    // محتوای ادمین
    echo "<h1>به داشبورد ادمین خوش آمدید، " . $_SESSION['username'] . "</h1>";
    echo "<p>اینجا محتوای ادمین قرار می‌گیرد.</p>";
} elseif ($_SESSION['role'] == 'user') {
    // محتوای کاربر معمولی
    echo "<h1>به داشبورد کاربر معمولی خوش آمدید، " . $_SESSION['username'] . "</h1>";
    echo "<p>اینجا محتوای کاربر معمولی قرار می‌گیرد.</p>";
} else {
    // در صورتی که نقش کاربر مشخص نباشد
    echo "<h1>نقش شما مشخص نیست.</h1>";
}
?>
