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

	public function add_para_value($listid,$paraid,$info,$imgname)
	{
		global $_M;
		if($this->module == 8){
			$query = "INSERT INTO $this->table SET listid = {$listid},paraid={$paraid},info='{$info}',lang='{$_M['lang']}',module={$this->module}";
		}else{
			$query = "INSERT INTO $this->table SET listid = {$listid},paraid={$paraid},info='{$info}',lang='{$_M['lang']}',module={$this->module},imgname='{$imgname}'";
		}

		return DB::query($query);

	}

	public function delete_list_value($listid,$paraid)
	{
		global $_M;
		$query = "DELETE FROM $this->table WHERE listid = {$listid} AND paraid = {$paraid} AND module = $this->module AND lang = '{$_M['lang']}'";
		return DB::query($query);

	}

	public function update_by_listid_paraid($listid, $paraid, $info, $imgname){
		global $_M;

		if(!self::select_by_listid_paraid($listid, $paraid)){
			self::add_para_value($listid,$paraid,$info,$imgname);
		}else{
			$query = "UPDATE $this->table SET info='{$info}',imgname='{$imgname}' WHERE listid='{$listid}' AND paraid='{$paraid}' AND lang='{$_M['lang']}' AND module = $this->module";
			DB::query($query);
		}

		return true;
	}

	public function del_by_listid($listid){
		global $_M;
		$query = "DELETE FROM $this->table WHERE listid='{$listid}' AND module = $this->module";
		return DB::query($query);
	}

	public function del_parameter_by_class($classtype,$cid)
	{
		global $_M;
		$type = "class{$classtype}";//class1,class2,class3
		$query = "SELECT * FROM {$_M['table']['parameter']} WHERE {$type} = {$cid} AND module = $this->module AND lang = '{$_M['lang']}'";
		$parameter = DB::get_all($query);

		foreach ($parameter as $para) {

			$query = "DELETE FROM {$_M['table']['parameter']} WHERE id = {$para['id']}";
			DB::query($query);

			$query = "DELETE FROM {$_M['table']['para']} WHERE pid = {$para['id']}";
			DB::query($query);

			$query = "DELETE FROM $this->table WHERE module = $this->module AND lang = '{$_M['lang']}' AND paraid = {$para['id']}";
			DB::query($query);
		}
	}

}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>
