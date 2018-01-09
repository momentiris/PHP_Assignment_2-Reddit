<?php require __DIR__.'/views/header.php';

  ?>
  <div class="postboxcontainer container py-3" style="margin: 0;">

    <h3 class="newpost">New post</h3>
    <article class="">
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
</div>

  <div class="container py-3 postcontainer postBox">
</div>

<?php require __DIR__.'/views/footer.php'; ?>
