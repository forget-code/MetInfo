<if value="$lang['tagshow_2']">
<tag action="category" type="current" cid="$data['class1']">
<if value="$m['sub']">
<section class="met-column-nav" m-id="subcolumn_nav" m-type="nocontent">
    <div class="container">
        <div class="row">
            <ul class="clearfix met-column-nav-ul">
                <tag action='category' cid="$data['class1']" class="active">
                <if value="$m['module'] neq 1">
                    <li>
                        <a href="{$m.url}"  title="{$lang.sub_all}" <if value="$data['classnow'] eq $m['id']">class="active"</if>>{$lang.sub_all}</a>
                    </li>
                    <else/>
                    <if value="$m[isshow]">
                    <li>
                        <a href="{$m.url}"  title="{$m.name}" <if value="$data['classnow'] eq $m['id']">class="active"</if>>{$m.name}</a>
                    </li>
                    </if>
                </if>
                <tag action='category' cid="$m['id']" type='son' class="active">
                    <if value="$m['sub']">
                        <li class="dropdown">
                            <a href="{$m.url}" title="{$m.name}" class="dropdown-toggle <if value="$data['classnow'] eq $m['id']">active</if>" data-toggle="dropdown">{$m.name}</a>
                            <div class="dropdown-menu animate">
                                <if value="$data['class1']['module'] neq 1">
                                    <a href="{$m.url}"  title="{$lang.sub_all}" class='dropdown-item {$m.class}'>{$lang.sub_all}</a>
                                </if>
                                <tag action='category' cid="$m['id']" type='son' class="active">
                                <a href="{$m.url}" title="{$m.name}" class='dropdown-item {$m.class}'>{$m.name}</a>
                                </tag>
                            </div>
                        </li>
                        <else/>
                        <li>
                            <a href="{$m.url}" title="{$m.name}" class='{$m.class}'>{$m.name}</a>
                        </li>
                    </if>
                </tag>
                </tag>
            </ul>
        </div>
    </div>
</section>
</if>
</tag>
</if>