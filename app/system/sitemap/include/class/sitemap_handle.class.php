<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.

defined('IN_MET') or exit('No permission');

load::sys_class('handle');

/**
 * banner标签类
 */

class banner_handle extends handle{
	/**
	 * 处理图片字段
	 * @param  string  $banner 设置数组
	 * @return array           处理过后的栏目配置数组
	 */
	public function config_para_handle($banner_config){
		global $_M;
		return $banner_config;

  }

	/**
	 * 处理设置字段
	 * @param  string  $banner 设置数组
	 * @return array           处理过后的栏目图片数组
	 */
	public function img_para_handle($banner_img){
		global $_M;
		foreach($banner_img as $key=>$val){
			$banner_img[$key]['img_path'] = $this->url_transform($val['img_path']);
		}
		return $banner_img;
	}
}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>
