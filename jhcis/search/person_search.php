<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');

include '../includes/DBConn.php';

$postData = json_decode( file_get_contents("php://input") );

            @$pn = explode(" ", $postData->text);
            $fn=$pn[0];
            @$ln=$pn[1];

$sql="select p.idcard as CID,
p.pid as PID,p.pid as HN,
concat(p.fname,'  ',p.lname) as `NAME`,
if((select pid from personimages where pid=p.pid and pcucodeperson=p.pcucodeperson) is null,(if(p.sex=1,1,2)),3) as PIMG,
concat(h.hno,' ม.',v.villno,' ถนน ',ifnull(h.road,'ไม่ระบุ')) as ADDR
from
person as p,
house as h,
village v
where p.pcucodeperson=h.pcucode and p.hcode=h.hcode
and h.pcucode=v.pcucode and h.villcode=v.villcode
and p.dischargetype='9'
and (p.idcard like '$fn%' 
or p.pid like '$fn%' 
or concat(p.fname,' ',p.lname) like '$fn%$ln%' or p.lname like '$fn%') 
limit 100";


$obj = $db->query($sql, PDO::FETCH_OBJ);
$json_data = [];


foreach ($obj as $k) {
    array_push($json_data, $k);
}
$txt = json_encode($json_data);
print($txt);
?>


