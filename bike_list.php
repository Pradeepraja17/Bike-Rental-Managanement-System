<!DOCTYPE html>
<html>
<head>
  <title>Bike Rental - Bike List</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <h2>Bike List</h2>

  <table>
    <tr>
      <th>Bike Image</th>
      <th>Bike ID</th>
      <th>Bike Name</th>
      <th>Bike Details</th>
      <th>Rent Price</th>
      <th>Available</th>
    </tr>
    <?php
      // Connect to the database (replace with your own database credentials)
      $db = mysqli_connect('localhost', 'username', 'password', 'bikerent');

      // Fetch bike data from the database
      $query = "SELECT * FROM bikes";
      $result = mysqli_query($db, $query);

      // Loop through the bike data and display it in the table
      while ($row = mysqli_fetch_assoc($result)) {
        $bikeId = $row['bike_id'];
        $bikeName = $row['bike_name'];
        $bikeDetails = $row['bike_details'];
        $rentPrice = $row['rent_price'];
        $availability = $row['availability'];
        $bikeImage = $row['bike_image'];

        echo "<tr>";
        echo "<td><img src='$bikeImage' alt='Bike Image' class='bike-image'></td>";
        echo "<td>$bikeId</td>";
        echo "<td>$bikeName</td>";
        echo "<td>$bikeDetails</td>";
        echo "<td>$rentPrice</td>";
        echo "<td>$availability</td>";
        echo "</tr>";
      }

      // Close the database connection
      mysqli_close($db);
    ?>
  </table>
</body>
</html>
