<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');

/**
 * 字段类
 * @param string $paralist  字段缓存数组	
 * @param string $lang      操作的语言	
 */

class para{	
	protected $paralist;
	protected $lang;
	protected $table;
	
	public function __construct() {
		global $_M;
		$this->lang = $_M['lang'];
	}
	public function table($module,$table){
		global $_M;
		switch($module){
			case 10:$table = $_M['table']['user_list'];break;
			case 3:$table = $_M['table']['plist'];break;
		}
		$this->table = $table;
		return $this->table;
	}
	public function form_para($form,$module,$class1,$class2,$class3){
		foreach($this->get_para_list($module,$class1,$class2,$class3) as $val){
			if($val['type']==7){
				$info[$val['id']] = $form["info_{$val['id']}_1"].'-'.$form["info_{$val['id']}_2"];
				if($form["info_{$val['id']}_3"])$info[$val['id']].= '-'.$form["info_{$val['id']}_3"];
			}else{
				$info[$val['id']] = $form['info_'.$val['id']];
			}
		}
		return $info;
	}
	
	public function paratem($listid,$module,$class1,$class2,$class3){
		global $_M;
		if($listid)$para = $this->get_para($listid,$module,$class1,$class2,$class3);
		$paralist = $this->get_para_list($module,$class1,$class2,$class3);
		require PATH_WEB.'app/system/include/public/ui/admin/paratype.php';
	}
	public function parawebtem($listid,$module,$wr_oks = 0,$class1,$class2,$class3){
		global $_M;
		if($listid)$para = $this->get_para($listid,$module,$class1,$class2,$class3);
		$paralist = $this->get_para_list($module,$class1,$class2,$class3);
		if($wr_oks){
			foreach($paralist as $val){
				if($val['wr_oks'])$paralists[] = $val;
			}
			$paralist = $paralists;
		}
		require PATH_WEB.'app/system/include/public/ui/web/paratype.php';
	}
	public function get_para($listid,$module,$class1,$class2,$class3){
		global $_M;
		$paralist = $this->get_para_list($module,$class1,$class2,$class3);
		foreach($paralist as $val){
			$para = DB::get_one("SELECT * FROM {$this->table($module)} WHERE listid='{$listid}' and paraid='{$val[id]}' and lang = '{$this->lang}'"); 
			if($val['type']==7){
				$para7 = explode("-",$para['info']) ;
				$list['info_'.$val['id'].'_1'] = $para7[0];
				$list['info_'.$val['id'].'_2'] = $para7[1];
				if($para7[2])$list['info_'.$val['id'].'_3'] = $para7[2];
			}
			$list['info_'.$val['id']] = $para['info'];
			if(!$para){
				$infos[$val['id']] = '';
			}
		}
		if($infos)$this->insert_para($listid, $infos, $module);
		return $list;
	}
	public function get_para_list($module,$class1,$class2,$class3){
		global $_M;
		if(!$this->paralist[$module][$this->lang]){
			$this->paralist[$module][$this->lang] = cache::get("para/paralist_{$module}_{$this->lang}");
			if(!$this->paralist[$module][$this->lang]){
				$query = "SELECT * FROM {$_M['table']['parameter']} WHERE module='{$module}' and lang='{$_M['lang']}' order by no_order ASC, id ASC";
				$result = DB::query($query);
				while($list = DB::fetch_array($result)){
					if($list['options']){
						$lists = explode("$|$",$list['options']);
						$list['list'] = $lists;
					}
					$this->paralist[$module][$this->lang][$list['id']] = $list;
				}
				cache::put("para/paralist_{$module}_{$this->lang}", $this->paralist[$module][$this->lang]);
			}
		}
		$re = $this->paralist[$module][$this->lang];
		$paralists = array();
		foreach($re as $val){
			if($val['class1']){
				if($val['class1']==$class1){
					if($val['class2']==0&&$val['class3']==0)$paralists[] = $val;
					if($val['class2']&&$val['class2']==$class2&&$val['class3']==0)$paralists[] = $val;
					if($val['class3']&&$val['class3']==$class3)$paralists[] = $val;
				}
			}else{
				$paralists[] = $val;
			}
		}
		$re = $paralists;
		return $re;
	}
	public function insert_para($listid, $infos, $module){
		global $_M;
		foreach($infos as $paraid=>$val){
			if($val){
				$query = "INSERT INTO {$this->table($module)} SET 
							listid  = '{$listid}',
							paraid  = '{$paraid}',
							info    = '{$val}',
						";	
				if($module != 10)$query .= "
							module  = '{$module}',
							imgname = '',		
				";
				$query .= "lang    = '{$this->lang}'";
				DB::query($query);
			}
		}
	}

	public function update_para($listid, $infos, $module){
		global $_M;
		$table = $this->table($module);
		foreach($infos as $paraid=>$val){
			if(isset($val)){
				$query = "SELECT * FROM {$table} WHERE listid = '{$listid}' and paraid = '{$paraid}' and lang = '{$this->lang}'";
				$para = DB::get_all($query);
				if(count($para) > 1){
					$query = "DELETE FROM {$table} WHERE listid = '{$listid}' and paraid = '{$paraid}' and lang = '{$this->lang}'";
					DB::query($query);
				}
				if(count($para) == 0 || count($para) > 1){
					$query = "INSERT INTO {$this->table($module)} SET 
							listid  = '{$listid}',
							paraid  = '{$paraid}',
							info    = '{$val}',
						";	
					if($module != 10)$query .= "
								module  = '{$module}',
								imgname = '',		
					";
					$query .= "lang    = '{$this->lang}'";
					DB::query($query);
				}else if(count($para) == 1){
					$query = "UPDATE {$table} SET info = '{$val}' WHERE listid = '{$listid}' and paraid = '{$paraid}' and lang = '{$this->lang}'";
					DB::query($query);
				}
			}
		}
	}
	
}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>