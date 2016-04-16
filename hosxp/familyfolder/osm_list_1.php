<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');

include '../includes/DBConn.php';

$postData = json_decode( file_get_contents("php://input") );

$obj=$db->query("select  vm.village_organization_mid as OSM_ID,concat(p.pname,p.fname,'  ',p.lname) as OSM_NAME,
    if(p.mobile_phone is null,'0','1') as CAN_TEL,
    REPLACE(p.mobile_phone,'-','') as OSM_TEL
from village_organization_member as vm 
join village_organization as vo on vm.village_organization_id = vo.village_organization_id
join village_organization_type as vt on vo.village_organization_type_id = vt.village_organization_type_id
join person as p on p.person_id = vm.person_id
where vt.village_organization_type_name='อสม.' and vo.village_id='".$postData->vid."'");

$json_data = [];


foreach ($obj as $k) {
    array_push($json_data, $k);
}
$txt = json_encode($json_data);
print($txt);
?>


