<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');

load::sys_class('admin');

class about extends admin {
	public $iniclass;
	function __construct() {
		global $_M;
		parent::__construct();
	}
	
	function doindex() {
		global $_M;
		$agens = php_uname('s').' '.php_uname('r');
		$php   = PHP_VERSION;
		$mysql =mysql_get_server_info();
		$web   = $_SERVER['SERVER_SOFTWARE'];
		$web   = str_replace("PHP/{$php}","",$web);
		$url   = str_replace("http://","",$_M[url][site]);
		if(substr($url,-1,1)=="/")$url   = substr($url,0,strlen($url)-1); 
		//$ip    = gethostbyname($url);
		$ip    = $ip==$url?'127.0.0.1':$ip;
		if(file_exists(PATH_WEB."{$_M['config']['met_adminfile']}/update/cms/auto.lock")){
			$data_auto = 0;
		}else{
			$data_auto = 1;
		}
		require $this->template('tem/index');
	}

}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>