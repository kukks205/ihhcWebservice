<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');

include '../includes/DBConn.php';

$postData = json_decode( file_get_contents("php://input") );

            @$pn = explode(" ", $postData->text);
            $fn=$pn[0];
            @$ln=$pn[1];

$sql ="select p.cid as CID,p.person_id as PID,p.patient_hn as HN,concat(fname,' ',lname) as NAME,
if(pi.person_id is null,(if(p.sex=1,1,2)),3) as PIMG,
concat(h.address,' ม. ',v.village_moo,' ถนน') as ADDR
from person p inner join house h on (p.house_id=h.house_id) 
left join person_image pi on p.person_id=pi.person_id
join village v on (h.village_id=v.village_id)
where p.cid like '%$fn%' 
or p.patient_hn ='$fn'
or concat(p.fname,' ',p.lname) like '%$fn%$ln%' and p.death<>'Y' or p.lname like '$fn' limit 100 ";


$obj = $db->query($sql, PDO::FETCH_OBJ);
$json_data = [];


foreach ($obj as $k) {
    array_push($json_data, $k);
}
$txt = json_encode($json_data);
print($txt);
?>


