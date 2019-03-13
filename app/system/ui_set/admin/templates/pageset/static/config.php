<?php
global $met_skin,$met_skin_url;
// 模板url
$met_skin='pageset';
$met_skin_url='app/system/ui_set/admin/templates/'.$met_skin.'/';
require_once PATH_WEB.'public/ui/v2/static/library.php';// UI资源配置

// 模板UI
$resui=array(
    $metui[paths][basic],
    $metui[paths][web_icons],
    $metui[paths][font_awesome],
    $metui[paths][glyphicons],
    $metui[paths][x_editable],
    // 模板自定义UI
    "{$metui[url][static2_fonts]}metinfo-icon/metinfo-icon.css",
    "{$metui[url][tem_css]}pageset.css",
    "{$metui[url][tem_js]}pageset.js"
);
// UI打包
$metuipack->cache=false; // 缓存开关
$resui=$metuipack->getUi($resui,'pageset');// 模板公共UI、当前页面UI打包生成文件，返回文件url数组
$metuipack->setUiVersion();// 模板版本信息更新
?>