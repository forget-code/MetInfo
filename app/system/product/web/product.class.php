<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.

defined('IN_MET') or exit('No permission');

load::mod_class('news/web/news');

class product extends news {
	public function __construct() {
		global $_M;
		parent::__construct();
	}

  public function doproduct() {
		global $_M;
		if($this->listpage('product') == 'list'){

			require_once $this->template('tem/product');
		}else{
			$this->doshowproduct();
		}
  }

	public function doshowproduct(){
		global $_M;
		$this->showpage('product');
        $shop_plugin_file = PATH_ALL_APP.'shop/plugin/plugin_shop.class.php';
		if($_M['config']['shopv2_open']  && file_exists($shop_plugin_file)){
			load::plugin('doproduct_show',0,$this->input);
		}else{
			require_once $this->template('tem/showproduct');
		}
	}
}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>
