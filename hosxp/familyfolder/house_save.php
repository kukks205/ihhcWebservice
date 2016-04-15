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
if($postData->osm_sid<1):
  $osm_sid=$data->GetStringData("select get_serialnumber('village_organization_member_service_id') as cc");
else:
  $osm_sid=$postData->osm_sid;
endif;



$sql="update house set address='$address',
road='$road',
census_id='$house_id',
location_area_id='$locatype',
latitude='$lat',
longitude='$lng',
last_update=DATE_FORMAT(now(),'%d/%m/%Y %H:%i:%s'),
house_type_id='$housetype',
doctor_code='$doctor_id',
head_person_id='$head_id'
where house_id=$hid";

//$osm="update village_organization_member_service set village_organization_mid='$osm_id' where village_organization_member_service_id ='$osm_sid'";
$osm="replace into village_organization_member_service(village_organization_member_service_id,village_organization_mid,house_id,village_id)
values ('$osm_sid','$osm_id','$hid','$vid')";


$stm = $db->prepare($sql);
$stm->execute();
$count = $stm->rowCount();

$db->exec($osm);

$r=['row'=>$count];

$txt = json_encode($r);

print($txt);

?>
