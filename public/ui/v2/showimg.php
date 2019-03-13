<?php
$subcolumn_no = 1;
require_once template('head');
methtml_imgdisplay('img');//图片模块详情页数据处理
$img['content'] = $metresclass->lazyload($img['content']);// 内容图片懒加载设置
if(!$img['issue']) $img['issue'] = $met_webname;// 发布者判断
$img_num=$displaylist?count($displaylist):count($img[imgurl]);// 展示图片数量判断
if($img_num>1) $paddingb=' slick-dotted';// 展示图片数量>1时的样式
echo <<<EOT
-->
<section class="met-shownews border-top1 met-page-body bg-pagebg1">
	<div class="container">
		<div class="row">
			<div class="col-lg-9 met-shownews-body met-page-content box-shadow1{$content_position}" boxmh-mh>
				<div class="met-shownews-header details-title border-bottom1">
					<h1 class='m-t-10 m-b-5'>{$img[title]}</h1>
					<div class="info">
						<span>
							{$img['updatetime']}
						</span>
						<span>
							{$img['issue']}
						</span>
						<span>
							<i class="icon wb-eye m-r-5" aria-hidden="true"></i>{$img['hits']}
						</span>
					</div>
				</div>
<!--
EOT;
// 展示图片列表
if($img_num){
echo <<<EOT
-->
				<div class='met-showimg-con'>
					<div class='met-showimg-list fngallery{$paddingb} cover text-xs-center' id="met-imgs-slick">
<!--
EOT;
	$img[size_default]="{$met_imgdetail_x}x{$met_imgdetail_y}";
	if($displaylist){
		foreach($displaylist as $key=>$val){
			$val[imgurls]="{$thumb_src}dir={$val[imgurl]}&x={$met_imgdetail_x}&y={$met_imgdetail_y}";
		    $src='data-lazy';
		    $exthumbimage="{$thumb_src}dir={$val[imgurl]}&x=60&y=60";
		    if($key==0){
		        $src='src';
		        $exthumbimage="{$thumb_src}dir={$val[imgurl]}&x={$met_imgdetail_x}&y={$met_imgdetail_y}";
		    }
		    if(!$val[size]) $val[size]=$img[size_default];
echo <<<EOT
-->
                        <div class='slick-slide'>
                        	<a href="{$val[imgurl]}" data-size="{$val[size]}" data-med="{$val[imgurl]}" data-med-size="{$val[size]}" class='lg-item-box' data-src="{$val[imgurl]}" data-exthumbimage="{$exthumbimage}" data-sub-html='{$val[title]}'>
                                <img {$src}="{$thumb_src}dir={$val[imgurl]}&x={$met_imgdetail_x}&y={$met_imgdetail_y}" class="img-fluid" alt="{$val[title]}" />
                            </a>
                        </div>
<!--
EOT;
		}
	}else{
		$img[imgurls]="{$thumb_src}dir={$img[imgurl]}&x={$met_imgdetail_x}&y={$met_imgdetail_y}";
		if(!$img[imgsize]) $img[imgsize]=$img[size_default];
echo <<<EOT
-->
						<div class='slick-slide'>
                            <a href="{$img[imgurl]}" data-size="{$img[imgsize]}" data-med="{$img[imgurl]}" data-med-size="{$img[imgsize]}" class='lg-item-box' data-src="{$img[imgurl]}" data-exthumbimage="{$img[imgurls]}" data-sub-html='{$img[title]}'>
                                <img src="{$img[imgurls]}" class="img-fluid" alt="{$img[title]}" />
                            </a>
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
}
// 参数列表
if($img_paralist){
echo <<<EOT
-->
				<ul class="img-paralist paralist blocks-100 blocks-sm-2 blocks-md-3 blocks-xl-4">
<!--
EOT;
	foreach($img_paralist as $key=>$val){
		if($img[$val[para]]){
echo <<<EOT
-->
					<li><span>{$val[name]}：</span>{$img[$val[para]]}</li>
<!--
EOT;
		}
	}
echo <<<EOT
-->
				</ul>
<!--
EOT;
}
echo <<<EOT
-->
				<div class="met-editor clearfix p-x-0">
					{$img[content]}
<!--
EOT;
// 分享代码
if($lang_sharecode){
echo <<<EOT
-->
					<div class="met_tools_code">{$lang_sharecode}</div>
<!--
EOT;
}
echo <<<EOT
-->
				</div>
				<div class="met-shownews-footer border-top1">
<!--
EOT;
require_once template('module/page');// 翻篇
echo <<<EOT
-->
				</div>
			</div>
			<div class="col-lg-3">
				<div class="row">
<!--
EOT;
require_once template('module/md/sidebar');// 侧栏
echo <<<EOT
-->
				</div>
			</div>
		</div>
	</div>
</section>
<!--
EOT;
require_once template('foot');
?>