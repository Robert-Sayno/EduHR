<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link href="../resorce/css/style.css" rel="stylesheet">

    <title>Admin Login</title>
    <style>
        body, html {
            height: 100%;
            margin: 0;
        }

        .bg {
            background-image: url("../background.jpg");
            height: 100%; 
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }

        .login-form-bg {
            background-color: rgba(255, 255, 255, 0.8);
        }

        .login-form {
            border-radius: 15px;
        }

        .login-form .card-body {
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .login-form h4 {
            color: #333;
            font-weight: 600;
        }

        .login-form input[type="email"],
        .login-form input[type="password"] {
            border-radius: 10px;
            border: 1px solid #ced4da;
            padding: 12px;
        }

        .login-form input[type="email"]:focus,
        .login-form input[type="password"]:focus {
            outline: none;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }

        .login-form .btn-primary {
            border-radius: 10px;
            padding: 12px;
            font-weight: 600;
        }

        .login-form__footer {
            margin-top: 15px;
            font-size: 14px;
        }

        .login-form__footer a {
            color: #007bff;
            font-weight: 600;
        }

        .login-form__footer a:hover {
            text-decoration: none;
            color: #0056b3;
        }
    </style>
</head>
<body>

<div class="bg">
    <div class="login-form-bg h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100">
                <div class="col-xl-6">
                    <div class="form-input-content">
                        <div class="card login-form mb-0">
                            <div class="card-body pt-5 shadow">
                                <h4 class="text-center">Admin Login</h4>
                                <hr>
                                <?php echo $login_err; ?>
                                <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                                    <div class="form-group">
                                        <label for="email">Email:</label>
                                        <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>" placeholder="Enter your email">
                                        <span class="text-danger"><?php echo $email_err; ?></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password:</label>
                                        <input type="password" class="form-control" id="password" name="password" value="<?php echo $password; ?>" placeholder="Enter your password">
                                        <span class="text-danger"><?php echo $password_err; ?></span>
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" value="Login" class="btn btn-primary btn-lg w-100" name="login">
                                    </div>
                                </form>
                                <p class="login-form__footer">Not an admin? <a href="../employee/login.php" class="text-primary">Login</a> as an employee now</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
<script src="./resorce/plugins/common/common.min.js"></script>
<script src="./resorce/js/custom.min.js"></script>
<script src="./resorce/js/settings.js"></script>
<script src="./resorce/js/gleek.js"></script>
<script src="./resorce/js/styleSwitcher.js"></script>
</body>
</html>
