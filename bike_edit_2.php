<?php
session_start();
$id = $_SESSION['id'];
$connect = mysqli_connect("localhost", "root", "", "bikerent");
$query = mysqli_query($connect, "SELECT * FROM bikes WHERE id='$id'");
$row = $query->fetch_assoc();
?>

<html>
<head>
  <title>bike edit 2</title>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script>
    function previewImage(event) {
      var reader = new FileReader();
      reader.onload = function() {
        var output = document.getElementById('preview');
        output.src = reader.result;
      }
      reader.readAsDataURL(event.target.files[0]);
    }
  </script>
  <style>
    .card {
      height: 100%;
    }

    .card-image-container {
      position: relative;
      padding-top: 100%; /* Set the aspect ratio as per your preference (e.g., 1:1 for square) */
      overflow: hidden;
    }

    .card-image-container img {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 95%;
      object-fit: cover;
    }
  </style>
  </div>
</head>
<body>
<?php
include("admin_nav.php");
?>
<br>

<center><h1><b><strong >Bike rent</strong></b></h1></center>
<form name="form" method="post" name="form1" action="" enctype="multipart/form-data">
  <div class="container mt-3">
    <div class="card" style="width:350px;margin: 0 auto">
      <!-- Existing form fields -->
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text">id</span>
        </div>
        <input type="text" name="id" style="width:300px;margin: 0 auto" value="<?php echo $row['id']; ?>" class="form-control" placeholder="id" readonly>
      </div>

      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text">image</span>
        </div>
        <input type="file" name="image" style="width:300px;margin: 0 auto" class="form-control" onchange="previewImage(event)">
      </div>

      <div class="card-image-container">
        <img id="preview" src="data:image/jpeg;base64,<?= base64_encode($row['image']) ?>" alt="Card image">
      </div>

      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text">@</span>
        </div>
        <input type="text" style="width:300px;margin: 0 auto" name="nme" class="form-control" value="<?php echo $row['name']; ?>" placeholder="name">
      </div>

      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text">@</span>
        </div>
        <input type="text" style="width:300px;margin: 0 auto" name="price" class="form-control" placeholder="price" value="<?php echo $row['rent']; ?>">
      </div>   
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text">@</span>
        </div>
        <input type="text" style="width:300px;margin: 0 auto" name="detail" class="form-control" placeholder="bike_detail" value="<?php echo $row['bike_detail']; ?>">
      </div>
      <br>
      <br>
      <center><button type="submit" name="btn" style="width:200px;margin: 0 auto" class="btn btn-dark">Upload</button></center>
      <br>
      <br>
    </div>
  </div>
  </div>
</form>
</body>
</html>

<?php
if (isset($_POST['btn'])) {
  // Retrieve form data
  $t2 = isset($_POST['nme']) ? $_POST['nme'] : '';
  $t3 = isset($_POST['price']) ? $_POST['price'] : '';
  $t4 = isset($_POST['detail']) ? $_POST['detail'] : '';


  if (!empty($_FILES['image']['tmp_name'])) {
    // Handle image upload
    $image = $_FILES['image']['tmp_name']; // Path to the temporary uploaded file
    $imageData = file_get_contents($image); // Retrieve the image data
  } else {
    // No new image uploaded, use the existing image data
    $imageData = $row['image'];
  }

  $qry = mysqli_prepare($connect, "UPDATE bikes SET image = ?, name = ?, rent = ?,bike_detail = ? WHERE id = ?");
  mysqli_stmt_bind_param($qry, 'sssss', $imageData, $t2, $t3,$t4,$id);
  

  if (mysqli_stmt_execute($qry)) {
	  
	    ?>
<script language="javascript">
alert("Updated Successfully");
window.location.href="bike_edit_1.php";
</script>
<?php

  } else {
    echo "Error: " . mysqli_error($connect);
  }

  mysqli_stmt_close($qry);
}
?>
