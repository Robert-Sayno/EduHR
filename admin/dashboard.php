<?php
session_start();

// Check if user is not logged in
if (!isset($_SESSION["email"])) {
    header("Location: login.php");
    exit();
}

// Database connection
require_once "../connection.php";

// Retrieve admin details based on email from session
$email = $_SESSION["email"];
$sql_query = "SELECT fullname FROM admins WHERE email='$email'";
$result = mysqli_query($conn, $sql_query);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $admin_name = $row["fullname"];
} else {
    // Handle error if admin details not found
    $admin_name = "Unknown";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Your CSS styles -->
</head>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
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
        }

        .nav-header {
            background-color: #2c3e50;
            color: #fff;
            padding: 10px;
            border-radius: 5px 5px 0 0;
            margin-bottom: 20px;
            width: 100%;
        }

        .nav-links {
            display: flex;
            justify-content: center;
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
    <div class="header">
        <h1>Welcome, <?php echo $admin_name; ?>!</h1>
    </div>
    </div>

    <div class="nav-header">
        <div class="nav-links">
            <a href="#">Home</a>
            <a href="#">Admins</a>
            <a href="#">Employees</a>
            <a href="#">Leave Management</a>

    
            <!-- Add more links as needed -->
        </div>
    </div>

    <div class="container">
        <div class="section">
            <div class="card">
                <div class="card-content">
                    <p>Total Admins: 10</p>
                    <a href="manage-admin.php">View All Admins</a>
                </div>
            </div>
        </div>

        <div class="section">
            <div class="card">
                <div class="card-content">
                    <p>Total Employees: 50</p>
                    <a href="manage-employee.php">View All Employees</a>
                </div>
            </div>
        </div>

        <div class="section">
            <div class="card">
                <div class="card-content">
                    <p>Employees on Leave (Daywise)</p>
                    <p>Today: 5</p>
                    <p>Tomorrow: 7</p>
                </div>
            </div>
        </div>

        <div class="section">
            <div class="card">
                <div class="card-content">
                    <p>Employee Leadership Board</p>
                    <table>
                        <thead>
                            <tr>
                                <th>S.No.</th>
                                <th>Employee's Id</th>
                                <th>Employee's Name</th>
                                <th>Employee's Email</th>
                                <th>Salary in Rs.</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>1001</td>
                                <td>John Doe</td>
                                <td>john@example.com</td>
                                <td>50000</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>1002</td>
                                <td>Jane Smith</td>
                                <td>jane@example.com</td>
                                <td>48000</td>
                            </tr>
                            <!-- Add more rows as needed -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Add more sections as needed -->
    </div>
</body>

</html>
