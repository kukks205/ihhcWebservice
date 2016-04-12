<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');


ob_start();
include 'ImgClass.php';

//$hid=$_REQUEST['hid'];
$hid=2;
$blobObj = new ImageDB();
$a = $blobObj->HouseImage($hid);
header("Content-Type: image/jpeg");
echo $a['pic'];
?>
