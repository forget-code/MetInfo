<!--<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');
require $this->template('ui/head');
echo <<<EOT
-->
  <form  method="POST" class="ui-from" name="myform" action="{$_M[url][own_form]}a={$a}" target="_self">
		<input name="id" type="hidden" value="$id">
		<input name="class1" type="hidden" value="$class1" />
		<input name="lang" type="hidden" value="$lang" />
		<input name="filenameold" type="hidden"  value="$job_list[filename]">
		<input name="updatetimeold" type="hidden"  value="$job_list[updatetime]">
		<input type="hidden" name="no_order" value="$job_list[no_order]" />
<div class="v52fmbx_tbmax">
<div class="v52fmbx_tbbox">
<div class="v52fmbx">
        <dl>
		<dt>{$_M[word][jobposition]}{$_M[word][marks]}</dt>
		<dd class="ftype_input">
			<div class="fbox">
				<input type="text" name="position" value="$job_list[position]">
			</div>
		</dd>
        </dl>
		<dl>
			<dt>{$_M[word][article1]}{$_M[word][marks]}</dt>
			<dd class="ftype_checkbox">
			<div class="fbox">
			    <label><input name="top_ok" type="checkbox" type="checkbox" value="1" data-checked="$job_list[top_ok]" />{$_M[word][top]}</label>
<!--
EOT;
if($_M[config][met_wap] && $_M[config][met_wap_ok]){
echo <<<EOT
-->	
				<label><input name="wap_ok" type="checkbox" class="checkbox" value="1" {$wap_ok}>{$_M[word][article3]}</label>
<!--
EOT;
}
echo <<<EOT
-->	
			</dd>
		</dl>
        <dl>
		<dt>{$_M[word][jobaddress]}{$_M[word][marks]}</dt>
		<dd class="ftype_input">
			<div class="fbox">
				<input type="text" name="place" value="$job_list[place]">
		    </div>
		</dd>
	    </dl>
        <dl>
		<dt>{$_M[word][jobdeal]}{$_M[word][marks]}</dt>
		<dd class="ftype_input">
		<div class="fbox">
			<input name="deal" type="text" class="text" value="$job_list[deal]" />
			</div>
		</dd>
		</dl>
		<dl>
			<dt>{$_M[word][jobnum]}{$_M[word][marks]}</dt>
			<dd  class="ftype_input">
			  <div class="fbox">
				<input name="count" type="text" class="text mid" value="$job_list[count]" />
				</div>
				<span class="tips">{$_M[word][jobtip1]}</span>
			</dd>
		</dl>
<!--
EOT;
if($_M[config][met_cv_emtype]){
echo <<<EOT
-->
		<div class="v52fmbx_dlbox">
		<dl>
			<dt>{$_M[word][cvemail]}{$_M[word][marks]}</dt>
			<dd>
			    <input name="email" type="text" class="text med" value="$job_list[email]" />
				<span class="tips">{$_M[word][jobtip5]} {$_M[word][fdincTip9]}</span>
			</dd>
		</dl>
		</div>
<!--
EOT;
}
echo <<<EOT
-->
		
		<dl>
			<dt>{$_M[word][joblife]}{$_M[word][marks]}</dt>
			<dd  class="ftype_input">
			      <div class="fbox">
			    <input name="useful_life" type="text" class="text mid" value="$job_list[useful_life]" />
			    </div>
				<span class="tips">{$_M[word][jobtip3]}</span>
			</dd>
		</dl>
		
		
		<dl>
			<dt>{$_M[word][jobpublish]}{$_M[word][marks]}</dt>
			<dd class="ftype_input">
			  <div class="fbox">
			    <input name="addtime" type="text" class="text" style="width:100px;" value="$job_list[addtime]" />
			    </div>
				<span class="tips">{$_M[word][jobnow]} $m_now_counter {$_M[word][jobtip2]}</span>
			</dd>
		</dl>
		<dl>
			<dt>{$_M[word][columnhtmlname]}{$_M[word][marks]}</dt>
			<dd class="ftype_input">
			  <div class="fbox">
			    <input name="filename" type="text" class="text med" value="$job_list[filename]" />
			   </div>
				<span class="tips">{$_M[word][columntip14]}</span>
			</dd>
		</dl>
		<h3 class="v52fmbx_hr">{$_M[word][contentdetail]}</h3>
		<dl>
			<dd class="ftype_ckeditor">
				<div class="fbox">
					<textarea name="content" data-ckeditor-y="500">{$job_list[content]}</textarea>
				</div>
			</dd>
		</dl>


	<h3 class="v52fmbx_hr metsliding" sliding="14">{$_M[word][unitytxt_33]}</h3>
<!--
EOT;
if($_M[config][met_member_use]){
echo <<<EOT
-->	
		<dl>
			<dt>{$_M[word][webaccess]}</dt>
			<dd class="ftype_select">
				<div class="fbox">
					{$access_option}
				</div>
			</dd>
		</dl>
<!--
EOT;
}
echo <<<EOT
-->		
	
		<dl>
			<dt>{$_M[word][displaytype]}{$_M[word][marks]}</dt>
			<dd  class="ftype_radio">
			<div class="fbox">
			<label><input name="displaytype" type="radio"  value="1" data-checked="$job_list[displaytype]" />{$_M[word][yes]}</label>
			<label><input name="displaytype" type="radio"  value="0" />{$_M[word][no]}</label>
			</div>
			</dd>
		</dl>
		<div class="v52fmbx_submit">
			<input type="submit" name="Submit" value="{$_M[word][Submit]}" class="submit" onclick="return Smit($(this),'myform');" />
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