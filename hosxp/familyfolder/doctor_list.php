<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');

include '../includes/DBConn.php';

$obj=$db->query("select d.code as DOCTOR_ID,d.name as DOCTOR_NAME from doctor as d
join opduser as o on o.doctorcode=d.code 
where d.active='Y' and o.real_staff='Y' order by code");

$json_data = [];


foreach ($obj as $k) {
    array_push($json_data, $k);
}
$txt = json_encode($json_data);
print($txt);
?>


