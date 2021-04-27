<html>
<head>
    <title>BURPage</title>
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

<h1>Enter vaccine batches</h1>

<form action="AddTrackingNumbers.php" method="post">
   <div class="mb-3">
  <label for="formGroupExampleInput" class="form-label">Manufacturer</label>
  <input type="text" class="form-control" name="manu" placeholder="Please Enter the Vaccine  Manufacturer: ">
</div>
 <div class="mb-3">
  <label for="formGroupExampleInput2" class="form-label">Expiration Date</label>
  <input type="date" class="form-control" name="edate" placeholder="Please Enter the Vaccine  Expiration Date: ">
</div>
 <div class="mb-3">
  <label for="formGroupExampleInput3" class="form-label">Quantity</label>
  <input type="number" class="form-control" name="quan" placeholder="Please Enter the Quantity: ">
</div>
<input type="submit">
</form>
<p>Click the "Submit" button to add a new vaccine batch. </p>

<form action="ListDoseStatus.php">
    <input type="submit" value="List Dose Status and Patient Names" />
</form>

<form action="GenerateReport.php">
    <input type="submit" value="Generate Report" />
</form>

<form action="DisplayTables.php">
    <input type="submit" value="Display Tables" />
</form>

<form action="ClearTables.php">
    <input type="submit" value="Clear Tables" />
</form>


</body>
</html>