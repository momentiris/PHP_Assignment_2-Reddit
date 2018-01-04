<?php
require __DIR__.'/views/header.php';

$sId = $_SESSION['user']['id'];
$profilePic = '';
$getProfile = getProfile($pdo);

$checkAvatarQ = "SELECT avatar FROM users WHERE id = :id";
$checkAvatar = $pdo->prepare($checkAvatarQ);
$checkAvatar->bindParam(':id', $sId, PDO::PARAM_INT);
$checkAvatar->execute();
$result = $checkAvatar->fetch(PDO::FETCH_ASSOC);

if ($result) {
  $profilePic = "/assets/avatars/" . $result['avatar'];
} else {
  $profilePic = "assets/avatars/placeholder.png";
}
foreach ($getProfile['userinfo'] as $info) :?>
<?php foreach ($getProfile['posts'] as $post): ?>


<div class="profileBox">
  <div class="innerUser">

    <div class="userinfo">
      <h2 class="usernameheader"><?php echo $info['username']; ?></h2>
      <ul class="infoUl">
        <p>Email: <?php echo $info['email']; ?> </p>
        <p>Member since: <?php echo $info['userdate']; ?></p>
      <?php endforeach; ?>

      </ul>
    </div>
    <div class="avatarBox">
      <img src="<?php echo $profilePic; ?>" alt="">
    </div>
  </div>

  <form action="app/auth/avatar.php" method="post" enctype="multipart/form-data">
      <div class="form-group">
          <label class="small" for="title">Please choose an image.</label><br>
          <input class="small" name="avatar" type="file" required>
      </div>
      <button type="submit" class="small">Upload</button>
  </form>

  <a href="editprofile.php">Edit Profile</a>
</div>

<div class="posts">
<?php echo $post; ?>

<?php endforeach; ?>
</div>


<?php require __DIR__.'/views/footer.php'; ?>
