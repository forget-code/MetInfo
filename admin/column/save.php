<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.  
require_once '../login/login_check.php';
if($name=='')okinfo('javascript:history.back();',$lang_js11);
$filename=preg_replace("/\s/","_",trim($filename)); 
$filenameold=preg_replace("/\s/","_",trim($filenameold));
if($if_in==0){
if($bigclass=="0" and $module>5 and $action=="add")$foldername=$foldername1;
if($bigclass!="0"&&$action=="add"){
$foldername=$foldername1;
$module=$module1;
if($module==1){
$filenameok = $db->get_one("SELECT * FROM $met_column WHERE filename='$filename' and lang='$lang'");
if($filenameok){
okinfo('javascript:history.back();',$lang_modFilenameok);
}
}
if($foldername==""){okinfo('javascript:history.back();',$lang_modFoldername);}
if($module==""){okinfo('javascript:history.back();',$lang_modModule);}
}
if($module=="1"&&$filename==""&&$action=="add"){okinfo('javascript:history.back();',$lang_modFilenamenull);}

$filedir="../../".$foldername;  
if(!file_exists($filedir)){ @mkdir ($filedir, 0777); } 
if(!file_exists($filedir)){ okinfo('javascript:history.back();',$lang_modFiledir);}
switch($module){
case 1:
$oldfile      ="../../about/show.php";   
$newfile      ="../../".$foldername."/show.php"; 
if(!file_exists($newfile)){  
if (!copy($oldfile,   $newfile)){okinfo('javascript:history.back();',$lang_modCopyfile);}
}
break;
case 2:
$oldfile      ="../../news/news.php";   
$newfile      ="../../".$foldername."/news.php"; 
if(!file_exists($newfile)){  
if (!copy($oldfile,   $newfile)){okinfo('javascript:history.back();',$lang_modCopyfile);}
}

$oldfile      ="../../news/shownews.php";   
$newfile      ="../../".$foldername."/shownews.php"; 
if(!file_exists($newfile)){  
if (!copy($oldfile,   $newfile)){okinfo('javascript:history.back();',$lang_modCopyfile);}
}
break;
case 3:
$oldfile      ="../../product/product.php";   
$newfile      ="../../".$foldername."/product.php";  
if(!file_exists($newfile)){ 
if (!copy($oldfile,   $newfile)){okinfo('javascript:history.back();',$lang_modCopyfile);}
}
$oldfile      ="../../product/showproduct.php";   
$newfile      ="../../".$foldername."/showproduct.php";  
if(!file_exists($newfile)){ 
if (!copy($oldfile,   $newfile)){okinfo('javascript:history.back();',$lang_modCopyfile);}
}
break;
case 4:
$oldfile      ="../../download/download.php";   
$newfile      ="../../".$foldername."/download.php";  
if(!file_exists($newfile)){ 
if (!copy($oldfile,   $newfile)){okinfo('javascript:history.back();',$lang_modCopyfile);}
}
$oldfile      ="../../download/showdownload.php";   
$newfile      ="../../".$foldername."/showdownload.php";  
if(!file_exists($newfile)){ 
if (!copy($oldfile,   $newfile)){okinfo('javascript:history.back();',$lang_modCopyfile);}
}
break;
case 5:
$oldfile      ="../../img/img.php";   
$newfile      ="../../".$foldername."/img.php";  
if(!file_exists($newfile)){ 
if (!copy($oldfile,   $newfile)){okinfo('javascript:history.back();',$lang_modCopyfile);}
}
$oldfile      ="../../img/showimg.php";   
$newfile      ="../../".$foldername."/showimg.php";  
if(!file_exists($newfile)){ 
if (!copy($oldfile,   $newfile)){okinfo('javascript:history.back();',$lang_modCopyfile);}
}
break;
}  
}

if($releclass){
  $bigclass=$releclass;
  $classtype=2;
  if($met_member_use&&$bigclass&&intval($access)<intval($met_class[$bigclass][access]))$access=$met_class[$bigclass][access];
  }
if($if_in==1 and $out_url=="")okinfo('javascript:history.back();',$lang_modOuturl);

if($action=="add"){
if($if_in==0){
$isshow=$isshow==1?1:0;
$query = "INSERT INTO $met_column SET
                      name               = '$name',
					  namemark           = '$namemark',
					  no_order           = '$no_order',
					  list_order         = '$list_order',
					  new_windows        = '$new_windows',
					  bigclass           = '$bigclass',
					  releclass          = '$releclass',
					  nav                = '$nav',
					  if_in              = '$if_in',
					  filename           = '$filename',
					  foldername         = '$foldername',
					  module             = '$module',
					  index_num          = '$index_num',
					  out_url            = '',
					  classtype          = '$classtype',
					  keywords           = '$keywords', 
					  description        = '$description',
					  access      		 = '$access',
					  indeximg			 = '$indeximg',
					  columnimg			 = '$columnimg',
					  lang			     = '$lang',
					  isshow			 =  $isshow";
         $db->query($query);
echo "<script type='text/javascript'>parent.setCookie('colunmid', 'metinfo'); parent.location.reload();</script>";
}
if($if_in==1){

$query = "INSERT INTO $met_column SET
                      name               = '$name',
                      namemark           = '$namemark',
					  no_order           = '$no_order',
					  new_windows        = '$new_windows',
					  nav                = '$nav',
					  if_in              = '$if_in',
					  foldername         = '',
					  module             = '0',
					  bigclass           = '$bigclass',
					  releclass          = '$releclass',
					  classtype          = '$classtype',
					  index_num          = '$index_num',
					  out_url            = '$out_url',
					  lang			     = '$lang',
					  indeximg			 = '$indeximg',
					  columnimg			 = '$columnimg'";
         $db->query($query);
okinfo('index.php?lang='.$lang,$lang_jsok);
}


}

if($action=="editor"){
$indeximg=($indeximg<>"" or $metadmin[categorymarkimage])?$indeximg:$indeximg1;
$columnimg=($columnimg<>"" or $metadmin[categoryimage])?$columnimg:$columnimg1;
if($if_in==0){
if($releclass==0&&$bigclass&&$module<>$met_class[$bigclass][module]){
   $bigclass=0;
   $classtype=1;
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
					  list_order         = '$list_order',
					  new_windows        = '$new_windows',
					  bigclass           = '$bigclass',
					  releclass          = '$releclass',
					  nav                = '$nav',
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
echo "<script type='text/javascript'>parent.setCookie('colunmid', 'metinfo'); parent.location.reload();</script>";
}
if($if_in==1){
$query = "update $met_column SET 
                      name               = '$name',
					  namemark           = '$namemark',
					  out_url            = '$out_url',
                      no_order           = '$no_order',
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

okinfo('index.php?lang='.$lang,$lang_jsok);
}
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>
