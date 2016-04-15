<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');

include '../includes/DBConn.php';

$postData = json_decode( file_get_contents("php://input") );


		$date = $postData->apdate;



$obj = $db->query("select c.clinic as CLINIC,c.name as CLINIC_NAME,count(distinct p.patient_hn) as PCOUNT,
	o.nextdate as APDATE
from person p join oapp o on (o.hn=p.patient_hn) 
join clinic c on (c.clinic=o.clinic) 
where nextdate ='$date'  
group by c.clinic order by c.name", PDO::FETCH_OBJ);
$json_data = [];

foreach ($obj as $k) {
    array_push($json_data, $k);
}

$txt = json_encode($json_data);
print($txt);
?>
