<?php defined('IN_MET') or exit('No permission'); ?>
<tag action='news.list' num="$c['met_news_list']">
<li class="media media-lg border-bottom1">
<if value="$lang['news_imgok']">
	<div class="media-left">
		<a href="{$v.url}" title="{$v.title}" {$v.urlnew}>
			<img class="media-object" <if value="$v['_index'] gt 3 || $data['page'] gt 1">data-original<else/>src</if>="{$v.imgurl|thumb:$c['met_newsimg_x'],$c['met_newsimg_y']}" alt="{$v.title}" height='100'></a>
	</div>
</if>
	<div class="media-body">
		<h4>
			<a href="{$v.url}" {$v.urlnew} title="{$v.title}" target='_self'>{$v.title}</a>
		</h4>
		<p class="des font-weight-300">
			{$v.description}
		</p>
		<p class="info font-weight-300">
			<span>{$v.updatetime}</span>
			<span>{$v.issue}</span>
			<span>
				<i class="icon wb-eye m-r-5 font-weight-300" aria-hidden="true"></i>
				{$v.hits}
			</span>
		</p>
	</div>
</li>
</tag>