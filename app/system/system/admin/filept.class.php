<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');

load::sys_class('admin');
load::sys_func('file');
load::sys_func('array');

class filept extends admin {
	public function dogetfile() {
		global $_M;		
		$filearray = traversal(PATH_WEB.'/upload/', 'jpg|png|gif|jpeg|bmp', '((\/upload\/[0-9]{6}\/thumb)|(\/upload\/[0-9]{6}\/thumb_dis)|(\/upload\/[0-9]{6}\/watermark)|(\/upload\/thumb_src)|(\/upload\/files)|(\/upload\/images)|(\/upload\/_thumb)|(\/upload\/\.quarantine)|(\/upload\/\.tmb))');//_thumbs
		foreach($filearray as $val){
			$img_info = getimagesize(PATH_WEB.$val);
			$img_name = pathinfo(PATH_WEB.$val);
			$info['name'] = $img_name['basename']; 
			$info['path'] = $val; 
			$info['value'] = '..'.$val; 
			$info['x'] = $img_info[0]; 
			$info['y'] = $img_info[1]; 
			$info['time'] = filemtime(PATH_WEB.$val); 
			$array[] = $info;  
		}
		$arrays = arr_sort($array, 'time', SORT_DESC);
		echo jsonencode($arrays);
	}
}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>