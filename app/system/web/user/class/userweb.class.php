<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');

load::sys_class('web');

/**
 * 前台基类
 */
class userweb extends web {
	public $userclass;
	/**
	  * 初始化
	  */
	public function __construct() {
		global $_M;
		parent::__construct();
		$this->check();
		$this->userclass = load::sys_class('user', 'new');
		$query = "SELECT * FROM {$_M['table']['column']} WHERE module='10' AND lang='{$_M['lang']}'";
		$member = DB::get_one($query);
		if($_M['config']['met_title_type'] == 0){
			$_M['tem_data']['title'] = $member['name'];
		}else if($_M['config']['met_title_type'] == 1){
			$_M['tem_data']['title'] = $member['name'].'-'.$_M['config']['met_keywords'];
		}else if($_M['config']['met_title_type'] == 2){
			$_M['tem_data']['title'] = $member['name'].'-'.$_M['config']['met_webname'];
		}else if($_M['config']['met_title_type'] == 3){
			$_M['tem_data']['title'] = $member['name'].'-'.$_M['config']['met_keywords'].'-'.$_M['config']['met_webname'];
		}
		
		$query = "SELECT * FROM {$_M['table']['ifmember_left']}";
		$navigation = DB::get_all($query);
		foreach($navigation as $key=>$val){
			if($val[columnid]){
				//$column = $class_list[$val[columnid]];
				$query = "SELECT * FROM {$_M['table']['column']} WHERE id = '{$val[columnid]} ' and lang='{$_M['lang']}'";
				$column = DB::get_one($query);
				$val['foldername'] = $val['foldername'] ? $val['foldername'] : $column['foldername'];
				$val['filename'] = $val['filename'] ? $val['filename'] : 'index.php';
				$list['url'] = "../{$val['foldername']}/{$val['filename']}";
				$list['title'] = $column['name'];
			}else{
				$list['url'] = "../{$val['foldername']}/{$val['filename']}";
				$list['title'] = $val['title'];
			}
			$_M['html']['app_sidebar'][] = $list;
		}
	}
	
	public function mcheck() {
		global $_M;
		
	}
	
	protected function template($path){
		global $_M;
		list($postion, $file) = explode('/',$path);
		if ($postion == 'own') {
			return PATH_OWN_FILE."templates/met/{$file}.php";
		}
		if ($postion == 'ui') {
			return PATH_SYS."include/public/ui/web/{$file}.php";
		}
		if($postion == 'tem'){
			if($_M['custom_template']['sys_content']){
				$flag = 1;
			}else{
				$flag = 0;
			}
			if (file_exists(PATH_TEM."user/{$file}.php")) {
				$_M['custom_template']['sys_content'] = PATH_TEM."user/{$file}.php";
			}else{	
				if (file_exists(PATH_SYS."web/user/templates/met/{$file}.php")) {
					$_M['custom_template']['sys_content'] = PATH_SYS."web/user/templates/met/{$file}.php";
				}
			}
			if($flag == 1){
				return $_M['custom_template']['sys_content'];
			}else{
				return $this->template('ui/compatible');
			}
			
		}			

	}
	
	/**
	  * 重写web类的load_url_unique方法，获取前台特有URL
	  */
	protected function load_url_unique() {
		global $_M;
		parent::load_url_unique();
		$_M['url']['tem'] = $_M['url']['site'].'app/system/web/user/templates/met/';
		if($_M['lang'] != $_M['config']['met_index_type']){
			$lang = "?lang={$_M['lang']}";
		}
		$lang = "?lang={$_M['lang']}";
		$_M['url']['login'] = $_M['url']['site']."member/login.php{$lang}";
		$_M['url']['register'] = $_M['url']['site']."member/register_include.php{$lang}";
		$_M['url']['register_userok'] = $_M['url']['site']."member/register_include.php?lang={$_M['lang']}&a=douserok";
		$_M['url']['getpassword'] = $_M['url']['site']."member/getpassword.php?lang={$_M['lang']}";
		
		$_M['url']['user_home'] = $_M['url']['site']."member/index.php{$lang}";
		$_M['url']['profile'] = $_M['url']['site']."member/basic.php{$lang}"; 
		$_M['url']['profile_safety'] = $_M['url']['site']."member/basic.php?lang={$_M['lang']}&a=dosafety"; 
		$_M['url']['pass_save'] = $_M['url']['site']."member/basic.php?lang={$_M['lang']}&a=dopasssave"; 
		$_M['url']['mailedit'] = $_M['url']['site']."member/basic.php?lang={$_M['lang']}&a=doemailedit"; 
		$_M['url']['maileditok'] = $_M['url']['site']."member/basic.php?lang={$_M['lang']}&a=doemailok"; 
		$_M['url']['profile_safety_emailadd'] = $_M['url']['site']."member/basic.php?lang={$_M['lang']}&a=dosafety_emailadd"; 
		$_M['url']['profile_safety_telok'] = $_M['url']['site']."member/basic.php?lang={$_M['lang']}&a=dosafety_telok"; 
		$_M['url']['profile_safety_telvalid'] = $_M['url']['site']."member/basic.php?lang={$_M['lang']}&a=dosafety_telvalid"; 
		$_M['url']['profile_safety_teladd'] = $_M['url']['site']."member/basic.php?lang={$_M['lang']}&a=dosafety_teladd"; 
		$_M['url']['profile_safety_teledit'] = $_M['url']['site']."member/basic.php?lang={$_M['lang']}&a=dosafety_teledit"; 
		
		$_M['url']['info_save'] = $_M['url']['site']."member/basic.php?lang={$_M['lang']}&a=doinfosave";
		$_M['url']['valid_email_repeat'] = $_M['url']['site']."member/basic.php?lang={$_M['lang']}&a=dovalid_email"; 
		$_M['url']['valid_email'] = $_M['url']['site']."member/register_include.php?lang={$_M['lang']}&a=doemailvild"; 
		$_M['url']['valid_phone'] = $_M['url']['site']."member/register_include.php?lang={$_M['lang']}&a=dophonecode"; 
		
		$_M['url']['login_check'] = $_M['url']['site']."member/login.php?lang={$_M['lang']}&a=dologin";	
				
		$_M['url']['register_save'] = $_M['url']['site']."member/register_include.php?lang={$_M['lang']}&a=dosave";	
		
		$_M['url']['password_email'] = $_M['url']['site']."member/getpassword.php?lang={$_M['lang']}&a=doemail";
		$_M['url']['password_valid'] = $_M['url']['site']."member/getpassword.php?lang={$_M['lang']}&a=dovalid";
		$_M['url']['password_telvalid'] = $_M['url']['site']."member/getpassword.php?lang={$_M['lang']}&a=dotelvalid";
		$_M['url']['password_valid_phone'] = $_M['url']['site']."member/getpassword.php?lang={$_M['lang']}&a=dophonecode";
	
		$_M['url']['login_out'] = $_M['url']['site']."member/login.php?lang={$_M['lang']}&a=dologout";	
		$_M['url']['login_other'] = $_M['url']['site']."member/login.php?lang={$_M['lang']}&a=doother";	
		$_M['url']['login_other_register'] = $_M['url']['site']."member/login.php?lang={$_M['lang']}&a=dologin_other_register";	
		$_M['url']['login_other_info'] = $_M['url']['site']."member/login.php?lang={$_M['lang']}&a=dologin_other_info";	

	}	
	
	
	protected function navlist(){
		
	}
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>