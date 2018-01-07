<?php
require __DIR__.'/views/header.php';

$sId = $_SESSION['user']['id'];
$placeholder = 'placeholder.png';
$getProfile = getProfile($pdo);

$checkAvatarQ = "SELECT avatar FROM users WHERE id = :id";
$checkAvatar = $pdo->prepare($checkAvatarQ);
$checkAvatar->bindParam(':id', $sId, PDO::PARAM_INT);
$checkAvatar->execute();
$result = $checkAvatar->fetch(PDO::FETCH_ASSOC);

if ($result['avatar']) {
  $profilePic = "/assets/avatars/" . $result['avatar'];
} else {
  $profilePic = "/assets/avatars/" . $placeholder;
}


foreach ($getProfile['userinfo'] as $info) :?>

<div class="profileBox">
  <div class="innerUser">

    <div class="userinfo">
      <h2 class="usernameheader"><?php echo $info['username']; ?></h2>
      <ul class="infoUl">
        <p>Email: <?php echo $info['email']; ?> </p>
        <p>Member since: <?php echo $info['userdate']; ?></p>
      </ul>
    </div>
    <div class="avatarBox">
      <img src="<?php echo $profilePic; ?>" alt="">
      <?php if (isset($_GET['editavatar'])) : ?>
        <a href="?">Edit</a> <?php $_GET; ?>
      <?php else : ?>
        <a href="?editavatar">Edit</a>
      <?php endif; ?>
      <?php if (isset($_GET['editavatar'])) : ?>
        <form action="app/auth/avatar.php" method="post" enctype="multipart/form-data">
          <div class="form-group uploadavatar">
            <label class="small" for="title">Please choose an image.</label><br>
            <input class="small" name="avatar" type="file" required>
            <button type="submit" class="small">Upload</button>
          </div>
        </form>
      <?php endif; ?>
    </div>
  </div>

    <a href="editprofile.php">Edit Profile</a>

  <div class="posts">
    <h5>Posts</h5>
    <div class="countMe">
      <?php foreach ($getProfile['posts'][0] as $post): ?>
        <div class="postCont">
          <div class="contentCont">
            <a href="<?php echo $post['title']; ?>"><h5 class="card-title title"><?php echo $post['title']; ?></h5></a>
            <p class="small content"><?php echo $post['content']; ?></p>
            <p class="small time">Submitted by <a href="?user"><?php echo $info['username']; ?></a> on <?php echo $post['time']; ?></p>
          </div>
        </div>
      <?php endforeach; ?>
    <?php endforeach; ?>
</div>



<?php require __DIR__.'/views/footer.php'; ?>
