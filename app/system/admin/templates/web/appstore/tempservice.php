<!--<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');

require $this->template('tem/head');
echo <<<EOT
-->
<div class="appbox_left">
<div class="appbox_left_box">
	<div class="v52fmbx tempservice">
		<h3 class="v52fmbx_hr" style="border:1px solid #ddd; border-bottom:0;">模板制作/修改服务商</h3>
		<div class="applistdiv">
		<table class="display dataTable ui-table" data-table-ajaxurl="{$_M['url']['app_api']}a=dotable_tempservicelist_json&info_id={$result['columnid']}&stat_key={$result['value']}&lang={$_M['lang']}&user_key={$_M['config']['met_secret_key']}" data-table-pagelength="20" data-table-datatype="jsonp">
			<thead>
				<tr>
					<th width="100" data-table-columnclass="met-center">标志</th>
					<th width="200">名称</th>
					<th width="50" data-table-columnclass="met-center">类型</th>
					<th>服务</th>
					<th width="90" data-table-columnclass="met-center">地区</th>
					<th data-table-columnclass="met-center">能力值</th>
					<th width="80" data-table-columnclass="met-center">联系方式</th>
				</tr>
			</thead>
			<tbody>
				
			</tbody>
			<tfoot>
				<tr>
					<th colspan="7" class="formsubmit" style="text-align:right!important;">
						<a href="javascript:;" class="shangjiaruzhu">商家如何入驻？</a>
						<textarea class="none">
							<div class="v52fmbx">
								<h3 class="v52fmbx_hr">商家入驻说明</h3>
								<dl>
									<dt>入驻要求</dt>
									<dd style="color:#333;">
									<ul style="list-style-type: disc;">
									<li>获得“官方认证模板设计师”称号。<br/><span class="tips">完成官方模板制作培训并顺利结业</span>
									<a href="http://ke.qq.com/cgi-bin/courseDetail?course_id=32691" target="_blank">点此报名培训</a></li>
									<li>上线一套收费模板至应用商店。</li>
									</ul>
									</dd>
								</dl>
								<dl>
									<dt>入驻流程</dt>
									<dd style="color:#333;">
									1、联系官方商家合作专员：<a href="http://wpa.qq.com/msgrd?v=3&amp;uin=2545740365&amp;site=qq&amp;menu=yes" target="_blank"><img alt="QQ招商加盟" border="0" src="http://wpa.qq.com/pa?p=2:2545740365:47" title="QQ招商加盟"></a>。<br/>
									2、报名参加官方模板制作培训并获得“官方认证模板设计师”称号。<br/>
									3、通过官网审核并顺利上线一套收费模板至应用商店。<br/>
									4、提供商家入驻所需资料，官方进行核实。<br/>
									5、正式入驻。
									</dd>
								</dl>
								<dl>
									<dd class="ftype_description">
									上线一套作品至应用商店其标准和审核将会非常严格，因为我们需要确保最终用户能够得到足够专业的技术服务。
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