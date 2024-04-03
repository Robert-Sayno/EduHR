<?php
// Database connection parameters
$server = 'localhost';
$username = 'root';
$password = '';
$database = 'EduHR';

// Create a new mysqli connection using the provided parameters
$conn = new mysqli($server, $username, $password, $database);

// Check if the connection was successful
if ($conn->connect_error) {
    // If the connection fails, terminate the script and display the MySQL error.
    die("Connection failed: " . $conn->connect_error);
}

// If you want to display a success message, you can uncomment the line below
// echo 'Server Connected Successfully';

// Note: This connection file should be included at the beginning of your other PHP scripts where you need database access.
?>
