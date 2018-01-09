<?php
declare(strict_types=1);

require __DIR__.'/../autoload.php';
$passwordInput = $_POST['password'];

if (isset($_POST['username'], $_POST['password'])) {
    $username = filter_var(strtolower($_POST['username']), FILTER_SANITIZE_STRING);
    login($pdo, $username, $passwordInput);
}
