<?php

date_default_timezone_set("Asia/Bangkok");

include 'includes/DBConn.php';

$filename = "log/iHHC-UpgradeStructure" . date("Y-m-d") . ".log";
$fp = fopen($filename, 'a');


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


// start check table village_history
$sql_village_history_check = "show tables like'village_history'";
$result_village_history_check = $db->prepare($sql_village_history_check);
$result_village_history_check->execute();

if ($result_village_history_check->rowCount() > 0):
    $village_history_check = '[' . date('Y-m-d H:i:s') . '] ' . "table village_history check pass.....[OK]<br>\n";
    fputs($fp, $village_history_check);

else:
    $village_history_check = '[' . date('Y-m-d h:i:s') . '] ' . "table village_history empty กำลังนำเข้าตาราง....";
    fputs($fp, $village_history_check);

    $sql_village_history = "CREATE TABLE `village_history` (
  `village_id` INTEGER(11) NOT NULL,
  `village_history_id` INTEGER(11) NOT NULL,
  `village_history_detail` VARCHAR(10000) COLLATE tis620_thai_ci NOT NULL DEFAULT '',
  `hos_guid` VARCHAR(38) COLLATE tis620_thai_ci DEFAULT NULL,
  `user_update` VARCHAR(9) COLLATE tis620_thai_ci DEFAULT NULL,
  `entry_update` DATETIME DEFAULT NULL,
  PRIMARY KEY (`village_history_id`),
  UNIQUE KEY `village_id` (`village_id`),
  KEY `ix_hos_guid` (`hos_guid`)
)ENGINE=InnoDB CHARACTER SET 'tis620' COLLATE 'tis620_thai_ci';";
    $import = $db->exec($sql_village_history);
    $import_village_history = "Import Table village_history Complete.....[OK]<br> \n  ";
    fputs($fp, $import_village_history);
endif;

// End check table village_history

// start check table hhc_person_visit_vn
$sql_hhc_person_visit_vn_check = "show tables like'hhc_person_visit_vn'";
$result_hhc_person_visit_vn_check = $db->prepare($sql_hhc_person_visit_vn_check);
$result_hhc_person_visit_vn_check->execute();

if ($result_hhc_person_visit_vn_check->rowCount() > 0):
    $hhc_person_visit_vn_check = '[' . date('Y-m-d H:i:s') . '] ' . "table hhc_person_visit_vn check pass.....[OK]<br>\n";
    fputs($fp, $hhc_person_visit_vn_check);

else:
    $hhc_person_visit_vn_check = '[' . date('Y-m-d h:i:s') . '] ' . "table hhc_person_visit_vn empty กำลังนำเข้าตาราง....";
    fputs($fp, $hhc_person_visit_vn_check);

    $sql_hhc_person_visit_vn = "CREATE TABLE `hhc_person_visit_vn` (`person_visit_id` int(11) NOT NULL,
`vn` varchar(13) NOT NULL,
`seq_id` int(11) NOT NULL,
`team_visit` varchar(1) DEFAULT NULL, 
PRIMARY KEY (`person_visit_id`,`vn`)) ENGINE=InnoDB DEFAULT CHARSET=tis620;";
    $import = $db->exec($sql_hhc_person_visit_vn);
    $import_hhc_person_visit_vn = "Import Table hhc_person_visit_vn Complete.....[OK]<br> \n  ";
    fputs($fp, $import_hhc_person_visit_vn);
endif;

// End check table hhc_person_visit_vn

// start check table hhc_person_visit_type_map
$sql_hhc_person_visit_type_map_check = "show tables like'hhc_person_visit_type_map'";
$result_hhc_person_visit_type_map_check = $db->prepare($sql_hhc_person_visit_type_map_check);
$result_hhc_person_visit_type_map_check->execute();

if ($result_hhc_person_visit_type_map_check->rowCount() > 0):
    $hhc_person_visit_type_map_check = '[' . date('Y-m-d H:i:s') . '] ' . "table hhc_person_visit_type_map check pass.....[OK]<br>\n";
    fputs($fp, $hhc_person_visit_type_map_check);

else:
    $hhc_person_visit_type_map_check = '[' . date('Y-m-d h:i:s') . '] ' . "table hhc_person_visit_type_map empty กำลังนำเข้าตาราง....";
    fputs($fp, $hhc_person_visit_type_map_check);

    $sql_hhc_person_visit_type_map = "CREATE TABLE `hhc_person_visit_type_map` (
`person_visit_type_id` int(11) NOT NULL,
`ovst_community_service_type_id` int(11) NOT NULL,
`dx1` varchar(5) NOT NULL,
`dx2` varchar(5) DEFAULT NULL,
PRIMARY KEY (`person_visit_type_id`,`ovst_community_service_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=tis620;";
    $import = $db->exec($sql_hhc_person_visit_type_map);
    $import_hhc_person_visit_type_map = "Import Table hhc_person_visit_type_map Complete.....[OK]<br> \n  ";
    fputs($fp, $import_hhc_person_visit_type_map);
endif;

// End check table hhc_person_visit_type_map

fclose($fp);
?>

