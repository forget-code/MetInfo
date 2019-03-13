<!--<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.

defined('IN_MET') or exit('No permission');

require $this->template('ui/head');
echo <<<EOT
-->
<link rel="stylesheet" href="{$_M[url][own_tem]}css/metinfo.css?{$jsrand}" />
<form method="POST" class="ui-from" name="myform" action="{$_M[url][own_form]}a=dolistsave&sub_type=editor" target="_self">
<div class="v52fmbx product_index">
	<div class="v52fmbx-table-top">
		<div class="ui-float-left">
		<a class="btn btn-danger" href="javascript:;" data-table-addlist="{$_M[url][own_form]}a=doadd&bigclass=0" role="button">{$_M[word][column_addcolumn_v6]}</a>
		&nbsp;&nbsp;
		<font style=" color:#999;">{$_M[word][noorderinfo]}</font>
		</div>
		<div class="ui-float-right">
		<a class="btn btn-danger " role="button" id="expandall">{$_M[word][columntip11]}</a>
		</div>
	</div>
	<input id="class1id" name="class1" data-table-search="1" value="{$_M['form']['class1']}" class="ui-input" type="hidden" />
	<input id="class2id" name="class2" data-table-search="1" value="{$_M['form']['class2']}" class="ui-input" type="hidden" />
	<input id="class3id" name="class3" data-table-search="1" value="{$_M['form']['class3']}" class="ui-input" type="hidden" />
	<table class="display dataTable ui-table" data-table-ajaxurl="{$_M[url][own_form]}a=dojson_list"  data-table-pageLength="100000000000">
		<thead>
			<tr>
				<th width="30" data-table-columnclass="met-center">{$_M[word][selected]}</th>
				<th data-table-columnclass="met-center" width="30">
					{$_M[word][sort]}
				</th>
				<th  >
					{$_M[word][columnname]}
				</th>
				<th data-table-columnclass="met-center" width="110">
				{$_M[word][columnnav]}
				</th>
				<th data-table-columnclass="met-center" width="60">
				{$_M[word][columnmodule]}
				</th>
				<th data-table-columnclass="met-center" width="60">
				{$_M[word][columndocument]}
				</th>
				<th data-table-columnclass="met-center" width="30">
				{$_M[word][columnmark1]}
				</th>
				<th data-table-columnclass="met-center" width="150" >{$_M[word][operate]}</th>
			</tr>
		</thead>
		<tbody>
		</tbody>
		<tfoot>	
			<tr>
				<th><input name="id" type="checkbox" data-table-chckall="id" value=""></th>
				<th colspan="7" class="formsubmit">
				<div class="pull-left">
					<button type="submit" name="save" class="btn btn-default btn-primary" style="margin-left:5px;">
					{$_M[word][Submit]}</button>
					<button type="submit" name="del" class="btn btn-default btn-danger" data-confirm="{$_M['word']['js7']}</br>{$_M['word']['jsx39']}" style="margin-left:2px;">
					{$_M[word][delete]}</button>
					<a class="btn btn-default" href="javascript:;" data-table-addlist="{$_M[url][own_form]}a=doadd&bigclass=0" role="button">+{$_M[word][column_addcolumn_v6]}</a>
					</div>
					<div class="pull-right">
					<div class="pull-left padding-right-5 dropup">
						<input type="hidden" name="to_lang" value="">
						<button id="lang" class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="true">
						{$_M[word][copyotherlang1]}
						<span class="caret"></span>
						</button>	
						<ul class="dropdown-menu" data-type="move" role="menu">
						<li role="presentation" class="divider"></li>
<!--
EOT;
foreach($met_langok as $val){
	if($val['mark'] == $_M['lang'])continue;
echo <<<EOT
-->
						<li class="met-tool-list"><a class="to-lang-select" data-value="{$val['mark']}" href="javascript:;">{$val['name']}</a></li>
						<!--
EOT;
}
echo <<<EOT
-->
							</li>
							<li role="presentation" class="divider"></li>
						</ul>
					</div>

					<div class=" pull-left padding-right-15 copycontent">
          			<span class="">
            		<input type="checkbox" name="is_contents" value="1" aria-label="Checkbox for following text input">
          			</span>
          			<span class="">{$_M[word][copyotherlang2]}</span>
        			</div>
        			<div class="pull-left padding-right-15">
        			<button type="submit" name="copy" class="btn btn-default btn-warning" id="copyLang">{$_M[word][Copy]}</button>
        			</div>
					</div>
				</th>
			</tr>
		</tfoot>
	</table>
</div>
</form>

<div class="modal fade modal-primary move-modal" id="move-modal" aria-hidden="true" aria-labelledby="move-modal" role="dialog" tabindex="-1">
<div class="modal-dialog modal-lg">
	<div class="modal-content">
		<form method="POST" name="myform" action="{$_M[url][own_form]}a=domove&uplv=1">
			<input id="movenow" name="nowid" type="hidden" value=""/>
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="top: 10px;">
					<span aria-hidden="true">×</span>
				</button>
				<h4 class="modal-title">{$_M[word][column_inputcolumnfolder_v6]}</h4>
			</div>
			<div class="modal-body">
				<input type="text" class="form-control" name="foldername" placeholder="">
			</div>
			<div class="modal-footer bg-blue-grey-100">
				<button type="button" class="btn btn-default" data-dismiss="modal">{$_M['word']['indexonlieno']}</button>
				<button type="submit" class="btn btn-primary">{$_M['word']['Submit']}</button>
			</div>

		</form>
	</div>
</div>
</div>
<script>var closeText='{$_M[word][close_allchildcolumn_v6]}',
			expandText='{$_M[word][open_allchildcolumn_v6]}';</script>
<!--
EOT;
require $this->template('ui/foot');
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>
