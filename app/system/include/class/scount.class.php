<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');

class scount {
	
	public function check($c){
		$sc = $this->get();
		$this->add();
		if($sc > $c){
			return true;
		}else{
			return false;
		}
	}
	
	public function add(){
		$this->set($this->get()+1);
	}
	
	public function clear(){
		$this->set(0);
	}
	
	public function get(){
		return load::sys_class('session', 'new')->get('scount');
	}
	
	public function set($c){
		load::sys_class('session', 'new')->set('scount', $c);
	}
}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>