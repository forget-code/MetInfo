<?php
require_once '../login/login_check.php';
if($if_in==0){
if($bigclass!="0"&&$action=="add"){
$foldername=$foldername1;
$module=$module1;
if($module==1){
$filenameok = $db->get_one("SELECT * FROM $met_column WHERE filename='$filename'");
if($filenameok){
okinfo('javascript:history.back();',$lang[filenameok]);
}
}
if($foldername==""){okinfo('javascript:history.back();',$lang[foldername]);}
if($module==""){okinfo('javascript:history.back();',$lang[module]);}
if($module=="1"&&$filename==""){okinfo('javascript:history.back();',$lang[filenamenull]);}
}

$filedir="../../".$foldername;  
if(!file_exists($filedir)){ @mkdir ($filedir, 0777); } 
if(!file_exists($filedir)){ okinfo('javascript:history.back();',$lang[filedir]);}
switch($module){
case 1;
$oldfile      ="../../about/show.php";   
$newfile      ="../../".$foldername."/show.php"; 
if(!file_exists($newfile)){  
if (!copy($oldfile,   $newfile)){okinfo('javascript:history.back();',$lang[copyfile]);}
}
break;
case 2;
$oldfile      ="../../news/news.php";   
$newfile      ="../../".$foldername."/news.php"; 
if(!file_exists($newfile)){  
if (!copy($oldfile,   $newfile)){okinfo('javascript:history.back();',$lang[copyfile]);}
}

$oldfile      ="../../news/shownews.php";   
$newfile      ="../../".$foldername."/shownews.php"; 
if(!file_exists($newfile)){  
if (!copy($oldfile,   $newfile)){okinfo('javascript:history.back();',$lang[copyfile]);}
}
break;
case 3;
$oldfile      ="../../product/product.php";   
$newfile      ="../../".$foldername."/product.php";  
if(!file_exists($newfile)){ 
if (!copy($oldfile,   $newfile)){okinfo('javascript:history.back();',$lang[copyfile]);}
}
$oldfile      ="../../product/showproduct.php";   
$newfile      ="../../".$foldername."/showproduct.php";  
if(!file_exists($newfile)){ 
if (!copy($oldfile,   $newfile)){okinfo('javascript:history.back();',$lang[copyfile]);}
}
break;
case 4;
$oldfile      ="../../download/download.php";   
$newfile      ="../../".$foldername."/download.php";  
if(!file_exists($newfile)){ 
if (!copy($oldfile,   $newfile)){okinfo('javascript:history.back();',$lang[copyfile]);}
}
$oldfile      ="../../download/showdownload.php";   
$newfile      ="../../".$foldername."/showdownload.php";  
if(!file_exists($newfile)){ 
if (!copy($oldfile,   $newfile)){okinfo('javascript:history.back();',$lang[copyfile]);}
}
break;
case 5;
$oldfile      ="../../img/img.php";   
$newfile      ="../../".$foldername."/img.php";  
if(!file_exists($newfile)){ 
if (!copy($oldfile,   $newfile)){okinfo('javascript:history.back();',$lang[copyfile]);}
}
$oldfile      ="../../img/showimg.php";   
$newfile      ="../../".$foldername."/showimg.php";  
if(!file_exists($newfile)){ 
if (!copy($oldfile,   $newfile)){okinfo('javascript:history.back();',$lang[copyfile]);}
}
break;
}
   
}

if($if_in==1){
if($c_out_url==""){okinfo('javascript:history.back();',$lang[out_url ]);}
}
if($if_in==1&&met_en_lang==1){
if($e_out_url==""){okinfo('javascript:history.back();',$lang[out_url ]);}
}
if($action=="add"){
$c_name_if=$db->get_one("SELECT * FROM $met_column WHERE c_name='$c_name'");
if($c_name_if){
okinfo('javascript:history.back();',$lang[c_name]);
}
if($e_name!=""){
$e_name_if=$db->get_one("SELECT * FROM $met_column WHERE e_name='$e_name'");
if($e_name_if){okinfo('javascript:history.back();',$lang[e_name]);}
}
if($if_in==0){

$query = "INSERT INTO $met_column SET
                      c_name             = '$c_name',
                      e_name             = '$e_name',
					  no_order           = '$no_order',
					  list_order         = '$list_order',
					  new_windows        = '$new_windows',
					  bigclass           = '$bigclass',
					  nav                = '$nav',
					  if_in              = '$if_in',
					  filename           = '$filename',
					  foldername         = '$foldername',
					  module             = '$module',
					  c_out_url          = '',
					  e_out_url          = '',
					  classtype          = '$classtype',
					  c_keywords         = '$c_keywords',
					  e_keywords         = '$e_keywords',
					  c_description      = '$c_description',
					  e_description      = '$e_description'";
         $db->query($query);
okinfo('index.php',$lang[user_admin]);
}
if($if_in==1){

$query = "INSERT INTO $met_column SET
                      c_name             = '$c_name',
                      e_name             = '$e_name',
					  no_order           = '$no_order',
					  new_windows        = '$new_windows',
					  nav                = '$nav',
					  if_in              = '$if_in',
					  foldername         = '',
					  module             = '0',
					  bigclass           = '$bigclass',
					  classtype          = '$classtype',
					  c_out_url          = '$c_out_url',
					  e_out_url          = '$e_out_url'";
         $db->query($query);
okinfo('index.php',$lang[user_admin]);
}


}

if($action=="editor"){
if($if_in==0){
if($met_en_lang==1){
$query = "update $met_column SET
                      c_name             = '$c_name',
                      e_name             = '$e_name',
					  no_order           = '$no_order',
					  list_order         = '$list_order',
					  new_windows        = '$new_windows',
					  bigclass           = '$bigclass',
					  nav                = '$nav',
					  if_in              = '$if_in',
					  filename           = '$filename',
					  foldername         = '$foldername',
					  module             = '$module',
					  c_keywords         = '$c_keywords',
					  e_keywords         = '$e_keywords',
					  c_out_url          = '',
					  e_out_url          = '',
					  classtype          = '$classtype',
					  c_description      = '$c_description',
					  e_description      = '$e_description' 
					  where id='$id'";
}
else{
$query = "update $met_column SET
                      c_name             = '$c_name',
					  no_order           = '$no_order',
					  list_order         = '$list_order',
					  new_windows        = '$new_windows',
					  bigclass           = '$bigclass',
					  nav                = '$nav',
					  if_in              = '$if_in',
					  filename           = '$filename',
					  foldername         = '$foldername',
					  module             = '$module',
					  c_keywords         = '$c_keywords',					 
					  c_out_url          = '',
					  e_out_url          = '',
					  classtype          = '$classtype',
					  c_description      = '$c_description'
					  where id='$id'";

} 
 $db->query($query);
okinfo('index.php',$lang[user_admin]);
}
if($if_in==1){
if($met_en_lang==1){
$query = "update $met_column SET
                      c_name             = '$c_name',
                      e_name             = '$e_name',
					  no_order           = '$no_order',
					  new_windows        = '$new_windows',
					  bigclass           = '$bigclass',
					  nav                = '$nav',
					  if_in              = '$if_in',
					  foldername           = '',
					  module             = '0',
					  bigclass           = '$bigclass',
					  c_out_url          = '$c_out_url',
					  e_out_url          = '$e_out_url',
					  classtype          = '$classtype'
					  where id='$id'";
}
else{
$query = "update $met_column SET
                      c_name             = '$c_name',
                      no_order           = '$no_order',
					  new_windows        = '$new_windows',
					  bigclass           = '$bigclass',
					  nav                = '$nav',
					  if_in              = '$if_in',
					  foldername           = '',
					  module             = '0',
					  bigclass           = '$bigclass',
					  c_out_url          = '$c_out_url',
					  e_out_url          = '$e_out_url',
					  classtype          = '$classtype'
					  where id='$id'";
}
 $db->query($query);
okinfo('index.php',$lang[user_admin]);
}


}
?>
