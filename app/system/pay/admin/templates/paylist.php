<!--<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.
defined('IN_MET') or exit('No permission');
require $this->template('ui/head');
echo <<<EOT
-->
<style type="text/css">
.box a{display: block;width: 110px;overflow: hidden;margin: 0px auto;position: relative;padding: 25px 13px 15px 13px!important;}
.box a:hover{background: #f1f1f1;padding: 25px 13px 15px 13px!important;}
</style>
<form method="POST" class="ui-from" name="myform" action="{$_M[url][own_form]}a=dosavepaymentconfig" target="_self">
    <div class="v52fmbx">
        <h3 class="v52fmbx_hr">综合管理</h3>
        <dl>
            <dt>插件开关</dt>
            <dd class="ftype_radio ftype_transverse">
                <div class="fbox">
                    <label><input name="payment_open" type="radio" value="1"data-checked="{$payment_open}">开启</label>
                    <label><input name="payment_open" type="radio" value="0">关闭</label>
                </div>
            </dd>
        </dl>
        <dl>
            <dt>接口管理</dt>
            <dd class="ftype_checkbox ftype_transverse">
                <div class="fbox">
                    <label><input name="payment_type" type="checkbox" value="1" data-checked="{$payment_type}">微信扫码</label>
                    <label><input name="payment_type" type="checkbox" value="2">财付通</label>
                    <label><input name="payment_type" type="checkbox" value="3">支付宝</label>
                    <label><input name="payment_type" type="checkbox" value="4">银联</label>
                    <label><input name="payment_type" type="checkbox" value="5">PayPal</label>
                    <label><input name="payment_type" type="checkbox" value="6">微信H5</label>
                    <!--<label><input name="payment_type" type="checkbox" value="7">网银在线</label>-->
                </div>
                <span class="tips">勾选启用，前端支付时将不显示未勾选支付途径。</span>
                <br />
                <span class="tips">接口前台显示可以每个语言单独设置。具体每个支付接口的支付设置为全站通用。</span>
            </dd>
        </dl>
        <dl class="noborder">
            <dt> </dt>
            <dd>
                <input type="submit" name="submit" value="{$_M['word']['Submitall']}" class="submit">
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
