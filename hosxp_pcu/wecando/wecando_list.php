<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');

include '../includes/DBConn.php';
include '../includes/function.php';

$data = new dbClass();

$postData = json_decode( file_get_contents("php://input") );

$dm= $data->GetStringData("select sys_value as cc from sys_var where sys_name='dm_clinic_code' ");
$ht= $data->GetStringData("select sys_value as cc from sys_var where sys_name='ht_clinic_code' ");
$doctor = $data->GetStringData("select doctorcode as cc from opduser where loginname='$postData->user' ");

$sql ="select count(p.person_id) as cc  
from person as p,house as h 
where h.house_id = p.house_id 
and p.death='N' 
and p.person_discharge_id='9'
and p.patient_hn not in (select hn from clinicmember where clinic in ('$dm','$ht'))
and h.doctor_code='$doctor'";

$pop= $data->GetStringData($sql);

$obj = $db->query("select '1' as id,'W:Worker' as name,'วัยทำงาน (25-59 ปี)' as desp,(select count(p.person_id) as cc  
from person as p,house as h 
where h.house_id = p.house_id 
and p.death='N' 
and p.age_y between '25' and '59' 
and p.person_discharge_id='9'
and p.patient_hn not in (select hn from clinicmember where clinic in ('$dm','$ht'))
and h.doctor_code='$doctor') as cc
UNION
select '2' as id,'E:Educate&Teenage' as name,'วัยเรียนและวัยรุ่น (6-24 ปี)' as desp,(select count(p.person_id) as cc  
from person as p,house as h 
where h.house_id = p.house_id 
and p.death='N' 
and p.age_y between '6' and '24'
and p.person_discharge_id='9'
and h.doctor_code='$doctor') as cc
UNION
select '3' as id,'C:Child' as name,'เด็กแรกเกิดและวัยเด็ก (0-5 ปี)' as desp,(select count(distinct p.person_id) as cc  
from person as p,house as h 
where h.house_id = p.house_id 
and p.death='N' 
and p.age_y between '0' and '5' 
and p.person_discharge_id='9'
and h.doctor_code='$doctor') as cc
UNION
select '4' as id,'A:ANC&PNC' as name,'หญิงตั้งครรภ์และหลังคลอด' as desp,(select count(distinct p.person_id) as cc 
from house as h ,person as p, person_anc as pa 
where h.house_id = p.house_id 
and p.person_id = pa.person_id 
and pa.discharge <>'Y'
and p.person_discharge_id='9'
and p.death <>'Y' 
and h.doctor_code='$doctor') as cc
UNION
select '5' as id,'N:NCD' as name,'ผู้ป่วยไม่ติดต่อเรื้อรัง' as desp,(select count(p.person_id) as cc  
from person as p,house as h 
where h.house_id = p.house_id 
and p.death='N' 
and p.person_discharge_id='9'
and p.patient_hn in (select hn from clinicmember where clinic in ('$dm','$ht'))
and h.doctor_code='0001') as cc
UNION
select '6' as id,'D:Disable' as name,'ผู้พิการและด้อยโอกาส' as desp,(select count(distinct p.person_id) as cc 
from  house as h,person as p,person_deformed as pd
where  h.house_id = p.house_id 
and p.person_id = pd.person_id 
and p.death <>'Y' 
and  p.person_discharge_id='9'
and h.doctor_code='$doctor') as cc
UNION
select '7' as id,'O:Older' as name,'ผู้สูงอายุ (60ปีขึ้นไป)' as desp,(select count(p.person_id) as cc  
from person as p,house as h 
where h.house_id = p.house_id 
and p.death='N' 
and p.age_y >59
and p.person_discharge_id='9'
and p.patient_hn not in (select hn from clinicmember)
and h.doctor_code='$doctor') as cc", PDO::FETCH_OBJ);



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

