<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');

include '../includes/DBConn.php';

$postData = json_decode(file_get_contents("php://input"));

$sql = "select
p.pid AS PID,
p.idcard AS CID,
p.sex AS PIMG,
h.villcode as VILLCODE,
concat(t.titlename,p.fname,'  ',p.lname) as PERSON_NAME,
if(p.telephoneperson,1,0) as TEL,
replace(p.telephoneperson,'-','') as MPHONE,
p.sex,getAgeYearNum(p.birth,now()) as AGE,
h.hno as address,v.villno as MOO,v.villname
FROM
person AS p,
house as h,
ctitle as t,
village v
where p.pcucodeperson=h.pcucode and p.hcode=h.hcode
and h.pcucode=v.pcucode and h.villcode=v.villcode
and p.prename = t.titlecode
and h.hcode='" . $postData->hid . "' order by p.birth";

$result = $db->prepare($sql);
$result->execute();
$check = $result->rowCount();

if ($check > 0):
    $obj = $db->query($sql, PDO::FETCH_OBJ);
    $json_data = [];
    foreach ($obj as $k) {
        array_push($json_data, $k);
    }
endif;
    $txt = json_encode($json_data);
    print($txt);
?>


