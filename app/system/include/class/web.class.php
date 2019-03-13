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
		$this->tem_dir();//确定模板根目录
		$this->load_language();//语言加载
		//met_cooike_start();//读取已登陆会员信息
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
		//模板文件
		$query = "SELECT * FROM {$_M['table']['templates']} WHERE no='{$_M[config][met_skin_user]}' AND lang='{$_M['lang']}' order by no_order ";
		$inc = DB::get_all($query);
		$tmpincfile=PATH_WEB."templates/{$_M[config][met_skin_user]}/metinfo.inc.php";
		require $tmpincfile;
		$_M['config']['metinfover'] = $metinfover;
		foreach($inc as $key=>$val){
			$name = $val['name'];
			if($val[type]==7&&strstr($val['value'],"../upload/")&&$index=='index'&&($metinfover=='v1' || $metinfover=='v2')){//增加判断（新模板框架v2）
				$val['value']=explode("../",$val['value']);
				$val['value']=$val['value'][1];
			}
			$_M['word'][$name] = trim($val['value']);
		}
	}

	/**
	  * 前台权限检测
	  * @param int 会员组编号
	  * 如果会员拥有权限则，程序代码向后正常执行，如果没有则提示没有权限。
	  */
	protected function check($groupid = 0) {
		global $_M;
		$user = $this->get_login_user_info();
		$gourl = $_M['gourl'] ? urlencode($_M['gourl']) : urlencode('http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
		$gourl = $gourl == -1 ? "":$gourl;
		if($_M['lang'] != $_M['config']['met_index_type']){
			$lang = "&lang={$_M['lang']}";
		}
		if($groupid == 0 && !$user){
			okinfo($_M['url']['site'].'member/login.php?gourl='.$gourl.$lang, '');
		}
		$group = load::sys_class('group', 'new')->get_group($groupid);
		if($user['access'] < $group['access']){
			okinfo($_M['url']['site'].'member/login.php?gourl='.$gourl.$lang, '');
		}
	}

	/**
	  * 前台权限检测
	  * @param string m_auth 会员登陆授权码
	  * @param string m_key  会员登陆密钥
	  * 如果会员拥有权限则，程序代码向后正常执行，如果没有则提示没有权限。
	  * get_met_cookie函数兼容也调用login_by_auth,如果修改请一并修改。
	  */
	protected function get_login_user_info($met_auth = '', $met_key = '') {
		global $_M;
		$met_auth =  $met_auth ? $met_auth : $_M['form']['acc_auth'];
		$met_key  =  $met_key  ?  $met_key : $_M['form']['acc_key'];
		$userclass = load::sys_class('user', 'new');
		if($met_auth && $met_key) {
			if(!$userclass->get_login_user_info()){
				$userclass->login_by_auth($met_auth, $met_key);
			}
		}
		return $userclass->get_login_user_info();

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

	/**
	  * 确定模板根目录
	  */
	protected function tem_dir(){
		global $_M;
		$ua = strtolower($_SERVER['HTTP_USER_AGENT']);
		$uachar = "/(nokia|sony|ericsson|mot|samsung|sgh|lg|philips|panasonic|alcatel|lenovo|cldc|midp|mobile|wap|Android|ucweb)/i";
		if($ua != '' && preg_match($uachar, $ua) && $_M['config']['met_wap']){
			$_M['config']['met_skin_user'] = $_M['config']['wap_skin_user'];
		}else{
			$_M['config']['met_skin_user'] = $_M['config']['met_skin_user'];
		}
		define('PATH_TEM', PATH_WEB."templates/".$_M['config']['met_skin_user'].'/');//模板根目录
	}

	/**
	  * 销毁
	  */
	public function __destruct(){
		global $_M;
		//读取缓冲区数据
		$output = str_replace(array('<!--<!---->','<!---->','<!--fck-->','<!--fck','fck-->','',"\r",substr($admin_url,0,-1)),'',ob_get_contents());
		ob_end_clean();//清空缓冲区
		$output = $this->video_replace('/(<video.*?edui-upload-video.*?>).*?<\/video>/', $output);
		$output = $this->video_replace('/(<embed.*?edui-faked-video.*?>)/', $output);
		load::plugin('dofooter_replace',0,array('data'=>$output));
		echo $output;//输出内容
		DB::close();//关闭数据库连接
		exit;
	}

	/**
	  * 视频插件替换
	  * @param string $preg    替换的正则规则
	  * @param string $content 被替换内容
	  */
	function video_replace($preg, $content){
		preg_match_all($preg, $content, $out);
		foreach ($out[1] as $key => $val) {
			preg_match_all('/width=(\'|")([0-9]+)(\'|")/', $val, $w_out);
			$width = $w_out[2][0];

			preg_match_all('/height=(\'|")([0-9]+)(\'|")/', $val, $h_out);
			$height = $h_out[2][0];

			preg_match_all('/src=(\'|")(.+?)(\'|")/', $val, $src_out);
			$src = $src_out[2][0];

			preg_match_all('/style=(\'|")(.+?)(\'|")/', $val, $style_out);
			$style = $style_out[2][0];

			$str = "<video class=\"metvideobox\" data-metvideo=\"{$width}|{$height}||false|{$src}\" style=\"width:{$width}px; height:{$height}px; background:#000 url() no-repeat 50% 50%; background-size:contain;{$style}\" /></video>";

			$content = str_replace($out[0][$key], $str, $content);
		}
		return $content;
	}

}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>