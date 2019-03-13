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
				<th width="80" data-table-columnclass="met-center">字段类型</th>
				<th width="60" data-table-columnclass="met-center">所属栏目</th>
				<th width="60" data-table-columnclass="met-center">访问权限</th>
				<th width="40" data-table-columnclass="met-center"><abbr title="数值越小越靠前">排序</abbr></th>
				<th>操作</th>
			</tr>
		</thead>
		<tbody>
		</tbody>
		<tfoot>
			<tr>
				<th><input name="id" type="checkbox" data-table-chckall="id" value=""></th>
				<th colspan="6" class="formsubmit">
					<input type="submit" name="save" value="保存" class="submit" />
					<input type="submit" name="del" value="{$_M['word']['delete']}" class="submit" data-confirm='{$_M[word][js7]}' />
					<a href="#" class="ui-addlist" data-table-addlist="{$_M[url][own_form]}a=doparaaddlist"><i class="fa fa-plus-circle"></i>新增</a>
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
        <h4 class="modal-title">设置选项</h4>
      </div>
      <div class="modal-body">
		<div class="v52fmbx" style="border:0;">
			<dl style="border:0;">
				<dt>标签增加器</dt>
				<dd class="ftype_tags">
					<div class="fbox">
						<input name="option" type="hidden" data-label="$|$" value="">
					</div>
					<span class="tips">点击 + 号输入选项名，再点击 + 号或回车完成添加</span>
				</dd>
			</dl>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary">确定</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
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