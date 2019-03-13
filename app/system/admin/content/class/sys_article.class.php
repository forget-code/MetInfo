<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');

load::sys_class('admin.class.php');
load::mod_class('content/class/module');

class sys_article extends module {
	public $errorno;
	public $table;
	public $tablename;
	public $module;
	public function __construct() {
		global $_M;
		$this->tablename = $_M['table']['news'];
		$this->module = 2;
	}
	public function json_list($where, $order){
		global $_M;
		$this->table = load::sys_class('tabledata', 'new');
		$where = "lang='{$_M['lang']}' and (recycle = '0' or recycle = '-1') {$where}";
		$data = $this->table->getdata($this->tablename, '*', $where, $order);
		return $data;
	}
	public function json_return($data){
		global $_M;
		$this->table->rdata($data);
	}
	/*读取*/
	public function get_list($id){
		global $_M;
		$query = "SELECT * FROM {$this->tablename} WHERE id='{$id}'";
		$list = DB::get_one($query); 
		return $list;
	}
	/*复制*/
	public function list_copy($id,$class1,$class2,$class3){
		global $_M;
		$list = $this->get_list($id);
		$list['filename'] = '';
		$list['class1']   = $class1;
		$list['class2']   = $class2;
		$list['class3']   = $class3;
		$list['updatetime']  = date("Y-m-d H:i:s");
		$list['addtime']  = date("Y-m-d H:i:s");
		$list['content']  = str_replace('\'','\'\'',$list['content']);
		return $this->insert_list_sql($list);
	}
	/*移动产品*/
	public function list_move($id,$class1,$class2,$class3){
		global $_M;
		$query = "UPDATE {$this->tablename} SET 
			class1 = '{$class1}', 
			class2 = '{$class2}', 
			class3 = '{$class3}'
			WHERE id = '{$id}'";
		DB::query($query);
	}
	/*修改排序*/
	public function list_no_order($id,$no_order){
		global $_M;
		$query = "UPDATE {$this->tablename} SET no_order = '{$no_order}' WHERE id = '{$id}'";
		DB::query($query);
	}
	/*上架下架*/
	public function list_display($id,$display){
		global $_M;
		$query = "UPDATE {$this->tablename} SET displaytype = '{$display}' WHERE id = '{$id}'";
		DB::query($query);
	}
	/*置顶*/
	public function list_top($id,$top){
		global $_M;
		$query = "UPDATE {$this->tablename} SET top_ok = '{$top}' WHERE id = '{$id}'";
		DB::query($query);
	}
	/*推荐*/
	public function list_com($id,$com){
		global $_M;
		$query = "UPDATE {$this->tablename} SET com_ok = '{$com}' WHERE id = '{$id}'";
		DB::query($query);
	}
	/*删除*/
	public function del_list($id,$recycle){
		global $_M;
		if($recycle){
			$query = "UPDATE {$this->tablename} SET recycle = '2' WHERE id='{$id}'";
			DB::query($query);
		}else{
			$query = "DELETE FROM {$this->tablename} WHERE id='{$id}'";
			DB::query($query);
		}
	}
	/*编辑*/
	public function update_list($list,$id){
		global $_M;
		
		//$list['updatetime'] = date("Y-m-d H:i:s");

		if($list['imgurl'] == ''){
			if(preg_match('/<img.*?src=\\\\"(.*?)\\\\".*?>/i',$list['content'],$out)){
				$imgurl             = explode("upload/",$out[1]);
				$list['imgurl']     = '../upload/'.str_replace('watermark/', '',$imgurl[1]);
			}
		}
		
		$list = $this->form_imglist($list,2);
		
		if($this->update_list_sql($list,$id)){
			return true;
		}else{
			return false;
		}
		
	}
	public function update_list_sql($list,$id){
		global $_M;
		if(!$list['title']){
			return false;
		}
		if(!$this->check_filename($list['filename'],$id,$this->module)){
			return false;
		}
		if($list['links']){
			$list['links'] = url_standard($list['links']);
		}
		if($list['description']){
			$query = "SELECT content FROM {$this->tablename} WHERE id='{$id}'";
			$listown = DB::get_one($query); 
			$description = $this->description($listown['content']);
			if($list['description']==$description){
				$list['description'] = $this->description($list['content']);
			}
		}else{
			$list['description'] = $this->description($list['content']);
		}
		$query = "UPDATE {$this->tablename} SET
			title              = '{$list['title']}',
			ctitle             = '{$list['ctitle']}',
			keywords           = '{$list['keywords']}',
			description        = '{$list['description']}',
			content            = '{$list['content']}',
			class1             = '{$list['class1']}',
			class2             = '{$list['class2']}',
			class3             = '{$list['class3']}',
			imgurl             = '{$list['imgurl']}',
			imgurls            = '{$list['imgurls']}',
			com_ok             = '{$list['com_ok']}',
			wap_ok             = '{$list['wap_ok']}',
			issue              = '{$list['issue']}',
			hits               = '{$list['hits']}', 
			addtime            = '{$list['addtime']}', 
			updatetime         = '{$list['updatetime']}',
			access             = '{$list['access']}',
			filename           = '{$list['filename']}',
			no_order       	   = '{$list['no_order']}',
			lang          	   = '{$_M['lang']}',
			displaytype        = '{$list['displaytype']}',
			tag                = '{$list['tag']}',
			links              = '{$list['links']}',
			top_ok             = '{$list['top_ok']}'
			WHERE id='{$id}'
		";
		DB::query($query);
		return true;
	}
	/**
	 * 新增内容
	 * @param  前台提交的表单数组 $list 
	 * @return $pid  新增的ID 失败返回FALSE
	 */
	public function insert_list($list){
		global $_M;
		$list['addtime']    = $list['addtime']?$list['addtime']:$list['updatetime'];
		if($list['imgurl'] == ''){
			if(preg_match('/<img.*src=\\\\"(.*?)\\\\".*?>/i',$list['content'],$out)){
				$imgurl             = explode("upload/",$out[1]);
				if(count($imgurl) < 2) {
					$list['imgurl'] = $_M['config']['met_agents_img'];
				}else{
					$list['imgurl']     = '../upload/'.str_replace('watermark/', '',$imgurl[1]);
				}
				
			}else{
				$list['imgurl'] = $_M['config']['met_agents_img'];
			}
		}
		$list = $this->form_imglist($list,2);
		
		$pid = $this->insert_list_sql($list);
		if($pid){
			return $pid;
		}else{
			return false;
		}
		
	}
	public function insert_list_sql($list){
		global $_M;
		if(!$list['title']){
			return false;
		}
		if(!$this->check_filename($list['filename'],'',$this->module)){
			return false;
		}
		if($list['links']){
			$list['links'] = url_standard($list['links']);
		}
		if(!$list['description'])$list['description'] = $this->description($list['content']);
		$query = "INSERT INTO {$this->tablename} SET
			title              = '{$list['title']}',
			ctitle             = '{$list['ctitle']}',
			keywords           = '{$list['keywords']}',
			description        = '{$list['description']}',
			content            = '{$list['content']}',
			class1             = '{$list['class1']}',
			class2             = '{$list['class2']}',
			class3             = '{$list['class3']}',
			imgurl             = '{$list['imgurl']}',
			imgurls            = '{$list['imgurls']}',
			com_ok             = '{$list['com_ok']}',
			wap_ok             = '{$list['wap_ok']}',
			issue              = '{$list['issue']}',
			hits               = '{$list['hits']}', 
			addtime            = '{$list['addtime']}', 
			updatetime         = '{$list['updatetime']}',
			access             = '{$list['access']}',
			filename           = '{$list['filename']}',
			no_order       	   = '{$list['no_order']}',
			lang          	   = '{$_M['lang']}',
			displaytype        = '{$list['displaytype']}',
			tag                = '{$list['tag']}',
			links              = '{$list['links']}',
			top_ok             = '{$list['top_ok']}'
		";
		DB::query($query);
		return DB::insert_id();
	}
}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>