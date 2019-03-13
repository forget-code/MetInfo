<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.
require_once '../login/login_check.php';

/*
 * foreach (getDir(dirname(__FILE__)) as $dir) {   
 *        echo $dir."<br>";   
 *    } 
 */
function getDir($dir) {   
    $fileArr = array();
    $dp = opendir($dir);
    while(($file = readdir($dp)) !== false) {
        if($file !="." AND $file !=".." AND $file !="") {   
            if(is_dir($dir."/".$file)) {   
                $fileArr = array_merge($fileArr, getDir($dir."/".$file));   
                $fileArr[] = $dir."/".$file; 
            } 
        }   
    }   
    closedir($dp);   
    return $fileArr;   
}   
 
class myDIR 
{ 
var $mask = ""; 
var $find = ""; 
var $root = array(); 
var $temp = array(); 
var $result = array(); 

//** setFIND

function setFIND($val) 
{ 
$this->find = $val; 
} 

//** setMASK 

function setMASK($val="") 
{ 
$this->mask = $val; 
} 

//** setROOT 

function setROOT($val="") 
{ 
$this->root[] = $val; 
} 

//** setARRAY

function setARRAY($folder="",$file="",$size="",$time="") 
{ 
$this->result[] = array("folder"=>$folder,"file"=>$file,"size"=>$size,"time"=>$time); 
} 

//** doSEARCH

function doSEARCH() 
{ 
for($i=0; $i<count($this->root); $i++) 
{ 
unset($this->temp); 

$handle = @opendir($this->root[$i]); 
while ($file = @readdir ($handle)) 
{ 
if (eregi("^\.{1,2}$",$file)) 
{ 
continue; 
} 
$this->temp[] = $this->root[$i]."/$file"; 
} 
@closedir($handle); 

if (count($this->temp) > 0) 
{ 
natcasesort($this->temp); 

foreach ($this->temp as $val) 
{ 
switch ($this->find) 
{ 
case "folder": 
$this->doFOLDER($val); 
break; 
case "files": 
$this->doFILES($val); 
break; 
case "all": 
$this->doFILES($val); 
$this->doFOLDER($val); 
break; 
} 
} 
} 
} 
} 

//** doFOLDER

function doFOLDER($val) 
{ 
if( is_dir($val) ) 
{ 
if ($this->find == "all") 
{ 
$this->root[] = $val; 
} 
} 
} 

//** doFILES 

function doFILES($val) 
{ 
if( is_file($val) && $this->doMATCH($val) ) 
{ 
$this->doINFO($val); 
} 
} 

//** doINFO

function doINFO($val) 
{ 
$fSIZE = filesize($val); 
$fTIME = filemtime($val); 

$offset = strrpos ($val, "/"); 
$folder = substr ($val, 0, $offset); 
$file = substr ($val, $offset+1); 

$this->setARRAY($folder,$file,$fSIZE,$fTIME); 
} 

//** getRESULT 

function doMATCH($file) 
{ 
$mask = $this->mask; 
$mask = str_replace(".", "\.", $mask); 
$mask = str_replace("*", "(.*)", $mask); 

$mask_array = explode(',',$mask); 
foreach ($mask_array as $valid) 
{ 
if(eregi("^$valid", $file, $geek)) 
{ 
return true; 
} 
} 
} 

//** getRESULT 

function getRESULT() 
{ 

$version = split ("\.", phpversion()); 
if ( $version < 4 ) 
{ 
echo "ERROR: phpMyAdmin does only works with PHP-Versions 4.0 or higher.\n<br>"; 
echo "Your Version is (".phpversion().")."; 
exit; 
} 

$this->doSEARCH(); 

if ( !$this->result ) 
{ 
global $lang_setfileno,$file_classnow;
if($file_classnow==3){
okinfo('uploadfile.php?lang='.$lang,$lang_setfileno);
exit; 
} }
return $this->result; 
} 
} 

function deldir($dir) {
  $dh=opendir($dir);
  while ($file=readdir($dh)) {
    if($file!="." && $file!="..") {
      $fullpath=$dir."/".$file;
      if(!is_dir($fullpath)) {
          unlink($fullpath);
      } else {
          deldir($fullpath);
      }
    }
  }

  closedir($dh);
  if($dir!='../../upload'){
    if(rmdir($dir)) {
    return true;
    } else {
    return false;
    }
	}
} 


if($action=='deletefolder'){
   $returnurl="uploadfile.php?lang=".$lang;
   $filedir="../../".$filename;
   deldir($filedir);
   okinfo($returnurl,$lang_jsok);
   }

if($action=='delete'){
$returnurl="uploadfile.php?lang=".$lang."&fileurl=".$fileurl."&file_classnow=".$file_classnow."&page=".$page;

if($action_type=="del"){
$allidlist=explode(',',$allid);
$k=count($allidlist)-1;
  for($i=0;$i<$k; $i++){
   if(file_exists($allidlist[$i]))@unlink($allidlist[$i]);
   }
okinfo($returnurl,$lang_jsok);
}else{
  if(file_exists($filename)){
      @unlink($filename);
	  okinfo($returnurl,$lang_jsok);
	}else{
	  okinfo($returnurl,$lang_setfilenourl);
	}
  }
}else{
$fileurl2=$fileurl;
$metnowdir="upload";
$metdirfile=getDir('../../'.$metnowdir);
$i=0;
foreach($metdirfile as $val){
$fileclassarray=explode('/',$val);
$fileclassnum=count($fileclassarray)-3;
$fileclassnum1=count($fileclassarray)-1;
$fileclass[$fileclassnum][$i][name]=$fileclassarray[$fileclassnum1];
$fileclass[$fileclassnum][$i][url]=$val;
$i++;
}
if($fileurl<>"")$metnowdir=$fileurl;

if($file_classnow==3){
$fileurl1=explode('/',$fileurl);
$fileurl=$fileurl1[0].'/'.$fileurl1[1];
}
$metdir = new myDIR; 
$metdir->setMASK("*.gif,*.txt,*.jpg*,*.rar*,*.jpeg*,*.doc*,*.pdf*,*.bmp*,*.png*,*.tif*,*.psd*,*.swf*,*.swf*"); // ("*.html,*.htm,*.txt") separated with comma 
$metdir->setFIND("files"); // could be "folder" "files" "all" 
$metdir->setROOT('../../'.$metnowdir); // start folder 

$metfile = $metdir->getRESULT(); 


    $total_count = count($metfile);
    require_once 'include/pager.class.php';
    $page = (int)$page;
	if($page_input){$page=$page_input;}
    $list_num = 16;
    $rowset = new Pager($total_count,$list_num,$page);
$page=$page?$page:1;
$startnum=($page-1)*$list_num;
$endnum=$page*$list_num;
$page_list = $rowset->link("uploadfile.php?lang=$lang&fileurl=$fileurl2&file_classnow=$file_classnow&page=");
$css_url="../templates/".$met_skin."/css";
$img_url="../templates/".$met_skin."/images";
include template('uploadfile');
footer();
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>