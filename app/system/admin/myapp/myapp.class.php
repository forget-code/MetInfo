<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.

defined('IN_MET') or exit('No permission');

load::sys_class('admin');

class myapp extends admin {

    public function __construct() {
        global $_M;
        parent::__construct();
    }

    public function doindex() {
        global $_M;
        $app = load::mod_class('myapp/class/getapp', 'new');
        $appl = $app->get_app();
        foreach($appl as $key=>$val){
            if($val['no'] > 10000)$applist .= $val['no'].'-'.$val['ver'].'|';
        }
        $applist = trim($applist, '|');
		$privilege = background_privilege();
		
		if($privilege['application'] != 'metinfo'){
			foreach($appl as $key=>$val){
				if($val['no'] > 10000) {
					if(!strstr($privilege['application'], $val['no'])) {
						unset($appl[$key]); 
					}
				}
			}
		}
        require $this->template('tem/myapp');
    }

    public function dodelapp() {
        global $_M;
        $no = $_M['form']['no'];
        $getapp = load::mod_class('myapp/class/getapp', 'new');
        $app = $getapp->get_oneapp($no);
        if ($app['m_class']) {
            $uninstall = load::app_class($app['m_name'].'/admin/uninstall', 'new');
            $uninstall->dodel();
            turnover($_M['url']['own_name'].'&c=myapp&a=doindex', $_M['word']['physicaldelok']);
        } else {
            $query = "DELETE FROM {$_M['table']['applist']} WHERE no='{$no}'";
            DB::query($query);
            $query = "SELECT * FROM {$_M['table']['app']} WHERE no='{$no}' AND download=1";
            $app_old = DB::get_one($query);
            if (file_exists(PATH_WEB.$_M['config']['met_adminfile'].'/app/'.$app['m_name'].'/delapp.php')){
                header('location:'.$_M['url']['site_admin'].'app/'.$app['m_name'].'/delapp.php?lang='.$_M['lang'].'&id='.$app_old['id'].'&action=del');
            } else {
				header('location:'.$_M['url']['site_admin'].'app/dlapp/delapp.php?lang='.$_M['lang'].'&id='.$app_old['id'].'&action=del');
            }
        }

    }



}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>