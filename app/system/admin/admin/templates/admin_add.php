<!--<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.

defined('IN_MET') or exit('No permission');

require $this->template('ui/head');
echo <<<EOT
-->

<link rel="stylesheet" href="{$_M[url][own_tem]}css/metinfo.css?{$jsrand}" />
<form method="POST" class="ui-from" name="myform" action="{$_M[url][own_form]}a={$a}" target="_self">
	<input type="hidden" name='id' value="{$_M['form']['id']}" />
    <div class="v52fmbx">
    <h3 class="v52fmbx_hr">{$_M['word']['admininfo']}</h3>
    <dl>
    	<dt>{$_M['word']['adminusername']}</dt>
    	<dd class="ftype_input">
    		<div class="fbox">
    			<input type="text" name="admin_id" value="{$list['admin_id']}" data-required="1">
    		</div>
    	</dd>
    </dl>
    <dl>
      <dt>{$_M['word']['adminpassword']}</dt>
      <dd class="ftype_input">
        <div class="fbox">
          <input type="password" name="admin_pass" value="{$list['admin_pass']}" data-required="1">
        </div>
      </dd>
    </dl>
    <dl>
      <dt>{$_M['word']['adminpassword1']}</dt>
      <dd class="ftype_input">
        <div class="fbox">
          <input type="password" name="admin_pass_replay" value="{$list['admin_pass']}" data-required="1" data-password="admin_pass">
        </div>
      </dd>
    </dl>
    <dl>
      <dt>{$_M['word']['adminname']}</dt>
      <dd class="ftype_input">
        <div class="fbox">
          <input type="text" name="admin_name" value="{$list['admin_name']}">
        </div>
      </dd>
    </dl>
    <h3 class="v52fmbx_hr">{$_M['word']['admintips7']}</h3>
    <dl>
    	<dt>{$_M['word']['admintips7']}</dt>
    	<dd class="ftype_radio">
    		<div class="fbox">
    			<label><input name="admin_group" type="radio" value="1" data-checked="{$list['admin_group']}">{$_M['word']['managertyp4']}</label>
    			<label><input name="admin_group" type="radio" value="2">{$_M['word']['managertyp3']}</label>
    			<label><input name="admin_group" type="radio" value="3">{$_M['word']['managertyp2']}</label>
          <label><input name="admin_group" type="radio" value="0">{$_M['word']['managertyp5']}</label>
    		</div>
    	</dd>
    </dl>
    <dl>
    	<dt>{$_M['word']['adminjurisd']}</dt>
    	<dd class="ftype_checkbox">
    		<div class="fbox">
    			<label><input name="langok" type="checkbox" value="#metinfo#" data-checked="{$list['lang_check']}" class="lang-select-all">{$_M['word']['admintips1']}</label>
<!--
EOT;
foreach($list['lang'] as $key=>$val){
echo <<<EOT
-->
          <label><input name="langok" type="checkbox" value="{$val['mark']}" class="lang-select-one">{$val['name']}</label>
<!--
EOT;
}
echo <<<EOT
-->
    		</div>
    		<span class="tips">{$_M['word']['admintips2']}</span>
    	</dd>
    </dl>
    <dl>
      <dt>{$_M['word']['permission_upgrade']}</dt>
      <dd class="ftype_checkbox">
        <div class="fbox">
          <label><input name="admin_pop" type="checkbox" value="s1801" />{$_M['word']['upfiletips42']}</label>
        </div>
      </dd>
    </dl>
    <dl>
    <dt>{$_M[word][veditor]}</dt>
      <dd class="ftype_checkbox">
        <div class="fbox">
          <label><input name="admin_pop" type="checkbox" value="s1802" />{$_M[word][veditortips1]}</label>
        </div>
      </dd>
    </dl>
    <dl>
      <dt>{$_M['word']['adminPower']}</dt>
      <dd class="ftype_checkbox">
        <div class="fbox">
          <label><input name="admin_issueok" type="checkbox" value="1" data-checked="{$list['admin_issueok']}">{$_M['word']['adminTip2']}</label>
        </div>
      </dd>
    </dl>
    <dl>
      <dt>{$_M['word']['adminOperate']}</dt>
      <dd class="ftype_checkbox">
        <div class="fbox">
          <label><input name="admin_op" class="op-select-all" type="checkbox" value="metinfo" data-checked="{$list['op_check']}">{$_M['word']['adminOperate1']}</label>
          <label><input name="admin_op" class="op-select-one" type="checkbox" value="add">{$_M['word']['adminOperate2']}</label>
          <label><input name="admin_op" class="op-select-one" type="checkbox" value="editor">{$_M['word']['adminOperate3']}</label>
          <label><input name="admin_op" class="op-select-one" type="checkbox" value="del">{$_M['word']['adminOperate4']}</label>
        </div>
      </dd>
    </dl>

    <dl>
      <dt>{$_M['word']['adminOperate']}</dt>
      <dd class="ftype_checkbox ftype_transverse">
        <div class="fbox">
          <label><input name="admin_pop" id="opwer-id" class="opwer-select-all" type="checkbox" value="#metinfo#" data-checked="{$list['pop_check']}"><input type="hidden" id="admin_pop_list" name="admin_pop_str">{$_M['word']['adminSelectAll']}</label>
        </div>
<!--
EOT;
foreach($metinfocolumn as $mkey=>$mval){
echo <<<EOT
-->
        <div class="fbox admin_poplistdiv">
        <h2>{$mval['info']['name']}</h2>
        <div class="x2">
<!--
EOT;
  foreach($mval['next'] as $nkey=>$nval){
echo <<<EOT
-->

          <label><input name="admin_pop" class="opwer-select-one" type="checkbox" value="{$nval['field']}">{$nval['name']}</label>
<!--
EOT;
  }
echo <<<EOT
-->
        </div>
        <div class="x3">
<!--
EOT;
  foreach($mval['next2'] as $n2key=>$n2val){
echo <<<EOT
-->
          <div class="adpopcnkdiv">
          <div class="x5">
          <h2>{$n2val['info']['name']}</h2>
          </div>
          <div class="x6">
<!--
EOT;
    foreach($n2val['column'] as $n2ckey=>$n2cval){
echo <<<EOT
-->
          <label><input name="admin_pop" class="opwer-select-one {$n2cval['column_lang']}" type="checkbox" value="{$n2cval['field']}" {$n2cval['data_lang']}>{$n2cval['name']}</label>
<!--
EOT;
    }
echo <<<EOT
-->
        </div>
        </div>
<!--
EOT;
  }
echo <<<EOT
-->
        </div>
        </div>
<!--
EOT;
}
echo <<<EOT
-->
      </dd>
    </dl>
    <dl class="noborder">
      <dt> </dt>
      <dd>
        <input type="submit" name="submit" value="{$_M['word']['Submit']}" class="submit">
      </dd>
    </dl>
    </div>
</form>
<!--
EOT;
require $this->template('ui/foot');
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>
