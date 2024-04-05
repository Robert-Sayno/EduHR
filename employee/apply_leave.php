<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leave Request Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }

        .navbar {
            background-color: #3498db;
            color: #fff;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar a {
            color: #fff;
            text-decoration: none;
            padding: 10px;
            margin: 0 10px;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .form-group input[type="date"],
        .form-group textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        .form-group textarea {
            resize: none;
        }

        .form-group input[type="submit"] {
            background-color: #3498db;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        .form-group input[type="submit"]:hover {
            background-color: #2980b9;
        }
    </style>
</head>

<body>
<div class="navbar">
        <div>
            <h2>Employee Dashboard</h2>
        </div>
        <div>
            <a href="#">Home</a>
            <a href="#">Profile</a>
            <a href="#">Leave Requests</a>
            <a href="#">Tasks</a>
            <!-- Add more links as needed -->
        </div>
    </div>


    <div class="container">
        <h2>Leave Request Form</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label for="start_date">Start Date:</label>
                <input type="date" id="start_date" name="start_date" required>
            </div>
            <div class="form-group">
                <label for="end_date">End Date:</label>
                <input type="date" id="end_date" name="end_date" required>
            </div>
            <div class="form-group">
                <label for="reason">Reason:</label>
                <textarea id="reason" name="reason" rows="4" required></textarea>
            </div>
            <div class="form-group">
                <input type="submit" name="submit" value="Submit Request">
            </div>
        </form>
    </div>
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

    // Form submission handling
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $start_date = $_POST["start_date"];
        $end_date = $_POST["end_date"];
        $reason = $_POST["reason"];

        // Set the status to "pending"
        $status = "pending";

        // Insert leave request into leave_requests table with status
        $sql_insert = "INSERT INTO leave_requests (user_id, start_date, end_date, reason, status) VALUES ('$user_id', '$start_date', '$end_date', '$reason', '$status')";

        if ($conn->query($sql_insert) === TRUE) {
            echo "<script>alert('Leave request submitted successfully');</script>";
        } else {
            echo "Error: " . $sql_insert . "<br>" . $conn->error;
        }
    }
} else {
    echo "Error: User not found";
}

$conn->close();
?>

</body>

</html>
