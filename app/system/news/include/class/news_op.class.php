<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.

defined('IN_MET') or exit('No permission');

//load::mod_class('base/base_op');

/**
 * news标签类
 */

class news_op {

	/**
		* 初始化
		*/
	public function __construct() {
		global $_M;
    $this->database = load::mod_class('news/news_database', 'new');
	}

  //删除
  public function del_by_class($classnow) {
    global $_M;
    $class123 = load::sys_class('label', 'new')->get('column')->get_class123_no_reclass($classnow);
    $this->database->del_list_by_class($class123['class1']['id'], $class123['class2']['id'], $class123['class3']['id']);
    return true;
  }
  
	/*复制*/
	public function list_copy($classnow, $toclass1, $toclass2, $toclass3, $tolang){
		global $_M;

		$class123 = load::sys_class('label', 'new')->get('column')->get_class123_no_reclass($classnow);

		$contents = $this->database->get_list_by_class_no_next($classnow);

		foreach($contents as $list){
			$id = $list['id'];
			$list['id']       = '';
			$list['filename'] = '';
			$list['class1']   = $toclass1;
			$list['class2']   = $toclass2;
			$list['class3']   = $toclass3;
			$list['updatetime']  = date("Y-m-d H:i:s");
			$list['addtime']  = date("Y-m-d H:i:s");
			$list['content']  = str_replace('\'','\'\'',$list['content']);
			$list['lang']     = $tolang ? $tolang : $list['lang'];	

			$id_array[$id] =  $this->database->insert($list);
		}

		return $id_array;
	}

	/*移动产品*/
	public function list_move($nowclass1,$nowclass2,$nowclass3,$toclass1,$toclass2,$toclass3){
		global $_M;
		return $this->database->move_list_by_class($id);
  }
  
}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>
