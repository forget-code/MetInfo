<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 
require_once '../login/login_check.php';

$met_wap_logo      =str_replace("\"","'",$met_wap_logo);
$met_wap_img       =str_replace("\"","'",$met_wap_img);
$wap_description   =str_replace("\"","'",$wap_description);
$wap_footertext    =str_replace("\"","'",$wap_footertext);
$wap_description   =str_replace(chr(13).chr(10),"",$wap_description);
$wap_footertext    =str_replace(chr(13).chr(10),"",$wap_footertext);

$config_save       = "<?php
/*
met_wap     	  = \"$met_wap\";
met_waplink       = \"$met_waplink\";
met_wap_ok     	  = \"$met_wap_ok\";
met_wap_tpa       = \"$met_wap_tpa\";
met_wap_tpb       = \"$met_wap_tpb\";
met_wap_url       = \"$met_wap_url\";
met_wap_logo      = \"$met_wap_logo\";
met_wap_img       = \"$met_wap_img\";
wap_skin_1        = \"$wap_skin_1\";
wap_skin_2        = \"$wap_skin_2\";
wap_skin_3        = \"$wap_skin_3\";
wap_news_list     = \"$wap_news_list\";
wap_product_list  = \"$wap_product_list\";
wap_download_list = \"$wap_download_list\";
wap_img_list      = \"$wap_img_list\";
wap_job_list      = \"$wap_job_list\";
wap_product_imgx  = \"$wap_product_imgx\";
wap_product_imgy  = \"$wap_product_imgy\";
wap_img_imgx      = \"$wap_img_imgx\";
wap_img_imgy      = \"$wap_img_imgy\";
wap_title         = \"$wap_title\";
wap_description   = \"$wap_description\";
wap_footertext    = \"$wap_footertext\";
*/
?>";
if(!is_writable("../../wap/config_".$lang.".inc.php"))@chmod("../../wap/config_".$lang.".inc.php",0777);
$fp = fopen("../../wap/config_".$lang.".inc.php",w);
      fputs($fp, $config_save);
      fclose($fp);
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>