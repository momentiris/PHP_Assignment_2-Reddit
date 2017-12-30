<?php
require __DIR__.'/../autoload.php';


if (isset($_POST['title'], $_POST['content'], $_POST['url'])) {
  $postAuthor = $_SESSION['user']['name'];
  $authorId = $_SESSION['user']['id'];
  $title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
  $content = filter_var($_POST['content'], FILTER_SANITIZE_STRING);
  $url = filter_var($_POST['url'], FILTER_SANITIZE_URL);
  $time = timeRightNow();
  $upvotes = 0;
  $downvotes = 0;
  newPost($pdo, $title, $content, $url, $postAuthor, $authorId, $time, $upvotes, $downvotes);
  redirect ('/index.php');
}
