<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 
//开启静态页面转换伪静态URL功能
if(isset($murlid)){
	$murlids = explode('_', $murlid);
	$htmlurl_last = $murlids[count($murlids)-1];
	//是否是默认语言
	if($met_langok[$htmlurl_last]) {
		$lang = $htmlurl_last;
		unset($murlids[count($murlids)-1]);
		$htmlurl_last = $murlids[count($murlids)-1];
	}
	//列表页或内容页
	if(is_numeric($htmlurl_last) && count($murlids) != 1 && !strstr($htmlurl_last, '.')){
		$list = 1;
		$page = $htmlurl_last;
		unset($murlids[count($murlids)-1]);
	}else{
		$list = 0;
	}
	$htmlurl = implode('_', $murlids);
	if($list == 1) {
		if($htmlurl == 'message_list' || $htmlurl == 'index_list'){
			$query = "select * from {$met_column} where foldername='message' and lang='{$lang}'";
			$url_column = $db->get_one($query);
			$metid = $url_column['id'];
			if($htmlurl == 'message_list'){
				$html_met_htmlistname = 1;
			}else{
				$html_met_htmlistname = 0;
			}
		}else if(preg_match('/^(product|news|img|download|job|'.$furlid.')[_0-9]+/', $htmlurl, $out)){
			$metid = $murlids[count($murlids)-1];
			if(!preg_match('/^(product|news|img|download|job)$/', $furlid)){
				if($furlid==$out[1]){
					$html_met_htmlistname = 1;
				}else{
					$html_met_htmlistname = 0;
				}
			}
			if(count($murlids) > 2){
				$html_met_listhtmltype = 0;
			}
		}else{
			$metid = $htmlurl;
			if(!$lang){
				$url_column =array();
				$query = "select * from {$met_column} where filename='{$htmlurl}'";
				$url_column = $db->get_one($query);
				if($url_column){
					$lang = $url_column['lang'];
					$metid = $url_column['id'];
				}
			}
		}
	}else{
		if(preg_match('/^(showproduct|shownews|showimg|showdownload|about|job|[0-9]{8}|'.$furlid.')[0-9]+/', $htmlurl, $out)){
			$metid = str_replace($out[1], '',$htmlurl);
			if($fmodule != 1){
				if($out[1] == $furlid){
					$html_met_htmpagename = 2;
				}else if(is_numeric($out[1])){
					$html_met_htmpagename = 1;
				}else{
					$html_met_htmpagename = 0;
				}
			}
		}else{
			$metid = $htmlurl;
			if(!$lang){
				$url_column = array();
				$table = array();
				$query = "select * from {$met_column} where foldername='{$furlid}'";
				$url_column = $db->get_one($query);
				$table[1] = $met_column;
				$table[2] = $met_news;
				$table[3] = $met_product;
				$table[4] = $met_download;
				$table[5] = $met_img;
				$table[6] = $met_job;
				$query = "select * from {$table[$url_column[module]]} where filename='{$metid}'";
				$url_con = $db->get_one($query);
				if($url_con){
					$metid = $url_con['id'];
					$lang = $url_con['lang'];
				}
			}
		}
	}
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>