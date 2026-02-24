<?php
include 'db.php';

$post = null;
$comments = [];

/* Handle Post Selection */
if(isset($_POST['select_post'])){
    $post_id = (int) $_POST['post_id'];

    /* Fetch selected post */
    $post_query = "SELECT * FROM posts WHERE id=$post_id";
    $post_result = mysqli_query($conn,$post_query);
    $post = mysqli_fetch_assoc($post_result);

    /* Fetch comments */
    $comment_query = "SELECT * FROM comments WHERE post_id=$post_id ORDER BY id DESC";
    $comments = mysqli_query($conn,$comment_query);
}

/* Handle Comment Submission */
if(isset($_POST['submit_comment'])){

    $post_id = (int) $_POST['post_id'];
    $name = mysqli_real_escape_string($conn,$_POST['name']);
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $comment = mysqli_real_escape_string($conn,$_POST['comment']);

    if(!empty($name) && !empty($email) && !empty($comment)){

        $insert = "INSERT INTO comments(post_id,user_name,email,comment)
                   VALUES($post_id,'$name','$email','$comment')";

        if(mysqli_query($conn,$insert)){
            echo "<script>alert('Comment added successfully');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Comment System</title>

<style>
body{
    font-family: Arial;
    background:#f4f6f9;
}

.container{
    width:500px;
    margin:50px auto;
    background:white;
    padding:25px;
    border-radius:8px;
    box-shadow:0 4px 10px rgba(0,0,0,0.1);
}

input,textarea,select{
    width:100%;
    padding:10px;
    margin-bottom:15px;
}

button{
    width:100%;
    padding:10px;
    background:#007bff;
    color:white;
    border:none;
    cursor:pointer;
}

.comment-box{
    background:#f8f9fa;
    padding:12px;
    margin-bottom:10px;
    border-radius:6px;
}
</style>

</head>

<body>

<div class="container">

<h2>Select Post</h2>

<!-- Post Selection Form -->
<form method="POST">
    <select name="post_id" required>
        <option value="">Select Post</option>

        <?php
        $posts = mysqli_query($conn,"SELECT id,title FROM posts ORDER BY id DESC");
        while($row = mysqli_fetch_assoc($posts)){
            echo "<option value='{$row['id']}'>".
                 htmlspecialchars($row['title']).
                 "</option>";
        }
        ?>

    </select>

    <button type="submit" name="select_post">Load Post</button>
</form>

<hr>

<?php if($post){ ?>

<h2><?php echo htmlspecialchars($post['title']); ?></h2>
<p><?php echo htmlspecialchars($post['content']); ?></p>

<hr>

<h3>Leave Comment</h3>

<form method="POST">
    <input type="hidden" name="post_id" 
           value="<?php echo $post['id']; ?>">

    <input type="text" name="name" placeholder="Your Name" required>
    <input type="email" name="email" placeholder="Your Email" required>
    <textarea name="comment" placeholder="Write comment..." required></textarea>

    <button type="submit" name="submit_comment">
        Post Comment
    </button>
</form>

<hr>

<h3>All Comments</h3>

<?php while($row = mysqli_fetch_assoc($comments)) { ?>

<div class="comment-box">
<h4><?php echo htmlspecialchars($row['user_name']); ?></h4>
<small><?php echo htmlspecialchars($row['email']); ?></small>
<p><?php echo htmlspecialchars($row['comment']); ?></p>
</div>

<?php } ?>

<?php } ?>

</div>

</body>
</html>