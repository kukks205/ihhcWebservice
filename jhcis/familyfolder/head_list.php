<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');

include '../includes/DBConn.php';

$postData = json_decode( file_get_contents("php://input") );

$obj=$db->query("select p.pid,concat(p.fname,'  ',p.lname) head_name
from
person as p
,house as h 
where p.pcucodeperson=h.pcucode and p.hcode=h.hcode
and h.hcode='".$postData->hid."' and p.dischargetype='9' order by birth ");

$json_data = [];


foreach ($obj as $k) {
    array_push($json_data, $k);
}
$txt = json_encode($json_data);
print($txt);
?>


