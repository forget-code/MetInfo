<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

//版本号
define ('SYS_VER', 'beta 1.101');
define ('SYS_VER_TIME', '20150511');

header("Content-type: text/html;charset=utf-8");

error_reporting(E_ERROR | E_PARSE | E_CORE_ERROR |E_COMPILE_ERROR | E_USER_ERROR );
//error_reporting(E_ALL);
PHP_VERSION >= '5.1' && date_default_timezone_set('Asia/Shanghai');

@set_time_limit(0);

define('IN_MET', true);

//网站根目录
define ('PATH_WEB', substr(dirname(__FILE__),0,-10));
//应用开发包根目录
define ('PATH_APP', PATH_WEB."app/");
//应用文件根目录
define ('PATH_ALL_APP', PATH_WEB."app/app/");
//配置文件根目录
define ('PATH_CONFIG', PATH_WEB."config/");
//缓存文件根目录
define ('PATH_CACHE', PATH_WEB."cache/");
//应用开发框架内核根目录
define ('PATH_SYS', PATH_APP."system/");

//系统类根目录
define ('PATH_SYS_CLASS', PATH_WEB."app/system/include/class/");
//系统方法根目录
define ('PATH_SYS_FUNC', PATH_WEB."app/system/include/function/");
//系统模板公用文件根目录
define ('PATH_SYS_PUBLIC', PATH_WEB."app/system/include/public/");
//系统模块根目录
define ('PATH_SYS_MODULE', PATH_WEB."app/system/include/module/");

if (!defined('M_TYPE')) {
	if(file_exists(PATH_APP.'app/'.M_NAME.'/')&&M_NAME){
		define('M_TYPE', 'app');
	}else{
		define('M_TYPE', 'system');
	}
}

if (!defined('M_MODULE')) {
	define ('M_MODULE', 'include');
	define ('M_CLASS', $_GET['c']);
	define ('M_ACTION', $_GET['a']);
}
//当前文件夹地址
if(M_TYPE == 'system'){
	if(M_MODULE == 'include'){
		define ('PATH_OWN_FILE', PATH_APP.M_TYPE.'/'.M_MODULE.'/module/');
	}else{
		define ('PATH_OWN_FILE', PATH_APP.M_TYPE.'/'.M_MODULE.'/'.M_NAME.'/');
	}
}else{
	define ('PATH_OWN_FILE', PATH_APP.M_TYPE.'/'.M_NAME.'/'.M_MODULE.'/');
	define ('PATH_APP_FILE', PATH_APP.M_TYPE.'/'.M_NAME.'/');
}

define ('PATH_MODULE_FILE', PATH_APP.'system'.'/'.M_MODULE.'/');
//程序运行开始时间
define ('TIME_SYS_START', time());
//表单变量自动过滤
define ('MAGIC_QUOTES_GPC', get_magic_quotes_gpc());

//当前访问的主机名
define ('HTTP_HOST', $_SERVER['HTTP_HOST']);
//来源页面
define('HTTP_REFERER', $_SERVER['HTTP_REFERER']);
//脚本路径
$phpfile = basename(__FILE__);
$_SERVER['PHP_SELF']=htmlentities($_SERVER['PHP_SELF']);
define ('PHP_SELF', $_SERVER['PHP_SELF']=="" ? $_SERVER['SCRIPT_NAME'] : $_SERVER['PHP_SELF']);

if (!preg_match('/^[A-Za-z0-9_]+$/', M_TYPE.M_NAME.M_MODULE.M_CLASS.M_ACTION)) {
	echo 'Constants must be numbers or letters or underlined';
	die();
}

require_once PATH_SYS_CLASS.'load.class.php';

load::module();

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>