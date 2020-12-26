<?php
require_once('./class.php');
$HOST = "localhost";
$USER = "root";
$PASS = "!8%uHoZ7w!";
$DB = "nuevaweb";
$api = new api();
$mysql = new mysqli($HOST, $USER, $PASS, $DB);
if($mysql->connect_errno) {
    $api->DropError($mysql->connect_error);
}
?>