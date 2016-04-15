<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');

include 'ImgClass.php';

$hid = $_POST['hid'];

 $img = new ImageDB();
 $img->houseImgUpload($hid, $_FILES["file"]);

/*$json_data = ['status'=>$status];
$txt = json_encode($json_data);
print($txt);
*/

?>
