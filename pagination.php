<?php

require __DIR__.'/app/autoload.php';

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$postsPerPage = 5;
$start = ($page > 1) ? ($page * $postsPerPage) - $postsPerPage : 0;


$countPosts = $pdo->prepare("SELECT COUNT('id') FROM posts");
$countPosts ->execute();
$totalAmountOfPosts = $countPosts->fetch(PDO::FETCH_NUM);


$posts = $pdo->prepare("SELECT title, content, url, time, username, votes, author_id FROM posts LIMIT $start, $postsPerPage");
$posts->execute();
$answer = $posts->fetchAll(PDO::FETCH_ASSOC);

$allArr = [
'posts' => [],
'total' => []
];

array_push($allArr['posts'], $answer);
array_push($allArr['total'], $totalAmountOfPosts);

// $pages = ceil($totalAmountOfPosts / $postsPerPage);



header("content-type: application/json");
echo json_encode($allArr);
// echo json_encode($totalAmountOfPosts);



 ?>
