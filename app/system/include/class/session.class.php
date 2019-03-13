<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');

class session{	
	
	public function __construct() {
		global $_M;
		$this->start();
	}
	
	public function start(){
		session_id(md5($_SERVER['HTTP_USER_AGENT'].$_SERVER['REMOTE_ADDR']));
		session_start();
	}
	
	public function set($name, $value){
		$this->start();
		$_SESSION[$name] = $value;
	}
	
	public function get($name){
		$this->start();
		return $_SESSION[$name];
	}
	
	public function del($name){
		$this->start();
		unset($_SESSION[$name]);
	}
	
	
}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>