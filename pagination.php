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
$countVotes = $pdo->prepare("SELECT id, sum(uservotes.vote_value) as totalvalue from posts LEFT JOIN uservotes ON uservotes.post_id = posts.id GROUP BY posts.id");
$countVotes ->execute();
$totalAmountOfVotes = $countVotes->fetchAll(PDO::FETCH_ASSOC);


 //last update: got votes paired to post_id from from db. mission now is to push to $allArr depending on post_id;


$posts = $pdo->prepare("SELECT title, content, url, time, username, author_id, id FROM posts LIMIT $start, $postsPerPage");
$posts->execute();
$answer = $posts->fetchAll(PDO::FETCH_ASSOC);

$allArr = [
'posts' => [],
'total' => []
];

array_push($allArr['posts'], $answer);
array_push($allArr['total'], $totalAmountOfPosts);

foreach($allArr['posts'][0] as $key=>$fromAllArr)
{

  foreach($totalAmountOfVotes as $key2=>$value2)
  {

     if($fromAllArr['id']==$value2['id'])
     {
       echo $fromAllArr['id'] . 'is paired with' . $value2['id'] . '</br>';



     }
 }
}
var_dump($allArr);

// $value1['vote'] = $value2['vote'];
// $result[$key1][]=$value;

// foreach ($allArr as $key => $value) {
//   var_dump($value);
// }
// foreach ($totalAmountOfVotes as $post => $value) {
// }
// $pages = ceil($totalAmountOfPosts / $postsPerPage);



// header("content-type: application/json");
// echo json_encode($allArr);
// echo json_encode($totalAmountOfPosts);




 ?>
