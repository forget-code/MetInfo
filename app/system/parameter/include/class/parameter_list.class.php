<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.

defined('IN_MET') or exit('No permission');

/**
 * 字段数据库类
 */

class  parameter_list {

	/**
		* 初始化
		*/
	public function __construct() {
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
		$query = "SELECT * FROM {$_M['table']['plist']} WHERE listid = '{$id}' AND module = '{$module}'";
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
		if ($module <= 5) {
			
		}
		$query = "SELECT * FROM {$_M['table']['plist']} WHERE listid = '{$id}' AND module = '{$module}'";
		$list = DB::get_all($query);
		foreach ($list as $key => $val) {
			$relist[$val['paraid']] = $val;
		}
		return $relist;
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
	public function get_parameter($lang , $module , $class1 = '' , $class2 = '' , $class3 = '' ){
		global $_M;
		$where = "WHERE lang= '$lang' AND (( module = '$module' and class1=0 ) OR ( module = '$module'";
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
		$query = "SELECT * FROM {$_M['table']['parameter']} {$where} ORDER BY no_order ASC, id DESC";
		$paras = DB::get_all($query);
		foreach ($paras as $key => $val) {
			if ($val['type'] == 2 or $val['type'] == 4 or $val['type'] == 6) {
				$paras[$key]['para_list'] = $this->get_parameter_list($val['id']);
			} else {
				$paras[$key]['para_list'] = '';
			}
		}
		return $paras;
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

}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>
