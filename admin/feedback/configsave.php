<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 
require_once '../login/login_check.php';
$met_fd_content    =str_replace("\"","'",$met_fd_content);
$met_fd_content    =str_replace(chr(13).chr(10),"",$met_fd_content);
$config_save       = "<?php
/*
met_fd_time       = \"$met_fd_time\";
met_fd_word       = \"$met_fd_word\";
met_fd_type       = \"$met_fd_type\";
met_fd_to         = \"$met_fd_to\";
met_fd_back       = \"$met_fd_back\";
met_fd_email      = \"$met_fd_email\";
met_fd_title      = \"$met_fd_title\";
met_fd_content    = \"$met_fd_content\";
met_fdtable       = \"$met_fdtable\";
met_fd_class      = \"$met_fd_class\";
*/
?>";
if(!is_writable("../../".$foldename."/config_".$lang.".inc.php"))@chmod("../../".$foldename."/config_".$lang.".inc.php",0777);
$fp = fopen("../../".$foldename."/config_".$lang.".inc.php",w);
    fputs($fp, $config_save);
    fclose($fp);
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>