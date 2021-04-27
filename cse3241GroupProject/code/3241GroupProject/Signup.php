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

    // get passed values 
    $name = $_POST["name"];
    $pnumber = $_POST["pnumber"];
    $age = $_POST["age"];
    $date=date("Y-m-d",strtotime($_POST["date"]));
    $priority = $_POST["priority"];


    $conn = mysqli_connect('localhost', 'root', 'mysql', 'groupproject');
    if (!$conn) {
        die('Cannot connect'.mysqli_connect_error());
    }

    // insert a new patient to Patient table
    $insertPatient="insert into patient (name, phonenumber, age, earliestdate, priority) values('$name', $pnumber, $age, '$date', $priority);";
    if(!mysqli_query($conn, $insertPatient)) {
        echo "ERROR: Could not able to execute $insertPatient. " . mysqli_error($conn);
    }
    else {
        echo "$name has been successfully added. <br>
        Your Patient ID is:". mysqli_insert_id($conn) .".<br>
        You will need this ID to cancel request.";
    }

    // display Patient table
    $query = "SELECT * FROM patient";
    $result = mysqli_query($conn, $query);

    echo "<h1>Patient Table</h1>
    <table border='1' class='table table-hover table-dark table-striped'>
    <tr>
    <th>Name</th>
    <th>Patient ID</th>
    <th>Phone Number</th>
    <th>Age</th>
    <th>Earliest Date</th>
    <th>Priority</th>
    </tr>";

    while($row = mysqli_fetch_array($result)){
        echo "<tr>";
        echo "<td>" . $row['Name'] . "</td>";
        echo "<td>" . $row['patientid'] . "</td>";
        echo "<td>" . $row['PhoneNumber'] . "</td>";
        echo "<td>" . $row['Age'] . "</td>";
        echo "<td>" . $row['EarliestDate'] . "</td>";
        echo "<td>" . $row['Priority'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";

    // update waitlist
    include 'UpdateSchedule.php';
    UpdateSchedule();

    // get and draw Waitlist table
    $query = "SELECT * FROM waitlist;";
    $result = mysqli_query($conn, $query);

    echo "<h1>Waitlist</h1>
    <h2>Total Number: ".mysqli_num_rows($result)."<br>
    <table border='1' class='table table-hover table-dark table-striped'>
    <tr>
    <th>ID</th>
    <th>Dates</th>
    <th>Patient ID</th>
    <th>Tracking Number</th>
    </tr>";

    while($row = mysqli_fetch_array($result)){
        echo "<tr>";
        echo "<td>" . $row['ID'] . "</td>";
        echo "<td>" . $row['Dates'] . "</td>";
        echo "<td>" . $row['patientID'] . "</td>";
        echo "<td>" . $row['trackingnumber'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    
    mysqli_close($conn);
?>

<br>
<form>
 <input type="button" value="Previous" onclick="history.back()">
</form>


</body>
</html>