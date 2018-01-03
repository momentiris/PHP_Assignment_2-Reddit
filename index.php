<?php require __DIR__.'/views/header.php';

  // $posts = $pdo->prepare('SELECT title, content, url, time, upvotes, username FROM posts');
  // $posts->execute();
  // $posts = $posts->fetchAll(PDO::FETCH_ASSOC);
if (isset($_GET['test'])) {
  echo 'hej';
}
  ?>

<a href="?test=test">TEST</a>
  <div class="container py-3 postcontainer" style="margin: 0;">
</div>

<article>
    <h1>New post</h1>
    <p style="color: red; margin: 0; position: absolute; right: 0;"class="deniedUsername small"></p>
    <form action="app/auth/newpost.php" method="post">
        <div class="form-group">
            <label for="title">Title</label>
            <input id="usernameInput" class="form-control" type="text" name="title"  required>
        </div><!-- /form-group -->

        <div class="form-group">
            <label for="content">Content</label>
            <input class="form-control" type="text" name="content" required>

        </div><!-- /form-group -->

        <div class="form-group">
            <label for="url">Url</label>
            <input class="form-control" type="url" name="url">

        </div><!-- /form-group -->


        <button type="submit" class="btn btn-primary">Post</button>
    </form>
</article>




<?php require __DIR__.'/views/footer.php'; ?>
