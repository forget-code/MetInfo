<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.

defined('IN_MET') or exit('No permission');

load::mod_class('base/base_handle');

/**
 * banner标签类
 */

class news_handle extends base_handle{

	public function __construct() {
		global $_M;
		$this->construct('news');
	}

	/**
	 * 处理list数组
	 * @param  string  $list 处理列表数组
	 * @return array         处理过后数组
	 */
	public function para_handle($list) {
		global $_M;
		foreach ($list as $key => $val) {
			$list[$key] = $this->one_para_handle($val);
		}
		return $list;
	}

	/**
	 * 处理list数组
	 * @param  string  $content 内容数组
	 * @return array           	处理过后数组
	 */
	public function one_para_handle($content) {
		global $_M;
		if ($content) {
			//$content['url'] = $this->url_transform($this->contents_page_name . '/show' . $this->contents_page_name . '.php?lang=' . $content['lang'] . '&id=' . $content['id']);
			$content['url'] = $this->get_content_url($content);
			if($content['imgurl'])$content['imgurl'] = $this->url_transform($content['imgurl']);
			if($content['imgurls'])$content['imgurls'] = $this->url_transform($content['imgurls']);
			$content['original_updatetime'] = $content['updatetime'];
			$content['updatetime'] = date($_M['config']['met_listtime'], strtotime($content['updatetime']));
			$content['original_addtime'] = $content['addtime'];
			$content['addtime'] = date($_M['config']['met_listtime'], strtotime($content['addtime']));
			if($content['new_windows']){
				$content['target'] = 'target="_blank"';
			}else{
				$content['target'] = '';
			}
			if($_M['form']['id']){
				$list = 0;
			}else{
				$list = 1;
			}

			if($_M['form']['ajax']){
				$src = 'data-src';
				$ajax = '&ajax=1';
			}else{
				$src = 'src';
			}
			$content['hits'] = "<script type='text/javascript' class='met_hits' {$src}=\"{$_M['url']['site']}hits/?lang={$_M['lang']}&type={$this->contents_page_name}&vid={$content['id']}&list={$list}{$ajax}\"></script>";
			$content['content'] = contentshow($content['content']);
		}
		return $content;
	}

	/**
	 * 返回分页url
	 * @param  string  $id 栏目id
	 * @return string
	 */
	public function get_page_url($id, $type){
		$c = load::sys_class('label', 'new')->get('column')->get_column_id($id);
		$class = load::sys_class('label', 'new')->get('column')->get_class123_no_reclass($id);
		return $this->get_list_page_url($class['class1']['id'], $class['class2']['id'], $class['class3']['id'], $c['foldername'], $this->contents_page_name, $c['filename'], $c['lang'], $type);
	}

	/**
	 * 返回分页url
	 * @param  string  $id 栏目id
	 * @return string
	 */
	public function get_content_url($content, $type=''){
		if($content['links']){
			return $content['links'];
		}else{
			$c = load::sys_class('label', 'new')->get('column')->get_column_id($content['class1']);
			$addtime = $content['original_addtime'] ? $content['original_addtime'] : $content['addtime'];
			return $this->url_add_contents_filename($c['foldername'], $this->contents_page_name, $content['id'], $content['filename'], $content['lang'], $addtime, $type);
		}
	}

	public function url_add_page($type){
		global $_M;
		switch ($type) {
			case '1'://动态
				$pname = "&page=#page#";
			break;
			case '2'://伪静态
				$pname = "-#page#";
			break;
			case '3'://静态
				$pname = "_#page#";
			break;
		}
		return $pname;
	}

	public function url_add_lang($type, $lang , $mod = 0){
		global $_M;
		$lname = '';
		if(($lang && $lang != $_M['config']['met_index_type'])){
			switch ($type) {
				case '1'://动态
					$lname = "&lang={$lang}";
				break;
				case '2'://伪静态
					$lname = "-{$lang}";
				break;
				case '3'://静态
					$lname = "_{$lang}";
				break;
			}
		}else{
			if($type == 2){
				if($_M['config']['met_index_type'] != $lang){
					$lname = "-{$lang}";
				}else {
					if($_M['config']['met_defult_lang']){
						$lname = "-{$lang}";
					}
				}
			}else{
				return '';
			}
		}
		return $lname;
	}

	public function url_add_list_filename($type, $filename, $column_file, $module_name){
		global $_M;
		switch ($type) {
			case '1'://动态
				$fname = 'index.php';
			break;
			case '2'://伪静态
				if($filename){
					$fname = 'list-'.$filename;
				}else{
					$fname = 'list';
				}
			break;
			case '3'://静态
				if($filename){
					$fname = $filename;
				}else{
					if($_M['config']['met_htmlistname']){
						$fname = $column_file;
					}else{
						$fname = $module_name;
					}
				}
			break;
		}
		return $fname;
	}

	public function url_add_suffix($type){
		global $_M;
		switch ($type) {
			case '1'://动态
				$sname = '';
			break;
			case '2'://伪静态
				$sname = '.html';
			break;
			case '3'://静态
				$sname = '.'.$_M['config']['met_htmtype'];
			break;
		}
		return $sname;
	}

	public function url_add_list_class($type, $column_class1, $column_class2, $column_class3, $filename){
		global $_M;
		$idname = '';
		switch ($type) {
			case '1'://动态
				$idname = $column_class1 ? "?class1=$column_class1" : $idname;
				$idname = $column_class2 ? "?class2=$column_class2" : $idname;
				$idname = $column_class3 ? "?class3=$column_class3" : $idname;
			break;
			case '2'://伪静态
				$idname = $column_class1 ? "-$column_class1" : $idname;
				$idname = $column_class2 ? "-$column_class2" : $idname;
				$idname = $column_class3 ? "-$column_class3" : $idname;
				if($filename)$idname = '';
			break;
			case '3'://静态
				if($_M['config']['met_listhtmltype']){
					$class_now = $column_class3 ? $column_class3 : ($column_class2 ? $column_class2 : $column_class1);
					$idname = "_{$class_now}";
				}else{
					$idname .= $column_class1 ? "_{$column_class1}" : '';
					$idname .= $column_class2 ? "_{$column_class2}" : '';
					$idname .= $column_class3 ? "_{$column_class3}" : '';
				}
				if($filename)$idname = '';
			break;
		}
		return $idname;
	}

	public function url_add_content_filename($type, $id, $column_file, $module_name, $addtime, $filename){
		global $_M;
		$cdname = '';
		switch ($type) {
			case '1'://动态
				$cdname = "show".$module_name.'.php';
			break;
			case '2'://伪静态
				if($filename){
					$cdname = $filename;
				}
			break;
			case '3'://静态
			if($filename){
					$cdname = $filename;
				}else{
					switch ($_M['config']['met_htmpagename']) {
						case 0:
							$cdname = 'show'.$module_name;
						break;
						case 1:
							$cdname = date('YmdH',strtotime($addtime));
						break;
						case 2:
							$cdname = $column_file;
						break;
						case 3:
							$cdname = '';
						break;
					}
				}
			break;
		}
		return $cdname;
	}
	public function url_add_id($type, $id, $column_file, $module_name, $filename){
		global $_M;
		$idname = '';
		switch ($type) {
			case '1'://动态
				$idname = "?id=$id";
			break;
			case '2'://伪静态
				if($filename){
					$idname = '';
				}else{
					$idname = $id;
				}
			break;
			case '3'://静态
				if($filename){
					$idname = '';
				}else{
					$idname = $id;
				}
			break;
		}
		return $idname;
	}

	public function url_add_contents_filename($column_file, $module_name, $id, $filename, $lang, $addtime, $type = ''){
		global $_M;
		// if(!$type){
		// 	if($_M['config']['met_pseudo']){
		// 		$type = 2;
		// 	}else if($_M['config']['met_webhtm'] != 0){
		// 		$type = 3;
		// 	}else{
		// 		$type = 1;
		// 	}
		// }
		$type = $this->url_type($type, 0);
		if($type == 1){
			$mod = 1;
		}else{
			$mod = 0;
		}
		$url .= $column_file.'/';
		$url .= $this->url_add_content_filename($type, $id, $column_file, $module_name, $addtime, $filename);
		$url .= $this->url_add_id($type, $id, $column_file, $module_name, $filename);
		$url .= $this->url_add_lang($type, $lang , $mod);
		$url .= $this->url_add_suffix($type);
		$url = $this->url_transform($url);
		if($type == 1){
			$url = str_replace('.php&', '.php?', $url);
		}
		return $url;
	}

	public function get_list_page_url($column_class1, $column_class2, $column_class3, $column_file, $module_name, $filename, $lang, $type = ''){
		global $_M;
		$url .= $column_file.'/';
		// if(!$type){
		// 	if($_M['config']['met_pseudo']){
		// 		$type = 2;
		// 	}else if($_M['config']['met_webhtm'] == '2'){
		// 		$type = 3;
		// 	}else{
		// 		$type = 1;
		// 	}
		// }
		$type = $this->url_type($type, 2);
		$url .= $this->url_add_list_filename($type, $filename, $column_file, $module_name);
		$url .= $this->url_add_list_class($type, $column_class1, $column_class2, $column_class3, $filename);
		$url .= $this->url_add_page($type);
		$url .= $this->url_add_lang($type, $lang);
		$url .= $this->url_add_suffix($type);
		$url = $this->url_transform($url);
		if($type == 1){
			$url = str_replace('.php&', '.php?', $url);
		}
		return $url;
	}

}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>
