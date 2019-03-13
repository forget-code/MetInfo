<!--<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.

defined('IN_MET') or exit('No permission');

require $this->template('ui/head');
echo <<<EOT
-->
<div class="v52fmbx">
    <dl>
        <dt>{$_M[word][search]}</dt>
        <dd class="ftype_input">
            <div class="fbox">
                <input type="test"  name="admin_metinfo"  value="" >
            </div>
        </dd>
        <dd>        
            <dt>{$appname}<br>{$appno}<br>{$langeditor}</dt>
        </dd>
        <dd>
            <input type="submit" name="submit" value="{$_M[word][search]}"  id="wordsearch" data-url="{$_M[url][own_form]}a=dosearchapp&langsite={$site}&langeditor={$_M['form']['langeditor']}&appno={$appno}" class="submit" />
        </dd>
    </dl>
</div>
<div id="langlist" style="display:none">
<form method="POST" name="myform" action="{$_M[url][own_form]}a=domodifyapp&langsite={$_M['form']['langsite']}&langeditor={$_M['form']['langeditor']}&appno={$appno}" target="_self">
    <div class="v52fmbx" >
        <dl class="noborder">
            <dt>&nbsp;</dt>
            <dd>
                <input type="submit" name="submit" value="{$_M[word][submit]}" class="submit" />
            </dd>
        </dl> 
        <div id="langsection">
        </div>
       <dl class="noborder">
            <dt>&nbsp;</dt>
            <dd>
                <input type="submit" name="submit" value="{$_M[word][submit]}" class="submit" />
            </dd>
        </dl> 
    </div>
</form>
</div>
<!--
EOT;
require $this->template('ui/foot');
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>