<?php defined('IN_MET') or exit('No permission'); ?>
<include file="head.php" />
<section class="met-showdownload animsition">
    <div class="container">
        <div class="row">
            <div class="col-md-9 met-showdownload-body" m-id='noset' >
                <div class="row">
                    <section class="details-title">
                        <h1 class='m-t-10 m-b-5'>{$data.title}</h1>
                        <div class="info">
                            <span>{$data.updatetime}</span>
                            <span>{$data.issue}</span>
                            <span>
                                <i class="icon wb-eye m-r-5" aria-hidden="true"></i>
                                {$data.hits}
                            </span>
                        </div>
                    </section>
                    <section class="download-paralist">
                        <if value="$data['para']">
                            <list data="$data['para']" name="$s">
                            <dl class="dl-horizontal clearfix blocks font-size-16">
                                <dt class='font-weight-300'><span>{$s.name}</span> :<span class="p-x-10">{$s.value}</span></dt>
                            </dl>
                            </list>
                        </if>
                        <a class="btn btn-outline btn-primary btn-squared met-showdownload-btn m-t-20" href="{$data.downloadurl}" title="{$data.title}">{$lang.download}</a>
                    </section>
                    <section class="met-editor clearfix">
                        {$data.content}
                    </section>
                   <if value="$data[taglist]">
                    <div class="detail_tag font-size-14">
                        <span>{$data.tagname}</span>
                        <list data="$data[taglist]" name="$tag">
                            <a href="{$tag.url}" title="{$tag.name}">{$tag.name}</a>
                        </list>
                    </div>
                    </if>
                </div>
            </div>
            <div class="col-md-3" m-id="downlaod_bar" m-type="nocontent">
                <div class="row">
                    <div class="met-bar">
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
                        <if value="$lang['sidebar_downloadlist_ok']">
                        <div class="sidebar-news-list recommend">
                            <h3 class='m-0'>{$lang.download_bar_list_title}</h3>
                            <ul class="list-group list-group-bordered m-t-10 m-b-0">
                                <tag action='list' cid="$data['class1']" num="$lang['sidebar_downloadlist_num']" type="$lang['download_bar_list_type']">
                                <li class="list-group-item">
                                    <a href="{$v.url}" title="{$v.title}" target='_self'>{$v.title}</a>
                                </li>
                                </tag>
                            </ul>
                        </div>
                        </if>
                        <if value="$lang['downloadsidebar_column_ok']">
                        <ul class="column list-icons p-l-0">
                            <tag action='category' cid="$data['class1']" class='active'>
                            <li>
                                <a href="{$m.url}" title="{$m.name}" class="{$m.class}" target='_self'><h3>{$m.name}</h3></a>
                            </li>
                            <tag action='category' cid="$m['id']" type='son' class='active'>
                            <li>
                                <if value="$m['sub'] && $lang['download_column3_ok']">
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