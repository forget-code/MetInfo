<?php
# 文件名称:common.inc.php 2009-08-15 16:34:57
# MetInfo企业网站管理系统 
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn). All rights reserved.
header("Content-type: text/html;charset=utf-8");
error_reporting(E_ERROR | E_PARSE);
@set_time_limit(0);
//获取程序所在目录及后台目录
define('ROOTPATH_ADMIN', substr(dirname(__FILE__), 0, -7));
DIRECTORY_SEPARATOR == '\\'?@ini_set('include_path', '.;' . ROOTPATH_ADMIN):@ini_set('include_path', '.:' . ROOTPATH_ADMIN);
$DS=DIRECTORY_SEPARATOR;
$url_array=explode($DS,ROOTPATH_ADMIN);
$count = count($url_array);
$last_count=$count-2;
$last_count=strlen($url_array[$last_count])+1;
define('ROOTPATH', substr(ROOTPATH_ADMIN, 0, -$last_count));

PHP_VERSION >= '5.1' && date_default_timezone_set('Asia/Shanghai');
session_cache_limiter('private, must-revalidate'); 
@ini_set('session.auto_start',0); //自动启动关闭
if(PHP_VERSION < '4.1.0') {
	$_GET         = &$HTTP_GET_VARS;
	$_POST        = &$HTTP_POST_VARS;
	$_COOKIE      = &$HTTP_COOKIE_VARS;
	$_SERVER      = &$HTTP_SERVER_VARS;
	$_ENV         = &$HTTP_ENV_VARS;
	$_FILES       = &$HTTP_POST_FILES;
}
session_start();
if($_GET[langset]!='')$_SESSION['languser'] = $_GET[langset];
$metinfo_admin_name     = $_SESSION['metinfo_admin_name'];
$metinfo_admin_pass     = $_SESSION['metinfo_admin_pass'];
$metinfo_admin_pop      = $_SESSION['metinfo_admin_pop'];
$languser               = $_SESSION['languser'];
$settings = parse_ini_file(ROOTPATH.'config/config.inc.php');
@extract($settings);

$db_settings = parse_ini_file(ROOTPATH.'config/config_db.php');
@extract($db_settings);
require_once ROOTPATH.'config/tablepre.php';


// MYSQL数据库连接
require_once ROOTPATH_ADMIN.'include/mysql_class.php';
$db = new dbmysql();
$db->dbconn($con_db_host,$con_db_id,$con_db_pass,$con_db_name);

require_once dirname(__file__).'/global.func.php';
define('MAGIC_QUOTES_GPC', get_magic_quotes_gpc());
isset($_REQUEST['GLOBALS']) && exit('Access Error');
require_once ROOTPATH_ADMIN.'include/lang.php';

foreach(array('_COOKIE', '_POST', '_GET') as $_request) {
	foreach($$_request as $_key => $_value) {
		$_key{0} != '_' && $$_key = daddslashes($_value);
	}
}

(!MAGIC_QUOTES_GPC) && $_FILES = daddslashes($_FILES);
$REQUEST_URI  = $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];
$t_array = explode(' ',microtime());
$P_S_T	 = $t_array[0] + $t_array[1];
$met_obstart == 1 && function_exists('ob_gzhandler') ? ob_start('ob_gzhandler') :ob_start();

$referer?$forward=$referer:$forward=$_SERVER['HTTP_REFERER'];
$char_key=array("\\",'&',' ',"'",'"','/','*',',','<','>',"\r","\t","\n",'#','%','?');
$m_now_time     = time();
$m_now_date     = date('Y-m-d H:i:s',$m_now_time);
$m_now_counter  = date('Y-m-d',$m_now_time);
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

//后台风格
$met_skin="met";

//显示参数转换
$metcms_v="2.0";

met_run(met_decode($metinfo2[1]));
$met_e_seo=stripslashes($met_e_seo);
$met_c_seo=stripslashes($met_c_seo);
$met_o_seo=stripslashes($met_o_seo);
$met_c_foottext=stripslashes($met_c_foottext);
$met_e_foottext=stripslashes($met_e_foottext);
$met_o_foottext=stripslashes($met_o_foottext);
$met_c_footright=stripslashes($met_c_footright);
$met_c_footother=stripslashes($met_c_footother);
$met_e_footright=stripslashes($met_e_footright);
$met_e_footother=stripslashes($met_e_footother);
$met_o_footright=stripslashes($met_o_footright);
$met_o_footother=stripslashes($met_o_footother);
$met_c_foottel=stripslashes($met_c_foottel);
$met_e_foottel=stripslashes($met_e_foottel);
$met_o_foottel=stripslashes($met_o_foottel);
$met_c_footaddress=stripslashes($met_c_footaddress);
$met_e_footaddress=stripslashes($met_e_footaddress);
$met_o_footaddress=stripslashes($met_o_footaddress);
$met_c_footstat=stripslashes($met_c_footstat);
$met_e_footstat=stripslashes($met_e_footstat);
$met_o_footstat=stripslashes($met_o_footstat);
$met_c_memberemail=stripslashes($met_c_memberemail);
$met_e_memberemail=stripslashes($met_e_memberemail);
$met_o_memberemail=stripslashes($met_o_memberemail);
$met_c_membercontrol=stripslashes($met_c_membercontrol);
$met_e_membercontrol=stripslashes($met_e_membercontrol);
$met_o_membercontrol=stripslashes($met_o_membercontrol);
$met_c_onlinetel=stripslashes($met_c_onlinetel);
$met_e_onlinetel=stripslashes($met_e_onlinetel);
$met_o_onlinetel=stripslashes($met_o_onlinetel);
if(!function_exists('ob_phpintan')) {
	function ob_phpintan($content){return htmlspecialchars($content);}
}
 if(!function_exists('ob_pcontent')) {
	function ob_pcontent($content){return intval($content);}
}
 
# 本程序是一个开源系统,使用时请你仔细阅读使用协议,商业用途请自觉购买商业授权.
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn). All rights reserved.
?>

