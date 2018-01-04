<?php

declare(strict_types=1);

// Always start by loading the default application setup.
require __DIR__.'/../app/autoload.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title><?php echo $config['title']; ?></title>
  <link rel="stylesheet" href="/assets/styles/main.css">
  <link rel="stylesheet" href="/assets/styles/profile.css">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">


</head>
<body>
  <?php require __DIR__.'/navigation.php'; ?>

  <div class="container bg-dark navbar-dark py-2 bg-light navbar-expand-md bg-faded justify-content-center">
    <ul class="nav navbar-nav ml-auto w-100">
      <li class="nav-item">
        <a class="nav-link " href="./profile.php">Cats</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="./profile.php">Dogs</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="./profile.php">Lizards</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="./profile.php">Baking</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="./profile.php">Music</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="./profile.php">Code</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="./profile.php">Blabla</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="./profile.php">Cars</a>
      </li>
    </ul>
  </div>
