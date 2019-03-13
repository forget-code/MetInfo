<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.

defined('IN_MET') or exit('No permission');

load::sys_class('admin');

class tempservice extends admin {
	public $iniclass;
	function __construct() {
		global $_M;
		parent::__construct();
		nav::set_nav(1, $_M['word']['sys_select'], "{$_M['url']['own_name']}c=appstore&a=doindex");
		nav::set_nav(2, $_M['word']['should_used'], "{$_M['url']['own_name']}c=appstore&a=doappstore");
		nav::set_nav(3, $_M['word']['sys_template'], "{$_M['url']['own_name']}c=appstore&a=dotem_market");
		nav::set_nav(4, "$_M['word']['appstore_service_v6']","{$_M['url']['own_name']}c=appstore&a=doservice");
	}

	function doindex() {
		global $_M;
		nav::select_nav(4);
		require $this->template('own/tempservice');
	}

	function doappservice() {
		global $_M;
		nav::select_nav(4);
		require $this->template('own/appservice');
	}

}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>