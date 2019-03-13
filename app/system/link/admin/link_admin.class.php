<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.

defined('IN_MET') or exit('No permission');

load::mod_class('base/admin/base_admin');

class link_admin extends base_admin {
	public $moduleclass;
	public $module;
	public $database;
	/**
	 * 初始化
	 */

	function __construct() {
		global $_M;
		parent::__construct();
		nav::set_nav(1, $_M['word']['article6'], $_M['url']['adminurl'].'anyid=37&n=seo&c=seo&a=doindex');
		nav::set_nav(2, $_M['word']['pseudostatic'], $_M['url']['adminurl'].'anyid=37&n=seo&c=seo&a=dourl');
		nav::set_nav(3, $_M['word']['staticpage'], $_M['url']['adminurl'].'anyid=37&n=html&c=html&a=doset');
        if($_M['config']['met_webhtm'] != 0)nav::set_nav(4, $_M['word']['createstatic'], $_M['url']['own_form'].'a=dohtml');
		nav::set_nav(5, $_M['word']['anchor_text'], $_M['url']['adminurl'].'anyid=37&n=seo&c=seo&a=doanchor');
		nav::set_nav(6, 'SiteMap', $_M['url']['adminurl'].'anyid=37&n=seo&c=seo&a=dositemap');
		nav::set_nav(7, $_M['word']['indexlink'], $_M['url']['own_form'].'a=doindex');
		$this->module =9;
		$this->database = load::mod_class('link/link_database', 'new');
		$this->tabledata = load::sys_class('tabledata', 'new');
		//$this->database->construct('new');
		$_M['url']['help_tutorials_helpid']='113';
	}

	/**
	 * 新增内容
	 */
	public function doadd() {
		global $_M;
		nav::select_nav(7);
		$list = $this->add();
		$a = 'doaddsave';
		$access_option = $this->access_option('access');
		$link_list[link_type]=0;
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

		if($this->insert_list($_M['form'])){
			// if(1){
			// 	turnover("./content/article/save.php?lang={$_M['lang']}&action=html&class1_select={$_M['form']['class1_select']}&class2_select={$_M['form']['class2_select']}&class3_select={$_M['form']['class3_select']}");
			// }else{
			// 	turnover("{$_M[url][own_form]}a=doindex");
			// }
			turnover("{$_M[url][own_form]}a=doindex");

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
		return $this->database->insert($list);
	}


	/**
	 * ajax检测静态文件是否重名
	 */
	function docheck_filename() {
		global $_M;
		if(!$this->moduleclass->check_filename($_M['form']['filename'], $_M['form']['id'], $this->module)){
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
		nav::select_nav(7);
		$a = 'doeditorsave';
		$id=$_M['form']['id'];
		$class1=$_M['form']['class1_select'];
		$query="select * from {$_M[table][link]} where lang='{$this->lang}' and id='{$id}'";
		$link_list=DB::get_one($query);
		require $this->template('own/article_add');
	}

	/**
	 * 修改保存页面
	 * @param  array   $list   插入的数组
	 * @return number  				 插入后的数据ID
	 */
	function doeditorsave() {
		global $_M;
		$_M['form']['addtime'] = $_M['form']['addtype']==2?$_M['form']['addtime']:date("Y-m-d H:i:s");
		if(!$_M['form']['nofollow']){
			$_M['form']['nofollow'] = '';
		}
		if($this->update_list($_M['form'],$_M['form']['id'])){
			 	turnover("{$_M[url][own_form]}a=doindex");
		}else{
			turnover("{$_M[url][own_form]}a=doindex","{$_M[word][dataerror]}");
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
		nav::select_nav(7);
		$column = $this->column(3,$this->module);
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
		$where="lang='{$this->lang}'";
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
		$where.= $keyword?"and webname like '%{$keyword}%'":'';
        switch($_M[form][search_type]){
			case 0:break;
			case 1:
				$where.= "and show_ok = '0'";
			break;
			case 2:
				$where.= "and com_ok = '1'";
			break;
			case 3:
				$where.= "and link_type ='0'";
			break;
			case 4:
				$where.= "and weblogo ='1'";
			break;
		}
		$messagesName1=DB::get_one("select * from {$_M[table][config]} where name='met_message_fd_class' and lang='{$this->lang}'");
        $messagesName2=DB::get_one("select * from {$_M[table][config]} where name='met_message_fd_sms' and lang='{$this->lang}'");
        $messagesName3=DB::get_one("select * from {$_M[table][config]} where name='met_message_fd_email' and lang='{$this->lang}'");
	    $userlist = $this->json_list('', '');
	    $where.='order by orderno desc';
		$result =$this->tabledata->getdata($_M[table][link],'*',$where);


		 foreach ($result as $key => $list) {
			$list[show_ok]=($list[show_ok])?$_M[word][yes]:$_M[word][no];
			$list[com_ok]=($list[com_ok])?$_M[word][yes]:$_M[word][no];
			$list[link_type]=($list[link_type])?$_M[word][linkType5]:$_M[word][linkType4];
		    $link_list[]=$list;
		 }

		$admininfo = admin_information();

		foreach($link_list as $key=>$val){
			$val['url']   = $this->url($val,$this->module);
			if($val[readok]==$_M[word][yes]){
				$val['state']='<span class="label label-default">'.$_M[word][read].'</span>';
			}else{
			    $val['state']='<span class="label label-default">'.$_M[word][unread].'</span>';
			}
			$list = array();
			$list[] = "<input name=\"id\" type=\"checkbox\" value=\"{$val[id]}\">";
			$list[] =$val['orderno'];
			$list[] = $val['link_type'];
			$list[] = $val['webname'];
			$list[] = $val['weburl'];
			$list[] = $val['show_ok'];
			$list[] = $val['com_ok'];
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
	    $fnam=DB::get_one("SELECT * FROM {$_M[table][column]} WHERE id='{$_M[form][class1]}' and lang='{$_M[form][lang]}'");
		$query = "select * from {$_M[table][parameter]} where lang='{$_M[form][lang]}' and module='{$this->module}' and type='1'";
		$menus=DB::query($query);
		while($list = DB::fetch_array($menus)) {
			$fd_paraall[]=$list;
		}
		$query = "select * from {$_M[table][parameter]} where lang='{$_M[form][lang]}' and module='{$this->module}' and type='3'";
		$menus=DB::query($query);
		while($list = DB::fetch_array($menus)) {
			$fd_paraalls[]=$list;
		}
		 $query = "SELECT * FROM {$_M[table][config]} WHERE lang='{$_M[form][lang]}' or lang='metinfo'";
            $result = DB::query($query);
            while($list_config= DB::fetch_array($result)){
                $settings_arr[]=$list_config;
                $_M[config][$list_config['name']]=$list_config['value'];
                if($metinfoadminok)$list_config['value']=str_replace('"', '&#34;', str_replace("'", '&#39;',$list_config['value']));
            }
        foreach($settings_arr as $key=>$val){
		if($val['columnid']==$fnam['id'])$$val['name']=$val['value'];
	    }
		$met_fd_ok1[$_M[config][met_fd_ok]]="checked='checked'";
		$met_fd_email1=($_M[config][met_fd_email])?"checked":"";
		$met_fd_back1=($_M[config][met_fd_back])?"checked":"";
		$met_fd_type1=($_M[config][met_fd_type])?"checked":"";
		$met_fd_sms_back1=($_M[config][met_fd_sms_back])?"checked=":"";
		$met_sms_back1=($_M[config][met_sms_back])?"checked='checked'":"";
		$m_list = DB::get_one("SELECT * FROM {$_M[table][column]} WHERE module='{$this->module}' and lang='{$_M[form][lang]}'");
		$class1 = $m_list['id'];
	    require $this->template('own/set');
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
      turnover("{$_M[url][own_form]}a=dosyset&class1={$_M[form][class1]}",'');
    }

}



# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>
