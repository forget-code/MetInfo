<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 
require_once '../login/login_check.php';
if($action=="del"){
$allidlist=explode(',',$allid);
foreach($allidlist as $key=>$val){
if($val!=0){
$admin_list2=$db->get_one("SELECT * FROM $met_column WHERE bigclass='$val'");
if($admin_list2){
okinfox('../column/index.php?lang='.$lang,$lang_modBigclass1);
}
}
$admin_list = $db->get_one("SELECT * FROM $met_column WHERE id='$val'");
$classtype="class".$admin_list[classtype];
switch ($admin_list[module]){
case 2:
$listok=$db->get_one("SELECT * FROM $met_news WHERE $classtype='$admin_list[id]'");
if($listok)okinfox('../column/index.php?lang='.$lang,"{$lang_deleteTip1}$admin_list[name]{$lang_deleteTip2}");
break;
case 3:
$listok=$db->get_one("SELECT * FROM $met_product WHERE $classtype='$admin_list[id]'");
if($listok)okinfox('../column/index.php?lang='.$lang,"{$lang_deleteTip1}$admin_list[name]{$lang_deleteTip2}");
$query = "delete from $met_parameter where module='$admin_list[module]' and class1='$admin_list[id]' and lang='$lang'";
$db->query($query);
break;
case 4:
$listok=$db->get_one("SELECT * FROM $met_download WHERE $classtype='$admin_list[id]'");
if($listok)okinfox('../column/index.php?lang='.$lang,"{$lang_deleteTip1}$admin_list[name]{$lang_deleteTip2}");
$query = "delete from $met_parameter where module='$admin_list[module]' and class1='$admin_list[id]' and lang='$lang'";
$db->query($query);
break;
case 5:
$listok=$db->get_one("SELECT * FROM $met_img WHERE $classtype='$admin_list[id]'");
if($listok)okinfox('../column/index.php?lang='.$lang,"{$lang_deleteTip1}$admin_list[name]{$lang_deleteTip2}");
$query = "delete from $met_parameter where module='$admin_list[module]' and class1='$admin_list[id]' and lang='$lang'";
$db->query($query);
break;
case 6:
$listok=$db->get_one("SELECT * FROM $met_job WHERE lang='$lang'");
if($listok)okinfox('../column/index.php?lang='.$lang,"{$lang_deleteTip1}$admin_list[name]{$lang_deleteTip2}");
$query = "delete from $met_parameter where module='$admin_list[module]' and lang='$lang'";
$db->query($query);
break;
case 8:
$query = "delete from $met_parameter where module='$admin_list[module]' and class1='$admin_list[id]' and lang='$lang'";
$db->query($query);
break;
}
$query = "delete from $met_column where id='$val'";
$db->query($query);
$admin_lists = $db->get_one("SELECT * FROM $met_column WHERE foldername='$admin_list[foldername]'");
//delete foldername
if(!$admin_lists[id] && ($admin_list['classtype'] == 1 || $admin_list['releclass'])){
	if($admin_list['foldername']!='' && ($admin_list['module']<6 || $admin_list['module']==8)){
		if(!unkmodule($admin_list['foldername'])){
			$foldername="../../".$admin_list['foldername'];
			if(!deldir($foldername))okinfox('../column/index.php?lang='.$lang,$lang_columntip9);
		}
	}
}
if($met_deleteimg){
file_unlink("../".$admin_list[indeximg]);
file_unlink("../".$admin_list[columnimg]);
}
}
okinfo('../column/index.php?lang='.$lang,20);
}
elseif($action=="editor"){
	$tesumods[6] = 'job';
	$tesumods[7] = 'message';
	$tesumods[9] = 'link';
	$tesumods[10] = 'member';
	$tesumods[11] = 'search';
	$tesumods[12] = 'sitemap';
	$tesumods[100] = 'product';
	$tesumods[101] = 'img';
	$allidlist=explode(',',$allid);
	$adnum = count($allidlist)-1;
	$bigc='';
	for($i=0;$i<$adnum;$i++){
		$name        = 'name_'.$allidlist[$i];        $name        = $$name;
		//$namemark    = 'namemark_'.$allidlist[$i];    $namemark    = $$namemark;
		//$keywords    = 'keywords_'.$allidlist[$i];    $keywords    = $$keywords;
		//$description = 'description_'.$allidlist[$i]; $description = $$description;
		$no_order    = 'no_order_'.$allidlist[$i];    $no_order    = $$no_order;
		//$list_order  = 'list_order_'.$allidlist[$i];  $list_order  = $$list_order;
		//$new_windows = 'new_windows_'.$allidlist[$i]; $new_windows = $$new_windows;
		$bigclass    = 'bigclass_'.$allidlist[$i];    $bigclass    = $$bigclass;		
		//$releclass   = 'releclass_'.$allidlist[$i];   $releclass   = $$releclass;		
		$nav         = 'nav_'.$allidlist[$i];         $nav         = $$nav;		
		//$filename  = 'filename_'.$allidlist[$i];    $filename    = $$filename;
		$foldername  = 'foldername_'.$allidlist[$i];  $foldername  = $$foldername;
		$module      = 'module_'.$allidlist[$i];  	  $module      = $$module;
		$out_url     = 'out_url_'.$allidlist[$i];     $out_url     = $$out_url;
		$if_in       = 'if_in_'.$allidlist[$i];       $if_in       = $$if_in;
 if(!$if_in)$if_in   = $module==999?1:0;
		$index_num   = 'index_num_'.$allidlist[$i];   $index_num   = $$index_num;
		$classtype   = 'classtype_'.$allidlist[$i];   $classtype   = $$classtype;
		$access      = 'access_'.$allidlist[$i];      $access      = $$access;
		//$indeximg    = 'indeximg_'.$allidlist[$i];    $indeximg    = $$indeximg;
		//$columnimg   = 'columnimg_'.$allidlist[$i];   $columnimg   = $$columnimg;
		//$isshow      = 'isshow_'.$allidlist[$i];      $isshow      = $$isshow; 
		$releclass=0;
		$releok=0;
		$releclassok=$db->get_one("SELECT * FROM $met_column WHERE id='$bigclass'");
		if($classtype==2){
			if($module!=$releclassok['module']){
				$releclass=$bigclass;
				if(($module>0 && $module<6) || $module==8)$releok=1;
			}else{
				$foldername=$releclassok['foldername'];
			}
		}
		if($classtype==3)$foldername=$releclassok['foldername'];
		if($module==999)$module=0;
		if(!$if_in)$if_in=0;
		if($if_in==1 && $out_url=="")okinfox('../column/index.php?lang='.$lang,$lang_modOuturl);
		$tpif = is_numeric($allidlist[$i])?1:0;
		if($module>5 && $module!=8)$foldername = $tesumods[$module];
		$sql = $tpif?"id='$allidlist[$i]'":'';
		if($sql!='')$skin_m=$db->get_one("SELECT * FROM $met_column WHERE $sql");
		if($if_in==0){
			$out_url='';

			if($tpif){
				if(!$skin_m){okinfox('../column/index.php?lang='.$lang,$lang_dataerror);}
				$id = $allidlist[$i];
				if($met_member_use)require_once 'check.php';
				if($filename!=''){
				$filenameok = $db->get_one("SELECT * FROM $met_column WHERE filename='$filename'");
				if($filenameok)okinfox('../column/index.php?lang='.$lang,$lang_modFilenameok);
				}
			}else{
				if($foldername==""){okinfox('../column/index.php?lang='.$lang,$lang_modFoldername);}
				if($module==""){okinfox('../column/index.php?lang='.$lang,$lang_modModule);}
				$filedir="../../".$foldername;
				if($module>5 && $module!=8){	
					$modulewy = $db->get_one("SELECT * FROM $met_column WHERE module='$module' and lang='$lang'");
					if($modulewy['id'])okinfox('../column/index.php?lang='.$lang,$lang_modmodulewyok);
				}
				if($bigclass==0 || $releok){
					$folder_m=$db->get_one("SELECT * FROM $met_column WHERE foldername='$foldername' and lang='$lang'");
					if($folder_m){
						if($module<13 && file_exists($filedir))okinfox('../column/index.php?lang='.$lang,$lang_loginSkin);
					}
					if(!$folder_m && file_exists($filedir))$folder_m=1;
					$folder_ms=$db->get_one("SELECT * FROM $met_column WHERE foldername='$foldername' and lang!='$lang'");
					if($folder_ms){
						if($folder_ms['module']!=$module && $module<13)okinfox('../column/index.php?lang='.$lang,$lang_loginSkin);
					}
					if(!file_exists($filedir)){ @mkdir($filedir, 0777); } 		
					if(!file_exists($filedir)){ okinfox('../column/index.php?lang='.$lang,$lang_modFiledir);}
					if(!$folder_m){
						switch($module){
							case 1:
								$oldfile  ="../../about/show.php";   //模块原始文件路径
								$newfile  ="../../".$foldername."/show.php";  //新路径
								$address  ="../about/show.php";		//新文件require_once路径	
								Copyfile($address,$newfile);
							break;
							case 2:
								$oldfile ="../../news/news.php";   
								$newfile ="../../".$foldername."/news.php"; 
								$address ="../news/news.php"; 
								Copyfile($address,$newfile);
								$oldfile ="../../news/shownews.php";   
								$newfile ="../../".$foldername."/shownews.php"; 
								$address  ="../news/shownews.php"; 
								Copyfile($address,$newfile);
							break;
							case 3:
								$oldfile ="../../product/product.php";   
								$newfile ="../../".$foldername."/product.php";  
								$address  ="../product/product.php"; 
								Copyfile($address,$newfile);
								$oldfile ="../../product/showproduct.php";   
								$newfile ="../../".$foldername."/showproduct.php";  
								$address  ="../product/showproduct.php"; 
								Copyfile($address,$newfile);
							break;
							case 4:
								$oldfile ="../../download/download.php";   
								$newfile ="../../".$foldername."/download.php";  
								$address  ="../download/download.php"; 
								Copyfile($address,$newfile);
								$oldfile ="../../download/showdownload.php";   
								$newfile ="../../".$foldername."/showdownload.php";  
								$address  ="../download/showdownload.php"; 
								Copyfile($address,$newfile);
							break;
							case 5:
								$oldfile ="../../img/img.php";   
								$newfile ="../../".$foldername."/img.php";  
								$address  ="../img/img.php"; 
								Copyfile($address,$newfile);
								$oldfile ="../../img/showimg.php";   
								$newfile ="../../".$foldername."/showimg.php";  
								$address  ="../img/showimg.php"; 
								Copyfile($address,$newfile);
							break;
							case 8:
								$oldfile ="../../feedback/uploadfile_save.php";   
								$newfile ="../../".$foldername."/uploadfile_save.php";  
								$address ="../feedback/uploadfile_save.php"; 
								Copyfile($address,$newfile);
								$oldfile ="../../feedback/config_$lang.inc.php";   
								$newfile ="../../".$foldername."/config_$lang.inc.php";  
								if(!file_exists($newfile)){  
									if (!copy($oldfile,$newfile))okinfox('../column/index.php?lang='.$lang,$lang_columntip13);
								}
							break;
						}  
						Copyindx("../../".$foldername."/index.php");
					}  
				}
			}
		}
		$uptp = $tpif?"update":"insert into";
		$upbp = $tpif?"where id='$allidlist[$i]'":"";
		$query="$uptp $met_column set
				name               = '$name',
				out_url            = '$out_url',
				no_order           = '$no_order',
				bigclass           = '$bigclass',
				nav                = '$nav',
				if_in              = '$if_in',
				foldername         = '$foldername',
				module             = '$module',
				index_num          = '$index_num',					  
				classtype          = '$classtype',					  
				releclass          = '$releclass',					  
				access      	   = '$access',
				lang			   = '$lang'
			$upbp";
		$db->query($query);
		$bigc.=$bigclass.',';
	}	
		okinfo('../column/index.php?lang='.$lang.'&bigc='.$bigc,20);
}else{
$admin_list = $db->get_one("SELECT * FROM $met_column WHERE id='$id'");
if(!$admin_list){
okinfox('../column/index.php?lang='.$lang,$lang_dataerror);
}
$classtype="class".$admin_list[classtype];
switch ($admin_list['module']){
case 2:
$listok=$db->get_one("SELECT * FROM $met_news WHERE $classtype='$admin_list[id]'");
if($listok)okinfox('../column/index.php?lang='.$lang,"{$lang_deleteTip1}$admin_list[name]{$lang_deleteTip2}");
break;
case 3:
$listok=$db->get_one("SELECT * FROM $met_product WHERE $classtype='$admin_list[id]'");
if($listok)okinfox('../column/index.php?lang='.$lang,"{$lang_deleteTip1}$admin_list[name]{$lang_deleteTip2}");
break;
case 4:
$listok=$db->get_one("SELECT * FROM $met_download WHERE $classtype='$admin_list[id]'");
if($listok)okinfox('../column/index.php?lang='.$lang,"{$lang_deleteTip1}$admin_list[name]{$lang_deleteTip2}");
break;
case 5:
$listok=$db->get_one("SELECT * FROM $met_img WHERE $classtype='$admin_list[id]'");
if($listok)okinfox('../column/index.php?lang='.$lang,"{$lang_deleteTip1}$admin_list[name]{$lang_deleteTip2}");
break;
case 6:
$listok=$db->get_one("SELECT * FROM $met_job WHERE $classtype='$admin_list[id]'");
if($listok)okinfox('../column/index.php?lang='.$lang,"{$lang_deleteTip1}$admin_list[name]{$lang_deleteTip2}");
break;
}
$admin_list2=$db->get_one("SELECT * FROM $met_column WHERE bigclass='$admin_list[id]'");
if($admin_list2){
okinfox('../column/index.php?lang='.$lang,$lang_modBigclass);
}

$query = "delete from $met_column where id='$id'";
$db->query($query);
$admin_lists = $db->get_one("SELECT * FROM $met_column WHERE foldername='$admin_list[foldername]'");
//delete foldername
if(!$admin_lists[id] && ($admin_list['classtype'] == 1 || $admin_list['releclass'])){
	if($admin_list['foldername']!='' && ($admin_list['module']<6 || $admin_list['module']==8)){
		if(!unkmodule($admin_list['foldername'])){
			$foldername="../../".$admin_list['foldername'];
			if(!deldir($foldername))okinfox('../column/index.php?lang='.$lang,$lang_columntip9);
		}
	}
}
//delete images
if($met_deleteimg){
file_unlink("../".$admin_list['indeximg']);
file_unlink("../".$admin_list['columnimg']);
}
okinfo('../column/index.php?lang='.$lang,20);
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>
