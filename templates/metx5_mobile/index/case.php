<!--<?php
$tem_case         = tmpcentarr($lang_case_id);
$tem_case['name'] = $lang_case_title?$lang_case_title:$tem_case['name'];
$tem_case['list'] = methtml_getarray($lang_case_id,$lang_case_type,'','',$lang_case_num);
echo <<<EOT
-->
<section class="tem_index_case {$into}">
	<div class="tem_inner">
		<h3 class="tem_index_title">
			<span>
				{$tem_case[name]}
				<p></p>
			</span>
		</h3>
		<div class="am-slider am-slider-default tem_index_case_list">
		<ul class="am-slides">
<!--
EOT;
$i=0;$k=1;$c=count($tem_case['list']);
foreach($tem_case['list'] as $key=>$val){
$i++;
$qq = $i==1?"<li>":'';
if($i==$k+4){$k = $i;$qq = "<li>";}
$qz = $i%4==0||$i==$c?"</li>":'';
$val[imgurl]="{$thumb_src}dir=../{$val[imgurl]}&x=300&y=300";
echo <<<EOT
-->
			{$qq}
				<dl class="tem_list">
					<dt><a href="{$val[url]}" title="{$val[title]}" {$metblank}><img src="{$val[imgurl]}" title="{$val[title]}" alt="{$val[title]}" /></a></dt>
					<dd>
						<h3><a href="{$val[url]}" title="{$val[title]}" {$metblank}>{$val[title]}</a></h3>
					</dd>
				</dl>
			{$qz}
<!--
EOT;
}
echo <<<EOT
--> 
		</ul>
		</div>
		<h4 class="tem_index_more"><a href="{$tem_case[url]}" title="{$lang_case_more}" {$metblank}>{$lang_case_more}</a></h4>
	</div>
</section>
<!--
EOT;
?>