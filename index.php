<?php

    require_once 'db.php';
    $posts = [];

    try {

      $stmt = $pdo->query('SELECT * FROM posts ORDER BY created_at DESC');
      $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {
         die("Connection failed: " . $e->getMessage());
    }


 ?>

 <!DOCTYPE html>
 <html lang="en">
 <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>HomePage</title>
  <link rel="stylesheet" href="style.css">
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
    <h2 class="page-title">Latest Posts</h2>

    <?php if (count($posts) > 0): ?>
        <?php foreach ($posts as $post): ?>
            <div class="post-card">
                <h2><a href="post.php?id=<?php echo $post['id']; ?>">
                    <?php echo htmlspecialchars($post['title']); ?>
                </a></h2>
                <div class="meta">Posted on <?php echo htmlspecialchars($post['created_at']); ?></div>
                <a href="delete.php?id=<?php echo $post['id']; ?>" class="delete-link">Delete</a>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p class="empty">No posts yet. <a href="create.php">Write the first one.</a></p>
    <?php endif; ?>
</div>
  
 </body>
 </html>
