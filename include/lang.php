<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.
require_once 'common.inc.php';
$packurl = 'http://'.$_SERVER['HTTP_HOST'].'/';
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
	$met_langok[$key][met_weburl]=$met_index_url[$val[mark]];
}
//2.0
$index_c_url=$met_index_url[cn];
$index_e_url=$met_index_url[en];
$index_o_url=$met_index_url[other];

//2.0
$searchurl           =$met_weburl."search/search.php?lang=".$lang;
$file_basicname      =ROOTPATH."lang/language_".$lang.".ini";
$file_name           =ROOTPATH."templates/".$met_skin_user."/lang/language_".$lang.".ini";
$str="";
//

if(!file_get_contents(ROOTPATH.'cache/lang_'.$lang.'.php')||!file_get_contents(ROOTPATH.'cache/lang_json_'.$lang.'.php')){
	$query="select * from $met_language where lang='$lang' and site='0' and array!='0'";
	$result= $db->query($query);
	while($listlang= $db->fetch_array($result)){
		$name = 'lang_'.$listlang['name'];
		$$name= trim($listlang['value']);
		$str.='$'."{$name}='".str_replace(array('\\',"'"),array("\\\\","\\'"),trim($listlang['value']))."';";
		$lang_json[$listlang['name']]=$listlang['value'];
	}
	$lang_json['met_weburl'] = $met_langok[$lang][met_weburl];
	$str="<?php\n".$str."\n?>";
	file_put_contents(ROOTPATH.'cache/lang_'.$lang.'.php',$str);
	file_put_contents(ROOTPATH.'cache/lang_json_'.$lang.'.php',json_encode($lang_json));
}else{
	require_once ROOTPATH.'cache/lang_'.$lang.'.php';
}
$query="select * from $met_language where site='0' and lang='$lang'";
$languages=$db->get_all($query);
foreach($languages as $key=>$val){
	$_M[word][$val[name]]=$val[value];
}
$query = "SELECT * FROM {$met_templates} WHERE no='{$met_skin_user}' AND lang='{$lang}' order by no_order ";
$inc = $db->get_all($query);
$tmpincfile=ROOTPATH."templates/{$_M[config][met_skin_user]}/metinfo.inc.php";
if(file_exists($tmpincfile)){	
	$metinfover_content = file_get_contents($tmpincfile);
	if(strstr($metinfover_content, "metinfover")) {
		require $tmpincfile;
	}
}
foreach($inc as $key=>$val){
	$name = 'lang_'.$val['name'];
	if(($val[type]==7||$val[type]==13)&&strstr($val['value'],"../upload/")&&$index=='index'&&($metinfover=='v1' || $metinfover=='v2')){// 增加$metinfover判断值，新增判断条件$val[type]==13（新模板框架v2）
		$val['value']=explode("../",$val['value']);
		$val['value']=$val['value'][1];
	}
	$$name = trim($val['value']);
}
/*模板设置预览*/
if($theme_preview&&$met_theme_preview){
	foreach($php_json['langini'] as $key=>$val){
		if(strstr($val,"../upload/")&&$index=='index'){
			$val=explode("../",$val);
			$val=$val[1];
		}
		$name = 'lang_'.$key;
		$$name= trim($val);
	}
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>
