<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.

defined('IN_MET') or exit('No permission');

load::sys_class('database');

/**
 * 字段数据库类
 */

class  parameter_database extends database{

	/**
		* 初始化
		*/
	public function __construct() {
		global $_M;
		$this->construct($_M['table']['parameter']);
	}

	//获取list存放的表
	public function get_plist_table($module){
		global $_M;
		switch ($module) {
			case 7:
			$table = $_M['table']['mlist'];
			break;
			default:
			$table = $_M['table']['plist'];
			break;
		}
		return $table;
	}

	/**
	 * 获取字段
	 * @param  string  $lang    语言
	 * @param  string  $module  模块（3:产品|4:下载|5:图片|6:简历|7:留言|8:反馈|10:会员）
	 * @param  string  $class1  一级栏目
	 * @return array            字段数组
	 */
	public function get_list($id, $module){
		global $_M;
		$table = $this->get_plist_table($module);
		$query = "SELECT * FROM {$table} WHERE listid = '{$id}' AND module = '{$module}'";
		$list = DB::get_all($query);
		foreach ($list as $key => $val) {
			$relist[$val['paraid']] = $val;
		}
		return $relist;
	}

	/**
	 * 写入字段
	 * @param  string  $lang    语言
	 * @param  string  $module  模块（3:产品|4:下载|5:图片|6:简历|7:留言|8:反馈|10:会员）
	 * @param  string  $class1  一级栏目
	 * @return array            字段数组
	 */
	public function insert_list($listid, $paraid, $info, $imgname, $lang, $module){
		global $_M;
		$para_list = load::mod_class('parameter/parameter_list_database', 'new');
		$para_list->construct($module);
		$array['listid'] = $listid;
		$array['paraid'] = $paraid;
		$array['info'] = $info;
		
		$array['lang'] = $lang;
		$array['module'] = $module;
		if($module!=8){
           $array['imgname'] = $imgname;
		}
		
		return $para_list->insert($array);
	}

	/**
	 * 写入字段
	 * @param  string  $lang    语言
	 * @param  string  $module  模块（3:产品|4:下载|5:图片|6:简历|7:留言|8:反馈|10:会员）
	 * @param  string  $class1  一级栏目
	 * @return array            字段数组
	 */
	public function update_list($listid, $paraid, $info, $imgname, $module){
		global $_M;
		$para_list = load::mod_class('parameter/parameter_list_database', 'new');
		$para_list->construct($module);
		return $para_list->update_by_listid_paraid($listid, $paraid, $info, $imgname);
	}

	/**
	 * 写入字段
	 * @param  string  $lang    语言
	 * @param  string  $module  模块（3:产品|4:下载|5:图片|6:简历|7:留言|8:反馈|10:会员）
	 * @param  string  $class1  一级栏目
	 * @return array            字段数组
	 */
	public function del_list($listid, $module){
		global $_M;
		$para_list = load::mod_class('parameter/parameter_list_database', 'new');
		$para_list->construct($module);
		return $para_list->del_by_listid($listid);
	}

	/**
	 * 获取字段
	 * @param  string  $lang    语言
	 * @param  string  $module  模块（3:产品|4:下载|5:图片|6:简历|7:留言|8:反馈|10:会员）
	 * @param  string  $class1  一级栏目
	 * @param  string  $class2  二级栏目
	 * @param  string  $class3  三级栏目
	 * @return array            字段数组
	 */
	public function get_parameter($module , $class1 = '' , $class2 = '' , $class3 = '' ){
		global $_M;
		$where = "WHERE {$this->langsql} AND (( module = '$module' AND class1 = 0) OR ( module = '$module'";
		if($class1){
			$where .=" AND class1 = '$class1' ";
		}
		if($class2){
			$where .=" AND class2 = '$class2' ";
		}
		if($class3){
			$where .=" AND class3 = '$class3' ";
		}
		$where .= " ) )";
		$query = "SELECT * FROM {$_M['table']['parameter']} {$where} ORDER BY no_order ASC, id DESC ";
		$paras = DB::get_all($query);
		foreach ($paras as $key => $val) {
			if ($val['type'] == 2 or $val['type'] == 4 or $val['type'] == 6) {
				if($val['options']){
					$paras[$key]['para_list'] = explode("$|$", $val['options']);
					$paras[$key]['para_list']=array_filter($paras[$key]['para_list']);
				}else{
					$paras[$key]['para_list'] = $this->get_parameter_list($val['id']);
				}
			} else {
				$paras[$key]['para_list'] = '';
			}
		}

		return $paras;
	}

	//获取栏目下面的内容,返回内容不包含下级栏目内容
	public function get_list_by_class_no_next($id) {
		global $_M;
		if(is_numeric($id)){
			$class123 = load::sys_class('label', 'new')->get('column')->get_class123_no_reclass($id);
			$module = $class123['class1']['module'];
		}else{
			$module = load::sys_class('handle', 'new')->file_to_mod($id);
		}
		$sql = " {$this->langsql} AND module = '{$module}' ";

		if ($class123['class1']['id']) {
			if($module == 7 ){
				$sql .= " AND (class1 = '{$class123['class1']['id']}' OR class1 = 0)";
			}else{
				$sql .= " AND class1 = '{$class123['class1']['id']}' ";
			}
		} else {
			$sql .= " AND ( class1 = '' OR class1 = '0' ) ";
		}

		if ($class123['class2']['id']) {
			$sql .= " AND class2 = '{$class123['class2']['id']}' ";
		} else {
			$sql .= " AND ( class2 = '' OR class2 = '0' ) ";
		}

		if ($class123['class3']['id']) {
			$sql .= " AND class3 = '{$class123['class3']['id']}' ";
		} else {
			$sql .= " AND ( class3 = '' OR class3 = '0' ) ";
		}

		$query = "SELECT * FROM {$_M['table']['parameter']} WHERE $sql ";
		return DB::get_all(	$query);
	}

	/**
	 * 获取字段的选项列表
	 * @param  string  $paraid  字段id
	 * @return array            字段选项数组
	 */
	public function get_parameter_list($paraid) {
		global $_M;
		$query = "SELECT * FROM {$_M['table']['list']} WHERE bigid='{$paraid}' ORDER BY no_order ASC";
		return DB::get_all($query);
	}

	public function table_para(){
		return 'id|name|options|description|no_order|type|access|wr_ok|class1|class2|class3|module|lang|wr_oks';
	}

}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>
