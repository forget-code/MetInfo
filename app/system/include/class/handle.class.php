<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.

defined('IN_MET') or exit('No permission');

/**
 *  数据处理基类
 */

class handle {
  /**
	 * url 路径进行全站统tt
	 * @param  string  $url   url地址
	 * @return array          合法的页面变量
	 */
	public function url_transform($url){
		global $_M;
		$url = trim($url);
		if(substr($url, 0, 4) == 'http'){
			$url = $url;
		}else{
			$url = $_M['url']['site'].str_replace(array($_M['url']['site'], '../'), '', $url);
		}

		if($_M['form']['pageset']){
			if(strstr($url, '?')){
				$url .= '&pageset=1';
			}else{
				if(substr($url,-1) == '/'){
					$url .= 'index.php?lang='.$_M['lang'].'&pageset=1';
				}
				
			}
		}
		return $url; 
  }

	/**
	 * 根据模块编号，返回栏目列表遍文件名称
	 * @param  string  $mod   $mod编号
	 * @return array          合法的页面变量
	 */
	public function mod_to_name($mod){
		global $_M;
		switch ($mod) {
			case '1':
				$name =  'show';
			break;
			case '2':
				$name =  'news';
			break;
			case '3':
				$name =  'product';
			break;
			case '4':
				$name =  'download';
			break;
			case '5':
				$name =  'img';
			break;
			case '6':
				$name =  'job';
			break;
			case '7':
				$name =  'message';
			break;
			case '8':
				$name =  'feedback';
			break;
			case '9':
				$name =  'link';
			break;
			case '10':
				$name =  'member';
			break;
			case '11':
				$name =  'search';
			break;
			case '12':
				$name =  'sitemap';
			break;
			default:
				$name =  '';
			break;
		}
		return $name;
	}

	/**
	 * 根据模块编号，返回栏目列表遍文件名称
	 * @param  string  $mod   $mod编号
	 * @return array          合法的页面变量
	 */
	public function mod_to_file($mod){
		global $_M;
		switch ($mod) {
			case '1':
				$name =  'about';
			break;
			case '2':
				$name =  'news';
			break;
			case '3':
				$name =  'product';
			break;
			case '4':
				$name =  'download';
			break;
			case '5':
				$name =  'img';
			break;
			case '6':
				$name =  'job';
			break;
			case '7':
				$name =  'message';
			break;
			case '8':
				$name =  'feedback';
			break;
			case '9':
				$name =  'link';
			break;
			case '10':
				$name =  'member';
			break;
			case '11':
				$name =  'search';
			break;
			case '12':
				$name =  'sitemap';
			break;
			default:
				$name =  '';
			break;
		}
		return $name;
	}

	/**
	 * 根据模块编号，返回栏目列表遍文件名称
	 * @param  string  $mod   $mod编号
	 * @return array          合法的页面变量
	 */
	public function file_to_mod($file){
		global $_M;
		switch ($file) {
			case 'about':
				$mod =  '1';
			break;
			case 'news':
				$mod =  '2';
			break;
			case 'product':
				$mod =  '3';
			break;
			case 'download':
				$mod =  '4';
			break;
			case 'img':
				$mod =  '5';
			break;
			case 'job':
				$mod =  '6';
			break;
			case 'message':
				$mod =  '7';
			break;
			case 'feedback':
				$mod =  '8';
			break;
			case 'link':
				$mod =  '9';
			break;
			case 'member':
				$mod =  '10';
			break;
			case 'search':
				$mod =  '11';
			break;
			case 'sitemap':
				$mod =  '12';
			break;
			default:
				$mod =  '';
			break;
		}
		return $mod;
	}

	/*
	 * url类型
	 * @param  string  $type        url类型
	 * @param  string  $page_type   页面类型（2:分页，1:列表页面，0:内容页面）
	 * @return string               url类型
   */
	public function url_type($type, $page_type, $pseudo = '', $webhtm = ''){
		global $_M;
		if($pseudo === '')$pseudo = $_M['config']['met_pseudo'];
		if($webhtm === '')$webhtm = $_M['config']['met_webhtm'];
		if($_M['form']['pageset']){//搜索状态下，强制动态
			return 1;
		}
		if($_M['form']['search'] && $page_type == 2){
			return 1;
		}
		if($type){
			return $type;
		}else{
			if($page_type){
				if($pseudo){
					$type = 2;
				}else{
					if($webhtm == '2'){
						$type = 3;
					}else{
						$type = 1;
					}
				}
			}else{
				if($pseudo){
					$type = 2;
				}else{
					if($webhtm != 0){
						$type = 3;
					}else{
						$type = 1;
					}
				}
			}
		}
		return $type;
	}

	/*
	 * url类型
	 * @param  string  $module      模块名称或者模块编号
	 * @return string               模块名称编号数组
   */
	public function handle_module($module) {
		global $_M;
		if(is_numeric($module)){
			return array(
				'num' => $module,
				'name'=> $this->mod_to_file($module),
			);
		}else{
			return array(
				'num' => $this->file_to_mod($module),
				'name'=> $module,
			);
		}
	}

	public function replace_list_page_url($url, $page, $class, $type){
		global $_M;
		if($page == 1 && $class && !$_M['form']['search']){
			$c = load::sys_class('label', 'new')->get('column')->get_column_id($class);
			return load::sys_class('label', 'new')->get('column')->handle->url_full($c, $type);
		}else{
			return str_replace('#page#', $page, $url);
		}
	}


}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>
