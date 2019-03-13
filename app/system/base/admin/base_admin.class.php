<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.

defined('IN_MET') or exit('No permission');

load::sys_class('admin.class.php');

class base_admin extends admin {
	public $table;
	public $module;
	public $lang;
	/**
	 * 初始化
	 */

	function __construct() {
		global $_M;
		parent::__construct();
		$this->lang = $_M['lang'];
		$this->module = 0;
		$this->table = '';
	}

	// /**
	//  * 初始化模型编号
	//  * @param  string  $module 模型编号
	//  * @param  string  $table  数据表名称
	//  */
	// function construct($module, $table) {
	// 	$this->module = $module;
	// 	$this->table = $table;
	// }
	//
	// /*数据表*/
	// public function tablename(){
	// 	global $_M;
	// 	switch($this->module){
	// 		case 2:
	// 			$tablename = $_M['table']['news'];
	// 		break;
	// 		case 3:
	// 			$tablename = $_M['table']['product'];
	// 		break;
	// 	}
	// 	return $tablename;
	// }

	/**
	 * 提取描述文字
	 * @param  string  $content    描述文字
	 * @return array               提取后的描述文字
	 */
	public function description($content){
		global $_M;
		$desc = strip_tags($content);
		$desc = str_replace("\n", '', $desc);
		$desc = str_replace("\r", '', $desc);
		$desc = str_replace("\t", '', $desc);
		$desc = mb_substr($desc,0,200,'utf-8');
		return $desc;
	}

	/**
	 * 静态页面名称验证
	 * @param  string  $filename   select的name名称
   * @param  string  $id         选中的权限字段
	 * @return array               配置数组
	 */
	public function check_filename($filename, $id){
		global $_M;
		if($filename!=''){
			if(!preg_match("/^[a-zA-Z0-9_^\x80-\xff]+$/",$filename)){
				$this->errorno = 'error_filename_cha';
				return false;
			}
		}

		if($filename){
			$filenames = $this->database->get_list_by_filename($filename);
			if(count($filenames) > 1 || ($filenames[0]['id'] != $id && $filenames[0]['id']) ){
				$this->errorno = 'error_filename_exist';
				return false;
			}
		}

			// $query = "SELECT * FROM {$this->tablename($this->module)} WHERE filename='{$filename}' and lang='{$_M['lang']}'";
			// $list = DB::get_one($query);

			//if($list&&$list['id']!=$id){
			// if($count >= 1){
			// 	$this->errorno = 'error_filename_exist';
			// 	return false;
			// }
		return true;
	}

	/**
	 * 信息列表URL
	 * @param  string  $p          信息数组
	 * @param  string  $module     模块类型
	 * @return array               url
	 */
	public function url($p, $module){
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
			case 4:
				$url.= "showdownload.php?lang={$_M['lang']}&id={$p['id']}";
			break;
			case 5:
				$url.= "showimg.php?lang={$_M['lang']}&id={$p['id']}";
			break;
		}
		return $url;
	}

	/**
	 * 列表页面排序
	 * @param  string  $type
	 * @param  string  $module     模块
	 * @return array               栏目数组
	 */
	function list_order($type='', $table='') {
		$ps = $table?$table.'.':'';
		switch($type){
			case '0':$list_order="{$ps}top_ok desc,{$ps}com_ok desc,{$ps}no_order desc,{$ps}updatetime desc,id desc";break;
			case '1':$list_order="{$ps}top_ok desc,{$ps}com_ok desc,{$ps}no_order desc,{$ps}updatetime desc,id desc";break;
			case '2':$list_order="{$ps}top_ok desc,{$ps}com_ok desc,{$ps}no_order desc,{$ps}addtime desc,id desc";break;
			case '3':$list_order="{$ps}top_ok desc,{$ps}com_ok desc,{$ps}no_order desc,{$ps}hits desc,id desc";break;
			case '4':$list_order="{$ps}top_ok desc,{$ps}com_ok desc,{$ps}no_order desc,{$ps}id desc";break;
			case '5':$list_order="{$ps}top_ok desc,{$ps}com_ok desc,{$ps}no_order desc,{$ps}id asc";break;
			default :$list_order="{$ps}top_ok desc,{$ps}com_ok desc,{$ps}no_order desc,{$ps}updatetime desc";break;
		}
		return $list_order;
	}

	/**
	 * 获取栏目
	 * @param  string  $type
	 * @param  string  $module     模块
	 * @return array               栏目数组
	 */
	function column($type = 1, $module){

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
         foreach($array['class3'] as $key=>$val){
			           foreach ($val as $key1 => $val3) {
			           	# code...
			           	if(!$val3['releclass']){
				 			$newarray['class3'][$key][$key1] = $val3;
			           }
			        }
		        }
		    }
		return $newarray;
	}

	/**
	 * 缩略图生成
	 * @param  string  $filePath    原图路径
	 * @return array                缩略图路径
	 */
	public function thumbimg($filePath, $module){
		global $_M;
		$thumb = load::sys_class('thumb', 'new');
		$thumb->list_module($module);
		$ret = $thumb->createthumb($filePath);
		return $ret['path'];
	}

	/**
	 * 大图水印
	 * @param  string  $filePath    原图路径
	 * @return array                大图水印路径
	 */
	public function waterbigimg($filePath){
		global $_M;
		$watermark = load::sys_class('watermark', 'new');
		$watermark->set_system_bigimg();
		$ret = $watermark->create($filePath);
		return $ret['path'];
	}

	/**
	 * 缩略图水印
	 * @param  string  $filePath    缩略图路径
	 * @return array                缩略图水印路径
	 */
	public function waterthumbimg($filePath){
		global $_M;
		$watermark = load::sys_class('watermark', 'new');

		$watermark->set_system_thumb();
		$ret = $watermark->create($filePath);
		return $ret['path'];
	}

	/**
	 * 处理图片
	 * @param  string  $list   数据数组
	 * @return array           处理完的图片后的数据数组
	 */
	public function form_imglist($list, $module){
		global $_M;
		$imglist = explode("|",$list['imgurl']);
		$imgsizes=explode("|",$list['imgsizes']);//增加图片尺寸变量（新模板框架v2）
		$i=0;
		$list['displayimg'] = '';
		foreach($imglist as $val){
            if($val!='' || $j==1)$i++;
			if(1){
				$list['imgurlr'] = str_replace('watermark/', '',$val);

                if($_M['config']['met_autothumb_ok'] != 1){
                    $list['imgurl'] = $this->waterbigimg($list['imgurlr']);

                }else{
                	$list['imgurl'] = $list['imgurlr'];
                }

				if($_M['config']['met_big_wate'] == 1 )
				{
					$list['imgurl'] = $this->waterbigimg($list['imgurlr']);
				}else{
					$list['imgurl'] = $list['imgurlr'];
				}
				if($list['imgurlr']!=str_replace('thumb/', '',$list['imgurl_l']) && $_M['config']['met_autothumb_ok'] == 1){

					$list['imgurls'] = $this->thumbimg($list['imgurlr'], $module);
				}else{
					$list['imgurls'] = $list['imgurl_l'];
				}

                if($_M['config']['met_autothumb_ok'] == 1 && $_M['config']['met_thumb_wate'] == 1 ){
                	$list['imgurls'] = $this->waterthumbimg($list['imgurls']);
                }else{
                	$list['imgurls'] = $list['imgurlr'];
                	//$list['imgurl'] = $val;
                }

				if($i==1){
					$j=1;
					if(strstr($val,'../')){
				     $img=explode('/',$imglist[$i]);
                  	 $imglast=$img[count($img)-1];
                  	 $imglist[$i]= str_replace('watermark/', '',$imglist[$i]);
                  	 if($imglist[0]!=''){
                          $imglist[$i]=str_replace('watermark/', '',$imglist[0]);
                            $img=explode('/',$imglist[$i]);
                  	        $imglast=$img[count($img)-1];
                  	 }
                      if($_M['config']['met_autothumb_ok'] == 1 && $_M['config']['met_big_wate']!=1 && $_M['config']['met_thumb_wate']!=1 ){
                            $imgurls= str_replace($imglast,'thumb/'.$imglast,$imglist[$i]);
                            $imgurl =$imglist[$i];
                      }elseif($_M['config']['met_autothumb_ok'] == 1 && $_M['config']['met_thumb_wate']!=1 && $_M['config']['met_big_wate']==1){
                            $imgurls=  str_replace($imglast,'thumb/'.$imglast,$imglist[$i]);
                            $imgurl=   str_replace($imglast,'watermark/'.$imglast,$imglist[$i]);
                      }elseif($_M['config']['met_autothumb_ok'] != 1 && $_M['config']['met_thumb_wate']!=1 && $_M['config']['met_big_wate']!=1){
                      	 $imgurls='';
                      	 $imgurl= $imglist[$i];
                      }elseif($_M['config']['met_autothumb_ok'] != 1  && $_M['config']['met_big_wate']==1){
                            $imgurls= '';
                            $imgurl=  str_replace($imglast,'watermark/'.$imglast,$imglist[$i]);
                      }elseif($_M['config']['met_autothumb_ok'] == 1 && $_M['config']['met_thumb_wate']==1 && $_M['config']['met_big_wate']==1){
                            $imgurls=  str_replace($imglast,'thumb/'.$imglast,$imglist[$i]);
                            $imgurl=  str_replace($imglast,'watermark/'.$imglast,$imglist[$i]);
                      }elseif($_M['config']['met_autothumb_ok'] == 1 && $_M['config']['met_big_wate']!=1 && $_M['config']['met_thumb_wate']==1) {
                      	    $imgurls=  str_replace($imglast,'thumb/'.$imglast,$imglist[$i]);
                      	    $imgurl= $imglist[$i];
                      }else{
                      	    $imgurls= '';
                      	    $imgurl= $imglist[$i];
                      }
                     }else{
                     	 $imgurls= '';
                      	 $imgurl= $val;
                     }

                }
                if(!strstr($val,'../')){//说明是外部图片
                  $list['imgurl']=$val;
                }
				$list['imgsize']=$imgsizes[0];//增加图片尺寸值（新模板框架v2）
				$lt = $list['title'].'*'.$list['imgurl'].'*'.$imgsizes[0];//
				if($i==1){
					 $lt='';
				}
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
        $str=substr($list['displayimg'],'0','1');
        if($str=='|'){
        	 $length=strlen($list['displayimg']);
             $list['displayimg']=substr($list['displayimg'],1,$length);
        }
        // dump($list['displayimg']);
        // exit;
        $list['imgurls']= $imgurls;
        $list['imgurl']= $imgurl;
		return $list;
	}

	/**
	 * 处理内容中的图片
	 * @param  string  $str    内容html
	 * @return array           处理完的图片后的html
	 */
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

	/**
	 * 缩略图水印
	 * @param  string  $module    返回栏目数组
	 * @param  number  $type      默认提示文字类型
	 * @return array              缩略图水印路径
	 */
	function column_json($module='', $type=''){

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

    /**
     * 栏目选择
     * @param $module
     * @param string $choice
     * @return string
     */
    function class_option($module ,$choice = ''){
        $column = $this->column(3,$module);
        /*dump($column);
        die();*/
        foreach($column['class1'] as $val){
            $re.= "<option value=\"{$val['id']}-0-0\">{$val['name']}</option>";
            foreach($column['class2'][$val[id]] as $val2){
                #dump("{$val2['bigclass']}-{$val2['id']}-0");
                $selected = "{$val2['bigclass']}-{$val2['id']}-0" == $choice ? "selected='selected'" : '';
                $re.= "<option value=\"{$val2['bigclass']}-{$val2['id']}-0\" $selected> —— {$val2['name']}</option>";
                foreach($column['class3'][$val2[id]] as $val3){
                    #dump("{$val2['bigclass']}-{$val3['bigclass']}-{$val3['id']}");
                    $selected = "{$val2['bigclass']}-{$val3['bigclass']}-{$val3['id']}" == $choice ? "selected='selected'" : '';
                    $re.= "<option value=\"{$val2['bigclass']}-{$val3['bigclass']}-{$val3['id']}\" $selected> ———— {$val3['name']}</option>";
                }
            }
        }
        $re.= "</select>";
        return $re;
    }

	/**
	 * 保存修改sql
	 * @param  array   $where   条件
	 * @param  array   $order   排序
	 * @return bool  				 	  json数组
	 */
	public function json_list($where, $order){
		global $_M;
		$where = "lang='{$_M['lang']}' and (recycle = '0' or recycle = '-1') {$where}";
		$data = $this->database->table_json_list($where, $order);
		return $data;
	}

	public function json_list1($where, $order){
		global $_M;
		//$where = "lang='{$_M['lang']}' and (recycle = '0' or recycle = '-1') {$where}";
		$data = $this->database->table_json_list($where, $order);
		return $data;
	}

	/**
	 * 返回json数据
	 * @param  array   $data   条件
	 */
	public function json_return($data){
		global $_M;

		$this->database->tabledata->rdata($data);
	}
}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>
