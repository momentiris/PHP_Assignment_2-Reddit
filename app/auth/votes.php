<?php
declare(strict_types=1);

require __DIR__.'/../autoload.php';
$sId = $_SESSION['user']['id'];
?>
<?php
//Check if user has voted before
if (isset($_POST['dir'])) {
  $voteValue = $_POST['dir'];
  $postId = $_POST['postId'];
  header("content-type: application/json");
  echo json_encode(checkVote($pdo,$sId));
}
elseif ($_POST['post']) {
  $postId = $_POST['postId'];
  header("content-type: application/json");
  newTotalVoteValue($pdo,$postId);

}
