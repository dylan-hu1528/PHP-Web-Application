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

    // query to get a table with colomns of manufacturer, number of doses received, distributed, expired and available.
    $query="
        select e.sum, uCount,eCount, aCount, e.manufacturer from(
        select c.sum, uCount, eCount, c.manufacturer from(
        select sum, uCount, a.manufacturer from (select sum(quantity) as sum, manufacturer from vaccinebatch group by manufacturer) a

    right join (
        select count(status) as uCount, a.manufacturer from dose 
        right join(select manufacturer, vaccinebatch.batchid from vaccinebatch 
        join dose on vaccinebatch.batchid = dose.batchid group by batchid) a 
        on dose.batchid = a.batchid and (status = 'used' or status = 'assigned')
        group by manufacturer)b on a.manufacturer = b.manufacturer) c

    right join (
        select count(status) as eCount, a.manufacturer from dose 
        right join(select manufacturer, vaccinebatch.batchid from vaccinebatch 
        join dose on vaccinebatch.batchid = dose.batchid group by batchid) a 
        on dose.batchid = a.batchid and status = 'expired' 
        group by manufacturer)d on d.manufacturer = c.manufacturer) e

    right join (
        select count(status) as aCount, a.manufacturer from dose 
        right join(select manufacturer, vaccinebatch.batchid from vaccinebatch 
        join dose on vaccinebatch.batchid = dose.batchid group by batchid) a 
        on dose.batchid = a.batchid and status = 'available'
        group by manufacturer)f on e.manufacturer = f.manufacturer;";

    $results = mysqli_query($conn,$query) or die(mysqli_connect_error());

    // draw a table
    echo "<h1>Inventory</h1>
    <h2>Total Number: ".mysqli_num_rows($results)."<br>
    <table border='1' class='table table-hover table-dark table-striped'>
    <tr>
    <th>Manufacturer</th>
    <th>Number Received</th>
    <th>Number Distribued(used or assigned)</th>
    <th>Number Expired</th>
    <th>Number Available</th>
    </tr>";

    while($row = mysqli_fetch_array($results)){
        echo "<tr>";
        echo "<td>" . $row['manufacturer'] . "</td>";
        echo "<td>" . $row['sum'] . "</td>";
        echo "<td>" . $row['uCount'] . "</td>";
        echo "<td>" . $row['eCount'] . "</td>";
        echo "<td>" . $row['aCount'] . "</td>";
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

