<html>
<body>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
<ul class="nav nav-pills nav-fill">
  <li class="nav-item">
    <a class="nav-link active" aria-current="page" href="/index.php">Home</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="SignupPage.php">Vaccination Sign Up</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="CancelRequest.php">Cancel Request</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="BURPage.php">BUR Administration</a>
  </li>
</ul>

<?php 

    // get patientid
    $id = $_POST["id"];

    $conn = mysqli_connect('localhost', 'root', 'mysql', 'groupproject');
    if (!$conn) {
        die('Cannot connect'.mysqli_connect_error());
    }

    // find the entry in waitlist
    $query = "select * from waitlist where patientid = $id;";
    $results = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($results);
    if (mysqli_num_rows($results) == 1) {
        $tnumber = $row['trackingnumber'];
        if ($tnumber != null) {
            // get the dose status
            $check = "select status, trackingnumber from dose where trackingnumber = $tnumber;";
            $results = mysqli_query($conn, $check);
            $row = mysqli_fetch_array($results);
        }
        else {
            $row = null;
        }
        // can't cancel if used
        if ($row['status'] == 'used') {
            echo "You can't cancel this request because you have completed the vaccination.";
        }
        
        // proceed if assigned
        else if ($tnumber == null or $row['status'] == 'assigned') {

            // try delete from Waitlist
            $delete = "delete from waitlist where patientid = $id;";
            if(!mysqli_query($conn, $delete)) {
                echo "ERROR: Could not able to execute $delete. " . mysqli_error($conn);
            }
            else {
                echo "Your information has been removed from Waitlist!<br>";
            }

            // try delete from Patient
            $delete = "delete from patient where patientid = $id;";
            if(!mysqli_query($conn, $delete)) {
                echo "ERROR: Could not able to execute $delete. " . mysqli_error($conn);
            }
            else {
                echo "Your information has been removed from Patient!";
            }

            if ($tnumber != null) {
                // try change the status of the dose to available
                $changeStatus = "update dose set status = 'available' where trackingnumber = $tnumber;";
                if(!mysqli_query($conn, $changeStatus)) {
                    echo "ERROR: Could not able to execute $changeStatus. " . mysqli_error($conn);
                }
                else {
                    echo "<br>The reserved vaccine has been sent back to inventory.";
                }
            }
        }

        // error if vaccine status is neither used or assigned
        else {
            echo "ERROR: Unexpected vaccine status found: ".$row['status'].".";
        }
    }

    // print found nothing if number of result row is 0
    else if (mysqli_num_rows($results) == 0) {
        echo "No request of Patient ID $id is found.";
    }

    // error if number of result row is greater than 1
    else {
        echo "ERROR: More than 1 row is found for Patient ID $id.";
    }
    
    // update waitlist
    include 'UpdateSchedule.php';
    UpdateSchedule();
    
    mysqli_close($conn);
?>

<br>
<form>
 <input type="button" value="Previous" onclick="history.back()">
</form>

</body>
</html>