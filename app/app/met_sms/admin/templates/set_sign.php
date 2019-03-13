<!--<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');
require $this->template('ui/head');
$total = $total ? $total : "0";
echo <<<EOT
-->
<form class="ui-from" action="{$_M['url']['own_form']}a=doset_sign" method="post">

<div class="v52fmbx" >
<style type="text/css">
    .textarea:{resize:both;}
</style>


<dl class='hide error'>
<dd>
    <div class="col-xs-4">
       <div class="alert alert-danger " style="margin-bottom:0px;padding:10px;">
            <span class='msg'></span>
        </div>
    </div>
</dd>
    
</dl>

    <dl>
        <dt>短信签名</dt>
        <dd class="ftype_input">
            <div class="fbox">
                <input type="text" name="sms_sign" style="width:160px;" value="{$res['sign']}" class='sms_sign'>
                    <i class="glyphicon glyphicon-info-sign" data-toggle="tooltip"
                        data-placement="right" title="{$msg}"></i>
                        <span>{$error}</span>
            </div>
        </dd>
    </dl>

<dl class="noborder">
         
            <dd>
                <input type="submit" name="submit" class="submit" value="确定">
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