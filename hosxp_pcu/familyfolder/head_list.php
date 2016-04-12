<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');

include '../includes/DBConn.php';

$postData = json_decode( file_get_contents("php://input") );

$obj=$db->query("select p.person_id as pid,concat(p.pname,p.fname,'  ',p.lname) as head_name 
from person as p 
where p.house_id = '".$postData->hid."' and p.death<>'Y' order by p.age_y desc");

$json_data = [];


foreach ($obj as $k) {
    array_push($json_data, $k);
}
$txt = json_encode($json_data);
print($txt);
?>


