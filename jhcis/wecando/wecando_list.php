<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');

include '../includes/DBConn.php';
include '../includes/function.php';

$data = new dbClass();



$postData = json_decode( file_get_contents("php://input") );

$doctor = $postData->user;

$sql ="select count(distinct p.idcard ) as cc 
from person as p, house as h 
where 
p.pcucodeperson=h.pcucode 
and p.hcode=h.hcode 
and p.dischargetype='9'
and RIGHT(h.villcode,2)<>'00'
and h.usernamedoc='$doctor'";

$pop= $data->GetStringData($sql);

$obj = $db->query("select '1' as id,'W:Worker' as name,'วัยทำงาน (25-59 ปี)' as desp,(select count(distinct p.idcard ) as num 
from person as p, house as h 
where 
p.pcucodeperson=h.pcucode 
and p.hcode=h.hcode 
and p.dischargetype='9'
and RIGHT(h.villcode,2)<>'00'
and getAgeYearNum(p.birth,CURDATE()) between 25 and 59 and h.usernamedoc='$doctor') as cc
union
select '2' as id,'E:Educate&Teenage' as name,'วัยเรียนและวัยรุ่น (6-24 ปี)' as desp,(select count(distinct p.idcard ) as num
from person as p, house as h 
where 
p.pcucodeperson=h.pcucode 
and p.hcode=h.hcode 
and p.dischargetype='9'
and RIGHT(h.villcode,2)<>'00'
and getAgeYearNum(p.birth,CURDATE()) between 6 and 24 and h.usernamedoc='$doctor') as cc
union
select '3' as id,'C:Child' as name,'เด็กแรกเกิดและวัยเด็ก (0-5 ปี)' as desp,(select count(distinct p.idcard ) as num
from person as p, house as h 
where 
p.pcucodeperson=h.pcucode 
and p.hcode=h.hcode 
and p.dischargetype='9'
and RIGHT(h.villcode,2)<>'00'
and getAgeYearNum(p.birth,CURDATE()) between 0 and 5 and h.usernamedoc='$doctor') as cc
union 
select '4' as id,'A:ANC&PNC' as name,'หญิงตั้งครรภ์และหลังคลอด' as desp,(select count(distinct p.idcard) as num 
from visitancpregnancy as a ,person as p,house as h 
where 
a.pcucodeperson = p.pcucodeperson 
and a.pid = p.pid
and h.hcode = p.hcode
and p.dischargetype='9'
and DATE_ADD(a.edc,INTERVAL 8 WEEK) > CURDATE()
and RIGHT(h.villcode,2)<>'00' and h.usernamedoc='$doctor') as cc
union 
select '5' as id,'N:NCD' as name,'ผู้ป่วยไม่ติดต่อเรื้อรัง' as desp,(select count(distinct p.idcard) as num
from personchronic as c ,person as p,house as h 
where c.pcucodeperson = p.pcucodeperson 
and c.pid = p.pid
and c.typedischart not in ('02','07','08','10')
and p.dischargetype='9'
and RIGHT(h.villcode,2)<>'00'
and h.hcode = p.hcode
and h.usernamedoc='มาลินี') as cc
union 
select '6' as id,'D:Disable' as name,'ผู้พิการและด้อยโอกาส' as desp,(select count(distinct p.idcard) as num
from personunable as d ,person as p,house as h 
where 
d.pcucodeperson = p.pcucodeperson 
and d.pid = p.pid
and h.hcode = p.hcode
and p.dischargetype='9'
and RIGHT(h.villcode,2)<>'00' and h.usernamedoc='$doctor') as cc
union 
select '7' as id,'O:Older' as name,'ผู้สูงอายุ (60ปีขึ้นไป)' as desp,(select count(distinct p.idcard ) as num 
from person as p, house as h 
where 
p.pcucodeperson=h.pcucode 
and p.hcode=h.hcode 
and p.dischargetype='9'
and RIGHT(h.villcode,2)<>'00'
and getAgeYearNum(p.birth,CURDATE()) >59 and h.usernamedoc='$doctor') as cc", PDO::FETCH_OBJ);



$json_data = [];
$popData=[];
array_push($popData, ['pop'=>$pop]);


foreach ($obj as $k) {
    array_push($json_data, $k);
}


$txt = json_encode($json_data);
$txtpop =json_encode($popData); 

//print($txtpop);
//print($txt);

print('{"data":' . $txt . ',"popdata":'.$txtpop.'}');
//print($txt);

?>

