DROP TABLE IF EXISTS `met_admin_table`;
CREATE TABLE `met_admin_table` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `admin_type` text NOT NULL,
  `admin_id` char(15) NOT NULL,
  `admin_pass` char(64) default NULL,
  `admin_name` varchar(30) NOT NULL,
  `admin_sex` tinyint(1) NOT NULL default '1',
  `admin_tel` varchar(20) default NULL,
  `admin_mobile` varchar(20) default NULL,
  `admin_email` varchar(150) default NULL,
  `admin_qq` varchar(12) NOT NULL,
  `admin_msn` varchar(40) NOT NULL,
  `admin_taobao` varchar(40) NOT NULL,
  `admin_introduction` text,
  `admin_login` int(11) unsigned NOT NULL default '0',
  `admin_modify_ip` varchar(20) default NULL,
  `admin_modify_date` datetime default NULL,
  `admin_register_date` datetime default NULL,
  `admin_approval_date` datetime default NULL,
  `admin_ok` int(11) NOT NULL default '0',
  `admin_op` varchar(20) default 'metinfo',
  `admin_issueok` int(11) NOT NULL default '0',
  `companyname` varchar(255) default NULL,
  `companyaddress` varchar(255) default NULL,
  `companyfax` varchar(255) default NULL,
  `usertype` varchar(20) default 'all',
  `checkid` int(1) default '0',
  `companycode` varchar(50) default NULL,
  `companywebsite` varchar(50) default NULL,
  PRIMARY KEY  (`id`),
  KEY `admin_id` (`admin_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `met_column`;
CREATE TABLE `met_column` (
  `id` int(11) NOT NULL auto_increment,
  `c_name` varchar(100) default NULL,
  `e_name` varchar(100) default NULL,
  `foldername` varchar(50) default NULL,
  `filename` varchar(50) default NULL,
  `bigclass` int(11) default '0',
  `module` int(11) default NULL,
  `no_order` int(11) default NULL,
  `if_in` char(1) NOT NULL default '1',
  `nav` char(1) default '0',
  `c_keywords` varchar(200) default NULL,
  `e_keywords` varchar(200) default NULL,
  `c_content` text,
  `e_content` text,
  `c_description` text,
  `e_description` text,
  `c_out_url` varchar(200) default NULL,
  `list_order` int(11) default '0',
  `new_windows` varchar(50) default NULL,
  `classtype` int(11) default '1',
  `e_out_url` varchar(200) default NULL,
  `index_num` int(11) default '0',
  `o_name` varchar(100) default NULL,
  `o_keywords` varchar(200) default NULL,
  `o_content` text,
  `o_description` text,
  `o_out_url` varchar(200) default NULL,
  `access` varchar(20) default 'all',
  `indeximg` varchar(255) default NULL,
  `columnimg` varchar(255) default NULL,
  `isshow` int(11) default '1',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `met_cv`;
CREATE TABLE `met_cv` (
  `id` int(11) NOT NULL auto_increment,
  `addtime` datetime default NULL,
  `readok` int(11) default '0',
  `para1` varchar(200) default NULL,
  `para2` varchar(200) default NULL,
  `para3` varchar(200) default NULL,
  `para4` varchar(200) default NULL,
  `para5` varchar(200) default NULL,
  `para6` varchar(200) default NULL,
  `para7` varchar(200) default NULL,
  `para8` varchar(200) default NULL,
  `para9` varchar(200) default NULL,
  `para10` varchar(200) default NULL,
  `para11` varchar(200) default NULL,
  `para12` varchar(200) default NULL,
  `para13` varchar(200) default NULL,
  `para14` varchar(200) default NULL,
  `para15` varchar(200) default NULL,
  `para16` varchar(200) default NULL,
  `para17` varchar(200) default NULL,
  `para18` varchar(200) default NULL,
  `para19` varchar(200) default NULL,
  `para20` varchar(255) default NULL,
  `para21` text,
  `para22` text,
  `para23` text,
  `para24` text,
  `para25` text,
  `para26` text,
  `para27` text,
  `para28` text,
  `para29` text,
  `para30` text,
  `customerid` varchar(30) default '0',
  `jobid` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `met_download`;
CREATE TABLE `met_download` (
  `id` int(11) NOT NULL auto_increment,
  `c_title` varchar(200) default NULL,
  `e_title` varchar(200) default NULL,
  `c_keywords` varchar(200) default NULL,
  `e_keywords` varchar(200) default NULL,
  `c_description` text,
  `e_description` text,
  `c_content` longtext,
  `e_content` longtext,
  `class1` int(11) default '0',
  `class2` int(11) default '0',
  `class3` int(11) default '0',
  `new_ok` int(1) default '0',
  `downloadurl` varchar(255) default NULL,
  `filesize` varchar(100) default NULL,
  `com_ok` int(1) default '0',
  `hits` int(11) default '0',
  `updatetime` datetime default NULL,
  `addtime` datetime default NULL,
  `c_para1` varchar(200) default NULL,
  `c_para2` varchar(200) default NULL,
  `c_para3` varchar(200) default NULL,
  `c_para4` varchar(200) default NULL,
  `c_para5` varchar(200) default NULL,
  `c_para6` varchar(200) default NULL,
  `c_para7` varchar(200) default NULL,
  `c_para8` varchar(200) default NULL,
  `c_para9` text,
  `c_para10` text,
  `e_para1` varchar(200) default NULL,
  `e_para2` varchar(200) default NULL,
  `e_para3` varchar(200) default NULL,
  `e_para4` varchar(200) default NULL,
  `e_para5` varchar(200) default NULL,
  `e_para6` varchar(200) default NULL,
  `e_para7` varchar(200) default NULL,
  `e_para8` varchar(200) default NULL,
  `e_para9` text,
  `e_para10` text,
  `issue` varchar(100) default '',
  `o_title` varchar(200) default NULL,
  `o_keywords` varchar(200) default NULL,
  `o_description` text,
  `o_content` longtext,
  `o_para1` varchar(200) default NULL,
  `o_para2` varchar(200) default NULL,
  `o_para3` varchar(200) default NULL,
  `o_para4` varchar(200) default NULL,
  `o_para5` varchar(200) default NULL,
  `o_para6` varchar(200) default NULL,
  `o_para7` varchar(200) default NULL,
  `o_para8` varchar(200) default NULL,
  `o_para9` text,
  `o_para10` text,
  `access` varchar(20) default 'all',
  `top_ok` int(1) default '0',
  `downloadaccess` int(1) default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `met_fdlist`;
CREATE TABLE `met_fdlist` (
  `id` int(11) NOT NULL auto_increment,
  `bigid` int(11) default NULL,
  `c_list` varchar(255) default NULL,
  `e_list` varchar(255) default NULL,
  `no_order` int(11) default NULL,
  `o_list` varchar(255) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `met_fdparameter`;
CREATE TABLE `met_fdparameter` (
  `id` int(11) NOT NULL auto_increment,
  `c_name` varchar(255) default NULL,
  `e_name` varchar(255) default NULL,
  `no_order` int(11) default NULL,
  `use_ok` int(11) default '0',
  `wr_ok` int(11) default '0',
  `type` int(11) default NULL,
  `o_name` varchar(255) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `met_feedback`;
CREATE TABLE `met_feedback` (
  `id` int(11) NOT NULL auto_increment,
  `para1` varchar(255) default NULL,
  `para2` varchar(255) default NULL,
  `para3` varchar(255) default NULL,
  `para4` varchar(255) default NULL,
  `para5` varchar(255) default NULL,
  `para6` varchar(255) default NULL,
  `para7` varchar(255) default NULL,
  `para8` varchar(255) default NULL,
  `para9` varchar(255) default NULL,
  `para10` varchar(255) default NULL,
  `para11` varchar(255) default NULL,
  `para12` varchar(255) default NULL,
  `para13` varchar(255) default NULL,
  `para14` varchar(255) default NULL,
  `para15` varchar(255) default NULL,
  `para16` text,
  `para17` text,
  `para18` text,
  `para19` text,
  `para20` text,
  `fdtitle` varchar(255) default NULL,
  `fromurl` varchar(255) default NULL,
  `ip` varchar(255) default NULL,
  `addtime` datetime default NULL,
  `readok` int(11) default '0',
  `useinfo` text,
  `en` varchar(20) default NULL,
  `para21` text,
  `para22` text,
  `para23` text,
  `para24` text,
  `para25` varchar(255) default NULL,
  `para26` varchar(255) default NULL,
  `para27` varchar(255) default NULL,
  `customerid` varchar(30) default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `met_flash`;
CREATE TABLE `met_flash` (
  `id` int(11) NOT NULL auto_increment,
  `module` int(11) default '0',
  `c_img_title` varchar(255) default NULL,
  `c_img_path` varchar(255) default NULL,
  `c_img_link` varchar(255) default NULL,
  `e_img_title` varchar(255) default NULL,
  `e_img_path` varchar(255) default NULL,
  `e_img_link` varchar(255) default NULL,
  `o_img_title` varchar(255) default NULL,
  `o_img_path` varchar(255) default NULL,
  `o_img_link` varchar(255) default NULL,
  `c_flash_path` varchar(255) default NULL,
  `c_flash_back` varchar(255) default NULL,
  `e_flash_path` varchar(255) default NULL,
  `e_flash_back` varchar(255) default NULL,
  `o_flash_path` varchar(255) default NULL,
  `o_flash_back` varchar(255) default NULL,
  `no_order` int(11) default NULL,
  `width` int(11) default NULL,
  `height` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `met_img`;
CREATE TABLE `met_img` (
  `id` int(11) NOT NULL auto_increment,
  `c_title` varchar(200) default NULL,
  `e_title` varchar(200) default NULL,
  `c_keywords` varchar(200) default NULL,
  `e_keywords` varchar(200) default NULL,
  `c_description` text,
  `e_description` text,
  `c_content` longtext,
  `e_content` longtext,
  `class1` int(11) default '0',
  `class2` int(11) default '0',
  `class3` int(11) default '0',
  `new_ok` int(1) default '0',
  `imgurl` varchar(255) default NULL,
  `imgurls` varchar(255) default NULL,
  `com_ok` int(1) default '0',
  `hits` int(11) default '0',
  `updatetime` datetime default NULL,
  `addtime` datetime default NULL,
  `c_para1` varchar(200) default NULL,
  `c_para2` varchar(200) default NULL,
  `c_para3` varchar(200) default NULL,
  `c_para4` varchar(200) default NULL,
  `c_para5` varchar(200) default NULL,
  `c_para6` varchar(200) default NULL,
  `c_para7` varchar(200) default NULL,
  `c_para8` varchar(200) default NULL,
  `c_para9` text,
  `c_para10` text,
  `e_para1` varchar(200) default NULL,
  `e_para2` varchar(200) default NULL,
  `e_para3` varchar(200) default NULL,
  `e_para4` varchar(200) default NULL,
  `e_para5` varchar(200) default NULL,
  `e_para6` varchar(200) default NULL,
  `e_para7` varchar(200) default NULL,
  `e_para8` varchar(200) default NULL,
  `e_para9` text,
  `e_para10` text,
  `issue` varchar(100) default '',
  `o_title` varchar(200) default NULL,
  `o_keywords` varchar(200) default NULL,
  `o_description` text,
  `o_content` longtext,
  `o_para1` varchar(200) default NULL,
  `o_para2` varchar(200) default NULL,
  `o_para3` varchar(200) default NULL,
  `o_para4` varchar(200) default NULL,
  `o_para5` varchar(200) default NULL,
  `o_para6` varchar(200) default NULL,
  `o_para7` varchar(200) default NULL,
  `o_para8` varchar(200) default NULL,
  `o_para9` text,
  `o_para10` text,
  `access` varchar(20) default 'all',
  `c_para11` varchar(255) default NULL,
  `c_para12` varchar(255) default NULL,
  `c_para13` varchar(255) default NULL,
  `c_para14` varchar(255) default NULL,
  `c_para15` varchar(255) default NULL,
  `c_para16` varchar(255) default NULL,
  `c_para17` varchar(255) default NULL,
  `c_para18` varchar(255) default NULL,
  `c_para19` varchar(255) default NULL,
  `c_para20` varchar(255) default NULL,
  `e_para11` varchar(255) default NULL,
  `e_para12` varchar(255) default NULL,
  `e_para13` varchar(255) default NULL,
  `e_para14` varchar(255) default NULL,
  `e_para15` varchar(255) default NULL,
  `e_para16` varchar(255) default NULL,
  `e_para17` varchar(255) default NULL,
  `e_para18` varchar(255) default NULL,
  `e_para19` varchar(255) default NULL,
  `e_para20` varchar(255) default NULL,
  `o_para11` varchar(255) default NULL,
  `o_para12` varchar(255) default NULL,
  `o_para13` varchar(255) default NULL,
  `o_para14` varchar(255) default NULL,
  `o_para15` varchar(255) default NULL,
  `o_para16` varchar(255) default NULL,
  `o_para17` varchar(255) default NULL,
  `o_para18` varchar(255) default NULL,
  `o_para19` varchar(255) default NULL,
  `o_para20` varchar(255) default NULL,
  `top_ok` int(1) default '0',
  `c_para21` varchar(200) default NULL,
  `c_para22` varchar(200) default NULL,
  `c_para23` varchar(200) default NULL,
  `c_para24` varchar(200) default NULL,
  `e_para21` varchar(200) default NULL,
  `e_para22` varchar(200) default NULL,
  `e_para23` varchar(200) default NULL,
  `e_para24` varchar(200) default NULL,
  `o_para21` varchar(200) default NULL,
  `o_para22` varchar(200) default NULL,
  `o_para23` varchar(200) default NULL,
  `o_para24` varchar(200) default NULL,  
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `met_index`;
CREATE TABLE `met_index` (
  `id` int(11) NOT NULL auto_increment,
  `c_content` text,
  `e_content` text,
  `online_type` int(11) default NULL,
  `news_no` int(11) default NULL,
  `product_no` int(11) default NULL,
  `img_no` int(11) default NULL,
  `download_no` int(11) default NULL,
  `job_no` int(11) default NULL,
  `link_ok` int(11) default NULL,
  `link_img` int(11) default NULL,
  `link_text` int(11) default NULL,
  `o_content` text,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `met_job`;
CREATE TABLE `met_job` (
  `id` int(11) NOT NULL auto_increment,
  `c_position` varchar(200) default NULL,
  `e_position` varchar(200) default NULL,
  `count` int(11) default '0',
  `c_place` varchar(200) default NULL,
  `e_place` varchar(200) default NULL,
  `c_deal` varchar(200) default NULL,
  `e_deal` varchar(200) default NULL,
  `addtime` date default NULL,
  `useful_life` int(11) default NULL,
  `c_content` longtext,
  `e_content` longtext,
  `o_position` varchar(200) default NULL,
  `o_place` varchar(200) default NULL,
  `o_deal` varchar(200) default NULL,
  `o_content` longtext,
  `access` varchar(20) default 'all',
  `top_ok` int(1) default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `met_label`;
CREATE TABLE `met_label` (
  `id` int(11) NOT NULL auto_increment,
  `oldwords` varchar(255) default NULL,
  `newwords` varchar(255) default NULL,
  `url` varchar(255) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `met_link`;
CREATE TABLE `met_link` (
  `id` int(11) NOT NULL auto_increment,
  `c_webname` varchar(255) default NULL,
  `e_webname` varchar(255) default NULL,
  `weburl` varchar(255) default NULL,
  `weblogo` varchar(255) default NULL,
  `link_type` int(11) default '0',
  `c_info` varchar(255) default NULL,
  `e_info` varchar(255) default NULL,
  `contact` varchar(255) default NULL,
  `orderno` int(11) default '0',
  `com_ok` int(11) default '0',
  `show_ok` int(11) default '0',
  `addtime` datetime default NULL,
  `link_lang` varchar(255) default NULL,
  `o_webname` varchar(255) default NULL,
  `o_info` varchar(255) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `met_message`;
CREATE TABLE `met_message` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) default NULL,
  `tel` varchar(255) default NULL,
  `email` varchar(255) default NULL,
  `contact` varchar(255) default NULL,
  `info` text,
  `ip` varchar(255) default NULL,
  `addtime` datetime default NULL,
  `readok` int(11) default '0',
  `useinfo` varchar(255) default NULL,
  `en` varchar(255) default NULL,
  `access` varchar(20) default 'all',
  `customerid` varchar(30) default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `met_news`;
CREATE TABLE `met_news` (
  `id` int(11) NOT NULL auto_increment,
  `c_title` varchar(200) default NULL,
  `e_title` varchar(200) default NULL,
  `c_keywords` varchar(200) default NULL,
  `e_keywords` varchar(200) default NULL,
  `c_description` text,
  `e_description` text,
  `c_content` longtext,
  `e_content` longtext,
  `class1` int(11) default '0',
  `class2` int(11) default '0',
  `class3` int(11) default '0',
  `img_ok` int(1) default '0',
  `imgurl` varchar(255) default NULL,
  `imgurls` varchar(255) default NULL,
  `com_ok` int(1) default '0',
  `issue` varchar(100) default NULL,
  `hits` int(11) default '0',
  `updatetime` datetime default NULL,
  `addtime` datetime default NULL,
  `o_title` varchar(200) default NULL,
  `o_keywords` varchar(200) default NULL,
  `o_description` text,
  `o_content` longtext,
  `access` varchar(20) default 'all',
  `top_ok` int(1) default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `met_online`;
CREATE TABLE `met_online` (
  `id` int(11) NOT NULL auto_increment,
  `c_name` varchar(200) default NULL,
  `e_name` varchar(200) default NULL,
  `no_order` int(11) default NULL,
  `qq` varchar(100) default NULL,
  `msn` varchar(100) default NULL,
  `taobao` varchar(100) default NULL,
  `alibaba` varchar(100) default NULL,
  `skype` varchar(100) default NULL,
  `o_name` varchar(200) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `met_otherinfo`;
CREATE TABLE `met_otherinfo` (
  `id` int(11) NOT NULL auto_increment,
  `c_info1` varchar(255) default NULL,
  `c_info2` varchar(255) default NULL,
  `c_info3` varchar(255) default NULL,
  `c_info4` varchar(255) default NULL,
  `c_info5` varchar(255) default NULL,
  `c_info6` varchar(255) default NULL,
  `c_info7` varchar(255) default NULL,
  `c_imgurl1` varchar(255) default NULL,
  `c_imgurl2` varchar(255) default NULL,
  `c_info8` text,
  `c_info9` text,
  `c_info10` text,
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
  `rightmd5` varchar(255) default NULL,
  `righttext` varchar(255) default NULL,
  `authcode` text,
  `authpass` varchar(255) default NULL,
  `authtext` varchar(255) default NULL,
  `o_info1` varchar(255) default NULL,
  `o_info2` varchar(255) default NULL,
  `o_info3` varchar(255) default NULL,
  `o_info4` varchar(255) default NULL,
  `o_info5` varchar(255) default NULL,
  `o_info6` varchar(255) default NULL,
  `o_info7` varchar(255) default NULL,
  `o_info8` varchar(255) default NULL,
  `o_info9` varchar(255) default NULL,
  `o_info10` varchar(255) default NULL,
  `o_imgurl1` varchar(255) default NULL,
  `o_imgurl2` varchar(255) default NULL,
  `data` longtext,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `met_parameter`;
CREATE TABLE `met_parameter` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(100) default NULL,
  `c_mark` varchar(200) default NULL,
  `e_mark` varchar(200) default NULL,
  `use_ok` int(1) default '0',
  `no_order` int(11) default NULL,
  `type` int(11) default '0',
  `maxsize` varchar(200) NOT NULL default '200',
  `o_mark` varchar(100) default NULL,
  `access` varchar(20) default 'all',
  `wr_ok` int(11) default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `met_product`;
CREATE TABLE `met_product` (
  `id` int(11) NOT NULL auto_increment,
  `c_title` varchar(200) default NULL,
  `e_title` varchar(200) default NULL,
  `c_keywords` varchar(200) default NULL,
  `e_keywords` varchar(200) default NULL,
  `c_description` text,
  `e_description` text,
  `c_content` longtext,
  `e_content` longtext,
  `class1` int(11) default '0',
  `class2` int(11) default '0',
  `class3` int(11) default '0',
  `new_ok` int(1) default '0',
  `imgurl` varchar(255) default NULL,
  `imgurls` varchar(255) default NULL,
  `com_ok` int(1) default '0',
  `hits` int(11) default '0',
  `updatetime` datetime default NULL,
  `addtime` datetime default NULL,
  `c_para1` varchar(200) default NULL,
  `c_para2` varchar(200) default NULL,
  `c_para3` varchar(200) default NULL,
  `c_para4` varchar(200) default NULL,
  `c_para5` varchar(200) default NULL,
  `c_para6` varchar(200) default NULL,
  `c_para7` varchar(200) default NULL,
  `c_para8` varchar(200) default NULL,
  `c_para9` text,
  `c_para10` text,
  `e_para1` varchar(200) default NULL,
  `e_para2` varchar(200) default NULL,
  `e_para3` varchar(200) default NULL,
  `e_para4` varchar(200) default NULL,
  `e_para5` varchar(200) default NULL,
  `e_para6` varchar(200) default NULL,
  `e_para7` varchar(200) default NULL,
  `e_para8` varchar(200) default NULL,
  `e_para9` text,
  `e_para10` text,
  `issue` varchar(100) default '',
  `o_title` varchar(200) default NULL,
  `o_keywords` varchar(200) default NULL,
  `o_description` text,
  `o_content` longtext,
  `o_para1` varchar(200) default NULL,
  `o_para2` varchar(200) default NULL,
  `o_para3` varchar(200) default NULL,
  `o_para4` varchar(200) default NULL,
  `o_para5` varchar(200) default NULL,
  `o_para6` varchar(200) default NULL,
  `o_para7` varchar(200) default NULL,
  `o_para8` varchar(200) default NULL,
  `o_para9` text,
  `o_para10` text,
  `access` varchar(20) default 'all',
  `c_para11` varchar(255) default NULL,
  `c_para12` varchar(255) default NULL,
  `c_para13` varchar(255) default NULL,
  `c_para14` varchar(255) default NULL,
  `c_para15` varchar(255) default NULL,
  `c_para16` varchar(255) default NULL,
  `e_para11` varchar(255) default NULL,
  `e_para12` varchar(255) default NULL,
  `e_para13` varchar(255) default NULL,
  `e_para14` varchar(255) default NULL,
  `e_para15` varchar(255) default NULL,
  `e_para16` varchar(255) default NULL,
  `o_para11` varchar(255) default NULL,
  `o_para12` varchar(255) default NULL,
  `o_para13` varchar(255) default NULL,
  `o_para14` varchar(255) default NULL,
  `o_para15` varchar(255) default NULL,
  `o_para16` varchar(255) default NULL,
  `top_ok` int(1) default '0',
  `c_para17` varchar(255) default NULL,
  `c_para18` varchar(255) default NULL,
  `c_para19` varchar(255) default NULL,
  `c_para20` varchar(255) default NULL,
  `e_para17` varchar(255) default NULL,
  `e_para18` varchar(255) default NULL,
  `e_para19` varchar(255) default NULL,
  `e_para20` varchar(255) default NULL,
  `o_para17` varchar(255) default NULL,
  `o_para18` varchar(255) default NULL,
  `o_para19` varchar(255) default NULL,
  `o_para20` varchar(255) default NULL,
  `c_para21` varchar(200) default NULL,
  `c_para22` varchar(200) default NULL,
  `c_para23` varchar(200) default NULL,
  `c_para24` varchar(200) default NULL,
  `e_para21` varchar(200) default NULL,
  `e_para22` varchar(200) default NULL,
  `e_para23` varchar(200) default NULL,
  `e_para24` varchar(200) default NULL,
  `o_para21` varchar(200) default NULL,
  `o_para22` varchar(200) default NULL,
  `o_para23` varchar(200) default NULL,
  `o_para24` varchar(200) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `met_skin_table`;
CREATE TABLE `met_skin_table` (
  `id` int(11) NOT NULL auto_increment,
  `skin_name` varchar(200) default NULL,
  `skin_file` varchar(20) default NULL,
  `skin_info` text,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `met_column` VALUES (1,'关于我们','About','about','about',0,1,1,'0','1','关于我们','about us','<p><img height=\"150\" hspace=\"3\" width=\"150\" align=\"left\" vspace=\"3\" alt=\"\" src=\"../upload/logoimg.gif\" />米拓信息（MetInfo.cn）专注于网络信息化及网络营销领域，通过整合团队专业的市场营销理念与网络技术为客户提供优质的网络营销服务。</p>\r\n<p>米拓信息的主要业务包括：网站系统开发、网站建设、网站推广、空间域名以及网络营销策划与运行。<br />\r\n&nbsp;<br />\r\n米拓信息主打产品&mdash;&mdash;MetInfo企业网站管理系统采用PHP+Mysql架构，全站内置了SEO搜索引擎优化机制，支持用户自定义界面语言，拥有企业网站常用的模块功能（企业简介模块、新闻模块、产品模块、下载模块、图片模块、招聘模块、在线留言、反馈系统、在线交流、友情链接、会员与权限管理）。强大灵活的后台管理功能、静态页面生成功能、个性化模块添加功能、不同栏目自定义FLASH样式功能等可为企业打造出大气漂亮且具有营销力的精品网站。</p>\r\n<p>米拓信息秉承&ldquo;为合作伙伴创造价值&rdquo;的核心价值观，并以&ldquo;诚实、宽容、创新、服务&rdquo;为企业精神，通过自主创新和真诚合作为电子商务及信息服务行业创造价值。</p>\r\n<p><strong>关于&ldquo;为合作伙伴创造价值&rdquo;</strong><br />\r\n米拓信息认为客户、供应商、公司股东、公司员工等一切和自身有合作关系的单位和个人都是自己的合作伙伴，并只有通过努力为合作伙伴创造价值，才能体现自身的价值并获得发展和成功。</p>\r\n<p><strong>关于&ldquo;诚实、宽容、创新、服务&rdquo;</strong><br />\r\n米拓信息认为诚信是一切合作的基础，宽容是解决问题的前提，创新是发展事业的利器，服务是创造价值的根本。</p>','<p class=\"style2 style6\"><img height=\"150\" alt=\"\" hspace=\"3\" width=\"150\" align=\"left\" vspace=\"3\" src=\"../upload/logoimg.gif\" /><span style=\"font-size: 10.5pt\"><span style=\"font-size: 10.5pt; font-family: \'宋体\'; mso-spacerun: \'yes\'\"><font face=\"Arial\">MetInfo (MetInfo.cn) focused on network information and network marketing, through the integration team of professional marketing ideas and networking technologies to provide customers with high-quality Internet marketing services. </font></span></p>\r\n<p><span style=\"font-size: 10.5pt\"><span style=\"font-size: 10.5pt; font-family: \'宋体\'; mso-spacerun: \'yes\'\"><font face=\"Arial\">MetInfo services include: Web system development, website building, website promotion, space domain names, and network marketing, planning and operation. </font></span></p>\r\n<p><span style=\"font-size: 10.5pt\"><span style=\"font-size: 10.5pt; font-family: \'宋体\'; mso-spacerun: \'yes\'\"><font face=\"Arial\">MetInfo main product - MetInfo enterprise website management system using PHP + Mysql structure, the whole point of SEO search engine optimization built-in mechanisms,support user-defined interface language, has a corporate Web site commonly used module functions (Company Profile module, news module ,&nbsp; product module, download&nbsp; module, image module, job module, messager systems, feedback systems, on-line communication, friend links, membership and authority management). Powerful and flexible back-end management capabilities, static page generation capabilities, personalization modules to add functionality, custom columns in different styles FLASH functions for enterprise to create a beautiful atmosphere, and has a sales force of fine websites.</font></span></p>\r\n<p class=\"style2 style6\"><strong>About &ldquo;Create Value for Partners&rdquo; </strong></p>\r\n<p class=\"style7\">MatISS thinks that all organization and persons which have cooperative relation with us are our partners, which include clients, suppliers, shareholders, employee and so on. Only doing our best to creating value for partners, MatISS will embody our value, develop and be successful.</p>\r\n<p class=\"style7\"><strong>About &ldquo;Honesty, Allowance, Innovation, Service&rdquo; </strong></p>\r\n<p class=\"style7\">Honesty is the base of all cooperation. Allowance is the prerequisite of solving problem, Innovation is the edge tool of development causes. Service is the basic of creating value.</p>','米拓信息的主要业务包括：网站系统开发、网站建设、网站推广、空间域名以及网络营销策划与运行。','MetInfo (MetInfo.cn) focused on network information and network marketing, through the integration team of professional marketing ideas and networking technologies to provide customers with high-quality Internet marketing services. ','',0,'',1,'',0,'','','<p class=\"p16\" style=\"margin-top: 0pt; margin-bottom: 0pt\"><span style=\"font-size: 10.5pt; font-family: \'宋体\'\"><img height=\"150\" alt=\"\" hspace=\"3\" width=\"150\" align=\"left\" vspace=\"3\" src=\"../upload/logoimg.gif\" />米拓信息（MetInfo.cn</span><span style=\"font-size: 10.5pt; font-family: \'宋体\'\">）</span><span style=\"font-size: 10.5pt; font-family: \'宋体\'\">专注于</span><span style=\"font-size: 10.5pt; font-family: \'宋体\'\">网络信息化及</span><span style=\"font-size: 10.5pt; font-family: \'宋体\'\">网络营销领域，通过整合团队专业的市场营销理念与网络技术为客户提供优质的网络营销服务。</span></p>\r\n<p class=\"p16\" style=\"margin-top: 0pt; margin-bottom: 0pt\">&nbsp;</p>\r\n<p class=\"p16\" style=\"margin-top: 0pt; margin-bottom: 0pt\"><span style=\"font-size: 10.5pt; font-family: \'宋体\'\">米拓信息的主要业务包括：</span><span style=\"font-size: 10.5pt; font-family: \'宋体\'\">网站系统开发、</span><span style=\"font-size: 10.5pt; font-family: \'宋体\'\">网站建设、网站推广、空间域名以及网络营销策划与运行。</span></p>\r\n<p class=\"p16\" style=\"margin-top: 0pt; margin-bottom: 0pt\">&nbsp;</p>\r\n<p class=\"p16\" style=\"margin-top: 0pt; margin-bottom: 0pt\"><span style=\"font-size: 10.5pt; font-family: \'宋体\'\">米拓信息</span><span style=\"font-size: 10.5pt; font-family: \'宋体\'\">主打产品&mdash;&mdash;</span><span style=\"font-size: 10.5pt; font-family: \'宋体\'\">MetInfo企业网站管理系统采用PHP+Mysql架构，全站内置了SEO搜索引擎优化机制，拥有企业网站常用的模块功能（企业简介模块、新闻模块、产品模块、下载模块、图片模块、招聘模块、在线留言、反馈系统、在线交流、友情链接）。强大灵活的后台管理功能、静态页面生成功能、个性化模块添加功能等可为企业打造出大气漂亮且具有营销力的精品网站。</span></p>\r\n<p class=\"p16\" style=\"margin-top: 0pt; margin-bottom: 0pt\">&nbsp;</p>\r\n<p class=\"p16\" style=\"margin-top: 0pt; margin-bottom: 0pt\"><span style=\"font-size: 10.5pt; font-family: \'宋体\'\">米拓信息</span><span style=\"font-size: 10.5pt; font-family: \'宋体\'\">秉承&ldquo;为合作伙伴创造价值&rdquo;的核心价值观，并以&ldquo;诚实、宽容、创新、服务&rdquo;为企业精神，通过自主创新和真诚合作为电子商务及信息服务行业创造价值。</span></p>\r\n<p class=\"p16\" style=\"margin-top: 0pt; margin-bottom: 0pt\">&nbsp;</p>\r\n<p class=\"p16\" style=\"margin-top: 0pt; margin-bottom: 0pt\"><span style=\"font-weight: bold; font-size: 10.5pt; font-family: \'宋体\'\">关于&ldquo;为合作伙伴创造价值&rdquo;</span><span style=\"font-size: 10.5pt; font-family: \'宋体\'\"><o:p></o:p></span></p>\r\n<p class=\"p16\" style=\"margin-top: 0pt; margin-bottom: 0pt\"><span style=\"font-size: 10.5pt; font-family: \'宋体\'\">　　</span><span style=\"font-size: 10.5pt; font-family: \'宋体\'\">米拓信息</span><span style=\"font-size: 10.5pt; font-family: \'宋体\'\">认为客户、供应商、公司股东、公司员工等一切和自身有合作关系的单位和个人都是自己的合作伙伴，并只有通过努力为合作伙伴创造价值，才能体现自身的价值并获得发展和成功。</span><span style=\"font-size: 10.5pt; font-family: \'宋体\'\"><o:p></o:p></span></p>\r\n<p class=\"p16\" style=\"margin-top: 0pt; margin-bottom: 0pt\"><span style=\"font-size: 10.5pt; font-family: \'宋体\'\"><br />\r\n</span><span style=\"font-weight: bold; font-size: 10.5pt; font-family: \'宋体\'\">关于&ldquo;诚实、宽容、创新、服务&rdquo;</span><span style=\"font-size: 10.5pt; font-family: \'宋体\'\"><o:p></o:p></span></p>\r\n<p class=\"p0\" style=\"margin-top: 0pt; margin-bottom: 0pt\"><span style=\"font-size: 10.5pt; font-family: \'Times New Roman\'\"><font face=\"宋体\">　&nbsp;</font></span><span style=\"font-size: 10.5pt; font-family: \'宋体\'\"><font face=\"宋体\">米拓信息</font></span><span style=\"font-size: 10.5pt; font-family: \'Times New Roman\'\"><font face=\"宋体\">认为诚信是一切合作的基础，宽容是解决问题的前提，创新是发展事业的利器，服务是创造价值的根本。</font></span></p>\r\n<!--EndFragment-->','','','all','../upload/200908/1250039888.gif','../upload/200908/1250040620.gif',1);
INSERT INTO `met_column` VALUES (2,'联系我们','Contact','about','contact',1,1,8,'0','3','','','<p>&nbsp;</p>\r\n<p>地址：长沙市天心区芙蓉中路三段416号</p>\r\n<p>电话：0731-87133078 13888888888</p>\r\n<p>QQ：348468810</p>\r\n<p>邮编：410076</p>\r\n<p>email：<a href=\"mailto:sales@metinfo.cn\">sales@metinfo.cn</a></p>\r\n<p>网址：<a href=\"http://www.metinfo.cn/\">www.MetInfo.cn</a></p>','<p>&nbsp;</p>\r\n<p>Add:No 416,Furong Road, Tianxin area, Changsha City</p>\r\n<p>Tel：0731-87133078 13888888888</p>\r\n<p>QQ：348468810</p>\r\n<p>Code：410076</p>\r\n<p>Email：<a href=\"mailto:sales@metinfo.cn\">sales@metinfo.cn</a></p>\r\n<p>Web：<a href=\"http://www.metinfo.cn/\">www.MetInfo.cn</a></p>','','','',0,'',2,'',0,'','','<p>&nbsp;</p>\r\n<p>地址：长沙市天心区赤岭路348号</p>\r\n<p>电话：0731-7133078 13888888888</p>\r\n<p>QQ：348468810</p>\r\n<p>邮编：410076</p>\r\n<p>email：<a href=\"mailto:sales@metinfo.cn\">sales@metinfo.cn</a></p>\r\n<p>网址：<a href=\"http://www.metinfo.cn/\">www.MetInfo.cn</a></p>','','','all','','',1);
INSERT INTO `met_column` VALUES (3,'业务范围','Operation','about','operation',1,1,2,'0','0','','','<p>1、网站系统开发、信息系统开发；<br />\r\n2、网站建设、网站设计； <br />\r\n3、网站推广与网络营销；<br />\r\n4、营销策划；<br />\r\n5、空间域名</p>','<p>1、Developing web system and information system；<br />\r\n2、Web building,web design； <br />\r\n3、Web extend and web marketing；<br />\r\n4、Marketing；<br />\r\n5、Domain and IDC；</p>','','','',0,'',2,'',0,'','','<p>1、网站系统开发、信息系统开发；<br />\r\n2、网站建设、网站设计； <br />\r\n3、网站推广与网络营销；<br />\r\n4、营销策划；<br />\r\n5、空间域名</p>','','','all','','',1);
INSERT INTO `met_column` VALUES (4,'新闻中心','News','news','',0,2,2,'0','1','','','','','','','',3,'',1,'',3,'','','','','','all','','',1);
INSERT INTO `met_column` VALUES (5,'企业新闻','Enterprise News','news','',4,2,1,'0','2','','','','','','','',1,'',2,'',0,'','','','','','all','','',1);
INSERT INTO `met_column` VALUES (6,'行业新闻','Industry News','news','',4,2,2,'0','0','','','','','','','',1,'',2,'',0,'','','','','','all','','',1);
INSERT INTO `met_column` VALUES (7,'产品中心','Product','product','',0,3,3,'0','1','','','','','','','',1,'',1,'',1,'','','','','','all','../upload/200909/1252723918.jpg','../upload/200909/1252723918.jpg',1);
INSERT INTO `met_column` VALUES (13,'下载中心','Download','download','',0,4,4,'0','1','','','','','','','',1,'',1,'',0,'','','','','','all','','',1);
INSERT INTO `met_column` VALUES (14,'文件下载','File Download','download','',13,4,1,'0','0','','','','','','','',1,'',2,'',0,'','','','','','all','','',1);
INSERT INTO `met_column` VALUES (15,'软件下载','Software Download','download','',13,4,2,'0','0','','','','','','','',1,'',2,'',0,'','','','','','all','','',1);
INSERT INTO `met_column` VALUES (16,'成功案例','Case','img','',0,5,5,'0','1','','','','','','','',1,'',1,'',4,'','','','','','all','','',1);
INSERT INTO `met_column` VALUES (18,'招聘中心','Job','job','',0,6,6,'0','1','','','','','','','',0,'',1,'',0,'','','','','','all','','',1);
INSERT INTO `met_column` VALUES (19,'在线反馈','Feedback','feedback','',0,8,7,'0','1','','','','','','','',0,'',1,'',0,'','','','','','all','','',1);
INSERT INTO `met_column` VALUES (20,'网站管理','Administer','','',0,0,20,'1','2','','','','','','','admin/',0,'target=\'_blank\'',1,'admin/',0,'网站管理','','','','admin/','all','','',1);
INSERT INTO `met_column` VALUES (21,'交流论坛','Forum','','',0,0,10,'1','1','','','','','','','http://bbs.metinfo.cn',0,'target=\'_blank\'',1,'http://bbs.metinfo.cn',0,'','','','','http://bbs.metinfo.cn','all','','',1);
INSERT INTO `met_column` VALUES (22,'在线留言','Guestbook','message','',0,7,9,'0','2','','','','','','','',0,'',1,'',0,'','','','','','all','','',1);
INSERT INTO `met_column` VALUES (23,'友情链接','Friendly Link','link','',0,9,10,'0','2','','','','','','','',0,'',1,'',0,'','','','','','all','','',1);
INSERT INTO `met_column` VALUES (24,'站内搜索','Search','search','',0,11,11,'0','2','','','','','','','',0,'',1,'',0,'','','','','','all','','',1);
INSERT INTO `met_column` VALUES (25,'会员中心','Member','member','',0,10,10,'0','2','','','','','','','',0,'',1,'',0,'','','','','','all','','',1);
INSERT INTO `met_column` VALUES (26,'网站地图','Sitemap','sitemap','',0,12,12,'0','2','','','','','','','',0,'',1,'',0,'','','','','','all','','',1);
INSERT INTO `met_column` VALUES (27,'数码家电','Digital Appliances','product','',7,3,1,'0','0','','','','','数码家电栏目简介','Digital Appliances column information','',1,'',2,'',6,'','','','','','all','../upload/200909/1252724165.jpg','../upload/200909/1252724165.jpg',1);
INSERT INTO `met_column` VALUES (28,'手机','Mobile','product','',7,3,2,'0','0','','','','','手机栏目简介','Mobile column information','',1,'',2,'',0,'','','','','','all','../upload/200909/1252723994.jpg','../upload/200909/1252723994.jpg',1);
INSERT INTO `met_column` VALUES (29,'MP3/MP4','MP3/MP4','product','',7,3,3,'0','0','','','','','MP3/MP4 栏目简介','MP3/MP4 column information','',1,'',2,'',0,'','','','','','all','../upload/200909/1252723752.jpg','../upload/200909/1252723752.jpg',1);
INSERT INTO `met_column` VALUES (30,'笔记本电脑','Notebook','product','',7,3,4,'0','0','','','','','笔记本电脑栏目简介','Notebook column information','',1,'',2,'',0,'','','','','','all','../upload/200909/1252724293.jpg','../upload/200909/1252724293.jpg',1);
INSERT INTO `met_column` VALUES (31,'移动存储','Removable Storage','product','',7,3,5,'0','0','','','','','移动存储栏目简介','Removable Storage column information','',1,'',2,'',0,'','','','','','all','../upload/200909/1252724264.jpg','../upload/200909/1252724264.jpg',1);
INSERT INTO `met_column` VALUES (32,'DC/DV','DC/DV','product','',7,3,6,'0','0','','','','','DC/DV 栏目简介','DC/DV column information','',1,'',2,'',0,'','','','','','all','../upload/200909/1252724038.jpg','../upload/200909/1252724038.jpg',1);
INSERT INTO `met_column` VALUES (33,'索尼','Sony','product','',27,3,1,'0','0','','','','','索尼栏目简介','Sony column information','',1,'',3,'',0,'','','','','','all','../upload/200909/1252723918.jpg','../upload/200909/1252723918.jpg',1);
INSERT INTO `met_column` VALUES (34,'日立','Hitachi','product','',27,3,2,'0','0','','','','','日立栏目简介','Hitachi column information','',1,'',3,'',0,'','','','','','all','../upload/200909/1252724165.jpg','../upload/200909/1252724165.jpg',1);
INSERT INTO `met_column` VALUES (35,'飞利浦','Philips','product','',27,3,3,'0','0','','','','','飞利浦栏目简介','Philips column information','',1,'',3,'',0,'','','','','','all','../upload/200909/1252723994.jpg','../upload/200909/1252723994.jpg',1);
INSERT INTO `met_column` VALUES (36,'三星','Samsung','product','',27,3,4,'0','0','','','','','三星栏目简介','Samsung column information','',1,'',3,'',0,'','','','','','all','../upload/200909/1252723752.jpg','../upload/200909/1252723752.jpg',1);
INSERT INTO `met_column` VALUES (37,'诺基亚','Nokia','product','',28,3,1,'0','0','','','','','诺基亚栏目简介','Nokia column information','',1,'',3,'',0,'','','','','','all','../upload/200909/1252724293.jpg','../upload/200909/1252724293.jpg',1);
INSERT INTO `met_column` VALUES (38,'三星','Samsung','product','',28,3,2,'0','0','','','','','三星栏目简介','Samsung column information','',1,'',3,'',0,'','','','','','all','../upload/200909/1252724264.jpg','../upload/200909/1252724264.jpg',1);
INSERT INTO `met_column` VALUES (39,'最新公告','Bulletin','news','',0,2,25,'0','0','','',NULL,NULL,'','','',1,'',1,'',5,'','',NULL,'','','all','','',1);
INSERT INTO `met_column` VALUES (40,'产品列表','Product List','product','',0,100,26,'0','0','','','','','','','',1,'',1,'',0,'','','','','','all','','',1);
INSERT INTO `met_column` VALUES (41,'图片列表','Images List','img','',0,101,27,'0','0','','','','','','','',1,'',1,'',0,'','','','','','all','','',1);


INSERT INTO `met_download` VALUES (1,'Metinfo企业网站管理系统介绍','MetInfo enterprise website management system ','','','MetInfo企业网站管理系统采用PHP+Mysql架构，全站内置了SEO搜索引擎优化机制，支持用户自定义界面语言(全球各种语言)，拥有企业网站常用的模块功能（企业简介模块、新闻模块、产品模块、下载模块、图片模块、招聘模块、在线留言、反馈系统、在线交流、友情链接、网站地图、会员与权限管理）。强大灵活的后台管理功能、静态页面生成功能、个性化模块添加功能、不同栏目自定义FLASH样式功能等可为企业打造出大气漂亮且具有营销力的精品网站。','','<p>软件名称：MetInfo企业网站管理系统<br />\r\n软件版本：V2.0<br />\r\n开发语言：PHP+Mysql<br />\r\n支持语言：用户自定义(支持全球各种语言，每套系统可设置3种语言)<br />\r\n界面风格：内含5套完整免费模板，全面支持MetInfo收费模板及用户自定义模板<br />\r\n版权所有：MetInfo Co.,Ltd<br />\r\n官方网址：<a href=\"http://www.MetInfo.cn\">http://www.MetInfo.cn</a><br />\r\n演示地址：<a href=\"http://www.MetInfo.cn/demo\">http://www.MetInfo.cn/demo</a><br />\r\n技术论坛：<a href=\"http://bbs.MetInfo.cn\">http://bbs.MetInfo.cn</a><br />\r\n适用范围：企业网站建设、个人网站建设、政府单位网站建设等</p>\r\n<p>MetInfo企业网站管理系统采用PHP+Mysql架构，全站内置了SEO搜索引擎优化机制，支持用户自定义界面语言(全球各种语言)，拥有企业网站常用的模块功能（企业简介模块、新闻模块、产品模块、下载模块、图片模块、招聘模块、在线留言、反馈系统、在线交流、友情链接、网站地图、会员与权限管理）。强大灵活的后台管理功能、静态页面生成功能、个性化模块添加功能、不同栏目自定义FLASH样式功能等可为企业打造出大气漂亮且具有营销力的精品网站。</p>\r\n<p>功能介绍：<br />\r\n1、全站页面SEO信息设置，如关键词、页面描述等；<br />\r\n2、全站静态页面生成功能，并可以个性化静态页面名称及静态页面格式；<br />\r\n3、简介、文章、产品、下载、图片模块三级栏目添加功能；<br />\r\n4、会员、代理商管理注册与管理，全站栏目、信息页面、字段参数权限控制功能；<br />\r\n5、全站文字与显示栏目、信息内容支持用户自定义，所见即可改；<br />\r\n6、支持全球各种语言（包括简体中文，繁体中文、英文、日文等等），用户可以自定义三种语言，并可以在后台根据需要开启语言和自定义默认首页；<br />\r\n7、Flash动画（广告）可以根据栏目设置不同样式，并可以选择多种不同的图片轮播方式；<br />\r\n8、在线交流后台管理功能、可添加QQ、MSN、淘宝旺旺、阿里旺旺、SKYPE、客服交流软件等，并可以设置显示风格和图标；<br />\r\n9、在线反馈与在线留言后台管理功能及邮件发送功能，反馈信息excel表格导出功能；<br />\r\n10、产品、图片、下载字段自定义功能，每个产品最多可以上传12张产品图片；<br />\r\n11、前台模板与程序完全分离，标签化模板制作，模板后台添加和切换功能，模板风格选择功能；<br />\r\n12、缩略图自动生成、图片文字水印自动添加功能；<br />\r\n13、直接根据后台栏目设置管理员权限及操作权限功能；<br />\r\n14、热门标签设置功能；<br />\r\n15、数据库备份和恢复功能；<br />\r\n16、系统安全设置与效率配置功能；<br />\r\n17、网站地图功能；<br />\r\n18、上传文件管理功能；<br />\r\n19、简历投递与管理功能，简历参数后台配置功能；<br />\r\n20、支持内容手动分页；<br />\r\n21、支持多种首页布局后台切换、产品及图片显示模式；<br />\r\n22、DIV+CSS布局，全部兼容IE6、IE7、IE8、火狐、谷歌、TT、360度、遨游等主流浏览器；</p>\r\n<p><br />\r\n模块介绍：<br />\r\n1、简介模块：发布介绍企业的各类信息，如企业简介、组织机构、联系方式，并可随意增加新的栏目，持三级栏目，并可以随意添加新的栏目。 <br />\r\n2、新闻模块：发布企业新闻和相关文章，可设置图片文章和推荐文章，支持三级栏目，并可以随意添加新的栏目。<br />\r\n3、产品模块：可设置产品参数，并可以设置参数浏览权限，如产品型号、包装等等，支持12张产品图片轮播，支持新品展示和推荐产品，可自动生成产品缩略图，支持三级栏目，并可以随意添加新的栏目。<br />\r\n4、下载模块：可设置下载参数，并可以设置参数浏览权限和下载权限，如文件类型、文件大小等等，支持最新下载和推荐下载，支持三级栏目，并可以随意添加新的栏目。<br />\r\n5、图片模块：可设置图片参数，并可以设置参数浏览权限，如图片来源、图片大小等等，支持12张图片轮播，支持最新图片和推荐图片，支持三级栏目，并可以随意添加新的栏目。<br />\r\n6、招聘模块：发布招聘信息，简历在线投递，可以自定义简历字段。<br />\r\n7、在线交流：可在后台添加多个QQ、MSN、淘宝旺旺、阿里旺旺、SKYPE，自定义显示风格，并可为每一组联系方式设置相应的部门，如在线销售、技术支持等。<br />\r\n8、在线留言：访问者在线留言，自动将留言发送至设定邮箱，后台审核回复功能，敏感字符过滤功能。<br />\r\n9、反馈系统：可设置前台反馈表单、下拉菜单、多选菜单，系统可自动获取反馈者来源IP及提交页面，并可以用于产品模块直接提交产品咨询购买，反馈信息自动发送至设定邮箱及自动邮件回复功能，敏感字符过滤功能，excel表格导出功能。<br />\r\n10、友情链接：友情链接申请，后台审批推荐功能，支持文字链接和图片链接。<br />\r\n11、会员模块：会员注册、激活、登陆，游客、普通会员、代理商三级权限管理，在线留言、在线反馈、简历投递管理；<br />\r\n12、网站地图：HTML和XML网站地图生成功能；</p>','<p>Software Name: MetInfo enterprise website management system <br />\r\nSoftware Version: V2.0 <br />\r\nDevelopment Environment: PHP + Mysql <br />\r\nSupport language: user-defined (supporting various global languages, each system can be set to three kinds of languages) <br />\r\nInterface Style: contains 5 complete set of free templates, full support for MetInfo fees and user-defined template template <br />\r\nCopyright: MetInfo Co., Ltd <br />\r\nOfficial Website: <a href=\"http://www.MetInfo.cn\">http://www.MetInfo.cn</a> <br />\r\nDemo Address: <a href=\"http://www.MetInfo.cn/demo\">http://www.MetInfo.cn/demo</a> <br />\r\nTechnical Forum: <a href=\"http://bbs.MetInfo.cn\">http://bbs.MetInfo.cn</a> <br />\r\nScope: Corporate Website, personal Web site-building, government agencies, Web site construction</p>\r\n<p>MetInfo enterprise website management system using PHP + Mysql structure, the whole point of SEO search engine optimization built-in mechanisms to support user-defined interface language (the world\'s languages), has a corporate Web site commonly used module functions (Company Profile module, news module, product modules, download the module, image module, recruitment module, on-line comments, feedback systems, on-line communication, friendship links, site map, members and rights management). Powerful and flexible back-end management capabilities, static page generation capabilities, personalization modules to add functionality, custom columns in different styles FLASH functions for enterprise to create a beautiful atmosphere, and has a marketing edge boutique website.</p>\r\n<p>Function: <br />\r\n1, full-stop SEO information on the page settings, such as keywords, page descriptions, etc.; <br />\r\n2, full-stop static page generation capabilities, and can personalize the name and static page static web page format; <br />\r\n3, profiles, articles, products, downloads, pictures, add functionality to the module three sections; <br />\r\n4, members, agents manage registration and management, full-stop section, information pages, the field parameters of access control function; <br />\r\n5, full-stop text and display columns, message content to support user-defined, you can see it change; <br />\r\n6, support the world\'s languages (including Simplified Chinese, Traditional Chinese, English, Japanese, etc.), users can customize in three languages and can be opened in the background as needed language and custom default home page; <br />\r\n7, Flash animation (advertising) can be set up different styles according to section, and can choose a variety of image carousel method; <br />\r\n8, on-line exchange of background management functions, you can add QQ, MSN, Taobao Wangwang, Ali Wangwang, SKYPE, customer communication software, and you can set the display style and icon; <br />\r\n9, online feedback and online e-mail message to send back the management functions and features, feedback forms excel export function; <br />\r\n10, products, images, download the field of custom features, each product can upload up to 12 product images; <br />\r\n11, front templates and procedures were entirely separate production label templates, templates, add background and switching functions, templates, style, selection function; <br />\r\n12, automatically generated thumbnails, pictures, text watermark automatically added functionality; <br />\r\n13, directly under the background section to set administrator rights and operational authority functions; <br />\r\n14, Top Label Set function; <br />\r\n15, database backup and restore functions; <br />\r\n16, system security configuration settings and efficiency; <br />\r\n17, site map function; <br />\r\n18, upload file management functions; <br />\r\n19, CV delivery and management functions, resume the background configuration parameter function; <br />\r\n20, support the contents of the manual page; <br />\r\n21, supports a variety of page layouts to switch the background, products and image display mode; <br />\r\n22, DIV + CSS layout, all compatible with IE6, IE7, IE8, Firefox, Google, TT, 360 degrees, traveling, and other mainstream browser;</p>\r\n<p><br />\r\nModule description: <br />\r\n1, Introduction module: release describes the various types of business information such as company profile, organization, contacts, and can freely add new sections, holding 3 sections, and can freely add new sections. <br />\r\n2, News module: Release business news and related articles, you can set pictures articles and recommended articles in support of three columns, and can freely add new sections. <br />\r\n3, the product modules: You can set the product parameters, and can set the parameters browse permissions, such as product models, packaging, etc., to support 12 Picture Carousel support the new display and recommend products that can automatically generate product thumbnails, supports 3 section, and can freely add new sections. <br />\r\n4, download the module: You can set download parameters, and can set parameters browsing and downloading access permissions, such as file type, file size, etc., support for the latest downloads and recommend to download in support of three columns, and can freely add new sections. <br />\r\n5, Photo Modules: You can set the image parameters, and can set the parameters browse permissions, such as images sources, image size, etc., to support 12 pictures Carousel, support for the latest pictures and recommended images, support for three columns, and can freely add new columns. <br />\r\n6, the recruitment module: release employment information, resume online delivery, you can customize the resume field. <br />\r\n7, on-line exchange: You can add more than one in the background, QQ, MSN, Taobao Wangwang, Ali Wangwang, SKYPE, custom display styles, and can be set for each group contact the appropriate departments, such as online sales, technical support, etc. . <br />\r\n8, on-line message: visitors online messages, automatically set up a message sent to the mailbox, the background audit recovery capabilities, sensitive character filtering. <br />\r\n9, the feedback system: feedback form can be set to front, pull-down menus, multiple-choice menu, the system can automatically obtain the IP source of feedback and submit those pages, and modules can be used for products purchased directly to the product advisory, feedback information is automatically sent to the set fixed-mail and automatic e-mail reply function, sensitive character filtering, excel table export functionality. <br />\r\n10, Links: Link application for approval of recommended background, supporting text links and image links. <br />\r\n11, member modules: member registration, activation, landing, tourists, ordinary members, agents, three rights management, online message, on-line feedback, and resume delivery management; <br />\r\n12, Site Map: HTML and XML site map generation function;</p>',13,14,0,0,'http://www.metinfo.cn/','6000',0,5,'2009-09-13 23:15:46','2009-03-18 21:57:41','产品说明书','V2.0','','','','','','','','','Explain','V2.0','','','','','','','','','','','','','','','','','','','','','','','','all',0,0);
INSERT INTO `met_download` VALUES (2,'metinfo企业网站管理系统2.0','MetInfo enterprise website management system ','MetInfo企业网站管理系统','','MetInfo企业网站管理系统采用PHP+Mysql架构，全站内置了SEO搜索引擎优化机制，支持用户自定义界面语言(全球各种语言)，拥有企业网站常用的模块功能（企业简介模块、新闻模块、产品模块、下载模块、图片模块、招聘模块、在线留言、反馈系统、在线交流、友情链接、网站地图、会员与权限管理）。强大灵活的后台管理功能、静态页面生成功能、个性化模块添加功能、不同栏目自定义FLASH样式功能等可为企业打造出大气漂亮且具有营销力的精品网站。','','<p><strong>软件名称</strong>：MetInfo企业网站管理系统<br />\r\n<strong>软件版本</strong>：V2.0<br />\r\n<strong>开发语言</strong>：PHP+Mysql<br />\r\n<strong>支持语言</strong>：用户自定义(支持全球各种语言，每套系统可设置3种语言)<br />\r\n<strong>界面风格</strong>：内含5套完整免费模板，全面支持MetInfo收费模板及用户自定义模板<br />\r\n<strong>版权所有</strong>：MetInfo Co.,Ltd<br />\r\n<strong>官方网址</strong>：<a href=\"http://www.MetInfo.cn\">http://www.MetInfo.cn</a><br />\r\n<strong>演示地址</strong>：<a href=\"http://www.MetInfo.cn/demo\">http://www.MetInfo.cn/demo</a><br />\r\n<strong>技术论坛</strong>：<a href=\"http://bbs.MetInfo.cn\">http://bbs.MetInfo.cn</a><br />\r\n<strong>适用范围</strong>：企业网站建设、个人网站建设、政府单位网站建设等</p>\r\n<p>&nbsp;</p>\r\n<p>MetInfo企业网站管理系统采用PHP+Mysql架构，全站内置了SEO搜索引擎优化机制，支持用户自定义界面语言(全球各种语言)，拥有企业网站常用的模块功能（企业简介模块、新闻模块、产品模块、下载模块、图片模块、招聘模块、在线留言、反馈系统、在线交流、友情链接、网站地图、会员与权限管理）。强大灵活的后台管理功能、静态页面生成功能、个性化模块添加功能、不同栏目自定义FLASH样式功能等可为企业打造出大气漂亮且具有营销力的精品网站。</p>\r\n<p>&nbsp;</p>\r\n<p><strong>功能介绍：</strong><br />\r\n1、全站页面SEO信息设置，如关键词、页面描述等；<br />\r\n2、全站静态页面生成功能，并可以个性化静态页面名称及静态页面格式；<br />\r\n3、简介、文章、产品、下载、图片模块三级栏目添加功能；<br />\r\n4、会员、代理商管理注册与管理，全站栏目、信息页面、字段参数权限控制功能；<br />\r\n5、全站文字与显示栏目、信息内容支持用户自定义，所见即可改；<br />\r\n6、支持全球各种语言（包括简体中文，繁体中文、英文、日文等等），用户可以自定义三种语言，并可以在后台根据需要开启语言和自定义默认首页；<br />\r\n7、Flash动画（广告）可以根据栏目设置不同样式，并可以选择多种不同的图片轮播方式；<br />\r\n8、在线交流后台管理功能、可添加QQ、MSN、淘宝旺旺、阿里旺旺、SKYPE、客服交流软件等，并可以设置显示风格和图标；<br />\r\n9、在线反馈与在线留言后台管理功能及邮件发送功能，反馈信息excel表格导出功能；<br />\r\n10、产品、图片、下载字段自定义功能，每个产品最多可以上传12张产品图片；<br />\r\n11、前台模板与程序完全分离，标签化模板制作，模板后台添加和切换功能，模板风格选择功能；<br />\r\n12、缩略图自动生成、图片文字水印自动添加功能；<br />\r\n13、直接根据后台栏目设置管理员权限及操作权限功能；<br />\r\n14、热门标签设置功能；<br />\r\n15、数据库备份和恢复功能；<br />\r\n16、系统安全设置与效率配置功能；<br />\r\n17、网站地图功能；<br />\r\n18、上传文件管理功能；<br />\r\n19、简历投递与管理功能，简历参数后台配置功能；<br />\r\n20、支持内容手动分页；<br />\r\n21、支持多种首页布局后台切换、产品及图片显示模式；<br />\r\n22、DIV+CSS布局，全部兼容IE6、IE7、IE8、火狐、谷歌、TT、360度、遨游等主流浏览器；</p>\r\n<p><br />\r\n<strong>模块介绍：</strong><br />\r\n1、简介模块：发布介绍企业的各类信息，如企业简介、组织机构、联系方式，并可随意增加新的栏目，持三级栏目，并可以随意添加新的栏目。 <br />\r\n2、新闻模块：发布企业新闻和相关文章，可设置图片文章和推荐文章，支持三级栏目，并可以随意添加新的栏目。<br />\r\n3、产品模块：可设置产品参数，并可以设置参数浏览权限，如产品型号、包装等等，支持12张产品图片轮播，支持新品展示和推荐产品，可自动生成产品缩略图，支持三级栏目，并可以随意添加新的栏目。<br />\r\n4、下载模块：可设置下载参数，并可以设置参数浏览权限和下载权限，如文件类型、文件大小等等，支持最新下载和推荐下载，支持三级栏目，并可以随意添加新的栏目。<br />\r\n5、图片模块：可设置图片参数，并可以设置参数浏览权限，如图片来源、图片大小等等，支持12张图片轮播，支持最新图片和推荐图片，支持三级栏目，并可以随意添加新的栏目。<br />\r\n6、招聘模块：发布招聘信息，简历在线投递，可以自定义简历字段。<br />\r\n7、在线交流：可在后台添加多个QQ、MSN、淘宝旺旺、阿里旺旺、SKYPE，自定义显示风格，并可为每一组联系方式设置相应的部门，如在线销售、技术支持等。<br />\r\n8、在线留言：访问者在线留言，自动将留言发送至设定邮箱，后台审核回复功能，敏感字符过滤功能。<br />\r\n9、反馈系统：可设置前台反馈表单、下拉菜单、多选菜单，系统可自动获取反馈者来源IP及提交页面，并可以用于产品模块直接提交产品咨询购买，反馈信息自动发送至设定邮箱及自动邮件回复功能，敏感字符过滤功能，excel表格导出功能。<br />\r\n10、友情链接：友情链接申请，后台审批推荐功能，支持文字链接和图片链接。<br />\r\n11、会员模块：会员注册、激活、登陆，游</p>','<p>Software Name: MetInfo enterprise website management system <br />\r\nSoftware Version: V2.0 <br />\r\nDevelopment Environment: PHP + Mysql <br />\r\nSupport language: user-defined (supporting various global languages, each system can be set to three kinds of languages) <br />\r\nInterface Style: contains 5 complete set of free templates, full support for MetInfo fees and user-defined template template <br />\r\nCopyright: MetInfo Co., Ltd <br />\r\nOfficial Website: <a href=\"http://www.MetInfo.cn\">http://www.MetInfo.cn</a> <br />\r\nDemo Address: <a href=\"http://www.MetInfo.cn/demo\">http://www.MetInfo.cn/demo</a> <br />\r\nTechnical Forum: <a href=\"http://bbs.MetInfo.cn\">http://bbs.MetInfo.cn</a> <br />\r\nScope: Corporate Website, personal Web site-building, government agencies, Web site construction</p>\r\n<p>&nbsp;</p>\r\n<p>MetInfo enterprise website management system using PHP + Mysql structure, the whole point of SEO search engine optimization built-in mechanisms to support user-defined interface language (the world\'s languages), has a corporate Web site commonly used module functions (Company Profile module, news module, product modules, download the module, image module, recruitment module, on-line comments, feedback systems, on-line communication, friendship links, site map, members and rights management). Powerful and flexible back-end management capabilities, static page generation capabilities, personalization modules to add functionality, custom columns in different styles FLASH functions for enterprise to create a beautiful atmosphere, and has a marketing edge boutique website.</p>\r\n<p><strong>Function: </strong><br />\r\n1, full-stop SEO information on the page settings, such as keywords, page descriptions, etc.; <br />\r\n2, full-stop static page generation capabilities, and can personalize the name and static page static web page format; <br />\r\n3, profiles, articles, products, downloads, pictures, add functionality to the module three sections; <br />\r\n4, members, agents manage registration and management, full-stop section, information pages, the field parameters of access control function; <br />\r\n5, full-stop text and display columns, message content to support user-defined, you can see it change; <br />\r\n6, support the world\'s languages (including Simplified Chinese, Traditional Chinese, English, Japanese, etc.), users can customize in three languages and can be opened in the background as needed language and custom default home page; <br />\r\n7, Flash animation (advertising) can be set up different styles according to section, and can choose a variety of image carousel method; <br />\r\n8, on-line exchange of background management functions, you can add QQ, MSN, Taobao Wangwang, Ali Wangwang, SKYPE, customer communication software, and you can set the display style and icon; <br />\r\n9, online feedback and online e-mail message to send back the management functions and features, feedback forms excel export function; <br />\r\n10, products, images, download the field of custom features, each product can upload up to 12 product images; <br />\r\n11, front templates and procedures were entirely separate production label templates, templates, add background and switching functions, templates, style, selection function; <br />\r\n12, automatically generated thumbnails, pictures, text watermark automatically added functionality; <br />\r\n13, directly under the background section to set administrator rights and operational authority functions; <br />\r\n14, Top Label Set function; <br />\r\n15, database backup and restore functions; <br />\r\n16, system security configuration settings and efficiency; <br />\r\n17, site map function; <br />\r\n18, upload file management functions; <br />\r\n19, CV delivery and management functions, resume the background configuration parameter function; <br />\r\n20, support the contents of the manual page; <br />\r\n21, supports a variety of page layouts to switch the background, products and image display mode; <br />\r\n22, DIV + CSS layout, all compatible with IE6, IE7, IE8, Firefox, Google, TT, 360 degrees, traveling, and other mainstream browser;</p>\r\n<p><br />\r\n<strong>Module description: </strong><br />\r\n1, Introduction module: release describes the various types of business information such as company profile, organization, contacts, and can freely add new sections, holding 3 sections, and can freely add new sections. <br />\r\n2, News module: Release business news and related articles, you can set pictures articles and recommended articles in support of three columns, and can freely add new sections. <br />\r\n3, the product modules: You can set the product parameters, and can set the parameters browse permissions, such as product models, packaging, etc., to support 12 Picture Carousel support the new display and recommend products that can automatically generate product thumbnails, supports 3 section, and can freely add new sections. <br />\r\n4, download the module: You can set download parameters, and can set parameters browsing and downloading access permissions, such as file type, file size, etc., support for the latest downloads and recommend to download in support of three columns, and can freely add new sections. <br />\r\n5, Photo Modules: You can set the image parameters, and can set the parameters browse permissions, such as images sources, image size, etc., to support 12 pictures Carousel, support for the latest pictures and recommended images, support for three columns, and can freely add new columns. <br />\r\n6, the recruitment module: release employment information, resume online delivery, you can customize the resume field. <br />\r\n7, on-line exchange: You can add more than one in the background, QQ, MSN, Taobao Wangwang, Ali Wangwang, SKYPE, custom display styles, and can be set for each group contact the appropriate departments, such as online sales, technical support, etc. . <br />\r\n8, on-line message: visitors online messages, automatically set up a message sent to the mailbox, the background audit recovery capabilities, sensitive character filtering. <br />\r\n9, the feedback system: feedback form can be set to front, pull-down menus, multiple-choice menu, the system can automatically obtain the IP source of feedback and submit those pages, and modules can be used for products purchased directly to the product advisory, feedback information is automatically sent to the set fixed-mail and automatic e-mail reply function, sensitive character filtering, excel table export functionality. <br />\r\n10, Links: Link application for approval of recommended background, supporting text links and image links. <br />\r\n11, member modules: member registration, activation, landing, tourists, ordinary members, agents, three rights management, online message, on-line feedback, and resume delivery management; <br />\r\n12, Site Map: HTML and XML site map generation function;</p>',13,15,0,0,'http://www.metinfo.cn','6000',1,21,'2009-09-13 23:18:50','2009-03-19 11:32:38','软件','V2.0','','','','','','','','','software','V2.0','','','','','','','','','','','','','','','','','','','','','','','','all',0,1);

INSERT INTO `met_fdlist` VALUES (1,11,'北京','Beijin',1,'北京');
INSERT INTO `met_fdlist` VALUES (2,11,'天津','Tianjin',2,'天津');
INSERT INTO `met_fdlist` VALUES (3,11,'河北','Hebei',3,'河北');
INSERT INTO `met_fdlist` VALUES (4,11,'内蒙古','Neimenggu',4,'内蒙古');
INSERT INTO `met_fdlist` VALUES (5,11,'黑龙江','Heilongjiang',5,'黑龙江');
INSERT INTO `met_fdlist` VALUES (6,11,'辽宁','Liaoning',6,'辽宁');
INSERT INTO `met_fdlist` VALUES (7,11,'吉林','Jilin',7,'吉林');
INSERT INTO `met_fdlist` VALUES (8,11,'山西','Shanxi',8,'山西');
INSERT INTO `met_fdlist` VALUES (9,11,'陕西','Shanxi',9,'陕西');
INSERT INTO `met_fdlist` VALUES (10,11,'甘肃','Gansu',10,'甘肃');
INSERT INTO `met_fdlist` VALUES (11,11,'青海','Qinghai',11,'青海');
INSERT INTO `met_fdlist` VALUES (12,11,'宁夏','Ningxia',12,'宁夏');
INSERT INTO `met_fdlist` VALUES (13,11,'新疆','Xinjiang',13,'新疆');
INSERT INTO `met_fdlist` VALUES (14,11,'西藏','Xizang',14,'西藏');
INSERT INTO `met_fdlist` VALUES (15,11,'四川','Sichuan',15,'四川');
INSERT INTO `met_fdlist` VALUES (16,11,'重庆','Chongqing',16,'重庆');
INSERT INTO `met_fdlist` VALUES (17,11,'云南','Yunnan',17,'云南');
INSERT INTO `met_fdlist` VALUES (18,11,'贵州','Guizhou',18,'贵州');
INSERT INTO `met_fdlist` VALUES (19,11,'湖南','Hunan',19,'湖南');
INSERT INTO `met_fdlist` VALUES (20,11,'湖北','Hubei',20,'湖北');
INSERT INTO `met_fdlist` VALUES (21,11,'河南','Henan',21,'河南');
INSERT INTO `met_fdlist` VALUES (22,11,'山东','Shandong',22,'山东');
INSERT INTO `met_fdlist` VALUES (23,11,'安徽','Anhui',23,'安徽');
INSERT INTO `met_fdlist` VALUES (24,11,'江苏','Jiangsu',24,'江苏');
INSERT INTO `met_fdlist` VALUES (25,11,'上海','Shanghai',25,'上海');
INSERT INTO `met_fdlist` VALUES (26,11,'浙江','Zhejiang',26,'浙江');
INSERT INTO `met_fdlist` VALUES (27,11,'江西','Jiangxi',27,'江西');
INSERT INTO `met_fdlist` VALUES (28,11,'福建','Fujian',28,'福建');
INSERT INTO `met_fdlist` VALUES (29,11,'广东','Guangdong',29,'广东');
INSERT INTO `met_fdlist` VALUES (30,11,'广西','Guangxi',30,'广西');
INSERT INTO `met_fdlist` VALUES (31,11,'海南','Hainan',31,'海南');
INSERT INTO `met_fdlist` VALUES (32,11,'港澳台','Gangaotai',32,'港澳台');
INSERT INTO `met_fdlist` VALUES (33,12,'索取资料','Get data',1,'索取资料');
INSERT INTO `met_fdlist` VALUES (34,12,'购买产品','Buy Product',2,'购买产品');
INSERT INTO `met_fdlist` VALUES (35,12,'技术咨询','Consultation',3,'技术咨询');
INSERT INTO `met_fdlist` VALUES (36,21,'搜索引擎','Search Engine',1,'搜索引擎');
INSERT INTO `met_fdlist` VALUES (37,21,'网站链接','Web Link',2,'网站链接');
INSERT INTO `met_fdlist` VALUES (38,21,'朋友介绍','Friend Introduce',3,'朋友介绍');
INSERT INTO `met_fdlist` VALUES (39,21,'电视广告','TV AD',4,'电视广告');
INSERT INTO `met_fdlist` VALUES (40,21,'其他方式','Other way',5,'其他方式');
INSERT INTO `met_fdlist` VALUES (41,81,'创维','skyworth',1,'');
INSERT INTO `met_fdlist` VALUES (42,81,'TCL','TCL',2,'');
INSERT INTO `met_fdlist` VALUES (43,81,'海尔','haier',3,'');

INSERT INTO `met_fdparameter` VALUES (1,'反馈主题','Subject',2,1,1,1,'反馈主题');
INSERT INTO `met_fdparameter` VALUES (2,'姓名','Name',3,1,1,1,'姓名');
INSERT INTO `met_fdparameter` VALUES (3,'职务','Duty',4,1,0,1,'职务');
INSERT INTO `met_fdparameter` VALUES (4,'Email','Email',5,1,1,1,'Email');
INSERT INTO `met_fdparameter` VALUES (5,'电话',' Tel',6,1,0,1,'电话');
INSERT INTO `met_fdparameter` VALUES (6,'手机','Mobile',7,1,0,1,'手机');
INSERT INTO `met_fdparameter` VALUES (7,'传真','Fax',8,1,0,1,'传真');
INSERT INTO `met_fdparameter` VALUES (8,'单位名称','Company',9,1,0,1,'单位名称');
INSERT INTO `met_fdparameter` VALUES (9,'详细地址','Add',11,1,0,1,'详细地址');
INSERT INTO `met_fdparameter` VALUES (10,'邮政编码','Postalcode',12,1,0,1,'邮政编码');
INSERT INTO `met_fdparameter` VALUES (11,'省份','Province',10,1,0,2,'省份');
INSERT INTO `met_fdparameter` VALUES (12,'反馈类型','Type',1,1,1,2,'反馈类型');
INSERT INTO `met_fdparameter` VALUES (13,'','',13,0,0,2,'');
INSERT INTO `met_fdparameter` VALUES (14,'','',14,0,0,2,'');
INSERT INTO `met_fdparameter` VALUES (15,'','',15,0,0,2,'');
INSERT INTO `met_fdparameter` VALUES (16,'信息描述','Infomation',16,1,1,3,'信息描述');
INSERT INTO `met_fdparameter` VALUES (17,'','',17,0,0,3,'');
INSERT INTO `met_fdparameter` VALUES (18,'','',18,0,0,3,'');
INSERT INTO `met_fdparameter` VALUES (19,'','',19,0,0,3,'');
INSERT INTO `met_fdparameter` VALUES (20,'','',20,0,0,3,'');
INSERT INTO `met_fdparameter` VALUES (21,'您是怎么找到我们的','How did you find us',16,1,0,4,'您是怎么找到我们的');
INSERT INTO `met_fdparameter` VALUES (22,'','',22,0,0,4,'');
INSERT INTO `met_fdparameter` VALUES (23,'','',23,0,0,4,'');
INSERT INTO `met_fdparameter` VALUES (24,'','',24,0,0,4,'');
INSERT INTO `met_fdparameter` VALUES (25,'上传附件','upload file',25,1,0,5,'上传附件');
INSERT INTO `met_fdparameter` VALUES (26,'','',26,0,0,5,'');
INSERT INTO `met_fdparameter` VALUES (27,'','',27,0,0,5,'');


INSERT INTO `met_flash` VALUES (1,10000,'MetInfo企业网站管理系统正式发布','../upload/200909/1251807502.jpg','http://www.metinfo.cn/','MetInfo enterprise website manager system Released Now ','../upload/200909/1252905375.jpg','http://www.metinfo.cn/','','','','','','','','','',1,990,196);
INSERT INTO `met_flash` VALUES (2,10001,'MetInfo企业网站管理系统','../upload/200909/1251807998.jpg','http://www.metinfo.cn/','MetInfo enterprise website manager system','../upload/200909/1252907240.jpg','http://www.metinfo.cn/','','','','','','','','','',3,990,200);
INSERT INTO `met_flash` VALUES (3,10000,'为你打造营销型企业网站','../upload/200909/1251807982.jpg','http://www.metinfo.cn/','Building Marketing Web for you!','../upload/200909/1252907455.jpg','http://www.metinfo.cn/','','','','','','','','','',3,990,196);
INSERT INTO `met_flash` VALUES (4,10001,'购买官方空间免费获取商业授权','../upload/200909/1252902438.jpg','http://www.metinfo.cn/web/promotion.htm','Buy the official space for free access to license','../upload/200909/1252901845.jpg','http://www.metinfo.cn/web/promotion.htm','','','','','','','','','',1,990,200);
INSERT INTO `met_flash` VALUES (5,10001,'MetInfo商业模板','../upload/200909/1252901922.jpg','http://www.metinfo.cn/product/product.php?class1=37','MetInfo Business Templates','../upload/200909/1252902691.jpg','http://www.metinfo.cn/product/product.php?class1=37','','','','','','','','','',2,990,200);
INSERT INTO `met_flash` VALUES (6,18,'购买官方空间免费获取商业授权','../upload/200909/1252902438.jpg','http://www.metinfo.cn/web/promotion.htm','Buy the official space for free access to license','../upload/200909/1252901845.jpg','http://www.metinfo.cn/web/promotion.htm','','','','','','','','','',0,990,196);
INSERT INTO `met_flash` VALUES (7,7,'','','','','','','','','','../upload/file/1252912622.swf','','../upload/file/1252912281.swf','','','',0,990,193);
INSERT INTO `met_flash` VALUES (8,27,'','','','','','','','','','../upload/file/1252912240.swf','','../upload/file/1252912334.swf','','','',0,990,193);
INSERT INTO `met_flash` VALUES (9,19,'','','','','','','','','','../upload/file/1252912819.swf','','../upload/file/1252912903.swf','','','',0,990,193);
INSERT INTO `met_flash` VALUES (10,33,'','','','','','','','','','../upload/file/1252912709.swf','','../upload/file/1252912906.swf','','','',0,990,193);

INSERT INTO `met_img` VALUES (1,'成功案例1','Case1','','','MetInfo企业网站管理系统2.0正式版','MetInfo MetInfo Company Website 2.0','<p>MetInfo企业网站管理系统2.0正式版</p>','<p>MetInfo MetInfo Company Website 2.0</p>',16,0,0,0,'../upload/200909/watermark/1251809913.jpg','../upload/200909/thumb/1251809913.jpg',1,19,'2009-09-13 23:35:34','2009-09-01 20:39:23','','','','','','','','','','','','','','','','','','','','','admin','','','','','','','','','','','','','','','all','../upload/200909/1252723918.jpg','../upload/200909/1252724165.jpg','../upload/200909/1252723994.jpg','../upload/200909/1252723752.jpg','../upload/200909/1252724293.jpg','../upload/200909/1252724264.jpg','../upload/200909/1252724038.jpg','','','','../upload/200909/1252723918.jpg','../upload/200909/1252724165.jpg','../upload/200909/1252723994.jpg','../upload/200909/1252723752.jpg','../upload/200909/1252724293.jpg','../upload/200909/1252724264.jpg','../upload/200909/1252724038.jpg','','','','','','','','','','','','','',0,'','','','','','','','','','','','');
INSERT INTO `met_img` VALUES (2,'成功案例2','Case2','','','MetInfo企业网站管理系统2.0正式版','MetInfo MetInfo Company Website 2.0','','',16,0,0,0,'../upload/200909/watermark/1251809775.jpg','../upload/200909/thumb/1251809775.jpg',1,10,'2009-09-01 20:52:47','2009-09-01 20:43:22','','','','','','','','','','','','','','','','','','','','','admin','','','','','','','','','','','','','','','all','../upload/200909/1252723918.jpg','../upload/200909/1252724165.jpg','../upload/200909/1252723994.jpg','../upload/200909/1252723752.jpg','../upload/200909/1252724293.jpg','../upload/200909/1252724264.jpg','../upload/200909/1252724038.jpg','','','','../upload/200909/1252723918.jpg','../upload/200909/1252724165.jpg','../upload/200909/1252723994.jpg','../upload/200909/1252723752.jpg','../upload/200909/1252724293.jpg','../upload/200909/1252724264.jpg','../upload/200909/1252724038.jpg','','','','','','','','','','','','','',0,'','','','','','','','','','','','');
INSERT INTO `met_img` VALUES (3,'成功案例3','case3','','','MetInfo企业网站管理系统2.0正式版','MetInfo MetInfo Company Website 2.0','','',16,0,0,0,'../upload/200909/watermark/1251809385.jpg','../upload/200909/thumb/1251809385.jpg',1,2,'2009-09-01 20:52:36','2009-09-01 20:44:20','','','','','','','','','','','','','','','','','','','','','admin','','','','','','','','','','','','','','','all','../upload/200909/1252723918.jpg','../upload/200909/1252724165.jpg','../upload/200909/1252723994.jpg','../upload/200909/1252723752.jpg','../upload/200909/1252724293.jpg','../upload/200909/1252724264.jpg','../upload/200909/1252724038.jpg','','','','../upload/200909/1252723918.jpg','../upload/200909/1252724165.jpg','../upload/200909/1252723994.jpg','../upload/200909/1252723752.jpg','../upload/200909/1252724293.jpg','../upload/200909/1252724264.jpg','../upload/200909/1252724038.jpg','','','','','','','','','','','','','',0,'','','','','','','','','','','','');
INSERT INTO `met_img` VALUES (4,'成功案例4','Case4','','','MetInfo企业网站管理系统2.0正式版','MetInfo MetInfo Company Website 2.0','','',16,0,0,0,'../upload/200909/watermark/1251810214.jpg','../upload/200909/thumb/1251810214.jpg',1,4,'2009-09-01 20:52:25','2009-09-01 20:51:10','','','','','','','','','','','','','','','','','','','','','admin','','','','','','','','','','','','','','','all','../upload/200909/1252723918.jpg','../upload/200909/1252724165.jpg','../upload/200909/1252723994.jpg','../upload/200909/1252723752.jpg','../upload/200909/1252724293.jpg','../upload/200909/1252724264.jpg','../upload/200909/1252724038.jpg','','','','../upload/200909/1252723918.jpg','../upload/200909/1252724165.jpg','../upload/200909/1252723994.jpg','../upload/200909/1252723752.jpg','../upload/200909/1252724293.jpg','../upload/200909/1252724264.jpg','../upload/200909/1252724038.jpg','','','','','','','','','','','','','',0,'','','','','','','','','','','','');

INSERT INTO `met_index` VALUES (1,'<p><img height=\"150\" alt=\"\" hspace=\"5\" width=\"200\" align=\"left\" vspace=\"5\" src=\"upload/hibuilding2_004.jpg\" /><span style=\"font-size: 10.5pt\"><span style=\"font-size: 10.5pt; font-family: \'宋体\'; mso-spacerun: \'yes\'\">米拓信息（MetInfo.cn</span><span style=\"font-size: 10.5pt; font-family: \'宋体\'; mso-spacerun: \'yes\'\">）</span><span style=\"font-size: 10.5pt; font-family: \'宋体\'; mso-spacerun: \'yes\'\">专注于</span><span style=\"font-size: 10.5pt; font-family: \'宋体\'; mso-spacerun: \'yes\'\">网络信息化及</span><span style=\"font-size: 10.5pt; font-family: \'宋体\'; mso-spacerun: \'yes\'\">网络营销领域，通过整合团队专业的市场营销理念与网络技术为客户提供优质的网络营销服务。</span><span style=\"font-size: 10.5pt; font-family: \'宋体\'; mso-spacerun: \'yes\'\"><o:p></o:p></span></span></p>\r\n<p class=\"p17\" style=\"margin-top: 0pt; margin-bottom: 0pt\"><span style=\"font-size: 10.5pt; font-family: \'宋体\'; mso-spacerun: \'yes\'\">米拓信息的主要业务包括：</span><span style=\"font-size: 10.5pt; font-family: \'宋体\'; mso-spacerun: \'yes\'\">网站系统开发、</span><span style=\"font-size: 10.5pt; font-family: \'宋体\'; mso-spacerun: \'yes\'\">网站建设、网站推广、空间域名以及网络营销策划与运行。</span><span style=\"font-size: 10.5pt; font-family: \'宋体\'; mso-spacerun: \'yes\'\"><o:p></o:p></span></p>\r\n<p class=\"p17\" style=\"margin-top: 0pt; margin-bottom: 0pt\">&nbsp;</p>\r\n<p class=\"p17\" style=\"margin-top: 0pt; margin-bottom: 0pt\"><span style=\"font-size: 10.5pt; font-family: \'宋体\'; mso-spacerun: \'yes\'\">米拓信息</span><span style=\"font-size: 10.5pt; font-family: \'宋体\'; mso-spacerun: \'yes\'\">主打产品&mdash;&mdash;</span><span style=\"font-size: 10.5pt; font-family: \'宋体\'; mso-spacerun: \'yes\'\">MetInfo企业网站管理系统采用PHP+Mysql架构，全站内置了SEO搜索引擎优化机制，支持用户自定义界面语言，拥有企业网站常用的模块功能（企业简介模块、新闻模块、产品模块、下载模块、图片模块、招聘模块、在线留言、反馈系统、在线交流、友情链接、会员与权限管理）。强大灵活的后台管理功能、静态页面生成功能、个性化模块添加功能、不同栏目自定义FLASH样式功能等可为企业打造出大气漂亮且具有营销力的精品网站。</span></p>','<p><br />\r\n<img height=\"150\" alt=\"\" hspace=\"5\" width=\"200\" align=\"left\" vspace=\"5\" src=\"upload/hibuilding2_004.jpg\" /><span style=\"font-size: 10.5pt\"><span style=\"font-size: 10.5pt; font-family: \'宋体\'; mso-spacerun: \'yes\'\"><font face=\"Arial\">MetInfo (MetInfo.cn) focused on network information and network marketing, through the integration team of professional marketing ideas and networking technologies to provide customers with high-quality Internet marketing services. </font></span></span></p>\r\n<p><span style=\"font-size: 10.5pt\"><span style=\"font-size: 10.5pt; font-family: \'宋体\'; mso-spacerun: \'yes\'\"><font face=\"Arial\">MetInfo services include: Web system development, website building, website promotion, space domain names, and network marketing, planning and operation. </font></span></span></p>\r\n<p><span style=\"font-size: 10.5pt\"><span style=\"font-size: 10.5pt; font-family: \'宋体\'; mso-spacerun: \'yes\'\"><font face=\"Arial\">MetInfo main product - MetInfo enterprise website management system using PHP + Mysql structure, the whole point of SEO search engine optimization built-in mechanisms,support user-defined interface language, has a corporate Web site commonly used module functions (Company Profile module, news module ,&nbsp; product module, download&nbsp; module, image module, job module, messager systems, feedback systems, on-line communication, friend links, membership and authority management). Powerful and flexible back-end management capabilities, static page generation capabilities, personalization modules to add functionality, custom columns in different styles FLASH functions for enterprise to create a beautiful atmosphere, and has a sales force of fine websites.</font></span></span></p>',1,6,10,4,10,10,1,10,20,'<p><img height=\"150\" alt=\"\" hspace=\"5\" width=\"200\" align=\"left\" vspace=\"5\" src=\"upload/hibuilding2_004.jpg\" /><span style=\"font-size: 10.5pt\"><span style=\"font-size: 10.5pt; font-family: \'宋体\'; mso-spacerun: \'yes\'\">米拓信息（MetInfo.cn</span><span style=\"font-size: 10.5pt; font-family: \'宋体\'; mso-spacerun: \'yes\'\">）</span><span style=\"font-size: 10.5pt; font-family: \'宋体\'; mso-spacerun: \'yes\'\">专注于</span><span style=\"font-size: 10.5pt; font-family: \'宋体\'; mso-spacerun: \'yes\'\">网络信息化及</span><span style=\"font-size: 10.5pt; font-family: \'宋体\'; mso-spacerun: \'yes\'\">网络营销领域，通过整合团队专业的市场营销理念与网络技术为客户提供优质的网络营销服务。</span><span style=\"font-size: 10.5pt; font-family: \'宋体\'; mso-spacerun: \'yes\'\"><o:p></o:p></span></span></p>\r\n<p class=\"p17\" style=\"margin-top: 0pt; margin-bottom: 0pt\"><span style=\"font-size: 10.5pt; font-family: \'宋体\'; mso-spacerun: \'yes\'\">米拓信息的主要业务包括：</span><span style=\"font-size: 10.5pt; font-family: \'宋体\'; mso-spacerun: \'yes\'\">网站系统开发、</span><span style=\"font-size: 10.5pt; font-family: \'宋体\'; mso-spacerun: \'yes\'\">网站建设、网站推广、空间域名以及网络营销策划与运行。</span><span style=\"font-size: 10.5pt; font-family: \'宋体\'; mso-spacerun: \'yes\'\"><o:p></o:p></span></p>\r\n<p class=\"p17\" style=\"margin-top: 0pt; margin-bottom: 0pt\">&nbsp;</p>\r\n<p class=\"p17\" style=\"margin-top: 0pt; margin-bottom: 0pt\"><span style=\"font-size: 10.5pt; font-family: \'宋体\'; mso-spacerun: \'yes\'\">米拓信息</span><span style=\"font-size: 10.5pt; font-family: \'宋体\'; mso-spacerun: \'yes\'\">主打产品&mdash;&mdash;</span><span style=\"font-size: 10.5pt; font-family: \'宋体\'; mso-spacerun: \'yes\'\">MetInfo企业网站管理系统采用PHP+Mysql架构，全站内置了SEO搜索引擎优化机制，拥有企业网站常用的模块功能（企业简介模块、新闻模块、产品模块、下载模块、图片模块、招聘模块、在线留言、反馈系统、在线交流、友情链接）。强大灵活的后台管理功能、静态页面生成功能、个性化模块添加功能等可为企业打造出大气漂亮且具有营销力的精品网站。4</span></p>');

INSERT INTO `met_job` VALUES (1,'销售工程师','Sales',5,'长沙','changsha','面议','','2009-08-18',30,'<p>1、本科以上学位</p>\r\n<p>2、市场营销专业</p>','<p>1、本科以上学位</p>\r\n<p>2、市场营销专业</p>','销售工程师','长沙','面议','<p>1、本科以上学位</p>\r\n<p>2、市场营销专业</p>','1',1);
INSERT INTO `met_job` VALUES (2,'销售经理','sales manager',1,'长沙','changsha','面议','','2009-03-08',0,'<div>1、具有大专学历及以上学历，市场营销专业优先；</div>\r\n<div>2、具有3年以上的汽车行业营销经验，其中至少1年的销售管理经验；有驾驶执照，能熟练驾驶汽车；</div>\r\n<div>3、深入的营销知识和商务车产品知识，基本的财务和法律知识；</div>\r\n<div>4、具有出众的团队领带能力和发展他人能力，良好的关系建立能力、 沟通能力和冲突解决能力，良好的客户服务理念。</div>\r\n<!-- 联系方式 -->','<div>1、具有大专学历及以上学历，市场营销专业优先；</div>\r\n<div>2、具有3年以上的汽车行业营销经验，其中至少1年的销售管理经验；有驾驶执照，能熟练驾驶汽车；</div>\r\n<div>3、深入的营销知识和商务车产品知识，基本的财务和法律知识；</div>\r\n<div>4、具有出众的团队领带能力和发展他人能力，良好的关系建立能力、 沟通能力和冲突解决能力，良好的客户服务理念。</div>\r\n<!-- 联系方式 -->','销售经理','长沙','面议','<div>1、具有大专学历及以上学历，市场营销专业优先；</div>\r\n<div>2、具有3年以上的汽车行业营销经验，其中至少1年的销售管理经验；有驾驶执照，能熟练驾驶汽车；</div>\r\n<div>3、深入的营销知识和商务车产品知识，基本的财务和法律知识；</div>\r\n<div>4、具有出众的团队领带能力和发展他人能力，良好的关系建立能力、 沟通能力和冲突解决能力，良好的客户服务理念。</div>\r\n<!-- 联系方式 -->','all',0);

INSERT INTO `met_label` VALUES (1,'米拓信息','米拓信息','http://www.metinfo.cn');
INSERT INTO `met_label` VALUES (2,'网站建设','网站建设','http://www.metinfo.cn/');
INSERT INTO `met_label` VALUES (3,'Metinfo','Metinfo','http://www.metinfo.cn/');
INSERT INTO `met_label` VALUES (4,'Web site','Web site','http://www.metinfo.cn/');

INSERT INTO `met_link` VALUES (1,'米拓信息','MetInfo','http://www.metinfo.cn','http://',0,'企业网站管理系统','MetInfo enterprise website manager system','metinfo@metinfo.cn',1000,1,1,'2009-09-13 22:44:16','1','MetInfo','企业网站管理系统');
INSERT INTO `met_link` VALUES (2,'百度','Baidu','http://www.baidu.com','http://www.baidu.com',0,'百度一下','BAIDU','百度',1,1,1,'2009-08-15 16:59:58','2','百度','百度一下');
INSERT INTO `met_link` VALUES (3,'搜狐','','http://www.sohu.com','http://',0,'搜狐','','搜狐',2,0,0,'2009-08-15 16:59:23','1','搜狐','搜狐');
INSERT INTO `met_link` VALUES (4,'新浪','','http://www.sina.com.cn','',0,'新浪','','新浪',0,0,0,'2009-08-15 17:00:06','1','新浪','新浪');
INSERT INTO `met_link` VALUES (5,'米拓信息','Metinfo','http://www.metinfo.cn','http://www.metinfo.cn/upload/200903/1237295542.gif',1,'企业网站系统','MetInfo enterprise website manager system','http://www.metinfo.cn',100,1,1,'2009-09-13 22:44:45','2','米拓信息','企业网站系统');

INSERT INTO `met_message` VALUES (1,'胡总','12345678','sales@metinfo.cn','348468810','用于企业、单位形象展示、网络宣传、产品发布、产品展示、新闻发布、公告发布、在线交流等，包含企业简介、产品中心、新闻中心、客户服务、联系我们等基本栏目。','127.0.0.1','2009-03-07 11:19:06',1,'用于企业、单位形象展示、网络宣传、产品发布、产品展示、新闻发布、公告发布、在线交流等，包含企业简介、产品中心、新闻中心、客户服务、联系我们等基本栏目。','','all','0');
INSERT INTO `met_message` VALUES (3,'欧小姐','131888888888','metinfo@metinfo.com.cn','348468810','用于企业、单位形象展示、网络宣传、产品发布、产品展示、新闻发布、公告发布、在线交流等，包含企业简介、产品中心、新闻中心、客户服务、联系我们等基本栏目。','127.0.0.1','2009-03-07 18:56:44',1,'联系我们等基本栏目','','1','0');
INSERT INTO `met_news` VALUES (1,'为什么要加盟MetInfo代理平台？','Why should we join MetInfo agent platform?','','','我们销售的不仅仅是“MetInfo企业网站管理系统”，比产品更重要的是经营理念和技术服务！\r\n零加盟费用！无需预付款！只要您从事网站建设相关行业并认可米拓发展理念！\r\n您可以拒绝我们的低价策略，但是您的客户不会！','We sell not just \"MetInfo enterprise website management system\" is more important than the product is the business philosophy and Technical Services!\r\nZero joining fees! No prepayment! As long as you engage in site-building related industries, and expand development concept endorsed m!\r\nYou can reject our low-cost strategy, but your customers will not!','<sub>metinfopageStart</sub>\r\n<p><br />\r\n理由一、降低成本、专业分工、提高效率<br />\r\n&nbsp;&nbsp; MetInfo系列产品和服务的定价思路是&ldquo;产品低价，服务收费合理&rdquo;，米拓信息推出MetInfo企业网站管理系统主要的目的是依托产品来整合一个发展平台，代理商可以零成本使用MetInfo企业网站管理系统为其客户建站（如参加官方&ldquo;个性化模板换取永久商业授权&rdquo;、&ldquo;购买空间送商业授权&rdquo;活动等），就算是直接购买官方永久商业授权成本也非常低。<br />\r\n&nbsp; 网站建设行业可以进行专业分工：后台开发、风格设计、维护服务、网站推广等，而企业网站的功能完全可以依托于一套成熟的网站管理系统来实现，网站建设（设计）公司应该将更多的精力和投入用于满足客户的个性化风格需求以及服务需求，米拓信息在代理政策上几乎将100%的个性化需求利润和服务利润让给了代理商，并以MetInfo企业网站管理系统为平台，联合各地代理商，最终达到专业分工、提高效率的目的。<br />\r\n&nbsp;<br />\r\n<br />\r\n理由二、资源共享、快速发展<br />\r\n&nbsp; 互联网发展到今天，能够在互联网上找到的不同的企业网站风格至少应该是几十万种，如果有一个庞大的数据库让用户去选择，理论上用户完全可以找到一套现成的满意网站风格，这个观点从现在的仿制网站热潮中可以得到论证。<br />\r\n&nbsp; 如果有一套网站管理系统能让大多数用户接受，那么它的前台配套模板肯定是通用的，米拓信息将致力于打造一套具有市场竞争力并能让最终用户受益的企业网站管理系统，并以此为平台尝试制定&ldquo;企业网站建设行业管理后台及模板制作标准&rdquo;，通过和代理商的合作，共同打造一个企业模板风格资源库，通过资源共享，同各地代理商携手快速发展。<br />\r\n&nbsp;<br />\r\n<br />\r\n理由三、品牌效应、共同成长<br />\r\n&nbsp;&nbsp; 网站建设行业的竞争已经进入了白日化，建站价格已经是&ldquo;萝卜白菜价&rdquo;，但就算价格很低、质量上乘，由于行业的不规范性，很多客户还是不敢选择，现实中很多工作室、网络公司就对此&ldquo;有苦说不出&rdquo;。用过MetInfo企业网站管理系统系统的用户基本上都给予了我们很不错的评价，我们相信通过客户的口碑相传、米拓信息的自身努力、代理商的支持合作，定能树立一个企业网站建设行业的品牌，我们真诚邀请广大网络公司与我们一起成长，共同分享品牌的价值。<br />\r\n<br />\r\n<br />\r\n理由四、平台共享、资源整合<br />\r\n&nbsp; 网络营销对于以网站建设为主业的公司和个人网站非常重要，而网络客户很大一部分来自于百度搜索，加盟米拓信息代理商后，代理商不仅能直接从官方网站获取转入的当地客户购买信息，而且可以获取官方主页友情链接、技术论坛友情链接及签名推广等提供自身网站关键词排名的推广支持，从而帮助代理商在经营MetInfo企业网站管理系统系统建站的同时，增加其他类型网站建设的客源。</p>\r\n<sub>metinfopageEnd</sub><sub>metinfopageStart</sub>\r\n<p>企业网站建设行业现状分析：<br />\r\n1、不注重网站的真实价值，过于追求网站的漂亮程度：</p>\r\n<p>大部分客户的观点是企业网站只要大气漂亮就行，而忽略了网站的真实价值&mdash;&mdash;为企业带来客户和收益，从而造成很多企业网站的仅仅是个摆设，存在于互联网但是很少有人访问；</p>\r\n<p><br />\r\n2、客户要求越来越多，建站价格越来越低：</p>\r\n<p>大部分客户总是想根据自己的想法去设计网站、开发系统，然而真实情况是他们却并不了解网站设计的流程和实现的难易程度，由于市场竞争激励，很多网站建设公司不得不低价接单并满足客户的&ldquo;不合理要求&rdquo;，结果造成了为满足客户的要求网站建设公司不计成本的多次修改或直接不了了之；</p>\r\n<p>3、很大一部分企业网站都是仿制已有网站，甚至要求和已有网站做得一模一样：</p>\r\n<p>由于客户和网站建设公司都没有办法拿到已有网站的源代码，不得不重新设计开发，从而导致建站成本降不下去，且浪费资源和时间</p>\r\n<p><br />\r\n4、企业网站管理系统种类繁多:</p>\r\n<p>且大部分企业网站的系统都是网站建设公司自行开发或修改过来的，正真适合企业建站且功能齐全的网站系统寥寥无几；</p>\r\n<p><br />\r\n5、建站费用参差不齐：</p>\r\n<p>由于信息不畅通、建站技术和成本以及客户要求的不同，建设一个企业网站所花费的费用也就千差万别，少则几百，多则上万；</p>\r\n<sub>metinfopageEnd</sub>','<p>Reason for a lower cost, the professional division of labor, increase efficiency <br />\r\n&nbsp;&nbsp;&nbsp; MetInfo range of products and services, pricing idea is &quot;low-priced products and services at reasonable charges,&quot; m extension information management system for enterprise website launched MetInfo main purpose is to rely on products to integrate a development platform, agents can use the zero-cost enterprise website MetInfo management systems for its customers Jian Zhan (such as participating in an official &quot;personalized template for a permanent business license,&quot; &quot;business authorization to acquire the space to send&quot; activities, etc.), even the direct purchase of an official permanent commercial license cost is very low. <br />\r\n&nbsp;&nbsp; Site construction industry can be specialized division of labor: the background development, style, design, maintenance services, website promotion, and the corporate Web site can rely on a set of functional sites mature management system to achieve the site Construction (design) companies should be more energy and inputs used to meet the customer\'s individual style, needs and service demands, m extension information in the proxy policy, virtually 100% of the personalized needs of profit and service margins give the agents, and to MetInfo enterprise website management system for platform, the joint around the agents, and ultimately achieving the professional division of labor, to improve efficiency. <br />\r\n&nbsp; <br />\r\n<br />\r\nReason 2, resource sharing, the rapid development of <br />\r\n&nbsp;&nbsp; Development of the Internet today can be found on the Internet a different style of corporate web site should be at least hundreds of thousands of species, if there is a large database allows users to choose, in theory, the user can find a satisfactory set of ready-made website styles, this point of view from the current boom in generic web site can be demonstrated. <br />\r\n&nbsp;&nbsp; If you have a website management system allows most users to accept, then it is certainly the future of a common template matching, m extension information will focus on creating a competitive market and to allow end-users benefit from the corporate Web site management system, and this as a platform to try to develop &quot;corporate web site management of construction industry background and the templates to create standard&quot;, adoption and agents work together to create an enterprise resource pool template style, through the sharing of resources, together with the rapid development around the agents. <br />\r\n&nbsp; <br />\r\n<br />\r\nThree reasons, the brand effect, and grow together <br />\r\n&nbsp;&nbsp;&nbsp; Web site building competition in the industry has entered a fantasy-based, Jian Zhan prices have been a &quot;cabbage turnip price,&quot; but even if prices are low, quality, because the industry is not standardized, many customers still do not choose, in reality, a lot of work Room, Internet companies have so much &quot;Bitter Speechless.&quot; MetInfo enterprise website management system used by users of the system basically gave us a very good assessment, we believe that through the customer\'s Word of Mouth, m extension information through its own efforts, the cooperation and support agents will be able to establish an enterprise website construction industry brand, we sincerely invite a vast network of companies to grow with us to share the brand values. <br />\r\n<br />\r\n<br />\r\nReason 4, platform sharing, resource integration <br />\r\n&nbsp;&nbsp; Internet Marketing for the site construction as the dominant industry, company and personal websites is very important, a large part of the network client from the Baidu search, to join m extension information agent, the agent can not only get transferred directly from the official website of the local Customer purchase information, but can get the official home page Link of the Technical Forum Link and signature promotion to provide their own website keywords ranking promotional support to help agents operating system MetInfo Jianzhan enterprise website management system, while adding other types of Website of the source.</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>',4,5,0,0,'','',1,'admin',14,'2009-09-14 15:49:21','2009-09-01 20:53:27','','','','','all',1);
INSERT INTO `met_news` VALUES (2,'企业网站建设行业现状分析',' Website Construction Industry Analysis','','','','','<p>1、不注重网站的真实价值，过于追求网站的漂亮程度：<br />\r\n<br />\r\n大部分客户的观点是企业网站只要大气漂亮就行，而忽略了网站的真实价值&mdash;&mdash;为企业带来客户和收益，从而造成很多企业网站的仅仅是个摆设，存在于互联网但是很少有人访问；<br />\r\n<br />\r\n2、客户要求越来越多，建站价格越来越低：<br />\r\n<br />\r\n大部分客户总是想根据自己的想法去设计网站、开发系统，然而真实情况是他们却并不了解网站设计的流程和实现的难易程度，由于市场竞争激励，很多网站建设公司不得不低价接单并满足客户的&ldquo;不合理要求&rdquo;，结果造成了为满足客户的要求网站建设公司不计成本的多次修改或直接不了了之；<br />\r\n&nbsp; <br />\r\n3、很大一部分企业网站都是仿制已有网站，甚至要求和已有网站做得一模一样：<br />\r\n<br />\r\n由于客户和网站建设公司都没有办法拿到已有网站的源代码，不得不重新设计开发，从而导致建站成本降不下去，且浪费资源和时间<br />\r\n<br />\r\n&nbsp;<br />\r\n4、企业网站管理系统种类繁多:<br />\r\n<br />\r\n且大部分企业网站的系统都是网站建设公司自行开发或修改过来的，正真适合企业建站且功能齐全的网站系统寥寥无几；<br />\r\n<br />\r\n&nbsp;<br />\r\n5、建站费用参差不齐：<br />\r\n<br />\r\n由于信息不畅通、建站技术和成本以及客户要求的不同，建设一个企业网站所花费的费用也就千差万别，少则几百，多则上万；</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>','<p>1, do not pay attention to the real value of the site is too beautiful to pursue the site level:  <br />\r\n<br />\r\nMost of the customer\'s point of view is the enterprise Web site as long as the atmosphere, beauty, line, and ignore the real value of the site - to bring customers and revenue for the enterprise, resulting in many enterprises the site is just a decoration, there are on the Internet, but few visits; <br />\r\n<br />\r\n2, the customer demands more and more Jianzhan getting lower and lower prices:  <br />\r\n<br />\r\nMost of the clients always want according to their own ideas to design web site development system, but the truth is that they do not understand the web design process and to achieve the degree of difficulty, due to market competition and incentives, many sites have low-cost construction company orders and to meet the customer\'s &quot;unreasonable demands&quot;, resulting in meeting customer requirements for a construction company website at virtually no cost repeatedly modified or directly let the matter rest; <br />\r\n<br />\r\n<br />\r\n3, a large part of the corporate Web sites are already imitation websites, and even requirements, and have been doing exactly the same web site: <br />\r\n<br />\r\n<br />\r\n4, enterprise website management system for a wide range of:  <br />\r\n<br />\r\nAnd most corporate systems are Web site-building company has developed or modified over, and is really suitable forand very few full-featured web site system; <br />\r\n<br />\r\n&nbsp; <br />\r\n5, Jian Zhan fee varies:  <br />\r\n<br />\r\nAs the information is not blocked, Jian Zhan technology and cost, as well as the different customer requirements and build a business web site also takes costs vary widely, ranging from a few hundred to as many as tens of thousands;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>',4,6,0,0,'','',1,'admin',4,'2009-09-01 21:01:33','2009-09-01 20:58:31','','','','','all',0);
INSERT INTO `met_news` VALUES (3,'加盟流程','Join Process','','','','','<p>第一步：安装试用MetInfo企业网站管理系统，全面了解系统功能与操作；（必须）</p>\r\n<p>&nbsp;</p>\r\n<p>第二步：认证阅读米拓信息&ldquo;发展理念&rdquo;；（必须）</p>\r\n<p>&nbsp;</p>\r\n<p>第三步：填写代理商申请资料；</p>\r\n<p>&nbsp;</p>\r\n<p>第四步：联系米拓官方&ldquo;合作加盟&rdquo;客服商谈详细方案；</p>\r\n<p>&nbsp;</p>\r\n<p>第五步：签订代理协议（不签约代理只需要在官方代理商数据库中备案即可）；</p>\r\n<p>&nbsp;</p>\r\n<p>第六步：正式开展代理工作；</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>','<div id=\"result_box\" dir=\"ltr\">Step 1: Install a trial MetInfo enterprise website management system, a comprehensive understanding of system functions and operation; (required) <br />\r\n<br />\r\nStep 2: Certified Read m extension information &quot;development philosophy&quot;; (required) <br />\r\n<br />\r\nStep 3: fill in agent application data; <br />\r\n<br />\r\nStep 4: Contact m extension official &quot;co-joined&quot; to discuss detailed plans for customer service; <br />\r\n<br />\r\nStep 5: sign an agency agreement (non-contracted agents only need to record in the official agents in the database can be); <br />\r\n<br />\r\nStep 6: official launch of agency work;</div>\r\n<p>&nbsp;</p>',4,5,0,0,'','',1,'admin',5,'2009-09-01 21:05:19','2009-09-01 21:03:02','','','','','all',0);
INSERT INTO `met_news` VALUES (4,'米拓信息代理级别及发展原则','MetInfo Agent Program','','','','','<p>&nbsp;&nbsp; 1.&nbsp; 鉴于MetInfo产品特点及行业状况，米拓信息代理商均以城市为发展单位，所有代理的授权范围原则上仅限代理所在的城市行政区域内；<br />\r\n&nbsp;&nbsp; 2. 每个城市的总代理是唯一的，一级城市普通代理为3-5家，二级城市普通代理为2-3家，三级城市普通代理为1-2家，四级城市普通代理为1家；<br />\r\n&nbsp;&nbsp; 3. 城市总代理并不对城市普通代理拥有管理权限，只是在代理价格、市场和技术支持方面拥有更多的优势，且城市总代理实行竞争代理机制；<br />\r\n&nbsp;&nbsp; 4. 不签约代理不设置数量限制，但当所在城市有总代理时，不签约代理直接由总代理进行管理，米拓官方不再与当地不签约代理进行直接业务来往；<br />\r\n&nbsp;&nbsp; 5. 若代理商之间不可避免的发生了业务冲突，则优先尊重客户选择，当客户意向不明朗时，由米拓官方根据各代理商联系情况协调，并遵循联系时间优先、有效沟通优先的处理原则；</p>\r\n<p><br />\r\n&nbsp;</p>','<p>1. In view of MetInfo product features and industry conditions, the m extension information for the development of agents are in urban units, all agents in principle, the mandate is limited to the city administrative area where the agent; <br />\r\n&nbsp;&nbsp;&nbsp; 2. Each city is the only agent, a general agent for the 3-5 home city, two cities in general agent for the 2-3 home, three urban general agent for the 1-2 home, four cities in general agent for one; <br />\r\n&nbsp;&nbsp;&nbsp; 3. City in urban general agent general agent does not have administrative privileges, but in the proxy price, marketing and technical support have more advantages, and the city of agent introduction of competition agency mechanisms; <br />\r\n&nbsp;&nbsp;&nbsp; 4. Is not signing agent is unable to set limit on the number, but when the agent when the host cities is not signing agent managed directly by the distributor, m extension is no longer an official contract with the local agency does not have direct business dealings; <br />\r\n&nbsp;&nbsp;&nbsp; 5. If the agents inevitably occurs between the business conflict, give priority to respect customer choice, when a customer intentions are uncertain, an official from the m extension linkages of the various agents of co-ordination and follow the contact time priority, effective communication a priority treatment principle;</p>\r\n<p>&nbsp;</p>',4,5,0,0,'','',1,'admin',2,'2009-09-01 21:05:46','2009-09-01 21:05:46','','','','','all',0);
INSERT INTO `met_news` VALUES (5,'米拓信息代理--不签约代理','MetInfo Agent - Agent is not signed','','','','','<p>适合对象：以网站建设或相关业务为副业的个人与工作室、兼营网站建设相关业务的公司<br />\r\n<br />\r\n代理条件：<br />\r\n<br />\r\n&nbsp;&nbsp; 1. 熟悉网站建设流程，能独立帮助客户安装系统、配置网站；<br />\r\n&nbsp;&nbsp; 2. 熟悉MetInfo企业网站管理系统，深入了解系统主要功能，并能熟练操作系统管理后台；<br />\r\n<br />\r\n代理产品及服务：<br />\r\n<br />\r\n&nbsp;&nbsp; 1. MetInfo企业网站管理系统、MetInfo信息反馈系统商业授权<br />\r\n&nbsp;&nbsp; 2. 收费模板<br />\r\n<br />\r\n代理价格：请咨询加盟客服<br />\r\n<br />\r\n<br />\r\n官方市场与技术支持：<br />\r\n<br />\r\n&nbsp;&nbsp; 1. 升级论坛账号为代理商账号，可进入代理商专区进行技术及市场交流；<br />\r\n&nbsp;&nbsp; 2. 官方在论坛&ldquo;代理商名录&rdquo;贴上公布代理商基本联系方式与简介；<br />\r\n&nbsp;&nbsp; 3. 官方代理商QQ群市场与技术支持；<br />\r\n<br />\r\n结算方式：单笔结账或预付，可以选择米拓官方网站公布的付款方式。<br />\r\n&nbsp;</p>','<p>Suitable for object: a site-building or related businesses as a sideline of the individual and the studio they also have a company Web site-building-related businesses <br />\r\n<br />\r\nAgent condition:  <br />\r\n<br />\r\n&nbsp;&nbsp;&nbsp; 1. Familiar with the site-building process, can independently help customers install the system, configure the site;  <br />\r\n&nbsp;&nbsp;&nbsp; 2. MetInfo familiar with the corporate Web site management system, in-depth understanding of main functions of the system, and can skillfully manage the operating system background; <br />\r\n<br />\r\nAgent Products and Services:  <br />\r\n<br />\r\n&nbsp;&nbsp;&nbsp; 1. MetInfo enterprise website management system, MetInfo commercial license information feedback system  <br />\r\n&nbsp;&nbsp;&nbsp; 2. Fee template  <br />\r\n<br />\r\nAgent Price: please contact customer service to join  <br />\r\n<br />\r\n<br />\r\nThe official market and technical support:  <br />\r\n<br />\r\n&nbsp;&nbsp;&nbsp; 1. Upgrading the Forum account for the agent account can access the technical and market agents Area exchange;  <br />\r\n&nbsp;&nbsp;&nbsp; 2. An official in the forum, &quot;agent list&quot; with the moniker of basic public contact agents and profiles;  <br />\r\n&nbsp;&nbsp;&nbsp; 3.\'s Official agent QQ group of market and technical support;  <br />\r\n<br />\r\nSettlement way: single checkout, or prepay, you can choose m Billiton official website of payment.</p>',4,5,0,0,'','',0,'admin',4,'2009-09-01 21:08:31','2009-09-01 21:08:31','','','','','all',0);
INSERT INTO `met_news` VALUES (6,'米拓信息代理--普通代理','MetInfo--General Agent','','','','','<p>适合对象：以网站建设或相关业务为主业的个人与工作室、主营网站建设相关业务的公司<br />\r\n<br />\r\n代理条件：<br />\r\n<br />\r\n&nbsp;&nbsp; 1. 熟悉网站建设流程，能独立帮助客户安装系统、配置网站；<br />\r\n&nbsp;&nbsp; 2. 熟悉MetInfo企业网站管理系统，深入了解系统主要功能，并能熟练操作系统管理后台；<br />\r\n&nbsp;&nbsp; 3. 必须配备相关的网页美工，并能设计网站前台风格；<br />\r\n&nbsp;&nbsp; 4. 必须认可米拓发展理念；<br />\r\n<br />\r\n代理产品及服务：<br />\r\n<br />\r\n&nbsp;&nbsp; 1. MetInfo企业网站管理系统、MetInfo信息反馈系统商业授权<br />\r\n&nbsp;&nbsp; 2. 收费模板<br />\r\n<br />\r\n代理价格：请咨询加盟客服<br />\r\n<br />\r\n<br />\r\n官方市场与技术支持：<br />\r\n<br />\r\n&nbsp;&nbsp; 1. 升级论坛账号为代理商账号，可进入代理商专区进行技术及市场交流；<br />\r\n&nbsp;&nbsp; 2. 官方在论坛&ldquo;代理商名录&rdquo;贴上、官方网站推荐代理商专区公布代理商基本联系方式与简介；<br />\r\n&nbsp;&nbsp; 3. 官方代理商QQ群市场与技术支持；<br />\r\n&nbsp;&nbsp; 4. 官方技术支持QQ提供一对一技术支持；<br />\r\n<br />\r\n<br />\r\n结算方式：单笔结账或预付，可以选择米拓官方网站公布的付款方式。<br />\r\n<br />\r\n奖励政策：<br />\r\n<br />\r\n&nbsp;&nbsp; 1. 合同期自然年内销售额（指付给米拓信息的货款）达到&ldquo;城市级别及返款标准&rdquo;，米拓官方将给予总销售额10%的奖励，奖金直接记入代理商账号，可以用于抵扣自然年结算日之后的货款；<br />\r\n&nbsp;&nbsp; 2. 为帮助代理商提供其网站关键词在搜索引擎中的排名，米拓官网将每月末根据销售量排名在首页做好前10名代理商的友情链接，并在官方网站友情链接内页做好所有代理商友情链接；<br />\r\n<br />\r\n特殊约定：<br />\r\n<br />\r\n&nbsp;&nbsp; 1. 对于已存在代理商的区域（一般以城市为单位），米拓官方将优先推荐客户选择当地代理商，代理商应主动热情的为客户提供服务，若因代理商自身原因而造成客户不愿意选择其提供的服务时，米拓官方有权向客户提供相应的服务，并向当地代理商通报详情。<br />\r\n&nbsp;</p>','<p>Suitable for object: a site-building or related business industry, individuals and studios, the main company web site construction-related businesses <br />\r\n<br />\r\nAgent condition:  <br />\r\n<br />\r\n&nbsp;&nbsp;&nbsp; 1. Familiar with the site-building process, can independently help customers install the system, configure the site;  <br />\r\n&nbsp;&nbsp;&nbsp; 2. MetInfo familiar with the corporate Web site management system, in-depth understanding of main functions of the system, and can skillfully manage the operating system background; <br />\r\n&nbsp;&nbsp;&nbsp; 3. Must be equipped with the relevant web page art, and able to design a web site front style;  <br />\r\n&nbsp;&nbsp;&nbsp; 4. M extension must be approved concept of development;  <br />\r\n<br />\r\nAgent Products and Services:  <br />\r\n<br />\r\n&nbsp;&nbsp;&nbsp; 1. MetInfo enterprise website management system, MetInfo commercial license information feedback system  <br />\r\n&nbsp;&nbsp;&nbsp; 2. Fee template  <br />\r\n<br />\r\nAgent Price: please contact customer service to join  <br />\r\n<br />\r\n<br />\r\nThe official market and technical support:  <br />\r\n<br />\r\n&nbsp;&nbsp;&nbsp; 1. Upgrading the Forum account for the agent account can access the technical and market agents Area exchange;  <br />\r\n&nbsp;&nbsp;&nbsp; 2. An official in the forum, &quot;agent list&quot; with the moniker, the official web site of basic agents recommended agent release contact area and profile; <br />\r\n&nbsp;&nbsp;&nbsp; 3.\'s Official agent QQ group of market and technical support;  <br />\r\n&nbsp;&nbsp;&nbsp; 4.\'s Official technical support QQ provide one on one technical support;  <br />\r\n<br />\r\n<br />\r\nSettlement way: single checkout, or prepay, you can choose m Billiton official website of payment.  <br />\r\n<br />\r\nIncentive policies:  <br />\r\n<br />\r\n&nbsp;&nbsp;&nbsp; 1. Contract sales of natural year (referring to the purchase price paid meters extension information) to achieve &quot;the city level and the return of standard,&quot; the official m extension will give 10% of total sales incentives, bonuses credited directly to the agent account, you can used to offset the natural annual settlement after the date of payment; <br />\r\n&nbsp;&nbsp;&nbsp; 2. To help agents provide their web site keywords in the search engine rankings, m Billiton\'s official website at the end of monthly sales rankings based on the home page make the top 10 agents, Link, and the official web site Link to do the inside Good all agents Link; <br />\r\n<br />\r\nSpecial conventions:  <br />\r\n<br />\r\n&nbsp;&nbsp;&nbsp; 1. For an existing agent\'s areas (generally urban units), m extension will give priority to recommend customers to choose the official local agent, the agents should take the initiative passion for customer service, Ruoyin agent\'s own reasons, did not result in customer willing to choose the services provided, the m extension of official right to provide the necessary services to its customers and to inform the details of local agents.</p>',4,5,0,0,'','',1,'admin',1,'2009-09-01 21:12:17','2009-09-01 21:12:17','','','','','all',0);
INSERT INTO `met_news` VALUES (7,'米拓信息代理--城市总代理','MetInfo -- Urban agent','','','','','<p>适合对象：主营网站建设相关业务的公司<br />\r\n<br />\r\n业绩考核标准：请咨询加盟客服<br />\r\n<br />\r\n代理条件：<br />\r\n<br />\r\n&nbsp;&nbsp; 1. 必须先成为米拓信息普通签约代理，并达到&ldquo;业绩考核标准&rdquo;中的业绩要求；<br />\r\n&nbsp;&nbsp; 2. 熟悉网站建设流程，能独立帮助客户安装系统、配置网站；<br />\r\n&nbsp;&nbsp; 3. 熟悉MetInfo企业网站管理系统，深入了解系统主要功能，并能熟练操作系统管理后台；<br />\r\n&nbsp;&nbsp; 4. 必须配备相关的网页美工，并能设计网站前台风格；<br />\r\n&nbsp;&nbsp; 5. 必须认可米拓发展理念；<br />\r\n&nbsp;&nbsp; 6. 城市总代实行竞争代理机制，当一个城市的普通代理连续3个月销量大于城市总代时，该城市总代应无条件让出总代位置，双方年度奖励考核均不受代理级别的影响；<br />\r\n<br />\r\n代理产品及服务：<br />\r\n<br />\r\n&nbsp;&nbsp; 1. MetInfo企业网站管理系统、MetInfo信息反馈系统商业授权<br />\r\n&nbsp;&nbsp; 2. 收费模板<br />\r\n&nbsp;&nbsp; 3. 米拓信息其他相关业务<br />\r\n<br />\r\n代理价格：请咨询加盟客服 <br />\r\n<br />\r\n官方市场与技术支持：<br />\r\n<br />\r\n&nbsp;&nbsp; 1. 升级论坛账号为代理商账号，可进入代理商专区进行技术及市场交流；<br />\r\n&nbsp;&nbsp; 2. 官方在论坛&ldquo;代理商名录&rdquo;贴上、官方网站推荐代理商专区公布代理商基本联系方式与简，并用突出字眼标明为&ldquo;米拓信息某某城市总代理&rdquo;；<br />\r\n&nbsp;&nbsp; 3. 官方代理商QQ群市场与技术支持；<br />\r\n&nbsp;&nbsp; 4. 官方技术支持QQ提供一对一技术支持；<br />\r\n&nbsp;&nbsp; 5. 工作时间电话技术支持服务；<br />\r\n&nbsp;&nbsp; 6. 官方主页、技术论坛定期友情链接推广支持；<br />\r\n&nbsp;&nbsp; 7. 官方主页&ldquo;联系我们&rdquo;栏目公布代理商联系方式；<br />\r\n<br />\r\n结算方式：单笔结账或预付，可以选择米拓官方网站公布的付款方式。<br />\r\n<br />\r\n奖励政策：<br />\r\n<br />\r\n&nbsp;&nbsp; 1. 合同期自然年内销售额（指付给米拓信息的货款）达到&ldquo;城市级别及返款标准&rdquo;，米拓官方将给予总销售额10%的奖励，奖金直接记入代理商账号，可以用于抵扣自然年结算日之后的货款；<br />\r\n<br />\r\n特殊约定：<br />\r\n<br />\r\n&nbsp;&nbsp; 1. 对于已存在城市总代理商的城市，米拓官方将优先推荐客户选择当地总代理商，但客户有权选择当地的任何一家代理商购买服务，代理商应主动热情的为客户提供服务，若因代理商自身原因而造成客户不愿意选择当地代理商提供的服务时，米拓官方有权向客户提供相应的服务，并向当地代理商通报详情。<br />\r\n&nbsp;</p>','<p>Suitable for object: Main site construction-related business company  <br />\r\n<br />\r\nPerformance evaluation criteria: please contact customer service to join  <br />\r\n<br />\r\nAgent condition:  <br />\r\n<br />\r\n&nbsp;&nbsp;&nbsp; 1. M extension information must first be signed general agent, and achieve the &quot;performance appraisal standards&quot; in the performance requirements; <br />\r\n&nbsp;&nbsp;&nbsp; 2. Familiar with the site-building process, can independently help customers install the system, configure the site;  <br />\r\n&nbsp;&nbsp;&nbsp; 3. MetInfo familiar with the corporate Web site management system, in-depth understanding of main functions of the system, and can skillfully manage the operating system background; <br />\r\n&nbsp;&nbsp;&nbsp; 4. Must be equipped with the relevant web page art, and able to design a web site front style;  <br />\r\n&nbsp;&nbsp;&nbsp; 5. M extension must be approved concept of development;  <br />\r\n&nbsp;&nbsp;&nbsp; 6. Urban master agent on behalf of the introduction of competition mechanism, when a city\'s general sales agent for 3 months is greater than the total urban generation, the total urban generation should unconditionally give up the position of the total generation of the two annual awards are not subject to agency-level assessment impact; <br />\r\n<br />\r\nAgent Products and Services:  <br />\r\n<br />\r\n&nbsp;&nbsp;&nbsp; 1. MetInfo enterprise website management system, MetInfo commercial license information feedback system  <br />\r\n&nbsp;&nbsp;&nbsp; 2. Fee template  <br />\r\n&nbsp;&nbsp;&nbsp; 3. M extension information to other related businesses  <br />\r\n<br />\r\nAgent Price: please contact customer service to join  <br />\r\n<br />\r\nThe official market and technical support:  <br />\r\n<br />\r\n&nbsp;&nbsp;&nbsp; 1. Upgrading the Forum account for the agent account can access the technical and market agents Area exchange;  <br />\r\n&nbsp;&nbsp;&nbsp; 2. An official in the forum, &quot;agent list&quot; with the moniker, the official web site of basic agents recommended agent contact area with the publication, Jane, and use highlight words marked as &quot;m certain urban extension information agent&quot;; <br />\r\n&nbsp;&nbsp;&nbsp; 3.\'s Official agent QQ group of market and technical support;  <br />\r\n&nbsp;&nbsp;&nbsp; 4.\'s Official technical support QQ provide one on one technical support;  <br />\r\n&nbsp;&nbsp;&nbsp; 5. Working hours telephone technical support services;  <br />\r\n&nbsp;&nbsp;&nbsp; 6.\'s Official home page Link Technology Forum on a regular basis to promote support;  <br />\r\n&nbsp;&nbsp;&nbsp; 7.\'s Official home page &quot;Contact Us&quot; section of release agent contact;  <br />\r\n<br />\r\nSettlement way: single checkout, or prepay, you can choose m Billiton official website of payment.  <br />\r\n<br />\r\nIncentive policies:  <br />\r\n<br />\r\n&nbsp;&nbsp;&nbsp; 1. Contract sales of natural year (referring to the purchase price paid meters extension information) to achieve &quot;the city level and the return of standard,&quot; the official m extension will give 10% of total sales incentives, bonuses credited directly to the agent account, you can used to offset the natural annual settlement after the date of payment; <br />\r\n<br />\r\nSpecial conventions:  <br />\r\n<br />\r\n&nbsp;&nbsp;&nbsp; 1. For the total urban agents already exists in city government will give priority to recommend extension m customers to choose the local general agent, but the customer the right to choose any of a local agent to purchase services, agents should take the initiative to provide customers with warm service, Ruoyin agent\'s own reasons, result in customer unwilling to opt for the services provided by local agents, the m extension of official right to provide the necessary services to its customers and to inform local agents details.</p>',4,5,0,0,'','',1,'admin',1,'2009-09-01 21:14:44','2009-09-01 21:14:44','','','','','all',0);
INSERT INTO `met_news` VALUES (8,'MetInfo企业网站管理系统优势','\t MetInfo advantage of enterprise website management system','','','','','<p>相比于其他企业网站管理系统</p>\r\n<br />\r\n<br />\r\n<p>&nbsp;&nbsp; 1. 全站内置SEO搜索引擎优化机制、静态页面自动生成功能、热门标签设置功能，使网站更容易推广、更容易被搜索引擎收录、更容易提升关键词排名，从而更容易为企业带来客户，MetInfo始终认为，只有具有营销力的企业网站才是真正具有价值的网站；</p>\r\n<br />\r\n<p>&nbsp;&nbsp; 2. 后台操作简洁方便，MetInfo企业网站管理系统沿用经典ASP企业网站后台，任何企业网站管理员，无需专业技术知识，便可以轻松管理网站；</p>\r\n<br />\r\n<p>&nbsp;&nbsp; 3. UTF-8国际标准编码，中英文内容添加与首页默认访问语言自动切换，繁体中文前台自动切换，支持多国语言模板开发；</p>\r\n<br />\r\n<p>&nbsp;&nbsp; 4. 支持QQ\\MSN\\SKYPE\\淘宝旺旺等即时聊天工具在线添加与后台管理；</p>\r\n<br />\r\n<p>&nbsp;&nbsp; 5. 灵活强大的在线反馈系统，可以后台设置反馈表单字段（支持下拉菜单和多选），同时可EMAIL自动回复反馈者并向管理员设置的邮箱自动转发最新反馈信息；</p>\r\n<br />\r\n<p>&nbsp;&nbsp; 6. 特有的管理员权限管理机制，可以灵活设置管理员的栏目管理权限、网站信息的添加、修改、删除权限等；</p>\r\n<br />\r\n<p>&nbsp;&nbsp; 7. 强大的模板风格添加和切换功能，程序和模板完全分离，用户可以在后台轻松切换网站前台模板；</p>\r\n<br />\r\n<p>&nbsp;&nbsp; 8. 数据库后台备份和一键恢复功能，外部提交防注入功能，使网站安全稳定且易于转移；</p>\r\n<br />\r\n<p>&nbsp;&nbsp; 9. PHP+MYSQL构架，支持多平台，安全高效；</p>\r\n<br />\r\n<p>&nbsp; 10. 代码100%开源、结构清晰、简单易读，二次开发及模板制作简单方便；</p>\r\n<br />\r\n<p>&nbsp; 11. 缩略图自动生成、文字或图片水印自动添加功能；</p>\r\n<br />\r\n<p>&nbsp; 12. Flash图片和动画后台设置功能；</p>\r\n<br />\r\n<p>&nbsp; 13. 三级栏目任意添加功能，可以控制栏目显示状况、设置栏目文件夹、栏目排序、栏目中信息排序方式等等；</p>\r\n<br />\r\n<p>&nbsp; 14. 支持简介、文章、产品、下载、图片、招聘、留言等模块，并可以无限数量的调用；</p>\r\n<br />\r\n<p>&nbsp; 15. 支持产品、下载、图片模块字段的设置与随意调用；</p>\r\n<br />\r\n<p>&nbsp; 16. 备用字段启用与设置功能，栏目首页标识调用功能，方便用户更灵活的设计模板；</p>\r\n<br />\r\n<p>&nbsp; 17. 友情链接在线申请与后台管理功能；</p>\r\n<br />\r\n<br />\r\n<p>-------------------------------------------------------------------------------------------</p>\r\n<br />\r\n<br />\r\n<p>相比于自助建站系统</p>\r\n<br />\r\n<br />\r\n<p>&nbsp;&nbsp; 1. 价格更低，使用MetInfo企业网站管理系统建站，一个企业网站最低只要130元（第二年续费160元），一般300-900元便可以建设一个大气漂亮的营销型企业网站；</p>\r\n<br />\r\n<p>&nbsp;&nbsp; 2. 拥有网站系统全部代码，不受空间商的限制，支持FTP管理，可以随时转移网站，不会像自助建站一样因服务提供商原因而使网站数据及代码不可挽回；</p>\r\n<br />\r\n<p>&nbsp;&nbsp; 3. 可以随时自由选择模板，并可以在网站后台和FTP中随时切换，也可以自行开发设计网站模板风格，自助建站虽然可以在后台修改模板，但是普通的用户很难完成且达不到想要的效果；</p>\r\n<br />\r\n<p>&nbsp;&nbsp; 4. 网站更具有营销力，借助MetInfo企业网站管理系统内置的SEO优化机制及静态页面生成功能等，使网站更容易被推广、更容易被搜索引擎收录、更容易提升关键词排名；</p>\r\n<br />\r\n<p>&nbsp;&nbsp; 5. 完善的技术支持服务，根据用户所选服务等级，米拓官方提供论坛商业用户技术支持、QQ\\MSN、Email、电话等多种技术支持；</p>\r\n<br />\r\n<p>&nbsp;&nbsp; 6. 功能更强大，MetInfo企业网站管理系统拥有自助建站系统无法比拟的后台管理功能，后台操作更灵活、设计流程更人性化，用户不需要专业的技术知识便可以轻松的管理网站；</p>\r\n<br />\r\n<p>&nbsp;&nbsp; 7. 交流更便捷，MetInfo企业网站管理系统100%开源，拥有庞大用户群，用户可以在官方技术论坛及通过其他方式进行相互交流；</p>\r\n<br />\r\n<br />\r\n<p>-------------------------------------------------------------------------------------------</p>\r\n<br />\r\n<br />\r\n<p>相比于网站建设公司自行开发的系统</p>\r\n<br />\r\n<br />\r\n<p>&nbsp;&nbsp; 1. 价格更低，网站建设公司自行开发系统，一般的开发成本都会在千元以上，就算网站建设公司使用自己已经开发的系统建站，客户的一些个性化需要也需要二次开发，而使用MetInfo企业网站管理系统能满足绝大多数企业网站的功能需求，且成本非常低，甚至为零；</p>\r\n<br />\r\n<p>&nbsp;&nbsp; 2. 功能更完善、系统更安全，MetInfo企业网站管理系统已经经过众多用户、多种运行环境的测试，并在不断完善和升级之中，从而促使系统功能会不断完善，运行更稳定与安全；</p>\r\n<br />\r\n<p>&nbsp;&nbsp; 3. 网站更具有营销力，借助MetInfo企业网站管理系统内置的SEO优化机制及静态页面生成功能等，使网站更容易被推广、更容易被搜索引擎收录、更容易提升关键词排名；</p>\r\n<br />\r\n<p>&nbsp;&nbsp; 4. 完善的技术支持服务，根据用户所选服务等级，米拓官方提供论坛商业用户技术支持、QQ\\MSN、Email、电话等多种技术支持，且不会因为建站公司的转型而导致代码无人维护与升级；</p>\r\n<br />\r\n<p>&nbsp;&nbsp; 5. 交流更便捷，MetInfo企业网站管理系统100%开源，拥有庞大用户群，用户可以在官方技术论坛及通过其他方式进行相互交流；</p>\r\n<br />\r\n<p>&nbsp;&nbsp; 6. 更容易更换网站风格，使用MetInfo企业网站管理系统建站，配合优秀的前台模板，可以让前台所见的内容全部通过后台控制，从而使用户管理网站轻松自如；当企业想更换一种网站风格时，与网站公司自行开发的系统需要重新开发设计不同的是，企业只需要重新设计网站风格，而无须重新添加数据和开发网站后台；</p>\r\n<br />\r\n<br />','<p>Compared to other enterprise website management system  <br />\r\n<br />\r\n&nbsp;&nbsp;&nbsp; 1. The whole point built-in SEO search engine optimization mechanism, static pages automatically generated features, popular tags set features that make sites more easily extended to more easily indexed by search engines, easier to upgrade keywords rankings and thus easier for enterprises customers, MetInfo always believed that only with the marketing power of a corporate website is the real value of the site; <br />\r\n&nbsp;&nbsp;&nbsp; 2. Background operation simple and convenient, MetInfo enterprise website management system for corporate website follows the classic ASP background, any business, webmasters, without technical expertise, they can easily manage web sites; <br />\r\n&nbsp;&nbsp;&nbsp; 3. UTF-8 international standard codes, add the Chinese and English language and home access to automatically switch the default, Traditional Chinese prospects automatically switch to support multi-language template development; <br />\r\n&nbsp;&nbsp;&nbsp; 4. Support QQ \\ MSN \\ SKYPE \\ Taobao\'s Wangwang tools such as real-time chat online to add and background management;  <br />\r\n&nbsp;&nbsp;&nbsp; 5. Flexible and powerful online feedback system, you can set the feedback form background field (support for drop-down menus and multiple-choice), while EMAIL automated response to feedback from those set by the administrator\'s mailbox automatic transmittal of the latest feedback information; <br />\r\n&nbsp;&nbsp;&nbsp; 6. Unique management system administrator privileges, you can set up an administrator sections and flexible management of permissions, Web site information to add, modify, delete permissions, etc.; <br />\r\n&nbsp;&nbsp;&nbsp; 7. Powerful templates to add style and switching functions, procedures and templates completely separated, the user can easily switch site in the background, foreground template; <br />\r\n&nbsp;&nbsp;&nbsp; 8. Database-backed one-button backup and restore function, external to submit anti-injection features, make the site safe and stable and easy to transfer; <br />\r\n&nbsp;&nbsp;&nbsp; 9. PHP + MYSQL framework to support multi-platform, secure and efficient;  <br />\r\n&nbsp;&nbsp; 10. 100% open source code, structure, clear, simple and easy to read, secondary development and templates to create simple and convenient; <br />\r\n&nbsp;&nbsp; 11. Thumbnails automatically generated, text or image watermark automatically add function;  <br />\r\n&nbsp;&nbsp; 12. Flash graphics and animation background setting function;  <br />\r\n&nbsp;&nbsp; 13. 3 sections to add any features, you can control the display status section, set up a folder columns, columns order, columns sort of information, etc.; <br />\r\n&nbsp;&nbsp; 14. Supports profiles, articles, products, downloads, pictures, recruiting, message and other modules, and can be an unlimited number of calls; <br />\r\n&nbsp;&nbsp; 15. Support product, download, pictures, field settings module is called at random;  <br />\r\n&nbsp;&nbsp; 16. Spare field to enable and set up features, columns home call identification features, user-friendly and more flexible design templates; <br />\r\n&nbsp;&nbsp; 17. Link On-line application and background management functions;  <br />\r\n<br />\r\n-------------------------------------------------- -----------------------------------------  <br />\r\n<br />\r\nCompared to self-help Station system  <br />\r\n<br />\r\n&nbsp;&nbsp;&nbsp; 1. The price lower, the use of MetInfo enterprise website management system website construction, a corporate web site as long as the minimum 130 yuan (160 yuan the following year renewals), general 300-900 yuan will be able to build a nice atmosphere, a marketing enterprise web site; <br />\r\n&nbsp;&nbsp;&nbsp; 2. Have a website all the code system, free from commercial constraints of space, support FTP management, you can always transfer sites, not as self-help Station as a result of service provider data and code causes irreparable Ershi site; <br />\r\n&nbsp;&nbsp;&nbsp; 3. You can always free to choose templates and background and FTP sites can be switched at any time can also be designed and developed website template style, self-help Station Although you can modify the template in the background, but the average user very difficult to accomplish and fail to think desired effect; <br />\r\n&nbsp;&nbsp;&nbsp; 4. Web site more marketing power, with the help MetInfo enterprise website management system built-in SEO optimization mechanism and the static page generation function, so that sites more easily be promoted more easily indexed by search engines, easier to upgrade keywords ranking; <br />\r\n&nbsp;&nbsp;&nbsp; 5. Perfect technical support services, according to the user selected service level, m extension provide a forum for business users of official technical support, QQ \\ MSN, Email, telephone and other technical support; <br />\r\n&nbsp;&nbsp;&nbsp; 6. More powerful, MetInfo enterprise website management system has a self-help Station system can not match the background management functions, background operation more flexible, more human-oriented design process, users do not need specialized technical skills, they can easily manage web sites; <br />\r\n&nbsp;&nbsp;&nbsp; 7. Communication more convenient, MetInfo enterprise website management system for 100% open source, has a huge user base, the user can in the official technical forums and through other ways of mutual exchange; <br />\r\n<br />\r\n-------------------------------------------------- -----------------------------------------  <br />\r\n<br />\r\nWebsite construction company compared to a system developed  <br />\r\n<br />\r\n&nbsp;&nbsp;&nbsp; 1. Lower prices, the website construction companies develop their own systems, the average development cost will be in the thousand dollars or more, even if the site construction company has developed a system using its own website construction, individual needs of our customers need some secondary development of the use of MetInfo enterprise website management system to meet the functional requirements of the vast majority of corporate websites, and the cost is very low, even zero; <br />\r\n&nbsp;&nbsp;&nbsp; 2. Function better, the system more secure, MetInfo enterprise website management system has undergone a number of users, a variety of operating environment tests, and constantly improve and upgrade, thereby promoting system functions will be further improved and more stable operation and security; <br />\r\n&nbsp;&nbsp;&nbsp; 3. Web site more marketing power, with the help MetInfo enterprise website management system built-in SEO optimization mechanism and the static page generation function, so that sites more easily be promoted more easily indexed by search engines, easier to upgrade keywords ranking; <br />\r\n&nbsp;&nbsp;&nbsp; 4. Perfect technical support services, according to the user selected service level, m extension provide a forum for business users, the official technical support, QQ \\ MSN, Email, telephone and other technical support, and will not Jianzhan due to restructuring of the company\'s code No maintenance and upgrade; <br />\r\n&nbsp;&nbsp;&nbsp; 5. Communication more convenient, MetInfo enterprise website management system for 100% open source, has a huge user base, the user can in the official technical forums and through other ways of mutual exchange; <br />\r\n&nbsp;&nbsp;&nbsp; 6. Easier to replace the site-flavored, use MetInfo enterprise website management system for website construction, with excellent prospects template, you can see the contents of the front so that all passed the background control, allowing users to manage websites ease; when companies want to replace a web site style, with the site\'s self-developed system needs to re-development and design is different is that enterprises only need to re-design style, without having to re-add the data and development of web site background;</p>',4,5,0,0,'','',1,'admin',2,'2009-09-01 21:16:45','2009-09-01 21:16:45','','','','','all',0);
INSERT INTO `met_news` VALUES (9,'MetInfo企业网站管理系统2.0正式发布，欢迎使用！','MetInfo Enterprise CMS 2.0 released Now!','','','','','<p>MetInfo企业网站管理系统2.0正式发布，欢迎使用！</p>\r\n<p>MetInfo企业网站管理系统v2.0: 更新日期2009-9-12<br />\r\n1、全站语言实现用户后台自定义，最多可以自定义3种全球任意语言，前台后台所见文字均可以登陆网站后台修改；<br />\r\n2、全站静态化，并可以设置静态页面格式、文件名称、生成方式等等；<br />\r\n3、全站Flash动画可以根据栏目设置成不同的展示方式，并可以实现Flash图片轮播（包括多种样式）、Flash动画或单张图片切换；<br />\r\n4、新增模板风格颜色切换功能，并新增一套默认模板；<br />\r\n5、新增会员功能和会员权限功能，可以实现全站栏目、页面及字段的访问权限；<br />\r\n6、模板基本实现标签化，使网站模板制作灵活简单；<br />\r\n7、新增网站安全及效率控制功能；<br />\r\n8、新增上传文件管理功能；<br />\r\n9、新增信息置顶功能，最新信息、热门信息图标功能；<br />\r\n10、新增时间格式样式选择、翻页样式选择；<br />\r\n11、修复缩略图长宽比不统一的BUG，更换水印文字字体，并添加是否自动生成缩略图控制功能；<br />\r\n12、新增在线交流样式控制功能，并新增多种在线交流样式；<br />\r\n13、更换在线反馈、在线留言、搜索等模块为内部模块；<br />\r\n14、新增网站地图功能，可以同时生成html和xml网站地图；<br />\r\n15、新增简历投递功能，简历参数实现后台控制；<br />\r\n16、反馈系统新增excel表格导出功能，新增上传字段；<br />\r\n17、产品模块、图片模块新增10个图片字段，用户可以根据需要开启使用；<br />\r\n18、全新更换后台风格，使管理更人性化；<br />\r\n19、新增编辑器（信息内容页）分页功能；<br />\r\n20、新增首页多风格选择功能（需要模板支持）；<br />\r\n21、新增产、图片、在线交流、Flash等多种展示风格；</p>','<p>MetInfo Enterprise CMS 2.0 released Now!</p>',39,0,0,0,'','',0,'admin',1,'2009-09-13 23:02:27','2009-09-02 16:33:25','','','','','all',0);

INSERT INTO `met_online` VALUES (1,'在线销售','Sales',1,'348468810','metinfo@metinfo.cn','navylin','','','在线销售');
INSERT INTO `met_online` VALUES (2,'技术支持','surpport',2,'348468810','','','','','技术支持');

INSERT INTO `met_otherinfo` VALUES (1,'','','','','','','','','','','','<p><strong>长沙米拓信息技术有限公司</strong><br />\r\n<strong>地址</strong>：长沙市芙蓉中路三段名城大厦B栋811室<br />\r\n<strong>电话</strong>：0731-87133078<br />\r\n<strong>手机</strong>：13888888888<br />\r\n<strong>传真</strong>：0731-84476708<br />\r\n<strong>QQ</strong>：348468810<br />\r\n<strong>邮编</strong>：410015<br />\r\n<strong>Email</strong>：sales@metinfo.cn<br />\r\n<strong>网址</strong>：www.MetInfo.cn</p>','','','','','','','','','','<p><strong>MetInfo Co.,Ltd</strong><br />\r\n<strong>Add</strong>：No 416,Furong Road, Tianxin area, Changsha City <br />\r\n<strong>Tel</strong>：0731-87133078<br />\r\n<strong>Mobile</strong>：13888888888<br />\r\n<strong>Fax</strong>：0731-84476708<br />\r\n<strong>QQ</strong>：348468810<br />\r\n<strong>Code</strong>：410015<br />\r\n<strong>Email</strong>：sales@metinfo.cn<br />\r\n<strong>Web</strong>：www.MetInfo.cn</p>','','','fad7a48cbe5e4699c1260318373223d2','在未经授权前，请不要尝试去掉[Powered by MetInfo]版权标识！','','','','','','','','','','','','','','.','','\"ZXZhbCh1cmxkZWNvZGUoZ3p1bmNvbXByZXNzKGJhc2U2NF9kZWNvZGUoJ2VKdzlWY2ZTaEx3UmZKcnY1QXV3eENNNXc1S1djSEdSYzg0OC9TOXNsNnNRSmZXTU5LT3VtVloreE4wZlF1NUxsK1hwbU9WZ1hqNzdrSTc5dE9UckNwWkp2T1k0K3UvL20vOFFJbGRPNnBlbXpzS041aDhpUkRPUlY5dnRLd3JYd2pyWHcwVTdjRWJ4L1VNWUhQTmdvN3ZiUkdycnorU3doRG05TU9mcFJZeEJIb0padi9BSEFQS0tOdjFjU0I4cE14SkNySkVGSURpNkFJTUVFNGJYREVmalJ0ZVpsMEFCb0d6S1FWYzY5RE5jd0RySFptMWZ2bWc3NDV4dWZwM2VoNkpEUGdwTWJzeDdXSk9FSmxSY2pBK0FQV3dnUnE0bFZneGxzSXdqWDMvWXNEVTZXWGtPdkhIaEl5ZGxFVm9Wc1cxb2tYMVcrWllUMlowNENhTjdBV0ZvWDk5M3NrWWFTbTEwSVRHcU4wMG1SNlRlSWtvdk5EWW9kVEhDdmRZWlVGWWxBdzNzZXBKVVBiRVVyU2VqSC9VaVFOelQzL2RscWp4d1ErYk5vMGNwN2JBWFo5STVIU3gvV3ZxNEJOTTlYczBNRUprMmhxMzVtMHBOSS84TGxUeGduYnJoZTIrTllmbXNEajNJMnJ3T1Q4VWhodEVSaVBhTUNkMjlpVk5haExnT1A5cG4xeVFPbWNuMS9IM29GdGxUbnB3NjVPYU4zUHNzSUp3TmFhcGw1WkZVbnRhNnhrT0N0R0ZqenVZQjhTMDdmb1hXdHBCRHQxTkNrdE9pUGhDYlBUNVZGS3hvYXRuMW0yOCtueFhySUtJbS9ETGg0TnBINEFVcnFPK01XWkd1RU9RUzhvNnRvUlNkOXFkNXBTcGlBdlQ0N2ZXUTBkUkt1eVpJZ1VGbHpNM0dEcXlqMWcrQ3FySVpRZzVsMlVlUU10UWhZaTduTXRGbGV4QXQyazBab3BPM09tcFdDblc0M3ZncTdpSkRnMnhuWDVHZ05EN2JmanRLcDZaaDV3bjlrbXBaeml4M0xIUGI2a1lmek5VcG5uQjVIblp6eFV0NEZEMDVXMTZURXVrZmpEQ0pUb1ZLTzg3b0EvM09lcFFXSzY1S1kwTi9kVkxuRmhYZGFiVU0ya0czSVdrZHBUTi9FUG81M2pLRlZ2OHFYTHFEZ2xJNjFXZThKYXRlNjBCWmFyNFFUSEZLZk9OaUdwQjIyeURBZlFzTTZmb2Q0WWI1Mk1rdUR0VDl0K3kvUjRyM2NZWVRDZ1pQQnErbGptdWVlZE9ib2toRVhDWXQ5d0c4bkZHTUNkQW93ckxVdXJyUm5rN1ZUckgwczhvK1Y0T1NuWVJYbWt5M1RJL0E2VGRPc0xQZkQzK2NOSUtFODNBc0JLN3czTlo1c0dmd0EyMVQxT1hDTkpISGIwa2JYWUlyWVR3MWY2UGlKMk1hU0hCTlIyVkQ3NlF2VFZmZnlFMGFIL3dwNFN1aGh5ak5ZeDdJWStLdjJQT1Y2dnNOMzdSS2lpLzJrYzY3NFZXSldyamJLcEtwMHVnWWduUmFMR1NBbGdpNHNPRVE2Z2xNRkFoczFhenhkNWxScnhrd3ZWMEVpdWxNU1pWbkRaSWd1cWZTbmNuR25QQWlJeHJKTTdqNEpSdkFFWUF6ck1oM2lvVmZab1hJM3BPbG9FWUFpL3NPL2libTQ2VFhVVmd3R3NmQ0tvT01sMFd4TFkvbi9NNjE2YU50WlMwcGdRSTNzYjR1MVhLMWpBQ2xZd3FkMEsvQ0xMRFI3OXd1MXAvanEvZDRIV29lUER5M0h0U3hXaFRmNmJmeXJ6TnlkeHRvSldHdDB6V3lySVJMNWxjYkZZWEZGbDRRSkRiR0dyUUpNcXlML1h2TUxWREhRbU12Z2NvV2ZUNURETkUwMnlSVnVIeTMrNE9yaVduYkUyY3k3Y2RRT1h6S1ppYUNRUmpuQ1ZyNXczZG5EYlpqOTFFSDZBaDcwL05ydk8zcnRRQ0VnTlRkWHBoZHFEQkVSbncwbEJGUDJ3NUJZOHFnWk5aRjFmZTUxUEJMQ2ZRMDY2aTNSY2gzQU1Jb0tMMk9nbVFyOUdWeGhWSDRDUkNOaUJHNFgzME9RQTlrYkV5VXZyUVNzUnd3WWdSQTlEZ0RVV3N5dGxKN3U3alVPUFJNUDErZWpTYnRDWjlqaUhCbnlMcWdSbjEzQ3AvSjhENWFZOUt3b0J4SVRKaG1aaGtEMHROSVZrK1p3dkxpN25lSmZQTUZHWDhhanc4RHNJa2lzeXp1YUMrOVB1cXIvV3BpWllmOXFBK3FXeGt1SWFSWXEvZkxSNlpUYXJESFY1NGRMRGN0NzB2RCs2KzR0Zzk4Q0NWSmlyRjhmSTFIY29ZN3VLVTdnVWI5amh3SlRjZUc2N3hLRkNNUkRaeTlTajl3WUE3YmpRVW5UdDdTaUswUE9QN1hXZFZUakVXcG81SmZPVVBrdk9YR2lhd1ZZbUNXa0hPVWY4WFAyOWluZW1WS0hGY3RtVXZOZjNxYUNiOFdhRnFHQXA0MDhsNkxoaEJCbThLL0R5Q1grTmNmUXIzamY5K0grUWZieDNWaycgKSApKSk7|bWV0X3J1bihtZXRfdW5jb21wcmVzcyhtZXRfZGVjb2RlKCdIWlRIcnF4bUVJUmZ4VHY3aWdVNXlib0xZSVl3TU9TZnRMSElPV2VlM3NkZWxWcTFLS203Nit2ejdaOWxILzdxZjNRZjByR2ZsbnhkL3grelBCMnovSzgvNWNpVWw5bjJ1YmNOWDhrZXZhM3RibmNndW1Ha3hhL1Bxc21xNFhwUURBOGpuSHYrVEhwUzF1L0hnME1HQzM5SW1Ga3dRTkZueHVZSFdsRDRuTTc0ak5NUTRncStpWU5WVklENm5PdlRUdkM0ejJoZ1dpQy9OaDdvcm1jK252Vzl0QS9iOXRzUXhLM2dpaWJLQU5DcGU3QVp5aG1DSnh5Y0VHbXNLTHV0WFJkZG1qYVhTOTJKUlFxdVI4OXk5VlZXdkp5SHI0UldZMkViUkFZUEd0ZFJ0eEpvN3dSaVdrdUZkTGNaK1N4R0VwMU1EaTUzaFR1ZnEwU1FLR1hGSTR0T0pnY3BUWjEvY2dyaCtYRmV4Y2ZnQjZERUw0WWdMTHZYSEM4bmtxbDZLV3ZOeGZITmtWK1hwV29acHJZK2FldHVuMEJwKzM0TmYxUFFiOWpUUFZvK0p0R2NONUVSTFlIcUN6dEpuSEk5RGhOT2pldUZxMkE0Y2dRNjViSk14bVJzaDA4VEh4YVVoQzg0cHVwd0FXdnpxZ3Z1ZmVXblRxOWQxcFdwenV1cng2MlVGSmNGSCsrOUdFaUVUenp5RmtxbU9jc0lyWmNwWHpNUWlHWFp3ZmNPZ2pSc3kvYUwzREJ5V0VvN1BwYmJtSWVaYXBOQTJEblVNZW8wV1FuZ2cvNGNNTlU4R2NuM21LYU85L3hEbTdneVVtenhZRDczK3Q2VlQxZ0tLOG9OUFZ2RzhweWRGQkpVNjNvYkF4bThUKzNQMU9hbk13VDJkMURTVEIvNU9LZzhYUlVtU3dlMnM2QlhKaXNIY0l6cy9vS2ZCVGhYcm0vdGhiM3lhc1JxTVhpc2xkMzVkSk85eVB0NUM3bnVlb0gwL1JFcGIzR1dtd28zb1JMbk5XTkNqWUYrRWFETGxCK0RZcU5vK1pyeEl5Q25pbEVmbWt5bXhOUStQMGMxMTlTSHVMQ3BPR1l1R0dZbjFkTDE5OTRuUHpTbENKaWNsempqaEZnVDU4WFptM0dyWFhYM2s0ZkNVd1pkbzREWmtVd3o0TnloNDhiZitTa25acFdqNTFOZzFxSWpvWXhhMmpDS3FkU2hmYkYzU3B3ZVBZQ1VVTWg5b1gxRWU2RjVxem5GZmFMYWU2N1pLRDF6YWlWVmI4S3hxcmZ3SFlQOUxKS2E5RzI3MHlteGpWbHhCNXMzVnltSDRZZWhVbnlvM2VrUlZtd0daVjkva01XYyttMDNFcmZjUVFSWEVyZEpKUStlSUtrZkJoV0kzZS90YjI5TGtFOVJ3NlVJYWJvYzZqYnRFa1YvbFRmYTRvc3VRMWJ0NHkvYm9FZmZFOGhlYzYxVTIxTnpDTE9WQ1JXdFBvSWlMVmo0clNyWjBHeGh2VmlvcmNIZmM3WTFNaG5jUy9md2RQNFdDYWxWdmN4RjRtM0UzOE9zNzBraTFxalZWeEExQTgvTmFDMnZYVEFydm0vdzN1ZGp4WjBITzRYc1BiZVJLSkd5cS9ZN3B0Y1BnVlpTTkpFaWJ1dmY4Z3M1bEVMN3I1ZXRuTW5TeVJpZFUyNnlQbDJYY1hSK1dGMUVSdVd1cmZwTVMyUytaSTRCcmdvTHNPMXRkdDBDbGpBQXczcEhsWWFtSXF4aUlGU28xWnlMVnprVEFWRzg2cUVGYUU4R1I2YmlnazFKVXlyVGM3aEwwTVpKU0pKQXBmenQrMHk3anhHaFBKZGIxYWhOZ1o2OTYxTUJFeTFKSkZKajE3UENxckhXb3h1L1ZNVGplNDFGajZPMktQOEJjcnhORUJKOUt6MWt2c3BkZDZMRDlIZnM1R0NKMGFiUGNmSlNLR1N5US9JRlRKRlFuNHg4YjRtNGh0RGM2K1VnT0RlSm90cmNKRy9PWjJRM1hGMjZSTUE3blVPVHF5aDIySk9xTGVTTzUwdmV1SU5nTWVMeEI3Y0VxM0tYeDc3a1ZsU1plZytqOTlJRk1JUFV0dDQ4aVRVdlhuUCswR0xoSlc2V1NPc1RHQzVBMmUwaVdVTitUdmJUMWFYbDM3UGZ1Y3l3bHVSZ3NzV3lNbnc4cGJNd21YcFhkK3dsWVZ2WmV2b2NjeE9US0JObXZxQ3UxU3E4d0pGdHd6WEtrNmJpTStSbDQ1MGN0TFpTU0FaN1dDdUZCenpzcExDemNnanFPMXJ3UlNLZFlZcm1aYlhISjlpWHFDbHE0NzhheG9vOFEzSCtmTjFKM0ZMS3hNVkN2SGtycTAyL2ZTanpaclhQSnkvcUFvNkpzM25uL2JVNlpQNit5cVJOeTloS3c2cWpKalVaRFBtbmpzK1F2b0FWOFQxaHRRQTRCSHdNQTRxeU1IdzhLQW5CTU1mOS92M25INzkrL2ZIcjczOEInICkpICk7|bWV0X3J1bihtZXRfdW5jb21wcmVzcyhtZXRfZGVjb2RlKCdIWlhIRHF6WUFRVi9aWGJqRVFzeU5MSzhBSnFjTGpsc0xPQVNteHk3K1hvL2VYVlU2MUxwak5YeDMrMmMvalgrMlhNcTUzSFpxbjMvUDhLcW5HSDFyNy9WekZTZjlSdnptbDNURlgxdVErcytCeDltb1hwbFZYZDNhVkU1OTNOellJeUdPTkgzSzlEVmVlTklORXpSNzRKd1F2ZmtXWitreDRVYzVPZ0Z5ZlRGaVJkZDhncGFMUmFsTmxLbUYrK3J0TFZPL2RERTVuMzcxRjVtMGNmUjE2ZDFxbzg2VFdCQmFoMUZnUEx1UHZIbnJUZEkzd21zRXlpVXBVL05wTVRFcENvRXYxa0V2Znl3c21zR0hlQnQyUjhtcTRoZVJzZ2ZhUGFWYXcvRHlURnRGSVh0MlBHa1JCVUFRQzdRTFR6Z0pOOWpVWHhMSGhNUWRrK2ZuRGRkaUFHa0tXTjBQQSs1V3pibHRMYWx5aG1LYmZ6TTZCbnVKVm51bVRwTDExaXVwMWVoY0VXUE8zQlNyaDFYYyt2TnB1ek1JUEVVOHhYSGU2dHNINDVmUEowbW5BMlNzNFp3aC9NQnJDKzRoMXEzMGk1cTJNQ3c3aGh5TGMvdGp3cWtvVUUrV0Vla0s1UFQ3T1JxdW05YnZYMnF4Q0FuWDhQb3Nra2thUmhLOHJyV0NqblpzcVVBTkpDVWRTMUsvY3FwTnJJZWVyODN2c0k1NGEzK0p2eG4waGE2NnBkZGNpMmJQRzNGN1BWdlpzWHRCeXNDcmkwQ1hUWmQzZHBiR1oyOXBTWG9yREZlOTVZTWNWUDlMRnZ3TWFhb21heVUrYWJ2UHRNcWpaZWJaZDB5VUhhNzl5THRpbDNIL3BrVXp6TWxLRkdKRFBMWi9qN0gxeHJtTU90RUYwSDFZUDJJV1N4em84YjB1anU5MjFNaVZ2UmpxdkR3UXdwMFl2cURSNWUrWG1xZzhEdGlPR25jSWNJUHF0SnFKQS91NWlJcUd6bmZQclNTdWVBWE8rZ1FzbkYreUltZ3hDczdrS04wYXJ0bVFwKytwMHJmWkhOTlg0YVVEaGl6Rkh4dTVJZDFrZ1B0bEFGTEVDN29zM0M1OUJBaHZLMkFnUThpdWZyVmQwbGV3RExvdTBrem1LTzJOWHpyYm9Bb2tSeXMwYVptaVpmVmJ0Z2xzMFFUNjQvcERIZTZFaERtb05FQWR6c1FaRXozR3RTZ3A3MWpTQ0xUL0Z6MnQ5LzlpYklyWHplSjNNTHBTcVV1NlkvcFdNalFjc3hudGwzREtpbUVVWUNsUTFRWWtnZXdTbXRIZ0FFZVEyN0llYlduSFRwbkdSR3loeVJpSUo2T0Q4aXg5aHdDSzVpS21UenR0eGVKUTVxQ0htczBLbjUzTSszTGt2SjZ6L01ZNnpReU4wWDJXQlRFZno4UGE4eW5XWFRhQWU5RGk1TmJGZVZGWGNPbGkyUzBLazVmV3p2a1NPdTd1WXJEam9lekg3Y0NHSHF3V0I3YXZhM2RMU0NEVFQySFUvMXQrYUhERjJSUmVoUTFpRE85TmV2Ui9ZbVg1K3FQRzNvaTBwR0poMlBVT2QvMzZiODF1bDZiL3ZUOFN2VXB3M1RrNGpGK1JvYXJFS2RucFRGSUNWYXVJUTduanNWQmxaL0lvbTNXRU5Wc3hEek1RQmlKRURMNGQwTXAyZU9FbGF3a3ArMkhLLzd5ekxpS2tZU09iY3ZPMXp1akFPMWNMRHR6RGVONjlPdkd1b3BNa2RXR0FaUVdaNzZ3TktQa0kzWjFoK2s1Vkx3QWNnN21jaGE4NzRXNXdrV3dYWDhQckt2KzBaSFQ3VUtyQyt1UzA2czRsVHhhRm15c0xmTXJpQzJyQVRIVWhnN25RZmxVSGxnandMbUZodGlUMXZYQmlHcDFlWVV3cmZPTk9Odmg5MnhCazc5b2JQcGxyZGQrOTBOdGZueFE5L2x3QmhNd1QrMElGOHgwSXcxQzVmQU1JTXJHaXNYMWpFWmZwbS9QL0d6SzFkMURSL2IzOUw3SDB5Uys4VXB4VXo3U1R1d24rS3YxdXJOTjZHSnppdmxGUGx1WWpBUnFMa1p5SWIya09yNm5ZY1VqNnM0Q2FEMjBPQ2NNYjc2YjJBWlR0MHVwUWwwK05BdnVhZ29rVlB1a0R0WUxyN21LN3pzVm1HOFVEOURzTmlGM1RIak1WUW11WWhuM2lvZW13ZHl2d0N6Vk4zSWZsSmZZQ3pMUUhSdFc5cGRMQXVOVEJHeU1acjNkV29zL1lQV2t6UThjVmVVSGdLZ2ZnbjhCRzJwRi91TXg5YzFmN21TZlhCdHpoaTVBOXJWbmhuQU4wenZyd0Vnd1R3UytsckdxamNnbEdhZS9XVVpaMlBwTVNjYTdzeXNzWGZmT09INmxWeHFkajFqQ3d2M1B5V3pONEU5Q3BQU2ZLYU0wVzAwR3ZBempPc2FQSXRKaTdjdXFKcjVSeElMUGZIdU8zU0ZhdlB2NERYcE5IUE5DNm9SRUViUjUvZWZ2di83NTU2OS8vdjAvJyApKSApOw==\"');

INSERT INTO `met_parameter` VALUES (1,'para1','编号','Number',0,1,3,'200','编号','all',0);
INSERT INTO `met_parameter` VALUES (2,'para2','品牌','Brand',0,21,3,'200','品牌','all',0);
INSERT INTO `met_parameter` VALUES (3,'para3','单位','Unit',1,3,3,'200','单位','all',0);
INSERT INTO `met_parameter` VALUES (4,'para4','价格','Price',1,4,3,'200','价格','1',0);
INSERT INTO `met_parameter` VALUES (5,'para5','','',0,5,3,'200','','all',0);
INSERT INTO `met_parameter` VALUES (6,'para6','','',0,6,3,'200','','all',0);
INSERT INTO `met_parameter` VALUES (7,'para7','','',0,7,3,'200','','all',0);
INSERT INTO `met_parameter` VALUES (8,'para8','','',0,8,3,'200','','all',0);
INSERT INTO `met_parameter` VALUES (9,'para9','','',0,9,3,'不限','','all',0);
INSERT INTO `met_parameter` VALUES (10,'para10','','',0,10,3,'不限','','all',0);
INSERT INTO `met_parameter` VALUES (11,'para1','文件类型','File Type',1,1,4,'200','文件类型','all',0);
INSERT INTO `met_parameter` VALUES (12,'para2','文件版本','Version',1,2,4,'200','文件版本','all',0);
INSERT INTO `met_parameter` VALUES (13,'para3','','',0,3,4,'200','','all',0);
INSERT INTO `met_parameter` VALUES (14,'para4','','',0,4,4,'200','','all',0);
INSERT INTO `met_parameter` VALUES (15,'para5','','',0,5,4,'200','','all',0);
INSERT INTO `met_parameter` VALUES (16,'para6','','',0,6,4,'200','','all',0);
INSERT INTO `met_parameter` VALUES (17,'para7','','',0,7,4,'200','','all',0);
INSERT INTO `met_parameter` VALUES (18,'para8','','',0,8,4,'200','','all',0);
INSERT INTO `met_parameter` VALUES (19,'para9','','',0,9,4,'不限','','all',0);
INSERT INTO `met_parameter` VALUES (20,'para10','','',0,10,4,'不限','','all',0);
INSERT INTO `met_parameter` VALUES (21,'para1','','',0,1,5,'200','','all',0);
INSERT INTO `met_parameter` VALUES (22,'para2','','',0,2,5,'200','','all',0);
INSERT INTO `met_parameter` VALUES (23,'para3','','',0,3,5,'200','','all',0);
INSERT INTO `met_parameter` VALUES (24,'para4','','',0,4,5,'200','','all',0);
INSERT INTO `met_parameter` VALUES (25,'para5','','',0,5,5,'200','','all',0);
INSERT INTO `met_parameter` VALUES (26,'para6','','',0,6,5,'200','','all',0);
INSERT INTO `met_parameter` VALUES (27,'para7','','',0,7,5,'200','','all',0);
INSERT INTO `met_parameter` VALUES (28,'para8','','',0,8,5,'200','','all',0);
INSERT INTO `met_parameter` VALUES (29,'para9','','',0,9,5,'不限','','all',0);
INSERT INTO `met_parameter` VALUES (30,'para10','','',0,10,5,'不限','','all',0);
INSERT INTO `met_parameter` VALUES (31,'para11','图片1','Pic1',1,11,3,'255','图片1','all',0);
INSERT INTO `met_parameter` VALUES (32,'para12','图片2','Pic2',1,12,3,'255','图片2','all',0);
INSERT INTO `met_parameter` VALUES (33,'para13','图片3','Pic3',1,13,3,'255','图片3','all',0);
INSERT INTO `met_parameter` VALUES (34,'para14','图片4','Pic4',1,14,3,'255','图片4','all',0);
INSERT INTO `met_parameter` VALUES (35,'para15','图片5','Pic5',1,15,3,'255','图片5','all',0);
INSERT INTO `met_parameter` VALUES (36,'para16','图片6','Pic6',1,16,3,'255','图片6','all',0);
INSERT INTO `met_parameter` VALUES (37,'para11','图片1','Pic1',1,11,5,'255','','all',0);
INSERT INTO `met_parameter` VALUES (38,'para12','图片2','Pic2',1,12,5,'255','','all',0);
INSERT INTO `met_parameter` VALUES (39,'para13','图片3','Pic3',1,13,5,'255','','all',0);
INSERT INTO `met_parameter` VALUES (40,'para14','图片4','Pic4',1,14,5,'255','','all',0);
INSERT INTO `met_parameter` VALUES (41,'para15','图片5','Pic5',1,15,5,'255','','all',0);
INSERT INTO `met_parameter` VALUES (42,'para16','图片6','Pic6',1,16,5,'255','','all',0);
INSERT INTO `met_parameter` VALUES (43,'para17','图片7','Pic7',1,17,5,'255','','all',0);
INSERT INTO `met_parameter` VALUES (44,'para18','','',0,18,5,'255','','all',0);
INSERT INTO `met_parameter` VALUES (45,'para19','','',0,19,5,'255','','all',0);
INSERT INTO `met_parameter` VALUES (46,'para20','','',0,20,5,'255','','all',0);
INSERT INTO `met_parameter` VALUES (47,'para1','姓名','Name',1,1,10000,'200','姓名','all',1);
INSERT INTO `met_parameter` VALUES (48,'para2','性别','Sex',1,2,10000,'200','性别','all',1);
INSERT INTO `met_parameter` VALUES (49,'para3','出生年月','Birthday',1,3,10000,'200','出生年月','all',1);
INSERT INTO `met_parameter` VALUES (50,'para4','身高','Height',1,4,10000,'200','身高','all',0);
INSERT INTO `met_parameter` VALUES (51,'para5','身体状况','Health',1,5,10000,'200','身体状况','all',0);
INSERT INTO `met_parameter` VALUES (52,'para6','民族','National',1,6,10000,'200','民族','all',0);
INSERT INTO `met_parameter` VALUES (53,'para7','政治面貌','Political background',1,7,10000,'200','政治面貌','all',0);
INSERT INTO `met_parameter` VALUES (54,'para8','籍贯','Origin',1,8,10000,'200','籍贯','all',0);
INSERT INTO `met_parameter` VALUES (55,'para9','联系电话','Phone number',1,9,10000,'200','联系电话','all',1);
INSERT INTO `met_parameter` VALUES (56,'para10','邮编','Postal code',1,10,10000,'200','邮编','all',0);
INSERT INTO `met_parameter` VALUES (57,'para11','学历','Education',1,11,10000,'200','学历','all',1);
INSERT INTO `met_parameter` VALUES (58,'para12','E–mail','E–mail',1,12,10000,'200','E–mail','all',1);
INSERT INTO `met_parameter` VALUES (59,'para13','专业','Professional',1,13,10000,'200','专业','all',1);
INSERT INTO `met_parameter` VALUES (60,'para14','个人博客','Blog',1,14,10000,'200','个人博客','all',0);
INSERT INTO `met_parameter` VALUES (61,'para15','学校','Graduate school',1,15,10000,'200','学校','all',1);
INSERT INTO `met_parameter` VALUES (62,'para16','通讯地址','Address',1,16,10000,'200','通讯地址','all',0);
INSERT INTO `met_parameter` VALUES (63,'para17','','',0,17,10000,'200','','all',0);
INSERT INTO `met_parameter` VALUES (64,'para18','','',0,18,10000,'200','','all',0);
INSERT INTO `met_parameter` VALUES (65,'para19','','',0,19,10000,'200','','all',0);
INSERT INTO `met_parameter` VALUES (66,'para20','附件','Upload file',1,20,10000,'255','附件','all',0);
INSERT INTO `met_parameter` VALUES (67,'para21','所获奖项','Technical qualifications and special skills',1,21,10000,'不限','所获奖项','all',0);
INSERT INTO `met_parameter` VALUES (68,'para22','工作经历','Work experience',1,22,10000,'不限','工作经历','all',1);
INSERT INTO `met_parameter` VALUES (69,'para23','业余爱好','Hobbies/interests',1,23,10000,'不限','业余爱好','all',0);
INSERT INTO `met_parameter` VALUES (70,'para24','','',0,24,10000,'不限','','all',0);
INSERT INTO `met_parameter` VALUES (71,'para25','','',0,25,10000,'不限','','all',0);
INSERT INTO `met_parameter` VALUES (72,'para26','','',0,26,10000,'不限','','all',0);
INSERT INTO `met_parameter` VALUES (73,'para27','','',0,27,10000,'不限','','all',0);
INSERT INTO `met_parameter` VALUES (74,'para28','','',0,28,10000,'不限','','all',0);
INSERT INTO `met_parameter` VALUES (75,'para29','','',0,29,10000,'不限','','all',0);
INSERT INTO `met_parameter` VALUES (76,'para30','','',0,30,10000,'不限','','all',0);
INSERT INTO `met_parameter` VALUES (77,'para17','图片7','Pic7',1,17,3,'255','图片7','all',0);
INSERT INTO `met_parameter` VALUES (78,'para18','','',0,18,3,'255','','all',0);
INSERT INTO `met_parameter` VALUES (79,'para19','','',0,19,3,'255','','all',0);
INSERT INTO `met_parameter` VALUES (80,'para20','','',0,20,3,'255','','all',0);
INSERT INTO `met_parameter` VALUES (81,'para21','品牌','Brand',1,2,3,'200','品牌','all',0);
INSERT INTO `met_parameter` VALUES (82,'para22','','',0,22,3,'200','','all',0);
INSERT INTO `met_parameter` VALUES (83,'para23','','',0,23,3,'200','','all',0);
INSERT INTO `met_parameter` VALUES (84,'para24','','',0,24,3,'200','','all',0);
INSERT INTO `met_parameter` VALUES (85,'para21','','',0,21,5,'200','','all',0);
INSERT INTO `met_parameter` VALUES (86,'para22','','',0,22,5,'200','','all',0);
INSERT INTO `met_parameter` VALUES (87,'para23','','',0,23,5,'200','','all',0);
INSERT INTO `met_parameter` VALUES (88,'para24','','',0,24,5,'200','','all',0);

INSERT INTO `met_product` VALUES (1,'索尼 KLV-32S550A ','Sony KLV-32S550A ','','','','','','',7,27,33,0,'../upload/200909/watermark/1251812828.jpg','../upload/200909/thumb/1251812828.jpg',1,4,'2009-09-13 23:28:01','2009-09-01 21:30:56','','索尼','台','￥2000.00','','','','','','','','Sony','piece','$2000.00','','','','','','','admin','','','','','','','','','','','','','','','all','../upload/200909/1252723918.jpg','../upload/200909/1252724165.jpg','../upload/200909/1252723994.jpg','../upload/200909/1252723752.jpg','../upload/200909/1252724293.jpg','../upload/200909/1252724264.jpg','../upload/200909/1252723918.jpg','../upload/200909/1252724165.jpg','../upload/200909/1252723994.jpg','../upload/200909/1252723752.jpg','../upload/200909/1252724293.jpg','../upload/200909/1252724264.jpg','','','','','','',0,'../upload/200909/1252724038.jpg','','','','../upload/200909/1252724038.jpg','','','','','','','','TCL','','','','TCL','','','','','','','');
INSERT INTO `met_product` VALUES (2,'飞利浦 42PFL7403A/93','Philips 42PFL7403A/93','','','','','<p>&nbsp;&nbsp;&nbsp; *&nbsp; 液晶品牌： 飞利浦<br />\r\n&nbsp;&nbsp;&nbsp; * 飞利浦液晶电视型号： 42PFL7403A/93<br />\r\n&nbsp;&nbsp;&nbsp; * 屏幕尺寸： 42英寸<br />\r\n&nbsp;&nbsp;&nbsp; * 同城特色服务： 同城送货上门<br />\r\n&nbsp;&nbsp;&nbsp; * 屏幕比例： 宽屏16:9<br />\r\n&nbsp;&nbsp;&nbsp; * 液晶价格区间： 6000-8000元<br />\r\n&nbsp;&nbsp;&nbsp; * 清晰度： 1080p(全高清)<br />\r\n&nbsp;&nbsp;&nbsp; * 响应速度： 3-6毫秒(含3毫秒)<br />\r\n&nbsp;&nbsp;&nbsp; * 输入输出接口： 色差分量(YCbCr/YPbPr)接口 S端子接口 TV接口(RF射频) 耳机接口 其它 HDMI接口 VGA接口<br />\r\n&nbsp;&nbsp;&nbsp; * 液晶电视分辨率： 1920&times;1080<br />\r\n&nbsp;&nbsp;&nbsp; * 液晶电视售后服务： 全国联保<br />\r\n&nbsp;&nbsp;&nbsp; * 平板/液晶电视类型： 液晶电视</p>','<p>* LCD Brand: Philips <br />\r\n&nbsp;&nbsp;&nbsp;&nbsp; * Philips LCD TV Model: 42PFL7403A/93 <br />\r\n&nbsp;&nbsp;&nbsp;&nbsp; * Screen size: 42 inches <br />\r\n&nbsp;&nbsp;&nbsp;&nbsp; * Tong Cheng Special Service: Tongcheng home delivery <br />\r\n&nbsp;&nbsp;&nbsp;&nbsp; * Screen ratio: 16:9 widescreen <br />\r\n&nbsp;&nbsp;&nbsp;&nbsp; * LCD Price range: 6000-8000 yuan <br />\r\n&nbsp;&nbsp;&nbsp;&nbsp; * Definition: 1080p (Full HD) <br />\r\n&nbsp;&nbsp;&nbsp;&nbsp; * Response Speed: 3-6 ms (including 3 ms) <br />\r\n&nbsp;&nbsp;&nbsp;&nbsp; * Input and output interfaces: composite, component (YCbCr / YPbPr) interface, S-Video Interface TV interface (RF Radio Frequency) headphone jack other HDMI interface, VGA port <br />\r\n&nbsp;&nbsp;&nbsp;&nbsp; * LCD TV Resolution: 1920 &times; 1080 <br />\r\n&nbsp;&nbsp;&nbsp;&nbsp; * LCD TV Service: Quanguolianbao <br />\r\n&nbsp;&nbsp;&nbsp;&nbsp; * Flat Panel / LCD TV type: LCD TV</p>',7,27,35,0,'../upload/200909/watermark/1251812427.jpg','../upload/200909/thumb/1251812427.jpg',1,3,'2009-09-13 23:29:22','2009-09-01 21:33:33','','飞利浦','台','￥3000.00','','','','','','','','Philips','piece','$3000.00','','','','','','','admin','','','','','','','','','','','','','','','all','../upload/200909/1252723918.jpg','../upload/200909/1252724165.jpg','../upload/200909/1252723994.jpg','../upload/200909/1252723752.jpg','../upload/200909/1252724293.jpg','../upload/200909/1252724264.jpg','../upload/200909/1252723918.jpg','../upload/200909/1252724165.jpg','../upload/200909/1252723994.jpg','../upload/200909/1252723752.jpg','../upload/200909/1252724293.jpg','../upload/200909/1252724264.jpg','','','','','','',0,'../upload/200909/1252724038.jpg','','','','../upload/200909/1252724038.jpg','','','','','','','','海尔','','','','haier','','','','','','','');
INSERT INTO `met_product` VALUES (3,'三星液晶','Samsung LCD','','','','','<p>&nbsp;&nbsp;&nbsp; *&nbsp; 品牌: 三星SAMSUNG<br />\r\n&nbsp;&nbsp;&nbsp; * 型号: 943nw+<br />\r\n&nbsp;&nbsp;&nbsp; * LCD尺寸: 19寸<br />\r\n&nbsp;&nbsp;&nbsp; * 售后服务: 全国联保<br />\r\n&nbsp;&nbsp;&nbsp; * 宽屏: 是<br />\r\n&nbsp;&nbsp;&nbsp; * 垂直可视角度: 160度<br />\r\n&nbsp;&nbsp;&nbsp; * 对比度: 50000：1<br />\r\n&nbsp;&nbsp;&nbsp; * 黑白响应时间: 5ms<br />\r\n&nbsp;&nbsp;&nbsp; * 点距(mm): 0.283<br />\r\n&nbsp;&nbsp;&nbsp; * 面板类型: TN<br />\r\n&nbsp;&nbsp;&nbsp; * 接口类型: VGA<br />\r\n&nbsp;&nbsp;&nbsp; * 平均亮度: 300cd/m2<br />\r\n&nbsp;&nbsp;&nbsp; * 分辨率: 1440x900<br />\r\n&nbsp;&nbsp;&nbsp; * 水平可视角度: 170度<br />\r\n&nbsp;&nbsp;&nbsp; * 成色: 全新<br />\r\n&nbsp;&nbsp;&nbsp; * 液晶屏种类: 普通屏(保点三个以内)<br />\r\n&nbsp;&nbsp;&nbsp; * 屏幕比例: 宽屏16:10<br />\r\n<br />\r\n外观设计<br />\r\n外观颜色&nbsp;&nbsp;&nbsp; 黑色<br />\r\n外形尺寸&nbsp;&nbsp;&nbsp; 宽&times;高&times;厚(包括底座) 439&times;368&times;185mm <br />\r\n宽&times;高&times;厚(包装) 512&times;131&times;367mm<br />\r\n产品重量&nbsp;&nbsp;&nbsp; 净重 3.8kg <br />\r\n毛重 5.1kg<br />\r\n显示屏<br />\r\n显示屏尺寸&nbsp;&nbsp;&nbsp; 19英寸<br />\r\n是否宽屏&nbsp;&nbsp;&nbsp; 是<br />\r\n屏幕比例&nbsp;&nbsp;&nbsp; 16:10<br />\r\n可视角度&nbsp;&nbsp;&nbsp; 170/160&deg;<br />\r\n面板特征<br />\r\n亮度&nbsp;&nbsp;&nbsp; 300cd/㎡<br />\r\n对比度&nbsp;&nbsp;&nbsp; 50000:1<br />\r\n黑白响应时间&nbsp;&nbsp;&nbsp; 5ms<br />\r\n点距&nbsp;&nbsp;&nbsp; 0.285mm<br />\r\n显示色彩&nbsp;&nbsp;&nbsp; 16.7M<br />\r\n最佳分辨率&nbsp;&nbsp;&nbsp; 1440&times;900<br />\r\n输入输出<br />\r\n接口类型&nbsp;&nbsp;&nbsp; D-Sub<br />\r\n音频性能&nbsp;&nbsp;&nbsp; 无<br />\r\n即插即用&nbsp;&nbsp;&nbsp; 支持<br />\r\n其他性能<br />\r\n其他性能&nbsp;&nbsp;&nbsp; 魔亮 (MagicBright3), 定时关机, 图像尺寸调节, 颜色效果, 定制键, MagicWizard &amp; MagicTune (具有资源管理功能), 支持Windows Vista基础版, 支持安全模式 (DownScaling in UXGA)<br />\r\n其他特点&nbsp;&nbsp;&nbsp; 底座功能 简洁（倾斜）<br />\r\n&nbsp; 50000：1 的动态对比度，使两帧不同画面之间，改变背光灯亮度使对比度达到理想化，根据不同的显示画面内容，您可以享受 50000：1 的超高动态对比度，令流动画面的每个细节和轮廓，清晰地展现在屏幕上。<br />\r\n通过 Windows Vista 认证，为 Windows Vista 强大的多媒体功能和用户界面提供完美的显示支持。<br />\r\n快速图像处理器能使电影画面和游戏场面生动清晰的展现在屏幕上，极速响应时间，有效解决了拖影现象，为您呈现鲜亮清晰的数字画面。</p>','<p>* Brand: Samsung SAMSUNG <br />\r\n&nbsp;&nbsp;&nbsp;&nbsp; * Model: 943nw + <br />\r\n&nbsp;&nbsp;&nbsp;&nbsp; * LCD Size: 19 inches <br />\r\n&nbsp;&nbsp;&nbsp;&nbsp; * Service: Quanguolianbao <br />\r\n&nbsp;&nbsp;&nbsp;&nbsp; * Widescreen: Yes <br />\r\n&nbsp;&nbsp;&nbsp;&nbsp; * Vertical Viewing Angle: 160 degrees <br />\r\n&nbsp;&nbsp;&nbsp;&nbsp; * Contrast Ratio: 50,000:1 <br />\r\n&nbsp;&nbsp;&nbsp;&nbsp; * Black and White Response time: 5ms <br />\r\n&nbsp;&nbsp;&nbsp;&nbsp; * Pixel Pitch (mm): 0.283 <br />\r\n&nbsp;&nbsp;&nbsp;&nbsp; * Panel Type: TN <br />\r\n&nbsp;&nbsp;&nbsp;&nbsp; * Interface Type: VGA <br />\r\n&nbsp;&nbsp;&nbsp;&nbsp; * Average Brightness: 300cd/m2 <br />\r\n&nbsp;&nbsp;&nbsp;&nbsp; * Resolution: 1440x900 <br />\r\n&nbsp;&nbsp;&nbsp;&nbsp; * Horizontal viewing angle: 170 degrees <br />\r\n&nbsp;&nbsp;&nbsp;&nbsp; * Condition: New <br />\r\n&nbsp;&nbsp;&nbsp;&nbsp; * LCD Screen Type: Normal Screen (Checkpoint 3 or less) <br />\r\n&nbsp;&nbsp;&nbsp;&nbsp; * Screen ratio: Widescreen 16:10 <br />\r\n<br />\r\nDesigns <br />\r\nAppearance Color Black <br />\r\nDimensions W &times; H &times; thickness (including stand) 439 &times; 368 &times; 185mm <br />\r\nW &times; H &times; thickness (packaging) 512 &times; 131 &times; 367mm <br />\r\nProduct weight Net weight 3.8kg <br />\r\nGross Weight 5.1kg <br />\r\nDisplay <br />\r\n19-inch screen size <br />\r\nWhether it is a widescreen <br />\r\nScreen ratio 16:10 <br />\r\nViewing Angle 170/160 &deg; <br />\r\nPanel Features <br />\r\nBrightness 300cd / ㎡ <br />\r\n50,000:1 contrast ratio <br />\r\n5ms response time black and white <br />\r\nPixel Pitch 0.285mm <br />\r\nDisplay Colors 16.7M <br />\r\nBest Resolution 1440 &times; 900 <br />\r\nO <br />\r\nInterface D-Sub <br />\r\nAudio Performance No <br />\r\nPlug and Play support <br />\r\nOther features <br />\r\nOther performance MagicBright (MagicBright3), timing shutdown, image size adjustment, color effect, customized key, MagicWizard &amp; MagicTune (with a resource management function), support for Windows Vista Basic Edition, to support safe mode (DownScaling in UXGA) <br />\r\nOther features of the base features concise (tilt) <br />\r\n&nbsp;&nbsp; 50,000:1 dynamic contrast ratio, so that between two different images to change the backlight brightness to make contrast to idealized, depending on the display content, you can enjoy ultra-high 50,000:1 dynamic contrast ratio, so that every movement of the screen details and outline clearly show on the screen. <br />\r\nCertified by Windows Vista, to Windows Vista powerful multimedia features and user interface provides the perfect display support. <br />\r\nFast image processor enables vivid scenes of the film screen and the game clearly shows on the screen, speed response time, an effective solution to the smear phenomenon, in order to present you with bright clear digital images.</p>',7,27,36,0,'../upload/200909/watermark/1251812545.jpg','../upload/200909/thumb/1251812545.jpg',1,4,'2009-09-13 23:26:56','2009-09-01 21:37:47','','','台','￥5000','','','','','','','','','piece','$5000','','','','','','','admin','','','','','','','','','','','','','','','all','../upload/200909/1252723918.jpg','../upload/200909/1252724165.jpg','../upload/200909/1252723994.jpg','../upload/200909/1252723752.jpg','../upload/200909/1252724293.jpg','../upload/200909/1252724264.jpg','../upload/200909/1252723918.jpg','../upload/200909/1252724165.jpg','../upload/200909/1252723994.jpg','../upload/200909/1252723752.jpg','../upload/200909/1252724293.jpg','../upload/200909/1252724264.jpg','','','','','','',0,'../upload/200909/1252724038.jpg','','','','../upload/200909/1252724038.jpg','','','','','','','','创维','','','','skyworth','','','','','','','');
INSERT INTO `met_product` VALUES (4,'诺基亚手机','Nokia','','','','','<ul class=\"attributes-list\">\r\n    <li title=\"品牌\">品牌: Nokia/诺基亚</li>\r\n    <li title=\"诺基亚型号\">诺基亚型号: 8600 Luna</li>\r\n    <li title=\"上市时间\">上市时间: 2007年</li>\r\n    <li title=\"网络类型\">网络类型: GSM</li>\r\n    <li title=\"外观样式\">外观样式: 滑盖</li>\r\n    <li title=\"屏幕颜色\">屏幕颜色: 1600万</li>\r\n    <li title=\"机身颜色\">机身颜色: 黑色</li>\r\n    <li title=\"手机套餐\">手机套餐: 官方标配</li>\r\n    <li title=\"铃声\">铃声: 64和弦</li>\r\n    <li title=\"摄像头\">摄像头: 200万</li>\r\n    <li title=\"是否智能手机\">是否智能手机: 非智能手机</li>\r\n    <li title=\"操作系统\">操作系统: Symbian</li>\r\n    <li title=\"储存功能\">储存功能: 不支持存储卡</li>\r\n    <li title=\"高级功能\">高级功能: MP3播放 &nbsp;视频播放 &nbsp;蓝牙传输</li>\r\n    <li title=\"宝贝成色\">宝贝成色: 全新</li>\r\n    <li title=\"售后服务\">售后服务: 全国联保</li>\r\n</ul>','<p># Brand: Nokia / Nokia <br />\r\n# Nokia Model: 8600 Luna <br />\r\n# Available: 2007 <br />\r\n# Network types: GSM <br />\r\n# Appearance Style: Slide <br />\r\n# Screen Color: 16 million <br />\r\n# Body Color: Black <br />\r\n# Mobile Package: Official Standard <br />\r\n# Ringtones: 64 chord <br />\r\n# Camera: 2 million <br />\r\n# Whether the smart phone: a non-smart phone <br />\r\n# Operating System: Symbian <br />\r\n# Storage functions: does not support the memory card <br />\r\n# Advanced Features: MP3 Player Bluetooth, video playback <br />\r\n# Baby Condition: New <br />\r\n# Service: Quanguolianbao</p>',7,28,37,0,'../upload/200909/watermark/1251812965.jpg','../upload/200909/thumb/1251812965.jpg',1,9,'2009-09-13 23:29:51','2009-09-01 21:43:39','','诺基亚','台','￥1000.00','','','','','','','','Nokia','piece','￥1000.00','','','','','','','admin','','','','','','','','','','','','','','','all','../upload/200909/1252723918.jpg','../upload/200909/1252724165.jpg','../upload/200909/1252723994.jpg','../upload/200909/1252723752.jpg','../upload/200909/1252724293.jpg','../upload/200909/1252724264.jpg','../upload/200909/1252723918.jpg','../upload/200909/1252724165.jpg','../upload/200909/1252723994.jpg','../upload/200909/1252723752.jpg','../upload/200909/1252724293.jpg','../upload/200909/1252724264.jpg','','','','','','',0,'../upload/200909/1252724038.jpg','../upload/200909/1251813731.jpg','../upload/200909/1251813520.jpg','../upload/200909/1251812983.jpg','../upload/200909/1252724038.jpg','../upload/200909/1251813731.jpg','../upload/200909/1251813520.jpg','../upload/200909/1251812983.jpg','','','','','海尔','','','','haier','','','','','','','');
INSERT INTO `met_product` VALUES (5,'飞利浦GoGear Mix(2GB)','GoGear Mix(2GB)','','','','','<p>采用了推拉式的直插设计，内置一个超薄的USB接口，只要轻轻一推，就可以快速连接电脑，进行充电及文件传输。左侧是显示窗口，右侧是按键，但这里却暗藏玄机。通过设置，可以将Mix的显示界面实现180度倒转，按键功能也随之相应倒转，成为左侧按键，而右侧是显示窗口。</p>','<p>Designs <br />\r\nAppearance Color Black <br />\r\nDimensions W &times; H &times; thickness (including stand) 439 &times; 368 &times; 185mm <br />\r\nW &times; H &times; thickness (packaging) 512 &times; 131 &times; 367mm <br />\r\nProduct weight Net weight 3.8kg <br />\r\nGross Weight 5.1kg <br />\r\nDisplay <br />\r\n19-inch screen size <br />\r\nWhether it is a widescreen <br />\r\nScreen ratio 16:10 <br />\r\nViewing Angle 170/160 &deg; <br />\r\nPanel Features <br />\r\nBrightness 300cd / ㎡ <br />\r\n50,000:1 contrast ratio <br />\r\n5ms response time black and white <br />\r\nPixel Pitch 0.285mm <br />\r\nDisplay Colors 16.7M <br />\r\nBest Resolution 1440 &times; 900&nbsp;<br />\r\n&nbsp;</p>',7,29,0,0,'../upload/200909/watermark/1252722157.jpg','../upload/200909/thumb/1252722157.jpg',0,8,'2009-09-13 23:32:28','2009-09-12 10:06:18','','','台','￥229',NULL,NULL,NULL,NULL,NULL,NULL,'','','piece','$500',NULL,NULL,NULL,NULL,NULL,NULL,'admin','','','','',NULL,'','','',NULL,NULL,NULL,NULL,NULL,NULL,'all','../upload/200909/1252723918.jpg','../upload/200909/1252724165.jpg','../upload/200909/1252723994.jpg','../upload/200909/1252723752.jpg','../upload/200909/1252724293.jpg','../upload/200909/1252724264.jpg','../upload/200909/1252723918.jpg','../upload/200909/1252724165.jpg','../upload/200909/1252723994.jpg','../upload/200909/1252723752.jpg','../upload/200909/1252724293.jpg','../upload/200909/1252724264.jpg','','','','','','',0,'../upload/200909/1252724038.jpg','','','','../upload/200909/1252724038.jpg','','','','','','','','TCL',NULL,NULL,NULL,'skyworth',NULL,NULL,NULL,'',NULL,NULL,NULL);
INSERT INTO `met_product` VALUES (6,'戴尔1427（S510437CN）','Dell 1427（S510437CN）','','','','','<p>\r\n<td class=\"param_td1\" id=\"param_1838_1\" bgcolor=\"#ffffff\" align=\"left\" width=\"100\" valign=\"middle\">&nbsp;</td>\r\n&nbsp; &nbsp; &nbsp; 处理器型号 Intel 酷睿2双核 P8600</p>\r\n<p>&nbsp;</p>','<p>Designs <br />\r\nAppearance Color Black <br />\r\nDimensions W &times; H &times; thickness (including stand) 439 &times; 368 &times; 185mm <br />\r\nW &times; H &times; thickness (packaging) 512 &times; 131 &times; 367mm <br />\r\nProduct weight Net weight 3.8kg <br />\r\nGross Weight 5.1kg <br />\r\nDisplay <br />\r\n19-inch screen size <br />\r\nWhether it is a widescreen <br />\r\nScreen ratio 16:10 <br />\r\nViewing Angle 170/160 &deg; <br />\r\nPanel Features <br />\r\nBrightness 300cd / ㎡ <br />\r\n50,000:1 contrast ratio <br />\r\n5ms response time black and white <br />\r\nPixel Pitch 0.285mm <br />\r\nDisplay Colors 16.7M <br />\r\nBest Resolution 1440 &times; 900&nbsp;<br />\r\n&nbsp;</p>',7,30,0,0,'../upload/200909/watermark/1252721787.jpg','../upload/200909/thumb/1252721787.jpg',0,2,'2009-09-13 23:32:59','2009-09-12 10:10:46','','','台','￥6199',NULL,NULL,NULL,NULL,NULL,NULL,'','','piece','$3000.00',NULL,NULL,NULL,NULL,NULL,NULL,'admin','','','','',NULL,'','','',NULL,NULL,NULL,NULL,NULL,NULL,'all','../upload/200909/1252723918.jpg','../upload/200909/1252724165.jpg','../upload/200909/1252723994.jpg','../upload/200909/1252723752.jpg','../upload/200909/1252724293.jpg','../upload/200909/1252724264.jpg','../upload/200909/1252723918.jpg','../upload/200909/1252724165.jpg','../upload/200909/1252723994.jpg','../upload/200909/1252723752.jpg','../upload/200909/1252724293.jpg','../upload/200909/1252724264.jpg','','','','','','',0,'../upload/200909/1252724038.jpg','','','','../upload/200909/1252724038.jpg','','','','','','','','TCL',NULL,NULL,NULL,'TCL',NULL,NULL,NULL,'',NULL,NULL,NULL);
INSERT INTO `met_product` VALUES (7,'希捷FreeAgent XTreme(1TB)','FreeAgent XTreme(1TB)','','','','','<p>自动备份软件让您能够轻松保护数据利用强大的软件加密技术将您重要的文件和文件夹私密化实现 FreeAgent XTreme 硬盘和其他便携硬盘之间的内容同步。这样您可以随时随地获最新版本利用预先装载的软件实现快速启动。不再需要CD，其环保智能的实用程序将闲置时间超过 15 分钟的硬盘转为睡眠状态以节省能源 世界领先的存储解决方案提供 5 年有限责任质保让您远离烦恼。</p>','<p>Designs <br />\r\nAppearance Color Black <br />\r\nDimensions W &times; H &times; thickness (including stand) 439 &times; 368 &times; 185mm <br />\r\nW &times; H &times; thickness (packaging) 512 &times; 131 &times; 367mm <br />\r\nProduct weight Net weight 3.8kg <br />\r\nGross Weight 5.1kg <br />\r\nDisplay <br />\r\n19-inch screen size <br />\r\nWhether it is a widescreen <br />\r\nScreen ratio 16:10 <br />\r\nViewing Angle 170/160 &deg; <br />\r\nPanel Features <br />\r\nBrightness 300cd / ㎡ <br />\r\n50,000:1 contrast ratio <br />\r\n5ms response time black and white <br />\r\nPixel Pitch 0.285mm <br />\r\nDisplay Colors 16.7M <br />\r\nBest Resolution 1440 &times; 900</p>',7,31,0,0,'../upload/200909/watermark/1252722902.jpg','../upload/200909/thumb/1252722902.jpg',0,23,'2009-09-13 23:33:34','2009-09-12 10:17:59','','','台','￥1499',NULL,NULL,NULL,NULL,NULL,NULL,'','','piece','$5000',NULL,NULL,NULL,NULL,NULL,NULL,'admin','','','','',NULL,'','','',NULL,NULL,NULL,NULL,NULL,NULL,'all','../upload/200909/1252723918.jpg','../upload/200909/1252724165.jpg','../upload/200909/1252723994.jpg','../upload/200909/1252723752.jpg','../upload/200909/1252724293.jpg','../upload/200909/1252724264.jpg','../upload/200909/1252723918.jpg','../upload/200909/1252724165.jpg','../upload/200909/1252723994.jpg','../upload/200909/1252723752.jpg','../upload/200909/1252724293.jpg','../upload/200909/1252724264.jpg','','','','','','',0,'../upload/200909/1252724038.jpg','','','','../upload/200909/1252724038.jpg','','','','','','','','海尔',NULL,NULL,NULL,'haier',NULL,NULL,NULL,'',NULL,NULL,NULL);
INSERT INTO `met_product` VALUES (8,'索尼HDR-XR100E','SONY HDR-XR100E','','','','','<p>f（焦点距离）:&nbsp;3.2 - 32mm&nbsp;<br />\r\nf （35mm换算）:&nbsp;<br />\r\n动态模式:(16:9):42-497mm,(4:3):52-608mm<br />\r\n静态模式:(16:9):42-420mm,(4:3):38-380mm&nbsp;<br />\r\n卡尔&middot;蔡司镜头</p>','<p>Designs <br />\r\nAppearance Color Black <br />\r\nDimensions W &times; H &times; thickness (including stand) 439 &times; 368 &times; 185mm <br />\r\nW &times; H &times; thickness (packaging) 512 &times; 131 &times; 367mm <br />\r\nProduct weight Net weight 3.8kg <br />\r\nGross Weight 5.1kg <br />\r\nDisplay <br />\r\n19-inch screen size <br />\r\nWhether it is a widescreen <br />\r\nScreen ratio 16:10 <br />\r\nViewing Angle 170/160 &deg; <br />\r\nPanel Features <br />\r\nBrightness 300cd / ㎡ <br />\r\n50,000:1 contrast ratio <br />\r\n5ms response time black and white <br />\r\nPixel Pitch 0.285mm <br />\r\nDisplay Colors 16.7M <br />\r\nBest Resolution 1440 &times; 900 <br />\r\n&nbsp;</p>',7,32,0,0,'../upload/200909/watermark/1252722540.jpg','../upload/200909/thumb/1252722540.jpg',0,2,'2009-09-13 23:31:23','2009-09-12 10:21:13','','','台','￥5250',NULL,NULL,NULL,NULL,NULL,NULL,'','','piece','$500',NULL,NULL,NULL,NULL,NULL,NULL,'admin','','','','',NULL,'','','',NULL,NULL,NULL,NULL,NULL,NULL,'all','../upload/200909/1252723918.jpg','../upload/200909/1252724165.jpg','../upload/200909/1252723994.jpg','../upload/200909/1252723752.jpg','../upload/200909/1252724293.jpg','../upload/200909/1252724264.jpg','../upload/200909/1252723918.jpg','../upload/200909/1252724165.jpg','../upload/200909/1252723994.jpg','../upload/200909/1252723752.jpg','../upload/200909/1252724293.jpg','../upload/200909/1252724264.jpg','','','','','','',0,'../upload/200909/1252724038.jpg','','','','../upload/200909/1252724038.jpg','','','','','','','','创维',NULL,NULL,NULL,'skyworth',NULL,NULL,NULL,'',NULL,NULL,NULL);

INSERT INTO `met_skin_table` VALUES (1,'2.0默认模板','default','2.0默认模板');
INSERT INTO `met_skin_table` VALUES (2,'米拓经典001','met001','对应1.5版本的red模板');
INSERT INTO `met_skin_table` VALUES (3,'米拓经典002','met002','对应1.5版本的草绿双语系列模板');
INSERT INTO `met_skin_table` VALUES (4,'米拓官网003','met003','对应1.5版本的metinfo模板');
INSERT INTO `met_skin_table` VALUES (5,'米拓经典004','met004','对应1.5版本的met009模板');
INSERT INTO `met_skin_table` VALUES (6,'MetInfo官网','met005','');