<?php
    require_once 'db.php';

    if($_SERVER["REQUEST_METHOD"] == 'POST'){

        $post_id = $_POST['id'] ?? null;


        if(!$post_id || !is_numeric($post_id)){
          header("Location: index.php");
          exit();
        }
        else {
          try {
              $stmt = $pdo->prepare('DELETE FROM posts WHERE id = :post_id');
              $stmt->execute([
                  ':post_id' => $post_id
              ]);

          } catch (PDOException $e) {
              die("Connection Failed: " . $e->getMessage());
          }

          header('Location: index.php');
          exit();
        }
    }
    else {
      header('Location: index.php');
      exit();
    }








    // if (isset($_GET['id'])) {
    //     $post_id = $_GET['id'];
    //
    //     try {
    //         $stmt = $pdo->prepare('DELETE FROM posts WHERE id = :post_id');
    //         $stmt->execute([ ':post_id' => $post_id ]);
    //     } catch (PDOException $e) {
    //         die("Error deleting post: " . $e->getMessage());
    //     }
    // }
    //
    // header("Location: index.php");
    // exit();
