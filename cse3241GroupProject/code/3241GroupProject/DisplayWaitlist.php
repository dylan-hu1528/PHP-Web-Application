<html>
<head>
    <title>DisplayWaitlist</title>
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


<h1>Choose a table</h1>

<form action="DisplayPatient.php">
    <input type="submit" value="Patient" />
</form>

<form action="DisplayVaccineBatch.php">
    <input type="submit" value="VaccineBatch" />
</form>

<form action="DisplayDose.php">
    <input type="submit" value="Dose" />
</form>

<form action="DisplayWaitlist.php">
    <input type="submit" value="Waitlist" />
</form>

<?php
    $conn = mysqli_connect('localhost', 'root', 'mysql', 'groupproject');
    if (!$conn) {
        die('Cannot connect'.mysqli_connect_error());
    }

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