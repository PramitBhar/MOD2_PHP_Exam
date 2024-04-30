<?php

session_start();
include 'ConnectionDb.php';
if ($_SERVER['REQUEST_METHOD']=="POST") {
  //It takes the first name of the user.
  $firstName = $_POST['fname'];
  //It takes the last name of the user.
  $lastName = $_POST['lname'];
  //It takes the email of the user.
  $email = $_POST['email'];
  //It takes the password of the user.
  $password = $_POST['password'];
  //It takes the unique id of the user.
  $id = uniqid();
  try {
    //Convert the password to hash password enhance the security
    $hashPass = password_hash($password, PASSWORD_DEFAULT);
    // Sql query to insert the user details to the database
    $sql = "INSERT INTO user_info(first_name,last_name,id,email,hash_password,user_type)
    VALUES('$firstName','$lastName','$id','$email','$hashPass','customer');";
    // New obj created.
    $dbConnect = new ConnectionDb();
    // Connect to the database.
    $dbConnect->connection();
    // Insert the user data to the database.
    $dbConnect->insertData($sql);
    // After registration user redirect to the login page.
    header("Location: /");
  }
  catch (PDOException $e) {
    echo "User registration is not successful". $e->getMessage();
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register Page</title>
  <link rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
  integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N"
  crossorigin="anonymous">
  <style>
    <?php include 'styles.css'?>
  </style>
</head>
<body>
  <div class="container">
    <div class = "card">
      <h1>Register Your Details</h1>
      <form method="post" action='/register'>
        <div class="input-group mb-3">
          <span class="input-group-text">First name</span>
          <input type="text" name="fname" class="form-control" maxlength="25" pattern="^[A-Za-z]+$" required>
        </div>
        <div class="input-group mb-3">
          <span class="input-group-text">Last name</span>
          <input type="text" name="lname" class="form-control" maxlength="25" pattern="^[A-Za-z]+$" required>
        </div>

        <div class="input-group mb-3">
          <span class="input-group-text">Email</span>
          <input type="email" name="email" class="form-control" pattern="^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$" required>
        </div>
        <div class="input-group mb-3">
          <span class="input-group-text">Password</span>
          <input type="password" name="password" class="form-control"
          maxlength="10" pattern="^[A-Za-z0-9-\#\$\.\%\&\*\@]+$" required>
        </div>
        <input type="submit" value="Register" class="btn btn-success">
      </form>
    </div>
  </div>
</body>
</html>
