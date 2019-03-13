<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.

defined('IN_MET') or exit('No permission');

require $this->template('ui/head');
echo <<<EOT
-->
<form method="POST" class="ui-from" name="myform" action="{$_M['url']['own_form']}a=doparasave&module={$_M['form']['module']}&class1={$_M['form']['class1']}" target="_self">
	<div class="v52fmbx product_para">
		<table class="display dataTable ui-table new_effects" data-table-ajaxurl="{$_M['url']['own_form']}a=dojson_para_list&module={$_M['form']['module']}&class1={$_M['form']['class1']}">
			<thead>
				<tr>
					<th width="20" data-table-columnclass="met-center">
						<input data-table-chckall="id" type="checkbox"/>
					</th>
					<th>{$_M['word']['paraname']}</th>
					<th width="80" data-table-columnclass="met-center">{$_M['word']['parametertype']}</th>
					<th width="80" data-table-columnclass="met-center">{$_M['word']['category']}</th>
					<th width="60" data-table-columnclass="met-center">{$_M['word']['webaccess']}</th>
<!--
EOT;
$colspan=6;
if(strpos('345', $_M['form']['module'])===false){
	$colspan=7;
echo <<<EOT
-->
					<th width="60" data-table-columnclass="met-center">{$_M['word']['user_must_v6']}</th>
<!--
EOT;
}
echo <<<EOT
-->
					<th width="40" data-table-columnclass="met-center"> <abbr title="{$_M['word']['noorderinfo']}">{$_M['word']['sort']}</abbr>
					</th>
					<th>{$_M['word']['operate']}</th>
				</tr>
			</thead>
			<tbody></tbody>
			<tfoot>
				<tr>
					<th>
						<input type="checkbox" data-table-chckall="id"></th>
					<th colspan="{$colspan}" class="formsubmit">
						<input type="submit" name="save" value="{$_M['word']['Submit']}" class="submit" />
						<input type="submit" name="del" value="{$_M['word']['delete']}" class="submit" data-confirm='{$_M['word']['js7']}' />
						<a href="javascript:;" class="ui-addlist" data-table-addlist="{$_M['url']['own_form']}a=doparaaddlist&module={$_M['form']['module']}&class1={$_M['form']['class1']}&id={$_M['form']['id']}"> <i class="fa fa-plus-circle"></i>
							{$_M['word']['added']}
						</a>
<!--
EOT;
if($_M['form']['module']==3){
echo <<<EOT
-->
						<span class='tips pull-left'>{$_M['word']['product_para_tips']}</span>
<!--
EOT;
}
echo <<<EOT
-->
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
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title">{$_M['word']['listTitle']}</h4>
			</div>
			<div class="modal-body">
					<h3 class="example-title" style='margin-bottom: 10px;font-size: 16px;'></h3>
					<table class="display ui-table dataTable">
						<thead>
							<tr>
								<th width="20">
									<input data-table-chckall="id" type="checkbox"/>
								</th>
								<th width="50" class='text-center'><abbr title="{$_M['word']['noorderinfo']}">{$_M['word']['sort']}</abbr></th>
								<th width="400">{$_M['word']['parametervalueinfo']}</th>
								<th>{$_M['word']['operate']}</th>
							</tr>
						</thead>
						<tbody></tbody>
						<tfoot>
							<tr>
								<th>
									<input type="checkbox" data-table-chckall="id">
								</th>
								<th colspan="3" class="formsubmit">
									<input type="submit" name="del" value="{$_M['word']['delete']}" data-del-name="id" class="submit"/>
									<a href="javascript:;" class="ui-addlist" data-order-name="order">
										<i class="fa fa-plus-circle"></i>
										{$_M['word']['added']}
									</a>
									<textarea ui-addlist-html hidden>
										<tr>
											<td>
												<input name="id" type="checkbox"/>
											</td>
											<td><input type="text" name="order" class='ui-input text-center'></td>
											<td><input type="text" name="value" class='ui-input'></td>
											<td>
												<button type='button' class='btn btn-default ui-table-del'>{$_M['word']['delete']}</button>
											</td>
										</tr>
									</textarea>
								</th>
							</tr>
						</tfoot>
					</table>
					<span class="tips" style='display: inline-block;margin-top: 10px;'>{$_M['word']['tips3_v6']}</span>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary">{$_M['word']['confirm']}</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">{$_M['word']['close']}</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!--
EOT;
require $this->template('ui/foot');
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>
