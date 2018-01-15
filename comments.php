<?php
require __DIR__.'/views/header.php';

if (isset($_GET['post'])) {
  $postId = (int)$_GET['post'];
  $getPost = getPost($pdo,$postId);
  $getVote = getVote($pdo, $postId);


}
?>
<div class="postboxcontainer container py-3" style="margin: 0;">
  <div class="fullPost">
    <div class="postContFull">
      <div class="contentCont">
        <a href=""><h5 class="card-title title"><?php echo $getPost[0]['title']; ?></h5></a>
        <p class="small content"><?php echo $getPost[0]['content']; ?></p>
        <p class="small time">Submitted by <a href="/profile.php?"><?php echo $getPost[0]['username']; ?></a> on <?php echo $getPost[0]['time']; ?></p>
      </div>
      <div class="voting">
        <button class="upvotePost" data-dir="+1" value="<?php echo $getPost[0]['id']; ?>">Upvote</button>
        <small class="votes"><?php echo $getVote[0]; ?></small>
        <button class="downvotePost" data-dir="-1" value="<?php echo $getPost[0]['id']; ?>">Downvote</button>
      </div>
    </div>
  </div>
</div>

  <div class="postboxcontainer container py-3" style="margin: 0;">
    <h3 class="newpost">New comment</h3>
  <article class="hidden ">
    <form class="postForm" action="app/auth/newpost.php" method="post">
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
</div>











<?php require __DIR__.'/views/footer.php'; ?>
