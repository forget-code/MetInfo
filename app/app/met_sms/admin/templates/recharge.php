<!--<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');
require $this->template('ui/head');

echo <<<EOT
-->
<script>
var recharge_url = "{$_M['url']['own_form']}a=doadd_buy"
var index_url = "{$_M['url']['own_form']}a=doindex"
</script>


<div class="v52fmbx" >
        <p class="pull-right">账户余额：<span class="money">￥ {$balance}</span></p>
    <table class="display ui-table" data-table-ajaxurl="{$_M[url][own_form]}a=dopackage">
        <thead>
            <tr>
                <th>价格/元</th>
                <th>短信条数/条</th>
                <th>购买</th>
            </tr>
        </thead>
        <tbody>
            
        </tbody>
    </table>

        
    </div>

<div id="mywindow" style="display:none;">
<span>提示</span>
<br>
<span class="pull-left">1、短信购买后无法退还</span>
<br>
<span class="pull-left">2、测试短信发送速度，请先充值1元测试短信发送速度。</span>
        
        
</div>

<!--
EOT;
require $this->template('ui/foot');
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved..
?>