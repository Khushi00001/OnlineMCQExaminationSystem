<?php
if (!isset($_SESSION['user_name'])) {
    header("Location: login_form.php");
    exit();
}
?>