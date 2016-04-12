<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');

include '../includes/DBConn.php';

$postData = json_decode( file_get_contents("php://input") );

$obj = $db->query("select h.house_id as HID,h.village_id as VILLCODE,h.address as ADDRESS,h.road as ROAD,concat(p.pname,p.fname,'  ',p.lname) as HEADNAME,
if(hp.house_id is null,false,true) as IMG,v.village_name as VILLNAME,v.village_moo as MOO,
(select count(distinct cid) as cc from person where house_id=h.house_id and death<>'y' ) as POP,
(select concat(person.pname,person.fname,'  ',person.lname) as name
from village_organization join village_organization_type ON village_organization.village_organization_type_id = village_organization_type.village_organization_type_id
join village_organization_member ON village_organization.village_organization_id = village_organization_member.village_organization_id
join person  ON village_organization_member.person_id = person.person_id
join village_organization_member_service ON village_organization_member_service.village_organization_mid = village_organization_member.village_organization_mid
where village_organization_type.village_organization_type_name='อสม.'  and village_organization_member_service.house_id=h.house_id limit 1) as OSM,
(select name from doctor where code=h.doctor_code) as DOCTOR
from
village as v
join house as h on h.village_id=v.village_id
left join person as p on h.head_person_id = p.person_id
left join house_image hp on h.house_id=hp.house_id
where
h.village_id = '".$postData->vid."'
group by h.house_id
order by
h.address asc", PDO::FETCH_OBJ);
$json_data = [];

foreach ($obj as $k) {
    array_push($json_data, $k);
}
$txt = json_encode($json_data);
print($txt);
?>
