<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');

include '../includes/DBConn.php';


$postData = json_decode( file_get_contents("php://input") );

$obj = $db->query("select p.pid as PID,p.hcode as HID,p.idcard as CID,
p.prename as PRENAME,p.sex as PIMG,p.fname as `NAME`,p.lname as LNAME,
p.sex as SEX,p.birth as BIRTH,p.marystatus as MSTATUS,p.educate as EDUCATE,
p.occupa as OCCUPATION_NEW,p.nation as NATION,p.origin as RACE,p.religion as RELIGION,
p.typelive as TYPEAREA,p.familyposition as FSTATUS,p.bloodgroup as ABOGROUP,
case
when p.bloodrh='P' then 1
when p.bloodrh='N' then 2
end as RHGROUP, 
p.dischargetype as DISCHARGE,p.telephoneperson as MOBILEPHONE,
p.dateupdate as D_UPDATE
from
person as p
where p.pid='".$postData->pid."'", PDO::FETCH_OBJ);



$json_data = [];


foreach ($obj as $k) {
    array_push($json_data, $k);
}

$txt = json_encode($json_data);

print($txt);

?>

