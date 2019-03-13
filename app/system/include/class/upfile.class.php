<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');

load::sys_func('file.func.php');

/** 
 * 上传文件类
 * @param string $savepath		路径,为上传文件夹（upload）下的路径
 * @param string $format		允许上传文件后缀,如zip|jpg|txt,用竖线隔开,设置的格式不能超过网站设置中的格式
 * @param string $maxsize		限制上传文件大小,单位是M,设置的大小不能超过网站设置中的大小
 * @param string $is_rename		是否重命名,1：重命名，0：不重命名
 * @param string $ext			后缀
 * 以上路径变量都必须是绝对路径，如果不使用类的set方法
 */
class upfile {
	public    $savepath;
	public    $format;
	public    $maxsize = 1073741824;
	public    $is_rename;
	
	protected $ext;
	
	public function __construct() {
		global $_M;
		$this->set_upfile();
	}
	
	/** 
	 * 设置字段
	 */
	public function set($name, $value) {
		if ($value === NULL) {
			return false;
		}
		switch ($name) {
			case 'savepath':
				$this->savepath = path_standard(PATH_WEB.'upload/'.$value);
				
			break;
			case 'format':
				$this->format = $value;
			break;
			case 'maxsize':
				$this->maxsize = min($value*1048576, $this->maxsize);
			break;
			case 'is_rename':
				$this->is_rename = $value;
			break;
		}	
	}
	
	/** 
	 * 设置上传文件模式
	 */
	public function set_upfile() {
		global $_M;
		$this->set('savepath', 'file');
		$this->set('format', $_M['config']['met_file_format']);
		$this->set('maxsize', min($_M['config']['met_file_maxsize']*1048576, 1073741824));
		$this->set('is_rename', $_M['config']['met_img_rename']);
	}
	
	/** 
	 * 设置上传图片模式
	 */
	public function set_upimg() {
		global $_M;
		$this->set('savepath', date('Ym'));
		$this->set('format', $_M['config']['met_file_format']);
		$this->set('maxsize', min($_M['config']['met_file_maxsize']*1048576, 1073741824));
		$this->set('is_rename', $_M['config']['met_img_rename']);
	}
	
	/** 
	 * 上传方法
	 * @param array $form 上传空间名，也就是input，file上传控件的name字段值
	 */
	public function upload($form = '') {
		global $_M;
		if($form){
			foreach($_FILES as $key => $val){
				if($form == $key){
					$filear = $_FILES[$key];
				}
			}
		}
		if(!$filear){
			foreach($_FILES as $key => $val){
				$filear = $_FILES[$key];
				break;
			}
		}
		//是否能正常上传
		if(!is_array($filear))$filear['error'] = 4;
		if($filear['error'] != 0 ){
			$errors = array(
				0 => $_M['word']['upfileOver4'], 
				1 => $_M['word']['upfileOver'], 
				2 => $_M['word']['upfileOver1'], 
				3 => $_M['word']['upfileOver2'], 
				4 => $_M['word']['upfileOver3'], 
				6 => $_M['word']['upfileOver5'], 
				7 => $_M['word']['upfileOver5']
			);
			$error_info[]= $errors[$filear['error']] ? $errors[$filear['error']] : $errors[0];
			return $this->error($errors[$filear['error']]);
		}
		//文件大小是否正确
		if ($filear["size"] > $this->maxsize || $filear["size"] > $_M['config']['met_file_maxsize']*1048576) {
			return $this->error("{$_M['word']['upfileFile']}".$filear["name"]." {$_M['word']['upfileMax']} {$_M['word']['upfileTip1']}");
		}
		//文件后缀是否为合法后缀
		$this->getext($filear["name"]); //获取允许的后缀
		if (strtolower($this->ext)=='php'||strtolower($this->ext)=='aspx'||strtolower($this->ext)=='asp'||strtolower($this->ext)=='jsp'||strtolower($this->ext)=='js'||strtolower($this->ext)=='asa') {
			return $this->error($this->ext." {$_M['word']['upfileTip3']}");
		}
		if ($_M['config']['met_file_format']) {
			if($_M['config']['met_file_format'] != "" && !in_array(strtolower($this->ext), explode('|',strtolower($_M['config']['met_file_format']))) && $filear){  	
				return $this->error($this->ext." {$_M['word']['upfileTip3']}");
			}
		} else {
			return $this->error($this->ext." {$_M['word']['upfileTip3']}");
		}
		if ($this->format) {
			if ($this->format != "" && !in_array(strtolower($this->ext), explode('|',strtolower($this->format))) && $filear) {  	
				return $this->error($this->ext." {$_M['word']['upfileTip3']}");
			}
		}
		//文件名重命名
		$this->set_savename($filear["name"], $this->is_rename);
		//新建保存文件
		if(stripos($this->savepath, PATH_WEB.'upload/') !== 0){
			return $this->error($_M['word']['upfileFail2']);
		}
		if (!makedir($this->savepath)) {
			return $this->error($_M['word']['upfileFail2']);
		}
		//复制文件
		$upfileok=0;
		$file_tmp=$filear["tmp_name"];
		$file_name=$this->savepath.$this->savename;
		if (stristr(PHP_OS,"WIN")) {
			$file_name = @iconv("utf-8","GBK",$file_name);
		}		
		if (function_exists("move_uploaded_file")) {
			if (move_uploaded_file($file_tmp, $file_name)) {
				$upfileok=1;
			} else if (copy($file_tmp, $file_name)) {
				$upfileok=1;
			}
		} elseif (copy($file_tmp, $file_name)) {
			$upfileok=1;
		}
		if (!$upfileok) {
			if (file_put_contents($this->savepath.'test.txt','metinfo')) {
				$_M['word']['upfileOver4']=$_M['word']['upfileOver5'];
			}
			unlink($this->savepath.'test.txt');
			$errors = array(0 => $_M['word']['upfileOver4'], 1 =>$_M['word']['upfileOver'], 2 => $_M['word']['upfileOver1'], 3 => $_M['word']['upfileOver2'], 4 => $_M['word']['upfileOver3'], 6=> $_M['word']['upfileOver5'], 7=> $_M['word']['upfileOver5']);
			$filear['error']=$filear['error']?$filear['error']:0;
			return $this->error($errors[$filear['error']]);
		} else {
			if(stripos($filear['tmp_name'], PATH_WEB) === false){
				@unlink($filear['tmp_name']); //Delete temporary files
			}
		}
		load::plugin('doqiniu_upload',0,array('savename'=>str_replace(PATH_WEB, '', $this->savepath).$this->savename,'localfile'=>$file_name));
		$back = '../'.str_replace(PATH_WEB, '', $this->savepath).$this->savename;
		return $this->sucess($back);
	}


	/**
	 * 获取后缀
	 * @param  string $filename	文件名
	 * @return string			文件后缀名
	 */
	protected function getext($filename) {
		if ($filename == "") {
			return ;
		}
		$ext = explode(".", $filename);
		return $this->ext = $ext[count($ext)-1];
	}
	
	/**
	 * 是否重命名
	 * @param  string $filename 	文件名
	 * @param  string $is_rename	是否重命名，0或1
	 * @return string 				处理后的文件名
	 */
	protected function set_savename($filename, $is_rename) {
		if ($is_rename) {
			srand((double)microtime() * 1000000);
			$rnd = rand(100, 999);
			$filename = date('U') + $rnd;
			$filename = $filename.".".$this->ext;	
		} else {
			$name_verification = explode('.',$filename);
			$verification_mun = count($name_verification);
			if($verification_mun>2){
				$verification_mun1 = $verification_mun-1;
				$name_verification1 = $name_verification[0];
				for($i=0;$i<$verification_mun1;$i++){
					$name_verification1 .= '_'.$name_verification[$i];
				}
				$name_verification1 .= '.'.$name_verification[$verification_mun1];
				$filename = $name_verification1;
			}
			$filename = str_replace(array(":", "*", "?", "|", "/" , "\\" , "\"" , "<" , ">" , "——" , " " ),'_',$filename);
			if (stristr(PHP_OS,"WIN")) {
				$filename_temp = @iconv("utf-8","GBK",$filename);
			}else
			{
				$filename_temp = $filename;
			}
			$i=0;
			$savename_temp=str_replace('.'.$this->ext,'',$filename_temp);
			while (file_exists($this->savepath.$filename_temp)) {
				$i++;
				$filename_temp = $savename_temp.'('.$i.')'.'.'.$this->ext;	
			}
			if ($i != 0) {
				$filename = str_replace('.'.$this->ext,'',$filename).'('.$i.')'.'.'.$this->ext;	
			}
		}
		return $this->savename = $filename;
	}

	/**
	 * 上传错误调用方法		
	 * @param string $error 错误信息
	 * @return array 返回错误信息
	 */
	protected function error($error){
		$back['error'] = 1;
		$back['errorcode'] = $error;
		return $back;
	}
	
	/**
	 * 上传成功调用方法
	 * @param string $path 路径
	 * @return array 返回成功路径(相对于当前路径)
	 */
	protected function sucess($path){
		$back['error']=0;
		$back['path']=$path;
		return $back;
	}
}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>