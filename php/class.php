<?php
session_start();
header('Access-Control-Allow-Origin: ' . $_SERVER['HTTP_ORIGIN']);
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST");
header("Access-Control-Allow-Credentials: true");
header("Allow: GET, POST");
header('content-type: application/json; charset=utf-8');
header("set-cookie: PHPSESSID=" . session_id() . "; path=/; SameSite=None; Secure");

class api
{
    public function DropError($message)
    {
        $a['error'] = true;
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
}
