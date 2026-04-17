<?php

    require_once 'db.php';

    $post = [];
    $error = "";


    try {
          if (isset($_GET['id'])) {
                $post_id = $_GET['id'];

                $stmt = $pdo->prepare('SELECT * FROM posts WHERE id = :post_id');

                $stmt->execute([ ':post_id' => $post_id ]);

                $post = $stmt->fetch(PDO::FETCH_ASSOC);

                if (!$post) {
                        header("Location: index.php");
                        exit();
                  }

          } else {
                $error = "No Post here";
          }


    } catch (PDOException $e) {
        die("Something went wrong. Please try again" . $e->getMessage());
    }


 ?>

 <!DOCTYPE html>
 <html lang="en">
 <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="style.css">
      <title>Post</title>
 </head>
 <body>
     <header>
    <h1>My Blog</h1>
    <nav>
        <a href="index.php">Home</a>
        <a href="create.php">New Post</a>
    </nav>
</header>

<div class="container">
    <a href="index.php" class="back-link">&larr; Back to all posts</a>

    <?php if ($error): ?>
        <div class="msg-error"><?php echo htmlspecialchars($error); ?></div>
    <?php else: ?>
        <div class="post-full">
            <h1><?php echo htmlspecialchars($post['title']); ?></h1>
            <div class="meta">Posted on <?php echo htmlspecialchars($post['created_at']); ?></div>
            <div class="content"><?php echo nl2br(htmlspecialchars($post['content'])); ?></div>
        </div>
    <?php endif; ?>
</div>
 </body>
 </html>
