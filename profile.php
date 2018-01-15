<?php
require __DIR__.'/views/header.php';

$sId = $_SESSION['user']['id'];
$placeholder = 'placeholder.png';
if (isset($_GET['user'])) {
  $userId = $_GET['user'];
} else {
  $userId = (int)$_SESSION['user']['id'];

}
$checkAvatar = checkAvatar($pdo, $userId);
if ($checkAvatar['avatar']) {
  $profilePic = "/assets/avatars/" . $checkAvatar['avatar'];
} else {
  $profilePic = "/assets/avatars/" . $placeholder;
}

$getProfile = getProfile($pdo, $userId);


foreach ($getProfile['userinfo'] as $info) :?>



<div class="profileBox">
  <div class="innerUser">
    <div class="avatarBox">
      <img class="avatarimg" src="<?php echo $profilePic; ?>" alt="">
        <?php if ($sId == $info['id']) : ?>
      <?php if (isset($_GET['editavatar'])) : ?>
        <a href="?">Edit</a>
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
      <?php endif; ?>
    </div>
    <div class="userinfo">
      <h2 class="usernameheader"><?php echo $info['username']; ?></h2>
      <ul class="infoUl">
        <label class="bioInfo" for="biography">Biography:</label>
        <p class="small"><?php echo $info['biography']; ?> </p>
        <label class="bioInfo" for="email">Email:</label>
        <p class="small"><?php echo $info['email']; ?> </p>
        <label class="bioInfo" for="data">Member since: </label>
        <p class="small"><?php echo $info['userdate']; ?></p>
      </ul>
    </div>

  </div>
    <?php if ($sId == $info['id']) : ?>
    <div class="edits">
      <p class="editprofile small">Edit profile</p>
      <p class="editpassword editprofile small">Edit password</p>
    </div>
      <article class="editForm hidden">
        <form class="" action="app/auth/editprofile.php" method="post">
            <div class="form-group">
                <label for="title" class="small">Username</label>
                <input id="usernameInput" class="form-control inputArea" type="text" name="username" value="<?php echo $info['username'];?>" required>
            </div><!-- /form-group -->
            <div class="form-group">
                <label for="content" class="small">Email</label>
                <input class="form-control inputArea" type="text" name="email" value="<?php echo $info['email'];?>" required>
            </div><!-- /form-group -->
            <div class="form-group">
                <label for="content" class="small">Biography</label>
                <textarea maxlength="240"class="form-control contentArea inputArea"  type="text" name="biography" required><?php echo $info['biography'];?></textarea>
            </div><!-- /form-group -->

            <button type="submit" class="">Submit</button>
        </form>
    </article>

    <article class=" editPwForm hidden">
      <form class="editPwForm" action="app/auth/editprofile.php" method="post">
        <div class="form-group">
            <label for="password" class="small">Old password</label>
            <input class="form-control inputArea" type="password" name="oldpassword">
            <label for="password" class="small">New password</label>
            <input class="form-control inputArea" type="password" name="newpassword">
            <label for="password" class="small">Repeat new password</label>
            <input class="form-control inputArea" type="password" name="newpassword">
        </div><!-- /form-group -->
        <button type="submit" class="">Submit</button>
      </form>
    </article>
  <?php endif; ?>


  <div class="posts">
    <h5>Posts: <?php echo count($getProfile['posts'][0]) ?></h5>
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
