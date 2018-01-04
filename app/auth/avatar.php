<?php require '../autoload.php';


if (isset($_FILES)) {


  $targetDir = '../../avatars';
  $avOrigin = $_FILES['avatar']['tmp_name'];
  $fileName = $_SESSION['user']['name'] . '.png';


  list($width, $height) = getimagesize($avOrigin);
  if ($width == null && $height == null) {
      redirect('../../profile.php');
      return false;
  }

  if ($width >= 200 && $height >= 200) {
    $avatar = new Imagick($avOrigin);
    $avatar->thumbnailImage(200, 200);
    $avatar->writeImage(__DIR__.'/../../assets/avatars/'.$fileName);
    redirect('../../profile.php');
  }

}

?>



<?php



?>
