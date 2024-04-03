<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>

body {
            background-image: url('../tugume.jpeg');
            background-size: cover;
            background-position: center;
            color: #fff;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 20%;
            background-color: #2c3e50;
            padding: 20px;
            box-shadow: 2px 0px 5px rgba(0, 0, 0, 0.2);
        }

        .dashboard-container {
            width: 80%;
            max-width: 1200px;
            padding: 20px;
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        h2 {
            color: #3498db;
            margin: 0;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .user-info span {
            font-size: 18px;
        }

        nav ul {
            list-style: none;
            padding: 0;
            margin-top: 20px;
        }

        nav li {
            margin-bottom: 20px;
            font-size: 20px;
        }

        nav a {
            color: #fff;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        nav a:hover {
            color: #3498db;
        }

        .content-section {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .main-content {
            width: 70%;
            background-color: rgba(0, 0, 0, 0.8);
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            padding: 20px;
        }

        p {
            font-size: 30px;
        }

        .logout-btn {
            display: block;
            color: #fff;
            background-color: #e74c3c;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .logout-btn:hover {
            background-color: #c0392b;
        }
      
        .statistic-container {
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            padding: 10px;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <div class="sidebar">
        <nav>
            <ul>
                <li><a href="view_students.php">View all students</a></li>
                <li><a href="view_students.php">Add more students</a></li>
                <li><a href="display_tours.php">Manage Tours</a></li>
            </ul>
        </nav>
    </div>

    <div class="dashboard-container">
        <div class="header-content">
            <?php
            session_start(); // Start session

            // Include your database connection file
            include 'connection.php'; // Assuming you have this file

            // Check if the teacher is logged in
            if (isset($_SESSION['user_id'])) {
                // Get the teacher ID from the session
                $teacher_id = $_SESSION['user_id'];

                // Fetch teacher information from the database based on the teacher ID
                $sql = "SELECT teacher_name FROM teacher_information WHERE user_id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $teacher_id);
                $stmt->execute();
                $result = $stmt->get_result();
                $teacher = $result->fetch_assoc();

                // Check if teacher information was fetched successfully
                if ($teacher) {
                    $teacher_name = $teacher['teacher_name'];
                }
            }
            ?>
            <h2>Welcome, <?php echo isset($teacher_name) ? $teacher_name : 'Admin'; ?></h2>
            <div class="user-info">
                <span>Logged in as: <?php echo isset($teacher_name) ? $teacher_name : 'Admin'; ?></span>
                <a class="logout-btn" href="logout.php">Logout</a>
            </div>
        </div>

        <div class="content-section">
            <div class="main-content">
                <p>Manage and monitor your platform with ease. Use the sidebar to navigate through different sections and take
                    control of user data, messages, and tour information.</p>

                <div class="data-section">
                    <h3>Statistics</h3>

                    <?php
                    // Database connection parameters
                    $server = 'localhost';
                    $username = 'root';
                    $password = '';
                    $database = 'ScholarView';

                    // Create a new mysqli connection using the provided parameters
                    $conn = new mysqli($server, $username, $password, $database);

                    // Check if the connection was successful
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    // Fetch and display total number of students for each class
                    $classes = ['P7', 'P6', 'P2']; // Add more classes as needed
                    foreach ($classes as $class) {
                        $sql = "SELECT COUNT(*) AS total_students FROM student_information WHERE class = ?";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("s", $class);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $row = $result->fetch_assoc();
                        $total_students = $row['total_students'];

                        echo "<div class='statistic-container'>";
                        echo "<p>Total Number of Students in Class $class: $total_students</p>";
                        echo "</div>";
                    }

                    // Close the database connection
                    $conn->close();
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
