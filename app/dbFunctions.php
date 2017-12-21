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



?>
