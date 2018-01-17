<?php
declare(strict_types=1);

require __DIR__.'/../autoload.php';
$sId = $_SESSION['user']['id'];
?>
<?php
//Check if user has voted before
//$_POST['dir'] triggers checkVote, and $_POST['post'] triggers the newTotalValue.
//checkVote checks if vote exist for the post, if it does it compares the sent value with the value stored in database. if they match it calls for updatevote with a vote value of 0, hence removing the vote.
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
