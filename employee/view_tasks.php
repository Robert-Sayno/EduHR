<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Start session (assuming you're using sessions for user authentication)
session_start();

// Check if the user is logged in
if (!isset($_SESSION['fullname'])) {
    // Redirect to login page or display an error message
    header("Location: login.php");
    exit();
}

// Include database connection
include_once "../connection.php";

// Get the fullname of the currently logged-in employee
$fullname = $_SESSION['fullname'];

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Review</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }

        .header {
            background-color: #3498db;
            color: #fff;
            padding: 20px;
            text-align: center;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #f9f9f9;
        }

        .nav-links {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }

        .nav-links a {
            color: #fff;
            text-decoration: none;
            padding: 10px 20px;
            background-color: #2c3e50;
            border-radius: 5px;
            margin: 0 10px;
        }

        .nav-links a:hover {
            background-color: #34495e;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Task Management System</h1>
    </div>
    
    <div class="nav-links">
        <a href="#">Home</a>
        <a href="#">Profile</a>
        <a href="#">Logout</a>
    </div>

    <div class="container">
        <h2>Tasks Assigned to You</h2>
        <table>
            <thead>
                <tr>
                    <th>Task ID</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
                // Fetch tasks assigned to the user
                $sql = "SELECT task_id, description FROM tasks WHERE fullname = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("s", $fullname);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    // Output data of each row
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["task_id"] . "</td>";
                        echo "<td>" . $row["description"] . "</td>";
                        // Add action buttons or links
                        echo "<td>";
                        echo "<button onclick='completeTask(" . $row["task_id"] . ")'>Complete</button>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>No tasks assigned to you.</td></tr>";
                }

                // Close statement and database connection
                $stmt->close();
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
    <script>
        // Function to handle completing a task
        function completeTask(taskId) {
            // You can perform AJAX request to mark the task as complete in the database
            // For demonstration purpose, let's just alert the task ID
            alert("Task " + taskId + " completed!");
        }
    </script>
</body>
</html>
