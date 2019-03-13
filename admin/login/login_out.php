<?php
session_start();
		  $_SESSION['metinfo_admin_name'] ='';
          $_SESSION['metinfo_admin_pass'] ='';
		  $_SESSION['metinfo_admin_time'] ='';
		  $_SESSION['metinfo_admin_pop']  ='';
Header("Location: login.php");
exit;
?>
