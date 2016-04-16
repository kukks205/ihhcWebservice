<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');


ob_start();
include 'ImgClass.php';

$hid=$_REQUEST['hid'];
$blobObj = new ImageDB();
$a = $blobObj->HouseImageID($hid);
header("Content-Type: image/jpeg");
echo $a['pic'];

?>
