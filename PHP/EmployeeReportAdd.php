<?php
session_start();
include 'ConnectionToDatabase.php'; 

if (!isset($_SESSION['username'])) {
    die("You are not logged in.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and sanitize input data
    $didReports = $_POST['Did_Reports'] ?? '';
    $activityTime = $_POST['Activity_Time'] ?? '';
    $plane = $_POST['Plane'] ?? '';
    $improvePercentage = $_POST['Improve_Precentage'] ?? '';
    $result = $_POST['Result'] ?? '';
    $problems = $_POST['Problems'] ?? '';
    $resolveSuggestion = $_POST['Resolve_Sugestion'] ?? '';
    $date = $_POST['Date'] ?? '';
    $observation = $_POST['Observation'] ?? '';

    // Fetch username from session
    $username = $_SESSION['username'];

    // Fetch the user ID from the database
    $stmt = $conn->prepare("SELECT ID FROM employee_register WHERE Username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($uid);
    $stmt->fetch();
    $stmt->close();
    // Check if fields are filled
    if (empty($uid) || empty($didReports) || empty($activityTime) || empty($plane) || empty($improvePercentage) || empty($result) || empty($problems) || empty($resolveSuggestion) || empty($date)) {
        ?>
        <script>
            alert("لطفاً تمام فیلدها را پر کنید!");
            window.history.back(); 
        </script>
        <?php
    } else {
        // Prepare the SQL statement without the ID field
        $stmt = $conn->prepare("INSERT INTO employeereport (username, Did_Reports, Activity_Time, Plane, Improve_Precentage, Result, Problems, Resolve_Sugestion, Date, Observation) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        
        // Bind parameters, excluding ID
        $stmt->bind_param("ssssssssss", $username, $didReports, $activityTime, $plane, $improvePercentage, $result, $problems, $resolveSuggestion, $date, $observation);

        if ($stmt->execute()) {
            ?>
            <script>
                alert("شما موفقانه به سیستم ثبت کردید!!!");
                window.location.href = "../dashboardpages/ShowEmployeeReport.php"; // Redirect to ShowEmployeeReport
            </script>
            <?php
        } else {
            ?>
            <script>
                alert("خطایی رخ داد. لطفاً دوباره تلاش کنید.");
                console.error("Error: " + "<?php echo addslashes($stmt->error); ?>");
            </script>
            <?php
        }

        $stmt->close();
    }
}

$conn->close();
?>
