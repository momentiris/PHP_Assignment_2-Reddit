<?php
require __DIR__.'/../autoload.php';
$sId = $_SESSION['user']['id'];
?>
<?php

//Check if user has voted before

if (isset($_POST)) {

  $voteValue = $_POST['dir'];
  $postId = $_POST['postId'];

  function checkVote($pdo, $sId) {
    $voteValue = $_POST['dir'];
    $postId = $_POST['postId'];
    // $voteValue = -1;
    // $postId = 34;

  $checkVote =
  "SELECT vote_value
  FROM uservotes WHERE post_id = :post_id
  AND user_id = :user_id";

  $statement = $pdo->prepare($checkVote);
  $statement->bindParam('user_id', $sId);
  $statement->bindParam('post_id', $postId);
  $statement->execute();
  $resultCheck = $statement->fetchAll(PDO::FETCH_NUM);
  if ($resultCheck) {
    if ($resultCheck[0][0] == $voteValue) {
      echo json_encode('no');
    } else {
      updateVote($sId,$pdo,$postId,$voteValue);
    }
  } else {
    return insertVote($voteValue, $postId, $sId, $pdo);
  }

}


header("content-type: application/json");
echo json_encode(checkVote($pdo,$sId));



// 1. get user id and vote value
// 2. check if vote exists for target post
// 3. if exists, check if saved value is +1 or -1 and compare to POST value
// 4. if same, do nothing, if different, update current value to POST value





// if (!checkVote($pdo)) {
  // $insertVote = insertVote($voteValue, $postId, $sId, $pdo);
  // echo json_encode($insertVote);
// }

}
