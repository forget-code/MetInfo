<!--<?php
require_once template('head'); 
require_once template('sidebar');
$met_productnext=methtml_prenextinfo(1);
echo <<<EOT
-->
        <div id="showproduct">
						<div class="am-slider met_imgshowbox">
							<ul class="am-slides my-simple-gallery am-gallery" data-am-widget="gallery" data-am-gallery="{pureview: 1}">
							<li>
								<div class="am-gallery-item">
									<img src="{$thumb_src}dir={$product[imgurl]}&x=480&y=480" data-rel="{$product[imgurl]}" alt="{$product[title]}" />
									<h3 class="am-gallery-title">{$product[title]}</h3>
								</div>
							</li>
<!--
EOT;
if(count($displaylist)>0){
foreach($displaylist as $key=>$val){
echo <<<EOT
-->
							<li>
								<div class="am-gallery-item">
									<img src="{$thumb_src}dir={$val[imgurl]}&x=480&y=480" data-rel="{$val[imgurl]}" alt="{$val[title]}" />
									<h3 class="am-gallery-title">{$val[title]}</h3>
								</div>
							</li>
<!--
EOT;
}
}
echo <<<EOT
-->
							</ul>
						</div>
			
            <dl class='pshow'>
		        <dd>
					<div class="met_box">
					<h1 class='met_title'>{$product[title]}</h1>
		            <ul>
<!--
EOT;
foreach($product_paralist as $key=>$val){
echo <<<EOT
-->
                        <li><span>{$val[name]}</span>{$product[$val[para]]}</li>
<!--
EOT;
}
$product[descriptionhtml] = $product[description]?"<p class=\"desc\">{$product[description]}</p>":'';
echo <<<EOT
-->
			        </ul>
					{$product[descriptionhtml]}
					</div>
		        </dd>
	        </dl>
<!--
EOT;
$productTablist[0]['title'] = $met_productTabname;
$productTablist[0]['content'] = $product[content];
for($i=1;$i<=($met_productTabok-1);$i++){
	$met_productTabname = 'met_productTabname_'.$i;
	$productTablist[$i]['title']   = $$met_productTabname;
	$productTablist[$i]['content'] = $product['content'.$i];
}
echo <<<EOT
-->
		<div class="am-tabs" data-am-tabs="{noSwipe: 1}" >
			<div class="met_nav" data-am-sticky>
				<div id="wrapper">
					<div id="scroller">
						<ol class="am-tabs-nav am-nav am-nav-tabs">
<!--
EOT;
$i=0;
foreach($productTablist as $key=>$val){
$i++;
$met_now = $i==1?'class="am-active"':'';
echo <<<EOT
-->
							<li {$met_now}><a href="#tab{$i}">{$val['title']}</a></li>
<!--
EOT;
}
echo <<<EOT
-->
						</ol>
					</div>
				</div>
			</div>
			<div class="met_nav_contbox am-tabs-bd">
<!--
EOT;
$i=0;
foreach($productTablist as $key=>$val){
$i++;
$met_now = $i==1?'am-in am-active':'';
echo <<<EOT
-->
				<div class="met_editor {$met_now} am-tab-panel am-fade" id="tab{$i}">{$val[content]}<div class="met_clear"></div></div>
<!--
EOT;
}
echo <<<EOT
-->
			</div>
		</div>
			<div class="met_tools">
				{$met_tools_code}
				<span class="met_Clicks met_none"><!--累计浏览次数--></span>
				<ul class="met_page">
					<li class="met_page_preinfo"><span>{$lang_Previous}</span><a href='{$preinfo[url]}'>{$preinfo[title]}</a></li>
					<li class="met_page_next"><span>{$lang_Next}</span><a href='{$nextinfo[url]}'>{$nextinfo[title]}</a></li>
				</ul>
			</div>
<!--
EOT;
if(count($product_list)>1){
echo <<<EOT
-->
			<h3 class="met_related">{$lang_product_related_title}</h3>
			<ul class="met_related_list">
<!--
EOT;
$i=0;
foreach($product_list as $key=>$val){
if($val[id]!=$product[id]){
$i++;
echo <<<EOT
-->
				<li>
					<a href="{$val[url]}" title="{$val[title]}" {$metblank}>
						<img src="{$thumb_src}dir={$val[imgurl]}&x={$met_productimg_x}&y={$met_productimg_y}"
							width ="{$met_productimg_x}" height="{$met_productimg_y}"
						/>
						<h2>{$val['title']}</h2>
					</a>
				</li>
<!--
EOT;
if($i>=$lang_product_related_num)break;
}}
echo <<<EOT
--> 
			</ul>
<!--
EOT;
}
echo <<<EOT
-->
	    </div>
<!--
EOT;
require_once template('gap');
require_once template('foot'); 
?>