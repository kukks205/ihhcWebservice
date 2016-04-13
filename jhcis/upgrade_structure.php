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
// start check table hhc_diag_map
$sql_hhc_diag_map_check = "show tables like'hhc_diag_map'";
$result_hhc_diag_map_check = $db->prepare($sql_hhc_diag_map_check);
$result_hhc_diag_map_check->execute();

if ($result_hhc_diag_map_check->rowCount() > 0):
    $hhc_diag_map_check = '[' . date('Y-m-d H:i:s') . '] ' . "table hhc_diag_map check pass.....[OK]<br>\n";
    fputs($fp, $hhc_diag_map_check);

else:
    $hhc_diag_map_check = '[' . date('Y-m-d h:i:s') . '] ' . "table hhc_diag_map empty กำลังนำเข้าตาราง....";
    fputs($fp, $hhc_diag_map_check);

    $sql_hhc_diag_map = "CREATE TABLE `hhc_diag_map` (
  `homehealthcode` varchar(7) NOT NULL DEFAULT '',
  `pdx` varchar(7) DEFAULT NULL,
  PRIMARY KEY (`homehealthcode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `hhc_diag_map` VALUES ('1A000', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1A001', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1A002', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1A003', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1A004', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1A005', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1A008', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1A009', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1A010', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1A011', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1A012', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1A013', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1A014', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1A015', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1A016', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1A018', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1A019', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1A020', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1A021', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1A022', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1A023', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1A024', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1A025', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1A028', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1A029', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1A030', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1A031', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1A032', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1A038', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1A039', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1A10', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1A11', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1A12', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1A13', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1A14', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1A18', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1A19', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1A200', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1A201', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1A202', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1A203', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1A208', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1A209', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1A210', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1A211', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1A212', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1A213', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1A214', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1A215', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1A216', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1A217', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1A218', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1A219', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1A220', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1A221', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1A222', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1A223', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1A224', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1A225', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1A226', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1A227', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1A228', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1A229', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1A30', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1A31', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1A32', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1A33', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1A34', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1A35', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1A39', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1A400', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1A401', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1A402', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1A403', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1A404', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1A405', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1A406', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1A407', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1A408', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1A409', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1A410', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1A411', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1A412', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1A413', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1A418', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1A419', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1A420', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1A421', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1A422', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1A428', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1A429', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1A430', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1A431', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1A439', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1A50', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1A51', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1A52', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1A53', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1A54', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1A58', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1A59', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1A90', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1A99', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1B000', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1B001', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1B002', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1B003', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1B004', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1B005', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1B008', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1B009', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1B01', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1B020', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1B021', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1B022', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1B023', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1B024', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1B025', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1B028', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1B029', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1B100', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1B101', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1B102', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1B103', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1B108', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1B109', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1B110', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1B111', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1B112', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1B118', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1B119', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1B120', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1B121', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1B128', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1B129', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1C00', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1C01', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1C02', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1C10', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1C11', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1C20', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1C3', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1C4', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1D00', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1D01', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1D02', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1D03', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1D04', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1D05', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1D08', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1D09', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1D10', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1D11', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1D12', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1D13', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1D18', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1D19', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1D20', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1D21', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1D28', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1E00', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1E01', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1E10', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1E11', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1E12', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1E13', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1E18', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1F00', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1F08', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1F09', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1F10', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1F11', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1F12', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1F18', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1F19', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1F20', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1F21', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1F28', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1F29', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1G00', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1G01', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1G08', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1G09', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1G10', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1G11', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1G12', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1G13', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1G14', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1G18', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1G19', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1H000', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1H001', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1H010', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1H020', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1H030', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1H040', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1H041', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1H050', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1H051', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1H060', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1H061', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1H070', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1H071', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1H10', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1H18', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1H19', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1H200', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1H201', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1H202', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1H203', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1H204', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1H205', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1H206', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1H207', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1H210', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1H211', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1H212', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1H213', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1H214', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1H215', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1H216', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1H217', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1H280', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1H281', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1H288', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1H300', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1H301', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1H302', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1H308', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1I00', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1I01', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1I02', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1I03', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1I04', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1I05', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1I06', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1I07', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1I08', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1J00', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1J01', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1J02', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1J03', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1J04', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1J05', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1J08', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1J09', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1J10', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1J11', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1J18', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1J19', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1J20', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1J21', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1J22', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1J23', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1J24', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1J25', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1J26', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1J27', 'Z71.8');
INSERT INTO `hhc_diag_map` VALUES ('1J28', 'Z71.8');";

    $import = $db->exec($sql_hhc_diag_map);
    $import_hhc_diag_map = "Import Table hhc_diag_map Complete.....[OK]<br> \n  ";
    fputs($fp, $import_hhc_diag_map);
endif;

// End check table hhc_diag_map
// start check table hhc_guideline_list
$sql_hhc_guideline_list_check = "show tables like'hhc_guideline_list'";
$result_hhc_guideline_list_check = $db->prepare($sql_hhc_guideline_list_check);
$result_hhc_guideline_list_check->execute();

if ($result_hhc_guideline_list_check->rowCount() > 0):
    $hhc_guideline_list_check = '[' . date('Y-m-d H:i:s') . '] ' . "table hhc_guideline_list check pass.....[OK]<br>\n";
    fputs($fp, $hhc_guideline_list_check);

else:
    $hhc_guideline_list_check = '[' . date('Y-m-d h:i:s') . '] ' . "table hhc_guideline_list empty กำลังนำเข้าตาราง....";
    fputs($fp, $hhc_guideline_list_check);

    $sql_hhc_guideline_list = "CREATE TABLE `hhc_guideline_list` (
  `hhc_guideline_list_id` int(11) NOT NULL AUTO_INCREMENT,
  `person_visit_type_id` varchar(7) CHARACTER SET utf8 NOT NULL,
  `hhc_guideline_list_subtype_id` int(11) NOT NULL,
  `hhc_guideline_list_text` varchar(250) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`hhc_guideline_list_id`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8;";

    $import = $db->exec($sql_hhc_guideline_list);
    $import_hhc_guideline_list = "Import Table hhc_guideline_list Complete.....[OK]<br> \n  ";
    fputs($fp, $import_hhc_guideline_list);
endif;

// End check table ctypedisch

// start check table hhc_guideline_list_subtype
$sql_hhc_guideline_list_subtype_check = "show tables like'hhc_guideline_list_subtype'";
$result_hhc_guideline_list_subtype_check = $db->prepare($sql_hhc_guideline_list_subtype_check);
$result_hhc_guideline_list_subtype_check->execute();

if ($result_hhc_guideline_list_subtype_check->rowCount() > 0):
    $hhc_guideline_list_subtype_check = '[' . date('Y-m-d H:i:s') . '] ' . "table hhc_guideline_list_subtype check pass.....[OK]<br>\n";
    fputs($fp, $hhc_guideline_list_subtype_check);

else:
    $hhc_guideline_list_subtype_check = '[' . date('Y-m-d h:i:s') . '] ' . "table hhc_guideline_list_subtype empty กำลังนำเข้าตาราง....";
    fputs($fp, $hhc_guideline_list_subtype_check);

    $sql_hhc_guideline_list_subtype = "CREATE TABLE `hhc_guideline_list_subtype` (
  `hhc_guideline_list_subtype_id` int(11) NOT NULL AUTO_INCREMENT,
  `hhc_guideline_list_subtype_name` varchar(50) NOT NULL,
  `hhc_guideline_type_id` int(11) NOT NULL,
  PRIMARY KEY (`hhc_guideline_list_subtype_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

INSERT INTO `hhc_guideline_list_subtype` VALUES ('1', 'Subjective (ข้อมูลที่ได้จากผู้ป่วยบอกเล่า)', '1');
INSERT INTO `hhc_guideline_list_subtype` VALUES ('2', 'Objective (ข้อมูลที่ได้จากผู้เยี่ยม)', '1');
INSERT INTO `hhc_guideline_list_subtype` VALUES ('3', 'Assessment (การประเมิน)', '1');
INSERT INTO `hhc_guideline_list_subtype` VALUES ('4', 'Plan management (การวางแผน)', '1');
INSERT INTO `hhc_guideline_list_subtype` VALUES ('5', 'Immobility  Impairment  (การเคลื่อนไหวร่างกาย)', '2');
INSERT INTO `hhc_guideline_list_subtype` VALUES ('6', 'Nutrition  (โภชนาการ)', '2');
INSERT INTO `hhc_guideline_list_subtype` VALUES ('7', 'Housing  (ภาวะแวดล้อมทั่วไปของบ้าน)', '2');
INSERT INTO `hhc_guideline_list_subtype` VALUES ('8', 'Other  people  (บุคคลอื่นที่เกี่ยวข้อง)', '2');
INSERT INTO `hhc_guideline_list_subtype` VALUES ('9', 'Medication  (การใช้ยา)', '2');
INSERT INTO `hhc_guideline_list_subtype` VALUES ('10', 'Examination (ตรวจร่างกาย)', '2');
INSERT INTO `hhc_guideline_list_subtype` VALUES ('11', 'Safety (ความปลอดภัย)', '2');
INSERT INTO `hhc_guideline_list_subtype` VALUES ('12', 'Spiritual (จิตวิญญาณ)', '2');
INSERT INTO `hhc_guideline_list_subtype` VALUES ('13', 'Service(ความช่วยเหลือ)', '2');
INSERT INTO `hhc_guideline_list_subtype` VALUES ('14', 'Interventions(บริการทางการพยาบาลที่ให้)', '1');
INSERT INTO `hhc_guideline_list_subtype` VALUES ('15', 'Evaluation(การประเมินผลทางการพยาบาล)', '1');";

    $import = $db->exec($sql_hhc_guideline_list_subtype);
    $import_hhc_guideline_list_subtype = "Import Table hhc_guideline_list_subtype Complete.....[OK]<br> \n  ";
    fputs($fp, $import_hhc_guideline_list_subtype);
endif;

// End check table hhc_guideline_list_subtype



// start check table hhc_guideline_type
$sql_hhc_guideline_type_check = "show tables like'hhc_guideline_type'";
$result_hhc_guideline_type_check = $db->prepare($sql_hhc_guideline_type_check);
$result_hhc_guideline_type_check->execute();

if ($result_hhc_guideline_type_check->rowCount() > 0):
    $hhc_guideline_type_check = '[' . date('Y-m-d H:i:s') . '] ' . "table hhc_guideline_type check pass.....[OK]<br>\n";
    fputs($fp, $hhc_guideline_type_check);

else:
    $hhc_guideline_type_check = '[' . date('Y-m-d h:i:s') . '] ' . "table hhc_guideline_type empty กำลังนำเข้าตาราง....";
    fputs($fp, $hhc_guideline_type_check);

    $sql_hhc_guideline_type = "CREATE TABLE `hhc_guideline_type` (
  `hhc_guideline_type_id` int(11) NOT NULL,
  `hhc_guideline_type_name` varchar(250) NOT NULL,
  PRIMARY KEY (`hhc_guideline_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `hhc_guideline_type` VALUES ('1', 'SOAP');
INSERT INTO `hhc_guideline_type` VALUES ('2', 'IN HOME SSS');";

    $import = $db->exec($sql_hhc_guideline_type);
    $import_hhc_guideline_type = "Import Table hhc_guideline_type Complete.....[OK]<br> \n  ";
    fputs($fp, $import_hhc_guideline_type);
endif;

// End check table hhc_guideline_type



// start check table hhc_oxford_knee_score_screen
$sql_hhc_oxford_knee_score_screen_check = "show tables like'hhc_oxford_knee_score_screen'";
$result_hhc_oxford_knee_score_screen_check = $db->prepare($sql_hhc_oxford_knee_score_screen_check);
$result_hhc_oxford_knee_score_screen_check->execute();

if ($result_hhc_oxford_knee_score_screen_check->rowCount() > 0):
    $hhc_oxford_knee_score_screen_check = '[' . date('Y-m-d H:i:s') . '] ' . "table hhc_oxford_knee_score_screen check pass.....[OK]<br>\n";
    fputs($fp, $hhc_oxford_knee_score_screen_check);

else:
    $hhc_oxford_knee_score_screen_check = '[' . date('Y-m-d h:i:s') . '] ' . "table hhc_oxford_knee_score_screen empty กำลังนำเข้าตาราง....";
    fputs($fp, $hhc_oxford_knee_score_screen_check);

    $sql_hhc_oxford_knee_score_screen = "CREATE TABLE `hhc_oxford_knee_score_screen` (
  `oks_id` int(11) NOT NULL,
  `person_id` int(11) NOT NULL,
  `vn` varchar(13) DEFAULT NULL,
  `screen_date` date DEFAULT NULL,
  `screen_time` time DEFAULT NULL,
  `pain` int(11) DEFAULT NULL,
  `pain_knee` int(11) DEFAULT NULL,
  `trouble_washing` int(11) DEFAULT NULL,
  `trouble_car` int(11) DEFAULT NULL,
  `able_walk` int(11) DEFAULT NULL,
  `stand_up_chair` int(11) DEFAULT NULL,
  `limping_walking` int(11) DEFAULT NULL,
  `kneel_down_get_up` int(11) DEFAULT NULL,
  `pain_at_night` int(11) DEFAULT NULL,
  `pain_work` int(11) DEFAULT NULL,
  `let_down` int(11) DEFAULT NULL,
  `shopping` int(11) DEFAULT NULL,
  `stairs` int(11) DEFAULT NULL,
  `staff` varchar(25) DEFAULT NULL,
  `total_point` int(11) DEFAULT NULL,
  PRIMARY KEY (`oks_id`,`person_id`)
) ENGINE=MyISAM DEFAULT CHARSET=tis620;";
    $import = $db->exec($sql_hhc_oxford_knee_score_screen);
    $import_hhc_oxford_knee_score_screen = "Import Table hhc_oxford_knee_score_screen Complete.....[OK]<br> \n  ";
    fputs($fp, $import_hhc_oxford_knee_score_screen);
endif;

// End check table hhc_oxford_knee_score_screen


// start check table hhc_person_adl_screen
$sql_hhc_person_adl_screen_check = "show tables like'hhc_person_adl_screen'";
$result_hhc_person_adl_screen_check = $db->prepare($sql_hhc_person_adl_screen_check);
$result_hhc_person_adl_screen_check->execute();

if ($result_hhc_person_adl_screen_check->rowCount() > 0):
    $hhc_person_adl_screen_check = '[' . date('Y-m-d H:i:s') . '] ' . "table hhc_person_adl_screen check pass.....[OK]<br>\n";
    fputs($fp, $hhc_person_adl_screen_check);

else:
    $hhc_person_adl_screen_check = '[' . date('Y-m-d h:i:s') . '] ' . "table hhc_person_adl_screen empty กำลังนำเข้าตาราง....";
    fputs($fp, $hhc_person_adl_screen_check);

    $sql_hhc_person_adl_screen = "CREATE TABLE `hhc_person_adl_screen` (
  `adl_id` int(11) NOT NULL,
  `person_id` int(11) NOT NULL,
  `vn` varchar(13) DEFAULT NULL,
  `screen_time` time NOT NULL,
  `screen_date` date NOT NULL,
  `feeding` int(11) DEFAULT NULL,
  `transfer` int(11) DEFAULT NULL,
  `mobility` int(11) DEFAULT NULL,
  `dressing` int(11) DEFAULT NULL,
  `bathing` int(11) DEFAULT NULL,
  `groming` int(11) DEFAULT NULL,
  `toilet_use` int(11) DEFAULT NULL,
  `bowels` int(11) DEFAULT NULL,
  `bladder` int(11) DEFAULT NULL,
  `stairs` int(11) DEFAULT NULL,
  `staff` varchar(25) NOT NULL,
  PRIMARY KEY (`adl_id`,`person_id`)
) ENGINE=InnoDB DEFAULT CHARSET=tis620;";
    $import = $db->exec($sql_hhc_person_adl_screen);
    $import_hhc_person_adl_screen = "Import Table hhc_person_adl_screen Complete.....[OK]<br> \n  ";
    fputs($fp, $import_hhc_person_adl_screen);
endif;

// End check table hhc_person_adl_screen

fclose($fp);
?>

