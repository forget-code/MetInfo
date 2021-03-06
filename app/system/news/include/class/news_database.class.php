<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.

defined('IN_MET') or exit('No permission');

load::mod_class('base/base_database');

/**
 * 系统标签类
 */

class news_database extends base_database {

	public $multi_column = 0;//是否支持多栏目

	public function __construct() {
		global $_M;
		$this->construct($_M['table']['news']);
	}

	/**
	 * 搜索功能
	 * 获取列表数据（产品，图片，下载，新闻模块使用）
	 * @param  string  $lang    语言
	 * @param  string  $id      栏目id
	 * @param  string  $start   limit开始条数
	 * @param  string  $rows    limit取的条数
	 * @return array            配置数组get_list_by_class
	 */
	public function get_list_by_class($id, $start = 0, $rows = '', $type, $order) {
		global $_M;
		$sql = $this->get_list_by_class_sql($id, $type, $order);
		if ($rows) {
			$sql .= "LIMIT $start , $rows";
		}

		$query = "SELECT * FROM {$this->table} WHERE {$sql} ";
		$data = DB::get_all($query);
		return $data;
	}

	/**
	 * 获取列表数据（产品，图片，下载，新闻模块使用）
	 * @param  string  $lang    语言
	 * @param  string  $id      栏目id
	 * @param  string  $start   limit开始条数
	 * @param  string  $rows    limit取的条数
	 * @return array            配置数组
	 */
	public function get_page_count_by_class($id, $type) {
		
		$sql = $this->get_list_by_class_sql($id, $type, -1);
		return   DB::counter($this->table, $sql);
	}

	/**
	 * 获取列表数据（产品，图片，下载，新闻模块使用）
	 * @param  string  $lang    语言
	 * @param  string  $id      栏目id
	 * @return array            配置数组
	 */
	public function get_list_by_class_sql($id, $type, $order) {
		global $_M;
		$time = date("Y-m-d H:i:s");
		$column = load::sys_class('label', 'new')->get('column');
		$sql = " {$this->langsql} AND (recycle='0' or recycle='-1') AND displaytype='1' ";
		if(!$_M['config']['sitemap']){//网站地图生成全部连接
            $sql .= " AND addtime < '{$time}' ";
        }
		if($_M['form']['classnow']){
			$class = $column->get_class123_reclass($_M['form']['classnow']);
			if($class['class1']){
				$sql .= " AND class1 = {$class['class1']['id']} ";
			}

			if($class['class2']){
				$sql .= " AND class2 = {$class['class2']['id']} ";
			}

			if($class['class3']){
				$sql .= " AND class3 = {$class['class3']['id']} ";
			}
		}
		
		$class123 = $column->get_class123_no_reclass($id);
        if(isset($_M['form']['search'])){
			// search_label的search_info的数据
			$search = '';
			$fields = array('ctitle','title','keywords','description','content','tag');
			if ($type['type'] == 'array' || $type['type'] == 'tag') {

				$search .= load::sys_class('label', 'new')->get('tags')->getSqlByTag($_M['form']['content'], $class123);
				if(!$_M['config']['tag_show_range']){

					foreach ($fields as $val) {
						if($type[$val]['status']){
							$search .= " OR {$val} like '%{$type[$val]['info']}%' ";
						}
					}
					
					if ($type['para']['status'] && $type['para']['info']) {
						$para = load::sys_class('label', 'new')->get('parameter')->get_search_list_sql($this->module, $type['para']['precision'], $type['para']['info']);
						$search .= " OR id in ({$para}) ";//如果以后需要加强字段搜索，就在这里添加代码。
					}
				}

				if($search){
					$sql .= "AND ( 1 != 1 {$search} ) ";
					$sql = str_replace('1 != 1  OR', '', $sql);
				}
			}

		}else{
			if($type == 'com'){
				$sql .= "AND com_ok = 1 ";
			}
		}

		if($this->multi_column == 1 && !$_M['form']['searchword']){
			$sql .= $this->get_multi_column_sql($class123['class1']['id'], $class123['class2']['id'], $class123['class3']['id']);
        }else{
			if ($class123['class1']['id'] && !$_M['form']['searchword']) {//搜索模块的兼容
				
				if($_M['form']['search'] != 'tag' || $_M['config']['tag_search_type'] == 'column'){
					$sql .= "AND class1 = '{$class123['class1']['id']}' ";
				}

			}
			if ($class123['class2']['id']) {
				$sql .= "AND class2 = '{$class123['class2']['id']}' ";
			}
			if ($class123['class3']['id']) {
				$sql .= "AND class3 = '{$class123['class3']['id']}' ";
			}
		}

		if ($class123['class1']['id']) {
			$defult_order = $class123['class1']['list_order'];
		}
		if ($class123['class2']['id']) {
			$defult_order = $class123['class2']['list_order'];
		}
		if ($class123['class3']['id']) {
			$defult_order = $class123['class3']['list_order'];
		}

		$order_sql = '';
        if(is_array($order)){
            //自定义条件
            if($order['type'] == 'array'){
                $order_sql .= $this->get_custom_order($order['status'], $defult_order);
            }
        }else{
            $order = $order ? $order : $defult_order;
            $order_sql .= $this->get_column_order($order);
        }
        $plugin['type'] = $type;
        $plugin_order = load::plugin('list_order', $plugin);//商城这里加插件，当前代码只作演示用，开发商城的时候，需要根据实际情况修改。
		$sql .= $plugin_order ? $plugin_order : $order_sql;
		

        return $sql;
	}

	/**
	 * 获取栏目排序URL
	 * @param  string  $order  排序类型
	 * @return string          排序sql
	 */
	public function get_column_order($order) {
        $order_sql = '';
		switch ($order) {
			case '1':
				$order_sql .= " ORDER BY top_ok DESC, com_ok DESC, no_order DESC, updatetime DESC, id DESC ";
			break;
			case '2':
				$order_sql .= " ORDER BY top_ok DESC, com_ok DESC, no_order DESC, addtime DESC, id DESC ";
			break;
			case '3':
				$order_sql .= " ORDER BY top_ok DESC, com_ok DESC, no_order DESC, hits DESC, id DESC ";
			break;
			case '4':
				$order_sql .= " ORDER BY top_ok DESC, com_ok DESC, no_order DESC, id DESC ";
			break;
			case '5':
				$order_sql .= " ORDER BY top_ok DESC, com_ok DESC, no_order DESC, id ASC ";
			break;
            case '6':
                $order_sql .= " ORDER BY top_ok DESC, com_ok DESC, no_order DESC, id ASC ";
			break;
			case '-1':
				$order_sql .= "  ";
			break;
			default:
				$order_sql .= " ORDER BY top_ok DESC, com_ok DESC, no_order DESC, updatetime DESC, id DESC ";
			break;
		}
		return $order_sql;
	}

	/**
	 * 获取栏目排序URL
	 * @param  string  $order  排序类型
	 * @return string          排序sql
	 */
	public function get_custom_order($order, $defult_order) {
        $order_sql = '';
		switch ($order) {
			case '1':
				$order_sql .= " ORDER BY updatetime DESC, id DESC ";	//按更新时间
			break;
			case '2':
				$order_sql .= " ORDER BY addtime DESC, id DESC ";		//按添加时间
			break;
			case '3':
				$order_sql .= " ORDER BY hits DESC, id DESC ";			//按点击数
			break;
			case '4':
				$order_sql .= " ORDER BY id DESC ";						//按ID倒叙
			break;
			case '5':
				$order_sql .= " ORDER BY id ASC ";						//按ID顺序
			break;
            case '6':
                $order_sql .= " ORDER BY com_ok DESC, id DESC ";		//按推荐
			break;
			case '-1':
				$order_sql .= "  ";
			break;
			case '7':
				$order_sql .= " ORDER BY rand()";
			break;
			default:
				$order_sql .= $this->get_column_order($defult_order);
			break;
		}
		return $order_sql;
	}

	/**
	 * 获取当前内容的前一条信息
	 * @param  string  $one    内容数组
	 * @return array           数组
	 */
	public function get_pre($one) {
		global $_M;
		$time = date("Y-m-d H:i:s");
		$where = "(recycle='0' or recycle='-1') AND displaytype='1' AND addtime<'{$time}' AND (links = '' OR links is null) ";

		$classnow = $one['class3'] ? $one['class3'] : ($one['class2'] ? $one['class2'] : $one['class1']);

		if ($_M['config']['met_pnorder']) {
			if($one['class1'])$where .= " AND class1='{$one['class1']}' ";
			if($one['class2'])$where .= " AND class2='{$one['class2']}' ";
			if($one['class3'])$where .= " AND class3='{$one['class3']}' ";
			$column = load::sys_class('label', 'new')->get('column')->get_column_id($classnow);
			$list_order = $column['list_order'];
		} else {
			$where .= " AND class1='{$one['class1']}'";
			$class123 = load::sys_class('label', 'new')->get('column')->get_class123_no_reclass($classnow);
			$list_order = $class123['class1']['list_order'];
		}

		switch ($list_order) {
			case '1':
				$list_order_where = " (
					(updatetime > '$one[original_updatetime]')
					OR
					(updatetime = '$one[original_updatetime]' AND id > '$one[id]')
				)";
				$order = 'top_ok ASC, com_ok ASC, no_order ASC, updatetime ASC, id ASC';
			break;
			case '2':
				$list_order_where = " (
					(addtime > '$one[original_addtime]')
					OR
					(addtime = '$one[original_addtime]' AND id > '$one[id]')
				) ";
				$order = 'top_ok ASC, com_ok ASC, no_order ASC, addtime ASC, id ASC';
			break;
			case '3':
				$list_order_where = " (
					(hits > '$one[hits]')
					OR
					(hits = '$one[hits]' AND id > '$one[id]')
				)";
				$order = 'top_ok ASC, com_ok ASC, no_order ASC, hits ASC, id ASC';
			break;
			case '4':
				$list_order_where = " id > '$one[id]' ";
				$order = 'top_ok ASC, com_ok ASC, no_order ASC, id ASC';
			break;
			case '5':
				$list_order_where = " id < '$one[id]' ";
				$order = 'top_ok ASC, com_ok ASC, no_order ASC, id DESC';
			break;
			default:
				$list_order_where = " updatetime > '$one[original_updatetime]' ";
				$order = 'top_ok ASC, com_ok ASC, no_order ASC, updatetime ASC';
			break;
		}

		if($one['top_ok'] && $one['com_ok']){
			$where .= "
			AND (
				( top_ok = 1 AND com_ok = 1 AND no_order > '{$one['no_order']}' )
				OR
				( top_ok = 1 AND com_ok = 1 AND no_order = '{$one['no_order']}' AND {$list_order_where} )
			) ";
		}

		if($one['top_ok'] && !$one['com_ok']){
			$where .= "
			AND (
				( top_ok = 1 AND com_ok = 0 AND no_order > '{$one['no_order']}' )
				OR
				( top_ok = 1 AND com_ok = 0 AND no_order = '{$one['no_order']}' AND {$list_order_where} )
				OR
				( top_ok = 1 AND com_ok = 1)
			) ";
		}

		if(!$one['top_ok'] && $one['com_ok']){
			$where .= "
			AND (
				( top_ok = 0 AND com_ok = 1 AND no_order > '{$one['no_order']}' )
				OR
				( top_ok = 0 AND com_ok = 1 AND no_order = '{$one['no_order']}' AND {$list_order_where} )
				OR
				( top_ok = 1)
			) ";
		}

		if(!$one['top_ok'] && !$one['com_ok']){
			$where .= "
			AND (
				( top_ok = 0 AND com_ok = 0 AND no_order > '{$one['no_order']}' )
				OR
				( top_ok = 0 AND com_ok = 0 AND no_order = '{$one['no_order']}' AND {$list_order_where} )
				OR
				( top_ok = 1)
				OR
				( com_ok = 1)
			) ";
		}

		$order = $order;
		$query = "SELECT * FROM {$this->table} WHERE $where ORDER BY {$order} LIMIT 0,1";
		return DB::get_one($query);
	}

	/**
	 * 获取当前内容的下一条信息
	 * @param  string  $one    内容数组
	 * @return array           数组
	 */
	public function get_next($one) {
		global $_M;
		$time = date("Y-m-d H:i:s");
		$where = "(recycle='0' or recycle='-1') AND displaytype='1' AND addtime<'{$time}' AND (links = '' OR links is null) ";

		$classnow = $one['class3'] ? $one['class3'] : ($one['class2'] ? $one['class2'] : $one['class1']);

		if ($_M['config']['met_pnorder']) {
			if($one['class1'])$where .= " AND class1='{$one['class1']}' ";
			if($one['class2'])$where .= " AND class2='{$one['class2']}' ";
			if($one['class3'])$where .= " AND class3='{$one['class3']}' ";
			$column = load::sys_class('label', 'new')->get('column')->get_column_id($classnow);
			$list_order = $column['list_order'];
		} else {
			$where .= " AND class1='{$one['class1']}'";
			$class123 = load::sys_class('label', 'new')->get('column')->get_class123_no_reclass($classnow);
			$list_order = $class123['class1']['list_order'];
		}

		switch ($list_order) {
			case '1':
				$list_order_where = "(
					 (updatetime < '$one[original_updatetime]')
					 OR
					 (updatetime = '$one[original_updatetime]' AND id < '$one[id]' )
				)";
				$order = 'top_ok DESC, com_ok DESC, no_order DESC, updatetime DESC, id DESC';
			break;
			case '2':
				$list_order_where = " (
					(addtime < '$one[original_addtime]')
					OR
					(addtime = '$one[original_addtime]' AND id < '$one[id]' )
				)";
				$order = 'top_ok DESC, com_ok DESC, no_order DESC, addtime DESC, id DESC';
			break;
			case '3':
				$list_order_where = " (
					(hits < '$one[hits]')
					OR
					(hits = '$one[hits]' AND id < '$one[id]' )
				)";
				$order = 'top_ok DESC, com_ok DESC, no_order DESC, hits DESC, id DESC';
			break;
			case '4':
				$list_order_where = " id < '$one[id]' ";
				$order = 'top_ok DESC, com_ok DESC, no_order DESC, id DESC';
			break;
			case '5':
				$list_order_where = " id > '$one[id]' ";
				$order = 'top_ok DESC, com_ok DESC, no_order DESC, id ASC';
			break;
			default:
				$list_order_where =  " updatetime < '$one[original_updatetime]' ";
				$order = 'top_ok DESC, com_ok DESC, no_order DESC, updatetime DESC';
			break;
		}

		if($one['top_ok'] && $one['com_ok']){
			$where .= "
			AND (
				( top_ok = 1 AND com_ok = 1 AND no_order < '{$one['no_order']}' )
				OR
				( top_ok = 1 AND com_ok = 1 AND no_order = '{$one['no_order']}' AND {$list_order_where} )
				OR
				( top_ok = 1 AND com_ok = 0 )
				OR
				( top_ok = 0 )
			) ";
		}

		if($one['top_ok'] && !$one['com_ok']){
			$where .= "
			AND (
				( top_ok = 1 AND com_ok = 0 AND no_order < '{$one['no_order']}' )
				OR
				( top_ok = 1 AND com_ok = 0 AND no_order = '{$one['no_order']}' AND {$list_order_where} )
				OR
				( top_ok = 0 )
			) ";
		}

		if(!$one['top_ok'] && $one['com_ok']){
			$where .= "
			AND (
				( top_ok = 0 AND com_ok = 1 AND no_order < '{$one['no_order']}' )
				OR
				( top_ok = 0 AND com_ok = 1 AND no_order = '{$one['no_order']}' AND {$list_order_where} )
				OR
				( top_ok = 0  AND com_ok = 0)
			) ";
		}

		if(!$one['top_ok'] && !$one['com_ok']){
			$where .= "
			AND (
				( top_ok = 0 AND com_ok = 0 AND no_order < '{$one['no_order']}' )
				OR
				( top_ok = 0 AND com_ok = 0 AND no_order = '{$one['no_order']}' AND {$list_order_where} )
			) ";
		}


		$order = $order;
		$query = "SELECT * FROM {$this->table} WHERE $where ORDER BY {$order}";
		return DB::get_one($query);
	}

	/**
	 * 获取静态页面名称
	 * @param  array  $filename     静态页面名称
	 * @param  array  $lang         语言
	 * @return bool                 当前静态页面名称个数
	 */
	public function get_list_by_filename($filename) {
		$query = "SELECT * FROM {$this->table} WHERE {$this->langsql} AND filename='{$filename}'";
		return DB::get_all($query);
	}

	public function table_para(){
		return 'id|title|ctitle|keywords|description|content|class1|class2|class3|no_order|wap_ok|img_ok|imgurl|imgurls|com_ok|issue|hits|updatetime|addtime|access|top_ok|filename|lang|recycle|displaytype|tag|links|text_size|text_color|other_info|custom_info|publisher';
	}

	//删除
	public function del_list_by_class($class1, $class2, $class3){
		if($class1){
			$sql .= " AND class1 = '{$class1}'";
		}
		if($class2){
			$sql .= " AND class2 = '{$class2}'";
		}
		if($class3){
			$sql .= " AND class3 = '{$class3}'";
		}

		$query = "SELECT id FROM $this->table WHERE {$this->langsql} {$sql}";
		$list = DB::get_all($query);
		foreach ($list as $c) {
			$query = "DELETE FROM $this->table WHERE id = {$c['id']}";
			DB::query($query);
		}
		return $list;
	}

	//栏目批量移动
	public function move_list_by_class($nowclass1,$nowclass2,$nowclass3,$toclass1,$toclass2,$toclass3){
        $query = "UPDATE {$this->table} SET
			class1 = '{$toclass1}', 
			class2 = '{$toclass2}', 
			class3 = '{$toclass3}' 
			WHERE {$this->langsql} 
			AND class1 = '{$nowclass1}'  
			AND class2 = '{$nowclass2}'  
			AND class3 = '{$nowclass3}' 
			";
        return DB::query($query);
	}

	//获取栏目下面的内容,返回内容不包含下级栏目内容
	public function get_list_by_class_no_next($id) {

		$class123 = load::sys_class('label', 'new')->get('column')->get_class123_no_reclass($id);

		$sql = " {$this->langsql} ";

		if ($class123['class1']['id']) {
			$sql .= "AND class1 = '{$class123['class1']['id']}' ";
		} else {
			$sql .= "AND ( class1 = '' OR class1 = '0' ) ";
		}

		if ($class123['class2']['id']) {
			$sql .= "AND class2 = '{$class123['class2']['id']}' ";
		} else {
			$sql .= "AND ( class2 = '' OR class2 = '0' ) ";
		}

		if ($class123['class3']['id']) {
			$sql .= "AND class3 = '{$class123['class3']['id']}' ";
		} else {
			$sql .= "AND ( class3 = '' OR class3 = '0' ) ";
		}

		$query = "SELECT * FROM {$this->table} WHERE $sql ";
		return DB::get_all(	$query);
	}

	//多栏目支持
	public function get_multi_column_sql($class1, $class2, $class3){
		return '';
	}

	//sql变化，现在用于栏目字段搜索
	public function sql_change($query, $type){
		if(is_array($type)){

		}
		return $query;
	}


}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>
