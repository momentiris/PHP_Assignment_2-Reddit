<?php
require __DIR__.'/../autoload.php';
$sId = $_SESSION['user']['id'];
?>
<?php

//Check if user has voted before

// if (isset($_POST['postId'])) {
  // $voteValue = $_POST['dir'];
  // $postId = $_POST['postId'];
function checkVote($pdo) {
  $checkVote =
  "SELECT vote_value
  FROM uservotes WHERE post_id = 34
  AND user_id = 17";

  $statement = $pdo->prepare($checkVote);
  // $statement->bindParam('user_id', 17);
  // $statement->bindParam('post_id', 35);
  $statement->execute();
  $resultCheck = $statement->fetchAll(PDO::FETCH_NUM);
  return $resultCheck;
  }
// if ($result) {
//   if ((int)$result == 1) {
//     echo 'You have already voted up!';
//   } else {
//     echo 'You have already voted down!';
//   }
//
// }



if (checkVote($pdo)) {
  echo json_encode('You have already voted');
  var_dump(checkVote($pdo));

}

if (!checkVote($pdo)) {
  $insertVote = insertVote($voteValue, $postId, $sId, $pdo);
  echo json_encode($insertVote);
  // var_dump($resultCheck);


}

// }
