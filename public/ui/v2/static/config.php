<?php
global $met_skin,$met_skin_url;
// 模板url
$met_skin=$met_skin_user;
$met_skin_url="templates/{$met_skin}/";

require_once template('static/library');// UI资源配置
require_once template('static/uipaths');// 模板UI配置
?>