<?php
session_start();

if(!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Dashboard</title>

<style>
body{
    font-family: Arial;
    background:#f4f6f9;
}

.container{
    width:500px;
    margin:80px auto;
    background:white;
    padding:30px;
    border-radius:8px;
    box-shadow:0 4px 10px rgba(0,0,0,0.1);
    text-align:center;
}

h2{
    margin-bottom:10px;
}

.role{
    color:#666;
    margin-bottom:25px;
}

a{
    display:block;
    margin:10px 0;
    padding:12px;
    background:#007bff;
    color:white;
    text-decoration:none;
    border-radius:6px;
}

a:hover{
    background:#0056b3;
}

.logout{
    background:#dc3545;
}

.logout:hover{
    background:#b02a37;
}
</style>

</head>

<body>

<div class="container">

<h2>Welcome, <?php echo htmlspecialchars($_SESSION['user_name']); ?> 👋</h2>

<div class="role">
You are logged in as: <?php echo htmlspecialchars($_SESSION['user_role']); ?>
</div>

<a href="add_category.php">Add Category</a>
<a href="insert_post.php">Add New Post</a>
<a href="comments.php">Manage Comments</a>
<a href="logout.php" class="logout">Logout</a>

</div>

</body>
</html>