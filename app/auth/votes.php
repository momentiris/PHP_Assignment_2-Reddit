<?php
require __DIR__.'/../autoload.php';
?>


<?php

if (isset($_POST['upvote'])) {
  echo json_encode("hej");
}
// $sId = $_SESSION['user']['id'];
// var_dump($sId);
// $votes = $pdo->prepare('SELECT title, content, url, time, votes username FROM posts');
// $votes->execute();
// $votes = $votes->fetchAll(PDO::FETCH_ASSOC);
