<?php
require __DIR__.'/../autoload.php';

if (isset($_POST['username'])) {
  $sId = $_SESSION['user']['id'];
  $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
  $email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
  $biography = filter_var($_POST['biography'], FILTER_SANITIZE_STRING);
  editProfile($pdo, $email, $biography, $username, $sId);
  redirect('/../../profile.php');
}
if (isset($_POST['password'])) {

}
