<?php
defined('IN_MET') or exit('No permission');
?>
<met_meta />
<?php
if(file_exists(PATH_OWN_FILE."templates/met/css/metinfo.css")){
    $own_metinfo_css_filemtime = filemtime(PATH_OWN_FILE.'templates/met/css/metinfo.css');
?>
<link href="{$_M['url']['own_tem']}css/metinfo.css?{$own_metinfo_css_filemtime}" rel='stylesheet' type='text/css'>
<?php } ?>
<header>
    <nav class="navbar navbar-default met-nav">
        <div class="container">
            <div class="row">
                <div class="navbar-header pull-xs-left">
                    <a href="{$c.index_url}" class="met-logo vertical-align block pull-xs-left p-y-5" title="{$_M['config']['met_webname']}">
                        <h1 hidden>{$_M['config']['met_webname']}</h1>
                        <div class="vertical-align-middle"><img src="{$_M['config']['met_logo']}" alt="{$_M['config']['met_webname']}"></div>
                    </a>
                </div>
                <button type="button" class="navbar-toggler hamburger hamburger-close collapsed p-x-5 met-nav-toggler" data-target="#met-nav-collapse" data-toggle="collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="hamburger-bar"></span>
                </button>
                <?php if($_M['config']['met_member_register'] || $_M['config']['shopv2_open']){ ?>
                <button type="button" class="navbar-toggler collapsed m-0 p-x-5 met-head-user-toggler" data-target="#met-head-user-collapse" data-toggle="collapse">
                    <i class="icon wb-user-circle" aria-hidden="true"></i>
                    <i class="icon wb-user" aria-hidden="true"></i>
                </button>
                <?php
                }
                if($_M['config']['met_lang_mark']){
                ?>
                <lang></lang>
                <?php if($sub>1){ ?>
                <div class="met-langlist vertical-align pull-xs-right">
                    <div class="inline-block dropdown">
                        <button type="button" data-toggle="dropdown" class="btn btn-outline btn-default btn-squared dropdown-toggle btn-lang">
                            <lang>
                            <if value="$data['lang'] eq $v['mark']">
                                <img src="{$v.flag}" alt="{$v.name}" width="20">
                                <span class="hidden-xs-down">{$v.name}</span>
                            </if>
                            </lang>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-right animate animate-reverse" id="met-langlist-dropdown" role="menu">
                            <lang>
                            <a href="{$v.met_weburl}" title="{$v.name}" class='dropdown-item'>
                                <img src="{$v.flag}" alt="{$v.name}" width="20">
                                {$v['name']}
                            </a>
                            </lang>
                        </ul>
                    </div>
                </div>
                <?php
                    }
                }
                if($_M['config']['met_member_register'] || $_M['config']['shopv2_open']){
                ?>
                <div class="collapse navbar-collapse navbar-collapse-toolbar pull-md-right p-0" id='met-head-user-collapse'>
                    <ul class="navbar-nav vertical-align p-l-0 m-b-0 met-head-user">
                        <?php
                        if($_M['user']['username']){
                            $_M['config']['own_active']=array($_M['config']['app_no'].'_'.$_M['config']['own_order']=>'active');
                        ?>
                        <li class="dropdown vertical-align-middle met-head-user-column">
                            <a href="javascript:;" class="navbar-avatar dropdown-toggle dropdown-item" data-toggle="dropdown">
                                <span class="avatar m-r-5"><img src="{$_M['user']['head']}" alt="{$_M['user']['username']}" style='position:relative;top: -2px;'></span>
                                {$_M['user']['username']}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-right animate animate-reverse">
                                <a href="{$_M['url']['profile']}" title='{$_M['word']['memberIndex9']}' class='dropdown-item {$_M['config']['own_active']['0_1']}'><i class="icon wb-user" aria-hidden="true"></i> {$_M['word']['memberIndex9']}</a>
                                <a href="{$_M['url']['profile_safety']}" title='{$_M['word']['accsafe']}' class='dropdown-item {$_M['config']['own_active']['0_2']}'><i class="icon wb-lock" aria-hidden="true"></i> {$_M['word']['accsafe']}</a>
                                <div class="dropdown-divider"></div>
                                <?php
                                foreach($_M['html']['app_sidebar'] as $key=>$val){
                                    $val['active']=$_M['config']['own_active'][$val['no'].'_'.$val['own_order']];
                                    $val['target']=$val['target']?' target="_blank"':'';
                                ?>
                                <a href="{$val['url']}" class="dropdown-item {$val['active']}" title="{$val['title']}"{$val['target']}><i class="icon fa-paper-plane" aria-hidden="true"></i> {$val['title']}</a>
                                <?php } ?>
                                <div class="dropdown-divider"></div>
                                <a href="{$_M['url']['login_out']}" class='dropdown-item'><i class="icon wb-power"></i> {$_M['word']['memberIndex10']}</a>
                            </ul>
                        </li>
                        <?php }else{ ?>
                        <li class=" text-xs-center vertical-align-middle animation-slide-top">
                            <a href="{$_M['url']['login']}" class="btn btn-squared btn-primary btn-outline m-r-10">{$_M['word']['login']}</a>
                            <a href="{$_M['url']['register']}" class="btn btn-squared btn-success">{$_M['word']['register']}</a>
                        </li>
                        <?php
                        }
                        if($_M['config']['shopv2_open'] && !isset($data['cartnum'])){
                        ?>
                        <li class="dropdown vertical-align-middle">
                            <a href="javascript:void(0)" title="{$_M['word']['app_shop_cart']}" class='dropdown-item topcart-btn' data-toggle="dropdown">
                                <i class="icon wb-shopping-cart" aria-hidden="true"></i>
                                {$_M['word']['app_shop_cart']}
                                <span class="tag tag-pill up tag-danger topcart-goodnum font-size-12" hidden></span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-right animate animate-reverse dropdown-menu-media animation-slide-bottom10">
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
                        <?php } ?>
                    </ul>
                </div>
                <?php } ?>
                <div class="collapse navbar-collapse navbar-collapse-toolbar pull-md-right p-0" id='met-nav-collapse'>
                    <ul class="nav navbar-nav navlist">
                        <li class='nav-item'><a href="{$c.index_url}" title="{$word.home}" class="nav-link">{$word.home}</a></li>
                        <tag action='category' type='head' class='active'>
                        <?php
                        $navdropdown_ok=$m['sub'] && $m['module']!=6 && $m['module']!=7;// 6为招聘模块，7位留言模块，没必要展示下拉菜单
                        $dropdown_class=$dropdown_toggle=$data_toggle=$navdropdown_type='';
                        if($navdropdown_ok){
                            $dropdown_class=' dropdown';
                            $dropdown_toggle=' dropdown-toggle';
                            $data_toggle='data-toggle="dropdown"';
                            $navdropdown_type =' data-hover="dropdown"';
                        }
                        ?>
                        <li class="nav-item{$dropdown_class}">
                            <a
                                href="{$m['url']}"
                                title="{$m['name']}"
                                class="nav-link {$m['class']}{$dropdown_toggle}"
                                {$data_toggle}{$navdropdown_type}
                                {$m['new_windows']}
                            >{$m['name']}</a>
                            <if value="$navdropdown_ok">
                            <div class="dropdown-menu dropdown-menu-right animate animate-reverse">
                                <if value="$m['isshow']">
                                <a href="{$m['url']}" {$m['new_windows']} title="{$m['name']}" class='dropdown-item nav-parent hidden-lg-up {$m['class']}'>{$m['name']}</a>
                                </if>
                                <tag action='category' cid="$m['id']" type='son' class='active'>
                                <if value="$m['sub']">
                                <div class="dropdown-item dropdown-submenu">
                                    <a href="{$m['url']}" class="dropdown-item {$m['class']}" {$m['new_windows']}>{$m['name']}</a>
                                    <div class="dropdown-menu animate animate-reverse">
                                        <tag action='category' cid="$m['id']" type='son' class='active'>
                                        <a href="{$m['url']}" class="dropdown-item {$m['class']}" {$m['new_windows']}>{$m['name']}</a>
                                        </tag>
                                    </div>
                                </div>
                                <else/>
                                <a href="{$m['url']}" class="dropdown-item {$m['class']}" {$m['new_windows']} title="{$m['name']}">{$m['name']}</a>
                                </if>
                                </tag>
                            </div>
                            </if>
                        </li>
                        </tag>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</header>