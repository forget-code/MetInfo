<!--<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');

require $this->template('ui/head');

echo <<<EOT
-->

<form method="POST" class="ui-from" name="myform" action="{$_M[url][own_form]}a=dosave" target="_self">
    <div class="v52fmbx">
        <table class="display dataTable ui-table" data-table-ajaxurl="{$_M[url][own_form]}a=dotable_list_json" data-table-pagelength="15">
            <thead>
                <tr>
                    <th colspan="5">
                        <span>{$_M[word][recyclere_tips1_v6]}</span>
                        <select name="search_fod" data-table-search="1">
                            <option value="0">{$_M[word][allcategory]}</option>
                            <option value="2">{$_M[word][recyclenew]}</option>
                            <option value="3">{$_M[word][recycleproduct]}</option>
                            <option value="4">{$_M[word][recycledownload]}</option>
                            <option value="5">{$_M[word][recycleimg]}</option>
                        </select>


                        <select name="search_lang" data-table-search="1">
                            <option value="0">{$_M[word][langselect]}</option>
EOT;
foreach ($langlist as $val) {
    echo "<option value='{$val['lang']}'>{$val['name']}</option>";
}
echo <<<EOT
                        </select>
                        <div class="ui-table-search">
                            <i class="fa fa-search"></i>
                            <input name="search_title" data-table-search="1" type="text" value="" class="ui-input" placeholder="{$_M[word][column_searchname]}" style="width:120px;">
                        </div>
                    </th>
                </tr>
                <tr>
                    <th width="25">{$_M[word][selected]}</th>
                    <th style="width:50%">{$_M[word][title]}</th>
                    <th width="50">{$_M[word][recycledietime]}</th>
                    <th width="50">{$_M[word][category]}</th>
                    <th width="70">{$_M[word][operate]}</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
            <tfoot>
             <tr>
                <th>
                <input name="id" type="checkbox" data-table-chckall="id" value=""></th>
                <th colspan="4" class="formsubmit">
                    <input type="submit" name="restore" value="{$_M[word][recyclere]}" class="submit">
                    <input type="submit" name="delete" value="{$_M[word][delete]}" class="submit" data-confirm='{$_M[word][js7]}'>
                </th>
             </tr>
            </tfoot>
        </table>
    </div>
</form>
<!--
EOT;
require $this->template('ui/foot');
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>