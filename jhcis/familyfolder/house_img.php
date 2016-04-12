<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');

include '../includes/DBConn.php';

$postData = json_decode( file_get_contents("php://input") );


$sql="select hi.house_image_id as IMG_ID,h.house_id as HID,hi.image_number as IMG_No,v.village_id as VILLCODE,
hi.image_description as IMG_DESC,hi.image_taken_date as IMG_DATE,h.address as ADDRESS,v.village_moo as MOO 
from  house h
left outer join house_image hi on h.house_id=hi.house_id
left join village v on v.village_id = h.village_id
where h.house_id ='$postData->hid' order by hi.house_image_id ";

$obj = $db->query($sql, PDO::FETCH_OBJ);

$json_data = [];


foreach ($obj as $k) {
    array_push($json_data, $k);
}
$txt = json_encode($json_data);
print($txt);
?>


