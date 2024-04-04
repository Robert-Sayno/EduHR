<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include the file with database connection
include_once "connection.php";

// Check if user is not logged in
if (!isset($_SESSION["email_employee"])) {
    header("Location: login.php");
    exit();
}

// Retrieve employee details based on email from session
$email = $_SESSION["email_employee"];
$sql_query = "SELECT fullname FROM employees WHERE email='$email'";
$result = mysqli_query($conn, $sql_query);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $employee_fullname = $row["fullname"];
} else {
    // Handle error if employee details not found
    $employee_fullname = "Unknown";
}

// Set the session variable for the full name if it's not already set
if (!isset($_SESSION["fullname"])) {
    $_SESSION["fullname"] = $employee_fullname;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Dashboard</title>
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
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .nav-links {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .nav-links a {
            color: #fff;
            text-decoration: none;
            padding: 10px;
            margin: 0 10px;
        }

        .nav-links a:hover {
            text-decoration: underline;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .section {
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
            flex-basis: calc(33.33% - 20px);
        }

        .card {
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 10px;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Employee Dashboard</h1>
        <div class="nav-links">
            <a href="#">Home</a>
            <a href="#">Profile</a>
            <a href="#">Leave Requests</a>
            <a href="#">Tasks</a>
            <p>Welcome, <?php echo $employee_fullname; ?>!</p>
            <form method="post">
                <input type="submit" name="logout" value="Logout">
            </form>
        </div>
    </div>

    <div class="container">
        <div class="section">
            <div class="card">
                <div class="card-content">
                    <h2>Welcome, <?php echo $employee_fullname; ?>!</h2>
                    <p>Employee ID: 123456</p>
                    <p>Email: <?php echo $_SESSION["fullname"]; ?></p>
                    <p>Department: IT</p>
                </div>
            </div>
        </div>

        <div class="section">
            <div class="card">
                <div class="card-content">
                    <h2>Leave Requests</h2>
                    <p>You have 3 pending leave requests.</p>
                    <a href="#">View Leave Requests</a>
                </div>
            </div>
        </div>

        <div class="section">
            <div class="card">
                <div class="card-content">
                    <h2>Tasks</h2>
                    <p>You have 5 tasks assigned.</p>
                    <a href="#">View Tasks</a>
                </div>
            </div>
        </div>

        <!-- Add more sections as needed -->
    </div>
</body>

</html>
