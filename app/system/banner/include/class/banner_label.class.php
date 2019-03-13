<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.

defined('IN_MET') or exit('No permission');

/**
 * banner标签类
 */

class banner_label {

	public $lang;

	/**
		* 初始化
		*/
	public function __construct() {
		global $_M;
		$this->lang = $_M['lang'];
	}

  /**
	 * 获取所有banner栏目配置//兼容系统v5
	 * @return array         banner栏目配置数组
	 */
	public function get_config(){
		$banner = load::mod_class('banner/banner_database', 'new')->get_banner_config_by_lang($this->lang);
		return load::mod_class('banner/banner_handle', 'new')->config_para_handle($banner);
  }

	/**
	 * 获取所有栏目benner图片列表//兼容系统v5
	 * @return array         banner图片列表
	 */
	public function get_img(){
		$banner = load::mod_class('banner/banner_database', 'new')->get_banner_img_by_lang($this->lang);
		return load::mod_class('banner/banner_handle', 'new')->img_para_handle($banner);
	}

	/**
	 * 获取指定栏目banner图片和配置//系统v6使用
	 * @param  string  $id    栏目id
	 * @return array          指定栏目banner图片和配置数组
	 */
	public function get_column_banner($column_id){
		global $_M;
		if ($_M['config']['met_bannerpagetype'] && $_M['config']['metinfover']!='v2') { //其他页面banner样式是否和首页一致，v5模板兼容代码
			$column_id = 10001;
		}

		$banner_config = load::mod_class('banner/banner_handle', 'new')->config_para_handle(load::mod_class('banner/banner_database', 'new')->get_banner_config_by_column($column_id));

		if (!isset($banner_config['type'])) {//页面如果没有type类型，就采用默认设置，兼容v5代码
			$banner_config = load::mod_class('banner/banner_handle', 'new')->config_para_handle(load::mod_class('banner/banner_database', 'new')->get_banner_config_by_column(10000));
		}

		$banner['config']['type'] = $banner_config['type'];
		$banner['config']['y'] = $banner_config['y'];

		$banner['img'] = load::mod_class('banner/banner_handle', 'new')->img_para_handle(load::mod_class('banner/banner_database', 'new')->get_banner_img_by_column($column_id, $this->lang));

		return $banner;
	}
}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>
