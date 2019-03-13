<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 
set_time_limit(0);
require_once '../login/login_check.php';
if($action=="all"){
	if($htmpack){
		$url.=$_SERVER["PHP_SELF"];
		$mlist = explode('/',$url);
		$mnum = count($mlist)-2;
		$p = '';
		for($i=0;$i<$mnum;$i++){
			$p = '../'.$p;
		}
		$lista = $met_htmpack_url.'templates/'.$met_skin_user.'/images/';
		metnew_dir($lista,$p);
		$lista = $met_htmpack_url.'public/';
		metnew_dir($lista,$p);
		$dira=$p.$met_htmpack_url.'templates/'.$met_skin_user.'/images/';
		$dirb="../../templates/".$met_skin_user.'/images';
		xCopy($dirb,$dira,1);
		$dira=$p.$met_htmpack_url.'upload/';
		$dirb="../../upload/";
		xCopy($dirb,$dira,1);
		$dira=$p.$met_htmpack_url.'public/flash/';
		$dirb="../../public/flash/";
		xCopy($dirb,$dira,1);
		$dira=$p.$met_htmpack_url.'public/images/';
		$dirb="../../public/images/";
		xCopy($dirb,$dira,1);
		$dira=$p.$met_htmpack_url.'public/js/';
		$dirb="../../public/js/";
		xCopy($dirb,$dira,1);
		$dira=$p.$met_htmpack_url.'public/css/';
		$dirb="../../public/css/";
		xCopy($dirb,$dira,1);
		$dira=$p.$met_htmpack_url.'favicon.ico';
		$dirb="../../favicon.ico";
		copy($dirb,$dira);
	}
 indexhtm(1,$htmpack);
//module 1
foreach($met_classindex[1] as $key=>$val){
    if($val[isshow])showhtm($val[id],1,$htmpack);
	foreach($met_class22[$val[id]] as $key=>$val2){
		if($val2[isshow])showhtm($val2[id],1,$htmpack);
		foreach($met_class3[$val2[id]] as $key=>$val3){
			if($val3[isshow])showhtm($val3[id],1,$htmpack);
		}
	}
}
//module 2
foreach($met_classindex[2] as $key=>$val){
     classhtm($val[id],0,0,1,0,$htmpack);
	  foreach($met_class22[$val[id]] as $key=>$val2){
	     classhtm($val[id],$val2[id],0,1,2,$htmpack);
	      foreach($met_class3[$val2[id]] as $key=>$val3){
		   classhtm($val[id],$val2[id],$val3[id],1,3,$htmpack);
	      }
		 }
	$query="select * from $met_news where class1='$val[id]' and lang='$lang'";
	$result= $db->query($query);
	 while($list = $db->fetch_array($result)){
	 contenthtm($val[id],$list[id],'shownews',$list[filename],1,$val[foldername],$list[updatetime],$htmpack);
	}
 }
 //module 3
 foreach($met_classindex[3] as $key=>$val){
     classhtm($val[id],0,0,1,0,$htmpack);
	  foreach($met_class22[$val[id]] as $key=>$val2){
	     classhtm($val[id],$val2[id],0,1,2,$htmpack);
	      foreach($met_class3[$val2[id]] as $key=>$val3){
		   classhtm($val[id],$val2[id],$val3[id],1,3,$htmpack);
	      }
		 }
	$query="select * from $met_product where class1='$val[id]' and lang='$lang'";
	$result= $db->query($query);
	while($list = $db->fetch_array($result)){
	 contenthtm($val[id],$list[id],'showproduct',$list[filename],1,$val[foldername],$list[updatetime],$htmpack);
	}
 }
 
 //module 4
 foreach($met_classindex[4] as $key=>$val){
     classhtm($val[id],0,0,1,0,$htmpack);
	  foreach($met_class22[$val[id]] as $key=>$val2){
	     classhtm($val[id],$val2[id],0,1,2,$htmpack);
	      foreach($met_class3[$val2[id]] as $key=>$val3){
		   classhtm($val[id],$val2[id],$val3[id],1,3,$htmpack);
	      }
		 }
	$query="select * from $met_download where class1='$val[id]' and lang='$lang'";
	$result= $db->query($query);
	 while($list = $db->fetch_array($result)){
	 contenthtm($val[id],$list[id],'showdownload',$list[filename],1,$val[foldername],$list[updatetime],$htmpack);
	}
 }
 
 //module 5
 foreach($met_classindex[5] as $key=>$val){
     classhtm($val[id],0,0,1,0,$htmpack);
	  foreach($met_class22[$val[id]] as $key=>$val2){
	     classhtm($val[id],$val2[id],0,1,2,$htmpack);
	      foreach($met_class3[$val2[id]] as $key=>$val3){
		   classhtm($val[id],$val2[id],$val3[id],1,3,$htmpack);
	      }
		 }
	$query="select * from $met_img where class1='$val[id]' and lang='$lang'";
	$result= $db->query($query);
	 while($list = $db->fetch_array($result)){
	 contenthtm($val[id],$list[id],'showimg',$list[filename],1,$val[foldername],$list[updatetime],$htmpack);
	}
 }

 //module 6
 foreach($met_classindex[6] as $key=>$val){
    classhtm($val[id],0,0,1,0,$htmpack);
	onepagehtm('job','cv',1,$htmpack); 
	$query="select * from $met_job where lang='$lang'";
	$result= $db->query($query);
	 while($list = $db->fetch_array($result)){
	 contenthtm($val[id],$list[id],'showjob',$list[filename],1,$val[foldername],$list[addtime],$htmpack);
	}
 }
 
 //module 7
if(count($met_module[7])){
 foreach($met_module[7] as $key=>$val){
 classhtm($val[id],0,0,1,0,$htmpack);
}
 onepagehtm('message','message',1,$htmpack); 
}

 //module 8
	foreach($met_classindex[8] as $key=>$val){
		onepagehtm($val['foldername'],'index',1,$htmpack,$val['filename'],$val['id']);
	}

 //module 9
if(count($met_module[9])){
onepagehtm('link','index',1,$htmpack);
onepagehtm('link','addlink',1,$htmpack);
}
 //module 10 
if($met_member_use and count($met_module[10])){
onepagehtm('member','index',1,$htmpack);
onepagehtm('member','login',1,$htmpack);
onepagehtm('member','register',1,$htmpack);
}

 //module 12 
if(count($met_module[12])){
onepagehtm('sitemap','sitemap',1,$htmpack);
}
okinfo('htm.php?lang='.$lang,'',$lang_htm);
}elseif($action=='compression'){
            include "pclzip.lib.php";
		    if(!file_exists('../databack/static'))@mkdir ('../databack/static', 0777);  
		    $sqlzip='../databack/static/metinfo_static_'.date('YmdHis',time()).'.zip';
		    $nowpath=explode('/',$_SERVER["PHP_SELF"]);
			$cunt=count($nowpath)-2;
			for($i=0;$i<$cunt;$i++){
				$dian.='../';
			}
			$zipfile=$dian.$met_htmpack_url;
		    $archive = new PclZip($sqlzip);
            $zip_list = $archive->create($zipfile,PCLZIP_OPT_REMOVE_PATH,$zipfile);
            if($zip_list==0){
                die("Error : ".$archive->errorInfo(true));
            }
            okinfo('database.php?action=filedown&lang='.$lang,'',$lang_setdbArchiveOK);
}else{
if($index=="index"){indexhtm(1); okinfo('htm.php?lang='.$lang,'',$lang_htm);}

if($module==1){

    $folder=$met_class[$class1];
	if($folder[isshow])showhtm($class1,1);

foreach($met_class22[$class1] as $key=>$val){
    if($val[isshow])showhtm($val[id],1);
    foreach($met_class3[$val[id]] as $key=>$val1){
    showhtm($val1[id],1);
	 }
}

okinfo('htm.php?lang='.$lang,'',$lang_htm);
}
if($module>=2 && $module<=5){
  if($listall=="all"){
  if($met_class[$class1]['releclass']){
     classhtm($class1,0,0,1);
  }else{
    classhtm($class1,0,0,1);
	  foreach($met_class22[$class1] as $key=>$val){
	     classhtm($class1,$val[id],0,1,2);
	      foreach($met_class3[$val[id]] as $key=>$val3){
		   classhtm($class1,$val[id],$val3[id],1,3);
	      }
		 }
	 }
  }else{
	switch($module){
	case 2:
	$tablename=$met_news;
	$filename='shownews';
	break;
	case 3:
	$tablename=$met_product;
	$filename='showproduct';
	break;
	case 4:
	$tablename=$met_download;
	$filename='showdownload';
	break;
	case 5:
	$tablename=$met_img;
	$filename='showimg';
	break;
	}
    $query="select * from $tablename where class1='$class1'";
	$result= $db->query($query);
	while($list = $db->fetch_array($result)){
	contenthtm($class1,$list[id],$filename,$list[filename],1,$met_class[$class1][foldername],$list[updatetime]);
	}
   }

okinfo('htm.php?lang='.$lang,'',$lang_htm);
}

if($module==6){
if($listall=="all"){
 classhtm($class1,0,0,1);
 }else{
    $query="select * from $met_job where lang='$lang'";
	$result= $db->query($query);
	while($list = $db->fetch_array($result)){
	contenthtm($class1,$list[id],'showjob',$list['filename'],1,'job',$list[addtime]);
	}
	onepagehtm('job','cv',1);
}
	okinfo('htm.php?lang='.$lang,'',$lang_htm);
}

if($module==7){
if($listall=="all"){
 classhtm($class1,0,0,1);
 }else{
 onepagehtm('message','message',1); 
}
okinfo('htm.php?lang='.$lang,'',$lang_htm);
}

if($module==8){
	foreach($met_classindex[8] as $key=>$val){
		if($val['id']==$class1)onepagehtm($val['foldername'],'index',1,$htmpack,$val['filename'],$class1);
	}
	okinfo('htm.php?lang='.$lang,'',$lang_htm);
}

if($module==9){
onepagehtm('link','index',1);
onepagehtm('link','addlink',1);
okinfo('htm.php?lang='.$lang,'',$lang_htm);
}

if($class1=='login'&&$met_member_use!=0){
onepagehtm('member','index',1);
onepagehtm('member','login',1);
onepagehtm('member','register',1);
okinfo('htm.php?lang='.$lang,'',$lang_htm);
}

if($action=='sitemap'){
onepagehtm('sitemap','sitemap',1);
okinfo('htm.php?lang='.$lang,'',$lang_htm);
}
$css_url="../templates/".$met_skin."/css";
$img_url="../templates/".$met_skin."/images";
include template('htm');
footer();
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>