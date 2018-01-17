<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

if (isset($_POST['title'])) {
  $title = $_POST['title'];
  $content = $_POST['content'];
  $url = $_POST['url'];
  $postId = (int)$_POST['id'];
  if (updatePost($pdo, $postId, $title, $content, $url)) {
    redirect('/index.php');
  }

}
