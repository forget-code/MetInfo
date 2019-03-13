<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.

class config_tem{

	public $no;//模板编号
	public $lang;//模板语言

	function __construct($no, $lang) {
		global $_M;
		$this->no = $no;
		$this->lang = $_M['lang'];
	}

	public function get_config($name){
		global $_M;
		if(is_numeric($name)){
			$query = "SELECT * FROM {$_M['table']['templates']} WHERE pos = {$name} AND lang='{$this->lang}' AND no = '{$this->no}' ";
		}else{
			$query = "SELECT * FROM {$_M['table']['templates']} WHERE bigclass = (SELECT id FROM {$_M['table']['templates']} WHERE lang='{$this->lang}' AND no = '{$this->no}' AND name='{$name}') AND lang='{$this->lang}' ORDER BY no_order";
		}

		return DB::get_all($query);
	}


	public function get_area($name)
	{
		global $_M;
		$query = "SELECT * FROM {$_M['table']['templates']} WHERE lang='{$this->lang}' AND no = '{$this->no}' AND name='{$name}'";
		return DB::get_one($query);
	}

	/**
	 * 前端按区保存
	 */
	public function save_config($config){
		global $_M;
		foreach ($config as $key => $value) {
			$name = str_replace('_metinfo', '', $key);
			$query = "UPDATE {$_M['table']['templates']} SET value='{$value}' WHERE name='{$name}' AND lang='{$_M['lang']}' AND no='{$this->no}'";
			$row = DB::query($query);
		}
	}

	public function get_public_config()
	{
		global $_M;
		$query = "SELECT * FROM {$_M['table']['templates']} WHERE bigclass = (SELECT id FROM {$_M['table']['templates']} WHERE lang='{$this->lang}' AND no = '{$this->no}' AND name='global') ORDER BY no_order";
		return DB::get_all($query);
	}

	public function set_public_config($config)
	{
		global $_M;
		foreach ($config as $key => $value) {
			$name = str_replace('_metinfo', '', $key);
			$query = "UPDATE {$_M['table']['templates']} SET value='{$value}' WHERE name='{$name}' AND lang='{$_M['lang']}' AND no='{$this->no}'";

			$row = DB::query($query);
		}

		return array('status'=>1);
	}

	public function set_page_config($config)
	{
		global $_M;
		foreach ($config as $key => $val) {
			$query = "UPDATE {$_M['table']['config']} SET value='{$val}' WHERE name='{$key}' AND lang='{$_M['lang']}'";
			DB::query($query);
		}
		return array('status'=>1);
	}


	public function get_config_column($name)
	{
		global $_M;
		$query = "SELECT * FROM {$_M['table']['templates']} WHERE name = '{$name}' AND lang = '{$_M['lang']}' AND type = 1 AND no = '{$this->no}'";
		$area = DB::get_one($query);
		$query = "SELECT * FROM {$_M['table']['templates']} WHERE type = 6 AND no = '{$this->no}' AND lang = '{$_M['lang']}' AND bigclass = {$area['id']}";

		$column = DB::get_all($query);
		if(count($column) > 1){
			return 2;
		}
		return DB::get_one($query);
	}

	public function list_html($name){
		global $_M;

		$config = array();
		$config['html'] = $this->parse_config($this->get_config($name));
		$config['desc'] = $this->get_area($name);
		return $config;
	}

	public function parse_config($config){
		global $_M;
		$html = array();
		foreach ($config as $key=>$val) {
			switch($val['type']){
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
			$html[] = $this->clear($re);
		}
		return $html;

	}


	/*预览*/
	function tminipreview($have){
		global $_M;
		//新方法
		$langtext = $this->uiclass -> tminiget('all');

		$cglist = $this->configlist;
		if($have['mobile']=='1'){
			$have['wap_skin_user'] = $have['met_skin_user'];
			$have['wap_skin_css'] = $have['met_skin_css'];
			$cglist = $this->mobile_configlist;
			$have['met_flash_10001_y'] = $have['met_flash_10001_y']?$have['met_flash_10001_y']:'400';
			$have['flash_10001'] = '1|'.$have['met_flash_10001_y'];
		}else{
			/*备用字段*/
			for($i=1;$i<=10;$i++){
				$preview['otherinfo']['info'.$i] = str_replace("\\","",$have['info'.$i]);
			}
			$preview['otherinfo']['imgurl1'] = $have['imgurl1'];
			$preview['otherinfo']['imgurl2'] = $have['imgurl2'];


			$have['flash_10001'] = '3|'.$have['met_flash_10001_x'].'|'.$have['met_flash_10001_y'].'|'.$have['met_flash_10001_imgtype'];
		}
		/*系统配置数据*/
		$cglist[] = 'met_productTabok';
		$cglist[] = 'met_productTabname';
		$cglist[] = 'met_productTabname_1';
		$cglist[] = 'met_productTabname_2';
		$cglist[] = 'met_productTabname_3';
		$cglist[] = 'met_productTabname_4';
		foreach($cglist as $key=>$val){
			global $_M;
			$have[$val] = str_replace("\\","",$have[$val]);
			$preview['config'][$val]=$have[$val];
		}

		/*模板自定义参数*/
		foreach($langtext as $key=>$val){
			global $_M;
			//if($key!='linetop'){
				$namelist=$val['name']."_metinfo";
				$preview['langini'][$val['name']] = str_replace("\\","",$have[$namelist]);
			//}
		}

		/*大图轮播*/
		$have['indexbannerlist'] = str_replace("\\","",$have['indexbannerlist']);
		$preview['banner']['index'] = json_decode($have['indexbannerlist'],true);

		/*写入数据表*/
		$value = json_encode($preview);
		$value = str_replace("'","''",$value);
		$value = str_replace("\\","\\\\",$value);
		DB::query("UPDATE {$_M[table][config]} SET value = '{$value}' WHERE name = 'met_theme_preview' AND lang='{$this->lang}'");
		//echo "UPDATE {$_M[table][config]} SET value = '{$value}' WHERE name = 'met_theme_preview' AND lang='{$lang}'";
		//die();
	}

	public function clear($val) {
		global $_M;
		unset($val['id']);
		unset($val['no']);
		unset($val['pos']);
		unset($val['no_order']);
		unset($val['type']);
		unset($val['style']);
		unset($val['selectd']);
		unset($val['lang']);
		return $val;
	}
	/*
	 *标题栏html
	 * 0：分类设置
	 * 1：区块设置
	 */
	public function tlebar($val) {
		global $_M;
		$val['ftype']="";
		$val['inputhtm']="{$val['valueinfo']}";
		$val['valueinfo']="";
		$val['sliding']=1;
		if ($val['style'] == 1) {
			$val['inputhtm']="<span class='blockname'>{$val[valueinfo]}</span>";
			$val['valueinfo']="";
			$val['sliding']=1;
		}
		return $val;
	}

	/*简短输入框*/
	public function text($val){
		global $_M;
		$convlue = $val[name];
		$convlue = $val['style'] ==0 ? $val['value'] : $_M['config'][$val['value']];
		$convlue = $val['value']=="" ? $val['defaultvalue']:$val['value'];
		$flag = "";
		if($val['name'] == 'met_font'){
			$flag = "data-name={$val['name']}";
		}
		$val[inputhtm] ="
			<div class=\"fbox\">
				<input type=\"text\" name=\"{$val[name]}_metinfo\" {$flag} value=\"{$convlue}\" />
			</div>
			<span class=\"tips\">{$val[tips]}</span>
		";
		$val[ftype]="ftype_input";
		return $val;
	}

	/*输入文本域*/
	public function textarea($val){
		global $_M;
		$val[ftype]="ftype_textarea";
		$convlue = $val[name];
		$convlue = $val['style'] ==0 ? $val['value'] : $_M['config'][$val['value']];
		$convlue = $val['value']=="" ? $val['defaultvalue']:$val['value'];

		$val[inputhtm] ="
			<div class=\"fbox\">
				<textarea name=\"{$val[name]}_metinfo\">{$convlue}</textarea>
			</div>
			<span class=\"tips\">{$val[tips]}</span>
		";
		return $val;
	}

	public function radio($val){
		global $_M;
		$val[ftype]="ftype_radio";
		$vlist=explode('$M$',$val['selectd']);
		$val[inputhtm]='<div class="fbox">';
		foreach($vlist as $key=>$val2){
			$vz=explode('$T$',$val2);
			$val['value']=$val['value']=="" ? $val['defaultvalue']:$val['value'];
			if($vz[0]){
			$val[inputhtm].="<label>";
			$select=$val['value']==$vz[1]?'checked':'';
			$val['inputhtm'].="<input value='".$vz[1]."' name='{$val[name]}_metinfo' type='radio' {$select} />".$vz[0];
			$val[inputhtm].="</label>";
			}
		}
		$val[inputhtm].='</div>';
		$val[inputhtm].="<span class='tips'>{$val[tips]}</span>";
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
		if($val['style']==2)$val['style']=4;
		if ($val['style'] == 0) {
			$val[ftype]="ftype_select";
			$val[inputhtm] ="<div class='fbox'><select name='{$val[name]}_metinfo'>";
			$vlist=explode('$M$',$val['selectd']);
			foreach($vlist as $key=>$val2){
				$vz=explode('$T$',$val2);
				$val['value']=$val['value']=="" ? $val['defaultvalue']:$val['value'];
				$select=$val['value']==$vz[1]?'selected':'';
				$val['inputhtm'].="<option value='".$vz[1]."' {$select}>".$vz[0]."</option>";
			}
			$val[inputhtm].="</select></div>";
			$val[inputhtm].="<span class='tips'>{$val[tips]}</span>";
		}else{
			$val[ftype]="ftype_select";
			$hngy5 = $val['style'];
			$array = column_sorting(2);
			$met_class1 = $array['class1'];
			$met_class2 = $array['class2'];
			$met_class3 = $array['class3'];
			$val['inputhtm'] ="<select name='{$val[name]}_metinfo'>";
			$val['inputhtm'].="<option value=''>{$_M[word][skinerr3]}</option>";
			switch($hngy5){
				case 1:
					foreach($met_class1 as $key=>$val2){
						if(!$val2[if_in]){
						$select=$val['value']==$val2[id].''?'selected':'';
						$val['inputhtm'].="<option value='".$val2[id]."' {$select} class='c1'>".$val2[name]."</option>";
						}
					}
				break;
				case 3:
					foreach($met_class1 as $key=>$val2){
						$val2['cok']=0;
						if(count($met_class2[$val2[id]])){
							foreach($met_class2[$val2[id]] as $key=>$val6){
								if($val6[module] > 1 && $val6[module] < 7 ){
									$val2['cok'] = 1;
								}
							}
						}
						if(($val2[module]>1&&$val2[module]<7)||$val2['cok']){
						$select=$val['value']==$val2[id].''?'selected':'';
						$disabled='';
						if(($val2[module]<2||$val2[module]>6)&&$val2['cok'])$disabled='disabled';
						$val['inputhtm'].="<option value='".$val2[id]."' {$select} class='c1' {$disabled}>==".$val2[name]."==</option>";
						foreach($met_class2[$val2['id']] as $key=>$val3){
							if(($val3[module]>=2&&$val3[module]<=6)&&!$val3[if_in]){
							$select2=$val['value']==$val3[id].''?'selected':'';
							$val['inputhtm'].="<option value='".$val3[id]."' {$select2} class='c2'>".$val3[name]."</option>";
							foreach($met_class3[$val3['id']] as $key=>$val4){
								$select3=$val['value']==$val4[id].''?'selected':'';
								$val['inputhtm'].="<option value='".$val4[id]."' {$select3} class='c3'>+".$val4[name]."</option>";
							}
							}
						}
						}
					}
					for($i=2;$i<6;$i++){
						if($i!=4){
						$langmod1=$_M[word]['mod'.$i];
						$select=$val['value']==$i.'-md'?'selected':'';
						$val['inputhtm'].="<option value='".$i."-md' {$select} class='c0'>==".$langmod1."==</option>";
						}
					}
				break;
				case 4:
					foreach($met_class1 as $key=>$val2){
						//if(!$val2[if_in]){
							$select=$val['value']==$val2[id].''?'selected':'';
							$val['inputhtm'].="<option value='".$val2[id]."' {$select} class='c1'>==".$val2[name]."==</option>";
							foreach($met_class2[$val2['id']] as $key=>$val3){
								//if(!$val3[if_in]){
									$select2=$val['value']==$val3[id].''?'selected':'';
									$val['inputhtm'].="<option value='".$val3[id]."' {$select2} class='c2'>".$val3[name]."</option>";
									foreach($met_class3[$val3['id']] as $key=>$val4){
										$select3=$val['value']==$val4[id].''?'selected':'';
										$val['inputhtm'].="<option value='".$val4[id]."' {$select3} class='c3'>+".$val4[name]."</option>";
									}
								//}
							}
						//}
					}
				break;
			}
			$val[inputhtm].="</select>";
			$val[inputhtm].="<span class='tips'>{$val[tips]}</span>";
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
		$convlue = $val[name];
		$convlue = $val['style'] ==0 ? $val['value'] : $_M['config'][$val['value']];
		$convlue = $val['value']=="" ? $val['defaultvalue']:$val['value'];
		// 增加上传组件类型判断（新模板框架v2）
		$val[ftype]="ftype_upload";
		$upload_type=$val[type]==13?'doupfile':'doupimg';
		$upload_accept=$val[type]==13?'video/*':'*';
		$val[inputhtm]="
			<div class=\"fbox\">
				<input
					name=\"{$val[name]}_metinfo\"
					type=\"text\"
					data-upload-type=\"{$upload_type}\"
					value=\"{$convlue}\"
				/>
			</div>
			<span class=\"tips\">{$val[tips]}</span>
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
		$convlue = $val[name];
		$convlue = $val['style'] ==0 ? $val['value'] : $_M['config'][$val['value']];
		$convlue = $val['value']=="" ? $val['defaultvalue']:$val['value'];
		$val[inputhtm] ="
			<div class=\"fbox\">
				<textarea name=\"{$val[name]}_metinfo\" data-ckeditor-type=\"2\" data-ckeditor-y='300'>{$convlue}</textarea>
			</div>
			<span class='tips'>{$val[tips]}</span>
		";
		return $val;
	}

	/*颜色选择*/
	public function color($val){
		global $_M;
		$val[ftype]="ftype_color";
		$val[inputhtm]="
			<div class=\"fbox\">
				<input type=\"text\" name=\"{$val[name]}_metinfo\" value=\"{$val['value']}\">
			</div>
			<span class=\"tips\">{$val[tips]}</span>
		";
		return $val;
	}

	public function dateselect($val){}

	public function slider($val){}

	public function label($val){}

	/*读取配置*/
	public function tminiget($pos = '') {
		global $_M;
		$pos   = $pos?$pos:'0';
		$posw  = $pos=='all'?'':" and pos='{$pos}' ";
		$query = "SELECT * FROM {$_M['table']['templates']} WHERE no='{$this->no}' {$posw} AND lang='{$this->lang}' order by no_order,id ";
		$this->inc = DB::get_all($query);
		return $this->inc;
	}

	public function change_skin($skin_name)
	{
		global $_M;

		$this->update_lang_config($skin_name);
		$query = "UPDATE {$_M['table']['config']} SET value='{$skin_name}' WHERE name = 'met_skin_user' AND lang = '{$this->lang}'";
		return DB::query($query);
	}


	public function update_lang_config($skin_name)
	{
		global $_M;

		$query = "SELECT * FROM {$_M['table']['templates']} WHERE no = '{$skin_name}'";

        $res = DB::get_one($query);

        if($res){
            $lang = $res['lang'];
        }else{
            $lang = $_M['lang'];
        }

        $this->copy_tempates($skin_name,$lang);
	}

	public function copy_tempates($skin_name,$from_lang,$to_lang)
	{
		global $_M;
		if(!$to_lang){
			$to_lang = $_M['lang'];
		}
		$query="select * from {$_M['table']['templates']} where lang='{$from_lang}' and no='$skin_name' AND bigclass=0";
		$templates = DB::get_all($query);

		foreach ($templates as $key => $val) {
			$query = "SELECT id FROM {$_M['table']['templates']} WHERE name = '{$val['name']}' AND lang = '{$to_lang}' AND no = '{$skin_name}'";

            $has = DB::get_one($query);

            if(!$has){
            	$id = $val['id'];
				unset($val['id']);
				$parent = $val;
				$parent['lang'] = $to_lang;
				$this->insert_templates($parent);
				$cid =DB::insert_id();
				$query = "SELECT * FROM {$_M['table']['templates']} where lang='{$from_lang}' and no='{$skin_name}' AND bigclass={$id}";
				file_put_contents(PATH_WEB.'cache/test.txt', $query."\n",FILE_APPEND);
				$source = DB::get_all($query);
				foreach ($source as $k => $v) {
					$sub = $v;
					unset($v,$sub['id']);
					$sub['bigclass'] = $cid;
					$sub['lang'] = $to_lang;
					$this->insert_templates($sub);
					unset($sub);
				}
            }
		}
	}

	public function insert_templates($data)
    {
    	global $_M;
    	$sql = "";
        foreach ($data as $key => $value) {
            if(strstr($value, "'")){
                $value = str_replace("'", "\'", $value);
            }
            $sql .= " {$key} = '{$value}',";
        }
        $sql = trim($sql,',');
        $query = "INSERT INTO {$_M['table']['templates']} SET {$sql}";
        return DB::query($query);
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