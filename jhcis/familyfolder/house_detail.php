<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');

include '../includes/DBConn.php';


$postData = json_decode( file_get_contents("php://input") );

$obj = $db->query("select h.hcode AS HID,h.villcode AS VILLCODE,h.hno AS ADDRESS,
h.housechar AS HOUSETYPE,h.hid AS HOUSE_ID,h.road AS ROAD,
h.area AS LOCATYPE,h.ygis as LAT,h.xgis as LNG,h.pcucodepersonvola,
null AS CONDO,h.usernamedoc AS DOCTOR,h.pid AS HEAD_ID,v.villname AS VILLNAME,
v.villno AS MOO,h.pidvola AS OSM_ID,h.pidvola AS OSM_SID,
(select REPLACE(p.telephoneperson,'-','') as cc from person p where p.pid=h.pidvola and p.pcucodeperson=h.pcucode) as OSM_TEL
from house AS h,
village AS v
where
v.pcucode = h.pcucode AND v.villcode = h.villcode
and h.hcode='".$postData->hid."'", PDO::FETCH_OBJ);



$json_data = [];


foreach ($obj as $k) {
    array_push($json_data, $k);
}

$txt = json_encode($json_data);

print($txt);

?>

