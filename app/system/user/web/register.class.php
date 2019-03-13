<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.

defined('IN_MET') or exit('No permission');

load::mod_class('user/web/class/userweb');

class register extends userweb {

	public $paralist;
	public $paraclass;

	public function __construct() {
		global $_M;
		parent::__construct();
		isset($_SESSION) ? "" : load::sys_class('session', 'new');
		if(!$_M['config']['met_member_register']){
			okinfo($_M['url']['login'], $_M['word']['regclose']);
		}
		$this->paraclass = load::sys_class('para', 'new');
		$paralist  = $this->paraclass->get_para_list(10);
		foreach($paralist as $val){
			if($val['wr_oks'])$paralists[] = $val;
		}
		$this->paralist  = $paralists;
		$_M['paralist']=$this->paralist;
		$_M['paraclass']=$this->paraclass;
	}

	public function check(){

	}

	public function doindex() {
		global $_M;
        if($_M['user']['id'])
        {
            okinfo($_M['url']['user_home']);
        }

		require_once $this->view('app/register',$this->input);
	}

	public function dosave() {
		global $_M;
        $info = $this->paraclass->form_para($_M['form'],10);
        switch($_M['config']['met_member_vecan']){
			case 1:
                $pinok = load::sys_class('pin', 'new')->check_pin($_M['form']['code']);
                if(!$pinok && $_M['config']['met_memberlogin_code'] ){
                    okinfo(-1, $_M['word']['membercode']);
				}
				if($this->userclass->register($_M['form']['username'], $_M['form']['password'], $_M['form']['username'],'',$info, 0)){
					$valid = load::mod_class('user/web/class/valid','new');
					if ($valid->get_email($_M['form']['username'])) {
						$this->userclass->login_by_password($_M['form']['username'],  $_M['form']['password']);
						okinfo($_M['url']['profile'], $_M['word']['js25']);
					} else {
						okinfo($_M['url']['login'], $_M['word']['emailfail']);
					}
				}else{
					okinfo(-1, $_M['word']['regfail']);
				}
			break;
			case 3:
				$session = load::sys_class('session', 'new');
				if($_M['form']['phonecode']!=$session->get("phonecode")){
					okinfo(-1, $_M['word']['phonecodeerror']);
				}
				if(time()>$session->get("phonetime")){
					okinfo(-1, $_M['word']['codetimeout']);
				}

				$_M['form']['username'] = $_M['form']['phone'];
				if($_M['form']['username']!=$session->get("phonetel")){
					okinfo(-1, $_M['word']['telcheckfail']);
				}
				$session->del('phonecode');
				$session->del('phonetime');
				$session->del('phonetel');

				if($this->userclass->register($_M['form']['username'], $_M['form']['password'], '',$_M['form']['username'],$info, 1)){
                    $this->userclass->login_by_password($_M['form']['username'],  $_M['form']['password']);
					okinfo($_M['url']['profile'], $_M['word']['regsuc']);
				}else{
					okinfo(-1, $_M['word']['regfail']);
				}
			break;
			default :
				if(!load::sys_class('pin', 'new')->check_pin($_M['form']['code']) && $_M['config']['met_memberlogin_code']){
					okinfo(-1, $_M['word']['membercode']);
				}
				$valid = $_M['config']['met_member_vecan'] == 2?0:1;
				$turnovertext=$_M['config']['met_member_vecan'] == 2?$_M['word']['js25']:$_M['word']['regsuc'];
				if($this->userclass->register($_M['form']['username'], $_M['form']['password'], '','',$info, $valid)){
					$this->userclass->login_by_password($_M['form']['username'],  $_M['form']['password']);
					okinfo($_M['url']['profile'], $turnovertext);
				}else{
					okinfo(-1, $_M['word']['regfail']);
				}
			break;
		}
	}

	public function doemailvild() {
		global $_M;
		$auth = load::sys_class('auth', 'new');
		$username = $auth->decode($_M['form']['p']);
		if($username){
			if($this->userclass->get_user_valid($username)){
				okinfo($_M['url']['login'], $_M['word']['activesuc']);
			}else{
				okinfo($_M['url']['register'], $_M['word']['emailvildtips1']);
			}
		}else{
			okinfo($_M['url']['register'], $_M['word']['emailvildtips2']);
		}
	}

	public function douserok() {
		global $_M;
		$valid = true;
		if($this->userclass->get_user_by_username_sql($_M['form']['username'])||$this->userclass->get_admin_by_username_sql($_M['form']['username'])){
			$valid = false;
		}
		echo json_encode(array(
			'valid' => $valid
		));
	}

	public function dophonecode() {
		global $_M;
		if($this->userclass->get_user_by_username_sql($_M['form']['phone'])||$this->userclass->get_admin_by_username_sql($_M['form']['phone'])){
			echo $_M['word']['telreg'];
			die;
		}

		$valid = load::mod_class('user/web/class/valid','new');
		if ($valid->get_tel($_M['form']['phone'])) {
			echo 'SUCCESS';
		} else {
			echo $_M['word']['Sendfrequent'];
		}

	}

}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>