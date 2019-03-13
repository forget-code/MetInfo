<!--<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.

defined('IN_MET') or exit('No permission');

require $this->template('ui/head');
echo <<<EOT
-->

<link rel="stylesheet" href="{$_M[url][own]}templates/css/metinfo.css?{$jsrand}" />
<script type="text/javascript">
	var import_url = "{$_M['url']['own_name']}c=uiset&a=dotemplate_import";
	var update_url = "{$_M['url']['own_name']}c=uiset&a=docheck_update";
	var download_ui_url = "{$_M['url']['own_name']}c=uiset&a=dodownload_ui";
</script>
<form method="POST" name="myform" class="ui-from" action="" target="_self">
	<div class="v52fmbx">

		<table class="display dataTable ui-table" data-table-datatype="jsonp" data-table-ajaxurl="{$_M['url']['own_form']}a=dotable_temlist_json">
		    <thead>
		        <tr>
		            <th width="200" data-table-columnclass="met-center">预览图</th>
		            <th width="80" data-table-columnclass="met-center">模板编号</th>
					<th>操作</th>

		        </tr>
		    </thead>
		</table>
	</div>
</form>
<div class="remodal" data-remodal-id="modal"><div class="temset_box"></div></div>
<!--
EOT;
require $this->template('ui/foot');

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>