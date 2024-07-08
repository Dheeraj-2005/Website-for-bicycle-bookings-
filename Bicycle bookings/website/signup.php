<!-- starting the session -->
<?php
    session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>sign up</title>
</head>
<body>

    <!-- connecting to database -->
    <?php
        $conn = mysqli_connect("localhost", "root", "", "Cycles") ;
        if(!$conn){
            die("Connection failed" .mysqli_connect_error());
        }

        // requesting username, password, email from form.
        if($_SERVER["REQUEST_METHOD"]=="POST"){
            $username = $_REQUEST["uname"];
            $password = $_REQUEST["psw"];
            $email = $_REQUEST["email"];
            $flag = 1;

            // creating session variables
            $_SESSION["username"] = $username;
            $_SESSION["email"]=$email;

            // validation
            if(!preg_match("/^([a-z]{2})(\d{2})((btech)|(mtech))(\d{5})@iith\.ac\.in$/",$email)){
                echo "invalid email format\n";
                $flag = 0;
                header("Location: S-sign-up.php?error=invalid-email");
            }
            if(!preg_match("/(?=.*[0-9])(?=.*[a-zA-Z]).{8,30}/",$password)){
                echo "invalid password\n";
                $flag = 0;
                header("Location: S-sign-up.php?error=invalid-password");
            }
            if(!preg_match("/(?=.*[a-zA-Z]).{2,20}/",$username)){
                echo "name must contain only alphabets \n";
                $flag = 0;
                header("Location: S-sign-up.php?error=invalid-username");
            }

            // if validation passed
            if($flag==1){
                // if user exists
                $sql_check = "SELECT * from users where username='$username' and email='$email' ";
                if($res = mysqli_query($conn, $sql_check)){
                    if(mysqli_num_rows($res)==1){
                        header("Location: S-sign-up.php?error=user-exists");
                        exit();
                    }
                }

                $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email' ,'$password')";                
                
                if(mysqli_query($conn, $sql) ){
                    echo "signup successful";
                    $sql_f = "INSERT INTO fine (email, fine) VALUES ('$email', 0)";
                    mysqli_query($conn, $sql_f);
                    header("Location: S-signin.php");
                }
                else{
                    echo "unsuccessful";
                    header("Location: S-sign-up.php?error=unsuccessful");
                }
            }
        }

    ?>
</body>
</html>