<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.

defined('IN_MET') or exit('No permission');

/**
 * 系统标签类
 */

class  banner_database{

	public $banner_config_array;//banner配置数组

	/**
	 * 对banner/config数组进行处理
	 * @param  string  $id  语言
	 * @return array        配置数组
	 */
	public function banner_config_handle($config){
		$falshval = array();
		if ($config['flashid']) {
			$config['value']        = explode('|', $config['value']);
			$falshval['type']       = $config['value'][0];
			$falshval['x']          = $config['value'][1];
			$falshval['y']          = $config['value'][2];
			$falshval['imgtype']    = $config['value'][3];
			$config['mobile_value'] = explode('|',$config['mobile_value']);
			$falshval['wap_type']   = $config['mobile_value'][0];
			$falshval['wap_y']      = $config['mobile_value'][1];
		}
		return $falshval;
	}

	/**
	 * 获取banner栏目配置数据
	 * @param  string  $lang  语言
	 * @return array          配置数组
	 */
	public function get_banner_config_by_lang($lang) {
		global $_M;
		if (!$this->banner_config_array[$lang]) {
			$query = "SELECT * FROM {$_M['table']['config']} WHERE lang='{$lang}'";
			$c = DB::get_all($query);
			foreach ($c as $key => $val) {
				if ($val['flashid']) {
					$this->banner_config_array[$lang][$val['flashid']] = $this->banner_config_handle($val);
				}
			}
		}
		return $this->banner_config_array[$lang];
  }

	/**
	 * 获取banner图片栏目设置数据
	 * @param  string  $lang  语言
	 * @return array          图片配置数组
	 */
	public function get_banner_img_by_lang($lang) {
		global $_M;
		$query = "SELECT * FROM {$_M['table']['flash']} WHERE lang = '{$lang}'";
		return DB::get_all($query);
	}

	/**
	 * 获取指定栏目banner配置数据
	 * @param  string  $id  语言
	 * @return array        配置数组
	 */
	public function get_banner_config_by_column($id) {
		global $_M;
		$query = "SELECT * FROM {$_M['table']['config']} WHERE flashid =' {$id}'";
		return $this->banner_config_handle(DB::get_one($query));
	}

	/**
	 * 获取指定栏目banner图片数据
	 * @param  string  $id  语言
	 * @return array        配置数组
	 */
	public function get_banner_img_by_column($id, $lang) {
		global $_M;
		$query = "SELECT * FROM {$_M['table']['flash']} WHERE module LIKE '%,{$id},%' OR ( module = 'metinfo' AND lang = '{$lang}' )";
		return DB::get_all($query);
	}

}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>
