<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

if (isset($_POST['username'], $_POST['email'], $_POST['password'])) {

  $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
  $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
  $time = timeRightNow();

  newUser($pdo, $username, $email, $password, $time);
    redirect ('./../../login.php');
}
