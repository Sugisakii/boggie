<?php
require_once('./class.php');
if(isset($_SESSION['id'])) {
    $api->DropArray($_SESSION);
}

?> 