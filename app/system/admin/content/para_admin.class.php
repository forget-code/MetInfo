<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');

load::sys_class('admin.class.php');

class para_admin extends admin {
	public $paraclass;
	function __construct() {
		global $_M;
		parent::__construct();
		$this->paraclass = load::mod_class('system/class/sys_para', 'new');
	}
	
	function doindex() {
		global $_M;
		require $this->template('tem/para_index');
	}
	
	function dojson_para_list(){
		global $_M;
		$moduleclass = load::mod_class('content/class/module');
		$column = $moduleclass->column(3,3);
		$order = "no_order";
		$where = '';
		$paralist = $this->paraclass->json_para_list($where, $order, 3);
		foreach($paralist as $key=>$val){
			$list = array();
			$list[] = $val['id_html'];
			$list[] = $val['name_html'];
			$list[] = $val['paratype_html'];
			$list[] = '';
			$list[] = '';
			$list[] = $val['wr_ok_html'];
			$list[] = $val['no_order_html'];
			$list[] = $val['options_html'];
			$rarray[] = $list;
		}
		$this->paraclass->json_return($rarray);
	}

}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>