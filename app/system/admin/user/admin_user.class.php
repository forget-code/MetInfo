<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');

load::sys_class('admin');

class admin_user extends admin {
	public $userclass;
	public $group;
	public $grouplist;
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
		
		$this->userclass = load::mod_class('user/class/sys_user', 'new');
		$this->paraclass = load::sys_class('para', 'new');
		$this->group = load::mod_class('user/class/sys_group', 'new');
		$this->grouplist = $this->group->get_group_list();
	}
	public function dojson_user_list(){
		$this->userclass->json_user_list();
	}
	public function doindex(){
		global $_M;
		nav::select_nav(1);
		require_once $this->template('tem/user_index');
	}
	
	public function doadd(){
		global $_M;
		nav::select_nav(1); 
		require_once $this->template('tem/user_add');
	}
	
	public function douserok() {
		global $_M;
		$valid = '1|可以注册';
		if(!$this->userclass->check_str($_M['form']['username'])){
			$valid = '0|含有非法字符';
		}
		if($this->userclass->get_user_by_username_sql($_M['form']['username'])||$this->userclass->get_admin_by_username_sql($_M['form']['username'])){
			$valid = '0|用户名已存在';
		}
		echo $valid;
	}
	public function doemailok() {
		global $_M;
		$valid = 'SUCCESS';
		$user = $this->userclass->get_user_by_email($_M['form']['email']);
		if($user && $user['id']!=$_M['form']['id']){
			$valid = 'error';
		}
		echo $valid;
	}
	public function dotelok() {
		global $_M;
		$valid = 'SUCCESS';
		$user = $this->userclass->get_user_by_tel($_M['form']['tel']);
		if($user && $user['id']!=$_M['form']['id']){
			$valid = 'error';
		}
		echo $valid;
	}
	
	public function doaddsave(){
		global $_M;
		$info = '';
		if($this->userclass->register($_M['form']['username'], $_M['form']['password'],'','',$info, $_M['form']['valid'],$_M['form']['groupid'])){
			turnover("{$_M[url][own_form]}a=doindex", '注册成功');
		}else{
			turnover("{$_M[url][own_form]}a=doadd", '注册失败');
		}
	}
	
	public function doeditor(){
		global $_M;
		nav::select_nav(1);
		$user = $this->userclass->get_user_by_id($_M['form']['id']);
		require_once $this->template('tem/user_editor');
	}
	
	public function doeditorsave(){
		global $_M;
		if($_M['form']['password']){
			if(!$this->userclass->editor_uesr_password($_M['form']['id'], $_M['form']['password'])){
				if($this->userclass->errorno=='error_password_cha'){
					turnover("{$_M[url][own_form]}a=doeditor&id={$_M['form']['id']}", '请输入6-30位的密码');
				}
			}
		}
		$this->userclass->editor_uesr($_M['form']['id'], $_M['form']['email'],$_M['form']['tel'], $_M['form']['valid'],$_M['form']['groupid']);
		$info = $this->paraclass->form_para($_M['form'],10);
		$this->paraclass->update_para($_M['form']['id'],$info,10);
		turnover("{$_M[url][own_form]}a=doindex", '编辑成功');
	}
	
	public function dodellist(){
		global $_M;
		$this->userclass->del_uesr($_M['form']['allid']);
		turnover("{$_M[url][own_form]}a=doindex");
	}
	
	function dousercsv(){
		global $_M;
		
		$groupid = $_M['form']['groupid'];
		$keyword = $_M['form']['keyword'];
		$search = $groupid?"and groupid = '{$groupid}'":'';  
		$search.= $keyword?"and (username like '%{$keyword}%' || email like '%{$keyword}%' || tel like '%{$keyword}%')":''; 
		
		/*查询表*/
		$query = "SELECT * FROM {$_M['table']['user']} WHERE lang='{$_M['lang']}' {$search} ORDER BY login_time DESC,register_time DESC";  //mysql语句
		$array = DB::get_all($query);
		$paralist = $this->paraclass->get_para_list(10);
		foreach($array as $key => $val){
			switch($val['source']){
				case 'weixin': $val['source'] = '微信登录'; break;
				case 'weibo': $val['source']  = '微博登录'; break;
				case 'qq': $val['source']     = 'QQ登录'; break;
				default:$val['source']     = '注册'; break;
			}
			if(!$val['login_time'])$val['login_time'] = $val['register_time'];
			$list = array();
			$list[] = $val['username'];
			$list[] = $user_group[$val['groupid']];
			$list[] = date('Y-m-d H:i:s',$val['register_time']);
			$list[] = date('Y-m-d H:i:s',$val['login_time']);
			$list[] = $val['login_count'];
			$list[] = $val['valid']?'已激活':'未激活';
			$list[] = $val['source'];
			$list[] = $val['email'];
			$list[] = $val['tel'];
			if($paralist){
				$para = $this->paraclass->get_para($val['id'],10);
				foreach($paralist as $vals){
					$list[] = $para['info_'.$vals['id']];
				}
			}
			$rarray[] = $list;
		}
		
		$filename = "USER_".date('Y-m-d',time())."_ACCLOG";
		$head = array ('用户名','会员组','注册时间','最后活跃','登录次数','是否激活','来源','绑定邮箱','绑定手机');
		if($paralist){
			foreach($paralist as $val){
				$head[] = $val['name'];
			}
		}
		
		$csv = load::sys_class('csv','new');
		$csv->get_csv($filename, $rarray, $head);
		
	}
	
}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>