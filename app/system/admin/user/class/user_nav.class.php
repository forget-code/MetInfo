<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');

class user_nav {	
	public function nav(){
		global $_M;//�ǵ�global $_M
		parent::__construct();//�����д�˳�ʼ������,һ��Ҫ���ø���ĳ�ʼ��������
		nav::set_nav(1, "ѡ�1", $_M['url']['own_form'].'a=admin_user');
		nav::set_nav(2, "ѡ�2", $_M['url']['own_form'].'a=admin_user');
		nav::set_nav(3, "ѡ�3", $_M['url']['own_form'].'a=admin_user');
	}
}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>