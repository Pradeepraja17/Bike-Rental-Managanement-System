<!DOCTYPE html>
<html>
<head>
  <title>Booking detail</title>
  <div style="background-color:#ffd59e">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  
  <style>
    table {
      width: 100%;
      border-collapse: collapse;
    }

    th, td {
      padding: 8px;
      text-align: center;
      border-bottom: 1px solid #ddd;
    }

    th {
      background-color: #f2f2f2;
    }

    tr:hover {
      background-color: #f5f5f5;
    }

    button {
      padding: 6px 12px;
      background-color: #4CAF50;
      color: white;
      border: none;
      cursor: pointer;
      border-radius: 4px;
    }

    button:hover {
      background-color: #45a049;
    }
    div1{
        background-color: red;
    }

  </style>
</head>

<body>
<?php
   include("admin_nav.php");
 ?>
    <h1>Booking Details</h1>
    <?php
    // Create a MySQLi connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "bikerent";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch data where status = 0
    $sql = "SELECT * FROM bookings WHERE status = 0";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table border='0'>
                <tr>
                  <th>Name</th>
                  <th>Mobile</th>
                  <th>Address</th>
                  <th>Aadhar</th>
                  <th>Driving Licence</th>
                  <th>Book From</th>
                  <th>Book To</th>
                  <th>Bike ID</th>
                  <th colspan='2'>Action</th>
                </tr>";

        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["name"] . "</td>";
            echo "<td>" . $row["mobile"] . "</td>";
            echo "<td>" . $row["address"] . "</td>";
            echo "<td>" . $row["aadhar"] . "</td>";
            echo "<td>" . $row["driving_licence"] . "</td>";
            echo "<td>" . $row["book_from"] . "</td>";
            echo "<td>" . $row["book_to"] . "</td>";
            echo "<td>" . $row["bike_id"] . "</td>";

            // Add accept and reject buttons
            echo "<td><form method='POST' action='book_accept.php?ret=".$row['id']."' onsubmit='return submitForm(this);'>
            <button onclick='acceptBooking(" . $row["id"] . ")'>Accept</button></div>
            </form>";
            echo "</td>";
            echo "<td><form method='POST' action='book_reject.php?ret=".$row['id']."' onsubmit='return submitForm(this);'>
            <button class=div1 onclick='rejectBooking(" . $row["id"] . ")' style='background-color: red;'>Reject</button></div>
            </form>";
            echo "</td>";            
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "No bookings found.";
    }

    $conn->close();
    ?>
    

  
  <script>
    function acceptBooking(bookingId) {
      // Implement your accept booking logic here
      console.log("Accepting booking with ID: " + bookingId);
 
    }

    function rejectBooking(bookingId) {
      // Implement your reject booking logic here
      console.log("Rejecting booking with ID: " + bookingId);
    
    }
  </script>
</body>
</html>
