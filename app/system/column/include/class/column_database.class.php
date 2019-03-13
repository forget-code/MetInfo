<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.

defined('IN_MET') or exit('No permission');

load::sys_class('database');

/**
 * 系统标签类
 */

class column_database extends database {

  /**
   * 初始化，继承类需要调用
   */
  public function __construct() {
    global $_M;
    $this->construct($_M['table']['column']);
  }

  /**
   * 为字段赋值
   * @param  string  $lang  语言
   * @return array          栏目数组
   */
  public function get_all_column_by_lang($lang = '') {
    global $_M;
    $langsql = $this->get_lang($lang);
    $query = "SELECT * FROM {$this->table} WHERE {$langsql} ORDER BY no_order ASC, id DESC";
    return DB::get_all($query);
  }

  public function get_column_by_id($id, $lang = '') {
    global $_M;
    $langsql = $this->get_lang($lang);
    $query = "SELECT * FROM {$this->table} WHERE {$langsql} AND id='{$id}' ";
    return DB::get_one($query);
  }

  public function get_column_by_filename($filename, $lang = '') {
    global $_M;
    $langsql = $this->get_lang($lang);
    $query = "SELECT * FROM {$this->table} WHERE {$langsql} AND filename='{$filename}'";
    return DB::get_one($query);
  }

  public function get_column_by_foldername($foldername, $lang = '') {
    global $_M;
    $langsql = $this->get_lang($lang);
    $query = "SELECT * FROM {$this->table} WHERE {$langsql} AND foldername='{$foldername}'";
    return DB::get_all($query);
  }

  public function get_column_by_module($module, $lang = '') {
    global $_M;
    $langsql = $this->get_lang($lang);
    $query = "SELECT * FROM {$_M['table']['column']} WHERE {$langsql} AND module='{$module}'";

    return DB::get_one($query);
  }

  public function update_column_by_bigclass($list) {
    global $_M;
    $sql = $this->update_sql($list);
    $query = "UPDATE {$this->table} SET $sql WHERE bigclass = '{$list['bigclass']}'";
    return DB::get_one($query);
  }

  /*更新表数据*/
  public function up_table_data($table, $where) {
    global $_M;
    $query = "UPDATE {$table} {$where}";
    $result = DB::query($query);
    return $result;
  }
  /*删除表数据*/
  public function del_table_data($table, $where) {
    global $_M;
    $query = "delete from {$table} {$where}";
    DB::query($query);
  }

  /*获取数据*/
  public function getdata($table, $where, $type) {
    global $_M;
    $query = "select * from {$table} {$where}";
    if ($type) {
      $user = DB::get_one($query);
    } else {
      $user = DB::get_all($query);
    }

    return $user;
  }

  public function table_para() {
    return 'name|foldername|filename|bigclass|samefile|module|no_order|wap_ok|wap_nav_ok|if_in|nav|ctitle|keywords|content|description|list_order|new_windows|classtype|out_url|index_num|access|indeximg|columnimg|isshow|lang|namemark|releclass|display|icon|nofollow';
  }

}; # This program is an open source system, commercial use, please consciously to purchase commercial license.; # Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>
