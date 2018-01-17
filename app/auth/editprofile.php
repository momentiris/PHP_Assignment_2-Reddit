<?php
declare(strict_types=1);

require __DIR__.'/../autoload.php';

if (isset($_POST['username'])) {
  $sId = $_SESSION['user']['id'];
  $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
  $email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
  $biography = filter_var($_POST['biography'], FILTER_SANITIZE_STRING);
  editProfile($pdo, $email, $biography, $username, $sId);
  redirect('/../../profile.php');
}
if (isset($_POST['oldpassword'])) {
  $sId = $_SESSION['user']['id'];
  $inputOld = $_POST['oldpassword'];
  $newPw = $_POST['newpassword'];
  $editPw = editPassword($pdo, $inputOld, $newPw, $sId);
  if ($editPw) {
    $_SESSION['message'] = "Your password has been updated";
    redirect('/../../profile.php');
  } else {
    $_SESSION['message'] = "Something went wrong, try again!";
    redirect('/../../profile.php');
  }
}
