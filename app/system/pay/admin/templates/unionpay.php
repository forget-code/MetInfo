<!--<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 
defined('IN_MET') or exit('No permission');
require $this->template('ui/head');
echo <<<EOT
-->
<form method="POST" class="ui-from" name="myform" action="{$_M[url][own_form]}a=dosaveunionpay&type={$paytype}" target="_self">
    <div class="v52fmbx">
        <h3 class="v52fmbx_hr">基本信息设置</h3>
        <dl>
            <dt>商户号</dt>
            <dd class="ftype_input">
                <div class="fbox">
                    <input type="text" name="merid" value="{$merid}">
                </div>
            </dd>
        </dl>
        <h3 class="v52fmbx_hr">证书路径设置</h3>
        <dl>
            <dd class="ftype_description">
                上传证书前，请先至“安全=>安全与效率”中添加“pfx”、“cer”为“允许上传的文件格式”
            </dd>
        </dl>
        <dl>
            <dt>商户私钥证书</dt>
            <dd class="ftype_upload">
                <div class="fbox">
                    <input name="sign_cert_path" type="text" data-upload-type="doupfile" value="{$sign_cert_path}"/>
                </div>
            </dd>
        </dl>
        <dl>
            <dt>签名使用密码</dt>
            <dd class="ftype_input">
                <div class="fbox">
                    <input type="text" name="sign_cert_pwd" value="{$sign_cert_pwd}">
                </div>
            </dd>
        </dl>
        <dl>
            <dt>银联公钥证书</dt>
            <dd class="ftype_upload">
                <div class="fbox">
                    <input name="encrypt_cert_path" type="text" data-upload-type="doupfile" value="{$encrypt_cert_path}"/>
                </div>
            </dd>
        </dl>
		<!--
        <h3 class="v52fmbx_hr">日志配置</h3>
        <dl>
            <dt>日志级别</dt>
            <dd class="ftype_radio ftype_transverse">
                <div class="fbox">
                    <label><input name="log_level" type="radio" value="1" data-checked="{$log_level}">开启日志</label>
                    <label><input name="log_level" type="radio" value="0">关闭日志</label>
                </div>
            </dd>
        </dl>\
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