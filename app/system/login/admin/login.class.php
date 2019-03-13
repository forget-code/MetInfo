<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.

defined('IN_MET') or exit('No permission');

load::sys_class('admin.class.php');
load::sys_class('nav.class.php');
load::sys_func('file');

class login extends admin {

	public function __construct() {
		global $_M;
		parent::__construct();
	}

	public function doindex() {
		global $_M;
		$_M['config']['met_agents_logo_login'] = $_M['url']['site_admin'].'templates/met/images/login-logo.png';
		$met_langadmin=DB::get_all("select * from {$_M[table][lang_admin]} where lang !='metinfo'");
		$langset=$_M[form][langset];
		$query="select * from {$_M[table][language]} where lang='{$_M[form][langset]}' and site = 1";
		$langwordlist=DB::get_all($query);
		foreach ($langwordlist as $key => $value) {
			$_M[word][$value[name]]=$value[value];
		}
		require $this->template('own/index');
	}

	public function dologin() {
		global $_M;
		if(!load::sys_class('pin', 'new')->check_pin($_M['form']['code']) && $_M[config][met_login_code]){
			 			okinfo(HTTP_REFERER,$_M['word']['logincodeerror']);
		}
		if($_M['form']['login_name'] != '' && $_M['form']['login_pass'] != ''){
			$query = "SELECT * FROM {$_M['table']['admin_table']} WHERE admin_id = '{$_M['form']['login_name']}'";
			$admin = DB::get_one($query);
			if($admin['admin_pass'] === md5($_M['form']['login_pass'])){
				$this->login($admin);
				$this->modify_weburl($admin);
				setcookie("page_iframe_url", '',0,'/');
				Header("Location: ".$_M['url']['adminurl']."n=ui_set&pageset=1");
			}else{
				okinfo(HTTP_REFERER, $_M['word']['loginpass']);
			}
		}else{
			okinfo(HTTP_REFERER, $_M['word']['loginname']);
		}
	}

	public function dologinout() {
		global $_M;
		setcookie("met_auth", '',0,'/');
		setcookie("met_key", '',0,'/');
		setcookie("page_iframe_url", '',0,'/');
		okinfo($_M['url']['site_admin']."index.php?n=login&c=login&a=doindex");
	}

	function login($admin){
		global $_M;
		$met_cookie=array();
		$met_cookie['time']=time();
		$met_cookie['metinfo_admin_name']=urlencode($admin['admin_id']);
		$met_cookie['metinfo_admin_pass']=$admin['admin_pass'];
		$met_cookie['metinfo_admin_id']=$admin['id'];
		$met_cookie['metinfo_admin_type']=$admin['usertype'];
		$met_cookie['metinfo_admin_pop']=$admin['admin_type'];
		$met_cookie['metinfo_admin_time']=time();
		$met_cookie['metinfo_admin_lang']=$admin['langok'];
		$met_cookie['languser']=$_M['form']['langset'];
		$m_now_date = date('Y-m-d H:i:s');
		$m_user_ip = get_userip();
		$json = jsonencode($met_cookie);
		$query="update {$_M['table']['admin_table']} set cookie='{$json}',admin_modify_date='{$m_now_date}',admin_login=admin_login+1,admin_modify_ip='{$m_user_ip}' WHERE admin_id = '{$admin['admin_id']}'";
		DB::query($query);
		$met_key=met_rand(7);
		$admin[admin_pass]=md5($admin[admin_pass]);

		$auth=authcode("{$admin[admin_id]}\t{$admin[admin_pass]}",'ENCODE', $_M['config']['met_webkeys'].$met_key, 86400);
		setcookie("met_auth",$auth,0,'/');
		setcookie("met_key",$met_key,0,'/');

        $query="update {$_M['table']['config']} set `value`=0 WHERE `name`='met_safe_prompt'";
        DB::query($query);
	}

	function modify_weburl(){
		global $_M;
		if(!strstr($_M['config']['met_weburl'], str_replace('www.', '', HTTP_HOST))){
			/*网址修改*/
			$met_weburl = "http://".HTTP_HOST.'/';
			$query  = "UPDATE {$_M['table']['config']} set value='{$met_weburl}' WHERE name='met_weburl'";
			DB::query($query);
			/*语言网址修改*/
			$query = "UPDATE {$_M['table']['lang']} SET met_weburl = '{$met_weburl}'";
			DB::query($query);
			/*重新生成404*/
			$gent = "{$_M['url']['site']}include/404.php?lang={$_M[config][met_index_type]}&metinfonow={$_M['config']['met_member_force']}";
			load::sys_class('curl');
			$curl = new curl();
			$curl -> set('host', $_M['url']['site']);
			$curl -> set('file', "include/404.php?lang={$_M[config][met_index_type]}&metinfonow={$_M['config']['met_member_force']}");
			$curl->curl_post();
			/*重新生成robots.txt*/
			$sitemaptype = $_M['config']['met_sitemap_xml']?'xml':($_M['config']['met_sitemap_txt']?'txt':0);
			//sitemap_robots($sitemaptype);
		}
		deldir(PATH_WEB.'cache',1);
	}

	public function check() {

	}


}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>
