<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');

//记录支付接口参数
function pay_config_save($name,$value) {
    global $_M;
    $query  = "INSERT INTO {$_M['table']['config']} SET name='{$name}',value='{$value}',mobile_value='',columnid='0',flashid='0',lang='metinfo'";
    $result = DB::query($query);
}

//查询支付接口参数
function pay_config_query($name) {
    global $_M;
    $query  = "SELECT * FROM {$_M['table']['config']} where name='{$name}' AND lang='metinfo'";
    $result = DB::get_one($query);
    return $result;
}

//修改支付接口参数
function pay_config_modify($name,$value) {
    global $_M;
    $query  = "UPDATE {$_M['table']['config']} SET value='{$value}' where name='{$name}' AND lang='metinfo'";
    $result = DB::query($query);
}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>