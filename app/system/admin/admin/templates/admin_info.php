<!--<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.

defined('IN_MET') or exit('No permission');

require $this->template('ui/head');
echo <<<EOT
-->

<link rel="stylesheet" href="{$_M[url][own_tem]}css/metinfo.css?{$jsrand}" />
<form method="POST" class="ui-from" name="myform" action="{$_M[url][own_form]}a=doeditor_info_save" target="_self">
	<input type="hidden" name='id' value="{$list['id']}" />
    <div class="v52fmbx">
    <h3 class="v52fmbx_hr">{$_M['word']['admininfo']}</h3>
    <dl>
    	<dt>{$_M['word']['adminusername']}</dt>
    	<dd class="ftype_input">
    		<div class="fbox">
    			{$list['admin_id']}
    		</div>
    	</dd>
    </dl>
    <dl>
      <dt>{$_M['word']['adminpassword']}</dt>
      <dd class="ftype_input">
        <div class="fbox">
          <input type="password" name="admin_pass" value="" data-required="">
        </div>
      </dd>
    </dl>
    <dl>
      <dt>{$_M['word']['adminpassword1']}</dt>
      <dd class="ftype_input">
        <div class="fbox">
          <input type="password" name="admin_pass_replay" value="" data-required="" data-password="admin_pass">
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
