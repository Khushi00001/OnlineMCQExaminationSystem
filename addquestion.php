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
   <link rel="stylesheet" href="css/admin.css">
   <link rel="stylesheet" href="css/style.css">
   <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
   <link rel="stylesheet" href="css/admin.css">
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
   <!-- Include Bootstrap Icons CSS -->
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap-icons/1.6.0/bootstrap-icons.min.css">
   <!-- Font Awesome -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
</head>
<body>
   <nav class="side-nav">
    <ul>
        <li><a href="admin_page.php" class="btn"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
        <li><a href="addquestion.php" class="btn"><i class="bi bi-plus-circle-fill"></i> Add Questions</a></li>
        <li><a href="viewusers.php" class="btn"><i class="fas fa-users"></i> View Users</a></li>
        <li><a href="premiumstudent.php" class="btn"><i class="bi bi-person-plus-fill"></i> Premium Student</a></li>
        <!-- <li><a href="#"><i class="fas fa-sign-out-alt"></i> Logout</a></li> -->
        <li><a href="logout.php" class="btn"><i class="fas fa-sign-out-alt"></i>logout</a></li>
    </ul>
</nav>
<div class="container">
   <div class="content">
      <span style="color: #990000; position: absolute; top: 10px; right: 10px;"><?php echo $_SESSION['admin_name'] ?></span><br>
      <span style="color: #990000; position: absolute; top: 30px; right: 10px;"><?php echo $_SESSION['admin_email'] ?></span>
      <a href="cmatadd.php" class="btn">CMAT</a>
      <a href="gmatadd.php" class="btn">GMAT</a>
      <a href="loksewaadd.php" class="btn">LokSewa</a>
   </div>
</div>

</body>
</html>


