<?php
    session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <title>BOOKED</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./booked.css" />
    <script>
        function openFile(url) {
            window.location.href = url;
        }
    </script>
</head>

<body>
    <?php
        $name = $_SESSION['username'];
        $email = $_SESSION['email'];
        $pickup = $_SESSION['pickup'];
        $dest = $_SESSION["dest"];
        $cycle = $_SESSION['cycle_no'];
        $ptime = $_SESSION['ptime'];
        $id = $_SESSION['id'];
    ?>
    <div class="background"> </div>
    <div class="box">
        <form action="/action_page.php" method="post">
            <h1>Book your trip</h1>
            <hr>
            <div class="container">
                <div class="contain">
                    <!-- <label for="name"><b>Name</b></label>
                    <input type="text" id="name" placeholder="Name" name="name" required>
                    <label for="psw"><b>Roll No</b></label>
                    <input type="text" id="psw" placeholder="Roll No" name="psw" required> -->
                    <div class="formcolumn side">
                        <label for="fromplace">From :</label>
                        <input type="text" id="fromplace" class="disabled" name="name" value=<?php echo "$pickup"; ?> readonly>
                    </div>
                    <span class="arrow">&#8644;</span>
                    <!-- <span class="arrow">&#8594;&raquo;</span> -->
                    <div class="formcolumn side">
                        <label for="toplace">To :</label>
                        <input type="text" id="toplace" class="disabled" name="name" value=<?php echo "$dest"; ?>  readonly>
                    </div>
                    <div class="formcolumn">
                        <label for="starttime"><b>Start time</b></label>
                        <input type="time" id="starttime" class="highlight" name="starttime" value=<?php echo "$ptime"; ?>  readonly>
                    </div>
                </div>
            </div>
            <button class="disabled-button">Book Now</button>
        </form>
        <div class="confirm">
        <?php 
                echo "<p>Your cycle has been booked. Cycle no :- $cycle </p>";
            ?>
            <!-- <button onclick="openFile('./book.php')">Cancel</button> -->
            <?php 
                $cancel = "./S-book.php?op=cancelled";
                // echo "<button onclick='openFile($s)'>Cancel</button>";
                $park = "./S-book.php?op=parked" ;

        ?>
        </div>
        <!-- <div class="proceed">
            
            <a href = <?php echo"$cancel"?> >
                <button>Cancel</button>
            </a>
             
    </div> -->

        <div class="proceed">
            <button id="hideButton" onclick="openFile('./S-book.php?op=cancelled')">Cancel</button>
            <form action=<?php echo"$park";?> method="post">
                <button>Park</button>
            </form>
        </div>
    </div>
    <script>
        var Button = document.querySelector('#hideButton');
        var hideTime = 1000*60*10;
        function Opacity() {
            Button.style.opacity = 0.5;
            Button.style.cursor = "not-allowed";
            Button.setAttribute("title", "Time limit to cancel your cycle is done.");
            Button.disabled = true;
        }
        setTimeout(Opacity, hideTime);
    </script>
    </div>
</body>

</html>