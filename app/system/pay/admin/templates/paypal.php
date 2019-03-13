<!--<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 
defined('IN_MET') or exit('No permission');
require $this->template('ui/head');
echo <<<EOT
-->
<form method="POST" class="ui-from" name="myform" action="{$_M[url][own_form]}a=dosavepaypal&type={$paypal_config['paytype']}" target="_self">
    <div class="v52fmbx">
        <h3 class="v52fmbx_hr">接口环境设置</h3>
        <dl>
            <dt>接口</dt>
            <dd class="ftype_radio ftype_transverse">
                <div class="fbox">
                    <label><input name="open" type="radio" value="1" data-checked="{$paypal_config['open']}">沙盒环境（SandBox）</label>
                    <label><input name="open" type="radio" value="2">生产环境（Live）</label>
                </div>
            </dd>
        </dl>
        <h3 class="v52fmbx_hr">生产环境（Live）接口参数</h3>
        <dl>
            <dt>商户邮箱</dt>
            <dd class="ftype_input">
                <div class="fbox">
                    <input type="text" name="user" value="{$paypal_config['user']}">
                </div>
            </dd>
        </dl>
        <dl>
            <dt>商户密码</dt>
            <dd class="ftype_input">
                <div class="fbox">
                    <input type="text" name="password" value="{$paypal_config['password']}">
                </div>
            </dd>
        </dl>
        <dl>
            <dt>签名</dt>
            <dd class="ftype_input">
                <div class="fbox">
                    <input type="text" name="signature" value="{$paypal_config['signature']}">
                </div>
            </dd>
        </dl>
        <h3 class="v52fmbx_hr">沙盒环境（SandBox）接口参数</h3>
        <dl>
            <dt>商户邮箱</dt>
            <dd class="ftype_input">
                <div class="fbox">
                    <input type="text" name="user_sandbox" value="{$paypal_config['user_sandbox']}">
                </div>
            </dd>
        </dl>
        <dl>
            <dt>商户密码</dt>
            <dd class="ftype_input">
                <div class="fbox">
                    <input type="text" name="password_sandbox" value="{$paypal_config['password_sandbox']}">
                </div>
            </dd>
        </dl>
        <dl>
            <dt>签名</dt>
            <dd class="ftype_input">
                <div class="fbox">
                    <input type="text" name="signature_sandbox" value="{$paypal_config['signature_sandbox']}">
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