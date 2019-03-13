<?php defined('IN_MET') or exit('No permission'); ?>
<include file="head.php" />
<section class="met-news animsition">
    <div class="container">
        <div class="row">
            <div class="col-md-9 met-news-body">
                <div class="row">
                    <div class="met-news-list" m-id="noset">
                        <tag action='news.list' num="$c['met_news_list']"></tag>
                        <if value="$sub">
                        <ul class="ulstyle met-pager-ajax imagesize" data-scale='{$c.met_newsimg_y}x{$c.met_newsimg_x}'>
                            <include file='ajax/news'/>
                        </ul>
                        <else/>
                        <div class='h-100 text-xs-center font-size-20 vertical-align'>{$lang.nodata}</div>
                        </if>
                        <div class='m-t-20 text-xs-center hidden-sm-down' m-type="nosysdata">
                            <pager/>
                        </div>
                        <div class="met_pager met-pager-ajax-link hidden-md-up" data-plugin="appear" data-animate="slide-bottom" data-repeat="false" m-type="nosysdata">
                            <button type="button" class="btn btn-primary btn-block btn-squared ladda-button" id="met-pager-btn" data-plugin="ladda" data-style="slide-left" data-url="" data-page="1">
                                <i class="icon wb-chevron-down m-r-5" aria-hidden="true"></i>
                                {$lang.page_ajax_next}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
            <div class="row">
                <div class="met-bar" m-id="news_bar" m-type="nocontent">
                    <form class='sidebar-search' method='get' action="{$c.met_weburl}search/search.php">
                        <input type='hidden' name='lang' value='{$data.lang}' />
                        <input type='hidden' name='class1' value='{$data.class1}' />
                        <div class="form-group">
                            <div class="input-search">
                                <button type="submit" class="input-search-btn">
                                    <i class="icon wb-search" aria-hidden="true"></i>
                                </button>
                                <input type="text" class="form-control" name="searchword" placeholder="{$lang.search_placeholder}">
                            </div>
                        </div>
                    </form>
                    <if value="$lang.news_bar_list_open">
                    <div class="sidebar-news-list recommend">
                        <h3 class=' font-weight-300 m-0'>{$lang.news_bar_list_title}</h3>
                        <ul class="list-group list-group-bordered m-t-10 m-b-0">
                            <tag action='list' cid="$data['class1']" num="$lang['news_bar_list_num']" type="$lang['news_bar_list_type']">
                            <li class="list-group-item">
                                <a href="{$v.url}" title="{$v.title}" target='_self'>{$v.title}</a>
                            </li>
                            </tag>
                        </ul>
                    </div>
                    </if>
                    <if value="$lang['bar_column_open']">
                    <ul class="column list-icons">
                        <tag action='category' cid="$data['class1']" class='active'>
                        <li>
                            <a href="{$m.url}" title="{$m.name}" class="{$m.class}" target='_self'><h3 class="font-weight-300">{$m.name}</h3></a>
                        </li>
                        <tag action='category' cid="$m['id']" type='son' class='active'>
                        <li>
                            <if value="$m['sub']&& $lang['bar_column3_open']">
                            <a href="javascript:;" title="{$m.name}" class='{$m.class}' data-toggle="collapse" data-target=".sidebar-column3-{$m._index}">{$m.name}<i class="wb-chevron-right-mini"></i></a>
                            <div class="sidebar-column3-{$m._index} collapse" aria-expanded="false">
                                <ul class="m-t-5 p-l-20">
                                    <li><a href="{$m.url}" title="{$lang.all}" class="{$m.class}">{$lang.all}</a></li>
                                    <tag action='category' cid="$m['id']" type='son' class='active'>
                                    <li><a href="{$m.url}" title="{$m.name}" class='{$m.class}'>{$m.name}</a></li>
                                    </tag>
                                </ul>
                            </div>
                            <else/>
                            <a href="{$m.url}" title="{$m.name}" class='{$m.class}'>{$m.name}</a>
                            </if>
                        </li>
                        </tag>
                        </tag>
                    </ul>
                    </if>
                </div>

            </div>
        </div>
        </div>
    </div>
</section>
<include file="foot.php" />