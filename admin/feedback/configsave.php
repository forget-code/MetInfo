<?php
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
met_c_fdtable     = \"$met_c_fdtable\";
met_e_fdtable     = \"$met_e_fdtable\";
met_fd_class      = \"$met_fd_class\";
*/
?>";
$fp = fopen("../../feedback/config.inc.php",w);
    fputs($fp, $config_save);
    fclose($fp);
?>