<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';
$passwordInput = $_POST['password'];

if (isset($_POST['email'], $_POST['password'])) {

    $emailInput = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $user = $pdo->prepare('SELECT * FROM users WHERE email = :email LIMIT 1');
    $user->bindParam(':email', $emailInput, PDO::PARAM_STR);
    $user->execute();
    $user = $user->fetch(PDO::FETCH_ASSOC);

     if ($user) {
         if (password_verify($passwordInput, $user['password'])) {

             $_SESSION['user'] = [
                 'name'  => $user['name'],
                 'email' => $user['email'],
                 'id'    => $user['id'],
             ];
            redirect ('./../../login.php');

         } else {
             echo 'wrong password';
            }

     } else {
         redirect ('./../../login.php');

        }
}
