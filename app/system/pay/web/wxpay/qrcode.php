<?php
error_reporting(E_ERROR);
require_once '../../../include/class/phpqrcode/phpqrcode.php';
$url = urldecode($_GET["data"]);$size = $_GET['size'] ? $_GET['size'] : 10;$margin = $_GET['margin'] ? $_GET['margin'] : 1;QRcode::png($url, false, QR_ECLEVEL_L, $size, $margin);			
//QRcode::png($url);
