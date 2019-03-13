<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.

defined('IN_MET') or exit('No permission');

load::sys_class('database');

/**
 * 字段数据库类
 */

class  parameter_list_database  extends database{
	/**
		* 初始化
		*/
	public function construct($module, $table = '') {
		global $_M;
		switch ($module) {
			case '3':
				parent::construct($_M['table']['plist']);
				$this->module = 3;
			break;
			case '4':
				parent::construct($_M['table']['plist']);
				$this->module = 4;
			break;
			case '5':
				parent::construct($_M['table']['plist']);
				$this->module = 5;
			break;
			break;
			case '6':
				parent::construct($_M['table']['plist']);
				$this->module = 6;
			break;
			case '7':
					parent::construct($_M['table']['mlist']);
					$this->module = 7;
			break;
			case '8':
				parent::construct($_M['table']['flist']);
				$this->module = 8;
			break;
			default:

			break;
		}
	}

	public function select_by_listid_paraid($listid, $paraid){
		global $_M;
		$query = "SELECT * FROM $this->table WHERE listid='{$listid}' AND paraid='{$paraid}' AND module = '$this->module'";
		return DB::get_one($query);
	}

	public function update_by_listid_paraid($listid, $paraid, $info, $imgname){
		global $_M;
		$query = "UPDATE $this->table SET info='{$info}',imgname='{$imgname}' WHERE listid='{$listid}' AND paraid='{$paraid}'";
		return DB::query($query);
	}

	public function del_by_listid($listid){
		global $_M;
		$query = "DELETE FROM $this->table WHERE listid='{$listid}'";
		return DB::query($query);
	}

}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>
