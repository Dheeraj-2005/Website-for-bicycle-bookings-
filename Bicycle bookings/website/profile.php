<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>PROFILE</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./profile.css" />
    <script src="https://kit.fontawesome.com/3f8f2cb77a.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php 
        $conn = mysqli_connect("localhost", "root", "", "Cycles") ;
        if(!$conn){
            die("Connection failed" .mysqli_connect_error());
        }
        // echo "connected successfully<br>";
        // $username = $_GET['username'];
        $username = $_SESSION["username"];
        $sql_fetch = "SELECT * from users where username='$username'";
        $sql_run = "SELECT SUM(fine) as tot_sum from running where Name='$username'";
        $sum = mysqli_query($conn, $sql_run);
        $summ = mysqli_fetch_assoc($sum);
        $summ = $summ['tot_sum'];
        // if($res = mysqli_query($conn ,$sql_fetch)){
        //     echo "query success";
        // }
        $res = mysqli_query($conn ,$sql_fetch);
        $row = mysqli_fetch_assoc($res);
        $username = $row['username'];
        $email = $row['email'];
    ?>
    <div class="nav">
        <div class="topnav">
            <img id="logo" src="./images/iithlogo.png" alt="LOGO IITH">
            <p>IIT-Hyderabad</p>
            <div class="rightside">
                <?php
                    if(isset($_SESSION['username'])){
                        echo "<a href='./sess_destroy.php'>Logout</a>";
                    }
                ?>
                <a href="#"><?php echo "Hi $username"?></a>
                <?php
                echo "<a href='./index.php'>About</a>"
                ?>
                <?php
                echo "<a href='./S-book.php'>Book now</a>"
                ?>
                <!-- <a href="./index.php">Home</a> -->
                <?php
                echo "<a href='./index.php'>Home</a>"
                ?>
            </div>
        </div>
    </div>
    <div class="container">
        <fieldset class="field">
            <p class="legendtitle">PROFILE :</p>
            <div class="profile">
                <img id="img" src="./images/profile.jpg" alt="Profile">
            </div>
            <ul>
                <li>
                    <p>Name :<?php echo " $username"?></p>
                </li>
                <li>
                    <p>Roll No :<?php echo " ".strtoupper(substr($email,0,14))?></p>
                </li>
                <li>
                    <p>Email :<?php echo " $email"?></p>
                </li>
                <li>
                    <p>Fine :<?php echo " $summ"?></p>
                </li>
            </ul>

        </fieldset>
    </div>
    <div class="socialmedia">
        <p>Follow us on Social Media</p>
        <div id="icons">
            <a href="https://www.instagram.com/iithyderabad/"><i class="fab fa-instagram fa-2x"></i></a>
            <a href="https://www.facebook.com/iithyderabad/"><i class="fab fa-facebook fa-2x"></i></a>
            <a href="https://twitter.com/IITHyderabad/"><i class="fab fa-twitter fa-2x"></i></a>
            <a href="https://www.linkedin.com/school/iithyderabad/?originalSubdomain=in"><i class="fab fa-linkedin fa-2x"></i></a>
        </div>
    </div>
</body>
<footer>
    <div class="copyrights">
        <p>&copy; 2023 Copyright: CYCLES IIT-HYDERABAD</p>
    </div>
</footer>

</html>