<?php
require_once('./db.conf.php');
$post = $api->readpostdata();
if(!$post) {
    $api->DropError("Invalid Arguments");
}
$stmt =  $mysql->prepare('SELECT `id`,`user`,`level` FROM usuarios WHERE user = ? AND pass = ?');
if(!$stmt) {
    $api->DropError($mysql->error);
}
$pass = md5($post->pass);
$stmt->bind_param('ss', $post->user, $pass);
$stmt->execute();
$stmt->bind_result($id, $user, $level);
$stmt->store_result();
if($stmt->num_rows > 0) {
    $stmt->fetch();
    $a['id'] = $id;
    $a['user'] = $user;
    $a['level'] = $level;
    $a['logged'] = true;
    $_SESSION = $a;
    $api->DropArray($_SESSION);
} else {
    $api->DropError("Contraseña invalida");
}

?>