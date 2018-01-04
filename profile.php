<?php require __DIR__.'/views/header.php';?>

<?php
$getProfile = getProfile($pdo);
// echo '</br>';
// var_dump($getProfile);

?>


<br>
<br>
<br>
<br>
<form action="app/auth/avatar.php" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label class="small" for="title">Please choose an image.</label><br>
        <input class="small" name="avatar" type="file" required>
    </div>
    <button type="submit" class="small">Upload</button>
</form>

<a href="editprofile.php">Edit Profile</a>


<?php require __DIR__.'/views/footer.php'; ?>
