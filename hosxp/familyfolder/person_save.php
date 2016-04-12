<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');

include '../includes/DBConn.php';
include '../includes/function.php';

$data = new dbClass();


$postData = json_decode( file_get_contents("php://input") );

$occupation=$data->GetStringData("select occupation as cc from occupation where occupation.nhso_code ='$postData->OCCUPATION_NEW' group by occupation.nhso_code ");
$nation = $data->GetStringData("select nationality as cc from nationality where nhso_code='$postData->NATION' ");
$race = $data->GetStringData("select nationality as cc from nationality where nhso_code='$postData->RACE' ");
$religion = $data->GetStringData("select religion as cc from religion where nhso_code='$postData->RELIGION' ");
$blood_group = $data->GetStringData("select  b.name as cc from blood_group as b where b.blood_id='$postData->ABOGROUP' ");
$blood_rh = $data->GetStringData("select name as cc from blood_rh where rh_id='$postData->RHGROUP' ");
$pname = $data->GetStringData("select provis_pname_short_name as cc from provis_pname where provis_pname_code='$postData->PRENAME' ");


$sql ="update person set pname='$pname',
fname='$postData->NAME',
lname='$postData->LNAME',
sex='$postData->SEX',
nationality='$nation',
education ='$postData->EDUCATE',
citizenship='$race',
occupation='$occupation',
religion='$religion',
marrystatus = '$postData->MSTATUS',
house_regist_type_id='$postData->TYPEAREA',
birthdate='$postData->BIRTH',
blood_group='$blood_group',
bloodgroup_rh='$blood_rh',
person_house_position_id='$postData->FSTATUS',
person_discharge_id='$postData->DISCHARGE',
mobile_phone='$postData->MOBILEPHONE' where person_id='$postData->PID'";



$stm = $db->prepare($sql);
$stm->execute();
$count = $stm->rowCount();


$r=['row'=>$count];

$txt = json_encode($r);

print($txt);

?>