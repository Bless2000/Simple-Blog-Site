<?php
    require_once 'db.php';
    $error = "";

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $id      = $_POST['id'] ?? null;
        $title   = trim($_POST['title'] ?? '');
        $content = trim($_POST['content'] ?? '');

        if(!$id || !is_numeric($id)){
            header("Location: index.php");
            exit();
        }

        if(empty($title) || empty($content)){
            $error = "Please fill all fields";
        } else {
            try {
                $stmt = $pdo->prepare("UPDATE posts SET title = :title, content = :content WHERE id = :id");
                $stmt->execute([':title' => $title, ':content' => $content, ':id' => $id]);
                header("Location: post.php?id=" . $id);
                exit();
            } catch (PDOException $e) {
                $error = "Error updating post: " . $e->getMessage();
            }
        }

    } else {
        $id = $_GET['id'] ?? null;

        if(!$id || !is_numeric($id)){
            header("Location: index.php");
            exit();
        }

        try {
            $stmt = $pdo->prepare("SELECT * FROM posts WHERE id = :id");
            $stmt->execute([':id' => $id]);
            $post = $stmt->fetch(PDO::FETCH_ASSOC);

            if(!$post){
                header("Location: index.php");
                exit();
            }
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }

        $title   = $post['title'];
        $content = $post['content'];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Post</title>
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
        <h2>Edit Post</h2>

        <?php if($error): ?>
            <p style="color:red;"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>

        <form method="POST">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">

            <label for="title">Title</label><br>
            <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($title); ?>"><br><br>

            <label for="content">Content</label><br>
            <textarea id="content" name="content" rows="5" cols="40"><?php echo htmlspecialchars($content); ?></textarea><br><br>

            <input type="submit" value="Update Post">
        </form>
    </div>
</body>
</html>