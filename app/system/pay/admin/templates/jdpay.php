<!--<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 
defined('IN_MET') or exit('No permission');
require $this->template('ui/head');
echo <<<EOT
-->
<form method="POST" class="ui-from" name="myform" action="{$_M[url][own_form]}a=dosavejdpay&type={$jdpay_config['paytype']}" target="_self">
    <div class="v52fmbx">
        <h3 class="v52fmbx_hr">基本信息设置</h3>
        <dl>
            <dd class="ftype_description">
                特别说明：“网银在线”接口仅作为B2C直连银行支付接口使用。接口收款方为“京东钱包”，提款需进入JD钱包进行相关操作。
            </dd>
        </dl>
        <dl>
            <dt>商户编号</dt>
            <dd class="ftype_input">
                <div class="fbox">
                    <input type="text" name="jd_mid" value="{$jdpay_config['jd_mid']}">
                </div>
            </dd>
        </dl>
        <dl>
            <dt>商户密钥</dt>
            <dd class="ftype_input">
                <div class="fbox">
                    <input type="text" name="jd_key" value="{$jdpay_config['jd_key']}">
                </div>
            </dd>
        </dl>
        <dl>
            <dt>收款支付类型</dt>
            <dd class="ftype_checkbox ftype_transverse">
                <div class="fbox">
                    <label><input name="jd_payment_type" type="checkbox" value="1" data-checked="{$jdpay_config['jd_payment_type']}">储蓄卡</label>
                    <label><input name="jd_payment_type" type="checkbox" value="2">信用卡</label>
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