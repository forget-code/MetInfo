<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 
/*读语言配置*/
$query = "SELECT * FROM $met_lang order by no_order";
$result = $db->query($query);
while($list_config= $db->fetch_array($result)){
	$list_config['order']=$list_config['no_order'];
	if($list_config['lang']=='metinfo'){
		$met_langadmin[$list_config['mark']]=$list_config;
		$_M[langlist][admin][$list_config['mark']]=$list_config;
	}else{
		$met_langok[$list_config['mark']]=$list_config;
		$_M[langlist][web][$list_config['mark']]=$list_config;
	}
}
/*静态页面转伪静态*/
require_once ROOTPATH.'include/htmlurl.php';
/*域名跳转判断*/
if($lang==""){
	foreach($met_langok as $key=>$val){
		if($val[link]){
			if(strstr($val[link].'/',"http://".$_SERVER["HTTP_HOST"].'/'))$lang=$val[mark];
		}
	}
}
/*默认语言*/
$met_index_type = $db->get_one("SELECT * FROM $met_config WHERE name='met_index_type' and lang='metinfo'");
$met_index_type = $met_index_type['value'];
$lang=($lang=="")?$met_index_type:$lang;
$langoks = $db->get_one("SELECT * FROM $met_lang WHERE lang='$lang'");
if(!$langoks)die('No data in the database,please reinstall.');
if(!$langoks[useok]&&!$metinfoadminok)okinfo('../404.html');
if(count($met_langok)==1)$lang=$met_index_type;
/*读配置数据*/
$_M[config][tablepre]=$tablepre;
$query = "SELECT * FROM $met_config WHERE lang='$lang' or lang='metinfo'";
$result = $db->query($query);
while($list_config= $db->fetch_array($result)){
	$_M[config][$list_config['name']]=$list_config['value'];
	if($metinfoadminok)$list_config['value']=str_replace('"', '&#34;', str_replace("'", '&#39;',$list_config['value']));
	$settings_arr[]=$list_config;
	if($list_config['columnid']){
		$settings[$list_config['name'].'_'.$list_config['columnid']]=$list_config['value'];
	}else{
		$settings[$list_config['name']]=$list_config['value'];
	}
	if($list_config['flashid']){
		$list_config['value']=explode('|',$list_config['value']);
		$falshval['type']=$list_config['value'][0];
		$falshval['x']=$list_config['value'][1];
		$falshval['y']=$list_config['value'][2];
		$falshval['imgtype']=$list_config['value'][3];
		$list_config['mobile_value']=explode('|',$list_config['mobile_value']);
		$falshval['wap_type']=$list_config['mobile_value'][0];
		$falshval['wap_y']=$list_config['mobile_value'][1];
		$met_flasharray[$list_config['flashid']]=$falshval;
	}
}
$_M[lang]=$lang;
@extract($settings);
/*静态页面转伪静态，规则不匹配*/
if(isset($html_met_htmlistname) && $html_met_htmlistname!=$met_htmlistname){
	okinfo('../404.html');
}
if(isset($html_met_listhtmltype) && $html_met_listhtmltype!=$met_listhtmltype){
	okinfo('../404.html');
}
if(isset($html_met_htmpagename) && $html_met_htmpagename!=$met_htmpagename){
	okinfo('../404.html');
}
/*模板设置预览*/
if($theme_preview){
	$met_pseudo=0;//关闭伪静态
	$met_webhtm=0;//关闭静态页面
	$met_online_type=3;//关闭在线客服
	$met_stat=0;//关闭访问统计
	$_M['config']['met_pseudo'] = 0;
	$_M['config']['met_webhtm'] = 0;
	$_M['config']['met_online_type'] = 3;
	$_M['config']['met_stat'] = 0;
	if($met_theme_preview){
		//echo $met_theme_preview;
		$php_json = json_decode($met_theme_preview,true); 
		foreach($php_json['config'] as $key=>$val){
			$patten = '/^[a-zA-Z0-9_]+$/';
			//echo $key.'='.$val.'<br/>';
			if(preg_match($patten, $key) == 1){
				$$key = $val;
				$_M['config'][$key] = $val;
			}
		}
		$indexbannerset=explode('|',$_M['config']['flash_10001']);
		$met_flasharray['10001']['x']=$indexbannerset[1];
		$met_flasharray['10001']['y']=$indexbannerset[2];
		$met_flasharray['10001']['imgtype']=$indexbannerset[3];
		$met_flasharray['10001']['wap_y']=$indexbannerset[1];
	}
}
/*系统安全密钥*/
function met_rand_x($length){
	$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
	$password = '';
	for ( $i = 0; $i < $length; $i++ ) {
		$password .= $chars[ mt_rand(0, strlen($chars) - 1) ];
	}
	return $password;
}
$met_webkeys=file_get_contents(ROOTPATH.'/config/config_safe.php');
$met_webkeys=str_replace('<?php/*','',$met_webkeys);
$met_webkeys=str_replace('*/?>','',$met_webkeys);
if(!preg_match('/^[0-9A-Za-z]{32}$/',$met_webkeys)){
	$met_webkeys = met_rand_x(32);
	file_put_contents(ROOTPATH.'/config/config_safe.php', "<?php/*{$met_webkeys}*/?>");
}
$met_adminfile_code=$met_adminfile;
$met_adminfile=authcode($met_adminfile,'DECODE', $met_webkeys);
//接口代码
$_M[url][site_admin]=$met_weburl.$met_adminfile.'/';
$_M[url][site]=$met_weburl;
$_M[url][entrance]=$met_weburl.'app/system/entrance.php';
$_M[url][pub]=$met_weburl.'app/system/include/public/';
$_M[url][app]=$met_weburl.'app/app/';
$_M['url']['static'] = $met_weburl.'app/system/include/static/';
$current_url='http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
//

$met_agents_backup =substr(md5(substr($met_webkeys,0,8)), 0, 8); 

if(defined('ROOTPATH_ADMIN')){
	$_M[url][ui]=$met_weburl.'app/system/include/public/ui/admin/';
}else{
	$_M[url][ui]=$met_weburl.'app/system/include/public/ui/web/';
	$_M[flashset]=$met_flasharray;
}
$query = "SELECT * FROM $met_app_plugin  WHERE effect='1' ORDER BY no_order DESC";
$plugins = $db->get_all($query);
foreach($plugins as $key => $val){
	$_M['plugin'][$val['m_action']][] = $val['m_name'];
}
//结束
/*app引用*/
$query="select * from $met_app where site is not null and download=1";
$app_file_temp = $db->get_all($query);
$app_file=array();
foreach($app_file_temp as $key=>$val){
	$sites=explode('-',$val['site']);
	$urls=explode('-',$val['url']);
	foreach($sites as $keysite=>$valsite){
		$app_file[$valsite].='|'.$urls[$keysite];
	}
}
foreach($app_file as $key=>$val){		
	$app_file[$key]=trim($app_file[$key],'|');
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>