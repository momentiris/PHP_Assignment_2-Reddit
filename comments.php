<?php
declare(strict_types=1);
require __DIR__.'/views/header.php';

$postId = (int)$_GET['post'];
if (isset($_GET['post'])) {
  $getPost = getPost($pdo,$postId);
  $getVote = getVote($pdo, $postId);
}
$comments = getComments($pdo, $postId);

if (!$getPost) : ?>
  <div class="nothingToShow">
    <h6>There doesn't seem to be anything here. <a href="./index.php">Go back.</a> </h6>
  </div>
<?php else: ?>


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
        <button class="upvote" data-dir="+1" value="<?php echo $getPost[0]['id']; ?>">A</button>
        <small class="votes"><?php echo $getVote[0]; ?></small>
        <button class="downvote" data-dir="-1" value="<?php echo $getPost[0]['id']; ?>">Ω</button>
      </div>
    </div>
  </div>
</div>
<!-- End target post -->
<!-- Comment form -->
<div class="postboxcontainer container py-3" style="margin: 0;">
  <h3 class="">New comment</h3>
  <article class="">
    <form class="postForm" action="app/posts/comments/insert.php" method="post">
      <div class="form-group">
        <label for="content" class="small">Content</label></br>
        <textarea class"contentArea"  type="text" name="content" required></textarea></br>
      </div><!-- /form-group -->
      <input type="hidden" name="id" value="<?php echo $postId ?>" >
      <button type="submit" class="">Submit</button>
    </form>
  </article>
</div>
<!-- End comment form -->

<!-- Comments container -->
<div class="container py-3 postcontainer postBox">
  <?php foreach ($comments as $key => $comment):?>
      <div class="postContFull">
        <div class="contentCont">
          <p class="small content"><?php echo $comment['content']; ?></p>

          <p class="small timeComment">Submitted by <a href="/profile.php?"><?php echo $comment['username']; ?></a> on <?php echo $getPost[0]['time']; ?><a class="reply" href="<?php echo $comment['id']; ?>">Reply</a></p>
        </div>

      </div>
  <?php endforeach; ?>
</div>
<!-- End comments container -->

<?php endif; ?>


<?php require __DIR__.'/views/footer.php'; ?>
