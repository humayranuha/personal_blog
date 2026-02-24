<?php
session_start();
include 'db.php';

/*Check login*/
if (!isset($_SESSION['user_role'])) {
    header("Location: login.php");
    exit();
}

/* Allow only author */
if ($_SESSION['user_role'] != 'author') {
    header("Location: dashboard.php");
    exit();
}

$author_id = $_SESSION['user_id'];

/* Fetch categories for dropdown */
$cat_query = "SELECT id, name FROM categories";
$cat_result = mysqli_query($conn, $cat_query);

/* Handle form submission */
if (isset($_POST['submit'])) {

    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $content = mysqli_real_escape_string($conn, $_POST['content']);
    $category_id = (int) $_POST['category_id'];

    $image_name = time() . "_" . basename($_FILES['image']['name']);
    $tmp_name = $_FILES['image']['tmp_name'];
    $upload_path = "uploads/" . $image_name;

    if (move_uploaded_file($tmp_name, $upload_path)) {

        $sql = "INSERT INTO posts 
                (title, content, image, author_id, category_id) 
                VALUES 
                ('$title', '$content', '$image_name', $author_id, $category_id)";

        if (mysqli_query($conn, $sql)) {
            $success = "Post added successfully!";
        } else {
            $error = "Database Error: " . mysqli_error($conn);
        }

    } else {
        $error = "Image upload failed.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post Insertion</title>
    <style>
        body {
            font-family: Arial;
            background: #f4f6f8;
            margin: 0;
        }

        .navbar {
            background: #333;
            padding: 15px;
            display: flex;
            justify-content: space-between;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            padding: 6px 12px;
            border-radius: 4px;
        }

        .dashboard-btn {
            background: #28a745;
        }

        .logout-btn {
            background: #dc3545;
        }

        .container {
            width: 500px;
            background: white;
            margin: 50px auto;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        input, textarea, select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }

        button {
            width: 100%;
            padding: 10px;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background: #0056b3;
        }

        .success {
            color: green;
            text-align: center;
        }

        .error {
            color: red;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <a href="dashboard.php" class="dashboard-btn">Dashboard</a>
        <a href="logout.php" class="logout-btn">Logout</a>
    </div>
    <div class="container">
        <h2>Create Post</h2>

        <?php if(isset($success)) {
            echo "<div class='success'>$success</div>";
        }
        if(isset($error)) {
            echo "<div class='error'>$error</div>";
        }
        ?>          

        <form method="POST" enctype="multipart/form-data">
            <input type="text" name="title" placeholder="Post Title" required><br>
            <textarea name="content" rows="6" placeholder="Post Content" required></textarea><br>

            <select name="category_id" required>
                <option value="">Select Category</option>

                <?php while ($row = mysqli_fetch_assoc($cat_result)) { ?>
                <option value="<?php echo $row['id']; ?>">
                <?php echo $row['name']; ?>
                </option>
                <?php } ?>
            </select>

            <input type="file" name="image">
            <button type="submit" name="submit">Publish Post</button>
        </form>
    </div>
</body>
</html>