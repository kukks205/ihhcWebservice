<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');

include 'ImgClass.php';

$hid = $_POST['hid'];
if (!empty($_POST['image_number'])):
    $img_number = $_POST['image_number'];
else:
    $img_number = '0';
endif;

if (!empty($_POST['image_description'])):
    $image_description = $_POST['image_description'];
else:
    $image_description = 'ไม่ระบุ';
endif;


 $img = new ImageDB();
 $status = $img->houseImgUpload($hid, $_FILES["file"], $image_description, $img_number);

$json_data = ['status'=>$status];

?>
