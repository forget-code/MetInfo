<?php defined('IN_MET') or exit('No permission'); ?>
<include file="head.php" />
<main class="met-index-body">
    <div class="met-index-news" m-id="met_index_news">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-xs-12">
                    <ul class="list-group">
                        <tag action="category" type="current" cid="$lang['home_news1']">
                            <li class="list-group-item active clearfix">
                                <h4 class="pull-xs-left m-y-0">{$m.name}</h4>
                                <a href="{$m.url}" class="pull-xs-right">{$lang.home_news_more}</a>
                            </li>
                            <tag action="list" cid="$m['id']" num="$lang['home_news_num']" type="$lang['home_news_type']">
                                <li class="list-group-item news-li clearfix">
                                    <span>{$v.updatetime}</span>
                                    <a href="{$v.url}" title="{$v.title}" target="{$lang.met_listurlblank}">
                                        {$v.title}
                                    </a>
                                </li>
                            </tag>
                        </tag>
                    </ul>
                </div>
                <div class="col-lg-4 col-md-4 col-xs-12">
                    <ul class="list-group">
                        <tag action="category" type="current" cid="$lang['home_news2']">
                            <li class="list-group-item active clearfix">
                                <h4 class="pull-xs-left m-y-0">{$m.name}</h4>
                                <a href="{$m.url}" class="pull-xs-right">{$lang.home_news_more}</a>
                            </li>
                            <tag action="list" cid="$m['id']" num="$lang['home_news_num']" type="$lang['home_news_type']">
                                <li class="list-group-item news-li clearfix">
                                    <span>{$v.updatetime}</span>
                                    <a href="{$v.url}" title="{$v.title}" target="{$lang.met_listurlblank}">
                                        {$v.title}
                                    </a>
                                </li>
                            </tag>
                        </tag>
                    </ul>
                </div>
                <div class="col-lg-4 col-md-4 col-xs-12">
                    <ul class="list-group">
                        <tag action="category" type="current" cid="$lang['home_news3']">
                            <li class="list-group-item active clearfix">
                                <h4 class="pull-xs-left m-y-0">{$m.name}</h4>
                                <a href="{$m.url}" class="pull-xs-right">{$lang.home_news_more}</a>
                            </li>
                            <tag action="list" cid="$m['id']" num="$lang['home_news_num']" type="$lang['home_news_type']">
                                <li class="list-group-item news-li clearfix">
                                    <span>{$v.updatetime}</span>
                                    <a href="{$v.url}" title="{$v.title}" target="{$lang.met_listurlblank}">
                                        {$v.title}
                                    </a>
                                </li>
                            </tag>
                        </tag>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</main>
<include file="foot.php" />