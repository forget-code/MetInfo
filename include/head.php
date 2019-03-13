<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 
	$modulename[1] = array(0=>'show',1=>'show');
	$modulename[2] = array(0=>'news',1=>'shownews');
	$modulename[3] = array(0=>'product',1=>'showproduct');
	$modulename[4] = array(0=>'download',1=>'showdownload');
	$modulename[5] = array(0=>'img',1=>'showimg');
	$modulename[6] = array(0=>'job',1=>'showjob');
	$modulename[7] = array(0=>'message',1=>'index');
	$modulename[8] = array(0=>'feedback',1=>'index');	
	$modulename[9] = array(0=>'link',1=>'index');	
	$modulename[10]= array(0=>'member',1=>'index');	
	$modulename[11]= array(0=>'search',1=>'search');	
	$modulename[12]= array(0=>'sitemap',1=>'sitemap');
	$navurl    = $index=='index'?'':'../';
	$class1    = $index=='index'?10001:intval($class1);
	$class2    = $index=='index'?0:intval($class2);
	$class3    = $index=='index'?0:intval($class3);
	$met_logox = explode('../',$met_logo);
	$weburly   = $index=='index'?'':'../';
	$met_logo  = $met_pseudo?$weburly.$met_logox[1]:($index=='index'?$met_logox[1]:$met_logo);
	$skinurl   = 'templates/'.$met_skin_user;
	$css_url   = $weburly.$skinurl.'/css/';
	$img_url   = $weburly.$skinurl.'/images/';
	$met_url   = $weburly.'public/';
	$classnow  = $classnow==''?($class3?$class3:($class2?$class2:$class1)):$classnow;
	$countlang = count($met_langok);
	$class_list[10001]['module'] = 10001;
	$metweburl = ROOTPATH;
	if($met_index_type==$lang)$countlang=1;
	require_once file_exists($navurl.$skinurl.'/metinfo.inc.php')?$navurl.$skinurl.'/metinfo.inc.php':ROOTPATH.'config/metinfo.inc.php';
	$metadmin[pagename]=1;
	require_once ROOTPATH.'include/global/cache.php';
	foreach($cache_column as $key=>$list){	
		$langnums=$countlang;
		require 'global/pseudo.php';
		$nav_listall[]=$list;
	    $class_list[$list['id']]=$list;
		$module_listall[$list['module']][]=$list;
		if($list['classtype']==1){
		    $nav_list_1[]=$list;
			$module_list1[$list['module']][]=$list;
			$class1_list[$list['id']]=$list;
			if($list['module']==2 or $list['module']==3 or $list['module']==4 or $list['module']==5)$nav_search[]=$list; 
		} 
		if($list['classtype']==2){
			$nav_list_2[]=$list;
			$module_list2[$list['module']][]=$list;
			$nav_list2[$list['bigclass']][]=$list;
			$class2_list[$list['id']]=$list;
		}
		if($list['classtype']==3){
			$nav_list_3[]=$list;
			$module_list3[$list['module']][]=$list;
			$nav_list3[$list['bigclass']][]=$list;
			$class3_list[$list['id']]=$list;
		}
		if($list['nav']==1 or $list['nav']==3)$nav_list[]=$list;
		if($list['nav']==2 or $list['nav']==3)$navfoot_list[]=$list;
		if($list['classtype']==1&&$list['module']==1&&$list['isshow']==1){$nav_listabout[]=$list;}
		if($list['index_num']!="" and $list['index_num']!=0){
			$list['classtype']=$list['releclass']?"class1":"class".$list['classtype'];
			$class_index[$list['index_num']]=$list;
		}
	}
	if($metinfo_about2=="metinfo2"){
		foreach($nav_listall as $key=>$val){
			if($val['urllabel2']=="metinfo_url2"){
				foreach($nav_list3[$val['id']] as $key=>$val1){
					$val['url']=$val1['url'];
					$class_list[$val['id']]['url']=$val['url'];
					$class2_list[$val['id']]['url']=$val['url'];
					break;	
				}
			}
			$nav_listall2[]=$val;
			if($val['classtype']==2){
				$nav_list_22[]=$val;
				$nav_list2a[$val['bigclass']][]= $val;
			}
			if($val['nav']==1 or $val['nav']==3)$nav_list2b[]=$val;
			if($val['nav']==2 or $val['nav']==3){$navfoot_list2[]=$val;}
		}
		$nav_listall=$nav_listall2;
		$nav_list_2=$nav_list_22;
		$nav_list2=$nav_list2a;
		$nav_list=$nav_list2b;
		$navfoot_list=$navfoot_list2;
	}
	if($metinfo_about=="metinfo"){
		foreach($nav_listall as $key=>$val){
			if($val['urllabel']=="metinfo_url"){
				foreach($nav_list2[$val['id']] as $key=>$val1){
					$val['url']=$val1['url'];
					$class_list[$val['id']]['url']=$val['url'];
					$class1_list[$val['id']]['url']=$val['url'];
					break;
				}
			}
			$nav_listall1[]=$val;
			if($val['classtype']==1)$nav_list_11[]=$val;
			if($val['nav']==1 or $val['nav']==3)$nav_list1[]=$val;
			if($val['nav']==2 or $val['nav']==3){$navfoot_list1[]=$val;}
		}
		$nav_listall=$nav_listall1;
		$nav_list_1=$nav_list_11;
		$nav_list=$nav_list1;
		$navfoot_list=$navfoot_list1;
	}
	$aboutid=$class1;
	if($class_list[$class1]['module']!=1){
		$aboutid=$class_list[$class1]['releclass'];
	}
	if(count($nav_listabout)){
		$count=count($nav_list2[$aboutid]);
		for($i=0;$i<count($nav_listabout);$i++){
			if($nav_listabout[$i][id]==$aboutid){
				for($k=$count;$k>0;$k--){
					$nav_list2[$aboutid][$k]=$nav_list2[$aboutid][$k-1];
				}
				$nav_list2[$aboutid][0]=$nav_listabout[$i];
			}
		}
	}
    $tempfie=$navurl."templates/".$met_skin_user."/database.inc.php";
    $conffie=$navurl.'config/database.inc.php';
	//$database_fie=file_exists()?$navurl."templates/".$met_skin_user."/database.inc.php":
	require_once file_exists($tempfie)?$tempfie:$conffie;
	$pagemark=$class_list[$classnow]['module'];
//Standby field 
	if(!isset($dataoptimize[$pagemark]['otherinfo']))$dataoptimize[$pagemark]['otherinfo']=$dataoptimize[10000]['otherinfo'];
	if($dataoptimize[$pagemark]['otherinfo']){
	    $otherinfo=met_cache('otherinfo_'.$lang.'.php');
		if(!$otherinfo){
			$otherinfo = $db->get_one("SELECT * FROM $met_otherinfo where lang='$lang'");
			cache_page('otherinfo_'.$lang.'.php',$otherinfo);
		}
		if($index=="index"){
			$otherinfo['imgurl1']=explode("../",$otherinfo['imgurl1']);
			$otherinfo['imgurl1']=$otherinfo['imgurl1'][1];
			$otherinfo['imgurl2']=explode("../",$otherinfo['imgurl2']);
			$otherinfo['imgurl2']=$otherinfo['imgurl2'][1];
		}
	}
//online
	if($met_online_type!==3){
		foreach($cache_online as $key=>$list){
			$online_list[]=$list;
			if($list['qq']!="")$qq_list[]=$list;
			if($list['msn']!="")$msn_list[]=$list;
			if($list['taobao']!="")$taobao_list[]=$list;
			if($list['alibaba']!="")$alibaba_list[]=$list;
			if($list['skype']!="")$skype_list[]=$list;
		}
	}
//Flash
	if(!isset($met_flasharray[$classnow]['type']))$met_flasharray[$classnow]=$met_flasharray[10000];
	if($met_flasharray[$classnow]['type']){
		$query="select * from $met_flash where lang='$lang' and  (module=10000 or module=".$class1." or module=".$class2." or module=".$class3." or module=".$classnow.")  order by no_order";
		$result= $db->query($query);
		while($list = $db->fetch_array($result)){
			if($index=="index"){
				$list['img_path_array']=explode("../",$list['img_path']);
				$list['img_path']=$list['img_path_array'][1];
				$list['flash_path_array']=explode("../",$list['flash_path']);
				$list['flash_path']=$list['flash_path_array'][1];
				$list['flash_back_array']=explode("../",$list['flash_back']);
				$list['flash_back']=$list['flash_back_array'][1];
			}
			$met_flashall[]=$list;
			if($list['flash_path']!=""){
				$met_flashflashall[]=$list; 
				$flash_flash_module[$list['module']]=$list;
			}else{
				$met_flashimgall[]=$list;
				$flash_img_module[$list['module']]=$list;
			}
		}
		if($met_flasharray[$classnow]['type']==2){
			if(count($flash_flash_module[$classnow])==0){
				if($class3<>0){
					if($class2<>0&&count($flash_flash_module[$class2])<>0){
						$flash_nowarray=$flash_flash_module[$class2];
						$met_flash_x=$met_flasharray[$class2]['x'];
						$met_flash_y=$met_flasharray[$class2]['y'];
					}elseif($class1<>0&&count($flash_flash_module[$class1])<>0){
						$flash_nowarray=$flash_flash_module[$class1];
						$met_flash_x=$met_flasharray[$class1]['x'];
						$met_flash_y=$met_flasharray[$class1]['y'];
					}else{
						$flash_nowarray=$flash_flash_module[10000];
						$met_flash_x=$met_flasharray[10000]['x'];
						$met_flash_y=$met_flasharray[10000]['y'];
					}
				}elseif($class2<>0){
					if($class1<>0&&count($flash_flash_module[$class1])<>0){
						$flash_nowarray=$flash_flash_module[$class1];
						$met_flash_x=$met_flasharray[$class1]['x'];
						$met_flash_y=$met_flasharray[$class1]['y'];
					}else{
						$flash_nowarray=$flash_flash_module[10000];
						$met_flash_x=$met_flasharray[10000]['x'];
						$met_flash_y=$met_flasharray[10000]['y'];
					}
				}else{
					$flash_nowarray=$flash_flash_module[10000];
					$met_flash_x=$met_flasharray[10000]['x'];
					$met_flash_y=$met_flasharray[10000]['y'];
				}
			}else{
				$flash_nowarray=$flash_flash_module[$classnow];
				$met_flash_x=$met_flasharray[$classnow]['x'];
				$met_flash_y=$met_flasharray[$classnow]['y'];
			}

			if(count($flash_nowarray)<>0){
				$met_flash_ok=1;
				$met_flash_type=1;
				$met_flash_url=$flash_nowarray['flash_path'];
				$met_e_flash_url=$flash_nowarray['e_flash_path'];
				$met_flash_back=$flash_nowarray['flash_back'];
				$met_e_flash_back=$flash_nowarray['e_flash_back'];
			}
		}elseif($met_flasharray[$classnow][type]==1){
			$met_flash_ok=1;
			$met_flash_type=0;
			foreach($met_flashimgall as $key=>$val){
				if($val['img_path']!=""){
					if($met_flasharray[$classnow]['x']==$val['width'] && $met_flasharray[$classnow]['y']==$val['height']){
						$met_flash_img=$met_flash_img.$val['img_path']."|";
						$met_flash_imglink=$met_flash_imglink.$val['img_link']."|";
						$met_flash_imgtitle=$met_flash_imgtitle.$val['img_title']."|";
						$met_flashimg[]=$val;
					}
				}
			}
			$met_flash_x=$met_flasharray[$classnow]['x'];
			$met_flash_y=$met_flasharray[$classnow]['y'];
		}elseif($met_flasharray[$classnow]['type']==3){
			if(count($flash_img_module[$classnow])){
				$flash_imgone_img=$flash_img_module[$classnow]['img_path'];
				$flash_imgone_url=$flash_img_module[$classnow]['img_link'];
				$flash_imgone_title=$flash_img_module[$classnow]['img_title'];
			}else{
				if($flash_imgone_img==""){
					$flash_imgone_img=$flash_img_module[$class2]['img_path'];
					$flash_imgone_url=$flash_img_module[$class2]['img_link'];
					$flash_imgone_title=$flash_img_module[$class2]['img_title'];
				}
				if($flash_imgone_img==""){
					$flash_imgone_img=$flash_img_module[$class1]['img_path'];
					$flash_imgone_url=$flash_img_module[$class1]['img_link'];
					$flash_imgone_title=$flash_img_module[$class1]['img_title'];
				}
				if($flash_imgone_img==""){
					$flash_imgone_img=$flash_img_module[10000]['img_path'];
					$flash_imgone_url=$flash_img_module[10000]['img_link'];
					$flash_imgone_title=$flash_img_module[10000]['img_title'];
				}
			}
		}elseif($met_flasharray[$classnow]['type']==0){
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
	if(!isset($dataoptimize[$pagemark]['parameter']))$dataoptimize[$pagemark]['parameter']=$dataoptimize[10000]['parameter'];
	if($dataoptimize[$pagemark]['parameter']){
		$query = "SELECT * FROM $met_parameter where module<6  and lang='$lang' order by no_order";
		$result = $db->query($query);
		while($list= $db->fetch_array($result)){
			$list['para']="para".$list['id'];
			$list['paraname']="para".$list['id']."name";
			$metpara[$list['id']]=$list;
			if($list['class1']==0 or $list['class1']==$class1){
				switch($list['module']){
					case 3:
						$product_para[]=$list;
						$productpara[$list['type']][]=$list;
						if($list['type']==1 or $list['type']==2 or $list['type']==4 or $list['type']==6)$product_paralist[]=$list;
						//2.0
						if($list[type]==1 or $list[type]==2)$product_para200[]=$list;
						if($list[type]==5)$product_paraimg[]=$list;
						if($list[type]==2)$product_paraselect[]=$list;
						//2.0
						break;
					case 4:
						$download_para[]=$list;
						$downloadpara[$list['type']][]=$list;
						if($list['type']==1 or $list['type']==2 or $list['type']==4 or $list['type']==6)$download_paralist[]=$list;
						//2.0
						if($list[type]==1)$download_para200[]=$list;
						//2.0
						break;
					case 5:
						$img_para[]=$list;
						$imgpara[$list['type']][]=$list;
						if($list['type']==1 or $list['type']==2 or $list['type']==4 or $list['type']==6)$img_paralist[]=$list;
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
			$para_select[$list['bigid']][]=$list;
		}
	}
	require_once 'global/page.php';
	
	//friendly link	
	if(!isset($dataoptimize[$pagemark]['link']))$dataoptimize[$pagemark]['link']=$dataoptimize[10000]['link'];
if($dataoptimize[$pagemark]['link']){	
    $query = "SELECT * FROM $met_link where show_ok='1' and lang='$lang' order by orderno desc";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	if($index=='index' && strstr($list['weblogo'],"../")){
	$linkweblogo=explode('../',$list['weblogo']);
	$list['weblogo']=$linkweblogo[1];
	}
	if($list['link_type']=="0"){
	if($list['com_ok']=="1")$link_text_com[]=$list;
	$link_text[]=$list;
	}
	if($list['link_type']=="1"){
	if($list['com_ok']=="1")$link_img_com[]=$list;
	$link_img[]=$list;
	}
	if($list['com_ok']=="1")$link_com[]=$list;
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
	$listimg['news']=$listnew['news'];
	$hitslistimg['news']=$hitslistnew['news'];
	$classlistimg['news']=$classlistnew['news'];
	$hitsclasslistimg['news']=$hitsclasslistnew['news'];
	$cv['url']=$met_pseudo?'jobcv-0-'.$lang.'.html':($met_webhtm?$navurl."job/cv".$met_htmtype:$navurl."job/cv.php?".$langmark);
	if($met_submit_type==1){
		$cv['url']=$met_pseudo?'jobcv-0-'.$lang.'.html':$navurl."job/cv.php?".$langmark."&selectedjob=";
		$addfeedback_url=$navurl."feedback/index.php?".$langmark."&title=";
	}
	$member_indexurl=$navurl."member/".$member_index_url;
	$member_registerurl=$navurl."member/".$member_register_url;
	if($class_list[$class_list[$classnow]['releclass']]['module']>5 and count($nav_list2[$class_list[$classnow]['releclass']])){
		$nav_list2[$class_list[$classnow]['releclass']][count($nav_list2[$class_list[$classnow]['releclass']])]=$class_list[$class_list[$classnow]['releclass']];
	}
	if($met_img_style){
		switch($class_list[$classnow]['module']){
			case 2:
				$met_img_x=$met_newsimg_x?$met_newsimg_x:$met_img_x; 
				$met_img_y=$met_newsimg_y?$met_newsimg_y:$met_img_y;
				break;
			case 3:
				$met_img_x=$met_productimg_x?$met_productimg_x:$met_img_x; 
				$met_img_y=$met_productimg_y?$met_productimg_y:$met_img_y;
				break;
			case 5:
				$met_img_x=$met_imgs_x?$met_imgs_x:$met_img_x; 
				$met_img_y=$met_imgs_y?$met_imgs_y:$met_img_y;
				break;
		}
	}
	$navdown=$class1;
	if($class1 == 0 || $class_list[$class1]['na'] == 2 || $class_list[$class1][nav] == 0)$navdown="10001";
	if($class_list[$classnow]['nav'] == 1 || $class_list[$classnow]['nav'] == 3)$navdown=$classnow;
	if($class_list[$classnow]['releclass'])$navdown=$class_list[$classnow]['releclass'];
	if(!$navdown)$navdown=10001;
	$metblank=$met_urlblank?'target="_blank"':'target="_self"';
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>