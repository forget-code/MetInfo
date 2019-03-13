<?php defined('IN_MET') or exit('No permission'); ?>
<tag action='search.list'>
<li class="list-group-item">
	<h4><a href="{$v.url}" title='{$v.ctitle}' {$g.urlnew}>{$v.ctitle}</a></h4>
	<a class="search-result-link" href="{$v.url}" {$g.urlnew}>{$v.url}</a>
	<p>{$v.content}</p>
</li>
</tag>