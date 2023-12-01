<?php
session_start();
if (isset($_POST['btn']))	
	{
    $clickedId = $_POST['id'];
    echo "Clicked ID: " . $clickedId;
	$_SESSION['id']=$clickedId;
	header("location:bike_edit_2.php");
}

if (isset($_POST['delete']))	
	{
    $clickedId = $_POST['id'];
	$connect = mysqli_connect("localhost", "root", "", "bikerent");
	$query=mysqli_query($connect,"delete from bikes where id='$clickedId'");
}

?>
<html>
<head>
  
  <title>bike_edit_1</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
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
      height: 100%;
      object-fit: cover;
    }
  </style>
</head>
<body>
<?php
include("admin_nav.php");
?>

<div class="container">
  <h2>Bike List</h2>

  <div class="row">
    <?php
    //$em = $_SESSION['uname'];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "bikerent";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    $query = "SELECT * FROM bikes";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $imageData = $row['image'];
        ?>
        <div class="col-lg-3 col-md-6 mb-4">
          <div class="card">
            <div class="card-image-container">
              <img src="data:image/jpeg;base64,<?= base64_encode($imageData) ?>" alt="Card image">
            </div>
            <div class="card-body">
              <h4 class="card-title"><?= $row['name'] ?></h4>
              <p class="card-text">Price: <?= $row['rent'] ?>$</p>
			  <form method='POST'><input type="hidden" name="id" value="<?php echo  $row['id'] ?> ">
			  <button type="submit" name="btn"	>Edit</button>
			  <button type="submit" name="delete" >delete </button></form>

            </div>
          </div>
        </div>
     <?php
      }
    }
    $conn->close();
    ?>
  </div>
</div>

</body>
</html>
