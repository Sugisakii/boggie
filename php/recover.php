<?php
require_once("./db.conf.php");
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
        $_SESSION['recover_token'] = $token;
        header("Location: " . $refer . "#/recover");
    } else {
        echo "Invalid Token";
    }
    exit;
}
$post = $api->readpostdata();
if (isset($post->recover_user) && isset($post->recover_token) && isset($post->recover_pass)) {
    $recover_user   = trim($post->recover_user);
    $recover_token  = trim($post->recover_token);
    $recover_pass   = md5(trim($post->recover_pass));
    if (!empty($recover_user) && !empty($recover_token) && !empty($recover_pass)) {
        $stmt = $mysql->prepare("SELECT `id` FROM `usuarios` WHERE `user`=? AND `recover_token`=?");
        if (!$stmt) {
            $api->DropError($mysql->error);
        }
        $stmt->bind_param("ss", $recover_user, $recover_token);
        $stmt->bind_result($recover_userid);
        if (!$stmt->execute()) {
            $api->DropError("Ocurrio un error al actualizar la contraseña, vuelve a intentarlo");
        }
        if (!$stmt->fetch()) {
            $api->DropError("Token Invalido, vuelve a solicitar la recuperacion de contraseña");
        }
        $stmt->close();
        $stmt = $mysql->prepare("UPDATE `usuarios` SET `pass`=? WHERE `id`=?");
        if (!$stmt) {
            $api->DropError($mysql->error);
        }
        $stmt->bind_param("ss", $recover_pass, $recover_userid);
        if ($stmt->execute()) {
            unset($_SESSION['recover_token']);
            unset($_SESSION['recover_user']);
            $mysql->query("UPDATE `usuarios` SET `recover_token`=null, `http_refer`=null WHERE `id`=$recover_userid");
            $api->DropSuccess("Contraseña actualizada");
        } else {
            $api->DropError("Ocurrio un error al actualizar la contraseña, vuelve a intentarlo");
        }
    }
    $api->DropError("Invalid Arguments to recover pass");
}
if (!isset($post->email) || empty(trim($post->email))) {
    $api->DropError("Invalid Arguments to send Token");
}
$email = trim($post->email);

$stmt = $mysql->prepare("SELECT `user` FROM `usuarios` WHERE `email`=?");
if (!$stmt) {
    $api->DropError($mysql->error);
}
$stmt->bind_param("s", $email);
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
$stmt->bind_param("sss", $token, $_SERVER['HTTP_REFERER'], $user);
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
