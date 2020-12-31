<?php
require_once("./db.conf.php");
error_reporting(E_ALL);
ini_set("display_errors", 1);

if (isset($_GET['token']) && !empty(trim($_GET['token']))) {
    $token = $_GET['token'];
    $stmt = $mysql->prepare("SELECT `user`,`http_refer` FROM `usuarios` WHERE `recover_token`=?");
    if (!$stmt) {
        $api->DropError($mysql->error);
    }
    $stmt->bind_param("s", $token);
    $stmt->bind_result($u, $refer);
    $stmt->execute();
    if ($stmt->fetch()) {
        session_unset();
        $_SESSION['recover_user'] = $u;
        header("Location: " . $refer . "/#/recover");
    } else {
        echo "Invalid Token";
    }
    exit;
}
$post = $api->readpostdata();
if (!isset($post->email) || empty($post->email)) {
    $api->DropError("Invalid Arguments");
}
$stmt = $mysql->prepare("SELECT `user` FROM `usuarios` WHERE `email`=?");
if (!$stmt) {
    $api->DropError($mysql->error);
}
$stmt->bind_param("s", $post->email);
$stmt->bind_result($user);
$stmt->execute();
$stmt->store_result();
if (!$stmt->fetch()) {
    $api->DropError("Correo electronico no se encuentra registrado");
}
$stmt->close();
$stmt = $mysql->prepare("UPDATE `usuarios` SET `recover_token`=?, `http_refer`=? WHERE `user`=?");
if (!$stmt) {
    $api->DropError($mysql->error);
}
$token = GenerateToken(80);
$stmt->bind_param("sss", $token, $_SERVER['HTTP_ORIGIN'], $user);
$stmt->execute();
$msg = sprintf("
Hola %s, has solicitado una recuperacion de contraseña, pulsa el siguiente enlace para reestablecerla %s://%s%s?token=%s
", $user, $_SERVER['REQUEST_SCHEME'], $_SERVER['SERVER_NAME'], $_SERVER['PHP_SELF'], $token);

if ($api->SendMail($post->email, "[RoyalMS-Gamming] Soporte", "Reestablecimiento de contraseña", $msg)) {
    $api->DropSuccess("Email Enviado");
} else {
    $api->DropError("Ha ocurrido un error al enviar el Email");
}

function GenerateToken($num)
{
    $Dic = "1234567890ABCDEFGHIJKLMNOPQRSTUWXYZ1234567890abcfefghijklmnopqrstu1234567890";
    $Token = '';
    for ($i = 0; $i < $num; $i++) {
        $Token .= $Dic[random_int(0, strlen($Dic) - 1)];
    }
    return $Token;
}
