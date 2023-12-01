<!DOCTYPE html>
<html>
<head>
  <title>Bike Rental list</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
  <?php
  include("user_nav.php");
  ?>
  <h2>Bike List</h2>

  <table>
    <tr>
      <th>Bike Image</th>
      <th>Bike ID</th>
      <th>Bike Name</th>
      <th>Bike Details</th>
      <th>Rent Price</th>
      <th>Availabile</th>
      <th>notAvailabile</th>
    </tr>
    <?php
      // Connect to the database (replace with your own database credentials)
      $db = mysqli_connect('localhost', 'root', '', 'bikerent');

      // Fetch bike data from the database
      $query = "SELECT * FROM bikes";
      $result = mysqli_query($db, $query);

      // Loop through the bike data and display it in the table
      while ($row = mysqli_fetch_assoc($result)) {
        $bikeId = $row['bike_id'];
        $bikeName = $row['bike_name'];
        $bikeDetails = $row['bike_details'];
        $rentPrice = $row['rent_price'];
        $availabile = $row['availabile'];
        $notavailabile = $row['notavailabile'];
        $bikeImage = $row['bike_image'];

        echo "<tr>";
        echo "<td><img src='$bikeImage' alt='Bike Image' class='bike-image'></td>";
        echo "<td>$bikeId</td>";
        echo "<td>$bikeName</td>";
        echo "<td>$bikeDetails</td>";
        echo "<td>$rentPrice</td>";
        echo "<td>$availabile</td>";
        echo "<td>$notavailabile</td>";

        echo "</tr>";
      }

      // Close the database connection
      mysqli_close($db);
    ?>
  </table>
</body>
</html>
