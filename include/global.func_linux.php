<?php

/** 
系统函数库
*/
function daddslashes($string, $force = 0) {
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
	if(inject_check($string)){
	$reurl="http://".$_SERVER["HTTP_HOST"];
	echo("<script type='text/javascript'> alert('请不要尝试非法注入！'); location.href='$reurl'; </script>");
	die("请不要尝试非法注入！");
	}
	if($id!=""){
	if(!is_numeric($id)){
	$reurl="http://".$_SERVER["HTTP_HOST"];
	echo("<script type='text/javascript'> alert('参数非法！'); location.href='$reurl'; </script>");
	die("参数非法！");
	}}
	if($class1!=""){
	if(!is_numeric($class1)){
	$reurl="http://".$_SERVER["HTTP_HOST"];
	echo("<script type='text/javascript'> alert('参数非法！'); location.href='$reurl'; </script>");
	die("参数非法！");
	}}
	if($class2!=""){
	if(!is_numeric($class2)){
	$reurl="http://".$_SERVER["HTTP_HOST"];
	echo("<script type='text/javascript'> alert('参数非法！'); location.href='$reurl'; </script>");
	die("参数非法！");
	}}
	if($class3!=""){
	if(!is_numeric($class3)){
	$reurl="http://".$_SERVER["HTTP_HOST"];
	echo("<script type='text/javascript'> alert('参数非法！'); location.href='$reurl'; </script>");
	die("参数非法！");
	}}
	$string = str_replace("_", "\_", $string);     // 把 '_'过滤掉     
    $string = str_replace("%", "\%", $string);     // 把 '%'过滤掉     
	return $string;
}

function template($template,$EXT="html"){
	global $met_skin_user,$skin;
	if(empty($skin)){
	    $skin = $met_skin_user;
	}
	unset($GLOBALS[con_db_id],$GLOBALS[con_db_pass],$GLOBALS[con_db_name]);
	$path = ROOTPATH."templates/$skin/$template.$EXT";
	!file_exists($path) && $path=ROOTPATH."templates/met/$template.$EXT";
	return  $path;
}

/**底部处理**/
function footer(){
	$output = str_replace(array('<!--<!---->','<!---->','<!--fck-->','<!--fck','fck-->','',"\r",substr($admin_url,0,-1)),'',ob_get_contents());
    ob_end_clean();
	if(!strstr($output,"MetInfo"))die("在未经授权前，请不要尝试去掉'Powered by MetInfo'版权标识！");
    echo $output; unset($output);
	mysql_close();
	exit;
}
/**操作成功提示**/
function okinfo($url = '../site/sysadmin.php',$langinfo){
echo("<script type='text/javascript'> alert('$langinfo'); location.href='$url'; </script>");
exit;
}
/**是否导航条显示**/
function navdisplay($nav){
switch($nav){
case '0';
$nav="<font color=#999999>不显示</font>";
break;
case '1';
$nav="<font color=#990000>头部主导航条</font>";
break;
case '2';
$nav="尾部导航条";
break;
case '3';
$nav="<font color=blue>都显示</font>";
break;
}
return $nav;
}
/**栏目属性显示**/
function if_in($if_in){
switch($if_in){
case '0';
$if_in="系统模块";
break;
case '1';
$if_in="<font color=red>外部栏目</font>";
break;
}
return $if_in;
}

/**模型显示**/
function module($module){
switch($module){
case '0';
$module="<font color=red>外部模块</font>";
break;
case '1';
$module="简介模块";
break;
case '2';
$module="文章模块";
break;
case '3';
$module="产品模块";
break;
case '4';
$module="下载模块";
break;
case '5';
$module="图片模块";
break;
case '6';
$module="招聘模块";
break;
case '7';
$module="留言模块";
break;
}
return $module;
}

// 删除文件的函数
function file_unlink($file_name) {

	if(file_exists($file_name)) {
		@chmod($file_name,0777);
		$area_lord = @unlink($file_name);
	}
	return $area_lord;
}

//静态页面生成
function createhtm($fromurl,$filename){
$fp        = fopen ($fromurl,"r");
$content   = fread ($fp,filesize ($fromurl));
$handle = fopen ($filename,"w"); //打开文件指针，创建文件
/*
检查文件是否被创建且可写
*/
if (!is_writable ($filename)){
okinfo('javascript:history.go(-1)',"文件：".$filename."不可写，请检查其属性后重试！");
}
if (!fwrite ($handle,$content)){   //将信息写入文件
   die ("生成文件".$filename."失败！");
} 
fclose ($handle); //关闭指针

die ("创建文件".$filename."成功！");
}

// 热门标签函数
function contentshow($content) {
require_once ROOTPATH.'config/str.inc.php';
foreach($str as $key=>$val){
$content = str_replace($val[0],$val[1],$content);
}
return $content;
}

//读取数据排序
function list_order($listid){
switch($listid){
case '0';
$list_order=" order by updatetime desc";
return $list_order;
break;

case '1';
$list_order=" order by updatetime desc";
return $list_order;
break;

case '2';
$list_order=" order by addtime desc";
return $list_order;
break;

case '3';
$list_order=" order by hits desc";
return $list_order;
break;

case '4';
$list_order=" order by id desc";
return $list_order;
break;

case '5';
$list_order=" order by id";
return $list_order;
break;
}
}

function utf8Substr($str, $from, $len) 
{ 
return preg_replace('#^(?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$from.'}'. 
'((?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$len.'}).*#s', 
'$1',$str); 
}

function inject_check($sql_str) {     
  return eregi('select|insert|update|delete|\'|\/\*|\*|\.\.\/|\.\/|union|into|load_file|outfile', $sql_str);    // 进行过滤     
}  

function get_keyword_str($str,$keyword,$getstrlen)
{
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
	获取中英文混合字符串的长度
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
	获取中英文混合字符在字符串中的位置
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
//截取字符数
//$str-字符串
//$N-多少字符
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
//去除HTML字符标记
/*
/*
已采用函数
*/
