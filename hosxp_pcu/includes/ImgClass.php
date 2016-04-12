<?php
class ImageDB {

    var $conn = null;

    public function __construct() {

        include 'img_config.php';


        $connectionString = sprintf("mysql:host=$hostname;dbname=$dbname;charset=utf8");
        try {
            $this->conn = new PDO("mysql:host=$hostname;port=$port;dbname=$dbname;", $username, $password, array(
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES $charset",));
        } catch (PDOException $pe) {
            die($pe->getMessage());
        }
    }

    /*
      close the database connection
     */

    public function __destruct() {
        // close the database connection
        $this->conn = null;
    }

    /*
     * function แสดง person_image ด้วย person_id
     */

    public function selectPerImage($pid) {
        $sql = "select person_image from person_image where person_id = :id";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute(array(":id" => $pid));
        $stmt->bindColumn(1, $pic, PDO::PARAM_LOB);

        $stmt->fetch(PDO::FETCH_BOUND);

        return array("pic" => $pic);
    }

    public function HouseImage($hid) {
        $sql = "select house_image from house_image where house_id= :id order by house_image_id desc limit 1";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute(array(":id" => $hid));
        $stmt->bindColumn(1, $pic, PDO::PARAM_LOB);

        $stmt->fetch(PDO::FETCH_BOUND);

        return array("pic" => $pic);
    }

    public function HouseImageID($hid) {
        $sql = "select house_image from house_image where house_image_id= :id order by house_image_id desc";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute(array(":id" => $hid));
        $stmt->bindColumn(1, $pic, PDO::PARAM_LOB);

        $stmt->fetch(PDO::FETCH_BOUND);

        return array("pic" => $pic);
    }

    public function addPerPic($pid, $file) {
        
        $sqlhn="select patient_hn as cc from person where person_id='$pid'";
        $row = 0;
        $result = $this->conn->query($sqlhn, PDO::FETCH_OBJ);
        foreach ($result as $val) {
            if ($row > 0)
                break;
            else
                $hn = $val->cc;
            $row = $row + 1;
        }

        $filename = $file['name'];
        $type = $file['type'];
        $source = $file['tmp_name'];
        $typename = explode("/", $type);
        $accepted_types = array('jpeg', 'png', 'gif', 'jpg');
        $temp_path = 'img_temp';
        if (is_dir($temp_path)):
            chmod($temp_path, 0777);
        else:
            mkdir($temp_path, 0777);
        endif;

        foreach ($accepted_types as $mime_type) {
            if ($mime_type == $typename[1]):
                $status = 'OK';
                break;
            endif;
        }

        if ($status == 'OK'):
            //start resize
            $width = 350;
            $size = GetimageSize($source);
            $height = round($width * $size[1] / $size[0]);

            switch ($typename[1]) {
                case 'jpg':
                    $image = imagecreatefromjpeg($source);
                    break;
                case 'jpeg':
                    $image = imagecreatefromjpeg($source);
                    break;
                case 'png':
                    $image = imagecreatefrompng($source);
                    break;
                case 'gif':
                    $image = imagecreatefromgif($source);
                    break;
                default:
                    $image = imagecreatefromjpeg($source);
            }
            $x = imagesx($image);
            $y = imagesy($image);
            $imgfin = ImageCreateTrueColor($width, $height);
            ImageCopyResampled($imgfin, $image, 0, 0, 0, 0, $width + 1, $height + 1, $x, $y);
            ImageJPEG($imgfin, "img_temp/" . $pid . '_' . $filename);
            //end resize
            //start read image
            $img_temp = "img_temp/" . $pid . '_' . $filename; //
            $of = fopen($img_temp, 'r');
            $rb = fread($of, filesize($img_temp));
            fclose($of);
            $img = addslashes($rb);
            //end read image
            $sql = "replace into person_image(person_id,person_image,capture_datetime) values('$pid','$img',DATE_FORMAT(NOW(),'%Y-%m-%d %H:%i:%s')) ";
            $sqlpatient="replace into patient_image(hn,image_name,image,width,height,capture_date) 
            values('$hn','OPD','$img',$width,$height,DATE_FORMAT(NOW(),'%Y-%m-%d %H:%i:%s')) ";
            $upload = $this->conn->prepare($sql);
            $upload->execute();
            $upload = $this->conn->prepare($sqlpatient);
            $upload->execute();
            unlink($img_temp);
            return 'OK';
        else:
            return 'NOT';
        endif;
    }

    public function houseImgUpload($hid,$file,$text,$number) {


        $filename = $file['name'];
        $type = $file['type'];
        $source = $file['tmp_name'];
        $typename = explode("/", $type);
        $accepted_types = array('jpeg', 'png', 'gif', 'jpg');
        
        $temp_path = 'img_temp';
        if (is_dir($temp_path)):
            chmod($temp_path, 0777);
        else:
            mkdir($temp_path, 0777);
        endif;

        foreach ($accepted_types as $mime_type) {
            if ($mime_type == $typename[1]):
                $status = 'OK';
                break;
            endif;
        }

        if ($status == 'OK'):
            //start resize
            $width = 350;
            $size = GetimageSize($source);
            $height = round($width * $size[1] / $size[0]);

            switch ($typename[1]) {
                case 'jpg':
                    $image = imagecreatefromjpeg($source);
                    break;
                case 'jpeg':
                    $image = imagecreatefromjpeg($source);
                    break;
                case 'png':
                    $image = imagecreatefrompng($source);
                    break;
                case 'gif':
                    $image = imagecreatefromgif($source);
                    break;
                default:
                    $image = imagecreatefromjpeg($source);
            }
            $x = imagesx($image);
            $y = imagesy($image);
            $imgfin = ImageCreateTrueColor($width, $height);
            ImageCopyResampled($imgfin, $image, 0, 0, 0, 0, $width + 1, $height + 1, $x, $y);
            ImageJPEG($imgfin, "img_temp/" . $hid . '_' . $filename);
            //end resize
            //start read image
            $img_temp = "img_temp/" . $hid . '_' . $filename; //
            $of = fopen($img_temp, 'r');
            $rb = fread($of, filesize($img_temp));
            fclose($of);
            $img = addslashes($rb);
            //end read image
            $sql = "replace into house_image(house_image_id,house_id,house_image,image_description,image_number,image_taken_date) values(get_serialnumber('house_image_id'),'$hid','$img','$text',$number,DATE_FORMAT(NOW(),'%Y-%m-%d %H:%i:%s'))";
            $upload = $this->conn->prepare($sql);
            $upload->execute();
            unlink($img_temp);
            return 'OK';
        else:
            return 'NOT';
        endif;
    }    
    
}

?>
