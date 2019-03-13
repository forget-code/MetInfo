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

		require $this->template('tem/index');
		
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
			/*保存*/
			deldir('upload/thumb_src/');
			$this->iniclass->tminisave($_M['form']);		
			$_M['form']['iframesrc']=urlencode($_M['form']['iframesrc']);
			turnover("{$_M[url][own_form]}a=doindex&mobile={$_M[form][mobile]}&item_index={$_M['form']['item_index']}&iframesrc={$_M['form']['iframesrc']}", $_M['word']['settings_effect']);
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
	
}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>