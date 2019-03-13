<!--<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');
require $this->template('ui/head');
echo <<<EOT
-->
<script>
var send_url = "{$_M['url']['own_form']}a=dosend"

</script>
<form class="ui-from" >

<div class="v52fmbx" >
<style type="text/css">
    .textarea:{resize:both;}
    .red{color:red;}
</style>

<dl>
<dd class="ftype_description">
短信内容有非法关键词可能会被拦截，费用无法退回，所以建议先给2、3个手机号码试发一次。
<br>
请注册充值后，及时查收余额

<br>
群发短信提示文字，群发短信需要人工审核，请选择周一至周日9：00-18:00发送短信。审核时间为15-60分钟左右
<br>
短信签名提示文字要添加，签名审核需要人工审核，审核时间为1个工作日内
<br>
测试短信请只填写 测试，其他文字可能导致短信无法发送成功
</dd>

</dl>


<dl>
    <dt>短信内容</dt>
    <dd class="ftype_textarea">
        <div class="fbox">
            <textarea style="resize: both" name="sms_content" >测试</textarea>

        </div>
       
        <span>中文/英文第一条66个字，第二条起64个字,超过字数算将切分为多条短信</span>
        <span> 当前字数：<b class="red str_now">0/66</b> 个字 (共 <b class="red str_count">0</b> 条短信)</span>
    </dd>
</dl>

<dl>
    <dt>手机号码</dt>
    <dd class="ftype_textarea">
        <div class="fbox">
            <textarea style="resize: both"  name="sms_phone" ></textarea>
        </div>
        <span>请填写接收短信的手机号码
多个手机号码请换行
一次不超过800个手机号码 当前共 <b class="red phone_count">0</b> 个号码</span>
    </dd>
</dl>

<dl class="noborder">
         
            <dd>
                <input type="submit" name="submit" class="submit sms_submit" value="发送" style="float:left;margin-right: 10px">
                <p class="sms_msg"  style="padding:10px;color:red"></p>
            </dd>
        </dl>
        
    </div>
</form>

<!--
EOT;
require $this->template('ui/foot');
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved..
?>