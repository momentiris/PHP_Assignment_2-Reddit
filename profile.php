<?php require __DIR__.'/views/header.php';?>

<?php
$getProfile = getProfile($pdo);
echo '</br>';
var_dump($getProfile);

?>







<?php require __DIR__.'/views/footer.php'; ?>
