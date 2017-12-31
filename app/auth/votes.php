<?php
require __DIR__.'/../autoload.php';
$sId = $_SESSION['user']['id'];

?>


<?php
if (isset($_POST['postId'])) {
  $voteValue = $_POST['dir'];
  $postId = $_POST['postId'];
  $insertVote = insertVote($voteValue, $postId, $sId, $pdo);
  echo json_encode($insertVote);
}
