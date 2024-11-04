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

// Fetch external plan data
$sql_external = "SELECT e.username, 
                        COALESCE(SUM(CAST(REPLACE(er.improve_precentage, '%', '') AS UNSIGNED)), 0) AS total_percentage 
                 FROM (SELECT DISTINCT username FROM employeereport) e
                 LEFT JOIN employeereport er 
                       ON e.username = er.username AND er.Plane IN ('خارج از پلان')
                 GROUP BY e.username";

// Prepare data for JavaScript
$chartDataInternal = [];
$chartDataExternal = [];

// Get internal plan data
if ($result_internal = $conn->query($sql_internal)) {
    while($row = $result_internal->fetch_assoc()) {
        $chartDataInternal[$row['username']] = (int)$row['total_percentage'];
    }
}

// Get external plan data
if ($result_external = $conn->query($sql_external)) {
    while($row = $result_external->fetch_assoc()) {
        $chartDataExternal[$row['username']] = (int)$row['total_percentage'];
    }
}

// Get all employee usernames
$allEmployees = [];
$query = "SELECT DISTINCT Username FROM employeereport";
$allResult = $conn->query($query);
while($row = $allResult->fetch_assoc()) {
    $allEmployees[] = $row['Username'];
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
          foreach($allEmployees as $employee) {
              $percentage = isset($chartDataInternal[$employee]) ? $chartDataInternal[$employee] : 0;
              echo "['" . $employee . "', " . $percentage . "],";
          }
        ?>
      ];

      var chartDataExternal = [
        ['کارمند', 'فیصدي'],
        <?php
          foreach($allEmployees as $employee) {
              $percentage = isset($chartDataExternal[$employee]) ? $chartDataExternal[$employee] : 0;
              echo "['" . $employee . "', " . $percentage . "],";
          }
        ?>
      ];

      function drawCharts() {
        var dataInternal = google.visualization.arrayToDataTable(chartDataInternal);
        var options = {
          pieHole: 0.4,
          width: 500,
          height: 500,
          legend: 'none',
          colors: ['DodgerBlue', '#FF5733', '#FFC300', '#DAF7A6', '#C70039'], // Customize colors with a palette
          fontName: 'B Nazanin',
          pieSliceText: 'label',
          pieSliceTextStyle: {
            color: 'white',
            fontSize: 16
          },
          titleTextStyle: {
            color: '#333',
            fontSize: 18,
            bold: true
          }
        };
        
        var chartInternal = new google.visualization.PieChart(document.getElementById('donutchartInternal'));
        chartInternal.draw(dataInternal, { ...options, title: 'گزاشات پلان مربوطه' });  // Add title for internal plan chart

        var dataExternal = google.visualization.arrayToDataTable(chartDataExternal);
        var chartExternal = new google.visualization.PieChart(document.getElementById('donutchartExternal'));
        chartExternal.draw(dataExternal, { ...options, title: 'گزارشات خارج از پلان ' });  // Add title for external plan chart
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
            display: flex;
            width: 80%;
            margin-top: 20px;
            justify-content: center;  /* Center the charts */
            align-items: center;      /* Center vertically */
        }
        #donutchartInternal, #donutchartExternal {
            width: 500px;
            height: 500px;
            margin: 0 20px; /* Add margin between charts */
        }
        .chart-title {
            text-align: center;
            margin-top: 20px;
            font-size: 1.5em;  /* Set a slightly smaller font size for titles */
            color: #343a40;     /* Dark gray color for titles */
        }
        table {
            width: 80%;
            margin-top: 30px;
            border-collapse: collapse;
            text-align: center;
            background-color: #fff; /* White background for the table */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2); /* Shadow for the table */
        }
        th, td {
            border: 1px solid #dee2e6; /* Light gray border */
            padding: 12px;
        }
        th {
            background-color: #007bff; /* Bootstrap primary color */
            color: white; /* White text */
            font-weight: bold; /* Bold font for header */
        }
        tr:hover {
            background-color: #f1f1f1; /* Highlight on hover */
        }
    </style>
</head>
<body dir="rtl">
    <h1>بررسی عمومي راپور هایی کارمندان</h1>
    <div class="charts-container">
        <div>
            <h2 class="chart-title">گزارشات پلان مربوطه</h2>
            <div id="donutchartInternal"></div>
        </div>
        <div>
            <h2 class="chart-title">گزارشات خارج از پلان </h2>
            <div id="donutchartExternal"></div>
        </div>
    </div>

    <!-- Table displaying employee data -->
    <table>
        <thead>
            <tr>
                <th>نام و تخلص کارمند</th>
                <th>پلان مربوطه (%)</th>
                <th>خارج از پلان (%)</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach ($allEmployees as $employee) {
                    $internalPercentage = isset($chartDataInternal[$employee]) ? $chartDataInternal[$employee] : 0;
                    $externalPercentage = isset($chartDataExternal[$employee]) ? $chartDataExternal[$employee] : 0;
                    echo "<tr>
                            <td>$employee</td>
                            <td>$internalPercentage%</td>
                            <td>$externalPercentage%</td>
                          </tr>";
                }
            ?>
        </tbody>
    </table>
</body>
</html>
