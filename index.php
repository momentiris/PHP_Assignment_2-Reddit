<?php require __DIR__.'/views/header.php';


  $posts = $pdo->prepare('SELECT title, content, url, time, username FROM posts');
  $posts->execute();
  $posts = $posts->fetchAll(PDO::FETCH_ASSOC);

  if (isset($_GET['test'])) {
    echo 'hej';
  }
  ?>
<a href="?test=test">TEST</a>

<?php foreach ($posts as $post => $value): ?>
<div class="card postcontainer" style="margin-bottom: 1rem;padding: 0;">
<div class="card-body">
  <h5 class="card-title"><?php echo $value['title']?></h4>
  <p class="card-text small"><?php echo $value['content'];?></p>
  <p class="card-text small"><?php echo $value['url'];?></p>
  <p class="card-text small"><?php echo $value['username'];?></p>
  <p class="card-text small"><?php echo $value['time'];?></p>
  <a href="#" style="padding: 0;"class="btn">Go somewhere</a>
</div>
</div>
<?php endforeach; ?>

</div>

<nav aria-label="Page navigation example">
  <ul class="pagination">
    <li class="page-item"><a class="page-link" href="#">Previous</a></li>
    <li class="page-item"><a class="page-link" href="#">1</a></li>
    <li class="page-item"><a class="page-link" href="#">2</a></li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>
    <li class="page-item"><a class="page-link" href="#">Next</a></li>
  </ul>
</nav>


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
