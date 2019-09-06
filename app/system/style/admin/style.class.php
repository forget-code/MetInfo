<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.

defined('IN_MET') or exit('No permission');

load::sys_class('admin.class.php');
load::sys_func('file');

class style extends admin {
    public $table;

	function __construct() {
		global $_M;
		parent::__construct();
        $this->metui_dir = PATH_WEB . 'app/style';
        $this->style_list_table = $_M['table']['style_list'];
        $this->style_config_table = $_M['table']['style_config'];
        $this->database = load::mod_class('style/style_database', 'new');

    }

    /**
     * 获取集成UI列表
     */
	function doGetMetuiList() {
		global $_M;
        $block = $_M['form']['mname'];
        $redata = array();

        $met_ui_list = $this->getMetuiList($block);
        $list = array();
        foreach ($met_ui_list as $met_ui) {
            switch ($met_ui['block_name']) {
                case 'banner':
                    $list['banner'][] = $met_ui;
                    break;
                case 'head_nav':
                    $list['head_nav'][] = $met_ui;
                    break;
                case 'online':
                    $list['online'][] = $met_ui;
                    break;
                case 'product_list_page':
                    $list['product_list_page'][] = $met_ui;
                    break;
                case 'news_list_page':
                    $list['news_list_page'][] = $met_ui;
                    break;
                case 'mobile_menu':
                    $list['mobile_menu'][] = $met_ui;
                    break;
                case 'page_list':
                    $list['page_list'][] = $met_ui;
                    break;
            }
        }

        $redata['data'] = $list;
        $redata['status'] = 1;
        $this->ajaxReturn($redata);
	}

    /**
     * 保存配置
     */
    public function doSaveUilist()
    {
        global $_M;
        $redata = array();
        $block = $_M['form']['mname'];
        $pid = $_M['form']['pid'];
        $this->saveMetuiList($block, $pid);

        $redata['status'] = 1;
        $redata['msg'] = $_M['word']['jsok'];
        $this->ajaxReturn($redata);
    }


    /**
     * 获取集成UI列表
     * @return array
     */
    public function getMetuiList($block = '')
    {
        global $_M;
        $query = "SELECT * FROM {$this->style_list_table} WHERE block_name = '{$block}' AND lang = '{$_M['lang']}' ORDER BY ui_order";
        $list = DB::get_all($query);
        return $list;
    }

    /**
     * 保存集成UI配置
     * @param $data
     */
    public function saveMetuiList($block = '', $pid = '')
    {
        global $_M;
        if ($block) {
            $query = "UPDATE {$this->style_list_table} SET effect = 0 WHERE block_name = '{$block}' AND lang = '{$_M['lang']}'";
            DB::query($query);

            if ($pid) {
                $query = "UPDATE {$this->style_list_table} SET effect = 1 WHERE block_name = '{$block}' AND pid = '{$pid}' AND lang = '{$_M['lang']}'";
                DB::query($query);
            }
        }
        return true;
    }

    /**
     * 初始化系统UI配置
     */
    public function doInitialize()
    {
        global $_M;
        $style_op = load::mod_class("style/style_op", 'new');
        $style_op->initializeMetUI();
        $this->success(array('Initialize success'));
    }

}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>