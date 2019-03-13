<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');

load::sys_class('admin');

class admin_group extends admin {
	public $userclass;
	public function __construct() {
		parent::__construct();
		global $_M;
		nav::set_nav(1,'会员列表', $_M['url']['own_name'].'c=admin_user&a=doindex');
		nav::set_nav(2, '会员组', $_M['url']['own_name'].'c=admin_group&a=doindex');
		nav::set_nav(3, '会员属性', $_M['url']['own_name'].'c=admin_set&a=douserfield');
		nav::set_nav(4, '会员功能设置', $_M['url']['own_name'].'c=admin_set&a=doindex');
		nav::set_nav(5, '社会化登录', $_M['url']['own_name'].'c=admin_set&a=doopen');
		nav::set_nav(6, '邮件内容设置', $_M['url']['own_name'].'c=admin_set&a=doemailset');
		$this->userclass = load::mod_class('user/class/sys_user', 'new');
		
	}
	public function dojson_group_list(){
		$this->userclass->json_group_list();
	}
	public function doaddlist(){
		global $_M;
		$id = 'new-'.$_M['form']['ai'];
		$metinfo ="<tr class=\"even newlist\">
					<td class=\"met-center\"><input name=\"id\" type=\"checkbox\" value=\"{$id}\" checked></td>
					<td><input type=\"text\" name=\"name-{$id}\" class=\"ui-input listname\" value=\"\" placeholder=\"会员组名称\"></td>
					<td><input type=\"text\" name=\"access-{$id}\" class=\"ui-input\" value=\"\"></td>
				</tr>"; 
		echo $metinfo;
	}
	public function doindex(){
		global $_M;
		nav::select_nav(2);
		require_once $this->template('tem/user_group');
	}
	public function dosave(){
		global $_M;
		$this->userclass->save_group($_M['form']['allid'],$_M['form']['submit_type']);
		turnover("{$_M[url][own_form]}a=doindex");
	}
	
}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>