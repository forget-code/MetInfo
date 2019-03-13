DROP TABLE IF EXISTS `met_admin_array`;
CREATE TABLE `met_admin_array` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `array_name` varchar(255) NOT NULL,
  `admin_type` text NOT NULL,
  `admin_ok` int(11) NOT NULL default '0',
  `admin_op` varchar(30) default 'metinfo',
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
  `admin_op` varchar(30) default 'metinfo',
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
  `icon` varchar(100) default '',
  `nofollow` tinyint(1) default '0',
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
  `links` varchar(200) default NULL,
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
  `height_m` int(11) default NULL,
  `height_t` int(11) default NULL,
  `mobile_img_path` varchar(255) default NULL,
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


DROP TABLE IF EXISTS `met_lang_admin`;
CREATE TABLE `met_lang_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL COMMENT '语言名称',
  `useok` int(1) NOT NULL COMMENT '语言是否开启，1开启，0不开启',
  `no_order` int(11) NOT NULL COMMENT '排序',
  `mark` varchar(50) NOT NULL COMMENT '语言标识（唯一）',
  `synchronous` varchar(50) NOT NULL COMMENT '同步官方语言标识',
  `link` varchar(255) NOT NULL COMMENT '语言外部链接',
  `lang` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
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
  `nofollow` tinyint(1) default '0',
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
  `checkok` int(11) NOT NULL DEFAULT '0',
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
  `related` varchar(50) default NULL,
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
  `target` int(11) NOT NULL,
  `own_order` varchar(11) NOT NULL,
  `effect` int(1) NOT NULL,
  `lang` varchar(50) NOT NULL,
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
  `mlangok`  int(1) NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `met_app_config`;
CREATE TABLE `met_app_config` (
  `id` int(11) NOT NULL auto_increment,
  `appno` int(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `value` text NOT NULL,
  `lang` varchar(50) NOT NULL,
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
  `bigclass` int(10) DEFAULT 0,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `met_ui_list`;
CREATE TABLE `met_ui_list` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `installid` int(10) NOT NULL,
  `parent_name` varchar(100) NOT NULL,
  `ui_name` varchar(100) NOT NULL,
  `skin_name` varchar(100) NOT NULL,
  `ui_page` varchar(200) NOT NULL,
  `ui_title` varchar(100) NOT NULL,
  `ui_description` varchar(500) NOT NULL,
  `ui_order` int(10) NOT NULL DEFAULT '0',
  `ui_version` varchar(100) NOT NULL,
  `ui_installtime` int(10) NOT NULL,
  `ui_edittime` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `met_ui_config`;
CREATE TABLE `met_ui_config` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(10) NOT NULL,
  `parent_name` varchar(100) NOT NULL,
  `ui_name` varchar(100) NOT NULL,
  `skin_name` varchar(100) NOT NULL,
  `uip_type` int(10) NOT NULL,
  `uip_style` tinyint(1) NOT NULL,
  `uip_select` varchar(500) NOT NULL DEFAULT '1',
  `uip_name` varchar(100) NOT NULL,
  `uip_key` varchar(100) NOT NULL,
  `uip_value` text NOT NULL,
  `uip_default` varchar(255) NOT NULL,
  `uip_title` varchar(100) NOT NULL,
  `uip_description` varchar(255) NOT NULL,
  `uip_order` int(10) unsigned NOT NULL DEFAULT '0',
  `lang` varchar(100) NOT NULL,
  `uip_hidden` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

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
  `idvalid` int(1) unsigned NOT NULL DEFAULT '0' COMMENT '实名认证状态',
  `reidinfo` varchar(100) DEFAULT NULL COMMENT '实名信息  姓名|身份证|手机号',
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

DROP TABLE IF EXISTS `met_user_group_pay`;
CREATE TABLE IF NOT EXISTS`met_user_group_pay` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `groupid` int(11) NOT NULL COMMENT '会员组ID',
  `price` double(10,2) NOT NULL COMMENT '购买价格',
  `recharge_price` double(10,2) NOT NULL  COMMENT '充值价格',
  `buyok` int(1) NOT NULL COMMENT '付费会员',
  `rechargeok` int(50) NOT NULL COMMENT '充值会员',
  `lang` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

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

DROP TABLE IF EXISTS `met_app_config`;
CREATE TABLE `met_app_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `appno` int(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `value` text NOT NULL,
  `lang` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `met_para`;
CREATE TABLE `met_para` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(10) NOT NULL,
  `value` varchar(255) DEFAULT NULL,
  `module` int(10) NOT NULL,
  `order` int(10) DEFAULT '0',
  `lang` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

INSERT INTO met_applist VALUES(null, '0', '1.0', 'ueditor', 'index', 'doindex', '百度编辑器', '编辑器', '0', '0', '0','0','',0);
INSERT INTO met_applist VALUES(null,'10070','1.2', 'metconfig_sms', 'index', 'doindex', '短信功能', '短信接口', '0', '0', '0','1','',0);
INSERT INTO met_applist VALUES(null,'50002','1.0', 'metconfig_template', 'temtool', 'dotemlist', '官方模板管理工具', '官方商业模板请在此进行管理操作', '0', '0', '0','2','',1);
INSERT INTO met_config VALUES(null,'metconfig_nurse_link_tel','','','0','0','metinfo');
INSERT INTO met_config VALUES(null,'metconfig_nurse_link','0','','0','0','metinfo');
INSERT INTO met_config VALUES(null,'metcms_v','6.1.3','','0','0','metinfo');
INSERT INTO met_config VALUES(null,'metconfig_nurse_job_tel','','','0','0','metinfo');
INSERT INTO met_config VALUES(null,'metconfig_nurse_job','0','','0','0','metinfo');
INSERT INTO met_config VALUES(null,'metconfig_nurse_massge_tel','','','0','0','metinfo');
INSERT INTO met_config VALUES(null,'metconfig_nurse_massge','0','','0','0','metinfo');
INSERT INTO met_config VALUES(null,'metconfig_nurse_feed_tel','','','0','0','metinfo');
INSERT INTO met_config VALUES(null,'metconfig_nurse_feed','0','','0','0','metinfo');
INSERT INTO met_config VALUES(null,'metconfig_nurse_member_tel','','','0','0','metinfo');
INSERT INTO met_config VALUES(null,'metconfig_nurse_member','0','','0','0','metinfo');
INSERT INTO met_config VALUES(null,'metconfig_nurse_monitor_tel','','','0','0','metinfo');
INSERT INTO met_config VALUES(null,'metconfig_nurse_monitor_timeb','23','','0','0','metinfo');
INSERT INTO met_config VALUES(null,'metconfig_nurse_monitor_timea','0','','0','0','metinfo');
INSERT INTO met_config VALUES(null,'metconfig_apptime','1373858456','','0','0','metinfo');
INSERT INTO met_config VALUES(null,'metconfig_nurse_monitor_weeka','1','','0','0','metinfo');
INSERT INTO met_config VALUES(null,'metconfig_nurse_monitor_fre','1','','0','0','metinfo');
INSERT INTO met_config VALUES(null,'metconfig_nurse_monitor','0','','0','0','metinfo');
INSERT INTO met_config VALUES(null,'metconfig_host','api.metinfo.cn','','0','0','metinfo');
INSERT INTO met_config VALUES(null,'metconfig_nurse_stat','0','','0','0','metinfo');
INSERT INTO met_config VALUES(null,'metconfig_nurse_stat_tel','','','0','0','metinfo');
INSERT INTO met_config VALUES(null,'metconfig_nurse_max','10','','0','0','metinfo');
INSERT INTO met_config VALUES(null,'metconfig_adminfile','9626k1yDhwTy+UEvnusgMWahnI7/uzBEoErEoZbV1jugFg','','0','0','metinfo');
INSERT INTO met_config VALUES(null,'metconfig_ch_lang','1','','0','0','metinfo');
INSERT INTO met_config VALUES(null,'metconfig_stat_max','10000','','0','0','metinfo');
INSERT INTO met_config VALUES(null,'metconfig_stat_cr5','2','','0','0','metinfo');
INSERT INTO met_config VALUES(null,'metconfig_stat_cr4','3','','0','0','metinfo');
INSERT INTO met_config VALUES(null,'metconfig_stat_cr3','3','','0','0','metinfo');
INSERT INTO met_config VALUES(null,'metconfig_stat_cr1','0','','0','0','metinfo');
INSERT INTO met_config VALUES(null,'metconfig_stat_cr2','3','','0','0','metinfo');
INSERT INTO met_config VALUES(null,'metconfig_stat','1','','0','0','metinfo');
INSERT INTO met_config VALUES(null,'metconfig_ch_mark','cn','','0','0','metinfo');
INSERT INTO met_config VALUES(null,'metconfig_lang_editor','','','0','0','metinfo');
INSERT INTO met_config VALUES(null,'metconfig_lang_mark','1','','0','0','metinfo');
INSERT INTO met_config VALUES(null,'metconfig_agents_web_site','','','0','0','metinfo');
INSERT INTO met_config VALUES(null,'metconfig_admin_type_ok','0','','0','0','metinfo');
INSERT INTO met_config VALUES(null,'metconfig_admin_type','cn','','0','0','metinfo');
INSERT INTO met_config VALUES(null,'metconfig_sitemap_lang','1','','0','0','metinfo');
INSERT INTO met_config VALUES(null,'metconfig_sitemap_not2','1','','0','0','metinfo');
INSERT INTO met_config VALUES(null,'metconfig_sitemap_not1','0','','0','0','metinfo');
INSERT INTO met_config VALUES(null,'metconfig_sitemap_txt','0','','0','0','metinfo');
INSERT INTO met_config VALUES(null,'metconfig_sitemap_xml','1','','0','0','metinfo');
INSERT INTO met_config VALUES(null,'metconfig_index_type','cn','','0','0','metinfo');
INSERT INTO met_config VALUES(null,'metconfig_nurse_monitor_weekb','1','','0','0','metinfo');
INSERT INTO met_config VALUES(null,'metconfig_member_force','byuqujz','','0','0','metinfo');
INSERT INTO met_config VALUES(null,'metconfig_nurse_sendtime','10','','0','0','metinfo');
INSERT INTO met_config VALUES(null,'metconfig_recycle','1','','0','0','metinfo');
INSERT INTO met_config VALUES(null,'metconfig_tablename','admin_array|admin_table|app|admin_column|column|config|cv|download|feedback|flash|flist|img|job|label|lang|lang_admin|language|link|list|message|news|online|otherinfo|para|parameter|plist|product|skin_table|sms|visit_day|visit_detail|visit_summary|mlist|ifcolumn|ifcolumn_addfile|ifmember_left|applist|app_plugin|app_config|wapmenu|infoprompt|templates|user|user_group|user_list|user_other|ui_list|ui_config|app_config|lang_admin|user_group_pay','','0','0','metinfo');
INSERT INTO met_config VALUES(null,'metconfig_smsprice','0.1','','0','0','metinfo');
INSERT INTO met_config VALUES(null,'metconfig_agents_logo_login','templates/met/images/login-logo.png','','0','0','metinfo');
INSERT INTO met_config VALUES(null,'metconfig_agents_logo_index','templates/met/images/logoen.gif','','0','0','metinfo');
INSERT INTO met_config VALUES(null,'metconfig_agents_copyright_foot','Powered by <b><a href=http://www.metinfo.cn target=_blank>MetInfo $metcms_v</a></b> &copy;2008-$m_now_year &nbsp;<a href=http://www.metinfo.cn target=_blank>MetInfo Inc.</a>','','0','0','metinfo');
INSERT INTO met_config VALUES(null,'metconfig_agents_type','0','','0','0','metinfo');
INSERT INTO met_config VALUES(null,'metconfig_agents_code','','','0','0','metinfo');
INSERT INTO met_config VALUES(null,'metconfig_agents_backup','metinfo','','0','0','metinfo');
INSERT INTO met_config VALUES(null,'metconfig_agents_sms','1','','0','0','metinfo');
INSERT INTO met_config VALUES(null,'metconfig_agents_app','1','','0','0','metinfo');
INSERT INTO met_config VALUES(null,'metconfig_agents_img','public/images/metinfo.gif','','0','0','metinfo');
INSERT INTO met_config VALUES(null,'metconfig_newcmsv','','','0','0','metinfo');
INSERT INTO met_config VALUES(null,'metconfig_patch','0','','0','0','metinfo');
INSERT INTO met_config VALUES(null,'metconfig_app_sysver','|5.0 Beta|5.0|5.0.1|5.0.2|5.0.3|5.0.4|5.1.0|5.1.1|5.1.2|5.1.3|5.1.4|5.1.5|5.1.6|5.1.7|5.2.0|5.2.1|5.2.2|5.2.3|5.2.4|5.2.5|5.2.6','','0','0','metinfo');
INSERT INTO met_config VALUES(null,'metconfig_app_info','0|1373858456','','0','0','metinfo');
INSERT INTO met_config VALUES(null,'metconfig_agents_thanks','感谢使用 Metinfo','','0','0','cn-metinfo');
INSERT INTO met_config VALUES(null,'metconfig_agents_depict_login','MetInfo','','0','0','cn-metinfo');
INSERT INTO met_config VALUES(null,'metconfig_agents_name','Metinfo企业网站管理系统','','0','0','cn-metinfo');
INSERT INTO met_config VALUES(null,'metconfig_agents_copyright','长沙米拓信息技术有限公司（MetInfo Inc.）','','0','0','cn-metinfo');
INSERT INTO met_config VALUES(null,'metconfig_agents_about','关于我们','','0','0','cn-metinfo');
INSERT INTO met_config VALUES(null,'metconfig_agents_thanks','thanks use Metinfo','','0','0','en-metinfo');
INSERT INTO met_config VALUES(null,'metconfig_agents_depict_login','Metinfo Build marketing value corporate website','','0','0','en-metinfo');
INSERT INTO met_config VALUES(null,'metconfig_agents_name','Metinfo CMS','','0','0','en-metinfo');
INSERT INTO met_config VALUES(null,'metconfig_agents_copyright','China Changsha MetInfo Information Co., Ltd.','','0','0','en-metinfo');
INSERT INTO met_config VALUES(null,'metconfig_agents_about','About Us','','0','0','en-metinfo');
INSERT INTO met_config VALUES(null,'metconfig_secret_key','','','0','0','metinfo');
INSERT INTO met_config VALUES(null,'metconfig_host_new','app.metinfo.cn','','0','0','metinfo');
INSERT INTO met_config VALUES(null,'metconfig_editor', 'ueditor', '', '0', '0', 'metinfo');
INSERT INTO met_config VALUES(null,'metconfig_sms_url', 'https://appv2.metinfo.cn/sms', '', '0', '0', 'metinfo');
INSERT INTO met_config VALUES(null,'metconfig_sms_token', '', '', '0', '0', 'metinfo');
INSERT INTO met_config VALUES(NULL, 'metconfig_agents_metmsg', '1', '', '', '', 'metinfo');
INSERT INTO met_config VALUES(null, 'metconfig_safe_prompt', '0', '', '0', '0', 'metinfo');

INSERT INTO met_admin_column VALUES('5','lang_unitytxt_39','','0','0','1','7','<i class=\"fa fa-sliders\"></i>','','1');
INSERT INTO met_admin_column VALUES('73','lang_member','index.php?n=user&c=admin_user&a=doindex','72','1601','2','1','<i class=\"fa fa-users\"></i>','','1');
INSERT INTO met_admin_column VALUES('2','lang_content','','0','0','1','1','','','1');
INSERT INTO met_admin_column VALUES('3','lang_marketing','','0','0','1','2','<i class=\"fa fa-money\"></i>','','1');
INSERT INTO met_admin_column VALUES('4','lang_application','','0','0','1','4','','','1');
INSERT INTO met_admin_column VALUES('74','lang_safety','','0','0','1','6','<i class=\"fa fa-shield\"></i>','','1');
INSERT INTO met_admin_column VALUES('10','lang_language','index.php?n=language&c=language_admin&a=doindex','5','1002','2','3','<i class=\"fa fa-language\"></i>','','1');
INSERT INTO met_admin_column VALUES('11','lang_indexpic','index.php?n=imgmanager&c=imgmanager&a=dowatermark','5','1003','2','4','<i class=\"fa fa-picture-o\"></i>','','1');
INSERT INTO met_admin_column VALUES('12','lang_safety_efficiency','index.php?n=safe&c=index&a=doindex','74','1004','2','1','<i class=\"fa fa-shield\"></i>','','1');
INSERT INTO met_admin_column VALUES('13','lang_data_processing','index.php?n=databack&c=index&a=doindex','74','1005','2','2','<i class=\"fa fa-database\"></i>','','1');
INSERT INTO met_admin_column VALUES('57','lang_upfiletips7','index.php?n=webset&c=webset&a=doindex','5','1007','2','0','<i class=\"fa fa-newspaper-o\"></i>','','1');
INSERT INTO met_admin_column VALUES('18','lang_computer','index.php?n=theme&c=theme&a=doindex','69','1101','2','1','<i class=\"fa fa-desktop\"></i>','','1');
INSERT INTO met_admin_column VALUES('25','lang_htmColumn','index.php?n=column&c=index&a=doindex','5','1201','2','2','<i class=\"fa fa-sitemap\"></i>','','1');
INSERT INTO met_admin_column VALUES('29','lang_administration','index.php?n=manage&c=index&a=doindex','2','1301','2','2','<i class=\"fa fa-th-large\"></i>','','1');
INSERT INTO met_admin_column VALUES('71','lang_customers','index.php?n=online&c=online&a=doindex','3','1106','2','2','<i class=\"fa fa-comments-o\"></i>','','1');
INSERT INTO met_admin_column VALUES('70','lang_adminmobile','index.php?n=theme&c=theme&a=doindex&mobile=1','69','1102','2','2','<i class=\"fa fa-mobile\"></i>','','1');
INSERT INTO met_admin_column VALUES('69','lang_appearance','','0','0','1','3','<i class=\"fa fa-tachometer\"></i>','','1');
INSERT INTO met_admin_column VALUES('37','lang_seo','index.php?n=seo&c=seo&a=doindex','3','1404','2','3','<i class=\"fa fa-check\"></i>','','1');
INSERT INTO met_admin_column VALUES('39','lang_indexlink','index.php?n=link&c=link_admin&a=doindex','3','1406','2','4','<i class=\"fa fa-link\"></i>','','1');
INSERT INTO met_admin_column VALUES('40','lang_smsfuc','app/sms/sms.php','44','1503','3','3','sms.png','lang_dlapptips12','0');
INSERT INTO met_admin_column VALUES('42','lang_webnanny','app/nurse/index.php','44','1504','3','4','nurse.png','lang_dlapptips13','0');
INSERT INTO met_admin_column VALUES('43','lang_indexPhysical','index.php?n=physical&c=physical_admin&&a=doindex','44','1501','3','7','physical.png','lang_dlapptips17','1');
INSERT INTO met_admin_column VALUES('44','lang_myapp','index.php?n=myapp&c=myapp&&a=doindex','4','1505','2','1','<i class=\"fa fa-paper-plane\"></i>','','1');
INSERT INTO met_admin_column VALUES('47','lang_managertyp2','index.php?n=admin&c=admin_admin&a=doindex','72','1603','2','2','<i class=\"fa fa-users\"></i>','','1');
INSERT INTO met_admin_column VALUES('68','lang_release','index.php?n=content&c=content&a=doadd','2','1301','2','1','<i class=\"fa fa-plus\"></i>','','1');
INSERT INTO met_admin_column VALUES('72','lang_the_user','','0','0','1','5','<i class=\"fa fa-user\"></i>','','1');
INSERT INTO met_admin_column VALUES('75','lang_checkupdate','index.php?n=update&c=about&a=doindex','5','1104','2','5','<i class=\"fa fa-info-circle\"></i>','','1');
INSERT INTO met_admin_column VALUES('65','lang_dlapptips2','index.php?n=appstore&c=appstore&a=doappstore','4','1507','2','9999','<i class=\"fa fa-cube\"></i>','','1');


INSERT INTO met_otherinfo VALUES('1','NOUSER','2147483647','','','','','','','','','','','','','','','','','metinfo');
INSERT INTO met_skin_table VALUES('1','metv6','metv6','MetInfo v6.0正式版新推出一套全新精致免费模板！','0','');
INSERT INTO met_lang VALUES('2','English','1','2','en','en','','','0','0','','','metinfo');
INSERT INTO met_lang VALUES('1','简体中文','1','1','cn','cn','','','0','0','','','metinfo');
INSERT INTO met_admin_array VALUES('3','管理员','metinfo','1','metinfo','0','10000','256','2','metinfo','metinfo');
