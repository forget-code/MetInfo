<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.

defined('IN_MET') or exit('No permission');

load::sys_class('database');

/**
 * 系统标签类
 */

class config_database extends database {

	/**
	 * 初始化，继承类需要调用
	*/
	public function __construct() {
		global $_M;
		$this->construct($_M['table']['config']);
	}

	public function get_value($name,$lang)
	{
		global $_M;
		if(!$lang){
			$lang = $_M['lang'];
		}

		$query = "SELECT * FROM {$_M['table']['config']} WHERE name = '{$name}' AND lang = '{$lang}'";
		$config =  DB::get_one($query);
		if($config){
			return $config['value'];
		}else{
			return false;
		}
	}

	public function get_value_by_columnid($id){
		global $_M;
		$query = "SELECT * FROM {$_M['table']['config']} WHERE columnid = '{$id}'";
		return $config =  DB::get_all($query);

	}
}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>
