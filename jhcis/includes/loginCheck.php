<?php

class loginCheck {

    var $conn;

    //ใช้ connect DB เพื่อใช้ใน Class
    public function __construct() {

        include 'conf.ini.php';
        try {
            //connect ฐานข้อมูล 
            $this->conn = new PDO("mysql:host=$hostname;port=$port;dbname=$dbname;", $username, $password, array(
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES $charset",));
        } catch (Exception $e) {
            echo "<script> alert('ไม่สามารถเชื่อมต่อฐานข้อมูลได้กรุณาตรวจสอบการตั้งค่าการเชื่อมต่อหรือติดต่อผู้ดูแลระบบครับผม');</script>";
            echo "<script>";
            echo "window.location='index.php';";
            echo "</script>";
        }
    }

    public function checkLogin($username, $password) {

        if ($username == null):

            $txt = ['status' => 'notuser', 'token' => 'null', 'acsessright' => 'null'];

            $return = json_encode($txt);

        else:
            if ($password == null):
                $txt = ['status' => 'notpass', 'token' => 'null', 'acsessright' => 'null'];

                $return = json_encode($txt);

            else:
                $sql = "select concat(fname,'  ',lname) as `name`,grouplevel,`password`,officerposition from `user` where username='$username' and password='$password'";
                $result = $this->conn->prepare($sql);
                $result->execute();
                $check = $result->rowCount();

                if ($result !== false):

                    if ($result->rowCount() > 0):
                        while ($row = $result->fetch()) {
                            $token = $row['password'];
                            $accessright = $row['grouplevel'];
                            $name = $row['name'];
                            $position = $row['officerposition'];
                        }
                        $txt = ['status' => 'success', 'token' => $token, 'acsessright' => $accessright, 'name' => $name, 'position' => $position];

                        $return = json_encode($txt);

                    else:
                        $txt = ['status' => 'notsuccess', 'token' => 'null', 'acsessright' => 'null', 'name' => 'null', 'position' => 'null'];

                        $return = json_encode($txt);

                    endif;

                else:
                    $txt = ['status' => 'notpass', 'token' => 'null', 'acsessright' => 'null', 'name' => 'null', 'position' => 'null'];

                    $return = json_encode($txt);



                endif;

            endif;

        endif;

        return $return;
    }

}

?>
