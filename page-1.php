<?php
session_start();

// This page can be accessed only after login
// Redirect user to login page, if user email is not available in session
if (!isset($_SESSION["email"])) {
    header("location: login.php");
}
else {
    $email = $_SESSION["email"];
}
include_once("db-config.php");
if (isset($_POST['page-1'])) {
    $notes     = $_POST['notes'];
    $result   = mysqli_query($mysqli, "UPDATE users SET notes='$notes' WHERE email='$email' ");
}
sleep(1 );
$notesResult = mysqli_query($mysqli,"SELECT * FROM users WHERE email='$email'");
while($row = $notesResult->fetch_assoc()) {
    $notesValue = $row["notes"];
}


?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width">
        <link rel="stylesheet" type="text/css" href="css/style.css" />

        <title>SYNC Notes</title>
    <style>
        input[type=submit] {
            width: 10%;
            background-color:   #242525;
            color: white;
            padding: 12px 20px;
            margin: 10px 50px 50px 50px;
            border: none;
            font-size: 18px;
            
            cursor: pointer;
        }

        input[type=submit]:hover {
            background-color:  #FFFFFF;
            color:black;
        }
    </style>
        
    </head>
    <body style="background-image: url('images/bg2.jpg');">
        
        <div class="header">
            <!-- <h3>Sync Notes</h3> -->
             <!-- The overlay -->
                <div id="myNav" class="overlay">

                    <!-- Button to close the overlay navigation -->
                    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>

                        <!-- Overlay content -->
                        <div class="overlay-content">
                            <!-- <a href="#">About</a>
                            <a href="#">Services</a>-->                           
                            <a href="#"><?php echo $_SESSION['email']; ?></a>
                            <a style="text-align:center;" href="logout.php">Logout</a>
                        </div>

                </div>

                <!-- Use any element to open/show the overlay navigation menu -->
                <p style="display: flex;justify-content: space-between;font-size:30px;">&nbsp &nbsp SYNC Notes
                        <span style="position:relative;font-size:30px;cursor:pointer" onclick="openNav()">&#9776; &nbsp&nbsp</span>
                    
                </p>
                            
        </div>

        <!-- <div style="text-align:right"> 
            <div class="button1">
                <a href="logout.php">Logout</a>         
            </div>
        </div> -->
        <form action="page-1.php" method="post" name="notesForm">
            <div id="container">
                <textarea id="area" name="notes" rows="10"  cols="50"><?php echo isset($_POST['notes']) ? htmlspecialchars($_POST['notes']) : ''; ?></textarea>
            </div>
            <div style="text-align:center">
                <div class="button2">
                    <input type="submit" name="page-1" value="SAVE">
                </div>
            </div>
        </form>
        <div class="footer">
            <p>Copyright (c) SYNC Notes</p>
        </div>

    </body>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
    // Check if the page has loaded completely 

    $(document).ready( function() { 
        var val = "<?php echo $notesValue ?>";  
        console.log(val);                                      
        $('#area').val(val);
    }); 
</script> 
<script>
function openNav() {
  document.getElementById("myNav").style.height = "100%";
}

function closeNav() {
  document.getElementById("myNav").style.height = "0%";
}
</script>
</html>