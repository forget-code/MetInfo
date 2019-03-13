<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.

defined('IN_MET') or exit('No permission');

load::sys_func('common');
load::sys_func('power');
load::sys_func('array');
load::sys_class('mysql');
load::sys_class('cache');

/**
 * 系统一级基类
 */
class common {

	/**
	  * 初始化
	  */
	public function __construct() {
		global $_M;//全局数组$_M
		ob_start();//开启缓存
		$this->load_mysql();//数据库连接
		$this->load_form();//表单过滤
		$this->load_lang();//加载语言配置
		$this->load_config_global();//加载全站配置数据
		$this->load_config_lang();//加载当前语言配置数据
		$this->load_url();//加载url数据
	}

	/**
	  * 链接数据库
	  */
	protected function load_mysql() {
		global $_M;
		$db_settings = array();
		$db_settings = parse_ini_file(PATH_CONFIG.'config_db.php');
		@extract($db_settings);
		DB::dbconn($con_db_host, $con_db_id, $con_db_pass, $con_db_name);
		$_M['config']['tablepre'] = $tablepre;
		return true;
	}

	/**
	  * 获取GET,POST,COOKIE，存放在$_M['form']，系统表单提交变量数组
	  */
	protected function load_form() {
		global $_M;
		$_M['form'] =array();
		isset($_REQUEST['GLOBALS']) && exit('Access Error');
		foreach($_COOKIE as $_key => $_value) {
			$_key{0} != '_' && $_M['form'][$_key] = daddslashes($_value);
		}
		foreach($_POST as $_key => $_value) {
			$_key{0} != '_' && $_M['form'][$_key] = daddslashes($_value);
		}
		foreach($_GET as $_key => $_value) {
			$_key{0} != '_' && $_M['form'][$_key] = daddslashes($_value);
		}
		if(!preg_match('/^[0-9A-Za-z-]+$/', $_M['form']['lang']) && $_M['form']['lang']){
			echo "No data in the database,please reinstall11.";
			die();
		}
	}

	/**
	  * 获取网站的语言设置，存放在$_M['langlist']，语言设置数组
	  */
	protected function load_lang() {
		global $_M;
		$query = "SELECT * FROM {$_M['config']['tablepre']}lang ORDER BY no_order";
		$result = DB::query($query);
		while ($list_config = DB::fetch_array($result)) {
			$list_config['order'] = $list_config['no_order'];
			if ($list_config['lang'] == 'metinfo') {
				$_M['langlist']['admin'][$list_config['mark']] = $list_config;
			} else {
				$_M['langlist']['web'][$list_config['mark']] = $list_config;
			}
		}
	}

	/**
	  * 获取网站的全局网站设置，存放在$_M['config']，网站设置数组
	  */
	protected function load_config_global() {
		global $_M;

		$this->load_config('metinfo');

		$_M['config']['met_webkeys'] = trim(file_get_contents(PATH_WEB.'/config/config_safe.php'));
		$_M['config']['met_webkeys'] = str_replace('<?php/*', '', $_M['config']['met_webkeys']);
		$_M['config']['met_webkeys'] = str_replace('*/?>', '', $_M['config']['met_webkeys']);
		if(!preg_match('/^[0-9A-Za-z]{32}$/',$_M['config']['met_webkeys'])){
			$_M['config']['met_webkeys'] = random(32);
			file_put_contents(PATH_WEB.'/config/config_safe.php', "<?php/*{$_M['config']['met_webkeys']}*/?>");
		}
		$_M['config']['met_adminfile_code'] = $_M['config']['met_adminfile'];
		$_M['config']['met_adminfile'] = authcode($_M['config']['met_adminfile'],'DECODE', $_M['config']['met_webkeys']);

		$_M['table'] = array();
		$_Mettables = explode('|', $_M['config']['met_tablename']);
		foreach ($_Mettables as $key => $val) {
			$_M['table'][$val] = $_M['config']['tablepre'].$val;
		}
		//$_M['config']['met_host_new'] = 'app.metinfo.cn';
		$_M['config']['met_host'] = $_M['config']['met_host_new'];
	}

	/**
	  * 获取网站的当前语言的网站设置，存放在$_M['config']，网站设置数组
	  */
	protected function load_config_lang() {
		global $_M;
		$_M['lang'] = $_M['form']['lang'] ? $_M['form']['lang'] : $_M['config']['met_index_type'];
		if(!$_M['langlist']['web'][$_M['lang']]){
			echo "No data in the database,please reinstall.";
			die();
		}
		$this->load_config($_M['lang']);
	}

	/**
	  * 获取网站的网站设置，存放在$_M['config']，网站设置数组
	  * @param string $lang 需要获取网站设置的语言，metinfo为全局网站设置
	  */
	protected function load_config($lang) {
		global $_M;
		$query = "SELECT * FROM {$_M['config']['tablepre']}config WHERE lang='{$lang}'";
		$result = DB::query($query);
		while ($list_config = DB::fetch_array($result)) {
			$_M['config'][$list_config['name']] = $this->filter_config($list_config['value']);
		}
	}

	/**
	  * 配置变量过滤
	  * @param string $value 配置变量
	  */
	protected function filter_config($value) {
		$value = str_replace('&#34;', '"', str_replace("&#39;", "'", $value));
		return $value;
	}

	/**
	  * 获取$_M['url']，系统URL网址数组
	  */
	protected function load_url() {
		global $_M;
		$this->load_url_site();
		$this->load_url_other();
		$this->load_url_unique();
	}

	/**
	  * 获取前台网址与后台网址
	  */
	protected function load_url_site() {
		global $_M;
		$_M['url']['site'] = $_M['config']['met_weburl'];
		$_M['url']['site_admin'] = $_M['url']['site'].$_M['config']['met_adminfile'].'/';
	}

	/**
	  * 获取其他网址，web与admin公用
	  */
	protected function load_url_other() {
		global $_M;
		$_M['url']['entrance'] = $_M['url']['site'].'app/system/entrance.php';
		if(M_TYPE == 'system'){
			$_M['url']['own'] = $_M['url']['site'].'app/'.M_TYPE.'/'.M_MODULE.'/'.M_NAME.'/';
			//$_M['url']['module'] = $_M['url']['site'].'app/'.M_TYPE.'/'.M_MODULE.'/';
		}else{
			$_M['url']['own'] = $_M['url']['site'].'app/'.M_TYPE.'/'.M_NAME.'/';
		}
		$_M['url']['app'] = $_M['url']['site'].'app/app/';
		$_M['url']['pub'] = $_M['url']['site'].'app/system/include/public/';
		$_M['url']['static'] = $_M['url']['site'].'app/system/include/static/';
		$_M['url']['api'] = 'https://'.$_M['config']['met_host'].'/'."index.php?lang=".$_M['lang'].'&';
	}

	/**
	  * 用于web与admin类加载不同的网址
	  */
	protected function load_url_unique() {
	}

	/**
	  * 获取网站的flash设置，存放在$_M['flashset']，flash设置数组
	  */
	protected function load_flashset_data($lang = '') {
		global $_M;
		$lang = $lang ? $lang : $_M['lang'];
		$query = "SELECT * FROM {$_M['config']['tablepre']}config WHERE flashid!='0' and lang='{$lang}'";
		$result = DB::query($query);
		while ($list_config = DB::fetch_array($result)) {
			$list_config['value'] = str_replace('"', '&#34;', str_replace("'", '&#39;',$list_config['value']));
			$list_config['value'] = explode('|',$list_config['value']);
			$falshval['type'] = $list_config['value'][0];
			$falshval['x'] = $list_config['value'][1];
			$falshval['y'] = $list_config['value'][2];
			$falshval['imgtype'] = $list_config['value'][3];
			$list_config['mobile_value'] = explode('|',$list_config['mobile_value']);
			$falshval['wap_type'] = $list_config['mobile_value'][0];
			$falshval['wap_y'] = $list_config['mobile_value'][1];
			$_M['flashset'][$list_config['flashid']] = $falshval;
		}
	}

	/**
	  * 获取语言参数，存放在$_M['word']，网站设置数组
	  * @param string $lang    需要获取语言参数的语言
	  * @param int    $site    获取语言参数位置，1:后台语言，2:前台语言
	  */
	protected function load_word($lang, $site) {
		global $_M;
		$query = "SELECT * FROM {$_M['table']['language']} WHERE lang='{$lang}' AND site='{$site}'";
		$result = DB::query($query);
		while ($listlang = DB::fetch_array($result)) {
			$_M['word'][$listlang['name']] = trim($listlang['value']);
		}
		$langtype = $site ? 'admin_' : '';
		$json_cache = PATH_CACHE.'lang_json_'.$langtype.$lang.'.php';
		file_put_contents($json_cache, jsonencode($_M['word']));
	}

	/**
	  * 包含模板文件
	  * @param string $path 要包含的模板文件地址，已“模板文件类型/模板文件名称”方式输入
	  * @模板文件类型：own:应用自己的模板文件，ui:系统UI模板文件，tem:模板文件
	  * @除前台模板文件外，其他包含的文件一定是php格式
	  */
	protected function template($path){
		global $_M;
		// 前缀、路径转换优化（新模板框架v2）
		$dir = explode('/',$path);
		$postion = $dir[0];
		$file = substr(strstr($path, '/'),1);

		if ($postion == 'own') {
			return PATH_OWN_FILE."templates/{$file}.php";
		}
		if ($postion == 'ui') {
			if (M_MODULE == 'admin') {
				$ui = 'admin';
			} else {
				$ui = 'web';
			}
			return PATH_SYS."include/public/ui/{$ui}/{$file}.php";
		}
		if($postion == 'tem'){
			if (M_MODULE == 'admin') {
				if(file_exists(PATH_SYS."admin/templates/web/".M_NAME."/{$file}.php")){
					return PATH_SYS."admin/templates/web/".M_NAME."/{$file}.php";
				}else{
					return PATH_SYS."admin/templates/web/{$file}.php";
				}
			} else {
				if (file_exists(PATH_TEM."{$file}.php")) {
					return PATH_TEM."{$file}.php";
				}
				if (file_exists(PATH_TEM."{$file}.html")) {
					return PATH_TEM."{$file}.html";
				}
				if (file_exists(PATH_TEM."{$file}.htm")) {
					return PATH_TEM."{$file}.htm";
				}
				return PATH_WEB."public/ui/met/{$file}.html";

			}
		}
	}

	/**
	  * 销毁
	  */
	public function __destruct(){
		global $_M;
		//读取缓冲区数据
		$output = str_replace(array('<!--<!---->','<!---->','<!--fck-->','<!--fck','fck-->','',"\r",substr($admin_url,0,-1)),'',ob_get_contents());
		ob_end_clean();//清空缓冲区
		echo $output;//输出内容
		DB::close();//关闭数据库连接
		exit;
	}
}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>