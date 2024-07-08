<?php
    session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <title>BOOK</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./book.css" />
</head>

<body>
    <div class="background"> </div>
    <div class="box">
        <form action=<?php echo "./form.php" ?> method="post" onsubmit="return validateForm()">
            <h1>Book your trip</h1>
            <hr>
            <div class="container">
                <div class="formcolumn side">
                    <label for="fromplace">From:</label>
                    <select id="fromplace" class="highlight" name="pickup" onchange="updateToOptions()" required>
                        <option value="">Select</option>
                        <option value="Newhostel">NEW HOSTELS</option>
                        <option value="Oldhostel">OLD HOSTELS</option>
                        <option value="Maingate">MAIN GATE</option>
                        <option value="Isthara">ISTHARA FOOD COURT</option>
                    </select>
                </div>
                <span class="arrow">&#8644;</span>
                <div class="formcolumn side">
                    <label for="toplace">To:</label>
                    <select id="toplace" class="highlight" name="dest" required>
                        <option value="">Select</option>
                    </select>
                </div>
                <div class="formcolumn">
                    <label for="starttime"><b>Start time</b></label>
                    <input type="time" id="starttime" class="highlight" name="ptime" required>
                    <span id="timeError" style="display: none; color:red; text-align:center;"><p>Please enter a valid time.</p></span>
                </div>
                <button id="book" type="submit">Book Now</button>
            </div>
        </form>

        <?php
            if(isset($_GET['op']) && $_GET['op'] === 'cancelled'){
                $conn = mysqli_connect("localhost", "root", "", "Cycles") ;
                if(!$conn){
                    die("Connection failed" .mysqli_connect_error());
                }

                $cycleno = $_SESSION['cycle_no'];
                $pickup = $_SESSION['pickup'];
                $id = $_SESSION['id'];
                // echo "$id";
                $sql = "INSERT INTO $pickup VALUES ('$cycleno')";
                mysqli_query($conn, $sql);
                $sql_status = "UPDATE running SET status = 'cancelled'  WHERE id= $id";
                mysqli_query($conn, $sql_status);
            }
            
            if(isset($_GET['op']) && $_GET['op'] === 'parked'){
                $conn = mysqli_connect("localhost", "root", "", "Cycles") ;
                if(!$conn){
                    die("Connection failed" .mysqli_connect_error());
                }

                $dest = $_SESSION['dest'];
                $cycleno = $_SESSION['cycle_no']; 
                $id = $_SESSION['id'];
                $sql = "INSERT INTO $dest VALUES ('$cycleno')";
                if(mysqli_query($conn, $sql)){
                    echo "<p>Cycle is parked</p>";
                }
                $sql_status = "UPDATE running SET status = 'parked' WHERE id= $id";
                if(mysqli_query($conn, $sql_status)){
                    // echo "status updated";
                }
            }
            if(strcmp($_SESSION['cycles'], "empty")==0){
                $late = $_SESSION['late'];
                $_SESSION['cycles'] = "notempty"; 
                echo "<p style='text-align: center;'>Sorry, Currently there are no cycles in the stand.<br> Your cycle will be available at $late.</p>";
            }
        ?>
    </div>
    <script>
        function updateToOptions() {
            var fromSelect = document.getElementById("fromplace");
            var toSelect = document.getElementById("toplace");
            var selectedToValue = toSelect.value;

            toSelect.innerHTML = "";
            var selectOption = document.createElement("option");
            selectOption.value = "";
            selectOption.text = "Select";
            toSelect.appendChild(selectOption);
            var selectedFromValue = fromSelect.value;
            for (var i = 0; i < fromSelect.options.length; i++) {
                var option = fromSelect.options[i];
                if (option.value !== selectedFromValue && option.value !== "") {
                    var clonedOption = option.cloneNode(true);
                    toSelect.appendChild(clonedOption);
                    if (clonedOption.value === selectedToValue) {
                        clonedOption.selected = true;
                    }
                }
            }
        }

        updateToOptions();

        var arrow = document.querySelector('.arrow');
        arrow.addEventListener('click', function () {
            var fromInput = document.getElementById('fromplace');
            var toInput = document.getElementById('toplace');
            var temp = fromInput.value;
            fromInput.value = toInput.value;
            toInput.value = temp;
            updateToOptions();
        });

        function validateForm() {
            var startTimeInput = document.getElementById("starttime");
            var selectedTime = startTimeInput.value;
            var selectedTimeParts = selectedTime.split(":");
            var selectedHours = parseInt(selectedTimeParts[0]);
            var selectedMinutes = parseInt(selectedTimeParts[1]);

            var currentTime = new Date();
            var currentHours = currentTime.getHours();
            var currentMinutes = currentTime.getMinutes();

            if (selectedHours < currentHours || (selectedHours === currentHours && selectedMinutes <= currentMinutes)) {
                var timeError = document.getElementById("timeError");
                timeError.style.display = "inline";
                return false;
            }

            return true;
        }

        var startTimeInput = document.getElementById("starttime");
        startTimeInput.addEventListener("blur", function () {
            var timeError = document.getElementById("timeError");
            timeError.style.display = "none";
        });

    </script>
</body>

</html>