<?php
session_start();
include_once "../connection.php";

// Check if user is not logged in
if (!isset($_SESSION["email_employee"])) {
    header("Location: login.php");
    exit();
}

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve user ID based on email
$email = $_SESSION["email_employee"];
$sql = "SELECT user_id FROM employees WHERE email='$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $user_id = $row["user_id"];

    // Fetch leave requests for the user
    $sql_leave_requests = "SELECT * FROM leave_requests WHERE user_id='$user_id'";
    $result_leave_requests = $conn->query($sql_leave_requests);

    if ($result_leave_requests->num_rows > 0) {
        // Output leave requests in a table
        echo "<!DOCTYPE html>";
        echo "<html lang='en'>";
        echo "<head>";
        echo "<meta charset='UTF-8'>";
        echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
        echo "<title>Leave Requests</title>";
        echo "<style>";
        echo "body { font-family: Arial, sans-serif; margin: 0; padding: 0; background-color: #f2f2f2; }";
        echo ".navbar { background-color: #3498db; color: #fff; padding: 20px; display: flex; justify-content: space-between; align-items: center; }";
        echo ".navbar a { color: #fff; text-decoration: none; padding: 10px; margin: 0 10px; }";
        echo ".container { max-width: 800px; margin: 20px auto; padding: 20px; background-color: #fff; border-radius: 5px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); }";
        echo "table { width: 100%; border-collapse: collapse; }";
        echo "th, td { border: 1px solid #dddddd; text-align: left; padding: 8px; }";
        echo "th { background-color: #3498db; color: #ffffff; }";
        echo "tr:nth-child(even) { background-color: #f2f2f2; }";
        echo "</style>";
        echo "</head>";
        echo "<body>";
        echo "<div class='navbar'>";
        echo "<div><h2>Employee Dashboard</h2></div>";
        echo "<div>";
        echo "<a href='#'>Home</a>";
        echo "<a href='#'>Profile</a>";
        echo "<a href='#'>Leave Requests</a>";
        echo "<a href='#'>Tasks</a>";
        echo "</div>";
        echo "</div>";
        echo "<div class='container'>";
        echo "<h2>Leave Requests</h2>";
        echo "<table>";
        echo "<tr><th>Start Date</th><th>End Date</th><th>Reason</th><th>Status</th><th>Action</th></tr>";
        while ($row_leave_request = $result_leave_requests->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row_leave_request["start_date"] . "</td>";
            echo "<td>" . $row_leave_request["end_date"] . "</td>";
            echo "<td>" . $row_leave_request["reason"] . "</td>";
            echo "<td>" . $row_leave_request["status"] . "</td>";
            echo "<td><a href='#' onclick='confirmDelete(" . $row_leave_request["id"] . ")'>Delete</a></td>";
            echo "</tr>";
        }
        echo "</table>";
        echo "<a href='employee_dashboard.php'>Go Back</a>";
        echo "</div>";

        // JavaScript for confirmation popup and delete action
        echo "<script>";
        echo "function confirmDelete(id) {";
        echo "  if (confirm('Are you sure you want to delete this leave request?')) {";
        echo "    window.location.href = 'delete_leave.php?id=' + id;";
        echo "  }";
        echo "}";
        echo "</script>";

        echo "</body>";
        echo "</html>";
    } else {
        echo "<!DOCTYPE html>";
        echo "<html lang='en'>";
        echo "<head>";
        echo "<meta charset='UTF-8'>";
        echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
        echo "<title>No Leave Requests</title>";
        echo "<style>";
        echo "body { font-family: Arial, sans-serif; margin: 0; padding: 0; background-color: #f2f2f2; }";
        echo ".container { max-width: 800px; margin: 20px auto; padding: 20px; background-color: #fff; border-radius: 5px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); }";
        echo "</style>";
        echo "</head>";
        echo "<body>";
        echo "<div class='container'>";
        echo "<h2>No Leave Requests</h2>";
        echo "<p>No leave requests found for you!</p>";
        echo "<a href='employee_dashboard.php'>Go Back</a>";
        echo "</div>";
        echo "</body>";
        echo "</html>";
    }
} else {
    echo "Error: User not found";
}

$conn->close();
?>
