<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');

load::sys_class('common.class.php');
load::sys_func('web');

/**
 * 前台基类
 */
class web extends common {

	/**
	  * 初始化
	  */
	public function __construct() {
		parent::__construct();
		global $_M;
		define('PATH_TEM', PATH_WEB."templates/".$_M['config']['met_skin_user'].'/');//模板根目录
		$this->load_language();//语言加载
		met_cooike_start();//读取已登陆会员信息
		$this->load_publuc_data();//加载公共数据
		load::plugin('doweb');//加载插件
	}
	
	/**
	  * 重写common类的load_form方法，前台对提交的GET，POST，COOKIE进行安全的过滤处理
	  */
	protected function load_form() {
		global $_M;
		parent::load_form();
		foreach ($_M['form'] as $key => $val) {
			$_M['form'][$key] = sqlinsert($val);
		}
		if ($_M['form']['id']!='' && !is_numeric($_M['form']['id'])) {
			$_M['form']['id'] = '';
		}
		if ($_M['form']['class1']!='' && !is_numeric($_M['form']['class1'])) {
			$_M['form']['class1'] = '';
		}
		if ($_M['form']['class2']!='' && !is_numeric($_M['form']['class2'])) {
			$_M['form']['class2'] = '';
		}
		if ($_M['form']['class3']!='' && !is_numeric($_M['form']['class3'])) {
			$_M['form']['class3'] = '';
		} 
	}
	/**
	  * 重写common类的load_url_unique方法，获取前台特有URL
	  */
	protected function load_url_unique() {
		global $_M;
		$_M['url']['ui'] = $_M['url']['site'].'app/system/include/public/ui/web/';
	}
	
	
	/**
	  * 获取当前语言参数
	  */
	protected function load_language() {
		global $_M;
		$this->load_word($_M['lang'] ,0);
		$this->load_template_lang();
	}
	
	/**
	  * 获取前台公用数据
	  */
	protected function load_publuc_data() {
		global $_M;
		$this->load_flashset_data();
	}
			
	/**
	  * 获取前台模板的语言参数配置，存放在$_M['word']中，系统语言参数数组。
	  */
	protected function load_template_lang() {
		global $_M;
		$file_name = PATH_TEM."lang/language_".$_M['lang'].".ini";
		if (!file_exists($file_name)) {
			if (file_exists(PATH_TEM.'lang/language_cn.ini')) {
				$file_name = PATH_TEM.'lang/language_cn.ini';
			} else {
				$file_name = PATH_TEM.'lang/language_china.ini';
			}
		}
		if (file_exists($file_name)) {
			$fp = @fopen($file_name, "r") or die("Cannot open $file_name");
			while ($conf_line = @fgets($fp, 1024)) {    
				if (substr($conf_line,0,1)=="#") {   
					$line = ereg_replace("#.*$", "", $conf_line);
				} else {
					$line = $conf_line;
				}
				if (trim($line) == "") continue;
				$linearray = explode ('=', $line);
				$linenum = count($linearray);
				if ($linenum == 2) {
					list($name, $value) = explode ('=', $line);
				} else {
					for ($i=0;$i<$linenum;$i++) {
						$linetra=$i?$linetra."=".$linearray[$i]:$linearray[$i].'metinfo_';
					}
					list($name, $value) = explode ('metinfo_=', $linetra);
				}
				$value = str_replace("\"","&quot;",$value);
				list($value, $valueinfo) = explode ('/*', $value);
				$name = trim($name);
				$value = trim($value);
				if ($value!='#MetInfo') $_M['word'][$name] = $value;
			}
			fclose($fp) or die("Can't close file $file_name");
		}
	}
	
	/**
	  * 前台权限检测
	  * @param int 会员组编号
	  * 如果会员拥有权限则，程序代码向后正常执行，如果没有则提示没有权限。
	  */
	protected function check($power = 0) {
		global $_M;
		
		$metinfo_member_name = get_met_cookie('metinfo_admin_name');
		if (!$metinfo_member_name) {
			$metinfo_member_name = get_met_cookie('metinfo_member_name');
		}
		$metinfo_member_pass = get_met_cookie('metinfo_admin_pass');
		if (!$metinfo_member_pass) {
			$metinfo_member_pass = get_met_cookie('metinfo_member_pass');
		}
		
		$query = "SELECT * FROM {$_M['table']['admin_table']} WHERE admin_id='{$metinfo_member_name}' AND admin_pass='{$metinfo_member_pass}'";
		$membercp_ok = DB::get_one($query);
		if ($membercp_ok) {
			$query = "SELECT * FROM {$_M['table']['admin_array']} WHERE id='{$membercp_ok['usertype']}'";
			$member_ok = DB::get_one($query);
			$query = "SELECT * FROM {$_M['table']['admin_array']} WHERE id='{$power}'";
			$member_ok1 = DB::get_one($query);
			if ($member_ok['user_webpower'] < $member_ok1['user_webpower']) {
				okinfo('javascript:window.history.back();', $_M['word']['htmpermission']);
			}
		}else{
			okinfo('javascript:window.history.back();', $_M['word']['htmpermission']);
		}	
	}
	
	/**
	  * 应用兼容模式加载前台模板，会自动加载当前选定模板的顶部，尾部，左侧导航(可选)，只有内容主题可以自定义。
	  * @param string $content 页面主体内容部分调用的文件名，为自定的应用模板文件
	  * @param int    $left    收加载模板的左侧栏，2：加载会员左侧导航 1:加载一般页面左侧导航，0:不加载
	  */
	protected function custom_template($content, $left) {
		global $_M;
		$_M['custom_template']['content'] = $content;
		$_M['custom_template']['left'] = $left;
		return $this->template('ui/app');
	}
}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>