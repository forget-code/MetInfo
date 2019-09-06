<?php defined('IN_MET') or exit('No permission'); ?>
<include file="head.php" />
<main>
    <div class="met-index-product met-index-body text-xs-center" m-id="met_index_product">
        <div class="container">
            <if value="$lang['index_product_title']">
            <h2 class="m-t-0 invisible" data-plugin="appear" data-animate="slide-top" data-repeat="false">{$lang.index_product_title}</h2>
            </if>
            <if value="$lang['index_product_desc']">
            <p class="desc m-b-0 font-weight-300 invisible" data-plugin="appear" data-animate="fade" data-repeat="false">{$lang.index_product_desc}</p>
            </if>
            <div class='nav-tabs-horizontal nav-tabs-inverse nav-tabs-animate' data-plugin="tabs">
                <ul class="nav nav-tabs nav-tabs-solid flex flex-center">
                    <li class="nav-item" role="presentation">
                    <tag action="category" type="current" cid="$lang['index_product_id']">
                    <if value="$lang['index_product_style_type']">
                        <a class="nav-link active radius0" data-toggle="tab" href="#all{$m.id}" aria-controls="all{$m.id}" role="tab" aria-expanded="true">
                            <h3 class='font-weight-300'>{$lang.index_product_all}</h3>
                        </a>
                    <else/>
                        <a class="nav-link active radius0" href="{$m.url}" title="{$m.name}">
                            <h3 class='font-weight-300'>{$lang.index_product_all}</h3>
                        </a>
                    </if>
                    </tag>
                    </li>
                    <tag action="category" cid="$lang['index_product_id']" type="son">
                    <li class='nav-item' role="presentation">
                        <a class="nav-link radius0" <if value="$lang['index_product_style_type']">href="#list_{$m.id}" data-toggle="tab" aria-controls="list_{$m.id}" role="tab" aria-expanded="true"<else/>href="{$m.url}"</if>  title="{$m.name}">
                            <h3 class='font-weight-300'>{$m.name}</h3>
                        </a>
                    </li>
                    </tag>
                </ul>
            </div>
            <div class="tab-content">
                <tag action="category" cid="$lang['index_product_id']" type="current">
                <ul class="
                    <if value="$lang['index_product_column_xs'] eq 1">
                    block-xs-100
                    <else/>
                    blocks-xs-{$lang.index_product_column_xs}
                    </if>
                    blocks-md-{$lang.index_product_column_md} blocks-lg-{$lang.index_product_column_lg} blocks-xxl-{$lang.index_product_column_xxl} no-space imagesize index-product-list tab-pane active animation-scale-up"
                    id="all{$m.id}" role="tabpanel"
                     data-scale='{$lang.index_product_img_h}X{$lang.index_product_img_w}'>
                    <tag action="list" cid="$m['id']" num="$lang['index_product_allnum']" type="$lang['index_product_type']">
                        <li class='p-r-10 m-b-10' data-type="list_{$v.class2}">
                            <div class="card card-shadow">
                                <figure class="card-header cover">
                                    <a href="{$v.url}" title="{$v.title}" {$g.urlnew}>
                                        <img class="cover-image lazy" data-original="{$v.imgurl|thumb:$lang[img_w],$lang[img_h]}" alt="{$v.title}" ></a>
                                </figure>
                                <h4 class="card-title m-0 p-x-10 text-shadow-none font-szie-16 font-weight-300">
                                    <a href="{$v.url}" title="{$v.title}" class="block text-truncate" {$g.urlnew}>{$v.title}</a>
                                    <if value="$m[module] eq 3 && $c['shopv2_open']">
                                    <p class='m-b-0 m-t-5 red-600'>{$v.price_str}</p>
                                    </if>
                                </h4>
                            </div>
                        </li>
                    </tag>
                </ul>
                </tag>
                <if value="$lang['index_product_style_type']">
                <tag action="category" cid="$lang['index_product_id']" type="son">
                    <ul class="
                    <if value="$lang['index_product_column_xs'] eq 1">
                    block-xs-100
                    <else/>
                    blocks-xs-{$lang.index_product_column_xs}
                    </if>
                    blocks-md-{$lang.index_product_column_md} blocks-lg-{$lang.index_product_column_lg} blocks-xxl-{$lang.index_product_column_xxl} no-space imagesize index-product-list tab-pane animation-scale-up" data-scale='{$lang.index_product_img_h}X{$lang.index_product_img_w}'  id="list_{$m.id}" role="tabpanel">
                    <tag action="list" cid="$m['id']" num="$lang['index_product_allnum']" type="$lang['index_product_type']">
                    <li class='p-r-10 m-b-10' data-type="list_{$v.class2}">
                        <div class="card card-shadow">
                            <figure class="card-header cover">
                                <a href="{$v.url}" title="{$v.title}" {$g.urlnew}>
                                    <img class="cover-image lazy" data-src="{$v.imgurl|thumb:$lang[img_w],$lang[img_h]}" alt="{$v.title}" ></a>
                            </figure>
                            <h4 class="card-title m-0 p-x-10 text-shadow-none font-szie-16 font-weight-300">
                                <a href="{$v.url}" title="{$v.title}" class="block text-truncate" {$g.urlnew}>{$v.title}</a>
                                <if value="$m[module] eq 3 && $c['shopv2_open']">
                                <p class='m-b-0 m-t-5 red-600'>{$v.price_str}</p>
                                </if>
                            </h4>
                        </div>
                    </li>
                    </tag>
                    </ul>
                </tag>
                </if>
            </div>
        </div>
    </div>
    <div class="met-index-news met-index-body text-xs-center" m-id="met_index_news">
        <div class="container">
            <if value="$lang['index_news_title']">
            <h2 class="m-t-0 invisible" data-plugin="appear" data-animate="slide-top" data-repeat="false">{$lang.index_news_title}</h2>
            </if>
            <if value="$lang['index_news_desc']">
            <p class="desc m-b-0 font-weight-300 invisible" data-plugin="appear" data-animate="fade" data-repeat="false">{$lang.index_news_desc}</p>
            </if>
            <div class="row text-xs-left m-t-30 index-news-list">
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