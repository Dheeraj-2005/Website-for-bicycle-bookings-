<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>CYCLE BOOKING</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./cycle.css" />
    <script src="https://kit.fontawesome.com/3f8f2cb77a.js" crossorigin="anonymous"></script>
</head>

<body>
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
                
                <?php 
                    if(isset($_SESSION['username'])){
                        $email = $_SESSION['email'];
                        echo "<a href='#'>Hi ". $_SESSION['username'] . "</a>";
                    }
                    else{
                        echo "<a href='./S-signin.php'>Sign in</a>";
                    }
                ?>
                
                <?php 
                    if(isset($_SESSION['username'])){
                        echo "<a href='./profile.php'>Profile</a>";
                    }
                    
                ?>
                
                <a href="#About">About</a>
                
                <?php 
                    if(isset($_SESSION['username'])){
                        $str = "<a href='./S-book.php'>Book Now</a>";
                        echo "$str";
                        // echo "<a href='./book.html'>Book Now</a>";
                    }
                    else{
                        echo "<a href='./S-signin.php'>Book Now</a>";
                    }
                ?>
                
                <a href="#">Home</a>
            </div>
        </div>
    </div>
    <div class="image">
        <img id="img" src="./images/img.png" alt="Cycles">
    </div>
    <div class="box" id="About">
        <h2>About Us</h2>
        <p>
            Our website enables IIT Hyderabad students to book cycles for campus travel, minimizing pollution from
            buses. Users can select pickup and destination from four cycle stands, along with pickup time. After
            booking, they receive a confirmation and a unique cycle ID. They ride the cycle with the assigned ID. Upon
            reaching their destination, they must park the cycle at a stand and press the park button on the website.
            There's a specific time limit for parking, exceeding which incurs a fine. The fine is 1 rupee per minute for
            up to 10 minutes late, and 5 rupees per minute thereafter.
        </p>
    </div>
    <div class="button" id="button">
        <!-- <a href="./book.html">Book Now</a> -->
        <?php 
            if(isset($_SESSION['username'])){
                // echo "<a href='./book.html?username='>Book Now</a>";
                    $str = "<a href='./S-book.php'>Book Now</a>";
                echo "$str";
            }
            else{
                echo "<a href='./S-signin.php'>Book Now</a>";
            }
        ?>
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