<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.

defined('IN_MET') or exit('No permission');
class style_op  {

    public $error;

    private $metui_dir;

    private $block_list;

	public function __construct()
    {
        $this->metui_dir = PATH_WEB . 'app/style/';
        $this->block_list = array(
            'head_nav',
            'banner',
            'online',
            'head_nav',
            'mobile_menu',
            'page_list',
            'page_detail',
            'product_list_page',
            'news_list_page',
        );
    }

    /**
     * 初始化系统UI配置
     */
    public function initializeMetUI($lang = '')
    {
        global $_M;
        if ($lang == '') {
            $lang = $_M['lang'];
        }
        $query = "DELETE FROM {$_M['table']['style_list']} WHERE lang='{$lang}'";
        DB::query($query);
        $query = "DELETE FROM {$_M['table']['style_config']} WHERE lang='{$lang}'";
        DB::query($query);

        foreach ($this->block_list as $key => $block) {
            $ui_block = "$this->metui_dir/{$block}";
            $type_list = scandir($ui_block);
            foreach ($type_list as $k => $type) {
                if ($type != '.' && $type != '..' && is_numeric($type)) {
                    $install_res = self::installMetui($block, $type, $lang);
                }
            }
        }

        $query = "UPDATE {$_M['table']['style_list']} SET `effect` = 0 ";
        DB::query($query);
        $query = "UPDATE {$_M['table']['style_list']} SET `effect` = 1 WHERE pid = 1";
        DB::query($query);
        return true;
    }

    /**
     * 安装集成UI
     * @param string $block
     * @param string $pid\
     */
    public function installMetui($block = '', $pid = '' ,$to_lang = '')
    {
        global $_M;
        $redata = array();
        if ($block && $pid && $to_lang) {
            $install  = $this->metui_dir . "{$block}/{$pid}/install.json";
            if (is_file($install)) {
                $install_data = json_decode(file_get_contents($install), true);
                if (is_array($install_data['ui']) && is_array($install_data['config'])) {
                    $res1 = self::insertMetui($install_data['ui'],$to_lang);
                    $res2 = self::insertMetuiConfig($install_data['config'],$to_lang);
                }
            }
            if (!$this->error) {
                return true;
                $redata['status'] = 1;
                $redata['msg'] = $_M['word']['jsok'];
                return $redata;
            }
        }else{
            return false;
            $redata['status'] = 0;
            $redata['msg'] = 'error';
            $redata['error'] = $this->error;
            return $redata;
        }
    }

    /**
     * 插入ui信息
     * @param array $metui_info
     * @param string $to_lang
     * @return bool
     */
    private function insertMetui($metui_info = array(), $to_lang = '')
    {
        global $_M;
        $query = "SELECT * FROM {$_M['table']['style_list']} WHERE pid='{$metui_info['pid']}' AND block_name='{$metui_info['block_name']}' AND lang='{$to_lang}'";
        $met_ui = DB::get_one($query);
        if (!$met_ui) {
            $sava_data = array();
            $sava_data['pid'] = $metui_info['pid'];
            $sava_data['block_name'] = $metui_info['block_name'];
            $sava_data['ui_title'] = $metui_info['ui_title'];
            $sava_data['ui_description'] = $metui_info['ui_description'];
            $sava_data['ui_order'] = $metui_info['ui_order'];
            $sava_data['effect'] = 0;
            $sava_data['lang'] = $to_lang;
            $res = DB::insert($_M['table']['style_list'],$sava_data);
            if ($res) {
                return true;
            }else{
                $this->error[] = DB::error();
                return false;
            }
        }else{
            return true;
        }
    }

    /**
     * 插入ui配置
     * @param array $metui_config
     * @param string $to_lang
     * @return bool
     */
    private function insertMetuiConfig($metui_config = array(), $to_lang = '')
    {
        global $_M;
        foreach ($metui_config as $config) {
            $query = "SELECT * FROM {$_M['table']['style_config']} WHERE pid='{$config['pid']}' AND block_name='{$config['block_name']}' AND uip_name={$config['uip_name']} AND lang='{$to_lang}'";
            $met_ui_config = DB::get_one($query);
            if ($met_ui_config) {
                $query = "UPDATE {$_M['table']['style_config']} SET 
                  uip_style={$config['uip_style']},
                  uip_select={$config['uip_select']},
                  uip_default={$config['uip_default']},
                  uip_title={$config['uip_title']},
                  uip_description={$config['uip_description']},
                  uip_order'={$config['uip_order']}' WHERE 
                  pid='{$config['pid']}' AND 
                  block_name='{$config['block_name']}' AND 
                  uip_name={$config['uip_name']} AND 
                  lang='{$to_lang}'
                  ";
                $res = DB::query($query);
            }else{
                $sava_data = array();
                $sava_data['pid'] = $config['pid'];
                $sava_data['block_name'] = $config['block_name'];
                $sava_data['uip_type'] = $config['uip_type'];
                $sava_data['uip_style'] = $config['uip_style'];
                $sava_data['uip_select'] = $config['uip_select'];
                $sava_data['uip_name'] = $config['uip_name'];
                $sava_data['uip_key'] = $config['uip_key'];
                $sava_data['uip_value'] = $config['uip_value'];
                $sava_data['uip_default'] = $config['uip_default'];
                $sava_data['uip_title'] = $config['uip_title'];
                $sava_data['uip_description'] = $config['uip_description'];
                $sava_data['uip_order'] = $config['uip_order'];
                $sava_data['uip_hidden'] = $config['uip_hidden'];
                $sava_data['lang'] = $to_lang;
                $res = DB::insert($_M['table']['style_config'],$sava_data);
            }

            if (DB::error()) {
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

    /**************************************/
    /**
     * 生成安装文件
     */
    public function doCreateUiinstall()
    {
        global $_M;
        $redata = array();
        $block = $_M['form']['block'];
        $pid = $_M['form']['pid'];
        $ui_info = self::getMetuiInfo($block, $pid);
        $ui_config = self::getMetuiConfig($block, $pid);
        if (is_array($ui_info) && $ui_config) {
            $install = array();
            $install['ui'] = $ui_info;
            $install['config'] = $ui_config;
            $install_json = json_encode($install,JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
            if ($install_json) {
                $fpath = __DIR__ . "/install_{$block}_{$pid}.json";
                file_put_contents($fpath, $install_json);
                if (file_exists($fpath)) {
                    $redata['status'] = 1;
                    $redata['msg'] = $_M['word']['jsok'];
                    return $redata;
                }
            }
        }
        $redata['status'] = 0;
        $redata['msg'] = 'error';
        $redata['error'] = $_M['word']['dataerror'];
        return $redata;
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
       $metui_info = $this->database->getMetuiInfo($block,$pid);
        if ($metui_info) {
            unset($metui_info['id']);
            unset($metui_info['effect']);
            unset($metui_info['lang']);
            return $metui_info;
        }else{
            return false;
        }
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
        $metui_config = $this->database->getMetuiConfig($block,$pid);
        if ($metui_config) {
            unset($metui_config['id']);
            unset($metui_config['lang']);
            return $metui_config;
        }else{
            return false;
        }
    }


}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>
