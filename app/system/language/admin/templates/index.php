<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.

defined('IN_MET') or exit('No permission');

require $this->template('ui/head');

echo <<<EOT
-->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="{$_M[url][pub]}bootstrap/css/bootstrap.min.css?{$jsrand}" />
<link rel="stylesheet" type="text/css" href="{$_M[url][own_tem]}css/metinfo.css?{$jsrand}" />
<link rel="stylesheet" type="text/css" href="{$_M[url][own_tem]}css/newstyle.css?{$jsrand}" />
<link rel="stylesheet" href="{$_M[url][pub]}font-awesome/css/font-awesome.min.css?{$jsrand}" />
<script src="{$_M[url][own_tem]}js/jQuery1.8.2.js"></script>
<script src="{$_M[url][own_tem]}js/metvar.js"></script>
<script type="text/javascript">var basepath='{$img_url}?$jsrand',lang = '$lang',adminurl='{$_M[url][site_admin]}';
function linkSmit(my, type, txt) {
	text = txt ? txt: user_msg['js7'];
	var tp = type != 1 ? 1: confirm(text) ? 1: '';
	if (tp == 1) {
		return true;
	}
	return false;
}
</script>

<div class="clear"></div>
<!--
EOT;
echo <<<EOT
-->
<div class="v52fmbx_tbmax">
<div class="v52fmbx_tbbox">
    <table cellpadding="2" cellspacing="1" class="table">
        <tr>
            <td width="30" class="list">{$_M[word][sort]}</td>
            <td width="60" class="list">{$_M[word][langname]}</td>
            <td width="60" class="list">{$_M[word][langflag]}</td>
			<td width="40" class="list">{$_M[word][open]}</td>
			<td width="60" class="list">{$_M[word][langhome]}</td>
			<td width="60" class="list list_left">{$_M[word][langouturl]}</td>
			<td width="80" class="list">{$_M[word][operate]}</td>
			<td class="list list_left">{$_M[word][langpara]}</td>
        </tr>
<!--
EOT;

$i=0;
foreach($met_langok as $key=>$val){
$i++;

if(1){
 if(strstr($val[flag], 'http://')){
	$val['flag']=($val['flag']=='')?'':"<img src='".$val['flag']."' alt=".$val['name'].">";
}elseif(strstr($val['flag'], '../')){
	$val['flag']=($val['flag']=='')?'':"<img src='../../".$val['flag']."' alt=".$val['name'].">";
}else{
$val[flag]=($val[flag]=='')?'':"<img src='{$_M[url][own_tem]}images/flag/".$val[flag]."' alt=".$val[name].">";
}

$val[useok]=$val[useok]?$_M[word][yes]:$_M[word][no];
$val[moren]=$met_index_type==$val[mark]?"<img src='{$_M[url][own_tem]}images/greencheck.png' />":"";
$val['linka']=str_ireplace("http://","",$val['link']);
$val['links']=utf8substr($val['linka'],0,26);
echo <<<EOT
-->
		<tr class="mouse">
            <td class="list-text">{$val[no_order]}</td>
            <td class="list-text list_left">{$val[name]}</td>
            <td class="list-text">{$val[flag]}</td>
			<td class="list-text">{$val[useok]}</td>
			<td class="list-text">{$val[moren]}</td>
			<td class="list-text list_left"><a href="{$val[link]}" target="_blank" title="{$val[link]}">{$val[link]}</a></td>
			<td class="list-text list_left">
<!--
EOT;
if(1){
	if($val['mark'] == 'cn' || $val['mark'] == 'en'){
		$syn = "<a href=\"{$_M[url][own_form]}a=dosys&langsite=web&langeditor={$val[lang]}\" title=\"\" onclick=\"return syn('$val[synchronous]');\">{$_M[word][unitytxt_9]}</a>";
	}else{
		$syn = "";
	}
echo <<<EOT
-->
			<a href="{$_M[url][own_form]}a=dolangeditor&langeditor={$val[lang]}" title="{$_M[word][editor]}">{$_M[word][editor]}</a>
			&nbsp;
			<a href="{$_M[url][own_form]}a=dolangdelete&langeditor={$val[lang]}" onClick="return linkSmit($(this),1,'{$_M['word']['columndefallinfo']}');" title="{$_M[word][delete]}">{$_M[word][delete]}</a>
			&nbsp;
			<a href="{$_M[url][own_form]}a=doexportpack&langsite=web&langeditor={$val[lang]}" title="{$_M[word][delete]}">{$_M[word][language_outputlang_v6]}</a>
			&nbsp;
			<a href="{$_M[url][own_form]}a=domengenedit&langsite=web&langeditor={$val[lang]}" title="{$_M[word][language_batchreplace_v6]}">{$_M[word][language_batchreplace_v6]}</a>
			&nbsp;
			<a href="{$_M[url][own_form]}a=doparaeditor&langeditor={$val[lang]}" title="{$_M[word][langwebeditor]}" style="margin-bottom:5px;">{$_M[word][langwebeditor]}</a>
            &nbsp;

            {$syn}
<!--
EOT;
}
echo <<<EOT
-->
			</td>
			<td class="list-text list_left">
				<a href="{$_M[url][own_form]}a=doapplangset&langsite=0&langeditor={$val['lang']}" title="" onclick="return syn('$val[synchronous]');">{$_M[word][edit_app_lang]}</a>
			</td>
        </tr>
<!--
EOT;
}}
echo <<<EOT
-->
<!--
EOT;
if(1){
echo <<<EOT
-->
		<tr>
			<td class="list-text"></td>
			<td colspan="8" class="list-text list_left"><a href="{$_M[url][own_form]}a=dolangadd" title="{$_M[word][langadd]}">+{$_M[word][langadd]}</a></td>
		</tr>
<!--
EOT;
}
echo <<<EOT
-->
		</table>
</div>
</div>
<!--
EOT;
require $this->template('ui/foot');
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved..
?>