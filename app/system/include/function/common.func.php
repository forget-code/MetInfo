<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');

/**
 * 输出字符串或数组
 * @param string/array	$vars	输出字符串或数组 
 * @param string		$label	提示标题
 * @param string		$return	是否有返回值
 */
function dump($vars, $label = '', $return = false){
    if (ini_get('html_errors')){
        $content = "<pre>\n";
        if ($label != '') {
            $content .= "<strong>{$label} :</strong>\n";
        }
        $content .= htmlspecialchars(print_r($vars, true), ENT_COMPAT, 'ISO-8859-1');
        $content .= "\n</pre>\n";
    } else {
        $content = $label . " :\n" . print_r($vars, true);
    }
    if ($return) { return $content; }
    echo $content;
    return null;
}

/**
 * 提取一个数组中部分键值返回
 * @param  array	$roc		提取的数组
 * @param  keyarray	$keyarray	需要提取的键值数组 
 * @return array				返回提取的键值数组
 */
function copykey($roc, $keyarray){
	$des = array();
	if(is_array($keyarray)){
		foreach($keyarray as $key=>$val){
			$des[$val] = $roc[$val];
		}
	}
	return $des;
}

/**
 * 对字符串进行反斜杠处理，如果服务器开启MAGIC_QUOTES_GPC。则不处理。
 * @param  string/array	$string	处理的字符串或数组
 * @param  bool			$force	是否强制反斜杠处理
 * @return array                返回处理好的字符串或数组
 */
function daddslashes($string, $force = 0) {
	!defined('MAGIC_QUOTES_GPC') && define('MAGIC_QUOTES_GPC', get_magic_quotes_gpc());
	if(!MAGIC_QUOTES_GPC || $force) {
		if(is_array($string)) {
			foreach($string as $key => $val) {
				$string[$key] = daddslashes($val, $force);
			}
		} else {
			$string = trim(addslashes($string));
		}
	}
	return $string;
}

/**
 * 对字符串进行SQL注入过滤
 * @param  string/array	$string	处理的字符串或数组
 * @return array                返回处理好的字符串或数组
 */
function sqlinsert($string){
	if(is_array($string)){
		foreach($string as $key => $val) {
			$string[$key] = sqlinsert($val);
		}
	}else{
		$string_old = $string;
		$string = str_ireplace("\\","/",$string);
		$string = str_ireplace("\"","/",$string);
		$string = str_ireplace("'","/",$string);
		$string = str_ireplace("*","/",$string);
		$string = str_ireplace("%5C","/",$string);
		$string = str_ireplace("%22","/",$string);
		$string = str_ireplace("%27","/",$string);
		$string = str_ireplace("%2A","/",$string);
		$string = str_ireplace("~","/",$string);
		$string = str_ireplace("select", "\sel\ect", $string);
		$string = str_ireplace("insert", "\ins\ert", $string);
		$string = str_ireplace("update", "\up\date", $string);
		$string = str_ireplace("delete", "\de\lete", $string);
		$string = str_ireplace("union", "\un\ion", $string);
		$string = str_ireplace("into", "\in\to", $string);
		$string = str_ireplace("load_file", "\load\_\file", $string);
		$string = str_ireplace("outfile", "\out\file", $string);
		$string = str_ireplace("sleep", "\sle\ep", $string);
		$string = strip_tags($string);
		if($string_old!=$string){
			$string='';
		}
		$string = trim($string);
	}
	return $string;
}

/**
 * 使用JS方式页面跳转
 * @param  string $url      跳转地址
 * @param  string $langinfo 跳转时alert弹窗内容
 */
function okinfo($url,$langinfo){
	if($langinfo)$langstr = "alert('{$langinfo}');";
	if($url == '-1'){
		$js = "window.history.back();";
	}else{
		$js = "location.href='{$url}';";
	}
	echo("<script type='text/javascript'>{$langstr} {$js} </script>");
	die();
}

/**
 * 产生随机字符串
 * @param  string $length   字符串长度
 * @param  int    $type     生成字符串类型,0(默认):26字母大小写+数字,1:数字，2:26字母小写，3:26字母大写，4:26字母大小写，5:字母小写+数字，6:字母大写+数字
 * @return string           返回产生随机字符串
 */
function random($length = 1, $type = 0, $patten ='') {
	if (!$patten) {
		switch ($type) {
			case 1:
				$patten = '0123456789';
			break;
			case 2:
				$patten = 'abcdefghigklmnopqrstuvwxyz';
			break;
			case 3:
				$patten = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
			break;
			case 4:
				$patten = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghigklmnopqrstuvwxyz';
			break;
			case 5:
				$patten = 'abcdefghigklmnopqrstuvwxyz0123456789';
			break;
			case 6:
				$patten = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
			break;
			default:
				$patten = 'ABCDEFGHIJKMNPQRSTUVWXYZabcdefghigkmnpqrstuvwxyz0123456789';
			break;
		}
	}
	for($i=1;$i>0;$i++){
		if(strlen($str)<$length){
			$rand=rand(0,strlen($patten));
			$str.= substr($patten, $rand, 1);
		}else{
			break;
		}
	}
	return $str;
}

/**
 * cookie设置
 * @param  string $var      规定 cookie 的名称。
 * @param  string $value    规定 cookie 的值。
 * @param  int    $life     规定 cookie 的有效期。
 * @param  string $path     规定 cookie 的服务器路径。
 * @param  string $domain   规定 cookie 的域名。
 */
function met_setcookie($var, $value='', $life=0, $path= '/', $domain = '') {
	$path = PHP_VERSION < '5.2.0' ? $path.'; HttpOnly' : $path;
	$secure = $_SERVER['SERVER_PORT'] == 443 ? 1 : 0;
	if (PHP_VERSION < '5.2.0') {
		setcookie($var, $value, $life, $path, $domain, $secure);
	} else {
		setcookie($var, $value, $life, $path, $domain, $secure, true);
	}
}

/**
 * 获取服务器信息
 * @return array 返回服务器信息
 */
function server_info(){
	$serverinfo=array();
	$serverinfo['system'] = php_uname('s');                  //获取系统类型
	$serverinfo['sysos'] = $_SERVER["SERVER_SOFTWARE"];      //获取php版本及运行环境
	$serverinfo['phpinfo'] = PHP_VERSION;      //获取PHP信息
	$serverinfo['mysqlinfo'] = mysql_get_server_info();      //获取数据库信息
	return $serverinfo;
}

/**
 * 获取ip
 * @return string 返回当前用户ip
 */
function get_userip(){
	return  $_SERVER['REMOTE_ADDR'];
}

/**
 * 获取浏览器版本
 * @return string 浏览器
 */
function getbrowser(){
    $agent = $_SERVER['HTTP_USER_AGENT'];
    $browser = '';
    $browser_ver = '';
    if(preg_match('/OmniWeb\/(v*)([^\s|;]+)/i', $agent, $return)){
		$browser = 'OmniWeb';
		$browser_ver = $return[2];
    }
    if(preg_match('/Netscape([\d]*)\/([^\s]+)/i', $agent, $return)){
		$browser = 'Netscape';
        $browser_ver = $return[2];
    }
    if(preg_match('/safari\/([^\s]+)/i', $agent, $return)){
        $browser = 'Safari';
        $browser_ver = $return[1];
    }
	if(preg_match('/Chrome\/([^\s]+)/i', $agent, $return)){
		$browser = 'Chrome';
		$browser_ver = $return[1];
	}
    if(preg_match('/MSIE\s([^\s|;]+)/i', $agent, $return)){
        $browser = 'Internet Explorer';
        $browser_ver = $return[1];
    }
    if(preg_match('/Opera[\s|\/]([^\s]+)/i', $agent, $return)){
        $browser = 'Opera';
        $browser_ver = $return[1];
    }
    if(preg_match('/NetCaptor\s([^\s|;]+)/i', $agent, $return)){
        $browser = '(Internet Explorer ' .$browser_ver. ') NetCaptor';
        $browser_ver = $return[1];
    }
    if(preg_match('/Maxthon/i', $agent, $return)){
        $browser = '(Internet Explorer ' .$browser_ver. ') Maxthon';
        $browser_ver = '';
    }
	if(preg_match('/360SE/i', $agent, $return)){
        $browser = '(Internet Explorer ' .$browser_ver. ') 360SE';
        $browser_ver = '';
    }
	if(preg_match('/SE 2.x/i', $agent, $return)){
        $browser = '(Internet Explorer ' .$browser_ver. ') sougou';
        $browser_ver = '';
    }
    if(preg_match('/FireFox\/([^\s]+)/i', $agent, $return)){
        $browser = 'FireFox';
        $browser_ver = $return[1];
    }
    if(preg_match('/Lynx\/([^\s]+)/i', $agent, $return)){
		$browser  = 'Lynx';
		$browser_ver = $return[1];
    }
    if($browser != ''){
		return $browser.' '.$browser_ver;
    }else{
		return false;
    }
}

/**
 * url标准化
 * @return string 返回标准化的url
 */
function url_standard($url){
	if(stripos($url,'http://') === false && stripos($url,'https://') === false){
		$url= 'http://'.$url;
	}else{
		if(stripos($url,'http://') != 0 && stripos($url,'http://') != 0){
			$url=str_replace('http://','',$url);
			$url= 'http://'.$url;
		}
	}
	/*
	$start = strripos($url,'.');
	$start1 = strripos($url,'?');
	if($start !== false && $start1 !== false && $start > $start1){
		return $url;
		die();
	}
	if($start !== false){
		$end = stripos($url,'?');
		if($end !== false){
			$start = $start+1;
			$end = $end-$start;
			$suffix = substr($url, $start, $end);
		}else{
			$start = $start+1;
			$suffix = substr($url, $start);
		}
		$arr = array('php','html','htm');
		if(!in_array($suffix,$arr)){
			$url = substr($url, -1) == '/' ? $url : $url . '/';
		}
	}else{
		$url = substr($url, -1) == '/' ? $url : $url . '/';
	}
	*/
	return $url;
}

/**
 * 获取http头信息
 * @return array 返回标准化的ip
 */
function httphead_info(){
	$headinfo = array();
	$current = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];//当前页面地址
	$headinfo['current'] = $current;
	$headinfo['referer'] = $_SERVER['HTTP_REFERER'];//前一个页面地址
	$headinfo['domain'] = $_SERVER['SERVER_NAME'];//域名
	$script = !empty($_SERVER['PHP_SELF']) ? $_SERVER['PHP_SELF'] : (!empty($_SERVER['SCRIPT_NAME']) ? $_SERVER['SCRIPT_NAME'] : $_SERVER['REQUEST_URI']);
	$headinfo['script'] = $script;//脚本地址
	return $headinfo;
}

/**
 * 把$_M['word'][]字符串转为其所指示的语言变量的值
 * @param string $str $_M['word'][]字符串
 * @return array 返回此语言参数字符串的语言变量的值
 */
function get_word($str) {
	global $_M;
	$str_old = $str;
	if (substr($str, 0, 5) == 'lang_') {
		$str = str_replace('lang_', '', $str);
	}
	if (substr($str, 0, 3) == '$_M') {
		$str = str_replace(array('$_M', '\'', '[word]', '[', ']',), '', $str);
	}
	if($_M['word'][$str]){
		return $_M['word'][$str];
	}else{
		return $str_old;
	}
}

load::sys_func('compatible');
load::sys_func('power');

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>