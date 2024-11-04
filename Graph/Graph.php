<?php  
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "final";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch internal plan data
$sql_internal = "SELECT e.username, 
                        COALESCE(SUM(CAST(REPLACE(er.improve_precentage, '%', '') AS UNSIGNED)), 0) AS total_percentage 
                 FROM (SELECT DISTINCT username FROM employeereport) e
                 LEFT JOIN employeereport er 
                       ON e.username = er.username AND er.Plane IN ('پلان مربوطه')
                 GROUP BY e.username";

// Prepare data for JavaScript
$chartDataInternal = [];

// Get internal plan data
if ($result_internal = $conn->query($sql_internal)) {
    while($row = $result_internal->fetch_assoc()) {
        $chartDataInternal[$row['username']] = (int)$row['total_percentage'];
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <title>راپور های کارمندان</title>

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
          title: 'گزاشات پلان مربوطه',
          width: 600,
          height: 400,
          hAxis: {
            title: 'فیصدي',
            minValue: 0,
          },
          vAxis: {
            title: 'کارمندان',
          },
          colors: ['#4285F4', '#EA4335', '#FBBC05', '#34A853'], // Google Colors
          legend: { position: 'none' },
          fontName: 'B Nazanin',
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
        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #212529; /* Dark gray text */
        }
        .charts-container {
            width: 80%;
            margin-top: 20px;
            display: flex;
            justify-content: center;  /* Center the charts */
        }
        #barchartInternal {
            width: 600px;
            height: 400px;
        }
    </style>
</head>
<body dir="rtl">
    <h1>بررسی عمومي راپور هایی کارمندان</h1>
    <div class="charts-container">
        <div>
            <h2 class="chart-title">گزارشات پلان مربوطه</h2>
            <div id="barchartInternal"></div>
        </div>
    </div>
</body>
</html>
