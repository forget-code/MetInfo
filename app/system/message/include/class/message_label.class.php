<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.

defined('IN_MET') or exit('No permission');

load::mod_class('news/news_label');

/**
 * 留言标签类
 */

class message_label extends news_label {

	public $lang;//语言

	/**
	 * 初始化
	 */
	public function __construct() {
 		global $_M;
 		$this->construct('message', $_M['config']['met_message_list']);
 	}

	/**
	 * 获取列表分页数据
	 * @param  string  $class1  一级栏目id
	 * @param  string  $page    当前分页
	 * @return array        		news数组
	 */
	// public function get_page_info_by_class($id) {
	// 	global $_M;
	// 	//分页url
	// 	$info['url'] = load::mod_class('message/message_handle', 'new')->get_page_url($this->lang);
	// 	$info['count'] = ceil(load::mod_class('message/message_database', 'new')->get_page_count($this->lang)/$_M['config']['met_message_list']);
	// 	return $info;
	// }

	/**
	 * 获取简历字段表单
	 * @return array         简历表单数组
	 */
	public function get_module_form($id){
		global $_M;
		$return['para'] = load::mod_class('parameter/parameter_label', 'new')->get_parameter_form('message', $id);
		$return['config']['url'] = load::mod_class('message/message_handle', 'new')->module_form_url($id);
		$return['config']['lang']['submit'] = $_M['word']['SubmitInfo'];
		$return['config']['lang']['title'] = '';
		return $return;
  }


  	public function get_module_value($name,$module)
  	{
  		global $_M;
  		return load::mod_class('message/message_database', 'new')->get_fd_value($name,$module);
  	}
	/**
	 * 获取简历字段表单
	 * @return array         简历表单数组
	 */
	public function get_module_form_html($id) {
		global $_M;
		$message = $this->get_module_form($id);
$str .= <<<EOT
		<form method='POST' class="met-form met-form-validation"  enctype="multipart/form-data" action='{$message['config']['url']}'>
		  <input type='hidden' name='lang' value='{$_M['lang']}' />
EOT;
		foreach($message['para'] as $key => $val){
$str .= <<<EOT
		{$val['type_html']}

EOT;
		}
$str .= <<<EOT
		  <div class="form-group m-b-0">
		    <button type="submit" class="btn btn-primary btn-block btn-squared">{$message['config']['lang']['submit']}</button>
		  </div>
		</form>
EOT;
		return $str;
	}

	/**
	 * 获取单条news
	 * @param  string  $id      内容id
	 * @return array        		一个列表页面数组
	 */
	public function insert_message($paras, $customerid,$addtime,$ip) {
		global $_M;

		if(!$paras){
			return false;
		}
		$data['ip'] = $ip ? $ip : IP;
		$data['customerid'] = $customerid;
		$data['addtime'] = $addtime;
		$data['lang'] = $_M[form][lang];

		$mid = load::mod_class('message/message_database', 'new')->insert($data);
		// dump($paras);
		// exit;
         
		
		if($mid){
			if(load::mod_class('parameter/parameter_label', 'new')->insert_list($mid, 'message', $paras)){
                 return true;
			}
		}
	}
}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>
