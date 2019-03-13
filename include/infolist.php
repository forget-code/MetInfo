<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 
if($dataoptimize[$pagemark][categoryname]){
	$list[class1_name]=$class_list[$list[class1]][name];
	$list[class1_url]=$class_list[$list[class1]][url];
	$list[class2_name]=$list[class2]?$class_list[$list[class2]][name]:$list[class1_name];
	$list[class2_url]=$list[class2]?$class_list[$list[class2]][url]:$list[class1_url];
	$list[class3_name]=$list[class3]?$class_list[$list[class3]][name]:($list[class2]?$class_list[$list[class2]][name]:$list[class1_name]);
	$list[class3_url]=$list[class3]?$class_list[$list[class3]][url]:($list[class2]?$class_list[$list[class2]][url]:$list[class1_url]);
}
	if($nowlabel=="met_hot"){
	  $list[top]="<img class='listtop' src='".$img_url."top.gif"."' />";
	  $list[hot]="";
	  $list[news]="";
	 }else{
	  $list[top]="";
	  $list[hot]=($list[hits]>=$met_hot)?"<img class='listhot' src='".$img_url."hot.gif"."' />":"";
	  $list[news]=(((strtotime($m_now_date)-strtotime($list[updatetime]))/86400)<$met_newsdays)?"<img class='listnew' src='".$img_url."news.gif"."' />":"";
	}
	$list[imgurls]=($list[imgurls]<>"")?$list[imgurls]:'../public/images/metinfo.gif';
	//$list[imgurl]=($list[imgurl]<>"")?$list[imgurl]:'../public/images/metinfo.gif';
	if($nowpara and $dataoptimize[$pagemark][parameter]){
	  $query1 = "select * from $met_plist where lang='$lang' and listid='$list[id]' and module='$metmodule' ";
      $result1 = $db->query($query1);
      while($list1 = $db->fetch_array($result1)){
      $nowpara1="para".$list1[paraid];
      $list[$nowpara1]=$list1[info];
	  $metparaaccess=$metpara[$list1[paraid]][access];
	  if(intval($metparaaccess)>0&&$met_member_use){
	  $paracode=authcode($list1[$nowpara1], 'ENCODE', $met_memberforce);
	  $paracode=codetra($paracode,1); 
	  $list[$nowpara1]="<script language='javascript' src='".$navurl."include/access.php?metuser=para&metaccess=".$metparaaccess."&lang=".$lang."&listinfo=".$paracode."&paratype=".$metpara[$list1[paraid]][type]."&index=".$index."'></script>";
	  }
      $nowparaname="";
	  $nowparaname=$nowpara1."name";
	  $list[$nowparaname]=($list1[imgname]<>"")?$list1[imgname]:$metpara[$list1[paraid]][name];
	   if($metpara[$list1[paraid]][type]==5&&$index=="index"){
	     $listarray[info]=explode("../",$list1[info]);
         $list[$nowpara1]=$listarray[info][1];
	    }
      }
	 }
	$htmname=($list[filename]<>"" and $metadmin[pagename])?$filename."/".$list[filename]."_".$filenamenow.$list[id]:$filename."/".$filenamenow.$list[id];
	$phpname=$filename."/show".$pagename.".php?".$langmark."&id=".$list[id];	
	$list[url]=$met_webhtm?$htmname.$met_htmtype:$phpname;
if($index=="index"){	
	$listarray[imgurls]=explode("../",$list[imgurls]);
    $list[imgurls]=$listarray[imgurls][1];
	//$listarray[imgurl]=explode("../",$list[imgurl]);
    //$list[imgurl]=$listarray[imgurl][1];
	}
	$list[updatetime] = date($met_listtime,strtotime($list[updatetime]));
	if($nowhits=="metinfo"){
	   if($list[new_ok] == 1 or $list[img_ok] == 1){
	   $hitslistimg[$pagename][]=$list;
	   if($list[class1]!=0)$hitsclasslistnew[$pagename][$list[class1]][]=$list;
	   if($list[class2]!=0)$hitsclasslistnew[$pagename][$list[class2]][]=$list;
	   if($list[class3]!=0)$hitsclasslistnew[$pagename][$list[class3]][]=$list;
	  }
	  if($list[com_ok] == 1){
	   $hitslistcom[$pagename][]=$list;
	   if($list[class1]!=0)$hitsclasslistcom[$pagename][$list[class1]][]=$list;
	   if($list[class2]!=0)$hitsclasslistcom[$pagename][$list[class2]][]=$list;
	   if($list[class3]!=0)$hitsclasslistcom[$pagename][$list[class3]][]=$list;
	   }
      $hitslistall[$pagename][]=$list;
	  if($list[class1]!=0)$hitsclasslistall[$pagename][$list[class1]][]=$list;
	  if($list[class2]!=0)$hitsclasslistall[$pagename][$list[class2]][]=$list;
	  if($list[class3]!=0)$hitsclasslistall[$pagename][$list[class3]][]=$list;
	}else{
	  if($list[new_ok] == 1 or $list[img_ok] == 1){
	   $listnew[$pagename][]=$list;
	   if($list[class1]!=0)$classlistnew[$pagename][$list[class1]][]=$list;
	   if($list[class2]!=0)$classlistnew[$pagename][$list[class2]][]=$list;
	   if($list[class3]!=0)$classlistnew[$pagename][$list[class3]][]=$list;
	  }
	  if($list[com_ok] == 1){
	  $listcom[$pagename][]=$list;
	   if($list[class1]!=0)$classlistcom[$pagename][$list[class1]][]=$list;
	   if($list[class2]!=0)$classlistcom[$pagename][$list[class2]][]=$list;
	   if($list[class3]!=0)$classlistcom[$pagename][$list[class3]][]=$list;
	   }
      $listall[$pagename][]=$list;
	  if($list[class1]!=0)$classlistall[$pagename][$list[class1]][]=$list;
	  if($list[class2]!=0)$classlistall[$pagename][$list[class2]][]=$list;
	  if($list[class3]!=0)$classlistall[$pagename][$list[class3]][]=$list;
	}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>