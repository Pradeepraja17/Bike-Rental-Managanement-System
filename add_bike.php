<html>
<head>
  <title>add bike </title>
  <div style="background-color: #80d9f6;">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<?php
   include("admin_nav.php");
 ?>
 <br>
<center> <h1><b>Upload bike details </b></h1></center>
<form name="form" method="post" name="form1" action="" enctype="multipart/form-data">
<div class="container mt-3">
 
  <div class="card" style="width:400px;margin: 0 auto">

  <!-- Existing form fields -->

  <input type="text" name="id" style="width:300px;margin: 0 auto" class="form-control mt-3" placeholder="id"><br>
  <input type="file" name="image" style="width:300px;margin: 0 auto" class="form-control mt-3"><br>
<input type="text" style="width:300px;margin: 0 auto" name="nme" class="form-control mt-3" placeholder="name"><br>
<input type="text" style="width:300px;margin: 0 auto" name="model" class="form-control mt-3" placeholder="model"><br>
<input type="text" style="width:300px;margin: 0 auto" name="rent" class="form-control mt-3" placeholder="rent"><br>
<input type="textarea" style="width:300px;margin: 0 auto" name="bide" class="form-control mt-3" placeholder="bike detail"><br>
<br>


  <center><button type="submit" name="btn" style="width:200px;margin: 0 auto" class="btn btn-dark">upload</button></center>
  <br>
  <br>
  
  </div>
  </div>
</form>
</body>
</html>
<?php
session_start();
$connect = mysqli_connect("localhost", "root", "", "bikerent");

if (isset($_POST['btn']))
 {
  // Retrieve form data
  $t1 = isset($_POST['id']) ? $_POST['id'] : '';
  $t2 = isset($_POST['nme']) ? $_POST['nme'] : '';
  $t3 = isset($_POST['model']) ? $_POST['model'] : '';
  $t4 = isset($_POST['rent']) ? $_POST['rent'] : '';
  $t5 = isset($_POST['bide']) ? $_POST['bide'] : '';
  

  // Handle image upload
  $image = $_FILES['image']['tmp_name']; // Path to the temporary uploaded file
  $imageData = file_get_contents($image); // Retrieve the image data

 $qry = mysqli_prepare($connect, "INSERT INTO bikes (id, image, name, model,rent,bike_detail) VALUES (?, ?,?,?,?,?)");
 mysqli_stmt_bind_param($qry, 'ssssss', $t1, $imageData, $t2, $t3, $t4,$t5);

  // Execute the prepared statement
  mysqli_stmt_execute($qry);

  if (mysqli_stmt_affected_rows($qry) > 0) 
  {
    die("<script>alert('Data inserted Suessfully')</script>");
   
  } 
  else {
    echo "Error: " . mysqli_error($connect);
    die("<script>alert('Data  not inserted ')</script>");
  }

  mysqli_stmt_close($qry);


}
?>