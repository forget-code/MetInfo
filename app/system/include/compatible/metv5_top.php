<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');

//表单提交
foreach($_M['form'] as $key => $val){
	$k="{$key}";
	$$k=$val;
	
}

//flash兼容
global $methtml_flash,$met_flasharray,$classnow,$met_flashimg,$navurl;

//设置左边和中间内容页面显示的页面
$control['content']=$_M['custom_template']['content'];
$control['left']=$_M['custom_template']['left'];
if(substr($control['content'],0,4)!='own/'){
	$control['content']='own/'.$control['content'];
}
if($control['left'] > 1){
	$is_memberleft = 1;
}
//获取当前应用栏目信息
$PHP_SELF = $_SERVER['PHP_SELF'] ? $_SERVER['PHP_SELF'] : $_SERVER['SCRIPT_NAME'];
$PHP_SELFs = explode('/', $PHP_SELF);
$query = "SELECT * FROM {$_M['table'][column]} where module!=0 and foldername = '{$PHP_SELFs[count($PHP_SELFs)-2]}' and lang='{$_M['lang']}'";
$column = DB::get_one($query);
$met_module =  $column['module'];
if($met_module > 1000){
	//设置SEO参数
	switch($_M['config']['met_title_type']){
		case 0:
			$webtitle = '';
			break;
		case 1:
			$webtitle = $_M['config']['met_keywords'];
			break;
		case 2:
			$webtitle = $_M['config']['met_webname'];
			break;
		case 3:
			$webtitle = $_M['config']['met_keywords'].'-'.$_M['config']['met_webname'];
	}
	$met_title = $webtitle;

	$met_title = $met_title?$column['name'].'-'.$met_title:$column['name'];
	$met_title = $column['ctitle'] ? $column['ctitle'] : $met_title;
	$show['description']=$column['description']?$column['description']:$_M['config']['met_description'];
	$show['keywords']=$column['keywords']?$column['keywords']:$_M['config']['met_keywords'];
		
	$met_module =  $column['module'];

	$classnow = $column['id'];
	$class1 = $column['id'];
	if($column['releclass']){
		$class1 = $column['bigclass'];
	}
}else{
	if(!$class1 && !$class2 && !$class3 && !$metid){
		//$classnow = $column['id'];
		$class1 = $column['id'];
		if($column['releclass']){
			$class1 = $column['bigclass'];
		}		
	}
	
}
//设置网站根
define('ROOTPATH', PATH_WEB);
function is_letf_exists($left){
	global $_M;
	//$left = array('sidebar');
	$file = PATH_TEM.$left;
	if(file_exists($file.'.php')||file_exists($file.'.html')){
		return true;
	}
	return false;
}
//把$_M数组,DB转换成旧系统变量写法
foreach($_M['config'] as $key => $val){
	$$key=$val;
}
foreach($_M['table'] as $key => $val){
	$k="met_{$key}";
	$$k=$val;
}
foreach($_M['word'] as $key => $val){
	$k="lang_{$key}";
	$$k=$val;
}

$lang=$_M['lang'];

$db = new DB();

//global $index_url,$lang_home,$nav_list,$nav_list2,$nav_list3,$navdown,$lang;

//页面模板参数设置
$met_chtmtype=".".$met_htmtype;
$met_htmtype=($lang==$met_index_type)?".".$met_htmtype:"_".$lang.".".$met_htmtype;
$langmark='lang='.$_M['lang'];

$met_langadmin=$_M['langlist']['admin'];

foreach ($_M['langlist']['web'] as $key => $v) {
	$_M['langlist']['web'][$key]['met_weburl'] .= 'index.php?lang='.$v['lang'];
}

$met_langok=$_M['langlist']['web'];

$index_url=$_M['langlist']['web'][$_M['lang']]['met_weburl'];

$m_now_year = date('Y');

$member_index_url="index.php?lang=".$lang;
$member_register_url="register_include.php?lang=".$lang;

//2.0
$index_c_url=$met_index_url[cn];
$index_e_url=$met_index_url[en];
$index_o_url=$met_index_url[other];

//2.0
$searchurl           =$met_weburl."search/search.php?lang=".$lang;
$file_basicname      =PATH_WEB."lang/language_".$lang.".ini";
$file_name           =PATH_WEB."templates/".$met_skin_user."/lang/language_".$lang.".ini";
$str="";
//
//语言数组设置
foreach($met_langok as $key=>$val){
	$indexmark=($val[mark]==$met_index_type)?"index.":"index_".$val[mark].".";
	$val[met_weburl]=$val[met_weburl]<>""?$val[met_weburl]:$met_weburl;
	$val[met_htmtype]=$val[met_htmtype]<>""?$val[met_htmtype]:$met_htmtype;
	if($val[useok]){
		$met_index_url[$val[mark]]=$val[met_webhtm]?$val[met_weburl].$indexmark.$val[met_htmtype]:$val[met_weburl]."index.php?lang=".$val[mark];
		if($val[met_webhtm]==3)$met_index_url[$val['mark']] = $val['met_weburl'].'index-'.$val['mark'].'.html';
		if($htmpack){
			$navurls = $index=='index'?'':'../';
			$met_index_url[$val['mark']]=$navurls.$indexmark.$val['met_htmtype'];
		}
		if($val[mark]==$met_index_type)$met_index_url[$val[mark]]=$val[met_weburl];
		if($htmpack && $val[mark]==$met_index_type){
			$met_index_url[$val[mark]]=$navurls;
		}
		if($val[link]!="")$met_index_url[$val[mark]]=$val[link];
		if(!strstr($val[flag], 'http://')){
			$navurls = $index=='index'?'':'../';
			if($index=="index"&&strstr($val[flag], '../')){
				$met_langlogoarray=explode("../",$val[flag]);
				$val[flag]=$met_langlogoarray[1];
			}
			if(!strstr($val[flag], 'http://')&&!strstr($val[flag], 'public/images/flag/'))$val[flag]=$navurls.'public/images/flag/'.$val[flag];
		}
		$met_langok[$val[mark]]=$val;
	}
}

$tmpincfile=PATH_WEB."templates/{$_M[config][met_skin_user]}/metinfo.inc.php";
require $tmpincfile;
//flash设置数组
$met_flasharray = $_M['flashset'];
$m_now_time     = time();
$m_now_date     = date('Y-m-d H:i:s',$m_now_time);
$m_now_counter  = date('Ymd',$m_now_time);
$m_now_month    = date('Ym',$m_now_time);
$m_now_year     = date('Y',$m_now_time);
//公用数据处理文件与模板标签文件处理
if($met_module && $met_module > 1000){
	require_once PATH_WEB.'include/head.php';
}

//把上面赋值的变量与数组转成全局数组
$vars2=array_keys(get_defined_vars());
$a2=get_defined_vars();
foreach($vars2 as $key => $val){
	global $$val;
	$$val=$a2[$val];
}

if($met_module && $met_module < 1000){
	if(isset($murlid)){
		require_once PATH_WEB.'include/htmlurl.php';
	}
	if($metid){
		global $filpy,$fmodule,$cmodule;
		require PATH_WEB."include/module.php";
	}
	if($met_module == 3){
		if(M_CLASS == 'product_show'){
			$mdname = 'product';
			$showname = 'showproduct';
			$dbname = $met_product;
			$listnum = $met_product_list;
			$imgproduct = 'product';
			require_once PATH_WEB.'/include/global/showmod.php';
			$product = $news;
			$product_list_new  = $md_list_new;
			$product_class_new = $md_class_new;
			$product_list_com  = $md_list_com;
			$product_class_com = $md_class_com;
			$product_class     = $md_class;
			$product_list      = $md_list;
			require_once PATH_WEB.'public/php/producthtml.inc.php';
		}else{
			$mdname = 'product';
			$showname = 'showproduct';
			$dbname = $met_product;
			$dbname_list = $met_product_list;
			$mdmendy = 1;
			$imgproduct = 'product';
			$class1re = '';
			require_once PATH_WEB."include/global/listmod.php";
			$product_listnow = $modlistnow;
			$product_list_new  = $md_list_new;
			$product_class_new = $md_class_new;
			$product_list_com  = $md_list_com;
			$product_class_com = $md_class_com;
			$product_class     = $md_class;
			$product_list      = $md_list;
			require_once PATH_WEB.'public/php/producthtml.inc.php';
		}

	}
}
require_once PATH_WEB."public/php/methtml.inc.php";
if(!function_exists('rgb2hex')){
	require_once PATH_WEB."public/php/waphtml.inc.php";
	function toHex($N) {
		if ($N==NULL) return "00";
		if ($N==0) return "00";
		$N=max(0,$N);
		$N=min($N,255);
		$N=round($N);
		$string = "0123456789ABCDEF";
		$val = (($N-$N%16)/16);
		$s1 = $string{$val};
		$val = ($N%16);
		$s2 = $string{$val};
		return $s1.$s2;
	}

	function rgb2hex($r,$g,$b){
		return toHex($r).toHex($g).toHex($b);
	}

	function hex2rgb($N){
		$dou = str_split($N,2);
		return array(
			"R" => hexdec($dou[0]),
			"G" => hexdec($dou[1]),
			"B" => hexdec($dou[2])
		);
	}
}
//页面内容区块顶部导航处理，左侧导航调用系统时候生效，自定义无效。
if($met_module && $met_module > 1000){
	if($class_list[$classnow]['releclass']){
		$pre_class = $class_list[$classnow]['bigclass'];
		//dump($class_list[$classnow]);
		if($class_list[$pre_class][new_windows] == 0)$class_list[$pre_class][new_windows] = '_self';
		$nav_x[name]="<a href=\"{$class_list[$pre_class][url]}\" target=\"{$class_list[$pre_class][new_windows]}\">{$class_list[$pre_class][name]}</a> > ";
	}

	$nav_x[name].="<a href=\"{$class_list[$classnow][url]}\" target=\"{$class_list[$classnow][new_windows]}\">{$class_list[$classnow][name]}</a>";
}

//把上面赋值的变量与数组转成全局数组
$vars3=array_keys(get_defined_vars());
$a3=get_defined_vars();
foreach($vars3 as $key => $val){
	if(!isset($a2[$val])){
		global $$val;
		$$val=$a3[$val];
	}
}
$met_title = $_M['plugin']['para']['met_title'] ? $_M['plugin']['para']['met_title'] : $met_title;
$show['description'] = $_M['plugin']['para']['met_description'] ? $_M['plugin']['para']['met_description'] : $show['description'];
$show['keywords'] = $_M['plugin']['para']['met_keywords'] ? $_M['plugin']['para']['met_keywords'] : $show['keywords'];
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>