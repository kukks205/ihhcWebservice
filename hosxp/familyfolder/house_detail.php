<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');

include '../includes/DBConn.php';


$postData = json_decode( file_get_contents("php://input") );

$obj = $db->query("select *,(select if(p.mobile_phone is null,'0',REPLACE(p.mobile_phone,'-','')) as cc
from person as p join village_organization_member as vm ON p.person_id = vm.person_id
where vm.village_organization_mid=d1.OSM_ID) as OSM_TEL from (select h.house_id as HID,h.village_id as VILLCODE,h.address as ADDRESS,house_subtype_id as HOUSETYPE,
census_id as HOUSE_ID,road as ROAD,location_area_id as LOCATYPE,
h.latitude as LAT,h.longitude as LNG,house_condo_name as CONDO,h.doctor_code as DOCTOR,
head_person_id AS HEAD_ID,
v.village_name as VILLNAME,v.village_moo as MOO,
(select village_organization_member.village_organization_mid
from village_organization join village_organization_type ON village_organization.village_organization_type_id = village_organization_type.village_organization_type_id
join village_organization_member ON village_organization.village_organization_id = village_organization_member.village_organization_id
join person  ON village_organization_member.person_id = person.person_id
join village_organization_member_service ON village_organization_member_service.village_organization_mid = village_organization_member.village_organization_mid
where village_organization_type.village_organization_type_name='อสม.'  and village_organization_member_service.house_id=h.house_id limit 1) as OSM_ID,
(select village_organization_member_service.village_organization_member_service_id
from village_organization join village_organization_type ON village_organization.village_organization_type_id = village_organization_type.village_organization_type_id
join village_organization_member ON village_organization.village_organization_id = village_organization_member.village_organization_id
join person  ON village_organization_member.person_id = person.person_id
join village_organization_member_service ON village_organization_member_service.village_organization_mid = village_organization_member.village_organization_mid
where village_organization_type.village_organization_type_name='อสม.'  and village_organization_member_service.house_id=h.house_id limit 1) as OSM_SID
from house h 
left join house_type ht on (h.house_type_id=ht.house_type_id)
left join person p on (h.head_person_id=p.person_id)
join village as v on v.village_id=h.village_id where  h.house_id='".$postData->hid."') as d1", PDO::FETCH_OBJ);



$json_data = [];


foreach ($obj as $k) {
    array_push($json_data, $k);
}

$txt = json_encode($json_data);

print($txt);

?>

