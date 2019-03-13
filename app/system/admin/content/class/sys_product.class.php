<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');

load::sys_class('admin.class.php');
load::mod_class('content/class/module');

class sys_product extends module {
	public $errorno;
	public $table;
	public $tablename;
	public $paraclass;
	public $module;
	public function __construct() {
		global $_M;
		$this->paraclass = load::sys_class('para', 'new');
		$this->tablename = $_M['table']['product'];
		$this->module = 3;
	}
	public function json_list($where, $order){
		global $_M;
		$this->table = load::sys_class('tabledata', 'new');
		
		$p = $this->tablename;
		$s = $_M['table']['shopv2_product'];
		
		if($_M['config']['shopv2_open']){//开启在线订购时
			$table = $p.' Left JOIN '.$s." ON ({$p}.id = {$s}.pid)";
			$where = "{$p}.lang='{$_M['lang']}' and ({$p}.recycle = '0' or {$p}.recycle = '-1') {$where}";
		}else{
			$table = $p;
			$where = "lang='{$_M['lang']}' and (recycle = '0' or recycle = '-1') {$where}";
		}
		
		$data = $this->table->getdata($table, '*', $where, $order);
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
		$list['content1'] = str_replace('\'','\'\'',$list['content1']);
		$list['content2'] = str_replace('\'','\'\'',$list['content2']);
		$list['content3'] = str_replace('\'','\'\'',$list['content3']);
		$list['content4'] = str_replace('\'','\'\'',$list['content4']);
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
	/*删除产品*/
	public function del_list($id,$recycle){
		global $_M;
		if($recycle){
			$query = "UPDATE {$this->tablename} SET recycle = '3' WHERE id='{$id}'";
			DB::query($query);
		}else{
			$query = "DELETE FROM {$this->tablename} WHERE id='{$id}'";
			DB::query($query);
			$query = "DELETE FROM {$_M['table']['plist']} WHERE listid='{$id}'";
			DB::query($query);
		}
	}
	/*编辑产品*/
	public function update_list($list,$id){
		global $_M;
		
		$list = $this->form_classlist($list);
		if($list['imgurl'])$list = $this->form_imglist($list,$this->module);
		//$list['updatetime'] = date("Y-m-d H:i:s");

		if($this->update_list_sql($list,$id)){
			$this->paraclass->get_para($id,3,$list['class1'],$list['class2'],$list['class3']);
			$info = $this->paraclass->form_para($list,3,$list['class1'],$list['class2'],$list['class3']);
			$this->paraclass->update_para($id,$info,3);
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
		if(!$this->check_filename($list['filename'],$id,3)){
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
			classother         = '{$list['classother']}',
			new_ok             = '{$list['new_ok']}',
			imgurl             = '{$list['imgurl']}',
			imgurls            = '{$list['imgurls']}',
			displayimg         = '{$list['displayimg']}',
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
			content1           = '{$list['content1']}',
			content2           = '{$list['content2']}',
			content3           = '{$list['content3']}',
			content4           = '{$list['content4']}',
			top_ok             = '{$list['top_ok']}'
			WHERE id='{$id}'
		";
		DB::query($query);
		return true;
	}
	/*新增产品*/
	public function insert_list($list){
		global $_M;
		
		$list = $this->form_classlist($list);
		if($list['imgurl'])$list = $this->form_imglist($list,$this->module);
		//$list['updatetime'] = date("Y-m-d H:i:s");
		$list['addtime']    = $list['addtime']?$list['addtime']:$list['updatetime'];

		$pid = $this->insert_list_sql($list);
		if($pid){
			$this->paraclass->get_para($pid,3,$list['class1'],$list['class2'],$list['class3']);
			$info = $this->paraclass->form_para($list,3,$list['class1'],$list['class2'],$list['class3']);
			$this->paraclass->update_para($pid,$info,3);
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
			classother         = '{$list['classother']}',
			new_ok             = '{$list['new_ok']}',
			imgurl             = '{$list['imgurl']}',
			imgurls            = '{$list['imgurls']}',
			displayimg         = '{$list['displayimg']}',
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
			content1           = '{$list['content1']}',
			content2           = '{$list['content2']}',
			content3           = '{$list['content3']}',
			content4           = '{$list['content4']}',
			top_ok             = '{$list['top_ok']}'
		";
		DB::query($query);
		return DB::insert_id();
	}
}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>