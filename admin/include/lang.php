<?php
# 文件名称:lang.php 2009-08-15 16:34:57
# MetInfo企业网站管理系统 
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn). All rights reserved.
function daddslashes1($string, $force = 0) {
	!defined('MAGIC_QUOTES_GPC') && define('MAGIC_QUOTES_GPC', get_magic_quotes_gpc());
	if(!MAGIC_QUOTES_GPC || $force) {
		if(is_array($string)) {
			foreach($string as $key => $val) {
				$string[$key] = daddslashes($val, $force);
			}
		} else {
			$string = addslashes($string);
		}
	}
	return $string;
}
//ini
switch($met_admin_type){
case 0;
$langusenow="cn";
break;
case 1;
$langusenow="en";
break;
case 2;
$langusenow="other";
break;
}

if($_GET[langset]!="" and $met_admin_type_ok==1){
$languser = $_GET[langset];
}
if($languser!="" and $met_admin_type_ok==1)$langusenow=$languser;
if($langusenow=="en"){
$file_name=ROOTPATH_ADMIN.'language/language_en.ini';
}else if($langusenow=="other")
{
$file_name=ROOTPATH_ADMIN.'language/language_other.ini';
}	
else
{
$file_name=ROOTPATH_ADMIN.'language/language_china.ini';
}	
$fp = @fopen($file_name, "r") or die("Cannot open $file_name");
$js='var user_msg = new Array();';
while ($conf_line = @fgets($fp, 1024)){ 
if(substr($conf_line,0,1)=="#"){   
$line = ereg_replace("#.*$", "", $conf_line);
}else{
$line = $conf_line;
}
if (trim($line) == "") continue;
$linearray=explode ('=', $line);
$linenum=count($linearray);
if($linenum==2){
list($name, $value) = explode ('=', $line);
}else{

  for($i=0;$i<$linenum;$i++){

     $linetra=$i?$linetra."=".$linearray[$i]:$linearray[$i].'metinfo_';
   }
list($name, $value) = explode ('metinfo_=', $linetra);
}
$value=str_replace("\"","&quot;",$value);
if($name[0]=='j' && $name[1]=='s') 
{
	$tmp=trim($value);
	$js=$js."user_msg['$name']='$tmp';";
}
list($value, $valueinfo)=explode ('/*', $value);
$name = 'lang_'.daddslashes1(trim($name),1);
$$name= daddslashes1(trim($value),1);
}
fclose($fp) or die("Can't close file $file_name");
# 本程序是一个开源系统,使用时请你仔细阅读使用协议,商业用途请自觉购买商业授权.
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn). All rights reserved.
?>