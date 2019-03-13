<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/1
 * Time: 10:38
 */
defined('IN_MET') or exit('No permission');
require $this->template('ui/head');
echo <<<EOT
-->
<form method="POST" name="myform" class="ui-from" action="{$_M[url][own_form]}a=dosave" target="_self">
    <div class="v52fmbx">
        <div class="ui-float-left">
            <a href="javascript:;" class="ui-addlist" data-table-addlist="{$_M[url][own_form]}a=do_table_add_list"><i class="fa fa-plus-circle"></i>{$_M[word][online_addkefu_v6]}</a>
        </div>
        <table class="display dataTable ui-table" data-table-ajaxurl="{$_M[url][own_form]}a=doonline_list_json" data-table-pagelength="20">
            <thead>
                <tr>
                    <td colspan="9" class="centle" style="font-weight:normal;">
                        <span style="color:red">{$_M[word][online_tips1_v6]}</span>
                    </td>
                </tr>
                <tr>
                    <th width="20" data-table-columnclass="met-center"><input name="id" data-table-chckall="id" type="checkbox" value="" /></th>
                    <th width="25" data-table-columnclass="met-center">{$_M[word][sort]}</th>
                    <th width="40" style="width:15%">{$_M[word][online_csname_v6]}</th>
                    <th width="40" style="width:15%">QQ</th>
                    <th width="40" style="width:15%">Facebook</th>
                    <th width="40" style="width:15%">{$_M[word][online_taobaocs_v6]}</th>
                    <th width="40" style="width:15%">{$_M[word][online_alics_v6]}</th>
                    <th width="40" style="width:15%">SKYPE</th>
                    <th width="30" style="width:5%">{$_M[word][operate]}</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
            <tfoot>
            <tr>
             <th>
                <input name="id" type="checkbox" data-table-chckall="id" value=""></th>
                <th colspan="8" class="formsubmit">
                    <input type="submit" name="save" value="{$_M[word][Submit]}" class="submit">
                    <input type="submit" name="del" value="{$_M[word][delete]}" class="submit">
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
