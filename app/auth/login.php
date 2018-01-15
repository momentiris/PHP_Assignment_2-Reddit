<?php
declare(strict_types=1);

require __DIR__.'/../autoload.php';

if (isset($_POST['username'], $_POST['password'])) {
  $passwordInput = $_POST['password'];
    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);

    login($pdo, $username, $passwordInput);
}
