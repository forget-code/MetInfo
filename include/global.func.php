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

function jmailsend($from,$fromname,$to,$title,$body,$usename,$usepassword,$smtp){
$jmail=new COM("JMail.Message")or die("无法调用Jmail组件");
//屏蔽例外错误，静默处理
$jmail->silent=true;
//编码必须设置，否则中文会乱码
$jmail->charset="utf8";
//发信人邮件地址和名称，能自定义，可以和邮件发送账号不同
$jmail->From=$from;
$jmail->FromName=$fromname;
//添加多个邮件接受者
$toarray=explode("|",$to);
$tocount=count($toarray);
for($k=0;$k<$tocount;$k++){
$jmail->AddRecipient($toarray[$k]);
}

//邮件主题和正文信息
$jmail->ContentType ='text/html';   //设置邮件格式为html格式
$jmail->Subject = mb_convert_encoding($title, 'GB2312', 'UTF-8'); 
$jmail->Body = mb_convert_encoding($body, 'GB2312', 'UTF-8'); 
//发信邮件账号和密码
$jmail->MailServerUserName=$usename;
$jmail->MailServerPassword=$usepassword;
try{
    $email = $jmail->Send($smtp);
    if($email)$msg= '发送成功';
    else $msg= '发送失败';
} catch (Exception $e){
    $msg=$e->getMessage();
}
}


function utf8Substr($str, $from, $len) 
{ 
return preg_replace('#^(?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$from.'}'. 
'((?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$len.'}).*#s', 
'$1',$str); 
}

/*
已采用函数
*/
