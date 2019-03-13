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

// 删除HTML 中攻击标记
function dhtmlchars($string) {
	if(is_array($string)) {
		foreach($string as $key => $val) {
			$string[$key] = dhtmlchars($val);
		}
	} else {
		$string = preg_replace('/&amp;((#(\d{3,5}|x[a-fA-F0-9]{4})|[a-zA-Z][a-z0-9]{2,5});)/', '&\\1',
		str_replace(array('&', '"', '<', '>'), array('&amp;', '&quot;', '&lt;', '&gt;'), $string));
	}
	return $string;
}

function isblank($str) {
	if(eregi("[^[:space:]]",$str)) { return 0; } else { return 1; }
	return 0;
}

 function authcode($string, $operation = 'DECODE', $key = '', $expiry = 0) {

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
/*
已采用函数
*/
