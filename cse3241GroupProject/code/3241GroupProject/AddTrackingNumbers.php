<html>
<head>
    <title>BURPage</title>
</head>
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

<h1>Enter the number of doses in this batch</h1>

<form action="AddBatches.php" method="post">
    <?php
        // pass values to next file
        echo '<input type="hidden" name="manu" value=', $_POST["manu"], '>';
        echo '<input type="hidden" name="edate" value=', $_POST["edate"], '>';
        echo '<input type="hidden" name="quan" value=', $_POST["quan"], '>';

        // get and pass tracking numbers
        echo "Enter tracking number(s) for this batch: <br>";        
        for ($x = 0; $x < $_POST["quan"]; $x++) {
            echo $x, ' : <input type="number" name="tnumbers[]"><br>';  
        }

    ?>
<input type="submit">
</form>

<br>
<form>
 <input type="button" value="Previous" onclick="history.back()">
</form>

</body>
</html>