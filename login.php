<!DOCTYPE html>
<html>
<head>
  <title>Bike login </title>
  
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
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
</head>
<header>
<?php
   include("nav.php");
   ?>
  </header>

<body>


  <center>
    <br><br><br><br><br>
     <p></p>
    <div class="container_p"  style="color:black">
  <br>
   
    <!--<img src="img\book.png" alt="Logo" style="float: center; max-width: 60px; height: 60px;">-->
    <form action="login.php" method="POST">
    <center><h1 style="color:black;">Login</h1></center>
      <input type="text" name="email" placeholder="email" required><br><br>
      
      <input type="password" name="password" placeholder="Password" required><br><br>
      
     <!-- <center><button style="background: #000000; color: #FFFFFF;" type="submit">Login</button></center>-->
      <center>
  <button style="background: #000000; color: #ffff11; font-size: 16px; font-weight: bold;" name="btn" type="submit">Login</button>
</center>
    </div></center>
    </form>
  </div>
</body>
</html>
<?php
  session_start(); // Start a session

  // Check if the login form is submitted
  if(isset($_POST['btn'])) {
    // Retrieve form data
    $username = $_POST['email'];
    $password = $_POST['password'];

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
    $sql = "SELECT * FROM user WHERE email='$username' AND psw='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      // Login successful, set session variables
      $_SESSION['username'] = $username;
      $_SESSION['mobile']=$row['phone'];

      // Redirect to the home page or any other page
      header("Location: user_bike.php");
      exit();
    } else {
      //echo "Invalid username or password.";
      die("<script>alert('Invalid username or password')</script>");
    }

    // Close the database connection
    $conn->close();
  }
?>
