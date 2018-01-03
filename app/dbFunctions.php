<?php
//New Post
function newPost($pdo, $title, $content, $url, $postAuthor, $authorId, $time, $votes) {
  $user = $pdo->prepare('INSERT INTO posts (author_id, title, content, url, username, time, votes) VALUES (:author_id, :title, :content, :url, :username, :time, :votes)');
  $user->bindParam(':author_id', $authorId, PDO::PARAM_STR);
  $user->bindParam(':title', $title, PDO::PARAM_STR);
  $user->bindParam(':content', $content, PDO::PARAM_STR);
  $user->bindParam(':url', $url, PDO::PARAM_STR);
  $user->bindParam(':username', $postAuthor, PDO::PARAM_STR);
  $user->bindParam(':time', $time, PDO::PARAM_STR);
  $user->bindParam(':votes', $votes, PDO::PARAM_INT);
  $user->execute();
}

//Registration
function newUser($pdo, $username, $email, $password, $time) {
  $user = $pdo->prepare('INSERT INTO users (username, email, password, userdate)  VALUES (:username, :email, :password, :userdate)');
  $user->bindParam(':username', $username, PDO::PARAM_STR);
  $user->bindParam(':email', $email, PDO::PARAM_STR);
  $user->bindParam(':password', $password, PDO::PARAM_STR);
  $user->bindParam(':userdate', $time, PDO::PARAM_STR);
  $user->execute();
}

//Login
function login($pdo, $username, $passwordInput) {
  $user = $pdo->prepare('SELECT * FROM users WHERE username = :username LIMIT 1');
  $user->bindParam(':username', $username, PDO::PARAM_STR);
  $user->execute();
  $user = $user->fetch(PDO::FETCH_ASSOC);

  if ($user) {
      if (password_verify($passwordInput, $user['password'])) {
          $_SESSION['user'] = [
              'name'  => $user['username'],
              'id'    => $user['id'],
          ];
         redirect ('./../../index.php');
      } else {
          echo 'wrong password';
         }
  } else {
      redirect ('./../../login.php');
     }
}

function getProfile($pdo) {
  $sId = (int)$_SESSION['user']['id'];
  $countPosts = $pdo->prepare("SELECT COUNT('author_id') FROM posts WHERE author_id = $sId");
  $countPosts ->execute();
  $totalAmountOfPosts = $countPosts->fetch(PDO::FETCH_NUM);
  var_dump($totalAmountOfPosts);
  // $user = $pdo->prepare('SELECT posts.title, posts.content, posts.time, posts.author_id, users.username, users.email, users.userdate FROM posts LEFT JOIN users ON posts.author_id = users.id WHERE posts.author_id = :id');
  $user = $pdo->prepare('SELECT users.username, users.email, users.userdate FROM users WHERE id = :id LIMIT 1');
  $user->bindParam(':id', $sId, PDO::PARAM_INT);
  $user->execute();
  $result = $user->fetchAll(PDO::FETCH_ASSOC);
  return $result;
}

function insertVote($voteValue, $postId, $sId, $pdo) {

  // Insert vote
  $vote = "INSERT INTO uservotes(user_id, post_id, vote_value) VALUES(:user_id, :post_id, :vote_value)";
  $statement = $pdo->prepare($vote);
  $statement->bindParam(':post_id', $postId, PDO::PARAM_INT);
  $statement->bindParam(':user_id', $sId, PDO::PARAM_INT);
  $statement->bindParam(':vote_value', $voteValue, PDO::PARAM_INT);

  if (!$statement) {
    die(var_dump($pdo->errorInfo()));
  }
  $statement->execute();
  $result = $statement->fetchAll(PDO::FETCH_ASSOC);
  return $result;
}

function updateVote($sId, $pdo, $postId,$voteValue) {

  $updateQ = "UPDATE uservotes SET vote_value = :vote_value WHERE user_id = :user_id AND post_id = :post_id";
  $update = $pdo->prepare($updateQ);
  $update->bindParam(':vote_value', $voteValue, PDO::PARAM_INT);
  $update->bindParam(':post_id', $postId, PDO::PARAM_INT);
  $update->bindParam(':user_id', $sId, PDO::PARAM_INT);

  if (!$update) {
    die(var_dump($pdo->errorInfo()));
  }

  $update->execute();
//   $result = $update->fetchAll(PDO::FETCH_ASSOC);
// return json_encode($result);

}



?>
