<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');

load::sys_class('admin.class.php');

class article_admin extends admin {
	public $moduleclass;
	public $module;
	function __construct() {
		global $_M;
		parent::__construct();
		$this->moduleclass = load::mod_class('content/class/sys_article', 'new');
		$this->module = 2;
	}
	function doadd() {
		global $_M;
		
		$list['class1'] = $_M['form']['class1'];
		$list['class2'] = $_M['form']['class2'];
		$list['class3'] = $_M['form']['class3'];
		$list['displaytype'] = 1;
		$list['addtype'] = 1;
		$list['updatetime'] = date("Y-m-d H:i:s");
		$list['issue'] = get_met_cookie('metinfo_admin_name');
		$a = 'doaddsave';
		$access_option = $this->moduleclass->access_option('access');
		require $this->template('tem/article_add');
	}
	function docheck_filename() {
		global $_M;
		if(!$this->moduleclass->check_filename($_M['form']['filename'],$_M['form']['id'],$this->module)){
			$errorno = $this->moduleclass->errorno=='error_filename_cha'?'仅支持中文、大小写字母、数字、下划线':'静态页面名称已被使用';
			echo '0|'.$errorno;
		}else{
			echo '1|名称可用';
		}
	}
	
	function doaddsave() {
	
		global $_M;
		$_M['form']['addtime'] = $_M['form']['addtype']==2?$_M['form']['addtime']:date("Y-m-d H:i:s");
		if($this->moduleclass->insert_list($_M['form'])){
			if(1){
				turnover("./content/article/save.php?lang={$_M['lang']}&action=html&select_class1={$_M['form']['select_class1']}&select_class2={$_M['form']['select_class2']}&select_class3={$_M['form']['select_class3']}");
			}else{
				turnover("{$_M[url][own_form]}a=doindex");
			}
		}else{
			turnover("{$_M[url][own_form]}a=doindex",'数据错误');
		}
		
	}
	
	function doeditor() {
		global $_M;
		$list = $this->moduleclass->get_list($_M['form']['id']);
		$list['addtype'] = strtotime($list['addtime'])>time()?2:1;
		$list['updatetime'] = date("Y-m-d H:i:s");
		$list['issue'] = $list['issue'] ? $list['issue'] : get_met_cookie('metinfo_admin_name');
		$a = 'doeditorsave';
		$access_option = $this->moduleclass->access_option('access',$list['access']);
		require $this->template('tem/article_add');
	}
	function doeditorsave() {
		global $_M;
		$_M['form']['addtime'] = $_M['form']['addtype']==2?$_M['form']['addtime']:date("Y-m-d H:i:s");
		if($this->moduleclass->update_list($_M['form'],$_M['form']['id'])){
			//if($_M['config']['met_webhtm'] == 2 && $_M['config']['met_htmlurl'] == 0){
			if(1){
				turnover("./content/article/save.php?lang={$_M['lang']}&action=html&select_class1={$_M['form']['select_class1']}&select_class2={$_M['form']['select_class2']}&select_class3={$_M['form']['select_class3']}");
			}else{
				turnover("{$_M[url][own_form]}a=doindex");
			}
		}else{
			turnover("{$_M[url][own_form]}a=doindex",'数据错误');
		}
		
	}
	
	function doindex() {
		global $_M;
		$column = $this->moduleclass->column(3,$this->module);
		require $this->template('tem/article_index');
	}
	function docolumnjson(){
		global $_M;
		$this->moduleclass->column_json($this->module,$_M['form']['type']);
	}
	function dojson_list(){
		global $_M;
		if($_M['form']['class1_select']=='null'&&$_M['form']['class2_select']=='null'&&$_M['form']['class3_select']=='null'){
			$class1 = $_M['form']['class1'];
			$class2 = $_M['form']['class2'];
			$class3 = $_M['form']['class3'];
		}else{
			$class1 = $_M['form']['class1_select'];
			$class2 = $_M['form']['class2_select'];
			$class3 = $_M['form']['class3_select'];
		}
		$class1 = $class1 == ' ' ? 'null' : $class1;
		$class2 = $class2 == ' ' ? 'null' : $class2;
		$class3 = $class3 == ' ' ? 'null' : $class3;
		$keyword = $_M['form']['keyword'];
		$search_type = $_M['form']['search_type'];
		$orderby_hits = $_M['form']['orderby_hits'];
		$orderby_updatetime = $_M['form']['orderby_updatetime'];
		
		$where = $class1&&$class1!='所有栏目'&&$class1!='null'?"and class1 = '{$class1}'":'';  
		$where.= $class2&&$class2!='null'?"and class2 = '{$class2}'":'';  
		$where.= $class3&&$class3!='null'?"and class3 = '{$class3}'":''; 
		$where.= $keyword?"and title like '%{$keyword}%'":''; 
		switch($search_type){
			case 0:break;
			case 1:
				$where.= "and displaytype = '0'"; 
			break;
			case 2:
				$where.= "and com_ok = '1'"; 
			break;
		}		
		$admininfo = admin_information();			
		if($admininfo[admin_issueok] == 1)$where.= "and issue = '{$admininfo[admin_id]}'";
		$met_class = $this->moduleclass->column(2,$this->module);
		$order = $this->moduleclass->list_order($met_class[$classnow]['list_order']);
		if($orderby_hits)$order = "hits {$orderby_hits}";
		if($orderby_updatetime)$order = "updatetime {$orderby_updatetime}";
		
		$userlist = $this->moduleclass->json_list($where, $order);
		
		foreach($userlist as $key=>$val){
		
			$val['url']   = $this->moduleclass->url($val,$this->module);
			$val['state'] = $val['displaytype']?'':'<span class="label label-default">前台隐藏</span>';
			if(!$val['state'])$val['state'] = strtotime($val['addtime'])>time()?'<span class="label label-default">定时发布</span>':'';
			$val['state'].= $val['com_ok']?'<span class="label label-info" style="margin-left:8px;">推荐</span>':'';
			$val['state'].= $val['top_ok']?'<span class="label label-success" style="margin-left:8px;">置顶</span>':'';
			$list = array();
			$list[] = "<input name=\"id\" type=\"checkbox\" value=\"{$val[id]}\">";
			$list[] = "<div class=\"ui-table-a\"><a title=\"{$val['title']}\" href=\"{$val['url']}\" target=\"_blank\">{$val['title']}</a></div>";
			$list[] = $val['hits'];
			$list[] = $val['updatetime'];
			$list[] = $val['state'];
			$list[] = "<input name=\"no_order-{$val['id']}\" type=\"text\" class=\"ui-input text-center\" value=\"{$val[no_order]}\">";
			$list[] = "<a href=\"{$_M[url][own_form]}a=doeditor&id={$val['id']}&select_class1={$class1}&select_class2={$class2}&select_class3={$class3}\" class=\"edit\">编辑</a><span class=\"line\">-</span><a href=\"{$_M[url][own_form]}a=dolistsave&submit_type=del&allid={$val['id']}\" data-toggle=\"popover\" class=\"delet\">删除</a>
			";
			$rarray[] = $list;
		}
		
		$this->moduleclass->json_return($rarray);
		
	}
	function dolistsave(){
		global $_M;
		$list = explode(",",$_M['form']['allid']) ;
		foreach($list as $id){
			if($id){
				switch($_M['form']['submit_type']){
					case 'save':
						$list['no_order'] 	 = $_M['form']['no_order-'.$id];
						$this->moduleclass->list_no_order($id,$list['no_order']);
					break;
					case 'del':
						$this->moduleclass->del_list($id,$_M['form']['recycle']);
					break;
					case 'comok':
						$this->moduleclass->list_com($id,1);
					break;
					case 'comno':
						$this->moduleclass->list_com($id,0);
					break;
					case 'topok':
						$this->moduleclass->list_top($id,1);
					break;
					case 'topno':
						$this->moduleclass->list_top($id,0);
					break;
					case 'displayok':
						$this->moduleclass->list_display($id,1);
					break;
					case 'displayno':
						$this->moduleclass->list_display($id,0);
					break;
					case 'move':
						$class = explode("-",$_M['form']['columnid']);
						$class1 = $class[0];
						$class2 = $class[1];
						$class3 = $class[2];
						$this->moduleclass->list_move($id,$class1,$class2,$class3);
					break;
					case 'copy':
						$class = explode("-",$_M['form']['columnid']);
						$class1 = $class[0];
						$class2 = $class[1];
						$class3 = $class[2];
						$newid = $this->moduleclass->list_copy($id,$class1,$class2,$class3);
					break;
				}
			}
		}
		if($_M['config']['met_webhtm'] == 2 && $_M['config']['met_htmlurl'] == 0){
			turnover("./content/article/save.php?lang={$_M['lang']}&action=html");
		}else{
			turnover("{$_M[url][own_form]}a=doindex");
		}
		
	}
}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>