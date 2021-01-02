<?php
require_once('./db.conf.php');
if (isset($_SESSION['cart'])) {
    $cart = $_SESSION['cart'];
}
session_unset();
if (isset($cart)) {
    $_SESSION['cart'] = $cart;
}
$_SESSION['Logged'] = false;
$api->DropArray($_SESSION);
