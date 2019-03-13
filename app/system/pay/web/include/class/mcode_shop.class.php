<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');
define ('FIND_CODE_KEY', '1557b29f41a401af397d96670fcdf3e5');
class mcode_shop {
	public $key;
	public $validity;
	public function __construct($key = FIND_CODE_KEY, $validity = 600) {
		$this->key = $key;
		$this->validity = $validity;
	}
	public function de_code($code) {
		if($code=='')return false;
		$code = str_replace(' ', '+', urldecode($code));
		list($true_code, $time, $str, $is_array_flag) = explode('$M$', $code);
		$c1 = substr($true_code, 0, 7);
		$c2 = substr($true_code, 9, 2);
		$c3 = substr($true_code, 13, 11);
		$c4 = substr($true_code, 26, 5);
		$c5 = substr($true_code, 33, 7);		
		$true_code = $c1.$c2.$c3.$c4.$c5;
		if(md5($str.$this->key.$time) == $true_code && time() - $time < $this->validity){
			if($is_array_flag == 1){
				return jsondecode(base64_decode($str));
			}else{
				return base64_decode($str);
			}
		}else{
			return false;
		}
	}
	
	public function en_code($str){
		$time = time();
		if(is_array($str)){
			$str = base64_encode(jsonencode($str));
			$is_array_flag = 1;
		}else{
			$str = base64_encode($str);
			$is_array_flag = 0;
		}
		$true_code = md5($str.$this->key.$time);
		$r1 = random(2, 5);
		$r2 = random(2, 5);
		$r3 = random(2, 5);
		$r4 = random(2, 5);
		
		$c1 = substr($true_code, 0, 7);
		$c2 = substr($true_code, 7, 2);
		$c3 = substr($true_code, 9, 11);
		$c4 = substr($true_code, 20, 5);
		$c5 = substr($true_code, 25, 9);	
		$re_code = "{$c1}{$r1}{$c2}{$r2}{$c3}{$r3}{$c4}{$r4}{$c5}".'$M$'."{$time}".'$M$'."{$str}".'$M$'.$is_array_flag;
		return urlencode($re_code);
	}
}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>