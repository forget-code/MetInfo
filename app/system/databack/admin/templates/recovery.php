<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.
require_once $this->template('ui/head');

echo <<<EOT
-->
<div class="v52fmbx_tbmax">
<table class="ui-table display dataTable" cellpadding="2" cellspacing="1" data-noajax='1'>
	<tr>
        <td width="40" class="list">{$_M[word][smstips17]}</td>
        <td width="60" class="list">{$_M[word][setdbFilename]}</td>
         <td width="80" class="list">{$_M[word][webupate6]}</td>
		<td width="60" class="list">{$_M[word][setdbsysver]}</td>
        <td width="100" class="list">{$_M[word][setdbFilesize]}</td>
        <td width="160" class="list">{$_M[word][setdbTime]}</td>
        <td width="60" class="list">{$_M[word][setdbNumber]}</td>
        <td class="list list_left">{$_M[word][operate]}</td>
	</tr>
<!--
EOT;
if($infos){
$i=0;
foreach($infos as $id => $info){
$filenamearray=explode(".sql",$info[filename]);
$i++;
echo <<<EOT
-->
            <tr class="mouse">
            <td class="list-text">$i</td>
            <td class="list-text">$info[filename]</td>
            <td class="list-text">$info[typename]</td>
			<td class="list-text">{$info[ver]}</td>
            <td class="list-text">{$info[filesize]} MB</td>
            <td class="list-text">$info[maketime]</td>
            <td class="list-text">$info[number]</td>
            <td class="list-text list_left">
<!--
EOT;
if($info[error]==1){
echo <<<EOT
-->
			{$_M[word][setdbLack]}&nbsp;
			<a href={$_M['url']['own_form']}a=dodelete&filenames=$id&rutnmt=import" onclick="return linkSmit($(this),1);" title="{$_M[word][delete]}">{$_M[word][delete]}</a>&nbsp;
			<a href="{$_M['url']['own_form']}a=dodownload&file={$info['pre']}&type=sql" target="_self" title="{$_M[word][setdbDownload]}">{$_M[word][setdbDownload]}</a>
<!--
EOT;
}elseif($info[error]==2){
echo <<<EOT
-->
			{$_M[word][unitytxt_6]}&nbsp;
			<a href="{$_M['url']['own_form']}a=dodelete&filenames=$id&rutnmt=import" onclick="return linkSmit($(this),1);" title="{$_M[word][delete]}">{$_M[word][delete]}</a>&nbsp;
			<a href="{$_M['url']['own_form']}a=dodownload&file={$info['pre']}&type=sql" target="_self" title="{$_M[word][setdbDownload]}">{$_M[word][setdbDownload]}</a>
<!--
EOT;
}else{
echo <<<EOT
-->
			<a href="{$_M['url']['own_form']}a=doimport&pre={$info['pre']}" data-pre='{$info['pre']}' title="{$_M[word][setdbImportData]}" class='import-data'>{$_M[word][setdbImportData]}</a>&nbsp;
	        <a href="{$_M['url']['own_form']}a=dodelete&filenames=$id&rutnmt=import" onclick="return linkSmit($(this),1);" title="{$_M[word][delete]}">{$_M[word][delete]}</a>&nbsp;
	        <a href="{$_M['url']['own_form']}a=dodownload&file={$info['pre']}&type=sql" target="_self" title="{$_M[word][setdbDownload]}">{$_M[word][setdbDownload]}</a></td>
<!--
EOT;
}
echo <<<EOT
-->
			</tr>
<!--
EOT;
}
}else{
echo <<<EOT
-->
		<tr><td class="list-text list_left color999" colspan="7">{$_M[word][dataexplain1]}</td></tr>
<!--
EOT;
}
foreach ($zips as $key => $zip) {
	$i++;
echo <<<EOT
-->
 <tr class="mouse">
            <td class="list-text">$i</td>
            <td class="list-text">$zip[filename]</td>
            <td class="list-text">$zip[typename]</td>
			<td class="list-text"></td>
            <td class="list-text">{$zip[filesize]} MB</td>
            <td class="list-text">$zip[maketime]</td>
            <td class="list-text"></td>
            <td class="list-text list_left">
<!--
EOT;
$unzip = "";
if($zip['type'] == 'upload'){
	$unzip = "<a href=\"javascript:;\" class=\"unzip_upload\" data-url=\"{$_M['url']['own_form']}a=dounzip_upload&file={$zip['filename']}\" >{$_M[word][webupate7]}</a>&nbsp;";
}
echo <<<EOT
-->

			{$unzip}
	        <a href="javascript:;" class="delete_zip" data-url="{$_M['url']['own_form']}a=dodelete_zip&file={$zip['filename']}" data-type="{$zip['type']}">{$_M[word][delete]}</a>&nbsp;
	        <a href="{$_M['url']['own_form']}a=dodownload&file={$zip['filename']}&type={$zip['type']}" target="_self" >{$_M[word][setdbDownload]}</a></td>

 </tr>
<!--
EOT;

}

echo <<<EOT
-->
<tr>
	<td class="list"></td>

	<td class="list list_normal list_left" colspan="7">
		<span class="tips">{$_M[word][dataexplain2]}</span><br>
		<div style='position:relative;height:34px;'>
			<input name="met_upsql" type="file" id='file_upload'/>
		</div>
	</td>
</tr>
</table>
</div>
<div class="modal fade import-user-modal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title">{$_M['word']['webupate8']}</h4>
			</div>
			<div class="modal-body">
			</div>
			<div class="modal-footer" style='text-align: center;'>
				<a data-url='{$_M['url']['own_form']}a=dosql_execute&dosubmit=1&dosubmit1=0&pre=' class='btn btn-success import-user' style='margin-right:10px;'>{$_M['word']['webupate9']}</a>
				<a data-url='{$_M['url']['own_form']}a=dosql_execute&dosubmit=1&dosubmit1=1&pre=' class='btn btn-primary noimport-user' style='margin-right:10px;'>{$_M['word']['webupate10']}</a>
				<button type="button" class='btn btn-default' data-dismiss="modal">{$_M['word']['webupate11']}</button>
			</div>
		</div>
	</div>
</div>
<script>var adminurls="{$adminurl}";</script>
<!--
EOT;
require_once $this->template('ui/foot');
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>