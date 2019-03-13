<!--<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');

require $this->template('ui/head');

echo <<<EOT
-->
<form method="POST" class="ui-from" name="myform" action="{$_M[url][own_form]}a=dosave_watermark" target="_self">
<div class="v52fmbx" >
	<h3 class="v52fmbx_hr">{$_M['word']['batchtips6']}</h3>
	<dl>
        <dt>{$_M['word']['setimgWatermarkType']}:</dt>
        <dd class="ftype_radio">
            <div class="fbox">
                <label><input name="met_wate_class" type="radio" value="1" data-checked="{$_M['config']['met_wate_class']}">{$_M['word']['setimgWordWatermark']}</label>
                <label><input name="met_wate_class" type="radio" value="2">{$_M['word']['setimgImgWatermark']}</label>
            </div>
        </dd>
    </dl>
    <dl>
        <dt>{$_M['word']['setimgWatermark']}:</dt>
        <dd class="ftype_checkbox">
            <div class="fbox">
                <label><input name="met_big_wate" type="checkbox" data="{$_M['config']['met_big_wate']}" value="1">{$_M['word']['setimgBigImg']}</label>
                <label><input name="met_thumb_wate" type="checkbox" data="{$_M['config']['met_thumb_wate']}" value="1">{$_M['word']['setimgThumb']}</label>
            </div>
        </dd>
    </dl>
    <dl>
        <dt>{$_M['word']['setimgPosition']}:</dt>
        <dd class="ftype_radio ftype_transverse">
            <div class="fbox">
                <label><input name="met_watermark" type="radio" value="1" data-checked="{$_M['config']['met_watermark']}">{$_M['word']['setimgLeftTop']}</label>
                <label><input name="met_watermark" type="radio" value="5">{$_M['word']['setimgTopMid']}</label>
                <label><input name="met_watermark" type="radio" value="2">{$_M['word']['setimgRightTop']}</label>
            </div>
            <div class="fbox">
                <label><input name="met_watermark" type="radio" value="8" data-checked="{$_M['config']['met_watermark']}">{$_M['word']['setimgRightTop']}</label>
                <label><input name="met_watermark" type="radio" value="0">{$_M['word']['setimgMid']}</label>
                <label><input name="met_watermark" type="radio" value="6">{$_M['word']['setimgRightMid']}</label>
            </div>
            <div class="fbox">
                <label><input name="met_watermark" type="radio" value="4" data-checked="{$_M['config']['met_watermark']}">{$_M['word']['setimgLeftLow']}</label>
                <label><input name="met_watermark" type="radio" value="7">{$_M['word']['setimgLowMid']}</label>
                <label><input name="met_watermark" type="radio" value="3">{$_M['word']['setimgRightLow']}</label>
            </div>
        </dd>
    </dl>

    <div class='met_wate_class1'>
    <dl>
        <dt>{$_M['word']['setimgWord']}:</dt>
        <dd class="ftype_input">
            <div class="fbox">
                <input type="text" name="met_text_wate" value="{$_M['config']['met_text_wate']}" style='color:{$_M['config']['met_text_color']}'>
            </div>
            <span class="tips">{$_M['word']['setimgTip3']}</span>
        </dd>
    </dl>
    <dl>
        <dt>{$_M['word']['setimgWordSize']}:</dt>
        <dd class="ftype_input">
            <div class="fbox">
                <input type="number" name="met_text_size" value="{$_M['config']['met_text_size']}" style="width:60px;text-align: center;" min="0">
            </div>
            <span class="tips">{$_M['word']['setflashPixel']}</span>
        </dd>
    </dl>
    <dl>
        <dt>{$_M['word']['setimgWordSize2']}:</dt>
        <dd class="ftype_input">
            <div class="fbox">
                <input type="number" name="met_text_bigsize" value="{$_M['config']['met_text_bigsize']}" style="width:60px;text-align: center;"  min="0">
            </div>
            <span class="tips">{$_M['word']['setflashPixel']}</span>
        </dd>
    </dl>
    <dl>
        <dt>{$_M['word']['setimgWordFont']}:</dt>
        <dd class="ftype_input">
            <div class="fbox">
                <input type="text" name="met_text_fonts" value="{$_M['config']['met_text_fonts']}">
            </div>
            <span class="tips">{$_M['word']['setimgTip4']}</span>
        </dd>
    </dl>
    <dl>
        <dt>{$_M['word']['setimgWordAngle']}:</dt>
        <dd class="ftype_input">
            <div class="fbox">
                <input type="number" name="met_text_angle" value="{$_M['config']['met_text_angle']}" style="width:60px;text-align: center;"  min="0">
            </div>
            <span class="tips">{$_M['word']['setimgTip5']}</span>
        </dd>
    </dl>
    <dl>
        <dt>{$_M['word']['setimgWordColor']}:</dt>
        <dd class="ftype_input">
            <div class="fbox">
                <input type="text" name="met_text_color" value="{$_M['config']['met_text_color']}" style="width:190px">
            </div>
            <div class="fbox">
                <select name="select_color" style="width:150px" onchange="do_color()">
                    <option value="{$_M['config']['met_text_color']}">{$_M[word][choicecolor]}</option>
                    <option style="background-color: #FFFFFF;color:#FFFFFF" value="#FFFFFF">{$_M[word][setimgWhite]}</option>
                    <option style="background-color:Black;color:Black" value="#000000">{$_M[word][setimgBlack]}</option>
                    <option style="background-color:Red;color:Red" value="#FF0000">{$_M[word][setimgRed]}</option>
                    <option style="background-color:Yellow;color:Yellow" value="#FFFF00">{$_M[word][setimgYellow]}</option>
                    <option style="background-color:Green;color:Green" value="#008000">{$_M[word][setimgGreen]}</option>
                    <option style="background-color:Orange;color:Orange" value="#FF8000">{$_M[word][setimgOrange]}</option>
                    <option style="background-color:Purple;color:Purple" value="#800080">{$_M[word][setimgPurple]}</option>
                    <option style="background-color:Blue;color:Blue" value="#0000FF">{$_M[word][setimgBlue]}</option>
                    <option style="background-color:Brown;color:Brown" value="#800000">{$_M[word][setimgBrown]}</option>
                    <option style="background-color:#00FFFF;color: #00FFFF" value="#00FFFF">{$_M[word][setimgGreen1]}</option>
                    <option style="background-color:#7FFFD4;color: #7FFFD4" value="#7FFFD4">{$_M[word][setimgGreen2]}</option>
                    <option style="background-color:#FFE4C4;color: #FFE4C4" value="#FFE4C4">{$_M[word][setimgGray1]}</option>
                    <option style="background-color:#7FFF00;color: #7FFF00" value="#7FFF00">{$_M[word][setimgGreen3]}</option>
                    <option style="background-color:#D2691E;color: #D2691E" value="#D2691E">{$_M[word][setimgRed1]}</option>
                    <option style="background-color:#FF7F50;color: #FF7F50" value="#FF7F50">{$_M[word][setimgRed2]}</option>
                    <option style="background-color:#6495ED;color: #6495ED" value="#6495ED">{$_M[word][setimgBlue1]}</option>
                    <option style="background-color:#DC143C;color: #DC143C" value="#DC143C">{$_M[word][setimgRed3]}</option>
                    <option style="background-color:#FF1493;color: #FF1493" value="#FF1493">{$_M[word][setimgRed4]}</option>
                    <option style="background-color:#FF00FF;color: #FF00FF" value="#FF00FF">{$_M[word][setimgRed5]}</option>
                    <option style="background-color:#FFD700;color: #FFD700" value="#FFD700">{$_M[word][setimgYellow1]}</option>
                    <option style="background-color:#DAA520;color: #DAA520" value="#DAA520">{$_M[word][setimgYellow2]}</option>
                    <option style="background-color:#808080;color: #808080" value="#808080">{$_M[word][setimgGray2]}</option>
                    <option style="background-color:#778899;color: #778899" value="#778899">{$_M[word][setimgGray3]}</option>
                    <option style="background-color:#B0C4DE;color: #B0C4DE" value="#B0C4DE">{$_M[word][setimgBlue2]}</option>
                </select>
            </div>
        </dd>
    </dl>
    </div>

    <div class='met_wate_class2'>
    <dl>
        <dt>{$_M['word']['setimgImg']}:</dt>
        <dd class="ftype_upload">
            <div class="fbox">
                <input
                    name="met_wate_img"
                    type="text"
                    data-upload-type="doupimg"
                    value="{$_M['config']['met_wate_img']}"
                />
            </div>
            <span class="tips">{$_M['word']['setimgTip2']}</span>
        </dd>
    </dl>
	
    <dl>
        <dt>{$_M['word']['setimgImg2']}:</dt>
        <dd class="ftype_upload">
            <div class="fbox">
                <input
                    name="met_wate_bigimg"
                    type="text"
                    data-upload-type="doupimg"
                    value="{$_M['config']['met_wate_bigimg']}"
                />
            </div>
            <span class="tips">{$_M['word']['setimgTip2']}</span>
        </dd>
    </dl>
    </div>

    <dl class="noborder">
		<dt> </dt>
		<dd>
			<input type="submit" name="submit" value="{$_M['word']['Submit']}" class="submit">
		</dd>
	</dl>

</div>
</form>
<!--
EOT;

require $this->template('ui/foot');
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>