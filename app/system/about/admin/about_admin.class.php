<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.

defined('IN_MET') or exit('No permission');

load::mod_class('message/admin/message_admin');

class about_admin extends message_admin {
	public $moduleclass;
	public $module;
	public $database;
	/**
	 * 初始化
	 */

	function __construct() {
		global $_M;
		parent::__construct();
		$this->module =1;
		$this->database = load::mod_class('about/about_database', 'new');
		$this->tabledata = load::sys_class('tabledata', 'new');
		$_M['url']['help_tutorials_helpid']='99';
	}

	/**
	 * 新增内容
	 */
	public function doadd() {
		global $_M;
		$list = $this->add();
		$a = 'doaddsave';
		$access_option = $this->access_option('access');
		require $this->template('own/article_add');
	}

	function add() {
		global $_M;
		$list['class1'] = $_M['form']['class1'] ? $_M['form']['class1'] : 0 ;
		$list['class2'] = $_M['form']['class2'] ? $_M['form']['class2'] : 0 ;
		$list['class3'] = $_M['form']['class3'] ? $_M['form']['class3'] : 0 ;
		$list['displaytype'] = 1;
		$list['addtype'] = 1;
		$list['updatetime'] = date("Y-m-d H:i:s");
		$list['issue'] = get_met_cookie('metinfo_admin_name');
		return $list;
	}

	/**
	 * 添加数据保存
	 */
	public function doaddsave() {
		global $_M;
		$_M['form']['addtime'] = $_M['form']['addtype']==2?$_M['form']['addtime']:date("Y-m-d H:i:s");
		if($this->insert_list($_M['form'])){
			if(1){
				turnover("./content/article/save.php?lang={$_M['lang']}&action=html&select_class1={$_M['form']['select_class1']}&select_class2={$_M['form']['select_class2']}&select_class3={$_M['form']['select_class3']}");
			}else{
				turnover("{$_M[url][own_form]}a=doindex");
			}
		}else{
			turnover("{$_M[url][own_form]}a=doindex",'{$_M[word][dataerror]}');
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
		if($list['imgurl'] == ''){
			if(preg_match('/<img.*src=\\\\"(.*?)\\\\".*?>/i',$list['content'],$out)){
				$imgurl             = explode("upload/",$out[1]);
				if(count($imgurl) < 2) {
					$list['imgurl'] = $_M['config']['met_agents_img'];
				}else{
					$list['imgurl']     = '../upload/'.str_replace('watermark/', '',$imgurl[1]);
				}

			}else{
				$list['imgurl'] = $_M['config']['met_agents_img'];
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
		return $this->database->update_by_id($list);
	}


	/**
	 * ajax检测静态文件是否重名
	 */
	function docheck_filename() {
		global $_M;
		if(!$this->check_filename($_M['form']['filename'], $_M['form']['id'], $this->module)){
			$errorno = $this->moduleclass->errorno=='error_filename_cha'?"{$_M[word][js74]}":"{$_M[word][js73]}";
			echo '0|'.$errorno;
		}else{
			echo "1|{$_M[word][js75]}";
		}
	}

	/**
	 * 编辑文章页面
	 */

  function doeditor() {
		global $_M;
		$turnurl=HTTP_REFERER;
		$a = 'doeditorsave';
		$about = $this->database->get_list_one_by_id($_M['form']['id']);
		if(!$about)turnover("{$_M[url][own_form]}a=doindex",$_M[word][dataerror]);
		$class1=$about[bigclass]==0?$id:$about[bigclass];
		$class2=$_M['form']['id'];
		if($about[classtype]==3||$about[classtype]==2)$ctp=1;
		$ctype = $about[classtype]==2&&count($met_class3[$id])?1:0;
		$ctype1 = $about[classtype]==2&&count($met_class3[$id])?1:0;
		if($about[classtype]==3){
			$about2 = DB::get_one("SELECT * FROM $_M[table][column] WHERE id='$about[bigclass]'");
			$class2=$about2[id];
			$class1=$about2[bigclass];
			$ctype1=1;
		}
		$nott=$class1==$class2||$class2==$id?0:1;
		if($met_class[$class2][releclass]){
			$class1=$class2;
		}
	        $about['ctitle']=str_replace('"', '&#34;', str_replace("'", '&#39;',$about['ctitle']));
	     	require $this->template('own/article_add');
	}






	function doview() {
		global $_M;
		$a = 'doeditorsave';
		$id=$_M['form']['id'];
		$access_option = $this->access_option('access',$list['access']);
		$query = "update {$_M[table][cv]} SET
					  readok  = '1'
					  where id='$id'";
		DB::query($query);
		$cv_list=DB::get_one("select * from {$_M[table][cv]} where id='$id'");
		if(!$cv_list)turnover("{$_M[url][own_form]}",$_M[word][dataerror]);
		$query = "SELECT * FROM {$_M[table][parameter]} where lang='{$this->lang}' and module=6  order by no_order";
		$result = DB::query($query);
		while($list= DB::fetch_array($result)){
			$value_list=DB::get_one("select * from {$_M[table][plist]} where paraid=$list[id] and listid=$id ");
			if($list[type]==5){
				if($value_list[info]){  
					$src = $value_list[info];
					$value_list[info]="<a href='$value_list[info]'>$value_list[info]</a>";
				}
			}
			$list[content]=$value_list[info];
			// if($list[type]==5 && $met_cv_image == $value_list[paraid]){
			// 	$jobzhaop='../../'.$src;
			// }else{
				$cv_para[]=$list;
			// }
		}
		$m_list = DB::get_one("SELECT * FROM {$_M[table][column]} WHERE module='6' and lang='{$this->lang}'");
		$class1 = $m_list['id'];
		require $this->template('own/cv_view');
	}

	/**
	 * 修改保存页面
	 * @param  array   $list   插入的数组
	 * @return number  				 插入后的数据ID
	 */
	function doeditorsave() {
		global $_M;
		$_M['form']['addtime'] = $_M['form']['addtype']==2?$_M['form']['addtime']:date("Y-m-d H:i:s");
		if($this->update_list($_M['form'],$_M['form']['id'])){
			if(strpos($_M['form']['turnurl'], 'pageset=1')!==false){
				turnover("{$_M['url'][own_form]}a=doeditor&id={$_M['form']['id']}","");
			}else{
				turnover($_M['form']['turnurl'],"");
			}
		}else{
			turnover("{$_M[url][own_form]}a=doindex",'{$_M[word][dataerror]}');
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

		// dump($list);
		// exit;
		// if(!$list['title']){
		// 	return false;
		// }
		// if(!$this->check_filename($list['filename'],$id,$this->module)){
		// 	return false;
		// }
		// if($list['links']){
		// 	$list['links'] = url_standard($list['links']);
		// }
		// if($list['description']){
		// 	$listown = $this->database->get_list_one_by_id($id);
		// 	$description = $this->description($listown['content']);
		// 	if($list['description']==$description){
		// 		$list['description'] = $this->description($list['content']);
		// 	}
		// }else{
		// 	$list['description'] = $this->description($list['content']);
		// }
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
		$column = $this->column(1,$this->module);

		
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
		$where="lang='{$this->lang}' and module='1' and isshow='1'";
		if($_M['form']['class1_select']=='null'&&$_M['form']['class2_select']=='null'&&$_M['form']['class3_select']=='null'){
			$class1 = $_M['form']['class1'];
			$class2 = $_M['form']['class2'];
			$class3 = $_M['form']['class3'];
		}else{
			$class1 = $_M['form']['class1_select'];
			$class2 = $_M['form']['class2_select'];
			$class3 = $_M['form']['class3_select'];
		}
		$keyword = $_M['form']['keyword'];
		if($class1 && $class1!='null')$classid=$class1;
		if($class2 && $class2!='null')$classid=$class2;
		if($class3 && $class3!='null')$classid=$class3;

		if($classid && $classid!="{$_M[word][allcategory]}"){
			$where.=" and (id={$classid} or bigclass= {$classid})";
		}
		$where.= $keyword?"and name like '%{$keyword}%'":'';
	    $userlist = $this->json_list('', '');
		$result =$this->tabledata->getdata($_M[table][column],'*',$where);
		foreach ($result as $key => $list) {
			$list['customerid']=$list['customerid']=='0'?$_M[word][feedbackAccess0]:$list['customerid'];
			if($_M[config][met_member_use]){
				switch($list['access']){
					case '1':$list['access']=$_M[word][access1];break;
					case '2':$list['access']=$_M[word][access2];break;
					case '3':$list['access']=$_M[word][access3];break;
					default: $list['access']=$_M[word][access0];break;
				}
			}	
			$list[displaytype1] = $list[displaytype] ? $_M[word][yes] : $_M[word][no];
			if($list[count]==0)$list[count]=$_M[word][josAlways];
			if($list[useful_life]==0)$list[useful_life]=$_M[word][josAlways];
			$list[top_ok] = $list[top_ok] ? $_M[word][yes] : $_M[word][no];
			$job_list[]=$list;
		}
		$admininfo = admin_information();
		foreach($job_list as $key=>$val){
			$val['url']   = $this->url($val,$this->module);
			$val['state'] = $val['displaytype']?'':'<span class="label label-default">'.$_M[word][displaytype2].'</span>';
			if(!$val['state'])$val['state'] = strtotime($val['addtime'])>time()?'<span class="label label-default">'.$_M[word][timedrelease].'</span>':'';
			$val['state'].= $val['top_ok']==$_M[word][yes]?'<span class="label label-success" style="margin-left:8px;">'.$_M[word][top].'</span>':'';
			$list = array();
			$list[] =$val['no_order'];
			$list[] = $val['name'];
			$list[] = "<a href=\"{$_M[url][own_form]}a=doeditor&id={$val['id']}&select_class1={$class1}&select_class2={$class2}&select_class3={$class3}\" class=\"edit\">{$_M[word][editor]}</a>";
			$rarray[] = $list;
		}
		$this->json_return($rarray);

	}

	function dojson_list1(){
		global $_M;
		$where="lang='{$this->lang}'";
		if(isset($_M['form']['jobid']) && $_M['form']['jobid']){
           $where.="AND jobid='{$_M['form']['jobid']}'";
		}
		if($_M['form']['class1_select']=='null'&&$_M['form']['class2_select']=='null'&&$_M['form']['class3_select']=='null'){
			$class1 = $_M['form']['class1'];
			$class2 = $_M['form']['class2'];
			$class3 = $_M['form']['class3'];
		}else{
			$class1 = $_M['form']['class1_select'];
			$class2 = $_M['form']['class2_select'];
			$class3 = $_M['form']['class3_select'];
		}
		$keyword = $_M['form']['keyword'];
		$class1 = $class1 == ' ' ? 'null' : $class1;
		$class2 = $class2 == ' ' ? 'null' : $class2;
		$class3 = $class3 == ' ' ? 'null' : $class3;
		$where.= $keyword?"and customerid like '%{$keyword}%'":'';
        switch($_M[form][search_type]){
			case 0:break;
			case 1:
				$where.= "and readok = '0'";
			break;
			case 2:
				$where.= "and readok = '1'";
			break;
		}
	    $userlist = $this->json_list('', '');
		$result =$this->tabledata->getdata($_M[table][cv],'*',$where);
		foreach ($result as $key => $list) {
			$list['customerid']=$list['customerid']=='0'?$_M[word][feedbackAccess0]:$list['customerid'];
			if($_M[config][met_member_use]){
				switch($list['access']){
					case '1':$list['access']=$_M[word][access1];break;
					case '2':$list['access']=$_M[word][access2];break;
					case '3':$list['access']=$_M[word][access3];break;
					default: $list['access']=$_M[word][access0];break;
				}
			}

			$query="SELECT * FROM {$_M[table][job]} WHERE id='{$list['jobid']}'";
			$jobinfo=DB::get_one($query);
			$list['position']=$jobinfo['position'];
			$list[readok] = $list[readok] ? $_M[word][yes] : $_M[word][no];
			$job_list[]=$list;
		}
		$admininfo = admin_information();
		foreach($job_list as $key=>$val){
			$val['url']   = $this->url($val,$this->module);
			$val['state'] = $val['readok']==$_M[word][yes]?'':'<span class="label label-default">'.$_M[word][feedbackClass2].'</span>';
			$list = array();
			$list[] = "<input name=\"id\" type=\"checkbox\" value=\"{$val[id]}\">";
			$list[] = $val['position'];
			$list[] = $val['customerid'];
			$list[] = $val['state'];
			$list[] = $val['addtime'];
			$list[] = $val['readok'];
			$list[] = "<a href=\"{$_M[url][own_form]}a=doview&id={$val['id']}&select_class1={$class1}&select_class2={$class2}&select_class3={$class3}\" class=\"edit\">{$_M[word][View]}</a><span class=\"line\">-</span><a href=\"{$_M[url][own_form]}a=dolistsave&submit_type=del&allid={$val['id']}&cv=1\" data-toggle=\"popover\" class=\"delet\">{$_M[word][delete]}</a>
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
		if($_M['config']['met_webhtm'] == 2 && $_M['config']['met_htmlurl'] == 0){
			turnover("./content/article/save.php?lang={$_M['lang']}&action=html");
		}else{
			turnover("{$_M[url][own_form]}a=doindex");
		}

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
		$list['$class1'] = $class1;
		$list['$class2'] = $class2;
		$list['$class3'] = $class3;
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
	public function del_list($id,$recycle){
		global $_M;
		if($recycle){
			$list['id'] = $id;
			$list['recycle'] = 2;
			return $this->database->update_by_id($list);
			// $query = "UPDATE {$this->tablename} SET recycle = '2' WHERE id='{$id}'";
			// DB::query($query);
		}else{
			return $this->database->del_by_id($id);
			// $query = "DELETE FROM {$this->tablename} WHERE id='{$id}'";
			// DB::query($query);
		}
	}

	/*系统参数设置*/

	public function dosyset(){
	    global $_M;
		$query = "SELECT * FROM {$_M[table][parameter]} where lang='{$this->lang}' and module='{$this->module}' order by no_order";
		$result =DB::query($query);
		while($list=DB::fetch_array($result)){
			$cv_para[$list[type]][]=$list;
		}
		$met_cv_type1[$_M[config][met_cv_type]]="checked=checked";
		$met_cv_emtype1[$_M[config][met_cv_emtype]]="checked=checked";
		$met_cv_back1=($_M[config][met_cv_back])?"checked":"";
		$m_list =DB::get_one("SELECT * FROM {$_M[table][column]} WHERE lang='{$this->lang}' and module='{$this->module}'");
		$class1 = $m_list['id'];
	    require $this->template('own/set');
	}

 /*信息管理*/
	public function domanageinfo(){
		global $_M;
		require $this->template('own/info');
	}
  /*保存配置*/
	public function dosaveinc(){
      global $_M;
      $list=$_M[form];
      $query="select * from {$_M[table][config]} where (lang ='{$this->lang}' or lang ='metinfo')";
      $res=DB::get_all($query);
      foreach ($res as $key => $value) {
      	  if($_M[config][$value['name']]!=$_M[form][$value['name']] &&isset($_M[form][$value['name']])){
      	  	$query="UPDATE {$_M[table][config]} SET value='{$_M[form][$value['name']]}' WHERE name='{$value['name']}'";
      	  	DB::query($query);
      	  }
        }
  
      turnover("{$_M[url][own_form]}a=dosyset",'');
}

/**
	 * 静态页面名称验证
	 * @param  string  $filename   select的name名称
   * @param  string  $id         选中的权限字段
	 * @return array               配置数组
	 */
	public function check_filename($filename, $id){
		global $_M;
		if($filename!=''){
			if(!preg_match("/^[a-zA-Z0-9_^\x80-\xff]+$/",$filename)){
				$this->errorno = 'error_filename_cha';
				return false;
			}
		}

		if($filename){
			$filenames = $this->database->get_list_by_filename($filename);
			if(count($filenames) > 1 || ($filenames[0]['id'] != $id && $filenames[0]['id']) ){
				$this->errorno = 'error_filename_exist';
				return false;
			}
		}

			// $query = "SELECT * FROM {$this->tablename($this->module)} WHERE filename='{$filename}' and lang='{$_M['lang']}'";
			// $list = DB::get_one($query);

			//if($list&&$list['id']!=$id){
			// if($count >= 1){
			// 	$this->errorno = 'error_filename_exist';
			// 	return false;
			// }
		return true;
	}

}



# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>
