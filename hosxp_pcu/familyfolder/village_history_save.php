<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');

include '../includes/DBConn.php';


$postData = json_decode( file_get_contents("php://input") );


$vid=$postData->vid;
$village_history_detail= $postData->village_history_detail;
$user = $postData->user;



$sql="replace into village_history(village_id,village_history_id,village_history_detail,user_update,entry_update) values('$vid','$vid','$village_history_detail','$user',DATE_FORMAT(NOW(),'%Y-%m-%d %H:%i:%s')) ";



$stm = $db->prepare($sql);
$stm->execute();
$count = $stm->rowCount();

$r=['row'=>$count];

$txt = json_encode($r);

print($txt);

?>