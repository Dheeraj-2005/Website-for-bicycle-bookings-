<!DOCTYPE html>
<html>

<head>
    <title>Forgot Password</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./signinsignup.css" />
</head>

<body>
    <div class="background"> </div>
    <div class="box">
        <form id="reset-form" action="./forgotpassaction.php" method="POST">
            <div class="column-container">
                <div class="column">
                    <img id="logo" src="./images/iithlogo.png">
                    <h3>IIT-Hyderabad</h3>
                </div>
                <div class="column">
                    <fieldset class="field">
                        <legend class="legendtitle">Forgot Password</legend>
                        <div class="container">
                            <label for="username"><b>User Name :</b></label>
                            <input type="text" id="username" class="highlight" placeholder="Username" name="username" required>
                            <label for="email"><b>Email :</
                            b></label>
                            <input type="text" id="email" class="highlight" placeholder="Email" name="email" required>
                            <button type="submit"><b>Reset Password</b></button>
                            <?php 
                                if (isset($_GET['error']) && $_GET['error'] === 'user-notexists') {
                                echo '<p style="color: red; font-size:15px;">Incorrect username or password.  </p>';
                                }
                            ?>
                        </div>
                    </fieldset>
                </div>
            </div>
        </form>
    </div>
</body>

</html>