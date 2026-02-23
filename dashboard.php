<?php
session_start();
if(!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}else {
    echo "Welcome, " . $_SESSION['user_name']. "! You are logged in as " . $_SESSION['user_role'] . ". <a href='logout.php'>Logout</a>";
}
?>