<?php
# 文件名称:save.php 2009-08-07 08:43:03
# MetInfo企业网站管理系统 
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.
require_once '../login/login_check.php';

if($met_c_lang_ok==1 && $c_name==''){
okinfo('javascript:history.back();',$lang_js11.'['.$met_c_lang.']');
}
if($met_c_lang_ok!=1 && $met_e_lang_ok==1&& $e_name==''){
okinfo('javascript:history.back();',$lang_js11.'['.$met_e_lang.']');
}
if($met_c_lang_ok!=1 && $met_e_lang_ok!=1&& $met_o_lang_ok==1&& $o_name==''){
okinfo('javascript:history.back();',$lang_js11.'['.$met_o_lang.']');
}

if($if_in==0){
if($bigclass!="0"&&$action=="add"){
$foldername=$foldername1;
$module=$module1;
if($module==1){
$filenameok = $db->get_one("SELECT * FROM $met_column WHERE filename='$filename'");
if($filenameok){
okinfo('javascript:history.back();',$lang_modFilenameok);
}
}
if($foldername==""){okinfo('javascript:history.back();',$lang_modFoldername);}
if($module==""){okinfo('javascript:history.back();',$lang_modModule);}
if($module=="1"&&$filename==""){okinfo('javascript:history.back();',$lang_modFilenamenull);}
}

$filedir="../../".$foldername;  
if(!file_exists($filedir)){ @mkdir ($filedir, 0777); } 
if(!file_exists($filedir)){ okinfo('javascript:history.back();',$lang_modFiledir);}
switch($module){
case 1;
$oldfile      ="../../about/show.php";   
$newfile      ="../../".$foldername."/show.php"; 
if(!file_exists($newfile)){  
if (!copy($oldfile,   $newfile)){okinfo('javascript:history.back();',$lang_modCopyfile);}
}
break;
case 2;
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
case 3;
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
case 4;
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
case 5;
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

if($if_in==1 && $met_c_lang_ok==1){
if($c_out_url==""){okinfo('javascript:history.back();',$lang_modOuturl.'['.$met_c_lang.']');}
}
if($if_in==1&& $met_e_lang_ok==1){
if($e_out_url==""){okinfo('javascript:history.back();',$lang_modOuturl.'['.$met_e_lang.']');}
}
if($if_in==1&& $met_o_lang_ok==1){
if($o_out_url==""){okinfo('javascript:history.back();',$lang_modOuturl.'['.$met_o_lang.']');}
}
if($action=="add"){
/*
$c_name_if=$db->get_one("SELECT * FROM $met_column WHERE c_name='$c_name' and bigclass='$bigclass'");
if($c_name_if){
okinfo('javascript:history.back();',$lang_modChname);
}
if($e_name!=""){
$e_name_if=$db->get_one("SELECT * FROM $met_column WHERE e_name='$e_name' and bigclass='$bigclass'");
if($e_name_if){okinfo('javascript:history.back();',$lang_modeEnName);}
}*/

if($if_in==0){
$isshow=$isshow==1?1:0;

$query = "INSERT INTO $met_column SET
                      c_name             = '$c_name',
                      e_name             = '$e_name',
					  o_name             = '$o_name',
					  no_order           = '$no_order',
					  list_order         = '$list_order',
					  new_windows        = '$new_windows',
					  bigclass           = '$bigclass',
					  nav                = '$nav',
					  if_in              = '$if_in',
					  filename           = '$filename',
					  foldername         = '$foldername',
					  module             = '$module',
					  index_num          = '$index_num',
					  c_out_url          = '',
					  e_out_url          = '',
					  o_out_url          = '',
					  classtype          = '$classtype',
					  c_keywords         = '$c_keywords',
					  e_keywords         = '$e_keywords',
					  o_keywords         = '$e_keywords',
					  c_description      = '$c_description',
					  e_description      = '$e_description',
					  o_description      = '$o_description',
					  access      		 = '$access',
					  indeximg			 = '$indeximg',
					  columnimg			 = '$columnimg',
					  isshow			 =  $isshow";
         $db->query($query);
echo "<script type='text/javascript'>parent.setCookie('colunmid', 'metinfo'); parent.location.reload();</script>";
//okinfo('index.php',$lang_loginUserAdmin);
}
if($if_in==1){

$query = "INSERT INTO $met_column SET
                      c_name             = '$c_name',
                      e_name             = '$e_name',
					  o_name             = '$o_name',
					  no_order           = '$no_order',
					  new_windows        = '$new_windows',
					  nav                = '$nav',
					  if_in              = '$if_in',
					  foldername         = '',
					  module             = '0',
					  bigclass           = '$bigclass',
					  classtype          = '$classtype',
					  index_num          = '$index_num',
					  c_out_url          = '$c_out_url',
					  e_out_url          = '$e_out_url',
					  o_out_url          = '$o_out_url',
					  indeximg			 = '$indeximg',
					  columnimg			 = '$columnimg'";
         $db->query($query);
okinfo('index.php',$lang_loginUserAdmin);
}


}

if($action=="editor"){
if($if_in==0){
require_once 'check.php';

$isshow=$isshow==1?1:0;
$query = "update $met_column SET ";
if($met_c_lang_ok==1){
     $query =$query. "c_name             = '$c_name',
					  c_out_url          = '',
					  c_keywords         = '$c_keywords',
					  c_description      = '$c_description',";
}
if($met_e_lang_ok==1){
     $query =$query. "e_name             = '$e_name',
					  e_out_url          = '',
					  e_keywords         = '$e_keywords',
					  e_description      = '$e_description',";
}
if($met_o_lang_ok==1){
     $query =$query. "o_name             = '$o_name',
					  o_out_url          = '',
					  o_keywords         = '$o_keywords',
					  o_description      = '$o_description',";
}
 $query =$query.     "no_order           = '$no_order',
					  list_order         = '$list_order',
					  new_windows        = '$new_windows',
					  bigclass           = '$bigclass',
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
					  isshow			 =  $isshow
					  where id='$id'"; 

$db->query($query);
echo "<script type='text/javascript'>parent.setCookie('colunmid', 'metinfo'); parent.location.reload();</script>";
//okinfo('index.php',$lang_loginUserAdmin);
}
if($if_in==1){
$query = "update $met_column SET ";
if($met_c_lang_ok==1){
     $query =$query. "c_name             = '$c_name',
					  c_out_url          = '$c_out_url',";
}
if($met_e_lang_ok==1){
     $query =$query. "e_name             = '$e_name',
					  e_out_url          = '$e_out_url',";
}
if($met_o_lang_ok==1){
     $query =$query. "o_name             = '$o_name',
					  o_out_url          = '$o_out_url',";
}
 $query =$query.     "no_order           = '$no_order',
					  new_windows        = '$new_windows',
					  bigclass           = '$bigclass',
					  nav                = '$nav',
					  if_in              = '$if_in',
					  foldername         = '$foldername',
					  module             = '$module',
					  index_num          = '$index_num',					  
					  classtype          = '$classtype',
					  indeximg			 = '$indeximg',
					  columnimg			 = '$columnimg'
					  where id='$id'"; 
 $db->query($query);

okinfo('index.php',$lang_loginUserAdmin);
}
}
# 本程序是一个开源系统,使用时请你仔细阅读使用协议,商业用途请自觉购买商业授权.
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.
?>
