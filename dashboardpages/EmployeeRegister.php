<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>فرم راجستر</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="../Css/dash.css" type="text/css">
    <script src="../js/script.js"></script>
</head>
<body dir="rtl">
<div class="container-fluid">
    <div class="row">
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
            
        <!-- ناحیه محتوای اصلی -->
        <div class="col-md-10 content mr-2">
            <div class="header">
                <h1>فرم ثبت کارمندان ریاست امور متعلمین و محصلین</h1>
            </div>

            <!-- فرم ثبت کارمند -->
            <form action="../PHP/EmployeeRegisterAddCodes.php" method="post" id="form">
                <div class="row">
                    <div class="col-md-4 mb-2">
                        <label for="UserName">آی‌دی</label>
                        <input type="number" id="UserName" name="ID" class="form-control">
                    </div>
                    <div class="col-md-4 mb-2">
                        <label for="Report">اسم</label>
                        <input type="text" id="Report" name="Name" class="form-control">
                    </div>
                    <div class="col-md-4 mb-2">
                        <label for="Time">تخلص</label>
                        <input type="text" id="Time" name="LastName" class="form-control">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-2">
                        <label for="Plane">ولد</label>
                        <input type="text" id="Plane" name="FatherName" class="form-control">
                    </div>
                    <div class="col-md-4 mb-2">
                        <label for="phone">شماره تماس</label>
                        <input type="text" id="phone" name="Phone" class="form-control">
                    </div>
                    <div class="col-md-4 mb-2">
                        <label for="email">ایمیل</label>
                        <input type="email" id="email" name="Email" class="form-control">
                    </div>
                    <div class="col-md-4 mb-2">
                            <label for="Post_No">بست</label>
                            <select name="PostNo" class="form-control" required>
                                <option value="بست اول">بست اول</option>
                                <option value="بست دوم">بست دوم</option>
                                <option value="بست سوم">بست سوم</option>
                                <option value="بست چهارم">بست چهارم</option>
                                <option value="بست پنجم">بست پنجم</option>
                            </select>
                        </div>
                    <div class="col-md-4 mb-2">
                        <label for="signature">عنوان بست</label>
                        <input type="text" id="signature" name="JobType" class="form-control">
                    </div>
                    <div class="col-md-4 mb-2">
                            <label for="Relevant_Department">آمریت مربوطه</label>
                            <select name="ReleventDep" class="form-control" required>
                                <option value="آمریت امور مکاتب">آمریت امور مکاتب</option>
                                <option value="آمریت نتایج">آمریت نتایج</option>
                                <option value="آمریت تعلیمات خاص">آمریت تعلیمات خاص</option>
                                <option value="آمریت امور تنظیم لیله ها">آمریت امور تنظیم لیلیه ها</option>
                            </select>
                        </div>
                </div>
                
                <div class="row">
                    <div class="col-md-4 mb-2">
                        <label for="jobType">نوعیت وظیفه</label>
                        <input type="text" id="jobType" name="JobType" class="form-control">
                    </div>
                    <div class="col-md-8 mb-2">
                            <label for="Observation">ملاحظات</label>
                            <textarea name="Observation" id="Observation" class="form-control"></textarea>
                        </div>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-2">
                        <label for="persent">کاربر</label>
                        <input type="text" id="persent" name="Username" class="form-control">
                    </div>
                    <div class="col-md-4 mb-2 position-relative">
                        <label for="state">رمز عبور</label>
                        <input type="password" id="state" name="Password" class="form-control">
                        <i class="bi bi-eye-slash position-absolute top-50 start-0 me-2 toggle-icon" style="cursor: pointer;margin-left:10px;margin-top:5px;" id="togglePassword1" onclick="togglePassword('state', 'togglePassword1')"></i>
                    </div>
                    <div class="col-md-4 mb-2 position-relative">
                        <label for="prob">تایید رمز عبور</label>
                        <input type="password" id="prob" name="Conform_Password" class="form-control">
                        <i class="bi bi-eye-slash position-absolute top-50 start-0 me-2 toggle-icon" style="cursor: pointer;margin-left:10px;margin-top:5px;" id="togglePassword2" onclick="togglePassword('prob', 'togglePassword2')"></i>
                    </div>
                </div>
                
                <div class="text-center"> <!-- دکمه‌های ثبت و پاک کردن فرم -->
                    <button type="submit" class="btnn">راجستر</button>
                </div>
            </form>
        </div>
    </div>
    
    <!-- Message Modal -->
    <div class="modal fade" id="messageModal" tabindex="-1" aria-labelledby="messageModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title ms-2" id="messageModalLabel">ارسال پیام</h5>
                    <button type="button" class="btn-close ms-3" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="messageForm" action="">
                        <div class="mb-3">
                            <label for="message" class="form-label">پیام:</label>
                            <textarea class="form-control" id="message" rows="12" required></textarea>
                        </div>
                        <button type="submit" class="btnn">ارسال</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- اسکریپت‌های جاوااسکریپت بوت‌استرپ -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
