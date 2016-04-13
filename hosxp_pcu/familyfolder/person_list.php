<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');

include '../includes/DBConn.php';

$postData = json_decode( file_get_contents("php://input") );


$obj = $db->query("select p.person_id as PID,p.cid as CID,if(pi.person_id is null,(if(p.sex=1,1,2)),3) as PIMG,v.village_id as VILLCODE,
concat(p.pname,' ',p.fname,' ',p.lname) as PERSON_NAME,if(p.mobile_phone is null,false,true) as TEL, p.mobile_phone as MPHONE,
p.sex,p.age_y as AGE ,h.address,v.village_moo as MOO,v.village_name as VILLNAME
from person as p 
left join person_image pi on p.person_id=pi.person_id
join house h on h.house_id=p.house_id
join village v on v.village_id=h.village_id
where p.death<>'y' and p.person_discharge_id='9'  and p.house_id='".$postData->hid."' order by p.age_y desc", PDO::FETCH_OBJ);
$json_data = [];


foreach ($obj as $k) {
    array_push($json_data, $k);
}
$txt = json_encode($json_data);
print($txt);
?>


