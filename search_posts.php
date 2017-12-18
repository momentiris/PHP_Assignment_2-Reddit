<?php

require __DIR__.'/app/autoload.php';

// $username = $_GET['username']??null;
$user = $pdo->prepare("SELECT * from posts");
$user->execute();
$postsGet = $user->fetchAll(PDO::FETCH_ASSOC);

header("content-type: application/json");
echo json_encode($postsGet);
