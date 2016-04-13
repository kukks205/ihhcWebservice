<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');

include '../includes/DBConn.php';

$postData = json_decode( file_get_contents("php://input") );

$obj=$db->query("select
p.pid as OSM_ID,
concat(p.fname,'  ',p.lname) OSM_NAME
from
person as p
,persontype as ps
,house as h 
where p.pcucodeperson=ps.pcucodeperson and p.pid=ps.pid
and p.pcucodeperson=h.pcucode and p.hcode=h.hcode
and ps.typecode='09' and h.villcode='".$postData->vid."'");

$json_data = [];


foreach ($obj as $k) {
    array_push($json_data, $k);
}
$txt = json_encode($json_data);
print($txt);
?>


