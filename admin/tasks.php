<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assign Task</title>
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

        .nav-header {
            background-color: #2c3e50;
            color: #fff;
            padding: 10px;
            border-radius: 5px 5px 0 0;
            margin-bottom: 20px;
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
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
        }

        label {
            font-weight: bold;
        }

        select, textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        input[type="submit"] {
            background-color: #3498db;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Assign Task</h1>
    </div>
    <nav class="nav-header">
        <div class="nav-links">
            <a href="#">Home</a>
            <a href="#">Employees</a>
            <a href="#">Tasks</a>
        </div>
    </nav>
    <?php
    // Enable error reporting
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    // Include the database connection file
    require_once "connection.php";

    // Define variables to store form data
    $employee_name = $task_description = "";

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get form data
        $employee_name = $_POST["employee"]; // Assuming the employee name is sent from the form
        $task_description = $_POST["task"]; // Assuming the task description is sent from the form

        // Prepare and execute SQL query
        $stmt = $conn->prepare("INSERT INTO tasks (description, fullname) VALUES (?, ?)");
        $stmt->bind_param("ss", $task_description, $employee_name);
        if ($stmt->execute()) {
            // Display JavaScript alert
            echo '<script>alert("Task assigned successfully!");</script>';
            // Delay the redirection by 1 second to ensure the alert is shown
            echo '<script>setTimeout(function(){ window.location.href = "dashboard.php?success=true"; }, 1000);</script>';
            // Exit the script
            exit();
        } else {
            // Redirect to error page
            header("Location: tasks.php?success=false");
            exit();
        }
        

        // Close the statement and database connection
        $stmt->close();
        $conn->close();
    }
    ?>
    
    <div class="container">
        <h2>Assign Task</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="employee">Select Employee:</label>
            <select name="employee" id="employee">
                <?php
                // Fetch employees from the database
                $sql = "SELECT fullname FROM employees";
                $result = $conn->query($sql);

                // Check if any rows are returned
                if ($result->num_rows > 0) {
                    // Output data of each row as options in the select element
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row["fullname"] . "'>" . $row["fullname"] . "</option>";
                    }
                } else {
                    echo "<option value=''>No employees available</option>";
                }
                ?>
            </select>
            <br>
            <label for="task">Task Description:</label><br>
            <textarea name="task" id="task" rows="4" cols="50"><?php echo $task_description; ?></textarea>
            <br>
            <input type="submit" value="Assign Task">
        </form>
    </div>
</body>
</html>
