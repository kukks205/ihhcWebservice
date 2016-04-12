<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');

include 'includes/loginCheck.php';

$postData = json_decode( file_get_contents("php://input") );

$login = new loginCheck;

echo $login->checkLogin($postData->username,$postData->password);

?>
