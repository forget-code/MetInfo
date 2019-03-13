<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.

defined('IN_MET') or exit('No permission');

load::mod_class('news/news_handle');

/**
 * 留言处理类
 */

class message_handle extends news_handle {

	/**
	 * 处理留言列表字段
	 * @param  string  $message_list 留言列表数组
	 * @return array                 处理过后的留言列表
	 */
	public function para_handle($message_list){
		global $_M;
		foreach ($message_list as $key => $val) {
			$message_lists[$key] = $this->one_para_handle($val);
			$power = load::sys_class('user', 'new')->check_power($val['access']);
	            if($power < 0){
	             $message_lists[$key][useinfo]="{$_M[word][Reply]}<br>【<a href='../member/login.php?lang={$_M[lang]}'>{$_M[word][login]}</a>】【<a href='../member/register_include.php?lang={$_M[lang]}'>{$_M[word][register]}</a>】";
	            }
            }
		return $message_lists;
  }

	/**
	 * 处理设置字段
	 * @param  string  $message 设置数组
	 * @return array           处理过后的栏目图片数组
	 */
	public function one_para_handle($message) {
		global $_M;
		$message['addtime'] = date($_M['config']['met_listtime'], strtotime($message['addtime']));
		$list = load::mod_class('parameter/parameter_database', 'new')->get_list($message['id'], 7);
		foreach($list as $key => $val){
			if($val['paraid'] == $_M['config']['met_message_fd_class']){
				$message['name'] = $val['info'];
			}
			if($val['paraid'] == $_M['config']['met_message_fd_content']){
				$message['content'] = $val['info'];
			}
		}

		return $message;
	}

	/**
	 * 处理设置字段
	 * @param  string  $id     反馈栏目id
	 * @return array           提交表单地址
	 */
	public function module_form_url($id) {
		global $_M;
		$c = load::sys_class('label', 'new')->get('column')->get_column_id($id);
		return $this->url_transform('message/index.php?action=add&lang='.$_M['lang']);
	}

	/**
	 * 处理设置字段
	 * @param  string  $id     反馈栏目id
	 * @return array           提交表单地址
	 */
	// public function get_page_url($id) {
	// 	global $_M;
	// 	$c = load::sys_class('label', 'new')->get('column')->get_column_id($id);
	// 	return $this->url_transform('message/index.php?lang='.$c['lang']);
	// }

	public function get_message_config($id){
        global $_M;
        $message=load::mod_class('message/message_database','new')->get_config_by_id($id);
        foreach ($message as $key => $value) {
        	$messagecfg[$value[name]]=$value;
        }
        return $messagecfg;
	}

}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>
