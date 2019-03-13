<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.

defined('IN_MET') or exit('No permission');

/**
 * 系统标签类
 */

class base_label {

	public $lang;//语言
	public $page_num;//分页数
	public $database;//数据库
	public $handle;//处理

	/**
	 * 初始化
	 */
	public function __construct() {
		global $_M;
		//$this->lang = $_M['lang'];
	}

	/**
	 * 初始化，继承类需要调用
	 * @param  string  $mod  模块名称
	 */
	public function construct($mod, $num) {
		global $_M;
		$this->mod = $mod;
		$this->database = load::mod_class($mod.'/'.$mod.'_database', 'new');
		$this->handle = load::mod_class($mod.'/'.$mod.'_handle', 'new');
		$this->page_num = $num;
	}

	/**
	 * 共用list标签
	 * @param  string  $mod  模块名称或id
	 * @param  string  $num  数量
	 * @param  string  $type com/news/all
	 */
	public function get_list_page_html($classnow, $pagenow) {
		global $_M;
		$pageinfo = $this->get_page_info_by_class($classnow);
		if($_M['form']['search']){
			$pageinfo['url'] .= load::sys_class('label', 'new')->get('search')->add_search_url();
		}
		$pagenow = $pagenow ? $pagenow : 1;
		$pageall = $pageinfo['count'];
		$url = $pageinfo['url'];
		$firestpage = $this->handle->replace_list_page_url($url, 1, $classnow);
		$text="<div class='met_pager'>";
		if ($pagenow == 1){     //$pagenow当前页面的码数
			if($pageall!=0){
			 $text.="<span class='PreSpan'>{$_M['word']['PagePre']}</span>";
			}
		}else{
			 $text.="<a href='".$this->handle->replace_list_page_url($url, $pagenow-1, $classnow)."' class='PreA'>{$_M['word']['PagePre']}</a>";
		}

		if($pageall >7 ){
			if($pagenow>4){
				$firstPage = "<a href='".$firestpage."' class='firstPage'>1...</a>";
				if(($pageall-$pagenow)>=4){
					$startnum=$pagenow-3;
					$endnum=$pagenow+3;
				}else{
					$startnum=$pageall-6;
					$endnum=$pageall;
				}
			}else{
				$startnum=1;
				$endnum=7;
			}
			if(($pageall-$pagenow)>3){
				$lastPage = "<a href='".$this->handle->replace_list_page_url($url, $pageall, $classnow)."' class='lastPage'>...".$pageall."</a>";
			}
		}else{
			$startnum=1;
			$endnum=$pageall;
		}

		$text.=$firstPage;

		for($i=$startnum;$i<=$endnum;$i++){
			$pageurl=$i==1?$firestpage:$this->handle->replace_list_page_url($url, $i, $classnow);
			if($i==$pagenow){$page_stylenow="class='Ahover'";}
			$text.="<a href='".$pageurl."' $page_stylenow>".$i."</a>";
			$page_stylenow='';
		}
		$text.=$lastPage;
		if ($pagenow == $pageall){
			$text.="<span class='NextSpan'>{$_M['word']['PageNext']}</span>";
		}else{
			if($pageall!=0){
				$text.="<a href='".$this->handle->replace_list_page_url($url, $pagenow+1, $classnow)."' class='NextA'>{$_M['word']['PageNext']}</a>";
			}
		}
		list($pageurl, $pageexc) = explode('#page#', $url);
		$pageurls = explode('/', $pageurl);
		if($_M['form']['search'] || $_M['form']['searchword']){
			if($_M['form']['class1']) $search_str.="&class1={$_M['form']['class1']}";
			if($_M['form']['class2']) $search_str.="&class2={$_M['form']['class2']}";
			if($_M['form']['class3']) $search_str.="&class3={$_M['form']['class3']}";
			$search_str.="&search=search";
			if($_M['form']['searchword']) $search_str.="&searchword={$_M['form']['searchword']}";
			if($_M['form']['para']){
				$para = rawurlencode($_M['form']['para']);
				$search_str.="&para={$para}";
			}

			if($_M['form']['specv']){
				$para = rawurlencode($_M['form']['specv']);
				$search_str.="&specv={$para}";
			}


		}else{
			$classnow_info=load::sys_class('label', 'new')->get('column')->get_column_id($classnow);
			$search_str="&class{$classnow_info['classtype']}={$classnow}";
		}

		if($pageall!=0){
			for($i=1;$i<=$pageall;$i++){
				if($i==$pagenow){
					if($_M['form']['search'] && $_M['form']['searchword']){
						$url = $_M['url']['site'].'search/index.php';
					}else{
						$url = 'index.php';
					}
					$text.="
					<span class='PageText'>{$_M['word']['PageGo']}</span>
					<input type='text' id='metPageT' data-pageurl='".$url."?lang={$_M['lang']}{$search_str}&page="."|".$pageexc."|".$pageall."' value='".$i."' />
					<input type='button' id='metPageB' value='".$_M['word']['Page']."' />";
				}
			}
		}

		$text .="
			</div>
		";

		return $text;
	}

	/**
	 * 共用list标签
	 * @param  string  $mod  模块名称或id
	 * @param  string  $num  数量
	 * @param  string  $type com/news/all
	 */
	public function get_list_page_select($classnow, $pagenow) {
		global $_M;
		$c = load::sys_class('label', 'new')->get('column')->get_column_id($classnow);
		$module = load::sys_class('handle', 'new')->mod_to_file($c['module']);
		$select['load'] = '查看更多';
		$select['page'] = $pagenow;
		$select['url'] = $this->get_page_url($classnow).'&ajax=1';
		return $select;
	}

}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>
