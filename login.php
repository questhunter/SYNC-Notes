<?php



// Start PHP session at the beginning 
session_start();

// Create database connection using config file
include_once("db-config.php");


?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="css/style styled.css">
</head>

<body>
    <div class="login-dark">
        <form action="login.php" method="post" name="form1">
            <h2 class="sr-only">Login Form</h2>
            <div class="illustration"><i class="icon ion-ios-locked-outline"></i></div>
            <?php
                // If form submitted, collect email and password from form
                if (isset($_POST['login'])) {
                    $email    = $_POST['email'];
                    $password = $_POST['password'];

                    // Check if a user exists with given username & password
                    $result = mysqli_query($mysqli, "select 'email', 'password' from users
                        where email='$email' and password='$password'");

                    // Count the number of user/rows returned by query 
                    $user_matched = mysqli_num_rows($result);

                    // Check If user matched/exist, store user email in session and redirect to page-1
                    if ($user_matched > 0) {

                        $_SESSION["email"] = $email;
                        header("location: page-1.php");
                    } else {
                        echo "Email or Password is invalid! <br/><br/>";
                    }
                }
            ?>
            <div class="form-group"><input class="form-control" type="email" name="email" placeholder="Email" required></div>
            <div class="form-group"><input class="form-control" type="password" name="password" placeholder="Password" required></div>
            <div class="form-group"><button class="btn btn-primary btn-block" type="submit" name="login">Log In</button></div><a href="register.php" class="forgot">Don't have an account?<br>Register</a></form>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
</body>

</html>