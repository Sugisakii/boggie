<?php
require_once('./db.conf.php');

$post = $api->readpostdata();
if (!$post || !isset($post->user) || !isset($post->email) || !isset($post->pass) || empty(trim($post->user)) || empty(trim($post->email)) || empty(trim($post->pass))) {
    $api->DropError("Invalid Arguments");
}
$stmt = $mysql->prepare("INSERT INTO usuarios (`user`,`email`,`pass`,`level`) VALUES (?,?,?,0)");
if (!$stmt) {
    $api->DropError($mysql->error);
}
$p = md5($post->pass);
$stmt->bind_param("sss", $post->user, $post->email, $p);
$stmt->execute();
if ($mysql->errno) {
    if ($mysql->errno == 1062) {
        $api->DropError("El usuario y/o email ya estan en uso, pruebe con otro");
    }
    $api->DropError($mysql->error);
}
$a['message'] = "Usuario registrado con exito";
$api->DropArray($a);
