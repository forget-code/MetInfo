<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.

defined('IN_MET') or exit('No permission');

load::sys_class('handle');

/**
 * 栏目信息处理
 */

class column_handle extends handle {

  /**
	 * 处理栏目数组
	 * @param  string  $module 模块标识
	 * @return string          模块名称
	 */
     public function __construct() {
     	global $_M;
        $this->column=load::mod_class('column/class/column_database','new');
     }
  /**
   * 处理栏目数组
   * @param  array  $column 栏目数组
   * @return array           处理过后的栏目数组
   */
  public function para_handle($column){
  	global $_M;
  	$return = array();
  	foreach($column as $key=>$val) {
  		$this->cache_column[$val['id']] = $val;
  	}

  	foreach($column as $key=>$val){
  		$val['sub'] = 0;
  		$return[$val['id']] = $this->one_para_handle($val);
  	}

  	//处理栏目是否有下级
  	foreach($return as $key=>$val){
  		if($val['bigclass']){
  			$return[$val['bigclass']]['sub'] = 1;
  		}
  	}
  	return $return;
  }

  /**
   * 处理栏目数组
   * @param  array  $content  单个栏目数据
   * @return array            处理过后的栏目数组
   */
  public function one_para_handle($content){
    global $_M;
    $content['url'] = $this->get_content_url($content);
    if($content['indeximg'])$content['indeximg']  = $this->url_transform($content['indeximg']);
    if($content['columnimg']){
        $content['columnimg'] = $this->url_transform($content['columnimg']);
    }else{
        $content['columnimg'] = $_M['url']['site'].$_M['config']['met_agents_img'];
    }
    if($content['new_windows']){
      $content['target'] = 'target="_blank"';
    }else{
      $content['target'] = '';
    }
    $classtype=$content['classtype'];
    $classid=$content['id'];
    if($content['display']){
     unset($content);
    }
    $content['classtype']=$classtype;
    $content['id']=$classid;
    $content['content'] = contentshow($content['content']);
  	return $content;
  }

  /**
   * 获取url
   * @param  array  $content  单个栏目数据
   * @return array            处理过后的栏目数组
   */
  public function get_content_url($content) {
    global $_M;
    if($content['out_url']){
      return $content['out_url'];
    }else{
      if($_M['config']['met_index_type'] == $content['lang'] && ($content['classtype'] == 1 || $content['releclass'] || $content['samefile'])){
        return $this->url_transform($content['foldername'].'/');
      }else{
        return $this->url_full($content);
      }
    }
  }

  /**
   * 处理栏目数组
   * @param  array  $content  单个栏目数据
   * @return array            处理过后的栏目数组
   */
  public function url_full($content, $type = '') {
  	global $_M;
    // if($content['isshow'] == 0 && $content['module'] == 1){
    //   return $this->url_full($content);
    // }
    $type = $this->url_type($type, 1);
    if($type == 2){
      return $this->url_pseudo($content);
    }else if($type == 3){
      return $this->url_static($content);
    }else{
      return $this->url_dynamic($content);
    }

  }

  public function get_no_releclass($content) {
    if($content['classtype'] == 1){
      $classnum = 1;
    }
    if($content['classtype'] == 2){
      if($content['releclass']){
        $classnum = 1;
      }else{
        $classnum = 2;
      }
    }
    if($content['classtype'] == 3){
      $bigclass = $this->cache_column[$content['bigclass']];
      if($bigclass['releclass']){
        $classnum = 2;
      }else{
        $classnum = 3;
      }
    }
    return $classnum;
  }
  public function url_dynamic($content) {
    global $_M;
    if($content['module']>=2 && $content['module']<=5){
      $classnum = $this->get_no_releclass($content);
      $url = '?class'.$classnum.'='.$content['id'];
    }else{
      if($content['module'] == 1 || $content['module'] == 8){
        $url = '?id='.$content['id'];
      }else{
        $url = '';
      }
    }
    if($_M['config']['met_index_type'] != $content['lang']){
      $url .= '&lang='.$content['lang'];
    }
    $url = $this->url_transform($content['foldername'].'/'.$this->mod_to_name($content['module']).'.php'.$url);
    $url = str_replace('.php&', '.php?', $url);
    return $url;
  }

  public function url_static($content) {
    global $_M;
    if($content['filename']){
      if($content['module'] == 1){
        $url .= $content['filename'];
      }else{
        $url .= $content['filename'].'_1';
      }
    }else{
      $classnum = $this->get_no_releclass($content);
      if($content['module']>=2 && $content['module']<=6){
        if($classnum != 1 || $_M['config']['met_index_type'] != $content['lang']){
          if($_M['config']['met_htmlistname']){
            $url .= $content['foldername'];
          }else{
            $url .= $this->mod_to_name($content['module']);
          }
          if($_M['config']['met_htmlistname']){
            $url .= "_{$content['id']}";
          }else{
            if($classnum == 2){
              $url .= "_{$content['bigclass']}_{$content['id']}";
            }else{
              $url .= "_{$this->cache_column[$content['bigclass']]['bigclass']}_{$content['bigclass']}_{$content['id']}";
            }
          }
          $url .= '_1';
        }
      }
      if($content['module'] == 1){
        $classnum = $this->get_no_releclass($content);
        if($classnum == 1){
          $url .= 'index';
        }else{
          $url .= 'about';
          $url .= "{$content['id']}";
        }
      }
    }
    if(!$url)$url .= 'index';
    if($_M['config']['met_index_type'] != $content['lang']){
      $url .= '_'.$content['lang'];
    }
    return $this->url_transform($content['foldername'].'/'.$url.'.'.$_M['config']['met_htmtype']);
  }

  public function url_pseudo($content) {
    global $_M;
    if($content['filename']){
      if ($content['module'] == 1) {
        $url .= $content['filename'];
      } else {
        $url .= 'list-'.$content['filename'];
      }
    }else{
      if($content['module']>=2 && $content['module']<=6){
        $url .= 'list-'.$content['id'];
      }
      if($content['module'] == 1){
        $classnum = $this->get_no_releclass($content);
        if($classnum != 1){
          $url .= $content['id'];
        }
      }
    }
    if(!$url) $url .= 'index';
    if($_M['config']['met_index_type'] != $content['lang']){
      $url .= '-'.$content['lang'];
    }else{
      if($_M['config']['met_defult_lang']){
        $url .= '-'.$content['lang'];
      }
    }
    return $this->url_transform($content['foldername'].'/'.$url.'.html');
  }


}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>
