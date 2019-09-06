<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.

defined('IN_MET') or exit('No permission');

load::mod_class('base/base_database');

/**
 * 系统标签类
 */

class style_database extends base_database {
    public $error;

	public function __construct()
    {
    	global $_M;
    }

    /**
     * 获取UI信息
     * @param string $block
     * @param string $pid
     * @return array
     */
    public function getMetuiInfo($block = '', $pid = '')
    {
        global $_M;
        $query = "SELECT * FROM {$_M['table']['style_list']} WHERE block_name = '{$block}' AND pid = '{$pid}' AND lang = '{$_M['lang']}'";
        $metui_info = DB::get_one($query);
        return $metui_info;
    }

    /**
     * 获取UI配置
     * @param string $block
     * @param string $pid
     * @return array
     */
    public function getMetuiConfig($block = '', $pid = '')
    {
        global $_M;
        $query = "SELECT * FROM {$_M['table']['style_config']} WHERE block_name = '{$block}' AND pid = '{$pid}' AND lang = '{$_M['lang']}'";
        $metui_info = DB::get_all($query);
        return $metui_info;
    }

    /**
     * 插入ui信息
     * @param array $metui_info
     * @return bool
     */
    public function insertMetui($metui_info = array())
    {
        global $_M;
        $res = DB::insert($_M['table']['style_list'],$metui_info);
        if ($res) {
            return true;
        }else{
            $this->error[] = DB::error();
            return false;
        }
    }

    /**
     * 插入ui配置
     * @param array $metui_config
     * @return bool
     */
    public function insertMetuiConfig($metui_config = array())
    {
        global $_M;
        foreach ($metui_config as $config) {
            $res = DB::insert($_M['table']['style_config'],$config);
            if (!$res) {
                $this->error[] = DB::error();
                continue;
            }
        }
        if (!$this->error) {
            return true;
        }else{
            return false;
        }
    }



}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>
