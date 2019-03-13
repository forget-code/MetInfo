<?php
# 文件名称:showproduct.php 2009-08-18 08:53:03
# MetInfo企业网站管理系统 
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.
require_once '../include/common.inc.php';

    $product=$db->get_one("select * from $met_product where id='$id'");
	if(!$product){
	okinfo('../',$lang_error);
	};
	$product[c_content]=contentshow($product[c_content]);
	$product[e_content]=contentshow($product[e_content]);
	$product[o_content]=contentshow($product[o_content]);
	$product[title]=($lang=="en")?$product[e_title]:(($lang=="other")?$product[o_title]:$product[c_title]);
	$product[keywords]=($lang=="en")?$product[e_keywords]:(($lang=="other")?$product[o_keywords]:$product[c_keywords]);
	$product[description]=($lang=="en")?$product[e_description]:(($lang=="other")?$product[o_description]:$product[c_description]);
	$product[content]=($lang=="en")?$product[e_content]:(($lang=="other")?$product[o_content]:$product[c_content]);
	$product[updatetime] = date($met_contenttime,strtotime($product[updatetime]));
	$product[imgurls]=($product[imgurls]<>"")?$product[imgurls]:'../public/images/metinfo.gif';
	$product[imgurl]=($product[imgurl]<>"")?$product[imgurl]:'../public/images/metinfo.gif';
    $class1=$product[class1];
	$class2=$product[class2];
    $class3=$product[class3];	
    $metaccess=$product[access];
require_once '../include/head.php';
    $class1_info=$class_list[$class1];
	$class2_info=$class_list[$class2];
	$class3_info=$class_list[$class3];
	if(!class1_info){
	okinfo('../',$lang_error);
	};

for($j=1;$j<=24;$j++){
	$c_para="c_para".$j;
	$e_para="e_para".$j;
	$o_para="o_para".$j;
	$para="para".$j;
	$product[$para]=($lang=="en")?$product[$e_para]:(($lang=="other")?$product[$o_para]:$product[$c_para]);
	$metparaaccess=$met_para[3][$para][access];
	if(intval($metparaaccess)>0&&$met_member_use){
	$paracode=authcode($product[$para], 'ENCODE', $met_memberforce);
	$paracode=codetra($paracode,1); 
	$product[$para]="<script language='javascript' src='../include/access.php?metuser=para&metaccess=".$metparaaccess."&lang=".$lang."&listinfo=".$paracode."&paraid=".$j."'></script>";
	  }
}
    $preproduct=$db->get_one("select * from $met_product where class1=$class1 and class2=$class2 and class3=$class3 and (id > $id) limit 0,1");
    $nextproduct=$db->get_one("select * from $met_product where class1=$class1 and class2=$class2 and class3=$class3 and (id < $id) order by id desc limit 0,1");
	$serch_sql=" where class1=$class1 ";
	if($class2)$serch_sql .= " and class2=$class2";
	if($class3)$serch_sql .= " and class3=$class3"; 
	$serch_sql .=($lang=="en")?" and e_title<>'' ":(($lang=="other")?" and o_title<>'' ":" and c_title<>'' ");
	$order_sql=$class3?list_order($class3_info[list_order]):($class2?list_order($class2_info[list_order]):list_order($class1_info[list_order]));
    $query = "SELECT * FROM $met_product $serch_sql $order_sql";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$list[title]=($lang=="en")?$list[e_title]:(($lang=="other")?$list[o_title]:$list[c_title]);
    $list[class1_name]=$class_list[$list[class1]][name];
	$list[class1_url]=$class_list[$list[class1]][url];
	$list[class2_name]=$list[class2]?$class_list[$list[class2]][name]:$list[class1_name];
	$list[class2_url]=$list[class2]?$class_list[$list[class2]][url]:$list[class1_url];
	$list[class3_name]=$list[class3]?$class_list[$list[class3]][name]:($list[class2]?$class_list[$list[class2]][name]:$list[class1_name]);
	$list[class3_url]=$list[class3]?$class_list[$list[class3]][url]:($list[class2]?$class_list[$list[class2]][url]:$list[class1_url]);
	$list[classname]=$class2?$list[class3_name]:$list[class2_name];
	$list[classurl]=$class2?$list[class3_url]:$list[class2_url];
	$list[keywords]=($lang=="en")?$list[e_keywords]:(($lang=="other")?$list[o_keywords]:$list[c_keywords]);
	$list[description]=($lang=="en")?$list[e_description]:(($lang=="other")?$list[o_description]:$list[c_description]);
	$list[content]=($lang=="en")?$list[e_content]:(($lang=="other")?$list[o_content]:$list[c_content]);
	$list[top]=$list[top_ok]?"<img class='listtop' src='".$img_url."top.gif"."' />":"";
	$list[hot]=$list[top_ok]?"":(($list[hits]>=$met_hot)?"<img class='listhot' src='".$img_url."hot.gif"."' />":"");
	$list[news]=$list[top_ok]?"":((((strtotime($m_now_date)-strtotime($list[updatetime]))/86400)<$met_newsdays)?"<img class='listnews' src='".$img_url."news.gif"."' />":"");
	$list[updatetime] = date($met_listtime,strtotime($list[updatetime]));
	$list[imgurls]=($list[imgurls]<>"")?$list[imgurls]:'../public/images/metinfo.gif';
	$list[imgurl]=($list[imgurl]<>"")?$list[imgurl]:'../public/images/metinfo.gif';
	for($j=1;$j<=24;$j++){
	$c_para="c_para".$j;
	$e_para="e_para".$j;
	$o_para="o_para".$j;
	$para="para".$j;
	$list[$para]=($lang=="en")?$list[$e_para]:(($lang=="other")?$list[$o_para]:$list[$c_para]);
	$metparaaccess=$met_para[3][$para][access];
	if(intval($metparaaccess)>0&&$met_member_use){
	$paracode=authcode($list[$para], 'ENCODE', $met_memberforce);
	$paracode=codetra($paracode,1); 
	$list[$para]="<script language='javascript' src='../include/access.php?metuser=para&metaccess=".$metparaaccess."&lang=".$lang."&listinfo=".$paracode."&paraid=".$j."'></script>";
	  }
	}
	switch($met_htmpagename){
    case 0:
	$htmname="showproduct".$list[id];	
	break;
	case 1:
	$list[updatetime1] = date('Ymd',strtotime($list[updatetime]));
	$htmname=$list[updatetime1].$list[id];	
	break;
	case 2:
	$htmname=$class_list[$list[class1]][foldername].$list[id];	
	break;
	}	
	$phpname="showproduct.php?id=".$list[id];
	$list[c_url]=$met_webhtm?$htmname.$met_c_htmtype:$phpname;
	$list[e_url]=$met_webhtm?$htmname.$met_e_htmtype:$phpname."&lang=en";
	$list[o_url]=$met_webhtm?$htmname.$met_o_htmtype:$phpname."&lang=other";
	$list[url]=($lang=="en")?$list[e_url]:(($lang=="other")?$list[o_url]:$list[c_url]);
	if($preproduct[id]==$list[id])$preinfo=$list;  
	if($nextproduct[id]==$list[id])$nextinfo=$list;
	if($list[new_ok] == 1){
	$product_list_new[]=$list;
    if($list[class1]!=0)$product_class_new[$list[class1]][]=$list;
	if($list[class2]!=0)$product_class_new[$list[class2]][]=$list;
	if($list[class3]!=0)$product_class_new[$list[class3]][]=$list;
	}
	if($list[com_ok] == 1){
	$product_list_com[]=$list;
	if($list[class1]!=0)$product_class_com[$list[class1]][]=$list;
	if($list[class2]!=0)$product_class_com[$list[class2]][]=$list;
	if($list[class3]!=0)$product_class_com[$list[class3]][]=$list;
	}
	if($list[class1]!=0)$product_class[$list[class1]][]=$list;
	if($list[class2]!=0)$product_class[$list[class2]][]=$list;
	if($list[class3]!=0)$product_class[$list[class3]][]=$list;
    $product_list[]=$list;
    }
     $show[description]=$product[description]?$product[description]:$met_keywords;
     $show[keywords]=$product[keywords]?$product[keywords]:$met_keywords;
	 $met_title=$product[title]."--".$met_title;
     require_once '../public/php/methtml.inc.php';
	 require_once '../public/php/producthtml.inc.php';
     $nav_x[name]=$nav_x[name]." > ".$product[title];
if(file_exists("templates/".$met_skin_user."/e_showproduct.html")){
   if($lang=="en"){
     $show[e_description]=$product[e_description]?$product[e_description]:$met_e_keywords;
     $show[e_keywords]=$product[e_keywords]?$product[e_keywords]:$met_e_keywords;
     $e_title_keywords=$product[e_title]."--".$met_e_webname;
	 $nav_x[e_name]=$nav_x[e_name]." > ".$product[e_title];
     include template('e_showproduct');
	}else{
	 $show[c_description]=$product[c_description]?$product[c_description]:$met_c_keywords;
     $show[c_keywords]=$product[c_keywords]?$product[c_keywords]:$met_c_keywords;
     $c_title_keywords=$product[c_title]."--".$met_c_webname;
	 $nav_x[c_name]=$nav_x[c_name]." > ".$product[c_title];
	 include template('showproduct');
	 }
}else{
include template('showproduct');
}
footer();
# 本程序是一个开源系统,使用时请你仔细阅读使用协议,商业用途请自觉购买商业授权.
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.
?>