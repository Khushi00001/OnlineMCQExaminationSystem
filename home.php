<?php

@include 'config.php';

session_start();

// if(!isset($_SESSION['admin_name'])){
//    header('location:login_form.php');
// }
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Home page</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
	<title>Home Page</title>
</head>
<body>
	<div class="container">

   <div class="content">
      <h1>Welcome to the Login Page</h1><br>
      <a href="admin_login_form.php" class="btn">Admin login</a>
      <a href="register_form.php" class="btn">Attend Tests</a>
   </div>

</div>
</body>
</html>