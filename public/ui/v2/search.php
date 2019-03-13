<!--<?php
if($mbpagelist){
	require_once template('module/search/ajax');// 无刷新翻页获取数据
}else{
	$subcolumn_no = 1;
	require_once template('head');
	$foldername=$class_list[$classnow][module]==11?$class_list[$classnow][foldername]:'search';
echo <<<EOT
-->
<section class="met-search met-page-body bg-pagebg1">
	<div class="container">
		<div class="row">
			<div class="met-search-body met-page-content box-shadow1">
				<form method='get' class="page-search-form" role="search" action='{$navurl}{$foldername}/search.php'>
					<input type='hidden' name='lang' value='{$lang}' />
					<input type='hidden' name='class1' value='{$class1}' />
					<div class="input-search input-search-dark">
						<button type="submit" class="input-search-btn"><i class="icon wb-search" aria-hidden="true"></i></button>
						<input
							type="text"
							class="form-control input-lg"
							name="searchword"
							value="{$searchword}"
							placeholder="{$lang_SearchInfo1}"
							required
							data-fv-message = "{$lang_Empty}"
						>
					</div>
				</form>
				<ul class="list-group list-group-full list-group-dividered m-t-20 met-pager-ajax">
<!--
EOT;
	require_once template('module/search/ajax');
echo <<<EOT
-->
				</ul>
<!--
EOT;
	if($search_list_num==0 && $searchword){// 搜索结果为空的情况
echo <<<EOT
-->
				<h4 class="page-search-title m-t-80 text-xs-center">
					{$lang_SearchInfo3} “ <span class='blue-600'>{$searchword}</span> ” {$lang_SearchInfo4}
				</h4>
<!--
EOT;
	}
	if($search_list_num) require_once template('module/pager');// 分页
echo <<<EOT
-->
			</div>
		</div>
	</div>
</section>
<!--
EOT;
	require_once template('foot');
}
?>