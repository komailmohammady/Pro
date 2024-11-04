<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ریاست امور متعلمین و محصلین</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <!-- B Nazanin Font -->
    <link href="https://fonts.ir/font/b-nazanin.css" rel="stylesheet">
</head>
<body dir="rtl">
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <nav class="col-md-2 d-none d-md-block sidebar" style="background-color: #073B4C; color: white; height: 100vh;">
            <div class="sidebar-sticky">
                <img src="img/logo.png" alt="لوگوی داشبورد" class="img-fluid mb-3" style="display: block; margin: 0 auto; width: 200px;">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php" style="color: white;">
                            <i class="bi bi-house-door"></i> داشبورد
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#employeesMenu" data-bs-toggle="collapse" aria-expanded="false" style="color: white;">
                            <i class="bi bi-person"></i> کارمندان
                            <i class="bi bi-chevron-down ms-auto"></i>
                        </a>
                        <div id="employeesMenu" class="collapse">
                            <ul class="nav flex-column ms-1">
                                <li class="nav-item">
                                    <a class="nav-link" href="dashboardpages/EmployeeRegister.php" style="color: white;">ثبت کارمند</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="dashboardpages/ShowEmployee.php" style="color: white;">لیست کارمندان</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#reportsMenu" data-bs-toggle="collapse" aria-expanded="false" style="color: white;">
                            <i class="bi bi-file-earmark-text"></i> گزارشات
                            <i class="bi bi-chevron-down ms-auto"></i>
                        </a>
                        <div id="reportsMenu" class="collapse">
                            <ul class="nav flex-column ms-1">
                                <li class="nav-item">
                                    <a class="nav-link" href="dashboardpages/EmployeeReport.php" style="color: white;">ثبت گزارش</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="dashboardpages/ShowEmployeeReport.php" style="color: white;">لیست گزارشات</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#messageModal" style="color: white;">
                            <i class="bi bi-box-arrow-right"></i> ارسال پیام
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#settingsModal" style="color: white;">
                            <i class="bi bi-gear"></i> تنظیمات
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="PHP/logout.php" style="color: white;">
                            <i class="bi bi-box-arrow-right"></i> خروج
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="col-md-10 ml-sm-auto col-lg-10 px-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h2>داشبورد</h2>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-search"></i></span>
                    <input type="search" id="searchInput" placeholder="جستجو" class="form-control" aria-label="جستجو">
                </div>
            </div>

            <!-- Main Content Here -->

            <!-- Footer -->
            <footer class="footer mt-auto py-3" style="background-color: #073B4C; color: white;">
                <div class="container">
                    <p class="text-center mb-0">&copy; 2024 تمامی حقوق محفوظ است. طراحی شده توسط محصلین ممتاز تکنالوژی کمپیوتر.</p>
                </div>
            </footer>

            <!-- Message Modal -->
            <div class="modal fade" id="messageModal" tabindex="-1" aria-labelledby="messageModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="messageModalLabel">ارسال پیام</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="messageForm" action="">
                                <div class="mb-3">
                                    <label for="message" class="form-label">پیام:</label>
                                    <textarea class="form-control" id="message" rows="12" required></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">ارسال</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bootstrap JS and dependencies -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
            <script src="js/Search.js"></script>
        </main>
    </div>
</div>
</body>
</html>
