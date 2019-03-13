<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.  
require_once '../login/login_check.php';
    if($name=='')okinfox('../column/index.php?lang='.$lang,$lang_js11);
    $filename=preg_replace("/\s/","_",trim($filename)); 
    $filenameold=preg_replace("/\s/","_",trim($filenameold));
    if($if_in==0){
		if($filename!='' && $filename!=$filenameold){
			$filenameok = $db->get_one("SELECT * FROM $met_column WHERE filename='$filename'");
			if($filenameok)okinfox('../column/editor.php?lang='.$lang.'&id='.$id,$lang_modFilenameok);
		}
		$filedir="../../".$foldername;  
		if(!file_exists($filedir)){ @mkdir ($filedir, 0777); } 
		if(!file_exists($filedir)){ okinfox('../column/editor.php?lang='.$lang.'&id='.$id,$lang_modFiledir);}
		switch($module){
			case 1:
				$oldfile  ="../../about/show.php";   
				$newfile  ="../../".$foldername."/show.php";  
				$address  ="../about/show.php";			
				Copyfile($address,$newfile);
			break;
			case 2:
				$oldfile ="../../news/news.php";   
				$newfile ="../../".$foldername."/news.php"; 
				$address  ="../news/news.php"; 
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
				$oldfile ="../../feedback/index.php";   
				$newfile ="../../".$foldername."/index.php";  
				$address  ="../feedback/index.php"; 
				Copyfile($address,$newfile);
				$oldfile ="../../feedback/uploadfile_save.php";   
				$newfile ="../../".$foldername."/uploadfile_save.php";  
				$address  ="../feedback/uploadfile_save.php"; 
				Copyfile($address,$newfile);
				$oldfile ="../../feedback/config_$lang.inc.php";   
				$newfile ="../../".$foldername."/config_$lang.inc.php";  
				if(!file_exists($newfile)){  
					if (!copy($oldfile,$newfile))okinfox('../column/index.php?lang='.$lang,$lang_columntip13);
				}
			break;
		}   
		if($module!=8)Copyindx("../../".$foldername."/index.php");
	}
	if($releclass){
		$bigclass=$releclass;
		$classtype=2;
		if($met_member_use&&$bigclass&&intval($access)<intval($met_class[$bigclass][access]))$access=$met_class[$bigclass][access];
	}
	if($if_in==1 and $out_url=="")okinfox('../column/index.php?lang='.$lang,$lang_modOuturl);
	if($action=="editor"){
		$indeximg=($indeximg<>"" or $metadmin[categorymarkimage])?$indeximg:$indeximg1;
		$columnimg=($columnimg<>"" or $metadmin[categoryimage])?$columnimg:$columnimg1;
		if($if_in==0){
			if($releclass==0&&$bigclass&&$module<>$met_class[$bigclass][module]){
				$bigclass=0;
				$classtype=1;
			}
			if($shiftok){
				$bigtype=$classtype;
				$shifttype=$shiftclass1?'1':($shiftclass2?'2':'');
				switch($shifttype){
					case '1':
						$classtype='2';
						$bigclass=$shiftclass1;
					break;
					case '2':
						$classtype='3';
						$bigclass=$shiftclass2;
					break;
				}
				switch($bigtype){
					case '1':
						switch($shifttype){
							case '1':
								if(count($met_class2[$id])>0){
									for($i=0;$i<=count($met_class2[$id]);$i++){
										if(count($met_class3[$met_class2[$id][$i][id]])>0){
											okinfox('../column/index.php?lang='.$lang,$lang_js34);
											break;
										}
										$classa=$met_class2[$id][$i][id];
										$query = "update $met_product SET";
										$query = $query."
												class1 = '$bigclass',
												class2 = '$id',
												class3 = '$classa'";
										$query = $query."where class2='$classa'";
										$db->query($query);
									}
									$query1 = "update $met_column SET";
									$query1 = $query1."
											classtype = '3'";
									$query1 = $query1."where bigclass='$id'";
									$db->query($query1);
								}else{
									$query = "update $met_product SET";
									$query = $query."
											class1 = '$bigclass',
											class2 = '$id'";
									$query = $query."where class1='$id'";
									$db->query($query);
								}
							break;
							case '2':
								if(count($met_class2[$id])>0){
									okinfox('../column/index.php?lang='.$lang,$lang_js34);
									break;
								}
								$classa=$met_class21[$bigclass][bigclass];
								$query = "update $met_product SET";
								$query = $query."
										class1 = '$classa',
										class2 = '$bigclass',
										class3 = '$id'";
								$query = $query."where class1='$id'";
								$db->query($query);
							break;
						}
					break;
					case '2':  
					break;
					case '3':
					break;
				}
			}
			if($met_member_use)require_once 'check.php';
			$isshow=$isshow==1?1:0;
			$query = "update $met_column SET 
                      name               = '$name',
	                  namemark           = '$namemark',
					  out_url            = '',
					  keywords           = '$keywords',
					  description        = '$description',
                      no_order           = '$no_order',
                      wap_ok             = '$wap_ok',
					  list_order         = '$list_order',
					  new_windows        = '$new_windows',
					  bigclass           = '$bigclass',
					  releclass          = '$releclass',
					  nav                = '$nav',
					  ctitle             = '$ctitle',
					  if_in              = '$if_in',
					  filename           = '$filename',
					  foldername         = '$foldername',
					  module             = '$module',
					  index_num          = '$index_num',					  
					  classtype          = '$classtype',					  
					  access      		 = '$access',
					  indeximg			 = '$indeximg',
					  columnimg			 = '$columnimg',
					  lang			     = '$lang',
					  isshow			 =  $isshow
					  where id='$id'"; 
			$db->query($query);
			okinfo('../column/index.php?lang='.$lang,20);
		}
		if($if_in==1){
			$query = "update $met_column SET 
                      name               = '$name',
					  namemark           = '$namemark',
					  out_url            = '$out_url',
                      no_order           = '$no_order',
                      wap_ok             = '$wap_ok',
					  new_windows        = '$new_windows',
					  bigclass           = '$bigclass',
					  releclass          = '$releclass',
					  nav                = '$nav',
					  if_in              = '$if_in',
					  foldername         = '$foldername',
					  module             = '$module',
					  index_num          = '$index_num',					  
					  classtype          = '$classtype',
					  indeximg			 = '$indeximg',
					  lang			     = '$lang',
					  columnimg			 = '$columnimg'
					  where id='$id'"; 
			$db->query($query);
			okinfo('../column/index.php?lang='.$lang,20);
		}
	}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>
