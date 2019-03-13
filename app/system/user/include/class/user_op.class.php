<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.

defined('IN_MET') or exit('No permission');
load::sys_func('file');
/**
 * 会员接口类
 */

class user_op {
    /**
     * 初始化
     */
    public function __construct() {
        global $_M;
        $this->lang = $_M['lang'];
    }

    /**
     * 用户信息
     * @param $uid
     * @return mixed
     */
    public function get_user_info($uid){
        global $_M;
        $sysuer = load::sys_class('user','new');
        $userinfo = $sysuer->get_user_by_id($uid);
        return $userinfo;
    }

    /**
     * 更改用户组
     * @param $uid
     * @param $group
     * @return mixed
     */
    public function modity_group($uid, $group){
        global $_M;
        $sysuer = load::sys_class('user','new');
        $usre_group = $sysuer->editor_uesr_gorup($uid,$group);
        return $usre_group;
    }


}

# This program is an open source system, commercial use, please consciously to purchase commercial license.; # Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>
