<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $vcode = $_POST["code"];
    $newPassword = $_POST["new_password"];
    
    $conn = mysqli_connect("localhost", "root", "", "Cycles") ;
        if(!$conn){
            die("Connection failed" .mysqli_connect_error());
        }
    
        echo "connected successfully<br>";

    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);
    echo "connectesfully<br>";

    if (mysqli_num_rows($result) > 0) {
        echo "connected successfully<br>";

        $row = mysqli_fetch_assoc($result);
        echo "connected successfully<br>";

        if ($vcode === $row['vcode']) {
            $updateSql = "UPDATE users SET password = '$newPassword' WHERE username = '$username'";
            if (mysqli_query($conn, $updateSql)) {
                header("Location: S-signin.php");
                exit;
            } else {
                $error = "Failed to update password.";
                header("Location: resetpass.php?username=" . $username . "&error=" . urlencode($error));
                exit;
            }
        } else {
            $error = "Invalid verification code.";
            header("Location: resetpass.php?username=" . $username . "&error=" . urlencode($error));
            exit;
        }
    }
    echo "connectedly<br>";
    mysqli_close($conn);
}
?>
</body>
</html>
