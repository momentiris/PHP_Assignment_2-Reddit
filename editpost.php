<?php
require __DIR__.'/views/header.php';
$sId = $_SESSION['user']['id'];

if (!isset($_SESSION['user'])) {
  echo 'Please login to edit your posts.';
}

if (isset($_GET)) {
$postId = (int)$_GET['post'];
$getPost = getPost($pdo, $postId);

  if ($getPost[0]['author_id'] == $sId): ?>

<div class="postboxcontainer container py-3" style="margin: 0;">
  <h3 class="">Edit post</h3>
  <article class="">
    <form class="postForm" action="/app/posts/update.php" method="post">
        <div class="form-group">
            <label for="title" class="small">Title</label>
            <input id="usernameInput" class="form-control inputArea" type="text" name="title" value="<?php echo $getPost[0]['title']; ?>" required>
        </div><!-- /form-group -->
        <div class="form-group">
            <label for="url" class="small">Url</label>
            <input class="form-control inputArea" type="url" name="url" value="<?php echo $getPost[0]['url']; ?>" required>
        </div><!-- /form-group -->
        <div class="form-group">
            <label for="content" class="small">Content</label>
            <textarea class="form-control contentArea inputArea"  type="text" name="content" required>
<?php echo $getPost[0]['content']; ?>
            </textarea>
            <input type="hidden" name="id" value="<?php echo $postId ?>" >
        </div><!-- /form-group -->
        <button type="submit" class="">Edit post</button>
    </form>
</article>
</div>
<?php else: echo "You can only edit your own posts."; endif; }?>
