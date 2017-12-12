<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

if (isset($_POST)) {
    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password =  password_hash($_POST['password'], PASSWORD_DEFAULT);
    // $passwordRep =  password_hash($_POST['passwordRep'], PASSWORD_DEFAULT);
    $user = $pdo->prepare('INSERT INTO users (username, email, password)  VALUES (:username, :email, :password)');
    $user->bindParam(':username', $username, PDO::PARAM_STR);
    $user->bindParam(':email', $email, PDO::PARAM_STR);
    $user->bindParam(':password', $password, PDO::PARAM_STR);
    $user->execute();

    redirect ('./../../login.php');
}
