<?php

    $host = "localhost";
    $dbname = "blog";
    $charset = "utf8";
    $db_user = "root";
    $db_pass = "";

    $dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";

    try {
          $pdo = new PDO($dsn, $db_user, $db_pass);
          $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Connection lost: " . $e->getMessage());
    }
