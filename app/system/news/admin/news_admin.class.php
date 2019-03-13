<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.

defined('IN_MET') or exit('No permission');

load::mod_class('base/admin/base_admin');

class news_admin extends base_admin {
	public $moduleclass;
	public $module;
	public $database;
	/**
	 * 初始化
	 */

	function __construct() {
		global $_M;
		parent::__construct();
		$this->module = 2;
		//$this->tablename = $_M['table']['news'];
		//$this->construct(2, $_M['table']['news']);
		$this->database = load::mod_class('news/news_database', 'new');
		//$this->database->construct('new');
	}

	/**
	 * 新增内容
	 */
	public function doadd() {
		global $_M;
		$list = $this->add();
		$a = 'doaddsave';
		$list[class1]=$_M[form][class1_select];
		$list[class2]=$_M[form][class2_select];
		$list[class3]=$_M[form][class3_select];
		$turnurl="&class1={$_M['form']['class1_select']}&class2={$_M['form']['class2_select']}&class3={$_M['form']['class3_select']}";
		$access_option = $this->access_option('access');
		$_M['url']['help_tutorials_helpid']='98#1、基本信息';
		require $this->template('own/article_add');
	}

	function add() {
		global $_M;
		$list['class1'] = $_M['form']['class1'] ? $_M['form']['class1'] : '' ;
		$list['class2'] = $_M['form']['class2'] ? $_M['form']['class2'] : '' ;
		$list['class3'] = $_M['form']['class3'] ? $_M['form']['class3'] : '' ;
		$list['displaytype'] = 1;
		$list['addtype'] = 1;
		$list['updatetime'] = date("Y-m-d H:i:s");
		$list['issue'] = get_met_cookie('metinfo_admin_name');
		$list['issue'] = get_met_cookie('metinfo_admin_name');
		$admin_name=DB::get_one("select admin_name from {$_M[table][admin_table]} where admin_id='{$list[issue]}'");
		$list['issue']=$admin_name[admin_name];
		return $list;
	}

	/**
	 * 添加数据保存
	 */
	public function doaddsave() {
		global $_M;
		$_M['form']['addtime'] = $_M['form']['addtype']==2?$_M['form']['addtime']:date("Y-m-d H:i:s");
		$id = $this->insert_list($_M['form']);
		if($id){
		$url="{$_M[url][own_form]}a=doindex{$_M[form][turnurl]}";
	    load::mod_class('html/html_op', 'new')->html_generate($url,$_M['form']['class1_select'],$id);
		}else{
			turnover("{$_M[url][own_form]}a=doindex",$_M[word][dataerror]);
		}
	}

	/**
	 * 新增内容插入数据处理
	 * @param  前台提交的表单数组 $list
	 * @return $pid  新增的ID 失败返回FALSE
	 */
	public function insert_list($list){
		global $_M;
		$list['addtime']    = $list['addtime']?$list['addtime']:$list['updatetime'];
		$list[description]=str_replace('&nbsp;','',$list[description]);
		$list[description]=trim($list[description]);
		if($list['imgurl'] == ''){
			if(preg_match('/<img.*src=\\\\"(.*?)\\\\".*?>/i',$list['content'],$out)){
				$imgurl             = explode("upload/",$out[1]);
				if(count($imgurl) < 2) {
					//$list['imgurl'] = $_M['config']['met_agents_img'];
				}else{
					$list['imgurl']     = '../upload/'.str_replace('watermark/', '',$imgurl[1]);
				}

			}else{
				//$list['imgurl'] = $_M['config']['met_agents_img'];
			}
		}
		$list = $this->form_imglist($list,2);

		$pid = $this->insert_list_sql($list);
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

		// $query = "INSERT INTO {$this->tablename} SET
		// 	title              = '{$list['title']}',
		// 	ctitle             = '{$list['ctitle']}',
		// 	keywords           = '{$list['keywords']}',
		// 	description        = '{$list['description']}',
		// 	content            = '{$list['content']}',
		// 	class1             = '{$list['class1']}',
		// 	class2             = '{$list['class2']}',
		// 	class3             = '{$list['class3']}',
		// 	imgurl             = '{$list['imgurl']}',
		// 	imgurls            = '{$list['imgurls']}',
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
		// 	top_ok             = '{$list['top_ok']}'
		// ";
		// DB::query($query);
		// return DB::insert_id();
		$list['lang'] = $this->lang;
		return $this->database->insert($list);
	}


	/**
	 * ajax检测静态文件是否重名//base
	 */
	function docheck_filename() {
		global $_M;
		if(is_numeric($_M['form']['filename'])){
            $errorno = $this->moduleclass->errorno=='error_filename_cha'?$_M[word][js74]:$_M[word][js73];
            echo '0|'.$errorno;
		}

		if(!$this->check_filename($_M['form']['filename'], $_M['form']['id'], $this->module)){
            $errorno = $this->moduleclass->errorno=='error_filename_cha'?$_M[word][js74]:$_M[word][js73];
			echo '0|'.$errorno;
		}else{
            echo '1|'.$_M[word][js75];
		}
	}

	/**
	 * 编辑文章页面
	 */
	function doeditor() {
		global $_M;
		$admin_name=get_met_cookie('metinfo_admin_name');
		$admin_name=DB::get_one("select admin_name from {$_M[table][admin_table]} where admin_id='{$admin_name}'");
		$list = $this->database->get_list_one_by_id($_M['form']['id']);
		$list['addtype'] = strtotime($list['addtime'])>time()?2:1;
		$list['updatetime'] = date("Y-m-d H:i:s");
		$list['issue'] = $list['issue'] ? $list['issue'] : $admin_name['admin_name'];
		//$list[description]=str_replace('&nbsp;','',$list[description]);
		//$list[description]=str_replace(' ','',$list[description]);
		$a = 'doeditorsave';
		$access_option = $this->access_option('access',$list['access']);
		$_M['url']['help_tutorials_helpid']='98#1、基本信息';
		require $this->template('own/article_add');
	}

	/**
	 * 修改保存页面
	 * @param  array   $list   插入的数组
	 * @return number  				 插入后的数据ID
	 */
	function doeditorsave() {
		global $_M;
		// dump($_SERVER);
		// exit;
		$_M['form']['addtime'] = $_M['form']['addtype']==2?$_M['form']['addtime']:date("Y-m-d H:i:s");
		if($this->update_list($_M['form'],$_M['form']['id'])){
			//if($_M['config']['met_webhtm'] == 2 && $_M['config']['met_htmlurl'] == 0){
			// if(0){
			// 	turnover("./content/article/save.php?lang={$_M['lang']}&action=html&class1_select={$_M['form']['class1_select']}&class2_select={$_M['form']['class2_select']}&class3_select={$_M['form']['class3_select']}");
			// }else{
			// 	turnover("{$_M[url][own_form]}a=doindex&class1={$_M['form']['class1_select']}&class2={$_M['form']['class2_select']}&class3={$_M['form']['class3_select']}");
			// }
      $url="{$_M[url][own_form]}a=doindex&class1={$_M['form']['class1_select']}&class2={$_M['form']['class2_select']}&class3={$_M['form']['class3_select']}";
			load::mod_class('html/html_op', 'new')->html_generate($url,$_M['form']['class1_select'],$_M['form']['id']);
		}else{
            turnover("{$_M[url][own_form]}a=doindex",$_M[word][dataerror]);
		}

	}

	/**
	 * 保存修改
	 * @param  array   $list   修改的数组
	 * @return bool  				 	 修改是否成功
	 */
	public function update_list($list,$id){
		global $_M;

		//$list['updatetime'] = date("Y-m-d H:i:s");

		if($list['imgurl'] == ''){
			if(preg_match('/<img.*?src=\\\\"(.*?)\\\\".*?>/i',$list['content'],$out)){
				$imgurl             = explode("upload/",$out[1]);
				$list['imgurl']     = '../upload/'.str_replace('watermark/', '',$imgurl[1]);
			}
		}

		$list = $this->form_imglist($list,2);

		if($this->update_list_sql($list,$id)){
			return true;
		}else{
			return false;
		}

	}

	/**
	 * 保存修改sql
	 * @param  array   $list   修改的数组
	 * @return bool  				 	 修改是否成功
	 */
	public function update_list_sql($list,$id){
		global $_M;
		if(!$list['title']){
			return false;
		}
		if(!$this->check_filename($list['filename'],$id,$this->module)){
			return false;
		}
		if($list['links']){
			$list['links'] = url_standard($list['links']);
		}
		if($list['description']){
			$listown = $this->database->get_list_one_by_id($id);
			$description = $this->description($listown['content']);
			if($list['description']==$description){
				$list['description'] = $this->description($list['content']);
			}
		}else{
			$list['description'] = $this->description($list['content']);
		}
		//$list[description]=str_replace('&nbsp;','',$list[description]);
		//$list[description]=str_replace(' ','',$list[description]);
		$list['id'] = $id;
		// $query = "UPDATE {$this->tablename} SET
		// 	title              = '{$list['title']}',
		// 	ctitle             = '{$list['ctitle']}',
		// 	keywords           = '{$list['keywords']}',
		// 	description        = '{$list['description']}',
		// 	content            = '{$list['content']}',
		// 	class1             = '{$list['class1']}',
		// 	class2             = '{$list['class2']}',
		// 	class3             = '{$list['class3']}',
		// 	imgurl             = '{$list['imgurl']}',
		// 	imgurls            = '{$list['imgurls']}',
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
		// 	top_ok             = '{$list['top_ok']}'
		// 	WHERE id='{$id}'
		// ";
		// DB::query($query);
		return $this->database->update_by_id($list);
		//return true;
	}

	/**
	 * 首页页面
	 */
	function doindex() {
		global $_M;
		$column = $this->column(3,$this->module);
		$list['class1'] = $_M['form']['class1'] ? $_M['form']['class1'] : '' ;
		$list['class2'] = $_M['form']['class2'] ? $_M['form']['class2'] : '' ;
		$list['class3'] = $_M['form']['class3'] ? $_M['form']['class3'] : '' ;
		$_M['url']['help_tutorials_helpid']='99';
		require $this->template('own/article_index');
	}

	/**
	 * 栏目json
	 */
	function docolumnjson(){
		global $_M;
		$this->column_json($this->module,$_M['form']['type']);
	}

	/**
	 * 分页数据
	 */
	function dojson_list(){
		global $_M;
		// dump($_M['form']);
		// exit;
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

		$where = $class1&&$class1!=$_M[word][allcategory]&&$class1!='null'?"and class1 = '{$class1}'":'';
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
		$met_class = $this->column(2,$this->module);
		if($class3!='null' &&$class3){
                 $classnow=$class3;
			}elseif($class2!='null' && $class2){
                 $classnow=$class2;
			}else{
				 $classnow=$class1;
			}
		$order = $this->list_order($met_class[$classnow]['list_order']);
		if($orderby_hits)$order = "hits {$orderby_hits}";
		if($orderby_updatetime)$order = "updatetime {$orderby_updatetime}";

		$userlist = $this->json_list($where, $order);

		foreach($userlist as $key=>$val){

			$val['url']   = $this->url($val,$this->module);
			$val['state'] = $val['displaytype']?'':'<span class="label label-default">'.$_M[word][displaytype2].'</span>';
			if(!$val['state'])$val['state'] = strtotime($val['addtime'])>time()?'<span class="label label-default">'.$_M[word][timedrelease].'</span>':'';
			$val['state'].= $val['com_ok']?'<span class="label label-info" style="margin-left:8px;">'.$_M[word][recom].'</span>':'';
			$val['state'].= $val['top_ok']?'<span class="label label-success" style="margin-left:8px;">'.$_M[word][top].'</span>':'';
			$list = array();
			$list[] = "<input name=\"id\" type=\"checkbox\" value=\"{$val[id]}\">";
			$list[] = "<div class=\"ui-table-a\"><a title=\"{$val['title']}\" href=\"{$val['url']}\" target=\"_blank\">{$val['title']}</a></div>";
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

	/**
	 * 列表操作保存
	 */
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
					break;
				}
			}
		}
		// if($_M['config']['met_webhtm'] == 2 && $_M['config']['met_htmlurl'] == 0){
		// 	turnover("./content/article/save.php?lang={$_M['lang']}&action=html");
		// }else{
		// 	turnover("{$_M[url][own_form]}a=doindex");
		// }
		//dump($_M[form]);
		$url="{$_M[url][own_form]}a=doindex&class1={$_M['form']['class1_select']}&class2={$_M['form']['class2_select']}&class3={$_M['form']['class3_select']}";
		load::mod_class('html/html_op', 'new')->html_generate($url,$_M['form']['class1_select'],$_M['form']['id']);


	}

	/*复制*/
	public function list_copy($id,$class1,$class2,$class3){
		global $_M;
		$list = $this->database->get_list_one_by_id($id);
		$list['filename'] = '';
		$list['class1']   = $class1;
		$list['class2']   = $class2;
		$list['class3']   = $class3;
		$list['updatetime']  = date("Y-m-d H:i:s");
		$list['addtime']  = date("Y-m-d H:i:s");
		$list['content']  = str_replace('\'','\'\'',$list['content']);
		return $this->insert_list_sql($list);
	}

	/*移动产品*/
	public function list_move($id,$class1,$class2,$class3){
		$list['id'] = $id;
		$list['class1'] = $class1;
		$list['class2'] = $class2;
		$list['class3'] = $class3;
		return $this->database->update_by_id($list);
		// $query = "UPDATE {$this->tablename} SET
		// 	class1 = '{$class1}',
		// 	class2 = '{$class2}',
		// 	class3 = '{$class3}'
		// 	WHERE id = '{$id}'";
		// DB::query($query);
	}

	/*修改排序*/
	public function list_no_order($id,$no_order){
		$list['id'] = $id;
		$list['no_order'] = $no_order;
		return $this->database->update_by_id($list);
		// $query = "UPDATE {$this->tablename} SET no_order = '{$no_order}' WHERE id = '{$id}'";
		// DB::query($query);
	}

	/*上架下架*/
	public function list_display($id,$display){
		$list['id'] = $id;
		$list['displaytype'] = $display;
		return $this->database->update_by_id($list);
		// $query = "UPDATE {$this->tablename} SET displaytype = '{$display}' WHERE id = '{$id}'";
		// DB::query($query);
	}

	/*置顶*/
	public function list_top($id,$top){
		$list['id'] = $id;
		$list['top_ok'] = $top;
		return $this->database->update_by_id($list);
		// $query = "UPDATE {$this->tablename} SET top_ok = '{$top}' WHERE id = '{$id}'";
		// DB::query($query);
	}

	/*推荐*/
	public function list_com($id,$com){
		$list['id'] = $id;
		$list['com_ok'] = $com;
		return $this->database->update_by_id($list);
		// $query = "UPDATE {$this->tablename} SET com_ok = '{$com}' WHERE id = '{$id}'";
		// DB::query($query);
	}

	/*删除*/
	public function del_list($id,$recycle = 2){
		global $_M;
		if($recycle){
			$list['id'] = $id;
			$list['recycle'] = $recycle;
			$list['updatetime'] =date('Y-m-d H:i:s',time());
			return $this->database->update_by_id($list);
			// $query = "UPDATE {$this->tablename} SET recycle = '2' WHERE id='{$id}'";
			// DB::query($query);
		}else{
			return $this->database->del_by_id($id);
			// $query = "DELETE FROM {$this->tablename} WHERE id='{$id}'";
			// DB::query($query);
		}
	}

}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>
