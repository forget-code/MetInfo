<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.

defined('IN_MET') or exit('No permission');

load::sys_class('admin');

class admin_admin extends admin {
	public $moduleclass;
	public $module;
	public $database;
	/**
	 * 初始化
	 */

	function __construct() {
		global $_M;
		parent::__construct();
		$this->database = load::mod_class('admin/admin_database', 'new');
	}

	/**
	 * 新增内容
	 */
	public function doadd() {
		global $_M;
		$a = 'doaddsave';
		$list['admin_group'] = '3';
		$list['lang'] = load::mod_class('language/language_op', 'new')->get_lang();
		foreach ($list['lang'] as $key => $val) {
			$list['lang_check'] .= $val['mark'].'|';
		}
		$list['lang_check'] .= '#metinfo#';
		$list['admin_issueok'] = 1;
		$list['op_check'] = "metinfo|add|editor|del";
		$list['pop_check'] = 'all';
		$metinfocolumn = $this->admin_list();
		require $this->template('own/admin_add');
	}

	// function add() {
	// 	global $_M;
	// 	$list['class1'] = $_M['form']['class1'] ? $_M['form']['class1'] : 0 ;
	// 	$list['class2'] = $_M['form']['class2'] ? $_M['form']['class2'] : 0 ;
	// 	$list['class3'] = $_M['form']['class3'] ? $_M['form']['class3'] : 0 ;
	// 	$list['displaytype'] = 1;
	// 	$list['addtype'] = 1;
	// 	$list['updatetime'] = date("Y-m-d H:i:s");
	// 	$list['issue'] = get_met_cookie('metinfo_admin_name');
	// 	return $list;
	// }

	/**
	 * 添加数据保存
	 */
	public function doaddsave() {
		global $_M;
		if($this->insert_list($_M['form'])){
			turnover("{$_M[url][own_form]}a=doindex");
		}else{
			turnover("{$_M[url][own_form]}a=doindex","{$_M['word']['dataerror']}");
		}
	}

	/**
	 * 新增内容插入数据处理
	 * @param  前台提交的表单数组 $list
	 * @return $pid  新增的ID 失败返回FALSE
	 */
	public function insert_list($list){
		global $_M;
		if($this->database->get_one_by_admin_id($list['admin_id'])){
			turnover("{$_M[url][own_form]}a=doindex", "{$_M['word']['js78']}");
		}
		$alist = $this->publuc_handle($list);
		$alist['admin_id'] = $list['admin_id'];
		$alist['admin_ok'] = 1;
		$alist['usertype'] = 3;
		$alist['checkid'] = 1;
		$alist['content_type'] = 2;
		$alist['admin_pass'] = md5($list['admin_pass']);
		$pid = $this->insert_list_sql($alist);
		if($pid){
			return $pid;
		}else{
			return false;
		}
	}

	/**
	 * 插入sql
	 * @param  array   $list   插入的数组
	 * @return number  				 插入后的数据ID
	 */
	public function insert_list_sql($list){
		global $_M;
		$list['lang'] = $this->lang;
		return $this->database->insert($list);
	}

	/**
	 * 编辑文章页面
	 */
	function doeditor() {
		global $_M;
		$nowadmin = admin_information();
		$list = $this->database->get_list_one_by_id($_M['form']['id']);
		if(!$this->have_power_eidtor($nowadmin['admin_group'], $list['admin_group'])){
			turnover("{$_M[url][own_form]}a=doindex",'nopower');
		}
		//dump($list);
		$a = 'doeditorsave';
		//语言勾选
		$list['lang'] = load::mod_class('language/language_op', 'new')->get_lang();
		foreach ($list['lang'] as $key => $val) {
			$list['lang_check'] .= $val['mark'].'|';
		}
		if($list['langok'] == 'metinfo'){
			$list['lang_check'] .= '#metinfo#|';
		}else{
			$langoks = explode('-', trim($list['langok'], '-'));
			$list['lang_check'] = implode('|', $langoks);
		}
		$list['lang_check'] = trim($list['lang_check'], '|');
		//控制勾选
		$admin_ops = explode('-', trim($list['admin_op'], '-'));
		$list['op_check'] = trim(implode('|', $admin_ops), '|');

		//权限控制
		$metinfocolumn = $this->admin_list();
		if($list['admin_type'] == 'metinfo'){
			//js处理的全部选中
			$list['pop_check'] = 'all';
		}else{
			$admin_types = explode('-', trim($list['admin_type'], '-'));
			$list['pop_check'] = trim(implode('|', $admin_types), '|');
		}
		require $this->template('own/admin_add');
	}

	/**
	 * 修改保存页面
	 * @param  array   $list   插入的数组
	 * @return number  				 插入后的数据ID
	 */
	function doeditorsave() {
		global $_M;
		if($this->update_list($_M['form'],$_M['form']['id'])){
			turnover("{$_M[url][own_form]}a=doindex");
		}else{
			turnover("{$_M[url][own_form]}a=doindex","{$_M['word']['dataerror']}");
		}

	}

	/**
	 * 编辑文章页面
	 */
	function doeditor_info() {
		global $_M;
		$nowadmin = admin_information();
		if($_M['form']['id']){
			$list = $this->database->get_list_one_by_id($_M['form']['id']);
		}else{
			$list = $this->database->get_list_one_by_id($nowadmin['id']);
		}
		if($nowadmin['id'] != $list['id']){
			turnover("{$_M[url][own_form]}a=doindex",'nopower');
		}
		$a = 'doeditor_info_save';
		require $this->template('own/admin_info');
	}

	/**
	 * 编辑文章页面
	 */
	function doeditor_info_save() {
		global $_M;
		$alist['admin_name'] = $_M['form']['admin_name'];
		$admin = $this->database->get_list_one_by_id($_M['form']['id']);
        if(empty($_M['form']['admin_pass']) || $admin['admin_pass'] == md5($_M['form']['admin_pass'])){
            $alist['admin_pass'] = $admin['admin_pass'];
        }else{
            $alist['admin_pass'] = md5($_M['form']['admin_pass']);
        }
        if($this->update_list_sql($alist, $_M['form']['id'])){
            turnover("{$_M[url][own_form]}a=doindex");
		}else{
			turnover("{$_M[url][own_form]}a=doindex","{$_M['word']['dataerror']}");
		}
	}

	/**
	 * 保存修改
	 * @param  array   $list   修改的数组
	 * @return bool  				 	 修改是否成功
	 */
	public function update_list($list,$id){
		global $_M;
		$list['id'] = $id;
		$alist = $this->publuc_handle($list);
		if($this->update_list_sql($alist,$id)){
			return true;
		}else{
			return false;
		}

	}

	public function publuc_handle($list){

		$admin = $this->database->get_list_one_by_id($list['id']);
		
		//密码
		if($admin['admin_pass'] != $list['admin_pass'] && $admin['admin_pass']){
			$alist['admin_pass'] = md5($list['admin_pass']);
		}
		//名字
		$alist['admin_name'] = $list['admin_name'];
		//控制
		$alist['admin_op'] = str_replace('|', '-', $list['admin_op']);
		//管理其他管理员权限
		$alist['admin_issueok'] = $list['admin_issueok'] ? 1 : 0;
		//分组
		$alist['admin_group'] = $list['admin_group'];
		//语言
		if(strstr($list['langok'], '#metinfo#')){
			$alist['langok'] = 'metinfo';
		}else{
			$alist['langok'] = '-'.str_replace('|', '-', $list['langok']).'-';
		}
		//权限
		if(strstr($list['admin_pop_str'], '#metinfo#') && strstr($list['admin_pop_str'], 's1801') && strstr($list['admin_pop_str'], 's1802')){
			$alist['admin_type'] = 'metinfo';
		}else{
			$list['admin_pop_str'] = str_replace('#metinfo#|', '', $list['admin_pop_str']);
			$alist['admin_type'] = '-'.str_replace('|', '-', $list['admin_pop_str']).'-';
		}
		return $alist;
	}

	/**
	 * 保存修改sql
	 * @param  array   $list   修改的数组
	 * @return bool  				 	 修改是否成功
	 */
	public function update_list_sql($list,$id){
		global $_M;
		$list['id'] = $id;
		return $this->database->update_by_id($list);
	}

	/**
	 * 首页页面
	 */
	function doindex() {
		global $_M;
		require $this->template('own/admin_index');
	}

	/**
	 * 分页数据
	 */
	function dojson_list(){
		global $_M;
		if($_M['form']['keyword'])$where = " admin_id like '%{$_M['form']['keyword']}%' ";
        $order = '';
		$userlist = $this->database->table_json_list($where, $order);
		foreach($userlist as $key=>$val){
			$list = array();
			if($val['admin_group'] == 10000){
				$list[] = "";
			}else{
				$list[] = "<input name=\"id\" type=\"checkbox\" value=\"{$val[id]}\">";
			}
			$list[] = $val['admin_id'];
			$list[] = $this->get_admin_array($val['admin_group']);
			$list[] = $val['admin_name'];
			$list[] = $val['admin_login'];
			$list[] = $val['admin_modify_date'];
			$list[] = $val['admin_modify_ip'];
			$nowadmin = admin_information();
			if($nowadmin['admin_id'] == $val['admin_id']){
				$list[] = "<a href=\"{$_M[url][own_form]}a=doeditor_info&id={$val['id']}\" class=\"edit\">{$_M['word']['adminpassTitle']}</a><span class=\"line\">";
			}else{
				if($this->have_power_eidtor($nowadmin['admin_group'], $val['admin_group'])){
					$list[] = "<a href=\"{$_M[url][own_form]}a=doeditor&id={$val['id']}\" class=\"edit\">{$_M['word']['editor']}</a><span class=\"line\">";
				}else{
					$list[] = "";
				}
			}
			$rarray[] = $list;
		}
		$this->database->table_return($rarray);
	}

	function have_power_eidtor($my, $you){
		if($my == '0' || $my == '1' || $my == '2'){
			return false;
		}else{
			if($my <= $you){
				return false;
			}else{
				return true;
			}
		}
	}
	/**
	 * 分页数据
	 */
	function get_admin_array($aid){
        global $_M;
		$str = '';
		switch ($aid) {
			case 0:
                //自定义管理员
				$str = $_M['word']['managertyp5'].$_M['word']['metadmin'];
			break;
			case 1:
                //内容管理员
				$str = $_M['word']['managertyp4'];
			break;
			case 2:
				//优化推广专员
				$str = $_M['word']['managertyp3'];
			break;
			case 3:
                //管理员
				$str =  $_M['word']['metadmin'];
			break;
			case 10000:
                //创始人
				$str = $_M['word']['managertyp1'];
			break;
		}
		return $str;
	}
	/**
	 * 列表操作保存
	 */
	function dolistsave(){
		global $_M;
		$list = explode(",",$_M['form']['allid']) ;
		foreach($list as $id){
			if($id){
				switch($_M['form']['submit_type']){
					case 'del':
						$this->del_list($id,$_M['form']['recycle']);
					break;
				}
			}
		}
		turnover("{$_M[url][own_form]}a=doindex");
	}

	/*删除*/
	public function del_list($id,$recycle){
		global $_M;
		return $this->database->del_by_id($id);
	}

	/*氪管理栏目列表*/
	public function admin_list(){
		global $_M;
		$query = "select * from {$_M['table']['admin_column']} ORDER BY type ASC, list_order ASC";
		$sidebarcolumn=DB::get_all($query);
		foreach($sidebarcolumn as $key=>$val){
			//去除的数组
			if((($val[name]=='lang_indexcode')||($val[name]=='lang_indexebook')||($val[name]=='lang_indexbbs')||($val[name]=='lang_indexskinset'))&&$_M['config']['met_agents_type']>1)continue;
			if((($val[name]=='lang_webnanny')||($val[name]=='lang_smsfuc'))&&$_M['config']['met_agents_sms']==0)continue;
			if(($val[name]=='lang_dlapptips2')&&$_M['config']['met_agents_app']==0)continue;
			//信息处理
			$val['name'] = get_word($val['name']);
			if(strstr($val['info'],"lang_")){
				$val['info']=$$val['info'];
			}
			$val['field'] = 's'.$val['field'];
			$val['url'] = $val['url'] ? :$_M['url']['admin_site'].$val['url'];
			switch($val['type']){
				case 1:
					$metinfocolumn[$val['id']]['info']=$val;
				break;
				case 2:
					$metinfocolumn[$val['bigclass']]['next'][$val['field']]=$val;
				break;
				case 3:
			}
		}
		foreach ($metinfocolumn as $key => $val) {
			if($val['info']['id'] == '2'){//管理，添加内容管理
				$langs = load::mod_class('language/language_op', 'new')->get_lang();
				foreach ($langs as $langkey => $langval) {
					$module = load::mod_class('column/column_op', 'new')->get_sorting_by_module(false, $langval['mark']);
					$mlist = array();
					$mlist['info']['name'] = $langval['name'];
					$mlist['info']['field'] = $langval['mark'];
					foreach($module as $modulekey => $moduleval){
						if($modulekey >0 && $modulekey <= 9){
							foreach($moduleval['class1'] as $class1val){
								$list = array();
								$list['name'] = $class1val['name'];
								$list['field'] = 'c'.$class1val['id'];
								$list['column_lang'] = "column-lang column-lang-{$langval['mark']}";
								$list['data_lang'] = "data-lang-column=\"{$langval['mark']}\"";
								$mlist['column'][$list['field']] = $list;
							}
						}
					}
					$metinfocolumn[$key]['next2'][$langval['mark']] = $mlist;
					$list = array();
					$list['name'] = $_M['word']['admintips4'];
					$list['field'] = 's9999';
					$metinfocolumn[$key]['next']['s9999'] = $list;
				}
			}
			if($val['info']['id'] == '4'){//应用，添加应用
				$app = load::mod_class('myapp/class/getapp', 'new')->get_app();
				$mlist = array();

				foreach($app as $key => $val){
					$list = array();
					$list['name'] = $val['appname'];
					$list['field'] = 'a'.$val['no'];
					$mlist['column'][$list['field']] = $list;
				}
				$metinfocolumn[4]['next2'][] = $mlist;
			}
		}
		return $metinfocolumn;
	}

}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>
