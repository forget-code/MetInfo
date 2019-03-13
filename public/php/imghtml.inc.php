<?php

# 文件名称:imghtml.inc.php 2009-08-31 08:53:03
# MetInfo企业网站管理系统 
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserve


//图片模块输出函数
function methtml_img($listtype,$type,$titlenum,$paranum,$detail,$feedback,$time,$hits,$newwindow=1,$desription,$desnum,$classname,$news,$hot,$top,$listnav=1,$max,$topcolor){
 global $img_list,$img_list_com,$img_list_img,$img_class,$lang_Colunm,$lang_Hits,$lang_UpdateTime,$lang_Title,$lang_Detail,$lang_Buy,$lang_imgTitle;
 global $img_para,$img_para200,$met_img_x,$met_imgdetail_x,$met_imgdetail_y,$met_img_y,$addfeedback_url,$met_submit_type,$met_img_page;
 global $class1,$class2,$class3,$nav_list2,$nav_list3,$class_list,$module_list1,$search;
 $listarray=($type=='new')?$img_list_new:(($type=='com')?$img_list_com:$img_list);
 $metimgok=0;
 if($met_img_page && $listtype=='img' &&($search<>'search')){
 if($class2 && count($nav_list3[$class2])&& (!$class3) ){
     $listarray=$nav_list3[$class2];
	 $metimgok=1;
	}elseif((!$class2) && count($nav_list2[$class1]) && $class1 && (!$class3)){
	 $listarray=$nav_list2[$class1];
	 $metimgok=1;
	}elseif($class_list[$class1][module]==101){
      $listarray=$module_list1[5];
	  $metimgok=1;
    }}
 $listtext.="<ul>\n";
 if($listtype=='text' or $listtype==''){
   if($listnav==1){
    $listtext.="<li class='img_list_title'>";
    if($classname==1)$listtext.="<span class='info_class' >[".$lang_Colunm."]</span>"; 
	$listtext.="<span class='info_title'>".$lang_imgTitle."</span>";
    $i=0;
  foreach($img_para200 as $key=>$val1){
    $i++;
	if($i>$paranum)break;
    $listtext.="<span class='info_para".$i."'>".$val1[mark]."</span>";
   }
    if($hits==1)$listtext.="<span class='info_hits'>".$lang_Hits."</span>";
	if($time==1)$listtext.="<span class='info_updatetime'>".$lang_UpdateTime."</span>";
	if($detail==1)$listtext.="<span class='info_detail'>".$lang_Detail."</span>";
	if($feedback==1)$listtext.="<span class='info_feedback'>".$lang_Buy."</span>";
	$listtext.="</li>\n";
  }
 }
 $i=0;
 foreach($listarray as $key=>$val){
 $val[title]=($val[title]=='')?$val[name]:$val[title];
 $val[name]=($val[name]=='')?$val[title]:$val[name];
 $addfeedback_url1=$met_submit_type?$addfeedback_url.$val[title]:addfeedback_url;
 $i++;
 if(intval($titlenum)<>0)$val[title]=utf8substr($val[title], 0, $titlenum); 
 if(intval($desnum)<>0)$val[description]=utf8substr($val[description], 0, $desnum); 
 $listtext.="<li>";
if($listtype=='img'){
 $listtext.="<span class='info_img' ><a href='".$val[url]."'";
 if($metimgok){
 $listtext.=" ".$val[new_windows]."><img src=".$val[columnimg]." alt=".$val[name]." width=".$met_img_x." height=".$met_img_y." /></a></span>";
 $listtext.="<span class='info_title' ><a title='".$val[name]."' href=".$val[url]." ".$val[new_windows]." >".$val[name]."</a></span>";
if($paranum) $listtext.="<span class='info_description' class='info_para' ><a title='".$val[name]."' href=".$val[url]." ".$val[new_windows]." >".$val[description]."</a></span>";
 if($detail==1)$listtext.="<span class='info_detail' ><a href=".$val[url]." ".$val[new_windows]." >".$lang_Detail."</a></span>";
 if($feedback==1)$listtext.="<span class='info_feedback'><a href='".$addfeedback_url1."' >".$lang_Buy."</a></span>";
 }else{
 if($newwindow==1)$listtext.=" target='_blank' ";
 $listtext.=" ><img src=".$val[imgurls]." alt=".$val[title]." width=".$met_img_x." height=".$met_img_y." /></a></span>";
 if($classname==1)$listtext.="<span class='info_class' ><a href='".$val[classurl]."' title='".$val[classname]."' >[".$val[classname]."]</a></span>";
 $listtext.="<span class='info_title' ><a title='".$val[title]."' href=".$val[url];
 if($newwindow==1)$listtext.=" target='_blank' ";
 if($val[top_ok]==1)$listtext.="style='color:".$topcolor.";'";
 $listtext.=">".$val[title]."</a></span>";
 if($desription==1 && $val[description]){
 $listtext.="<span class='info_description' ><a title='".$val[title]."' href=".$val[url];
 if($newwindow==1)$listtext.=" target='_blank' ";
 $listtext.=">".$val[description]."</a></span>"; 
 }
 $j=0;
 foreach($img_para200 as $key=>$val1){
 $j++;
 if($j>$paranum)break;
    $listtext.="<span class='info_para".$j."' ><b>".$val1[mark].":</b>".$val[$val1[name]]."</span>";
  }
 if($hits==1)$listtext.="<span class='info_hits'>".$lang_Hits.":<font>".$val[hits]."</font></span>";
 if($time==1)$listtext.="<span class='info_updatetime'>".$lang_UpdateTime.":".$val[updatetime]."</span>";
 if($detail==1){
    $listtext.="<span class='info_detail' ><a href=".$val[url];
    if($newwindow==1)$listtext.=" target='_blank' ";
    $listtext.=">".$lang_Detail."</a></span>";
  }
 if($feedback==1)$listtext.="<span class='info_feedback'><a href='".$addfeedback_url1."' >".$lang_Buy."</a></span>";
 }
}else{
 if($classname==1)$listtext.="<span class='info_class'><a href='".$val[classurl]."' title='".$val[classname]."' >[".$val[classname]."]</a></span>";
 $listtext.="<span  class='info_title'><a href=".$val[url];
 if($newwindow==1)$listtext.=" target='_blank' ";
 if($val[top_ok]==1)$listtext.=" style='color:".$topcolor.";'";
 $listtext.="  title='".$val[title]."' >".$val[title]."</a></span>";
 $j=0;
 foreach($img_para200 as $key=>$val1){
 $j++;
 if($j>$paranum)break;
    $listtext.="<span class='info_para".$j."' >".$val[$val1[name]]."</span>";
  }
 if($hits==1)$listtext.="<span class='info_hits' ><b>".$val[hits]."</b></span>";
 if($top==1)$listtext.=$val[top];
 if($news==1)$listtext.=$val[news];
 if($hot==1)$listtext.=$val[hot];
 if($time==1)$listtext.="<span class='info_updatetime' >".$val[updatetime]."</span>";
 if($detail==1){
    $listtext.="<span class='info_detail' ><a href=".$val[url];
    if($newwindow==1)$listtext.=" target='_blank' ";
    $listtext.=">".$lang_Detail."</a></span>";
  }
 if($feedback==1)$listtext.="<span class='info_feedback'><a href='".$addfeedback_url1."' >".$lang_Buy."</a></span>";
}
 $listtext.="</li>\n";
 if($max&&$i>=$max)break;
 }
 $listtext.="</ul>";
 return $listtext;
 }

function methtml_showimg($type,$feedback=0,$desription){
 global $img,$lang_Colunm,$lang_Hits,$lang_UpdateTime,$lang_Title,$lang_Detail,$lang_Buy,$lang_BigPicture;
 global $img_para,$img_para200,$met_img_x,$met_imgdetail_x,$met_imgdetail_y,$met_img_y,$addfeedback_url,$met_submit_type,$met_url,$img_paraimg;
 $addfeedback_url1=$met_submit_type?$addfeedback_url.$img[title]:addfeedback_url;
if($type=='all'){
  $listtext.=methtml_imgdisplay();
 $j=0;
 $k=0;
 $listtext.="<ul>\n";
 foreach($img_para as $key=>$val){
   if($val[maxsize]==200){
     $j++;
    $listtext.="<li class='info_para".$j."' ><b>".$val[mark].":</b>".$img[$val[name]]."</li>";
   }elseif($val[maxsize]!=255){
     $k++;
    $listtext.="<li class='info_bigpara".$k."' ><b>".$val[mark].":</b>".$img[$val[name]]."</li>";
   }
  }
  $listtext.="</ul>\n"; 
 if($desription==1 && $val[description]){
 $listtext.="<span class='info_description' >".$val[description]."</span>"; 
 }
 if($feedback==1)$listtext.="<span class='info_feedback'><a href='".$addfeedback_url1."' >".$lang_Buy."</a></span>";
 
}elseif($type=='para'){
 $j=0;
 $k=0;
 $listtext.="<ul>\n";
 foreach($img_para as $key=>$val){
   if($val[maxsize]==200){
     $j++;
    $listtext.="<li class='info_para".$j."' ><b>".$val[mark].":</b>".$img[$val[name]]."</li>";
   }elseif($val[maxsize]!=255){
     $k++;
    $listtext.="<li class='info_bigpara".$k."' ><b>".$val[mark].":</b>".$img[$val[name]]."</li>";
   }
  }
  $listtext.="</ul>\n"; 
}
  return $listtext;
}
require_once 'imgdisplayhtml.inc.php';

?>