<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');

load::sys_class('admin');
load::sys_func('file');
load::sys_func('array');
load::sys_class('curl');

class member extends admin {

	public function __construct() {
		global $_M;
		parent::__construct();
		$_M['url']['app_api'] = $_M['url']['api'] .= "n=platform&c=platform&";
	}
	public function navigation() {
		global $_M;
		nav::set_nav(1, $_M['word']['buy_records'], $_M['url']['own_form'].'a=dorecord&anyid='.$_M['form']['anyid'].'&info_id='.$_M['form']['info_id']);
		nav::set_nav(2, $_M['word']['my_bill'], $_M['url']['own_form'].'a=dofinance&anyid='.$_M['form']['anyid'].'&info_id='.$_M['form']['info_id']);
		nav::set_nav(3, $_M['word']['smsrecharge'], "{$_M['url']['own_form']}c=member&a=dorecharge");
	}
	
	public function navigation1() {
		global $_M;
		nav::set_nav(1, $_M['word']['account_information'], $_M['url']['own_form'].'&a=doinformation&anyid='.$_M['form']['anyid']);
		nav::set_nav(2, $_M['word']['login_password_changing'], $_M['url']['own_form'].'&a=doinformation_1&anyid='.$_M['form']['anyid']);
		//nav::set_nav(3, $_M['word']['password_changing'], $_M['url']['own_form'].'&a=doinformation_2&anyid='.$_M['form']['anyid']);
	}
	
	public function doinformation() {
		global $_M;
		$this->navigation1();
		nav::select_nav(1);
		$url_sec = "{$_M['url']['own_name']}&c=member&a=doinformation";
		$url_fai = "{$_M['url']['own_name']}&c=member&a=doinformation";
		require $this->template('tem/information');
	}
	
	public function doinformation_1() {
		global $_M;
		$this->navigation1();
		nav::select_nav(2);
		$url_sec = "{$_M['url']['own_name']}&c=appstore&a=doindex";
		$url_fai = "{$_M['url']['own_name']}&c=member&a=doinformation_1";
		require $this->template('tem/information_1');
	}
	
	public function doinformation_2() {
		global $_M;
		$this->navigation1();
		nav::select_nav(3);
		$url_sec = "{$_M['url']['own_name']}&c=member&a=doinformation_2";
		$url_fai = "{$_M['url']['own_name']}&c=member&a=doinformation_2";
		require $this->template('tem/information_2');
	}
	
	
	public function dorecord() {
		global $_M;
		$this->navigation();
		nav::select_nav(1);
		if($_M['form']['search_type']) {
			$search_url = "{$_M['url']['own_form']}a=dorecord&search_type={$_M['form']['search_type']}";
		} else {
			$search_url = "{$_M['url']['own_form']}a=dorecord&search_type=4";
		}
		require $this->template('tem/record');
	}
	
	public function dofinance() {
		global $_M;
		$this->navigation();
		nav::select_nav(2);
		if($_M['form']['search_type']) {
			$search_url = "{$_M['url']['own_form']}a=dofinance&search_type={$_M['form']['search_type']}";
		} else {
			$search_url = "{$_M['url']['own_form']}a=dofinance&search_type=3";
		}
		require $this->template('tem/finance');
	}
	
	public function dorecharge() {
		global $_M;
		$this->navigation();
		nav::select_nav(3);
		if($_M['form']['return_this']){
			$_M['form']['sucurl'] = HTTP_REFERER;
		}
		$sucurl = $_M['form']['sucurl'] ? $_M['form']['sucurl'] : "{$_M['url'][own_name]}&c=appstore&a=doindex";
		//$sucurl .= "&recharge=1";
		require $this->template('tem/recharge');
	}
	
	public function dologin() {
		global $_M;
		$position = $_M['word']['landing'];
		$url_sec = "{$_M['url']['own_name']}&c=member&a=dologingo";
		$url_fai = "{$_M['url']['own_name']}&c=member&a=dologin";
		$returnurl = $_M['form']['returnurl'];
		require $this->template('tem/login');
	}
	
	public function doregister() {
		global $_M;
		$position = $_M['word']['registration'];
		$url_sec = "{$_M['url']['own_name']}&c=member&a=dologin";
		$url_fai = "{$_M['url']['own_name']}&c=member&a=doregister";
		$returnurl = $_M['form']['returnurl'];
		require $this->template('tem/register');
	}
	
	
	

	public function doverifica() {
		global $_M;
		if($_M['form']['user_id']){
			$user_id	= $_M['form']['user_id'];
			$effect=1;
		}else if($_M['form']['user_email']){
			$user_id	= $_M['form']['user_email'];
			$effect=2;
		}else{
			$user_id	= $_M['form']['user_mobile'];
			$effect=3;
		}
		$curl = load::sys_class('curl', 'new'); 
		$curl -> set('host', 'http://account.metinfo.cn/');
		$curl -> set('file', "index.php?n=register&c=register&a=doappstoreuservalid&username={$user_id}&effect={$effect}"); 
		$post = array('post' => ''); 
		$info = $curl -> curl_post($post); 
		echo $info;
	}
	
    //远程获取用户信息
	public function domenmberinfo() {
		global $_M;
		$curl = load::sys_class('curl', 'new');    
		$curl -> set('host', 'http://app.metinfo.cn/');
		$curl -> set('file', "index.php?n=platform&c=platform&a=domember_obtain&user_key={$_M[config][met_secret_key]}"); 
		$curl -> set('ignore', ture);
		$post = array('post' =>''); 
		$info = $curl -> curl_post($post); 
		$res = jsondecode($info);
		$memberinfo= array('username' =>$res['user_id'],'money' =>$res['money']);
		$memberinfo=json_encode($memberinfo);
		if($_M['config']['met_secret_key']){
			echo $memberinfo;
		}else{
			echo '';
		}	
	}
  //远程退出登录
	public function dologout() {
		global $_M;
		$curl = load::sys_class('curl', 'new');    
		$curl -> set('host', 'http://app.metinfo.cn/');
		$curl -> set('file', "index.php?n=platform&c=platform&a=dologout&user_key={$_M[config][met_secret_key]}"); 
		$curl -> set('ignore', ture);
		$post = array('post' =>''); 
		$info = $curl -> curl_post($post); 
        $query = "UPDATE {$_M['table']['config']} SET value='' WHERE name='met_secret_key' AND lang='metinfo'";
		DB::query($query);
		if($_M['form']['returnurl']){
        	header("Location:".$_M['form']['returnurl']);;
        }else{
        	turnover($_M['url']['own_name']."c=appstore&a=doindex");
        }
	}
	
	//会员退出
	public function dologinout() {
		global $_M;
		$query = "UPDATE {$_M['table']['config']} SET value='' WHERE name='met_secret_key' AND lang='metinfo'";
		DB::query($query);
		turnover($_M['url']['own_name']."c=appstore&a=doindex", $_M['word']['out_of_success']);
	}
	
	public function dologingo() {
		global $_M;
		if($_M['form']['key']){
			$query = "UPDATE {$_M['table']['config']} SET value='{$_M['form']['key']}' WHERE  name='met_secret_key' and lang = 'metinfo'";
			$result = DB::query($query);
			$returnurl= urldecode($_M['form']['returnurl']);
			if($returnurl){
				header("Location:".$returnurl);
			}
			turnover($_M['url']['own_name']."c=appstore&a=doindex");
		}
	}
}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>