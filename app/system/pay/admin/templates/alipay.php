<!--<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 
defined('IN_MET') or exit('No permission');
require $this->template('ui/head');
echo <<<EOT
-->
<form method="POST" class="ui-from" name="myform" action="{$_M[url][own_form]}a=dosavealipay&type={$paytype}" target="_self">
    <div class="v52fmbx">
        <h3 class="v52fmbx_hr">基本信息设置</h3>
        <dl>
            <dt>合作身份者id</dt>
            <dd class="ftype_input">
                <div class="fbox">
                    <input type="text" name="app_partner" value="{$app_partner}">
                </div>
                <span class="tips">合作身份者id，以2088开头的16位纯数字</span>
            </dd>
        </dl>
        <dl>
            <dt>收款支付宝账号</dt>
            <dd class="ftype_input">
                <div class="fbox">
                    <input type="text" name="app_seller_email" value="{$app_seller_email}">
                </div>
                <span class="tips">收款支付宝账号，一般情况下收款账号就是签约账号</span>
            </dd>
        </dl>
        <dl>
            <dt>安全检验码</dt>
            <dd class="ftype_input">
                <div class="fbox">
                    <input type="text" name="app_key" value="{$app_key}">
                </div>
                <span class="tips">安全检验码，以数字和字母组成的32位字符</span>
            </dd>
        </dl>
		<!--
        <h3 class="v52fmbx_hr">证书路径设置</h3>
        <dl>
            <dt>证书</dt>
            <dd class="ftype_upload">
                <div class="fbox">
                    <input name="app_cacert" type="text" data-upload-type="doupfile" value="{$app_cacert}"/>
                </div>
            </dd>
        </dl>
		-->
        <dl class="noborder">
            <dt> </dt>
            <dd>
                <input type="submit" name="submit" value="保存" class="submit">
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