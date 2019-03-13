<!--<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');

require $this->template('own/head');
echo <<<EOT
-->
<div class="appbox_left">
<div class="appbox_left_box">
	<div class="v52fmbx tempservice">
		<h3 class="v52fmbx_hr" style="border:1px solid #ddd; border-bottom:0;">{$_M[word][appstore_descript26_v6]}</h3>
		<div class="applistdiv">
		<table class="display dataTable ui-table" data-table-ajaxurl="{$_M['url']['app_api']}a=dotable_tempservicelist_json&info_id={$result['columnid']}&stat_key={$result['value']}&lang={$_M['lang']}&user_key={$_M['config']['met_secret_key']}" data-table-pagelength="20" data-table-datatype="jsonp">
			<thead>
				<tr>
					<th width="100" data-table-columnclass="met-center">{$_M[word][appstore_sign_v6]}</th>
					<th width="200">{$_M[word][appstore_name_v6]}</th>
					<th width="50" data-table-columnclass="met-center">{$_M[word][appstore_type_v6]}</th>
					<th>服务</th>
					<th width="90" data-table-columnclass="met-center">{$_M[word][appstore_place_v6]}</th>
					<th data-table-columnclass="met-center">{$_M[word][appstore_Abilityvalue_v6]}</th>
					<th width="80" data-table-columnclass="met-center">{$_M[word][linkcontact]}</th>
				</tr>
			</thead>
			<tbody>
				
			</tbody>
			<tfoot>
				<tr>
					<th colspan="7" class="formsubmit" style="text-align:right!important;">
						<a href="javascript:;" class="shangjiaruzhu">{$_M[word][appstore_descript27_v6]}</a>
						<textarea class="none">
							<div class="v52fmbx">
								<h3 class="v52fmbx_hr">{$_M[word][appstore_descript28_v6]}</h3>
								<dl>
									<dt>{$_M[word][appstore_Admissionrequirements_v6]}</dt>
									<dd style="color:#333;">
									<ul style="list-style-type: disc;">
									<li>{$_M[word][appstore_descript29_v6]}<br/><span class="tips">{$_M[word][appstore_descript30_v6]}</span>
									<a href="http://ke.qq.com/cgi-bin/courseDetail?course_id=32691" target="_blank">{$_M[word][appstore_descript31_v6]}</a></li>
									<li>{$_M[word][appstore_descript32_v6]}</li>
									</ul>
									</dd>
								</dl>
								<dl>
									<dt>{$_M[word][appstore_Admissionprocess_v6]}</dt>
									<dd style="color:#333;">
									{$_M[word][appstore_descript33_v6]}<a href="http://wpa.qq.com/msgrd?v=3&amp;uin=2545740365&amp;site=qq&amp;menu=yes" target="_blank"><img alt="{$_M[word][appstore_descript34_v6]}" border="0" src="http://wpa.qq.com/pa?p=2:2545740365:47" title={$_M[word][appstore_descript34_v6]}"></a>。<br/>
									{$_M[word][appstore_descript35_v6]}<br/>
									{$_M[word][appstore_descript36_v6]}<br/>
									{$_M[word][appstore_descript37_v6]}<br/>
									{$_M[word][appstore_descript38_v6]}
									</dd>
								</dl>
								<dl>
									<dd class="ftype_description">
									{$_M[word][appstore_descript39_v6]}
									</dd>
								</dl>
							</div>
						</textarea>
					</th>
				</tr>
			</tfoot>
		</table>
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