<?php

include 'conf.ini.php';


try {
    //connect ฐานข้อมูล 
    $db = new PDO("mysql:host=$hostname;port=$port;dbname=$dbname;", $username, $password, array(
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES $charset",));
} catch (Exception $e) {
    echo "<script> alert('ไม่สามารถเชื่อมต่อฐานข้อมูลได้กรุณาตรวจสอบการตั้งค่าการเชื่อมต่อหรือติดต่อผู้ดูแลระบบครับผม');</script>";
    echo "<script>";
    echo "window.location='index.php';";
    echo "</script>";
    //echo 'error:'.$e->getMessage();
}
?>                