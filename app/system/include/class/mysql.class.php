<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');

/**
 * 数据库操作类
 */
class DB {
	public static $querynum = 0;
	public static $link;
	
	/**
	 * 数据库连接函数
	 * @param  string  $con_db_host  主机地址
	 * @param  string  $con_db_id    用户名
	 * @param  string  $con_db_pass  密码
	 * @param  string  $con_db_name  数据库名	 
	 * @param  string  $db_charset   字符编码	 
	 * @param  string  $pconnect     是否打开永久链接	 
	 */
	public static function  dbconn($con_db_host,$con_db_id,$con_db_pass, $con_db_name = '',$db_charset='utf8',$pconnect = 0) {
		if($pconnect) {
			if(!self::$link = @mysql_pconnect($con_db_host,$con_db_id,$con_db_pass)) {
				self::halt();
			}
		} else {
			if(!self::$link = @mysql_connect($con_db_host,$con_db_id,$con_db_pass, 1)) {
				self::halt();
			}
		}
		if(self::version() > '4.1') {
			if($db_charset!='latin1') {
				@mysql_query("SET character_set_connection=$db_charset, character_set_results=$db_charset, character_set_client=binary", self::$link);
			}

			if(self::version() > '5.0.1') {
				@mysql_query("SET sql_mode=''", self::$link);
			}
		}

		if($con_db_name) {
			@mysql_select_db($con_db_name, self::$link);
		}
	}
	
	/**
	 * 选择数据库
	 * @param   string  $dbname     选择的数据库名	 
	 * @return  bool                是否成功	
	 */
	public static function select_db($dbname) {
		return mysql_select_db($dbname, self::$link);
	}

	/**
	 * 选择数据库
	 * @param   string  $dbname     规定要使用的数据指针。该数据指针是 mysql_query() 函数产生的结果
	 * @param   string  $dbname     规定返回哪种结果
	 *	MYSQL_ASSOC - 默认。关联数组
	 *	MYSQL_NUM - 数字数组
	 *	MYSQL_BOTH - 同时产生关联和数字数组	 
	 * @return  bool                是否成功	
	 */
	public static function fetch_array($query, $result_type = MYSQL_ASSOC) {
		return mysql_fetch_array($query,$result_type);
	}
		
	/**
	 * 获取一条数据
	 * @param   string  $sql      select sql语句
	 * @param   string  $type     为UNBUFFERED时，不获取缓存结果
	 * @return  array             返回执行sql语句后查询到的数据	
	 */
	public static function get_one($sql, $type = ''){
		$query = self::query($sql, $type);
		$rs = self::fetch_array($query);
		self::free_result($query);
		return $rs ;
	}
	
	/**
	 * 获取多条数据
	 * @param   string  $sql      select sql语句
	 * @param   string  $type     为UNBUFFERED时，不获取缓存结果
	 * @return  array             返回执行sql语句后查询到的数据	
	 */
	public static function get_all($sql, $type = ''){
		$query = self::query($sql, $type);
		while($list = self::fetch_array($query)){
			$rs[]=$list;
		}
		self::free_result($query);
		return $rs ;
	}

	/**
	 * 执行数据库语句
	 * @param   string  $sql      insert、update等 sql语句
	 * @param   string  $type     为UNBUFFERED时，不获取缓存结果
	 * @return                    返回执行sql执行后的结果
	 */
	public static function query($sql, $type = '') {
	   $func = $type == 'UNBUFFERED' && @function_exists('mysql_unbuffered_query') ?
			'mysql_unbuffered_query' : 'mysql_query';
		if(!($query = $func($sql, self::$link))) {
			if(in_array(self::errno(), array(2006, 2013)) && substr($type, 0, 5) != 'RETRY') {
				self::close();
				$db_settings = parse_ini_file(PATH_WEB.'config/config_db.php');
	            @extract($db_settings);
				self::dbconn($con_db_host,$con_db_id,$con_db_pass, $con_db_name = '',$pconnect);
				self::query($sql, 'RETRY'.$type);
			} 
		}
		self::$querynum++;
		return $query;
	}
	
	/**
	 * 获取指定条数数据
	 * @param   string  $table       表名称
	 * @param   string  $where       where条件
	 * @param   string  $order       order条件
	 * @param   string  $limit_start 开始条数
	 * @param   string  $limit_num   取条数数量
	 * @param   string  $field_name  获取的字段
	 * @return  array                查询得到的数据
	 */	
	function get_data($table, $where , $order, $limit_start = 0, $limit_num = 20, $field_name = '*')
	{
		if($limit_start < 0){
			return false;
		}
		$limit_start = $limit_start ? $limit_start : 0;
		$where = str_ireplace("WHERE", "", $where);
		$order = str_ireplace("ORDER BY", "", $order);
		if($where){
			$conds .= " WHERE {$where} ";
		}
		if($order){
			$conds .= " ORDER BY {$order} ";
		}   

		$conds .= " LIMIT {$limit_start},{$limit_num}";
		$query = "SELECT {$field_name} FROM {$table} {$conds}";
		$data = DB::get_all($query);
		if($data){
			return $data;
		}else{
			if($limit_start == 0){
				return $data;
			}else{
				return false;
			}
		}
		
	}
	
	/**
	 * 统计条数
	 * @param   string  $table_name      insert、update等 sql语句
	 * @param   string  $where_str       where条件,建议添加上WEHER
	 * @param   string  $field_name      统计的字段
	 * @return  int                      统计条数
	 */	
	public static function counter($table_name,$where_str="", $field_name="*"){
	    $where_str = trim($where_str);
	    if(strtolower(substr($where_str,0,5))!='where' && $where_str) $where_str = "WHERE ".$where_str;
	    $query = " SELECT COUNT($field_name) FROM $table_name $where_str ";
	    $result = self::query($query);
	    $fetch_row = mysql_fetch_row($result);
	    return $fetch_row[0];
	}
	
	/**
	 * 返回前一次 MySQL 操作所影响的记录行数。
	 * @param   string  $dbname     选择的数据库名	 
	 * @return  int                 执行成功，则返回受影响的行的数目，如果最近一次查询失败的话，函数返回 -1。
	 */
	public static function affected_rows() {
		return mysql_affected_rows(self::$link);
	}
	
	/**
	 * 返回上一个 MySQL 操作产生的文本错误信息
	 * @return  string                    错误信息
	 */		
	public static function error() {
		return ((self::$link) ? mysql_error(self::$link) : mysql_error());
	}

	/**
	 * 返回上一个 MySQL 操作中的错误信息的数字编码
	 * @return  string  错误信息的数字编码
	 */		
	public static function errno() {
		return intval((self::$link) ? mysql_errno(self::$link) : mysql_errno());
	}

	/**
	 * 返回结果集中一个字段的值
	 * @param        $query 规定要使用的结果标识符。该标识符是 mysql_query() 函数返回的。
	 * @param    int $row   规定行号。行号从 0 开始。
	 * @return              结果集中一个字段的值
	 */		
	public static function result($query, $row) {
		$query = @mysql_result($query, $row);
		return $query;
	}

	/**
	 * 返回查询的结果中行的数目
	 * @param        $query 规定要使用的结果标识符。该标识符是 mysql_query() 函数返回的。
	 * @return       int    行数
	 */		
	public static function num_rows($query) {
		$query = mysql_num_rows($query);
		return $query;
	}

	/**
	 * 返回查询的结果中字段的数目
	 * @param        $query 规定要使用的结果标识符。该标识符是 mysql_query() 函数返回的。
	 * @return       int    字段数
	 */	
	public static function num_fields($query) {
		return mysql_num_fields($query);
	}

	/**
	 * 释放结果内存
	 * @param        $query 规定要使用的结果标识符。该标识符是 mysql_query() 函数返回的。
	 */	
	public static function free_result($query) {
		return mysql_free_result($query);
	}

	/**
	 * 返回上一步 INSERT 操作产生的 ID
	 * @return       int    id号
	 */
	public static function insert_id() {
		return ($id = mysql_insert_id(self::$link)) >= 0 ? $id : self::result(self::query("SELECT last_insert_id()"), 0);
	}

	/**
	 * 从结果集中取得一行作为数字数组
	 * @param        $query 规定要使用的结果标识符。该标识符是 mysql_query() 函数返回的。
	 * @return       array    结果集一行数组
	 */
	public static function fetch_row($query) {
		$query = mysql_fetch_row($query);
		return $query;
	}

	/**
	 * 返回mysql服务器信息
	 */
	public static function version() {
		return mysql_get_server_info(self::$link);
	}

	/**
	 * 关闭连接
	 */	
	public static function close() {
		return mysql_close(self::$link);
	}

	/**
	 * 无法连接数据库报错
	 */
	public static function halt() {
	    $sqlerror = mysql_error();
		$sqlerrno = mysql_errno();
		$sqlerror = str_replace($dbhost,'dbhost',$sqlerror);
		header('HTTP/1.1 500 Internal Server Error');
		echo"<html><head><title>MetInfo</title><style type='text/css'>P,BODY{FONT-FAMILY:tahoma,arial,sans-serif;FONT-SIZE:10px;}A { TEXT-DECORATION: none;}a:hover{ text-decoration: underline;}TD { BORDER-RIGHT: 1px; BORDER-TOP: 0px; FONT-SIZE: 16pt; COLOR: #000000;}</style><body>\n\n";
		echo"<table style='TABLE-LAYOUT:fixed;WORD-WRAP: break-word'><tr><td>";
		echo"<br><br><b>The URL Is</b>:<br>http://$_SERVER[HTTP_HOST]$REQUEST_URI";
		echo"<br><br><b>Can not connect to MySQL server</b>:<br>$sqlerror  ( $sqlerrno )";
		echo"<br><br><b>You Can Get Help In</b>:<br><b>http://www.MetInfo.cn</b>";
		echo"</td></tr></table>";
		exit;
	}
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>