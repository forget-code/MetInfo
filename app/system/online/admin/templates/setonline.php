<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/1
 * Time: 17:21
 */
defined('IN_MET') or exit('No permission');

require $this->template('ui/head');

echo <<<EOT
-->
<link rel="stylesheet" href="{$_M[url][own_tem]}css/online.css?{$jsrand}" />
<form method="POST" class="ui-from" name="myform" action="{$_M[url][own_form]}a=doonlinesave" target="_self">
    <div class="v52fmbx">
	<h3 class="v52fmbx_hr metsliding" sliding="1">{$_M['word']['unitytxt_1']}</h3>
	<div class="metsliding_box metsliding_box_1">
		<dl>
            <dt>{$_M['word']['setskinOnline']}</dt>
            <dd class="ftype_radio">
                <div class="fbox">
                    <label><input name="met_online_type" type="radio" value="3" data-checked="{$_M['config']['met_online_type']}"><span>{$_M['word']['setskinOnline1']}</span></label>
                    <label><input name="met_online_type" type="radio" value="4"><span>{$_M['word']['setskinOnline9']}</span></label>
                    <label><input name="met_online_type" type="radio" value="1"><span>{$_M['word']['setskinOnline2']}</span></label>
                    <label><input name="met_online_type" type="radio" value="2"><span>{$_M['word']['setskinOnline3']}</span></label>
                    <label><input name="met_online_type" type="radio" value="0"><span>{$_M['word']['close']}</span></label>
                </div>
            </dd>
        </dl>
<!--
EOT;
if ($_M['config']['met_online_type'] == 0) {
    $show = 'none';
}
echo <<<EOT
-->
    <div class="v52fmbx_dlbox" id="onlineleft" style="display:$show">
    <dl>
        <dt>{$_M['word']['setskinOnline10']}</dt>
        <dd>
            <cc>{$_M['word']['setskinOnline5']}</cc>&nbsp;
            <input type="text" name="met_online_x" value="{$_M['config']['met_online_x']}" class='ui-input listname' mid">&nbsp;{$_M['word']['setflashPixel']}&nbsp;&nbsp;{$_M['word']['setskinOnline6']} 
            <input type="text" name="met_online_y" value="{$_M['config']['met_online_y']}" class='ui-input listname' mid">{$_M['word']['setflashPixel']}
        </dd>
    </dl>
    </div>

	</div>
	<h3 class="v52fmbx_hr metsliding" sliding="2">{$_M['word']['unitytxt_14']}</h3>
	<div class="metsliding_box metsliding_box_2">
		<div class="v52fmbx_dlbox" id="onlineright">
		<dl>
		<dt>{$_M['word']['onlineskintype']}</dt>
		<dd class="ftype_color">
		<div class="fbox">
		<input type="text" name="met_online_color" value="{$_M['config'][met_online_color]}" >
		</div>
		</dd>
		</dl>
		</div>
	<h3 class="v52fmbx_hr metsliding" sliding="3">{$_M['word']['unitytxt_15']}</h3>
    <dl>
        <dt>{$_M['word']['onlineName']}</dt>
        <dd class="ftype_checkbox">
            <div class="fbox">
                <label style="display: inline-block;padding-right: 10px;"><input name="met_onlinenameok" type="checkbox" data="{$_M['config']['met_onlinenameok']}" value="1">{$_M['word']['close']}</label><span>({$_M[word][onlone_onlinetitle_v6]})</span>
            </div>
        </dd>
    </dl>
    <dl>
        <dt>{$_M[word][onlinetel]}</dt>
        <dd class="ftype_ckeditor">
            <div class="fbox">
                <textarea name="met_onlinetel" data-ckeditor-type="2" data-ckeditor-y="100">{$_M['config']['met_onlinetel']}</textarea>
            </div>
            <span class="tips">{$_M['word']['onlinetel1']}</span>
        </dd>
    </dl>

		<div class="v52fmbx_submit"><input type="submit" name="Submit" value="{$_M['word']['Submit']}" class="submit" onclick="return Smit($(this),'myform')" /></div>
</div>

<!--imgtype-->
<!--
EOT;
$imgtype=array(0=> 'qq', 1=>'msn', 2=> 'taobao', 3=> 'skype',4=>'alibaba');
for($i=0;$i<5;$i++){
    echo <<<EOT
-->
<div id="online_box_{$imgtype[$i]}" style="display:none">

	<h3><img src="{$_M[url][own_tem]}images/delete.png" onclick="closediv('online_box_{$imgtype[$i]}')" />{$_M['word']['indexonlieimg']}</h3>
	<ul>
<!--
EOT;
    $qqstyle=array(0=> 4, 1=>45, 2=> 5, 3=> 8,4=> 9, 5=>10, 6=>44, 7=>46,8=> 1, 9=> 6,10=> 7,11=>47,12=>41,13=>42,14=> 2,15=> 3,16=>11,17=>12,18=>43,19=>13);
    $msnstyle=array(0=> 1, 1=> 2, 2=> 3, 3=> 4,4=> 5, 5=>6, 6=>7, 7=>8,8=> 9, 9=>10,10=>11,11=>12,12=>13);
    $taobaostyle=array(0=>2,1=>1);
    $skypestyle=array(0=> 11, 1=> 12, 2=> 13, 3=> 4,4=> 5, 5=>6, 6=>7, 7=>8,8=> 9, 9=>10,10=>1,11=>2,12=>3);
    $alibabastyle=array(0=>10,1=>11, 2=> 12);
    if($i==0)$style=$qqstyle;
    if($i==1)$style=$msnstyle;
    if($i==2)$style=$taobaostyle;
    if($i==3)$style=$skypestyle;
    if($i==4)$style=$alibabastyle;
    $num=count($style);
    for($k=0;$k<$num;$k++){
        $stl='';
        if($i==0 && $style[$k]==11)$stl='style="position:relative; bottom:10px;"';
        if($i==0)$met_type1=$met_qq_type1[$style[$k]];
        if($i==1)$met_type1=$met_msn_type1[$style[$k]];
        if($i==2)$met_type1=$met_taobao_type1[$style[$k]];
        if($i==3)$met_type1=$met_skype_type1[$style[$k]];
        if($i==4)$met_type1=$met_alibaba_type1[$style[$k]];
        $hz='jpg';
        if($i==1||$i==3)$hz='gif';
		dump($_M['url']['site']);
        echo <<<EOT
-->
	<li>
	<span><input type="radio" value="{$style[$k]}" name="met_{$imgtype[$i]}_type" {$met_type1} /></span>
	<img src="{$_M['url']['site']}public/images/{$imgtype[$i]}/{$imgtype[$i]}_{$style[$k]}.{$hz}" {$stl} />
	</li>
<!--
EOT;
    }
    echo <<<EOT
-->
	</ul>
	<div class="clear"></div>
	<div class="botom">
		<a href="javascript:void(0)" onclick="closediv('online_box_{$imgtype[$i]}')">{$_M['word']['indexonlieno']}</a>
		<a href="javascript:void(0)" onclick="okonlineqq('{$imgtype[$i]}')">{$_M['word']['indexonlieok']}</a>

	</div>
</div>
<!--
EOT;
}
echo <<<EOT
-->
<!--imgtype_over-->
</form>
<!--
EOT;
require $this->template('ui/foot');
#dump($this->template('ui/foot'));
# This program is an open sourdivshow('online_box_skype') system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>