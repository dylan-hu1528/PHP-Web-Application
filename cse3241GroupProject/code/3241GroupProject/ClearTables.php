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

<h1>Select a table to clear</h1>

<form method="post">
    <input type="submit" name="ClearPatient" id="ClearPatient" value="Clear Patient" /><br><br>
    <input type="submit" name="ClearVaccineBatch" id="ClearVaccineBatch" value="Clear VaccineBatch" /><br><br>
    <input type="submit" name="ClearDose" id="ClearDose" value="Clear Dose" /><br><br>
    <input type="submit" name="ClearWaitlist" id="ClearWaitlist" value="Clear Waitlist" /><br><br>
</form>

<?php 
    // clear Patient table
    function ClearPatient() {
        $conn = mysqli_connect('localhost', 'root', 'mysql', 'groupproject');
        if (!$conn) {
            die('Cannot connect'.mysqli_connect_error());
        }

        $query = "delete from patient;";
        if(!mysqli_query($conn, $query)) {
            echo "ERROR: Could not able to execute $query. " . mysqli_error($conn);
        }

        $query = "alter table patient auto_increment = 1;";
        mysqli_query($conn, $query);

        echo "Table \"Patient\" has been cleared.";
    }

    // clear VaccineBatch table
    function ClearVaccineBatch() {
        $conn = mysqli_connect('localhost', 'root', 'mysql', 'groupproject');
        if (!$conn) {
            die('Cannot connect'.mysqli_connect_error());
        }

        $query = "delete from vaccinebatch;";
        if(!mysqli_query($conn, $query)) {
            echo "ERROR: Could not able to execute $query. " . mysqli_error($conn);
        }

        $query = "alter table vaccinebatch auto_increment = 1;";
        mysqli_query($conn, $query);

        echo "Table \"VaccineBatch\" has been cleared.";
    }

    // clear Dose table
    function ClearDose() {
        $conn = mysqli_connect('localhost', 'root', 'mysql', 'groupproject');
        if (!$conn) {
            die('Cannot connect'.mysqli_connect_error());
        }

        $query = "delete from dose;";
        if(!mysqli_query($conn, $query)) {
            echo "ERROR: Could not able to execute $query. " . mysqli_error($conn);
        }

        echo "Table \"Dose\" has been cleared.";
    }

    // clear Waitlist table
    function ClearWaitlist() {
        $conn = mysqli_connect('localhost', 'root', 'mysql', 'groupproject');
        if (!$conn) {
            die('Cannot connect'.mysqli_connect_error());
        }

        $query = "delete from waitlist;";
        if(!mysqli_query($conn, $query)) {
            echo "ERROR: Could not able to execute $query. " . mysqli_error($conn);
        }
        
        $query = "alter table waitlist auto_increment = 1;";
        mysqli_query($conn, $query);

        echo "Table \"Waitlist\" has been cleared.";
    }

    // responses to buttons
    if(array_key_exists('ClearPatient',$_POST)){
        ClearPatient();
    }
    if(array_key_exists('ClearVaccineBatch',$_POST)){
        ClearVaccineBatch();
    }
    if(array_key_exists('ClearDose',$_POST)){
        ClearDose();
    }
    if(array_key_exists('ClearWaitlist',$_POST)){
        ClearWaitlist();
    }
    
?>

<br>
<form>
 <input type="button" value="Previous" onclick="history.back()">
</form>


</body>
</html>