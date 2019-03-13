<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.

defined('IN_MET') or exit('No permission');

load::sys_class('admin.class.php');
load::mod_class('theme/class/skinc.class.php');
load::sys_func('file');

class theme extends admin {
	public $iniclass;
	function __construct() {
		global $_M;
		parent::__construct();
		$this->iniclass = new skinc($_M['form']['met_skin_user'], $_M['lang']);
	}

	function doindex() {
		global $_M;

		$file = $_M['form']['met_skin_user'] ? $_M['form']['met_skin_user'] : $_M['config']['met_skin_user'];

		if($_M['form']['from_page']=='met_template'){
			nav::set_nav(1, $_M['word']['met_template_templates'], $_M['url']['adminurl'].'anyid=44&n=met_template&c=temtool&a=dotemlist');
			nav::set_nav(2, $_M['word']['met_template_othertemplates'], "{$_M['url']['own_form']}a=doindex");
			nav::select_nav(2);
		}else{
			$_M['form']['head_no']=1;
			if(file_exists(PATH_WEB.'templates/'.$file.'/metinfo.inc.php')){
				require PATH_WEB.'templates/'.$file.'/metinfo.inc.php';
				if($metinfover == 'v2') header("location:".$_M['url']['adminurl']."n=ui_set&pageset=1");
			}
		}

		$this->checktem($file);
		$devices = 0 ;//默认电脑版
		if($_M[form][mobile])$devices = 1 ;
		$tem = DB::get_all("SELECT * FROM {$_M[table][skin_table]} WHERE devices = '{$devices}'");//获取当前选用模板
		/*清除预览*/
		DB::query("update {$_M[table][config]} SET value = '' WHERE name = 'met_theme_preview' and lang='{$_M[lang]}'");
		$item_index = $_M[form][item_index]?$_M[form][item_index]:1;
		$iframesrc = "{$_M[url][site]}index.php?lang={$_M[lang]}&theme_preview=1";
		if($_M['form']['mobile']){
			$iframesrc = $iframesrc.'&met_mobileok=1';
			$_M['config']['met_skin_user'] = $_M['config']['wap_skin_user'];
		}
		$iframesrc = $_M['form']['iframesrc']?$_M['form']['iframesrc']:$iframesrc;
		require $this->template('own/index');
	}

	function dolidb(){
		global $_M;
		$file = $_M['form']['met_skin_user'] ? $_M['form']['met_skin_user'] : $_M['config']['met_skin_user'];
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
				$inilist = $this->iniclass->tminiment(0);
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
				$inilist = $this->iniclass->tminiment(1);
				$temname = $_M[form][mobile]?'mobile_home':'oldhome';
			break;
			case 4://列表页
				$inilist = $this->iniclass->tminiment(2);
				$temname = $_M[form][mobile]?'mobile_page':'oldpage';
			break;
			case 5://详情页
				$inilist = $this->iniclass->tminiment(3);
				$temname = $_M[form][mobile]?'mobile_details':'olddetails';
			break;
		}
		require $this->template('tem/'.$temname);
	}

	/*预览与保存*/
	function doeditor(){
		global $_M;
		if($_M[form][preview]){
			/*预览*/
			$this->iniclass->tminipreview($_M['form']);
		}else{
			if(!isset($_M['form']['item_index'])){
				$this->iniclass->save_templates($_M['form']);
			}else{
				$this->iniclass->tminisave($_M['form']);
				if($_M['form']['pageset']){
					echo jsonencode(array('status'=>1));die;
				}else{
					$_M['form']['iframesrc']=urlencode($_M['form']['iframesrc']);
					turnover("{$_M[url][own_form]}a=doindex&mobile={$_M[form][mobile]}&item_index={$_M['form']['item_index']}&iframesrc={$_M['form']['iframesrc']}", $_M['word']['settings_effect']);
				}
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
				$post = array('type'=>'tem', 'no'=>$file, 'cmsver'=>$_M['config']['metcms_v'], 'authtemp'=>$out[1] );
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


	/**
	 * 设置分区 加载分区配置
	 * @DateTime 2017-11-06
	 */
	public function doset_area(){
		global $_M;
		$name = $_M['form']['name'];
		if($name){
			$query = "SELECT * FROM {$_M['table']['templates']} WHERE bigclass = (SELECT id FROM {$_M['table']['templates']} WHERE lang='{$_M['lang']}' AND no = '{$_M['config']['met_skin_user']}' AND name='{$name}')";

			$tem = DB::get_all($query);
			$iniclass = new skinc($_M['config']['met_skin_user'], $_M['lang']);
			$inilist = $iniclass->tminiment($name);
			require $this->template('tem/zujian');
		}else{
			require $this->template('tem/set_area');
		}
	}

	/**
	 * 分区栏目内容设置 返回后台栏目设置地址供前端iframe调用 临时数据
	 * @DateTime 2017-11-06
	 * @return  string $url
	 */
	public function doset_content(){
		global $_M;
		$name = $_M['form']['name'];
		$query = "SELECT value,name,valueinfo FROM {$_M['table']['templates']} WHERE bigclass = (SELECT id FROM {$_M['table']['templates']} WHERE lang='{$_M['lang']}' AND no = '{$_M['config']['met_skin_user']}' AND name='{$name}') AND type=6";
		$res = DB::get_one($query);
		$column = $res['value'];
		$url = $_M['url']['site_admin'];
		switch ($column) {
			case 1:
				$url .= "content/about/index.php?module=1&lang=cn&anyid=29";
				break;
			case 2:
				$url .= "index.php?n=content&c=article_admin&a=doindex&module=2&lang=cn&anyid=29";
				break;
			case 3:
				$url .= "index.php?n=content&c=product_admin&a=doindex&module=3&lang=cn&anyid=29";
				break;
			case 4:
				$url .= "content/download/index.php?module=4&lang=cn&anyid=29";
				break;
			case 5:
				$url .= "content/img/index.php?module=5&lang=cn&anyid=29";
				break;
			case 6:
				$url .= "content/job/index.php?class1=36&lang=cn&anyid=29";
				break;
			case 7:
				$url .= "content/message/index.php?class1=25&lang=cn&anyid=29";
				break;
			default:
				break;
		}

		$res['url'] = $url;
		echo jsonencode($res);die;
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

		$theme = load::sys_class('label','new')->get('theme');
		$content = $theme->get_field_text($table,$field,$id);
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
		$theme = load::sys_class('label','new')->get('theme');
		$content = $theme->set_field_text($table,$field,$id,$text);
		echo jsonencode($content);die;
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
		$new_img = PATH_WEB.str_replace(array($_M['url']['site'],'../'), '', $_M['form']['new_img']);
		$old_img = PATH_WEB.str_replace(array($_M['url']['site'],'../'), '', $_M['form']['old_img']);
		$info = pathinfo($old_img);

		if(file_exists($new_img)){
			if(strpos($old_img, 'thumb_src') === false){
				if($_M['form']['set_img_type']){
					// 直接覆盖老图
					rename($new_img, $old_img);
				}else{

					$bak_img = $info['dirname'].'/'.$info['filename'].'_bak.'.$info['extension'];
					rename($old_img, $bak_img);
					rename($new_img,$old_img);
				}

				$thumb_path = PATH_WEB.'upload/thumb_src/';

				$hand=opendir($thumb_path);
				while ($file=readdir($hand)){
					if(is_dir($thumb_path.$file) && $file != '.' && $file != '..'){
						@unlink($thumb_path.$file.'/'.$info['basename']);
					}
				}
			}else{
				// 如果原图是缩略图

			}
		}
		echo 1;die;
	}
}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>