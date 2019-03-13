<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.

defined('IN_MET') or exit('No permission');

load::sys_class('web');

/**
 * 前台基类
 */
class userweb extends web {
	public $userclass;
	/**
	  * 初始化
	  */
	public function __construct() {
		global $_M;
		parent::__construct();
		$this->check();
		$this->userclass = load::sys_class('user', 'new');
		$query = "SELECT * FROM {$_M['table']['column']} WHERE module='10' AND lang='{$_M['lang']}'";
		$member = DB::get_one($query);
		if($_M['config']['met_title_type'] == 0){
			$_M['tem_data']['title'] = $member['name'];
		}else if($_M['config']['met_title_type'] == 1){
			$_M['tem_data']['title'] = $member['name'].'-'.$_M['config']['met_keywords'];
		}else if($_M['config']['met_title_type'] == 2){
			$_M['tem_data']['title'] = $member['name'].'-'.$_M['config']['met_webname'];
		}else if($_M['config']['met_title_type'] == 3){
			$_M['tem_data']['title'] = $member['name'].'-'.$_M['config']['met_keywords'].'-'.$_M['config']['met_webname'];
		}

		$query = "SELECT * FROM {$_M['table']['ifmember_left']}";
		$navigation = DB::get_all($query);
		foreach($navigation as $key=>$val){
			if($val[columnid]){
				//$column = $class_list[$val[columnid]];
				$query = "SELECT * FROM {$_M['table']['column']} WHERE id = '{$val[columnid]} ' and lang='{$_M['lang']}'";
				$column = DB::get_one($query);
				$val['foldername'] = $val['foldername'] ? $val['foldername'] : $column['foldername'];
				$val['filename'] = $val['filename'] ? $val['filename'] : 'index.php';
				$list['url'] = "../{$val['foldername']}/{$val['filename']}";
				$list['title'] = $column['name'];
			}else{
				$list['url'] = "../{$val['foldername']}/{$val['filename']}";
				$list['title'] = $val['title'];
			}
			$_M['html']['app_sidebar'][] = $list;
		}
		// 前台模板公共参数
		$query = "SELECT * FROM {$_M['table']['ui_config']} WHERE skin_name = '{$_M['config']['met_skin_user']}' and lang='{$_M['lang']}' and ui_name='system'";
		$ui_config = DB::get_all($query);
		foreach ($ui_config as $key => $value) {
			$_M['ui_config'][$value['uip_name']]=$value['uip_value']?$value['uip_value']:$value['uip_default'];
		}
	}

	public function check() {
		global $_M;
		$user = $this->get_login_user_info();
		if(!$user){
			okinfo($_M['url']['site'].'member/login.php?gourl='.$_M['form']['gourl']);
		}
	}

	public function mcheck() {
		global $_M;

	}

	protected function template($path){
		global $_M;
		list($postion, $file) = explode('/',$path);
		if ($postion == 'own') {
			return PATH_OWN_FILE."templates/met/{$file}.php";
		}
		if ($postion == 'ui') {
			return PATH_SYS."include/public/ui/web/{$file}.php";
		}
		if($postion == 'tem'){
			if (file_exists(PATH_TEM."user/{$file}.php")) {
				$dir = PATH_TEM."user/{$file}.php";
			}else{
				if (file_exists(PATH_SYS."user/web/templates/met/{$file}.php")) {
					$dir = PATH_SYS."user/web/templates/met/{$file}.php";
				}
			}

			if($_M['custom_template']['sys_content']){
				return $dir;
			}else{
				$_M['custom_template']['sys_content'] = $dir;
				return $this->template('ui/compatible');

			}

		}

	}

	/**
	  * 重写web类的load_url_unique方法，获取前台特有URL
	  */
	protected function load_url_unique() {
		global $_M;
		parent::load_url_unique();
		load::mod_class('user/user_url', 'new')->insert_m();
	}

	protected function navlist(){

	}
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>
