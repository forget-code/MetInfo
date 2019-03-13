<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.

defined('IN_MET') or exit('No permission');

load::mod_class('base/admin/base_admin');

class message_admin extends base_admin {
	public $moduleclass;
	public $module;
	public $database;
	/**
	 * 初始化
	 */

	function __construct() {
		global $_M;
		parent::__construct();
		$this->module =7;
		//$this->tablename = $_M['table']['news'];
		//$this->construct(2, $_M['table']['news']);
		$this->database = load::mod_class('message/message_database', 'new');
		$this->tabledata = load::sys_class('tabledata', 'new');
		//$this->database->construct('new');
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
				turnover("./content/article/save.php?lang={$_M['lang']}&action=html&class1_select={$_M['form']['class1_select']}&class2_select={$_M['form']['class2_select']}&class3_select={$_M['form']['class3_select']}");
			}else{
				turnover("{$_M[url][own_form]}a=doindex");
			}
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
		$a = 'doeditorsave';
		$id=$_M['form']['id'];
		$query="update {$_M[table][message]} set readok='1' where lang='{$this->lang}' and id='{$_M[form][id]}'";
        DB::query($query);
		$message_contents=DB::get_one("select * from {$_M[table][config]} where lang='{$this->lang}' and name='met_message_fd_content' and columnid ='{$_M[form][class1_select]}'");
		$message_content=DB::get_one("select * from {$_M[table][parameter]} where lang='{$this->lang}' and id='$message_contents[value]' and module='{$this->module}'");
		$message_content_list=DB::get_all("select * from {$_M[table][parameter]} where lang='{$this->lang}' and id!='$message_contents[value]' and module='{$this->module}' order by no_order asc");
		$message_content1=DB::get_one("select * from {$_M[table][mlist]} where lang='{$this->lang}' and module='{$this->module}' and listid='$id' and imgname='$message_content[name]'");
		$message_content1['imgname'] = $message_content[name];
		$query1 = "SELECT * FROM {$_M[table][mlist]} WHERE lang='{$this->lang}' and module='{$this->module}' and listid='$id' and paraid!='$message_content1[paraid]' order by id";
		$result1 = DB::query($query1);

		while($list1 = DB::fetch_array($result1)){
			$para_list_tmp[$list1['paraid']]=$list1;
		}

		foreach($message_content_list as $key=>$val){
			$plist = $para_list_tmp[$val['id']];
			$para_list[$key] = $plist;

			if($val['type'] == 5){
				if($para_list[$key]['info']){
						$para_list[$key]['info'] = "<a href=\"../../{$para_list[$key]['info']}\" target=\"_blank\">{$para_list[$key][imgname]}</a>";
					}else{
						$para_list[$key]['info'] = $_M[word][nopicture];
					}

			}else{
				$para_list[$key]['info'] = $plist['info'];
			}
		}
		$message_list=DB::get_one("select * from {$_M[table][message]} where id='$id'");
		$access_option = $this->access_option('access',$message_list['access']);
		$feedacs=DB::get_one("select * from {$_M[table][admin_table]} where admin_id='{$message_list['customerid']}'");
	    $message_list['customerid']=$feedacs['usertype']==1?$_M[word][access1]:($feedacs['usertype']==2?$_M[word][access2]:($feedacs['usertype']==3?$_M[word][access3]:$_M[word][feedbackAccess0]));
		$met_readok=($message_list[checkok])?"checked='checked'":"";
		$class1 = $_M['form']['class1_select'];
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
		if($this->update_list($_M['form'],$_M['form']['id'])){
			//if($_M['config']['met_webhtm'] == 2 && $_M['config']['met_htmlurl'] == 0){

				turnover("{$_M[url][own_form]}a=doindex&class1=".$_M[form][class1_select]);

		}else{
            turnover("{$_M[url][own_form]}a=doindex&class1=".$_M[form][class1_select],$_M[word][dataerror]);
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

		$list['id'] = $id;

		load::mod_class('message/message_database', 'new')->update_fd_content($list);
		return $this->database->update_by_id($list);
		//return true;
	}

	/**
	 * 首页页面
	 */
	function doindex() {
		global $_M;
		$column = $this->column(3,$this->module);
		$class[class1]=$column[class1][0][id];
		$_M['url']['help_tutorials_helpid']='100#3、留言信息管理';
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
		//$where.= $keyword?"and customerid like '%{$keyword}%'":'';
        switch($_M[form][search_type]){
			case 0:break;
			case 1:
				$where.= "and readok = '0'";
			break;
			case 2:
				$where.= "and readok = '1'";
			break;
		}
		$messagesName1=DB::get_one("select * from {$_M[table][config]} where name='met_message_fd_class' and lang='{$this->lang}' and columnid='{$_M[form][class1]}'");
        $messagesName2=DB::get_one("select * from {$_M[table][config]} where name='met_message_fd_sms' and lang='{$this->lang}' and columnid='{$_M[form][class1]}'");
        $messagesName3=DB::get_one("select * from {$_M[table][config]} where name='met_message_fd_email' and lang='{$this->lang}' and columnid='{$_M[form][class1]}'");
	    $userlist = $this->json_list('', '');
	    $where.='order by addtime desc';
		$result =$this->tabledata->getdata($_M[table][message],'*',$where);
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
			$list[readok] = $list[readok] ? $_M[word][yes] : $_M[word][no];
			if($keyword){
                 $query="select * from {$_M[table][mlist]} where listid='$list[id]' and lang='{$this->lang}' and info like '%{$keyword}%'";
			     $parainfo=DB::get_all($query);
			     if(count($parainfo)){
			            $query="select * from {$_M[table][mlist]} where paraid='$messagesName1[value]' and listid='$list[id]' and lang='{$this->lang}'";
						$message_list1=DB::get_one($query);
						$list['name'] =$message_list1[info];
						$query="select * from {$_M[table][mlist]} where paraid='$messagesName2[value]' and listid='$list[id]' and lang='{$this->lang}'";
						$message_list2=DB::get_one($query);
						$list['tel'] =$message_list2[info];
						$query="select * from {$_M[table][mlist]} where paraid='$messagesName3[value]' and listid='$list[id]' and lang='{$this->lang}'";
						$message_list3=DB::get_one($query);
						$list['email'] =$message_list3[info];
			     }
			}else{
				       $query="select * from {$_M[table][mlist]} where paraid='$messagesName1[value]' and listid='$list[id]' and lang='{$this->lang}'";
						$message_list1=DB::get_one($query);
						$list['name'] =$message_list1[info];
						$query="select * from {$_M[table][mlist]} where paraid='$messagesName2[value]' and listid='$list[id]' and lang='{$this->lang}'";
						$message_list2=DB::get_one($query);
						$list['tel'] =$message_list2[info];
						$query="select * from {$_M[table][mlist]} where paraid='$messagesName3[value]' and listid='$list[id]' and lang='{$this->lang}'";
						$message_list3=DB::get_one($query);
						$list['email'] =$message_list3[info];
			}
			if($keyword){
				   if(($list['email'] || $list['tel'] || $list['name'])){
				   	     $message_list[]=$list;
				   }

			}else{
				     $message_list[]=$list;
			}

		}
		$admininfo = admin_information();
		foreach($message_list as $key=>$val){
			$val['url']   = $this->url($val,$this->module);
			if($val[readok]==$_M[word][yes]){
				$val['state']='<span class="label label-default">'.$_M[word][read].'</span>';
			}else{
			    $val['state']='<span class="label label-default">'.$_M[word][unread].'</span>';
			}
			$list = array();
			$list[] = "<input name=\"id\" type=\"checkbox\" value=\"{$val[id]}\">";
			$list[] =$val['customerid'];
			$list[] = $val['name'];
			$list[] = $val['tel'];
			$list[] = $val['state'];
			$list[] =$val['email'];
			$list[] = $val['readok'];
			$list[] = $val['addtime'];
			$list[] = $val['access'];
			$list[] = "<a href=\"{$_M[url][own_form]}a=doeditor&id={$val['id']}&class1_select={$_M[form][class1]}\" class=\"edit\">{$_M[word][View]}</a><span class=\"line\">-</span><a href=\"{$_M[url][own_form]}a=dolistsave&submit_type=del&allid={$val['id']}&class1_select={$_M[form][class1]}\" data-toggle=\"popover\" class=\"delet\">{$_M[word][delete]}</a>
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
			turnover("{$_M[url][own_form]}a=doindex&class1=".$_M[form][class1_select]);
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
               if($this->database->del_mlist($id) && $this->database->del_by_id($id)){
                  return true;
               }else{
                   return false;
               }
			// $query = "DELETE FROM {$this->tablename} WHERE id='{$id}'";
			// DB::query($query);
		}
	}

	/*系统参数设置*/

	public function dosyset(){
	    global $_M;
	    $fnam=DB::get_one("SELECT * FROM {$_M[table][column]} WHERE id='{$_M[form][class1]}' and lang='{$_M[form][lang]}'");


		$name_para = self::get_config_field(1);
		$email_para = self::get_config_field(9);
		$phone_para = self::get_config_field(8);
		$text_para = self::get_config_field(3);

		 $query = "SELECT * FROM {$_M[table][config]} WHERE lang='{$_M[form][lang]}' or lang='metinfo'";
            $result = DB::query($query);
            while($list_config= DB::fetch_array($result)){
                $settings_arr[]=$list_config;
                $_M[config][$list_config['name']]=$list_config['value'];
                if($metinfoadminok)$list_config['value']=str_replace('"', '&#34;', str_replace("'", '&#39;',$list_config['value']));
            }
        foreach($settings_arr as $key=>$val){
		if($val['columnid']==$fnam['id'])${$val['name']}=$val['value'];
	    }

        $met_fd_back=DB::get_one("select * from {$_M[table][config]} where name='met_fd_back' and lang='{$_M[form][lang]}' and columnid={$_M[form][class1]}");
        $_M[config][met_fd_back]= $met_fd_back[value];
        $met_fd_ok=DB::get_one("select * from {$_M[table][config]} where name='met_fd_ok' and lang='{$_M[form][lang]}' and columnid={$_M[form][class1]}");
        $_M[config][met_fd_ok]= $met_fd_ok[value];
        $met_fd_type=DB::get_one("select * from {$_M[table][config]} where name='met_fd_type' and lang='{$_M[form][lang]}' and columnid={$_M[form][class1]}");
        $_M[config][met_fd_type]= $met_fd_type[value];

        $met_fd_sms_back=DB::get_one("select * from {$_M[table][config]} where name='met_fd_sms_back' and lang='{$_M[form][lang]}' and columnid={$_M[form][class1]}");
         $_M[config][met_fd_sms_back]= $met_fd_sms_back[value];
        $met_sms_back=DB::get_one("select * from {$_M[table][config]} where name='met_sms_back' and lang='{$_M[form][lang]}' and columnid={$_M[form][class1]}");
        $_M[config][met_sms_back]= $met_sms_back[value];
        $met_fd_email=DB::get_one("select * from {$_M[table][config]} where name='met_fd_email' and lang='{$_M[form][lang]}' and columnid={$_M[form][class1]}");
        $_M[config][met_fd_email]= $met_fd_email[value];
         $met_fd_sms_content=DB::get_one("select * from {$_M[table][config]} where name='met_fd_sms_content' and lang='{$_M[form][lang]}' and columnid={$_M[form][class1]}");
        $_M[config][met_fd_sms_content]= $met_fd_sms_content[value];
        $met_fd_content=DB::get_one("select * from {$_M[table][config]} where name='met_fd_content' and lang='{$_M[form][lang]}' and columnid={$_M[form][class1]}");
        $_M[config][met_fd_content]= $met_fd_content[value];

		$met_fd_ok1[$_M[config][met_fd_ok]]="checked='checked'";
		$met_fd_email1=($_M[config][met_fd_email])?"checked":"";
		$met_fd_back1=($_M[config][met_fd_back])?"checked":"";
		$met_fd_type1=($_M[config][met_fd_type])?"checked":"";
		$met_fd_sms_back1=($_M[config][met_fd_sms_back])?"checked=":"";
		$met_sms_back1=($_M[config][met_sms_back])?"checked='checked'":"";
		$m_list = DB::get_one("SELECT * FROM {$_M[table][column]} WHERE module='{$this->module}' and lang='{$_M[form][lang]}'");
		$class1 = $m_list['id'];
		$class[class1]=$class1;
		$_M['url']['help_tutorials_helpid']='100#2、留言系统设置';

	    require $this->template('own/set');
	}

	 /*保存配置*/
	public function dosaveinc(){
      global $_M;
      $list=$_M[form];
        $query="select * from {$_M[table][config]} where (lang ='{$this->lang}' or lang ='metinfo') and columnid='{$_M[form][class1]}'";
      $res=DB::get_all($query);
      foreach ($res as $key => $value) {

      	  if($value['value']!=$_M[form][$value['name']] &&isset($_M[form][$value['name']])){
      	  	$query="UPDATE {$_M[table][config]} SET value='{$_M[form][$value['name']]}' WHERE name='{$value['name']}' and columnid='{$_M[form][class1]}' and lang='{$_M[lang]}'";
      	  	DB::query($query);
      	  }
        }
      turnover("{$_M[url][own_form]}a=dosyset&class1={$_M[form][class1]}",'');
    }

    public function get_config_field($type)
    {
    	global $_M;
    	$query = "SELECT * FROM {$_M['table']['parameter']} WHERE lang='{$_M['form']['lang']}' AND module='{$this->module}' AND type={$type}";
		$para = DB::get_all($query);
		return $para;
    }

}



# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>
