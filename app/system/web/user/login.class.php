<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');

load::mod_class('user/class/userweb');

class login extends userweb {

	public function __construct() {
		global $_M;
		parent::__construct();
		if($_M['form']['gourl']){
			$_M['url']['profile'] = $_M['form']['gourl'];
			if(strpos($_M['url']['login'], 'lang=')){
				$_M['url']['login'] .= "&gourl={$_M['form']['gourl']}";
			}else{
				$_M['url']['login'] .= "?gourl={$_M['form']['gourl']}";
			}
		}
	}	
	
	protected function check() {
		
	}
	public function doindex() {
		global $_M;
		$session = load::sys_class('session', 'new');
		if($session->get("logineorrorlength")>3)$code=1;
		require_once $this->template('tem/login');
	}
	
	public function dologin() {
		global $_M;
		$this->login($_M['form']['username'], $_M['form']['password'],'');
	}
	
	public function login($username, $password, $type = 'pass') {
		global $_M;
		$session = load::sys_class('session', 'new');
		if($session->get("logineorrorlength")>3){
			if(!load::sys_class('pin', 'new')->check_pin($_M['form']['code'])){
				okinfo($_M['url']['profile'], $_M['word']['membercode']);
			}
		}
		$user = $this->userclass->login_by_password($username,  $password, $type);
		if($user){
			$session->del('logineorrorlength');
			$this->userclass->set_login_record($user);
			okinfo($_M['url']['profile']);
		}else{
			$length = $session->get("logineorrorlength");
			$length ++;
			$session->set("logineorrorlength",$length);
			okinfo($_M['url']['login'], $_M['word']['membererror1']);
		}
	}
	
	public function dologout() {
		global $_M;
		$this->userclass->logout();
		okinfo($_M['url']['login']);
	}
	
	public function doother() {
		global $_M;
		$other = $this->other($_M['form']['type']);
		$other->set_state();
		$url = $other->get_login_url();		
		okinfo($url);
	}
	
	public function doother_login() {
		global $_M;
		$type = $_M['form']['amp;type'] ? $_M['form']['amp;type'] : $_M['form']['type'];
		$other = $this->other($type);
		$user = $other->get_user($_M['form']['code']);
		
		if(!$other->state_ok($_M['form']['state'])){
			okinfo($_M['url']['login'], $_M['word']['membererror2']);
		}
		if($user){
			if($user['register'] == 'no'){
				okinfo($_M['url']['login_other_register'].'&other_id='.$user['other_id'].'&type='.$user['other_type']);
			}
		}else{
			okinfo($_M['url']['login'], $other->errorno);
		}
		if($user){
			$this->login($user['username'], md5($user['password']), 'md5');
		}else{
			okinfo($_M['url']['login'], $_M['word']['membererror3']);
		}
	}
	
	public function dologin_other_register() {
		global $_M;
		$other = $this->other($_M['form']['type']);
		$met_id = $other->register($_M['form']['other_id'], $_M['form']['username']);
		if($met_id){
			$user = $this->userclass->get_user_by_id($met_id);
			$this->login($user['username'], md5($user['password']), 'md5');
		}else{
			if($other->errorno == 're_username'){
				okinfo($_M['url']['login_other_info']."&other_id={$_M['form']['other_id']}&type={$_M['form']['type']}");
			}else{
				okinfo($_M['url']['login'], $other->errorno);
			}
		}
	}
	
	public function other($type) {
		global $_M;
		if(!$type){
			okinfo($_M['url']['login'], $_M['word']['membererror4']);
		}
		if($type == 'qq'){
			$other = load::mod_class('user/class/qq', 'new');
		}
		if($type == 'weibo'){
			$other = load::mod_class('user/class/weibo', 'new');
		}
		if($type == 'weixin'){
			$other = load::mod_class('user/class/weixin', 'new');
		}
		return $other;
	}
	
	public function dologin_other_info(){
		global $_M;
		require_once $this->template('tem/other_info');
	}
}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>