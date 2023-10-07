<?php
@include 'config.php';
session_start();

// Check if the user is not logged in
if (!isset($_SESSION['user_name'])) {
    // Redirect to the login page
    header("Location: login_form.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Choose Exam</title>
   <link rel="stylesheet" href="css/style.css">
</head>
<body>
   
<div class="container">
   <div class="content">
      <a href="level1view.php" class="btn">Level One</a>
      <a href="level2view.php" class="btn">Level Two</a>
      <a href="level3view.php" class="btn">Level Three</a>
      <a href="level4view.php" class="btn">Level Four</a>
      <a href="level5view.php" class="btn">Level Five</a>
   </div>
</div>

</body>
</html>
