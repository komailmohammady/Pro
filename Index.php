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
    <link rel="stylesheet" href="Css/dash.css" type="text/css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        setInterval(function() {
            fetch('get_total_reports.php')
            .then(response => response.json())
            .then(data => {
                document.getElementById('totalReports').innerText = data.total_reports;
            });
        }, 60000);

        setInterval(function() {
            fetch('get_total_ShowEmployeeReport.php')
            .then(response => response.json())
            .then(data => {
                document.getElementById('EmployeeReport').innerText = data.total_ShowEmployeeReport;
            });
        }, 60000);
    </script>
</head>
<body dir="rtl">
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-2 sidebar">
            <img src="img/logo.png" alt="لوگوی داشبورد" class="logo-img mb-3">
            <a href="index.php"><i class="bi bi-house-door"></i> داشبورد</a>
            <a href="#employeesMenu" data-bs-toggle="collapse" aria-expanded="false" class="d-flex align-items-center">
                <i class="bi bi-person"></i> کارمندان
                <i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <div id="employeesMenu" class="collapse">
                <ul>
                    <li><a href="dashboardpages/EmployeeRegister.php" class="d-block">ثبت کارمند</a></li>
                    <li><a href="dashboardpages/ShowEmployee.php" class="d-block">لیست کارمندان</a></li>
                </ul>
            </div>
            <a href="#reportsMenu" data-bs-toggle="collapse" aria-expanded="false" class="d-flex align-items-center">
                <i class="bi bi-file-earmark-text"></i> گزارشات
                <i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <div id="reportsMenu" class="collapse">
                <ul>
                    <li><a href="dashboardpages/EmployeeReport.php" class="d-block">ثبت گزارش</a></li>
                    <li><a href="dashboardpages/ShowEmployeeReport.php" class="d-block">لیست گزارشات</a></li>
                </ul>
            </div>
            <a href="#" data-bs-toggle="modal" data-bs-target="#messageModal"><i class="bi bi-chat-left-text"></i> ارسال پیام</a>
            <a href="PHP/logout.php"><i class="bi bi-box-arrow-right"></i> خروج</a>
        </div>

        <!-- Main Content -->
        <div class="col-md-10 content">
            <div class="main--content p-4">
                <div class="header--wrapper d-flex justify-content-between align-items-center mb-3">
                    <div class="header--title">
                        <span>اصلی</span>
                        <h2>داشبورد</h2>
                    </div>
                    <div class="user--info">
                        <div class="search--box">
                            <i class="bi bi-search"></i>
                            <input type="search" id="searchInput" placeholder="جستجو" class="form-control">
                            <div id="autocompleteList" class="list-group mt-1 position-absolute" style="z-index:1; width:300px; background-color:unset;"></div>
                        </div>
                    </div>
                </div>
                
                <!-- Main Content of Dashboard -->
                <div class="chart-container mt-4">
                    <canvas id="myChart"></canvas>
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
                                    <button type="submit" class="btn btn-primary">ارسال</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bootstrap JS and dependencies -->
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
                <script src="js/Search.js"></script>

                <!-- Chart.js Setup with Dynamic Data -->
                <script>
                    var chartDataInternal = <?php echo json_encode($chartDataInternal); ?>;
                    
                    // Convert chartDataInternal into labels and data arrays
                    var labels = Object.keys(chartDataInternal);
                    var dataValues = Object.values(chartDataInternal);

                    // Get the context of the canvas
                    var ctx = document.getElementById('myChart').getContext('2d');

                    // Create a new chart
                    var myChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: 'درصد بهبود',
                                data: dataValues,
                                backgroundColor: [
                                    'rgba(75, 192, 192, 0.2)',
                                    'rgba(153, 102, 255, 0.2)',
                                    'rgba(255, 159, 64, 0.2)',
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(54, 162, 235, 0.2)',
                                    'rgba(255, 206, 86, 0.2)'
                                ],
                                borderColor: [
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(153, 102, 255, 1)',
                                    'rgba(255, 159, 64, 1)',
                                    'rgba(255, 99, 132, 1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 206, 86, 1)'
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            },
                            plugins: {
                                legend: {
                                    labels: {
                                        font: {
                                            size: 14
                                        }
                                    }
                                }
                            }
                        }
                    });
                </script>
            </div>
        </div>
    </div>
</div>
                <!-- Footer -->
                <footer>
                    <p>&copy; 2024 تمامی حقوق محفوظ است. طراحی شده توسط محصلین ممتاز تکنالوژی کمپیوتر.</p>
                </footer>
</body>
</html>
