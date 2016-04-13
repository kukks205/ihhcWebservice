<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');

include '../includes/DBConn.php';
include '../includes/function.php';

$data = new dbClass();


$postData = json_decode( file_get_contents("php://input") );

$offid=$data->GetStringData("select offid as cc from office where offid<>'0000x' limit 1");
$nation=$data->GetStringData("select nationcode as cc from cnation where mapnation='$postData->NATION'");
$race=$data->GetStringData("select nationcode as cc from cnation where mapnation='$postData->RACE'");
$educate =$data->GetStringData("select concat('0',$postData->EDUCATE) as cc"); 



$rh=$postData->RHGROUP;

switch ($rh) {
     case "1":
         $blood_rh='P';
         break;
     case "2":
         $blood_rh='N';
         break;
     default:
         $blood_rh=null;
}

$sql ="update person set prename='$postData->PRENAME',
fname='$postData->NAME',
lname='$postData->LNAME',
sex='$postData->SEX',
nation='$nation',
educate='$educate',
origin='$race',
religion='$postData->RELIGION',
marystatus= '$postData->MSTATUS',
typelive='$postData->TYPEAREA',
birth='$postData->BIRTH',
bloodgroup='$postData->ABOGROUP',
bloodrh='$blood_rh',
familyposition='$postData->FSTATUS',
dischargetype='$postData->DISCHARGE',
telephoneperson='$postData->MOBILEPHONE'
where pid='$postData->PID'";



$stm = $db->prepare($sql);
$stm->execute();
$count = $stm->rowCount();


$r=['row'=>$count];

$txt = json_encode($r);

print($txt);


?>