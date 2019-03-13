<?php
echo <<<EOT
-->
<ul class="navbar-nav vertical-align p-l-0 m-b-0 met-head-user">
<!--
EOT;
if(!$_M[user][head]) $_M[user][head]=get_met_cookie('metinfo_member_head');
$_M[user][head]=str_replace($_M[url][site],$navurl,$_M[user][head]);
if(!strstr($_M[user][head],$navurl)) $_M[user][head]=$navurl.$_M[user][head];
$metinfo_member_name = get_met_cookie('metinfo_member_name');
if($metinfo_member_name){
echo <<<EOT
-->
    <li class="dropdown vertical-align-middle met-head-user-column">
        <a href="javascript:;" class="navbar-avatar dropdown-toggle dropdown-item" data-toggle="dropdown">
            <span class="avatar m-r-5"><img src="{$_M[user][head]}" alt="{$metinfo_member_name}" style='position:relative;top: -2px;'></span>
            {$metinfo_member_name}
        </a>
        <ul class="dropdown-menu dropdown-menu-right animate">
<!--
EOT;
    if($_M['config']['shopv2_open']){
echo <<<EOT
-->
            <a href="{$_M['url']['shop_profile']}" class='dropdown-item'><i class="icon wb-user" aria-hidden="true"></i>{$_M['word']['app_shop_personal']}</a>
            <a href="{$_M['url']['shop_order']}" class='dropdown-item'><i class="icon wb-order" aria-hidden="true"></i>{$_M['word']['app_shop_myorder']}</a>
<!--
EOT;
        if($is_shopv3){
echo <<<EOT
-->
            <a href="{$_M['url']['shop_favorite']}" class='dropdown-item'><i class="icon wb-heart" aria-hidden="true"></i>{$_M['word']['app_shop_myfavorite']}</a>
            <a href="{$_M['url']['shop_discount']}" class='dropdown-item'><i class="icon wb-bookmark" aria-hidden="true"></i>{$_M['word']['app_shop_mydiscount']}</a>
<!--
EOT;
        }
echo <<<EOT
-->
            <a href="{$_M['url']['shop_member_base']}&nojump=1" target="_blank" class='dropdown-item'><i class="icon wb-settings" aria-hidden="true"></i>{$_M['word']['app_shop_settings']}</a>
            <div class="dropdown-divider"></div>
            <a href="{$_M['url']['shop_member_login_out']}" class='dropdown-item'><i class="icon wb-power"></i>{$_M['word']['app_shop_out']}</a>
<!--
EOT;
    }else{
echo <<<EOT
-->
            <a href="{$navurl}member/basic.php?lang={$lang}" title='{$_M['word']['memberIndex9']}' class='dropdown-item'><i class="icon wb-user" aria-hidden="true"></i> {$_M['word']['memberIndex9']}</a>
            <a href="{$navurl}member/basic.php?lang={$lang}&a=dosafety" title='{$_M['word']['accsafe']}' class='dropdown-item'><i class="icon wb-lock" aria-hidden="true"></i> {$_M['word']['accsafe']}</a>
<!--
EOT;
        foreach($_M['html']['app_sidebar'] as $key=>$val){
echo <<<EOT
-->
           <a href="{$val['url']}" class="dropdown-item" title="{$val['title']}"><i class="icon fa-money" aria-hidden="true"></i> {$val['title']}</a>
<!--
EOT;
        }
echo <<<EOT
-->
            <div class="dropdown-divider"></div>
            <a href="{$navurl}member/login.php?lang={$lang}&a=dologout" class='dropdown-item'><i class="icon wb-power"></i> {$_M['word']['memberIndex10']}</a>
<!--
EOT;
    }
echo <<<EOT
-->
        </ul>
    </li>
<!--
EOT;
}else{
echo <<<EOT
-->
    <li class=" text-xs-center vertical-align-middle animation-slide-top">
        <a href="{$navurl}member/login.php?lang={$lang}" class="btn btn-squared btn-primary btn-outline m-r-10">{$_M['word']['login']}</a>
        <a href="{$navurl}member/register_include.php?lang={$lang}" class="btn btn-squared btn-success">{$_M['word']['register']}</a>
    </li>
<!--
EOT;
}
if($_M['config']['shopv2_open'] && ($is_shopv3||$metinfo_member_name) && !isset($cartnum)){
echo <<<EOT
-->
    <li class="dropdown vertical-align-middle">
        <a href="javascript:void(0)" title="{$_M['word']['app_shop_cart']}" class='dropdown-item topcart-btn' data-toggle="dropdown">
            <i class="icon wb-shopping-cart" aria-hidden="true"></i>
            {$_M['word']['app_shop_cart']}
            <span class="tag tag-pill up tag-danger topcart-goodnum font-size-12" hidden></span>
        </a>
        <ul class="dropdown-menu dropdown-menu-right dropdown-menu-media animation-slide-bottom10">
            <li class="dropdown-menu-header">
                <h5>{$_M['word']['app_shop_cart']}</h5>
                <span class="tag tag-round tag-danger font-size-12">{$_M['word']['app_shop_intotal']} <span class="topcart-goodnum"></span> {$_M['word']['app_shop_piece']}{$_M['word']['app_shop_commodity']}</span>
            </li>
            <li class="list-group" role="presentation">
                <div data-role="container">
                    <div data-role="content" id="topcart-body"></div>
                </div>
            </li>
            <div class="dropdown-menu-footer cover p-y-10 p-x-20">
                <div><a href="{$_M['url']['shop_cart']}" class="btn btn-squared btn-danger pull-xs-right">{$_M['word']['app_shop_gosettlement']}</a></div>
                <span class="red-600 font-size-18 topcart-total"></span>
            </div>
        </ul>
    </li>
<!--
EOT;
}
echo <<<EOT
-->
</ul>
<!--
EOT;
?>