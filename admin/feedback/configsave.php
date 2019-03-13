<?php
# 文件名称:configsave.php 2009-08-12 10:15:03
# MetInfo企业网站管理系统 
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.
$met_c_fd_content    =str_replace("\"","'",$met_c_fd_content);
$met_c_fd_content    =str_replace(chr(13).chr(10),"",$met_c_fd_content);
$met_e_fd_content    =str_replace("\"","'",$met_e_fd_content);
$met_e_fd_content    =str_replace(chr(13).chr(10),"",$met_e_fd_content);
$met_o_fd_content    =str_replace("\"","'",$met_o_fd_content);
$met_o_fd_content    =str_replace(chr(13).chr(10),"",$met_o_fd_content);
$config_save       = "<?php
/*
met_fd_time       = \"$met_fd_time\";
met_fd_word       = \"$met_fd_word\";
met_fd_type       = \"$met_fd_type\";
met_fd_to         = \"$met_fd_to\";
met_fd_back       = \"$met_fd_back\";
met_fd_email      = \"$met_fd_email\";
met_c_fd_title    = \"$met_c_fd_title\";
met_e_fd_title    = \"$met_e_fd_title\";
met_o_fd_title    = \"$met_o_fd_title\";
met_c_fd_content  = \"$met_c_fd_content\";
met_e_fd_content  = \"$met_e_fd_content\";
met_o_fd_content  = \"$met_o_fd_content\";
met_c_fdtable     = \"$met_c_fdtable\";
met_e_fdtable     = \"$met_e_fdtable\";
met_o_fdtable     = \"$met_o_fdtable\";
met_fd_class      = \"$met_fd_class\";
*/
?>";
$fp = fopen("../../feedback/config.inc.php",w);
    fputs($fp, $config_save);
    fclose($fp);
# 本程序是一个开源系统,使用时请你仔细阅读使用协议,商业用途请自觉购买商业授权.
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.	
?>