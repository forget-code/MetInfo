<!--<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');
require $this->template('ui/head');
echo <<<EOT
-->
<form method="POST"  class="ui-from" action="{$_M[url][own_form]}a=dodel">

<div class="v52fmbx" style="border: 0px none;">

<table class="display dataTable ui-table new_effects" data-table-ajaxurl="{$_M['url']['own_form']}a=dolist_finance" data-table-pagelength="30">
    <thead>
        <tr>
            <th>用户名</th>
            <th>域名</th>
            <th>付费金额</th>
            <th>购买条数</th>
            <th>购买时间</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
    <br>
    

</table>
    </div>
</form>

<!--
EOT;
require $this->template('ui/foot');
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved..
?>