<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 
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
$metinfoinc=file_exists($navurl."templates/".$met_skin_user.'/metinfo.inc.php')?$navurl."templates/".$met_skin_user.'/metinfo.inc.php':ROOTPATH.'config/metinfo.inc.php';
require_once $metinfoinc;
if($classnow=="")$classnow=$class3?$class3:($class2?$class2:$class1);

$modulename[2]=array(0=>'news',1=>'shownews');
$modulename[3]=array(0=>'product',1=>'showproduct');
$modulename[4]=array(0=>'download',1=>'showdownload');
$modulename[5]=array(0=>'img',1=>'showimg');
$modulename[6]=array(0=>'job',1=>'showjob');
$modulename[7]=array(0=>'message',1=>'index');
$modulename[8]=array(0=>'feedback',1=>'index');	
$modulename[9]=array(0=>'link',1=>'index');	
$modulename[10]=array(0=>'member',1=>'index');	
$modulename[11]=array(0=>'search',1=>'search');	
$modulename[12]=array(0=>'sitemap',1=>'sitemap');	
	
$query="select * from $met_column where lang='$lang' order by no_order";
if($met_member_use==2)$query="select * from $met_column where lang='$lang' and access<=$metinfo_member_type order by no_order";
$result= $db->query($query);
	while($list = $db->fetch_array($result)){
	if($metadmin[categorymarkimage]){
	$list[indeximgarray]=explode("../",$list[indeximg]);
    $list[indeximg]=($index=="index")?$list[indeximgarray][1]:$list[indeximg];
	}
	if($metadmin[categorymage]){
	$list[columnimgarray]=explode("../",$list[columnimg]);
    $list[columnimg]=($index=="index")?$list[columnimgarray][1]:$list[columnimg];
	}
	if($list[releclass]){
	 $urllast="?".$langmark."&class1=".$list[id];
	 $htmlistpre="_";
	}else{
	switch($list[classtype]){
	case 1:
	$urllast="?".$langmark."&class1=".$list[id];
	$htmlistpre="_";
	break;
	case 2:
	$urllast="?".$langmark."&class1=".$list[bigclass]."&class2=".$list[id];
	$htmlistpre="_".$list[bigclass]."_";
	break;
	case 3:
	$urlclass1 = $db->get_one("SELECT * FROM $met_column where id='$list[bigclass]'");
	$urllast="?".$langmark."&class1=".$urlclass1[bigclass]."&class2=".$list[bigclass]."&class3=".$list[id];
	$htmlistpre="_".$urlclass1[bigclass]."_".$list[bigclass]."_";
	break;
	}
	}
	
	switch($list[module]){
	default:
	if($list[filename]<>"" and $metadmin[pagename]){
	$list[url]=($met_webhtm==2)?$list[filename].$htmlistpre.$list[id]."_1".$met_htmtype:$modulename[$list[module]][0].".php".$urllast;
	}else{
	$list[url]=($met_webhtm==2)?(!$met_htmlistname?$modulename[$list[module]][0]:$list[foldername]).$htmlistpre.$list[id]."_1".$met_htmtype:$modulename[$list[module]][0].".php".$urllast;
	}
	break;
	case 0:	
	$list[url]=(strstr($list[out_url],"http://"))?$list[out_url]:$navurl.$list[out_url];
	break;
	case 1:
	if($list[isshow]!=1&&$list[classtype]==1){
	$list[urllabel]="metinfo_url";
	$metinfo_about="metinfo";
	}else{
	$list[url]=$met_webhtm?$list[filename].$met_htmtype:"show.php?".$langmark."&id=".$list[id];
	}
	break;
	case 6:
	if($list[filename]<>"" and $metadmin[pagename]){
	$list[url]=($met_webhtm==2)?$list[filename]."_".$list[id]."_1".$met_htmtype:"job.php?".$langmark;
	}else{
	$list[url]=($met_webhtm==2)?(!$met_htmlistname?"job":$list[foldername])."_".$list[id]."_1".$met_htmtype:"job.php?".$langmark;
	}
	break;
	case 7:
	$list[url]=($met_webhtm==2)?(!$met_htmlistname?"index":$list[foldername])."_list_1".$met_htmtype:"index.php?".$langmark;
	$addmessage_url=$met_webhtm?(!$met_htmlistname?"message":$list[foldername]).$met_htmtype:"message.php?".$langmark;
	$addmessage_url=$navurl.$list[foldername]."/".$addmessage_url;
	break;
	case 8:
	$list[url]=$met_webhtm?"index".$met_htmtype:"index.php?".$langmark;
	$addfeedback_url=$navurl.$list[foldername]."/".$list[url];
	break;
	case 9:
	$list[url]=$met_webhtm?"index".$met_htmtype:"index.php?".$langmark;
	break;
	case 10:
	$list[url]=$met_webhtm?"index".$met_htmtype:"index.php?".$langmark;
	break;
	case 11:
	$list[url]="search.php?".$langmark;
	break;
	case 12:
	$list[url]=$met_webhtm?"sitemap".$met_htmtype:"sitemap.php?".$langmark;
	break;
	case 100:
	if($list[filename]<>"" and $metadmin[pagename]){
	$list[url]=($met_webhtm==2)?$list[filename]."_".$list[id]."_1".$met_htmtype:"product.php?".$langmark;
	}else{
	$list[url]=($met_webhtm==2)?"product_".$list[id]."_1".$met_htmtype:"product.php?".$langmark;
	}
	break;
	case 101:
	if($list[filename]<>"" and $metadmin[pagename]){
	$list[url]=($met_webhtm==2)?$list[filename]."_".$list[id]."_1".$met_htmtype:"img.php?".$langmark;
	}else{
	$list[url]=($met_webhtm==2)?"img_".$list[id]."_1".$met_htmtype:"img.php?".$langmark;
	}
	break;
	}
	$list[url]=$list[module]?$navurl.$list[foldername]."/".$list[url]:$list[url];
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
	   $list[classtype]=$list[releclass]?"class1":"class".$list[classtype];
	   $class_index[$list[index_num]]=$list;
	 }
}

if($metinfo_about=="metinfo"){
  foreach($nav_listall as $key=>$val){
    if($val[urllabel]=="metinfo_url"){
	  foreach($nav_list2[$val[id]] as $key=>$val1){
	  $val[url]=$val1[url];
	  $class_list[$val[id]][url]=$val[url];
	  $class1_list[$val[id]][url]=$val[url];
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

//Standby field 
if(!isset($dataoptimize[$pagemark][otherinfo]))$dataoptimize[$pagemark][otherinfo]=$dataoptimize[10000][otherinfo];
if($dataoptimize[$pagemark][otherinfo]){
$otherinfo = $db->get_one("SELECT * FROM $met_otherinfo where lang='$lang'");
if($index=="index"){
$otherinfo[imgurl1]=explode("../",$otherinfo[imgurl1]);
$otherinfo[imgurl1]=$otherinfo[imgurl1][1];
$otherinfo[imgurl2]=explode("../",$otherinfo[imgurl2]);
$otherinfo[imgurl2]=$otherinfo[imgurl2][1];
}
}

//online
if($met_online_type!==3){
$query="select * from $met_online where lang='$lang' order by no_order";
$result= $db->query($query);
while($list = $db->fetch_array($result)){
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
$query="select * from $met_flash where lang='$lang' and  (module=10000 or module=".$class1." or module=".$class2." or module=".$class3." or module=".$classnow.")  order by no_order";
$result= $db->query($query);
while($list = $db->fetch_array($result)){
if($index=="index"){
$list[img_path_array]=explode("../",$list[img_path]);
$list[img_path]=$list[img_path_array][1];
$list[flash_path_array]=explode("../",$list[flash_path]);
$list[flash_path]=$list[flash_path_array][1];
$list[flash_back_array]=explode("../",$list[flash_back]);
$list[flash_back]=$list[flash_back_array][1];
}
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
$met_flash_imglink=substr($met_flash_imglink, 0, -1);
$met_flash_imgtitle=substr($met_flash_imgtitle, 0, -1);
$met_flashurl=$met_flash_imglink;
$met_flash_xpx=$met_flash_x."px";
$met_flash_ypx=$met_flash_y."px";
}

//parameter
if(!isset($dataoptimize[$pagemark][parameter]))$dataoptimize[$pagemark][parameter]=$dataoptimize[10000][parameter];
if($dataoptimize[$pagemark][parameter]){
$query = "SELECT * FROM $met_parameter where module<6  and lang='$lang' order by no_order";
$result = $db->query($query);
while($list= $db->fetch_array($result)){
  $list[para]="para".$list[id];
  $list[paraname]="para".$list[id]."name";
  $list[mark]=$list[name]; //2.0
  $metpara[$list[id]]=$list;
  if($list[class1]==0 or $list[class1]==$class1){
  switch($list[module]){
  case 3:
  $product_para[]=$list;
  $productpara[$list[type]][]=$list;
  if($list[type]==1 or $list[type]==2 or $list[type]==4 or $list[type]==6)$product_paralist[]=$list;
  //2.0
  if($list[type]==1 or $list[type]==2)$product_para200[]=$list;
  if($list[type]==5)$product_paraimg[]=$list;
  if($list[type]==2)$product_paraselect[]=$list;
  //2.0
  break;
  case 4:
  $download_para[]=$list;
  $downloadpara[$list[type]][]=$list;
  if($list[type]==1 or $list[type]==2 or $list[type]==4 or $list[type]==6)$download_paralist[]=$list;
  //2.0
  if($list[type]==1)$download_para200[]=$list;
  //2.0
  break;
  case 5:
  $img_para[]=$list;
  $imgpara[$list[type]][]=$list;
  if($list[type]==1 or $list[type]==2 or $list[type]==4 or $list[type]==6)$img_paralist[]=$list;
    //2.0
  if($list[type]==1)$img_para200[]=$list;
  if($list[type]==5)$img_paraimg[]=$list;
  if($list[type]==2)$img_paraselect[]=$list;
    //2.0
  break;
  }
  }
  //$met_para[$list[module]][$list[name]]=$list;
}

$query = "SELECT * FROM $met_list where lang='$lang' order by no_order";
$result = $db->query($query);
while($list= $db->fetch_array($result)){
$para_select[$list[bigid]][]=$list;
}
}
if(!isset($dataoptimize[$pagemark][categoryname]))$dataoptimize[$pagemark][categoryname]=$dataoptimize[10000][categoryname];
if(!isset($dataoptimize[$pagemark][para][3]))$dataoptimize[$pagemark][para][3]=$dataoptimize[10000][para][3];
if(!isset($dataoptimize[$pagemark][para][4]))$dataoptimize[$pagemark][para][4]=$dataoptimize[10000][para][4];
if(!isset($dataoptimize[$pagemark][para][5]))$dataoptimize[$pagemark][para][5]=$dataoptimize[10000][para][5];
if($met_member_use==2)$access_sql= " and access<=$metinfo_member_type";
$listitem[news]=" id,title,description,class1,class2,class3,updatetime,filename,access,top_ok,hits,issue,com_ok,img_ok,imgurls";
$listitem[product]=" id,title,description,class1,class2,class3,updatetime,filename,access,top_ok,hits,issue,com_ok,new_ok,imgurls";
$listitem[download]=" id,title,description,class1,class2,class3,updatetime,filename,access,top_ok,hits,issue,com_ok,new_ok,downloadurl,filesize,downloadaccess";
$listitem[img]=" id,title,description,class1,class2,class3,updatetime,filename,access,top_ok,hits,issue,com_ok,new_ok,imgurls";
switch($met_htmpagename){
case 0:	
//news
    $metmodule=2;
    $pagename="news";
	$nowpara="";
if(!isset($dataoptimize[$pagemark][news]))$dataoptimize[$pagemark][news]=$dataoptimize[10000][news];
if($dataoptimize[$pagemark][news]){
	$nowhits="";
	$nowlabel="met_hot";
    $query = "SELECT $listitem[news] FROM $met_news where top_ok='1' and lang='$lang' $access_sql order by updatetime desc limit 0, $met_sqlnum";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$filename=$navurl.$class_list[$list[class1]][foldername];
	$filenamenow="shownews";
    require 'infolist.php';
    }
     
	$nowlabel="";
    $query = "SELECT $listitem[news] FROM $met_news where top_ok='0' and lang='$lang' $access_sql order by updatetime desc limit 0, $met_sqlnum";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$filename=$navurl.$class_list[$list[class1]][foldername];
	$filenamenow="shownews";
    require 'infolist.php';
     }
}

if(!isset($dataoptimize[$pagemark][hitsnews]))$dataoptimize[$pagemark][hitsnews]=$dataoptimize[10000][hitsnews];
if($dataoptimize[$pagemark][hitsnews]){
	$nowlabel="met_hot";
	$nowhits="metinfo";
	$query = "SELECT $listitem[news] FROM $met_news where top_ok='1' and lang='$lang' $access_sql order by hits desc limit 0, $met_sqlnum";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$filename=$navurl.$class_list[$list[class1]][foldername];
	$filenamenow="shownews";;
    require 'infolist.php';
     }
    
	$nowlabel="";
    $query = "SELECT $listitem[news] FROM $met_news where top_ok='0' and lang='$lang' $access_sql order by hits desc limit 0, $met_sqlnum";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$filename=$navurl.$class_list[$list[class1]][foldername];
	$filenamenow="shownews";
    require 'infolist.php';
     }
}
//product
    $metmodule=3;
    $pagename="product";
	$nowpara=$dataoptimize[$pagemark][para][3];
if(!isset($dataoptimize[$pagemark][product]))$dataoptimize[$pagemark][product]=$dataoptimize[10000][product];
if($dataoptimize[$pagemark][product]){
	$nowlabel="met_hot";
	$nowhits="";
    $query = "SELECT $listitem[product] FROM $met_product where top_ok='1' and lang='$lang' $access_sql order by updatetime desc limit 0, $met_sqlnum";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$filename=$navurl.$class_list[$list[class1]][foldername];
	$filenamenow="showproduct";
    require 'infolist.php';
    }
	   
	$nowlabel="";
    $query = "SELECT $listitem[product] FROM $met_product where top_ok='0' and lang='$lang' $access_sql order by updatetime desc limit 0, $met_sqlnum";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$filename=$navurl.$class_list[$list[class1]][foldername];
	$filenamenow="showproduct";
    require 'infolist.php';
     }
}	
if(!isset($dataoptimize[$pagemark][hitsproduct]))$dataoptimize[$pagemark][product]=$dataoptimize[10000][hitsproduct];
if($dataoptimize[$pagemark][hitsproduct]){ 
	$nowlabel="met_hot";
	$nowhits="metinfo";
	$query = "SELECT $listitem[product] FROM $met_product where top_ok='1' and lang='$lang' $access_sql order by hits desc limit 0, $met_sqlnum";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$filename=$navurl.$class_list[$list[class1]][foldername];
	$filenamenow="showproduct";
    require 'infolist.php';
     }
 
	$nowlabel="";
    $query = "SELECT $listitem[product] FROM $met_product where top_ok='0' and lang='$lang' $access_sql order by hits desc limit 0, $met_sqlnum";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$filename=$navurl.$class_list[$list[class1]][foldername];
	$filenamenow="showproduct";
    require 'infolist.php';
     }
}


//download
    $metmodule=4;
    $pagename="download";
	$nowpara=$dataoptimize[$pagemark][para][4];
if(!isset($dataoptimize[$pagemark][download]))$dataoptimize[$pagemark][download]=$dataoptimize[10000][download];
if($dataoptimize[$pagemark][download]){
	$nowlabel="met_hot";
	$nowhits="";
    $query = "SELECT $listitem[download] FROM $met_download where top_ok='1' and lang='$lang' $access_sql order by updatetime desc limit 0, $met_sqlnum";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$filename=$navurl.$class_list[$list[class1]][foldername];
	$filenamenow="showdownload";
    require 'infolist.php';
    }
	   
	$nowlabel="";
    $query = "SELECT $listitem[download] FROM $met_download where top_ok='0' and lang='$lang' $access_sql order by updatetime desc limit 0, $met_sqlnum";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$filename=$navurl.$class_list[$list[class1]][foldername];
	$filenamenow="showdownload";
    require 'infolist.php';
     }
}
if(!isset($dataoptimize[$pagemark][hitsdownload]))$dataoptimize[$pagemark][hitsdownload]=$dataoptimize[10000][hitsdownload];
if($dataoptimize[$pagemark][hitsdownload]){	 
	$nowlabel="met_hot";
	$nowhits="metinfo";
	$query = "SELECT $listitem[download] FROM $met_download where top_ok='1' and lang='$lang' $access_sql order by hits desc limit 0, $met_sqlnum";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$filename=$navurl.$class_list[$list[class1]][foldername];
	$filenamenow="showdownload";
    require 'infolist.php';
     }
 
	$nowlabel="";
    $query = "SELECT $listitem[download] FROM $met_download where top_ok='0' and lang='$lang' $access_sql order by hits desc limit 0, $met_sqlnum";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$filename=$navurl.$class_list[$list[class1]][foldername];
	$filenamenow="showdownload";
    require 'infolist.php';
     }
}
//images
    $metmodule=5;
    $pagename="img";
	$nowpara=$dataoptimize[$pagemark][para][5];
if(!isset($dataoptimize[$pagemark][img]))$dataoptimize[$pagemark][img]=$dataoptimize[10000][img];
if($dataoptimize[$pagemark][img]){	
	$nowlabel="met_hot";
	$nowhits="";
    $query = "SELECT $listitem[img] FROM $met_img where top_ok='1' and lang='$lang' $access_sql order by updatetime desc limit 0, $met_sqlnum";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$filename=$navurl.$class_list[$list[class1]][foldername];
	$filenamenow="showimg";
    require 'infolist.php';
    }
	   
	$nowlabel="";
    $query = "SELECT $listitem[img] FROM $met_img where top_ok='0' and lang='$lang' $access_sql order by updatetime desc limit 0, $met_sqlnum";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$filename=$navurl.$class_list[$list[class1]][foldername];
	$filenamenow="showimg";
    require 'infolist.php';
     }
}
if(!isset($dataoptimize[$pagemark][hitsimg]))$dataoptimize[$pagemark][hitsimg]=$dataoptimize[10000][hitsimg];
if($dataoptimize[$pagemark][hitsimg]){		 
	$nowlabel="met_hot";
	$nowhits="metinfo";
	$query = "SELECT $listitem[img] FROM $met_img where top_ok='1' and lang='$lang' $access_sql order by hits desc limit 0, $met_sqlnum";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$filename=$navurl.$class_list[$list[class1]][foldername];
	$filenamenow="showimg";
    require 'infolist.php';
     }
 
	$nowlabel="";
    $query = "SELECT $listitem[img] FROM $met_img where top_ok='0' and lang='$lang' $access_sql order by hits desc limit 0, $met_sqlnum";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$filename=$navurl.$class_list[$list[class1]][foldername];
	$filenamenow="showimg";
    require 'infolist.php';
     }
}
break;
case 1:
//news
    $metmodule=2;
    $pagename="news";
	$nowpara="";
if(!isset($dataoptimize[$pagemark][news]))$dataoptimize[$pagemark][news]=$dataoptimize[10000][news];
if($dataoptimize[$pagemark][news]){
	$nowlabel="met_hot";
    $query = "SELECT $listitem[news] FROM $met_news where top_ok='1' and lang='$lang' $access_sql order by updatetime desc limit 0, $met_sqlnum";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$filename=$navurl.$class_list[$list[class1]][foldername];
	$filenamenow=date('Ymd',strtotime($list[updatetime]));
    require 'infolist.php';
    }
     
	$nowlabel="";
    $query = "SELECT $listitem[news] FROM $met_news where top_ok='0' and lang='$lang' $access_sql order by updatetime desc limit 0, $met_sqlnum";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$filename=$navurl.$class_list[$list[class1]][foldername];
	$filenamenow=date('Ymd',strtotime($list[updatetime]));
    require 'infolist.php';
     }
}
if(!isset($dataoptimize[$pagemark][hitsnews]))$dataoptimize[$pagemark][hitsnews]=$dataoptimize[10000][hitsnews];
if($dataoptimize[$pagemark][hitsnews]){	 
	$nowlabel="met_hot";
	$nowhits="metinfo";
	$query = "SELECT $listitem[news] FROM $met_news where top_ok='1' and lang='$lang' $access_sql order by hits desc limit 0, $met_sqlnum";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$filename=$navurl.$class_list[$list[class1]][foldername];
	$filenamenow=date('Ymd',strtotime($list[updatetime]));
    require 'infolist.php';
     }
    
	$nowlabel="";
    $query = "SELECT $listitem[news] FROM $met_news where top_ok='0' and lang='$lang' $access_sql order by hits desc limit 0, $met_sqlnum";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$filename=$navurl.$class_list[$list[class1]][foldername];
	$filenamenow=date('Ymd',strtotime($list[updatetime]));
    require 'infolist.php';
     }
}
//product
    $metmodule=3;
    $pagename="product";
	$nowpara=$dataoptimize[$pagemark][para][3];
if(!isset($dataoptimize[$pagemark][product]))$dataoptimize[$pagemark][product]=$dataoptimize[10000][product];
if($dataoptimize[$pagemark][product]){
	$nowlabel="met_hot";
	$nowhits="";
    $query = "SELECT $listitem[product] FROM $met_product where top_ok='1' and lang='$lang' $access_sql order by updatetime desc limit 0, $met_sqlnum";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$filename=$navurl.$class_list[$list[class1]][foldername];
	$filenamenow=date('Ymd',strtotime($list[updatetime]));
    require 'infolist.php';
    }
	   
	$nowlabel="";
    $query = "SELECT $listitem[product] FROM $met_product where top_ok='0' and lang='$lang' $access_sql order by updatetime desc limit 0, $met_sqlnum";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$filename=$navurl.$class_list[$list[class1]][foldername];
	$filenamenow=date('Ymd',strtotime($list[updatetime]));
    require 'infolist.php';
     }
}
if(!isset($dataoptimize[$pagemark][hitsproduct]))$dataoptimize[$pagemark][hitsproduct]=$dataoptimize[10000][hitsproduct];
if($dataoptimize[$pagemark][hitsproduct]){	 
	$nowlabel="met_hot";
	$nowhits="metinfo";
	$query = "SELECT $listitem[product] FROM $met_product where top_ok='1' and lang='$lang' $access_sql order by hits desc limit 0, $met_sqlnum";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$filename=$navurl.$class_list[$list[class1]][foldername];
	$filenamenow=date('Ymd',strtotime($list[updatetime]));
    require 'infolist.php';
     }
 
	$nowlabel="";
    $query = "SELECT $listitem[product] FROM $met_product where top_ok='0' and lang='$lang' $access_sql order by hits desc limit 0, $met_sqlnum";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$filename=$navurl.$class_list[$list[class1]][foldername];
	$filenamenow=date('Ymd',strtotime($list[updatetime]));
    require 'infolist.php';
     }
}
//download
    $metmodule=4;
    $pagename="download";
	$nowpara=$dataoptimize[$pagemark][para][4];
if(!isset($dataoptimize[$pagemark][download]))$dataoptimize[$pagemark][download]=$dataoptimize[10000][download];
if($dataoptimize[$pagemark][download]){	
	$nowlabel="met_hot";
	$nowhits="";
    $query = "SELECT $listitem[download] FROM $met_download where top_ok='1' and lang='$lang' $access_sql order by updatetime desc limit 0, $met_sqlnum";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$filename=$navurl.$class_list[$list[class1]][foldername];
	$filenamenow=date('Ymd',strtotime($list[updatetime]));
    require 'infolist.php';
    }
	   
	$nowlabel="";
    $query = "SELECT $listitem[download] FROM $met_download where top_ok='0' and lang='$lang' $access_sql order by updatetime desc limit 0, $met_sqlnum";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$filename=$navurl.$class_list[$list[class1]][foldername];
	$filenamenow=date('Ymd',strtotime($list[updatetime]));
    require 'infolist.php';
     }
}
if(!isset($dataoptimize[$pagemark][hitsdownload]))$dataoptimize[$pagemark][hitsdownload]=$dataoptimize[10000][hitsdownload];
if($dataoptimize[$pagemark][hitsdownload]){		 
	$nowlabel="met_hot";
	$nowhits="metinfo";
	$query = "SELECT $listitem[download] FROM $met_download where top_ok='1' and lang='$lang' $access_sql order by hits desc limit 0, $met_sqlnum";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$filename=$navurl.$class_list[$list[class1]][foldername];
	$filenamenow=date('Ymd',strtotime($list[updatetime]));
    require 'infolist.php';
     }
 
	$nowlabel="";
    $query = "SELECT $listitem[download] FROM $met_download where top_ok='0' and lang='$lang' $access_sql order by hits desc limit 0, $met_sqlnum";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$filename=$navurl.$class_list[$list[class1]][foldername];
	$filenamenow=date('Ymd',strtotime($list[updatetime]));
    require 'infolist.php';
     }
}
//images
    $metmodule=5;
    $pagename="img";
	$nowpara=$dataoptimize[$pagemark][para][5];
if(!isset($dataoptimize[$pagemark][img]))$dataoptimize[$pagemark][img]=$dataoptimize[10000][img];
if($dataoptimize[$pagemark][img]){	
	$nowlabel="met_hot";
	$nowhits="";
    $query = "SELECT $listitem[img] FROM $met_img where top_ok='1' and lang='$lang' $access_sql order by updatetime desc limit 0, $met_sqlnum";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$filename=$navurl.$class_list[$list[class1]][foldername];
	$filenamenow=date('Ymd',strtotime($list[updatetime]));
    require 'infolist.php';
    }
	   
	$nowlabel="";
    $query = "SELECT $listitem[img] FROM $met_img where top_ok='0' and lang='$lang' $access_sql order by updatetime desc limit 0, $met_sqlnum";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$filename=$navurl.$class_list[$list[class1]][foldername];
	$filenamenow=date('Ymd',strtotime($list[updatetime]));
    require 'infolist.php';
     }
}
if(!isset($dataoptimize[$pagemark][hitsimg]))$dataoptimize[$pagemark][hitsimg]=$dataoptimize[10000][hitsimg];
if($dataoptimize[$pagemark][hitsimg]){		 
	$nowlabel="met_hot";
	$nowhits="metinfo";
	$query = "SELECT $listitem[img] FROM $met_img where top_ok='1' and lang='$lang' $access_sql order by hits desc limit 0, $met_sqlnum";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$filename=$navurl.$class_list[$list[class1]][foldername];
	$filenamenow=date('Ymd',strtotime($list[updatetime]));
    require 'infolist.php';
     }
 
	$nowlabel="";
    $query = "SELECT $listitem[img] FROM $met_img where top_ok='0' and lang='$lang' $access_sql order by hits desc limit 0, $met_sqlnum";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$filename=$navurl.$class_list[$list[class1]][foldername];
	$filenamenow=date('Ymd',strtotime($list[updatetime]));
    require 'infolist.php';
     }
}
break;

case 2:
//news
    $metmodule=2;
    $pagename="news";
	$nowpara="";
if(!isset($dataoptimize[$pagemark][news]))$dataoptimize[$pagemark][news]=$dataoptimize[10000][news];
if($dataoptimize[$pagemark][news]){
	$nowlabel="met_hot";
    $query = "SELECT $listitem[news] FROM $met_news where top_ok='1' and lang='$lang' $access_sql order by updatetime desc limit 0, $met_sqlnum";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$filenamenow=$class_list[$list[class1]][foldername];
	$filename=$navurl.$class_list[$list[class1]][foldername];
    require 'infolist.php';
    }
     
	$nowlabel="";
    $query = "SELECT $listitem[news] FROM $met_news where top_ok='0' and lang='$lang' $access_sql order by updatetime desc limit 0, $met_sqlnum";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$filenamenow=$class_list[$list[class1]][foldername];
	$filename=$navurl.$class_list[$list[class1]][foldername];
    require 'infolist.php';
     }
}
if(!isset($dataoptimize[$pagemark][hitsnews]))$dataoptimize[$pagemark][histnews]=$dataoptimize[10000][hitsnews];
if($dataoptimize[$pagemark][hitsnews]){	 
	$nowlabel="met_hot";
	$nowhits="metinfo";
	$query = "SELECT $listitem[news] FROM $met_news where top_ok='1' and lang='$lang' $access_sql order by hits desc limit 0, $met_sqlnum";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$filenamenow=$class_list[$list[class1]][foldername];
	$filename=$navurl.$class_list[$list[class1]][foldername];
    require 'infolist.php';
     }
    
	$nowlabel="";
    $query = "SELECT $listitem[news] FROM $met_news where top_ok='0' and lang='$lang' $access_sql order by hits desc limit 0, $met_sqlnum";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$filenamenow=$class_list[$list[class1]][foldername];
	$filename=$navurl.$class_list[$list[class1]][foldername];
    require 'infolist.php';
     }
}
//product
    $metmodule=3;
    $pagename="product";
	$nowpara=$dataoptimize[$pagemark][para][3];
if(!isset($dataoptimize[$pagemark][product]))$dataoptimize[$pagemark][product]=$dataoptimize[10000][product];
if($dataoptimize[$pagemark][product]){
	$nowlabel="met_hot";
	$nowhits="";
    $query = "SELECT $listitem[product] FROM $met_product where top_ok='1' and lang='$lang' $access_sql order by updatetime desc limit 0, $met_sqlnum";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$filenamenow=$class_list[$list[class1]][foldername];
	$filename=$navurl.$class_list[$list[class1]][foldername];
    require 'infolist.php';
    }
	   
	$nowlabel="";
    $query = "SELECT $listitem[product] FROM $met_product where top_ok='0' and lang='$lang' $access_sql order by updatetime desc limit 0, $met_sqlnum";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$filenamenow=$class_list[$list[class1]][foldername];
	$filename=$navurl.$class_list[$list[class1]][foldername];
    require 'infolist.php';
     }
}
if(!isset($dataoptimize[$pagemark][hitsproduct]))$dataoptimize[$pagemark][hitsproduct]=$dataoptimize[10000][hitsproduct];
if($dataoptimize[$pagemark][hitsproduct]){	 
	$nowlabel="met_hot";
	$nowhits="metinfo";
	$query = "SELECT $listitem[product] FROM $met_product where top_ok='1' and lang='$lang' $access_sql order by hits desc limit 0, $met_sqlnum";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$filenamenow=$class_list[$list[class1]][foldername];
	$filename=$navurl.$class_list[$list[class1]][foldername];
    require 'infolist.php';
     }
 
	$nowlabel="";
    $query = "SELECT $listitem[product] FROM $met_product where top_ok='0' and lang='$lang' $access_sql order by hits desc limit 0, $met_sqlnum";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$filenamenow=$class_list[$list[class1]][foldername];
	$filename=$navurl.$class_list[$list[class1]][foldername];
    require 'infolist.php';
     }
}	 
//download
    $metmodule=4;
    $pagename="download";
	$nowpara=$dataoptimize[$pagemark][para][4];
if(!isset($dataoptimize[$pagemark][download]))$dataoptimize[$pagemark][download]=$dataoptimize[10000][download];
if($dataoptimize[$pagemark][download]){
	$nowlabel="met_hot";
	$nowhits="";
    $query = "SELECT $listitem[download] FROM $met_download where top_ok='1' and lang='$lang' $access_sql order by updatetime desc limit 0, $met_sqlnum";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$filenamenow=$class_list[$list[class1]][foldername];
	$filename=$navurl.$class_list[$list[class1]][foldername];
    require 'infolist.php';
    }
	   
	$nowlabel="";
    $query = "SELECT $listitem[download] FROM $met_download where top_ok='0' and lang='$lang' $access_sql order by updatetime desc limit 0, $met_sqlnum";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$filenamenow=$class_list[$list[class1]][foldername];
	$filename=$navurl.$class_list[$list[class1]][foldername];
    require 'infolist.php';
     }
}
if(!isset($dataoptimize[$pagemark][hitsdownload]))$dataoptimize[$pagemark][hitsdownload]=$dataoptimize[10000][hitsdownload];
if($dataoptimize[$pagemark][hitsdownload]){	 
	$nowlabel="met_hot";
	$nowhits="metinfo";
	$query = "SELECT $listitem[download] FROM $met_download where top_ok='1' and lang='$lang' $access_sql order by hits desc limit 0, $met_sqlnum";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$filenamenow=$class_list[$list[class1]][foldername];
	$filename=$navurl.$class_list[$list[class1]][foldername];
    require 'infolist.php';
     }
 
	$nowlabel="";
    $query = "SELECT $listitem[download] FROM $met_download where top_ok='0' and lang='$lang' $access_sql order by hits desc limit 0, $met_sqlnum";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$filenamenow=$class_list[$list[class1]][foldername];
	$filename=$navurl.$class_list[$list[class1]][foldername];
    require 'infolist.php';
     }
}
//images
    $metmodule=5;
    $pagename="img";
	$nowpara=$dataoptimize[$pagemark][para][5];
if(!isset($dataoptimize[$pagemark][img]))$dataoptimize[$pagemark][img]=$dataoptimize[10000][img];
if($dataoptimize[$pagemark][img]){	
	$nowlabel="met_hot";
	$nowhits="";
    $query = "SELECT $listitem[img] FROM $met_img where top_ok='1' and lang='$lang' $access_sql order by updatetime desc limit 0, $met_sqlnum";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$filenamenow=$class_list[$list[class1]][foldername];
	$filename=$navurl.$class_list[$list[class1]][foldername];
    require 'infolist.php';
    }
	   
	$nowlabel="";
    $query = "SELECT $listitem[img] FROM $met_img where top_ok='0' and lang='$lang' $access_sql order by updatetime desc limit 0, $met_sqlnum";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$filenamenow=$class_list[$list[class1]][foldername];
	$filename=$navurl.$class_list[$list[class1]][foldername];
    require 'infolist.php';
     }
}
if(!isset($dataoptimize[$pagemark][hitsimg]))$dataoptimize[$pagemark][hitsimg]=$dataoptimize[10000][hitsimg];
if($dataoptimize[$pagemark][hitsimg]){	 
	$nowlabel="met_hot";
	$nowhits="metinfo";
	$query = "SELECT $listitem[img] FROM $met_img where top_ok='1' and lang='$lang' $access_sql order by hits desc limit 0, $met_sqlnum";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$filenamenow=$class_list[$list[class1]][foldername];
	$filename=$navurl.$class_list[$list[class1]][foldername];
    require 'infolist.php';
     }
 
	$nowlabel="";
    $query = "SELECT $listitem[img] FROM $met_img where top_ok='0' and lang='$lang' $access_sql order by hits desc limit 0, $met_sqlnum";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$filenamenow=$class_list[$list[class1]][foldername];
	$filename=$navurl.$class_list[$list[class1]][foldername];
    require 'infolist.php';
     }
}
break;
    }

//friendly link	
if(!isset($dataoptimize[$pagemark][link]))$dataoptimize[$pagemark][link]=$dataoptimize[10000][link];
if($dataoptimize[$pagemark][link]){		
    $query = "SELECT * FROM $met_link where show_ok='1' and lang='$lang' order by orderno desc";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
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


if($met_member_use and $metaccess){
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
$cv[url]=$met_webhtm?$navurl."job/cv".$met_htmtype:$navurl."job/cv.php?".$langmark;
if($met_submit_type==1){
   $cv[url]=$navurl."job/cv.php?".$langmark."&selectedjob=";
   $addfeedback_url=$navurl."feedback/index.php?".$langmark."&title=";
   }
$member_indexurl=$navurl."member/".$member_index_url;
$member_registerurl=$navurl."member/".$member_register_url;
if($class_list[$class_list[$classnow][releclass]][module]>5 and count($nav_list2[$class_list[$classnow][releclass]]))$nav_list2[$class_list[$classnow][releclass]][count($nav_list2[$class_list[$classnow][releclass]])]=$class_list[$class_list[$classnow][releclass]];
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>