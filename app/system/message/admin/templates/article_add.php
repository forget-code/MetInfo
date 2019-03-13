<!--<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.

defined('IN_MET') or exit('No permission');
require $this->template('ui/head');
if(!$customerid){
$title="<a href='index.php?anyid={$anyid}&lang={$lang}&class1={$class1}'>{$met_class[$class1][name]}</a> > ";
$title.="{$_M[word][messageeditor]}";
}else{
$title="{$_M[word][messageeditor]}";
}
$class1=$class1?$class1:($id?$id:0);
//$title=title($class1,$anyid,$lang)?title($class1,$anyid,$lang):$title;
//require_once template('metlangs');
$langname=DB::get_one("select * from {$_M[table][language]} where name='Name' and lang='$lang'");
$_M[word][Name]=$langname[value];
echo <<<EOT
-->
<div class="stat_list">
  <ul>
    <li ><a class='now' href="{$_M[url][own_form]}&a=doindex&class1={$class1}" title="{$_M[word][messageTitle]}">{$_M[word][messageTitle]}</a></li>
    <li><a href="{$_M[url][adminurl]}anyid=29&n=parameter&c=parameter_admin&a=doparaset&module=7&class1={$class1}" title="{$_M[word][messageVoice]}">{$_M[word][messageVoice]}</a></li>
    <li><a class="syset" href="{$_M[url][own_form]}&a=dosyset&class1={$class1}" title="{$_M[word][messageincTitle]}">{$_M[word][messageincTitle]}</a></li>
  </ul>
</div>
<div style="clear:both;"></div>
<form  method="POST" class='ui-from' name="myform"  action="{$_M[url][own_form]}a={$a}&class1=$class1" target="_self">
		<input name="id" type="hidden" value="$id">
		<input type="hidden" name='id' value="{$_M['form']['id']}" />
		<input type="hidden" name="addtime_l" value="{$list['addtime']}">
		<input type="hidden" name="imgurl_l" value="{$list['imgurl']}">
		<input type="hidden" name="imgurls_l" value="{$list['imgurls']}">
		<input type="hidden" name="no_order" value="{$list['no_order']}">
		<input type="hidden" name="checkok" value="0">
		<input type="hidden" name="class1_select" value="{$_M['form']['class1_select']}">
		<input type="hidden" name="class2_select" value="{$_M['form']['class2_select']}">
		<input type="hidden" name="class3_select" value="{$_M['form']['class3_select']}">
<div class="v52fmbx_tbmax">
<div class="v52fmbx_tbbox">
<div class="v52fmbx">
<!--
EOT;
foreach($para_list as $key=>$val){
echo <<<EOT
-->
		<div class="v52fmbx_dlbox">
		<dl>
			<dt>{$val[imgname]}{$_M[word][marks]}</dt>
			<dd>
				$val[info]
			</dd>
		</dl>
		</div>

<!--
EOT;
}
echo <<<EOT
-->
<!--
EOT;
if($message_content1){
$paras_name="para".$message_content1[paraid];
echo <<<EOT
-->
<dl>
	<dt><font color='#FF0000'>*</font>{$message_content1[imgname]}{$_M[word][marks]}</dt>
	<dd class="ftype_textarea">
		<div class="fbox">
			<textarea name="fd_content" placeholder="{$_M[word][message_tips1_v6]}">$message_content1[info]</textarea>
		</div>
	</dd>
</dl>
<!--
EOT;
}
echo <<<EOT
-->
		<div class="v52fmbx_dlbox">
		<dl>
			<dt>{$_M[word][messageTime]}{$_M[word][marks]}</dt>
			<dd>
				$message_list[addtime]
			</dd>
		</dl>
		</div>
		<div class="v52fmbx_dlbox">
		<dl>
			<dt>{$_M[word][messageID]}{$_M[word][marks]}</dt>
			<dd>
				$message_list[customerid]
			</dd>
		</dl>
		</div>
<!--
EOT;
if($_M[config][met_member_use]){
echo <<<EOT
-->
		<dl>
			<dt>{$_M[word][webaccess]}</dt>
			<dd class="ftype_select">
				<div class="fbox">
					{$access_option}
				</div>
			</dd>
		</dl>
<!--
EOT;
}
echo <<<EOT
-->
		<dl>
	<dt>{$_M[word][messageeditorReply]}{$_M[word][marks]}</dt>
	<dd class="ftype_textarea">
		<div class="fbox">
			<textarea name="useinfo" placeholder="{$_M[word][message_tips1_v6]}">$message_list[useinfo]</textarea>
		</div>
	</dd>
</dl>
		<dl>
		<dt>{$_M[word][messageeditorCheck]}{$_M[word][marks]}</dt>
		<dd class="ftype_checkbox">
			<div class="fbox">
				<label><input name="checkok" type="checkbox" $met_readok value="1">{$_M[word][messageeditorShow]}</label>
			</div>
		</dd>
	    </dl>
		<div class="v52fmbx_submit">
			<input type="submit" name="Submit" value="{$_M[word][Submit]}" class="submit" onclick="return Smit($(this),'myform')" />
		</div>
</div>
</div>
</div>
</form>
<!--
EOT;
require $this->template('ui/foot');
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>