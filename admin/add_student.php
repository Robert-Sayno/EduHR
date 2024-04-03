<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Students Details</title>
    <style>
        /* Reset default margin and padding */
        body, h1, h2, h3, p, ul, li {
            margin: 0;
            padding: 0;
        }
        /* Body background color */
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f5f8;
        }
        /* Header styles */
        header {
            background-color: #3a7ca5;
            color: #fff;
            padding: 20px 0;
            text-align: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        /* Header title styles */
        header h1 {
            font-size: 32px;
            margin-bottom: 10px;
        }
        /* Navigation menu styles */
        nav {
            text-align: center;
            margin-top: 20px;
        }
        nav a {
            color: #fff;
            text-decoration: none;
            padding: 10px 20px;
            margin: 0 10px;
            border-radius: 4px;
            background-color: #4e98c4;
            transition: background-color 0.3s;
        }
        nav a:hover {
            background-color: #26719b;
        }
        /* Form container styles */
        form {
            width: 400px;
            margin: auto;
            padding: 20px;
            border-radius: 8px;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        /* Form title styles */
        form h2 {
            font-size: 24px;
            margin-bottom: 20px;
            text-align: center;
        }
        /* Form label styles */
        label {
            display: block;
            margin-bottom: 8px;
        }
        /* Form input styles */
        input[type="text"], input[type="date"], select, input[type="file"], input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        /* Form submit button styles */
        input[type="submit"] {
            background-color: #4e98c4;
            color: #fff;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        input[type="submit"]:hover {
            background-color: #26719b;
        }
    </style>
</head>
<body>

<header>
    <h1>ScholarView</h1>
    <nav>
        <a href="add_student.php">Add Student</a>
        <a href="view_students.php">View Students</a>
        <a href="display_tours.php">Manage Tours</a>
    </nav>
</header>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
    <h2>Add Student Details</h2>
    <label for="students_name">Student's Name:</label>
    <input type="text" id="students_name" name="students_name" required>

    <label for="class">Class:</label>
    <input type="text" id="class" name="class" required>

    <label for="DOB">Date of Birth:</label>
    <input type="date" id="DOB" name="DOB" required>

    <label for="parents_name">Parent's Name:</label>
    <input type="text" id="parents_name" name="parents_name" required>

    <label for="relationship">Relationship to Student:</label>
    <input type="text" id="relationship" name="relationship" required>

    <label for="parents_contact">Parent's Contact:</label>
    <input type="text" id="parents_contact" name="parents_contact" required>

    <label for="gender">Gender:</label>
    <select id="gender" name="gender" required>
        <option value="male">Male</option>
        <option value="female">Female</option>
        <option value="other">Other</option>
    </select>

    <label for="students_image">Student's Image:</label>
    <input type="file" id="students_image" name="students_image" required>

    <input type="submit" name="submit" value="Add Student">
</form>

</body>
</html>
