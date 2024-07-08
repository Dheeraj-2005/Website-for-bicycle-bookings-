<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
        use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\Exception;
        require 'PHPMailer/src/Exception.php';
        require 'PHPMailer/src/PHPMailer.php';
        require 'PHPMailer/src/SMTP.php';

        $db = mysqli_connect("localhost", "root", "", "Cycles");
        if ($db === false) {
            die("Error connecting to database: " . mysqli_connect_error());
        }
        echo "connected successfully<br>";

        if (isset($_POST['email'])) {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $sql = "SELECT * FROM users WHERE email = '$email' AND username = '$username' ";
        echo "connected successfully<br>";

            $result = mysqli_query($db, $sql);
            if (mysqli_num_rows($result) === 1) {
                // $token = bin2hex(random_bytes(6));
                $vcode = rand(100000, 999999);
                $p = "UPDATE users SET vcode = '$vcode' WHERE email = '$email'";
                $q = mysqli_query($db, $p);
                
                $mail = new PHPMailer();
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com'; 
                $mail->SMTPAuth = true;
                $mail->Username = 'manoharmaripe1912@gmail.com'; 
                $mail->Password = 'sxrdqkdaqgnffbug'; 
                $mail->SMTPSecure = 'ssl';
                $mail->Port = 465;
                
                $mail->setFrom('manoharmaripe1912@gmail.com', 'Cycle Store');
                $mail->addAddress("$email", 'User');
                $mail->Subject = 'Password Reset';
                // $mail->Body = "$vcode";
                $mail->Body = 'Hi, Your Verfication Code is: ' . $vcode . '.' . "\n\n" . 'Please enter this code to reset your password.' . "\n\n" . 'Thank you.';

                if ($mail->send()) {
                    echo "Email sent successfully!";
                    header("Location: resetpass.php?username=" . urlencode($username) . "&email=" . urlencode($email));
                } 
                else {
                    echo "Failed to send email. Error: <br>" . $mail->ErrorInfo . "<br>";
                    header("Location: forgotpass.html?error=unsuccessful");
                }
            }
        }
    ?>
</body>

</html>