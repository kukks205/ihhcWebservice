<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');

include '../includes/DBConn.php';

$postData = json_decode( file_get_contents("php://input") );


		$date = $postData->apdate;


                
$obj = $db->query("select * from 
(select 1 as CLINIC,
'ตรวจโรคทั่วไป' as CLINIC_NAME,
count(v.visitno)  as PCOUNT ,
v.appodate as APDATE
from
visitdiagappoint AS v
where v.appodate ='$date'  
and v.diagcode not like 'z%' and v.diagcode not like 'e11%' and v.diagcode not like 'i10%' 
union
select 
2 as CLINIC,
'ทำแผล/ล้างแผล' as CLINIC_NAME,
count(v.visitno)  as PCOUNT ,
v.appodate as APDATE
from
visitdiagappoint AS v
where v.appodate ='$date' 
and v.diagcode like 'z4%' 
union
select 
3 as CLINIC,
'คลินิกเบาหวาน' as CLINIC_NAME,
count(v.visitno)  as PCOUNT ,
v.appodate as APDATE
from
visitdiagappoint AS v
where v.appodate ='$date'  
and v.diagcode like 'e11%'
union
select 
4 as CLINIC,
'คลินิกความดันโลหิตสูง' as CLINIC_NAME,
count(v.visitno)  as PCOUNT ,
v.appodate as APDATE
from
visitdiagappoint AS v
where v.appodate ='$date'   
and v.diagcode = 'i10'
union
select 
5 as CLINIC,
'คลินิกวางแผนครอบครัว/คุมกำเนิด' as CLINIC_NAME,
count(v.visitno)  as PCOUNT ,
v.appodate as APDATE
from
visitdiagappoint AS v
where v.appodate ='$date' 
and v.diagcode like 'z30%'
union 
select 
6 as CLINIC,
'สร้างเสริมภูมิคุ้มกันโรค' as CLINIC_NAME,
count(distinct v.pid) as PCOUNT ,
v.dateappoint as APDATE
from
visitepiappoint AS v
where v.dateappoint ='$date'  ) as oapp
where PCOUNT >0 order by PCOUNT desc ", PDO::FETCH_OBJ);
$json_data = [];

foreach ($obj as $k) {
    array_push($json_data, $k);
}

$txt = json_encode($json_data);
print($txt);
?>
