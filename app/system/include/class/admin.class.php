<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');
defined('IN_ADMIN') or exit('No permission');

load::sys_class('common');
load::sys_class('nav');
load::sys_func('admin');

/**
 * 后台基类
 */
class admin extends common {
	
	/**
	  * 初始化
	  */
	public function __construct() {
		parent::__construct();
		global $_M;
		met_cooike_start();//读取已登陆管理员信息
		$this->load_language();//语言加载
		$this->check();//验证管理员
		load::plugin('doadmin');//插件加载
	}
	
	/**
	  * 重写common类的load_url_site方法，获取前台与后台网址
	  */
	protected function load_url_site() {
		global $_M;

		if(strstr($_M[config][met_weburl],'https')){
              $_M['url']['site_admin'] = 'https://'.str_replace(array('/index.php'), '', HTTP_HOST.PHP_SELF).'/';
		}else{
		  $_M['url']['site_admin'] = 'http://'.str_replace(array('/index.php'), '', HTTP_HOST.PHP_SELF).'/';	
		}

		$_M['url']['site'] = preg_replace('/(\/[^\/]*\/$)/', '', $_M[url][site_admin]).'/';
	}
	
	/**
	  * 重写common类的load_url_unique方法，获取后台台特有URL
	  */
	protected function load_url_unique() {
		global $_M;
		$_M['url']['ui'] = $_M['url']['site'].'app/system/include/public/ui/admin/';
		$_M['url']['adminurl'] =  $_M['url']['site_admin']."index.php?lang={$_M['lang']}".'&';
		$_M['url']['own_name'] =  $_M['url']['adminurl'].'anyid='.$_M['form']['anyid'].'&n='.M_NAME.'&';
		$_M['url']['own_form'] = $_M['url']['own_name'].'c='.M_CLASS.'&';
		$_M['url']['tem'] = $_M['url']['site'].'app/'.M_TYPE.'/'.M_MODULE.'/'.'templates/web/';
		$_M['url']['own_tem'] = M_TYPE == 'system' ? $_M['url']['site'].'app/'.M_TYPE.'/'.M_MODULE.'/'.'templates/web/'.M_NAME.'/' : $_M['url']['site'].'app/'.M_TYPE.'/'.M_NAME.'/'.M_MODULE.'/templates/';
	}

	/**
	  * 获取当前语言参数
	  */
	protected function load_language() {
		global $_M;
		$_M['langset'] = get_met_cookie('languser');
		if(!$_M['langset']) {
			$_M['langset'] = 'cn';
		}
		$this->load_word($_M['langset'], 1);
		$this->load_agent_word($_M['langset']);
	}
	
	/**
	  * 代理商配置语言修改
	  */
	protected function load_agent_word($lang) {
		global $_M;
		if ($_M['config']['met_agents_type'] >= 2) {
			$query = "SELECT * FROM {$_M['table']['config']} WHERE lang='{$lang}-metinfo'";
			$result = DB::query($query);
			while($list_config= DB::fetch_array($result)){
				$lang_agents[$list_config['name']]=$list_config['value'];
			}
			$_M['word']['indexthanks'] = $lang_agents['met_agents_thanks'];
			$_M['word']['metinfo'] = $lang_agents['met_agents_name'];
			$_M['word']['copyright'] = $lang_agents['met_agents_copyright'];
			$_M['word']['oginmetinfo'] = $lang_agents['met_agents_depict_login'];
		}
	}
	
	/**
	  * 配置变量过滤
	  * @param string $value 配置变量
	  */	
	protected function filter_config($value) {	
		$value = str_replace('"', '&#34;', str_replace("'", "&#39;", $value));
		return $value;
	}
	
	/**
	 * 检测是否登陆
	 * 有权限则程序向后运行，无权限则提示物权限
	 */	
	protected function check() {
		global $_M;
		$current_url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		if (strstr($current_url, $_M['url']['site_admin']."index.php")) {
			$admin_index = 1;
		} else {
			$admin_index = '';
		}
		$met_adminfile = $_M['config']['met_adminfile'];
		$met_admin_table = $_M['table']['admin_table'];
		$metinfo_admin_name = get_met_cookie('metinfo_admin_name');
		$metinfo_admin_pass = get_met_cookie('metinfo_admin_pass');
		if (!$metinfo_admin_name || !$metinfo_admin_pass) {
			if ($admin_index) {
				met_cooike_unset();
				met_setcookie("re_url", $re_url,time()-3600);
				Header("Location: ".$_M['url']['site_admin']."login/login.php");
			} else {
				if (!$re_url) {
					$re_url = $_SERVER[HTTP_REFERER];
					$HTTP_REFERERs = explode('?', $_SERVER[HTTP_REFERER]);
					$admin_file_len1 = strlen("/{$met_adminfile}/");
					$admin_file_len2 = strlen("/{$met_adminfile}/index.php");
					if(strrev(substr(strrev($HTTP_REFERERs[0]), 0, $admin_file_len1)) == "/{$met_adminfile}/" || strrev(substr(strrev($HTTP_REFERERs[0]), 0,$admin_file_len2)) == "/{$met_adminfile}/index.php"||!$HTTP_REFERERs[0]) {
						$re_url = "http://{$_SERVER[SERVER_NAME]}{$_SERVER[REQUEST_URI]}";
					}
				}
				if (!$_COOKIE[re_url]&&!strstr($re_url, "return.php")) met_setcookie("re_url", $re_url,time()+3600);
				met_cooike_unset();
				Header("Location: ".$_M['url']['site_admin']."login/login.php");
			}
			exit;
		} else {
			$query = "SELECT * FROM {$_M['table']['admin_table']} WHERE admin_id = '{$metinfo_admin_name}' AND admin_pass = '{$metinfo_admin_pass}' AND usertype = '3'";
			$admincp_ok = DB::get_one($query);
			if (!$admincp_ok) {
				if ($admin_index) {
					met_cooike_unset();
					met_setcookie("re_url",$re_url,time()-3600);
					Header("Location: ".$_M['url']['site_admin']."login/login.php");
				} else {
					if (!$re_url) {
						$re_url = $_SERVER[HTTP_REFERER];
						$HTTP_REFERERs = explode('?',$_SERVER[HTTP_REFERER]);
						$admin_file_len1 = strlen("/{$met_adminfile}/");
						$admin_file_len2 = strlen("/{$met_adminfile}/index.php");
						if(strrev(substr(strrev($HTTP_REFERERs[0]), 0, $admin_file_len1)) == "/$met_adminfile/" || strrev(substr(strrev($HTTP_REFERERs[0]),0,$admin_file_len2)) == "/{$met_adminfile}/index.php" || !$HTTP_REFERERs[0]){
							$re_url = "http://{$_SERVER[SERVER_NAME]}{$_SERVER[REQUEST_URI]}";
						}
					}
					if (!strstr($re_url, "return.php")) {
						if (!$_COOKIE['re_url']) met_setcookie("re_url", $re_url,time()+3600);
					}
					met_cooike_unset();
					Header("Location: ".$_M['url']['site_admin']."login/login.php");
				}
				exit;
			}
		}
		$query = "SELECT * FROM {$_M['table']['admin_table']} WHERE admin_id='{$metinfo_admin_name}' AND admin_pass='{$metinfo_admin_pass}'";
		$membercp_ok = DB::get_one($query);
		if (!strstr($membercp_ok['admin_op'], "metinfo")) {
			if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
				$return_url = "";
			} else {
				$return_url = "javascript:window.history.back();";
			}

			if (stristr(M_ACTION, 'add')) {
				if (!strstr($membercp_ok['admin_op'], "add")) okinfo($return_url, $_M['word']['loginadd']);
			}
			if (stristr(M_ACTION, 'editor')||stristr($_M['form']['sub_type'], 'editor')) {

				if (!strstr($membercp_ok['admin_op'], "editor")) okinfo($return_url, $_M['word']['loginedit']);
			}
			if(stristr(M_ACTION, 'del')||stristr($_M['form']['submit_type'], 'del')){
				if (!strstr($membercp_ok['admin_op'], "del")) okinfo($return_url, $_M['word']['logindelete']);
			}
			if (stristr(M_ACTION, 'all')) {
				if (!strstr($membercp_ok['admin_op'], "metinfo")) okinfo($return_url, $_M['word']['loginall']);
			}
    //         if (stristr($_M['form']['submit_type'], 'del')) {
				// 	if (!strstr($membercp_ok['admin_op'], "del")) okinfo($return_url, $_M['word']['logindelete']);
				// }
                 //var_dump($_M['form']);
                 //exit;

     //         if (stristr($_M['form']['submit_type'], 'editor')) {
				 // 	if (!strstr($membercp_ok['admin_op'], "editor")) okinfo($return_url, $_M['word']['loginadd']);
				 // }


			if (stristr(M_ACTION, 'table')) {
				if (stristr($_M['form']['submit_type'], 'save')) {
					if ($_M['form']['allid']) {
						$power_ids = explode(',',$_M['form']['allid']);
						$e = 0;
						$a = 0;
						foreach ($power_ids as $val) {
							if($val){
								if (is_numeric($val)) {
									$e++;
								} else {
									$a++;
								}
							}
							if ($e > 0) {
								if (!strstr($membercp_ok['admin_op'], "editor")) okinfo($return_url, $_M['word']['loginedit']);
							}
							if ($a > 0) {
								if (!strstr($membercp_ok['admin_op'], "add")) okinfo($return_url, $_M['word']['loginadd']);
							}
						}
					}
				}
			
				if (stristr($_M['form']['submit_type'], 'del')) {
					if (!strstr($membercp_ok['admin_op'], "del")) okinfo($return_url, $_M['word']['logindelete']);
				}
			}
		}
		if(stristr($_M['url']['own'], 'admin/appstore')) {
			if(!stristr($membercp_ok['admin_type'], '1507') && $membercp_ok['admin_type'] != 'metinfo') {
				echo("<script type='text/javascript'> alert('{$_M['word']['appmarket_jurisdiction']}');window.history.back();</script>");
				exit;
			}
		}
		if(stristr($_M['url']['own'], 'admin/theme')) {
			if($_M['form']['mobile']) {
				if(!stristr($membercp_ok['admin_type'], '1102') && $membercp_ok['admin_type'] != 'metinfo') {
					echo("<script type='text/javascript'> alert('{$_M['word']['setup_permissions']}');window.history.back();</script>");
					exit;
				}
			} else {
				if(!stristr($membercp_ok['admin_type'], '1101') && $membercp_ok['admin_type'] != 'metinfo') {
					echo("<script type='text/javascript'> alert('{$_M['word']['setup_permissions']}');window.history.back();</script>");
					exit;
				}
			}
		}
	}
}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>