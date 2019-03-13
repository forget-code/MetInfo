<!--<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 
defined('IN_MET') or exit('No permission');
require $this->template('ui/head');
echo <<<EOT
-->
<form method="POST" class="ui-from" name="myform" action="{$_M[url][own_form]}a=dosavetempay&type={$paytype}" target="_self">
    <div class="v52fmbx">
        <h3 class="v52fmbx_hr">基本信息设置</h3>
        <dl>
            <dt>财付通商户号</dt>
            <dd class="ftype_input">
                <div class="fbox">
                    <input type="text" name="tem_partner" value="{$tem_partner}">
                </div>
            </dd>
        </dl>
        <dl>
            <dt>财付通密钥</dt>
            <dd class="ftype_input">
                <div class="fbox">
                    <input type="text" name="tem_key" value="{$tem_key}">
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