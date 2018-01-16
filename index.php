<?php
declare(strict_types=1);
require __DIR__.'/views/header.php';
if (!isset($_SESSION['user']['name'])) : ?>
  <div class="nothingToShow">
    <h6>Please <a href="./login.php"> login </a>to show secret content. </br>Not a secret member?<a href="./registration.php"> Register here! </a></h6>
  </div>
<?php else: ?>
  <div class="postboxcontainer container py-3" style="margin: 0;">
    <h3 class="newpost">New post</h3>
    <article class="hidden">
      <form class="postForm" action="app/posts/newpost.php" method="post">
          <div class="form-group">
              <label for="title" class="small">Title</label></br>
              <input id="usernameInput" class="inputArea" type="text" name="title" required></br>
          </div><!-- /form-group -->
          <div class="form-group">
              <label for="url" class="small">Url</label></br>
              <input class="inputArea" type="url" name="url"></br>
          </div><!-- /form-group -->
          <div class="form-group">
              <label for="content" class="small">Content</label></br>
              <textarea class=" contentArea "  type="text" name="content" required></textarea>
          </div><!-- /form-group -->
          <button type="submit" class="">Post</button>
      </form>
  </article>
</div>
<div class="slowpokewrap">
  <img class="slowpoke" src="http://i.stack.imgur.com/SBv4T.gif" title="this slowpoke moves" />
</div>

  <div class="container py-3 postcontainer postBox">

</div>
<div class="loadwrap">
  <img class="loading loadingHidden" src="assets/loading/2.gif" alt="">
</div>

<?php endif; require __DIR__.'/views/footer.php'; ?>
