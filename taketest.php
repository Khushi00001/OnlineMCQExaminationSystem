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
   <title>user page</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
   <!-- Include Bootstrap Icons CSS -->
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap-icons/1.6.0/bootstrap-icons.min.css">
   <!-- Font Awesome -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
   <!-- Custom CSS -->
   <link rel="stylesheet" href="css/admin.css" href="css/style.css">

   <style>
       .welcome-session {
      position: absolute;
      top: 20px;
      left: 40px;
      color: white; 
   }
      }
   </style>
</head>
<body>
   <nav class="side-nav">
          
      <ul>

         <li><a href="user_page.php" class="btn"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
         <li><a href="taketest.php" class="btn"><i class="bi bi-plus-circle-fill"></i> Take Tests</a></li>
         <!-- <li><a href="viewusers.php" class="btn"><i class="fas fa-users"></i> View Users</a></li>
         <li><a href="#" class="btn"><i class="fas fa-cog"></i> Settings</a></li> -->
         <!-- <li><a href="#"><i class="fas fa-sign-out-alt"></i> Logout</a></li> -->
         <li><a href="logout.php" class="btn"><i class="fas fa-sign-out-alt"></i>logout</a></li>
      </ul>
   </nav>
  
   <div class="container">
      <div class="welcome-session">
        
         <h5> <?php echo $_SESSION['user_name']; ?></h5>
      </div>
      <div class="content">
         <a href="cmatview.php" class="btn">CMAT</a>
         <a href="gmatview.php" class="btn">GMAT</a>
         <a href="loksewaview.php" class="btn">LokSewa</a>
      </div>
   </div>

</body>
</html>
