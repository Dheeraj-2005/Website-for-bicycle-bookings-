<!DOCTYPE html>
<html>

<head>
    <title>Sign Up</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./signinsignup.css" />
</head>

<body>
    <div class="background"></div>
    <div class="box">
    <form action="./signup.php" method="post">
            <div class="column-container">
                <div class="column">
                    <img id="logo" src="./images/iithlogo.png">
                    <h3>IIT-Hyderabad</h3>
                </div>
                <div class="column">
                    <fieldset class="field">
                        <legend class="legendtitle">Sign Up</legend>
                        <div class="container">
                            <label for="user-name"><b>User Name :</b></label>
                            <input type="text" class="highlight" placeholder="User Name" name="uname" required>
                            <?php
                                if (isset($_GET['error']) && $_GET['error'] === 'invalid-username') {
                                  echo '<p style="color: red; font-size:15px;">Invalid username. must contain only alphabets</p>';
                                }
                            ?>
                            <label for="email"><b>Email :</b></label>
                            <input type="text" class="highlight" placeholder="Email" name="email" required>
                            <?php
                                if (isset($_GET['error']) && $_GET['error'] === 'invalid-email') {
                                  echo '<p style="color: red; font-size:15px;">Invalid email.  </p>';
                                }
                            ?>
                            <label for="psw"><b>Password :</b></label>
                            <input type="password" class="highlight" placeholder="Password" name="psw" required>
                            <?php
                                if (isset($_GET['error']) && $_GET['error'] === 'invalid-password') {
                                    echo '<p style="color: red; font-size:15px;">Invalid password. must be between 8-30 and contain numbers and alphabets</p>';
                                }
                                if(isset($_GET['error']) && $_GET['error'] === 'user-exists'){
                                    echo '<p style="color: red; font-size:15px;">user already exists</p>';
                                }
                            ?>
                            <label for="psw"><b>Re-enter Password :</b></label>
                            <input type="password" class="highlight" placeholder="Enter password again" name="psw1"
                            required>
                            <button type="submit"><b>Sign Up</b></button>
                        </div>
                    </fieldset>
                    <div class="container">
                        Already have an account?
                        <span id="color">
                            <a href="./S-signin.php">Sign In</a>
                        </span>
                    </div>
                </div>
            </div>
    </form>
    </div>
</body>

</html>