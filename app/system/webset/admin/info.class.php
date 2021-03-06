<?php
defined('IN_MET') or exit('No permission');

load::sys_class('admin');
load::sys_class('nav');

/** 基本信息设置 */
class info extends admin
{
    public function __construct()
    {
        global $_M;
        parent::__construct();
    }

    //获取基本信息列表
    public function doGetInfo()
    {
        global $_M;
        $weburl = self::get_weburl();
        $data = array();

        //网站基本信息
        $info = array();
        $info['met_webname']    = isset($_M['config']['met_webname']) ? $_M['config']['met_webname'] : '';
        $info['met_logo']       = isset($_M['config']['met_logo']) ? $_M['config']['met_logo'] : '';
        $info['met_mobile_logo'] = isset($_M['config']['met_mobile_logo']) ? $_M['config']['met_mobile_logo'] : '';
        $info['met_weburl']     = $weburl;
        $info['met_keywords']   = isset($_M['config']['met_keywords']) ? $_M['config']['met_keywords'] : '';
        $info['met_description'] = isset($_M['config']['met_description']) ? $_M['config']['met_description'] : '';
        $info['data_key']       = isset($_M['config']['met_webkeys']) ? md5(md5(substr($_M['config']['met_webkeys'], 0, 8))) : '';

        //底部信息
        $info['met_footright']   = isset($_M['config']['met_footright']) ? $_M['config']['met_footright'] : '';
        $info['met_footaddress'] = isset($_M['config']['met_footaddress']) ? $_M['config']['met_footaddress'] : '';
        $info['met_foottel']     = isset($_M['config']['met_foottel']) ? $_M['config']['met_foottel'] : '';
        $info['met_footother']   = isset($_M['config']['met_footother']) ? $_M['config']['met_footother'] : '';

        $data['info'] = $info;

        $adrry = admin_information();
        $email = $adrry['admin_email'];
        $tel = $adrry['admin_mobile'];
        $data['record'] = "http://api.metinfo.cn/record_install.php?url={$_M['config']['met_weburl']}&email={$email}&webname={$_M['config']['met_webname']}&webkeywords={$_M['config']['met_keywords']}&tel={$tel}&version={$_M['config']['metcms_v']}&softtype=1";

        $data['weburltext'] = $_M['word']['upfiletips10'].$_M['url']['site'];
        if($_M['langlist']['web'][$_M['lang']]['link']){
            $data['met_weburl'] = $_M['langlist']['web'][$_M['lang']]['link'];
            $data['disabled'] = 'disabled';
            $data['weburltext'] = "{$_M['word']['unitytxt_8']}";
        }

        $data['data_key'] = md5(md5(substr($_M['config']['met_webkeys'],0,8)));

        $this->success($info);
    }

    //保存网站基本信息
    public function doSaveInfo()
    {
        global $_M;
        if (!$_M['form']) {
            $this->error();
        }

        if (isset($_M['form']['met_ico']) && $_M['form']['met_ico'] != '../favicon.ico') {
            copy($_M['form']['met_ico'], '../favicon.ico');
        }

        if ($_M['form']['met_ico'] == '') {
            delfile('../favicon.ico');
        }

        /*if (isset($_M['form']['met_weburl']) && $_M['form']['met_weburl']) {
            $met_weburl = $_M['form']['met_weburl'];
            if (substr($met_weburl, -1, 1) != "/") {
                $met_weburl .= "/";
            }
            if (!strstr($met_weburl, "http://") && !strstr($met_weburl, "https://")) {
                $met_weburl = "http://" . $met_weburl;
            }
        }
        $_M['form']['met_weburl'] = $met_weburl;*/

        //保存配置信息
        $configlist = array();
        ###$configlist[] = 'met_weburl';
        $configlist[] = 'met_webname';
        $configlist[] = 'met_logo';
        $configlist[] = 'met_mobile_logo';
        $configlist[] = 'met_keywords';
        $configlist[] = 'met_description';
        $configlist[] = 'met_footright';
        $configlist[] = 'met_footaddress';
        $configlist[] = 'met_foottel';
        $configlist[] = 'met_footother';
        configsave($configlist);

        #self::info_handle($met_weburl);
        //写日志
        logs::addAdminLog('website_information','save','jsok','doSaveInfo');

        buffer::clearConfig();
        $this->success('', $_M['word']['jsok']);
    }



    /** 获取站点网址
     * @param  string $lang 语言
     * @return string
     */
    private function get_weburl()
    {
        global $_M;
        if ($_M['langlist']['web'][$_M['lang']]['link']){
            return $_M['langlist']['web'][$_M['lang']]['link'];
        }

        $query = "SELECT met_weburl FROM {$_M['table']['lang']} WHERE lang = '{$_M['lang']}'";
        $get_lang = DB::get_one($query);
        $web_url = isset($get_lang['met_weburl']) ? $get_lang['met_weburl'] : '';
        if(!$web_url) {
            $web_url = isset($_M['config']['met_weburl']) ? $_M['config']['met_weburl'] : $_M['url']['site'];
        }
        return $web_url;
    }

    /**  基本信息处理
     * @param $weburl string 当前网址
     */
    private function info_handle($weburl)
    {
        global $_M;

        //重新验证授权
        $query = "UPDATE {$_M['table']['otherinfo']} SET info1='',info2='' where id=1";
        DB::query($query);

        //语言网址修改
        if (isset($weburl)) {
            $query = "UPDATE {$_M['table']['lang']} SET met_weburl = '{$weburl}' where lang='{$_M['lang']}'";
            DB::query($query);
        }

        //重新生成robots
        $sitemaptype = $_M['config']['met_sitemap_xml'] ? 'xml' : ($_M['config']['met_sitemap_txt'] ? 'txt' : 0);
        sitemap_robots($sitemaptype);

    }



}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>