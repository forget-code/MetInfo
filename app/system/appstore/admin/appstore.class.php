<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.

defined('IN_MET') or exit('No permission');

load::sys_class('admin');
load::sys_func('file');

class appstore extends admin {

	public function __construct() {
		global $_M;
		parent::__construct();
		// nav::set_nav(0, $_M['word']['sys_select'], $_M['url']['own_form'].'a=doindex');
		nav::set_nav(1, $_M['word']['should_used'], $_M['url']['own_form'].'a=doappstore');
		nav::set_nav(2, $_M['word']['sys_template'], 'https://www.metinfo.cn/product/','_blank');
		nav::set_nav(3, $_M['word']['appstore_Worryfree_service_v6'],'https://www.metinfo.cn/web/wuyou.htm','_blank');
		nav::set_nav(4, $_M['word']['appstore_Spacedomain_name_v6'],'https://www.metinfo.cn/web/idc.htm','_blank');
		nav::set_nav(5, $_M['word']['appstore_buildweb_v6'],'https://www.metinfo.cn/eweb/','_blank');
        nav::set_nav(6, $_M['word']['appstore_Thirdcooperation_v6'], $_M['url']['own_form'].'a=dopartner');
	}

	public function doindex() {
		global $_M;
		Header("Location: {$_M['url']['own_form']}a=doappstore");
		// nav::select_nav(1);
		// $query = "select * from {$_M['table']['config']} where name='met_secret_key'";
		// $result = DB::get_one($query);
		// require $this->template('own/index');
	}

	public function doappstore() {
		global $_M;
		$return_this = 1;
		nav::select_nav(1);
		$query = "select * from {$_M['table']['config']} where name='met_secret_key'";
		$result = DB::get_one($query);
		require $this->template('own/appstore');
	}

	public function dotem_market() {
		global $_M;
		$return_this = 1;
		nav::select_nav(2);
		$query = "select * from {$_M['table']['config']} where name='met_secret_key'";
		$result = DB::get_one($query);
		require $this->template('own/temstore');
	}

	public function doappdetail(){
		global $_M;
		$return_this = 1;
		$appdetail['type'] = $_M['form']['type'];
		$appdetail['no'] = $_M['form']['no'];
		//$appdetail['appid'] = $_M['form']['appid'];
		if($appdetail['type'] == 'app'){
			nav::select_nav(1);
			$getapp = load::mod_class('myapp/class/getapp', 'new');
			$app = $getapp->get_oneapp($appdetail['no']);
			if($app){
				$app['url'] = "<a href=\"{$app['url']}\">{$_M['word']['dlapptips5']}</a>";
			}
			$buy_Explain = $_M['word']['langshuom'];
			$buy_Explain1 = $_M['word']['purchase_application'];
			$demonstration = "<span class='demo_url'></span>";
		}
		if($appdetail['type'] == 'tem'){
			nav::select_nav(2);
			$query = "SELECT * FROM {$_M['table']['skin_table']} WHERE skin_file ='{$appdetail['no']}'";
			$app = DB::get_one($query);
			if($app){
				if(file_exists(PATH_WEB.'templates/'.$appdetail['no'].'/ui.json')){
				$tem_url = "{$_M['url']['adminurl']}index.php?lang={$_M['lang']}&n=ui_set&pageset=1";
				}else{
					$tem_url = "{$_M['url']['adminurl']}n=theme&c=theme&a=doindex&mobile={$app['devices']}&anyid=70&lang={$_M['lang']}";
				}
				//$app['ver'] = '1.0';
				$app['url'] = "<a target=\"_blank\" href=\"{$tem_url}\">{$_M['word']['configuratio_template']}</a><a target=\"_blank\" href=\"https://account.metinfo.cn/profile/template/\">{$_M['word']['appstore_downshowdata_v6']}</a>";
			}
			$appdetail['no'] = $_M['form']['appid'];
			$buy_Explain = $_M['word']['template_domain'];
			$buy_Explain1 = $_M['word']['buy_template_must'];
		}
		if($app){
			$appdetail['download'] = 1;
		}else{
			$appdetail['download'] = 0;
		}
		$appdetail['ver'] = $app['ver'];
		$appdetail['url'] = $app['url'];
		$query = "SELECT * FROM {$_M['table']['otherinfo']} where id=1";
		$th = DB::get_one($query);
		$authkey = $th['authpass'];
		$authcode= $th['authcode'];
		require $this->template('own/appdetail');
	}

	public function doservice() {
		global $_M;
		nav::select_nav(3);
		require $this->template('own/service');
	}

	public function dopartner() {
        global $_M;
        nav::select_nav(6);
        $query = "select * from {$_M['table']['config']} where name='met_secret_key'";
        $result = DB::get_one($query);
        require $this->template('own/partner');
    }

}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>