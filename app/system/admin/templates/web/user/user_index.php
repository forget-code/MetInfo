<!--<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');

require $this->template('ui/head');
echo <<<EOT
-->
<form method="POST" class="ui-from" name="myform" action="{$_M[url][own_form]}a=dodellist" target="_self">
<div class="v52fmbx">
	<div class="v52fmbx-table-top">
		<div class="ui-float-right">
			<div class="ui-table-search">
				<i class="fa fa-search"></i>
				<input name="keyword" data-table-search="1" type="text" value="" class="ui-input" placeholder="用户名/邮箱/手机">
			</div>
		</div>
	</div>
	<table class="display dataTable ui-table new_effects" data-table-ajaxurl="{$_M[url][own_form]}a=dojson_user_list"  data-table-pageLength="20">
		<thead>
			<tr>
				<th width="20" data-table-columnclass="met-center"><input name="id" data-table-chckall="id" type="checkbox" value="" /></th>
				<th>用户名</th>
				<th data-table-columnclass="met-center" width="100">
<select name="groupid" data-table-search="1">
	<option value="">会员组</option>
<!--
EOT;
foreach($this->grouplist as $val){
echo <<<EOT
-->
	<option value="{$val[id]}">{$val[name]}</option>
<!--
EOT;
}
echo <<<EOT
-->
</select>
				</th>
				<th data-table-columnclass="met-center">注册时间</th>
				<th data-table-columnclass="met-center">最后活跃</th>
				<th data-table-columnclass="met-center" width="50">登录次数</th>
				<th data-table-columnclass="met-center" width="50">是否激活</th>
				<th data-table-columnclass="met-center" width="80">来源</th>
				<th>操作</th>
			</tr>
		</thead>
		<tbody>
		</tbody>
		<tfoot>
			<tr>
				<th><input name="id" type="checkbox" data-table-chckall="id" value=""></th>
				<th colspan="8" class="formsubmit">
					<input type="submit" name="del" value="{$_M['word']['delete']}" class="submit" data-confirm='{$_M[word][js7]}' />
					<a href="{$_M[url][own_form]}a=doadd" class="ui-addlist"><i class="fa fa-plus-circle"></i>{$_M['word']['memberAdd']}</a>
					<a href="{$_M[url][own_form]}a=dousercsv" class="btn btn-info pull-right usercsv" title="下载CSV文件">导出会员</a>
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