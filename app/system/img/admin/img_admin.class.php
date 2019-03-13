<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.

defined('IN_MET') or exit('No permission');

load::mod_class('news/admin/news_admin');

class img_admin extends news_admin {
	public $paraclass;
	public $moduleclass;
	public $shop;
	public $module;
	function __construct() {
		global $_M;
		parent::__construct();
		//$this->moduleclass = load::mod_class('content/class/sys_product', 'new');
		//
		//$this->shop = load::app_class('shop/admin/class/sys_goods', 'new');

		// if(!$this->shop = load::plugin('doproduct_plugin_class', '99')){
		// 	$this->shop = load::mod_class('content/class/sys_shop', 'new');
		// }

		//$this->paraclass = load::mod_class('system/class/sys_para', 'new');
		$this->paraclass = load::mod_class('parameter/parameter_op','new');
		$this->para = load::mod_class('parameter/parameter_list','new');
		$this->module = 5;
		$this->database = load::mod_class('img/img_database', 'new');

	}
	/*获取运费模板*/
	function dorefresh_discount_list(){
		global $_M;
		$list = $this->shop->discount_list();
        $re = "<option value=\"0\">{$_M[word][skinerr3]}</option>";
		foreach($list as $val){
			$re.= "<option value=\"{$val[id]}\">{$val[name]}</option>";
		}
		echo $re;
	}

	/*产品增加*/
	function doadd() {
		global $_M;
		$list = $this->add();
		$list[class1]=$_M[form][class1_select];
		$list[class2]=$_M[form][class2_select];
		$list[class3]=$_M[form][class3_select];
		$list['class'] = $list['class1'].'-'.$list['class2'].'-'.$list['class3'];
		//$list = $this->shop->default_value($list);
		$a = 'doaddsave';
		$turnurl="&class1={$list[class1]}&class2={$list[class2]}&class3={$list[class3]}";
		$class_option = $this->class_option($this->module);
		$access_option = $this->access_option('access');
		$_M['url']['help_tutorials_helpid']='98';
		require $this->template('own/product_add');
	}

	function doaddsave() {
		global $_M;

		//dump($_M['form']);
		// exit;
		$_M['form']['addtime'] = $_M['form']['addtype']==2?$_M['form']['addtime']:date("Y-m-d H:i:s");
		$pid = $this->insert_list($_M['form']);
		if($pid){
			//if($_M['config']['shopv2_open'])$this->shop->save_product($pid,$_M['form']);
			//
			//$this->shop->save_product($pid,$_M['form']);
			//
     	$url="{$_M[url][own_form]}a=doindex{$_M[form][turnurl]}";
			load::mod_class('html/html_op', 'new')->html_generate($url,$_M['form']['class1_select'],$pid);
		}else{
			turnover("{$_M[url][own_form]}a=doindex",$_M[word][dataerror]);
		}
	}

	public function insert_list($list){
		global $_M;
		//$list = $this->form_classlist($list);
		//dump($list);
		if($list['imgurl'])$list = $this->form_imglist($list,$this->module);
		//$list['updatetime'] = date("Y-m-d H:i:s");
		$list['addtime']    = $list['addtime']?$list['addtime']:$list['updatetime'];
		$pid = $this->insert_list_sql($list);
		if($pid){
			// $this->paraclass->get_para($pid,3,$list['class1'],$list['class2'],$list['class3']);
			// $info = $this->paraclass->form_para($list,3,$list['class1'],$list['class2'],$list['class3']);
			// $this->paraclass->update_para($pid,$info,3);
			 $this->paraclass->insert($pid, $this->module, $_M['form']);
			return $pid;
		}else{
			return false;
		}
	}

	public function insert_list_sql($list){
		global $_M;
		if(!$list['title']){
			return false;
		}
		if(!$this->check_filename($list['filename'],'',$this->module)){
			return false;
		}
		if($list['links']){
			$list['links'] = url_standard($list['links']);
		}
		if(!$list['description'])$list['description'] = $this->description($list['content']);
		//$list[description]=str_replace('&nbsp;','',$list[description]);
		//$list[description]=str_replace(' ','',$list[description]);
		$titlenum =substr_count($list['title'],"\'");
		if(!$titlenum){
			 $list['title']=str_replace("'", "\'",$list['title']);
					$list['description']=str_replace("'", "\'",$list['description']);
		}


		// 增加展示图片尺寸属性imgsize（新模板框架v2）
		// $query = "INSERT INTO {$this->tablename} SET
		// 	title              = '{$list['title']}',
		// 	ctitle             = '{$list['ctitle']}',
		// 	keywords           = '{$list['keywords']}',
		// 	description        = '{$list['description']}',
		// 	content            = '{$list['content']}',
		// 	class1             = '{$list['class1']}',
		// 	class2             = '{$list['class2']}',
		// 	class3             = '{$list['class3']}',
		// 	classother         = '{$list['classother']}',
		// 	new_ok             = '{$list['new_ok']}',
		// 	imgurl             = '{$list['imgurl']}',
		// 	imgsize            = '{$list['imgsize']}',
		// 	imgurls            = '{$list['imgurls']}',
		// 	displayimg         = '{$list['displayimg']}',
		// 	com_ok             = '{$list['com_ok']}',
		// 	wap_ok             = '{$list['wap_ok']}',
		// 	issue              = '{$list['issue']}',
		// 	hits               = '{$list['hits']}',
		// 	addtime            = '{$list['addtime']}',
		// 	updatetime         = '{$list['updatetime']}',
		// 	access             = '{$list['access']}',
		// 	filename           = '{$list['filename']}',
		// 	no_order       	   = '{$list['no_order']}',
		// 	lang          	   = '{$_M['lang']}',
		// 	displaytype        = '{$list['displaytype']}',
		// 	tag                = '{$list['tag']}',
		// 	links              = '{$list['links']}',
		// 	content1           = '{$list['content1']}',
		// 	content2           = '{$list['content2']}',
		// 	content3           = '{$list['content3']}',
		// 	content4           = '{$list['content4']}',
		// 	top_ok             = '{$list['top_ok']}'
		// ";
		// DB::query($query);
		// return DB::insert_id();
		$list['lang'] = $this->lang;
		//dump($list);
		return $this->database->insert($list);
	}

	//继承news
	// function docheck_filename() {
	// 	global $_M;
	// 	if(!$this->moduleclass->check_filename($_M['form']['filename'],$_M['form']['id'],$this->module)){
	// 		$errorno = $this->moduleclass->errorno=='error_filename_cha'?'仅支持中文、大小写字母、数字、下划线':'静态页面名称已被使用';
	// 		echo '0|'.$errorno;
	// 	}else{
	// 		echo '1|名称可用';
	// 	}
	// }

	function dopara() {
		global $_M;
		$class1 = $_M['form']['class1'];
		$class2 = $_M['form']['class2'];
		$class3 = $_M['form']['class3'];
		$this->paraclass->paratem($_M['form']['id'],$this->module,$class1,$class2,$class3);
	}

	/*产品编辑*/
	function doeditor() {
		global $_M;
		$list = $this->database->get_list_one_by_id($_M['form']['id']);
		// dump($list);
		// exit;
		// if(!$list['class1'])$list['class1']='';
		// if(!$list['class2'])$list['class2']='';
		// if(!$list['class3'])$list['class3']='';
		$list['imgurl_all'] = $list['imgurl'];
		$displayimg = explode("|",$list['displayimg']) ;
		foreach($displayimg as $val){
			$img = explode("*",$val);
		    $list['imgurl_all'].= '|'.$img[1];
		}
		$list['class'] = $list['class1'].'-'.$list['class2'].'-'.$list['class3'];
		// if($list['classother']){
		// 	$list['classother'] = str_replace("-|-",",",$list['classother']);
		// 	$list['classother'] = str_replace("|-",",",$list['classother']);
		// 	$list['classother'] = str_replace("-|",",",$list['classother']);
		// 	$list['classother'] = substr($list['classother'], 0, -1);
		// }
		$list['addtype'] = strtotime($list['addtime'])>time()?2:1;

		//if($_M['config']['shopv2_open'])$list_s = $this->shop->default_value($list_s);
		//

		// $list_s = $this->shop->default_value($list);
		// if($list_s){
		// 	$list = array_merge($list, $list_s);
		// }else{
		// 	$list = $list;
		// }
		//
		$list['updatetime'] = date("Y-m-d H:i:s");
		$list['issue'] = $list['issue'] ? $list['issue'] : get_met_cookie('metinfo_admin_name');
		//$list[description]=str_replace('&nbsp;','',$list[description]);
		//$list[description]=str_replace(' ','',$list[description]);
		$a = 'doeditorsave';
		$class_option = $this->class_option($this->module);
		$access_option = $this->access_option('access',$list['access']);
		$_M['url']['help_tutorials_helpid']='98';
		require $this->template('own/product_add');
	}
	function doeditorsave() {
		global $_M;
		$_M['form']['addtime'] = $_M['form']['addtype']==2?$_M['form']['addtime']:$_M['form']['addtime_l'];
		if($this->update_list($_M['form'],$_M['form']['id'])){
			//if($_M['config']['shopv2_open'])$this->shop->save_product($_M['form']['id'],$_M['form']);
			//
			//$this->shop->save_product($_M['form']['id'],$_M['form']);
			//
			//if($_M['config']['met_webhtm'] == 2 && $_M['config']['met_htmlurl'] == 0){
			$url="{$_M[url][own_form]}a=doindex&class1={$_M['form']['class1_select']}&class2={$_M['form']['class2_select']}&class3={$_M['form']['class3_select']}";
			load::mod_class('html/html_op', 'new')->html_generate($url,$_M['form']['class1_select'],$_M['form']['id']);
		}else{
			turnover("{$_M[url][own_form]}a=doindex",$_M[word][dataerror]);
		}

	}
	/*编辑产品*/
	public function update_list($list,$id){
		global $_M;

		//$list = $this->form_classlist($list);
		if($list['imgurl'])$list = $this->form_imglist($list,$this->module);
		//$list['updatetime'] = date("Y-m-d H:i:s");

		if($this->update_list_sql($list,$id)){
			$this->paraclass->update($id, $this->module, $_M['form']);
			return true;
		}else{
			return false;
		}
	}

	public function update_list_sql($list,$id){
		global $_M;
		if(!$list['title']){
			return false;
		}
		if(!$this->check_filename($list['filename'],$id,3)){
			return false;
		}
		if($list['links']){
			$list['links'] = url_standard($list['links']);
		}
		if($list['description']){
			$query = "SELECT content FROM {$this->tablename} WHERE id='{$id}'";
			$listown = DB::get_one($query);
			$description = $this->description($listown['content']);
			if($list['description']==$description){
				$list['description'] = $this->description($list['content']);
			}
		}else{
			$list['description'] = $this->description($list['content']);
		}
		//$list[description]=str_replace('&nbsp;','',$list[description]);
		//$list[description]=str_replace(' ','',$list[description]);
		$list['displayimg'] = $this->displayimg_check($list['displayimg']);
		$list['id'] = $id;
		// 增加展示图片尺寸属性imgsize（新模板框架v2）
		// $query = "UPDATE {$this->tablename} SET
		// 	title              = '{$list['title']}',
		// 	ctitle             = '{$list['ctitle']}',
		// 	keywords           = '{$list['keywords']}',
		// 	description        = '{$list['description']}',
		// 	content            = '{$list['content']}',
		// 	class1             = '{$list['class1']}',
		// 	class2             = '{$list['class2']}',
		// 	class3             = '{$list['class3']}',
		// 	classother         = '{$list['classother']}',
		// 	new_ok             = '{$list['new_ok']}',
		// 	imgurl             = '{$list['imgurl']}',
		// 	imgsize            = '{$list['imgsize']}',
		// 	imgurls            = '{$list['imgurls']}',
		// 	displayimg         = '{$list['displayimg']}',
		// 	com_ok             = '{$list['com_ok']}',
		// 	wap_ok             = '{$list['wap_ok']}',
		// 	issue              = '{$list['issue']}',
		// 	hits               = '{$list['hits']}',
		// 	addtime            = '{$list['addtime']}',
		// 	updatetime         = '{$list['updatetime']}',
		// 	access             = '{$list['access']}',
		// 	filename           = '{$list['filename']}',
		// 	no_order       	   = '{$list['no_order']}',
		// 	lang          	   = '{$_M['lang']}',
		// 	displaytype        = '{$list['displaytype']}',
		// 	tag                = '{$list['tag']}',
		// 	links              = '{$list['links']}',
		// 	content1           = '{$list['content1']}',
		// 	content2           = '{$list['content2']}',
		// 	content3           = '{$list['content3']}',
		// 	content4           = '{$list['content4']}',
		// 	top_ok             = '{$list['top_ok']}'
		// 	WHERE id='{$id}'
		// ";
		// DB::query($query);
		return $this->database->update_by_id($list);
	}

	/*去除多余的displayimg里面的图片数据*/
	public function displayimg_check($img){
		$imgs = stringto_array($img, '*', '|');
		$str = '';
		foreach($imgs as $val){
			if($val[1]){
				$str .="{$val[0]}*{$val[1]}*{$val[2]}|";//增加展示图片尺寸值{$val[2]}（新模板框架v2）
			}
		}
		$str = trim($str, '|');
		return $str;
	}

	/*产品管理*/
	function doindex() {
		global $_M;
		$list[class1]=$_M[form][class1];
		$list[class2]=$_M[form][class2];
		$list[class3]=$_M[form][class3];
		$column = $this->column(3,$this->module);
		$_M['url']['help_tutorials_helpid']='99';
		require $this->template('tem/product_index');
	}

	function docolumnjson(){
		$this->column_json($this->module);
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
            if($_M['form']['class1_select']==$_M[word][allcategory] && $_M['form']['class1']){
                	$class1 = $_M['form']['class1'];
                	$class2 = $_M['form']['class2'];
				    $class3 = $_M['form']['class3'];
            }

			$class1 = $class1 == ' ' ? 'null' : $class1;
			$class2 = $class2 == ' ' ? 'null' : $class2;
			$class3 = $class3 == ' ' ? 'null' : $class3;
			$keyword = $_M['form']['keyword'];
			$search_type = $_M['form']['search_type'];
			$orderby_hits = $_M['form']['orderby_hits'];
			$orderby_updatetime = $_M['form']['orderby_updatetime'];

			$ps = '';

			$where = $class1&&$class1!=$_M[word][allcategory]&&$class1!='null'?"and {$ps}class1 = '{$class1}'":'';
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
			$met_class = $this->column(2,$this->module);
			if($class3!='null' &&$class3){
                 $classnow=$class3;
			}elseif($class2!='null' && $class2){
                 $classnow=$class2;
			}else{
				 $classnow=$class1;
			}
			$order = $this->list_order($met_class[$classnow]['list_order']);
			if($orderby_hits)$order = "{$ps}hits {$orderby_hits}";
			if($orderby_updatetime)$order = "{$ps}updatetime {$orderby_updatetime}";
			$userlist = $this->json_list($where, $order);
			foreach($userlist as $key=>$val){
                $val['url']   = $this->url($val,$this->module);
                $val['state'] = $val['displaytype']?'':'<span class="label label-default">'.$_M[word][displaytype2].'</span>';
                if(!$val['state'])$val['state'] = strtotime($val['addtime'])>time()?'<span class="label label-default">'.$_M[word][timedrelease].'</span>':'';
                $val['state'].= $val['com_ok']?'<span class="label label-info" style="margin-left:8px;">'.$_M[word][recom].'</span>':'';
                $val['state'].= $val['top_ok']?'<span class="label label-success" style="margin-left:8px;">'.$_M[word][top].'</span>':'';
                $list = array();
				$list[] = "<input name=\"id\" type=\"checkbox\" value=\"{$val[id]}\">";
				$list[] = "
					<div class=\"media\">
					  <div class=\"media-left\">
						<a href=\"{$val['url']}\" target=\"_blank\">
						  <img class=\"media-object\" src=\"{$val['imgurl']}\" width=\"60\">
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
				$list[] = "<a href=\"{$_M[url][own_form]}a=doeditor&id={$val['id']}&class1_select={$class1}&class2_select={$class2}&class3_select={$class3}\" class=\"edit\">{$_M[word][editor]}</a><span class=\"line\">-</span><a href=\"{$_M[url][own_form]}a=dolistsave&submit_type=del&allid={$val['id']}\" data-toggle=\"popover\" class=\"delet\">{$_M[word][delete]}</a>
				";
				$rarray[] = $list;
			}
			$this->json_return($rarray);
	}

	// /*gggg*/
	// public function json_list($where, $order){
	// 	global $_M;
	// 	$this->table = load::sys_class('tabledata', 'new');

	// 	$p = $_M['table']['product'];
	// 	$s = $_M['table']['shopv2_product'];

	// 	if($_M['config']['shopv2_open']){//开启在线订购时
	// 		$table = $p.' Left JOIN '.$s." ON ({$p}.id = {$s}.pid)";
	// 		$where = "{$p}.lang='{$_M['lang']}' and ({$p}.recycle = '0' or {$p}.recycle = '-1') {$where}";
	// 	}else{
	// 		$table = $p;
	// 		$where = "lang='{$_M['lang']}' and (recycle = '0' or recycle = '-1') {$where}";
	// 	}

	// 	$data = $this->table->getdata($table, '*', $where, $order);
	// 	return $data;
	// }

	public function json_return($data){
		global $_M;
		load::sys_class('tabledata', 'new')->rdata($data);
	}

	function dolistsave(){
		global $_M;
		$list = explode(",",$_M['form']['allid']) ;
		foreach($list as $id){
			if($id){
				switch($_M['form']['submit_type']){
					case 'save':
						$list['no_order'] 	 = $_M['form']['no_order-'.$id];
						$this->list_no_order($id,$list['no_order']);
					break;
					case 'del':
						$this->del_list($id,$_M['form']['recycle']);
						if($_M['form']['recycle']==0){
							load::mod_class('product/product_database','new')->del_plist($id,5);
						}
					break;
					case 'comok':
						$this->list_com($id,1);
					break;
					case 'comno':
						$this->list_com($id,0);
					break;
					case 'topok':
						$this->list_top($id,1);
					break;
					case 'topno':
						$this->list_top($id,0);
					break;
					case 'displayok':
						$this->list_display($id,1);
					break;
					case 'displayno':
						$this->list_display($id,0);
					break;
					case 'move':
						$class = explode("-",$_M['form']['columnid']);
						$class1 = $class[0];
						$class2 = $class[1];
						$class3 = $class[2];
						$this->list_move($id,$class1,$class2,$class3);
					break;
					case 'copy':
						$class = explode("-",$_M['form']['columnid']);
						$class1 = $class[0];
						$class2 = $class[1];
						$class3 = $class[2];
						$newid = $this->list_copy($id,$class1,$class2,$class3);
						//开启在线订购时
						//if($_M['config']['0'])$this->shop->copy_product($id,$newid);
						//
						//$this->shop->copy_product($id,$newid);
						//
					break;
				}
			}
		}
		$old_class_str="&class1={$_M['form']['class1']}&class2={$_M['form']['class2']}&class3={$_M['form']['class3']}";
		$url="{$_M[url][own_form]}a=doindex&class1={$_M['form']['class1_select']}&class2={$_M['form']['class2_select']}&class3={$_M['form']['class3_select']}";
		load::mod_class('html/html_op', 'new')->html_generate($url,$_M['form']['class1_select'],$_M['form']['id']);
	}

	/*复制*/
	public function list_copy($id,$class1,$class2,$class3){
		global $_M;
        $list =$this->database->get_list_one_by_id($id);
		$list['filename'] = '';
		$list['class1']   = $class1;
		$list['class2']   = $class2;
		$list['class3']   = $class3;
		$list['updatetime']  = date("Y-m-d H:i:s");
		$list['addtime']  = date("Y-m-d H:i:s");
		$list['content']  = str_replace('\'','\'\'',$list['content']);
		$list['content1'] = str_replace('\'','\'\'',$list['content1']);
		$list['content2'] = str_replace('\'','\'\'',$list['content2']);
		$list['content3'] = str_replace('\'','\'\'',$list['content3']);
		$list['content4'] = str_replace('\'','\'\'',$list['content4']);
		$copyid=$this->insert_list_sql($list); //复制产品参数
		$paralist = $this->para->get_list($id,$this->module);//
		foreach ($paralist as $key=>$paravalue) {
		 $listid=$copyid;
		 $paraid= $paravalue[paraid];
		 $val   =$paravalue[val];
		 $module=$paravalue[module];
		 $lang  =$paravalue[lang];
		 $imgname=$paravalue[imgname];
		 $info=$paravalue[info];
		 $query3="INSERT INTO  {$_M['table']['plist']}
						(`id` ,  `listid` ,   `paraid` ,   `info` ,     `lang` ,    `imgname` ,  `module`)	VALUES
						(NULL ,  '{$listid}', '{$paraid}' , '{$info}' , '{$lang}' , '{$imgname}','{$module}')";
		 DB::query($query3);
		}
		 return $copyid;
	}

	//下列全部继承news
	// /*移动产品*/
	// public function list_move($id,$class1,$class2,$class3){
	// 	global $_M;
	// 	$query = "UPDATE {$this->tablename} SET
	// 		class1 = '{$class1}',
	// 		class2 = '{$class2}',
	// 		class3 = '{$class3}'
	// 		WHERE id = '{$id}'";
	// 	DB::query($query);
	// }
	// /*修改排序*/
	// public function list_no_order($id,$no_order){
	// 	global $_M;
	// 	$query = "UPDATE {$this->tablename} SET no_order = '{$no_order}' WHERE id = '{$id}'";
	// 	DB::query($query);
	// }
	// /*上架下架*/
	// public function list_display($id,$display){
	// 	global $_M;
	// 	$query = "UPDATE {$this->tablename} SET displaytype = '{$display}' WHERE id = '{$id}'";
	// 	DB::query($query);
	// }
	// /*置顶*/
	// public function list_top($id,$top){
	// 	global $_M;
	// 	$query = "UPDATE {$this->tablename} SET top_ok = '{$top}' WHERE id = '{$id}'";
	// 	DB::query($query);
	// }
	// /*推荐*/
	// public function list_com($id,$com){
	// 	global $_M;
	// 	$query = "UPDATE {$this->tablename} SET com_ok = '{$com}' WHERE id = '{$id}'";
	// 	DB::query($query);
	// }
	// /*删除产品*/
	// public function del_list($id,$recycle){
	// 	global $_M;
	// 	if($recycle){
	// 		$query = "UPDATE {$this->tablename} SET recycle = '3' WHERE id='{$id}'";
	// 		DB::query($query);
	// 	}else{
	// 		$query = "DELETE FROM {$this->tablename} WHERE id='{$id}'";
	// 		DB::query($query);
	// 		$query = "DELETE FROM {$_M['table']['plist']} WHERE listid='{$id}'";
	// 		DB::query($query);
	// 	}
	// }

}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>
