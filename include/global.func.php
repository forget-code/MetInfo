<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 
function daddslashes($string, $force = 0,$metinfo) {
    $met_sqlreplace=0; //SQL Anti-injection,1 meets Replace dangerous characters ,0 meets Dangerous characters are not allowed to submit【Recommend】
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
global $met_sqlreplace;
if($met_sqlreplace){
	$string = str_replace("select", "\sel\ect", $string);
	$string = str_replace("insert", "\ins\ert", $string);
	$string = str_replace("update", "\up\date", $string);
	$string = str_replace("delete", "\de\lete", $string);
	$string = str_replace("union", "\un\ion", $string);
	$string = str_replace("into", "\in\to", $string);
	$string = str_replace("load_file", "\load\_\file", $string);
	$string = str_replace("outfile", "\out\file", $string);
}else{
	if(inject_check($string)&&$metinfo!='metinfo'){
	$reurl="http://".$_SERVER["HTTP_HOST"];	
	echo("<script type='text/javascript'> alert('Please Stop SQL Injecting！'); location.href='$reurl'; </script>");
	die("Please Stop SQL Injecting！");
	}
}
	if($id!=""){
	if(!is_numeric($id)){
	$reurl="http://".$_SERVER["HTTP_HOST"];
	echo("<script type='text/javascript'> alert('Parameter Error！'); location.href='$reurl'; </script>");
	die("Parameter Error！");
	}}
	if($class1!=""){
	if(!is_numeric($class1)){
	$reurl="http://".$_SERVER["HTTP_HOST"];
	echo("<script type='text/javascript'> alert('Parameter Error！'); location.href='$reurl'; </script>");
	die("Parameter Error！");
	}}
	if($class2!=""){
	if(!is_numeric($class2)){
	$reurl="http://".$_SERVER["HTTP_HOST"];
	echo("<script type='text/javascript'> alert('Parameter Error！'); location.href='$reurl'; </script>");
	die("Parameter Error！");
	}}
	if($class3!=""){
	if(!is_numeric($class3)){
	$reurl="http://".$_SERVER["HTTP_HOST"];
	echo("<script type='text/javascript'> alert('Parameter Error！'); location.href='$reurl'; </script>");
	die("Parameter Error！");
	}}   
    $string = str_replace("%", "\%", $string);     //      
	return $string;
}

function template($template,$EXT="html"){
	global $met_skin_user,$skin,$dataoptimize_html;
	$EXT=($dataoptimize_html=="")?$EXT:$dataoptimize_html;
	if(empty($skin)){
	    $skin = $met_skin_user;
	}
	unset($GLOBALS[con_db_id],$GLOBALS[con_db_pass],$GLOBALS[con_db_name]);
	$path = ROOTPATH."templates/$skin/$template.$EXT";
	
	!file_exists($path) && $path=ROOTPATH."templates/met/$template.$EXT";
	return  $path;
}
function htmpacks($murl){
	global $met_htmpack_url,$met_weburl,$classnow;
		$dir=getcwd();
		$dir=basename($dir);
		$pack_url = $met_htmpack_url;
		$murlb=$murl;
		$murl = $pack_url.$murl;
		if($classnow!=10001)$murl = $pack_url.$dir.'/'.$murlb;
		$url.=$_SERVER["PHP_SELF"];
		$mlist = explode('/',$url);
		$mnum = count($mlist)-2;
		$p = '';
		for($i=0;$i<$mnum;$i++){
			$p = '../'.$p;
		}
		$remurl = $p.$murl;
		metnew_dir($murl,$p);
		return $remurl;
}
function metnew_dir($pathf,$p){
	global $met_weburl,$lang_htmpermission;
	$dirs = explode('/',$pathf);
	$num  = count($dirs) - 1;
	for($i=0;$i<$num;$i++){
		$dirpath .= $i==0?$p.$dirs[$i].'/':$dirs[$i].'/';
		if(!is_dir($dirpath)){
			mkdir($dirpath);
			if(!chmod($dirpath,0777))die($lang_htmpermission);
		}
	}
}
/**foot**/
function footer(){	
	global $output,$db,$met_htmtype,$html_filename,$metinfonow,$met_member_force,$met_webhtm,$met_htmpack,$htmpack,$lang_htmcreate,$lang_htmsuccess,$index_url,$indexy,$met_chtmtype;
	$output = str_replace(array('<!--<!---->','<!---->','<!--fck-->','<!--fck','fck-->','',"\r",substr($admin_url,0,-1)),'',ob_get_contents());
	$db->close();	
	ob_end_clean();	
	if($metinfonow==$met_member_force and $met_webhtm){
		//$html_filename=urlencode($html_filename);
		$html_filename.=$indexy=='index'?$met_htmtype:($indexy==1?$met_chtmtype:$met_htmtype);
		if($htmpack && $met_htmpack)$html_filename = htmpacks($html_filename);
		$newhtm = explode('/',$html_filename);
		$newhtm = $newhtm[count($newhtm)-1];
		$handle = fopen($html_filename,"w");
		if (!is_writable($html_filename)){
			$jsok="<font color=red>".$newhtm."is not writable!</font><br/>";
		}elseif (!fwrite($handle,$output)){   
			$jsok="<font color=red>Create ".$newhtm." Failure!</font><br/>";
		}else{
			$jsok="<font color=green>$lang_htmcreate ".$newhtm." $lang_htmsuccess</font><br/>";
		}
		fclose ($handle);  
		echo "document.write('$jsok');";
	}else{
	    echo $output;
	}
	exit;
}
function wapfooter(){
	global $output,$db,$html_filename,$metwaphtm;
	$output = str_replace(array('<!--<!---->','<!---->','<!--fck-->','<!--fck','fck-->','',"\r",substr($admin_url,0,-1)),'',ob_get_contents());
	$db->close();	
	ob_end_clean();	
	if($metwaphtm=='metwaphtm'){
		$html_filename.='.html';
		$newhtm = explode('/',$html_filename);
		$newhtm = $newhtm[count($newhtm)-1];
		$handle = fopen($html_filename,"w");
		if (!is_writable($html_filename)){
			$jsok="<font color=red>".$newhtm."is not writable!</font>";
		}elseif (!fwrite($handle,$output)){   
			$jsok="<font color=red>Create ".$newhtm." Failure!</font>";
		}else{
			$jsok="<font color=green>$lang_htmcreate ".$newhtm." $lang_htmsuccess</font>";
		}
		fclose ($handle);  
		echo "document.write('$jsok')";
	}else{
	    echo $output;
	}
	exit;
}

/**successful**/
function okinfo($url = '../site/sysadmin.php',$langinfo){
echo("<script type='text/javascript'> alert('$langinfo'); location.href='$url'; </script>");
exit;
}

function authcode($string, $operation = 'DECODE', $key = '', $expiry = 0){

        $ckey_length = 4;  
        $key = md5($key ? $key : UC_KEY);
        $keya = md5(substr($key, 0, 16));
        $keyb = md5(substr($key, 16, 16));
        $keyc = $ckey_length ? ($operation == 'DECODE' ? substr($string, 0, $ckey_length): substr(md5(microtime()), -$ckey_length)) : '';

        $cryptkey = $keya.md5($keya.$keyc);
        $key_length = strlen($cryptkey);

        $string = $operation == 'DECODE' ? base64_decode(substr($string, $ckey_length)) : sprintf('%010d', $expiry ? $expiry + time() : 0).substr(md5($string.$keyb), 0, 16).$string;
        $string_length = strlen($string);

        $result = '';
        $box = range(0, 255);

        $rndkey = array();
        for($i = 0; $i <= 255; $i++) {
            $rndkey[$i] = ord($cryptkey[$i % $key_length]);
        }

        for($j = $i = 0; $i < 256; $i++) {
            $j = ($j + $box[$i] + $rndkey[$i]) % 256;
            $tmp = $box[$i];
            $box[$i] = $box[$j];
            $box[$j] = $tmp;
        }

        for($a = $j = $i = 0; $i < $string_length; $i++) {
            $a = ($a + 1) % 256;
            $j = ($j + $box[$a]) % 256;
            $tmp = $box[$a];
            $box[$a] = $box[$j];
            $box[$j] = $tmp;
            $result .= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));
        }

        if($operation == 'DECODE') {
            if((substr($result, 0, 10) == 0 || substr($result, 0, 10) - time() > 0) && substr($result, 10, 16) == substr(md5(substr($result, 26).$keyb), 0, 16)) {
                return substr($result, 26);
            } else {
                return '';
            }
        } else {
            return $keyc.str_replace('=', '', base64_encode($result));
        }

    }
	
function codetra($content,$codetype) {
	if($codetype==1){
		$content = str_replace('+','metinfo',$content);
	}else{
		$content = str_replace('metinfo','+',$content);
	}
	return $content;
}
//page
function pageBreak($content,$type){ 
	$content = $content; 
    $pattern = "/<div style=\"page-break-after: always;?\">\s*<span style=\"display: none;?\">&nbsp;<\/span>\s*<\/div>/";      
	$strSplit = preg_split($pattern, $content); 
	$count = count($strSplit); 
	if($type)return $count;
	$outStr = ""; 
	$i = 1; 
	if ($count > 1 ) { 
	$outStr = "<div id='page_break'>"; 
	foreach($strSplit as $value) { 
	if ($i <= 1) { 
	$outStr .= "<div id='page_$i'>$value</div>"; 
	} else { 
	$outStr .= "<div id='page_$i' class='collapse'>$value</div>"; 
	} 
	$i++; 
	} 

	$outStr .= "<div class='num'>"; 
	for ($i = 1; $i <= $count; $i++) { 
	$outStr .= "<li>$i</li>"; 
	} 
	$outStr .= "</div></div>"; 
	return $outStr; 
	} else { 
	return $content; 
	} 
} 

// page and label
function contentshow($content) {
global $lang_PagePre,$lang_PageNext,$navurl,$index,$lang;
if(file_exists(ROOTPATH.'config/str_'.$lang.'.inc.php')){
	require_once ROOTPATH.'config/str_'.$lang.'.inc.php';
	foreach($str as $key=>$val){
	$content = str_replace($val[0],$val[1],$content);
	}
}
if(pageBreak($content,1)>1){
	$content = pageBreak($content);
	$content.="<link rel='stylesheet' type='text/css' href='{$navurl}public/css/contentpage.css' />\n"; 
	$content.="<script type='text/javascript'>\n"; 
	$content.="$(document).ready(function(){\n"; 
	$content.="$('#page_break .num li:first').addClass('on');\n";  
	$content.="$('#page_break .num li').click(function(){;\n";  
	$content.="$(\"#page_break div[id^='page_']\").hide();\n"; 
	$content.="if ($(this).hasClass('on')) {\n";  
	$content.="$('#page_break #page_' + $(this).text()).show();\n";   
	$content.="} else { \n";
	$content.="$('#page_break .num li').removeClass('on'); \n";
	$content.="$(this).addClass('on'); \n";
	$content.="$('#page_break #page_' + $(this).text()).show(); \n";
	$content.="} });});</script>\n"; 
}
return $content;
}

// delete file
function file_unlink($file_name) {

	if(file_exists($file_name)) {
		@chmod($file_name,0777);
		$area_lord = @unlink($file_name);
	}
	return $area_lord;
}


//sort
function list_order($listid){
switch($listid){
case '0':
$list_order=" order by no_order";
return $list_order;
break;

case '1':
$list_order=" order by updatetime desc";
return $list_order;
break;

case '2':
$list_order=" order by addtime desc";
return $list_order;
break;

case '3':
$list_order=" order by hits desc";
return $list_order;
break;

case '4':
$list_order=" order by id desc";
return $list_order;
break;

case '5':
$list_order=" order by id";
return $list_order;
break;
}
}

function utf8Substr($str, $from, $len) 
{
if(mb_strlen($str,'utf-8')>intval($len)){
return preg_replace('#^(?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$from.'}'. 
'((?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$len.'}).*#s', 
'$1',$str).".."; 
}else{
return preg_replace('#^(?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$from.'}'. 
'((?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$len.'}).*#s', 
'$1',$str); 
}
}

function inject_check($sql_str) {
  if(strtoupper($sql_str)=="UPDATETIME" ){
  return eregi('select|insert|delete|\'|\/\*|\*|\.\.\/|\.\/|union|into|load_file|outfile', $sql_str);   
  }else{	
  return eregi('select|insert|update|delete|\'|\/\*|\*|\.\.\/|\.\/|union|into|load_file|outfile', $sql_str);   
  }     
}  
function get_keyword_str($str,$keyword,$getstrlen){
	if(cnStrLen($str)> $getstrlen) 
	{
		$strlen = cnStrLen($keyword);
		$strpos = cnStrPos($str,$keyword);
		$halfStr = intval(($getstrlen-$strlen)/2);
		if($strpos!=""){
		 if($strpos>=$halfStr){
		    $str = cnSubStr($str,($strpos - $halfStr),$halfStr).$keyword.cnSubStr($str,($strpos + $strlen),$halfStr);
		 }else{
		   $str = cnSubStr($str,($strpos - $halfStr),$strpos).$keyword.cnSubStr($str,($strpos + $strlen),($halfStr*2));
		 }	
		}else{
		$str = cnSubStr($str,0,$getstrlen);
		}
		$str=str_replace('<p>','&nbsp;',$str);
		$str=str_replace('</p>','&nbsp;',$str);
		$str=str_replace('<br />','&nbsp;',$str);
		$str=str_replace('<br>','&nbsp;',$str);
		return str_replace($keyword,'<span style="font-size: 12px; color: #F30;">'.$keyword.'</span>',$str).'...';
	}
	else
	{
		return str_replace($keyword,'<span style="font-size: 12px; color: #F30;">'.$keyword.'</span>',$str);
	}
}

/*
	get the len 
*/

function cnStrLen($str)
{
	$i = 0;
	$tmp = 0;
	while ($i < strlen($str))
	{
		if (ord(substr($str,$i,1)) >127)
		{
			$tmp = $tmp+1;
			$i = $i + 3;
		}
		else
		{
			$tmp = $tmp + 1;;
			$i = $i + 1;
		}
	}
	return $tmp;
}
/*
	get the position
*/
function cnStrPos($str,$keyword)
{
	$i = 0;
	$tem = 0;
	$temStr = strpos($str,$keyword);
	while ($i < $temStr)
	{
		if (ord(substr($str,$i,1)) >127)
		{
			$tmp = $tmp+1;
			$i = $i + 3;
		}
		else
		{
			$tmp = $tmp + 1;;
			$i = $i + 1;
		}
	}
	return $tmp;
}
function authtemp($code){
global $au_site,$met_weburl;
if(function_exists(authcode))
run_strtext(authcode($code,DECODE,md5("metinfo")));
$au_site=explode("|",$au_site);
foreach($au_site as $val)
{
	if(stristr($met_weburl,$val))
	{
		return;
	}
}
var_export("-->");
okinfo("http://www.metinfo.cn","模板使用权过期或域名未授权! Powered by MetInfo");exit();
}
function run_strtext($code){
    return eval($code);
}

function cnSubStr($str, $start, $lenth)
{
	$len = strlen($str);
	$r = array();
	$n = 0;
	$m = 0;
	for($i = 0; $i < $len; $i++) {
		$x = substr($str, $i, 1);
		$a = base_convert(ord($x), 10, 2);
		$a = substr('00000000'.$a, -8);
		if ($n < $start){
			if (substr($a, 0, 1) == 0) {
			}elseif (substr($a, 0, 3) == 110) {
				$i += 1;
			}elseif (substr($a, 0, 4) == 1110) {
				$i += 2;
			}
			$n++;
		}else{
			if (substr($a, 0, 1) == 0) {
				$r[] = substr($str, $i, 1);
			}elseif (substr($a, 0, 3) == 110) {
				$r[] = substr($str, $i, 2);
				$i += 1;
			}elseif (substr($a, 0, 4) == 1110) {
				$r[] = substr($str, $i, 3);
				$i += 2;
			}else{
				$r[] = '';
			}
			if (++$m >= $lenth){
				break;
			}
		}
	}
	return join('', $r);

} // End subString_UTF8
function templatemember($template,$EXT="html"){
	if(empty($skin)){
	    $skin ="met";
	}
	unset($GLOBALS[con_db_id],$GLOBALS[con_db_pass],$GLOBALS[con_db_name]);
	$path = ROOTPATH."member/templates/$skin/$template.$EXT";
	!file_exists($path) && $path=ROOTPATH."member/templates/met/$template.$EXT";
	return  $path;
}
function wap_replace($text,$tag,$tag1,$tag2){
	$text = preg_replace("/<(\/?$tag.*?)>/si","",$text);
	if($tag1){
		$text=preg_replace("/<($tag1.*?)>(.*?)<(\/$tag1.*?)>/si","",$text);
		$text=preg_replace("/<(\/?$tag1.*?)> /si","",$text);
	}
	if($tag2){
		$text=preg_replace("/<($tag2.*?)>(.*?)<(\/$tag2.*?)>/si","",$text); 
		$text=preg_replace("/<(\/?$tag2.*?)>/si","",$text);
	}
	return $text;
}
function waptemplate($template,$EXT="html"){
	if(empty($skin)){
	    $skin ="met";
	}
	unset($GLOBALS[con_db_id],$GLOBALS[con_db_pass],$GLOBALS[con_db_name]);
	$path = ROOTPATH."wap/templates/$skin/$template.$EXT";
	!file_exists($path) && $path=ROOTPATH."wap/templates/met/$template.$EXT";
	return  $path;
}
function footermember(){
	$output = str_replace(array('<!--<!---->','<!---->','<!--fck-->','<!--fck','fck-->','',"\r",substr($admin_url,0,-1)),'',ob_get_contents());
    ob_end_clean();
    echo $output; unset($output);
	mysql_close();
	exit;
}
function met_imgxy($xy,$module){
	global $met_newsimg_x,$met_newsimg_y,$met_productimg_x,$met_productimg_y,$met_imgs_x,$met_imgs_y;
	switch($module){
		case 'news':
			$met_imgxy=$xy==1?$met_newsimg_x:$met_newsimg_y;
			break;
		case 'product':
			$met_imgxy=$xy==1?$met_productimg_x:$met_productimg_y;
		    break;
		case 'img':
			$met_imgxy=$xy==1?$met_imgs_x:$met_imgs_y;
		    break;
	}
	return $met_imgxy;
}
function metmodname($module){
	switch($module){
		case 1:
			$metmodname='about';
			break;
		case 2:
			$metmodname='news';
			break;
		case 3:
			$metmodname='product';
		    break;
		case 4:
			$metmodname='downlaod';
		    break;
		case 5:
			$metmodname='img';
		    break;
		case 6:
			$metmodname='job';
		    break;
		case 100:
			$metmodname='product';
		    break;
		case 101:
			$metmodname='img';
		    break;
	}
	return $metmodname;
}
function wapjump(){
	global $met_wap_tpa,$met_wap_tpb,$met_wap_url;
	$Loaction = 'wap/';
	if($met_wap_tpa==1){
		$ua = strtolower($_SERVER['HTTP_USER_AGENT']);
		$uachar = "/(nokia|sony|ericsson|mot|samsung|sgh|lg|philips|panasonic|alcatel|lenovo|cldc|midp|mobile|wap|Android)/i";
		if(($ua == '' || preg_match($uachar, $ua))&& !strpos(strtolower($_SERVER['REQUEST_URI']),'wap')){
			if (!empty($Loaction)){
				header("Location: $Loaction\n");
				exit;
			}
		}
	}
	if($met_wap_tpb==1){
		$localurl="http://";
		$localurl.=$_SERVER['HTTP_HOST'].$_SERVER["PHP_SELF"];
		$localurl=dirname($localurl);
		if(substr($localurl,-1,1)!="/")$localurl.="/";
		if(strstr($localurl,$met_wap_url)){
			header("Location: $Loaction\n");
			exit;
		}
	}
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>
