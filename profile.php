<?php
require __DIR__.'/views/header.php';

$sId = $_SESSION['user']['id'];
$placeholder = 'placeholder.png';
if (isset($_GET['user'])) {
  $userId = $_GET['user'];
} else {
  $userId = $_SESSION['user']['id'];
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

    <div class="userinfo">
      <h2 class="usernameheader"><?php echo $info['username']; ?></h2>
      <ul class="infoUl">
        <p>Email: <?php echo $info['email']; ?> </p>
        <p>Member since: <?php echo $info['userdate']; ?></p>
      </ul>
    </div>
    <div class="avatarBox">
      <img class="avatarimg" src="<?php echo $profilePic; ?>" alt="">
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
    </div>
  </div>

    <p class="editprofile">Edit profile</p>


      <article class="editForm hidden">
        <form class="" action="app/auth/newpost.php" method="post">
            <div class="form-group">
                <label for="title" class="small">Title</label>
                <input id="usernameInput" class="form-control inputArea" type="text" name="title" required>
            </div><!-- /form-group -->
            <div class="form-group">
                <label for="url" class="small">Url</label>
                <input class="form-control inputArea" type="url" name="url">
            </div><!-- /form-group -->
            <div class="form-group">
                <label for="content" class="small">Content</label>
                <textarea class="form-control contentArea inputArea"  type="text" name="content" required></textarea>
            </div><!-- /form-group -->
            <button type="submit" class="">Post</button>
        </form>
    </article>


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
