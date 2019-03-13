<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');

class valid {	
	
	public function get_email($email,$type = 'register'){
		global $_M;
		//生成加密字符串
		$auth = load::sys_class('auth', 'new');
		$p = urlencode($auth->encode($email,'',3600));
		//发邮件
		$jmail = load::sys_class('jmail', 'new');
		$touser = $email;
		$typetxt = '注册验证';
		$url = $_M['url']['valid_email'];
		if($type=='getpassword'){
			$typetxt = ' 密码找回';
			$url = $_M['url']['password_valid'];
		}
		if($type=='emailedit'){
			$typetxt = ' 修改绑定邮箱';
			$url = $_M['url']['mailedit'];
		}
		if($type=='emailadd'){
			$typetxt = ' 绑定邮箱';
			$url = $_M['url']['profile_safety_emailadd'];
		}
		$title = $_M['config']['met_webname'].' 会员中心 '.$typetxt;
		$body = "
<div style=\"width:500px;margin:20px auto;\">
	<div class=\"header clearfix\" style=\"font-family: 'lucida Grande', Verdana, 'Microsoft YaHei'; line-height: 23.7999992370605px; background-color: rgb(255, 255, 255);\">
		<a href=\"{$_M['url']['site']}\"><b style=\"outline: none; cursor: pointer; color: rgb(30, 84, 148);\">{$_M['config']['met_webname']} 会员中心</b></a></div>
	<p>
		&nbsp;</p>
	<div class=\"content\" style=\"font-family: 'lucida Grande', Verdana, 'Microsoft YaHei'; line-height: 23.7999992370605px; border: 1px solid rgb(233, 233, 233); margin: 2px 0px 0px; padding: 30px; background: none 0px 0px repeat scroll rgb(255, 255, 255);\">
		<p style=\"line-height: 23.7999992370605px;\">
			您好：</p>
		<p style=\"line-height: 23.7999992370605px;\">
			这是您在 {$_M['config']['met_webname']} 会员中心 上的重要邮件, 功能是进行&nbsp;会员中心&nbsp;{$typetxt}, 请点击下面的连接完成验证</p>
		<p style=\"line-height: 23.7999992370605px; border-top-width: 1px; border-top-style: solid; border-top-color: rgb(221, 221, 221); margin-top: 15px; margin-bottom: 25px; padding: 15px;\">
			请点击链接继续：{$url}&p={$p}</p>
		<p style=\"line-height: 23.7999992370605px;\">
			&nbsp;</p>
		<p class=\"footer\" style=\"line-height: 23.7999992370605px; border-top-width: 1px; border-top-style: solid; border-top-color: rgb(221, 221, 221); padding-top: 6px; margin-top: 25px; color: rgb(131, 131, 131);\">
			请勿回复本邮件, 此邮箱未受监控, 您不会得到任何回复。<br />
			<br />
			<a href=\"{$_M['url']['site']}\"><b style=\"outline: none; cursor: pointer; color: rgb(30, 84, 148);\">{$_M['config']['met_webname']} 会员中心</b></a></p>
	</div>
</div>
		";
		return $jmail->send_email($touser, $title, $body);
	}
	
	public function get_tel($tel){
		global $_M;
		
		$session = load::sys_class('session', 'new');
		if($session->get("phonetime")&&time()<($session->get("phonetime")-220)){
			return false;
			die;
		}
		
		$code = random(6, 1);
		$time = time()+300;
		$session->set("phonecode",$code);
		$session->set("phonetime",$time);
		$session->set("phonetel",$tel);
		
		$sms = load::sys_class('sms', 'new');
		$ret = $sms->sendsms($tel, "验证码为 {$code} ，请及时输入验证。({$_M['config']['met_webname']})");
		return $ret;
		
	}
}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>