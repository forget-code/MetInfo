<!--<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');

if($product_detail){
require $this->template('tem/product_detail');
}

if($product){
require $this->template('tem/product');
}

if($img_detail){
require $this->template('tem/img_detail');
}

if($img){
require $this->template('tem/img');
}

if($module != 'product' && $module != 'img'){
	if(!$detail){
		require $this->template('tem/other_list');
	}else{
		echo "--><dl class='noset'>{$_M[word][uisetTips3]}</dl>";
	}
}


# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>