<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');

load::sys_class('web');

/**
 * 
 */
class common extends web {
	/**
	  * 初始化
	  */
	public function __construct() {
		global $_M;
		parent::__construct();

	}
	
    /**
     * 生成32位“12时间数字+随机18位数字”的纯数字字符串
     * return 所生成的数字字符串
     */
    public static function get_num_str() {
        global $_M;
        $time = date("YmdHms",time());          //生成14为时间数字字符串
        for($i=0; $i<18;$i++) {                 //循环生成18位随机数字字符串
            $str .= mt_rand(0,9);
        }
        $num_str = $time.$str;
        return $num_str;
    }

}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>