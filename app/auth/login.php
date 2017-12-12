<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';
$passwordInput = $_POST['password'];

if (isset($_POST['username'], $_POST['password'])) {

    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
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
            redirect ('./../../forumgeneral.php');

         } else {
             echo 'wrong password';
            }

     } else {
         redirect ('./../../login.php');

        }
}
