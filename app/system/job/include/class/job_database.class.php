<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.

defined('IN_MET') or exit('No permission');

load::mod_class('message/message_database');

/**
 * 招聘数据类
 */

class  job_database extends message_database{

	public function __construct() {
		global $_M;
		$this->construct($_M['table']['job']);
	}

  public function get_list_by_class_sql($id, $type = 'all') {
		if (is_array($type)) {
			$sql .= "AND ( 1 != 1 ";
			if ($type['title']['status']) {
				$sql .= " OR position = '{$type['title']['info']}' ";
			}else{
				$sql .= " OR position like '%{$type['title']['info']}%' ";
			}
			if ($type['search']['content']['status']) {
				$sql .= " OR content = '{$type['content']['info']}' ";
			}else{
				$sql .= " OR content like '%{$type['content']['info']}%' ";
			}

			if ($type['search']['para']['status']) {
				
			}else{
				
			}
			$sql .= " ) ";
		}
		$sql .= " {$this->langsql} AND displaytype = 1 ";
		$sql .= " ORDER BY top_ok DESC, no_order DESC, addtime DESC, id DESC ";
		return $sql;
	}

	/**
	 * 获取招聘岗位简历字段
	 * @param  string  $lang    语言
	 * @return array            招聘岗位数组
	 */
	public function get_module_para() {
		return load::mod_class('parameter/parameter_database', 'new')->get_parameter('job');
	}

	/**
	 * 获取简历信息
	 * @param  string  $jid  简历id
	 * @return array         简历信息
	 */
	public function get_job_cv($jid) {

	}

	public function table_para(){
    return 'id|position|count|place|deal|addtime|useful_life|content|access|no_order|wap_ok|top_ok|email|filename|lang|displaytype';
  }

}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>
