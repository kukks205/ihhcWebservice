<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');

include '../includes/DBConn.php';

$postData = json_decode( file_get_contents("php://input") );

$obj = $db->query("select
h.hcode as HID,
h.villcode as VILLCODE,
h.hno as ADDRESS,
h.road as ROAD,
(select concat(p.fname,p.lname) as cc from person as p where p.pid=h.pid and p.hcode=h.hcode) as HEAD_NAME,
h.ygis as LAT,
h.xgis as LNG,
v.villno as MOO,
v.villname as VILLNAME,
if(h.housepic is null,0,h.hcode) as HOUSE_IMG,
h.ygis VLat,
h.xgis as VLng
from
house as h,
village as v 
where v.pcucode = h.pcucode AND  v.villcode = h.villcode
and v.villcode='".$postData->vid."' group by h.hcode", PDO::FETCH_OBJ);
$json_data = [];

foreach ($obj as $k) {
    array_push($json_data, $k);
}
$txt = json_encode($json_data);
print($txt);
?>