<!--<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.

defined('IN_MET') or exit('No permission');
require $this->template('own/head');
$appdetail_nav_tab_w=$_M['form']['type']=='app'?4:6;
echo <<<EOT
-->
<div class="appbox_left">
	<div class="appbox_left_box">
		<input id="secret_key_appdetail" type="hidden" value="{$_M['config']['met_secret_key']}">
		<input id="recharge" type="hidden" value="{$_M['form']['recharge']}">
		<input id="authcode" type="hidden" value="{$authcode}">
		<input id="authkey" type="hidden" value="{$authkey}">
		<div class="v52fmbx" data-type="{$appdetail['type']}" data-info="{$appdetail['no']}" data-appid='{$appdetail['appid']}' data-download="{$appdetail['download']}" data-ver="{$appdetail['ver']}" data-cmsver="{$_M['config']['metcms_v']} ">
			<div class="paysuc" style="display:none">
				<h3 class="v52fmbx_hr">{$_M['word']['pay_success']}</h3>
				<dl>
					<dt></dt>
					<dd>
						<div>
							<span class="paysucjump" ><a>{$_M['word']['success_payment']}</a></span>
						</div>
					</dd>
				</dl>
			</div>
			<div class="buydiv remodal" style="display:none" data-remodal-id="modalbuydiv">
				<div class="v52fmbx">
					<form method="POST" class="ui-from" name="myform" action="" target="_self">
						<h3 class="v52fmbx_hr">{$_M['word']['sys_purchase']}</h3>
						<dl>
							<dt>{$_M['word']['purchase_program']}{$_M['word']['marks']}</dt>
							<dd>
								<div>
									<span class="buyname"></span>
								</div>
							</dd>
						</dl>
						<dl>
							<dt>{$_M['word']['amount_of']}{$_M['word']['marks']}</dt>
							<dd>
								<div>
									<div style="color:#F80B0B;"><span class="buyprice"></span></div>
								</div>
							</dd>
						</dl>

						<dl>
							<dt>{$buy_Explain}{$_M['word']['marks']}</dt>
							<dd>
								{$buy_Explain1}
							</dd>
						</dl>
						<div style="display:none">
							<dl>
								<dt>{$_M['word']['top_domain_names']}{$_M['word']['marks']}</dt>
								<dd class="ftype_input">
									<div class="fbox">
										<input type="text" name="domain" value="" placeholder="{$_M['word']['template_domain']}"  style="width:250px;">
									</div>
								</dd>
							</dl>
							<dl>
								<dt>{$_M['word']['temporary_access']}{$_M['word']['marks']}</dt>
								<dd class="ftype_input">
									<div class="fbox">
										<input type="text" name="tmp" value="" placeholder="{$_M['word']['temporary_access1']}"  style="width:250px;">
									</div>
								</dd>
							</dl>
						</div>
						<dl>
							<dt>{$_M['word']['sys_password']}{$_M['word']['marks']}</dt>
							<dd class="ftype_input">
								<div class="fbox">
									<input type="text" value="" style="display:none" />
									<input type="password" name="user_passpay" value="" placeholder="{$_M['word']['memberjstxt2']}" data-required="1" style="width:100px;">
								</div>
							</dd>
						</dl>
						<dl class="noborder">
							<dt> </dt>
							<dd>
								<input type="submit" name="buysubmit" data-click=1 value="{$_M['word']['sys_payment']}" class="submit buysubmit">
							</dd>
						</dl>
					</form>
				</div>
			</div>
			<div class="appdetail">
				<div class="appdetail_cont">
					<div class="appdetail_cont_bodr">
						<dl class="appdetail_dl">
							<dt>
								<img src="" />
							</dt>
							<dd>
								<h3><span class="buyname"></span></h3>
								<div class="appdetail_grade">
									<span class="evaluation"></span>
									{$_M['word']['total_of']} <span class="evaluation_num"></span> {$_M['word']['evaluation']}
								</div>
								<div class="appdetail_buybox">
									<span class="buyprice"></span>
									<h5 class="buybuttondiv none">
										<button type="type" class='btn btn-success btn-sm'
<!--
EOT;
if($_M['config']['met_secret_key']){
echo <<<EOT
-->

										data-toggle="modal" data-target="#purchase-notice-modal"
<!--
EOT;
}
echo <<<EOT
-->
										>{$_M['word']['sys_purchase']}</button>
									</h5>
									<h5 class="downloaddiv none">
										<span class="download-noclick"></span>
										<button type="type" class='btn btn-success btn-sm btn-metcms_upload' data-toggle="modal" data-target="#download-notice-modal"></button>
									</h5>
									<h5 class="completediv none"><span class="complete">{$appdetail['url']}</span></h5>
								</div>
							</dd>
						</dl>
						<ul class="appdetail-nav-tab nav nav-tabs">
							<li class="active col-xs-{$appdetail_nav_tab_w}"><a data-toggle="tab" href="#appdetail_de" aria-controls="appdetail_de">{$_M['word']['for_details']}</a></li>
<!--
EOT;
if($_M['form']['type']=='app'){
echo <<<EOT
-->
							<li class="col-xs-{$appdetail_nav_tab_w}"><a data-toggle="tab" href="#purchase-notice" aria-controls="purchase-notice">{$_M['word']['purchase_notice']}</a></li>
<!--
EOT;
}
echo <<<EOT
-->
							<li class="col-xs-{$appdetail_nav_tab_w}"><a data-toggle="tab" href="#appdetail_ev" aria-controls="appdetail_ev">{$_M['word']['comments']}</a></li>
						</ul>
						<div class="tab-content">
							<div class="tab-pane active appdetail_de" id="appdetail_de">
								<h3 class="v52fmbx_hr">{$_M['word']['skininfo']}</h3>
								<dl>
									<dt>{$_M['word']['updated_date']}</dt>
									<dd class="ftype_input">
										<div class="fbox">
											<div class="updateime"></div>
										</div>
									</dd>
								</dl>
								<dl>
									<dt>{$_M['word']['the_version']}</dt>
									<dd class="ftype_input">
										<div class="fbox">
											<span class="ver"></span>
										</div>
									</dd>
								</dl>
								<dl>
									<dt>{$_M['word']['running_environment']}</dt>
									<dd class="ftype_input">
										<div class="fbox">
											<span class="sys_text"></span>
										</div>
									</dd>
								</dl>
								<div class="appdetail_info none">
									<h3 class="v52fmbx_hr">{$_M['word']['is_introduced']}</h3>
									<dl>
										<dd class="ftype_input">
											<div class="fbox">
												<div class="info"></div>
											</div>
										</dd>
									</dl>
								</div>
								<div class="appdetail_demo_url none">
									<h3 class="v52fmbx_hr">{$_M['word']['online_presentation']}</h3>
									<dl>
										<dd class="ftype_input">
											<div class="fbox">
												<div class="demo_url"></div>
											</div>
										</dd>
									</dl>
								</div>
								<div class="appdetail_imglist none">
									<h3 class="v52fmbx_hr">{$_M['word']['screenshots']}</h3>
									<dl>
										<dd class="ftype_input">
											<div class="fbox">
												<div class="img"></div>
											</div>
										</dd>
									</dl>
								</div>
							</div>
<!--
EOT;
if($_M['form']['type']=='app'){
echo <<<EOT
-->
							<div class="tab-pane" id="purchase-notice">
							</div>
<!--
EOT;
}
echo <<<EOT
-->
							<div class="tab-pane appdetail_ev" id="appdetail_ev">
								<div class="evaluationinfo"></div>
								<dl>
									<dd class="ftype_radio ftype_transverse">
										<div class="fbox">
											<span id="pageup" class="page" data-page-action="up" style="display:none"><a href="#">{$_M['word']['back']}</a></span>
											<span id="pagedown" class="page" data-page-action="down" style="display:none"><a href="#">{$_M['word']['next_page']}</a></span>
											<input id="evaluation_page" type="hidden" value="1">
											<input id="evaluation_page_click" type="hidden" value="0">
										</div>
									</dd>
								</dl>
								<h3 class="v52fmbx_hr">{$_M['word']['want_comment']}</h3>
								<form method="POST" class="ui-from" name="myform" action="" target="_self">
									<dl>
										<dt>{$_M['word']['score']}</dt>
										<dd class="ftype_radio ftype_transverse">
											<div class="fbox my_evaluation_num_box">

											</div>
											<span class="tips">{$_M['word']['mouse_click_rating']}</span>
											<input name="my_evaluation_num" type="hidden" value="0" />
										</dd>
									</dl>
									<dl>
										<dt>{$_M['word']['content']}</dt>
										<dd class="ftype_textarea">
											<div class="fbox">
												<textarea name="my_evaluation" placeholder="{$_M['word']['dont_fill']}"></textarea>
											</div>
										</dd>
									</dl>
									<dl class="noborder">
										<dt> </dt>
										<dd>
											<input type="submit" data-click=1 name="evaluationsubmit" value="{$_M['word']['comments']}" class="submit evaluationsubmit">
										</dd>
									</dl>
								</form>
							</div>
						</div>
					</div>
					<div class="appdetail_develp">
						<h3 class="v52fmbx_hr">{$_M['word']['name_developers']}</h3>
						<!--
						<dl>
							<dt>{$_M['word']['sys_head']}</dt>
							<dd class="ftype_input">
								<div class="fbox">
									<div class="head"></div>
								</div>
							</dd>
						</dl>
						-->
						<dl>
							<dd class="ftype_input">
								<div class="fbox">
									<div class="developer_id"></div>
								</div>
							</dd>
						</dl>
						<h3 class="v52fmbx_hr">{$_M['word']['introduction_developers']}</h3>
						<dl>
							<dd class="ftype_input">
								<div class="fbox">
									<div class="introduction"></div>
								</div>
							</dd>
						</dl>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="remodal met_uplaod_remodal" data-remodal-id="modal"><div class="temset_box"></div>
</div>
<div class="modal fade" id="purchase-notice-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">{$_M['word']['purchase_notice']}</h4>
            </div>
            <div class="modal-body">
        	</div>
        	<div class="modal-footer">
                <button type="button" class="btn btn-danger btn-lg buybutton">{$_M['word']['sys_purchase']}</button>
            </div>
    	</div>
	</div>
</div>
<!--
EOT;
$download_notice="应用首次安装将自动绑定域名 <span class='red'>{$_M['url']['site']}</span>";
if(strpos($_M['url']['site'], 'http://localhost')!==false || strpos($_M['url']['site'], '127.0.0.1')!==false) $download_notice="你可以在 <span class='red'>{$_M['url']['site']}</span> 测试安装应用，上线到正式网站后应用将自动绑定正式域名";
echo <<<EOT
-->
<div class="modal fade" id="download-notice-modal" data-keyboard='false' data-backdrop='false'>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">{$_M['word']['metinfoappinstallinfo4']}</h4>
            </div>
            <div class="modal-body">
				{$download_notice}，且只能在此绑定域名的网站中使用，是否确认安装？
        	</div>
        	<div class="modal-footer">
        		<span class="download-noclick"></span>
                <button type="button" class="btn btn-success btn-lg metcms_upload_download" data-a-download="{$appdetail['type']}|{$appdetail['no']}|doc|1|">{$_M['word']['appinstall']}</button>
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
