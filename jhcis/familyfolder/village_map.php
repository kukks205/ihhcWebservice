<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');

include '../includes/DBConn.php';

$postData = json_decode( file_get_contents("php://input") );

$obj = $db->query("select h.house_id as HID,h.village_id as VILLCODE,h.address as ADDRESS,h.road as ROAD,if(p.cid is null,'ยังไม่ระบุ',concat(p.pname,p.fname,'  ',p.lname)) as HEAD_NAME,
h.latitude as LAT,h.longitude as LNG,v.village_moo as MOO,v.village_name as VILLNAME,if(hi.house_image_id,min(hi.house_image_id),0) as HOUSE_IMG,
v.latitude as VLat,v.longitude as VLng
from house as h
join village as v on v.village_id=h.village_id
left join person p on p.person_id =h.head_person_id
left join house_image as hi on hi.house_id=h.house_id
where h.latitude and h.longitude is not null and h.village_id='".$postData->vid."' group by h.house_id", PDO::FETCH_OBJ);
$json_data = [];

foreach ($obj as $k) {
    array_push($json_data, $k);
}
$txt = json_encode($json_data);
print($txt);
?>