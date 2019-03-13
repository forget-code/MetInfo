<?php
global $_M;
$paypal_config = json_decode($_M['config']['paypal_config'],true);
define("PP_USER_SANDBOX", $paypal_config['user_sandbox']);
define("PP_PASSWORD_SANDBOX", $paypal_config['password_sandbox']);
define("PP_SIGNATURE_SANDBOX", $paypal_config['signature_sandbox']);
define("PP_USER", $paypal_config['user']);
define("PP_PASSWORD", $paypal_config['password']);
define("PP_SIGNATURE", $paypal_config['signature']);
define("SANDBOX_FLAG", ($paypal_config['open']==1?true:false));
// define("SANDBOX_FLAG", true);
define("PROXY_HOST", "127.0.0.1");
define("PROXY_PORT", "808");
define("USERACTION_FLAG", false);
define("EXPRESS_MARK", true);
define("ADDRESS_OVERRIDE", true);
if(USERACTION_FLAG){
$page = 'return.php';
} else {
$page = 'review.php';
}
$http = strstr("https", $_M["url"]["site"]) ? "https" : "http";
define("RETURN_URL_MARK", $http.'://'.$_SERVER['HTTP_HOST'].preg_replace('/paypal_ec_redirect.php/','return.php',$_SERVER['SCRIPT_NAME']));
define("RETURN_URL", $http.'://'.$_SERVER['HTTP_HOST'].preg_replace('/paypal_ec_redirect.php/','lightboxreturn.php',$_SERVER['SCRIPT_NAME']));
//define("RETURN_URL", $_M['url']['pay_return']);
#define("CANCEL_URL", 'http://'.$_SERVER['HTTP_HOST'].preg_replace('/paypal_ec_redirect.php/','cancel.php',$_SERVER['SCRIPT_NAME']));
define("CANCEL_URL", $http."://{$_SERVER['HTTP_HOST']}/shop/order.php");

if(SANDBOX_FLAG){
$merchantID=PP_USER_SANDBOX;
$env= 'sandbox';
} else {
$merchantID=PP_USER;
$env='production';
}
define("PP_CHECKOUT_URL_SANDBOX", "https://www.sandbox.paypal.com/checkoutnow?token=");
define("PP_NVP_ENDPOINT_SANDBOX", "https://api-3t.sandbox.paypal.com/nvp");
define("PP_CHECKOUT_URL_LIVE", "https://www.paypal.com/checkoutnow?token=");
define("PP_NVP_ENDPOINT_LIVE", "https://api-3t.paypal.com/nvp");
define("API_VERSION", "109.0");
define("SBN_CODE", "PP-DemoPortal-EC-IC-php");
?>