<?php 
    require_once 'db.php';

    if (isset($_GET['id'])) {
        $post_id = $_GET['id'];

        try {
            $stmt = $pdo->prepare('DELETE FROM posts WHERE id = :post_id');
            $stmt->execute([ ':post_id' => $post_id ]);
        } catch (PDOException $e) {
            die("Error deleting post: " . $e->getMessage());
        }
    }

    header("Location: index.php");
    exit();
