
<?php

@include 'config.php';
@include 'sessionadmin.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <!-- Include Bootstrap Icons CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap-icons/1.6.0/bootstrap-icons.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/admin.css" href="css/style.css">
</head>
<body>
    <!-- Side Navigation -->
    <nav class="side-nav">
        <ul>
            <li><a href="admin_page.php" class="btn"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
            <li><a href="addquestion.php" class="btn"><i class="bi bi-plus-circle-fill"></i> Add Questions</a></li>
            <li><a href="viewusers.php" class="btn"><i class="fas fa-users"></i> View Users</a></li>
            <li><a href="studentreport.php" class="btn"><i class="bi bi-person-plus-fill"></i></i>Student Report</a></li>
            <!-- <li><a href="#"><i class="fas fa-sign-out-alt"></i> Logout</a></li> -->
            <li><a href="logout.php" class="btn"><i class="fas fa-sign-out-alt"></i>logout</a></li>
        </ul>
    </nav>
    <!-- Main Content -->
    <main>
        <div class="container-fluid">
            <div class="container">
   <div class="content">
   <header>
      <h1>Welcome <span><?php echo $_SESSION['admin_name'] ?></span></h1>
   </header>
</div>
        </div>
    </div>
    </main>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>