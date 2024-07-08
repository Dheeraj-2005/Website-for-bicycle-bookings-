<!DOCTYPE html>
<html>

<head>
    <title>Reset Password</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./signinsignup.css" />
</head>

<body>
    <div class="background"> </div>
    <div class="box">
        <form action="./updatepass.php" method="POST">
            <div class="column-container">
                <div class="column">
                    <img id="logo" src="./images/iithlogo.png">
                    <h3>IIT-Hyderabad</h3>
                </div>
                <div class="column">
                    <fieldset class="field">
                        <legend class="legendtitle">Reset Password</legend>
                        <div class="container">
                            <label for="username"><b>User Name :</b></label>
                            <input type="text" id="username"  class="highlight" name="username" value="<?php echo $_GET["username"]; ?>">
                            <label for="code"><b>Verification Code :</b></label>
                            <input type="text" id="code"  class="highlight" placeholder="Verification Code" name="code" required>
                            <label for="new_password"><b>New Password :</b></label>
                            <input type="password" id="new_password"  class="highlight" placeholder="Enter New Password"  name="new_password" required>
                            <?php
                                if (isset($_GET['error'])) {
                                    echo '<p style="color: red; class="error">' . $_GET['error'] . '</p>';
                                }
                                // if (isset($_GET['p'])) {
                                //     echo '<p style="color: blue; class="error">' . $_GET['p'] . '</p>';
                                //     echo '<a href="signin.php">Sign In</a>';
                                // }
                            ?>
                            <button type="submit"><b>Reset Password</b></button>
                        </div>
                    </fieldset>
                </div>
            </div>
        </form>
    </div>
</body>

</html>