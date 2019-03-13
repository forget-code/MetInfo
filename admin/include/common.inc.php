<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 
header("Content-type: text/html;charset=utf-8");
error_reporting(E_ERROR | E_PARSE);
@set_time_limit(0);
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
@ini_set('session.auto_start',0); 
if(PHP_VERSION < '4.1.0') {
	$_GET         = &$HTTP_GET_VARS;
	$_POST        = &$HTTP_POST_VARS;
	$_COOKIE      = &$HTTP_COOKIE_VARS;
	$_SERVER      = &$HTTP_SERVER_VARS;
	$_ENV         = &$HTTP_ENV_VARS;
	$_FILES       = &$HTTP_POST_FILES;
}
$settings=array();
$db_settings=array();
$db_settings = parse_ini_file(ROOTPATH.'config/config_db.php');
@extract($db_settings);
require_once ROOTPATH_ADMIN.'include/mysql_class.php';
$db = new dbmysql();
$db->dbconn($con_db_host,$con_db_id,$con_db_pass,$con_db_name);
$query="select * from {$tablepre}config where name='met_tablename' and lang='metinfo'";
$mettable=$db->get_one($query);
$mettables=explode('|',$mettable[value]);
foreach($mettables as $key=>$val){
	$tablename='met_'.$val;	
	$$tablename=$tablepre.$val;
	$_M[table][$tablename]=$tablepre.$val;
}
require_once dirname(__file__).'/global.func.php';
require_once dirname(__file__).'/global/snap.func.php';
define('MAGIC_QUOTES_GPC', get_magic_quotes_gpc());
$lang=$_GET['lang']<>""?$_GET['lang']:$_POST['lang'];
$lang=daddslashes($lang,0,1);
$metinfoadminok=1;
$settings_arr=array();
require_once ROOTPATH.'config/config.inc.php';
if($_GET[langset]!=''){
	$_GET[langset]=daddslashes($_GET[langset],0,1);
	if(!preg_match("/^[a-zA-Z0-9]+$/", $_GET[langset]))die();
	change_met_cookie('languser',$_GET[langset]);
	save_met_cookie();
}
met_cooike_start();
$query="select * from {$tablepre}lang where mark='{$_GET[langset]}' and lang='metinfo'";
$isadminlang=$db->get_one($query);
if(!$isadminlang&&$_GET[langset]!='')die('not have this language');
$_M['user']['cookie'] = $met_cookie;
$metinfo_admin_name     = get_met_cookie('metinfo_admin_name');
$metinfo_admin_pass     = get_met_cookie('metinfo_admin_pass');
$metinfo_admin_pop      = get_met_cookie('metinfo_admin_pop');
$metinfo_admin_shortcut = get_met_cookie('metinfo_admin_shortcut');
$languser               = get_met_cookie('languser');
$langadminok            = get_met_cookie('metinfo_admin_lang');
$langusenow=$languser;
if($langadminok<>"" and $langadminok<>'metinfo')$adminlang=explode('-',$langadminok);
require_once ROOTPATH_ADMIN.'include/lang.php';
isset($_REQUEST['GLOBALS']) && exit('Access Error');
unset($_POST['met_webkeys']);
unset($_GET['met_webkeys']);
unset($_POST['metinfo_admin_name']);
unset($_GET['metinfo_admin_name']);
unset($_GET['met_cookie']);
unset($_COOKIE['met_cookie']);
unset($_POST['met_cookie']);
foreach(array('_COOKIE', '_POST', '_GET') as $_request) {
	foreach($$_request as $_key => $_value) {
		$_key{0} != '_' && $$_key = daddslashes($_value,0,0,1);
		$_M['form'][$_key]=daddslashes($_value,0,0,1);
	}
}
$settings=array();
$db_settings=array();
$db_settings = parse_ini_file(ROOTPATH.'config/config_db.php');
@extract($db_settings);
$query="select * from {$tablepre}config where name='met_tablename' and lang='metinfo'";
$mettable=$db->get_one($query);
$mettables=explode('|',$mettable[value]);
foreach($mettables as $key=>$val){
	$tablename='met_'.$val;	
	$$tablename=$tablepre.$val;
	$_M['table'][$val] = $tablepre.$val;
}
(!MAGIC_QUOTES_GPC) && $_FILES = daddslashes($_FILES);
$REQUEST_URI  = $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];
$t_array = explode(' ',microtime());
$P_S_T	 = $t_array[0] + $t_array[1];
ob_start();
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
$foot=$met_agents_copyright_foot;
$foot=str_replace('$metcms_v',$metcms_v,$foot);
$foot=str_replace('$m_now_year',$m_now_year,$foot);
$met_skin="met";
if($metsking)$met_skin=$metsking;
if($lang==""){
foreach($met_langok as $key=>$val){
$lang=$val[mark];
break;
}
}
$metinfoadminfile=ROOTPATH.'templates/'.$met_skin_user.'/metinfo.inc.php';
if(file_exists($metinfoadminfile)){
require_once $metinfoadminfile;
}else{
require_once ROOTPATH.'config/metinfo.inc.php';
}
$metadmin[pagename]=1;
$metadmin[newscom]=1;
$metadmin[productcom]=1;
$metadmin[imgcom]=1;
$metadmin[downloadcom]=1;
$met_htmtypeadmin=($lang==$met_index_type)?".".$met_htmtype:"_".$lang.".".$met_htmtype;
if(!function_exists('ob_phpintan')) {
	function ob_phpintan($content){return htmlspecialchars($content);}
}
 if(!function_exists('ob_pcontent')) {
	function ob_pcontent($content){return intval($content);}
}
//接口
if($_M['plugin']['doadmin']){
	define('IN_MET', true);
	if(file_exists(ROOTPATH.'app/system/include/class/mysql.class.php')){
		require_once ROOTPATH.'app/system/include/class/mysql.class.php';
		$db_settings = array();
		$db_settings = parse_ini_file(ROOTPATH.'config/config_db.php');
		@extract($db_settings);
		DB::dbconn($con_db_host, $con_db_id, $con_db_pass, $con_db_name);
		foreach($_M['plugin']['doadmin'] as $key => $val){
				$applistfile=ROOTPATH.'app/app/'.$val.'/plugin/'.'plugin_'.$val.'.class.php';
				$_M['url']['own'] = $_M['url']['site'].'app/app/'.$val.'/';
				if(file_exists($applistfile)&&!is_dir($applistfile)&&((file_get_contents($applistfile))!='metinfo')){
					require_once $applistfile;
					$app_plugin_name=str_replace('.class.php', '', 'plugin_'.$val);
					if (class_exists($app_plugin_name)) {
						$newclass=new $app_plugin_name;
						if(method_exists($newclass, 'doadmin')){
							call_user_func(array($newclass,  'doadmin'));
						}
					}
				}
		}
		$_M['url']['own'] = '';
		DB::close();
		$db = new dbmysql();
		$db->dbconn($con_db_host,$con_db_id,$con_db_pass,$con_db_name);
	}
}
//结束
/*管理员权限处理*/
$admin_list = $db->get_one("SELECT * FROM {$met_admin_table} WHERE admin_id='{$metinfo_admin_name}'");
$metinfo_admin_pop=$admin_list['admin_type'];
if($metinfo_admin_pop!="metinfo"){
	$admin_pop=explode('-',$metinfo_admin_pop);
	$admin_poptext="admin_pop";
	foreach($admin_pop as $key=>$val){
		$admin_poptext1=$admin_poptext.$val=$val;
		$$admin_poptext1="metinfo";
	}
}
require_once ROOTPATH_ADMIN.'include/pubilc.php';
require_once 'metlist.php';
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>