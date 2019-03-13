<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 
header("Content-type: text/html;charset=utf-8");
error_reporting(E_ERROR | E_WARNING | E_PARSE);
@set_time_limit(0);
set_magic_quotes_runtime(0);
define('VERSION','4.1.0');
if(PHP_VERSION < '4.1.0') {
	$_GET         = &$HTTP_GET_VARS;
	$_POST        = &$HTTP_POST_VARS;
	$_COOKIE      = &$HTTP_COOKIE_VARS;
	$_SERVER      = &$HTTP_SERVER_VARS;
	$_ENV         = &$HTTP_ENV_VARS;
	$_FILES       = &$HTTP_POST_FILES;
}
define('MAGIC_QUOTES_GPC', get_magic_quotes_gpc());
isset($_REQUEST['GLOBALS']) && exit('Access Error');
foreach(array('_COOKIE', '_POST', '_GET') as $_request) {
	foreach($$_request as $_key => $_value) {
		$_key{0} != '_' && $$_key = daddslashes($_value);
	}
}
$m_now_time     = time();
$m_now_date     = date('Y-m-d H:i:s',$m_now_time);
$nowyear    = date('Y',$m_now_time);
$localurl="http://";
$localurl.=$_SERVER['HTTP_HOST'].$_SERVER["PHP_SELF"];
$install_url=$localurl;
if(file_exists('../config/install.lock')){
	exit('对不起，该程序已经安装过了。<br/>
	      如您要重新安装，请手动删除config/install.lock文件。');
}
switch ($action)
{
	case 'inspect':
	{
		$mysql_support = (function_exists( 'mysql_connect')) ? ON : OFF;
		if(function_exists( 'mysql_connect')){
			$mysql_support  = 'ON';
			$mysql_ver_class ='OK';
		}else {
			$mysql_support  = 'OFF';
			$mysql_ver_class ='WARN';
		}
		if(PHP_VERSION<'4.1.0'){
			$ver_class = 'WARN';
			$errormsg['version']='php 版本过低';
		}else {
			$ver_class = 'OK';
			$check=1;
		}
		$w_check=array(
		'../',
		'../about',
		'../download',
		'../product',
		'../news',
		'../img',
		'../job',
		'../search',
		'../sitemap',
		'../link',
		'../member',
		'../wap',
		'../upload',
		'../config',
		'../config/config_db.php',
		'../upload/file',
		'../upload/image',
		'../message',
		'../feedback',
		'../admin/databack',
		);
		$class_chcek=array();
		$check_msg = array();
		$count=count($w_check);
		for($i=0; $i<$count; $i++){
			if(!file_exists($w_check[$i])){
				$check_msg[$i].= '文件或文件夹不存在请上传';$check=0;
				$class_chcek[$i] = 'WARN';
			} elseif(is_writable($w_check[$i])){
				$check_msg[$i].= '通 过';
				$class_chcek[$i] = 'OK';
				$check=1;
			} else{
				$check_msg[$i].='777属性检测不通过'; $check=0;
				$class_chcek[$i] = 'WARN';
			}
		if($check!=1 and $disabled!='disabled'){$disabled = 'disabled';}
		}
		include template('inspect');
		break;
	}
	case 'db_setup':
	{
		if($setup==1){
			$db_prefix      = trim(strip_tags($db_prefix));
			$db_host        = trim(strip_tags($db_host));
			$db_username    = trim(strip_tags($db_username));
			$db_pass        = trim(strip_tags($db_pass));
			$db_name        = trim(strip_tags($db_name));
			$config="<?php
                   /*
                   con_db_host = \"$db_host\"
                   con_db_id   = \"$db_username\"
                   con_db_pass	= \"$db_pass\"
                   con_db_name = \"$db_name\"
                   tablepre    =  \"$db_prefix\"
                   db_charset  =  \"utf8\";
                  */
                  ?>";

			$fp=fopen("../config/config_db.php",'w+');
			fputs($fp,$config);
			fclose($fp);
			$db = mysql_connect($db_host,$db_username,$db_pass) or die('连接数据库失败: ' . mysql_error());
			if(!@mysql_select_db($db_name)){
				mysql_query("CREATE DATABASE $db_name ") or die('创建数据库失败'.mysql_error());
			}
			mysql_select_db($db_name);
			if(mysql_get_server_info()>='4.1'){
			 mysql_query("set names utf8"); 
			 $content=readover("install5.sql");
			}else {
			  echo "<SCRIPT language=JavaScript>alert('您的mysql版本过低，请确保你的数据库编码为utf-8,官方建议您升级到mysql4.1.0以上');</SCRIPT>";
			  $content=readover("install4.sql");  
			}
			if($cndata=="yes")$content.=readover("cn.sql");
            if($endata=="yes")$content.=readover("en.sql"); 			
			$content=preg_replace("/{#(.+?)}/eis",'$lang[\\1]',$content);		
			include template('db_setup');
			exit();
		}else {
		include template('databasesetup');
		}
		break;
	}
	case 'adminsetup':
	{
		if($setup==1){
			$regname              = trim(strip_tags($regname));
			$regpwd               = md5(trim(strip_tags($regpwd)));
			$email                = trim(strip_tags($email));
		    $m_now_time = time();
			$config = parse_ini_file('../config/config_db.php','ture');
			@extract($config);
			$link = mysql_connect($con_db_host,$con_db_id,$con_db_pass) or die('连接数据库失败: ' . mysql_error());
			mysql_select_db($con_db_name);
			if(mysql_get_server_info()>4.1){
			 mysql_query("set names utf8"); 
			}
			if(mysql_get_server_info()>'5.0.1'){
			 mysql_query("SET sql_mode=''",$link);
			}
			$met_admin_table = "{$tablepre}admin_table";
			 $query = " INSERT INTO $met_admin_table set
                      admin_id           = '$regname',
                      admin_pass         = '$regpwd',
					  admin_introduction = '创始人',
				      admin_type         = 'cn-metinfo,en-metinfo',
					  admin_email        = '$email',
					  admin_register_date= '$m_now_date',
					  usertype        	 = '3',
					  admin_ok           = '1'";
			mysql_query($query) or die('写入数据库失败: ' . mysql_error());
			@chmod('../config/config_db.php',0554);
			$spt = '<script type="text/javascript" src="http://www.metinfo.cn/record.php?';
			$spt .= "url=" .$install_url;
			$spt .= "&email=".$email."&installtime=".$m_now_date."&softtype=1";
			$spt .= "&version=".VERSION."&php_ver=" .PHP_VERSION. "&mysql_ver=" .mysql_get_server_info();
			$spt .= '"></script>';
			echo $spt;			
			define('ROOTPATH', substr(dirname(__FILE__), 0, -7));		
			$localurl="http://";
			$localurl.=$_SERVER['HTTP_HOST'].$_SERVER["PHP_SELF"];
			$localurl_a=explode("/",$localurl);
			unset($localurl_a[count($localurl_a)-1]);
			unset($localurl_a[count($localurl_a)-1]);
		    if($cndata=="yes" or ($cndata<>"yes" and $endata<>"yes")){
		    $settings = parse_ini_file(ROOTPATH.'config/config_cn.inc.php');
			@extract($settings);
			$met_weburl=implode($localurl_a,"/")."/";
			include 'configsave_cn.php';
            }			
		    if($endata=="yes" or ($cndata<>"yes" and $endata<>"yes")){
		    $settings = parse_ini_file(ROOTPATH.'config/config_en.inc.php');
			@extract($settings);
			$met_weburl=implode($localurl_a,"/")."/";
			include 'configsave_en.php';
            }			
			$fp  = fopen('../config/install.lock', 'w');
			fwrite($fp," ");
			fclose($fp);
			@chmod('../config/install.lock',0554);
			
//lang inc
if($cndata=="yes" or $endata=="yes"){
$config_save =  "<?php\n";
$config_save .=  "# MetInfo Enterprise Content Management System \n";
$config_save .=  "# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. \n";
if($cndata=="yes")$config_save .=  "$"."met_ch_lang='1';\n";
if($cndata=="yes")$config_save .=  "$"."met_ch_mark='cn';\n";
$met_index_type1=($cndata=="yes")?'cn':'en';
$config_save .=  "$"."met_index_type='$met_index_type1';\n";
$met_admin_type1=$met_admin_type?($met_admin_type==1?'en':'other'):'cn';
$config_save .=  "$"."met_admin_type='cn';\n";
$config_save .=  "$"."met_admin_type_ok='1';\n";
$config_save .=  "$"."met_url_type='0';\n";
$config_save .=  "$"."met_lang_mark='1';\n";
$config_save .=  "$"."met_lang_editor='1';\n";
$config_save .=  "$"."met_langok=array();\n";
if($cndata=="yes")$config_save .="$"."met_langok[cn]=array(name=>'简体中文',useok=>'1',order=>'1',mark=>'cn',flag=>'',link=>'',newwindows=>'');\n";
if($endata=="yes")$config_save .="$"."met_langok[en]=array(name=>'English',useok=>'1',order=>'2',mark=>'en',flag=>'',link=>'',newwindows=>'');\n";
$config_save .="$"."met_langadmin=array();\n";
$config_save .="$"."met_langadmin[cn]=array(name=>'简体中文',useok=>'1',order=>'1',mark=>'cn');\n";
$config_save .="$"."met_langadmin[en]=array(name=>'English',useok=>'1',order=>'1',mark=>'en');\n";
if($cndata=="yes"){
$config_save .="$"."met_langok[cn][met_webhtm]=0;\n";
$config_save .="$"."met_langok[cn][met_htmtype]='html';\n";
$config_save .="$"."met_langok[cn][met_weburl]='$met_weburl';\n";
}
if($endata=="yes"){
$config_save .="$"."met_langok[en][met_webhtm]=0;\n";
$config_save .="$"."met_langok[en][met_htmtype]='html';\n";
$config_save .="$"."met_langok[en][met_weburl]='$met_weburl';\n";
}
$config_save       .="# This program is an open source system, commercial use, please consciously to purchase commercial license.\n";
$config_save       .="# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.\n";
$config_save       .="?>";
if(!is_writable("../config/lang.inc.php"))@chmod('../config/lang.inc.php',0777);
 $fp = fopen("../config/lang.inc.php",w);
 fputs($fp, $config_save);
 fclose($fp);
 }
require_once '../config/tablepre.php';
require_once '../include/mysql_class.php';
$db = new dbmysql();
$db->dbconn($con_db_host,$con_db_id,$con_db_pass,$con_db_name);
require_once '../include/cache.func.php';
cache_all('cn');
cache_all('en');
			include template('finished');
		}else {
		include template('adminsetup');
		}
		break;
	}
   case 'license':
   include template('license');
   break;
	default:
	{
		include template('index');
	}
}

function creat_table($content) {
	global $installinfo,$db_prefix,$db_setup;
	$sql=explode("\n",$content);
	$query='';
	$j=0;
	foreach($sql as $key => $value){
		$value=trim($value);
		if(!$value || $value[0]=='#') continue;
		if(eregi("\;$",$value)){
			$query.=$value;
			if(eregi("^CREATE",$query)){
				$name=substr($query,13,strpos($query,'(')-13);
				$c_name=str_replace('met_',$db_prefix,$name);
				$i++;
			}
			$query = str_replace('met_',$db_prefix,$query);
			if(!mysql_query($query)){
				$db_setup=0;
				if($j!='0'){
				echo '<li class="WARN">出错：'.mysql_error().'<br/>sql:'.$query.'</li>';
				}
			}else {
			     
				if(eregi("^CREATE",$query)){
					$installinfo=$installinfo.'<li class="OK"><font color="#0000EE">建立数据表'.$i.'</font>'.$c_name.' ... <font color="#0000EE">完成</font></li>';
				}
				$db_setup=1;
			}
			$query='';
		} else{
			$query.=$value;
		}
		$j++;
	}
	return $installinfo;
}
function readover($filename,$method="rb"){
	if($handle=@fopen($filename,$method)){
		flock($handle,LOCK_SH);
		$filedata=@fread($handle,filesize($filename));
		fclose($handle);
	}
	return $filedata;
}
function daddslashes($string, $force = 0) {
	!defined('MAGIC_QUOTES_GPC') && define('MAGIC_QUOTES_GPC', get_magic_quotes_gpc());
	if(!MAGIC_QUOTES_GPC || $force) {
		if(is_array($string)) {
			foreach($string as $key => $val) {
				$string[$key] = daddslashes($val, $force);
			}
		} else {
			$string = addslashes($string);
		}
	}
	return $string;
}
function template($template,$EXT="htm"){
	global $met_skin_user,$skin;
	unset($GLOBALS[con_db_id],$GLOBALS[con_db_pass],$GLOBALS[con_db_name]);
	$path = "templates/$template.$EXT";
	return  $path;
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>