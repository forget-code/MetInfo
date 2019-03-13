<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 
$depth='../';
require_once $depth.'../login/login_check.php';
require_once $depth.'global.func.php';
if($action=="editor"){
	$product_list=$db->get_one("select * from $met_product where id='$id'");
	$product_list['title']=str_replace('"', '&#34;', str_replace("'", '&#39;',$product_list['title']));
	$product_list['ctitle']=str_replace('"', '&#34;', str_replace("'", '&#39;',$product_list['ctitle']));
	if($met_member_use){
		$lev=$met_class[$product_list['class1']][access];
	}
	if(!$product_list)metsave('-1',$lang_dataerror,$depth);
	$query = "select * from $met_plist where module='3' and listid='$id'";
	$result = $db->query($query);
	while($list = $db->fetch_array($result)){
		$nowpara="para".$list[paraid];
		$product_list[$nowpara]=$list[info];
		$nowparaname="";
		if($list[imgname]<>"")$nowparaname=$nowpara."name";$product_list[$nowparaname]=$list[imgname];
	}
	$class1=$product_list[class1];
	if($product_list[new_ok]==1)$new_ok="checked";
	if($product_list[com_ok]==1)$com_ok="checked";
	if($product_list[top_ok]==1)$top_ok="checked";
	if($product_list[wap_ok]==1)$wap_ok="checked";
	$class2[$product_list[class2]]="selected";
	$class3[$product_list[class3]]="selected";
	$displaylist='';
	if($product_list['displayimg']!=''){
		$displayimg=explode('|',$product_list['displayimg']);
		for($i=0;$i<count($displayimg);$i++){
			$newdisplay=explode('*',$displayimg[$i]);
			$displaylist[$i]['name']=$newdisplay[0];
			$displaylist[$i]['imgurl']=$newdisplay[1];
		}
	}
	$class2x[$product_list[class2]]="selected='selected'";
	$class3x[$product_list[class3]]="selected='selected'";	
}else{
	$class2x[$class2]="selected='selected'";
	$class3x[$class3]="selected='selected'";
	$product_list[class2]=$class2;
	$product_list[issue]=$metinfo_admin_name;
	$product_list[hits]=0;
	$product_list[no_order]=0;
	$product_list[addtime]=$m_now_date;
	$product_list[access]="0";
	$lang_editinfo=$lang_addinfo;
	$lev=$met_class[$class1][access];
}
	$product_list[contentinfo]=$lang_contentinfo;
	$product_list[contentinfo1]=$lang_contentinfo1;
	$product_list[contentinfo2]=$lang_contentinfo2;
	$product_list[contentinfo3]=$lang_contentinfo3;
	$product_list[contentinfo4]=$lang_contentinfo4;
	$list_access['access']=$product_list['access'];
	require '../access.php';
$listjs=listjs();
$para_list=para_list_with($product_list);
$imgnum=$displaylist?count($displaylist):0;
$css_url=$depth."../templates/".$met_skin."/css";
$img_url=$depth."../templates/".$met_skin."/images";
include template('content/product/content');
footer();
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>