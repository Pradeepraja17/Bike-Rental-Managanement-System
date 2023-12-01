<!DOCTYPE html>
<html>
<head>
<style>
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
        label{
          margin-top: 20px;
          font-size: 15px;
        }
  </style>
  <title>Admin Login</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
  <header>
    <?php include("nav.php"); ?>
  </header>
  <br><br><br>
  <div class="container mt-3" style="color:white; width: 300px;">
    


    <form method="POST" name="form1" action="">
    <center><h2 class="text-danger" style="color: Black;"><strong>Admin Login</strong></h2></center>
      <div class="mb-3 mt-3">
        <label for="email">Email:</label>
        <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
      </div>
      <div class="mb-3">
        <label for="pwd">Password:</label>
        <input type="password" class="form-control" name="pswd" id="pwd" placeholder="Enter password"><br>
      </div>
      <center><button type="submit" name="btn" class="btn btn-primary">Submit</button></center>
    </form>
  </div>

  <?php
  session_start(); // Start a session

  // Check if the login form is submitted
  if(isset($_POST['btn'])) {
    // Retrieve form data
    $email = $_POST['email'];
    $password = $_POST['pswd'];

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
    $sql = "SELECT * FROM admin WHERE emaill='$email' AND psw='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      // Login successful, set session variables
      $_SESSION['admin'] = true;

      // Redirect to the admin dashboard or any other admin page
      header("Location: add_bike.php");
      exit();
    } else {
      echo "Invalid email or password.";
    }

    // Close the database connection
    $conn->close();
  }
  ?>
</body>
</html>
