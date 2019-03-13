<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.

defined('IN_MET') or exit('No permission');

class config_ui {
	public $config;
	public $no;
	public $lang;
	public $skin_name;

	function __construct($no, $lang) {
		global $_M;
		$this->no = $no;
		$this->lang = $lang;
		$this->skin_name = $_M['config']['met_skin_user'];
	}

	/*读取配置*/
	public function get_config($mid) {
		global $_M;

		$query = "ALTER TABLE `{$_M['table']['ui_config']}` ADD COLUMN `uip_hidden`  tinyint(1) NULL DEFAULT 0 AFTER `uip_order`";
		DB::query($query);
		$query = "SELECT * FROM {$_M['table']['ui_config']} WHERE pid = {$mid} AND lang = '{$_M['lang']}' AND skin_name = '{$this->skin_name}' order by uip_hidden,uip_order";
		$config = DB::get_all($query);
		return $config;
	}


	// UI模式下获取全局变量
	public function get_public_config()
	{
		global $_M;
		$query = "SELECT * FROM {$_M['table']['ui_config']} WHERE parent_name = 'global' AND skin_name = '{$this->skin_name}' AND lang = '{$_M['lang']}' ORDER BY uip_order";
		return DB::get_all($query);

	}

	public function get_config_column($mid)
	{
		global $_M;
		$query = "SELECT * FROM {$_M['table']['ui_config']} WHERE pid = {$mid} AND lang = '{$_M['lang']}' AND uip_type = 6";
		$column = DB::get_all($query);
		if(count($column) > 1){
			return 2;
		}
		return DB::get_one($query);
	}

	public function get_ui($pid)
	{
		global $_M;
		$query = "SELECT * FROM {$_M['table']['ui_list']} WHERE installid = {$pid} AND skin_name = '{$this->no}' ";
		return DB::get_one($query);
	}

	public function set_public_config($config)
	{
		global $_M;
		$public = $this->get_public_config();
		foreach ($public as $key => $val) {
			$id = $val['id']."_metinfo";
			$uip_value = $config[$id];
			if($val['uip_value'] != $uip_value && $val['ui_type'] != 1){
				$uip_value = mysqlcheck($uip_value);
				$query = "UPDATE {$_M['table']['ui_config']} SET uip_value = '{$uip_value}' WHERE id = {$val['id']}";
				DB::query($query);
			}
		}
		return array('status'=>1);
	}
	/*配置文件保存*/
	public function save_config($config){
		global $_M;
		$ui_config = $this->get_config($config['mid']);
		foreach($ui_config as $key=>$val){
			$id = $val['id']."_metinfo";

			$uip_value = $config[$id];
			if($val['uip_value'] != $uip_value && $val['ui_type'] != 1){
				$uip_value = mysqlcheck($uip_value);
				$query = "UPDATE {$_M['table']['ui_config']} SET uip_value = '{$uip_value}' WHERE id = {$val['id']}";
				DB::query($query);
			}
		}
	}




	public function list_html($mid){
		global $_M;
		$config = array();
		$config['html'] =  $this->parse_config($this->get_config($mid));
		$config['desc'] = $this->get_ui($mid);
		return $config;
	}

	/*解析配置为html代码*/
	public function parse_config($config) {
		global $_M;

		$html = array();
		foreach ($config as $key=>$val) {
			switch($val['uip_type']){
				case 2:
					$re = $this->text($val);
				break;
				case 3:
					$re = $this->textarea($val);
				break;
				case 4:
					$re = $this->radio($val);
				break;
				case 5:
					$re = $this->checkbox($val);
				break;
				case 6:
					$re = $this->select($val);
				break;
				case 7:
					$re = $this->upload($val);
				break;
				case 8:
					$re = $this->editor($val);
				break;
				case 9:
					$re = $this->color($val);
				break;
				case 10:
					$re = $this->dateselect($val);
				break;
				case 11:
					$re = $this->slider($val);
				break;
				case 12:
					$re = $this->label($val);
				break;
				case 13://增加新组件类型（新模板框架v2）
					$re = $this->upload($val);
				break;
			}
			$html[] = $re;
		}
		return $html;
	}

	/*
	 *标题栏html
	 * 0：分类设置
	 * 1：区块设置
	 */
	public function tlebar($val) {
		global $_M;
		$val['ftype']="";
		$val['inputhtm']="{$val['uip_title']}";
		$val['uip_title']="";
		$val['sliding']=1;
		if ($val['uip_style'] == 1) {
			$val['inputhtm']="<span class='blockname'>{$val['uip_title']}</span>";
			$val['uip_title']="";
			$val['sliding']=1;
		}
		return $val;
	}

	/*简短输入框*/
	public function text($val){
		global $_M;
		$convlue = $val['uip_name'];
		$convlue = $val['uip_style'] ==0 ? $val['uip_value'] : $_M['config'][$val['uip_value']];
		$convlue = $val['uip_value']=="" ? $val['uip_default']:$val['uip_value'];
		$flag = "";
		if($val['uip_name'] == 'met_font'){
			$flag = "data-name={$val['uip_name']}";
		}
		$val['inputhtm'] ="
			<div class=\"fbox\">
				<input type=\"text\" name=\"{$val['id']}_metinfo\" {$flag} value=\"{$convlue}\" />
			</div>
			<span class=\"tips\">{$val['uip_description']}</span>
		";
		$val['ftype']="ftype_input";
		return $val;
	}

	/*输入文本域*/
	public function textarea($val){
		global $_M;
		$val['ftype']="ftype_textarea";
		$convlue = $val['uip_name'];
		$convlue = $val['uip_style'] ==0 ? $val['uip_value'] : $_M['config'][$val['uip_value']];
		$convlue = $val['uip_value']=="" ? $val['uip_default']:$val['uip_value'];

		$val['inputhtm'] ="
			<div class=\"fbox\">
				<textarea name=\"{$val['id']}_metinfo\">{$convlue}</textarea>
			</div>
			<span class=\"tips\">{$val['uip_description']}</span>
		";
		return $val;
	}

	public function radio($val){
		global $_M;
		$val['ftype']="ftype_radio";
		$vlist=explode('$M$',$val['uip_select']);
		$val['inputhtm']='<div class="fbox">';
		foreach($vlist as $key=>$val2){
			$vz=explode('$T$',$val2);
			$val['uip_value']=$val['uip_value']=="" ? $val['uip_default']:$val['uip_value'];
			if($vz[0]){
			$val['inputhtm'].="<label>";
			$select=$val['uip_value']==$vz[1]?'checked':'';
			$val['inputhtm'].="<input value='".$vz[1]."' name='{$val['id']}_metinfo' type='radio' {$select} />".$vz[0];
			$val['inputhtm'].="</label>";
			}
		}
		$val['inputhtm'].='</div>';
		$val['inputhtm'].="<span class='tips'>{$val['uip_description']}</span>";
		return $val;
	}

	public function checkbox($val){}
	/**
	 * 下拉html
	 * 0:自定义下拉选项
	 * 1：moudule小于6的一级栏目下拉
	 * 2：moudule小于7的三级栏目下拉
	 * 3：moudule为2,3,5的三级栏目下拉
	 * 4：三级栏目下拉，所有模块栏目
	 */
	public function select($val) {
		global $_M;
		if($val['uip_style']==2)$val['uip_style']=4;
		if ($val['uip_style'] == 0) {
			$val['ftype']="ftype_select";
			$val['inputhtm'] ="<div class='fbox'><select name='{$val['id']}_metinfo' data-checked='{$val['uip_value']}'>";
			$vlist=explode('$M$',$val['uip_select']);
			foreach($vlist as $key=>$val2){
				$vz=explode('$T$',$val2);
				$val['uip_value']=$val['uip_value']=="" ? $val['uip_default']:$val['uip_value'];
				$select=$val['uip_value']==$vz[1]?'uip_select':'';
				$val['inputhtm'].="<option value='".$vz[1]."' {$select}>".$vz[0]."</option>";
			}
			$val['inputhtm'].="</select></div>";
			$val['inputhtm'].="<span class='tips'>{$val['uip_description']}</span>";
		}else{
			$val['ftype']="ftype_select";
			$hngy5 = $val['uip_style'];
			$array = column_sorting(2);
			$met_class1 = $array['class1'];
			$met_class2 = $array['class2'];
			$met_class3 = $array['class3'];
			$val['inputhtm'] ="<select name='{$val['id']}_metinfo' data-checked='{$val['uip_value']}'>";
			$val['inputhtm'].="<option value=''>{$_M['word']['skinerr3']}</option>";
			switch($hngy5){
				case 1:
					foreach($met_class1 as $key=>$val2){
						if(!$val2['if_in']){
						$select=$val['uip_value']==$val2[id]?'uip_select':'';
						$val['inputhtm'].="<option value='".$val2[id]."' {$select} class='c1'>".$val2['name']."</option>";
						}
					}
				break;
				case 3:
					foreach($met_class1 as $key=>$val2){
						$val2['cok']=0;
						if(count($met_class2[$val2[id]])){
							foreach($met_class2[$val2[id]] as $key=>$val6){
								if($val6['module'] > 1 && $val6['module'] < 7 ){
									$val2['cok'] = 1;
								}
							}
						}
						if(($val2['module']>1&&$val2['module']<7)||$val2['cok']){
						$select=$val['uip_value']==$val2['id']?'uip_select':'';
						$disabled='';
						if(($val2['module']<2||$val2['module']>6)&&$val2['cok'])$disabled='disabled';
						$val['inputhtm'].="<option value='".$val2['id']."' {$select} class='c1' {$disabled}>==".$val2['name']."==</option>";
						foreach($met_class2[$val2['id']] as $key=>$val3){
							if(($val3['module']>=2&&$val3['module']<=6)&&!$val3['if_in']){
							$select2=$val['uip_value']==$val3['id']?'uip_select':'';
							$val['inputhtm'].="<option value='".$val3['id']."' {$select2} class='c2'>".$val3['name']."</option>";
							foreach($met_class3[$val3['id']] as $key=>$val4){
								$select3=$val['uip_value']==$val4['id']?'uip_select':'';
								$val['inputhtm'].="<option value='".$val4['id']."' {$select3} class='c3'>+".$val4['name']."</option>";
							}
							}
						}
						}
					}
					for($i=2;$i<6;$i++){
						if($i!=4){
						$langmod1=$_M['word']['mod'.$i];
						$select=$val['uip_value']==$i.'-md'?'uip_select':'';
						$val['inputhtm'].="<option value='".$i."-md' {$select} class='c0'>==".$langmod1."==</option>";
						}
					}
				break;
				case 4:
					foreach($met_class1 as $key=>$val2){
						//if(!$val2[if_in]){
							$select=$val['uip_value']==$val2[id]?'uip_select':'';
							$val['inputhtm'].="<option value='".$val2[id]."' {$select} class='c1'>==".$val2[name]."==</option>";
							foreach($met_class2[$val2['id']] as $key=>$val3){
								//if(!$val3[if_in]){
									$select2=$val['uip_value']==$val3[id]?'uip_select':'';
									$val['inputhtm'].="<option value='".$val3[id]."' {$select2} class='c2'>".$val3[name]."</option>";
									foreach($met_class3[$val3['id']] as $key=>$val4){
										$select3=$val['uip_value']==$val4[id]?'uip_select':'';
										$val['inputhtm'].="<option value='".$val4[id]."' {$select3} class='c3'>+".$val4[name]."</option>";
									}
								//}
							}
						//}
					}
				break;
			}
			$val[inputhtm].="</select>";
			$val[inputhtm].="<span class='tips'>{$val['uip_description']}</span>";
		}
		return $val;
	}

	/**
	 * 上传空间html
	 * 0:自定义
	 * 1:编辑值为系统设置
	 */
	public function upload($val) {
		global $_M;
		$convlue = $val['uip_name'];
		$convlue = $val['uip_style'] ==0 ? $val['uip_value'] : $_M['config'][$val['uip_value']];
		$convlue = $val['uip_value']=="" ? $val['uip_default']:$val['uip_value'];
		// 增加上传组件类型判断（新模板框架v2）
		$val[ftype]="ftype_upload";
		$upload_type=$val[type]==13?'doupfile':'doupimg';
		$upload_accept=$val[type]==13?'video/*':'*';
		$val[inputhtm]="
			<div class=\"fbox\">
				<input
					name=\"{$val['id']}_metinfo\"
					type=\"text\"
					data-upload-type=\"{$upload_type}\"
					value=\"{$convlue}\"
				/>
			</div>
			<span class=\"tips\">{$val['uip_description']}</span>
		";
		return $val;
	}

	/**
	 * 编辑器html
	 * 0:自定义
	 * 1:编辑值为系统设置
	 */
	public function editor($val){
		global $_M;
		$val[ftype]="ftype_ckeditor_theme";
		$convlue = $val['uip_name'];
		$convlue = $val['uip_style'] ==0 ? $val['uip_value'] : $_M['config'][$val['uip_value']];
		$convlue = $val['uip_value']=="" ? $val['uip_default']:$val['uip_value'];
		$val[inputhtm] ="
			<div class=\"fbox\">
				<textarea name=\"{$val['id']}_metinfo\" data-ckeditor-type=\"2\" data-ckeditor-y='300'>{$convlue}</textarea>
			</div>
			<span class='tips'>{$val['uip_description']}</span>
		";
		return $val;
	}

	/*颜色选择*/
	public function color($val){
		global $_M;
		$val[ftype]="ftype_color";
		$val['uip_value'] = $val['uip_value'] ? $val['uip_value'] : $val['uip_default'];
		$val[inputhtm]="
			<div class=\"fbox\">
				<input type=\"text\" name=\"{$val['id']}_metinfo\" value=\"{$val['uip_value']}\">
			</div>
			<span class=\"tips\">{$val['uip_description']}</span>
		";
		return $val;
	}

	public function dateselect($val){}

	public function slider($val){}

	public function label($val){}

	public function change_skin($skin_name)
	{
		global $_M;

		$this->update_lang_config($skin_name);
		$query = "UPDATE {$_M['table']['config']} SET value='{$skin_name}' WHERE name = 'met_skin_user' AND lang = '{$_M['lang']}'";
		return DB::query($query);
	}

	public function update_lang_config($skin_name)
    {
        global $_M;

        $query = "SELECT * FROM {$_M['table']['ui_config']} WHERE skin_name = '{$skin_name}' AND lang != '{$_M['lang']}'";

        $res = DB::get_one($query);

        if($res){
            $lang = $res['lang'];
        }else{
            $lang = $_M['lang'];
        }


        $query = "SELECT * FROM {$_M['table']['ui_config']} WHERE lang = '{$lang}' AND skin_name = '{$skin_name}'";
        $config = DB::get_all($query);


        foreach ($config as $v) {
            $query = "SELECT id FROM {$_M['table']['ui_config']} WHERE uip_key = '{$v['uip_key']}' AND lang = '{$_M['lang']}' AND skin_name = '{$skin_name}' AND parent_name = '{$v['parent_name']}' AND ui_name = '{$v['ui_name']}' AND pid = {$v['pid']}";
            $has = DB::get_one($query);

            if(!$has){
                $new = $v;
                unset($new['id'],$new['uip_value']);
                $new['lang'] = $_M['lang'];
                $insert = $this->get_sql($new);
                $query = "INSERT INTO {$_M['table']['ui_config']} SET {$insert}";
                $row = DB::query($query);
                if(!$row){
                    return false;
                }
            }
        }
    }

    public function get_sql($data) {
        global $_M;

        $sql = "";
        foreach ($data as $key => $value) {
            $sql .= " {$key} = '{$value}',";
        }
        return trim($sql,',');
    }
}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>
