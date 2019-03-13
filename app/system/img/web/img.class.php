<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.

defined('IN_MET') or exit('No permission');

load::mod_class('news/web/news');

class img extends news {

	public function __construct() {
		global $_M;
		parent::__construct();
	}

	public function doimg() {
		global $_M;
		if($this->listpage('img') == 'list'){
			require_once $this->template('tem/img');
		}else{
			$this->doshowimg();
		}
  }

	public function doshowimg(){
		global $_M;
		$this->showpage('img');
		require_once $this->template('tem/showimg');
	}

}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>
