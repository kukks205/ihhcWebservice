<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');

ob_start();
include 'ImgClass.php';
$pid=$_REQUEST['pid'];
$blobObj = new ImageDB();
$a=$blobObj->selectPerImage($pid);
header("Content-Type: image/jpeg");
echo $a['pic'];
?>