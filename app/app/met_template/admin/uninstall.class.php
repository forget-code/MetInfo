<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.
defined('IN_MET') or exit('No permission');
load::sys_func('file');
class uninstall extends admin{

    public $appno;
    public $appdir;

    public function __construct()
    {
        $this->appno = 50002;
        $this->appname = 'met_template';

    }

    /**
     * 卸载应用
     */
    public function dodel(){
        global $_M;
        turnover("{$_M['url']['own_form']}a=doindex","{$_M['word']['met_template_nodelet']}");
        // $del_applist = "DELETE FROM {$_M['table']['applist']} WHERE no = {$this->appno}";
        // DB::query($del_applist);

        // deldir(PATH_WEB.$_M['config']['met_adminfile'].'/update/app/'.$this->appno);
        // deldir('../app/app/'.$this->appname);

        // turnover("{$_M['url']['own_form']}a=doindex");
    }

    public function delConfig($name) {
        global $_M;
        $query = "DELETE FROM {$_M['table']['config']} WHERE name = '{$name}'";
        DB::query($query);
    }
}
?>