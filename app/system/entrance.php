<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

//�汾��
define ('SYS_VER', 'beta 1.101');
define ('SYS_VER_TIME', '20150511');

header("Content-type: text/html;charset=utf-8");

error_reporting(E_ERROR | E_PARSE | E_CORE_ERROR |E_COMPILE_ERROR | E_USER_ERROR );
//error_reporting(E_ALL);
PHP_VERSION >= '5.1' && date_default_timezone_set('Asia/Shanghai');

@set_time_limit(0);

define('IN_MET', true);

//��վ��Ŀ¼
define ('PATH_WEB', substr(dirname(__FILE__),0,-10));
//Ӧ�ÿ�������Ŀ¼
define ('PATH_APP', PATH_WEB."app/");
//Ӧ���ļ���Ŀ¼
define ('PATH_ALL_APP', PATH_WEB."app/app/");
//�����ļ���Ŀ¼
define ('PATH_CONFIG', PATH_WEB."config/");
//�����ļ���Ŀ¼
define ('PATH_CACHE', PATH_WEB."cache/");
//Ӧ�ÿ�������ں˸�Ŀ¼
define ('PATH_SYS', PATH_APP."system/");

//ϵͳ���Ŀ¼
define ('PATH_SYS_CLASS', PATH_WEB."app/system/include/class/");
//ϵͳ������Ŀ¼
define ('PATH_SYS_FUNC', PATH_WEB."app/system/include/function/");
//ϵͳģ�幫���ļ���Ŀ¼
define ('PATH_SYS_PUBLIC', PATH_WEB."app/system/include/public/");
//ϵͳģ���Ŀ¼
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
//��ǰ�ļ��е�ַ
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
//�������п�ʼʱ��
define ('TIME_SYS_START', time());
//�������Զ�����
define ('MAGIC_QUOTES_GPC', get_magic_quotes_gpc());

//��ǰ���ʵ�������
define ('HTTP_HOST', $_SERVER['HTTP_HOST']);
//��Դҳ��
define('HTTP_REFERER', $_SERVER['HTTP_REFERER']);
//�ű�·��
define ('PHP_SELF', $_SERVER['PHP_SELF']);

if (!preg_match('/^[A-Za-z0-9_]+$/', M_TYPE.M_NAME.M_MODULE.M_CLASS.M_ACTION)) {
	echo 'Constants must be numbers or letters or underlined';
	die();
}

require_once PATH_SYS_CLASS.'load.class.php';

load::module();

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>