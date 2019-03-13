<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/6
 * Time: 10:34
 */
defined('IN_MET') or exit('No permission');

load::sys_class('admin.class.php');
load::sys_class('nav.class.php');
load::sys_class('curl');

class imgmanager extends admin {
    function __construct() {
        global $_M;
        parent::__construct();
        nav::set_nav(1,$_M[word][modimgurls], $_M['url']['own_form'].'a=doindex');
        nav::set_nav(2, $_M[word][upfiletips19], $_M['url']['own_form'].'a=dowatermark');
    }
//缩略图thum
    function doindex()
    {
        global $_M;
        nav::select_nav(1);
        $_M['url']['help_tutorials_helpid']='105';
        require $this->template('tem/thumbs');
    }

    function dosave_thumbs()
    {
        global $_M;
        $_M['form']['met_autothumb_ok'] = $_POST['met_autothumb_ok'] ? 1 : 0;
        $configlist = array();
        $configlist[] = 'met_autothumb_ok';
        $configlist[] = 'met_thumb_kind';
        $configlist[] = 'met_productimg_x';
        $configlist[] = 'met_productimg_y';
        $configlist[] = 'met_imgs_x';
        $configlist[] = 'met_imgs_y';
        $configlist[] = 'met_newsimg_x';
        $configlist[] = 'met_newsimg_y';
        configsave($configlist);/*保存系统配置*/

        turnover("{$_M[url][own_form]}a=doindex");
    }

    //水印
    function dowatermark ()
    {
        global $_M;
        nav::select_nav(2);
        $_M['url']['help_tutorials_helpid']='106';
        require $this->template('tem/watermark');
    }

    function dosave_watermark()
    {
        global $_M;
        $_M['form']['met_big_wate'] = $_POST['met_big_wate'] ? 1 : 0;
        $_M['form']['met_thumb_wate'] = $_POST['met_thumb_wate'] ? 1 : 0;
        $configlist = array();
        $configlist[] = 'met_wate_class';
        $configlist[] = 'met_big_wate';
        $configlist[] = 'met_thumb_wate';
        $configlist[] = 'met_watermark';
        $configlist[] = 'met_text_wate';
        $configlist[] = 'met_text_size';
        $configlist[] = 'met_text_bigsize';
        $configlist[] = 'met_text_fonts';
        $configlist[] = 'met_text_angle';
        $configlist[] = 'met_text_color';
        $configlist[] = 'met_wate_img';
        $configlist[] = 'met_wate_bigimg';
        configsave($configlist);/*保存系统配置*/

        turnover("{$_M[url][own_form]}a=dowatermark");
    }


}