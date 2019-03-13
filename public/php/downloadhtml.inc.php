<?php

# 文件名称:downloadhtml.inc.php 2009-09-11 08:53:03
# MetInfo企业网站管理系统 
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserve


//下载模块输出函数
function methtml_download($type,$titlenum,$downurl=1,$filesize=1,$paranum,$detail,$time,$hits,$newwindow=1,$desription,$desnum,$classname,$news,$hot,$top,$listnav=0,$max,$topcolor){
 global $download_list,$download_list_com,$download_list_img,$download_class,$lang_Colunm,$lang_Hits,$lang_UpdateTime,$lang_Title,$lang_Detail,$lang_FileSize,$lang_Download;
 global $download_para,$download_para200,$addfeedback_url,$met_submit_type,$met_download_page;
 global $class1,$class2,$class3,$nav_list2,$nav_list3,$class_list,$module_list1,$search;
 $listarray=($type=='new')?$download_list_new:(($type=='com')?$download_list_com:$download_list);
 $listtext.="<ul>\n";
   if($listnav==1){
    $listtext.="<li class='download_list_title'>";
    if($classname==1)$listtext.="<span class='info_class' >[".$lang_Colunm."]</span>"; 
	$listtext.="<span class='info_title'>".$lang_Title."</span>";
	if($filesize==1)$listtext.="<span class='info_filesize'>".$lang_FileSize."</span>";
    $i=0;
  foreach($download_para200 as $key=>$val1){
    $i++;
	if($i>$paranum)break;
    $listtext.="<span class='info_para".$i."'>".$val1[mark]."</span>";
   }
    if($hits==1)$listtext.="<span class='info_hits'>".$lang_Hits."</span>";
	if($time==1)$listtext.="<span class='info_updatetime'>".$lang_UpdateTime."</span>";
	if($downurl==1)$listtext.="<span class='info_download'>".$lang_Download."</span>";
	if($detail==1)$listtext.="<span class='info_detail'>".$lang_Detail."</span>";
	$listtext.="</li>\n";
  }
 $i=0;
 foreach($listarray as $key=>$val){
 $i++;
 if(intval($titlenum)<>0)$val[title]=utf8substr($val[title], 0, $titlenum); 
 if(intval($desnum)<>0)$val[description]=utf8substr($val[description], 0, $desnum); 
 $listtext.="<li>";
 if($classname==1)$listtext.="<span class='info_class'><a href='".$val[classurl]."' title='".$val[classname]."' >[".$val[classname]."]</a></span>";
 $listtext.="<span  class='info_title'><a href=".$val[url];
 if($newwindow==1)$listtext.=" target='_blank' ";
 if($val[top_ok]==1)$listtext.=" style='color:".$topcolor.";'";
 $listtext.="  title='".$val[title]."' >".$val[title]."</a></span>";
 if($filesize==1)$listtext.="<span class='info_filesize'>";
 if($listnav!=1)$listtext.="<b>".$lang_FileSize."</b>:";
 $listtext.=$val[filesize]."KB</span>";
 $j=0;
 foreach($download_para200 as $key=>$val1){
 $j++;
 if($j>$paranum)break;
    $listtext.="<span class='info_para".$j."' >".$val[$val1[name]]."</span>";
  }
 if($hits==1)$listtext.="<span class='info_hits' >";
 if($listnav!=1)$listtext.="<b>".$lang_Hits."</b>:"; 
  $listtext.=$val[hits]."</span>";
 if($top==1)$listtext.=$val[top];
 if($news==1)$listtext.=$val[news];
 if($hot==1)$listtext.=$val[hot];
 if($time==1)$listtext.="<span class='info_updatetime' >";
 if($listnav!=1)$listtext.="<b>".$lang_UpdateTime."</b>:"; 
   $listtext.=$val[updatetime]."</span>";
 if($downurl==1)$listtext.="<span class='info_download'><a href='".$val[downloadurl]."' target='_blank'>".$lang_Download."</a></span>";
 if($detail==1){
    $listtext.="<span class='info_detail' ><a href=".$val[url];
    if($newwindow==1)$listtext.=" target='_blank' ";
    $listtext.=">".$lang_Detail."</a></span>";
  }
 $listtext.="</li>\n";
 if($max&&$i>=$max)break;
 }
 $listtext.="</ul>";
 return $listtext;
 }

function methtml_showdownload($type,$desription){
 global $download,$lang_Colunm,$lang_Hits,$lang_UpdateTime,$lang_Title,$lang_Detail,$lang_Download;
 global $download_para,$download_para200,$met_url,$download_paraimg,$lang_FileSize;
if($type=='all' or $type==''){
 $j=0;
 $k=0;
 $listtext.="<ul>\n";
 $listtext.="<span class='info_filesize'><b>".$lang_FileSize."</b>:".$download[filesize]."</span>";
 foreach($download_para as $key=>$val){
   if($val[maxsize]==200){
     $j++;
    $listtext.="<li class='info_para".$j."' ><b>".$val[mark].":</b>".$download[$val[name]]."</li>";
   }elseif($val[maxsize]!=255){
     $k++;
    $listtext.="<li class='info_bigpara".$k."' ><b>".$val[mark].":</b>".$download[$val[name]]."</li>";
   }
  }
  $listtext.="</ul>\n"; 
 if($desription==1 && $download[description]){
 $listtext.="<span class='info_description' >".$download[description]."</span>"; 
 }
 $listtext.="<span class='info_download'><a href='".$download[downloadurl]."' target='_blank'>".$lang_Download."</a></span>";
 
}elseif($type=='para'){
 $j=0;
 $k=0;
 $listtext.="<ul>\n";
 foreach($download_para as $key=>$val){
   if($val[maxsize]==200){
     $j++;
    $listtext.="<li class='info_para".$j."' ><b>".$val[mark].":</b>".$download[$val[name]]."</li>";
   }elseif($val[maxsize]!=255){
     $k++;
    $listtext.="<li class='info_bigpara".$k."' ><b>".$val[mark].":</b>".$download[$val[name]]."</li>";
   }
  }
  $listtext.="</ul>\n"; 
} 
  return $listtext;
}
?>