<?php
declare(strict_types=1);
require '../autoload.php';

//check for file
if (isset($_FILES)) {
  $targetDir = '../../avatars';
  $avOrigin = $_FILES['avatar']['tmp_name'];
  $fileName = $_SESSION['user']['name'] . '.png';
//check for !null width/height values to ensure its an image.
  list($width, $height) = getimagesize($avOrigin);
  if ($width == null && $height == null) {
    $_SESSION['message'] = "Only images allowed...";
      redirect('../../profile.php');
      return false;
  }
    $avatarName = $_SESSION['user']['name'] . '.png';
    $sId = $_SESSION['user']['id'];
    $avatar = new Imagick($avOrigin);
    $avatar->thumbnailImage(200, 200, true);
    $avatar->writeImage(__DIR__.'/../../assets/avatars/'.$fileName);
    $updateQ = "UPDATE users SET avatar = :avatar WHERE id = :id";
    $checkAvatar = $pdo->prepare($updateQ);
    $checkAvatar->bindParam(':id', $sId, PDO::PARAM_INT);
    $checkAvatar->bindParam(':avatar', $avatarName, PDO::PARAM_STR);
    $checkAvatar->execute();
    redirect('../../profile.php');
}

?>
