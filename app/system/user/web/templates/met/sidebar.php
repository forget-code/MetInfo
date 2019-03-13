<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.
defined('IN_MET') or exit('No permission');
if(!$_M['config']['own_active']) $_M['config']['own_active']=array($_M['config']['app_no'].'_'.$_M['config']['own_order']=>'active');
?>
<div class="col-lg-3">
    <div class='dropdown m-b-15 hidden-lg-up met-sidebar-nav-mobile'>
        <button type="button" class="btn btn-primary btn-block dropdown-toggle met-sidebar-nav-active-name" data-toggle="dropdown"></button>
        <div class="dropdown-menu animate animate-reverse w-full" role="menu">
            <a class="dropdown-item {$_M['config']['own_active']['0_1']}" href="{$_M['url']['profile']}" title="{$_M['word']['memberIndex9']}">{$_M['word']['memberIndex9']}</a>
            <a class="dropdown-item {$_M['config']['own_active']['0_2']}" href="{$_M['url']['profile_safety']}" title="{$_M['word']['accsafe']}">{$_M['word']['accsafe']}</a>
            <?php
            foreach($_M['html']['app_sidebar'] as $key=>$val){
                $val['active']=$_M['config']['own_active'][$val['no'].'_'.$val['own_order']];
                $val['target']=$val['target']?' target="_blank"':'';
            ?>
            <a class="dropdown-item {$val['active']}" href="{$val['url']}" title="{$val['title']}"{$val['target']}>{$val['title']}</a>
            <?php } ?>
        </div>
    </div>
	<div class="panel row m-r-0 m-b-0 hidden-md-down" boxmh-h>
        <div class="panel-body">
            <h2 class="m-l-30 font-size-18 font-weight-unset">{$_M['word']['memberIndex3']}</h2>
    		<ul class="list-group m-l-15 met-sidebar-nav">
    			<li class="list-group-item {$_M['config']['own_active']['0_1']}"><a href="{$_M['url']['profile']}" title="{$_M['word']['memberIndex9']}">{$_M['word']['memberIndex9']}</a></li>
    			<li class="list-group-item {$_M['config']['own_active']['0_2']}"><a href="{$_M['url']['profile_safety']}" title="{$_M['word']['accsafe']}">{$_M['word']['accsafe']}</a></li>
                <?php
                foreach($_M['html']['app_sidebar'] as $key=>$val){
                    $val['active']=$_M['config']['own_active'][$val['no'].'_'.$val['own_order']];
                    $val['target']=$val['target']?' target="_blank"':'';
                ?>
                <li class="list-group-item {$val['active']}"><a href="{$val['url']}" title="{$val['title']}"{$val['target']}>{$val['title']}</a></li>
                <?php } ?>
            </ul>
        </div>
	</div>
</div>