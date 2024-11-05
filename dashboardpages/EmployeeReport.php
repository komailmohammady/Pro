<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>گزارشدهی کارمندان</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="../Css/dash.css" type="text/css" type="text/css">
    <link rel="stylesheet" href="../Css/kamadatepicker.min.css" type="text/css">
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
            <!-- Main Content Area -->
            <div class="col-md-10 content mr-2">
                <div class="header text-center mt-3 mb-4">
                    <h1><b>فارمت گزارشدهی کارمندان</b></h1>
                </div>

                <form action="../PHP/EmployeeReportAdd.php" method="post" id="form" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="Report">گزارش فعالیت های انجام شده</label>
                            <input type="text" id="Report" name="Did_Reports" class="form-control">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="Time">زمان اجرای فعالیت</label>
                            <input type="text" id="Time" name="Activity_Time" class="form-control">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="Plane">پلان</label>
                            <select name="Plane" class="form-control">
                                <option value="پلان مربوطه">پلان عملیاتی</option>
                                <option value="خارج از پلان">خارج از پلان</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="persent">فیصدی پیشرفت</label>
                            <input type="text" id="persent" name="Improve_Precentage" class="form-control">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="state">نتیجه/دستاورد</label>
                            <input type="text" id="state" name="Result" class="form-control">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="date">تاریخ</label>
                            <input type="text" id="datepacker" name="Date" class="form-control">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="prob">مشکلات/نواقص و کمبودات</label>
                            <input type="text" id="prob" name="Problems" class="form-control">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="solve">راه حل پیشنهادی</label>
                            <input type="text" id="solve" name="Resolve_Sugestion" class="form-control">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="Observation">ملاحظات</label>
                            <input type="text" id="Observation" name="Observation" class="form-control">
                        </div>
                    </div>

                    <div class="text-center col-md-3">
                        <button type="submit" class="btnn">ثبت گزارشات</button>
                    </div>
                </form>
            </div>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../js/assits/jquery.js"></script>
    <script src="../js/assits/kamadatepicker.min.js"></script>
    <script>
        let options = {
    placeholder: "تاریخ",
    twodigit: false,
    closeAfterSelect: false,
    nextButtonIcon : "../img/timeir_next.png",
    previousButtonIcon : "../img/timeir_prev.png",
    buttonsColor:"blue",
    forceFarsiDigits : true,
    markToday: true,
    markHolidays:true,
    sync:true,
    gotoToday:true
}


        kamaDatepicker('datepacker',options);
        $("#datepacker").vla("1403/8/3")
    </script>
</body>
</html>
