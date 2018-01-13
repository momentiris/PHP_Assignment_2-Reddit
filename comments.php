<?php
require __DIR__.'/views/header.php';

if (isset($_GET['post'])) {
  $postId = (int)$_GET['post'];
  $getPost = getPost($pdo,$postId);
  echo $getPost[0]['time'];
}
?>
<div class="postboxcontainer container py-3" style="margin: 0;">
  <div class="countMe">
    <div class="postCont">
      <div class="contentCont">
        <a href=""><h5 class="card-title title"></h5></a>
        <p class="small content"></p>
        <div class="commentEdit">
        <p class="comment"><a href="/comments.php?post=${posts.id}">Comment</a></p>
        <p class="small content"></p>
        </div>
        <p class="small time">Submitted by <a href="/profile.php?"></a></p>
      </div>
      <div class="voting">

      <small class="votes"></small>

      </div>
    </div>
  </div>
</div>


  <h3 class="newpost">New post</h3>
  <article class="  ">
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








<?php require __DIR__.'/views/footer.php'; ?>
