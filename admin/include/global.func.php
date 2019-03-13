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
	return $string;
}

function template($template,$EXT="html"){
	global $met_skin_name,$skin;
	if(empty($skin)){
	    $skin = $met_skin_name;
	}
	unset($GLOBALS[con_db_id],$GLOBALS[con_db_pass],$GLOBALS[con_db_name]);
	$path = ROOTPATH_ADMIN."templates/$skin/$template.$EXT";
	!file_exists($path) && $path=ROOTPATH_ADMIN."templates/met/$template.$EXT";
	return  $path;
}

/**底部处理**/
function footer(){
	$output = str_replace(array('<!--<!---->','<!---->','<!--fck-->','<!--fck','fck-->','',"\r",substr($admin_url,0,-1)),'',ob_get_contents());
    ob_end_clean();
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
//ob_start(); 
$content = file_get_contents( $fromurl); 
//$content = ob_get_contents();
//ob_end_clea();
//$fp        = fopen ($fromurl,"rb");
//$content   = fread ($fp,filesize ($fromurl));
$handle = fopen ($filename,"w"); //打开文件指针，创建文件
/*
检查文件是否被创建且可写
*/
if (!is_writable ($filename)){
echo "<font color='#FF9900'>文件：".$filename."不可写，请检查其属性后重试！</font><br>";
}
if (!fwrite ($handle,$content)){   //将信息写入文件
echo "<font color='#FF0000'>生成文件".$filename."失败！</font><br>";
} 
fclose ($handle); //关闭指针
echo "<font color='#00CC00'>生成文件".$filename."成功！</font><br>";
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

/*
已采用函数
*/
