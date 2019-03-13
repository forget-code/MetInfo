<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');

require $this->template('ui/head');
echo <<<EOT
-->
<form method="POST" class="ui-from" name="myform" action="{$_M[url][own_form]}a=doupdatelang&langeditor={$_M[form][langeditor]}" target="_self">
<div class="v52fmbx">
    <dl>
        <dt>{$_M[word][language_updatelang_v6]}</dt>
        <dd class="ftype_textarea">
            <div class="fbox">
                <textarea name="langupdate" style="width:80%;height:500px">{$_M[config][met_headstat]}</textarea>
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