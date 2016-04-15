<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');

include '../includes/DBConn.php';

$postData = json_decode( file_get_contents("php://input") );


$sql="select 
h.hcode as IMG_ID,
h.hcode as HID,
'1' as IMG_No,
h.villcode as VILLCODE,
'รูปบ้าน'  as IMG_DESC,
h.dateupdate as IMG_DATE,
h.hno as ADDRESS,
v.villno as MOO  
from house as h,
village as v   
where h.hcode='$postData->hid' 
and v.villcode=h.villcode and v.pcucode=h.pcucode ";

$obj = $db->query($sql, PDO::FETCH_OBJ);

$json_data = [];


foreach ($obj as $k) {
    array_push($json_data, $k);
}
$txt = json_encode($json_data);
print($txt);
?>


