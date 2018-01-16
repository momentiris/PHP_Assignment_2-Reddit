<?php

declare(strict_types=1);

// Always start by loading the default application setup.
require __DIR__.'/../app/autoload.php';
$sId = $_SESSION['user']['name'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">

  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes">
  <meta name="viewport" content="initial-scale=1, maximum-scale=1">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <title><?php echo $config['title']; ?></title>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
  <link rel="stylesheet" href="/assets/styles/main.css">
  <link rel="stylesheet" href="/assets/styles/profile.css">


</head>
<body>
  <?php require __DIR__.'/navigation.php'; ?>
