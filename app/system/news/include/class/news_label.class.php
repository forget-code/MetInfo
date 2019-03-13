<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.

defined('IN_MET') or exit('No permission');

load::mod_class('base/base_label');

/**
 * news标签类
 */

class news_label extends base_label {

	public $lang;//语言

	/**
		* 初始化
		*/
	public function __construct() {
		global $_M;
		$this->construct('news', $_M['config']['met_news_list']);
	}

	/**
	 * 获取列表数据内容（产品，图片，下载，新闻模块使用）
	 * @param  string  $id      栏目id
	 * @param  string  $rows    取的条数
	 * @param  string  $type    调用内容com(推荐)／news(最新，已废除)//all（所有）
	 * @return array        		news数组
	 */
	public function get_module_list($id, $rows, $type, $order) {
		global $_M;

		if(!$type)$type = 'all';
		return $this->handle->para_handle(
			$this->database->get_list_by_class($id, 0, $rows, $type, $order)
		);
	}

	/**
	 * 获取列表分页数据
	 * @param  string  $class1  一级栏目id
	 * @param  string  $class2  二级栏目id
	 * @param  string  $class3  三级栏目id
	 * @param  string  $page    当前分页
	 * @return array        		news数组
	 */
	public function get_list_page($id, $page) {
		global $_M;
		$page = $page > 0 ? $page : 1;
		$page = $page - 1;
		$start = $this->page_num*$page;
		$rows  = $this->page_num;
		//搜索信息
		$search = $this->search();
        if($search['type']){
            $type = $search['type'];
        }
        if($search['order']){
            $order = $search['order'];
        }
        if(!$type)$type = 'all';
        return $this->handle->para_handle(
			$this->database->get_list_by_class($id, $start, $rows, $type, $order)
		);
	}

	/**
	 * 获取列表分页数据
	 * @param  string  $class1  一级栏目id
	 * @param  string  $page    当前分页
	 * @return array        		news数组
	 */
	public function search() {
		global $_M;
		if ($_M['form']['search']) {
			$search_order = load::sys_class('label', 'new')->get('search')->get_order();
			$search_type = load::sys_class('label', 'new')->get('search')->search_info();
		}
		return array(
			'type' => $search_type,
			'order' => $search_order,
		);
	}

	/**
	 * 获取列表分页数据
	 * @param  string  $class1  一级栏目id
	 * @param  string  $page    当前分页
	 * @return array        		news数组
	 */
	public function get_page_info_by_class($id, $type) {
		global $_M;
		//分页url
		if (method_exists($this->handle, 'get_page_url')) {
			$info['url'] = $this->handle->get_page_url($id, $type);
		}
		//搜索信息
		$type = '';
		$search = $this->search();
		if($search['type']){
			$type = $search['type'];
		}
		$info['count'] = ceil($this->database->get_page_count_by_class($id, $type)/$this->page_num);
		if(!$info['count']){
			$info['count'] = 1;
		}
		return $info;
	}

	/**
	 * 获取列表分页数据
	 * @param  string  $class1  一级栏目id
	 * @return array        		分页url
	 */
	public function get_page_url($id, $type) {
		return $this->handle->get_page_url($id, $type);
	}

	/**
	 * 获取单条列表数据
	 * @param  string  $id      内容id
	 * @return array        		一个列表页面数组
	 */
	public function get_one_list_contents($id, $para = 1, $nj = 1) {
		global $_M;

		$one = $this->handle->one_para_handle(
			$this->database->get_list_one_by_id($id)
		);

		if($nj == 1){
			$preinfo = $this->handle->one_para_handle(
				$this->database->get_pre($one)
			);
			if ($preinfo) {
				$one['preinfo']['title'] =  $preinfo['title'];
				$one['preinfo']['lang'] =  $_M['word']['Previous_news'];
				$one['preinfo']['url'] =  $preinfo['url'];
				$one['preinfo']['disable'] =  '';
			} else {
				$one['preinfo']['disable'] =  'disable';
			}

			$nextinfo = $this->handle->one_para_handle(
				$this->database->get_next($one)
			);
			if ($nextinfo) {
				$one['nextinfo']['title'] =  $nextinfo['title'];
				$one['nextinfo']['lang'] =  $_M['word']['Next_news'];
				$one['nextinfo']['url'] =  $nextinfo['url'];
				$one['nextinfo']['disable'] =  '';
			} else {
				$one['nextinfo']['disable'] =  'disable';
			}
		}

		if($para == 1){
			$one['para'] = load::mod_class('parameter/parameter_label', 'new')->get_parameter_contents($this->mod , $id, $one['class1'], $one['class2'], $one['class3']);
			$one['para_url'] = load::mod_class('parameter/parameter_label', 'new')->get_parameter_contents($this->mod , $id, $one['class1'], $one['class2'], $one['class3'],10);
		}

		$class = $one['class3'] ? $one['class3'] : ($one['class2'] ? $one['class2'] : $one['class1']);
		$class123 = load::sys_class('label', 'new')->get('column')->get_class123_no_reclass($class);
		$add = $class123['class1']['content'] ? $class123['class1']['content'] : $add;
		$add = $class123['class2']['content'] ? $class123['class2']['content'] : $add;
		$add = $class123['class3']['content'] ? $class123['class3']['content'] : $add;
		$add = $add ? '<div id="metinfo_additional">'.$add.'</div>' : '';
		$one['tag'] = trim($one['tag'], '|');
		if($one['tag']){
			if(!$_M['word']['tagweb'])$_M['word']['tagweb']='TAG';
			$tags=explode('|',$one[tag]);
			foreach($tags as $key => $val){
				$list = array();
				$list['name'] = $val;
				$urlval = urlencode($val);
				if($_M['config']['met_pseudo'] || $_M['config']['met_pseudo']){
					if($_M['config']['met_defult_lang']){
						$list['url'] = "../tag/{$urlval}-{$_M['lang']}";
					}else{
						$list['url'] = "../tag/{$urlval}";
					}

				}else{
					$list['url'] = "../search/search.php?searchtype=0&searchword={$urlval}&lang={$_M['lang']}";
				}
				$tagslist[] = $list;
			}

			$tagstr="<div id=\"metinfo_tag\">{$_M['word']['tagweb']}:&nbsp";
			foreach($tagslist as $key => $val){
				$tagstr.="&nbsp<a href=\"{$val['url']}\" target=\"_blank\">{$val['name']}</a>";
			}
			$tagstr = $tagstr.'</div>';

			$one['tagstr'] = $tagstr;
			$one['tagname'] = $_M['word']['tagweb'].':';
			$one['taglist'] = $tagslist;
		}
		$one = $this->get_add_contents($one, $add);
		return $one;
	}

	/**
	 * 添加附加内容
	 * @param  array  $id      数据数组
	 * @return array        	 数据数组
	 */
	public function get_add_contents($one, $add) {
		$one['content'] .= $add;
		$one['content'] = load::sys_class('label', 'new')->get('seo')->anchor_replace($one['content']);
		return $one;
	}

}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>
