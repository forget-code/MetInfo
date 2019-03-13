<!--<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 
$msecount = $db->counter($_M['table']['infoprompt'], " WHERE lang='{$_M[lang]}' and see_ok='0'", "*");
$_M['url']['adminurl'] = $_M['url']['site'].$met_adminfile."/index.php?lang={$lang}&";
if($_M[config][met_agents_type] > 2) $met_agents_display = "style=\"display:none\"";
function is_strinclude($str, $needle, $type = 0){
	if(!$needle) return false;
	$flag = true;
	if(function_exists('stripos')){
		if($type == 0){
			if(stripos($str, $needle) === false){
				$flag = false;
			}
		}else if($type == 1){
			if(strpos($str, $needle) === false){
				$flag = false;
			}
		}
	}else{
		if($type == 0){
			if(stristr($str, $needle) === false){
				$flag = false;
			}
		}else if($type == 1){
			if(strstr($str, $needle) === false){
				$flag = false;
			}
		}		
	}
	return $flag;
}
echo <<<EOT
-->
	 <div class="metcms_top_right">
		<div class="metcms_top_right_box">
			<div class="metcms_top_right_box_div clearfix"> 
<!--
EOT;
if($_M['form']['iframeurl']){
	function get($str){
		$data = array();
		$parameter = explode('&',end(explode('?',$str)));
		foreach($parameter as $val){
			$tmp = explode('=',$val);
			$data[$tmp[0]] = $tmp[1];
		}
		return $data;
	}
	$str = $_M['form']['iframeurl'];
	$data = get($str);
	$_M['form']['anyid'] = $data['anyid'];
	$_M['form']['n'] = $data['n'];
}
	$_M['user']['admin_name'] = $metinfo_admin_name;
	$query = "SELECT * from {$_M['table']['admin_table']} WHERE admin_id = '{$metinfo_admin_name}'";
	$user = $db->get_one($query);
	$privilege = array();
	$privilege['admin_op'] = $user['admin_op'];
	if(strstr($user['langok'], "metinfo")) {
		$privilege['langok'] = $_M['langlist']['web'];
	} else {
		$langok = explode('-',$user['langok']);
		foreach($langok as $key=>$val){
			if($val) {
				$privilege['langok'][$val] = $_M['langlist']['web'][$val];
			}
		}
	}
	if(strstr($user['admin_type'], "metinfo")){
		$privilege['navigation'] = "metinfo";
		$privilege['column'] = "metinfo";
		$privilege['application'] = "metinfo";
		$privilege['see'] = "metinfo";
	}else{
		$allidlist = explode('-', $user['admin_type']);
		foreach($allidlist as $key=>$val){
			if(strstr($val, "s")){
				$privilege['navigation'].= str_replace('s','',$val)."|";
			}
			if(strstr($val, "c")){
				$privilege['column'].= str_replace('c','',$val)."|";
			}
			if(strstr($val, "a")){
				$privilege['application'].= str_replace('a','',$val)."|";
			}
			if($val == 9999){
				$privilege['see'] = "metinfo";
			}
		}	
		$privilege['navigation'] = trim($privilege['navigation'], '|');
		$privilege['column'] = trim($privilege['column'], '|');
		$privilege['application'] = trim($privilege['application'], '|');
	}
	$jurisdiction = $privilege;
	$query = "select * from {$_M['table']['admin_column']} order by type desc,list_order";
	$sidebarcolumn = $db->get_all($query);
	$bigclass = array();
	foreach ($sidebarcolumn as $key => $val) {
		if($val['id'] == 68)$val['field'] = '1301';
		if(!is_strinclude($jurisdiction['navigation'], $val['field']) && $jurisdiction['navigation'] != 'metinfo' && $val['field']!=0)continue;
		//需要清理，下面的代码，有些栏目已经多余
		if ((($val['name'] == 'lang_indexcode') || ($val['name'] == 'lang_indexebook') || ($val['name'] == 'lang_indexbbs') || ($val['name'] == 'lang_indexskinset') ) && $_M['config']['met_agents_type'] > 1) continue;
		if ((($val['name'] == 'lang_webnanny') || ($val['name'] == 'lang_smsfuc')) && $_M['config']['met_agents_sms'] == 0) continue;
		if (($val['name'] == 'lang_dlapptips2') && $_M['config']['met_agents_app'] == 0) continue;
		//
		$val['name'] = get_word($val['name']);
		$val['info'] = get_word($val['info']);
		$bigclass[$val['bigclass']] = 1;
		switch ($val['type']) {
			case 1:
				if($bigclass[$val['id']] == 1)$adminnav[$val['id']] = $val;
			break;
			case 2:
				if (strstr($val['url'],"?")) {
					$val['url'] .= '&anyid='.$val['id'].'&lang='.$_M['lang'];
				}else{
					$val['url'] .= '?anyid='.$val['id'].'&lang='.$_M['lang'];
				}
				$val['url'] = $_M['url']['site_admin'].$val['url'];
				$adminnav[$val['id']] = $val;
			break;
		}
	}
if($_M['form']['anyid'] == 32 || $_M['form']['anyid'] == 33) {
	$_M['form']['anyid'] = '29';
}
if($_M['form']['anyid'] == '44'){
	foreach ($adminapplist as $key => $val) {
		if ($val['m_name'] == $_M['form']['n']) {
			$nav_3 = $val;
			$nav_3 ['name'] = get_word($val['appname']);
			break;
		}
	}
	if(!$nav_3)$nav_3 = $adminnav[$_M['form']['anyid']];
} else {
	$nav_3 = $adminnav[$_M['form']['anyid']];
}
$weizhi = '';
if(!$_M['form']['anyid'])$weizhi = $_M['word']['background_page'];
$a=$adminnav[$adminnav[$_M['form']['anyid']]['bigclass']]['name'];
$a=$$a;
if($_M['form']['anyid'] == 44 && M_NAME!='myapp')$adminnav[$adminnav[$_M['form']['anyid']]['bigclass']]['name'] = "<a href=\"{$adminnav[44]['url']}\">{$adminnav[44]['name']}";
echo <<<EOT
-->
<ol class="breadcrumb position hidden-xs">
	<li>{$_M['langlist']['web'][$_M['lang']]['name']}</li>
<!--
EOT;
if($a){
echo <<<EOT
-->
	<li>{$a}</li>
<!--
EOT;
}
echo <<<EOT
-->
<!--
EOT;
if($weizhi){
echo <<<EOT
-->
	<li>{$weizhi}</li>
<!--
EOT;
}
echo <<<EOT
-->
<!--
EOT;
if($_M['form']['anyid']){
echo <<<EOT
-->
	<li><a href="{$nav_3[url]}">{$$nav_3['name']}</a></li>
<!--
EOT;
}
echo <<<EOT
-->
</ol>
<div class="btn-group pull-right met-tool">
	<button class="btn btn-default dropdown-toggle" type="button" id="adminuser" data-toggle="dropdown" aria-expanded="true">
		{$_M['user']['admin_name']}
		<span class="caret"></span>
	</button>
	<ul class="dropdown-menu" role="menu" aria-labelledby="adminuser">
		<li class="met-tool-list"><a href="{$_M[url][site_admin]}admin/editor_pass.php?anyid=47&lang={$_M[lang]}">{$_M['word']['modify_information']}</a></li>
		<li class="met-tool-list"><a target="_top" href="{$_M[url][site_admin]}login/login_out.php">{$_M[word][indexloginout]}</a></li>
	</ul>
</div>
<div class="btn-group pull-right met-tool met-msecount-tool">
	<button class="btn btn-default text-center dropdown-toggle msecount" type="button" onclick="location.href = '{$_M[url][site_admin]}index.php?n=system&c=news&a=doindex&lang={$_M[lang]}';">
		<i class="fa fa-bell-o"></i>
		<span class="label label-danger">{$msecount}</span>
	</button>
</div>
<!--
EOT;
$_M['user']['langok'] = $privilege['langok'];
$weblangok = count($_M['user']['langok'])>1?1:0;
$weblang = $_M['langlist']['web'][$_M['lang']];
if($weblangok){
echo <<<EOT
-->
<div class="btn-group pull-right met-tool">
	<button class="btn btn-default dropdown-toggle" type="button" id="langlistbox" data-toggle="dropdown" aria-expanded="true">
		<i class="fa fa-globe"></i><span class="hidden-xs">{$_M['langlist']['web'][$_M['lang']]['name']}</span>
		<span class="caret"></span>
	</button>
	<ul class="dropdown-menu" role="menu" aria-labelledby="langlistbox">
<!--
EOT;
foreach($_M['user']['langok'] as $key=>$val){
$url_now ='http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];
if(!strstr($url_now, "lang=")) {
	$val['url'] = $_M[url][site_admin]."index.php?lang={$val['mark']}";
} else {
	$val['url'] = str_replace(array("lang={$_M['lang']}", "lang%3D{$_M['lang']}"), array("lang={$val['mark']}", "lang%3D{$val['mark']}"), $url_now);
}
$val['url'] .= "&switch=1";
if(strstr($val['url'], "/content/") && strstr($val['url'], "class1")) {
	$val['url'] = $_M[url][site_admin]."content/content.php?anyid=29&lang={$val['mark']}&switch=1";
}
echo <<<EOT
-->
		<li class="met-tool-list"><a href="{$val['url']}">{$val[name]}</a></li>
<!--
EOT;
}
echo <<<EOT
-->
		
		<li class="met-tool-list">
			<button class="btn btn-success" type="submit" onclick="location.href = '{$_M[url][site_admin]}system/lang/lang.php?anyid=10&langaction=add&lang={$_M[lang]}&cs=1';"><i class="fa fa-plus"></i>新增{$_M['word']['langweb']}</button>
		</li>
	</ul>
</div>
<!--
EOT;
}
echo <<<EOT
-->
<div class="btn-group pull-right met-tool" {$met_agents_display}>
	<button class="btn btn-default dropdown-toggle" type="button" id="shouquan" data-toggle="dropdown" aria-expanded="true">
		<i class="fa fa-bookmark"></i><span class="hidden-xs">{$_M['word']['indexcode']}</span>
		<span class="caret"></span>
	</button>
	<ul class="dropdown-menu" role="menu" aria-labelledby="shouquan">
<!--
EOT;
if($_M[config][met_agents_type] < 2) {
$query = "SELECT * FROM {$_M['table']['otherinfo']} WHERE id='1'";
$key_info = $db->get_one($query);
if ($key_info['authpass'] && $key_info['authcode']) {
	list($domain, $tempdomain) = explode('|', $key_info['info3']);
	if(is_strinclude($_M['url']['site'], $domain) || is_strinclude($_M['url']['site'], $tempdomain)){
		$otherinfoauth = $key_info;
	}else{
		$otherinfoauth = '';
	}
} else {
	$otherinfoauth = '';
}
if(!$otherinfoauth) {
echo <<<EOT
-->				
		<li class="met-tool-list text-center"><a target="_blank" class="liaojie" href="http://www.metinfo.cn/web/product.htm">{$_M['word']['sys_authorization2']}</a></li>
		<li class="met-tool-list text-center">
		<button class="btn btn-primary" type="submit" onclick="location.href = '{$_M['url']['adminurl']}&n=system&c=authcode&a=doindex';">{$_M['word']['sys_authorization1']}</button>
		</li>
<!--
EOT;
} else {
echo <<<EOT
-->	
		<li class="met-tool-list text-center">
			<button class="btn btn-info" type="submit">{$otherinfoauth['info1']}</button>
		</li>
		<li class="met-tool-list text-center">
		<a class="nobo" href="{$_M['url']['adminurl']}&n=system&c=authcode&a=doindex">{$_M['word']['entry_authorization']}</a></li>
<!--
EOT;
}
}
echo <<<EOT
-->
		
	</ul>
</div>
<div class="btn-group pull-right met-tool supportbox" {$met_agents_display}>
	<a href="http://www.metinfo.cn/bangzhu/index.php?ver=metcms" class="btn btn-success dropdown-toggle" target="_blank">技术支持<a>
	<!--<button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
		<i class="fa fa-life-ring"></i><span class="hidden-xs">技术支持</span>
		<span class="caret"></span>
		<input name="supporturldata" type="hidden" value="user_key={$_M['config']['met_secret_key']}&siteurl={$_M['url']['site']}" />
	</button>-->
	<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
		<li class="met-tool-list text-center support_loading">获取中...</li>
		<li class="met-tool-list text-center support_youok">处理时间：每天 </li>
		<li class="met-tool-list text-center support_youok"><button class="btn btn-primary" type="submit">工单</button></li>
		<li class="divider support_youok"></li>
		<li class="met-tool-list text-center support_youok">在线时间：工作日</li>
		<li class="met-tool-list text-center support_youok"><button class="btn btn-info supportmechatlink" type="submit">点我咨询</button></li>
		<li class="divider support_youok"></li>
		<li class="met-tool-list text-center support_desc">于 <span id="support_expiretime"></span> 到期</li>
		<li class="met-tool-list text-center support_desc"><a href="{$_M[url][adminurl]}n=appstore&c=support&a=doindex">续费服务</a></li>
		<li class="met-tool-list text-center support_no"><span class="text-danger">尚未开通服务</span>
		<a href="http://www.metinfo.cn/news/shownews1248.htm" target="_blank">什么是技术支持？</a>
		</li>
		<li class="met-tool-list text-center support_no">
		<button class="btn btn-primary" type="submit" onclick="location.href = '{$_M[url][adminurl]}n=appstore&c=support&a=doindex';">开通服务</button>
		</li>
	</ul>
</div>
			</div>
		</div>
	 </div>
<SCRIPT language=JavaScript>  
var langtime;
	$(".metcms_top_right_box li.lang").hover(function(){
		clearTimeout(langtime);
		var dl = $(this).find("dl");
		langtime = setTimeout(function () { dl.show();  }, "200");
	},function(){
		clearTimeout(langtime);
		var dl = $(this).find("dl");
		dl.hide();
	});
	var str = window.parent.document.URL; 
	var s = str.indexOf(lang);
	var str1 = window.location.href;
	var s1 = str1.indexOf('switch=1');
	if(s == '-1' && s1 != '-1'){
		str = str.replace(/(lang=[^#]*#)/g,"lang="+lang+"#");
		parent.location.href=str;
	}
</SCRIPT>
<!--
EOT;
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>