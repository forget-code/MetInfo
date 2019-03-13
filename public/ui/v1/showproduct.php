<!--<?php
require_once template('head'); 
require_once template('sidebar');
$met_productnext=methtml_prenextinfo(1);
echo <<<EOT
-->
        <div id="showproduct">
            <dl class='pshow'>
                <dt data-product_x="{$met_productdetail_x}">
					<div class="met_box">
						<div class="met_imgshowbox">
							<div class="my-simple-gallery slides">
							<figure>
							  <a href="{$product[imgurl]}">
								  <img src="{$thumb_src}dir={$product[imgurl]}&x={$met_productdetail_x}&y={$met_productdetail_y}" alt="{$product[title]}" width="{$met_productdetail_x}" height="{$met_productdetail_y}" />
							  </a>
							  <figcaption>{$product[title]}</figcaption>
							</figure>
<!--
EOT;
if(count($displaylist)>0){
$dlist = "<li><img src=\"{$thumb_src}dir={$product[imgurl]}&x=70&y=70\" alt=\"{$product[title]}\" /></li>";
foreach($displaylist as $key=>$val){
$dlist.= "<li><img src=\"{$thumb_src}dir={$val[imgurl]}&x=70&y=70\" alt=\"{$val[title]}\" /></li>";
echo <<<EOT
-->
							<figure>
							    <a href="{$val[imgurl]}">
									<img src="{$thumb_src}dir={$val[imgurl]}&x={$met_productdetail_x}&y={$met_productdetail_y}" alt="{$val[title]}" width="{$met_productdetail_x}" height="{$met_productdetail_y}" />
							    </a>
							  <figcaption>{$val[title]}</figcaption>
							</figure>
<!--
EOT;
}
}
echo <<<EOT
-->
							</div>
						</div>
						<ol>{$dlist}</ol>
					</div>
				</dt>
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
			<div class="met_clear"></div>
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
			<ol class="met_nav">
<!--
EOT;
$i=0;
foreach($productTablist as $key=>$val){
$i++;
$met_now = $i==1?'class="met_now"':'';
echo <<<EOT
-->
				<li {$met_now}><a href="#mettab{$i}">{$val['title']}</a></li>
<!--
EOT;
}
echo <<<EOT
-->
			</ol>
			<div class="met_nav_contbox">
<!--
EOT;
$i=0;
foreach($productTablist as $key=>$val){
$i++;
$met_none = $i==1?'':'met_none';
echo <<<EOT
-->
				<div class="met_editor {$met_none}">{$val[content]}<div class="met_clear"></div></div>
<!--
EOT;
}
echo <<<EOT
-->
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