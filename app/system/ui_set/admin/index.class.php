<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.

defined('IN_MET') or exit('No permission');

load::sys_class('admin.class.php');
load::mod_class('ui_set/class/config_ui.class.php');
load::mod_class('ui_set/class/config_tem.class.php');
load::sys_func('file');

class index extends admin {
	public $config;
	public $no;
	public $type;
	function __construct() {
		global $_M;
		parent::__construct();
		$power = background_privilege();
		if(!($power['navigation'] == 'metinfo' || strstr($power['navigation'], '1802'))){
			Header("Location: ".$_M['url']['adminurl']);
		}
		$this->no = $_M['form']['met_skin_user'] ? $_M['form']['met_skin_user'] : $_M['config']['met_skin_user'];

		$inc_file=PATH_WEB."templates/{$this->no}/metinfo.inc.php";
		if(file_exists($inc_file)){
			require $inc_file;
		}
		if($template_type == 'ui'){
			$this->type = 'ui';
			$this->config  = new config_ui($this->no, $_M['lang']);
		}else{
			$this->type = $template_type;
			$this->config = new config_tem($this->no, $_M['lang']);
		}
	}

	function doindex() {
		global $_M;

		$file = $this->no;
		$this->checktem($file);

		$devices = 0 ;//默认电脑版
		if($_M['form']['mobile'])$devices = 1 ;
		$tem = DB::get_all("SELECT * FROM {$_M['table']['skin_table']} WHERE devices = '{$devices}'");//获取当前选用模板
		/*清除预览*/

		DB::query("update {$_M['table']['config']} SET value = '' WHERE name = 'met_theme_preview' and lang='{$_M['lang']}'");
		$item_index = $_M['form']['item_index']?$_M['form']['item_index']:1;
		$iframesrc = "{$_M['url']['site']}index.php?lang={$_M['lang']}&theme_preview=1";
		if($_M['form']['mobile']){
			$iframesrc = $iframesrc.'&met_mobileok=1';
			$_M['config']['met_skin_user'] = $_M['config']['wap_skin_user'];
		}
		$iframesrc = $_M['form']['iframesrc']?$_M['form']['iframesrc']:$iframesrc;
		$query="select * from {$_M[table][applist]} where display='2'";
		$app=DB::get_all($query);
        $apphandle = load::mod_class('ui_set/class/config_app.class.php','new');
        foreach ($app as $key => $value) {
            $value['url'] = $_M['url']['adminurl']."n={$value['m_name']}&c={$value['m_class']}&a={$value['m_action']}";
            $appname = $apphandle->standard($value);
            $value['appname'] = $appname['appname'];
            $applist[] = $value;
		}

        //后台安全提示框
        if($_M['config']['met_safe_prompt']==0){
            //判断后来路径是否包含admin和网站关键词
            $adflag = 0;
            if (preg_match("/\/admin\/$/", $_M['url']['site_admin'])) {
                $adflag = 1;
            }
            $arr1 = explode( '/',trim($_M['url']['site_admin'],'/'));
            $adfile = end($arr1);
            unset($arr1[1]);
            foreach ($arr1 as $val) {
                if(($val == $_M['config']['met_keywords'] && $_M['config']['met_keywords']) || $val == 'admin' ){
                    $adflag = 1;
                }
            }
            foreach (explode('.', $arr1[2]) as $val) {
                if ($val == $adfile  || ($val == $_M['config']['met_keywords'] && $_M['config']['met_keywords'])) {
                    $adflag = 1;
                }
            }
        }else{
            $adflag = 0;
        }
        load::app_class('met_template/admin/class/UI','new')->adminnav();
		if($_GET['pageset']){
			require $this->template('own/pageset');
		}else{
			require $this->template('own/index');
		}

	}

	function dolidb(){
		global $_M;
		$file = $this->no;
		$this->checktem($file);
		$tmpincfile=PATH_WEB."templates/{$_M[form][met_skin_user]}/metinfo.inc.php";
		if(file_exists($tmpincfile)){
			require $tmpincfile;
		}
		//列表页设置
		$m_now_time = time();
		$met_timetype[0]=array(1=>'Y-m-d H:i:s',2=>date('Y-m-d H:i:s',$m_now_time));
		$met_timetype[1]=array(1=>'Y-m-d',2=>date('Y-m-d',$m_now_time));
		$met_timetype[2]=array(1=>'Y/m/d',2=>date('Y/m/d',$m_now_time));
		$met_timetype[3]=array(1=>'Ymd',2=>date('Ymd',$m_now_time));
		$met_timetype[4]=array(1=>'Y-m',2=>date('Y-m',$m_now_time));
		$met_timetype[5]=array(1=>'Y/m',2=>date('Y/m',$m_now_time));
		$met_timetype[6]=array(1=>'Ym',2=>date('Ym',$m_now_time));
		$met_timetype[6]=array(1=>'m-d',2=>date('m-d',$m_now_time));
		$met_timetype[7]=array(1=>'m/d',2=>date('m/d',$m_now_time));
		$met_timetype[8]=array(1=>'md',2=>date('md',$m_now_time));
		$selecthtml ='';
		for($i=0;$i<9;$i++){
			$selecthtml.= "<option value=\"{$met_timetype[$i][1]}\">{$met_timetype[$i][2]}</option>";
		}

		switch($_M['form']['listdb']){

			case 2://全局
				$config_list = $this->config->list_html(0);
				$temname = $_M[form][mobile]?'mobile_overall':'oldoverall';
			break;
			case 3://首页
				$wap_ok = $_M[form][mobile]?1:0;
				if($_M[form][mobile]){
					$set = DB::get_one("select * from {$_M[table][config]} where name='flash_10001' and lang='{$_M[lang]}'");
					$_M['config']['flash_10001'] = $set['mobile_value'];
				}
				$bannerlist = DB::get_all("select * from {$_M[table][flash]} where wap_ok='{$wap_ok}' and (module like '%,10001,%' or module = 'metinfo') and lang='{$_M[lang]}' and img_path!='' order by no_order ");
				$inbaset=explode('|',$_M['config']['flash_10001']);
				$config_list = $this->config->list_html(1);
				$temname = $_M[form][mobile]?'mobile_home':'oldhome';
			break;
			case 4://列表页
				$config_list = $this->config->list_html(2);
				$temname = $_M[form][mobile]?'mobile_page':'oldpage';
			break;
			case 5://详情页
				$config_list = $this->config->list_html(3);
				$temname = $_M[form][mobile]?'mobile_details':'olddetails';
			break;
		}
		require $this->template('tem/'.$temname);
	}

	/*预览与保存*/
	function doeditor(){
		global $_M;
		if($_M['form']['preview']){
			/*预览*/
			$this->config->tminipreview($_M['form']);
		}else{

			if(isset($_M['form']['item_index'])){
				$this->config->save_configs($_M['form']);
				turnover("{$_M['url']['own_name']}c=index&a=doindex",$_M[word][jsok]);
			}else{
				$this->config->save_config($_M['form']);
				self::doclear_cache();
				echo jsonencode(array('status'=>1));die;
			}
		}
	}

	/*检测授权*/
	function checktem($file) {
		global $_M;
		$str = file_get_contents(PATH_WEB.'templates/'.$file.'/index.php');
		preg_match('/authtemp\(\'([^;]+)\'\);/', $str, $out);
		if(!$out[1]){
			$str = file_get_contents(PATH_WEB.'templates/'.$file.'/config.php');
			preg_match('/authtemp\(\'([^;]+)\'\);/', $str, $out);
		}
		if($out[1]){
			$auth_domian ="met_muban_auth_".$file;
			$muban_auth = explode(',', $_M['config'][$auth_domian]);
			$do_auth = 1;
			foreach($muban_auth as $val){
				if(stristr($_M['url']['site'], $val)){
					$do_auth = 0;
				}
			}
			if($do_auth){
				$curl = load::sys_class('curl', 'new');
				$curl->set('file', 'index.php?n=platform&c=temcheck&a=doagain_auth');
				$post = array('type'=>'tem', 'no'=>$file, 'cmsver'=>$_M['config']['metcms_v'], 'authtemp'=>$out[1]);
				$data = $curl->curl_post($post);
				list($suc, $replace, $code, $foot, $domian) = explode('|', $data);
				$replace = PATH_WEB.'templates/'.$file.'/'.$replace;
				if ($suc == 'suc') {
					$str = file_get_contents($replace);
					$str = preg_replace('/authtemp\(\'([^;]+)\'\);/', $code, $str);
					file_put_contents($replace, $str);
					$query = "SELECT * FROM {$_M['table']['config']} WHERE name = '{$auth_domian}' and lang='metinfo'";
					if (DB::get_one($query)) {
						$query = "update {$_M['table']['config']} SET value='{$domian}' WHERE name = '{$auth_domian}' and lang='metinfo'";
						DB::query($query);
					} else {
						$query = "INSERT INTO {$_M['table']['config']} SET name='{$auth_domian}',value='{$domian}',lang='metinfo'";
						DB::query($query);
					}
				}
			}
		}
	}

	public function dochange_skin()
	{
		global $_M;
		$skin_name = $_M['form']['met_skin_user'];
		$change =  $this->config->change_skin($skin_name);
		echo jsonencode(array('status'=>$change));die;
	}

	/**
	 * 设置分区 加载分区配置
	 * @DateTime 2017-11-06
	 */
	public function doset_area(){
		global $_M;
		$mid = $_M['form']['mid'];
		$url = $_M['url']['site_admin']."index.php?lang={$_M['lang']}&";
		$urls = array(
			'member'	=> $url."n=user&c=admin_set&a=doindex",
			'lang'		=> $url."n=language&c=language_admin&a=dolangset",
			'online'	=> $url."n=online&c=online&&a=doonline",
			'message_form'	=> $url."n=message&c=message_admin&&a=dosyset&class1={$_M['form']['classnow']}",
			'feedback'	=> $url."n=feedback&c=feedback_admin&&a=dosyset&class1={$_M['form']['classnow']}",
		);

		if($urls[$_M['form']['type']]){
			echo "url=".$urls[$_M['form']['type']];die;
		}
		if($urls[$_M['form']['mid']]){
			echo "url=".$urls[$_M['form']['mid']];die;
		}else{
			if(isset($mid)){
				$config = $this->config->list_html($mid);
				$config_list = $config['html'];
				$desc = $config['desc'];
				// id为ui模式
				if(is_numeric($mid)){

					require $this->template('tem/ui_zujian');
				}else{
					require $this->template('tem/zujian');
				}
			}else{
				require $this->template('tem/set_area');
			}
		}
	}

	/**
	 * 分区栏目内容设置 返回后台栏目设置地址供前端iframe调用 临时数据
	 * @DateTime 2017-11-06
	 * @return  string $url
	 */
	public function doset_content(){
		global $_M;
		$mid = $_M['form']['mid'];
		$url = $_M['url']['site_admin']."index.php?lang={$_M['lang']}&";
		if($_M['form']['module'] == 1){
			$_M['form']['id'] = $_M['form']['classnow'];
			$_M['form']['table'] = load::sys_class('handle','new')->mod_to_file($_M['form']['module']);
			unset($_M['form']['classnow']);
		}else{
			$_M['form']['table'] = load::sys_class('handle','new')->mod_to_file($_M['form']['module']);
		}
		$urls = array(
			'banner'	=> $url."n=banner&c=banner_admin&a=domanage",
			'head_nav'	=> $url."n=column&c=index&a=doindex",
			'head_seo'	=> $url."n=seo&c=seo&&a=doindex",
			'foot_nav'	=> $url."n=column&c=index&a=doindex",
			'foot'		=> $url."n=webset&c=webset&a=doindex",
			'member'	=> $url."n=user&c=admin_user&a=doindex",
			'lang'		=> $url."n=language&c=language_admin&a=doindex",
			'online'	=> $url."n=online&c=online&a=doindex",
			'link'		=> $url."n=link&c=link_admin&a=doindex",
			'message_list'	=> $url."n=message&c=message_admin&&a=doindex&class1={$_M['form']['classnow']}",
			'message_form'	=> $url."n=parameter&c=parameter_admin&a=doparaset&module=7&class1={$_M['form']['classnow']}",
			'feedback'	=> $url."n=parameter&c=parameter_admin&a=doparaset&module=8&class1={$_M['form']['classnow']}",
		);

		$classnow = $_M['form']['classnow'];
		// 根据传来的classnow获取class1,2,3
		$class = load::sys_class('label','new')->get('column')->get_class123_reclass($classnow);
		if($class['class1']){
			$class1 = $class['class1']['id'];
			$class_url = "&class1={$class1}";
		}
		if($class['class2']){
			$class2 = $class['class2']['id'];
			$class_url .= "&class2={$class2}";
		}
		if($class['class3']){
			$class3 = $class['class3']['id'];
			$class_url .= "&class3={$class3}";
		}

		if($urls[$_M['form']['type']] ){
			echo jsonencode(array('url'=>$urls[$_M['form']['type']]));die;
		}

		if($urls[$_M['form']['mid']] ){
			echo jsonencode(array('url'=>$urls[$_M['form']['mid']]));die;
		}
		if($_M['form']['id']){
			$id = $_M['form']['id'];

			// 带ID一般为详情页内容的id
			switch ($_M['form']['table']) {
				case 'about':
					$url .= "n=about&c=about_admin&a=doeditor&id={$id}";
					break;
				case 'product':
					$url.="n=product&c=product_admin&a=doeditor&id={$id}&class1_select=&class2_select=&class3_select=";
					break;
				case 'news':
					$url.="n=news&c=news_admin&a=doeditor&id={$id}&class1_select=&class2_select=&class3_select=";
					break;
				case 'download':
					$url .= "n=download&c=download_admin&a=doeditor&id={$id}&class1_select=&class2_select=&class3_select=";
					break;
				case 'img':
					$url .= "n=img&c=img_admin&a=doeditor&id={$id}&class1_select=&class2_select=&class3_select=";
					break;
				case 'column':
					$url .= "n=about&c=about_admin&a=doeditor&id={$id}&class1_select=&class2_select=&class3_select=";
					break;
				case 'job':
					$url .= "n=job&c=job_admin&&a=doindex";
					break;
				default:
					break;
			}
		}else{
			$res = $this->config->get_config_column($mid);

			if(!$res){
				$cid = $classnow;
			}elseif(is_numeric($res)){
				$url .= "n=manage&c=index&a=doindex";
			}else{
				if(is_numeric($mid)){
					$cid = $res['uip_value'] ? $res['uip_value'] : $res['uip_default'];
				}else{
					$cid = $res['value'] ? $res['value'] : $res['defaultvalue'];
				}
			}


			$mod = load::sys_class('label', 'new')->get('column')->get_column_id($cid);

				switch ($mod['module']) {
					case 1:
						$url .= "n=about&c=about_admin&a=doindex&module=1{$class_url}";
						break;
					case 2:
						$url .= "n=news&c=news_admin&a=doindex{$class_url}";
						break;
					case 3:
						$url .= "n=product&c=product_admin&a=doindex{$class_url}";
						break;
					case 4:
						$url .= "n=download&c=download_admin&a=doindex{$class_url}";
						break;
					case 5:
						$url .= "n=img&c=img_admin&a=doindex{$class_url}";
						break;
					case 6:
						$url .= "n=job&c=job_admin&a=doindex{$class_url}";
						break;
					case 7:
						$url .= "n=message&c=message_admin&a=doindex{$class_url}";
						break;
					case 8:
						$url .= "n=parameter&c=parameter_admin&a=doparaset&module=8";
						break;
					default:
						$url .= "n=manage&c=index&a=doindex";
						break;
				}
			}
		if($_M['form']['type'] == 'displayimgs'){
			$url.= '&displayimgs=1';
		}
		$info['url'] = $url;
		echo jsonencode($info);die;
	}



	public function get_time()
	{
		global $_M;
		//列表页设置
		$m_now_time = time();
		$met_timetype = array();
		$met_timetype[]=array(1=>'Y-m-d H:i:s',2=>date('Y-m-d H:i:s',$m_now_time));
		$met_timetype[]=array(1=>'Y-m-d',2=>date('Y-m-d',$m_now_time));
		$met_timetype[]=array(1=>'Y/m/d',2=>date('Y/m/d',$m_now_time));
		$met_timetype[]=array(1=>'Ymd',2=>date('Ymd',$m_now_time));
		$met_timetype[]=array(1=>'Y-m',2=>date('Y-m',$m_now_time));
		$met_timetype[]=array(1=>'Y/m',2=>date('Y/m',$m_now_time));
		$met_timetype[]=array(1=>'Ym',2=>date('Ym',$m_now_time));
		$met_timetype[]=array(1=>'m-d',2=>date('m-d',$m_now_time));
		$met_timetype[]=array(1=>'m/d',2=>date('m/d',$m_now_time));
		$met_timetype[]=array(1=>'md',2=>date('md',$m_now_time));
		$timehtml ='';
		foreach ($met_timetype as $value) {
			$timehtml.= "<option value=\"{$value[1]}\">{$value[2]}</option>";
		}

		return $timehtml;
	}
	/**
	 * 前端通过表、字段、id来获取文本内容
	 * @DateTime 2017-11-09
	 * @return   json
	 */
	public function doget_text_content(){
		global $_M;
		$table = $_M['form']['table'];
		$field = $_M['form']['field'];
		$id = $_M['form']['id'];

		load::sys_class('view/ui_compile');
		$ui_compile = new ui_compile();
		$content = $ui_compile->get_field_text($table,$field,$id);
		echo jsonencode($content);die;
	}


	/**
	 * 前端更新指定数据内容
	 * @DateTime 2017-11-09
	 * @return json 更新结果状态
	 */
	public function doset_text_content(){
		global $_M;
		$table = $_M['form']['table'];
		$field = $_M['form']['field'];
		$id = $_M['form']['id'];
		$text = $_M['form']['text'];
		load::sys_class('view/ui_compile');
		$ui_compile = new ui_compile();
		$content = $ui_compile->set_field_text($table,$field,$id,$text);

		echo jsonencode($content);die;
	}


	public function doget_public_config()
	{
		global $_M;
		$config_list = $this->config->parse_config($this->config->get_public_config());

		$time_html = $this->get_time();
		if($this->type == 'ui'){
			require $this->template('tem/public');
		}else{
			require $this->template('tem/zujian');
		}

	}

	public function doset_public_config()
	{
		global $_M;
		$configs = array(
			'met_listtime'=>$_M['form']['met_listtime'],
			'met_contenttime'=>$_M['form']['met_contenttime'],
			'met_pnorder'=>$_M['form']['met_pnorder']
		);
		$public = new config_tem($this->no, $_M['lang']);
		$public->set_page_config($configs);
		$update = $this->config->set_public_config($_M['form']);
		echo jsonencode($update);die;

	}

	public function doget_page_config()
	{
		global $_M;

		$num = $_M['form']['module'];
		$module = load::sys_class('handle', 'new')->mod_to_name($num);
		$time_html = $this->get_time();
		$detail = $_M['form']['id'];

		if($module == 'product'){

			if($detail){
				$product_detail = 1;
			}else{
				$product = 1;
			}
		}

		if($module == 'img'){
			if($detail){
				$img_detail = 1;
			}else{
				$img = 1;
			}
		}
		require $this->template('tem/page_set');
	}

	public function doset_page_config()
	{
		global $_M;
		//config中的数据统一用config_tem处理
		$this->config  = new config_tem($this->no, $_M['lang']);
		$update = $this->config->set_page_config($_M['form']);
		echo jsonencode($update);die;
	}

	/**
	 * 图片修改组件页面
	 * @return [type] [description]
	 */
	public function doset_img(){
		global $_M;
		$file = $_M['form']['met_skin_user'] ? $_M['form']['met_skin_user'] : $_M['config']['met_skin_user'];
		$this->checktem($file);
		require $this->template('tem/set_img');
	}

/**
	 * 图片修改保存
	 * @return [type] [description]
	 */
	public function dosave_img(){
		global $_M;
		$mid = $_M['form']['id'];
		$table = $_M['form']['table'];
		$field = $_M['form']['field'];
		$new_img = $_M['form']['new_img'];

		if(strpos($new_img, PATH_WEB) === false){
			load::sys_class('view/ui_compile');
			$ui_compile = new ui_compile();
			$update = $ui_compile->save_img_field($table,$field,$mid,$new_img);

			if($_M['config']['met_big_wate'] && ($table == 'product' || $table == 'news' || $table == 'img')){
				$new_img = str_replace($_M['url']['site'], '', $new_img);
				$mark = load::sys_class('watermark','new');
				$mark->set_system_bigimg();
				$mark_res = $mark->create($new_img);
				if(!$mark_res['error']){
					$ui_compile->save_img_field($table,$field,$mid,$mark_res['path']);
				}
			}

			echo jsonencode(array('status'=>intval($update)));die;
		}
		echo jsonencode(array('status'=>1));die;
	}


	public function doclear_cache()
	{
		global $_M;
		if(file_exists(PATH_WEB.'cache')){
			deldir(PATH_WEB.'cache',1);
		}

		if(file_exists(PATH_WEB.'upload/thumb_src')){
			deldir(PATH_WEB.'upload/thumb_src');
		}

		$inc_file=PATH_WEB."templates/{$this->no}/metinfo.inc.php";
		if(file_exists($inc_file)){
			require $inc_file;
			if($template_type){
				deldir(PATH_WEB.'templates/'.$_M['config']['met_skin_user'].'/cache',1);
			}
		}

		echo jsonencode(array('status'=>1));die;

	}
	/**
	 * 图标选择页面
	 * @return [type] [description]
	 */
	public function doset_icon(){
		global $_M;
		require $this->view('app/set_icon');
	}

	/**
	 * 可视化页面导航设置
	 * @return [type] [description]
	 */
	public function doset_pageset_nav(){
		global $_M;
		$query="select * from {$_M[table][applist]}";
        $list=DB::get_all($query);
        $apphandle = load::mod_class('ui_set/class/config_app.class.php','new');
        foreach ($list as $value) {
            $applist[] =$apphandle->standard($value);
        }
		require $this->template('tem/set_pageset_nav');
	}

	/**
	 * 可视化页面导航修改保存
	 * @return [type] [description]
	 */
	public function dosave_pageset_nav(){
		global $_M;
		$applist=$_M[form][applist];
		foreach ($applist as $key => $value) {
			$query="update {$_M[table][applist]} set display='{$value[display]}' where id='{$value[id]}'";
			DB::query($query);
		}
		echo jsonencode(array('status'=>1));die;
	}

	/**
	 * 可视化页面系统功能大全
	 * @return [type] [description]
	 */
	public function dofunction_ency(){
		global $_M;
		require $this->view('sys_admin/head_v2');
	}

}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>