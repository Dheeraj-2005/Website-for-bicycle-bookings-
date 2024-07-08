<?php
    session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <title>Sign In</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./signinsignup.css" />
</head>

<body>
    <div class="background"> </div>
    <div class="box">
    <form action="./login.php" method="post">
            <div class="column-container">
                <div class="column">
                    <img id="logo" src="./images/iithlogo.png">
                    <h3>IIT-Hyderabad</h3>
                </div>
                <div class="column">
                    <fieldset class="field">
                        <legend class="legendtitle">Sign In</legend>
                        <div class="container">
                            <label for="uname"><b>Username :</b></label>
                            <input type="text" class="highlight" placeholder="Username or Email" name="uname" required>
                            <label for="psw"><b>Password :</b></label>
                            <input type="password" class="highlight" placeholder="Password" name="psw" required>
                            <div class="checkbox">
                                <label><input type="checkbox"> Remember me</label>
                                <span id="color">
                                    <a href="./forgotpass.php">Forgot password?</a>
                                </span>
                            </div>
                            <?php 
                                if (isset($_GET['error']) && $_GET['error'] === 'user-notexists') {
                                    echo '<p style="color: red; font-size:15px;">Incorrect username or password.  </p>';
                                }
                            ?>
                            <button type="submit"><b>Sign In</b></button>
                        </div>
                    </fieldset>
                    <div class="container">
                        Don't have an account?
                        <span id="color">
                            <a href="./S-sign-up.php">Sign Up</a>
                        </span>
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>

</html>