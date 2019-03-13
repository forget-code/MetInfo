<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.

defined('IN_MET') or exit('No permission');

load::mod_class('message/message_database');

/**
 * 反馈数据类
 */

class  feedback_database extends message_database{

	/**
	 * 初始化，继承类需要调用
	 */
	public function __construct() {
		global $_M;
		$this->construct($_M['table']['feedback']);
	}

	public function get_list_by_class_sql($id, $type = 'all') {
		$sql .= " WHERE class1 = '{$id}' AND readok = 1  ";
		$sql .= "  ORDER BY addtime DESC, id DESC  ";
		return $sql;
	}

	/**
	 * 获取反馈字段
	 * @param  string  $lang    语言
	 * @param  string  $id      反馈栏目id
	 * @return array            反馈字段数组
	 */
	public function get_module_para($id) {
		return load::mod_class('parameter/parameter_database', 'new')->get_parameter(8 , $id);
	}

	public function table_para(){
    return 'id|addtime|class1|fdtitle|fromurl|useinfo|readok|customerid|lang|ip';
  }

   public function get_select_list($class1){
   	 global $_M;
   	 $feedcfg=DB::get_one("select * from {$_M[table][config]} where lang ='{$_M[form][lang]}' and name='met_fd_class' and columnid ='{$class1}'");
     $_M[config][met_fd_class]=$feedcfg[value];
   	 $query = "SELECT * FROM {$_M['table']['list']} where bigid='{$_M[config][met_fd_class]}' order by no_order";
     $result=DB::get_all($query);

     return $result;
   }

   public function del_flist_by_id($id){
       global $_M;
       $query="delete from {$_M[table][flist]} where listid='$id' and lang ='$_M[lang]'";
       return DB::query($query);
   }

}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>
