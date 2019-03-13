<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.

defined('IN_MET') or exit('No permission');

load::sys_class('web');

class index extends web {
	public function __construct() {
		global $_M;
		parent::__construct();
	}

  public function doindex(){
		global $_M;
		$this->add_input('class1', 10001);
		$this->add_input('classnow', 10001);
		$title = $_M['config']['met_hometitle'] ? $_M['config']['met_hometitle'] : $_M['config']['met_webname'].'-'.$_M['config']['met_keywords'];
		$this->seo();
		$this->seo_title($title);
		//$s = load::sys_class('label', 'new')->get('seo')->html404();
		//get_search_opotion_html
		//dump($s);
		require_once $this->template('tem/index');
  }
}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>
