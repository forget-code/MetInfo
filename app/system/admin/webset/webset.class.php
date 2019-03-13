<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');

load::sys_class('admin.class.php');
load::sys_class('nav.class.php');

class webset extends admin {
	public $iniclass;
	function __construct() {
		global $_M;
		parent::__construct();
		nav::set_nav(1, $_M['word']['website_information'], $_M['url']['own_form'].'&a=doindex');
		nav::set_nav(2, $_M['word']['email_Settings'], $_M['url']['own_form'].'&a=doemailset');
		nav::set_nav(3, $_M['word']['third_party_ode'], $_M['url']['own_form'].'&a=dothirdparty');
	}
	
	function doindex() {
		global $_M;
		nav::select_nav(1);	
		$record = '';
		if($_M['form']['turnovertext']){
			$adrry = admin_information();
			$email = $adrry['admin_email'];
			$tel   = $adrry['admin_mobile'];
			$record = "http://api.metinfo.cn/record_install.php?url={$_M['config']['met_weburl']}&email={$email}&webname={$_M['config']['met_webname']}&webkeywords={$_M['config']['met_keywords']}&tel={$tel}&version={$_M['config']['metcms_v']}&softtype=1";
		}
		require $this->template('tem/index');
	}
	
	function doseteditor(){
		global $_M;

		if($_M['form']['met_ico'] != '../favicon.ico'){
			copy($_M['form']['met_ico'], '../favicon.ico');
		}
		$met_weburl = $_M['form']['met_weburl'];
		if(substr($met_weburl,-1,1)!="/")$met_weburl.="/";
		if(!strstr($met_weburl,"http://")&&!strstr($met_weburl,"https://"))$met_weburl="http://".$met_weburl;
		$_M['form']['met_weburl'] = $met_weburl;
		
		$configlist = array();
		$configlist[] = 'met_webname';
		$configlist[] = 'met_logo';
		$configlist[] = 'met_weburl';
		$configlist[] = 'met_keywords';
		$configlist[] = 'met_description';
		$configlist[] = 'met_footright';
		$configlist[] = 'met_footaddress';
		$configlist[] = 'met_foottel';
		$configlist[] = 'met_footother';
		configsave($configlist);/*保存系统配置*/
		
		if($_M['form']['met_weburl']!=$_M['config']['met_weburl']){//当首页网址变更时
			/*重新验证授权*/
			$query = "UPDATE {$_M['table']['otherinfo']} SET info1='',info2='' where id=1";
			DB::query($query);
			/*语言网址修改*/
			$query = "UPDATE {$_M['table']['lang']} SET met_weburl = '{$_M['form']['met_weburl']}' where lang='{$_M['lang']}'";
			DB::query($query);
			/*重新生成404*/
			$gent = "{$_M['url']['site']}include/404.php?lang={$_M[config][met_index_type]}&metinfonow={$_M['config']['met_member_force']}";
			$gent = urlencode($gent);
			/*重新生成robots.txt*/
			$sitemaptype = $_M['config']['met_sitemap_xml']?'xml':($_M['config']['met_sitemap_txt']?'txt':0);
			sitemap_robots($sitemaptype);
		}
		
		turnover("{$_M[url][own_form]}a=doindex&gent={$gent}", $_M['word']['jsok']);
		
	}
	
	function doemailset() {
		global $_M;
		nav::select_nav(2);
		require $this->template('tem/email');
	}
	
	function doemaileditor(){
		global $_M;
		$configlist = array();
		$configlist[] = 'met_fd_usename';
		$configlist[] = 'met_fd_fromname';
		if($_M['form']['met_fd_password']!='passwordhidden'){
		$configlist[] = 'met_fd_password';
		}
		$configlist[] = 'met_fd_smtp';
		$configlist[] = 'met_fd_port';
		$configlist[] = 'met_fd_way';
		configsave($configlist);/*保存系统配置*/
		turnover("{$_M[url][own_form]}a=doemailset", $_M['word']['jsok']);
	}
	
	function doemail(){
		global $_M;
		if(!get_extension_funcs('openssl')&&stripos($_M['form']['met_fd_smtp'],'.gmail.com')!==false){
			$metinfo="<span style=\"color:#f00;\">{$_M['word']['setbasicTip14']}</span>";
			echo $metinfo;
			die();
		}
		if(!get_extension_funcs('openssl')&&$_M['form']['met_fd_way']=='ssl'){
			$metinfo="<span style=\"color:#f00;\">{$_M['word']['setbasicTip15']}</span>";
			echo $metinfo;
			die();
		}
		if(!function_exists('fsockopen')&&!function_exists('pfsockopen')&&!function_exists('stream_socket_client')){
			$metinfo ="<span style=\"color:#f00;\">{$_M['word']['basictips1']}</span>";
			$metinfo.="<span style=\"color:#090;\">{$_M['word']['basictips2']}</span>";
		}else{
			$usename  = $_M['form']['met_fd_usename'];
			$fromname = $_M['form']['met_fd_fromname'];
			$password = $_M['form']['met_fd_password'];
			$password = $password=='passwordhidden'?$_M['config']['met_fd_password']:$password;
			$smtp     = $_M['form']['met_fd_smtp'];
			$port     = $_M['form']['met_fd_port'];
			$way      = $_M['form']['met_fd_way'];
			
			$jmail = load::sys_class('jmail', 'new');
			$jmail->set_send_mailbox($usename, $fromname, $usename, $password, $smtp , $port, $way);
			
			$ret = $jmail->send_email($usename, $_M['word']['basictips3'], $_M['word']['basictips4']);
			
			if ($ret) {
				$metinfo ="<span style=\"color:#090;\">{$_M['word']['basictips7']}</span>";
			}else{
				$metinfo ="<span style=\"color:#f00;\">{$_M['word']['basictips5']}</span>";
				$metinfo.="<span style=\"color:#f00;\">{$_M['word']['basictips6']}</span>";
			}			
		}
		echo $metinfo;
	}

	function dothirdparty(){
		global $_M;
		nav::select_nav(3);
		require $this->template('tem/thirdparty');
	}
	
	function dotpeditor(){
		global $_M;
		$configlist = array();
		$configlist[] = 'met_headstat';
		$configlist[] = 'met_footstat';
		configsave($configlist);/*保存系统配置*/
		turnover("{$_M[url][own_form]}a=dothirdparty", $_M['word']['jsok']);
	}
	
}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>