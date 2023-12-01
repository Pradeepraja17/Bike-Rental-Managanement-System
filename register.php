<!DOCTYPE html>
<html>
<head>
<style >
    body
    {
      
          background: url('img/fon1.jpg');
          background-size: cover;

        }
        form{
          background-color: rgba(255, 255, 255, .7);
      padding: 40px;
      color: #333;
      border-radius: 10px;
      box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.8);
      width: 390px;
      margin: 10px auto;
        }
        h1{
          font-weight: bold;
          padding-bottom: 40px;
        }
  </style>
  <title>Bike Rental Registration</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>  
<body>
<?php
   include("nav.php");
   ?>
  <center>
    <br><br><br><br>
    <div class="container_p"  style="color:black" >
    
    <form action="register.php" method="POST">
    <center><h1><strong style="color:Black">Register</h1></strong></center>
      <input type="text" name="un" placeholder="User Name" required><br><br>
      <input type="text" name="em" placeholder="email" required><br><br>
      <input type="password" name="psw" placeholder="Password" required><br><br>
      <input type="text" name="phno" placeholder="mobile number" required><br><br> 
      <div>
    
      <!--<label for="choices"><strong>Gender:</strong></label>-->
      
      
      <center><button name='btn' class="btn btn-primary"  type="submit">Register</button></center>
    </form>
     </div></center>  
</div>
</body>
</html>
<?php
  // Check if the form is submitted
  if(isset($_POST['btn'])) {
    // Retrieve form data
    $username = $_POST['un'];
    $email = $_POST['em'];

    $password = $_POST['psw'];
    $phone = $_POST['phno'];
    
    // Database connection settings
    $servername = "localhost";
    $dbname = "bikerent";
    $dbusername = "root";
    $dbpassword = "";

    // Create a connection
    $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute the SQL query
    $sql = "INSERT INTO user (name,email, psw, phone) VALUES ('$username','$email', '$password', '$phone')";
    
    if ($conn->query($sql) === TRUE) {
     die("<script>alert('Register Suessfully')</script>");
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
      die("<script>alert('Register failled')</script>");
    }

    // Close the database connection
    $conn->close();
  }
?>
