<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');

include 'ImgClass.php';

$pid = $_POST['pid'];


 $img = new ImageDB();
 $img->addPerPic($pid, $_FILES["file"]);

/*$json_data = ['status'=>$status];
$txt = json_encode($json_data);
print($txt);
*/

?>
