<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.
require_once $this->template('ui/head');
echo <<<EOT
-->
<div class="v52fmbx_tbmax">
    <span class="xtips red">{$_M[word][unitytxt_7]}</span>
    <table class="ui-table display dataTable" cellpadding="2" cellspacing="1" data-noajax='1'>
        <tr>
            <td width="40" class="list">{$_M[word][smstips17]}</td>
            <td width="100" class="list">{$_M[word][type]}</td>
            <td width="360" class="list">{$_M[word][setdbFilename]}</td>
            <td width="80" class="list">{$_M[word][setdbFilesize]}</td>
            <td width="160" class="list">{$_M[word][setdbTime]}</td>
            <td class="list list_left">{$_M[word][operate]}</td>
        </tr>

<!--
EOT;
if(count($metinfodata)>0){
$i=0;
foreach($metinfodata as $id => $info){
$i++;
$info[lhtml]="";
if($info[type]=='web'||$info[type]=='upload'){
$info[lhtml]="onClick=\"return linkSmit($(this),1,'{$_M[word][unitytxt_51]}');\"";
}
echo <<<EOT
-->
        <tr class="mouse">
            <td class="list-text">{$i}</td>
            <td class="list-text">{$info[typename]}</td>
            <td class="list-text">{$info[filename]}</td>
            <td class="list-text">{$info[filesize]} MB</td>
            <td class="list-text">{$info[maketime]}</td>
            <td class="list-text list_left">
                <a href="{$_M[url][own_form]}a=dodelete&filenames=$info[filename]&fileon={$info[type]}" onClick="return linkSmit($(this),1);" title="{$_M[word][delete]}">{$_M[word][delete]}</a>
                &nbsp;&nbsp;
                <a href="{$adminurl}/databack/{$info[type]}/$info[filename]" target="_blank" {$info[lhtml]} title="{$_M[word][setdbDownload]}">{$_M[word][setdbDownload]}</a>
            </td>
        </tr>
<!--
EOT;
}
}else{
echo <<<EOT
-->
        <tr><td colspan="6" class="list-text list_left color999">{$_M[word][dataexplain1]}</td></tr>
<!--
EOT;
}
echo <<<EOT
-->
    </table>
</div>
<!--
EOT;
require_once $this->template('ui/foot');
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>