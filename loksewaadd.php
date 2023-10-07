<?php

@include 'config.php';
@include 'sessionadmin.php';
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
      <a href="level1.php" class="btn">Level One</a>
      <a href="level2.php" class="btn">Level Two</a>
      <a href="level3.php" class="btn">Level Three</a>
      <a href="level4.php" class="btn">Level Four</a>
      <a href="level5.php" class="btn">Level Five</a>
   </div>

</div>
<span style="color: #990000; position: absolute; top: 10px; right: 10px;"><?php echo $_SESSION['admin_name'] ?></span><br>
      <span style="color: #990000; position: absolute; top: 30px; right: 10px;"><?php echo $_SESSION['admin_email'] ?></span>

</body>
</html> 
 