<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
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
    <h2>Edit student</h2>

    <form action="update_user.php" method="post">
        <input type="hidden" name="user_id" value="<?php echo $user_details['id']; ?>">

        <!-- Display user details in input fields for editing -->
        <label for="name">Name:</label>
        <input type="text" name="name" value="<?php echo $user_details['name']; ?>" required><br>

        <label for="username">Username:</label>
        <input type="text" name="username" value="<?php echo $user_details['username']; ?>" required><br>

        <label for="status">Status:</label>
        <select name="status">
            <option value="1" <?php echo ($user_details['active'] == 1) ? 'selected' : ''; ?>>Active</option>
            <option value="0" <?php echo ($user_details['active'] == 0) ? 'selected' : ''; ?>>Inactive</option>
        </select><br>

        <input type="submit" value="Update">
    </form>
</body>

</html>
