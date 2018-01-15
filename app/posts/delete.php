<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

// In this file we delete new posts in the database.
if (isset($_POST['delete'])) {
  $postId = $_POST['id'];
  if (deletePost($pdo, $postId)) {
    redirect('/index.php');
  }

}
