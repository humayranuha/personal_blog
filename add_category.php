<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_role'])) {
    header("Location: login.php");
    exit();
} else {
    if ($_SESSION['user_role'] == 'admin') {
        if (isset($_POST['submit'])) {
            $name = $_POST['name'];

            $sql = "INSERT INTO categories (name) VALUES ('$name')";
            $result = mysqli_query($conn, $sql);

            if (!$result) {
                $error = "Error: " . mysqli_error($conn);
            } else {
                header ("Location: dashboard.php");
                exit();
            }
        }
    } else {
        header ("Location: dashboard.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category addition</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f6f8;
        }

        /* Top Navbar */
        .navbar {
            background: #333;
            padding: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar h3 {
            color: #fff;
            margin: 0;
        }

        .nav-links a {
            color: white;
            text-decoration: none;
            margin-left: 15px;
            padding: 6px 12px;
            border-radius: 4px;
        }

        .dashboard-btn {
            background: #28a745;
        }

        .logout-btn {
            background: #dc3545;
        }

        .nav-links a:hover {
            opacity: 0.8;
        }

        /* Form container */
        .form-container {
            background: #ffffff;
            padding: 30px;
            width: 350px;
            margin: 80px auto;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-container input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .form-container button {
            width: 100%;
            padding: 10px;
            background: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .form-container button:hover {
            background: #0056b3;
        }

        .error {
            color: red;
            text-align: center;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <div class="navbar">
        <h3>Admin Panel</h3>
        <div class="nav-links">
            <a href="dashboard.php" class="dashboard-btn">Dashboard</a>
            <a href="logout.php" class="logout-btn">Logout</a>
        </div>
     </div>

     <!-- Add category form -->
    <div class="form-container">
        <h2>Add new category</h2>

        <?php
        if(isset($error)) {
            echo "<div class='error'>$error</div>";
        }
        ?>

        <form method="POST" action="">
            <input type="text" name="name" placeholder="Category name" required>
            <button type="submit" name="submit">Add Category</button>
        </form>
    </div>
</body>
</html>