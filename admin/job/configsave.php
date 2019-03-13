<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 
require_once '../login/login_check.php';
$config_save       = "<?php
/*
met_cv_time       = \"$met_cv_time\";
met_cv_word       = \"$met_cv_word\";
met_cv_type       = \"$met_cv_type\";
met_cv_image       = \"$met_cv_image\";
met_cv_emtype     = \"$met_cv_emtype\";
met_cv_to         = \"$met_cv_to\";
*/
?>";
if(!is_writable("../../job/config_".$lang.".inc.php"))@chmod("../../job/config_".$lang.".inc.php",0777);
$fp = fopen("../../job/config_".$lang.".inc.php",w);
    fputs($fp, $config_save);
    fclose($fp);
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>