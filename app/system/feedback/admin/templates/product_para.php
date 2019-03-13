<!--<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');

require $this->template('ui/head');
echo <<<EOT
-->
<form method="POST" class="ui-from" name="myform" action="{$_M[url][own_form]}a=doparasave" target="_self">
<div class="v52fmbx product_para">
	<table class="display dataTable ui-table new_effects" data-table-ajaxurl="{$_M[url][own_form]}a=dojson_para_list">
		<thead>
			<tr>
				<th width="20" data-table-columnclass="met-center"><input name="id" data-table-chckall="id" type="checkbox" value="" /></th>
				<th>名称</th>
				<th width="80" data-table-columnclass="met-center">{$_M[word][parametertype]}</th>
				<th width="60" data-table-columnclass="met-center">{$_M[word][category]}</th>
				<th width="60" data-table-columnclass="met-center">{$_M[word][webaccess]}</th>
				<th width="40" data-table-columnclass="met-center"><abbr title="{$_M[word][noorderinfo]}">{$_M[word][sort]}</abbr></th>
				<th>{$_M[word][operate]}</th>
			</tr>
		</thead>
		<tbody>
		</tbody>
		<tfoot>
			<tr>
				<th><input name="id" type="checkbox" data-table-chckall="id" value=""></th>
				<th colspan="6" class="formsubmit">
					<input type="submit" name="save" value="{$_M[word][save]}" class="submit" />
					<input type="submit" name="del" value="{$_M['word']['delete']}" class="submit" data-confirm='{$_M[word][js7]}' />
					<a href="#" class="ui-addlist" data-table-addlist="{$_M[url][own_form]}a=doparaaddlist"><i class="fa fa-plus-circle"></i>{$_M[word][added]}</a>
				</th>
			</tr>
		</tfoot>
	</table>
</div>
</form>
<div class="modal fade" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">{$_M[word][listTitle]}</h4>
      </div>
      <div class="modal-body">
		<div class="v52fmbx" style="border:0;">
			<dl style="border:0;">
				<dt>{$_M[word][admin_tagadder_v6]}</dt>
				<dd class="ftype_tags">
					<div class="fbox">
						<input name="option" type="hidden" data-label="$|$" value="">
					</div>
					<span class="tips">{$_M[word][tips3_v6]}</span>
				</dd>
			</dl>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary">{$_M[word][confirm]}</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">{$_M[word][close]}</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!--
EOT;
require $this->template('ui/foot');
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>