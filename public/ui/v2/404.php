<?php
$nofollow = 1;
$_M['config']['shopv2_open']=$met_member_register=0;
require_once template('module/meta');
echo <<<EOT
-->
<style>
.page-error header h1 {font-size: 10em;}
</style>
<body class="page-error page-error-404 layout-full">
<!-- Page -->
<div class="page vertical-align text-xs-center">
    <div class="page-content vertical-align-middle">
        <header>
            <h1 class="animation-slide-top font-weight-400">404</h1>
            <p class="m-b-30 blue-grey-500 font-size-30 font-weight-300">未找到页面 !</p>
        </header>
        <a class="btn btn-primary btn-round" href="{$index_url}">返回首页</a>
    </div>
</div>
<!-- End Page -->
<!--
EOT;
$resui='';
require_once template('module/footer');
?>