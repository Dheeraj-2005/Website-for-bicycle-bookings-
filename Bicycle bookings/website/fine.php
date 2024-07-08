<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>fine</title>
</head>
<body>
    <?php
        $conn = mysqli_connect("localhost", "root", "", "Cycles") ;
        if(!$conn){
            die("Connection failed" .mysqli_connect_error());
        }
        echo "connected successfully<br>";
        date_default_timezone_set('Asia/Kolkata');
        $current_time = date("Y-m-d H:i:s");
        echo "<br>$current_time";
        $query = "SELECT * FROM running WHERE dtime < CURTIME() and status='running'";
        $res = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_assoc($res)) {
            $dtime = date("Y-m-d H:i:s", strtotime($row['dtime']));
            $time_diff = strtotime($current_time) - strtotime($dtime);
            $min_diff = floor($time_diff / 60);
            echo "<br>$min_diff";
            $id = $row['id'];
            $fine = 0;
            if ($min_diff <= 10) {
                $fine = $min_diff; 
            } else {
                $fine = 10 + (($min_diff - 10) * 5);
            }
            echo "<br> $fine";
        
            $update_query = "UPDATE running SET fine = $fine WHERE id = '$id'";
            if(mysqli_query($conn, $update_query)){
                echo "success";
            }
        }
        

    ?>
    <script>
    setTimeout(function () { window.location.reload(); }, 1*60*1000);
    document.write(new Date());
    </script>

</body>
</html>