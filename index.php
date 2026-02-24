<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>My Blog</title>

<style>
body{
    font-family: Arial;
    text-align:center;
    background:#f4f6f9;
    padding-top:80px;
}

a{
    display:block;
    width:220px;
    margin:15px auto;
    padding:12px;
    background:#007bff;
    color:white;
    text-decoration:none;
    border-radius:6px;
}

a:hover{
    background:#0056b3;
}
</style>

</head>

<body>

<h1>Welcome To My Personal Blog</h1>

<a href="register.php">Register</a>
<a href="login.php">Login</a>
<a href="dashboard.php">Dashboard</a>

</body>
</html>