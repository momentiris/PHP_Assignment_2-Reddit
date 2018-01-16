<?php
declare(strict_types=1);

require __DIR__.'/app/autoload.php';

// $username = $_GET['username']??null;
$user = $pdo->prepare("SELECT username from users");
$user->execute();
$usernamesGet = $user->fetchAll(PDO::FETCH_ASSOC);

header("content-type: application/json");
echo json_encode($usernamesGet);
// $result = null;
