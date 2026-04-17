<?php

      require_once 'db.php';

      $title = "";
      $content = "";
      $error = "";
      $success = "";

      if($_SERVER["REQUEST_METHOD"] == "POST"){
          $title = trim($_POST['title']);
          $content = trim($_POST['content']);

          if(empty($title) || empty($content)){
              $error = "Pease fill all fields";
          }
          else{

              try {
                    $stmt = $pdo->prepare('INSERT INTO posts (title, content) VALUES (:title, :content)');
                    $stmt->execute([
                        ':title' => $title,
                        ':content' => $content
                    ]);

                    $success = "You have successfully created a post";
                    $title = "";
                    $content = "";


              } catch (PDOException $e) {
                  $error = "Something went wrong. Please try again";
              }

          }
      }

 ?>

 <!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Create Post</title>
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
    <h2 class="page-title">Create New Post</h2>

    <?php if ($error): ?>
        <div class="msg-error"><?php echo $error; ?></div>
    <?php endif; ?>

    <?php if ($success): ?>
        <div class="msg-success"><?php echo $success; ?></div>
    <?php endif; ?>

    <div class="form-card">
        <form action="create.php" method="POST">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" id="title"
                       value="<?php echo $title; ?>" placeholder="Enter post title">
            </div>
            <div class="form-group">
                <label for="content">Content</label>
                <textarea name="content" id="content"
                          rows="10"><?php echo $content; ?></textarea>
            </div>
            <button type="submit" class="btn">Publish Post</button>
        </form>
    </div>
</div>
 </body>
 </html>
