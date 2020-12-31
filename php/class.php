<?php
session_start();
header('Access-Control-Allow-Origin: ' . $_SERVER['HTTP_ORIGIN']);
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST");
header("Access-Control-Allow-Credentials: true");
header("Allow: GET, POST");
header('content-type: application/json; charset=utf-8');
header("set-cookie: PHPSESSID=" . session_id() . "; path=/; SameSite=None; Secure");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\OAuth;
use League\OAuth2\Client\Provider\Google;

require 'vendor/autoload.php';

class api
{
    protected $UserEmail = "gamerpeter90@gmail.com";
    protected $ClientId = "438693479661-4ee1llrf0un8gqiv38n7fo0kv6dc5a81.apps.googleusercontent.com";
    protected $ClientSecret = "FB-s6Cba0mZXTxb0Fu_OXnPF";
    protected $RefreshToken = "1//04iWTou_0x0-dCgYIARAAGAQSNwF-L9IrUd76_VrTabO_xZ6CK8AkQrEDhKj2nOLflAfHF5QtFuhCZEYzpS6j_iCB5PWK5x8O9bA";

    public function DropError($message)
    {
        $a['error'] = true;
        $a['message'] = $message;
        echo json_encode($a);
        exit;
    }
    public function DropSuccess($message)
    {
        $a['error'] = false;
        $a['message'] = $message;
        echo json_encode($a);
        exit;
    }
    public function DropArray($a)
    {
        $a['error'] = false;
        echo json_encode($a);
        exit;
    }
    public function readpostdata()
    {
        $fh = @fopen("php://input", "r");
        $data = '';
        if ($fh) {
            while (!feof($fh)) {
                $data .= fgets($fh);
            }
            fclose($fh);
        }
        $post = json_decode($data);
        if (is_object($post)) {
            return $post;
        }
        return false;
    }
    public function SendMail($receptor, $nombre, $asunto, $cuerpo, $ishtml = false)
    {
        $mail = new PHPMailer(true);
        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->Host = "smtp.gmail.com";
        $mail->AuthType = "XOAUTH2";
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;
        $mail->SMTPAuth = true;
        $mail->setFrom("no-reply@sugiweb.ga", $nombre);
        $mail->addAddress($receptor);

        $mail->Subject = $asunto;
        $mail->isHTML($ishtml);
        $mail->Body = $cuerpo;
        $mail->CharSet = "UTF-8";

        $provider = new Google([
            'clientId' => $this->ClientId,
            'clientSecret' => $this->ClientSecret,
        ]);

        $mail->setOAuth(new OAuth([
            'provider' => $provider,
            'clientId' => $this->ClientId,
            'clientSecret' => $this->ClientSecret,
            'refreshToken' => $this->RefreshToken,
            'userName' => $this->UserEmail,
        ]));
        return $mail->send();
    }
}
