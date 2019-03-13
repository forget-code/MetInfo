<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.

defined('IN_MET') or exit('No permission');

load::sys_class('database');

/**
 * 系统标签类
 */

class ifcolumn_database extends database {

	/**
	 * 初始化，继承类需要调用
	*/
	public function __construct() {
		global $_M;
		$this->construct($_M['table']['ifcolumn']);
		$this->get_lang('#all');
	}

}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>
