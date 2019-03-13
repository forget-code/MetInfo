<!--<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');

require $this->template('ui/head');
echo <<<EOT
-->

<link rel="stylesheet" href="{$_M[url][own_tem]}css/metinfo.css?{$jsrand}" />
<form method="POST" class="ui-from product_add" name="myform" action="{$_M[url][own_form]}a={$a}" target="_self">
	<input type="hidden" name='id' value="{$_M['form']['id']}" />
	<input type="hidden" name="addtime_l" value="{$list['addtime']}">
	<input type="hidden" name="imgurl_l" value="{$list['imgurl']}">
	<input type="hidden" name="no_order" value="{$list['no_order']}">
	<input type="hidden" name="issue" value="{$list[issue]}" />
	<input type="hidden" name="select_class1" value="{$_M['form']['select_class1']}">
	<input type="hidden" name="select_class2" value="{$_M['form']['select_class2']}">
	<input type="hidden" name="select_class3" value="{$_M['form']['select_class3']}">
	<div class="v52fmbx">
		<h3 class="v52fmbx_hr">{$_M[word][upfiletips7]}</h3>
		<dl>
			<dt><em class="required">*</em>{$_M[word][category]}</dt>
			<dd>
				<div class="fbox pull-left">
					<select name="class" class="form-control" data-value="{$list['class']}{$list['classother']}" style="min-width:250px; height:250px;" class="dist" multiple>
						{$class_option}
					</select>
					<input type="hidden" name="class" value='' />
					<span class="tips" style="display:block; margin-top:5px;">{$_M[word][admin_holdcanrlchoose_v6]}</span>
				</div>
<!--
EOT;
	
if(in_array('metinfo',$arrlanguage)||in_array('1201',$arrlanguage)){
echo <<<EOT
-->
		<span class="tips pull-left" style="margin-left:20px;"><a href="{$_M[url][site_admin]}index.php?lang={$_M[lang]}#metnav_25" target="_blank">{$_M[word][admin_colunmmanage_v6]}</a></span>
			</dd>
<!--
EOT;
}
echo <<<EOT
-->
		</dl>
		<dl>
			<dt><em class="required">*</em>{$_M[word][goodsname]}</dt>
			<dd class="ftype_input">
				<div class="fbox">
					<input type="text" name="title" value="{$list[title]}" data-required="1" />
				</div>
			</dd>
		</dl>
		<dl>
			<dt><em class="required">*</em>{$_M[word][product_img_v6]}</dt>
			<dd class="ftype_upload">
				<div class="fbox">
					<input 
						name="imgurl" 
						type="text" 
						data-upload-type="doupimg"
						data-upload-many="1"
						value="{$list[imgurl_all]}" 
					/>
				</div>
				<span class="tips">{$_M[word][tips11_v6]}</span>
			</dd>
		</dl>
		<h3 class="v52fmbx_hr">{$_M[word][goodspar]}</h3>
		<dl>
			<dd>
			<a href="{$_M[url][own_form]}a=doparaset" target="_blank">{$_M[word][parmanage]}</a>
			<a href="javascript:;" class="refresh_para" style="margin-left:10px;">{$_M[word][refresh]}</a>
			</dd>
		</dl>
		<div id="paralist" class="paralistbox" data-paralist="{$_M[url][own_form]}a=dopara&id={$_M['form']['id']}">
		<dl>
			<dd>
				<span class="tips">{$_M[word][selectcolumn]}</span>
			</dd>
		</dl>
		</div>	

<!--
EOT;
$tmpname = $this->shop->get_tmpname('product_shop');
if($tmpname){
	require $tmpname;
}
//if($_M['config']['shopv2_open'])require $this->template('own/product_shop');
$tmpincfile=PATH_WEB."templates/{$_M[config][met_skin_user]}/metinfo.inc.php";
require $tmpincfile;
if(isset($metadmin['productother'])){
	$_M['config']['met_productTabok'] = $metadmin['productother']+1;
}
if($metinfover == 'v1' || $metinfover == 'v2' || $metadmin['productother']){// 增加新模板框架v2判断
	$tems[productother]    = $_M['config']['met_productTabok']-1;
	$tems['productTabname']    = $_M['config']['met_productTabname'];
	$tems['productTabname_1']  = $_M['config']['met_productTabname_1'];
	$tems['productTabname_2']  = $_M['config']['met_productTabname_2'];
	$tems['productTabname_3']  = $_M['config']['met_productTabname_3'];
	$tems['productTabname_4']  = $_M['config']['met_productTabname_4'];
}
if($tems && $tems[productother]){
	$contxt1s=$tems['productTabname'];
echo <<<EOT
-->
	<h3 class="v52fmbx_hr">{$_M[word][goodsdetails]}</h3>
	<div style="margin-top:5px;margin-left:5px;">
		<!-- Nav tabs -->
		<ul class="nav nav-tabs" role="tablist">
		<li role="presentation" class="active"><a href="#content" aria-controls="content" role="tab" data-toggle="tab">{$contxt1s}</a></li>
<!--
EOT;
	for($i=1;$i<=$tems[productother];$i++){
		$tabtitle = $tems?$tems['productTabname_'.$i]:"{$_M[word][columnmappend]}".$i;
		$othermark ='content'.$i;
echo <<<EOT
-->
		<li role="presentation"><a href="#{$othermark}" aria-controls="{$othermark}" role="tab" data-toggle="tab">{$tabtitle}</a></li>
<!--
EOT;
	}
echo <<<EOT
-->
		</ul>
			  <!-- Tab panes -->
		<div class="tab-content">
			<div role="tabpanel" class="tab-pane active" id="content">
				<dl style="border-top:0px;">
					<dd class="ftype_ckeditor">
						<div class="fbox">
							<textarea name="content" data-ckeditor-y="500">{$list[content]}</textarea>
						</div>
					</dd>
				</dl>
			</div>
<!--
EOT;
	for($i=1;$i<=$tems[productother];$i++){
		$tabtitle = $tems?$tems['productTabname_'.$i]:"{$_M[word][columnmappend]}".$i;
		$othermark ='content'.$i;
echo <<<EOT
-->
			<div role="tabpanel" class="tab-pane" id="{$othermark}">
				<dl style="border-top:0px;">
					<dd class="ftype_ckeditor">
						<div class="fbox">
							<textarea name="{$othermark}" data-ckeditor-y="500">{$list[$othermark]}</textarea>
						</div>
					</dd>
				</dl>
			</div>
<!--
EOT;
	}
echo <<<EOT
-->	
	
		</div>

	</div>
			
<!--
EOT;
}else{
	$contxt1s="{$_M[word][goodsdetails]}";
echo <<<EOT
-->
		<h3 class="v52fmbx_hr">{$contxt1s}</h3>
		<dl>
			<dd class="ftype_ckeditor">
				<div class="fbox">
					<textarea name="content" data-ckeditor-y="500">{$list[content]}</textarea>
				</div>
			</dd>
		</dl>
<!--
EOT;
}


echo <<<EOT
-->		
		<h3 class="v52fmbx_hr">{$_M[word][seo_optimization]}</h3>
		<dl>
			<dt>{$_M[word][tips10_v6]}</dt>
			<dd class="ftype_input">
				<div class="fbox">
					<input type="text" name="ctitle" value="{$list[ctitle]}" />
				</div>
				<span class="tips">{$_M[word][tips6_v6]}</span>
			</dd>
		</dl>
		<dl>
			<dt>{$_M[word][keywords]}</dt>
			<dd class="ftype_input">
				<div class="fbox">
					<input type="text" name="keywords" value="{$list[keywords]}" />
				</div>
				<span class="tips">{$_M[word][content_descript1_v6]}</span>
			</dd>
		</dl>
		<dl>
			<dt>{$_M[word][desctext]}</dt>
			<dd class="ftype_textarea">
				<div class="fbox">
					<textarea name="description">{$list[description]}</textarea>
				</div>
				<span class="tips">{$_M[word][content_descript5_v6]}</span>
			</dd>
		</dl>
		<dl>
			<dt><abbr title="{$_M[word][admin_seotips3_v6]}">{$_M[word][tag]}</abbr></dt>
			<dd class="ftype_tags">
				<div class="fbox">
					<input name="tag" type="hidden" data-label="|" value="{$list[tag]}">
				</div>
				<span class="tips">{$_M[word][tips3_v6]}</span>
			</dd>
		</dl>
		<dl>
			<dt>{$_M[word][columnhtmlname]}</dt>
			<dd class="ftype_input">
				<div class="fbox">
					<input type="text" name="filename" data-ajaxcheck-url="{$_M[url][own_form]}a=docheck_filename&id={$_M['form']['id']}" style="width:200px;" value="{$list[filename]}" />
				</div>
				<span class="tips">{$_M[word][js74]}</span>
			</dd>
		</dl>
		<h3 class="v52fmbx_hr">{$_M[word][unitytxt_15]}<span class="tips">{$_M[word][content_descript6_v6]}</span></h3>
		<dl>
			<dt>{$_M[word][visitcount]}</dt>
			<dd class="ftype_input">
				<div class="fbox">
					<input type="text" name="hits" style="width:100px;" value="{$list[hits]}" />
				</div>
			</dd>
		</dl>
		<dl>
			<dt>{$_M[word][linkto]}</dt>
			<dd class="ftype_input">
				<div class="fbox">
					<input type="text" name="links" value="{$list[links]}" />
				</div>
				<span class="tips">{$_M[word][content_descript7_v6]}</span>
			</dd>
		</dl>
		<dl>
			<dt>{$_M[word][webaccess]}</dt>
			<dd class="ftype_select">
				<div class="fbox">
					{$access_option}
				</div>
			</dd>
		</dl>
		<dl>
			<dt>{$_M[word][state]}</dt>
			<dd class="ftype_checkbox ftype_transverse">
				<div class="fbox">
					<label><input name="displaytype" type="checkbox" value="1" data-checked="{$list[displaytype]}">{$_M[word][displaytype]}</label>
					<label><input name="com_ok" type="checkbox" value="1" data-checked="{$list[com_ok]}">{$_M[word][recom]}</label>
					<label><input name="top_ok" type="checkbox" value="1" data-checked="{$list[top_ok]}">{$_M[word][top]}</label>
				</div>
			</dd>
		</dl>
		<dl>
			<dt>{updatetime]}</dt>
			<dd class="ftype_day">
				<div class="fbox">
					<input type="input" name="updatetime" data-day-type = "2" value="{$list[updatetime]}">
				</div>
			</dd>
		</dl>
<!--
EOT;
if($_M['config']['met_webhtm']){
	$list['addtype'] = 1;
	$disabled = 'disabled';
	$tips = '<span class="tips">{$_M["word"]["admin_seotips6_v6"]}</span>';
}
echo <<<EOT
-->
		<dl>
			<dt>{$_M[word][addtime]}</dt>
			<dd class="ftype_day">
					<div class="form-inline" style="margin-bottom:10px;">
					<div class="radio">
						<label>
							<input type="radio" name="addtype" value="1" data-checked="{$list[addtype]}">
							{$_M[word][releasenow]}
						</label>
					</div>
				</div>
				<div class="form-inline" style="margin-bottom:10px;">
					<div class="radio">
						<label>
							<input type="radio" name="addtype" value="2" {$disabled} >
							{$_M[word][timedrelease]}
						</label>
					</div>
					<div class="form-group" style="margin-left:10px;">
						<div class="fbox">
							<input type="input" name="addtime" data-day-type = "2" {$disabled} value="{$list[addtime]}">
						</div>
					</div>
				</div>
				{$tips}
			</dd>
		</dl>
	</div>
	<div class="met_affix_save bg-success">
		<button type="submit" class="btn btn-success">{$_M[word][publish]}</button>
	</div>
</form>
<!--
EOT;
require $this->template('ui/foot');
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>