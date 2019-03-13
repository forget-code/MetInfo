<?php
$config_save       = "<?php
/*
met_fd_time       = \"$met_fd_time\";
met_fd_word       = \"$met_fd_word\";
met_fd_email      = \"$met_fd_email\";
met_fd_no         = \"$met_fd_no\";
met_fd_type       = \"$met_fd_type\";
met_fd_to         = \"$met_fd_to\";
met_fd_back       = \"$met_fd_back\";
met_fd_title      = \"$met_fd_title\";
met_fd_content    = \"$met_fd_content\";
*/
?>";
$fp = fopen("../../message/config.inc.php",w);
    fputs($fp, $config_save);
    fclose($fp);
?>