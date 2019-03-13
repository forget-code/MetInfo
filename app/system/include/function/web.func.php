<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');



/**
 * 获取当前会员信息；
 * @return array  $user 返回记录当前会员信息的数组
 */
function member_information(){
	global $_M;
	met_cooike_start();
	$met_admin_table = $_M['table']['admin_table'];
	$met_column = $_M['table']['column'];
	$metinfo_member_name = get_met_cookie('metinfo_admin_name');
	if(!$metinfo_member_name){
		$metinfo_member_name = get_met_cookie('metinfo_member_name');
	}
	$query = "SELECT * FROM {$_M['table']['admin_table']} WHERE admin_id = '{$metinfo_member_name}'";
	$user = DB::get_one($query);
	$query = "SELECT id,name FROM {$_M['table']['column']} WHERE access <= '{$user['usertype']}' AND lang = '{$_M['lang']}'";
	$column = DB::get_all($query);
	$user['column'] = $column;
	return $user;
}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>