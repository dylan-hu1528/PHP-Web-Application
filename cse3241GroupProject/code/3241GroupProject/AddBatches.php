<html>
<body>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
</head>
<body>
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
    $manu = $_POST["manu"];
    $edate = date("Y-m-d",strtotime($_POST["edate"]));
    $quan = $_POST["quan"];
    $tnumbers = $_POST["tnumbers"];

    // get current status of doses
    $status = array();
    $date = '2021-03-01'; // assume taday is 2021-3-1
    for ($x = 0; $x < $quan; $x++) {  
        if ($edate < $date) {
            array_push($status, "expired");
        }
        else {
            array_push($status, "available");
        }
    }

    $conn = mysqli_connect('localhost', 'root', 'mysql', 'groupproject');
    if (!$conn) {
        die('Cannot connect'.mysqli_connect_error());
    }

    // add a new batch to VaccineBatch table
    $insertBatch="insert into vaccinebatch (manufacturer, expirationdate, quantity) values('$manu', '$edate', $quan);";
    if(!mysqli_query($conn, $insertBatch)) {
        echo "ERROR: Could not able to execute $insertBatch. " . mysqli_error($conn);
    }

    // add doses of this batch to Dose table
    $batchid = mysqli_insert_id($conn);
    $bool = true;
    for ($x = 0; $x < $quan; $x++) {
        $insertDose="insert into dose (trackingnumber, status, batchid) values($tnumbers[$x], '$status[$x]', $batchid);";
        if(!mysqli_query($conn, $insertDose)) {
            echo "ERROR: Could not able to execute $insertBatch. " . mysqli_error($conn);
            $bool = false;
        }
    }

    // if one of the doses was failed to add, cancel this adding request. 
    if ($bool) {
        echo "Batch has been successfully added.<br>";
        echo $quan, " doses have been added.";
    }
    else {
        $delete = "delete from vaccinebatch where batchid = $batchid";
        mysqli_query($conn, $delete);
        $delete = "delete from dose where batchid = $batchid";
        mysqli_query($conn, $delete);
    }

    // update waitlist
    include 'UpdateSchedule.php';
    UpdateSchedule();
    
    mysqli_close($conn);
?>

<form action="DisplayTables.php">
    <input type="submit" value="Click here to see current tables" />
</form>

</body>
</html>