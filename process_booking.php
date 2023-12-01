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
    container {
      display: flex;
      justify-content: center;
      align-items: center;
      padding-top:20px ;
      padding-bottom: 40px;
  
     }

    form {
      max-width: 600px;
      padding: 20px;
      border: 1px solid #ccc;
      border-radius: 5px;
      background-color: #f2f2f2;
    }

    form label {
      font-weight: bold;
    }

    form input[type="text"],
    form input[type="tel"],
    form textarea,
    form input[type="date"] {
      width: 100%;
      padding: 10px;
      margin-bottom: 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
    }

    form input[type="submit"] {
      width: 100%;
      background-color: #4CAF50;
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    form input[type="submit"]:hover {
      background-color: black;
    }
  </style>
</head>

<?php
   include("user_nav.php");
   ?>

<body>
  <container>
  <form method="POST" action=" ">
    <h1 style="text-align: center;">Booking Form</h1>
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required>

    <label for="mobile">Mobile:</label>
    <input type="tel" id="mobile" name="mobile" pattern="[0-9]{10}" required>

    <label for="address">Address:</label>
    <textarea id="address" name="address" required></textarea>

    <label for="aadhar">Aadhar Card No:</label>
    <input type="text" id="aadhar" name="aadhar" required>

    <label for="drivingLicence">Driving Licence No:</label>
    <input type="text" id="drivingLicence" name="drivingLicence" required>

    <label for="bookFrom">Book From:</label>
    <input type="date" id="bookFrom" name="bookFrom" required>

    <label for="bookTo">Book To:</label>
    <input type="date" id="bookTo" name="bookTo" required>

    <input type="submit" value="Submit">
  </form>
  </container>
</body> 
</html>

<?php
session_start();
$mail= $_SESSION['username']; 
if (isset($_POST['name'])&& isset($_POST['mobile']) && isset($_POST['aadhar'])) {
$bid=$_GET['bid'];
// Get the form data
$name = $_POST['name'];
$mobile = $_POST['mobile'];
$address = $_POST['address'];
$aadhar = $_POST['aadhar'];
$drivingLicence = $_POST['drivingLicence'];
$bookFrom = $_POST['bookFrom'];
$bookTo = $_POST['bookTo'];

// Create a MySQLi connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bikerent";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and execute the SQL statement to insert the data
      // Insert the data into the database
      $tmpin = "INSERT INTO bookings (name, mobile, address, aadhar, driving_licence, book_from, book_to,bike_id,status,email) VALUES('$name', '$mobile', '$address', '$aadhar','$drivingLicence', '$bookFrom', '$bookTo','$bid','0','$mail')";
      $co = mysqli_query($conn, $tmpin);
      if ($co) {
          die("<script>alert('Waiting for Approvel.')</script>");
      } else {
          die("<script>alert('Booking Failed.')</script>");
      }


$conn->close();
}
?>
