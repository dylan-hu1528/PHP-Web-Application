<html>
<head>
    <title>SignupPage</title>
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
<h1>Vaccination Sign Up</h1>
<form action = "Signup.php" method = "post">
<div class="mb-3">
  <label for="formGroupExampleInput" class="form-label">Name</label>
  <input type="text" class="form-control" name="name" placeholder="Please Enter Your Name: ">
</div>
<div class="mb-3">
  <label for="formGroupExampleInput2" class="form-label">Phone Number</label>
  <input type="number" class="form-control" name="pnumber" placeholder="Please Enter Your Phone Number: ">
</div>
<div class="mb-3">
  <label for="formGroupExampleInput3" class="form-label">Earliest Date</label>
  <input type="date" class="form-control" name="date" placeholder="Please Enter the Earliest Date You are Available: ">
</div>
<div class="mb-3">
  <label for="formGroupExampleInput4" class="form-label">Age</label>
  <input type="number" class="form-control" name="age" placeholder="Please Enter Your Age: ">
</div>
<div class="mb-3">
  <label for="formGroupExampleInput5" class="form-label">Priority</label>
  <input type="number" min=1 max = 3 class="form-control" name="priority" placeholder="Please Enter the Priority from 1 to 3 (1 means high priority, 3 means low proority):  ">
</div>
<input type="submit">
</form>
<p>Click the "Submit" button to sign up for your vaccination. </p>
</body>
</html>