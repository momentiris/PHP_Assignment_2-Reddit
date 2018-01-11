<?php
require __DIR__.'/app/autoload.php';




$sId = $_SESSION['user']['id'];

header("content-type: application/json");
echo json_encode($sId);
