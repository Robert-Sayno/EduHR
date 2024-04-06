<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Assignment</title>
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
    <header class="header">
        <h1>Task Assignment</h1>
    </header>
    <nav class="nav-header">
        <div class="nav-links">
            <a href="#">Home</a>
            <a href="#">Employees</a>
            <a href="#">Tasks</a>
            <!-- Add more navigation links as needed -->
        </div>
    </nav>
    <div class="container">
        <main>
            <h2>Assign Task</h2>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <label for="employee">Select Employee:</label>
    <select name="employee" id="employee">
        <?php
        // Assuming $conn is your database connection
        include_once "connection.php";

        // Fetch employees from the database
        $sql = "SELECT user_id, fullname FROM employees";
        $result = $conn->query($sql);

        // Check if any rows are returned
        if ($result->num_rows > 0) {
            // Output data of each row as options in the select element
            while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row["user_id"] . "'>" . $row["fullname"] . "</option>";
            }
        } else {
            echo "<option value=''>No employees available</option>";
        }
        ?>
    </select>
    <br>
    <label for="task">Task Description:</label><br>
    <textarea name="task" id="task" rows="4" cols="50"></textarea>
    <br>
    <input type="submit" value="Assign Task">
</form>

<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include database connection
    include_once "connection.php";

    // Get data from the form
    $employee_id = $_POST['employee']; // Use the employee's user_id directly
    $task_description = $_POST['task'];

    // Insert the task into the database
    $sql_insert_task = "INSERT INTO tasks (user_id, task_description) VALUES (?, ?)";
    $stmt_insert_task = $conn->prepare($sql_insert_task);
    $stmt_insert_task->bind_param("is", $employee_id, $task_description);

    if ($stmt_insert_task->execute()) {
        echo "<p>Task assigned successfully.</p>";
    } else {
        echo "<p>Error: " . $sql_insert_task . "<br>" . $conn->error . "</p>";
    }

    // Close statement and database connection
    $stmt_insert_task->close();
    $conn->close();
}
?>


        </main>
    </div>
    <footer>
        <!-- Footer content -->
    </footer>
</body>
</html>
