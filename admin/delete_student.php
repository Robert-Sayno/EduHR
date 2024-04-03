<?php
include_once('../auth/connection.php');

try {
    // Check if message ID is set and valid
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $message_id = $_GET['id'];

        // Debugging: Display the received message ID
        echo 'Received Message ID: ' . $message_id;

        // Delete the message from the database
        $sql_delete_message = "DELETE FROM contact_messages WHERE id = $message_id";
        $result_delete_message = mysqli_query($conn, $sql_delete_message);

        // Check if the query was successful
        if ($result_delete_message) {
            // Display a circular progress bar with a message
            echo '<html lang="en">
                    <head>
                        <meta charset="UTF-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        <title>Deleting Message</title>
                        <style>
                            body {
                                display: flex;
                                justify-content: center;
                                align-items: center;
                                height: 100vh;
                                margin: 0;
                                background-color: #f1f1f1;
                                font-family: Arial, sans-serif;
                            }

                            .progress-container {
                                width: 150px;
                                height: 150px;
                                position: relative;
                            }

                            .progress-circle {
                                width: 100%;
                                height: 100%;
                                border-radius: 50%;
                                background-color: #f1f1f1;
                                position: absolute;
                                clip: rect(0, 150px, 150px, 75px);
                            }

                            .progress-fill {
                                width: 100%;
                                height: 100%;
                                border-radius: 50%;
                                background-color: #4CAF50;
                                position: absolute;
                                clip: rect(0, 75px, 150px, 0);
                                transform: rotate(0deg);
                                transform-origin: 50% 50%;
                            }

                            .message {
                                text-align: center;
                                margin-top: 20px;
                                font-size: 16px;
                            }
                        </style>
                    </head>
                    <body>
                        <div class="progress-container">
                            <div class="progress-circle">
                                <div class="progress-fill"></div>
                            </div>
                            <div class="message">Deleting Message...</div>
                        </div>
                        <script>
                            let progress = 0;
                            const progressFill = document.querySelector(".progress-fill");
                            const message = document.querySelector(".message");
                            const interval = setInterval(() => {
                                progress += 1;
                                progressFill.style.transform = `rotate(${progress * 3.6}deg)`;
                                if (progress >= 100) {
                                    clearInterval(interval);
                                    window.location.href = "dashboard.php?success=Message deleted successfully";
                                }
                            }, 20);
                        </script>
                    </body>
                </html>';
            exit();
        } else {
            // Handle the error
            throw new Exception('Error deleting message: ' . mysqli_error($conn));
        }
    } else {
        // Invalid message ID
        throw new Exception('Invalid message ID');
    }
} catch (Exception $e) {
    // Log the exception or display an error message
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

// Close the database connection
mysqli_close($conn);
?>
