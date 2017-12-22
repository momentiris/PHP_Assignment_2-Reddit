<?php
//New Post
function newPost($pdo, $title, $content, $url, $postAuthor, $authorId, $time) {
  $user = $pdo->prepare('INSERT INTO posts (author_id, title, content, url, username, time) VALUES (:author_id, :title, :content, :url, :username, :time)');
  $user->bindParam(':author_id', $authorId, PDO::PARAM_STR);
  $user->bindParam(':title', $title, PDO::PARAM_STR);
  $user->bindParam(':content', $content, PDO::PARAM_STR);
  $user->bindParam(':url', $url, PDO::PARAM_STR);
  $user->bindParam(':username', $postAuthor, PDO::PARAM_STR);
  $user->bindParam(':time', $time, PDO::PARAM_STR);
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



?>
