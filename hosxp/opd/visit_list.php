<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');

include '../includes/DBConn.php';

$postData = json_decode( file_get_contents("php://input") );


$obj = $db->query("select concat(p.pname,p.fname,' ',p.lname) as ptname,o.vn
,o.vstdate,o.vsttime,p.sex,ov.cc,d.name,oq.seq_id,v.age_y,p2.person_id,i.name as diag,s.name as dep
from ovst o
left outer join vn_stat v on v.vn = o.vn  
left outer join patient p on p.hn = o.hn  
join person p2 on (p2.cid=p.cid)
left outer join pttype t on t.pttype = o.pttype  
left outer join doctor d on d.code = o.doctor  
left outer join icd101 i on i.code = v.main_pdx  
left outer join spclty s on s.spclty = o.spclty  
left outer join ovstost st on st.ovstost = o.ovstost  
left outer join ovst_seq oq on oq.vn = o.vn  
left outer join ovst_nhso_send oo1 on oo1.vn = o.vn  
join opdscreen ov on (ov.vn=o.vn)   
where o.vstdate='2016-03-18'
order by o.vstdate,o.vsttime", PDO::FETCH_OBJ);
$json_data = [];


foreach ($obj as $k) {
    array_push($json_data, $k);
}
$txt = json_encode($json_data);
print($txt);
?>


