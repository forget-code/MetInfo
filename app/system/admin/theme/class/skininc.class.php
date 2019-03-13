<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.

defined('IN_MET') or exit('No permission');

class skininc {
	public $inc;
	public $no;
	public $lang;
	function __construct($no, $lang) {
		$this->no = $no;
		$this->lang = $lang;
	}

	/*读取配置*/
	public function tminiget($pos = '') {
		global $_M;
		$pos   = $pos?$pos:'0';
		$posw  = $pos=='all'?'':" and pos='{$pos}' ";
		$query = "SELECT * FROM {$_M['table']['templates']} WHERE no='{$this->no}' {$posw} AND lang='{$this->lang}' order by no_order,id ";
		$this->inc = DB::get_all($query);
		return $this->inc;
	}

	/*解析配置为html代码*/
	public function tminiment($pos = '') {
		global $_M;
		$inc = $this->tminiget($pos);
		foreach ($inc as $key=>$val) {
			switch($val['type']){
				case 1:
					$re = $this->tlebar($val);
				break;
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
			$langtextx[] = $this->clear($re);
		}
		return $langtextx;
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
		$val[inputhtm] ="
			<div class=\"fbox\">
				<input type=\"text\" name=\"{$val[name]}_metinfo\" value=\"{$convlue}\" />
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
						$select=$val['value']==$val2[id].'-cm'?'selected':'';
						$val['inputhtm'].="<option value='".$val2[id]."-cm' {$select} class='c1'>".$val2[name]."</option>";
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
						$select=$val['value']==$val2[id].'-cm'?'selected':'';
						$disabled='';
						if(($val2[module]<2||$val2[module]>6)&&$val2['cok'])$disabled='disabled';
						$val['inputhtm'].="<option value='".$val2[id]."-cm' {$select} class='c1' {$disabled}>==".$val2[name]."==</option>";
						foreach($met_class2[$val2['id']] as $key=>$val3){
							if(($val3[module]>=2&&$val3[module]<=6)&&!$val3[if_in]){
							$select2=$val['value']==$val3[id].'-cm'?'selected':'';
							$val['inputhtm'].="<option value='".$val3[id]."-cm' {$select2} class='c2'>".$val3[name]."</option>";
							foreach($met_class3[$val3['id']] as $key=>$val4){
								$select3=$val['value']==$val4[id].'-cm'?'selected':'';
								$val['inputhtm'].="<option value='".$val4[id]."-cm' {$select3} class='c3'>+".$val4[name]."</option>";
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
							$select=$val['value']==$val2[id].'-cm'?'selected':'';
							$val['inputhtm'].="<option value='".$val2[id]."-cm' {$select} class='c1'>==".$val2[name]."==</option>";
							foreach($met_class2[$val2['id']] as $key=>$val3){
								//if(!$val3[if_in]){
									$select2=$val['value']==$val3[id].'-cm'?'selected':'';
									$val['inputhtm'].="<option value='".$val3[id]."-cm' {$select2} class='c2'>".$val3[name]."</option>";
									foreach($met_class3[$val3['id']] as $key=>$val4){
										$select3=$val['value']==$val4[id].'-cm'?'selected':'';
										$val['inputhtm'].="<option value='".$val4[id]."-cm' {$select3} class='c3'>+".$val4[name]."</option>";
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

	/*配置文件保存*/
	function tminisave($inc){
		global $_M;
		$langtext=$this->tminiget('all');
		foreach($langtext as $key=>$val){
			$namelist=$val[name]."_metinfo";
			$namemetinfo=$inc[$namelist];
			if($val['value'] != $namemetinfo && $val['type'] != 1){
				$namemetinfo = mysqlcheck($namemetinfo);
				$query = "UPDATE {$_M['table']['templates']} SET value='{$namemetinfo}' WHERE no='{$this->no}' AND name='{$val[name]}' AND lang='{$this->lang}'";
				DB::query($query);
			}
		}
	}

}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>
