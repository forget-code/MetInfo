<!--<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.

defined('IN_MET') or exit('No permission');

require $this->template('ui/head');
echo <<<EOT
-->
<form method="POST"  class="ui-from" name="myform" action="{$_M[url][own_form]}a=dosaveinc" target="_self">
	<input name="action" type="hidden" value="modify">
	<input name="class1" type="hidden" value="{$_M[form][class1]}">
	<input name="met_fd_back" type="hidden" value="0">
	<input name="met_fd_sms_back" type="hidden" value="0">
	<div class="v52fmbx_tbmax">
		<div class="v52fmbx_tbbox">
			<div class="v52fmbx">
				<dl>
					<dt>{$_M[word][feedbacksubmit]}{$_M[word][marks]}</dt>
					<dd class="ftype_radio">
						<div class="fbox">
							<label>
								<input name="met_fd_ok" type="radio" value="1" $met_fd_ok1[1]>{$_M[word][open]}</label>
							<label>
								<input name="met_fd_ok" type="radio" value="0" $met_fd_ok1[0]>{$_M[word][close]}</label>
						</div>
					</dd>
				</dl>
				<dl>
					<dt>{$_M[word][fdincName]}{$_M[word][marks]}</dt>
					<dd class="ftype_input">
						<div class="fbox">
							<input type="text" name="met_fdtable" value="$met_fdtable"></div>
						<span class="tips">{$_M[word][feedbackexplain1]}</span>
					</dd>
				</dl>
				<dl>
					<dt>{$_M[word][fdincTime]}{$_M[word][marks]}</dt>
					<dd class="ftype_input">
						<div class="fbox">
							<input type="text" name="met_fd_time" value="$met_fd_time"></div>
						<span class="tips">{$_M[word][fdincTip4]}</span>
					</dd>
				</dl>
				<!--<dl>
					<dt>{$_M[word][fdincSlash]}{$_M[word][marks]}</dt>
					<dd class="ftype_textarea">
						<div class="fbox">
							<textarea name="met_fd_word" placeholder="提示文字，为空时显示，输入文字后消失。">$met_fd_word</textarea>
						</div>
						<span class="tips">{$_M[word][fdincTip5]}</span>
					</dd>
				</dl>-->
				<div class="v52fmbx_dlbox">
					<dl>
						<dt>{$_M[word][fdincClassName]}{$_M[word][marks]}</dt>
						<dd>
							<select name="met_fd_class">
<!--
EOT;
foreach($fd_paraall as $key=>$val){
$select1='';
if($val[id]==$met_fd_class)$select1="selected='selected'";
echo <<<EOT
-->								<option value="$val[id]" $select1 >$val[name]</option>
<!--
EOT;
}
if('0'==$metlistrele)$select0="selected='selected'";
if('metinfoall'==$metlistrele)$selectall="selected='selected'";
echo <<<EOT
-->

							</select>
							<span class="tips">{$_M[word][fdincTip6]}</span>
						</dd>
					</dl>
<!--
EOT;


/*echo <<<EOT

					<dl>
						<dt>{$_M[word][listproductre]}{$_M[word][marks]}</dt>
						<dd class="ftype_select">
							<div class="fbox">
								<select name="metlistrele">
									<option value="0" {$select0}>{$_M[word][listproductreok]}</option>
									<option value="metinfoall" {$selectall}>{$_M[word][allcategory]}</option>
<!--
EOT;
$module = load::mod_class('column/column_op', 'new')->get_sorting_by_module();
foreach($module['3']['class1'] as $val){
    $select1=$val[id]==$metlistrele?"selected='selected'":'';
    echo <<<EOT
-->
									<option value="{$val['id']}" {$select1}>{$val['name']}</option>
<!--
EOT;
}
echo <<<EOT
-->
								</select>
								<span class="tips">{$_M[word][fdincTip13]}</span>
							</div>
						</dd>
					</dl>
<!--
EOT;*/


echo <<<EOT
-->
                    <dl>
						<dt>{$_M[word][listproductre]}{$_M[word][marks]}</dt>
						<dd class="ftype_select">
							<div class="fbox">
								<select name="met_fd_related">
									<option value="0" {$select0}>{$_M[word][listproductreok]}</option>
<!--
EOT;
foreach($fd_related as $val){
    $select1=$val[id]==$met_fd_related?"selected='selected'":'';
    echo <<<EOT
-->
									<option value="{$val['id']}" {$select1}>{$val['name']}</option>
<!--
EOT;
}
echo <<<EOT
-->
								</select>
								<span class="tips">{$_M[word][fdincTip13]}</span>
							</div>
						</dd>
					</dl>


				    <dl>
                        <dt>{$_M[word][fdincTip12]}</dt>
                        <dd class="ftype_checkbox">
                            <div class="fbox">
<!--
EOT;
foreach($fbcol as $key=>$val){
    $checked='';
    foreach($met_fd_showcol as $v){
        if($val['id']==$v)$checked="checked='checked'";
    }
echo <<<EOT
-->
                                <label><input name="met_fd_showcol" type="checkbox" value="{$val[id]}" data-checked={$met_fd_showcol} >{$val[name]}</label>
<!--
EOT;
}
echo <<<EOT
-->
                            </div>
                            <span class="tips"></span>
                        </dd>
                    </dl>

					<dl>
						<dt>{$_M['word']['feedbackinquiry']}{$_M['word']['[marks']}</dt>
						<dd class="ftype_radio">
							<div class="fbox">
								<label>
									<input name="met_fd_inquiry" type="radio" value="1"  data-checked="{$met_fd_inquiry}">{$_M[word][open]}</label>
								<label>
									<input name="met_fd_inquiry" type="radio" value="0" >{$_M[word][close]}</label>
							</div>
							<span class="tips">{$_M['word']['feedbackinquiryinfo']}</span>
						</dd>
					</dl>

					<dl>
						<dt>{$_M[word][fdincAcceptType]}{$_M[word][marks]}</dt>
						<dd class="ftype_radio">
							<div class="fbox">
								<label>
									<input name="met_fd_type" type="radio" value="0" $met_fd_type1[0]>{$_M[word][fdincAccept]}</label>
								<label>
									<input name="met_fd_type" type="radio" value="1" $met_fd_type1[1]>{$_M[word][fdincTip7]}</label>
								<label>
									<input name="met_fd_type" type="radio" value="2" $met_fd_type1[2]>{$_M[word][fdincTip8]}</label>
							</div>
						</dd>
					</dl>
				</div>

				<dl>
					<dt>{$_M[word][fdincAcceptMail]}{$_M[word][marks]}</dt>
					<dd class="ftype_input">
						<div class="fbox">
							<input type="text" name="met_fd_to" value="$met_fd_to"></div>
						<span class="tips">{$_M[word][fdincTip9]}</span>
					</dd>
				</dl>
				<h3 class="v52fmbx_hr metsliding" sliding="1">{$_M[word][feedbackauto]}</h3>
				<div class="metsliding_box metsliding_box_1">
					<dl>
						<dt>{$_M[word][fdincAuto]}{$_M[word][marks]}</dt>
						<dd class="ftype_checkbox ftype_transverse">
							<div class="fbox">
								<label>
									<input name="met_fd_back" type="checkbox" value="1" {$met_fd_back1}>{$_M[word][fdincTip10]}</label>
							</div>
						</dd>
					</dl>
					<div class="v52fmbx_dlbox">
						<dl>
							<dt>{$_M[word][fdincEmailName]}{$_M[word][marks]}</dt>
							<dd>
								<select name="met_fd_email">
<!--
EOT;
foreach($fd_para[9] as $key=>$val){
$select1='';
if($val[id]==$met_fd_email)$select1="selected='selected'";
echo <<<EOT
-->
									<option value="$val[id]" $select1 >$val[name]</option>
<!--
EOT;
}
echo <<<EOT
-->
								</select>
								<span class="tips">{$_M[word][fdincTip11]}</span>
							</dd>
						</dl>
					</div>
				    <dl>
						<dt>{$_M[word][fdincFeedbackTitle]}{$_M[word][marks]}</dt>
						<dd class="ftype_input">
							<div class="fbox">
								<input type="text" name="met_fd_title" value="$met_fd_title">
							</div>
							<span class="tips">{$_M[word][fdincAutoFbTitle]}</span>
						</dd>
				    </dl>
				    <dl>
				    	<dt>{$_M[word][fdincAutoContent]}{$_M[word][marks]}</dt>
				    	<dd class="ftype_textarea">
				    		<div class="fbox">
				    			<textarea name="met_fd_content" >{$_M[config][met_fd_content]}</textarea>
				    		</div>
				    		<span class="tips">{$_M[word][htmlok]}</span>
				    	</dd>
				    </dl>
				    <h3 class="v52fmbx_hr metsliding" sliding="1">{$_M[word][feedbackautosms]}</h3>
				    <div class="metsliding_box metsliding_box_1">
				    	<dl>
				    		<dt>{$_M[word][fdincAutosms]}{$_M[word][marks]}</dt>
				    		<dd class="ftype_checkbox">
				    			<div class="fbox">
				    				<label>
				    					<input name="met_fd_sms_back" type="checkbox" value="1" $met_fd_sms_back1 >{$_M[word][fdincTipsms]}</label>
				    			</div>
				    		</dd>
				    	</dl>
				    	<div class="v52fmbx_dlbox">
				    		<dl>
				    			<dt>{$_M[word][fdinctellsms]}{$_M[word][marks]}</dt>
				    			<dd>
				    				<select name="met_fd_sms_dell">
<!--
EOT;
foreach($fd_para[8] as $key=>$val){
$select1='';
if($val[id]==$met_fd_sms_dell)$select1="selected='selected'";
echo <<<EOT
-->
										<option value="$val[id]" $select1 >$val[name]</option>
<!--
EOT;
}
echo <<<EOT
-->
									</select>
								<span class="tips">{$_M[word][fdinctells]}</span>
								</dd>
							</dl>
						</div>
				        <dl>
				        	<dt>{$_M[word][fdincAutoContentsms]}{$_M[word][marks]}</dt>
				        	<dd class="ftype_textarea">
				        		<div class="fbox">
				        			<textarea name="met_fd_sms_content" placeholder="提示文字，为空时显示，输入文字后消失。">{$_M[config][met_fd_sms_content]}</textarea>
				        		</div>
				        		<span class="tips"></span>
				        	</dd>
				        </dl>
			        </div>
			        <div class="v52fmbx_submit">
			        	<input type="submit" name="Submit" value="{$_M[word][Submit]}" class="submit" onclick="return Smit($(this),'myform')" />
			        </div>
		        </div>
	        </div>
        </div>
    </div>
</form>
<!--
EOT;
require $this->template('ui/foot');
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>