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
if (!$getProfile) : ?>
<div class="nothingToShow">
  <h6>There doesn't seem to be anything here. <a href="./index.php">Go back.</a> </h6>
</div>
<?php else :
foreach ($getProfile['userinfo'] as $info) :?>

<div class="profileBox">
  <div class="innerUser">
    <div class="avatarBox">
      <img class="avatarimg" src="<?php echo $profilePic; ?>" alt="">
        <?php if ($sId == $info['id']) : ?>
      <?php if (isset($_GET['editavatar'])) : ?>
        <a class="small" href="?">Edit</a>
      <?php else : ?>
        <a class="small" href="?editavatar">Edit</a>
      <?php endif; ?>
      <?php if (isset($_GET['editavatar'])) : ?>
        <form action="app/auth/avatar.php" method="post" enctype="multipart/form-data">
          <div class="form-group uploadavatar">
            <input class="small" name="avatar" type="file" required> </br>
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
        <?php if (isset($_SESSION['message'])) : ?>
          <p class="small"><?php echo $_SESSION['message']; ?></p>
        <?php endif; unset($_SESSION['message']); ?>
    </div>
      <article class="editForm hidden">
        <form class="" action="app/auth/editprofile.php" method="post">
            <div class="form-group">
                <label for="title" class="small">Username</label></br>
                <input id="usernameInput" class="inputArea" type="text" name="username" value="<?php echo $info['username'];?>" required>
            </div><!-- /form-group -->
            <div class="form-group">
                <label for="content" class="small">Email</label></br>
                <input class=" inputArea" type="text" name="email" value="<?php echo $info['email'];?>" required>
            </div><!-- /form-group -->
            <div class="form-group">
                <label for="content" class="small">Biography</label></br>
                <textarea maxlength="240"class="contentArea"  type="text" name="biography" required><?php echo $info['biography'];?></textarea>
            </div><!-- /form-group -->
            <button type="submit" class="">Submit</button>
        </form>
    </article>
    <article class=" editPwForm hidden">
      <form class="editPwForm" action="app/auth/editprofile.php" method="post">
        <div class="form-group">
            <label for="password" class="small">Old password</label></br>
            <input class=" inputArea" type="password" name="oldpassword"></br>
            <label for="password" class="small">New password</label></br>
            <input class=" inputArea" type="password" name="newpassword"></br>
            <label for="password" class="small">Repeat new password</label></br>
            <input class=" inputArea" type="password" name="newpassword">
        </div><!-- /form-group -->
        <button type="submit" class="">Submit</button>
      </form>
    </article>
  <?php endif; ?>

  <div class="posts">
    <h5>Posts: <?php echo count($getProfile['posts'][0]) ?></h5>
    <div class="countMe">
      <?php foreach ($getProfile['posts'][0] as $post): ?>
        <div class="profilePosts">
          <div class="contentCont">
            <a href="<?php echo $post['title']; ?>">
              <h5 class="card-title title"><?php echo $post['title']; ?></h5>
            </a>
            <p class="small content"><?php echo $post['content']; ?></p>
            <p class="small time">Submitted by <a href="?user"><?php echo $info['username']; ?></a> on <?php echo $post['time']; ?></p>
          </div>
        </div>
      <?php endforeach; ?>
    <?php endforeach; ?>
</div>
<?php endif; ?>

<?php require __DIR__.'/views/footer.php'; ?>
