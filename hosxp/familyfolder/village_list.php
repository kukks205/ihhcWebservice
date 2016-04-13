<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');

include '../includes/DBConn.php';

$obj = $db->query("select village_id as VILLCODE,village_moo as MOO,village_name as NAME,village_code as VID,doctor_code AS DOCTOR,
    (select count(distinct cid) as cc from person where village_id=village.village_id and death<>'y' ) as POP 
       from village where village_moo>0 order by village_code ", PDO::FETCH_OBJ);
$json_data = [];

foreach ($obj as $k) {
    array_push($json_data, $k);
}
$txt = json_encode($json_data);
print($txt);
?>