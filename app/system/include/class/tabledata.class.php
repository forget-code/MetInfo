<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');

/**
 * 表格数据获取类
 * @param array $rearray 表格数组返回数组			
 */
class tabledata {
	
	protected $rearray;
	public $error;
	
	/**
	 * 获取表查询数据
	 * @param  string $table 表名
	 * @param  string $field 表字段
	 * @param  string $where where条件
	 * @param  string $order order by条件	 
	 * @return array  查询数据	
	 */
	public function getdata($table, $field = '*', $where = '', $order = ''){
		global $_M;
	//dump( $_M['form']);
		/*获取表格ajax传递的参数*/
		$length = $_M['form']['length'];         //每页显示数量
		$start  = $_M['form']['start'];          //读取数据的起点
		$draw   = $_M['form']['draw'];           //累计执行次数，无作用但必须回传
		if($_M['form']['tablepage_json']&&$start==0&$draw==1){
			$cook = explode("|",$_M['form']['tablepage_json']) ;
			$u = "{$_M['form']['n']},{$_M['form']['c']},{$_M['form']['a']}";
			if($cook[1]==$u){
				$start = $cook[0]*$_M['form']['length'];
			}
		}else{
			met_setcookie('tablepage_json', $_M['form']['start']/$_M['form']['length']."|{$_M['form']['n']},{$_M['form']['c']},{$_M['form']['a']}");
		}
		/*查询表*/
		if($where){
			$conds .= " WHERE {$where} ";
		}
		if($order){
			$conds .= " ORDER BY {$order} ";
		}                
		//整理查询条件
		$query = "SELECT {$field} FROM {$table} {$conds} LIMIT {$start},{$length}";  //mysql语句
//echo $query;
		$array = DB::get_all($query);                                           //执行查询，获得数组
		$error = DB::error();
		//echo $error;
		if($error){
			$this->error = $query."<br />".$error;
		}else{
			$this->error = '';
		}
		$total = DB::counter($table, $conds, '*');                        //获取总数量，计算总页数
		
		/*回传数组处理*/
		$this->rarray = array();
		$this->rarray['draw']            = $draw;   //回传执行次数
		$this->rarray['recordsTotal']    = $total;  //回传总数量
		$this->rarray['recordsFiltered'] = $total;  //回传筛选过的总数量，暂无作用，但必须回传
		return $array;
	}
	
	/**
	 * 把处理后的数组已json方式输出到页面上，供AJAX读取。
	 * @param  array $rdata 需要转成json的数组
	 */
	public function rdata($rdata){
		if($rdata){
			$this->rarray['data'] = $rdata;
		}else{
			$this->rarray['data'][''] = '';			
		}
		jsoncallback($this->rarray); //回传json格式
	}
	
}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>