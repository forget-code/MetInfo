<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.

defined('IN_MET') or exit('No permission');

load::sys_func('admin');
/**
 * img标签类
 */

class html_op {

	/**
		* 初始化
		*/
	public function __construct() {
		global $_M;

	}

	/**
	 * 跳转至静态页面生成
	 * @param  string  $url        	url id
	 * @param  string  $column_list 栏目id
	 * @param  string  $id_list     内容id
	 */
	public function html_generate($url, $column_list, $id_list) {
		global $_M;
		load::sys_class('label', 'new')->get('seo')->site_map();
		if($_M['config']['met_webhtm'] != 0 && $_M['config']['met_htmway'] == 0){
			$url = urlencode($url);
			turnover("{$_M['url']['site_admin']}index.php?lang={$_M['lang']}&n=html&c=html&a=dogenerate&auto=1&reurl={$url}&column_list={$column_list}&id_list={$id_list}");
		}else{
			turnover($url);
		}
	}

}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>
