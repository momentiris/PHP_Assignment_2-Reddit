<?php

require __DIR__.'/app/autoload.php';

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$postsPerPage = 5;
$start = ($page > 1) ? ($page * $postsPerPage) - $postsPerPage : 0;

//Get total amount of posts
$countPosts = $pdo->prepare("SELECT COUNT('id') FROM posts");
$countPosts ->execute();
$totalAmountOfPosts = $countPosts->fetch(PDO::FETCH_NUM);

//Get total amount of votes
$countVotes = $pdo->prepare("SELECT id, sum(uservotes.vote_value) as totalvalue from posts LEFT JOIN uservotes ON uservotes.post_id = posts.id GROUP BY posts.id LIMIT $start, $postsPerPage");
$countVotes ->execute();
$totalAmountOfVotes = $countVotes->fetchAll(PDO::FETCH_ASSOC);


$posts = $pdo->prepare("SELECT title, content, url, time, username, author_id, id, votes FROM posts LIMIT $start, $postsPerPage");
$posts->execute();
$answer = $posts->fetchAll(PDO::FETCH_ASSOC);


$allArr = [
'posts' => [],
'total' => [],
];


array_push($allArr['posts'], $answer);
array_push($allArr['total'], $totalAmountOfPosts);

foreach ($allArr['posts'][0] as $key => $value) {
  foreach ($totalAmountOfVotes as $key2 => $value2) {
    if ($value['id'] == $value2['id']) {
      // $value['votes'] = $value2['totalvalue'];
      $allArr['posts'][0][$key]['votes'] = (int)$value2['totalvalue'];
      if (is_null($allArr['posts'][0][$key]['votes'])) {
        $allArr['posts'][0][$key]['votes'] = 0;
      }
    }
  }
}

header("content-type: application/json");
echo json_encode($allArr);







 ?>
