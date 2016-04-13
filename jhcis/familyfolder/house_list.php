<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');

include '../includes/DBConn.php';

$postData = json_decode( file_get_contents("php://input") );

$obj = $db->query("select h.hcode as HID,
h.villcode as VILLCODE,
h.hno as ADDRESS,
h.road as ROAD,
h.pid,
(select concat(t.titlename,p.fname,' ',p.lname) as cc from person as p,ctitle as t  where p.pid=h.pid and p.pcucodeperson=h.pcucode and p.prename=t.titlecode) as HEADNAME,
if(h.housepic is null,false,true) as IMG,v.villname as VILLNAME,v.villno as MOO,
(select count(distinct p.idcard) as cc from person as p
where p.hcode=h.hcode and p.pcucodeperson=h.pcucode and p.dischargetype ='9' ) as POP,
(select concat(t.titlename,p.fname,'  ',p.lname) from person as p,ctitle as t where p.prename=t.titlecode and p.pid=h.pidvola and p.pcucodeperson=h.pcucodepersonvola) as OSM,
(select d.fullname as cc from `user` as d where d.username = h.usernamedoc) as DOCTOR 
from
house as h,
village as v 
where 
h.villcode ='".$postData->vid."'
and v.pcucode = h.pcucode 
and v.villcode = h.villcode
order by h.hno asc", PDO::FETCH_OBJ);
$json_data = [];

foreach ($obj as $k) {
    array_push($json_data, $k);
}
$txt = json_encode($json_data);
print($txt);
//and v.villcode ='".$postData->vid."'
?>
