<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.

defined('IN_MET') or exit('No permission');

/**
 * 会员url类
 */
class user_url {
	/**
	  * 重写web类的load_url_unique方法，获取前台特有URL
	  */
	public function insert_m() {
		global $_M;
		$_M['url']['own_tem'] = $_M['url']['site'].'app/system/user/web/templates/met/';
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
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>
