<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.

defined('IN_MET') or exit('No permission');

load::mod_class('news/web/news');

class download extends news {
	public function __construct() {
		global $_M;
		parent::__construct();
	}

	public function dodownload() {
		global $_M;
		if($this->listpage('download') == 'list'){
			require_once $this->template('tem/download');
		}else{
			$this->doshowdownload();
		}
  }

	public function doshowdownload(){
		global $_M;
		$this->showpage('download');
		require_once $this->template('tem/showdownload');
	}
}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>
