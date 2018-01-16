<?php
require __DIR__.'/../../autoload.php';

if (isset($_POST)) {
  $postId = $_POST['id'];
  $sId = $_SESSION['user']['id'];
  $content = $_POST['content'];
  $username = $_SESSION ['user']['name'];
  $time = timeRightNow();
  $insertComment = insertComment($pdo, $postId, $sId, $username, $time, $content);
  if ($insertComment) {
    redirect("/comments.php?post=$postId");
  }
}
