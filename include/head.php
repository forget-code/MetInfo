<?php
# 文件名称:head.php 2009-08-18 08:53:03
# MetInfo企业网站管理系统 
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.
if($index=="index"){
$class1=10001;
$class2=0;
$class3=0;
$class_list[10001][module]=10001;
$css_url="templates/".$met_skin_user."/css/";
$img_url="templates/".$met_skin_user."/images/";
$met_url="public/";
$navurl="";
$met_logoarray=explode("../",$met_logo);
$met_logo=$met_logoarray[1];
}else{
$class1=intval($class1);
$class2=intval($class2);
$class3=intval($class3);
$css_url="../templates/".$met_skin_user."/css/";
$img_url="../templates/".$met_skin_user."/images/";
$met_url="../public/";
$navurl="../";
}
if($classnow=="")$classnow=$class3?$class3:($class2?$class2:$class1);

$modulename[2]=array(0=>'news',1=>'shownews');
$modulename[3]=array(0=>'product',1=>'showproduct');
$modulename[4]=array(0=>'download',1=>'showdownload');
$modulename[5]=array(0=>'img',1=>'showimg');
$modulename[6]=array(0=>'job',1=>'showjob');
$modulename[7]=array(0=>'message',1=>'message');
$modulename[8]=array(0=>'feedback',1=>'index');	
$modulename[9]=array(0=>'link',1=>'index');	
$modulename[10]=array(0=>'member',1=>'index');	
$modulename[11]=array(0=>'search',1=>'search');	
$modulename[9]=array(0=>'sitemap',1=>'sitemap');	
	
$query="select * from $met_column order by no_order";
$result= $db->query($query);
	while($list = $db->fetch_array($result)){
	$list[name]=($lang=="en")?$list[e_name]:(($lang=="other")?$list[o_name]:$list[c_name]);
	$list[keywords]=($lang=="en")?$list[e_keywords]:(($lang=="other")?$list[o_keywords]:$list[c_keywords]);
	$list[content]=($lang=="en")?$list[e_content]:(($lang=="other")?$list[o_content]:$list[c_content]);
	$list[description]=($lang=="en")?$list[e_description]:(($lang=="other")?$list[o_description]:$list[c_description]);
	$list[out_url]=($lang=="en")?$list[e_out_url]:(($lang=="other")?$list[o_out_url]:$list[c_out_url]);
	$list[indeximgarray]=explode("../",$list[indeximg]);
    $list[indeximg]=($index=="index")?$list[indeximgarray][1]:$list[indeximg];
	$list[columnimgarray]=explode("../",$list[columnimg]);
    $list[columnimg]=($index=="index")?$list[columnimgarray][1]:$list[columnimg];
	switch($list[classtype]){
	case 1;
	$c_urllast="?class1=".$list[id];
	$e_urllast="?lang=en&class1=".$list[id];
	$o_urllast="?lang=other&class1=".$list[id];
	$htmlistpre="_";
	break;
	case 2;
	$c_urllast="?class1=".$list[bigclass]."&class2=".$list[id];
	$e_urllast="?lang=en&class1=".$list[bigclass]."&class2=".$list[id];
	$o_urllast="?lang=other&class1=".$list[bigclass]."&class2=".$list[id];
	$htmlistpre="_".$list[bigclass]."_";
	break;
	case 3;
	$urlclass1 = $db->get_one("SELECT * FROM $met_column where id='$list[bigclass]'");
	$c_urllast="?class1=".$urlclass1[bigclass]."&class2=".$list[bigclass]."&class3=".$list[id];
	$e_urllast="?lang=en&class1=".$urlclass1[bigclass]."&class2=".$list[bigclass]."&class3=".$list[id];
	$o_urllast="?lang=other&class1=".$urlclass1[bigclass]."&class2=".$list[bigclass]."&class3=".$list[id];
	$htmlistpre="_".$urlclass1[bigclass]."_".$list[bigclass]."_";
	break;
	}
	
	switch($list[module]){
	default:
	$list[c_url]=($met_webhtm==2)?(!$met_htmlistname?$modulename[$list[module]][0]:$list[foldername]).$htmlistpre.$list[id]."_1".$met_c_htmtype:$modulename[$list[module]][0].".php".$c_urllast;
	$list[e_url]=($met_webhtm==2)?(!$met_htmlistname?$modulename[$list[module]][0]:$list[foldername]).$htmlistpre.$list[id]."_1".$met_e_htmtype:$modulename[$list[module]][0].".php".$e_urllast;
	$list[o_url]=($met_webhtm==2)?(!$met_htmlistname?$modulename[$list[module]][0]:$list[foldername]).$htmlistpre.$list[id]."_1".$met_o_htmtype:$modulename[$list[module]][0].".php".$o_urllast;
	break;
	case 0:	
	$list[c_url]=(strstr($list[c_out_url],"http://"))?$list[c_out_url]:$navurl.$list[c_out_url];
	$list[e_url]=(strstr($list[e_out_url],"http://"))?$list[e_out_url]:$navurl.$list[e_out_url];
	$list[o_url]=(strstr($list[o_out_url],"http://"))?$list[o_out_url]:$navurl.$list[o_out_url];
	break;
	case 1:
	if($list[isshow]!=1&&$list[classtype]==1){
	$list[urllabel]="metinfo_url";
	$metinfo_about="metinfo";
	}else{
	$list[c_url]=$met_webhtm?$list[filename].$met_c_htmtype:"show.php?id=".$list[id];
	$list[e_url]=$met_webhtm?$list[filename].$met_e_htmtype:"show.php?lang=en&id=".$list[id];
	$list[o_url]=$met_webhtm?$list[filename].$met_o_htmtype:"show.php?lang=other&id=".$list[id];
	}
	break;
	case 6:
	$list[c_url]=($met_webhtm==2)?(!$met_htmlistname?"job":$list[foldername])."_".$list[id]."_1".$met_c_htmtype:"job.php";
	$list[e_url]=($met_webhtm==2)?(!$met_htmlistname?"job":$list[foldername])."_".$list[id]."_1".$met_e_htmtype:"job.php?lang=en";
	$list[o_url]=($met_webhtm==2)?(!$met_htmlistname?"job":$list[foldername])."_".$list[id]."_1".$met_o_htmtype:"job.php?lang=other";
	break;
	case 7:
	$list[c_url]=$met_webhtm?(!$met_htmlistname?"message":$list[foldername]).$met_c_htmtype:"message.php";
	$list[e_url]=$met_webhtm?(!$met_htmlistname?"message":$list[foldername]).$met_e_htmtype:"message.php?lang=en";
	$list[o_url]=$met_webhtm?(!$met_htmlistname?"message":$list[foldername]).$met_o_htmtype:"message.php?lang=other";
	break;
	case 8:
	$list[c_url]=$met_webhtm?"index".$met_c_htmtype:"index.php";
	$list[e_url]=$met_webhtm?"index".$met_e_htmtype:"index.php?lang=en";
	$list[o_url]=$met_webhtm?"index".$met_o_htmtype:"index.php?lang=other";
	break;
	case 9:
	$list[c_url]=$met_webhtm?"index".$met_c_htmtype:"index.php";
	$list[e_url]=$met_webhtm?"index".$met_e_htmtype:"index.php?lang=en";
	$list[o_url]=$met_webhtm?"index".$met_o_htmtype:"index.php?lang=other";
	break;
	case 10:
	$list[c_url]=$met_webhtm?"index".$met_c_htmtype:"index.php";
	$list[e_url]=$met_webhtm?"index".$met_e_htmtype:"index.php?lang=en";
	$list[o_url]=$met_webhtm?"index".$met_o_htmtype:"index.php?lang=other";
	break;
	case 11:
	$list[c_url]="search.php";
	$list[e_url]="search.php?lang=en";
	$list[o_url]="search.php?lang=other";
	break;
	case 12:
	$list[c_url]=$met_webhtm?"sitemap".$met_c_htmtype:"sitemap.php";
	$list[e_url]=$met_webhtm?"sitemap".$met_e_htmtype:"sitemap.php?lang=en";
	$list[o_url]=$met_webhtm?"sitemap".$met_o_htmtype:"sitemap.php?lang=other";
	break;
	case 100:
	$list[c_url]=($met_webhtm==2)?"product_".$list[id]."_1".$met_c_htmtype:"product.php";
	$list[e_url]=($met_webhtm==2)?"product_".$list[id]."_1".$met_e_htmtype:"product.php?lang=en";
	$list[o_url]=($met_webhtm==2)?"product_".$list[id]."_1".$met_o_htmtype:"product.php?lang=other";
	break;
	case 101:
	$list[c_url]=($met_webhtm==2)?"img_".$list[id]."_1".$met_c_htmtype:"img.php";
	$list[e_url]=($met_webhtm==2)?"img_".$list[id]."_1".$met_e_htmtype:"img.php?lang=en";
	$list[o_url]=($met_webhtm==2)?"img_".$list[id]."_1".$met_o_htmtype:"img.php?lang=other";
	break;
	}
	$list[c_url]=$list[module]?$navurl.$list[foldername]."/".$list[c_url]:$list[c_url];
	$list[e_url]=$list[module]?$navurl.$list[foldername]."/".$list[e_url]:$list[e_url];
	$list[o_url]=$list[module]?$navurl.$list[foldername]."/".$list[o_url]:$list[o_url];
	$list[url]=($lang=="en")?$list[e_url]:(($lang=="other")?$list[o_url]:$list[c_url]);
	if($list[module]==7)$addmessage_url=$list[url];
	if($list[moudle]==8)$addfeedback_url=$list[url];
	if($met_member_use==2){
	 if(intval($metinfo_member_type)>=intval($list[access])){
	   $nav_listall[]=$list;
	   $class_list[$list[id]]=$list;
	    if($list[classtype]==1){
	     $nav_list_1[]=$list;
		 $module_list1[$list[module]][]=$list;
		 $class1_list[$list[id]]=$list;
	     if($list[module]==2 or $list[module]==3 or $list[module]==4 or $list[module]==5)$nav_search[]=$list; 
	    } 
	  if($list[classtype]==2){
	  $nav_list_2[]=$list;
	  $module_list2[$list[module]][]=$list;
	  $nav_list2[$list[bigclass]][]=$list;
	  $class2_list[$list[id]]=$list;
	  }
	  if($list[classtype]==3){
	  $nav_list_3[]=$list;
	  $module_list3[$list[module]][]=$list;
	  $nav_list3[$list[bigclass]][]=$list;
	  $class3_list[$list[id]]=$list;
	  }
	  if($list[nav]==1 or $list[nav]==3)$nav_list[]=$list;
	  if($list[nav]==2 or $list[nav]==3){$navfoot_list[]=$list;}
	  if($list[id]==$class1&&$list[module]==1&&$list[isshow]==1){$nav_listabout[]=$list;}
	  if($list[index_num]!="" and $list[index_num]!=0){
	   $list[classtype]="class".$list[classtype];
	   $class_index[$list[index_num]]=$list;
	   }
	 }
	}else{
	$nav_listall[]=$list;
	$class_list[$list[id]]=$list;
	$module_listall[$list[module]][]=$list;
	if($list[classtype]==1){
	  $nav_list_1[]=$list;
	  $module_list1[$list[module]][]=$list;
	  $class1_list[$list[id]]=$list;
	  if($list[module]==2 or $list[module]==3 or $list[module]==4 or $list[module]==5)$nav_search[]=$list; 
	} 
	if($list[classtype]==2){
	  $nav_list_2[]=$list;
	  $module_list2[$list[module]][]=$list;
	  $nav_list2[$list[bigclass]][]=$list;
	  $class2_list[$list[id]]=$list;
	  }
	if($list[classtype]==3){
	  $nav_list_3[]=$list;
	  $module_list3[$list[module]][]=$list;
	  $nav_list3[$list[bigclass]][]=$list;
	  $class3_list[$list[id]]=$list;
	  }
	if($list[nav]==1 or $list[nav]==3)$nav_list[]=$list;
	if($list[nav]==2 or $list[nav]==3){$navfoot_list[]=$list;}
	if($list[id]==$class1&&$list[module]==1&&$list[isshow]==1){$nav_listabout[]=$list;}
	if($list[index_num]!="" and $list[index_num]!=0){
	   $list[classtype]="class".$list[classtype];
	   $class_index[$list[index_num]]=$list;
	 }
	}
}

if($metinfo_about=="metinfo"){
  foreach($nav_listall as $key=>$val){
    if($val[urllabel]=="metinfo_url"){
	  foreach($nav_list2[$val[id]] as $key=>$val1){
	  $val[url]=$val1[url];
	  $val[c_url]=$val1[c_url];
	  $val[e_url]=$val1[e_url];
	  $val[o_url]=$val1[o_url];
	  break;
	  }
    }
   $nav_listall1[]=$val;
   if($val[classtype]==1)$nav_list_11[]=$val;
   if($val[nav]==1 or $val[nav]==3)$nav_list1[]=$val;
   if($val[nav]==2 or $val[nav]==3){$navfoot_list1[]=$val;}
   }
$nav_listall=$nav_listall1;
$nav_list_1=$nav_list_11;
$nav_list=$nav_list1;
$navfoot_list=$navfoot_list1;
}

if(count($nav_listabout)&&$show[module]==1){
  $count=count($nav_list2[$class1]);
  for($i=$count;$i>0;$i=$i-1){
   $nav_list2[$class1][$i]=$nav_list2[$class1][$i-1];
   }
  $nav_list2[$class1][0]=$nav_listabout[0];
}


if(file_exists($navurl."templates/".$met_skin_user."/database.inc.php")){
require_once ($navurl."templates/".$met_skin_user."/database.inc.php");
}else{
require_once ($navurl.'config/database.inc.php');
}
$pagemark=$class_list[$classnow][module];
//备用字段
if(!isset($dataoptimize[$pagemark][otherinfo]))$dataoptimize[$pagemark][otherinfo]=$dataoptimize[10000][otherinfo];
if($dataoptimize[$pagemark][otherinfo]){
$otherinfo = $db->get_one("SELECT * FROM $met_otherinfo order by id desc");
if($index=="index"){
$otherinfo[c_imgurl1]=explode("../",$otherinfo[c_imgurl1]);
$otherinfo[c_imgurl1]=$otherinfo[c_imgurl1][1];
$otherinfo[c_imgurl2]=explode("../",$otherinfo[c_imgurl2]);
$otherinfo[c_imgurl2]=$otherinfo[c_imgurl2][1];
$otherinfo[e_imgurl1]=explode("../",$otherinfo[e_imgurl1]);
$otherinfo[e_imgurl1]=$otherinfo[e_imgurl1][1];
$otherinfo[e_imgurl2]=explode("../",$otherinfo[e_imgurl2]);
$otherinfo[e_imgurl2]=$otherinfo[e_imgurl2][1];
$otherinfo[o_imgurl1]=explode("../",$otherinfo[o_imgurl1]);
$otherinfo[o_imgurl1]=$otherinfo[o_imgurl1][1];
$otherinfo[o_imgurl2]=explode("../",$otherinfo[o_imgurl2]);
$otherinfo[o_imgurl2]=$otherinfo[o_imgurl2][1];
}
$otherinfo[imgurl1]=($lang=="en")?$otherinfo[e_imgurl1]:(($lang=="other")?$otherinfo[o_imgurl1]:$otherinfo[c_imgurl1]);
$otherinfo[imgurl2]=($lang=="en")?$otherinfo[e_imgurl2]:(($lang=="other")?$otherinfo[o_imgurl2]:$otherinfo[c_imgurl2]);
for($i=1;$i<11;$i++)
{
$tmp="info".$i;
$e_tmp="e_info".$i;
$c_tmp="c_info".$i;
$o_tmp="o_info".$i;
$otherinfo[$tmp]=($lang=="en")?$otherinfo[$e_tmp]:(($lang=="other")?$otherinfo[$o_tmp]:$otherinfo[$c_tmp]);
}
}

//在线交流
if($met_online_type!==3){
$query="select * from $met_online order by no_order";
$result= $db->query($query);
while($list = $db->fetch_array($result)){
$list[name]=($lang=="en")?$list[e_name]:(($lang=="other")?$list[o_name]:$list[c_name]);
$online_list[]=$list;
if($list[qq]!="")$qq_list[]=$list;
if($list[msn]!="")$msn_list[]=$list;
if($list[taobao]!="")$taobao_list[]=$list;
if($list[alibaba]!="")$alibaba_list[]=$list;
if($list[skype]!="")$skype_list[]=$list;
}
}

//Flash
if(!isset($met_flasharray[$classnow][type]))$met_flasharray[$classnow]=$met_flasharray[10000];
if($met_flasharray[$classnow][type]){
$query="select * from $met_flash where module=10000 or module=".$class1." or module=".$class2." or module=".$class3." or module=".$classnow."  order by no_order";
$result= $db->query($query);
while($list = $db->fetch_array($result)){
$list[c_img_path_array]=explode("../",$list[c_img_path]);
$list[c_img_path]=($index=="index")?$list[c_img_path_array][1]:$list[c_img_path];
$list[e_img_path_array]=explode("../",$list[e_img_path]);
$list[e_img_path]=($index=="index")?$list[e_img_path_array][1]:$list[e_img_path];
$list[o_img_path_array]=explode("../",$list[o_img_path]);
$list[o_img_path]=($index=="index")?$list[o_img_path_array][1]:$list[o_img_path];
$list[c_flash_path_array]=explode("../",$list[c_flash_path]);
$list[c_flash_path]=($index=="index")?$list[c_flash_path_array][1]:$list[c_flash_path];
$list[e_flash_path_array]=explode("../",$list[e_flash_path]);
$list[e_flash_path]=($index=="index")?$list[e_flash_path_array][1]:$list[e_flash_path];
$list[o_flash_path_array]=explode("../",$list[o_flash_path]);
$list[o_flash_path]=($index=="index")?$list[o_flash_path_array][1]:$list[o_flash_path];
$list[c_flash_back_array]=explode("../",$list[c_flash_back]);
$list[c_flash_back]=($index=="index")?$list[c_flash_back_array][1]:$list[c_flash_back];
$list[e_flash_back_array]=explode("../",$list[e_flash_back]);
$list[e_flash_back]=($index=="index")?$list[e_flash_back_array][1]:$list[e_flash_back];
$list[o_flash_back_array]=explode("../",$list[o_flash_back]);
$list[o_flash_back]=($index=="index")?$list[o_flash_back_array][1]:$list[o_flash_back];
$list[img_path]=($lang=="en")?$list[e_img_path]:(($lang=="other")?$list[o_img_path]:$list[c_img_path]);
$list[flash_path]=($lang=="en")?$list[e_flash_path]:(($lang=="other")?$list[o_flash_path]:$list[c_flash_path]);
$list[flash_back]=($lang=="en")?$list[e_flash_back]:(($lang=="other")?$list[o_flash_back]:$list[c_flash_back]);
$list[img_title]=($lang=="en")?$list[e_img_title]:(($lang=="other")?$list[o_img_title]:$list[c_img_title]);
$list[img_link]=($lang=="en")?$list[e_img_link]:(($lang=="other")?$list[o_img_link]:$list[c_img_link]);
$met_flashall[]=$list;
 if($list[flash_path]!=""){
        $met_flashflashall[]=$list; 
		$flash_flash_module[$list[module]]=$list;
  }else{
        $met_flashimgall[]=$list;
		$flash_img_module[$list[module]]=$list;
 }
}
if($met_flasharray[$classnow][type]==2){
  if(count($flash_flash_module[$classnow])==0){
      if($class3<>0){
	     if($class2<>0&&count($flash_flash_module[$class2])<>0){
		   $flash_nowarray=$flash_flash_module[$class2];
		   $met_flash_x=$met_flasharray[$class2][x];
           $met_flash_y=$met_flasharray[$class2][y];
		   }elseif($class1<>0&&count($flash_flash_module[$class1])<>0){
		   $flash_nowarray=$flash_flash_module[$class1];
		   $met_flash_x=$met_flasharray[$class1][x];
           $met_flash_y=$met_flasharray[$class1][y];
		   }else{
		   $flash_nowarray=$flash_flash_module[10000];
		   $met_flash_x=$met_flasharray[10000][x];
           $met_flash_y=$met_flasharray[10000][y];
		   }
	   }elseif($class2<>0){
	     if($class1<>0&&count($flash_flash_module[$class1])<>0){
		   $flash_nowarray=$flash_flash_module[$class1];
		   $met_flash_x=$met_flasharray[$class1][x];
           $met_flash_y=$met_flasharray[$class1][y];
		   }else{
		   $flash_nowarray=$flash_flash_module[10000];
		   $met_flash_x=$met_flasharray[10000][x];
           $met_flash_y=$met_flasharray[10000][y];
		   }
	   }else{
	      $flash_nowarray=$flash_flash_module[10000];
		  $met_flash_x=$met_flasharray[10000][x];
          $met_flash_y=$met_flasharray[10000][y];
	   }
  }else{
     $flash_nowarray=$flash_flash_module[$classnow];
	 $met_flash_x=$met_flasharray[$classnow][x];
     $met_flash_y=$met_flasharray[$classnow][y];
  }

if(count($flash_nowarray)<>0){
  $met_flash_ok=1;
  $met_flash_type=1;
  $met_flash_url=$flash_nowarray[flash_path];
  $met_e_flash_url=$flash_nowarray[e_flash_path];
  $met_flash_back=$flash_nowarray[flash_back];
  $met_e_flash_back=$flash_nowarray[e_flash_back];
  }

 }elseif($met_flasharray[$classnow][type]==1){
 $met_flash_ok=1;
 $met_flash_type=0;
 foreach($met_flashimgall as $key=>$val){
 if($val[e_img_path]!="")$met_e_flash_img=$met_e_flash_img.$val[e_img_path]."|";
 if($val[img_path]!=""){
   if($met_flasharray[$classnow][x]==$val[width] && $met_flasharray[$classnow][y]==$val[height]){
      $met_flash_img=$met_flash_img.$val[img_path]."|";
      $met_flash_imglink=$met_flash_imglink.$val[img_link]."|";
      $met_flash_imgtitle=$met_flash_imgtitle.$val[img_title]."|";
	  $met_flashimg[]=$val;
   }
   }}
     $met_flash_x=$met_flasharray[$classnow][x];
     $met_flash_y=$met_flasharray[$classnow][y];
 }elseif($met_flasharray[$classnow][type]==3){
       if(count($flash_img_module[$classnow])){
		$flash_imgone_img=$flash_img_module[$classnow][img_path];
		$flash_imgone_url=$flash_img_module[$classnow][img_link];
		$flash_imgone_title=$flash_img_module[$classnow][img_title];
	    }else{
		  if($flash_imgone_img==""){
           $flash_imgone_img=$flash_img_module[$class2][img_path];
		   $flash_imgone_url=$flash_img_module[$class2][img_link];
		   $flash_imgone_title=$flash_img_module[$class2][img_title];
		   }
		   if($flash_imgone_img==""){
           $flash_imgone_img=$flash_img_module[$class1][img_path];
		   $flash_imgone_url=$flash_img_module[$class1][img_link];
		   $flash_imgone_title=$flash_img_module[$class1][img_title];
		   }
		   if($flash_imgone_img==""){
           $flash_imgone_img=$flash_img_module[10000][img_path];
		   $flash_imgone_url=$flash_img_module[10000][img_link];
		   $flash_imgone_title=$flash_img_module[10000][img_title];
		   }
		}
 }elseif($met_flasharray[$classnow][type]==0){
  $met_flash_ok=0;
 }


$met_flash_img=substr($met_flash_img, 0, -1);
$met_e_flash_img=substr($met_e_flash_img, 0, -1);
$met_flash_imglink=substr($met_flash_imglink, 0, -1);
$met_flash_imgtitle=substr($met_flash_imgtitle, 0, -1);
$met_flashurl=$met_flash_imglink;
$met_flash_xpx=$met_flash_x."px";
$met_flash_ypx=$met_flash_y."px";

}

//产品、下载、图片模块参数
if(!isset($dataoptimize[$pagemark][parameter]))$dataoptimize[$pagemark][parameter]=$dataoptimize[10000][parameter];
if($dataoptimize[$pagemark][parameter]){
$query = "SELECT * FROM $met_parameter where type<6  and use_ok='1' order by no_order";
$result = $db->query($query);
while($list= $db->fetch_array($result)){
$list[mark]=($lang=="en")?$list[e_mark]:(($lang=="other")?$list[o_mark]:$list[c_mark]);
  switch($list[type]){
  case 3:
  $product_para[]=$list;
  if($list[maxsize]==200)$product_para200[]=$list;
  if($list[maxsize]==255)$product_paraimg[]=$list;
  if($list[id]>80)$product_paraselect[]=$list;
  break;
  case 4:
  $download_para[]=$list;
  if($list[maxsize]==200)$download_para200[]=$list;
  if($list[maxsize]==255)$download_paraimg[]=$list;
  break;
  case 5:
  $img_para[]=$list;
  if($list[maxsize]==200)$img_para200[]=$list;
  if($list[maxsize]==255)$img_paraimg[]=$list;
  if($list[id]>80)$img_paraselect[]=$list;
  break;
  }
  $met_para[$list[type]][$list[name]]=$list;
}

$query = "SELECT * FROM $met_fdlist where bigid>80 order by no_order";
$result = $db->query($query);
while($list= $db->fetch_array($result)){
$list['list']=($lang=="en")?$list[e_list]:(($lang=="other")?$list[o_list]:$list[c_list]);
$para_select[$list[bigid]][]=$list;
}
}
switch($met_htmpagename){
case 0:	
//文章模块
    $pagename="news";
	$nowpara="";
if(!isset($dataoptimize[$pagemark][news]))$dataoptimize[$pagemark][news]=$dataoptimize[10000][news];
if($dataoptimize[$pagemark][news]){
	$nowhits="";
	$nowlabel="met_hot";
    $query = "SELECT * FROM $met_news where top_ok='1' order by updatetime desc limit 0, $met_sqlnum";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$filename=$navurl.$class1_list[$list[class1]][foldername];
	$filenamenow="shownews";
    require 'infolist.php';
    }
     
	$nowlabel="";
    $query = "SELECT * FROM $met_news where top_ok='0' order by updatetime desc limit 0, $met_sqlnum";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$filename=$navurl.$class1_list[$list[class1]][foldername];
	$filenamenow="shownews";
    require 'infolist.php';
     }
}

if(!isset($dataoptimize[$pagemark][hitsnews]))$dataoptimize[$pagemark][hitsnews]=$dataoptimize[10000][hitsnews];
if($dataoptimize[$pagemark][hitsnews]){
	$nowlabel="met_hot";
	$nowhits="metinfo";
	$query = "SELECT * FROM $met_news where top_ok='1' order by hits desc limit 0, $met_sqlnum";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$filename=$navurl.$class1_list[$list[class1]][foldername];
	$filenamenow="shownews";;
    require 'infolist.php';
     }
    
	$nowlabel="";
    $query = "SELECT * FROM $met_news where top_ok='0' order by hits desc limit 0, $met_sqlnum";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$filename=$navurl.$class1_list[$list[class1]][foldername];
	$filenamenow="shownews";
    require 'infolist.php';
     }
}

//产品模块
    $pagename="product";
	$nowpara="metinfo";
	$paranum=24;
if(!isset($dataoptimize[$pagemark][product]))$dataoptimize[$pagemark][product]=$dataoptimize[10000][product];
if($dataoptimize[$pagemark][product]){
	$nowlabel="met_hot";
	$nowhits="";
    $query = "SELECT * FROM $met_product where top_ok='1' order by updatetime desc limit 0, $met_sqlnum";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$filename=$navurl.$class1_list[$list[class1]][foldername];
	$filenamenow="showproduct";
    require 'infolist.php';
    }
	   
	$nowlabel="";
    $query = "SELECT * FROM $met_product where top_ok='0' order by updatetime desc limit 0, $met_sqlnum";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$filename=$navurl.$class1_list[$list[class1]][foldername];
	$filenamenow="showproduct";
    require 'infolist.php';
     }
}	
if(!isset($dataoptimize[$pagemark][hitsproduct]))$dataoptimize[$pagemark][product]=$dataoptimize[10000][hitsproduct];
if($dataoptimize[$pagemark][hitsproduct]){ 
	$nowlabel="met_hot";
	$nowhits="metinfo";
	$query = "SELECT * FROM $met_product where top_ok='1' order by hits desc limit 0, $met_sqlnum";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$filename=$navurl.$class1_list[$list[class1]][foldername];
	$filenamenow="showproduct";
    require 'infolist.php';
     }
 
	$nowlabel="";
    $query = "SELECT * FROM $met_product where top_ok='0' order by hits desc limit 0, $met_sqlnum";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$filename=$navurl.$class1_list[$list[class1]][foldername];
	$filenamenow="showproduct";
    require 'infolist.php';
     }
}


//下载模块
    $pagename="download";
	$nowpara="metinfo";
	$paranum=10;
if(!isset($dataoptimize[$pagemark][download]))$dataoptimize[$pagemark][download]=$dataoptimize[10000][download];
if($dataoptimize[$pagemark][download]){
	$nowlabel="met_hot";
	$nowhits="";
    $query = "SELECT * FROM $met_download where top_ok='1' order by updatetime desc limit 0, $met_sqlnum";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$filename=$navurl.$class1_list[$list[class1]][foldername];
	$filenamenow="showdownload";
    require 'infolist.php';
    }
	   
	$nowlabel="";
    $query = "SELECT * FROM $met_download where top_ok='0' order by updatetime desc limit 0, $met_sqlnum";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$filename=$navurl.$class1_list[$list[class1]][foldername];
	$filenamenow="showdownload";
    require 'infolist.php';
     }
}
if(!isset($dataoptimize[$pagemark][hitsdownload]))$dataoptimize[$pagemark][hitsdownload]=$dataoptimize[10000][hitsdownload];
if($dataoptimize[$pagemark][hitsdownload]){	 
	$nowlabel="met_hot";
	$nowhits="metinfo";
	$query = "SELECT * FROM $met_download where top_ok='1' order by hits desc limit 0, $met_sqlnum";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$filename=$navurl.$class1_list[$list[class1]][foldername];
	$filenamenow="showdownload";
    require 'infolist.php';
     }
 
	$nowlabel="";
    $query = "SELECT * FROM $met_download where top_ok='0' order by hits desc limit 0, $met_sqlnum";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$filename=$navurl.$class1_list[$list[class1]][foldername];
	$filenamenow="showdownload";
    require 'infolist.php';
     }
}
//图片模块
    $pagename="img";
	$nowpara="metinfo";
	$paranum=24;
if(!isset($dataoptimize[$pagemark][img]))$dataoptimize[$pagemark][img]=$dataoptimize[10000][img];
if($dataoptimize[$pagemark][img]){	
	$nowlabel="met_hot";
	$nowhits="";
    $query = "SELECT * FROM $met_img where top_ok='1' order by updatetime desc limit 0, $met_sqlnum";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$filename=$navurl.$class1_list[$list[class1]][foldername];
	$filenamenow="showimg";
    require 'infolist.php';
    }
	   
	$nowlabel="";
    $query = "SELECT * FROM $met_img where top_ok='0' order by updatetime desc limit 0, $met_sqlnum";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$filename=$navurl.$class1_list[$list[class1]][foldername];
	$filenamenow="showimg";
    require 'infolist.php';
     }
}
if(!isset($dataoptimize[$pagemark][hitsimg]))$dataoptimize[$pagemark][hitsimg]=$dataoptimize[10000][hitsimg];
if($dataoptimize[$pagemark][hitsimg]){		 
	$nowlabel="met_hot";
	$nowhits="metinfo";
	$query = "SELECT * FROM $met_img where top_ok='1' order by hits desc limit 0, $met_sqlnum";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$filename=$navurl.$class1_list[$list[class1]][foldername];
	$filenamenow="showimg";
    require 'infolist.php';
     }
 
	$nowlabel="";
    $query = "SELECT * FROM $met_img where top_ok='0' order by hits desc limit 0, $met_sqlnum";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$filename=$navurl.$class1_list[$list[class1]][foldername];
	$filenamenow="showimg";
    require 'infolist.php';
     }
}
break;
case 1;
//文章模块

    $pagename="news";
	$nowpara="";
if(!isset($dataoptimize[$pagemark][news]))$dataoptimize[$pagemark][news]=$dataoptimize[10000][news];
if($dataoptimize[$pagemark][news]){
	$nowlabel="met_hot";
    $query = "SELECT * FROM $met_news where top_ok='1' order by updatetime desc limit 0, $met_sqlnum";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$filename=$navurl.$class1_list[$list[class1]][foldername];
	$filenamenow=date('Ymd',strtotime($list[updatetime]));
    require 'infolist.php';
    }
     
	$nowlabel="";
    $query = "SELECT * FROM $met_news where top_ok='0' order by updatetime desc limit 0, $met_sqlnum";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$filename=$navurl.$class1_list[$list[class1]][foldername];
	$filenamenow=date('Ymd',strtotime($list[updatetime]));
    require 'infolist.php';
     }
}
if(!isset($dataoptimize[$pagemark][hitsnews]))$dataoptimize[$pagemark][hitsnews]=$dataoptimize[10000][hitsnews];
if($dataoptimize[$pagemark][hitsnews]){	 
	$nowlabel="met_hot";
	$nowhits="metinfo";
	$query = "SELECT * FROM $met_news where top_ok='1' order by hits desc limit 0, $met_sqlnum";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$filename=$navurl.$class1_list[$list[class1]][foldername];
	$filenamenow=date('Ymd',strtotime($list[updatetime]));
    require 'infolist.php';
     }
    
	$nowlabel="";
    $query = "SELECT * FROM $met_news where top_ok='0' order by hits desc limit 0, $met_sqlnum";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$filename=$navurl.$class1_list[$list[class1]][foldername];
	$filenamenow=date('Ymd',strtotime($list[updatetime]));
    require 'infolist.php';
     }
}
//产品模块
    $pagename="product";
	$nowpara="metinfo";
	$paranum=24;
if(!isset($dataoptimize[$pagemark][product]))$dataoptimize[$pagemark][product]=$dataoptimize[10000][product];
if($dataoptimize[$pagemark][product]){
	$nowlabel="met_hot";
	$nowhits="";
    $query = "SELECT * FROM $met_product where top_ok='1' order by updatetime desc limit 0, $met_sqlnum";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$filename=$navurl.$class1_list[$list[class1]][foldername];
	$filenamenow=date('Ymd',strtotime($list[updatetime]));
    require 'infolist.php';
    }
	   
	$nowlabel="";
    $query = "SELECT * FROM $met_product where top_ok='0' order by updatetime desc limit 0, $met_sqlnum";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$filename=$navurl.$class1_list[$list[class1]][foldername];
	$filenamenow=date('Ymd',strtotime($list[updatetime]));
    require 'infolist.php';
     }
}
if(!isset($dataoptimize[$pagemark][hitsproduct]))$dataoptimize[$pagemark][hitsproduct]=$dataoptimize[10000][hitsproduct];
if($dataoptimize[$pagemark][hitsproduct]){	 
	$nowlabel="met_hot";
	$nowhits="metinfo";
	$query = "SELECT * FROM $met_product where top_ok='1' order by hits desc limit 0, $met_sqlnum";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$filename=$navurl.$class1_list[$list[class1]][foldername];
	$filenamenow=date('Ymd',strtotime($list[updatetime]));
    require 'infolist.php';
     }
 
	$nowlabel="";
    $query = "SELECT * FROM $met_product where top_ok='0' order by hits desc limit 0, $met_sqlnum";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$filename=$navurl.$class1_list[$list[class1]][foldername];
	$filenamenow=date('Ymd',strtotime($list[updatetime]));
    require 'infolist.php';
     }
}
//下载模块
    $pagename="download";
	$nowpara="metinfo";
	$paranum=10;
if(!isset($dataoptimize[$pagemark][download]))$dataoptimize[$pagemark][download]=$dataoptimize[10000][download];
if($dataoptimize[$pagemark][download]){	
	$nowlabel="met_hot";
	$nowhits="";
    $query = "SELECT * FROM $met_download where top_ok='1' order by updatetime desc limit 0, $met_sqlnum";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$filename=$navurl.$class1_list[$list[class1]][foldername];
	$filenamenow=date('Ymd',strtotime($list[updatetime]));
    require 'infolist.php';
    }
	   
	$nowlabel="";
    $query = "SELECT * FROM $met_download where top_ok='0' order by updatetime desc limit 0, $met_sqlnum";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$filename=$navurl.$class1_list[$list[class1]][foldername];
	$filenamenow=date('Ymd',strtotime($list[updatetime]));
    require 'infolist.php';
     }
}
if(!isset($dataoptimize[$pagemark][hitsdownload]))$dataoptimize[$pagemark][hitsdownload]=$dataoptimize[10000][hitsdownload];
if($dataoptimize[$pagemark][hitsdownload]){		 
	$nowlabel="met_hot";
	$nowhits="metinfo";
	$query = "SELECT * FROM $met_download where top_ok='1' order by hits desc limit 0, $met_sqlnum";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$filename=$navurl.$class1_list[$list[class1]][foldername];
	$filenamenow=date('Ymd',strtotime($list[updatetime]));
    require 'infolist.php';
     }
 
	$nowlabel="";
    $query = "SELECT * FROM $met_download where top_ok='0' order by hits desc limit 0, $met_sqlnum";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$filename=$navurl.$class1_list[$list[class1]][foldername];
	$filenamenow=date('Ymd',strtotime($list[updatetime]));
    require 'infolist.php';
     }
}
//图片模块
    $pagename="img";
	$nowpara="metinfo";
	$paranum=24;
if(!isset($dataoptimize[$pagemark][img]))$dataoptimize[$pagemark][img]=$dataoptimize[10000][img];
if($dataoptimize[$pagemark][img]){	
	$nowlabel="met_hot";
	$nowhits="";
    $query = "SELECT * FROM $met_img where top_ok='1' order by updatetime desc limit 0, $met_sqlnum";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$filename=$navurl.$class1_list[$list[class1]][foldername];
	$filenamenow=date('Ymd',strtotime($list[updatetime]));
    require 'infolist.php';
    }
	   
	$nowlabel="";
    $query = "SELECT * FROM $met_img where top_ok='0' order by updatetime desc limit 0, $met_sqlnum";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$filename=$navurl.$class1_list[$list[class1]][foldername];
	$filenamenow=date('Ymd',strtotime($list[updatetime]));
    require 'infolist.php';
     }
}
if(!isset($dataoptimize[$pagemark][hitsimg]))$dataoptimize[$pagemark][hitsimg]=$dataoptimize[10000][hitsimg];
if($dataoptimize[$pagemark][hitsimg]){		 
	$nowlabel="met_hot";
	$nowhits="metinfo";
	$query = "SELECT * FROM $met_img where top_ok='1' order by hits desc limit 0, $met_sqlnum";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$filename=$navurl.$class1_list[$list[class1]][foldername];
	$filenamenow=date('Ymd',strtotime($list[updatetime]));
    require 'infolist.php';
     }
 
	$nowlabel="";
    $query = "SELECT * FROM $met_img where top_ok='0' order by hits desc limit 0, $met_sqlnum";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$filename=$navurl.$class1_list[$list[class1]][foldername];
	$filenamenow=date('Ymd',strtotime($list[updatetime]));
    require 'infolist.php';
     }
}
break;

case 2;
//文章模块
    $pagename="news";
	$nowpara="";
if(!isset($dataoptimize[$pagemark][news]))$dataoptimize[$pagemark][news]=$dataoptimize[10000][news];
if($dataoptimize[$pagemark][news]){
	$nowlabel="met_hot";
    $query = "SELECT * FROM $met_news where top_ok='1' order by updatetime desc limit 0, $met_sqlnum";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$filenamenow=$class1_list[$list[class1]][foldername];
	$filename=$navurl.$class1_list[$list[class1]][foldername];
    require 'infolist.php';
    }
     
	$nowlabel="";
    $query = "SELECT * FROM $met_news where top_ok='0' order by updatetime desc limit 0, $met_sqlnum";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$filenamenow=$class1_list[$list[class1]][foldername];
	$filename=$navurl.$class1_list[$list[class1]][foldername];
    require 'infolist.php';
     }
}
if(!isset($dataoptimize[$pagemark][hitsnews]))$dataoptimize[$pagemark][histnews]=$dataoptimize[10000][hitsnews];
if($dataoptimize[$pagemark][hitsnews]){	 
	$nowlabel="met_hot";
	$nowhits="metinfo";
	$query = "SELECT * FROM $met_news where top_ok='1' order by hits desc limit 0, $met_sqlnum";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$filenamenow=$class1_list[$list[class1]][foldername];
	$filename=$navurl.$class1_list[$list[class1]][foldername];
    require 'infolist.php';
     }
    
	$nowlabel="";
    $query = "SELECT * FROM $met_news where top_ok='0' order by hits desc limit 0, $met_sqlnum";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$filenamenow=$class1_list[$list[class1]][foldername];
	$filename=$navurl.$class1_list[$list[class1]][foldername];
    require 'infolist.php';
     }
}
//产品模块
    $pagename="product";
	$nowpara="metinfo";
	$paranum=24;
if(!isset($dataoptimize[$pagemark][product]))$dataoptimize[$pagemark][product]=$dataoptimize[10000][product];
if($dataoptimize[$pagemark][product]){
	$nowlabel="met_hot";
	$nowhits="";
    $query = "SELECT * FROM $met_product where top_ok='1' order by updatetime desc limit 0, $met_sqlnum";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$filenamenow=$class1_list[$list[class1]][foldername];
	$filename=$navurl.$class1_list[$list[class1]][foldername];
    require 'infolist.php';
    }
	   
	$nowlabel="";
    $query = "SELECT * FROM $met_product where top_ok='0' order by updatetime desc limit 0, $met_sqlnum";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$filenamenow=$class1_list[$list[class1]][foldername];
	$filename=$navurl.$class1_list[$list[class1]][foldername];
    require 'infolist.php';
     }
}
if(!isset($dataoptimize[$pagemark][hitsproduct]))$dataoptimize[$pagemark][hitsproduct]=$dataoptimize[10000][hitsproduct];
if($dataoptimize[$pagemark][hitsproduct]){	 
	$nowlabel="met_hot";
	$nowhits="metinfo";
	$query = "SELECT * FROM $met_product where top_ok='1' order by hits desc limit 0, $met_sqlnum";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$filenamenow=$class1_list[$list[class1]][foldername];
	$filename=$navurl.$class1_list[$list[class1]][foldername];
    require 'infolist.php';
     }
 
	$nowlabel="";
    $query = "SELECT * FROM $met_product where top_ok='0' order by hits desc limit 0, $met_sqlnum";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$filenamenow=$class1_list[$list[class1]][foldername];
	$filename=$navurl.$class1_list[$list[class1]][foldername];
    require 'infolist.php';
     }
}	 
//下载模块
    $pagename="download";
	$nowpara="metinfo";
	$paranum=10;
if(!isset($dataoptimize[$pagemark][download]))$dataoptimize[$pagemark][download]=$dataoptimize[10000][download];
if($dataoptimize[$pagemark][download]){
	$nowlabel="met_hot";
	$nowhits="";
    $query = "SELECT * FROM $met_download where top_ok='1' order by updatetime desc limit 0, $met_sqlnum";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$filenamenow=$class1_list[$list[class1]][foldername];
	$filename=$navurl.$class1_list[$list[class1]][foldername];
    require 'infolist.php';
    }
	   
	$nowlabel="";
    $query = "SELECT * FROM $met_download where top_ok='0' order by updatetime desc limit 0, $met_sqlnum";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$filenamenow=$class1_list[$list[class1]][foldername];
	$filename=$navurl.$class1_list[$list[class1]][foldername];
    require 'infolist.php';
     }
}
if(!isset($dataoptimize[$pagemark][hitsdownload]))$dataoptimize[$pagemark][hitsdownload]=$dataoptimize[10000][hitsdownload];
if($dataoptimize[$pagemark][hitsdownload]){	 
	$nowlabel="met_hot";
	$nowhits="metinfo";
	$query = "SELECT * FROM $met_download where top_ok='1' order by hits desc limit 0, $met_sqlnum";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$filenamenow=$class1_list[$list[class1]][foldername];
	$filename=$navurl.$class1_list[$list[class1]][foldername];
    require 'infolist.php';
     }
 
	$nowlabel="";
    $query = "SELECT * FROM $met_download where top_ok='0' order by hits desc limit 0, $met_sqlnum";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$filenamenow=$class1_list[$list[class1]][foldername];
	$filename=$navurl.$class1_list[$list[class1]][foldername];
    require 'infolist.php';
     }
}
//图片模块
    $pagename="img";
	$nowpara="metinfo";
	$paranum=24;
if(!isset($dataoptimize[$pagemark][img]))$dataoptimize[$pagemark][img]=$dataoptimize[10000][img];
if($dataoptimize[$pagemark][img]){	
	$nowlabel="met_hot";
	$nowhits="";
    $query = "SELECT * FROM $met_img where top_ok='1' order by updatetime desc limit 0, $met_sqlnum";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$filenamenow=$class1_list[$list[class1]][foldername];
	$filename=$navurl.$class1_list[$list[class1]][foldername];
    require 'infolist.php';
    }
	   
	$nowlabel="";
    $query = "SELECT * FROM $met_img where top_ok='0' order by updatetime desc limit 0, $met_sqlnum";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$filenamenow=$class1_list[$list[class1]][foldername];
	$filename=$navurl.$class1_list[$list[class1]][foldername];
    require 'infolist.php';
     }
}
if(!isset($dataoptimize[$pagemark][hitsimg]))$dataoptimize[$pagemark][hitsimg]=$dataoptimize[10000][hitsimg];
if($dataoptimize[$pagemark][hitsimg]){	 
	$nowlabel="met_hot";
	$nowhits="metinfo";
	$query = "SELECT * FROM $met_img where top_ok='1' order by hits desc limit 0, $met_sqlnum";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$filenamenow=$class1_list[$list[class1]][foldername];
	$filename=$navurl.$class1_list[$list[class1]][foldername];
    require 'infolist.php';
     }
 
	$nowlabel="";
    $query = "SELECT * FROM $met_img where top_ok='0' order by hits desc limit 0, $met_sqlnum";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$filenamenow=$class1_list[$list[class1]][foldername];
	$filename=$navurl.$class1_list[$list[class1]][foldername];
    require 'infolist.php';
     }
}
break;
    }

//友情链接	
if(!isset($dataoptimize[$pagemark][link]))$dataoptimize[$pagemark][link]=$dataoptimize[10000][link];
if($dataoptimize[$pagemark][link]){		
    $query = "SELECT * FROM $met_link where show_ok='1' order by orderno desc";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$list[webname]=($lang=="en")?$list[e_webname]:(($lang=="other")?$list[o_webname]:$list[c_webname]);
if($list[webname]<>""){
	$list[info]=($lang=="en")?$list[e_info]:(($lang=="other")?$list[o_info]:$list[c_info]);
	if($list[link_type]=="0"){
	if($list[com_ok]=="1")$link_text_com[]=$list;
	$link_text[]=$list;
	}
	if($list[link_type]=="1"){
	if($list[com_ok]=="1")$link_img_com[]=$list;
	$link_img[]=$list;
	}
	if($list[com_ok]=="1")$link_com[]=$list;
	$link[]=$list;
	}
}
}


if($met_member_use){
if($index!="index"){
$met_js_access="<script language='javascript' src='../include/access.php?metuser=".$metuser."&lang=".$lang."&metaccess=".$metaccess."'></script>";
if(intval($metinfo_member_type)<intval($metaccess)){
    session_unset();
    $_SESSION['metinfo_member_name']=$metinfo_member_name;
    $_SESSION['metinfo_member_pass']=$metinfo_member_pass;
    $_SESSION['metinfo_member_type']=$metinfo_member_type;
    $_SESSION['metinfo_admin_name']=$metinfo_admin_name;
    okinfo('../member/'.$member_index_url,$lang_access);
	}
}
}
$listimg[news]=$listnew[news];
$hitslistimg[news]=$hitslistnew[news];
$classlistimg[news]=$classlistnew[news];
$hitsclasslistimg[news]=$hitsclasslistnew[news];
$cv[c_url]=$met_webhtm?$navurl."job/cv".$met_c_htmtype:$navurl."job/cv.php";
$cv[e_url]=$met_webhtm?$navurl."job/cv".$met_e_htmtype:$navurl."job/cv.php?lang=en";
$cv[o_url]=$met_webhtm?$navurl."job/cv".$met_o_htmtype:$navurl."job/cv.php?lang=other";
if($met_submit_type==1){
   $cv[url]=($lang=="en")?$navurl."job/cv.php?lang=en&selectedjob=":(($lang=="other")?$navurl."job/cv.php?lang=other&selectedjob=":$navurl."job/cv.php?selectedjob=");
   $addfeedback_url=($lang=="en")?$navurl."feedback/index.php?lang=en&title=":(($lang=="other")?$navurl."feedback/index.php?lang=other&title=":$navurl."feedback/index.php?title=");
   }else{
   $cv[url]=($lang=="en")?$cv[e_url]:(($lang=="other")?$cv[o_url]:$cv[c_url]);
   }
$member_indexurl=$navurl."member/".$member_index_url;
$member_registerurl=$navurl."member/".$member_register_url;

# 本程序是一个开源系统,使用时请你仔细阅读使用协议,商业用途请自觉购买商业授权.
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.
?>