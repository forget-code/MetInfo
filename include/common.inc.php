<?php
# 文件名称:common.inc.php 2009-08-18 08:53:03
# MetInfo企业网站管理系统 
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.
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
if(PATH_SEPARATOR!=':'){
require_once dirname(__file__).'/jmail.php';
}
define('MAGIC_QUOTES_GPC', get_magic_quotes_gpc());
isset($_REQUEST['GLOBALS']) && exit('Access Error');

$settings = parse_ini_file(ROOTPATH.'config/config.inc.php');
@extract($settings);
require_once ROOTPATH.'config/flash.inc.php';
$db_settings = parse_ini_file(ROOTPATH.'config/config_db.php');
@extract($db_settings);
require_once ROOTPATH.'config/tablepre.php';
require_once ROOTPATH.'include/mysql_class.php';
$db = new dbmysql();
$db->dbconn($con_db_host,$con_db_id,$con_db_pass,$con_db_name);
require_once dirname(__file__).'/global.func.php';
if($met_member_use!=0){
$metinfo_member_type="";
session_start();
$metinfo_member_name     =($_SESSION['metinfo_admin_name']=="")?$_SESSION['metinfo_member_name']:$_SESSION['metinfo_admin_name'];
$metinfo_member_pass     =($_SESSION['metinfo_admin_pass']=="")?$_SESSION['metinfo_member_pass']:$_SESSION['metinfo_admin_pass'];
$metinfo_member_type     =($_SESSION['metinfo_admin_type']=="")?$_SESSION['metinfo_member_type']:$_SESSION['metinfo_admin_type'];
$metinfo_admin_name     =$_SESSION['metinfo_admin_name'];
if($metinfo_member_name=='' or  $metinfo_member_pass=='')$metinfo_member_type="";
}else{
$metinfo_member_type="100";
}
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
//$char_key=array("\\",'&',' ',"'",'"','/','*',',','<','>',"\r","\t","\n",'#','%','?');
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

if(md5($metmemberforce)==$met_memberforce)$metinfo_member_type="100";
$metcms_v="2.0";
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
$met_c_webname=$met_c_webname."--Powered by MetInfo";
$met_e_webname=$met_e_webname."--Powered by MetInfo";
$met_o_webname=$met_o_webname."--Powered by MetInfo";

if($met_index_type==0){
$index_c_url=$met_webhtm?$met_weburl."index.".$met_htmtype:$met_weburl."index.php";
$index_e_url=$met_webhtm?$met_weburl."index".$met_htmpre_e.".".$met_htmtype:$met_weburl."index.php?lang=en";
$index_o_url=$met_webhtm?$met_weburl."index".$met_htmpre_o.".".$met_htmtype:$met_weburl."index.php?lang=other";
}elseif($met_index_type==1){
$index_c_url=$met_webhtm?$met_weburl."index_cn.".$met_htmtype:$met_weburl."index.php?lang=cn";
$index_e_url=$met_webhtm?$met_weburl."index.".$met_htmtype:$met_weburl."index.php";
$index_o_url=$met_webhtm?$met_weburl."index".$met_htmpre_o.".".$met_htmtype:$met_weburl."index.php?lang=other";
}else{
$index_c_url=$met_webhtm?$met_weburl."index_cn.".$met_htmtype:$met_weburl."index.php?lang=cn";
$index_e_url=$met_webhtm?$met_weburl."index".$met_htmpre_e.".".$met_htmtype:$met_weburl."index.php?lang=en";
$index_o_url=$met_webhtm?$met_weburl."index.".$met_htmtype:$met_weburl."index.php";
}

if($index=="index"&&$lang==""){
if($met_index_type==1)$lang="en";
if($met_index_type==2)$lang="other";
}
if($lang=="cn")$ch="ch";
if($ch=="ch")$lang="cn";
if($en=="en")$lang="en";
if($lang=="en")$en="en";
$index_url=($lang=="en")?$index_e_url:(($lang=="other")?$index_o_url:$index_c_url);

$met_c_htmtype=".".$met_htmtype;
$met_e_htmtype=$met_htmpre_e.".".$met_htmtype;
$met_o_htmtype=$met_htmpre_o.".".$met_htmtype;
$met_htmtype=($lang=="en")?$met_e_htmtype:(($lang=="other")?$met_o_htmtype:$met_c_htmtype);

if($lang=="en"){
$met_webname         =$met_e_webname;
$met_logo            =($met_e_logo=="")?$met_c_logo:$met_e_logo;
$met_title_keywords  =$e_title_keywords;
$met_keywords        =$met_e_keywords;
$met_description     =$met_e_description;
$met_seo             =$met_e_seo;
$met_alt             =$met_e_alt;
$met_atitle          =$met_e_atitle;
$met_linkname        =$met_e_linkname;
$met_footright       =$met_e_footright;
$met_footaddress     =$met_e_footaddress;
$met_foottel         =$met_e_foottel;
$met_footother       =$met_e_footother;
$met_foottext        =$met_e_foottext;
$met_footstat        =$met_e_footstat;
$searchurl           =$met_weburl."search/search.php?lang=en";
$file_name           =ROOTPATH."templates/".$met_skin_user.'/lang/language_en.ini';
}elseif($lang=="other"){
$met_webname         =$met_o_webname;
$met_logo            =($met_o_logo=="")?$met_c_logo:$met_o_logo;
$met_title_keywords  =$o_title_keywords;
$met_keywords        =$met_o_keywords;
$met_description     =$met_o_description;
$met_seo             =$met_o_seo;
$met_alt             =$met_o_alt;
$met_atitle          =$met_o_atitle;
$met_linkname        =$met_o_linkname;
$met_footright       =$met_o_footright;
$met_footaddress     =$met_o_footaddress;
$met_foottel         =$met_o_foottel;
$met_footother       =$met_o_footother;
$met_foottext        =$met_o_foottext;
$met_footstat        =$met_o_footstat;
$searchurl           =$met_weburl."search/search.php?lang=other";
$file_name           =ROOTPATH."templates/".$met_skin_user.'/lang/language_other.ini';
}else{
$met_webname         =$met_c_webname;
$met_logo            =$met_c_logo;
$met_title_keywords  =$c_title_keywords;
$met_keywords        =$met_c_keywords;
$met_description     =$met_c_description;
$met_seo             =$met_c_seo;
$met_alt             =$met_c_alt;
$met_atitle          =$met_c_atitle;
$met_linkname        =$met_c_linkname;
$met_footright       =$met_c_footright;
$met_footaddress     =$met_c_footaddress;
$met_foottel         =$met_c_foottel;
$met_footother       =$met_c_footother;
$met_foottext        =$met_c_foottext;
$met_footstat        =$met_c_footstat;
$searchurl           =$met_weburl."search/search.php";
$file_name           =ROOTPATH."templates/".$met_skin_user.'/lang/language_china.ini';
}
eval(base64_decode($class2_all_1[0]));
$met_title=($met_title_keywords=="")?$met_webname:$met_title_keywords."--".$met_webname;
$met_onlinetel=($lang=="en")?$met_e_onlinetel:(($lang=="other")?$met_o_onlinetel:$met_c_onlinetel);
if(!file_exists($file_name))$file_name=ROOTPATH."templates/".$met_skin_user.'/lang/language_china.ini';	
if(file_exists($file_name)){
$fp = @fopen($file_name, "r") or die("Cannot open $file_name");
while ($conf_line = @fgets($fp, 1024)){    
if(substr($conf_line,0,1)=="#"){   
$line = ereg_replace("#.*$", "", $conf_line);
}else{
$line = $conf_line;
}
if (trim($line) == "") continue;
$linearray=explode ('=', $line);
$linenum=count($linearray);
if($linenum==2){
list($name, $value) = explode ('=', $line);
}else{

  for($i=0;$i<$linenum;$i++){

     $linetra=$i?$linetra."=".$linearray[$i]:$linearray[$i].'metinfo_';
   }
list($name, $value) = explode ('metinfo_=', $linetra);
}
$value=str_replace("\"","&quot;",$value);
list($value, $valueinfo)=explode ('/*', $value);
$name = 'lang_'.daddslashes(trim($name),1,'metinfo');
$$name= daddslashes(trim($value),1,'metinfo');
}
fclose($fp) or die("Can't close file $file_name");
}
  met_run(met_decode($class2_all_1[2]));
  if ((!isset($_SESSION['metinfo_member_name']) || $_SESSION['metinfo_admin_name']=="") && (!isset($_SESSION['metinfo_member_pass']) || $_SESSION['metinfo_member_pass']=="") && isset($_COOKIE['name']) && isset($_COOKIE['ps'])) 
  {
	$tmpusername=htmlspecialchars($_COOKIE['name']);
	$tmpps=$_COOKIE['ps'];
	$membercp_list = $db->get_one("SELECT * FROM $met_admin_table WHERE admin_id='$tmpusername' and admin_pass='$tmpps' and usertype<3");
	if ($membercp_list){
		$_SESSION['metinfo_member_name'] = $tmpusername;
        $_SESSION['metinfo_member_pass'] = $tmpps;
		$_SESSION['metinfo_member_id'] = $membercp_list[id];
		$_SESSION['metinfo_member_type']  = $membercp_list['usertype'];
		$_SESSION['metinfo_member_time'] = $m_now_time;
		$query="update $met_admin_table set 
		admin_modify_date='$m_now_date',
		admin_login=admin_login+1,
		admin_modify_ip='$m_user_ip'
		WHERE admin_id = '$metinfo_member_name'";
		$db->query($query);
		
	}
  }
 
if($met_webhtm==0){
$member_index_url="index.php?lang=".$lang;
$member_register_url="register.php?lang=".$lang;
}else{
$member_index_url=($lang=="en")?"index".$met_e_htmtype:(($lang=="other")?"index".$met_o_htmtype:"index".$met_c_htmtype);
$member_register_url=($lang=="en")?"register".$met_e_htmtype:(($lang=="other")?"register".$met_o_htmtype:"register".$met_c_htmtype);
}

# 本程序是一个开源系统,使用时请你仔细阅读使用协议,商业用途请自觉购买商业授权.
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.
?>
