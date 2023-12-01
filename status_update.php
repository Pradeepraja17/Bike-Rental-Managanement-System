<?php
session_start();
$conn= mysqli_connect("localhost", "root", "", "bikerent");
if (isset($_POST['btn'])) {
  $clickedId = $_POST['id'];
  $_SESSION['id'] = $clickedId;

  // Retrieve the status of the clicked bike
  $query2 = "SELECT status FROM bikes WHERE id = '$clickedId'";
  $result2 = $conn->query($query2);
  if ($result2->num_rows > 0) {
    $row2 = $result2->fetch_assoc();
    $currentStatus = $row2['status'];

    // Toggle the status between 0 and 1
    $newStatus = ($currentStatus == 0) ? 1 : 0;

    // Update the status in the database
    $query3 = "UPDATE bikes SET status = $newStatus WHERE id = '$clickedId'";
    if ($conn->query($query3) === TRUE) {
      echo "Status updated successfully..!";
      //die("<script>alert('Status updated successfully')</script>");
    } else {
      echo "Error updating status: " . $conn->error;
    }
  }
}

// Function to get the button text based on the status
function getButtonText($status) {
  return ($status == 0) ? "Change to Available" : "Change to Unavailable";
}

?>

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
      padding-top: 100%;
      /* Set the aspect ratio as per your preference (e.g., 1:1 for square) */
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
  <?php include("admin_nav.php"); ?>

  <div class="container">
    <h2>Status update</h2>

    <div class="row">
      <?php
      $query = "SELECT * FROM bikes";
      $result = $conn->query($query);

      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          $imageData = $row['image'];
          $status = $row['status'];
      ?>
          <div class="col-lg-3 col-md-6 mb-4">
            <div class="card">
              <div class="card-image-container">
                <img src="data:image/jpeg;base64,<?= base64_encode($imageData) ?>" alt="Card image">
              </div>
              <div class="card-body">
                <h4 class="card-title"><?= $row['name'] ?></h4>
                <p class="card-text">Rent: <?= $row['rent'] ?>$</p>
                <form method="POST">
                  <input type="hidden" name="id" value="<?= $row['id'] ?>">
                  <button type="submit" name="btn" class="btn btn-primary">
                    <?= getButtonText($status) ?>
                  </button>
                </form>
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
