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
    $conn = mysqli_connect('localhost', 'root', 'mysql', 'groupproject');
    if (!$conn) {
        die('Cannot connect'.mysqli_connect_error());
    }

    // get and draw the table of waiting patients
    $query="select * from patient where patientid = (select patientid from waitlist where trackingnumber is null) order by priority, age desc;";
    $results = mysqli_query($conn,$query) or die(mysqli_connect_error());

    echo "<h1>List of Waiting Patients</h1>
    <h2>Total Number: ".mysqli_num_rows($results)."<br>
    <table border='1' class='table table-hover table-dark table-striped'>
    <tr>
    <th>Name</th>
    <th>Patient ID</th>
    <th>Phone Number</th>
    <th>Age</th>
    <th>Earliest Date for Vaccination</th>
    <th>Priority</th>
    </tr>";

    while($row = mysqli_fetch_array($results)){
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

    
    mysqli_close($conn);
?>

<br>
<form>
 <input type="button" value="Previous" onclick="history.back()">
</form>

</body>
</html>

