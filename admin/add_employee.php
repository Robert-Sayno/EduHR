<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include the database connection file
require_once "connection.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Get form data
        $fullname = $_POST["fullname"];
        $gender = $_POST["gender"];
        $position = $_POST["position"];
        $dob = $_POST["dob"];
        $salary = $_POST["salary"];
        
        // Generate a unique user ID
        function generateUserID()
        {
            // You can implement your own logic to generate a unique user ID
            // For simplicity, a random 6-character string is generated here
            return substr(md5(uniqid()), 0, 6);
        }

        // Generate a company username email based on the full name
        function generateEmail($fullname)
        {
            // Replace spaces with underscores and convert to lowercase
            $username = strtolower(str_replace(' ', '', $fullname));

            // Dummy email domain for example purposes
            $domain = 'eduhr.com';

            return $username . '@' . $domain;
        }

        // Generate user ID and email
        $user_id = generateUserID();
        $email = generateEmail($fullname);

        // Handle image upload
        $targetDirectory = "uploads/";
        $targetFile = $targetDirectory . basename($_FILES["photo"]["name"]);

        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $targetFile)) {
            // Image uploaded successfully, insert employee details into the database
            $photo = $targetFile;

            // Prepare and execute SQL query
            $stmt = $conn->prepare("INSERT INTO employees (user_id, fullname, gender, position, dob, salary, email, photo) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssssss", $user_id, $fullname, $gender, $position, $dob, $salary, $email, $photo);
            if ($stmt->execute()) {
                // Redirect to success page or display success message
                echo '<script>alert("Employee added successfully!"); window.location.href = "teacher_dashboard.php";</script>';

                exit();
            } else {
                throw new Exception("Error adding employee: " . $conn->error);
            }
        } else {
            throw new Exception("Error uploading photo.");
        }
    } catch (Exception $e) {
        // Handle any exceptions
        echo "Error: " . $e->getMessage();
    } finally {
        // Close the statement and database connection
        $stmt->close();
        $conn->close();
    }
} 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Employee</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h2 {
            color: #333;
        }

        form {
            max-width: 400px;
            margin: 20px auto;
            background-color: #f4f4f4;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input,
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: white;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h2>Add Employee</h2>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">
        <label for="fullname">Full Name:</label>
        <input type="text" id="fullname" name="fullname" required>
        
        <label for="gender">Gender:</label>
        <select id="gender" name="gender" required>
            <option value="">Select Gender</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
        </select>
        
        <label for="position">Position:</label>
        <input type="text" id="position" name="position" required>
        
        <label for="dob">Date of Birth:</label>
        <input type="date" id="dob" name="dob" required>
        
        <label for="salary">Salary:</label>
        <input type="text" id="salary" name="salary" required>
        
        <label for="photo">Photo:</label>
        <input type="file" id="photo" name="photo" required>

        <input type="submit" value="Submit">
    </form>
</body>
</html>
