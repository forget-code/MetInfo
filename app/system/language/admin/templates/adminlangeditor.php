<!--<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.

defined('IN_MET') or exit('No permission');

require $this->template('ui/head');
echo <<<EOT
-->
<form method="POST" class="ui-from" name="myform" action="{$_M[url][own_form]}a=doadminlangeditorsave" target="_self" id="adminlangset">
	<div class="v52fmbx">
		<dl>
			<dt>{$_M[word][sort]}</dt>
			<dd class="ftype_input">
				<div class="fbox">
					<input type="number" min="0" name="order"  value="{$edlang['no_order']}" data-required="1" />
				</div>
				<span class="tips">{$_M[word][langorderinfo]}</span>
			</dd>
		</dl>
		
		<dl>
			<dt>{$_M[word][langname]}</dt>
			<dd class="ftype_input">
				<div class="fbox">
					<input type="text" name="langname" data-size="2-10"  value="{$edlang['name']}" data-required="1" />
				</div>
			</dd>
		</dl>
		
		<dl>
            <dt>{$_M[word][langtype]}</dt>
            <dd class="ftype_radio">
                <div class="fbox">
                    <label><input name="languseok" type="radio" value="1"  data-checked="{$edlang['useok']}">{$_M[word][open]}</label>
                    <label><input name="languseok" type="radio" value="0">{$_M[word][close]}</label>
                </div>
                <span class="tips">{$_M[word][langexplain8]}</span>
            </dd>
        </dl>
        
        <dl>
            <dt>{$_M[word][langhome]}</dt>
            <dd class="ftype_radio">
                <div class="fbox">
                    <label><input name="met_admin_type" type="radio" value="1" data-checked="{$default}">{$_M[word][yes]}</label>
                    <label><input name="met_admin_type" type="radio" value="0">{$_M[word][no]}</label>
                </div>
                <span class="tips"></span>
            </dd>
        </dl>
		
		<dl class="noborder">
			<dt>&nbsp;</dt>
			<dd>
				<input type="submit" name="submit" value="{$_M[word][submit]}" class="submit" />
				<input type="hidden" name="langeditor" value="{$edlang['mark']}"  />
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