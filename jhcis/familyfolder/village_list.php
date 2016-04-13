<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');

include '../includes/DBConn.php';

$obj = $db->query("select v.villcode as VILLCODE,v.villno as MOO,v.villname as `NAME`,v.villcode as VID,
    (select count(distinct p.idcard) as cc from person as p,house as h
where p.hcode=h.hcode and p.pcucodeperson=h.pcucode and h.villcode=v.villcode and v.pcucode=h.pcucode and p.dischargetype ='9' ) as POP
from village as v where v.villno>0 order by v.villno", PDO::FETCH_OBJ);
$json_data = [];

foreach ($obj as $k) {
    array_push($json_data, $k);
}
$txt = json_encode($json_data);
print($txt);
?>