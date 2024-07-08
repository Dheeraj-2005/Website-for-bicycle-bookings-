<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $conn = mysqli_connect("localhost", "root", "", "Cycles") ;
        if(!$conn){
            die("Connection failed" .mysqli_connect_error());
        }
        echo "connected successfully<br>";
        
        if($_SERVER["REQUEST_METHOD"]=="POST"){
            $username = $_SESSION['username'];
            $email = $_SESSION['email'];
            $pickup = $_REQUEST['pickup'];
            $dest = $_REQUEST['dest'];
            $ptime = $_REQUEST['ptime'];

            if((strcmp($pickup, "Maingate")==0 && strcmp($dest, "Newhostel")==0) || (strcmp($pickup, "Newhostel")==0 && strcmp($dest, "Maingate")==0)){
                $reach = 60*60;
            }
            else if((strcmp($pickup, "Maingate")==0 && strcmp($dest, "Oldhostel")==0) || (strcmp($pickup, "Oldhostel")==0 && strcmp($dest, "Maingate")==0)){
                $reach = 60*45;
            }
            else if((strcmp($pickup, "Maingate")==0 && strcmp($dest, "Isthara")==0) || (strcmp($pickup, "Isthara")==0 && strcmp($dest, "Maingate")==0)){
                $reach = 60*10;
            }
            else if((strcmp($pickup, "Isthara")==0 && strcmp($dest, "Newhostel")==0) || (strcmp($pickup, "Newhostel")==0 && strcmp($dest, "Isthara")==0)){
                $reach = 60*50;
            }
            else if((strcmp($pickup, "Isthara")==0 && strcmp($dest, "Oldhostel")==0) || (strcmp($pickup, "Oldhostel")==0 && strcmp($dest, "Isthara")==0)){
                $reach = 60*35;
            }
            else if((strcmp($pickup, "Oldhostel")==0 && strcmp($dest, "Newhostel")==0) || (strcmp($pickup, "Newhostel")==0 && strcmp($dest, "Oldhostel")==0)){
                $reach = 60*15;
            }

            $psec = strtotime($ptime);
            $sec = $psec + $reach;
            $dtime = date('H:i', $sec);
            $status = "running";
            echo "$dtime";
            echo "$dest";
            echo "$pickup";
            $fine = 0;
            
            
            
            $sql = "SELECT * FROM $pickup";
            $res = mysqli_query($conn, $sql);
            if(mysqli_num_rows($res) > 0 && 1!=1){
                while($row = mysqli_fetch_assoc($res)){
                    $cycle_no = $row['cyclesNo'];
                    $sqld = "DELETE FROM $pickup where CyclesNo = $cycle_no";
                    if(mysqli_query($conn, $sqld)){
                        echo "deleted\n";
                    }
                    break;
                }
            }
            else{
                echo "<br>$dest";
                $sql_time = "SELECT dtime  FROM running where dest='$dest' AND status='running' ORDER BY dtime ASC" ;
                if($res = mysqli_query($conn, $sql_time)){
                    if(mysqli_num_rows($res)>=1){
                        $row = mysqli_fetch_assoc($res);
                        $late = $row['dtime'];
                        $_SESSION['late'] = $late;  
                        $_SESSION['cycles'] = "empty";
                        header("Location: S-book.php");
                    }
                }
            }
            
            $sql = "INSERT INTO running (Name, email, pickup, dest, ptime, dtime, cycle_no, status, fine) VALUES ('$username', '$email', '$pickup', '$dest', '$ptime', '$dtime', '$cycle_no', '$status', '$fine')";
            if(mysqli_query($conn, $sql)){
                echo "Cycle has been booked";
                $id = mysqli_insert_id($conn);
                $_SESSION['cycle_no'] = $cycle_no;
                $_SESSION['pickup'] = $pickup;
                $_SESSION['dest'] = $dest;
                $_SESSION['ptime'] = $ptime;
                $_SESSION['id'] = $id;
                header("Location: S-booked.php");
                // header("Location: S-booked.php?cycleno=" . urlencode($cycle_no)."&pickup=".urlencode($pickup)."&dest=".urlencode($dest)."&ptime=".urlencode($ptime)."&name=".urlencode($name)."&email=".urlencode($email)."&id=".urlencode($id));
            }
            else{
                echo "failed to book";
            }
        }
        // else{
        //     echo "failed ";
        // }

        
    ?>
    
</body>
</html>