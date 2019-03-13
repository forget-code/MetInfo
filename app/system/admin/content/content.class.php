<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');

load::sys_class('admin.class.php');

class content extends admin {
	public $iniclass;
	function __construct() {
		global $_M;
		parent::__construct();
	}
	
	function doadd() {
		global $_M;
		
		require $this->template('tem/add');
		
	}
	
	function cexplode($str,$i){
		$class = explode("-",$str) ;
		return $class[$i]; 
	}
		
	function doaddsubmit(){
		global $_M;
		
		
		$class1 = $this->cexplode($_M['form']['add_class1'],0);
		$class2 = $this->cexplode($_M['form']['add_class2'],0);
		$class3 = $this->cexplode($_M['form']['add_class3'],0);
		$urlx = "&class1={$class1}&class2={$class2}&class3={$class3}";
		
		$classnow = 'add_class1';
		$classnow = $class2?'add_class2':$classnow;
		$classnow = $class3?'add_class3':$classnow;
		$module = $this->cexplode($_M['form'][$classnow],1);
		$releclass = $this->cexplode($_M['form']['add_class2'],2);
		//$releclass = $classnow==3?$this->cexplode($_M['form']['add_class2'],2):$releclass;
		
		$urlx = $releclass?"&class1={$class2}&class2={$class3}&class3=":$urlx;
		
		switch($module){
			case 2:
				$url = "{$_M[url][site_admin]}index.php?lang={$_M[lang]}&anyid=29&n=content&c=article_admin&a=doadd{$urlx}";
			break;
			case 3:
				$url = "{$_M[url][site_admin]}index.php?lang={$_M[lang]}&anyid=29&n=content&c=product_admin&a=doadd{$urlx}";
			break;
			case 4:
				$url = "{$_M[url][site_admin]}content/download/content.php?lang={$_M[lang]}&anyid=29&action=add{$urlx}";
			break;
			case 5:
				$url = "{$_M[url][site_admin]}content/img/content.php?lang={$_M[lang]}&anyid=29&action=add{$urlx}";
			break;
			case 6:
				$url = "{$_M[url][site_admin]}content/job/content.php?lang={$_M[lang]}&anyid=29&action=add{$urlx}";
			break;
		}
		echo $url;
		//die;
		//$addurl=urlencode($url);
		//turnover("{$_M[url][own_form]}a=doadd&addurl={$addurl}", '');
	}
	
	function docolumnjson(){
		global $_M;
		$array = column_sorting(2);
		$metinfo = array();
		$i=0;
		$metinfo['citylist'][$i]['p']['name']=$_M['word']['please_select'];//['name']
		$metinfo['citylist'][$i]['p']['value']='';
		foreach($array['class1'] as $key=>$val){ //一级级栏目
			if(count($array['class2'][$val[id]])){ 
				foreach($array['class2'][$val[id]] as $key=>$val6){
					if($val6[module] > 1 && $val6[module] < 7 ){
						$val['cok'] = 1;
					}
				}
			}
			if(($val[module] > 1 && $val[module] < 7 )||$val['cok']){
				$i++;
				$metinfo['citylist'][$i]['p']['name']=$val[name];
				$metinfo['citylist'][$i]['p']['value']=$val[id].'-'.$val[module].'-'.$val[releclass];
				
				if(count($array['class2'][$val[id]])){ //二级栏目
					$k=0;
					foreach($array['class2'][$val[id]] as $key=>$val2){
						if($val2[module] > 1 && $val2[module] < 7 ){
							$metinfo['citylist'][$i]['c'][$k]['n']['name']=$val2[name];
							$metinfo['citylist'][$i]['c'][$k]['n']['value']=$val2[id].'-'.$val2[module].'-'.$val2[releclass];
							
							if(count($array['class3'][$val2[id]])){ //三级栏目
								$j=0;
								foreach($array['class3'][$val2[id]] as $key=>$val3){
									if($val3[module] != 0) {
										$metinfo['citylist'][$i]['c'][$k]['a'][$j]['s']['name']=$val3[name];
										$metinfo['citylist'][$i]['c'][$k]['a'][$j]['s']['value']=$val3[id].'-'.$val3[module].'-'.$val3[releclass];
										$j++;
									}
								}
							}
							$k++;
						}
					}
				}
			}
		}
		echo json_encode($metinfo);
	}
	
}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>