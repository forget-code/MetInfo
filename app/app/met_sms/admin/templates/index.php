<!--<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');
require $this->template('ui/head');
$total = $total ? $total : "0";

$old_status = $old > 0 ? '' : 'hide';

echo <<<EOT
-->
<form class="ui-from" action="{$_M['url']['own_form']}a=doindex" method="post">

<div class="v52fmbx" >
<style type="text/css">
    .textarea:{resize:both;}
</style>

<dl>
<dd class="ftype_description">
1、短信签名建议为用户真实应用名/网站名/公司名。
<br>
2、单个签名长度介于 2 到 8 个字符之间 
<br>
3、无须添加【】、()、[]符号，短信发送会自带【】、()、[]符号，避免重复
<br>
4、签名审核需要人工审核，审核时间为1个工作日内
</dd>
</dl>

<dl>
    <dt>剩余条数 </dt>
    <dd class="ftype_input">
            <span class='balance'>{$total} </span><a href={$_M['url']['own_form']}a=dobuy> 购买</a> 
    </dd>
    <dd>{$old_sms}</dd>
</dl>
 <dl>
        <dt>短信签名</dt>
        <dd class="ftype_input">
            <div class="fbox">
                <input type="text" name="sms_sign" style="width:160px;" value="{$res['sign']}" class='sms_sign'>
                    <i class="glyphicon glyphicon-info-sign" data-toggle="tooltip"
                        data-placement="right" title="{$msg}"></i>
            </div>
        </dd>
    </dl>

<dl class="{$old_status}">
    <dt>老接口 </dt>
    <dd style="color:#000">
        剩余条数<b> {$old} </b>条,一键 <a href={$_M['url']['own_form']}a=domigrate>导入 </a>到新短信账户
    </dd>
</dl>

<dl class='hide error'>
<dd>
    <div class="col-xs-4">
       <div class="alert alert-danger " style="margin-bottom:0px;padding:10px;">
            <span class='msg'></span>
        </div>
    </div>
</dd>
    
</dl>

<dl class="noborder">
         
            <dd>
                <input type="submit"class="submit " value="保存" >
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