<?php
# 文件名称:infolist.php 2009-08-13 15:48:57
# MetInfo企业网站管理系统 
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn)). All rights reserved.
	$list[title]=($lang=="en")?$list[e_title]:(($lang=="other")?$list[o_title]:$list[c_title]);
if($list[title]<>""){
	$list[class1_name]=$class1_list[$list[class1]][name];
	$list[class1_url]=$class1_list[$list[class1]][url];
	$list[class2_name]=$list[class2]?$class2_list[$list[class2]][name]:$list[class1_name];
	$list[class2_url]=$list[class2]?$class2_list[$list[class2]][url]:$list[class1_url];
	$list[class3_name]=$list[class3]?$class3_list[$list[class3]][name]:($list[class2]?$class2_list[$list[class2]][name]:$list[class1_name]);
	$list[class3_url]=$list[class3]?$class3_list[$list[class3]][url]:($list[class2]?$class2_list[$list[class2]][url]:$list[class1_url]);
	if($nowlabel=="met_hot"){
	  $list[top]="<img class='listtop' src='".$img_url."top.gif"."' />";
	  $list[hot]="";
	  $list[news]="";
	 }else{
	  $list[top]="";
	  $list[hot]=($list[hits]>=$met_hot)?"<img class='listhot' src='".$img_url."hot.gif"."' />":"";
	  $list[news]=(((strtotime($m_now_date)-strtotime($list[updatetime]))/86400)<$met_newsdays)?"<img class='listnew' src='".$img_url."news.gif"."' />":"";
	}
	$list[keywords]=($lang=="en")?$list[e_keywords]:(($lang=="other")?$list[o_keywords]:$list[c_keywords]);
	$list[description]=($lang=="en")?$list[e_description]:(($lang=="other")?$list[o_description]:$list[c_description]);
	$list[content]=($lang=="en")?$list[e_content]:(($lang=="other")?$list[o_content]:$list[c_content]);
	$list[imgurls]=($list[imgurls]<>"")?$list[imgurls]:'../public/images/metinfo.gif';
	$list[imgurl]=($list[imgurl]<>"")?$list[imgurl]:'../public/images/metinfo.gif';
	if($nowpara=="metinfo"){
	  for($i=1;$i<=$paranum;$i++){
	  $para="para".$i;
	  $c_para="c_para".$i;
	  $e_para="e_para".$i;
	  $o_para="o_para".$i;
      $list[$para]=($lang=="en")?$list[$e_para]:(($lang=="other")?$list[$o_para]:$list[$c_para]);
	    if($i>10&&$index=="index"){
	     $listarray[$para]=explode("../",$list[$para]);
         $list[$para]=$listarray[$para][1];
	    }
	  }
	 }
	$htmname=$filename."/".$filenamenow.$list[id];
	$phpname=$filename."/show".$pagename.".php?id=".$list[id];	
	$list[c_url]=$met_webhtm?$htmname.$met_c_htmtype:$phpname;
	$list[e_url]=$met_webhtm?$htmname.$met_e_htmtype:$phpname."&lang=en";
	$list[o_url]=$met_webhtm?$htmname.$met_o_htmtype:$phpname."&lang=other";
	$list[url]=($lang=="en")?$list[e_url]:(($lang=="other")?$list[o_url]:$list[c_url]);
	
	$listarray[imgurls]=explode("../",$list[imgurls]);
    $list[imgurls]=($index=="index")?$listarray[imgurls][1]:$list[imgurls];
	$listarray[imgurl]=explode("../",$list[imgurl]);
    $list[imgurl]=($index=="index")?$listarray[imgurl][1]:$list[imgurl];
	$list[updatetime] = date($met_listtime,strtotime($list[updatetime]));
if($met_member_use==2){
   if($list[class3]!=0&&$class3_list[$list[class3]][name]==""){
   $nowaccess=100;
   }elseif($list[class2]!=0&&$class2_list[$list[class2]][name]==""){
   $nowaccess=101;
   }elseif($list[class1]!=0&&$class1_list[$list[class1]][name]==""){
   $nowaccess=102;
   }else{
   $nowaccess=max(intval($list[access]),intval($class3_list[$list[class3]][access]),intval($class2_list[$list[class2]][access]),intval($class1_list[$list[class1]][access]));
   }
 if(intval($metinfo_member_type)>=intval($nowaccess)){
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
 }
}else{
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
}
}
# 本程序是一个开源系统,使用时请你仔细阅读使用协议,商业用途请自觉购买商业授权.
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn). All rights reserved.
?>