<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');

load::sys_class('admin');
load::sys_class('upfile');
load::sys_func('array');

/**
 * 一个强大的上传类，可上传文件或图片，上传的图片根据所传的值控制是否生成大图水印，缩略图，缩略图水印，以及控制其下的大部分属性。
 * @param object $upfile		实例化upfile类
 * @param object $watermark 	实例化watermark类
 * @param object $thumb			实例化thumb类
 */	
class uploadify extends admin {
	public $upfile;
	function __construct(){
		parent::__construct();
		global $_M;
		$this->upfile = new upfile();
	}
		
	/**
	 * 设置上传属性
	 */	
	public function set_upload($info){
		global $_M;
		$this->upfile->set('savepath', $info['savepath']);
		$this->upfile->set('format', $info['format']);
		$this->upfile->set('maxsize', $info['maxsize']);
		$this->upfile->set('is_rename', $info['is_rename']);
		$this->upfile->set('is_overwrite', $info['is_overwrite']);
	}

	/**
	 * 上传函数
	 * @return json   		 					返回成功或失败信息，成功有路径，失败有错误信息，不过要通过json解析
	 */	
	public function upload($formname){
		global $_M;
		$back = $this->upfile->upload($formname);
		return $back;
	}
		
	/**
	 * 上传图片
	 * @param array	$file 	设置属性
	 */	
	public function upimg($file){
		global $_M;
		$this->upfile->set_upimg();
		$this->set_upload($file);
		$back = $this->upload($file['formname']);
		if($back['error'])return $back;
		$back['original'] = $back['path'];
		return $back;
	}
	
	/**
	 * 上传文件函数
	 * @return json   			 	返回成功或失败信息，成功有路径，失败有错误信息，不过要通过json解析
	 */
	public function doupfile(){
		global $_M;
		$this->upfile->set_upfile();
		$info['savepath'] = $_M['form']['savepath'];
		$info['format'] = $_M['form']['format'];
		$info['maxsize'] = $_M['form']['maxsize'];
		$info['is_rename'] = $_M['form']['is_rename'];
		$info['is_overwrite'] = $_M['form']['is_overwrite'];
		$this->set_upload($info);
		$back = $this->upload($_M['form']['formname']);
		echo jsonencode($back);
	}
	
	/**
	 * 上传文件
	 * @return json   		 					返回成功或失败信息，成功有路径，失败有错误信息，不过要通过json解析
	 */	
	public function doupimg(){
		global $_M;
		$infoarray = array('formname', 'savepath', 'format', 'maxsize', 'is_rename', 'is_overwrite');
		$info = copykey($_M['form'], $infoarray);
		$back = $this->upimg($info);
		echo jsonencode($back);
	}
	/**
	 * 上传错误调用方法	
	 * @return array 返回错误信息
	 */
	public function error($error){
		$back['error'] = 1;
		$back['errorcode'] = $error;
		return $back;
	}
	
	/**
	 * 上传成功调用方法
	 * @return array 返回成功路径(相对于当前路径)
	 */
	public function sucess($path){
		$back['error']=0;
		$back['path']=$path;
		return $back;
	}
	
}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>