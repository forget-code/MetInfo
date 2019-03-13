<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');

load::sys_class('web');
load::sys_class('upfile');
load::sys_func('array');

/**
 * 一个强大的上传类，可上传文件或图片，上传的图片根据所传的值控制是否生成大图水印，缩略图，缩略图水印，以及控制其下的大部分属性。
 * @param object $upfile		实例化upfile类
 * @param object $watermark 	实例化watermark类
 * @param object $thumb			实例化thumb类
 */	
class uploadify extends web {
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
		if($_M['form']['type']==1){
			if($back['error']){
				$back['error'] = $back['errorcode'];
			}else{
				$backs['path'] = $back['path'];
				$backs['append'] = 'false';
				$back = $backs;
			}
		}
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
		$imgpath = explode('../',$back['path']);
		$img_info = getimagesize(PATH_WEB.$imgpath[1]);
		$img_name = pathinfo(PATH_WEB.$imgpath[1]);
		$back['name'] = $img_name['basename']; 
		$back['path'] = $imgpath[1]; 
		$back['x'] = $img_info[0]; 
		$back['y'] = $img_info[1]; 
		echo jsonencode($back);
	}
	
	/**
	 * 上传头像
	 * @return json   		 					返回成功或失败信息，成功有路径，失败有错误信息，不过要通过json解析
	 */	
	public function dohead(){
		global $_M;
		
		$info['formname'] = $_M['form']['formname'];
		$info['savepath'] = '/head';
		$info['format'] = 'jpg|jpeg|png|gif';
		$info['maxsize'] = '5';
		$info['is_rename'] = 1;

		$back = $this->upimg($info);
		if($back['error']){
			$re['error'] = $back['errorcode'];
			echo jsonencode($re);
		}
		$file_old = PATH_WEB.str_replace('../', '', $back['path']);

		$file_new = PATH_WEB.'upload/head/'.get_met_cookie('id').'.png';
		rename($file_old, $file_new);

		
		$thumb = load::sys_class('thumb', 'new');//加载缩略图类
		//$thumb->list_module(3);//按网站列表页缩略图方式缩略图片
		$thumb->set('thumb_width', '200');//保存在原图路径的子目录下
		$thumb->set('thumb_height', '200');//保存在原图路径的子目录下
		$thumb->set('thumb_save_type', 2);//保存在原图路径的子目录下
		$thumb->set('thumb_kind', 3);//设置生成缩略图方式为裁剪
		$filePath = $file_new;//设置原图路径
		$ret = $thumb->createthumb($filePath);//生成缩略图

		$re['path'] = str_replace(PATH_WEB, '../', $file_new);
		$re['append'] = 'false';
		$re['type'] = 'head';
		
		echo jsonencode($re);
	}
	
	public function doupico(){
		global $_M;
		
		
		if(md5(md5(substr($_M['config']['met_webkeys'],0,8))) == $_M['form']['data_key']){		
			$info['formname'] = $_M['form']['formname'];
			$info['savepath'] = '/file';
			$info['format'] = 'jpeg|jpg|png|ico';
			$info['maxsize'] = '5';
			$info['is_rename'] = 1;

			$back = $this->upimg($info);
			if($back['error']){
				echo jsonencode($back);
				die();
			}
						
			$imgpath = explode('../',$back['path']);
			$img_info = getimagesize(PATH_WEB.$imgpath[1]);
			$img_name = pathinfo(PATH_WEB.$imgpath[1]);
			$back['name'] = $img_name['basename']; 
			$back['path'] = $imgpath[1]; 
			$back['x'] = $img_info[0]; 
			$back['y'] = $img_info[1]; 
		}else{
			$back['error'] = 1;
			$back['errorcode'] = '无权限上传';
			echo jsonencode($back);
			die();
		}
		$back['path'] = str_replace("//", "/", $back['path']);
		$back['original'] = str_replace("//", "/", $back['original']);
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