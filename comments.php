<?php
require __DIR__.'/views/header.php';

$postId = (int)$_GET['post'];
if (isset($_GET['post'])) {
  $getPost = getPost($pdo,$postId);
  $getVote = getVote($pdo, $postId);

}
$comments = getComments($pdo, $postId);


?>
<!-- Target post -->
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
<!-- End target post -->
<!-- Comment form -->
<div class="postboxcontainer container py-3" style="margin: 0;">
  <h3 class="newpost">New comment</h3>
  <article class="">
    <form class="postForm" action="app/posts/comments/insert.php" method="post">

      <div class="form-group">
        <label for="content" class="small">Content</label>
        <textarea class="form-control contentArea inputArea"  type="text" name="content" required></textarea>
      </div><!-- /form-group -->
      <input type="hidden" name="id" value="<?php echo $postId ?>" >
      <button type="submit" class="">Post</button>
    </form>
  </article>
</div>
<!-- End comment form -->

<!-- Comments container -->
<div class="container py-3 postcontainer postBox">
  <?php foreach ($comments as $key => $comment):?>
    <div class="fullPost">
      <div class="postContFull">
        <div class="contentCont">

          <p class="small content"><?php echo $comment['content']; ?></p>
          <p class="small time">Submitted by <a href="/profile.php?"><?php echo $comment['username']; ?></a> on <?php echo $getPost[0]['time']; ?></p>
        </div>
        <div class="voting">
          <button class="upvotePost" data-dir="+1" value="<?php echo $getPost[0]['id']; ?>">Upvote</button>
          <small class="votes"><?php echo $getVote[0]; ?></small>
          <button class="downvotePost" data-dir="-1" value="<?php echo $getPost[0]['id']; ?>">Downvote</button>
        </div>
      </div>
    </div>
  <?php endforeach; ?>
</div>
<!-- End comments container -->








<?php require __DIR__.'/views/footer.php'; ?>
