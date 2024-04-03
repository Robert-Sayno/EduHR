<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Report Card</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        .navbar {
            background-color: #3498db;
            overflow: hidden;
            text-align: center;
        }

        .navbar a {
            display: inline-block;
            color: #f2f2f2;
            text-align: center;
            padding: 14px 20px;
            text-decoration: none;
        }

        .navbar a:hover {
            background-color: #ddd;
            color: black;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            position: relative; /* Add relative positioning for badge placement */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: center;
            margin-bottom: 20px; /* Add some space between table and total comments */
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            white-space: nowrap;
            vertical-align: middle;
        }

        th {
            background-color: #f2f2f2;
        }

        input[type="text"] {
            height: 30px;
            box-sizing: border-box;
            width: calc(100% - 18px); /* Adjust width to account for input padding and border */
        }

        .fixed-size-input {
            max-width: 200px;
            height: 30px;
            resize: none;
        }

        textarea {
            resize: none;
            width: calc(100% - 18px); /* Adjust width to account for textarea padding and border */
            height: 60px; /* Set a smaller fixed height for textarea */
            margin: 0 auto; /* Center the textarea */
            display: block; /* Ensure it's displayed as a block element */
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box; /* Include padding and border in element's total width and height */
        }

        .update-btn {
            padding: 10px 20px;
            background-color: #3498db;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 20px;
            display: block;
            margin: 20px auto;
        }

        .update-btn:hover {
            background-color: #2980b9;
        }

        .badge {
            position: absolute;
            top: 0;
            right: 0;
            z-index: 1;
            width: 100px;
            height: auto;
        }

        .student-photo {
            position: absolute;
            top: 0;
            left: 0;
            z-index: 1;
            width: 100px;
            height: auto;
            border-radius: 50%;
        }
    </style>
</head>

<body>
    <div class="navbar">
        <a href="teacher_dashboard.php">Home</a>
        <a href="view_students.php">Back to students</a>
        <a href="#">logout</a>
    </div>

    <?php
    // Include necessary files and authentication check
    include_once('../auth/connection.php');
    include_once('../auth/auth_functions.php');

    // Check if the student ID is provided in the URL
    if (isset($_GET['id'])) {
        $student_id = mysqli_real_escape_string($conn, $_GET['id']);

        // Fetch student details from the database
        $sql_student_details = "SELECT * FROM student_information WHERE id = '$student_id'";
        $result_student_details = mysqli_query($conn, $sql_student_details);

        // Check if the query was successful
        if ($result_student_details && mysqli_num_rows($result_student_details) > 0) {
            $student_details = mysqli_fetch_assoc($result_student_details);
        } else {
            // Handle the error or redirect to an error page
            die('Error fetching student details: ' . mysqli_error($conn));
        }
    } else {
        // Redirect to the dashboard or another appropriate page if student ID is not provided
        header("Location: dashboard.php");
        exit();
    }
    ?>

    <div class="container">
        <!-- Badge Image -->
        <img src="me.PNG" alt="Badge" class="badge">

        <!-- Student Photo -->
       <!-- <img src="<?php echo $student_details['photo_url']; ?>" alt="Student Photo" class="student-photo"> -->

        <!-- Display student details -->
        <h2 style="text-align: center;">Student Report Card</h2>
        <h3 style="text-align: center;">Student Details</h3>
        <p style="text-align: center;">Name: <?php echo $student_details['students_name']; ?></p>
        <p style="text-align: center;">Student ID: <?php echo $student_details['user_id']; ?></p>
        <p style="text-align: center;">Username Email: <?php echo $student_details['username_email']; ?></p>


        <form id="performance-form">
            <table>
            <tbody>
                    <tr>
                        <td>Science</td>
                        <td><input type="text" id="sci-performance" name="sci-performance"></td>
                        <td><input type="text" id="sci-remarks" name="sci-remarks" class="fixed-size-input"></td>
                    </tr>
                    <tr>
                        <td>English</td>
                        <td><input type="text" id="eng-performance" name="eng-performance"></td>
                        <td><input type="text" id="eng-remarks" name="eng-remarks" class="fixed-size-input"></td>
                    </tr>
                    <tr>
                        <td>Social studies</td>
                        <td><input type="text" id="sst-performance" name="sst-performance"></td>
                        <td><input type="text" id="sst-remarks" name="sst-remarks" class="fixed-size-input"></td>
                    </tr>
                    <tr>
                        <td>Mathematics</td>
                        <td><input type="text" id="math-performance" name="math-performance"></td>
                        <td><input type="text" id="math-remarks" name="math-remarks" class="fixed-size-input"></td>
                    </tr>
                    <tr>
                        <td>Literacy 1</td>
                        <td><input type="text" id="lit1-performance" name="lit1-performance"></td>
                        <td><input type="text" id="lit1-remarks" name="lit1-remarks" class="fixed-size-input"></td>
                    </tr>
                    <tr>
                        <td>Literacy 2</td>
                        <td><input type="text" id="lit2-performance" name="lit2-performance"></td>
                        <td><input type="text" id="lit2-remarks" name="lit2-remarks" class="fixed-size-input"></td>
                    </tr>
                    
                    <!-- Add more subjects as needed -->
                </tbody>
            </table>

            <!-- Total Comments -->
            <h3 style="text-align: center;">Total Comments on Performance</h3>
            <textarea id="total-comments" name="total-comments" rows="4" cols="50" style="resize: none; background-color: #f2f2f2; width: calc(40% - 18px); height: 50px; margin: 0 auto; display: block;"></textarea>

            
            <!-- Update button -->
            <button type="button" class="update-btn" onclick="updatePerformance()">Update Performance</button>
        </form>
    </div>

    <script>
        function updatePerformance() {
            var form = document.getElementById('performance-form');
            var formData = new FormData(form);

            // Total Comments
            var totalComments = "";
            formData.forEach(function(value, key) {
                if (key.endsWith("-remarks")) {
                    totalComments += key.split("-")[0] + ": " + value + "\n";
                }
            });
            document.getElementById('total-comments').value = totalComments;

            // Here you can add code to submit the form data and update the performance in the database
            alert('Form data submitted!');
        }
    </script>
</body>

</html>


