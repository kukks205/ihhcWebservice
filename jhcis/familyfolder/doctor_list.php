<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');

include '../includes/DBConn.php';

$obj=$db->query("select  u.username as DOCTOR_ID,
concat(u.fname,'  ',u.lname) as DOCTOR_NAME
from `user` as u where officertype >0");

$json_data = [];


foreach ($obj as $k) {
    array_push($json_data, $k);
}
$txt = json_encode($json_data);
print($txt);
?>


