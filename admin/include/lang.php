<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 
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
if($_GET[langset]!="" and $met_admin_type_ok==1){
$languser = $_GET[langset];
}
$langset=($languser!="")?$languser:$met_admin_type;
$file_name=ROOTPATH_ADMIN."language/language_".$langset.".ini";	
$fp = @fopen($file_name, "r") or die("Cannot open $file_name");
$js="var user_msg = new Array();\n";
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
$value=str_replace("&quot;","\"",$value);
if($name[0]=='j' && $name[1]=='s') 
{
	$tmp=trim($value);
	$js=$js."user_msg['$name']='$tmp';\n";
}
list($value, $valueinfo)=explode ('/*', $value);
$name = 'lang_'.daddslashes1(trim($name),1);
$$name=preg_replace('/\r|\n/', '', $value);
}
fclose($fp) or die("Can't close file $file_name");
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>