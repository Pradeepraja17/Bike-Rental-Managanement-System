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
if(isset($_GET['ret']))
{
$bid=$_GET['ret'];
// Prepare and execute the SQL statement to insert the data
      // Insert the data into the database
      $tmpin = "UPDATE bookings SET status = 2 WHERE id =$bid";
      $co = mysqli_query($conn, $tmpin);
      if ($co) {
        header("location:admin_view_booking.php");
      } else {
          die("<script>alert('Booking Approvel Failed.')</script>");
      }
$conn->close();
    }
     ?>