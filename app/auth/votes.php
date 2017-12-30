<?php
require __DIR__.'/../autoload.php';
$sId = $_SESSION['user']['id'];

?>


<?php
if (isset($_POST['postId'])) {
  $voteValue = $_POST['dir'];
  $postId = $_POST['postId'];

    // $vote = "UPDATE posts SET upvotes = upvotes +1 WHERE id = :id";
    // $addUserToVoted = "INSERT INTO posts(hasvotedup) VALUES (:user_id)";
    $vote = "INSERT INTO uservotes(user_id, post_id, vote_value) VALUES(:user_id, :post_id, :vote_value)";


  $statement = $pdo->prepare($vote);
  $statement->bindParam(':post_id', $postId, PDO::PARAM_INT);
  $statement->bindParam(':user_id', $sId, PDO::PARAM_INT);
  $statement->bindParam(':vote_value', $voteValue, PDO::PARAM_INT);

// $temp = $pdo->prepare($addUserToVoted);
// $temp->bindParam(':user_id', $sId, PDO::PARAM_INT);
// // $temp->bindParam(':id', $postId, PDO::PARAM_INT);
// $temp->execute;
// $tempRes = $temp->fetchAll('PDO::FETCH_ASSOC');




  if (!$statement) {
  die(var_dump($pdo->errorInfo()));
}

  $statement->execute();
  $result = $statement->fetchAll(PDO::FETCH_ASSOC);
  echo json_encode($result);



  //
  //
  // $votes = $votes->fetchAll(PDO::FETCH_ASSOC);

}
