<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.

defined('IN_MET') or exit('No permission');

load::sys_class('admin');
load::sys_func('array');

class authcode extends admin {

	function __construct() {
		parent::__construct();
	}

	public function doindex() {
		global $_M;
		$auth = load::mod_class('system/class/auth', 'new');
		if ($auth->have_auth()) {
			$info = $auth->authinfo();
		}
		$_M['url']['help_tutorials_url']="https://www.metinfo.cn/?langset={$_M['langset']}&helpid=";
		$_M['url']['help_tutorials_helpid']='faq/shownews1535.htm';
		require $this->template('own/authcode');
	}

	public function doauth() {
		global $_M;
		$auth = load::mod_class('system/class/auth', 'new');
		if($auth->dl_auth($_M['form']['authpass'], $_M['form']['authcode'])){
			turnover("{$_M['url']['own_form']}a=doindex");
		} else {
			turnover("{$_M['url']['own_form']}a=doindex", $_M['word']['authTip2']);
		}

	}
}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>