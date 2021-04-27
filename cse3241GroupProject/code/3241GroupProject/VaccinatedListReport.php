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

    // get and draw the table of vaccinated patients
    $query="
        select name, patientid, dates, manufacturer from ((
        select name, a.patientid, dates, batchid from(
        select patientid, dates, batchid from waitlist join dose on status = 'used' and dose.trackingnumber = waitlist.trackingnumber)
        a join (select patientid, name from patient)b on a.patientid = b.patientid)
        c join (select * from vaccinebatch)d on c.batchid = d.batchid);";
    $results = mysqli_query($conn,$query) or die(mysqli_connect_error());

    echo "<h1>List of Vaccinated Patients</h1>
    <h2>Total Number: ".mysqli_num_rows($results)."<br>
    <table border='1' class='table table-hover table-dark table-striped'>
    <tr>
    <th>Name</th>
    <th>Patient ID</th>
    <th>Vaccinated Date</th>
    <th>Vaccine Brand</th>
    </tr>";

    while($row = mysqli_fetch_array($results)){
        echo "<tr>";
        echo "<td>" . $row['name'] . "</td>";
        echo "<td>" . $row['patientid'] . "</td>";
        echo "<td>" . $row['dates'] . "</td>";
        echo "<td>" . $row['Manufacturer'] . "</td>";
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

