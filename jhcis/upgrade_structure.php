<?php

date_default_timezone_set("Asia/Bangkok");

include 'includes/DBConn.php';

$filename = "log/iHHC-UpgradeStructure" . date("Y-m-d") . ".log";
$fp = fopen($filename, 'a');

// start check table chousechar
$sql_chousechar_check = "show tables like'chousechar'";
$result_chousechar_check = $db->prepare($sql_chousechar_check);
$result_chousechar_check->execute();

if ($result_chousechar_check->rowCount() > 0):
    $chousechar_check = '[' . date('Y-m-d H:i:s') . '] ' . "table chousechar check pass.....[OK]<br>\n";
    fputs($fp, $chousechar_check);

else:
    $chousechar_check = '[' . date('Y-m-d h:i:s') . '] ' . "table chousechar empty กำลังนำเข้าตาราง....";
    fputs($fp, $chousechar_check);
    $sql_chousechar = "DROP TABLE IF EXISTS `chousechar`;
CREATE TABLE `chousechar` (
  `housechar` varchar(1) CHARACTER SET utf8 NOT NULL,
  `housechar_name` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `export_code` varchar(1) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`housechar`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `chousechar` VALUES ('1', 'บ้านเดี่ยว บ้านแฝด', '1');
INSERT INTO `chousechar` VALUES ('2', 'ทาวน์เฮาส์ ทาวน์โฮม', '2');
INSERT INTO `chousechar` VALUES ('3', 'คอนโดมิเนียม', '3');
INSERT INTO `chousechar` VALUES ('4', 'อพาร์ทเมนท์ หอพัก', '4');
INSERT INTO `chousechar` VALUES ('5', 'บ้านพักคนงาน', '5');
INSERT INTO `chousechar` VALUES ('8', 'อื่นๆ', '8');
INSERT INTO `chousechar` VALUES ('9', 'ไม่ทราบ', '9');";

    $import = $db->exec($sql_chousechar);
    $import_chousechar = "Import Table chousechar Complete.....[OK]<br> \n  ";
    fputs($fp, $import_chousechar);
endif;

// End check table chousechar
// start check table ctypearea
$sql_ctypearea_check = "show tables like'ctypearea'";
$result_ctypearea_check = $db->prepare($sql_ctypearea_check);
$result_ctypearea_check->execute();

if ($result_ctypearea_check->rowCount() > 0):
    $ctypearea_check = '[' . date('Y-m-d H:i:s') . '] ' . "table ctypearea check pass.....[OK]<br>\n";
    fputs($fp, $ctypearea_check);

else:
    $ctypearea_check = '[' . date('Y-m-d h:i:s') . '] ' . "table ctypearea empty กำลังนำเข้าตาราง....";
    fputs($fp, $ctypearea_check);

    $sql_ctypearea = "CREATE TABLE `ctypearea` (
  `typearea` varchar(1) NOT NULL,
  `typearea_name` varchar(50) NOT NULL,
  PRIMARY KEY (`typearea`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `ctypearea` VALUES ('1', 'มีชื่ออยู่ตามทะเบียนบ้านในเขตรับผิดชอบและอยู่จริง'), 
('2', 'มีชื่ออยู่ตามทะเบียนบ้านในเขตรับผิดชอบแต่ตัวไม่อยู'), ('3', 'มาอาศัยอยู่ในเขตรับผิดชอบแต่ทะเบียนบ้านอยู่นอกเขต'), 
('4', 'ที่อาศัยอยู่นอกเขตรับผิดชอบและเข้ามารับบริการ'), ('5', 'มาอาศัยในเขตรับผิดชอบแต่ไม่ได้อยู่ตามทะเบียนบ้านใน');";

    $import = $db->exec($sql_ctypearea);
    $import_ctypearea = "Import Table ctypearea Complete.....[OK]<br> \n  ";
    fputs($fp, $import_ctypearea);
endif;

// End check table ctypearea
// start check table ctypedisch
$sql_ctypedisch_check = "show tables like'ctypedisch'";
$result_ctypedisch_check = $db->prepare($sql_ctypedisch_check);
$result_ctypedisch_check->execute();

if ($result_ctypedisch_check->rowCount() > 0):
    $ctypedisch_check = '[' . date('Y-m-d H:i:s') . '] ' . "table ctypedisch check pass.....[OK]<br>\n";
    fputs($fp, $ctypedisch_check);

else:
    $ctypedisch_check = '[' . date('Y-m-d h:i:s') . '] ' . "table ctypedisch empty กำลังนำเข้าตาราง....";
    fputs($fp, $ctypedisch_check);

    $sql_ctypedisch = "CREATE TABLE `ctypedisch` (
  `discharge_id` varchar(2) NOT NULL DEFAULT '',
  `discharge_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`discharge_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `ctypedisch` VALUES ('01', 'หาย'), ('02', 'ตาย'), ('03', 'ยังรักษาอยู่'), ('04', 'ไม่ทราบ(ไม่มีข้อมูล)'), 
('05', 'รอจำหน่าย/เฝ้าระวัง'), ('06', 'ขาดการรักษาไม่มาติดต่ออีก(ทราบว่าขาดการรักษา)'), ('07', 'ครบการรักษา'),
('08', 'โรคอยู่ในภาวะสงบ(inactive)ไม่มีความจำเป็นต้องรักษา'), ('09', 'ปฎิเสธการรักษา'), ('10', 'ออกจากพื้นที่');";

    $import = $db->exec($sql_ctypedisch);
    $import_ctypedisch = "Import Table ctypedisch Complete.....[OK]<br> \n  ";
    fputs($fp, $import_ctypedisch);
endif;

// End check table ctypedisch



fclose($fp);
?>

