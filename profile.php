<?php require __DIR__.'/views/header.php'; ?>

<article>
    <h1><?php echo $config['title']; ?></h1>
    <p>This is the home page.</p>
</article>

<?php require __DIR__.'/views/footer.php'; ?>





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
