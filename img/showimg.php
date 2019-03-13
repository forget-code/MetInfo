<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.
require_once '../include/common.inc.php';
    $img=$db->get_one("select * from $met_img where id='$id'");
	if(!$img){
	okinfo('../',$lang_error);
	}
	$img[content]=contentshow($img[content]);
	$img[updatetime] = date($met_contenttime,strtotime($img[updatetime]));
	$img[imgurls]=($img[imgurls]<>"")?$img[imgurls]:'../public/images/metinfo.gif';
	$img[imgurl]=($img[imgurl]<>"")?$img[imgurl]:'../public/images/metinfo.gif';
    $class1=$img[class1];
	$class2=$img[class2];
    $class3=$img[class3];	
    $metaccess=$img[access];
require_once '../include/head.php';
    $class1_info=$class_list[$class1][releclass]?$class_list[$class_list[$class1][releclass]]:$class_list[$class1];
	$class2_info=$class_list[$class1][releclass]?$class_list[$class1]:$class_list[$class2];
	$class3_info=$class_list[$class3];
	//if($dataoptimize[5][para][5]){
	  $query1 = "select * from $met_plist where module='5' and listid='$id'";
      $result1 = $db->query($query1);
      while($list1 = $db->fetch_array($result1)){
      $nowpara1="para".$list1[paraid];
	  $img[$nowpara1]=$list1[info];
	  $metparaaccess=$metpara[$list1[paraid]][access];
	  if(intval($metparaaccess)>0&&$met_member_use){
	  $paracode=authcode($img[$nowpara1], 'ENCODE', $met_memberforce);
	  $paracode=codetra($paracode,1); 
	  $img[$nowpara1]="<script language='javascript' src='../include/access.php?metuser=para&metaccess=".$metparaaccess."&lang=".$lang."&listinfo=".$paracode."&paratype=".$metpara[$list1[paraid]][type]."'></script>";
	  }
      $nowparaname="";
	  $nowparaname=$nowpara1."name";
	  $img[$nowparaname]=($list1[imgname]<>"")?$list1[imgname]:$metpara[$list1[paraid]][name];
      }
	  //}
if($dataoptimize[$pagemark][nextlist]){
if($met_member_use==2){
    $preimg=$db->get_one("select $listitem[img] from $met_img where  class1=$class1 and class2=$class2 and class3=$class3 and lang='$lang' and (access<=$metinfo_member_type) and (id > $id) limit 0,1");
    $nextimg=$db->get_one("select $listitem[img] from $met_img where class1=$class1 and class2=$class2 and class3=$class3 and lang='$lang' and (access<=$metinfo_member_type) and (id < $id) order by id desc limit 0,1");
}else{
    $preimg=$db->get_one("select $listitem[img] from $met_img where  class1=$class1 and class2=$class2 and class3=$class3 and lang='$lang' and (id > $id) limit 0,1");
    $nextimg=$db->get_one("select $listitem[img] from $met_img where class1=$class1 and class2=$class2 and class3=$class3 and lang='$lang' and (id < $id) order by id desc limit 0,1");
}
}
if($dataoptimize[5][otherlist]){	
	$serch_sql=" where lang='$lang' and  class1=$class1 ";
	if($class2)$serch_sql .= " and class2=$class2";
	if($class3)$serch_sql .= " and class3=$class3"; 
	if($met_member_use==2)$serch_sql .= " and access<=$metinfo_member_type";
	$order_sql=$class3?list_order($class_list[$class3][list_order]):($class2?list_order($class_list[$class2][list_order]):list_order($class_list[$class1][list_order]));
    $query = "SELECT $listitem[img] FROM $met_img $serch_sql $order_sql LIMIT 0, $met_img_list";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	if($dataoptimize[$pagemark][classname]){
    $list[class1_name]=$class_list[$list[class1]][name];
	$list[class1_url]=$class_list[$list[class1]][url];
	$list[class2_name]=$list[class2]?$class_list[$list[class2]][name]:$list[class1_name];
	$list[class2_url]=$list[class2]?$class_list[$list[class2]][url]:$list[class1_url];
	$list[class3_name]=$list[class3]?$class_list[$list[class3]][name]:($list[class2]?$class_list[$list[class2]][name]:$list[class1_name]);
	$list[class3_url]=$list[class3]?$class_list[$list[class3]][url]:($list[class2]?$class_list[$list[class2]][url]:$list[class1_url]);
	$list[classname]=$class2?$list[class3_name]:$list[class2_name];
	$list[classurl]=$class2?$list[class3_url]:$list[class2_url];
	}
	$list[top]=$list[top_ok]?"<img class='listtop' src='".$img_url."top.gif"."' />":"";
	$list[hot]=$list[top_ok]?"":(($list[hits]>=$met_hot)?"<img class='listhot' src='".$img_url."hot.gif"."' />":"");
	$list[news]=$list[top_ok]?"":((((strtotime($m_now_date)-strtotime($list[updatetime]))/86400)<$met_newsdays)?"<img class='listnews' src='".$img_url."news.gif"."' />":"");
	$list[updatetime] = date($met_listtime,strtotime($list[updatetime]));
	$list[imgurls]=($list[imgurls]<>"")?$list[imgurls]:'../public/images/metinfo.gif';
	$list[imgurl]=($list[imgurl]<>"")?$list[imgurl]:'../public/images/metinfo.gif';
	if($dataoptimize[5][para][5]){
	  $query1 = "select * from $met_plist where module='5' and listid='$list[id]'";
      $result1 = $db->query($query1);
      while($list1 = $db->fetch_array($result1)){
      $nowpara1="para".$list1[paraid];
	  $list[$nowpara1]=$list1[info];
	  $metparaaccess=$metpara[$list1[paraid]][access];
	  if(intval($metparaaccess)>0&&$met_member_use){
	  $paracode=authcode($list[$nowpara1], 'ENCODE', $met_memberforce);
	  $paracode=codetra($paracode,1); 
	  $list[$nowpara1]="<script language='javascript' src='../include/access.php?metuser=para&metaccess=".$metparaaccess."&lang=".$lang."&listinfo=".$paracode."&paratype=".$metpara[$list1[paraid]][type]."'></script>";
	  }
      $nowparaname="";
	  $nowparaname=$nowpara1."name";
	  $list[$nowparaname]=($list1[imgname]<>"")?$list1[imgname]:$metpara[$list1[paraid]][name];
      }
	 }
if($met_webhtm){
	switch($met_htmpagename){
    case 0:
	$htmname="showimg".$list[id];	
	break;
	case 1:
	$list[updatetime1] = date('Ymd',strtotime($list[updatetime]));
	$htmname=$list[updatetime1].$list[id];	
	break;
	case 2:
	$htmname=$class_list[$list[class1]][foldername].$list[id];	
	break;
	}
    $htmname=($list[filename]<>"" and $metadmin[pagename])?$list[filename]."_".$htmname:$htmname;
}	
	$phpname="showimg.php?id=".$list[id];
	$list[url]=$met_webhtm?$htmname.$met_htmtype:$phpname."&lang=".$lang;
	if($preimg[id]==$list[id])$preinfo=$list;  
	if($nextimg[id]==$list[id])$nextinfo=$list;
	if($list[new_ok] == 1){
	$img_list_new[]=$list;
    if($list[class1]!=0)$img_class_new[$list[class1]][]=$list;
	if($list[class2]!=0)$img_class_new[$list[class2]][]=$list;
	if($list[class3]!=0)$img_class_new[$list[class3]][]=$list;
	}
	if($list[com_ok] == 1){
	$img_list_com[]=$list;
	if($list[class1]!=0)$img_class_com[$list[class1]][]=$list;
	if($list[class2]!=0)$img_class_com[$list[class2]][]=$list;
	if($list[class3]!=0)$img_class_com[$list[class3]][]=$list;
	}
	if($list[class1]!=0)$img_class[$list[class1]][]=$list;
	if($list[class2]!=0)$img_class[$list[class2]][]=$list;
	if($list[class3]!=0)$img_class[$list[class3]][]=$list;
    $img_list[]=$list;
  }   
}elseif($dataoptimize[$pagemark][nextlist]){
    switch($met_htmpagename){
    case 0:
	$prehtmname="showimg";	
	$nexthtmname="showimg";
	break;
	case 1:
	$prehtmname = date('Ymd',strtotime($preimg[updatetime]));	
	$nexthtmname = date('Ymd',strtotime($nextimg[updatetime]));
	break;
	case 2:
	$prehtmname=$class_list[$preimg[class1]][foldername];
    $nexthtmname=$class_list[$nextimg[class1]][foldername];		
	break;
	}
	$phpname="showimg.php?".$langmark."&id=";
	if($preimg)$preimg[url]=$met_webhtm?$prehtmname.$preimg[id].$met_htmtype:$phpname.$preimg[id];
    if($nextimg)$nextimg[url]=$met_webhtm?$nexthtmname.$nextimg[id].$met_htmtype:$phpname.$nextimg[id];
	$preinfo=$preimg;
	$nextinfo=$nextimg;
}
$class2=$class_list[$class1][releclass]?$class1:$class2;
$class1=$class_list[$class1][releclass]?$class_list[$class1][releclass]:$class1;
     $show[description]=$img[description]?$img[description]:$met_keywords;
     $show[keywords]=$img[keywords]?$img[keywords]:$met_keywords;
	 $met_title=$img[title]."--".$met_title;
     require_once '../public/php/methtml.inc.php';
	 require_once '../public/php/imghtml.inc.php';
     $nav_x[name]=$nav_x[name]." > ".$img[title];
include template('showimg');
footer();
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>