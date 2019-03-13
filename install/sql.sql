DROP TABLE IF EXISTS `met_admin_array`;
CREATE TABLE `met_admin_array` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `array_name` varchar(255) NOT NULL,
  `admin_type` text NOT NULL,
  `admin_ok` int(11) NOT NULL default '0',
  `admin_op` varchar(20) default 'metinfo',
  `admin_issueok` int(11) NOT NULL default '0',
  `admin_group` int(11) NOT NULL,
  `user_webpower` int(11) NOT NULL,
  `array_type` int(11) default NULL,
  `lang` varchar(50) default NULL,
  `langok` varchar(255) default 'metinfo',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `met_admin_table`;
CREATE TABLE `met_admin_table` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `admin_type` text NOT NULL,
  `admin_id` char(20) NOT NULL,
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
  `admin_group` int(11) NOT NULL,
  `companyname` varchar(255) default NULL,
  `companyaddress` varchar(255) default NULL,
  `companyfax` varchar(255) default NULL,
  `usertype` int(11) default '0',
  `checkid` int(1) default '0',
  `companycode` varchar(50) default NULL,
  `companywebsite` varchar(50) default NULL,
  `cookie` text NOT NULL,
  `admin_shortcut` text NOT NULL,
  `lang` varchar(50) default NULL,
  `content_type` TINYINT default NULL,
  `langok` varchar(255) default 'metinfo',
  PRIMARY KEY  (`id`),
  KEY `admin_id` (`admin_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `met_admin_column`;
CREATE TABLE `met_admin_column` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(100) default NULL,
  `url` varchar(255) default NULL,
  `bigclass` int(11) NOT NULL,
  `field` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `list_order` int(11) default '0',
  `icon` varchar(255) default NULL,
  `info` text NOT NULL,
  `display` int(11) NOT NULL default '1',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `met_column`;
CREATE TABLE `met_column` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(100) default NULL,
  `foldername` varchar(50) default NULL,
  `filename` varchar(50) default NULL,
  `bigclass` int(11) default '0',
  `samefile` int(11) NOT NULL default '0',
  `module` int(11) default NULL,
  `no_order` int(11) default NULL,
  `wap_ok` int(1) default '0',
  `wap_nav_ok` INT( 11 ) NOT NULL default '0',
  `if_in` int(1) default '0',
  `nav` int(1) default '0',
  `ctitle` varchar(200) default NULL,
  `keywords` varchar(200) default NULL,
  `content` longtext,
  `description` text,
  `list_order` int(11) default '0',
  `new_windows` varchar(50) default NULL,
  `classtype` int(11) default '1',
  `out_url` varchar(200) default NULL,
  `index_num` int(11) default '0',
  `access` int(11) default '0',
  `indeximg` varchar(255) default NULL,
  `columnimg` varchar(255) default NULL,
  `isshow` int(11) default '1',
  `lang` varchar(50) default NULL,
  `namemark` varchar(255) default NULL,
  `releclass` int(11) default '0',
  `display` int(11) default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `met_config`;
CREATE TABLE `met_config` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL,
  `value` text NOT NULL,
  `mobile_value` text NOT NULL,
  `columnid` int(11) NOT NULL,
  `flashid` int(11) NOT NULL,
  `lang` varchar(50) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `met_cv`;
CREATE TABLE `met_cv` (
  `id` int(11) NOT NULL auto_increment,
  `addtime` datetime default NULL,
  `readok` int(11) default '0',
  `customerid` varchar(50) default '0',
  `jobid` int(11) NOT NULL default '0',
  `lang` varchar(50) default NULL,
  `ip` varchar(255) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `met_download`;
CREATE TABLE `met_download` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(200) default NULL,
  `ctitle` varchar(200) default NULL,
  `keywords` varchar(200) default NULL,
  `description` text,
  `content` longtext,
  `class1` int(11) default '0',
  `class2` int(11) default '0',
  `class3` int(11) default '0',
  `no_order` int(11) default '0',
  `new_ok` int(1) default '0',
  `wap_ok` int(1) default '0',
  `downloadurl` varchar(255) default NULL,
  `filesize` varchar(100) default NULL,
  `com_ok` int(1) default '0',
  `hits` int(11) default '0',
  `updatetime` datetime default NULL,
  `addtime` datetime default NULL,
  `issue` varchar(100) default '',
  `access` int(11) default '0',
  `top_ok` int(1) default '0',
  `downloadaccess` int(11) default '0',
  `filename` varchar(255) default NULL,
  `lang` varchar(50) default NULL,
  `recycle` int(11) NOT NULL default '0',
  `displaytype` int(11) NOT NULL default '1',
  `tag` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `met_feedback`;
CREATE TABLE `met_feedback` (
  `id` int(11) NOT NULL auto_increment,
  `class1` int(11) default '0',
  `fdtitle` varchar(255) default NULL,
  `fromurl` varchar(255) default NULL,
  `ip` varchar(255) default NULL,
  `addtime` datetime default NULL,
  `readok` int(11) default '0',
  `useinfo` text,
  `customerid` varchar(30) default '0',
  `lang` varchar(50) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `met_flash`;
CREATE TABLE `met_flash` (
  `id` int(11) NOT NULL auto_increment,
  `module` text,
  `img_title` varchar(255) default NULL,
  `img_path` varchar(255) default NULL,
  `img_link` varchar(255) default NULL,
  `flash_path` varchar(255) default NULL,
  `flash_back` varchar(255) default NULL,
  `no_order` int(11) default NULL,
  `width` int(11) default NULL,
  `height` int(11) default NULL,
  `wap_ok` int(11) NOT NULL default '0',
  `img_title_color` varchar(100) NOT NULL DEFAULT '',
  `img_des` varchar(100) NOT NULL DEFAULT '',
  `img_des_color` varchar(100) NOT NULL DEFAULT '',
  `img_text_position` varchar(100) NOT NULL DEFAULT '',
  `lang` varchar(50) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `met_flist`;
CREATE TABLE `met_flist` (
  `id` int(11) NOT NULL auto_increment,
  `listid` int(11) default NULL,
  `paraid` int(11) default NULL,
  `info` text,
  `lang` varchar(50) default NULL,
  `module` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `met_img`;
CREATE TABLE `met_img` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(200) default NULL,
  `ctitle` varchar(200) default NULL,
  `keywords` varchar(200) default NULL,
  `description` text,
  `content` longtext,
  `class1` int(11) default '0',
  `class2` int(11) default '0',
  `class3` int(11) default '0',
  `no_order` int(11) default '0',
  `wap_ok` int(1) default '0',
  `new_ok` int(1) default '0',
  `imgurl` varchar(255) default NULL,
  `imgurls` varchar(255) default NULL,
  `displayimg` text,
  `com_ok` int(1) default '0',
  `hits` int(11) default '0',
  `updatetime` datetime default NULL,
  `addtime` datetime default NULL,
  `issue` varchar(100) default '',
  `access` int(11) default '0',
  `top_ok` int(1) default '0',
  `filename` varchar(255) default NULL,
  `lang` varchar(50) default NULL,
  `content1` text,
  `content2` text,
  `content3` text,
  `content4` text,
  `contentinfo` varchar(255) default NULL,
  `contentinfo1` varchar(255) default NULL,
  `contentinfo2` varchar(255) default NULL,
  `contentinfo3` varchar(255) default NULL,
  `contentinfo4` varchar(255) default NULL,
  `recycle` int(11) NOT NULL default '0',
  `displaytype` int(11) NOT NULL default '1',
  `tag` text NOT NULL,
  `links` varchar(200) default NULL,
  `imgsize` varchar(200) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `met_job`;
CREATE TABLE `met_job` (
  `id` int(11) NOT NULL auto_increment,
  `position` varchar(200) default NULL,
  `count` int(11) default '0',
  `place` varchar(200) default NULL,
  `deal` varchar(200) default NULL,
  `addtime` date default NULL,
  `useful_life` int(11) default NULL,
  `content` longtext,
  `access` int(11) default '0',
  `no_order` int(11) default '0',
  `wap_ok` int(1) default '0',
  `top_ok` int(1) default '0',
  `email` varchar(255) default NULL,
  `filename` varchar(255) default NULL,
  `lang` varchar(50) default NULL,
  `displaytype` int(11) NOT NULL default '1',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `met_label`;
CREATE TABLE `met_label` (
  `id` int(11) NOT NULL auto_increment,
  `oldwords` varchar(255) default NULL,
  `newwords` varchar(255) default NULL,
  `newtitle` varchar(255) default NULL,
  `url` varchar(255) default NULL,
  `num` int(11) NOT NULL default '99',
  `lang` varchar(50) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `met_lang`;
CREATE TABLE `met_lang` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(100) NOT NULL,
  `useok` int(1) NOT NULL,
  `no_order` int(11) NOT NULL,
  `mark` varchar(50) NOT NULL,
  `synchronous` varchar(50) NOT NULL,
  `flag` varchar(100) NOT NULL,
  `link` varchar(255) NOT NULL,
  `newwindows` int(1) NOT NULL,
  `metconfig_webhtm` int(1) NOT NULL,
  `metconfig_htmtype` varchar(50) NOT NULL,
  `metconfig_weburl` varchar(255) NOT NULL,
  `lang` varchar(50) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `met_language`;
CREATE TABLE `met_language` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL,
  `value` text NOT NULL,
  `site` tinyint(1) NOT NULL,
  `no_order` int(11) NOT NULL default '0',
  `array` int(11) NOT NULL,
  `app` int(11) NOT NULL,
  `lang` varchar(50) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `met_link`;
CREATE TABLE `met_link` (
  `id` int(11) NOT NULL auto_increment,
  `webname` varchar(255) default NULL,
  `weburl` varchar(255) default NULL,
  `weblogo` varchar(255) default NULL,
  `link_type` int(11) default '0',
  `info` varchar(255) default NULL,
  `contact` varchar(255) default NULL,
  `orderno` int(11) default '0',
  `com_ok` int(11) default '0',
  `show_ok` int(11) default '0',
  `addtime` datetime default NULL,
  `lang` varchar(50) default NULL,
  `ip` varchar(255) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `met_list`;
CREATE TABLE `met_list` (
  `id` int(11) NOT NULL auto_increment,
  `bigid` int(11) default NULL,
  `info` varchar(255) default NULL,
  `no_order` int(11) default NULL,
  `lang` varchar(50) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `met_message`;
CREATE TABLE `met_message` (
  `id` int(11) NOT NULL auto_increment,
  `ip` varchar(255) default NULL,
  `addtime` datetime default NULL,
  `readok` int(11) default '0',
  `useinfo` text,
  `lang` varchar(50) default NULL,
  `access` int(11) default '0',
  `customerid` varchar(30) default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `met_news`;
CREATE TABLE `met_news` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(200) default NULL,
  `ctitle` varchar(200) default NULL,
  `keywords` varchar(200) default NULL,
  `description` text,
  `content` longtext,
  `class1` int(11) default '0',
  `class2` int(11) default '0',
  `class3` int(11) default '0',
  `no_order` int(11) default '0',
  `wap_ok` int(1) default '0',
  `img_ok` int(1) default '0',
  `imgurl` varchar(255) default NULL,
  `imgurls` varchar(255) default NULL,
  `com_ok` int(1) default '0',
  `issue` varchar(100) default NULL,
  `hits` int(11) default '0',
  `updatetime` datetime default NULL,
  `addtime` datetime default NULL,
  `access` int(11) default '0',
  `top_ok` int(1) default '0',
  `filename` varchar(255) default NULL,
  `lang` varchar(50) default NULL,
  `recycle` int(11) NOT NULL default '0',
  `displaytype` int(11) NOT NULL default '1',
  `tag` text NOT NULL,
  `links` varchar(200) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `met_online`;
CREATE TABLE `met_online` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(200) default NULL,
  `no_order` int(11) default NULL,
  `qq` text,
  `msn` varchar(100) default NULL,
  `taobao` varchar(100) default NULL,
  `alibaba` varchar(100) default NULL,
  `skype` varchar(100) default NULL,
  `lang` varchar(50) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `met_otherinfo`;
CREATE TABLE `met_otherinfo` (
  `id` int(11) NOT NULL auto_increment,
  `info1` varchar(255) default NULL,
  `info2` varchar(255) default NULL,
  `info3` varchar(255) default NULL,
  `info4` varchar(255) default NULL,
  `info5` varchar(255) default NULL,
  `info6` varchar(255) default NULL,
  `info7` varchar(255) default NULL,
  `info8` text,
  `info9` text,
  `info10` text,
  `imgurl1` varchar(255) default NULL,
  `imgurl2` varchar(255) default NULL,
  `rightmd5` varchar(255) default NULL,
  `righttext` varchar(255) default NULL,
  `authcode` text,
  `authpass` varchar(255) default NULL,
  `authtext` varchar(255) default NULL,
  `data` longtext,
  `lang` varchar(50) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `met_parameter`;
CREATE TABLE `met_parameter` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(100) default NULL,
  `options` text NOT NULL,
  `description` text NOT NULL,
  `no_order` int(2) default NULL,
  `type` int(2) default NULL,
  `access` int(11) default '0',
  `wr_ok` int(2) default '0',
  `class1` int(11) NOT NULL,
  `class2` int(11) NOT NULL,
  `class3` int(11) NOT NULL,
  `module` int(2) default NULL,
  `lang` varchar(50) default NULL,
  `wr_oks` int(2) default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `met_plist`;
CREATE TABLE `met_plist` (
  `id` int(11) NOT NULL auto_increment,
  `listid` int(11) default NULL,
  `paraid` int(11) default NULL,
  `info` text,
  `lang` varchar(50) default NULL,
  `imgname` varchar(255) default NULL,
  `module` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `met_mlist`;
CREATE TABLE `met_mlist` (
  `id` int(11) NOT NULL auto_increment,
  `listid` int(11) default NULL,
  `paraid` int(11) default NULL,
  `info` text,
  `lang` varchar(50) default NULL,
  `imgname` varchar(255) default NULL,
  `module` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `met_product`;
CREATE TABLE `met_product` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(200) default NULL,
  `ctitle` varchar(200) default NULL,
  `keywords` varchar(200) default NULL,
  `description` text,
  `content` longtext,
  `class1` int(11) default '0',
  `class2` int(11) default '0',
  `class3` int(11) default '0',
  `classother` text NOT NULL,
  `no_order` int(11) default '0',
  `wap_ok` int(1) default '0',
  `new_ok` int(1) default '0',
  `imgurl` varchar(255) default NULL,
  `imgurls` varchar(255) default NULL,
  `displayimg` text,
  `com_ok` int(1) default '0',
  `hits` int(11) default '0',
  `updatetime` datetime default NULL,
  `addtime` datetime default NULL,
  `issue` varchar(100) default '',
  `access` int(11) default '0',
  `top_ok` int(1) default '0',
  `filename` varchar(255) default NULL,
  `lang` varchar(50) default NULL,
  `content1` text,
  `content2` text,
  `content3` text,
  `content4` text,
  `contentinfo` varchar(255) default NULL,
  `contentinfo1` varchar(255) default NULL,
  `contentinfo2` varchar(255) default NULL,
  `contentinfo3` varchar(255) default NULL,
  `contentinfo4` varchar(255) default NULL,
  `recycle` int(11) NOT NULL default '0',
  `displaytype` int(11) NOT NULL default '1',
  `tag` text NOT NULL,
  `links` varchar(200) default NULL,
  `imgsize` varchar(200) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `met_skin_table`;
CREATE TABLE `met_skin_table` (
  `id` int(11) NOT NULL auto_increment,
  `skin_name` varchar(200) default NULL,
  `skin_file` varchar(20) default NULL,
  `skin_info` text,
  `devices` int(11) NOT NULL default '0',
  `ver` varchar(10) DEFAULT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `met_sms`;
CREATE TABLE `met_sms` (
  `id` int(11) NOT NULL auto_increment,
  `time` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `content` text NOT NULL,
  `tel` text NOT NULL,
  `remark` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `met_visit_day`;
CREATE TABLE `met_visit_day` (
  `id` int(11) NOT NULL auto_increment,
  `ip` varchar(30) NOT NULL,
  `acctime` int(10) NOT NULL,
  `visitpage` varchar(255) NOT NULL,
  `antepage` varchar(255) NOT NULL,
  `columnid` int(11) NOT NULL,
  `listid` int(11) NOT NULL,
  `browser` varchar(255) NOT NULL,
  `dizhi` varchar(255) NOT NULL,
  `network` varchar(100) NOT NULL,
  `lang` varchar(50) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `met_visit_detail`;
CREATE TABLE `met_visit_detail` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) character set utf8 collate utf8_bin NOT NULL,
  `pv` int(11) NOT NULL default '0',
  `ip` int(11) NOT NULL default '0',
  `alone` int(11) NOT NULL default '0',
  `remark` varchar(255) character set utf8 collate utf8_bin NOT NULL,
  `type` int(1) NOT NULL default '0',
  `columnid` int(11) NOT NULL,
  `listid` int(11) NOT NULL,
  `stattime` int(11) NOT NULL,
  `lang` varchar(50) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `met_visit_summary`;
CREATE TABLE `met_visit_summary` (
  `id` int(11) NOT NULL auto_increment,
  `pv` int(11) NOT NULL default '0',
  `ip` int(11) NOT NULL default '0',
  `alone` int(11) NOT NULL,
  `parttime` text NOT NULL,
  `stattime` int(10) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `met_ifcolumn`;
CREATE TABLE IF NOT EXISTS `met_ifcolumn` (
  `id` int(11) NOT NULL auto_increment,
  `no` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `appname` varchar(50) NOT NULL COMMENT '应用名称',
  `addfile` tinyint(1) NOT NULL default '1',
  `memberleft` tinyint(1) NOT NULL default '0',
  `uniqueness` tinyint(1) NOT NULL default '0',
  `fixed_name` varchar(50) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `met_ifcolumn_addfile`;
CREATE TABLE IF NOT EXISTS `met_ifcolumn_addfile` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `no` int(11) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `m_name` varchar(255) NOT NULL,
  `m_module` varchar(255) NOT NULL,
  `m_class` varchar(255) NOT NULL,
  `m_action` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `met_ifmember_left`;
CREATE TABLE IF NOT EXISTS `met_ifmember_left` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `no` int(11) NOT NULL,
  `columnid` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `foldername` varchar(255) NOT NULL,
  `filename` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `met_applist`;
CREATE TABLE IF NOT EXISTS `met_applist` (
  `id` int(11) NOT NULL auto_increment,
  `no` int(11) NOT NULL,
  `ver` varchar(50) NOT NULL,
  `m_name` varchar(50) NOT NULL,
  `m_class` varchar(50) NOT NULL,
  `m_action` varchar(50) NOT NULL,
  `appname` varchar(50) NOT NULL,
  `info` text NOT NULL,
  `addtime` int(11) NOT NULL,
  `updatetime` int(11) NOT NULL,
  `target` int(11) NOT NULL default '0',
  `display` int(11) NOT NULL default '1',
  `depend`  varchar(100) NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `met_app_plugin`;
CREATE TABLE IF NOT EXISTS `met_app_plugin` (
  `id` int(11) NOT NULL auto_increment,
  `no_order` int(11) NOT NULL,
  `no` int(11) NOT NULL,
  `m_name` varchar(255) NOT NULL,
  `m_action` varchar(255) NOT NULL,
  `effect` tinyint(1) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `met_wapmenu`;
CREATE TABLE IF NOT EXISTS `met_wapmenu` (
  `id` int(11) NOT NULL auto_increment,
  `sequence` int(11) NOT NULL,
  `name` varchar(10) NOT NULL,
  `value` text NOT NULL,
  `type` varchar(255) NOT NULL,
  `values` varchar(20) NOT NULL,
  `columnicon` varchar(35) NOT NULL,
  `menu_wordrgb` varchar(10) NOT NULL,
  `menu_iconrgb` varchar(10) NOT NULL,
  `lang` varchar(5) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `met_infoprompt`;
CREATE TABLE IF NOT EXISTS `met_infoprompt` (
  `id` int(11) NOT NULL auto_increment,
  `news_id` int(11) NOT NULL,
  `newstitle` varchar(120) NOT NULL,
  `content` text NOT NULL,
  `url` varchar(200) NOT NULL,
  `member` varchar(50) NOT NULL,
  `type` varchar(35) NOT NULL,
  `time` int(11) NOT NULL,
  `see_ok` int(11) NOT NULL default '0',
  `lang` varchar(10) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `met_templates`;
CREATE TABLE IF NOT EXISTS `met_templates` (
  `id` int(11) NOT NULL auto_increment,
  `no` varchar(20) NOT NULL,
  `pos` int(11) NOT NULL,
  `no_order` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `style` int(11) NOT NULL default '0',
  `selectd` varchar(500) NOT NULL,
  `name` varchar(50) NOT NULL,
  `value` text NOT NULL,
  `defaultvalue` text NOT NULL,
  `valueinfo` varchar(100) NOT NULL,
  `tips` varchar(255) NOT NULL,
  `lang` varchar(50) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
INSERT INTO met_applist VALUES(null, '0', '1.0', 'ueditor', 'index', 'doindex', '百度编辑器', '编辑器', '0', '0', '0','0','');
INSERT INTO met_applist VALUES(null,'10070','1.0', 'metconfig_sms', 'index', 'doindex', '短信功能', '短信接口', '0', '0', '0','1','');
INSERT INTO met_config VALUES('1','metconfig_nurse_link_tel','','','0','0','metinfo');
INSERT INTO met_config VALUES('2','metconfig_nurse_link','0','','0','0','metinfo');
INSERT INTO met_config VALUES('3','metcms_v','5.3.19','','0','0','metinfo');
INSERT INTO met_config VALUES('4','metconfig_nurse_job_tel','','','0','0','metinfo');
INSERT INTO met_config VALUES('5','metconfig_nurse_job','0','','0','0','metinfo');
INSERT INTO met_config VALUES('6','metconfig_nurse_massge_tel','','','0','0','metinfo');
INSERT INTO met_config VALUES('7','metconfig_nurse_massge','0','','0','0','metinfo');
INSERT INTO met_config VALUES('8','metconfig_nurse_feed_tel','','','0','0','metinfo');
INSERT INTO met_config VALUES('9','metconfig_nurse_feed','0','','0','0','metinfo');
INSERT INTO met_config VALUES('10','metconfig_nurse_member_tel','','','0','0','metinfo');
INSERT INTO met_config VALUES('11','metconfig_nurse_member','0','','0','0','metinfo');
INSERT INTO met_config VALUES('12','metconfig_nurse_monitor_tel','','','0','0','metinfo');
INSERT INTO met_config VALUES('13','metconfig_nurse_monitor_timeb','23','','0','0','metinfo');
INSERT INTO met_config VALUES('14','metconfig_nurse_monitor_timea','0','','0','0','metinfo');
INSERT INTO met_config VALUES('15','metconfig_apptime','1373858456','','0','0','metinfo');
INSERT INTO met_config VALUES('16','metconfig_nurse_monitor_weeka','1','','0','0','metinfo');
INSERT INTO met_config VALUES('17','metconfig_nurse_monitor_fre','1','','0','0','metinfo');
INSERT INTO met_config VALUES('18','metconfig_nurse_monitor','0','','0','0','metinfo');
INSERT INTO met_config VALUES('19','metconfig_host','api.metinfo.cn','','0','0','metinfo');
INSERT INTO met_config VALUES('20','metconfig_nurse_stat','0','','0','0','metinfo');
INSERT INTO met_config VALUES('21','metconfig_nurse_stat_tel','','','0','0','metinfo');
INSERT INTO met_config VALUES('22','metconfig_nurse_max','10','','0','0','metinfo');
INSERT INTO met_config VALUES('24','metconfig_adminfile','9626k1yDhwTy+UEvnusgMWahnI7/uzBEoErEoZbV1jugFg','','0','0','metinfo');
INSERT INTO met_config VALUES('25','metconfig_ch_lang','1','','0','0','metinfo');
INSERT INTO met_config VALUES('26','metconfig_stat_max','10000','','0','0','metinfo');
INSERT INTO met_config VALUES('27','metconfig_stat_cr5','2','','0','0','metinfo');
INSERT INTO met_config VALUES('28','metconfig_stat_cr4','3','','0','0','metinfo');
INSERT INTO met_config VALUES('29','metconfig_stat_cr3','3','','0','0','metinfo');
INSERT INTO met_config VALUES('30','metconfig_stat_cr1','0','','0','0','metinfo');
INSERT INTO met_config VALUES('31','metconfig_stat_cr2','3','','0','0','metinfo');
INSERT INTO met_config VALUES('32','metconfig_stat','1','','0','0','metinfo');
INSERT INTO met_config VALUES('33','metconfig_ch_mark','cn','','0','0','metinfo');
INSERT INTO met_config VALUES('34','metconfig_lang_editor','','','0','0','metinfo');
INSERT INTO met_config VALUES('35','metconfig_lang_mark','1','','0','0','metinfo');
INSERT INTO met_config VALUES('566','metconfig_agents_web_site','','','0','0','metinfo');
INSERT INTO met_config VALUES('37','metconfig_admin_type_ok','0','','0','0','metinfo');
INSERT INTO met_config VALUES('38','metconfig_admin_type','cn','','0','0','metinfo');
INSERT INTO met_config VALUES('39','metconfig_sitemap_lang','1','','0','0','metinfo');
INSERT INTO met_config VALUES('40','metconfig_sitemap_not2','1','','0','0','metinfo');
INSERT INTO met_config VALUES('41','metconfig_sitemap_not1','0','','0','0','metinfo');
INSERT INTO met_config VALUES('42','metconfig_sitemap_txt','0','','0','0','metinfo');
INSERT INTO met_config VALUES('43','metconfig_sitemap_xml','1','','0','0','metinfo');
INSERT INTO met_config VALUES('44','metconfig_index_type','cn','','0','0','metinfo');
INSERT INTO met_config VALUES('45','metconfig_nurse_monitor_weekb','1','','0','0','metinfo');
INSERT INTO met_config VALUES('46','physical_time','2013-12-26 17:23:41','','0','0','metinfo');
INSERT INTO met_config VALUES('47','physical_admin','0','','0','0','metinfo');
INSERT INTO met_config VALUES('48','physical_backup','0','','0','0','metinfo');
INSERT INTO met_config VALUES('49','physical_update','528','','0','0','metinfo');
INSERT INTO met_config VALUES('50','physical_seo','1|1|1|','','0','0','metinfo');
INSERT INTO met_config VALUES('51','physical_static','1','','0','0','metinfo');
INSERT INTO met_config VALUES('52','physical_unread','0|3|0','','0','0','metinfo');
INSERT INTO met_config VALUES('53','physical_spam','1','','0','0','metinfo');
INSERT INTO met_config VALUES('54','physical_member','1','','0','0','metinfo');
INSERT INTO met_config VALUES('55','physical_web','0','','0','0','metinfo');
INSERT INTO met_config VALUES('56','physical_file','2|include/common.inc.php|,2|include/global/pseudo.php|,2|include/global/showmod.php|,2|include/global.func.php|,2|include/head.php|,1|install_bak/index.php|,1|install_bak/js/IE6-png.js|,1|install_bak/js/install.js|,1|lang/google_lang.php|,2|lang/lang.php|,2|lang/lang_en.php|,1|lang.php|,2|member/captcha.class.php|,2|member/save.php|,1|power.php|,1|public/js/mobile.js|,2|public/php/metlabel.inc.php|,2|wap/index.php|,2|admin/admin/save.php|,2|admin/app/dlapp/delapp.php|,2|admin/app/sms/sms.php|,1|admin/app/wap/content.php|,1|admin/app/wap/flash.php|,1|admin/app/wap/flashadd.php|,1|admin/app/wap/flashdelete.php|,1|admin/app/wap/flashedit.php|,1|admin/app/wap/flashsave.php|,1|admin/app/wap/index.php|,1|admin/app/wap/list.php|,1|admin/app/wap/map.php|,1|admin/app/wap/setflash.php|,1|admin/app/wap/skin_editor.php|,1|admin/app/wap/skin_manager.php|,2|admin/app/wap/wap.php|,2|admin/column/copycolumn.php|,2|admin/content/content.php|,2|admin/include/captcha.class.php|,2|admin/include/global.func.php|,2|admin/include/lang.php|,2|admin/include/metlist.php|,2|admin/include/return.php|,2|admin/interface/skin.php|,2|admin/interface/skin_editor.php|,2|admin/interface/skin_manager.php|,2|admin/seo/htm.php|,2|admin/system/lang/lang.php|,2|admin/system/olupdate.php|,2|admin/system/shortcut.php|,2|admin/system/shortcut_editor.php|,2|admin/system/sysadmin.php|,2|admin/system/universal.php|,2|admin/templates/met/admin/admin.html|,2|admin/templates/met/admin/admin_editor.html|,2|admin/templates/met/app/dlapp/dlapp.html|,2|admin/templates/met/app/dlapp/index.html|,2|admin/templates/met/app/sms/sms.html|,1|admin/templates/met/app/wap/content.html|,1|admin/templates/met/app/wap/flash.html|,1|admin/templates/met/app/wap/flashadd.html|,1|admin/templates/met/app/wap/flashedit.html|,1|admin/templates/met/app/wap/index.html|,1|admin/templates/met/app/wap/list.html|,1|admin/templates/met/app/wap/map.html|,1|admin/templates/met/app/wap/setflash.html|,1|admin/templates/met/app/wap/skin.html|,1|admin/templates/met/app/wap/skin_editor.html|,1|admin/templates/met/app/wap/top.html|,2|admin/templates/met/app/wap/wap.html|,2|admin/templates/met/content/article/article.html|,2|admin/templates/met/content/content.html|,2|admin/templates/met/content/download/download.html|,2|admin/templates/met/content/img/img.html|,2|admin/templates/met/content/product/product.html|,2|admin/templates/met/head.html|,2|admin/templates/met/images/js/iframes.js|,2|admin/templates/met/images/js/metinfo.js|,2|admin/templates/met/index.html|,2|admin/templates/met/interface/online/online.html|,2|admin/templates/met/interface/set_skin.html|,2|admin/templates/met/interface/skin.html|,2|admin/templates/met/interface/skin_editor.html|,2|admin/templates/met/seo/htm.html|,2|admin/templates/met/system/database/filedown.html|,2|admin/templates/met/system/set_safe.html|,2|admin/templates/met/system/shortcut.html|,2|admin/templates/met/system/shortcut_editor.html|,2|admin/templates/met/system/sysadmin.html|,2|admin/templates/met/system/universal.html|,2|admin/templates/met/system/uploadfile.html|,1|public/ui/mobile/addlink.html|,1|public/ui/mobile/ajax/download.html|,1|public/ui/mobile/ajax/img.html|,1|public/ui/mobile/ajax/job.html|,1|public/ui/mobile/ajax/member/cv.html|,1|public/ui/mobile/ajax/member/feedback.html|,1|public/ui/mobile/ajax/member/message.html|,1|public/ui/mobile/ajax/message.html|,1|public/ui/mobile/ajax/news.html|,1|public/ui/mobile/ajax/product.html|,1|public/ui/mobile/ajax/seach.html|,1|public/ui/mobile/cv.html|,1|public/ui/mobile/download.html|,1|public/ui/mobile/feedback.html|,1|public/ui/mobile/gap.html|,1|public/ui/mobile/img.html|,1|public/ui/mobile/job.html|,1|public/ui/mobile/link_index.html|,1|public/ui/mobile/member/basic.html|,1|public/ui/mobile/member/cv.html|,1|public/ui/mobile/member/cv_detail.html|,1|public/ui/mobile/member/editor.html|,1|public/ui/mobile/member/feedback.html|,1|public/ui/mobile/member/feedback_detail.html|,1|public/ui/mobile/member/getpassword.html|,1|public/ui/mobile/member/login.html|,1|public/ui/mobile/member/message.html|,1|public/ui/mobile/member/message_detail.html|,1|public/ui/mobile/member/register.html|,1|public/ui/mobile/member.html|,1|public/ui/mobile/message_index.html|,1|public/ui/mobile/news.html|,1|public/ui/mobile/product.html|,1|public/ui/mobile/search.html|,1|public/ui/mobile/show.html|,1|public/ui/mobile/showdownload.html|,1|public/ui/mobile/showimg.html|,1|public/ui/mobile/showjob.html|,1|public/ui/mobile/shownews.html|,1|public/ui/mobile/showproduct.html|,1|public/ui/mobile/sitemap.html|,2|wap/templates/met/head.html|','','0','0','metinfo');
INSERT INTO met_config VALUES('57','physical_fingerprint','3|install_bak/index.php|,3|install_bak/js/IE6-png.js|,3|install_bak/js/install.js|,3|lang/google_lang.php|,3|public/js/mobile.js|,3|templates/leadway/addlink.php|,3|templates/leadway/config.php|,3|templates/leadway/config02.php|,3|templates/leadway/cv.php|,3|templates/leadway/database.inc.php|,3|templates/leadway/download.php|,3|templates/leadway/feedback.php|,3|templates/leadway/foot.php|,3|templates/leadway/head.php|,3|templates/leadway/head03.php|,3|templates/leadway/images/js/cn.index.js|,3|templates/leadway/images/js/fixPNG.js|,3|templates/leadway/images/js/fun.inc.js|,3|templates/leadway/images/js/fun.inc01.js|,3|templates/leadway/images/js/image.js|,3|templates/leadway/images/js/indexx.js|,3|templates/leadway/images/js/jquery.slider.min.js|,3|templates/leadway/img.php|,3|templates/leadway/index.php|,3|templates/leadway/info.html|,3|templates/leadway/job.php|,3|templates/leadway/link_index.php|,3|templates/leadway/login.php|,3|templates/leadway/member.php|,3|templates/leadway/message.php|,3|templates/leadway/message_index.php|,3|templates/leadway/metinfo.inc.php|,3|templates/leadway/news.php|,3|templates/leadway/otherinfo.inc.php|,3|templates/leadway/product.php|,3|templates/leadway/register.php|,3|templates/leadway/search.php|,3|templates/leadway/show.php|,3|templates/leadway/showdownload.php|,3|templates/leadway/showimg.php|,3|templates/leadway/showjob.php|,3|templates/leadway/shownews.php|,3|templates/leadway/showproduct.php|,3|templates/leadway/sidebar.php|,3|templates/leadway/sidebar02.php|,3|templates/leadway/sitemap.php|,3|templates/wap001/block/about.html|,3|templates/wap001/block/imgtxt.html|,3|templates/wap001/block/imgtxtshow.html|,3|templates/wap001/block/map.html|,3|templates/wap001/block/newslist.html|,3|templates/wap001/config.html|,3|templates/wap001/foot.html|,3|templates/wap001/head.html|,3|templates/wap001/images/css/css.inc.php|,3|templates/wap001/images/gmu/js/core/event.js|,3|templates/wap001/images/gmu/js/core/gmu.js|,3|templates/wap001/images/gmu/js/core/widget.js|,3|templates/wap001/images/gmu/js/extend/detect.js|,3|templates/wap001/images/gmu/js/extend/event.ortchange.js|,3|templates/wap001/images/gmu/js/extend/event.scrollStop.js|,3|templates/wap001/images/gmu/js/extend/fix.js|,3|templates/wap001/images/gmu/js/extend/highlight.js|,3|templates/wap001/images/gmu/js/extend/imglazyload.js|,3|templates/wap001/images/gmu/js/extend/iscroll.js|,3|templates/wap001/images/gmu/js/extend/matchMedia.js|,3|templates/wap001/images/gmu/js/extend/offset.js|,3|templates/wap001/images/gmu/js/extend/parseTpl.js|,3|templates/wap001/images/gmu/js/extend/position.js|,3|templates/wap001/images/gmu/js/extend/support.js|,3|templates/wap001/images/gmu/js/extend/throttle.js|,3|templates/wap001/images/gmu/js/extend/touch.js|,3|templates/wap001/images/gmu/js/widget/add2desktop/add2desktop.js|,3|templates/wap001/images/gmu/js/widget/button/$input.js|,3|templates/wap001/images/gmu/js/widget/button/button.js|,3|templates/wap001/images/gmu/js/widget/calendar/$picker.js|,3|templates/wap001/images/gmu/js/widget/calendar/calendar.js|,3|templates/wap001/images/gmu/js/widget/dialog/$position.js|,3|templates/wap001/images/gmu/js/widget/dialog/dialog.js|,3|templates/wap001/images/gmu/js/widget/dropmenu/dropmenu.js|,3|templates/wap001/images/gmu/js/widget/dropmenu/horizontal.js|,3|templates/wap001/images/gmu/js/widget/dropmenu/placement.js|,3|templates/wap001/images/gmu/js/widget/gotop/$iscroll.js|,3|templates/wap001/images/gmu/js/widget/gotop/gotop.js|,3|templates/wap001/images/gmu/js/widget/historylist/historylist.js|,3|templates/wap001/images/gmu/js/widget/navigator/$scrollable.js|,3|templates/wap001/images/gmu/js/widget/navigator/evenness.js|,3|templates/wap001/images/gmu/js/widget/navigator/navigator.js|,3|templates/wap001/images/gmu/js/widget/navigator/scrolltonext.js|,3|templates/wap001/images/gmu/js/widget/panel/panel.js|,3|templates/wap001/images/gmu/js/widget/popover/arrow.js|,3|templates/wap001/images/gmu/js/widget/popover/collision.js|,3|templates/wap001/images/gmu/js/widget/popover/dismissible.js|,3|templates/wap001/images/gmu/js/widget/popover/placement.js|,3|templates/wap001/images/gmu/js/widget/popover/popover.js|,3|templates/wap001/images/gmu/js/widget/progressbar/progressbar.js|,3|templates/wap001/images/gmu/js/widget/refresh/$iOS5.js|,3|templates/wap001/images/gmu/js/widget/refresh/$iscroll.js|,3|templates/wap001/images/gmu/js/widget/refresh/$lite.js|,3|templates/wap001/images/gmu/js/widget/refresh/refresh.js|,3|templates/wap001/images/gmu/js/widget/slider/$autoplay.js|,3|templates/wap001/images/gmu/js/widget/slider/$dynamic.js|,3|templates/wap001/images/gmu/js/widget/slider/$lazyloadimg.js|,3|templates/wap001/images/gmu/js/widget/slider/$multiview.js|,3|templates/wap001/images/gmu/js/widget/slider/$touch.js|,3|templates/wap001/images/gmu/js/widget/slider/arrow.js|,3|templates/wap001/images/gmu/js/widget/slider/dots.js|,3|templates/wap001/images/gmu/js/widget/slider/imgzoom.js|,3|templates/wap001/images/gmu/js/widget/slider/slider.js|,3|templates/wap001/images/gmu/js/widget/suggestion/$iscroll.js|,3|templates/wap001/images/gmu/js/widget/suggestion/$posadapt.js|,3|templates/wap001/images/gmu/js/widget/suggestion/$quickdelete.js|,3|templates/wap001/images/gmu/js/widget/suggestion/compatdata.js|,3|templates/wap001/images/gmu/js/widget/suggestion/renderlist.js|,3|templates/wap001/images/gmu/js/widget/suggestion/sendrequest.js|,3|templates/wap001/images/gmu/js/widget/suggestion/suggestion.js|,3|templates/wap001/images/gmu/js/widget/tabs/$ajax.js|,3|templates/wap001/images/gmu/js/widget/tabs/$swipe.js|,3|templates/wap001/images/gmu/js/widget/tabs/tabs.js|,3|templates/wap001/images/gmu/js/widget/toolbar/$position.js|,3|templates/wap001/images/gmu/js/widget/toolbar/toolbar.js|,3|templates/wap001/images/gmu/js/zepto.js|,3|templates/wap001/images/js/fun.inc.js|,3|templates/wap001/images/js/met_Verification.js|,3|templates/wap001/index.html|,3|templates/wap001/metinfo.inc.php|,3|templates/wap001/mtop.html|,3|templates/wap001/otherinfo.inc.php|,3|templates/wap001/sidebar.html|,3|templates/wap001/top.html|,3|templates/yongtai/config.php|,3|templates/yongtai/foot.php|,3|templates/yongtai/head.php|,3|templates/yongtai/images/js/fun.inc.js|,3|templates/yongtai/images/js/lavaLamp/flash.js|,3|templates/yongtai/images/js/lavaLamp/jquery-1.1.3.1.min.js|,3|templates/yongtai/images/js/lavaLamp/jquery.easing.min.js|,3|templates/yongtai/images/js/lavaLamp/jquery.lavalamp.js|,3|templates/yongtai/images/js/lavaLamp/jquery.lavalamp.min.js|,3|templates/yongtai/img.php|,3|templates/yongtai/index.php|,3|templates/yongtai/metinfo.inc.php|,3|templates/yongtai/otherinfo.inc.php|,3|templates/yongtai/product.php|,3|templates/yongtai/showproduct.php|,3|templates/yongtai/sidebar.php|,3|admin/app/wap/content.php|,3|admin/app/wap/flash.php|,3|admin/app/wap/flashadd.php|,3|admin/app/wap/flashdelete.php|,3|admin/app/wap/flashedit.php|,3|admin/app/wap/flashsave.php|,3|admin/app/wap/index.php|,3|admin/app/wap/list.php|,3|admin/app/wap/map.php|,3|admin/app/wap/setflash.php|,3|admin/app/wap/skin_editor.php|,3|admin/app/wap/skin_manager.php|,3|admin/templates/met/app/wap/content.html|,3|admin/templates/met/app/wap/flash.html|,3|admin/templates/met/app/wap/flashadd.html|,3|admin/templates/met/app/wap/flashedit.html|,3|admin/templates/met/app/wap/index.html|,3|admin/templates/met/app/wap/list.html|,3|admin/templates/met/app/wap/map.html|,3|admin/templates/met/app/wap/setflash.html|,3|admin/templates/met/app/wap/skin.html|,3|admin/templates/met/app/wap/skin_editor.html|,3|admin/templates/met/app/wap/top.html|,2|config/config_safe.php|,1|cx.php|,1|file.php|,2|include/common.inc.php|,2|include/global/pseudo.php|,2|include/global/showmod.php|,2|include/global.func.php|,2|include/head.php|,2|include/lang.php|,1|install/index.php|,1|install/js/IE6-png.js|,1|install/js/install.js|,1|install/lang_cn_520.php|,1|install/lang_en_520.php|,1|install/phpinfo.php|,2|lang/lang.php|,1|lang/lang_cn.php|,2|lang/lang_en.php|,1|lang/lang_insert.php|,2|lang.php|,2|member/captcha.class.php|,2|member/save.php|,2|power.php|,2|public/php/metlabel.inc.php|,2|wap/index.php|,2|templates/default/config.html|,2|templates/default/index.html|,2|templates/default/metinfo.inc.php|,2|admin/admin/add.php|,2|admin/admin/save.php|,2|admin/app/dlapp/delapp.php|,2|admin/app/physical/physical.fun.php|,2|admin/app/physical/trust.php|,2|admin/app/sms/sms.php|,2|admin/app/wap/wap.php|,2|admin/column/copycolumn.php|,2|admin/content/content.php|,2|admin/include/captcha.class.php|,2|admin/include/global.func.php|,2|admin/include/lang.php|,2|admin/include/metlist.php|,2|admin/include/return.php|,2|admin/interface/flash/flash.php|,2|admin/interface/flash/flashdelete.php|,2|admin/interface/flash/flashsave.php|,2|admin/interface/flash/setflash.php|,2|admin/interface/skin.php|,2|admin/interface/skin_editor.php|,2|admin/interface/skin_manager.php|,2|admin/seo/htm.php|,2|admin/system/database/recovery.php|,2|admin/system/lang/lang.php|,2|admin/system/olupdate.php|,2|admin/system/shortcut.php|,2|admin/system/shortcut_editor.php|,2|admin/system/sysadmin.php|,2|admin/system/universal.php|,2|admin/templates/met/admin/admin.html|,2|admin/templates/met/admin/admin_add.html|,2|admin/templates/met/admin/admin_editor.html|,2|admin/templates/met/app/dlapp/dlapp.html|,2|admin/templates/met/app/dlapp/index.html|,2|admin/templates/met/app/sms/sms.html|,2|admin/templates/met/app/wap/wap.html|,2|admin/templates/met/content/article/article.html|,2|admin/templates/met/content/content.html|,2|admin/templates/met/content/download/download.html|,2|admin/templates/met/content/img/img.html|,2|admin/templates/met/content/product/product.html|,2|admin/templates/met/head.html|,2|admin/templates/met/images/js/iframes.js|,2|admin/templates/met/images/js/metinfo.js|,2|admin/templates/met/index.html|,2|admin/templates/met/interface/flash/flash.html|,2|admin/templates/met/interface/flash/flashadd.html|,2|admin/templates/met/interface/flash/flashedit.html|,2|admin/templates/met/interface/flash/setflash.html|,1|admin/templates/met/interface/flash/top.html|,2|admin/templates/met/interface/online/online.html|,2|admin/templates/met/interface/set_skin.html|,2|admin/templates/met/interface/skin.html|,2|admin/templates/met/interface/skin_editor.html|,1|admin/templates/met/interface/skin_top.html|,2|admin/templates/met/metlangs.html|,2|admin/templates/met/seo/htm.html|,2|admin/templates/met/seo/sitemap.html|,2|admin/templates/met/system/database/filedown.html|,2|admin/templates/met/system/set_safe.html|,2|admin/templates/met/system/shortcut.html|,2|admin/templates/met/system/shortcut_editor.html|,2|admin/templates/met/system/sysadmin.html|,2|admin/templates/met/system/universal.html|,2|admin/templates/met/system/uploadfile.html|','','0','0','metinfo');
INSERT INTO met_config VALUES('58','physical_function','1','','0','0','metinfo');
INSERT INTO met_config VALUES('59','metconfig_member_force','byuqujz','','0','0','metinfo');
INSERT INTO met_config VALUES('61','metconfig_nurse_sendtime','10','','0','0','metinfo');
INSERT INTO met_config VALUES('62','metconfig_recycle','1','','0','0','metinfo');
INSERT INTO met_config VALUES('534','metconfig_tablename','admin_array|admin_table|app|admin_column|column|config|cv|download|feedback|flash|flist|img|job|label|lang|language|link|list|message|news|online|otherinfo|parameter|plist|product|skin_table|sms|visit_day|visit_detail|visit_summary|mlist|ifcolumn|ifcolumn_addfile|ifmember_left|applist|app_plugin|wapmenu|infoprompt|templates|user|user_group|user_list|user_other','','0','0','metinfo');
INSERT INTO met_config VALUES('539','metconfig_smsprice','0.1','','0','0','metinfo');
INSERT INTO met_config VALUES('540','metconfig_agents_logo_login','templates/met/images/login-logo.png','','0','0','metinfo');
INSERT INTO met_config VALUES('541','metconfig_agents_logo_index','templates/met/images/logoen.gif','','0','0','metinfo');
INSERT INTO met_config VALUES('542','metconfig_agents_copyright_foot','Powered by <b><a href=http://www.metinfo.cn target=_blank>MetInfo $metcms_v</a></b> &copy;2008-$m_now_year &nbsp;<a href=http://www.metinfo.cn target=_blank>MetInfo Inc.</a>','','0','0','metinfo');
INSERT INTO met_config VALUES('543','metconfig_agents_type','0','','0','0','metinfo');
INSERT INTO met_config VALUES('554','metconfig_agents_code','','','0','0','metinfo');
INSERT INTO met_config VALUES('555','metconfig_agents_backup','metinfo','','0','0','metinfo');
INSERT INTO met_config VALUES('556','metconfig_agents_sms','1','','0','0','metinfo');
INSERT INTO met_config VALUES('557','metconfig_agents_app','1','','0','0','metinfo');
INSERT INTO met_config VALUES('558','metconfig_agents_img','public/images/metinfo.gif','','0','0','metinfo');
INSERT INTO met_config VALUES('561','metconfig_newcmsv','','','0','0','metinfo');
INSERT INTO met_config VALUES('562','metconfig_patch','0','','0','0','metinfo');
INSERT INTO met_config VALUES('564','metconfig_app_sysver','|5.0 Beta|5.0|5.0.1|5.0.2|5.0.3|5.0.4|5.1.0|5.1.1|5.1.2|5.1.3|5.1.4|5.1.5|5.1.6|5.1.7|5.2.0|5.2.1|5.2.2|5.2.3|5.2.4|5.2.5|5.2.6','','0','0','metinfo');
INSERT INTO met_config VALUES('565','metconfig_app_info','0|1373858456','','0','0','metinfo');
INSERT INTO met_config VALUES('544','metconfig_agents_thanks','感谢使用 Metinfo','','0','0','cn-metinfo');
INSERT INTO met_config VALUES('545','metconfig_agents_depict_login','打造具有营销价值的企业网站','','0','0','cn-metinfo');
INSERT INTO met_config VALUES('546','metconfig_agents_name','Metinfo企业网站管理系统','','0','0','cn-metinfo');
INSERT INTO met_config VALUES('547','metconfig_agents_copyright','长沙米拓信息技术有限公司（MetInfo Inc.）','','0','0','cn-metinfo');
INSERT INTO met_config VALUES('548','metconfig_agents_about','关于我们','','0','0','cn-metinfo');
INSERT INTO met_config VALUES('549','metconfig_agents_thanks','thanks use Metinfo','','0','0','en-metinfo');
INSERT INTO met_config VALUES('550','metconfig_agents_depict_login','Metinfo Build marketing value corporate website','','0','0','en-metinfo');
INSERT INTO met_config VALUES('551','metconfig_agents_name','Metinfo CMS','','0','0','en-metinfo');
INSERT INTO met_config VALUES('552','metconfig_agents_copyright','China Changsha MetInfo Information Co., Ltd.','','0','0','en-metinfo');
INSERT INTO met_config VALUES('553','metconfig_agents_about','About Us','','0','0','en-metinfo');
INSERT INTO met_config VALUES('567','metconfig_secret_key','','','0','0','metinfo');
INSERT INTO met_config VALUES('568','metconfig_host_new','app.metinfo.cn','','0','0','metinfo');
INSERT INTO met_config VALUES('569', 'metconfig_editor', 'ueditor', '', '0', '0', 'metinfo');
INSERT INTO met_config VALUES('570','met_sms_url', 'https://appv2.metinfo.cn/sms', '', '0', '0', 'metinfo');
INSERT INTO met_config VALUES('571','met_sms_token', '', '', '0', '0', 'metinfo');

INSERT INTO met_admin_column VALUES('5', 'lang_unitytxt_39', '', '0', '0', '1', '7', '<i class="fa fa-sliders"></i>', '', '1');
INSERT INTO met_admin_column VALUES('73', 'lang_member', 'index.php?n=user&c=admin_user&a=doindex', '72', '1601', '2', '1', '<i class="fa fa-users"></i>', '', '1');
INSERT INTO met_admin_column VALUES('2', 'lang_content', '', '0', '0', '1', '1', '', '', '1');
INSERT INTO met_admin_column VALUES('3', 'lang_marketing', '', '0', '0', '1', '2', '<i class="fa fa-money"></i>', '', '1');
INSERT INTO met_admin_column VALUES('4', 'lang_application', '', '0', '0', '1', '4', '', '', '1');
INSERT INTO met_admin_column VALUES('74', 'lang_safety', '', '0', '0', '1', '6', '<i class="fa fa-shield"></i>', '', '1');
INSERT INTO met_admin_column VALUES('10', 'lang_language', 'system/lang/lang.php', '5', '1002', '2', '3', '<i class="fa fa-language"></i>', '', '1');
INSERT INTO met_admin_column VALUES('11', 'lang_indexpic', 'system/img.php', '5', '1003', '2', '4', '<i class="fa fa-picture-o"></i>', '', '1');
INSERT INTO met_admin_column VALUES('12', 'lang_safety_efficiency', 'system/safe.php', '74', '1004', '2', '1', '<i class="fa fa-shield"></i>', '', '1');
INSERT INTO met_admin_column VALUES('13', 'lang_data_processing', 'system/database/index.php', '74', '1005', '2', '2', '<i class="fa fa-database"></i>', '', '1');
INSERT INTO met_admin_column VALUES('14', 'lang_upfiletips2', 'system/uploadfile.php', '44', '1006', '3', '7', 'uploadfile.png', 'lang_dlapptips16');
INSERT INTO met_admin_column VALUES('57', 'lang_upfiletips7', 'index.php?n=webset&c=webset&a=doindex', '5', '1007', '2', '0', '<i class="fa fa-newspaper-o"></i>', '', '1');
INSERT INTO met_admin_column VALUES('18', 'lang_computer', 'index.php?n=theme&c=theme&a=doindex', '69', '1101', '2', '1', '<i class="fa fa-desktop"></i>', '', '1');
INSERT INTO met_admin_column VALUES('25', 'lang_htmColumn', 'column/index.php', '5', '1201', '2', '2', '<i class="fa fa-sitemap"></i>', '', '1');
INSERT INTO met_admin_column VALUES('29', 'lang_administration', 'content/content.php', '2', '1301', '2', '2', '<i class="fa fa-th-large"></i>', '', '1');
INSERT INTO met_admin_column VALUES('71', 'lang_customers', 'interface/online/index.php', '3', '1106', '2', '2', '<i class="fa fa-comments-o"></i>', '', '1');
INSERT INTO met_admin_column VALUES('70', 'lang_adminmobile', 'index.php?n=theme&c=theme&a=doindex&mobile=1', '69', '1102', '2', '2', '<i class="fa fa-mobile"></i>', '', '1');
INSERT INTO met_admin_column VALUES('69', 'lang_appearance', '', '0', '0', '1', '3', '<i class="fa fa-tachometer"></i>', '', '1');
INSERT INTO met_admin_column VALUES('34', 'lang_indexwebcount', 'app/stat/index.php', '3', '1401', '2', '1', '<i class="fa fa-line-chart"></i>', '', '1');
INSERT INTO met_admin_column VALUES('37', 'lang_seo', 'index.php?n=seo&c=seo&a=doindex', '3', '1404', '2', '3', '<i class="fa fa-check"></i>', '', '1');
INSERT INTO met_admin_column VALUES('39', 'lang_indexlink', 'seo/link/index.php', '3', '1406', '2', '4', '<i class="fa fa-link"></i>', '', '1');
INSERT INTO met_admin_column VALUES('40', 'lang_smsfuc', 'app/sms/sms.php', '44', '1503', '3', '3', 'sms.png', 'lang_dlapptips12', '0');
INSERT INTO met_admin_column VALUES('42', 'lang_webnanny', 'app/nurse/index.php', '44', '1504', '3', '4', 'nurse.png', 'lang_dlapptips13', '0');
INSERT INTO met_admin_column VALUES('43', 'lang_indexPhysical', 'app/physical/index.php', '44', '1501', '3', '7', 'physical.png', 'lang_dlapptips17', '1');
INSERT INTO met_admin_column VALUES('44', 'lang_myapp', 'index.php?n=myapp&c=myapp&&a=doindex', '4', '1505', '2', '1', '<i class="fa fa-paper-plane"></i>', '', '1');
INSERT INTO met_admin_column VALUES('47', 'lang_managertyp2', 'admin/index.php', '72', '1603', '2', '2', '<i class="fa fa-users"></i>', '', '1');
INSERT INTO met_admin_column VALUES('68', 'lang_release', 'index.php?n=content&c=content&a=doadd', '2', '1301', '2', '1', '<i class="fa fa-plus"></i>', '', '1');
INSERT INTO met_admin_column VALUES('72', 'lang_the_user', '', '0', '0', '1', '5', '<i class="fa fa-user"></i>', '', '1');
INSERT INTO met_admin_column VALUES('75', 'lang_checkupdate', 'index.php?n=about&c=about&a=doindex', '5', '1104', '2', '5', '<i class="fa fa-info-circle"></i>', '', '1');
INSERT INTO met_admin_column VALUES('65', 'lang_dlapptips2', 'index.php?n=appstore&c=appstore&a=doindex', '4', '1507', '2', '9999', '<i class="fa fa-cube"></i>', '', '1');
INSERT INTO met_admin_column VALUES('77', 'lang_mobile_edition', 'app/wap/wap.php', '5', '1103', '2', '1', '<i class="fa fa-mobile"></i>', '', '1');
INSERT INTO met_otherinfo VALUES('1','NOUSER','2147483647','','','','','','','','','','','','','','','','','metinfo');
INSERT INTO met_skin_table VALUES('1','metx5','metx5','MetInfo v5.3正式版新推出一套全新精致免费模板！','0','');
INSERT INTO met_skin_table VALUES('2','metv5','metv5','MetInfo v5.2正式版！','0','');
INSERT INTO met_skin_table VALUES('3','metx5_mobile','metx5_mobile','MetInfo v5.3正式版新推出一套全新精致免费手机模板！','1','');
INSERT INTO met_lang VALUES('2','English','1','2','en','en','','','0','0','','','metinfo');
INSERT INTO met_lang VALUES('1','简体中文','1','1','cn','cn','','','0','0','','','metinfo');
INSERT INTO met_lang VALUES('5','繁體中文','1','3','tc','tc','','','0','0','','','metinfo');
INSERT INTO met_admin_array VALUES('3','管理员','metinfo','1','metinfo','0','10000','256','2','metinfo','metinfo');

INSERT INTO met_parameter VALUES('100','公司名称','' ,'','9','1','0','0','0','0','0','10','cn','1');
INSERT INTO met_parameter VALUES('101','Company name','','','9','1','0','0','0','0','0','10','en','1');
INSERT INTO met_parameter VALUES('102','公司名稱','','','9','1','0','0','0','0','0','10','tc','1');
INSERT INTO met_parameter VALUES('103','公司传真','','','10','1','0','0','0','0','0','10','cn','1');
INSERT INTO met_parameter VALUES('104','Fax','','','10','1','0','0','0','0','0','10','en','1');
INSERT INTO met_parameter VALUES('105','公司傳真','','','10','1','0','0','0','0','0','10','tc','1');
INSERT INTO met_parameter VALUES('106','公司联系地址','','','11','1','0','0','0','0','0','10','cn','1');
INSERT INTO met_parameter VALUES('107','Company address','','','11','1','0','0','0','0','0','10','en','1');
INSERT INTO met_parameter VALUES('108','公司聯繫地址','','','11','1','0','0','0','0','0','10','tc','1');
INSERT INTO met_parameter VALUES('109','公司邮政编码','','','12','1','0','0','0','0','0','10','cn','1');
INSERT INTO met_parameter VALUES('110','Company Postcode','','','12','1','0','0','0','0','0','10','en','1');
INSERT INTO met_parameter VALUES('111','公司郵政編碼','','','12','1','0','0','0','0','0','10','tc','1');
INSERT INTO met_parameter VALUES('112','公司网址','','','13','1','0','0','0','0','0','10','cn','1');
INSERT INTO met_parameter VALUES('113','Website','','','13','1','0','0','0','0','0','10','en','1');
INSERT INTO met_parameter VALUES('114','公司網址','','','13','1','0','0','0','0','0','10','tc','1');

DROP TABLE IF EXISTS `met_user`;
CREATE TABLE IF NOT EXISTS `met_user` (
  `id` int(11) NOT NULL auto_increment,
  `username` varchar(30) NOT NULL,
  `password` varchar(32) NOT NULL,
  `head` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `tel` varchar(20) NOT NULL,
  `groupid` int(11) NOT NULL,
  `register_time` int(11) NOT NULL,
  `register_ip` varchar(15) NOT NULL,
  `login_time` int(11) NOT NULL,
  `login_count` int(11) NOT NULL,
  `login_ip` varchar(15) NOT NULL,
  `valid` int(1) NOT NULL,
  `source` varchar(20) NOT NULL,
  `lang` varchar(50) NOT NULL,
  `uid` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;

DROP TABLE IF EXISTS `met_user_group`;
CREATE TABLE IF NOT EXISTS `met_user_group` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `name` varchar(255) NOT NULL,
  `access` int(11) NOT NULL,
  `lang` varchar(50) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `met_user_list`;
CREATE TABLE IF NOT EXISTS `met_user_list` (
  `id` int(11) NOT NULL auto_increment,
  `listid` int(11) default NULL,
  `paraid` int(11) default NULL,
  `info` text,
  `lang` varchar(50) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `met_user_other`;
CREATE TABLE IF NOT EXISTS `met_user_other` (
  `id` int(11) NOT NULL auto_increment,
  `metconfig_uid` int(11) NOT NULL,
  `openid` varchar(100) NOT NULL,
  `unionid` varchar(100) NOT NULL,
  `access_token` varchar(255) NOT NULL,
  `expires_in` int(11) NOT NULL,
  `type` varchar(10) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `openid` (`openid`),
  KEY `metconfig_uid` (`metconfig_uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;

DROP TABLE IF EXISTS `met_app`;
CREATE TABLE `met_app` (
  `id` int(11) NOT NULL auto_increment,
  `no` varchar(10) NOT NULL,
  `ver` varchar(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `file` varchar(255) NOT NULL,
  `download` tinyint(1) NOT NULL,
  `power` int(11) NOT NULL,
  `sys` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `site` varchar(255) NOT NULL,
  `url` tinytext NOT NULL,
  `info` text NOT NULL,
  `addtime` int(11) NOT NULL,
  `updatetime` int(11) NOT NULL,
  `display` int(11) NOT NULL default '1',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
INSERT INTO met_app VALUES('2', '2', '1.0', '地址栏图标', 'ico', '0', '0', '5.0 Beta', '5.jpg', '0', '', '能够上传制作好的ICO小图标，该图标会显示在浏览器顶部的左上角。', '0', '0', '1');
INSERT INTO met_app VALUES('3', '3', '1.0', '分享按钮', 'share', '0', '0', '5.0 Beta', '6.jpg', '2', '/app/share/share.php', '常常看到一些页面有分享按钮，此应用就可以设置分享按钮，或者自定义分享按钮代码。', '0', '0', '1');
INSERT INTO met_app VALUES('4', '4', '1.0', '内容批量替换器', 'replace', '0', '0', '5.0 Beta', '8.jpg', '0', '', '能够批量替换内容文字、超链接、图片路径，如公司地址、电话、某个链接地址变更，逐个修改效率太低，此应用是很好的解决办法。', '0', '0', '1');
INSERT INTO met_app VALUES('5', '5', '1.1', '在线订购', 'shop', '0', '1', '5.1.2', '9.jpg', '2-3-4', '/app/shop/2.php-/app/shop/3.php-/app/shop/4.php', '可以为产品内容页增加立即购买按钮并支持在线购买产品，有购物车功能和顺畅的购买流程，网站后台可以查看会员下的订单、财务流水，也可以根据需求设置在线订购的部分功能，目前只支持支付宝即时到帐接口且只支持中文（多语言在线订购功能后续升级包会推出）。', '0', '0', '1');
INSERT INTO met_app VALUES('6', '6', '1.0', '站内广告', 'advs', '0', '1', '5.1.6', 'advs.png', '2', '/app/advs/advs.php', '目前支持三种广告方式：对联广告、通栏广告（页面顶部展开后隐藏或悬浮页面中间）、右下角广告（支持自定义HTML）。能够将广告投放在指定栏目页面中，可以设置广告开始日期和结束日期（结束后不再展示），可以设置广告在页面出现后展示时长（超过时间自动消失）等。', '1368489600', '1368489600', '1');
INSERT INTO met_app VALUES('7', '7', '1.0', 'robots在线修改器', 'robots', '0', '0', '5.0 Beta', 'robots.png', '', '', '网站通过robots协议告诉搜索引擎哪些页面可以抓取，哪些页面不能抓取。此工具用来在线修改robots。', '0', '0', '1');
INSERT INTO met_app VALUES('8', '8', '1.12', '手机版（商业版）', 'wap', '0', '1', '5.2.9', 'wap.png', '1-2', '/app/wap/wapjs.php-/app/wap/menu_map.php', '用于网站在移动终端展示的功能', '1389002714', '1410307200', '1');
INSERT INTO met_app VALUES('9', '9', '1.01', '微信公众号管理系统', 'weixin', '0', '0', '5.2.3', 'weixin.jpg', '1', '/app/weixin/is_weixin.php', '自定义菜单、微官网、智能回复...移动网络营销必备！企业网络营销不仅仅是在电脑上，手机市场更需要争夺。', '1395044072', '1395044072', '1');
INSERT INTO met_app VALUES('10', '10', '1.01', '360安全检测', '360', '0', '0', '5.2.5', '360.jpg', '1', '/app/360/360wed.php', '由360安装中心提供的网站安全应用，拥有防护黑客攻击与后门木马查杀两大功能。', '0', '0', '1');