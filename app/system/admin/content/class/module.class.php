<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.

defined('IN_MET') or exit('No permission');

load::sys_class('admin.class.php');

class module extends admin {
	public $met_column;
	public $module;
	/*数据表*/
	public function tablename($module){
		global $_M;
		switch($module){
			case 2:
				$tablename = $_M['table']['news'];
			break;
			case 3:
				$tablename = $_M['table']['product'];
			break;
		}
		return $tablename;
	}
	/*提取描述文字*/
	public function description($content){
		global $_M;
		$desc = strip_tags($content);
		$desc = str_replace("\n", '', $desc);
		$desc = str_replace("\r", '', $desc);
		$desc = str_replace("\t", '', $desc);
		$desc = mb_substr($desc,0,200,'utf-8');
		return $desc;
	}
	/*静态页面名称验证*/

	public function check_filename($filename,$id,$module){
		global $_M;
		if($filename!=''){
			if(!preg_match("/^[a-zA-Z0-9_^\x80-\xff]+$/",$filename)){
				$this->errorno = 'error_filename_cha';
				return false;
			}
			$query = "SELECT * FROM {$this->tablename($module)} WHERE filename='{$filename}' and lang='{$_M['lang']}'";
			$list = DB::get_one($query);
			if($list&&$list['id']!=$id){
				$this->errorno = 'error_filename_exist';
				return false;
			}
		}
		return true;
	}
	/*信息列表URL*/
	public function url($p,$module){
		global $_M;
		$met_class = $this->column(2,$module);
		$classnow = $p['class3']?$p['class3']:($p['class2']?$p['class2']:$p['class1']);
		$url = "{$_M['url']['site']}{$met_class[$classnow]['foldername']}/";
		switch($module){
			case 2:
				$url.= "shownews.php?lang={$_M['lang']}&id={$p['id']}";
			break;
			case 3:
				$url.= "showproduct.php?lang={$_M['lang']}&id={$p['id']}";
			break;
		}
		return $url;
	}
	/*列表页面排序*/
	function list_order($type,$table){
		$ps = $table?$table.'.':'';
		switch($type){
			case '0':$list_order="{$ps}top_ok desc,{$ps}no_order desc,{$ps}updatetime desc";break;
			case '1':$list_order="{$ps}top_ok desc,{$ps}no_order desc,{$ps}updatetime desc";break;
			case '2':$list_order="{$ps}top_ok desc,{$ps}no_order desc,{$ps}addtime desc";break;
			case '3':$list_order="{$ps}top_ok desc,{$ps}no_order desc,{$ps}hits desc";break;
			case '4':$list_order="{$ps}top_ok desc,{$ps}no_order desc,{$ps}id desc";break;
			case '5':$list_order="{$ps}top_ok desc,{$ps}no_order desc,{$ps}id";break;
			default :$list_order="{$ps}top_ok desc,{$ps}no_order desc,{$ps}updatetime desc";break;
		}
		return $list_order;
	}
	/*获取栏目*/
	function column($type = 1,$module){

		if(!$this->met_column){
			$this->met_column = column_sorting(1);
		}
		if($type==1){
			if($module){
				return $this->met_column[$module];
			}
			return $this->met_column;
		}
		if($type==2){
			$met_class = array();
			foreach($this->met_column[$module]['class1'] as $val){
				$met_class[$val['id']] = $val;
			}
			foreach($this->met_column[$module]['class2'] as $val){
				$met_class[$val['id']] = $val;
			}
			foreach($this->met_column[$module]['class3'] as $val){
				$met_class[$val['id']] = $val;
			}
			return $met_class;
		}
		if($type==3){ //理顺被关联的栏目
			$array = column_sorting(2);
			$newarray = array();
			foreach($array['class1'] as $key=>$val){
				if($val['module']==$module){
					$newarray['class1'][] = $val;
				}
			}
			foreach($array['class2'] as $key=>$val){
				foreach($val as $val2){
					if($val2['module']==$module){
						if($val2['releclass']){
							$newarray['class1'][] = $val2;
							if(count($array['class3'][$val2['id']])){
								$newarray['class2'][$val2['id']] = $array['class3'][$val2['id']];
							}
						}else{
							$newarray['class2'][$val2['bigclass']][] = $val2;
						}
					}
				}
			}
			$newarray['class3'] = $array['class3'];
			return $newarray;
		}
	}
	/*缩略图生成*/
	public function thumbimg($filePath,$module){
		global $_M;
		$thumb = load::sys_class('thumb', 'new');
		$thumb->list_module($module);
		$ret = $thumb->createthumb($filePath);
		return $ret['path'];
	}
	/*大图水印*/
	public function waterbigimg($filePath){
		global $_M;
		$watermark = load::sys_class('watermark', 'new');
		$watermark->set_system_bigimg();
		$ret = $watermark->create($filePath);
		return $ret['path'];
	}
	/*缩略图水印*/
	public function waterthumbimg($filePath){
		global $_M;
		$watermark = load::sys_class('watermark', 'new');

		$watermark->set_system_thumb();
		$ret = $watermark->create($filePath);
		return $ret['path'];
	}

	/*处理图片*/
	public function form_imglist($list,$module){
		global $_M;
		$imglist = explode("|",$list['imgurl']);
		$imgsizes=explode("|",$list['imgsizes']);//增加图片尺寸变量（新模板框架v2）
		$i=0;
		$list['displayimg'] = '';
		foreach($imglist as $val){

			$i++;
			if($i==1){
				$list['imgurlr'] = str_replace('watermark/', '',$val);

				if($_M['config']['met_thumb_wate'] == 1)
				{
					$list['imgurl'] = $this->waterbigimg($list['imgurlr']);
				}else{
					$list['imgurl'] = $list['imgurlr'];
				}


				if($list['imgurlr']!=str_replace('thumb/', '',$list['imgurl_l']) || $_M['config']['met_thumb_wate'] == 1){

					$list['imgurls'] = $this->thumbimg($list['imgurlr'],$module);
				}else{
					$list['imgurls'] = $list['imgurl_l'];
				}

				$list['imgurls'] = $this->waterthumbimg($list['imgurls']);
				$list['imgsize']=$imgsizes[$i-1];//增加图片尺寸值（新模板框架v2）
			}else{
				if($_M['config']['met_thumb_wate'] == 1)
				{
					$val = $this->waterbigimg(str_replace('watermark/', '',$val));
				}

				$lt = $list['title'].'*'.$val.'*'.$imgsizes[$i-1];//增加图片尺寸值$imgsizes[$i-1]（新模板框架v2）
				$list['displayimg'].= count($imglist)==$i?$lt:$lt.'|';


			}
		}
		if($_M['config']['met_big_wate'] == 1){
			$list['content'] = $this->concentwatermark($list['content']);
			if($list['content1'])$list['content1'] = $this->concentwatermark($list['content1']);
			if($list['content2'])$list['content2'] = $this->concentwatermark($list['content2']);
			if($list['content3'])$list['content3'] = $this->concentwatermark($list['content3']);
			if($list['content4'])$list['content4'] = $this->concentwatermark($list['content4']);
		}

		return $list;
	}

	function concentwatermark($str){
		if(preg_match_all('/<img.*?src=\\\\"(.*?)\\\\".*?>/i', $str, $out)){
			foreach($out[1] as $key=>$val){
				$imgurl             = explode("upload/", $val);
				if($imgurl[1]){
					$list['imgurl_now'] = 'upload/'.$imgurl[1];
					$list['imgurl_original'] = 'upload/'.str_replace('watermark/', '',$imgurl[1]);
					if(file_exists(PATH_WEB.$list['imgurl_original']))$imgurls[] = $list;
				}
			}
			foreach($imgurls as $key=>$val){
				$watermarkurl = str_replace('../', '',$this->waterbigimg($val['imgurl_original']));
				$str = str_replace($val['imgurl_now'], $watermarkurl, $str);
			}
		}
		return $str;
	}

	/*处理所属栏目*/
	public function form_classlist($list){
		global $_M;
		$classlist = explode(",",$list['class']);
		$i=0;
		$list['classother'] = '';
		foreach($classlist as $val){
			if($i==0){
				$cl = explode("-",$val);
				$list['class1'] = $cl[0];
				$list['class2'] = $cl[1];
				$list['class3'] = $cl[2];
			}else{
				$list['classother'].= $val.'-|-';
			}
			$i++;
		}
		if($list['classother'])$list['classother'] = '|-'.$list['classother'];
		$list['classother'] = trim($list['classother'], '-');
		return $list;
	}

	/*栏目下拉菜单*/
	function column_json($module,$type){

		$array = $this->column(3,$module);
		$metinfo = array();
		$i=0;
		if($type){
			$metinfo['citylist'][$i]['p']['name']='选择栏目';
			$metinfo['citylist'][$i]['p']['value']='';
		}else{
			$metinfo['citylist'][$i]['p']='所有栏目';
		}
		foreach($array['class1'] as $key=>$val){ //一级级栏目
			if($val['module']==$module){
				$i++;
				$metinfo['citylist'][$i]['p']['name']=$val[name];
				$metinfo['citylist'][$i]['p']['value']=$val[id];

				if(count($array['class2'][$val[id]])){ //二级栏目
					$metinfo['citylist'][$i]['c'][0]['n']['name']='二级栏目';
					$metinfo['citylist'][$i]['c'][0]['n']['value']=' ';
					$k=1;
					foreach($array['class2'][$val[id]] as $key=>$val2){
						$metinfo['citylist'][$i]['c'][$k]['n']['name']=$val2[name];
						$metinfo['citylist'][$i]['c'][$k]['n']['value']=$val2[id];

						if(count($array['class3'][$val2[id]])){ //三级栏目
							$metinfo['citylist'][$i]['c'][$k]['a'][0]['s']['name']='三级栏目';
							$metinfo['citylist'][$i]['c'][$k]['a'][0]['s']['value']=' ';
							$j=1;
							foreach($array['class3'][$val2[id]] as $key=>$val3){
								$metinfo['citylist'][$i]['c'][$k]['a'][$j]['s']['name']=$val3[name];
								$metinfo['citylist'][$i]['c'][$k]['a'][$j]['s']['value']=$val3[id];
								$j++;
							}
						}
						$k++;

					}
				}
			}
		}
		echo jsonencode($metinfo);
	}
	/*栏目选择*/
	function class_option($module){
		$column = $this->column(3,$module);
		foreach($column['class1'] as $val){
			$re.= "<option value=\"{$val['id']}-0-0\">{$val['name']}</option>";
			foreach($column['class2'][$val[id]] as $val2){
				$re.= "<option value=\"{$val2['bigclass']}-{$val2['id']}-0\"> —— {$val2['name']}</option>";
				foreach($column['class3'][$val2[id]] as $val3){
					$re.= "<option value=\"{$val2['bigclass']}-{$val3['bigclass']}-{$val3['id']}\"> ———— {$val3['name']}</option>";
				}
			}
		}
		$re.= "</select>";
		return $re;
	}
	/*权限选择*/
	public function access_option($name,$value){
		$group = load::sys_class('group', 'new')->get_group_list();
		$re = "<select name=\"{$name}\" data-checked=\"{$value}\">";
		$re.= "<option value=\"0\">不限制</option>";
		foreach($group as $val){
			$re.= "<option value=\"{$val['id']}\">{$val['name']}</option>";
		}
		$re.= "<option value=\"{$val['id']}\">管理员</option>";
		$re.= "</select>";
		return $re;
	}

}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>