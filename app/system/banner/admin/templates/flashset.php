<?php

# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.
require_once $this->template('ui/head');
$title='Flash'.$_M[word][editor];
if($kuaijieskin){
	$ffwegitl = $listclass;
	$listclass='';
	$listclass[5]='class="now"';
	//require_once template('interface/skin_top');
	$listclass=$ffwegitl;
}
//require_once template('interface/flash/top');
echo <<<EOT
-->
<form method="POST" name="myform" class='ui-from' action="{$_M[url][own_form]}a=doeditorsave&kuaijieskin={$kuaijieskin}" target="_self">
	<input name="action" type="hidden" value="editor" />
	<input name="met_flash_type" type="hidden" value="{$mtype}" />
	<input name="id" type="hidden" value="{$id}" />
	<div class="v52fmbx_tbmax">
		<div class="v52fmbx_tbbox">
			<a class="btn btn-danger" href="{$_M[url][own_form]}a=domanage" role="button">{$_M[word][indexflash]}</a>
			<div class="v52fmbx">
				<div class="v52fmbx_dlbox">
					<dl>
						<dt>{$_M[word][setflashSize]}{$_M[word][marks]}</dt>
						<dd class="ftype_input">
<!--
EOT;
if($flashmdtype==1){
	if(!$flashrec1[height]) $flashrec1[height]=$_M[word][adaptive];
	if(!$flashrec1[height_t]) $flashrec1[height_t]=$_M[word][adaptive];
	if(!$flashrec1[height_m]) $flashrec1[height_m]=$_M[word][adaptive];
echo <<<EOT
-->
							<div class='clearfix'>
								<span style='width:150px;display:inline-block;line-height:2.5;float:left;'>{$_M[word][banner_pcheight_v6]}:</span>
								<div class="fbox">
									<input name="height" type="text" value='{$flashrec1[height]}' class="ui-input" style='width:100px;'/>
								</div>
								<span class="tips">{$_M[word][banner_setalert_v6]}</span>
							</div>
							<div class='clearfix' style='margin-top: 10px;'>
								<span style='width:150px;display:inline-block;line-height:2.5;float:left;'>{$_M[word][banner_pidheight_v6]}:</span>
								<div class="fbox">
									<input name="height_t" type="text" value='{$flashrec1[height_t]}' class="ui-input" style='width:100px;'/>
								</div>
								<span class="tips">{$_M[word][banner_setalert_v6]}</span>
							</div>
							<div class='clearfix' style='margin-top: 10px;'>
								<span style='width:150px;display:inline-block;line-height:2.5;float:left;'>{$_M[word][banner_phoneheight_v6]}:</span>
								<div class="fbox">
									<input name="height_m" type="text" value='{$flashrec1[height_m]}' class="ui-input" style='width:100px;'/>
								</div>
								<span class="tips">{$_M[word][banner_setalert_v6]}</span>
							</div>
<!--
EOT;
}else{
echo <<<EOT
-->
							<span>{$flashrec1[banner_height_v6]}:</span>
							<div class="fbox">
								<input name="height" type="text" value='{$flashrec1[height]}' class="ui-input" style='width:50px;'/>
							</div>
<!--
EOT;
}
echo <<<EOT
-->
						</dd>
					</dl>
					<dl>
						<dt>{$_M[word][sort]}{$_M[word][marks]}</dt>
						<dd class="ftype_input">
							<div class="fbox">
								<input name="no_order" type="text" value="{$flashrec1[no_order]}" class="ui-input mid" data-required='1'/>
							</div>
							<span class="tips">{$_M[word][ordernumber]}</span>
						</dd>
					</dl>
<!--
EOT;
if($flashmdtype==1){
	$flashrec1[img_text_position]=$flashrec1[img_text_position]?$flashrec1[img_text_position]:0;
echo <<<EOT
-->
	                <dl>
						<dt>{$_M[word][setflashImgUrl]}{$_M[word][marks]}</dt>
						<dd class="ftype_upload">
							<div class="fbox">
								<input
									type="text"
									name="img_path"
									data-upload-type="doupimg"
									value="{$flashrec1[img_path]}"
									data-required='1'
								/>
							</div>
							<span class="tips">{$_M[word][indexflashexplain4]}</span>
						</dd>
					</dl>
					 <dl>
						<dt>{$_M[word][banner_setmobileImgUrl_v6]}{$_M[word][marks]}</dt>
						<dd class="ftype_upload">
							<div class="fbox">
								<input
									type="text"
									name="mobile_img_path"
									data-upload-type="doupimg"
									value="{$flashrec1[mobile_img_path]}"
								/>
							</div>
							<span class="tips">{$_M[word][indexflashexplain4]}&nbsp;{$_M[word][mobile_banner_tips1]}</span>
						</dd>
					</dl>
					<dl>
						<dt>{$_M[word][setflashImgHref]}{$_M[word][marks]}</dt>
						<dd class="ftype_input">
							<div class="fbox">
								<input type="text" name="img_link" value="{$flashrec1[img_link]}" class="ui-input" />
							</div>
							<span class="tips">{$_M[word][indexflashexplain9]}</span>
						</dd>
					</dl>
					<!-- 图片名称移动到图片链接下面 -->
					<dl>
						<dt>{$_M[word][setflashName]}{$_M[word][marks]}</dt>
						<dd class="ftype_input">
							<div class="fbox">
								<input type="text" name="img_title" value="{$flashrec1[img_title]}" class="ui-input"/>
							</div>
						</dd>
					</dl>
					<!-- 增加新模板框架banner属性 开始 -->
					<dl>
						<dt>{$_M[word][banner_imgtitlecolor_v6]}{$_M[word][marks]}</dt>
						<dd class="ftype_color">
							<div class="fbox">
								<input type="text" name="img_title_color" value='{$flashrec1[img_title_color]}' class="ui-input">
							</div>
							<span class="tips">{$_M[word][banner_needtempsupport_v6]}</span>
						</dd>
					</dl>
					<dl>
						<dt>{$_M[word][banner_imgdesc_v6]}{$_M[word][marks]}</dt>
						<dd class="ftype_input">
							<div class="fbox">
								<input type="text" name="img_des" value='{$flashrec1[img_des]}' class="ui-input">
							</div>
							<span class="tips">{$_M[word][banner_needtempsupport_v6]}</span>
						</dd>
					</dl>
					<dl>
						<dt>{$_M[word][banner_imgdesccolor_v6]}{$_M[word][marks]}</dt>
						<dd class="ftype_color">
							<div class="fbox">
								<input type="text" name="img_des_color" value='{$flashrec1[img_des_color]}'>
							</div>
							<span class="tips">{$_M[word][banner_needtempsupport_v6]}</span>
						</dd>
					</dl>
					<dl>
						<dt>{$_M[word][banner_imgwordpos_v6]}{$_M[word][marks]}</dt>
						<dd class="ftype_radio">
							<div class="fbox">
								<label><input type="radio" name="img_text_position" value="0" data-checked='{$flashrec1['img_text_position']}'>{$_M[word][posleft]}</label>
								<label><input type="radio" name="img_text_position" value="1">{$_M[word][posright]}</label>
								<label><input type="radio" name="img_text_position" value="2">{$_M[word][posup]}</label>
								<label><input type="radio" name="img_text_position" value="3">{$_M[word][poslower]}</label>
								<label><input type="radio" name="img_text_position" value="4">{$_M[word][poscenter]}</label>
							</div>
							<span class="tips">{$_M[word][banner_needtempsupport_v6]}</span>
						</dd>
					</dl>
					<!-- 增加新模板框架banner属性 结束 -->
<!--
EOT;
}elseif($flashmdtype==2){
echo <<<EOT
-->
					<dl>
						<dt>{$_M[word][setflashUrl]}{$_M[word][marks]}</dt>
						<dd class="ftype_upload">
							<div class="fbox">
								<input type="text" name="flash_path" data-upload-type="doupimg" value='{$flashrec1[flash_path]}'/>
							</div>
							<span class="tips">{$_M[word][indexflashexplain4]}</span>
						</dd>
					</dl>
					<dl>
						<dt>{$_M[word][setflashBg]}{$_M[word][marks]}</dt>
						<dd class="ftype_upload">
							<div class="fbox">
								<input type="text" name="flash_back" data-upload-type="doupimg" value='{$flashrec1[flash_back]}'/>
							</div>
							<!--<span class="tips">{$_M[word][indexflashexplain5]}</span>-->
							<span class="tips">{$_M[word][indexflashexplain4]}&nbsp;{$_M[word][mobile_banner_tips1]}</span>
						</dd>
					</dl>
<!--
EOT;
}
echo <<<EOT
-->
					<dl>
						<dt>{$_M[word][category]}{$_M[word][marks]}</dt>
						<dd>
<!--
EOT;
if(count($modclumlist)){
echo <<<EOT
-->
						<div class="flashaddclumn flashaddclumn_c1">
							<h3>
								<p>
									<label style='color:#000;font-weight:500'>
										<input name="met_clumid_all" type="checkbox" class="checkbox" value="10002" {$met_clumid_all1}>{$_M[word][allcategory]}</label>
								</p>
							</h3>
							<div class="list" style="">
<!--
EOT;
	foreach($mod1 as $val){
		$checkeds=$flashrec1['module']=='metinfo'?'checked':($feditlist[$val[id]]==1?'checked':'');
echo
<<<EOT
-->
								<p>
									<label style='color:#000;font-weight:500'>
										<input name="met_clumid_{$val[id]}" type="checkbox" class="checkbox" value="{$val[id]}" {$checkeds}>{$val[name]}</label>
								</p>
<!--
EOT;
		foreach($mod2[$val[id]] as $val2){
			$checkeds2=$flashrec1['module']=='metinfo'?'checked':($feditlist[$val2[id]]==1?'checked':'');
echo
<<<EOT
-->
								<p class="met_bigloumn2id_{$val2[bigclass]}" style="margin-left:22px;">
									<label style='color:#000;font-weight:500'>
										<input name="met_clumid_{$val2[id]}" type="checkbox" class="checkbox" value="{$val2[id]}" {$checkeds2}>{$val2[name]}</label>
								</p>
<!--
EOT;
			foreach($mod3[$val2[id]] as $val3){
				$checkeds3=$flashrec1['module']=='metinfo'?'checked':($feditlist[$val3[id]]==1?'checked':'');
echo
<<<EOT
-->
								<p class="met_bigloumn3id_{$val3[bigclass]}" style="margin-left:42px;">
									<label style='color:#000;font-weight:500'>
										<input name="met_clumid_{$val3[id]}" type="checkbox" class="checkbox" value="{$val3[id]}" {$checkeds3}>{$val3[name]}</label>
								</p>
<!--
EOT;
			}
		}
	}
echo <<<EOT
--></div>
							</div>
<!--
EOT;
}else{
echo <<<EOT
-->
							<p class="red">{$_M[word][indexflashexplain6]}</p>
<!--
EOT;
}
echo <<<EOT
-->
							<div class="clear"></div>
						</dd>
					</dl>
				</div>
			</div>
			<div class="met_affix_save bg-success">
				<input type="submit" name="Submit" value="{$_M[word][Submit]}" class="submit" onclick="return flashsubm()" />
				<input type="hidden" name="f_columnlist" value="" />
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