<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.

defined('IN_MET') or exit('No permission');

/**
 * 栏目标签类
 */

class column_label {
	public $column;//栏目数组
	public $lang;//语言
	public $wap;//手机版模式，v5手机模板兼容使用
	public $handle;
	/**
	 * 初始化
	 */
	public function __construct() {
		global $_M;
		$this->lang = $_M['lang'];
		$this->handle = load::mod_class('column/column_handle', 'new');
		$this->get_column($this->lang);
	}

  /**
	 * 获取当前语言的所有栏目
	 * @param  string  $lang  当前语言
	 * @return array          合法的页面变量
	 */
	public function get_column(){
		global $_M;
		if(!$this->column || $_M['form']['pageset'] || !file_exists(PATH_WEB.'cache/column.php')){
			//有缓存读取缓存
			$column = $this->handle->para_handle(
				load::mod_class('column/column_database', 'new')->get_all_column_by_lang($this->lang)
			);

			file_put_contents(PATH_WEB.'cache/column.php', json_encode($column));
		}else{
			$column = json_decode(file_get_contents(PATH_WEB.'cache/column.php'));
		}
		if($this->wap){//手机版模式，v5手机模板兼容使用
			foreach ($column as $key => $val) {
				if($val['wap_ok']){
					$column[$key]['nav'] = $val[wap_nav_ok] ? 1 : 0;//手机版导航
				}else{
					unset($column[$key]);
				}
			}
		}
		//简介不允许下级栏目时候，url替换问题。
		foreach ($column as $key => $list) {
			$column_bigclass[$list['bigclass']][] = $list;
		}
		foreach ($column as $key => $list) {
			if($list['module'] == 1 && !$list['isshow']){
				if($list['classtype'] == 2){
					$column[$key]['url'] = $column_bigclass[$list['id']][0]['url'];
					$column[$key]['new_windows'] = $column_bigclass[$list['id']][0]['new_windows'];
					$column[$key]['targeturl'] = $column_bigclass[$list['id']][0]['targeturl'];
				}
			}
		}
		foreach ($column as $key => $list) {
			if($list['module'] == 1 && !$list['isshow']){
				if($list['classtype'] == 1){
					//if($column_bigclass[$list['id']][0]['module'] != 1){
					if($list['lang'] != $_M['config']['met_index_type']){
						$column[$key]['url'] = $column_bigclass[$list['id']][0]['url'];
						$column[$key]['new_windows'] = $column_bigclass[$list['id']][0]['new_windows'];
						$column[$key]['targeturl'] = $column_bigclass[$list['id']][0]['targeturl'];
					}
				}
			}
		}

		//dump($column);

		foreach ($column as $key => $list) {
			if($list['display'] == 1)$list['nav'] = 0;
			//下列的所有数据都是老模板兼容需要使用的，新模板根据实际情况来使用，每使用到一个，在数组后进行注释。
			//后续可以根据使用情况在进行优化
			$this->column[nav_listall][]=$list;
			$this->column[class_list][$list['id']]=$list;//使用
			$this->column[module_listall][$list['module']][]=$list;
			if($list['classtype']==1){
				$this->column[nav_list_1][]=$list;//使用
				$this->column[module_list1][$list['module']][]=$list;
				$this->column[class1_list][$list['id']]=$list;
				if($list['module']==2 or $list['module']==3 or $list['module']==4 or $list['module']==5)$this->column[nav_search][]=$list;
			}
			if($list['classtype']==2){
				$this->column[nav_list_2][]=$list;
				$this->column[module_list2][$list['module']][]=$list;
				$this->column[nav_list2][$list['bigclass']][]=$list;//使用
				$this->column[class2_list][$list['id']]=$list;
			}
			if($list['classtype']==3){
				$this->column[nav_list_3][]=$list;
				$this->column[module_list3][$list['module']][]=$list;
				$this->column[nav_list3][$list['bigclass']][]=$list;//使用
				$this->column[class3_list][$list['id']]=$list;
			}

			if($list['nav']==1 or $list['nav']==3)$this->column[nav_list][]=$list;//使用
			if($list['nav']==2 or $list['nav']==3)$this->column[navfoot_list][]=$list;//使用

			if($list['classtype']==1&&$list['module']==1&&$list['isshow']==1){$this->column[nav_listabout][]=$list;}
			if($list['index_num']!="" and $list['index_num']!=0){
				$list['classtype']=$list['releclass']?"class1":"class".$list['classtype'];
				$this->column[class_index][$list['index_num']]=$list;
			}
		}
		return $this->column;
	}

	/**
	 * 返回$this->column
	 * @return array         返回$this->column
	 */
	public function get_cache_column($id) {
		return $this->column;
	}

	/**
	 * 返回class_list
	 * @return array         返回class_list
	 */
	public function get_class_list(){
		return $this->column['class_list'];
	}

		/**
	 * 返回class_list
	 * @return array         返回class_list
	 */
	public function get_all_list(){
		return $this->column['nav_listall'];
	}

	/**
	 * 获取指定栏目信息
	 * @param  number  $id   栏目id
	 * @return array         栏目数组
	 */
	public function get_column_id($id) {
		return $this->column['class_list'][$id];
	}

	/**
	 * 获取指定栏目的下级栏目
	 * @param  number  $id   栏目id
	 * @return array         栏目数组
	 */
	public function get_column_son($id) {
		$this_column = $this->get_column_id($id);
		$num = $this_column['classtype'] + 1;
		return $this->column['nav_list'.$num][$id];
	}

	/**
	 * 获取指定栏目的上级栏目
	 * @param  number  $id   栏目id
	 * @return array         栏目数组
	 */
	public function get_parent_column($id){
		if($id){
			return $this->column['class_list'][$this->column['class_list'][$id]['bigclass']];
		}else{
			return array();
		}

	}

	/**
	 * 顶部导航栏目
	 * @return array         栏目数组
	 */
	public function get_column_head() {
		return $this->column['nav_list'];
	}

	/**
	 * 底部导航栏目
	 * @return array         栏目数组
	 */
	public function get_column_foot() {
		return $this->column['navfoot_list'];
	}

	/**
	 * 获取指定文件夹的栏目
	 * @param  string  $floder   文件夹名称
	 * @return array             栏目数组
	 */
	public function get_column_folder($floder) {
		if(!$floder)return array();
		foreach ($this->column[nav_listall] as $key => $val) {
			if ($val['foldername'] == $floder && ($val['classtype'] == 1 || $val['releclass'])) {
				return $val;
			}
		}
		return array();
	}

	/**
	 * 获取指定静态页面的栏目
	 * @param  string  $floder   文件夹名称
	 * @return array             栏目数组
	 */
	public function get_column_filename($filename) {
		if(!$filename)return array();
		foreach ($this->column[nav_listall] as $key => $val) {
			if ($val['filename'] == $filename && ($val['classtype'] == 1 || $val['releclass'])) {
				return $val;
			}
		}
		return array();
	}


	public function get_column_by_filename($filename)
	{
		$column = load::mod_class('column/column_database', 'new')->get_column_by_filename($filename);

		return $column;
	}
	/**
	 * 获取指定栏目的class1/class2/class3，不算关联栏目
	 * @param  string  $id       当前栏目id
	 * @return array             3级栏目数组
	 */
	public function get_class123_no_reclass($id) {
		$classnow = $this->get_column_id($id);
		if($classnow['classtype'] == 1){
			$return['class1'] = $classnow;
			$return['class2'] = array();
			$return['class3'] = array();
		}

		if($classnow['classtype'] == 2){
			if($classnow['releclass']){
				$return['class1'] = $classnow;
				$return['class2'] = array();
				$return['class3'] = array();
			}else{
				$return['class1'] = $this->get_parent_column($classnow['id']);
				$return['class2'] = $classnow;
				$return['class3'] = array();
			}
		}

		if($classnow['classtype'] == 3){
			$bigclass = $this->get_parent_column($classnow['id']);
			if($bigclass['releclass']){
				$return['class1'] = $bigclass;
				$return['class2'] = $classnow;
				$return['class3'] = array();
			}else{
				$return['class1'] = $this->get_parent_column($bigclass['id']);
				$return['class2'] = $bigclass;
				$return['class3'] = $classnow;
			}
		}

		return $return;
	}

	/**
	 * 获取指定栏目的class1/class2/class3，不算关联栏目
	 * @param  string  $id       当前栏目id
	 * @return array             3级栏目数组
	 */
	public function get_class123_reclass($id) {
		$classnow = $this->get_column_id($id);
		if($classnow['classtype'] == 1){
			$return['class1'] = $classnow;
			$return['class2'] = array();
			$return['class3'] = array();
		}

		if($classnow['classtype'] == 2){
			$return['class1'] = $this->get_parent_column($classnow['id']);
			$return['class2'] = $classnow;
			$return['class3'] = array();
		}

		if($classnow['classtype'] == 3){
			$bigclass = $this->get_parent_column($classnow['id']);
			$return['class1'] = $this->get_parent_column($bigclass['id']);
			$return['class2'] = $bigclass;
			$return['class3'] = $classnow;
		}

		return $return;
	}

   /**
	 * 获取指定栏目的class1/class2/class3，不算关联栏目
	 * @param  string  $lang     语言
	 * @param  string  $type     栏目类型(1、2、3)
	 * @return array             3级栏目数组
	 */
	function get_column_by_classtype($lang,$type){
      $column= load::mod_class('column/column_database', 'new')->get_all_column_by_lang($lang);
      foreach ($column as $key => $list) {
         if($list['classtype']==$type){
					$columnlist[]=$list;
				}
            }
          return $columnlist;
	    }
}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>
