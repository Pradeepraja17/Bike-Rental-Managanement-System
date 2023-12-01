<html>
    <head>
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
include("user_nav.php");
?>

<div class="container">
  <h2>Bike list</h2>

  <div class="row">
    <?php
    session_start();
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
              <p class="card-text">rent: <?= $row['rent'] ?>$</p>
              <p class="card-text">detail: <?= $row['bike_detail'] ?>$</p>
			 <?php
             if($row['status']==1)
             {
                echo "unavaiable";
             }
             else
             {
              $id = $row['id'] ;               
                echo "<form method='POST' action='process_booking.php?bid=" . $id . "' name='form1'>";                  
                 echo "<input type='hidden' name='id' value='$id'>";
                echo "<button type='submit' name='btn'>Rent</button>";
                echo'</form>';
             }

             ?>
              
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

<?php
if (isset($_POST['btn'])) 
{
  
  $clickedId = $_POST['id'];
  $_SESSION['id'] = $clickedId;
  echo $clickedId;?>

  <script language="javascript">
  window.location.href="process_booking.php";
  </script>
  <?php
  }
?>