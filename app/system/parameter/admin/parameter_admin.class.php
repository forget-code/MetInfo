<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.

defined('IN_MET') or exit('No permission');

load::mod_class('base/admin/base_admin');

class parameter_admin extends base_admin {

	/**
	 * 初始化
	 */

	function __construct() {
		global $_M;
		parent::__construct();
		$this->database = load::mod_class('parameter/parameter_database', 'new');
	}

	/*产品参数设置*/
	function doparaset() {
		global $_M;

		if(!$_M['table']['para']){
		    $query = "CREATE TABLE `met_para` (
				  `id` int(11) NOT NULL AUTO_INCREMENT,
				  `pid` int(10) NOT NULL,
				  `value` varchar(255) DEFAULT NULL,
				  `module` int(10) NOT NULL,
				  `order` int(10) DEFAULT '0',
				  `lang` varchar(100) NOT NULL,
				  PRIMARY KEY (`id`)
				) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;";
			DB::query($query);
			add_table('para');
		}
		switch (intval($_M['form']['module'])) {
			case 6:
				nav::set_nav(1, $_M['word']['jobmanagement'], $_M['url']['adminurl'].'anyid=29&n=job&c=job_admin&&a=doindex&class1='.$_M['form']['class1']);
				nav::set_nav(2, $_M['word']['cvmanagement'], $_M['url']['adminurl'].'anyid=29&n=job&c=job_admin&&a=domanageinfo&class1='.$_M['form']['class1']);
				nav::set_nav(3, $_M['word']['cvset'], $_M['url']['own_form'].'a=doparaset&module=6&class1='.$_M['form']['class1']);
				nav::set_nav(4, $_M['word']['indexcv'], $_M['url']['adminurl'].'anyid=29&n=job&c=job_admin&&a=dosyset&class1='.$_M['form']['class1']);
				nav::select_nav(3);
				$_M['url']['help_tutorials_helpid']='102#2、简历表单设置';
				break;
			case 7:
				nav::set_nav(1, $_M['word']['messageTitle'], $_M['url']['adminurl'].'anyid=29&n=message&c=message_admin&&a=doindex&class1='.$_M['form']['class1']);
				nav::set_nav(2, $_M['word']['messageVoice'], $_M['url']['own_form'].'a=doparaset&module=7&class1='.$_M['form']['class1']);
				nav::set_nav(3, $_M['word']['messageincTitle'], $_M['url']['adminurl'].'anyid=29&n=message&c=message_admin&&a=dosyset&class1='.$_M['form']['class1']);
				nav::select_nav(2);
				$_M['url']['help_tutorials_helpid']='100#1、留言表单设置';
				break;
			case 8:
                $fname = DB::get_one("SELECT * FROM {$_M['table']['column']} WHERE id='{$_M['form']['class1']}'");
                nav::set_nav(1, $fname['name'].$_M[word]['msgmanager'], $_M['url']['adminurl'].'anyid=29&n=feedback&c=feedback_admin&&a=doindex&class1='.$_M['form']['class1']);
                nav::set_nav(2, $fname['name'].$_M['word']['feedback_formset_v6'], $_M['url']['own_form'].'a=doparaset&module=8&class1='.$_M['form']['class1']);
                nav::set_nav(3, $fname['name'].$_M['word']['syssetting'], $_M['url']['own_form'].'n=feedback&c=feedback_admin&a=dosyset&class1='.$_M['form']['class1']);
               	nav::select_nav(2);
                $_M['url']['help_tutorials_helpid']='101#1、反馈表单设置';
				break;
			case 10:
				nav::set_nav(1,$_M['word']['memberist'], $_M['url']['adminurl'].'anyid=73&n=user&c=admin_user&a=doindex');
				nav::set_nav(2, $_M['word']['membergroup'],$_M['url']['adminurl'].'anyid=73&n=user&c=admin_group&a=doindex');
				nav::set_nav(3, $_M['word']['memberattribute'],$_M[url]['own_form']."a=doparaset&module=10");
				nav::set_nav(4, $_M['word']['memberfunc'], $_M['url']['adminurl'].'anyid=73&n=user&c=admin_set&a=doindex');
				nav::set_nav(5, $_M['word']['thirdlogin'], $_M['url']['adminurl'].'anyid=73&n=user&c=admin_set&a=doopen');
				nav::set_nav(6, $_M['word']['mailcontentsetting'], $_M['url']['adminurl'].'anyid=73&n=user&c=admin_set&a=doemailset');
				nav::select_nav(3);
				$_M['url']['help_tutorials_helpid']='118#会员注册';
				break;
			default:
				$_M['url']['help_tutorials_helpid']='98#2、参数设置';
				break;
		}
		require $this->template('own/product_para');
	}
	public function doparasave(){
		global $_M;

		$this->table_para($_M['form'],$_M['form']['module']);

		turnover("{$_M[url]['own_form']}a=doparaset&module={$_M['form']['module']}&class1={$_M['form']['class1']}");
	}
	function dojson_para_list(){
		global $_M;
		$order = "no_order";
        if ($_M['form']['module'] == 8) {
            $where = "AND (class1 = '{$_M['form']['class1']}' OR class1 = '0')";
        }else{
            $where = '';
        }
		$paralist = $this->json_para_list($where, $order, $_M['form']['module']);
		foreach($paralist as $key=>$val){
			$val['value'] = $val['class1'].'-'.$val['class2'].'-'.$val['class3'];
			$list = array();
			$list[] = $val['id_html'];
			$list[] = $val['name_html'];
			$list[] = $val['paratype_html'];

			// if($_M['form']['class1']){
			// 	$c = load::sys_class('label', 'new')->get('column')->get_column_id($_M['form']['class1']);
			// 	$list[] = $c['name']."<select name=\"class-{$val[id]}\" style=\"display:none\">".$this->class_option($_M['form']['module'])."</select>";
			// }else{
			    if($_M[form][module]==7 || $_M[form][module]==6){
			    	$list[] = "{$_M['word'][allcategory]}<select name=\"class-{$id}\" style=\"display:none\"><option value=\"0-0-0\">{$_M['word'][allcategory]}</option></select>";
			    }else{
			    	$list[] = "<select name=\"class-{$val[id]}\" data-checked=\"{$val['value']}\"><option value=\"0-0-0\">{$_M['word'][allcategory]}</option>".$this->class_option($_M['form']['module']).'</select>';
			    }

			// }
			$list[] = $this->access_option("access-{$val[id]}",$val['access']);
			if(strpos('345', $_M['form']['module'])===false){
				$list[] = "<select name='wr_ok-{$val[id]}'  data-checked=\"{$val['wr_ok']}\"><option value='1'>{$_M['word']['yes']}</option><option value='0'>{$_M['word']['no']}</option></select>";
			}
			$list[] = $val['no_order_html'];
			$list[] = $val['options_html'];
			$rarray[] = $list;
		}
		$this->json_return($rarray);
	}
	public function doparaaddlist(){
		global $_M;
		$id = 'new-'.$_M['form']['ai'];
		$para_type = $this->para_type($id,'',$_M['form']['module']);
		$access_option = $this->access_option("access-{$id}");
		if($_M['form']['class1']){
			$c = load::sys_class('label', 'new')->get('column')->get_column_id($_M['form']['class1']);
			if($_M[form][module]==7 || $_M[form][module]==6){
               $class_option = "{$_M['word'][allcategory]}<select name=\"class-{$id}\" style=\"display:none\"><option value=\"0-0-0\">{$_M['word'][allcategory]}</option></select>";
			}else{
			  //$class_option = $c['name']."<select name=\"class-{$id}\" style=\"display:none\">".$this->class_option($_M['form']['module'])."</select>";
				$class_option = "<select name=\"class-{$id}\" data-checked=\"{$val['value']}\"><option value=\"0-0-0\">{$_M['word'][allcategory]}</option>".$this->class_option($_M['form']['module']).'</select>';
			}

		}else{
			$class_option = "<select name=\"class-{$id}\" data-checked=\"{$val['value']}\"><option value=\"0-0-0\">{$_M['word'][allcategory]}</option>".$this->class_option($_M['form']['module']).'</select>';
		}
		$metinfo ="<tr class=\"even newlist\">
					<td class=\"met-center\"><input name=\"id\" type=\"checkbox\" value=\"{$id}\" checked></td>
					<td><input type=\"text\" name=\"name-{$id}\" class=\"ui-input listname\" value=\"\" placeholder=\"{$_M['word'][paraname]}\"></td>
					<td class=\"met-center\">{$para_type}</td>
					<td class=\"met-center\">{$class_option}</td>
					<td class=\"met-center\">{$access_option}</td>";
		if(strpos('345', $_M['form']['module'])===false){
			$metinfo .="<td class=\"met - center\"><select name='wr_ok-{$id}'><option value='1'>{$_M['word']['yes']}</option><option value='0' selected>{$_M['word']['no']}</option></select></td>";
		}
		$metinfo .="<td class=\"met-center\"><input type=\"text\" name=\"no_order-{$id}\" class=\"ui-input met-center\" value=\"\"></td>
					<td><button type=\"button\" class=\"btn btn-info none paraoption\" data-id=\"{$id}\">{$_M['word'][listTitle]}</button><textarea name=\"options-{$id}\" hidden></textarea></td>
				</tr>";
		echo $metinfo;
	}

//===========================================

	public function para_type($id, $value,$module){
        global $_M;
        $module=intval($module);
		$re = "
			<select name=\"type-{$id}\" class=\"paratype\" data-checked=\"{$value}\">
				<option value=\"1\">{$_M['word'][parameter1]}</option>
				<option value=\"2\">{$_M['word'][parameter2]}</option>
				<option value=\"3\">{$_M['word'][parameter3]}</option>
				<option value=\"4\">{$_M['word'][parameter4]}</option>
				<option value=\"5\">{$_M['word'][parameter5]}</option>
				<option value=\"6\">{$_M['word'][parameter6]}</option>
				<!--<option value=\"7\">{$_M['word'][parameter7]}</option>-->
				<!--<option value=\"8\">仅管理员可修改</option>-->";
		if(!in_array($module,array(3,4,5))){
			$re .="<option value=\"8\">{$_M['word'][parameter8]}</option>
				<option value=\"9\">{$_M['word'][parameter9]}</option>";
		}
		if($module==3){
			$re .= "<option value=\"10\">{$_M['word'][parameter10]}</option>";
		}
		$re .= "</select>";
		return $re;
	}
	public function json_para_list($where, $order, $module){
		global $_M;
		$parameter_database = load::mod_class('parameter/parameter_database','new');
		//$this->table = load::sys_class('tabledata', 'new');
		$where = "lang='{$_M['lang']}' and module = '{$module}' {$where}";
		//$data = $this->table->getdata($_M['table']['parameter'], '*', $where, $order);
		$data = $this->database->table_json_list($where, $order);
		foreach ($data as $key => $value) {

			if($value[type]==2 || $value[type]==4 || $value[type]==6){
               $paralist=load::mod_class('parameter/parameter_database','new')->get_parameters($module,$value[id]);
               $para = array();
                foreach ($paralist as $k => $val) {
                		$para[$k]['id'] = $val['id'];
                		$para[$k]['value'] = $val['value'];
                		$para[$k]['order'] = $val['order'];
                }
                $value['options'] = $para ? json_encode($para) : '';
            }

			$datalist[]=$value;
		}
        //关联产品
        $query = "SELECT * FROM {$_M['table']['list']} WHERE bigid='{$_M[form][class1]}' AND no_order='99999' AND lang='{$_M['lang']}'";
        $metlistrele = DB::get_one($query);

        $config = load::sys_class('label', 'new')->get('config')->get_column_config($_M['form']['class1']);

		foreach($datalist as $key=>$val){
			$val['id_html'] = "<input name=\"id\" type=\"checkbox\" value=\"{$val[id]}\">";
			$val['no_order_html'] = "<input type=\"text\" name=\"no_order-{$val[id]}\" data-required=\"1\" class=\"ui-input met-center\" value=\"{$val['no_order']}\">";
			$val['name_html'] = "<input type=\"text\" name=\"name-{$val[id]}\" data-required=\"1\" class=\"ui-input listname\" value=\"{$val['name']}\">";
			$val['paratype_html'] = $this->para_type($val['id'],$val['type'],$module);
			$val['wr_oks_html'] = "<input name=\"wr_oks-{$val[id]}\" type=\"checkbox\" data-checked=\"{$val['wr_oks']}\" value=\"1\">";
			$val['wr_ok_html'] = "<input name=\"wr_ok-{$val[id]}\" type=\"checkbox\" data-checked=\"{$val['wr_ok']}\" value=\"1\">";
			$val['description_html'] = "<input type=\"text\" name=\"description-{$val[id]}\" class=\"ui-input listname\" value=\"{$val[description]}\">";
			$none = $val['type']==2||$val['type']==4||$val['type']==6?'':' none';
			$val['options_html'] = "<button type=\"button\" class=\"btn btn-info{$none} paraoption\" data-id=\"{$val[id]}\">{$_M['word'][listTitle]}</button><textarea name=\"options-{$val[id]}\" hidden>{$val['options']}</textarea>";
            if(($val['type']==2 || $val['type']==4 || $val['type']==6) && $module==8 && $val['id']==$config['met_fd_related']){
				$val['options_html'] .= "<select name=\"related-{$val['id']}\" data-checked=\"{$val['related']}\" style='margin-left: 10px;'><option value=\"0-0-0\">关联栏目</option>".$this->class_option(3,$val['related']).'</select>';
			}
			$datas[] = $val;
		}
		return $datas;
	}
	public function json_return($data){
		global $_M;
		//$this->table->rdata($data);
		$this->database->tabledata->rdata($data);
	}
	public function table_para($form,$module){
		global $_M;
		$list = explode(",",$form['allid']) ;
		$module=$_M[form][module];
		foreach($list as $id){
			if($id){
				if($form['submit_type']=='save'){
					if($form['class-'.$id]){
						$class 	 			 = explode("-",$form['class-'.$id]);
						$list['class1'] 	 = $class[0];
						$list['class2'] 	 = $class[1];
						$list['class3'] 	 = $class[2];
					}
					$list['no_order'] 	 = $form['no_order-'.$id];
					$list['name']     	 = $form['name-'.$id];
					$list['type']     	 = $form['type-'.$id];
					//$list['wr_oks']   	 = $form['wr_oks-'.$id];
					$list['wr_oks']   	 = 1;
					$list['wr_ok']       = $form['wr_ok-'.$id];
					$list['description'] = $form['description-'.$id];
					$list['options'] 	 = $list['type']==2||$list['type']==4||$list['type']==6?$form['options-'.$id]:'';
					$list['module']   	 = $module;
					$list['access'] 	 = $form['access-'.$id];
                    $list['related'] 	 = $form['related-'.$id];
					if(is_number($id)){
						$this->update_para_list($id,$list,$module);
					}else{
						$this->insert_para_list($list,$module);
					}
				}elseif($form['submit_type']=='del'){
					if(is_number($id)){
						$this->del_para_list($id,$module);
					}
				}
			}
		}
		return true;
	}

	public function update_para_list($id,$field,$module){
		global $_M;

		$field['id'] = $id;

		$options = json_decode(stripslashes($field['options']),true);

		$pid = array();//用来判断是否删除了值
		foreach ($options as $key => $option) {

			if(is_numeric($option['id'])){
				$row = $this->database->update_para_value($option);
				$pid[] = $option['id'];
			}else{
				unset($option['id']);
				$option['module'] = $module;
				$option['pid'] = $id;
				// 往para表增加一条数据
				$paraid = $this->database->add_para_value($option);
				$options[$key]['id'] = $paraid;
				$pid[] = $paraid;
			}
		}

		$this->database->delete_para_value($id,$pid);

		$field['options'] = jsonencode($options);
		$this->database->update_by_id($field);

		cache::del("para/paralist_{$module}_{$_M['lang']}");
	}
	public function insert_para_list($field,$module){
		global $_M;

		$options = json_decode(stripslashes($field['options']),true);
		$field['lang'] = $_M['lang'];

		$pid = $this->database->insert($field);

		foreach ($options as $key=> $option) {
			$option['pid'] = $pid;
			$option['module'] = $module;
			$id = $this->database->add_parameter($option);
			if($id){
				$options[$key]['id'] = $id;
			}else{
				$options[$key]['id'] =111;
			}

		}

		$field['options'] = jsonencode($options);
		$field['id'] = $pid;
		$this->database->update_by_id($field);
		cache::del("para/paralist_{$module}_{$_M['lang']}");
	}

	public function del_para_list($id,$module){
		global $_M;
		if(is_number($id)){
			$this->database->del_by_id($id);
			$this->database->delete_para_value($id);
			cache::del("para/paralist_{$module}_{$this->lang}");
		}
	}


}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>
