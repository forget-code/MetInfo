<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.

defined('IN_MET') or exit('No permission');

load::sys_class('admin.class.php');
load::sys_func('file');

class metui_tools extends admin {
    public $table;

	function __construct() {
		global $_M;
		parent::__construct();
        $this->metui_dir = PATH_WEB . 'app/style/';
        $this->ui_dir = PATH_WEB . 'templates/ui/';
    }

    public function doTransformUI()
    {
        global $_M;
        $redata     = array();
        $block_name = $_M['form']['block'];
        $ui_name    = $_M['form']['ui_name'];
        $pid        = $_M['form']['pid'];

        if ($block_name && $ui_name && is_numeric(intval($pid))) {
            $met_ui_path = $this->metui_dir.$block_name.'/'.$pid;
            if (!is_dir($met_ui_path)) {
                makedir($met_ui_path);
            }
            $res1 = self::TransformInstall($block_name, $ui_name, $pid);
            $res2 = self::TransformCss($block_name, $ui_name, $pid);
            $res3 = self::TransformJs($block_name, $ui_name, $pid);
            $res4 = self::TransformTemplate($block_name, $ui_name, $pid);
            $res5 = self::copyUIFile($block_name, $ui_name, $pid);

            if ($res1 && $res2 && $res3 && $res4 && $res5) {
                $redata['status'] = 1;
                $redata['msg'] = "{$block_name}_{$ui_name}_{$pid} {$_M['word']['successful_conversion']}";
                $this->ajaxReturn($redata);
            }else{
                $redata['status'] = 0;
                $redata['msg'] = $this->error;
                $this->ajaxReturn($redata);
            }

        }else{
            if (!$ui_name) {
                $this->error[] = 'no ui_name';
            }
            if (!$block_name) {
                $this->error[] = 'no block_name';
            }
            if ($pid) {
                $this->error[] = 'no pid';
            }

            $redata['status'] = 0;
            $redata['msg'] = $this->error;
            $this->ajaxReturn($redata);
            return;
        }
    }

    /**
     * 转换安装文件
     * @param string $block_name
     * @param string $ui_name
     * @param string $pid
     * @return bool
     */
    private function TransformInstall($block_name = '', $ui_name = '', $pid = '')
    {
        $ui_install_file = $this->ui_dir . "{$block_name}/{$ui_name}/install.json";
        if (!file_exists($ui_install_file)) {
            $this->error[] = 'ui file is not exists';
            return false;
        }

        $ui_install = json_decode(file_get_contents($ui_install_file), true);
        if (!is_array($ui_install)) {
            $this->error[] = 'ui install data error';
            return false;
        }

        #$style_op = load::mod_class('style/style_op', 'new');
        #$style_op->insertMetui();
        #$style_op->insertMetuiConfig();

        $ui_info = array();
        $ui_info['pid'] = $pid;
        $ui_info['block_name'] = $ui_install['ui']['parent_name'];
        $ui_info['ui_title'] = $ui_install['ui']['ui_title'];
        $ui_info['ui_description'] = $ui_install['ui']['ui_description'];
        $ui_info['ui_order'] = $ui_install['ui']['ui_order'];

        $ui_config = array();
        foreach ($ui_install['config'] as $config) {
            $arr = array();
            $arr['pid'] = $pid;
            $arr['block_name'] = $config['parent_name'];
            $arr['uip_type'] = $config['uip_type'];
            $arr['uip_select'] = $config['uip_select'];
            $arr['uip_name'] = $config['uip_name'];
            $arr['uip_key'] = $config['uip_key'];
            $arr['uip_value'] = $config['uip_value'];
            $arr['uip_default'] = $config['uip_default'];
            $arr['uip_title'] = $config['uip_title'];
            $arr['uip_description'] = $config['uip_description'];
            $arr['uip_order'] = $config['uip_order'];
            $arr['uip_hidden'] = $config['uip_hidden'];
            $ui_config[] = $arr;
        }

        $met_ui = array();
        $met_ui['ui'] = $ui_info;
        $met_ui['config'] = $ui_config;
        $install_json = json_encode($met_ui, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        $met_ui_install_file = $this->metui_dir . "{$block_name}/{$pid}/install.json";
        #die($met_ui_install_file);
        file_put_contents($met_ui_install_file, $install_json);

        if (file_exists($met_ui_install_file)) {
            return true;
        } else {
            $this->error[] = "metUI install_json creation failure";
            return false;
        }

    }

    /**
     * 转换UI css
     * @param string $block_name
     * @param string $ui_name
     * @param string $pid
     * @return bool
     */
    private function TransformCss($block_name = '', $ui_name = '', $pid = '')
    {
        $ui_css_file = $this->ui_dir . "{$block_name}/{$ui_name}/index.css";
        if (!file_exists($ui_css_file)) {
            $this->error[] = 'ui css file is not exists';
            return false;
        }

        $ui_css = file_get_contents($ui_css_file);
        if (!$ui_css) {
            $this->error[] = 'ui css data error';
            return false;
        }

        $metui_css = str_replace('$uicss', '$met_uicss', $ui_css);
        $met_ui_css_file = $this->metui_dir . "{$block_name}/{$pid}/index.css";
        ##die($met_ui_css_file);
        file_put_contents($met_ui_css_file, $metui_css);

        if (file_exists($met_ui_css_file)) {
            return true;
        } else {
            $this->error[] = "metUI css creation failure";
            return false;
        }
    }

    /**
     * 转化UI js
     * @param string $block_name
     * @param string $ui_name
     * @param string $pid
     * @return bool
     */
    private function TransformJs($block_name = '', $ui_name = '', $pid = '')
    {
        $ui_js_file = $this->ui_dir . "{$block_name}/{$ui_name}/index.js";
        if (!file_exists($ui_js_file)) {
            $this->error[] = 'ui js file is not exists';
            return false;
        }

        $ui_js = file_get_contents($ui_js_file);
        /*if (!$ui_js) {
            $this->error[] = 'ui js data error';
            return false;
        }*/

        $metui_css = str_replace('$uicss', '$met_uicss', $ui_js);
        $met_ui_js_file = $this->metui_dir . "{$block_name}/{$pid}/index.js";
        ##die($met_ui_js_file);
        file_put_contents($met_ui_js_file, $metui_css);

        if (file_exists($met_ui_js_file)) {
            return true;
        } else {
            $this->error[] = "metUI js creation failure";
            return false;
        }
    }

    /**
     *
     * @param string $block_name
     * @param string $ui_name
     * @param string $pid
     * @return bool
     */
    private function TransformTemplate($block_name = '', $ui_name = '', $pid = '')
    {
        $ui_template_file = $this->ui_dir . "{$block_name}/{$ui_name}/index.php";
        if (!file_exists($ui_template_file)) {
            $this->error[] = 'ui js file is not exists';
            return false;
        }

        $ui_template_file = file_get_contents($ui_template_file);
        if (!$ui_template_file) {
            $this->error[] = 'ui js data error';
            return false;
        }

        $metui_template = str_replace('$ui', '$met_ui', $ui_template_file);
        $met_ui_template_file = $this->metui_dir . "{$block_name}/{$pid}/index.php";
        ##die($met_ui_js_file);
        file_put_contents($met_ui_template_file, $metui_template);

        if (file_exists($met_ui_template_file)) {
            return true;
        } else {
            $this->error[] = "metUI template creation failure";
            return false;
        }
    }

    private function copyUIFile($block_name = '', $ui_name = '', $pid = '')
    {
        $ui_config = $this->ui_dir . "{$block_name}/{$ui_name}/config.json";
        if (!file_exists($ui_config)) {
            $this->error[] = 'ui config file is not exists';
            return false;
        }

        $met_ui_config = $this->metui_dir . "{$block_name}/{$pid}/config.json";
        copyfile($ui_config, $met_ui_config);

        if (file_exists($met_ui_config)) {
            return true;
        } else {
            $this->error[] = "metUI UIconfig creation failure";
            return false;
        }
    }
}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>