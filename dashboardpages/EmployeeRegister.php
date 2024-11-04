<!DOCTYPE html>
<html lang="fa"> <!-- تعریف زبان فارسی برای سند HTML -->
<head>
    <meta charset="UTF-8"> <!-- تنظیم کدگذاری کاراکترها به UTF-8 -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- تنظیم مقیاس صفحه برای نمایش در دستگاه‌های مختلف -->
    <title>فرم راجستر</title> <!-- عنوان صفحه -->
    
    <!-- لینک به فایل‌های CSS بوت‌استرپ -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- لینک به آیکون‌های بوت‌استرپ -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    
    <!-- لینک به فایل‌های CSS سفارشی -->
    <link rel="stylesheet" href="../Css/dash.css" type="text/css">
    <link rel="stylesheet" href="../Css/Employee_Report.css" type="text/css">
    
    <!-- لینک به فایل‌های JavaScript سفارشی -->
    <script src="../js/script.js"></script>
    
    <style>
        /* Custom styles for sidebar and form */
        .sidebar {
            background-color: #073B4C; /* Sidebar background color */
            color: white; /* Text color */
            padding: 15px; /* Padding for sidebar */
            height: 100vh; /* Full height */
        }
        
        .sidebar a {
            color: white; /* Link color */
            text-decoration: none; /* Remove underline from links */
            margin: 10px 0; /* Margin for links */
            display: block; /* Make links block level */
        }

        .sidebar a:hover {
            background-color: #05505b; /* Hover effect */
        }

        .main-content {
            padding: 20px; /* Padding for main content */
        }

        .form-row {
            display: flex; /* Flexbox for form rows */
            flex-wrap: wrap; /* Wrap items */
            margin-bottom: 15px; /* Bottom margin */
        }

        .form-col {
            flex: 1; /* Flex-grow for columns */
            min-width: 250px; /* Minimum width */
            margin: 5px; /* Margin between columns */
        }

        .form-control {
            padding: 10px; /* Padding for inputs */
            border-radius: 5px; /* Rounded corners */
        }

        .btn {
            background-color: #073B4C; /* Button background color */
            color: white; /* Button text color */
            margin: 5px; /* Margin for buttons */
        }
        
        .btn:hover {
            background-color: #05505b; /* Hover effect for buttons */
        }

        @media (max-width: 768px) {
            .sidebar {
                height: auto; /* Reset height for smaller screens */
            }
        }
    </style>
</head>
<body dir="rtl"> <!-- جهت متن به راست‌چین تغییر داده شده است -->
    <div class="container-fluid"> <!-- استفاده از کانتینر سیال برای محتوای صفحه -->
        <div class="row">
            <!-- نوار کناری (Sidebar) -->
            <div class="col-md-2 sidebar">
                <img src="../img/logo.png" alt="لوگوی داشبورد" class="logo-img"> <!-- لوگوی داشبورد -->
                <a href="../index.php"><i class="bi bi-house-door"></i> داشبورد</a> <!-- لینک به صفحه داشبورد -->
                
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

                <a href="logout.html"><i class="bi bi-box-arrow-right"></i> خروج</a>
            </div>
            
            <!-- ناحیه محتوای اصلی -->
            <div class="col-md-10 main-content">
                <div class="header">
                    <h1>فرم ثبت کارمندان ریاست امور متعلمین و محصلین</h1>
                </div>

                <!-- فرم ثبت کارمند -->
                <form action="../PHP/EmployeeRegisterAddCodes.php" method="post" id="form" onsubmit="return validateForm()">
                    <div class="form-row">
                        <div class="form-col">
                            <label for="UserName">آی‌دی</label>
                            <input type="number" id="UserName" name="ID" class="form-control">
                        </div>
                        <div class="form-col">
                            <label for="Report">اسم</label>
                            <input type="text" id="Report" name="Name" class="form-control">
                        </div>
                        <div class="form-col">
                            <label for="Time">تخلص</label>
                            <input type="text" id="Time" name="LastName" class="form-control">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-col">
                            <label for="Plane">ولد</label>
                            <input type="text" id="Plane" name="FatherName" class="form-control">
                        </div>
                        <div class="form-col">
                            <label for="solve">بست</label>
                            <input type="text" id="solve" name="PostType" class="form-control">
                        </div>
                        <div class="form-col">
                            <label for="signature">عنوان بست</label>
                            <input type="text" id="signature" name="JobType" class="form-control">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-col">
                            <label for="signature">آمریت مربوطه</label>
                            <input type="text" id="signature" name="JobType" class="form-control">
                        </div>
                        <div class="form-col">
                            <label for="signature">نوعیت وظیفه</label>
                            <input type="text" id="signature" name="JobType" class="form-control">
                        </div>
                        <div class="form-col">
                            <label for="signature">شماره تماس</label>
                            <input type="text" id="signature" name="JobType" class="form-control">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-col">
                            <label for="signature">ایمیل</label>
                            <input type="text" id="signature" name="JobType" class="form-control">
                        </div>
                        <div class="form-col">
                            <label for="persent">کاربر</label>
                            <input type="text" id="persent" name="Username" class="form-control">
                        </div>
                        <div class="form-col position-relative">
                            <label for="state">رمز عبور</label>
                            <input type="password" id="state" name="Password" class="form-control">
                            <i class="bi bi-eye-slash position-absolute top-50 start-0 me-2 toggle-icon" style="cursor: pointer;margin-left:10px;margin-top:5px;" id="togglePassword1" onclick="togglePassword('state', 'togglePassword1')"></i>
                        </div>
                        <div class="form-col position-relative">
                            <label for="prob">تایید رمز عبور</label>
                            <input type="password" id="prob" name="Conform_Password" class="form-control">
                            <i class="bi bi-eye-slash position-absolute top-50 start-0 me-2 toggle-icon" style="cursor: pointer;margin-left:10px;margin-top:5px;" id="togglePassword2" onclick="togglePassword('prob', 'togglePassword2')"></i>
                        </div>
                    </div>
                    
                    <div class="text-center"> <!-- دکمه‌های ثبت و پاک کردن فرم -->
                        <button type="submit" class="btn">راجستر</button>
                        <button type="reset" class="btn" style="background-color: DodgerBlue;">پاک کردن</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- اسکریپت‌های جاوااسکریپت بوت‌استرپ -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
