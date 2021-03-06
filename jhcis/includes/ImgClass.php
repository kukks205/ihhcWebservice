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
        $sql = "select photo from personimages where pid = :id";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute(array(":id" => $pid));
        $stmt->bindColumn(1, $pic, PDO::PARAM_LOB);

        $stmt->fetch(PDO::FETCH_BOUND);

        return array("pic" => $pic);
    }

    public function HouseImage($hid) {
        $sql = "select h.housepic from house as h where hcode= :id limit 1";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute(array(":id" => $hid));
        $stmt->bindColumn(1, $pic, PDO::PARAM_LOB);

        $stmt->fetch(PDO::FETCH_BOUND);

        return array("pic" => $pic);
    }

    public function HouseImageID($hid) {
        $sql = "select h.housepic from house as h where hcode= :id limit 1";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute(array(":id" => $hid));
        $stmt->bindColumn(1, $pic, PDO::PARAM_LOB);

        $stmt->fetch(PDO::FETCH_BOUND);

        return array("pic" => $pic);
    }

    public function addPerPic($pid, $file) {
        
        $sqloffid="select offid as cc from office where offid<>'0000x' limit 1";
        
        $row = 0;
        $result = $this->conn->query($sqloffid, PDO::FETCH_OBJ);
        foreach ($result as $val) {
            if ($row > 0)
                break;
            else
                $offid = $val->cc;
            $row = $row + 1;
        }

        $filename = $file['name'];
        $type = $file['type'];
        $source = $file['tmp_name'];
        $photosize=$file['size'];
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
            $phototype=$typename[1];
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
            $sql = "replace into personimages(pcucodeperson,pid,photo,phototype,photosize,dateupdate) values('$offid','$pid','$img','$phototype','$photosize',DATE_FORMAT(NOW(),'%Y-%m-%d %H:%i:%s')) ";

            $upload = $this->conn->prepare($sql);
            $upload->execute();
            unlink($img_temp);
            return 'OK';
        else:
            return 'NOT';
        endif;
    }

    public function houseImgUpload($hid,$file) {


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
            $sql="update house set housepic='$img',dateupdate=DATE_FORMAT(NOW(),'%Y-%m-%d %H:%i:%s') where hcode='$hid'";
            //$sql = "replace into house_image(house_image_id,house_id,house_image,image_description,image_number,image_taken_date) values(get_serialnumber('house_image_id'),'$hid','$img','$text',$number,DATE_FORMAT(NOW(),'%Y-%m-%d %H:%i:%s'))";
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
