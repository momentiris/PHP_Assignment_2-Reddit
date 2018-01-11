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

  if ($user){
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

function getProfile($pdo, $userId) {
  //I fill the $userProfile array with userinfo and all posts etc from the user in order to get a clear look of all the content and to easily print it on the profile page.
  $userProfile = [
    'userinfo' => [],
    'posts'    => [],
    'comments' => [],
  ];
  $countPosts = $pdo->prepare("SELECT posts.title, posts.content, posts.time FROM posts WHERE author_id = :id");
  $countPosts->bindParam(':id', $userId);
  $countPosts ->execute();

  $allPosts = $countPosts->fetchAll(PDO::FETCH_ASSOC);
  $user = $pdo->prepare('SELECT users.username, users.email, users.biography, users.userdate FROM users WHERE id = :id LIMIT 1');
  $user->bindParam(':id', $userId, PDO::PARAM_INT);
  $user->execute();
  $result = $user->fetchAll(PDO::FETCH_ASSOC);

  array_push($userProfile['userinfo'], $result[0]);
  array_push($userProfile['posts'], $allPosts);
  return $userProfile;
}

function editProfile($pdo, $email, $biography, $username, $sId) {
  $editQ = "UPDATE users SET username = :username, email = :email, biography = :biography WHERE id = :session_id";
  $editProfile = $pdo->prepare($editQ);
  $editProfile->bindParam(':username', $username, PDO::PARAM_STR);
  $editProfile->bindParam(':email', $email, PDO::PARAM_STR);
  $editProfile->bindParam(':biography', $biography, PDO::PARAM_STR);
  $editProfile->bindParam(':session_id', $sId, PDO::PARAM_INT);
  $editProfile->execute();
  $_SESSION['user']['name'] = $username;
}

function editPassword($pdo, $inputOld, $newPw, $sId) {
  $checkPwQ = "SELECT password FROM users WHERE id = :id";
  $checkPw = $pdo->prepare($checkPwQ);
  $checkPw->bindParam(':id', $sId, PDO::PARAM_INT);
  $checkPw->execute();
  $currentPw = $checkPw->fetch(PDO::FETCH_ASSOC);
  $currentPw = $currentPw['password'];

  if (password_verify($inputOld, $currentPw)) {
    $newPw = password_hash($newPw, PASSWORD_DEFAULT);
    $updatePwQ = "UPDATE users SET password = :password WHERE id = :id";
    $updatePw = $pdo->prepare($updatePwQ);
    $updatePw->bindParam(':password', $newPw);
    $updatePw->bindParam(':id', $sId);
    $updatePw->execute();
    return true;
  }
  else {
    return false;
  }
}
//checks if user has voted. If voted checks value of vote to vote_value in db. if not voted it inserts new vote.
function checkVote($pdo, $sId) {
  $voteValue = $_POST['dir'];
  $postId = $_POST['postId'];
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
      updateVote($sId,$pdo,$postId, 0);
    } else {
      updateVote($sId,$pdo,$postId,$voteValue);
    }
  } else {
    insertVote($voteValue, $postId, $sId, $pdo);
  }
}

function removeVote($sId, $voteValue, $pdo, $postId) {
  $rmVoteQ = "DELETE * FROM uservotes WHERE user_id = :user_id AND post_id = :post_id";
  $rmVote = $pdo->prepare($rmVoteQ);
  $rmVote->bindParam(':post_id',$postId);
  $rmVote->bindParam(':user_id',$sId);
  $rmVote->execute();
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
  echo json_encode('updated');
}

function newTotalVoteValue($pdo, $postId) {
  $newTotalValueQ = "SELECT sum(vote_value) as newtotal FROM uservotes WHERE post_id = :post_id";
  $newTotalValue = $pdo->prepare($newTotalValueQ);
  $newTotalValue->bindParam(':post_id', $postId, PDO::PARAM_INT);
  $newTotalValue->execute();

  if (!$newTotalValue) {
    die(var_dump($pdo->errorInfo()));
  }
  $result = $newTotalValue->fetch(PDO::FETCH_NUM);
  echo json_encode($result);
}

function checkAvatar($pdo,$userId) {
  $checkAvatarQ = "SELECT avatar FROM users WHERE id = :id";
  $checkAvatar = $pdo->prepare($checkAvatarQ);
  $checkAvatar->bindParam(':id', $userId, PDO::PARAM_INT);
  $checkAvatar->execute();
  $result = $checkAvatar->fetch(PDO::FETCH_ASSOC);

  if (!$checkAvatar) {
    die(var_dump($pdo->errorInfo()));
  }

return $result;

}

?>
