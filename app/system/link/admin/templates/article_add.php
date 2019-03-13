<!--<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');
require $this->template('ui/head');

echo <<<EOT
-->
</head>
<body>
<!--
EOT;
echo <<<EOT
-->
<script type="text/javascript">
</script>
<form  method="POST" class='ui-from' name="myform"  action="{$_M[url][own_form]}a={$a}&class1=$class1" target="_self">
<input name="lang" type="hidden"  value="$lang">
<input name="id" type="hidden"  value="$id">
<input name="show_ok" type="hidden"  value="0">
<input name="com_ok" type="hidden"   value="0">
<input name="com_ok" type="hidden" value="0">
<div class="v52fmbx_tbmax v52fmbx_tbmaxmt">
<div class="v52fmbx_tbbox">
<div class="v52fmbx">	

        
        <dl>
		<dt>{$_M[word][linkType]}{$_M[word][marks]}</dt>
		<dd class="ftype_radio">
			<div class="fbox">
				<label><input name="link_type" type="radio" value="0" data-checked="{$link_list[link_type]}">{$_M[word][linkType4]}</label>
				<label><input name="link_type" type="radio" value="1">{$_M[word][linkType5]}</label>
			</div>
		</dd>
	</dl>
     <dl>
		<dt>{$_M[word][linkUrl]}{$_M[word][marks]}</dt>
		<dd class="ftype_input">
			<div class="fbox">
				<input type="text" name="weburl" value="$link_list[weburl]">
			</div>
		</dd>
	</dl>

		<!--<div class="v52fmbx_dlbox">
		<dl>
			<dt>{$_M[word][linkLOGO]}{$_M[word][marks]}</dt>
			<dd>
		    <input name="weblogo" type="text" class="text" value="$link_list[weblogo]">
			<input name="met_upsql1" type="file" id="file_upload" />
<script type="text/javascript">
$(document).ready(function(){
	metuploadify('#file_upload','upimage','weblogo');
});
</script>
			</dd>
		</dl>
		</div>-->

       <dl>
	<dt>{$_M[word][linkLOGO]}{$_M[word][marks]}</dt>
	<dd class="ftype_upload">
		<div class="fbox">
			<input 
				name="weblogo" 
				type="text" 
				data-upload-type="doupimg"
				value="{$link_list[weblogo]}" 
			/>
		</div>
	</dd>
</dl>






		<dl>
			<dt >{$_M[word][linkName]}{$_M[word][marks]}</dt>
			<dd class="ftype_input">
			   <div class="fbox">
				<input name="webname" type="text" class="text nonull" value="$link_list[webname]" />
				</div>
			</dd>
		</dl>
		<dl>
			<dt>{$_M[word][linkKeys]}{$_M[word][marks]}</dt>
			<dd class="ftype_input" >
			  <div class="fbox">
				<input name="info" type="text" class="text" value="$link_list[info]" />
			  </div>
			</dd>
		</dl>
		
		<dl>
			<dt>{$_M[word][sort]}{$_M[word][marks]}</dt>
			<dd class="ftype_input">
			  <div class="fbox">
				<input name="orderno" type="text" class="text mid" value="$link_list[orderno]" />
			  </div>
				<span class="tips">{$_M[word][linktip1]}</span>
			</dd>
		</dl>
        <dl>
		<dt>{$_M[word][article1]}{$_M[word][marks]}</dt>
		<dd class="ftype_checkbox">
			<div class="fbox">
				<label><input name="show_ok" type="checkbox" value="1" data-checked="{$link_list[show_ok]}">{$_M[word][linkPass]}</label>
				<label><input name="com_ok" type="checkbox" value="1" data-checked="{$link_list[com_ok]}">{$_M[word][linkRecommend]}</label>
			</div>
		</dd>
	</dl>

	<dl>
	<dt>{$_M[word][linkcontact]}{$_M[word][marks]}</dt>
	<dd class="ftype_textarea">
		<div class="fbox">
			<textarea name="contact">$link_list[contact]</textarea>
		</div>
	</dd>
     </dl>



		<div class="v52fmbx_submit">
			<input type="submit" name="Submit" value="{$_M[word][Submit]}" class="submit" onclick="return Smit($(this),'myform')" />
			<input name="id" type="hidden" value="$link_list[id]" />
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