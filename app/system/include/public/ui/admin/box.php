<!--<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 
$msecount = DB::counter($_M['table']['infoprompt'], " WHERE lang='{$_M[lang]}' and see_ok='0'", "*");
$privilege = background_privilege();
$navigation=$privilege['navigation'];
$arrlanguage=explode('|', $navigation);
  if(in_array('metinfo',$arrlanguage)||in_array('1002',$arrlanguage)){
	$langprivelage=1;
  }else{
    $langprivelage=0;
  }
echo <<<EOT
-->
   <script>
      function valid(){
	      if({$langprivelage}){
           location.href = '{$_M[url][site_admin]}system/lang/lang.php?anyid=10&langaction=add&lang={$_M[lang]}&cs=1';
	      }else{
	        alert("您没有此操作权限请联系管理员");
	      }
      }

   </script>
<!--
EOT;
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

$adminnav = get_adminnav();
$adminapp = load::mod_class('myapp/class/getapp', 'new');
$adminapplist = $adminapp->get_app();
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
$weizhi = "<a href=\"{$nav_3[url]}\">{$nav_3['name']}</a>";
if(!$_M['form']['anyid'])$weizhi = $_M['word']['background_page'];
if($_M['form']['anyid'] == 44 && M_NAME!='myapp')$adminnav[$adminnav[$_M['form']['anyid']]['bigclass']]['name'] = "<a href=\"{$adminnav[44]['url']}\">{$adminnav[44]['name']}</a>";
echo <<<EOT
-->
<ol class="breadcrumb position hidden-xs">
	<li>{$_M['langlist']['web'][$_M['lang']]['name']}</li>
<!--
EOT;
if($adminnav[$adminnav[$_M['form']['anyid']]['bigclass']]['name']){
echo <<<EOT
-->
	<li>{$adminnav[$adminnav[$_M['form']['anyid']]['bigclass']]['name']}</li>
<!--
EOT;
}
echo <<<EOT
-->
	<li>{$weizhi}</li>
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
  
  if(strstr($_M[config][met_weburl],'https')){
	  $val['url']=str_replace('http','https',$val['url']);
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
			<button class="btn btn-success" type="submit" onclick="valid()"><i class="fa fa-plus"></i>新增{$_M['word']['langweb']}</button>
		</li>
	</ul>
</div>
<div class="btn-group pull-right met-tool" {$met_agents_display}>
	<button class="btn btn-default dropdown-toggle" type="button" id="shouquan" data-toggle="dropdown" aria-expanded="true">
		<i class="fa fa-bookmark"></i><span class="hidden-xs">{$_M['word']['indexcode']}</span>
		<span class="caret"></span>
	</button>
	<ul class="dropdown-menu" role="menu" aria-labelledby="shouquan">
<!--
EOT;
if($_M[config][met_agents_type] < 2) {
$auth = load::mod_class('system/class/auth', 'new');
$otherinfoauth = $auth->have_auth();
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
	<!--<a href="http://www.metinfo.cn/bangzhu/index.php?ver=metcms" class="btn btn-success dropdown-toggle" target="_blank">技术支持<a>
	<button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
		<i class="fa fa-life-ring"></i><span class="hidden-xs">技术支持</span>
		<span class="caret"></span>
		<input name="supporturldata" type="hidden" value="user_key={$_M['config']['met_secret_key']}&siteurl={$_M['url']['site']}" />
	</button>
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
	</ul>-->
</div>
			</div>
		</div>
	 </div>
<div class="navbar-collapse collapse metinfo_nav" role="navigation" aria-expanded="false">
	<ul class="nav navbar-nav visible-xs-block">
<!--
EOT;
$toparr = get_adminnav();
$i=0;
foreach($toparr as $key=>$val){
if($val['type']==1){
$cnm='';
$dt="{$val[name]}";
if($val[icon]!=''){
$cnm = 'class="jslist"';
$dt="{$val[icon]}{$val[name]}<i class=\"fa fa-angle-right\"></i>";
}
echo <<<EOT
-->
		<li class="dropdown">
			<a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">{$val[icon]}{$val[name]}<b class="caret"></b></a>
			<ul class="dropdown-menu">
<!--
EOT;
foreach($toparr as $key=>$val2){
if($val2['type']==2&&$val2['bigclass']==$val['id']){
echo <<<EOT
-->
					<li><a href="{$val2[url]}" {$val2[property]} title="{$val2[name]}">{$val2[icon]}{$val2[name]}</a></li>
<!--
EOT;
}}
echo <<<EOT
-->
			</ul>
		</li>
<!--
EOT;
$i++;
}}
echo <<<EOT
-->
	</ul>
</div>
<!--
EOT;
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>