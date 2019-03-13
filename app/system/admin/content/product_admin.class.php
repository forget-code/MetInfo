<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');

load::sys_class('admin.class.php');

class product_admin extends admin {
	public $paraclass;
	public $moduleclass;
	public $shop;
	public $module;
	function __construct() {
		global $_M;
		parent::__construct();
		$this->moduleclass = load::mod_class('content/class/sys_product', 'new');
		//
		//$this->shop = load::app_class('shop/admin/class/sys_goods', 'new');
		
		if(!$this->shop = load::plugin('doproduct_plugin_class', '99')){
			$this->shop = load::mod_class('content/class/sys_shop', 'new');
		}
		
		$this->paraclass = load::mod_class('system/class/sys_para', 'new');
		$this->module = 3;

	}
	/*获取运费模板*/
	function dorefresh_discount_list(){
		global $_M;
		$list = $this->shop->discount_list();
		$re = "<option value=\"0\">请选择</option>";
		foreach($list as $val){
			$re.= "<option value=\"{$val[id]}\">{$val[name]}</option>";
		}
		echo $re;
	}
	
	/*产品增加*/
	function doadd() {
		global $_M;
		$_M['form']['class1'] = $_M['form']['class1'] ? $_M['form']['class1'] : 0;
		$_M['form']['class2'] = $_M['form']['class2'] ? $_M['form']['class2'] : 0;
		$_M['form']['class3'] = $_M['form']['class3'] ? $_M['form']['class3'] : 0;
		$list_p['class'] = $_M['form']['class1'].'-'.$_M['form']['class2'].'-'.$_M['form']['class3'];
		$list_p['displaytype'] = 1;
		$list_p['addtype'] = 1;
		//if($_M['config']['shopv2_open'])$list = $this->shop->default_value($list);
		//
		$list_s = $this->shop->default_value($list_p);
		$list = array_merge($list_p, $list_s);
		//
		$list['class'] = $_M['form']['class1'].'-'.$_M['form']['class2'].'-'.$_M['form']['class3'];
		$list['displaytype'] = 1;
		$list['addtype'] = 1;
		$list['updatetime'] = date("Y-m-d H:i:s");
		$list['issue'] = get_met_cookie('metinfo_admin_name');
		$a = 'doaddsave';
		$class_option = $this->moduleclass->class_option($this->module);
		$access_option = $this->moduleclass->access_option('access');
		require $this->template('tem/product_add');
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
	function dopara() {
		global $_M;
		$class = explode("-",$_M['form']['class']);
		$class1 = $class[0];
		$class2 = $class[1];
		$class3 = $class[2];
		$this->paraclass->paratem($_M['form']['id'],$this->module,$class1,$class2,$class3);
	}
	function doaddsave() {
	
		global $_M;
		$_M['form']['addtime'] = $_M['form']['addtype']==2?$_M['form']['addtime']:date("Y-m-d H:i:s");
		$pid = $this->moduleclass->insert_list($_M['form']);
		if($pid){
			//if($_M['config']['shopv2_open'])$this->shop->save_product($pid,$_M['form']);
			//
			$this->shop->save_product($pid,$_M['form']);
			//
			if(1){
				turnover("./content/product/save.php?lang={$_M['lang']}&action=html");
			}else{
				turnover("{$_M[url][own_form]}a=doindex");
			}
		}else{
			turnover("{$_M[url][own_form]}a=doindex",'数据错误');
		}
		
	}
	/*产品编辑*/
	function doeditor() {
		global $_M;
		$list_p = $this->moduleclass->get_list($_M['form']['id']);
		$list_p['imgurl_all'] = $list_p['imgurl'];
		$displayimg = explode("|",$list_p['displayimg']) ;
		foreach($displayimg as $val){
			$img = explode("*",$val);
			$list_p['imgurl_all'].= '|'.$img[1];
		}
		
		$list_p['class'] = $list_p['class1'].'-'.$list_p['class2'].'-'.$list_p['class3'];
		if($list_p['classother']){
			$list_p['classother'] = str_replace("-|-",",",$list_p['classother']);
			$list_p['classother'] = str_replace("|-",",",$list_p['classother']);
			$list_p['classother'] = str_replace("-|",",",$list_p['classother']);
			$list_p['classother'] = substr($list_p['classother'], 0, -1);
		}
		$list_p['addtype'] = strtotime($list_p['addtime'])>time()?2:1;
		
		//if($_M['config']['shopv2_open'])$list_s = $this->shop->default_value($list_s);
		//

		$list_s = $this->shop->default_value($list_p);
		if($list_s){
			$list = array_merge($list_p, $list_s);
		}else{
			$list = $list_p;
		}
		//
		$list['updatetime'] = date("Y-m-d H:i:s");
		$list['issue'] = $list['issue'] ? $list['issue'] : get_met_cookie('metinfo_admin_name');
		$a = 'doeditorsave';
		$class_option = $this->moduleclass->class_option($this->module);
		$access_option = $this->moduleclass->access_option('access',$list['access']);
		require $this->template('tem/product_add');
	}
	function doeditorsave() {
	
		global $_M;
		$_M['form']['addtime'] = $_M['form']['addtype']==2?$_M['form']['addtime']:$_M['form']['addtime_l'];
		if($this->moduleclass->update_list($_M['form'],$_M['form']['id'])){
			//if($_M['config']['shopv2_open'])$this->shop->save_product($_M['form']['id'],$_M['form']);
			//
			$this->shop->save_product($_M['form']['id'],$_M['form']);
			//
			//if($_M['config']['met_webhtm'] == 2 && $_M['config']['met_htmlurl'] == 0){
			if(1){
				turnover("./content/product/save.php?lang={$_M['lang']}&action=html");
			}else{
				turnover("{$_M[url][own_form]}a=doindex");
			}
		}else{
			turnover("{$_M[url][own_form]}a=doindex",'数据错误');
		}
		
	}
	
	/*产品管理*/
	function doindex() {
		global $_M;
		$column = $this->moduleclass->column(3,$this->module);
		//$tmpname = $_M['config']['shopv2_open']?'tem/product_shop_index':'tem/product_index';
		//require $this->template($tmpname);
		//
		$tmpname = $this->shop->get_tmpname('product_shop_index');
		if($tmpname && $_M['config']['shopv2_open']==1){
			$tmpname = $this->shop->get_tmpname('product_shop_index');
			
		} else {
			$tmpname = $this->template('tem/product_index');
		}

		require $tmpname;
		//
	}
	function docolumnjson(){
		$this->moduleclass->column_json($this->module);
	}
	function dojson_list(){
		global $_M;
		//dump($_POST);
		if(!$this->shop->plgin_json_list()){
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
			
			$ps = '';
			
			$where = $class1&&$class1!='所有栏目'&&$class1!='null'?"and {$ps}class1 = '{$class1}'":'';  
			$where.= $class2&&$class2!='null'?"and {$ps}class2 = '{$class2}'":'';  
			$where.= $class3&&$class3!='null'?"and {$ps}class3 = '{$class3}'":''; 
			$where.= $keyword?"and {$ps}title like '%{$keyword}%'":''; 
			switch($search_type){
				case 0:break;
				case 1:
					$where.= "and {$ps}displaytype = '0'"; 
				break;
				case 2:
					$where.= "and {$ps}com_ok = '1'"; 
				break;
			}	
			$admininfo = admin_information();			
			if($admininfo[admin_issueok] == 1)$where.= "and issue = '{$admininfo[admin_id]}'";
			$met_class = $this->moduleclass->column(2,$this->module);
			$order = $this->moduleclass->list_order($met_class[$classnow]['list_order']);
			if($orderby_hits)$order = "{$ps}hits {$orderby_hits}";
			if($orderby_updatetime)$order = "{$ps}updatetime {$orderby_updatetime}";
					
			$userlist = $this->moduleclass->json_list($where, $order);
			
			foreach($userlist as $key=>$val){
				$val['url']   = $this->moduleclass->url($val,$this->module);
				$val['state'] = $val['displaytype']?'':'<span class="label label-default">前台隐藏</span>';
				if(!$val['state'])$val['state'] = strtotime($val['addtime'])>time()?'<span class="label label-default">定时发布</span>':'';
				$val['state'].= $val['com_ok']?'<span class="label label-info" style="margin-left:8px;">推荐</span>':'';
				$val['state'].= $val['top_ok']?'<span class="label label-success" style="margin-left:8px;">置顶</span>':'';
				$list = array();
				$list[] = "<input name=\"id\" type=\"checkbox\" value=\"{$val[id]}\">";
				$list[] = "
					<div class=\"media\">
					  <div class=\"media-left\">
						<a href=\"{$val['imgurls']}\">
						  <img class=\"media-object\" src=\"{$val['imgurls']}\" width=\"60\">
						</a>
					  </div>
					  <div class=\"media-body ui-table-a\">
						<a href=\"{$val['url']}\" title=\"{$val['title']}\" target=\"_blank\">{$val['title']}</a>
						{$val['price_html']}
					  </div>
					</div>
				";
				$list[] = $val['hits'];
				$list[] = $val['updatetime'];
				$list[] = $val['state'];
				$list[] = "<input name=\"no_order-{$val['id']}\" type=\"text\" class=\"ui-input text-center\" value=\"{$val[no_order]}\">";
				$list[] = "<a href=\"{$_M[url][own_form]}a=doeditor&id={$val['id']}&select_class1={$_M['form']['select_class1']}&select_class2={$_M['form']['select_class2']}&select_class3={$_M['form']['select_class3']}\" class=\"edit\">编辑</a><span class=\"line\">-</span><a href=\"{$_M[url][own_form]}a=dolistsave&submit_type=del&allid={$val['id']}\" data-toggle=\"popover\" class=\"delet\">删除</a>
				";
				$rarray[] = $list;
			}
			$this->moduleclass->json_return($rarray);	
		}
	
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
						if($_M['form']['recycle']==0)$this->shop->del_product($id);
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
						//开启在线订购时
						//if($_M['config']['0'])$this->shop->copy_product($id,$newid);
						//
						$this->shop->copy_product($id,$newid);
						//
					break;
				}
			}
		}
		if($_M['config']['met_webhtm'] == 2 && $_M['config']['met_htmlurl'] == 0){
			turnover("./content/product/save.php?lang={$_M['lang']}&action=html");
		}else{
			turnover("{$_M[url][own_form]}a=doindex");
		}
	}
	
	/*产品参数设置*/
	function doparaset() {
		global $_M;
		require $this->template('tem/product_para');
	}
	public function doparasave(){
		global $_M;
		$this->paraclass->table_para($_M['form'],$this->module);
		turnover("{$_M[url][own_form]}a=doparaset");
	}
	function dojson_para_list(){
		global $_M;
		$order = "no_order";
		$where = '';
		$paralist = $this->paraclass->json_para_list($where, $order, $this->module);
		foreach($paralist as $key=>$val){
			$val['value'] = $val['class1'].'-'.$val['class2'].'-'.$val['class3'];
			$list = array();
			$list[] = $val['id_html'];
			$list[] = $val['name_html'];
			$list[] = $val['paratype_html'];
			$list[] = "<select name=\"class-{$val[id]}\" data-checked=\"{$val['value']}\"><option value=\"0-0-0\">所有栏目</option>".$this->moduleclass->class_option($this->module).'</select>';
			$list[] = $this->moduleclass->access_option("access-{$val[id]}",$val['access']);
			$list[] = $val['no_order_html'];
			$list[] = $val['options_html'];
			$rarray[] = $list;
		}
		$this->paraclass->json_return($rarray);
	}
	public function doparaaddlist(){
		global $_M;
		$id = 'new-'.$_M['form']['ai'];
		$para_type = $this->paraclass->para_type($id);
		$access_option = $this->moduleclass->access_option("access-{$id}");
		$class_option = "<select name=\"class-{$id}\" data-checked=\"0-0-0\"><option value=\"0-0-0\">所有栏目</option>".$this->moduleclass->class_option($this->module).'</select>';
		$metinfo ="<tr class=\"even newlist\">
					<td class=\"met-center\"><input name=\"id\" type=\"checkbox\" value=\"{$id}\" checked></td>
					<td><input type=\"text\" name=\"name-{$id}\" class=\"ui-input listname\" value=\"\" placeholder=\"名称\"></td>
					<td class=\"met-center\">{$para_type}</td>
					<td class=\"met-center\">{$class_option}</td>
					<td class=\"met-center\">{$access_option}</td>
					<td class=\"met-center\"><input type=\"text\" name=\"no_order-{$id}\" class=\"ui-input met-center\" value=\"\"></td>
					<td><button type=\"button\" class=\"btn btn-info none paraoption\" data-id=\"{$id}\">设置选项</button><input name=\"options-{$id}\" type=\"hidden\" value=\"\"></td>
				</tr>"; 
		echo $metinfo;
	}
	
}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>