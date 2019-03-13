<!--<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 
defined('IN_MET') or exit('No permission');
require $this->template('ui/head');
echo <<<EOT
-->
<form method="POST" class="ui-from" name="myform" action="{$_M[url][own_form]}a=dosavewxpay&type={$paytype}" target="_self">
    <div class="v52fmbx">
        <h3 class="v52fmbx_hr">基本信息设置</h3>
        <dl>
            <dt>公众账号ID</dt>
            <dd class="ftype_input">
                <div class="fbox">
                    <input type="text" name="app_id" value="{$app_id}">
                </div>
                <span class="tips">绑定支付的APPID（必须配置，开户邮件中可查看）</span>
            </dd>
        </dl>
        <dl>
            <dt>商户号</dt>
            <dd class="ftype_input">
                <div class="fbox">
                    <input type="text" name="app_mchid" value="{$app_mchid}">
                </div>
                <span class="tips">商户号（必须配置，开户邮件中可查看）</span>
            </dd>
        </dl>
        <dl>
            <dt>商户支付密钥</dt>
            <dd class="ftype_input">
                <div class="fbox">
                    <input type="text" name="app_key" value="{$app_key}">
                </div>
                <span class="tips">商户支付密钥，参考开户邮件设置（必须配置，登录商户平台自行设置）</span>
            </dd>
        </dl>
        <dl>
            <dt>公众帐号secert</dt>
            <dd class="ftype_input">
                <div class="fbox">
                    <input type="text" name="app_secert" value="{$app_secert}">
                </div>
                <span class="tips">公众帐号secert（仅JSAPI支付的时候需要配置， 登录公众平台，进入开发者中心可设置）</span>
            </dd>
        </dl>
		<dl>
			<dd class="ftype_description">
			微信公众号支付（微信手机客户端内支付），请按<a href="https://pay.weixin.qq.com/wiki/doc/api/jsapi.php?chapter=7_3">教程</a>，设置支付授权目录为"{$_M['url']['site']}shop/，{$_M['url']['site']}pay/"
			</dd>
		</dl>
		<!--
        <h3 class="v52fmbx_hr">证书路径设置</h3>
        <dl>
            <dd class="ftype_description">
                证书路径,注意应该填写绝对路径（仅退款、撤销订单时需要，可登录商户平台下载，API证书下载地址：https://pay.weixin.qq.com/index.php/account/api_cert，下载之前需要安装商户操作证书）<br />
                上传证书前，请先至“安全=>安全与效率”中添加“pem”为“允许上传的文件格式”
            </dd>
        </dl>
        <dl>
            <dt>证书</dt>
            <dd class="ftype_upload">
                <div class="fbox">
                    <input name="apiclient_cert" type="text" data-upload-type="doupfile" value="{$apiclient_cert}"/>
                </div>
            </dd>
        </dl>
        <dl>
            <dt>证书密钥</dt>
            <dd class="ftype_upload">
                <div class="fbox">
                    <input name="apiclient_key" type="text" data-upload-type="doupfile" value="{$apiclient_key}"/>
                </div>
            </dd>
        </dl>
        <h3 class="v52fmbx_hr">curl代理设置</h3>
        <dl>
            <dd class="ftype_description">
                这里设置代理机器，只有需要代理的时候才设置，不需要代理，请设置为0.0.0.0和0.本例程通过curl使用HTTP POST方法，此处可修改代理服务器，默认CURL_PROXY_HOST=0.0.0.0和CURL_PROXY_PORT=0，此时不开启代理（如有需要才设置）
            </dd>
        </dl>
        <dl>
            <dt>代理主机</dt>
            <dd class="ftype_input">
                <div class="fbox">
                    <input type="text" name="proxy_host" value="{$proxy_host}">
                </div>
            </dd>
        </dl>
        <dl>
            <dt>代理端口</dt>
            <dd class="ftype_input">
                <div class="fbox">
                    <input type="text" name="proxy_port" value="{$proxy_port}">
                </div>
            </dd>
        </dl>
        <h3 class="v52fmbx_hr">上报信息配置</h3>
        <dl>
            <dd class="ftype_description">
                接口调用上报等级，默认紧错误上报（注意：上报超时间为【1s】，上报无论成败【永不抛出异常】，不会影响接口调用流程），开启上报之后，方便微信监控请求调用的质量，建议至少开启错误上报。
            </dd>
        </dl>
        <dl>
            <dt>上报等级</dt>
            <dd class="ftype_radio ftype_transverse">
                <div class="fbox">
                    <label><input name="report_lev" type="radio" value="0" data-checked="{$report_lev}">关闭上报</label>
                    <label><input name="report_lev" type="radio" value="1">仅错误出错上报</label>
                    <label><input name="report_lev" type="radio" value="2">全量上报</label>
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