<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.
require_once '../include/common.inc.php';
    $download=$db->get_one("select * from $met_download where id='$id'");
	if(!$download){
	okinfo('../',$lang_error);
	}
	$download[content]=contentshow($download[content]);
	$download[updatetime] = date($met_contenttime,strtotime($download[updatetime]));
    $class1=$download[class1];
	$class2=$download[class2];
    $class3=$download[class3];	
    $metaccess=$download[access];
	if(intval($download[downloadaccess])>0&&$met_member_use){
	$download[downloadurl]="down.php?id=$download[id]&lang=$lang";
	}
require_once '../include/head.php';
    $class1_info=$class_list[$class1][releclass]?$class_list[$class_list[$class1][releclass]]:$class_list[$class1];
	$class2_info=$class_list[$class1][releclass]?$class_list[$class1]:$class_list[$class2];
	$class3_info=$class_list[$class3];
 //if($dataoptimize[4][para][4]){
	  $query1 = "select * from $met_plist where module='4' and listid='$id'";
      $result1 = $db->query($query1);
      while($list1 = $db->fetch_array($result1)){
      $nowpara1="para".$list1[paraid];
	  $download[$nowpara1]=$list1[info];
	  $metparaaccess=$metpara[$list1[paraid]][access];
	  if(intval($metparaaccess)>0&&$met_member_use){
	  if($metpara[$list1[paraid]][type]==5){
	  $download[$nowpara1]="down.php?paraid=$list1[paraid]&lang=$lang&type=para&id=$id&listid=$list1[id]";
	  }else{
	  $paracode=authcode($download[$nowpara1], 'ENCODE', $met_memberforce);
	  $paracode=codetra($paracode,1); 
	  $download[$nowpara1]="<script language='javascript' src='../include/access.php?metuser=para&metaccess=".$metparaaccess."&lang=".$lang."&listinfo=".$paracode."&paratype=".$metpara[$list1[paraid]][type]."'></script>";
	  }
	  }
      $nowparaname="";
	  $nowparaname=$nowpara1."name";
	  $download[$nowparaname]=($list1[imgname]<>"")?$list1[imgname]:$metpara[$list1[paraid]][name];
      }
	 //} 
if($dataoptimize[$pagemark][nextlist]){
if($met_member_use==2){
    $predownload=$db->get_one("select $listitem[download] from $met_download where  class1=$class1 and class2=$class2 and class3=$class3 and lang='$lang' and (access<=$metinfo_member_type) and (id > $id) limit 0,1");
    $nextdownload=$db->get_one("select $listitem[download] from $met_download where class1=$class1 and class2=$class2 and class3=$class3 and lang='$lang' and (access<=$metinfo_member_type) and (id < $id) order by id desc limit 0,1");
}else{
    $predownload=$db->get_one("select $listitem[download] from $met_download where  class1=$class1 and class2=$class2 and class3=$class3 and lang='$lang' and (id > $id) limit 0,1");
    $nextdownload=$db->get_one("select $listitem[download] from $met_download where class1=$class1 and class2=$class2 and class3=$class3 and lang='$lang' and (id < $id) order by id desc limit 0,1");
}
}
if($dataoptimize[4][otherlist]){	
	$serch_sql=" where lang='$lang' and  class1=$class1 ";
	if($class2)$serch_sql .= " and class2=$class2";
	if($class3)$serch_sql .= " and class3=$class3"; 
	if($met_member_use==2)$serch_sql .= " and access<=$metinfo_member_type";
	$order_sql=$class3?list_order($class_list[$class3][list_order]):($class2?list_order($class_list[$class2][list_order]):list_order($class_list[$class1][list_order]));
    $query = "SELECT $listitem[download] FROM $met_download $serch_sql $order_sql LIMIT 0, $met_download_list";
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
	if(intval($list[downloadaccess])>0&&$met_member_use){
	$list[downloadurl]="down.php?id=$list[id]&lang=$lang";
	}
	if($dataoptimize[4][para][4]){
	  $query1 = "select * from $met_plist where module='4' and listid='$list[id]'";
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
	$htmname="showdownload".$list[id];	
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
	$phpname="showdownload.php?id=".$list[id];
	$list[url]=$met_webhtm?$htmname.$met_htmtype:$phpname."&lang=".$lang;
	if($predownload[id]==$list[id])$preinfo=$list;  
	if($nextdownload[id]==$list[id])$nextinfo=$list;
	if($list[new_ok] == 1){
	$download_list_new[]=$list;
    if($list[class1]!=0)$download_class_new[$list[class1]][]=$list;
	if($list[class2]!=0)$download_class_new[$list[class2]][]=$list;
	if($list[class3]!=0)$download_class_new[$list[class3]][]=$list;
	}
	if($list[com_ok] == 1){
	$download_list_com[]=$list;
	if($list[class1]!=0)$download_class_com[$list[class1]][]=$list;
	if($list[class2]!=0)$download_class_com[$list[class2]][]=$list;
	if($list[class3]!=0)$download_class_com[$list[class3]][]=$list;
	}
	if($list[class1]!=0)$download_class[$list[class1]][]=$list;
	if($list[class2]!=0)$download_class[$list[class2]][]=$list;
	if($list[class3]!=0)$download_class[$list[class3]][]=$list;
    $download_list[]=$list;
  }   
}elseif($dataoptimize[$pagemark][nextlist]){
    switch($met_htmpagename){
    case 0:
	$prehtmname="showdownload";	
	$nexthtmname="showdownload";
	break;
	case 1:
	$prehtmname = date('Ymd',strtotime($predownload[updatetime]));	
	$nexthtmname = date('Ymd',strtotime($nextdownload[updatetime]));
	break;
	case 2:
	$prehtmname=$class_list[$predownload[class1]][foldername];
    $nexthtmname=$class_list[$nextdownload[class1]][foldername];		
	break;
	}
	$phpname="showdownload.php?".$langmark."&id=";
	if($predownload)$predownload[url]=$met_webhtm?$prehtmname.$predownload[id].$met_htmtype:$phpname.$predownload[id];
    if($nextdownload)$nextdownload[url]=$met_webhtm?$nexthtmname.$nextdownload[id].$met_htmtype:$phpname.$nextdownload[id];
	$preinfo=$predownload;
	$nextinfo=$nextdownload;
}
$class2=$class_list[$class1][releclass]?$class1:$class2;
$class1=$class_list[$class1][releclass]?$class_list[$class1][releclass]:$class1;
     $show[description]=$download[description]?$download[description]:$met_keywords;
     $show[keywords]=$download[keywords]?$download[keywords]:$met_keywords;
	 $met_title=$download[title]."--".$met_title;
     require_once '../public/php/methtml.inc.php';
	 require_once '../public/php/downloadhtml.inc.php';
     $nav_x[name]=$nav_x[name]." > ".$download[title];
include template('showdownload');
footer();
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>