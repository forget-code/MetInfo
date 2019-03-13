<?php
require_once '../include/common.inc.php';
if(file_exists('install.lock')){
	exit('对不起，该程序已经升级安装过了。<br/>
	      如您要重新升级，请手动删除install.lock文件。');
}
if($action==""){
require('templates/index.htm');
}
else{

$query ="ALTER TABLE $met_column ADD `index_num` int(11) default '0' ";
$db->query($query);

$query ="CREATE TABLE $met_otherinfo (
  `id` int(11) NOT NULL auto_increment,
  `c_info1` varchar(255) default NULL,
  `c_info2` varchar(255) default NULL,
  `c_info3` varchar(255) default NULL,
  `c_info4` varchar(255) default NULL,
  `c_info5` varchar(255) default NULL,
  `c_info6` varchar(255) default NULL,
  `c_info7` varchar(255) default NULL,
  `c_info8` text,
  `c_info9` text,
  `c_info10` text,
  `c_imgurl1` varchar(255) default NULL,
  `c_imgurl2` varchar(255) default NULL,
  `e_info1` varchar(255) default NULL,
  `e_info2` varchar(255) default NULL,
  `e_info3` varchar(255) default NULL,
  `e_info4` varchar(255) default NULL,
  `e_info5` varchar(255) default NULL,
  `e_info6` varchar(255) default NULL,
  `e_info7` varchar(255) default NULL,
  `e_info8` text,
  `e_info9` text,
  `e_info10` text,
  `e_imgurl1` varchar(255) default NULL,
  `e_imgurl2` varchar(255) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8";
$db->query($query);

$query ="INSERT INTO $met_otherinfo VALUES (1,'','','','','','','','','','','','','','','','','','','','','','','','')";
$db->query($query);

			$fp  = fopen('install.lock', 'w');
			fwrite($fp,$config);
			fclose($fp);
			@chmod('install.lock',0554);
require('templates/finished.htm');
}

footer();
?>