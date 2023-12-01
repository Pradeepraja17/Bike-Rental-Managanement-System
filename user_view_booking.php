<!DOCTYPE html>
<html>
<head>
  <title>Booking detail</title>
  <div style="background-color: #80d9f6;">
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
   include("user_nav.php");
 ?>
    <h1>Booking Details</h1>
    <?php

    session_start();
    $un= $_SESSION['username']; 
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
    $sql = "SELECT * FROM bookings WHERE email='$un'";
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
                  <th>Status</th>
                  <th></th>
                </tr>";

        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            if($row['status']=="0")
            {
                $st="Pending";
            }
            elseif($row['status']=="1")
            {
                $st="Approved";
            }
            elseif($row['status']=="2")
            {
                $st="Rejected";
            }
            echo "<tr>";
            echo "<td>" . $row["name"] . "</td>";
            echo "<td>" . $row["mobile"] . "</td>";
            echo "<td>" . $row["address"] . "</td>";
            echo "<td>" . $row["aadhar"] . "</td>";
            echo "<td>" . $row["driving_licence"] . "</td>";
            echo "<td>" . $row["book_from"] . "</td>";
            echo "<td>" . $row["book_to"] . "</td>";
            echo "<td>" . $row["bike_id"] . "</td>";   
            echo "<td>" . $st . "</td>";    
            echo "<td><form method='POST' action='book_del.php?ret=".$row['id']."' onsubmit='return submitForm(this);'>
            <button class=div1 onclick='rejectBooking(" . $row["id"] . ")' style='background-color: red;'>Cancel</button></div>
            </form>";   
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
