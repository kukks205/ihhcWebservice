<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');

include '../includes/DBConn.php';

$postData = json_decode( file_get_contents("php://input") );

$obj = $db->query("select v.villcode as VILLCODE,v.villno as MOO,v.villname as `NAME`,v.villcode as VID  
    from village as v where v.villcode='".$postData->vid."' order by villcode ", PDO::FETCH_OBJ);

$json_data = [];

foreach ($obj as $k) {
    array_push($json_data, $k);
}
$txt = json_encode($json_data);
print($txt);
?>
