<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');

load::sys_class('admin');

class admin_set extends admin {
	public $paraclass;
	public function __construct() {
		parent::__construct();
		global $_M;
		nav::set_nav(1,$_M[word][memberist], $_M['url']['own_name'].'c=admin_user&a=doindex');
		nav::set_nav(2, $_M[word][membergroup], $_M['url']['own_name'].'c=admin_group&a=doindex');
		//nav::set_nav(3, $_M[word][memberattribute], $_M['url']['own_name'].'c=admin_set&a=douserfield');
		nav::set_nav(3, $_M[word][memberattribute], $_M[url][adminurl]."anyid=73&n=parameter&c=parameter_admin&a=doparaset&module=10");
		nav::set_nav(4, $_M[word][memberfunc], $_M['url']['own_name'].'c=admin_set&a=doindex');
		nav::set_nav(5, $_M[word][thirdlogin], $_M['url']['own_name'].'c=admin_set&a=doopen');
		nav::set_nav(6, $_M[word][mailcontentsetting], $_M['url']['own_name'].'c=admin_set&a=doemailset');
        // nav::set_nav(7, $_M[word][paygroup], $_M['url']['own_name'].'c=admin_group&a=do_pay_group');
		$this->paraclass = load::mod_class('system/class/sys_para', 'new');
		
	}
	public function doindex(){
		global $_M;
		nav::select_nav(4);
		$_M['url']['help_tutorials_helpid']='118#'.$_M[word][memberlogin];

        //查询实名认证可用条数
        $idvalid = load::mod_class('user/include/class/user_idvalid.class.php', 'new');
        $result = $idvalid->checkNumber();

        $number = 0;
        if($result['status']==200){
            if((int)$result['msg']===0){
                $disabled = "disabled";
                $_M['config']['met_member_idvalidate'] = 0;
                $number = 0;
            }else{
                $number = (int)$result['msg'];
            }
        }else{
            $disabled = "disabled";
        }

        require_once $this->template('tem/user_set');
	}
	public function doregsetsave(){
		global $_M;
		$configlist = array();
		$configlist[] = 'met_member_register';
		$configlist[] = 'met_member_vecan';
		$configlist[] = 'met_member_bgcolor';
		$configlist[] = 'met_member_force';
		$configlist[] = 'met_member_bgimage';
        $configlist[] = 'met_member_idvalidate';
        configsave($configlist);
		turnover("{$_M[url][own_form]}a=doindex");
	}
	public function dojson_para_list(){
		global $_M;
		$order = "no_order";
		$where = '';
		$paralist = $this->paraclass->json_para_list($where, $order, 10);
		foreach($paralist as $key=>$val){
			$list = array();
			$list[] = $val['id_html'];
			$list[] = $val['no_order_html'];
			$list[] = $val['name_html'];
			$list[] = $val['paratype_html'];
			$list[] = $val['wr_oks_html'];
			$list[] = $val['wr_ok_html'];
			$list[] = $val['description_html'];
			$list[] = $val['options_html'];
			$rarray[] = $list;
		}
		
		$this->paraclass->json_return($rarray);
	}
	public function doparasave(){
		global $_M;
		$this->paraclass->table_para($_M['form'],10);
		turnover("{$_M[url][own_form]}a=douserfield");
	}
	public function doparaaddlist(){
		global $_M;
		$id = 'new-'.$_M['form']['ai'];
		$metinfo ="<tr class=\"even newlist\">
					<td class=\"met-center\"><input name=\"id\" type=\"checkbox\" value=\"{$id}\" checked></td>
					<td class=\"met-center\"><input type=\"text\" name=\"no_order-{$id}\" class=\"ui-input met-center\" value=\"\" placeholder=\"{$_M[word][sort]}\"></td>
					<td><input type=\"text\" name=\"name-{$id}\" class=\"ui-input listname\" value=\"\" placeholder=\"{$_M[word][paraname]}\"></td>
					<td class=\"met-center\">";
		$metinfo.=$this->paraclass->para_type($id);
		$metinfo.="</td>
					<td class=\"met-center\"><input name=\"wr_oks-{$id}\" type=\"checkbox\" value=\"1\"></td>
					<td class=\"met-center\"><input name=\"wr_ok-{$id}\" type=\"checkbox\" value=\"1\"></td>
					<td><input type=\"text\" name=\"description-{$id}\" class=\"ui-input\" value=\"\"></td>
					<td><button type=\"button\" class=\"btn btn-info none paraoption\" data-id=\"{$id}\">{$_M[word][listTitle]}</button><input name=\"options-{$id}\" type=\"hidden\" value=\"\"></td>
				</tr>"; 
		echo $metinfo;
	}
	public function douserfield(){
		global $_M;
		nav::select_nav(3);
		require_once $this->template('tem/user_field');
	}
	public function doopen(){
		global $_M;
		nav::select_nav(5);
		$_M['url']['help_tutorials_helpid']='118#'.$_M[word][thirdlogin];
		require_once $this->template('tem/open');
	}
	public function doopensave(){
		global $_M;
		$configlist = array();
		$configlist[] = 'met_weixin_appid';
		$configlist[] = 'met_weixin_appsecret';
		$configlist[] = 'met_weixin_gz_appid';
		$configlist[] = 'met_weixin_gz_appsecret';
		$configlist[] = 'met_weibo_appkey';
		$configlist[] = 'met_weibo_appsecret';
		$configlist[] = 'met_qq_appid';
		$configlist[] = 'met_qq_appsecret';
		$configlist[] = 'met_weixin_open';
		$configlist[] = 'met_weibo_open';
		$configlist[] = 'met_qq_open';
		configsave($configlist);
		turnover("{$_M[url][own_form]}a=doopen");
	}
	
	public function doemailset(){
		global $_M;
		nav::select_nav(6);
		$_M['url']['help_tutorials_helpid']='118#'.$_M[word][user_tips32_v6];
		require_once $this->template('tem/email');
	
	}
	
	public function doemailsetsave(){
		global $_M;
		$configlist = array();
		$configlist[] = 'met_member_email_reg_title';
		$configlist[] = 'met_member_email_reg_content';
		
		$configlist[] = 'met_member_email_password_title';
		$configlist[] = 'met_member_email_password_content';
			
		$configlist[] = 'met_member_email_safety_title';
		$configlist[] = 'met_member_email_safety_content';

		configsave($configlist);
		turnover("{$_M[url][own_form]}a=doemailset");
	
	}

    public function dorecharge(){
        global $_M;
        $this->geridvalid_key();
        nav::select_nav(4);
        //查询实名认证可用条数
        $idvalid = load::mod_class('user/include/class/user_idvalid.class.php', 'new');
        $number = $idvalid->checkNumber();
        if((int)$number['msg']===0){
            $number = 0;
        }else{
            $number = (int)$number['msg'];
        }

        $balance = $idvalid->checkBalance();
        if((int)$balance['msg']===0){
            $balance = 0;
        }else{
            $balance = (int)$balance['msg'];
        }

        #$package = array(10 => 1000, 50 => 5000, 100 => 10000);
        $package = $idvalid->getpackage();
        $package = $package['msg'];

        require_once $this->template('tem/recharge');
    }

    public function doBuyRecharge(){
        global $_M;
        if (!$_M['config']['met_secret_key']) {
            $this->ajax_return($_M['word']['please_again'],213);
            die();
        }
        $idvalid = load::mod_class('user/include/class/user_idvalid.class.php', 'new');
        $result = $idvalid->buy();
        if($result['status']==200){
            $this->insertidvalid_key($result['msg']);
            $this->ajax_return($_M['word']['jsok'], $result['status']);
        }else{
            $this->ajax_return($result['msg'], $result['status']);
            die();
        }
    }

    public function geridvalid_key()
    {
        global $_M;
        if (!$_M['config']['met_secret_key']) {
            $shoplogin = $_M['url']['site_admin']."index.php?lang={$_M['lang']}&n=appstore&c=member&a=dologin";
            okinfo($shoplogin, $_M['word']['please_again']);
            die();
        }
        $idvalid = load::mod_class('user/include/class/user_idvalid.class.php', 'new');
        $result = $idvalid->getexpresskey();
        if ($result['status']==214) {
            $this->insertidvalid_key($result['msg']['express_key']);
        }
    }

    public function insertidvalid_key($express_key)
    {
        global $_M;
        $query = "update {$_M['table']['config']} SET value = '{$express_key}' WHERE name = 'met_idvalid_key' and (lang='{$_M['lang']}' or lang='metinfo')";
        DB::query($query);

    }

    public function ajax_return($msg,$status){
        $data = array();
        $data['msg']    = $msg;
        $data['status'] = $status;
        echo json_encode($data,JSON_UNESCAPED_UNICODE);
        die;
    }
	
}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>