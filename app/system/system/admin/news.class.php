<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');

load::sys_class('admin');
load::sys_func('news');

class news extends admin {
	
	function __construct() {
		parent::__construct();
	}
	
	public function doindex() {
		global $_M;
		if($_M['form']['search_type']) {
			$search_url = $_M['url']['own_form']."a=doindex&search_type={$_M['form']['search_type']}";
		} else {
			$search_url = $_M['url']['own_form']."a=doindex&search_type=all";
		}
		require $this->template('own/news');
	}

	public function docurlnews() {
		global $_M;
		if($_M['config']['met_agents_metmsg'] == 1){
			$curl = load::sys_class('curl', 'new');
			$curl->set('host', 'www.metinfo.cn');
			$curl->set('file', 'metv6news.php'); 
			$curl->set('ssl', 1);
			$query = "SELECT * FROM {$_M['table']['infoprompt']} where type='metinfo' ORDER BY time DESC limit 0,1";
			$result = DB::get_one($query);
			$post = array(
				'lang' => 'cn',
				'lasttime'    => $result['time'],
			);
			$jsons = json_decode($curl->curl_post($post), 1);
			foreach($jsons as $key => $val){
				obtain(0, $val['title'], '', $val['url'], '', 'metinfo', 'metinfo', $val['time']);
			}
		}
		jsoncallback(array('new'=>count($jsons)));
	}

	public function doofficial() {
		global $_M;
		$info = news_search($_M['form']['id']);
		$time = date("Y-m-d H:i:s", $info['time']);
		require $this->template('own/official');
	}
	
	public function donews_info() {
		global $_M;
		$sval  = $_M['form']['search_title'];
		$table = load::sys_class('tabledata', 'new'); //加载表格数据获取类
		$where = "(lang='{$_M['lang']}' or lang='metinfo') ";   //整理查询条件
		if($_M['form']['search_type'] && $_M['form']['search_type'] != 'all') {
			$where .= " AND type like '%{$_M['form']['search_type']}%'";
		}
		if($sval) {
			$where .= " AND member like '%{$sval}%'";
		}
		$order = "time DESC"; //排序方式
		$array = $table->getdata($_M['table']['infoprompt'], '*', $where, $order); 
		$j=1;
		$url = '';
		foreach($array as $key => $val){
			if($val['type'] == 'job') {
				$title = $val['newstitle'];
				$news_type = $_M['word']['recruitment_information'];
				$url = $_M['url']['site_admin']."content/job/cv_editor.php?anyid=29&lang={$_M['lang']}&id={$val['news_id']}";
			}
			if(strstr($val['type'], "feedback")) {
				$title = $_M['word']['news_prompt1'];
				$news_type = $_M['word']['physicalunread1'];
				$type = explode('-',$val['type']);
				$url = $_M['url']['site_admin']."content/feedback/editor.php?anyid=29&id={$val['news_id']}&lang={$_M['lang']}&class1={$type['1']}";
			}
			if(strstr($val['type'], "message")) {
				$title = $_M['word']['news_prompt'];
				$news_type = $_M['word']['physicalunread2'];
				$type = explode('-',$val['type']);
				$url = $_M['url']['site_admin']."message/editor.php?anyid=29&id={$val['news_id']}&lang={$_M['lang']}&class1={$type['1']}";
			}
			if($val['type'] == 'official') {
				$title = $val['newstitle'];
				$news_type = $_M['word']['official_information'];
				$url = "{$_M['url']['own_form']}a=doofficial&id={$val['id']}";
			}
			if($val['type'] == 'metinfo') {
				$title = $val['newstitle'];
				$news_type = 'News';
				$url = $val['url'];
				$target = "target=\"_blank\"";
			}
			$valinfo = $val['content'];
			$val['content'] = preg_replace('#^(?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,0}'.'((?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,30}).*#s','$1',$valinfo);
			if($valinfo != $val['content']) {
				$val['content'] .= '..';
			}
			$time = date("Y-m-d H:i:s", $val['time']);
			if($val['see_ok'] == '0') {
				$color = '#656565';
			} else {
				$color = '#c5c5c9';
			}
			$list = array();
			$list[] = "<a href='{$_M['url']['own_form']}a=donews_jump&id={$val['id']}' style='color:{$color};' {$target} >{$title}</a>";
			$list[] = $time;
			$rarray[] = $list;
		}	
		$table->rdata($rarray);
	}
	
	
	public function donews_jump() {
		global $_M;
		news_dell($_M['form']['id']);
		$info = news_search($_M['form']['id']);
		if($info['type'] == 'job') {
			$news_type = $_M['word']['recruitment_information'];
			$url = $_M['url']['site_admin']."content/job/cv_editor.php?anyid=29&lang={$_M['lang']}&id={$info['news_id']}";
		}
		if(strstr($info['type'], "feedback")) {
			$news_type = $_M['word']['physicalunread1'];
			$type = explode('-',$info['type']);
			$url = $_M['url']['site_admin']."content/feedback/editor.php?anyid=29&id={$info['news_id']}&lang={$_M['lang']}&class1={$type['1']}";
		}
		if(strstr($info['type'], "message")) {
			$news_type = $_M['word']['physicalunread2'];
			$type = explode('-',$info['type']);
			$url = $_M['url']['site_admin']."content/message/editor.php?anyid=29&id={$info['news_id']}&lang={$_M['lang']}&class1={$type['1']}";
		}
		if($info['type'] == 'official') {
			$news_type = $_M['word']['official_information'];
			if(!$info['url']) {
				$url = "{$_M['url']['own_form']}a=doofficial&id={$info['id']}";
			} else {
				$url = $info['url'];
			}
		}
		if($info['type'] == 'metinfo') {
			header("location: {$info['url']}");
		}
		turnover($url, 'No prompt');
	}
	
	public function donews_del() {
		global $_M;
		$query = "delete from {$_M['table']['infoprompt']}";
		DB::query($query);
		turnover("{$_M['url']['own_form']}a=doindex", $_M['word']['jsok']);
	}
}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>