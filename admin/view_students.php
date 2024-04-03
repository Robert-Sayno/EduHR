<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            background-image: url('lost_property_bg.jpg');
            background-size: cover;
            background-position: center;
            color: #7734eb;
            font-family: Arial, sans-serif;
            margin: 0;
        }

        .dashboard-container {
            width: 80%;
            margin: 0 auto;
            text-align: center;
            padding: 20px;
        }

        .dashboard-header {
            background-color: #2c3e50;
            color: #fff;
            padding: 10px;
            margin-bottom: 20px;
        }

        .dashboard-section {
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            overflow: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
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

        a {
            color: #3498db;
            text-decoration: none;
            margin-right: 10px;
        }

        a:hover {
            text-decoration: underline;
        }

        .property-image {
            max-width: 100%;
            max-height: 100px;
        }

        .logout-btn {
            color: #fff;
            background-color: #e74c3c;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }

        .logout-btn:hover {
            background-color: #c0392b;
        }

        .search-filter-container {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .search-input {
            padding: 5px;
        }

        .nav-container {
            background-color: #3498db;
            padding: 10px;
            text-align: center;
            margin-bottom: 20px;
        }

        .nav-link {
            color: #fff;
            text-decoration: none;
            padding: 10px;
            margin: 0 10px;
        }

        .nav-link:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <?php
    // Include necessary files and authentication check
    include_once('../auth/connection.php');
    include_once('../auth/auth_functions.php');

    // Fetch users from the database
    $sql_users = "SELECT * FROM student_information";
    $result_users = mysqli_query($conn, $sql_users);

    // Check if the query was successful
    if ($result_users) {
        $users = mysqli_fetch_all($result_users, MYSQLI_ASSOC);
    } else {
        // Handle the error, you can customize this part based on your needs
        die('Error fetching users: ' . mysqli_error($conn));
    }

    // Close the database connection
    mysqli_close($conn);
    ?>

    <div class="dashboard-container">
        <div class="dashboard-header">
            <h2>Welcome to the Admin Dashboard</h2>
        </div>

        <!-- Navigation Links -->
        <div class="nav-container">
            <a class="nav-link" href="teacher_dashboard.php">Home Dashboard</a>
            <a class="nav-link" href="add_student.php">add more students</a>
            <a class="nav-link" href="view_students.php">Manage Students</a>
            <a class="nav-link" href="logout.php">Log out</a>
            <!-- Add more links as needed -->
        </div>

        <!-- Search and filter options -->
        <div class="search-filter-container">
            <input type="text" class="search-input" id="search" placeholder="Search by name">
            <select id="filter" class="search-input">
                <option value="">Filter by class</option>
                <option value="P7">P7</option>
                <option value="P6">P6</option>
                <option value="P2">P5</option>
                <option value="P7">P4</option>
                <option value="P6">p3</option>
                <option value="P2">P2</option>
                <option value="P2">P1</option>

                <!-- Add more classes as needed -->
            </select>
        </div>

        <!-- Display users in a table -->
        <div class="dashboard-section">
            <h3>All students</h3>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>User ID</th>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Class</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user) : ?>
                        <tr>
                            <td><?php echo $user['id']; ?></td>
                            <td><?php echo $user['user_id']; ?></td>
                            <td><?php echo $user['students_name']; ?></td>
                            <td><?php echo $user['username_email']; ?></td>
                            <td><?php echo $user['class']; ?></td>
                            <td><?php echo (isset($user['active']) ? ($user['active'] ? 'Active' : 'Inactive') : 'N/A'); ?></td>
                            <td>
                                <a href="edit_user.php?id=<?php echo $user['id']; ?>">Edit</a>
                                <a href="delete_user.php?id=<?php echo $user['id']; ?>">Delete</a>
                                <a href="manage_student.php?id=<?php echo $user['id']; ?>">manage</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        // JavaScript for search and filter
        document.getElementById('search').addEventListener('input', function () {
            filterTable();
        });

        document.getElementById('filter').addEventListener('change', function () {
            filterTable();
        });

        function filterTable() {
            var searchInput = document.getElementById('search').value.toLowerCase();
            var filterClass = document.getElementById('filter').value.toLowerCase();

            var table = document.querySelector('table');
            var rows = table.getElementsByTagName('tr');

            for (var i = 1; i < rows.length; i++) {
                var row = rows[i];
                var nameColumn = row.getElementsByTagName('td')[2].textContent.toLowerCase();
                var classColumn = row.getElementsByTagName('td')[4].textContent.toLowerCase();

                var hideRow = (searchInput && !nameColumn.includes(searchInput)) || (filterClass && filterClass !== classColumn);
                row.style.display = hideRow ? 'none' : '';
            }
        }
    </script>
</body>

</html>
