<!--<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');

require $this->template('ui/head');
echo <<<EOT
-->
<form method="POST"  class="ui-form" name="myform" action="{$_M[url][own_form]}a=dosaveinc" target="_self">
		<input name="action" type="hidden" value="modify">
		<input name="class1" type="hidden" value="$class1">
		<input name="met_cv_back" type="hidden" value="0" />
<div class="v52fmbx_tbmax">
<div class="v52fmbx_tbbox">
<div class="v52fmbx">
	<dl>
	<dt>{$_M[word][fdincTime]}{$_M[word][marks]}</dt>
	<dd class="ftype_input">
		<div class="fbox">
			<input type="text" name="met_cv_time" value="{$_M[config][met_cv_time]}">
		</div>
		<span class="tips">{$_M[word][fdincTip4]}</span>
	</dd>
     </dl>
     <!--<dl>
		<dt>{$_M[word][fdincSlash]}{$_M[word][marks]}</dt>
		<dd class="ftype_textarea">
			<div class="fbox">
				<textarea name="met_cv_word">{$_M[config][met_cv_word]}</textarea>
			</div>
			<span class="tips">{$_M[word][fdincTip5]}</span>
		</dd>
    </dl>-->
		<div class="v52fmbx_dlbox">
		<dl>
			<dt>{$_M[word][jobtip8]}{$_M[word][marks]}</dt>
			<dd>
				<select name="met_cv_image">
<!--
EOT;


foreach($cv_para[5] as $keys=>$vals){
$ps = '';
if($_M[config][met_cv_image]==$vals[id])$ps = 'selected="selected"';
echo <<<EOT
-->
                	<option value="$vals[id]" $ps>$vals[name]</option>
<!--
EOT;
}

echo <<<EOT
-->	
			
			</select>			
			<span class="tips">{$_M[word][jobtip9]}</span>
			</dd>
		</dl>
		</div>
		
        <dl>
                        <dt>{$_M[word][fdincTip12]}</dt>
                        <dd class="ftype_checkbox">
                            <div class="fbox">
<!--
EOT;
foreach($fbcol as $key=>$val){
    $checked='';
    foreach($met_cv_showcol as $v){
        if($val['id']==$v)$checked="checked='checked'";
    }
    echo <<<EOT
-->
                    <label><input name="met_cv_showcol[]" type="checkbox" value="{$val[id]}" {$checked} >{$val[name]}</label>
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
	<dt>{$_M[word][cvincAcceptType]}{$_M[word][marks]}</dt>
	<dd class="ftype_radio">
		<div class="fbox">
			<label><input name="met_cv_type" type="radio" value="0" $met_cv_type1[0]>{$_M[word][fdincAccept]}</label>
			<label><input name="met_cv_type" type="radio" value="1" $met_cv_type1[1]>{$_M[word][fdincTip7]}</label>
			<label><input name="met_cv_type" type="radio" value="2" $met_cv_type1[2]>{$_M[word][fdincTip8]}</label>
		</div>
	</dd>
    </dl>


<dl>
	<dt>{$_M[word][cvincTip2]}{$_M[word][marks]}</dt>
	<dd class="ftype_radio">
		<div class="fbox">
			<label><input name="met_cv_emtype" type="radio" value="0" $met_cv_emtype1[0]>{$_M[word][cvincTip3]}</label>
			<label><input name="met_cv_emtype" type="radio" value="1" $met_cv_emtype1[1]>{$_M[word][cvincTip4]}</label>
		</div>
	</dd>
    </dl>
    <dl>
	<dt>{$_M[word][cvincAcceptMail]}{$_M[word][marks]}</dt>
	<dd class="ftype_input">
		<div class="fbox">
			<input type="text" name="met_cv_to" value="{$_M[config][met_cv_to]}">
		</div>
		<span class="tips">{$_M[word][fdincTip9]}</span>
	</dd>
     </dl>
	<h3 class="v52fmbx_hr metsliding" sliding="1">{$_M[word][feedbackauto]}</h3>
	<div class="metsliding_box metsliding_box_1">
		 <dl>
	     <dt>{$_M[word][fdincAuto]}{$_M[word][marks]}</dt>
	     <dd class="ftype_checkbox ftype_transverse">
		 <div class="fbox">
			<label><input name="met_cv_back" type="checkbox" value="1" {$met_cv_back1}>{$_M[word][fdincTip10]}</label>
		 </div>
	     </dd>
         </dl>
		<div class="v52fmbx_dlbox">
		<dl>
			<dt>{$_M[word][fdincEmailName]}{$_M[word][marks]}</dt>
			<dd>
			<select name="met_cv_email">
<!--
EOT;
foreach($cv_para[9] as $key=>$val){
$select1='';
if($val[id]==$_M[config][met_cv_email])$select1="selected='selected'";
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
			<input type="text" name="met_cv_title" value="{$_M[config][met_cv_title]}">
		</div>
		<span class="tips">{$_M[word][fdincAutoFbTitle]}</span>
	</dd>
</dl>
        <dl>
	<dt>{$_M[word][fdincAutoContent]}{$_M[word][marks]}</dt>
	<dd class="ftype_textarea">
		<div class="fbox">
			<textarea name="met_cv_content">{$_M[config][met_cv_content]}</textarea>
		</div>
		<span class="tips">{$_M[word][htmlok]}</span>
	</dd>
</dl>
<div class="v52fmbx_submit">
			<input type="submit" name="Submit" value="{$_M[word][Submit]}" class="submit" onclick="return Smit($(this),'myform')" />
		</div>
	</div>
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