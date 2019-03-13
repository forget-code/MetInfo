<?php
require_once '../login/login_check.php';
function wapcreatehtm($fromurl,$filename){
		$fromurl .="&metwaphtm=metwaphtm&html_filename=$filename";
		echo "<script language='javascript' src='../../".$fromurl."'></script><br/>";
}
function waphtm($df=0,$id,$tp=0,$module,$type){
	global $db,$met_index_type,$lang,$met_wap_ok;
	global $wap_news_list,$wap_product_list,$wap_download_list,$wap_img_list,$wap_job_list;
	if($id!='index'){
		$fname[1]=array(0=>'about',1=>'about',2=>'');
		$fname[2]=array(0=>'news',1=>'shownews',2=>$wap_news_list);
		$fname[3]=array(0=>'product',1=>'showproduct',2=>$wap_product_list);
		$fname[4]=array(0=>'download',1=>'showdownload',2=>$wap_download_list);
		$fname[5]=array(0=>'img',1=>'showimg',2=>$wap_img_list);
		$fname[6]=array(0=>'job',1=>'showjob',2=>$wap_job_list);
		if($type)$type = $type==1?'class1=':($type==2?'class2=':'class3=');
		$feed = $type?$type.$id:'id='.$id;
		$fromurl="wap/index.php?"."lang=".$lang.'&'.$feed.'&module='.$module;
		if($module!=1 && $type){
			$qtext = $met_wap_ok?"and wap_ok='1'":'';
			$dbname=moduledb($module);
			$mydbtext=" where lang='".$lang."' and $type"."'$id' $qtext";
			$total_count = $db->counter($dbname,$mydbtext, "*");
			$page_count=ceil($total_count/$fname[$module][2]);

			$page_count=$page_count?$page_count:1;
			for($i=1;$i<=$page_count;$i++){
				$fromurl="wap/index.php?lang=".$lang.'&'.$feed.'&module='.$module."&page=".$i;
				$filename=$fname[$module][$tp].$lang.$id."_".$i;
				if($df){
					$dfile = '../../wap/'.$filename.'.html';
					@unlink($dfile);
				}else{
					wapcreatehtm($fromurl,$filename);
				}
			}
		}else{
			$filename=$fname[$module][$tp].$lang.$id;
			if($df){
				$dfile = '../../wap/'.$filename.'.html';
				@unlink($dfile);
			}else{
				wapcreatehtm($fromurl,$filename);
			}
		}
	}else{
		$fromurl="wap/index.php?lang=".$lang;
		$filename="index{$lang}";
		if($met_index_type==$lang)$filename="index";
		if($df){
			$dfile = '../../wap/'.$filename.'.html';
			@unlink($dfile);
		}else{
			wapcreatehtm($fromurl,$filename);
		}
	}
}	
if($action == 'wapall'){
$wapoknow=0;
if($met_wap && $met_wap_ok)$wapoknow=1;
$waphtmok=1;
waphtm($df,'index');
//module 1
foreach($met_classindex[1] as $key=>$val){
if($wapoknow)$waphtmok = $val[wap_ok];
if($waphtmok){
    if($val[isshow])waphtm($df,$val[id],0,1);
	foreach($met_class22[$val[id]] as $key=>$val2){
		if($val2[isshow])waphtm($df,$val2[id],0,1);
		foreach($met_class3[$val2[id]] as $key=>$val3){
			if($val3[isshow])waphtm($df,$val3[id],0,1);
		}
	}
}
}
foreach($met_classindex[2] as $key=>$val){
if($wapoknow)$waphtmok = $val[wap_ok];
if($waphtmok){
	waphtm($df,$val[id],0,2,1);
	foreach($met_class22[$val[id]] as $key=>$val2){
		waphtm($df,$val2[id],0,2,2);
		foreach($met_class3[$val2[id]] as $key=>$val3){
			waphtm($df,$val3[id],0,2,3);
		}
	}
	$qtext = $met_wap_ok?"and wap_ok='1'":'';
	$query="select * from $met_news where class1='$val[id]' and lang='$lang' $qtext";
	$result= $db->query($query);
	while($list = $db->fetch_array($result)){
		waphtm($df,$list[id],1,2);
	}
}
}
foreach($met_classindex[3] as $key=>$val){
if($wapoknow)$waphtmok = $val[wap_ok];
if($waphtmok){
	waphtm($df,$val[id],0,3,1);
	foreach($met_class22[$val[id]] as $key=>$val2){
		waphtm($df,$val2[id],0,3,2);
		foreach($met_class3[$val2[id]] as $key=>$val3){
			waphtm($df,$val3[id],0,3,3);
		}
	}
	$qtext = $met_wap_ok?"and wap_ok='1'":'';
	$query="select * from $met_product where class1='$val[id]' and lang='$lang' $qtext";
	$result= $db->query($query);
	while($list = $db->fetch_array($result)){
		waphtm($df,$list[id],1,3);
	}
}
}
foreach($met_classindex[4] as $key=>$val){
if($wapoknow)$waphtmok = $val[wap_ok];
if($waphtmok){
	waphtm($df,$val[id],0,4,1);
	foreach($met_class22[$val[id]] as $key=>$val2){
		waphtm($df,$val2[id],0,4,2);
		foreach($met_class3[$val2[id]] as $key=>$val3){
			waphtm($df,$val3[id],0,4,3);
		}
	}
	$qtext = $met_wap_ok?"and wap_ok='1'":'';
	$query="select * from $met_download where class1='$val[id]' and lang='$lang' $qtext";
	$result= $db->query($query);
	while($list = $db->fetch_array($result)){
		waphtm($df,$list[id],1,4);
	}
}
}
foreach($met_classindex[5] as $key=>$val){
if($wapoknow)$waphtmok = $val[wap_ok];
if($waphtmok){
	waphtm($df,$val[id],0,5,1);
	foreach($met_class22[$val[id]] as $key=>$val2){
		waphtm($df,$val2[id],0,5,2);
		foreach($met_class3[$val2[id]] as $key=>$val3){
			waphtm($df,$val3[id],0,5,3);
		}
	}
	$qtext = $met_wap_ok?"and wap_ok='1'":'';
	$query="select * from $met_img where class1='$val[id]' and lang='$lang' $qtext";
	$result= $db->query($query);
	while($list = $db->fetch_array($result)){
		waphtm($df,$list[id],1,5);
	}
}
}
foreach($met_classindex[6] as $key=>$val){
if($wapoknow)$waphtmok = $val[wap_ok];
if($waphtmok){
    waphtm($df,$val[id],0,6,1);
	$qtext = $met_wap_ok?"and wap_ok='1'":'';
	$query="select * from $met_job where lang='$lang' $qtext";
	$result= $db->query($query);
	while($list = $db->fetch_array($result)){
		waphtm($df,$list[id],1,6);
	}
}
}
	$url = 'wap.php?lang='.$lang;
    okinfo($url);
}elseif($action == 'modify'){
	if(!$met_wap_tpa)$met_wap_tpa=0;
	if(!$met_wap_tpb)$met_wap_tpb=0;
	if(!$wap_skin_1)$wap_skin_1=0;
	if(!$wap_skin_2)$wap_skin_2=0;
	if(!$wap_skin_3)$wap_skin_3=0;
	require_once 'configwap.php';
	okinfo('wap.php?lang='.$lang);
}else{
	$met_wap1[$met_wap]="checked='checked'";
	$met_waplink1[$met_waplink]="checked='checked'";
	$met_wap_ok1[$met_wap_ok]="checked='checked'";
	$met_wap_tpa1[$met_wap_tpa]="checked='checked'";
	$met_wap_tpb1[$met_wap_tpb]="checked='checked'";
	$wap_skin_1a[$wap_skin_1]="checked='checked'";
	$wap_skin_2a[$wap_skin_2]="checked='checked'";
	$wap_skin_3a[$wap_skin_3]="checked='checked'";
	$webmpa = $_SERVER["PHP_SELF"];
	$webmpa = dirname($webmpa);
	$webmpa = explode('/',$webmpa);
	$wnum = count($webmpa)-2;
	for($i=1;$i<$wnum;$i++){
		$webmp = $i==1?$webmpa[$i]:$webmp.'/'.$webmpa[$i];
	}
	if(substr($webmp,-1,1)!="/")$webmp.="/";
	$webml = 'http://'.$_SERVER['HTTP_HOST'].'/';
	$webwapurl = $webml.$webmp.'wap/';
	$css_url="../templates/".$met_skin."/css";
	$img_url="../templates/".$met_skin."/images";
	include template('wap');
	footer();
}
?>