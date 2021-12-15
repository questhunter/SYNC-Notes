<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">   
    <link rel="stylesheet" href="style styled.css">
</head>

<body scroll="no" >
    
    <div class="login-dark">
        <form action="register.php" method="post" name="form1">
            <h3 style="text-align:center">Sign Up </h3>
            <?php
        //including the database connection file
        include_once("db-config.php");

        // Check If form submitted, insert user data into database.
        if (isset($_POST['register'])) {
            $name     = $_POST['name'];
            $email    = $_POST['email'];
            $password = $_POST['password'];

            // If email already exists, throw error
            $email_result = mysqli_query($mysqli, "select 'email' from users where email='$email' and password='$password'");

            // Count the number of row matched 
            $user_matched = mysqli_num_rows($email_result);

            // If number of user rows returned more than 0, it means email already exists
            if ($user_matched > 0) {
                echo "<br/><br/><strong>Error: </strong> User already exists with the email id '$email'.";
            } else {
                // Insert user data into database
                $result   = mysqli_query($mysqli, "INSERT INTO users(name,email,password,notes) VALUES('$name','$email','$password','')");

                // check if user data inserted successfully.
                if ($result) {
                    echo "<br/><br/>Registration Successful.";
                } else {
                    echo "Registration error. Please try again." . mysqli_error($mysqli);
                }
            }
        }

        ?>
            <div class="illustration"><i class="icon ion-ios-locked-outline"></i></div>
            <div class="form-group"><input class="form-control" type="text" name="name" placeholder="Name" required></div>
            <div class="form-group"><input class="form-control" type="email" name="email" placeholder="Email" required></div>
            <div class="form-group"><input class="form-control" type="password" name="password" placeholder="Password" required></div>
            <div class="form-group"><button class="btn btn-primary btn-block" type="submit" name="register">Register</button></div><a href="login.php" class="forgot">Already have an account?<br>Signin</a></form>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>

        
    </form>
</body>

</html>