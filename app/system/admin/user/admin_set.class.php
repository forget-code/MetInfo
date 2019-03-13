<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');

load::sys_class('admin');

class admin_set extends admin {
	public $paraclass;
	public function __construct() {
		parent::__construct();
		global $_M;
		nav::set_nav(1,'会员列表', $_M['url']['own_name'].'c=admin_user&a=doindex');
		nav::set_nav(2, '会员组', $_M['url']['own_name'].'c=admin_group&a=doindex');
		nav::set_nav(3, '会员属性', $_M['url']['own_name'].'c=admin_set&a=douserfield');
		nav::set_nav(4, '会员功能设置', $_M['url']['own_name'].'c=admin_set&a=doindex');
		nav::set_nav(5, '社会化登录', $_M['url']['own_name'].'c=admin_set&a=doopen');
		nav::set_nav(6, '邮件内容设置', $_M['url']['own_name'].'c=admin_set&a=doemailset');
		$this->paraclass = load::mod_class('system/class/sys_para', 'new');
		
	}
	public function doindex(){
		global $_M;
		nav::select_nav(4);
		require_once $this->template('tem/user_set');
	}
	public function doregsetsave(){
		global $_M;
		$configlist = array();
		$configlist[] = 'met_member_register';
		$configlist[] = 'met_member_vecan';
		$configlist[] = 'met_member_bgcolor';
		$configlist[] = 'met_member_force';
		$configlist[] = 'met_member_bgimage';
		configsave($configlist);
		turnover("{$_M[url][own_form]}a=doindex");
	}
	public function dojson_para_list(){
		global $_M;
		$order = "no_order";
		$where = '';
		$paralist = $this->paraclass->json_para_list($where, $order, 10);
		foreach($paralist as $key=>$val){
			$list = array();
			$list[] = $val['id_html'];
			$list[] = $val['no_order_html'];
			$list[] = $val['name_html'];
			$list[] = $val['paratype_html'];
			$list[] = $val['wr_oks_html'];
			$list[] = $val['wr_ok_html'];
			$list[] = $val['description_html'];
			$list[] = $val['options_html'];
			$rarray[] = $list;
		}
		
		$this->paraclass->json_return($rarray);
	}
	public function doparasave(){
		global $_M;
		$this->paraclass->table_para($_M['form'],10);
		turnover("{$_M[url][own_form]}a=douserfield");
	}
	public function doparaaddlist(){
		global $_M;
		$id = 'new-'.$_M['form']['ai'];
		$metinfo ="<tr class=\"even newlist\">
					<td class=\"met-center\"><input name=\"id\" type=\"checkbox\" value=\"{$id}\" checked></td>
					<td class=\"met-center\"><input type=\"text\" name=\"no_order-{$id}\" class=\"ui-input met-center\" value=\"\" placeholder=\"排序\"></td>
					<td><input type=\"text\" name=\"name-{$id}\" class=\"ui-input listname\" value=\"\" placeholder=\"名称\"></td>
					<td class=\"met-center\">";
		$metinfo.=$this->paraclass->para_type($id);
		$metinfo.="</td>
					<td class=\"met-center\"><input name=\"wr_oks-{$id}\" type=\"checkbox\" value=\"1\"></td>
					<td class=\"met-center\"><input name=\"wr_ok-{$id}\" type=\"checkbox\" value=\"1\"></td>
					<td><input type=\"text\" name=\"description-{$id}\" class=\"ui-input\" value=\"\"></td>
					<td><button type=\"button\" class=\"btn btn-info none paraoption\" data-id=\"{$id}\">设置选项</button><input name=\"options-{$id}\" type=\"hidden\" value=\"\"></td>
				</tr>"; 
		echo $metinfo;
	}
	public function douserfield(){
		global $_M;
		nav::select_nav(3);
		require_once $this->template('tem/user_field');
	}
	public function doopen(){
		global $_M;
		nav::select_nav(5);
		require_once $this->template('tem/open');
	}
	public function doopensave(){
		global $_M;
		$configlist = array();
		$configlist[] = 'met_weixin_appid';
		$configlist[] = 'met_weixin_appsecret';
		$configlist[] = 'met_weixin_gz_appid';
		$configlist[] = 'met_weixin_gz_appsecret';
		$configlist[] = 'met_weibo_appkey';
		$configlist[] = 'met_weibo_appsecret';
		$configlist[] = 'met_qq_appid';
		$configlist[] = 'met_qq_appsecret';
		$configlist[] = 'met_weixin_open';
		$configlist[] = 'met_weibo_open';
		$configlist[] = 'met_qq_open';
		configsave($configlist);
		turnover("{$_M[url][own_form]}a=doopen");
	}
	
	public function doemailset(){
		global $_M;
		nav::select_nav(6);
		require_once $this->template('tem/email');
	
	}
	
	public function doemailsetsave(){
		global $_M;
		$configlist = array();
		$configlist[] = 'met_member_email_reg_title';
		$configlist[] = 'met_member_email_reg_content';
		
		$configlist[] = 'met_member_email_password_title';
		$configlist[] = 'met_member_email_password_content';
			
		$configlist[] = 'met_member_email_safety_title';
		$configlist[] = 'met_member_email_safety_content';

		configsave($configlist);
		turnover("{$_M[url][own_form]}a=doemailset");
	
	}
	
}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>