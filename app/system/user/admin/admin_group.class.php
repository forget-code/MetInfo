<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');

load::sys_class('admin');

class admin_group extends admin {
	public $userclass;
	public $groupclass;
	public function __construct() {
		parent::__construct();
		global $_M;
		nav::set_nav(1,$_M[word][memberist], $_M['url']['own_name'].'c=admin_user&a=doindex');
		nav::set_nav(2, $_M[word][membergroup], $_M['url']['own_name'].'c=admin_group&a=doindex');
		//nav::set_nav(3, $_M[word][memberattribute], $_M['url']['own_name'].'c=admin_set&a=douserfield');
		nav::set_nav(3, $_M[word][memberattribute], $_M[url][adminurl]."anyid=73&n=parameter&c=parameter_admin&a=doparaset&module=10");
		nav::set_nav(4,  $_M[word][memberfunc], $_M['url']['own_name'].'c=admin_set&a=doindex');
		nav::set_nav(5, $_M[word][thirdlogin], $_M['url']['own_name'].'c=admin_set&a=doopen');
		nav::set_nav(6, $_M[word][mailcontentsetting], $_M['url']['own_name'].'c=admin_set&a=doemailset');
		// nav::set_nav(7, $_M[word][paygroup], $_M['url']['own_name'].'c=admin_group&a=do_pay_group');
		$this->userclass = load::mod_class('user/sys_user', 'new');
		$this->groupclass = load::mod_class('user/sys_group', 'new');

	}
	public function dojson_group_list(){
		$this->groupclass->json_group_list();
	}
	public function doaddlist(){
		global $_M;
		$id = 'new-'.$_M['form']['ai'];
        if($_M['config']['payment_open']){
		$metinfo ="<tr class=\"even newlist\">
					<td class=\"met-center\"><input name=\"id\" type=\"checkbox\" value=\"{$id}\" checked></td>
					<td><input type=\"text\" name=\"name-{$id}\" class=\"ui-input listname\" value=\"\" placeholder=\"{$_M[word][membergroupname]}\"></td>
					<td>
					<input type='checkbox' name='rechargeok-{$id}' class='set-price-ok' id='rechargeok-{$id}' value='1'>
					<label for='rechargeok-{$id}' style='font-weight: normal;margin-bottom: 0;'>{$_M['word']['usegroupauto1']}</label>
					<input type=\"text\" name=\"recharge_price-{$id}\" class=\"ui-input\" value=\"\">
					</td>
                    <td>
                    <input type='checkbox' name='buyok-{$id}' class='set-price-ok' id='buyok-{$id}' value='1'>
                    <label for='buybale-{$id}' style='font-weight: normal;margin-bottom: 0;'>".$_M['word']['sys_group_bayable']."</label>
                    <input type='text' name='group_pricr-{$id}' placeholder='".$_M['word']['sys_group_set_price']."' value='' class='ui-input' style='width: 60%;'>
                    </td>
                    <td><input type='text' name='access-{$id}' data-required='1' class='ui-input met-center' value=''></td>
				</tr>";
        }else{
            $metinfo ="<tr class=\"even newlist\">
					<td class=\"met-center\"><input name=\"id\" type=\"checkbox\" value=\"{$id}\" checked></td>
					<td><input type=\"text\" name=\"name-{$id}\" class=\"ui-input listname\" value=\"\" placeholder=\"{$_M[word][membergroupname]}\"></td>
					<td>
					{$_M['word']['useinfopay']}
					</td>
                    <td>
                    {$_M['word']['useinfopay']}
                    </td>
                    <td><input type='text' name='access-{$id}' data-required='1' class='ui-input met-center' value=''></td>
				</tr>";
        }
		echo $metinfo;
	}
	public function doindex(){
		global $_M;
		nav::select_nav(2);
		$_M['url']['help_tutorials_helpid']='118#'.$_M[word][user_tips31_v6];
		require_once $this->template('tem/user_group');
	}
	public function dosave(){
		global $_M;
		$this->groupclass->save_group($_M['form']['allid'],$_M['form']['submit_type']);
		turnover("{$_M[url][own_form]}a=doindex");
	}

}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>