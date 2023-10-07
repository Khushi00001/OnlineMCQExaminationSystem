<?php
@include 'config.php';

// session_start();
// if (!isset($_SESSION['user_id'])) {
//     header("Location: home.php");
//     exit();
// }
$error = array(); // Initialize an empty array to store errors

if(isset($_POST['submit'])){
   // Check if the email exists in the database
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $select = "SELECT * FROM user_form WHERE email = '$email'";
   $result = mysqli_query($conn, $select);

   if (mysqli_num_rows($result) > 0) {
      // Email exists, perform the update
      $name = mysqli_real_escape_string($conn, $_POST['name']);
      $checks = $_POST['checks'];

      $update = "UPDATE user_form SET name='$name', checks='$checks' WHERE email = '$email'";
      mysqli_query($conn, $update);

      header('Location: admin_page.php');
      exit;
   } else {
      // Email doesn't exist, handle the error
      $error[] = "Email not found in the database.";
   }
} else {
   // Retrieve the name and email of the student to be edited
   if (isset($_GET['id'])) {
      $studentId = $_GET['id'];

      $select = "SELECT * FROM user_form WHERE email = '$studentId'";
      $result = mysqli_query($conn, $select);

      if (mysqli_num_rows($result) > 0) {
         $studentData = mysqli_fetch_assoc($result);
         $name = $studentData['name'];
         $email = $studentData['email'];
      } else {
         $error[] = "Student not found in the database.";
      }
   } else {
      $error[] = "Invalid student ID.";
   }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Premium Student Login Form</title>
   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
   <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
   <link rel="stylesheet" href="css/admin.css">
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap-icons/1.6.0/bootstrap-icons.min.css">
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
      <li><a href="logout.php" class="btn"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
   </ul>
</nav>

<div class="form-container">
   <form action="" method="post">
      <h3>Edit Premium Student</h3>
      <?php
      if(isset($error)){
         foreach($error as $errorMsg){
            echo '<span class="error-msg">'.$errorMsg.'</span>';
         }
      }
      ?>
      <input type="text" name="name" required placeholder="Enter the name" value="<?php echo isset($name) ? $name : ''; ?>">
      <input type="email" name="email" required placeholder="Enter the email" value="<?php echo isset($email) ? $email : ''; ?>">
      <select name="checks">
         <option value="student">Student</option>
         <option value="pstudent">Premium Student</option>
      </select>
      <input type="submit" name="submit" value="Edit" class="form-btn">
   </form>
</div>
</body>
</html>