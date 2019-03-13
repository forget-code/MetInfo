<!--<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.

defined('IN_MET') or exit('No permission');

require $this->template('ui/head');
echo <<<EOT
-->
<div class="v52fmbx" style="border: 0px;">
    <header class="panel-heading">
        <div class="panel-actions"><span>{$_M['word']['smstips22']}： {$balance}</span></div>
        <div class="panel-actions"><span>{$_M['word']['timesofuse']}：{$number}</span></div>
    </header>
    <table class="display dataTable ui-table" id="user-idvalidate-buy" data-noajax>
        <thead>
            <tr>
                <th>{$_M['word']['price_yuan']}</th>
                <th>{$_M['word']['useables_times']}</th>
                <th>{$_M['word']['operate']}</th>
            </tr>
        </thead>
        <tbody>
<!--
EOT;
foreach ($package as $key => $val) {
echo <<<EOT
-->
            <tr>
                <td>{$key}.00</td>
                <td>{$val}</td>
                <td><a href='{$_M['url']['adminurl']}n=user&c=admin_set&a=doBuyRecharge&type={$key}' class='btn btn-danger recharge'>{$_M['word']['sys_purchase']}</a></td>
            </tr>
<!--
EOT;
}
echo <<<EOT
-->
        </tbody>
    </table>
</div>
<!--
EOT;
require $this->template('ui/foot');
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>