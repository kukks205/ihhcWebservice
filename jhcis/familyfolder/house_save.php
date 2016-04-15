<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');

include '../includes/DBConn.php';
include '../includes/function.php';
$data = new dbClass();


$postData = json_decode( file_get_contents("php://input") );


$hid=$postData->hid;
$vid=$postData->vid;
$house_id= $postData->house_id;
$address= $postData->address;
$road= $postData->road;
$locatype= $postData->locatype;
$lat= $postData->lat;
$lng= $postData->lng;
$housetype= $postData->housetype;
$doctor_id= $postData->doctor_id;
$head_id= $postData->head_id;
$osm=$postData->osm_sid;


$sql="update house set hno='$address',
road='$road',
hid='$house_id',
area='$locatype',
ygis='$lat',
xgis='$lng',
dateupdate=DATE_FORMAT(now(),'%d/%m/%Y %H:%i:%s'),
housechar='$housetype',
usernamedoc='$doctor_id',
pid='$head_id',pidvola='$osm' where hcode='$hid'";




$stm = $db->prepare($sql);
$stm->execute();
$count = $stm->rowCount();


$r=['row'=>$count];

$txt = json_encode($r);

print($txt);

?>
