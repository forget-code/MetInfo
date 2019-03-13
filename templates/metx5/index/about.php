<!--<?php
echo <<<EOT
-->
<!--
EOT;
$tem_about = tmpcentarr($lang_about_id);
if($lang_about_img1)$tem_aboutimg[1]  = $lang_about_img1;
if($lang_about_img2)$tem_aboutimg[2]  = $lang_about_img2;
if($lang_about_img3)$tem_aboutimg[3]  = $lang_about_img3;
$txtwd100 = $tem_aboutimg||$lang_about_video?'':'txtwd100';
$tem_wp1 = $lang_waypointsok==1?'tem_wp1':'';
echo <<<EOT
-->
<section class="tem_index_about">
	<div class="tem_inner">
		<h3 class="tem_index_title">
			<span>
				{$lang_about_title}
				<p></p>
			</span>
		</h3>
		<div class="tem_index_about_cont {$tem_wp1}">
			<div class="tem_index_about_txt {$txtwd100}">
				<div class="met_editor">
					{$lang_about_content}<div class="met_clear"></div>
					<h4 class="tem_index_about_more"><a href="{$tem_about[url]}" title="{$lang_about_more}" {$metblank}>{$lang_about_more}</a></h4>
				</div>
			</div>
<!--
EOT;
if($lang_about_video){
echo <<<EOT
-->
			<div class="tem_index_about_video">
				{$lang_about_video}
			</div>
<!--
EOT;
}elseif($tem_aboutimg){
$noe = count($tem_aboutimg)==1?'class="tem_index_about_img_noe"':'';
echo <<<EOT
-->	
			<div class="tem_index_about_img">
				<ul {$noe}>
<!--
EOT;
foreach($tem_aboutimg as $key=>$val){
echo <<<EOT
-->
					<li><img src="{$val}" /></li>
<!--
EOT;
}
echo <<<EOT
-->
				</ul>
<!--
EOT;
if(count($tem_aboutimg)>1){
echo <<<EOT
-->	
				<ol>
<!--
EOT;
$i=0;
foreach($tem_aboutimg as $key=>$val){
if($val){
$i++;
$tem_now = $i==1?'class="tem_now"':'';
echo <<<EOT
-->
					<li {$tem_now}><img src="{$val}" /><i class="fa fa-caret-left"></i></li>
<!--
EOT;
}}
echo <<<EOT
-->
				</ol>
<!--
EOT;
}
echo <<<EOT
-->	
			</div>
<!--
EOT;
}
echo <<<EOT
-->	
			<div class="met_clear"></div>
		</div>
	</div>
</section>
<!--
EOT;
?>