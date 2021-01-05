<?php
require_once('./class.php');
$HOST = "localhost";
$USER = "web";
$PASS = "y2V2r3KNP#u2";
$DB = "web";
$api = new api();
$mysql = new mysqli($HOST, $USER, $PASS, $DB);
if($mysql->connect_errno) {
    $api->DropError($mysql->connect_error);
}
