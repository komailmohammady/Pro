<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>فرم راجستر</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="../Css/dash.css" type="text/css">
    <link rel="stylesheet" href="../Css/Employee_Report.css" type="text/css">
    <script src="../js/script.js"></script>
    <style>
        body {
            background-color: #f8f9fa;
        }
        .form-control {
            height: 40px;
        }
        .sidebar {
            height: 100vh;
            overflow-y: auto;
        }
        .main-content {
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            background: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
            color: DodgerBlue;
            padding: 20px;
            border-radius: 20px;
        }
        .header h1 {
            font-size: 2rem;
            font-weight: bold;
        }
        .btn {
            padding: 10px;
            background-color: DodgerBlue;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 20px;
            cursor: pointer;
            transition: background-color 0.3s;
            font-family: 'B Nazanin';
            font-weight: bold;
            width: 330px;
        }
    </style>
</head>
<body dir="rtl">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 sidebar">
                <img src="../img/logo.png" alt="لوگوی داشبورد" class="logo-img">
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

                <a href="logout.html"><i class="bi bi-box-arrow-right"></i> خروج</a>
            </div>

            <div class="col-md-10 main-content">
                <div class="header">
                    <h1>فرم ثبت کارمندان ریاست امور متعلمین و محصلین</h1>
                </div>

                <form action="../PHP/EmployeeRegisterAddCodes.php" method="post" id="form" onsubmit="return validateForm()">
                    <div class="form-row">
                        <div class="form-col">
                            <label for="UserName">آي دی</label>
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
                            <label for="solve">عنوان بست</label>
                            <input type="text" id="solve" name="PostType" class="form-control">
                        </div>
                        
                        <div class="form-col">
                            <label for="signature">نوعیت وظیفه</label>
                            <input type="text" id="signature" name="JobType" class="form-control">
                        </div>
                    </div>

                    <div class="form-row">
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
                            <i class="bi bi-eye-slash position-absolute top-50 start-0 me-3 toggle-icon" style="cursor: pointer;margin-left:10px;margin-top:5px;" id="togglePassword2" onclick="togglePassword('prob', 'togglePassword2')"></i>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-col">
                            <label for="Post_No">بست</label>
                            <select name="PostNo" class="form-control">
                                <option value="بست اول">بست اول</option>
                                <option value="بست دوم">بست دوم</option>
                                <option value="بست سوم">بست سوم</option>
                                <option value="بست چهارم">بست چهارم</option>
                                <option value="بست پنجم">بست پنجم</option>
                            </select>
                        </div>

                        <div class="form-col">
                            <label for="Relevant_Department">آمریت مربوطه</label>
                            <select name="ReleventDep" class="form-control">
                                <option value="آمریت امور مکاتب">آمریت امور مکاتب</option>
                                <option value="آمریت نتایج">آمریت نتایج</option>
                                <option value="آمریت تعلیمات خاص">آمریت تعلیمات خاص</option>
                                <option value="آمریت امور تنظیم لیله ها">آمریت امور تنظیم لیلیه ها</option>
                            </select>
                        </div>

                        <div class="form-col">
                            <label for="Observation">ملاحضات</label>
                            <textarea name="Observation" id="Observation" class="form-control"></textarea>
                        </div>
                    </div>

                    <!-- New Fields for Email and Phone -->
                    <div class="form-row">
                        <div class="form-col">
                            <label for="email">ایمیل آدرس</label>
                            <input type="email" id="email" name="email" class="form-control">
                        </div>
                        <div class="form-col">
                            <label for="phone">شماره تماس</label>
                            <input type="text" id="phone" name="phone" class="form-control">
                        </div>
                    </div>

                    <div class="form-row" style="justify-content: center;">
                        <button type="submit" name="submit" id="btn" class="btn btn-primary">ثبت کارمند</button>
                    </div>
                </form>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
