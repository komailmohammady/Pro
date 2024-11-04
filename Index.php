<?php  
include 'PHP/ConnectionToDatabase.php';

// Fetch internal plan data
$sql_internal = "SELECT e.Did_Reports, 
                        COALESCE(SUM(CAST(REPLACE(er.improve_precentage, '%', '') AS UNSIGNED)), 0) AS total_percentage 
                 FROM (SELECT DISTINCT Did_Reports FROM employeereport) e
                 LEFT JOIN employeereport er 
                       ON e.Did_Reports = er.Did_Reports AND er.Plane IN ('پلان مربوطه')
                 GROUP BY e.Did_Reports";

// Prepare data for JavaScript
$chartDataInternal = [];

// Get internal plan data
if ($result_internal = $conn->query($sql_internal)) {
    while($row = $result_internal->fetch_assoc()) {
        $chartDataInternal[$row['Did_Reports']] = (int)$row['total_percentage'];
    }
}

$conn->close();
?>
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
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawCharts);

      var chartDataInternal = [
        ['کارمند', 'فیصدي'],
        <?php
          foreach($chartDataInternal as $employee => $percentage) {
              echo "['" . $employee . "', " . $percentage . "],";
          }
        ?>
      ];

      function drawCharts() {
        var dataInternal = google.visualization.arrayToDataTable(chartDataInternal);
        var options = {
          title: 'گراف پلان عملیاتی کارمندان',
          titleTextStyle: {
            color: '#073B4C',
            fontSize: 24,
            bold: true,
          },
          width: '100%',
          height: 350,
          hAxis: {
            minValue: 0,
            textStyle: {
              color: '#073B4C',
              fontSize: 14,
            },
            titleTextStyle: {
              color: '#073B4C',
              fontSize: 16,
              bold: true
            }
          },
          vAxis: {
            textStyle: {
              color: '#073B4C',
              fontSize: 14,
            },
            titleTextStyle: {
              color: '#073B4C',
              fontSize: 16,
              bold: true
            }
          },
          colors: ['#4285F4', '#EA4335', '#FBBC05', '#34A853'], // Google Colors
          legend: { position: 'top', alignment: 'end', textStyle: { color: '#073B4C', fontSize: 14 } },
          fontName: 'B Nazanin',
          backgroundColor: '#f7f7f7',
          chartArea: { width: '90%', height: '50%' }, // Make the chart area larger
        };
        
        var chartInternal = new google.visualization.ColumnChart(document.getElementById('barchartInternal'));
        chartInternal.draw(dataInternal, options);
      }

      window.onresize = drawCharts;
    </script>
    <style>
        body {
            font-family: 'B Nazanin', sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            background-color: #e9ecef; /* Light gray background */
        }
        h2.chart-title {
            text-align: center;
            margin-bottom: 20px;
            color: #073B4C; /* Main color for titles */
            font-size: 24px; /* Larger font size for better visibility */
        }
        .charts-container {
            width: 100%;
            margin-top: 20px;
            display: flex;
            justify-content: center;  /* Center the charts */
            padding: 20px; /* Add padding around the chart */
            background-color: white; /* White background for contrast */
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
            border-radius: 10px; /* Rounded corners */
        }
        #barchartInternal {
            width: 100%; /* Make it responsive */
            height: 400px; /* Set height */
        }
    </style>
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
                    <span class="input-group-text">جستجو</span>
                    <input type="text" class="form-control" placeholder="نام کارمند را وارد کنید" aria-label="Search">
                </div>
            </div>

            <div class="charts-container">
                <div id="barchartInternal"></div>
            </div>
        </main>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
