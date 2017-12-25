<?php
require __DIR__.'/../autoload.php';
?>


<?php
if (isset($_POST['postId'])) {
  $voteValue = $_POST['dir'];
  $postId = $_POST['postId'];
  $sId = $_SESSION['user']['id'];

  $upvote = "UPDATE posts SET votes = votes+1 WHERE id = :id";
  $statement = $pdo->prepare($upvote);
  $statement->bindParam(':id', $postId, PDO::PARAM_INT);

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
