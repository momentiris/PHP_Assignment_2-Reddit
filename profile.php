<?php require __DIR__.'/views/header.php';

?>



<?php
$getProfile = getProfile($pdo);

foreach ($getProfile as $info => $value) {

  echo $value['username'] . '<br>';
  echo $value['userdate'] . '<br>';
  echo $value['email'] . '<br>';

}

?>


<article>
    <h1><?php echo $config['title']; ?></h1>
    <p>This is the home page.</p>
</article>





<?php require __DIR__.'/views/footer.php'; ?>
