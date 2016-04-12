<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');

include '../includes/DBConn.php';


$postData = json_decode( file_get_contents("php://input") );

$obj = $db->query("select
p.person_id as PID,p.house_id as HID,p.cid as CID,provis_pname_code as PRENAME,
if(pi.person_id is null,(if(p.sex=1,1,2)),3) as PIMG,
p.fname as NAME,p.lname as LNAME,p.sex as SEX,p.birthdate as BIRTH,p.marrystatus as MSTATUS,
p.education as EDUCATE,oc.nhso_code as OCCUPATION_NEW,n.nhso_code as NATION,
n2.nhso_code as RACE,p.education as EDUCATION,
l.nhso_code as RELIGION,p.house_regist_type_id as TYPEAREA,p.person_house_position_id as FSTATUS,
b.blood_id as ABOGROUP,b2.rh_id as RHGROUP,p.person_discharge_id as DISCHARGE,
p.mobile_phone as MOBILEPHONE,p.last_update as D_UPDATE
from
person as p
left join person_image pi on p.person_id=pi.person_id
left join provis_pname pn on p.pname=pn.provis_pname_short_name 
left join occupation as oc on oc.occupation=p.occupation
left join nationality n on n.nationality=p.nationality
left join nationality n2 on n2.nationality=p.citizenship
left join religion l on l.religion=p.religion
left join blood_group b on b.name=p.blood_group
left join blood_rh b2 on b2.name=p.bloodgroup_rh 
where p.person_id='".$postData->pid."'", PDO::FETCH_OBJ);



$json_data = [];


foreach ($obj as $k) {
    array_push($json_data, $k);
}

$txt = json_encode($json_data);

print($txt);

?>

