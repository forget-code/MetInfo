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
	var install_tem_url = "{$_M['url']['own_name']}c=uiset&a=doinstall_tem";
	var clear_zip_url = "{$_M['url']['own_name']}c=uiset&a=doclear_zip";
	var down_data_url = "{$_M['url']['own_name']}c=uiset&a=dodown_data";
	var unzip_data_url = "{$_M['url']['own_name']}c=uiset&a=dounzip_data";
	var import_sql_url = "{$_M['url']['own_name']}c=uiset&a=doimport_sql";
	var backup_sql_url = "{$_M['url']['site_admin']}index.php?lang={$_M['lang']}&n=databack&c=index&a=dopackdata";
	var backup_upload_url = "{$_M['url']['site_admin']}index.php?lang={$_M['lang']}&anyid=13&n=databack&c=index&a=dopackupload";
</script>
<form method="POST" name="myform" class="ui-from" action="" target="_self">
	<div class="v52fmbx">
		<dl>
			<dd class="ftype_description">
<!--
EOT;
if($_M['config']['met_agents_app']){
echo <<<EOT
-->
			{$_M['word']['met_template_metinfouserinfo']}<br>
<!--
EOT;
}
echo <<<EOT
-->
			{$_M['word']['met_template_langinfotext']}</dd>
		</dl>
	</div>
	<div class="v52fmbx">
		<table class="display dataTable ui-table" data-table-datatype="jsonp" data-table-ajaxurl="{$_M['url']['own_form']}a=dotable_temlist_json">
		    <thead>
		        <tr>
		            <th width="200" data-table-columnclass="met-center">{$_M['word']['previewimg']}</th>
		            <th width="80" data-table-columnclass="met-center">{$_M['word']['template_code']}</th>
					<th>{$_M['word']['operate']}</th>
		        </tr>
		    </thead>
		    <tfoot>
<!--
EOT;
if($_M['config']['met_agents_app']){
echo <<<EOT
-->
				<tr>
					<th colspan="2" class="formsubmit met-center">
						<a href="https://www.metinfo.cn/product" class="btn btn-default pull-left" style="top:0px;left:0px;" target="_blank">{$_M['word']['met_template_buytemplates']}</a>
					</th>
					<th colspan="1">
						<span class="tips" style="font-weight:normal; color:#666; margin-left:10px;">
						{$_M['word']['met_template_delettemplatesinfo']}
						</span>
					</th>
				</tr>
<!--
EOT;
}
echo <<<EOT
-->
			</tfoot>
		</table>
	</div>
</form>
<div class="remodal" data-remodal-id="modal"><div class="temset_box"></div></div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel" style='color:red;'>{$_M['word']['met_template_demoinstalltitle']}</h4>
            </div>
            <div class="modal-body ">
			<p>{$_M['word']['met_template_demoinstallsel']}</p>
			<p>1.<strong>{$_M['word']['met_template_demoinstallt1']}</strong></p>
			<p>2.{$_M['word']['met_template_demoinstallt2']}</p>
			<p>3.{$_M['word']['met_template_demoinstallt3']}</p>
            </div>
            <input type="hidden" name="url">
            <input type="hidden" name="skin_name">
            <div class="modal-footer">
				<button type="button" class="btn btn-primary" id="backup_recovery">{$_M['word']['met_template_saveinstall']}</button>
                <button type="button" class="btn btn-danger" id="recovery">{$_M['word']['met_template_installnewmetinfo']}</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">{$_M['word']['cancel']}</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel" style='color:red;'>{$_M['word']['met_template_demoinstalltitle']}</h4>
            </div>
            <div class="modal-body">
				<iframe src="" frameborder="0"></iframe>
			</div>
        </div>
    </div>
</div>
<!--
EOT;
require $this->template('ui/foot');
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>