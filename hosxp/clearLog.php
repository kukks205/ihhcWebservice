<?PHP
$dir = 'log/';
if($dh = opendir($dir)){
    while(($file = readdir($dh))!== false){
        if(file_exists($dir.$file)) @unlink($dir.$file);
    }
        closedir($dh);
}
?>
