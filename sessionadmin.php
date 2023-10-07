<?php
session_start();
$_SESSION['admin_name'] = "Admin";
$_SESSION['admin_email'] = "admin@gmail.com";
// if (isset($_SESSION['admin_name'])) {
//     $adminName = $_SESSION['admin_name'];
// } else {
//     header("Location: admin_login_form.php");
//     exit();
// }
if(!isset($_SESSION['admin_name'])){
   header('location:admin_login_form.php');
   exit();
}
?>