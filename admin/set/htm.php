<?php
# 文件名称:htm.php 2009-08-07 16:01:57
# MetInfo企业网站管理系统 
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn)). All rights reserved.
require_once '../login/login_check.php';
if($met_webhtm!=0){

if($action=="all"){

 indexhtm(1);

    $query="select * from $met_column where bigclass='0' and if_in='0' order by id";
	$result= $db->query($query);
	while($list = $db->fetch_array($result)){
	$class1_list[]=$list;
	}
foreach($class1_list as $key=>$val){
  $class1=$val[id];
 if($val[module]==1){
     $query="select * from $met_column where bigclass='$val[id]'";
	 $result= $db->query($query);
	 $i=0;
	 while($list = $db->fetch_array($result)){
	 $i++;
	 $class_list[]=$list;
	 }
	 if($val[isshow])$class_list[$i]=$val;

     foreach($class_list as $key=>$val1){
     showhtm($val1[id],1);
     }
	 unset($class_list);
     }
 if($val[module]>=2 && $val[module]<=5){
    
    $query="select * from $met_column where module='$val[module]'";
	$result= $db->query($query);
	while($list = $db->fetch_array($result)){
	$class_list[]=$list;
	}
     foreach($class_list as $key=>$val1){
	 switch($val1[classtype]){
	 case 1;
	 if($val1[id]==$class1)listhtm($val1[id],0,0,$val1[foldername],$val1[module],$val1[classtype],1);
	 break;
	 case 2;
	  if($val1[bigclass]==$class1){
	  $class3ok=$class3ok."-".$val1[id]."-";
	  listhtm($val1[bigclass],$val1[id],0,$val1[foldername],$val1[module],$val1[classtype],1);
	  }
	 break;
	 case 3;
	 if(strstr($class3ok,"-".$val1[bigclass]."-"))listhtm($class1,$val1[bigclass],$val1[id],$val1[foldername],$val1[module],$val1[classtype],1);
	 break;
     }}
	 unset($class_list);
	 unset($class3ok);
   
	switch($val[module]){
	case 2;
	$tablename=$met_news;
	$filename='shownews';
	break;
	case 3;
	$tablename=$met_product;
	$filename='showproduct';
	break;
	case 4;
	$tablename=$met_download;
	$filename='showdownload';
	break;
	case 5;
	$tablename=$met_img;
	$filename='showimg';
	break;
	}
    $query="select * from $tablename where class1='$val[id]'";
	$result= $db->query($query);
	while($list = $db->fetch_array($result)){
	$class_list[]=$list;
	}
     foreach($class_list as $key=>$val1){
     contenthtm($val[id],$val1[id],$filename,1,$val[foldername],$val1[updatetime]);
      }
	unset($class_list);
  }

if($val[module]==6){
     classhtm($class1,0,0,1);
    $query="select * from $met_job";
	$result= $db->query($query);
	while($list = $db->fetch_array($result)){
	$class_list[]=$list;
	}
     foreach($class_list as $key=>$val1){
     contenthtm($class1,$val1[id],'showjob',1,'job',$val1[addtime]);
     }
	 onepagehtm('job','cv',1); 
	 unset($class_list);
}

if($val[module]==7){
 classhtm('message',0,0,1);
 onepagehtm('message','message',1); 
}

if($val[module]==8){
 onepagehtm('feedback','index',1);
}

if($val[module]==9){
onepagehtm('link','index',1);
onepagehtm('link','addlink',1);
}

 }
 
if($met_member_use!=0){
onepagehtm('member','index',1);
onepagehtm('member','login',1);
onepagehtm('member','register',1);
}

onepagehtm('sitemap','sitemap',1);

okinfo('htm.php',$lang_htm);

}else{

if($index=="index"){indexhtm(1); okinfo('htm.php',$lang_htm);}

if($module==1){
    $folder=$db->get_one("select * from $met_column where id='$class1'");
    $query="select * from $met_column where bigclass='$class1'";
	$result= $db->query($query);
	$i=0;
	while($list = $db->fetch_array($result)){
	$i++;
	$class_list[]=$list;
	}
	if($folder[isshow])$class_list[$i]=$folder;

foreach($class_list as $key=>$val){
showhtm($val[id],1);
}

okinfo('htm.php',$lang_htm);
}

if($module>=2 && $module<=5){
  if($list=="all"){
    $query="select * from $met_column where module='$module'";
	$result= $db->query($query);
	while($list = $db->fetch_array($result)){
	$class_list[]=$list;
	}
     foreach($class_list as $key=>$val){
	 switch($val[classtype]){
	 case 1;
	 if($val[id]==$class1)listhtm($val[id],0,0,$val[foldername],$val[module],$val[classtype],1);
	 break;
	 case 2;
	  if($val[bigclass]==$class1){
	  $class3ok=$class3ok."-".$val[id]."-";
	  listhtm($val[bigclass],$val[id],0,$val[foldername],$val[module],$val[classtype],1);
	  }
	 break;
	 case 3;
	 if(strstr($class3ok,"-".$val[bigclass]."-"))listhtm($class1,$val[bigclass],$val[id],$val[foldername],$val[module],$val[classtype],1);
	 break;
     }}
  }else{
    $folder=$db->get_one("select * from $met_column where id='$class1'");
	switch($module){
	case 2;
	$tablename=$met_news;
	$filename='shownews';
	break;
	case 3;
	$tablename=$met_product;
	$filename='showproduct';
	break;
	case 4;
	$tablename=$met_download;
	$filename='showdownload';
	break;
	case 5;
	$tablename=$met_img;
	$filename='showimg';
	break;
	}
    $query="select * from $tablename where class1='$class1'";
	$result= $db->query($query);
	while($list = $db->fetch_array($result)){
	$class_list[]=$list;
	}
     foreach($class_list as $key=>$val){
     contenthtm($class1,$val[id],$filename,1,$folder[foldername],$val[updatetime]);
      }
   }
okinfo('htm.php',$lang_htm);
}

if($module==6){
if($list=="all"){
 classhtm($class1,0,0,1);
 }else{
    $query="select * from $met_job";
	$result= $db->query($query);
	while($list = $db->fetch_array($result)){
	$class_list[]=$list;
	}
     foreach($class_list as $key=>$val){
     contenthtm($class1,$val[id],'showjob',1,'job',$val[addtime]);
     }
onepagehtm('job','cv',1);
}
okinfo('htm.php',$lang_htm);
}

if($module==7){
if($list=="all"){
 classhtm('message',0,0,1);
 }else{
 onepagehtm('message','message',1); 
}
okinfo('htm.php',$lang_htm);
}

if($module==8){
 onepagehtm('feedback','index',1);
okinfo('htm.php',$lang_htm);
}

if($module==9){
onepagehtm('link','index',1);
onepagehtm('link','addlink',1);
okinfo('htm.php',$lang_htm);
}

if($class1=='login'&&$met_member_use!=0){
onepagehtm('member','index',1);
onepagehtm('member','login',1);
onepagehtm('member','register',1);
okinfo('htm.php',$lang_htm);
}

if($action=='sitemap'){
onepagehtm('sitemap','sitemap',1);
okinfo('htm.php',$lang_htm);
}

}
$query="select * from $met_column where bigclass='0' and if_in='0' order by no_order";
	$result= $db->query($query);
	while($list = $db->fetch_array($result)){
	$class_list[]=$list;
	}
$css_url="../templates/".$met_skin."/css";
$img_url="../templates/".$met_skin."/images";
include template('htm');
footer();
}else{
okinfo('sethtm.php',$lang_htmIf);
}
# 本程序是一个开源系统,使用时请你仔细阅读使用协议,商业用途请自觉购买商业授权.
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn). All rights reserved.
?>