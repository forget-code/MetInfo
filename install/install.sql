treat SQL syntax error;
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
  PRIMARY KEY  (`id`),
  KEY `admin_id` (`admin_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `met_column`;
CREATE TABLE `met_column` (
  `id` int(11) NOT NULL auto_increment,
  `c_name` char(100) default NULL,
  `e_name` char(100) default NULL,
  `foldername` char(50) default NULL,
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
  `c_out_url` char(200) default NULL,
  `list_order` int(11) default '0',
  `new_windows` char(50) default NULL,
  `classtype` int(11) default '1',
  `e_out_url` char(200) default NULL,
  `index_num` int(11) default '0',
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
  `downloadurl` varchar(300) default NULL,
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
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `met_fdlist`;
CREATE TABLE `met_fdlist` (
  `id` int(11) NOT NULL auto_increment,
  `bigid` int(11) default NULL,
  `c_list` varchar(255) default NULL,
  `e_list` varchar(255) default NULL,
  `no_order` int(11) default NULL,
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
  `imgurl` varchar(300) default NULL,
  `imgurls` varchar(300) default NULL,
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
  `link_ok` int(11) default NULL,
  `link_img` int(11) default NULL,
  `link_text` int(11) default NULL,
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
  `imgurl` varchar(300) default NULL,
  `imgurls` varchar(300) default NULL,
  `com_ok` int(1) default '0',
  `issue` varchar(100) default NULL,
  `hits` int(11) default '0',
  `updatetime` datetime default NULL,
  `addtime` datetime default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `met_online`;
CREATE TABLE `met_online` (
  `id` int(11) NOT NULL auto_increment,
  `c_name` char(200) default NULL,
  `e_name` char(200) default NULL,
  `no_order` int(11) default NULL,
  `qq` char(100) default NULL,
  `msn` char(100) default NULL,
  `taobao` char(100) default NULL,
  `alibaba` char(100) default NULL,
  `skype` char(100) default NULL,
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
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `met_parameter`;
CREATE TABLE `met_parameter` (
  `id` int(11) NOT NULL auto_increment,
  `name` char(100) default NULL,
  `c_mark` char(200) default NULL,
  `e_mark` char(200) default NULL,
  `use_ok` int(1) default '0',
  `no_order` int(11) default NULL,
  `type` int(11) default '0',
  `maxsize` char(200) NOT NULL default '200',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
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
  `imgurl` varchar(300) default NULL,
  `imgurls` varchar(300) default NULL,
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
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `met_skin_table`;
CREATE TABLE `met_skin_table` (
  `id` int(11) NOT NULL auto_increment,
  `skin_name` char(200) default NULL,
  `skin_file` char(20) default NULL,
  `skin_info` text,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `met_column` VALUES (1,'关于我们','About','about','about',0,1,1,'0','1','','','<p class=\"p16\" style=\"margin-top: 0pt; margin-bottom: 0pt\"><span style=\"font-size: 10.5pt; font-family: \'宋体\'; mso-spacerun: \'yes\'\"><img height=\"150\" hspace=\"3\" width=\"150\" align=\"left\" vspace=\"3\" alt=\"\" src=\"../upload/logoimg.gif\" />米拓信息（MetInfo.cn</span><span style=\"font-size: 10.5pt; font-family: \'宋体\'; mso-spacerun: \'yes\'\">）</span><span style=\"font-size: 10.5pt; font-family: \'宋体\'; mso-spacerun: \'yes\'\">专注于</span><span style=\"font-size: 10.5pt; font-family: \'宋体\'; mso-spacerun: \'yes\'\">网络信息化及</span><span style=\"font-size: 10.5pt; font-family: \'宋体\'; mso-spacerun: \'yes\'\">网络营销领域，通过整合团队专业的市场营销理念与网络技术为客户提供优质的网络营销服务。</span></p>\r\n<p class=\"p16\" style=\"margin-top: 0pt; margin-bottom: 0pt\">&nbsp;</p>\r\n<p class=\"p16\" style=\"margin-top: 0pt; margin-bottom: 0pt\"><span style=\"font-size: 10.5pt; font-family: \'宋体\'; mso-spacerun: \'yes\'\">米拓信息的主要业务包括：</span><span style=\"font-size: 10.5pt; font-family: \'宋体\'; mso-spacerun: \'yes\'\">网站系统开发、</span><span style=\"font-size: 10.5pt; font-family: \'宋体\'; mso-spacerun: \'yes\'\">网站建设、网站推广、空间域名以及网络营销策划与运行。</span></p>\r\n<p class=\"p16\" style=\"margin-top: 0pt; margin-bottom: 0pt\">&nbsp;</p>\r\n<p class=\"p16\" style=\"margin-top: 0pt; margin-bottom: 0pt\"><span style=\"font-size: 10.5pt; font-family: \'宋体\'; mso-spacerun: \'yes\'\">米拓信息</span><span style=\"font-size: 10.5pt; font-family: \'宋体\'; mso-spacerun: \'yes\'\">主打产品&mdash;&mdash;</span><span style=\"font-size: 10.5pt; font-family: \'宋体\'; mso-spacerun: \'yes\'\">MetInfo企业网站管理系统采用PHP+Mysql架构，全站内置了SEO搜索引擎优化机制，拥有企业网站常用的模块功能（企业简介模块、新闻模块、产品模块、下载模块、图片模块、招聘模块、在线留言、反馈系统、在线交流、友情链接）。强大灵活的后台管理功能、静态页面生成功能、个性化模块添加功能等可为企业打造出大气漂亮且具有营销力的精品网站。</span></p>\r\n<p class=\"p16\" style=\"margin-top: 0pt; margin-bottom: 0pt\">&nbsp;</p>\r\n<p class=\"p16\" style=\"margin-top: 0pt; margin-bottom: 0pt\"><span style=\"font-size: 10.5pt; font-family: \'宋体\'; mso-spacerun: \'yes\'\">米拓信息</span><span style=\"font-size: 10.5pt; font-family: \'宋体\'; mso-spacerun: \'yes\'\">秉承&ldquo;为合作伙伴创造价值&rdquo;的核心价值观，并以&ldquo;诚实、宽容、创新、服务&rdquo;为企业精神，通过自主创新和真诚合作为电子商务及信息服务行业创造价值。</span></p>\r\n<p class=\"p16\" style=\"margin-top: 0pt; margin-bottom: 0pt\">&nbsp;</p>\r\n<p class=\"p16\" style=\"margin-top: 0pt; margin-bottom: 0pt\"><span style=\"font-weight: bold; font-size: 10.5pt; font-family: \'宋体\'; mso-spacerun: \'yes\'\">关于&ldquo;为合作伙伴创造价值&rdquo;</span><span style=\"font-size: 10.5pt; font-family: \'宋体\'; mso-spacerun: \'yes\'\"><o:p></o:p></span></p>\r\n<p class=\"p16\" style=\"margin-top: 0pt; margin-bottom: 0pt\"><span style=\"font-size: 10.5pt; font-family: \'宋体\'; mso-spacerun: \'yes\'\">　　</span><span style=\"font-size: 10.5pt; font-family: \'宋体\'; mso-spacerun: \'yes\'\">米拓信息</span><span style=\"font-size: 10.5pt; font-family: \'宋体\'; mso-spacerun: \'yes\'\">认为客户、供应商、公司股东、公司员工等一切和自身有合作关系的单位和个人都是自己的合作伙伴，并只有通过努力为合作伙伴创造价值，才能体现自身的价值并获得发展和成功。</span><span style=\"font-size: 10.5pt; font-family: \'宋体\'; mso-spacerun: \'yes\'\"><o:p></o:p></span></p>\r\n<p class=\"p16\" style=\"margin-top: 0pt; margin-bottom: 0pt\"><span style=\"font-size: 10.5pt; font-family: \'宋体\'; mso-spacerun: \'yes\'\"><br />\r\n</span><span style=\"font-weight: bold; font-size: 10.5pt; font-family: \'宋体\'; mso-spacerun: \'yes\'\">关于&ldquo;诚实、宽容、创新、服务&rdquo;</span><span style=\"font-size: 10.5pt; font-family: \'宋体\'; mso-spacerun: \'yes\'\"><o:p></o:p></span></p>\r\n<p class=\"p0\" style=\"margin-top: 0pt; margin-bottom: 0pt\"><span style=\"font-size: 10.5pt; font-family: \'Times New Roman\'; mso-spacerun: \'yes\'\"><font face=\"宋体\">　&nbsp;</font></span><span style=\"font-size: 10.5pt; font-family: \'宋体\'; mso-spacerun: \'yes\'\"><font face=\"宋体\">米拓信息</font></span><span style=\"font-size: 10.5pt; font-family: \'Times New Roman\'; mso-spacerun: \'yes\'\"><font face=\"宋体\">认为诚信是一切合作的基础，宽容是解决问题的前提，创新是发展事业的利器，服务是创造价值的根本。</font></span></p>\r\n<!--EndFragment-->','<p class=\"style2 style6\"><img height=\"150\" hspace=\"3\" width=\"150\" align=\"left\" vspace=\"3\" alt=\"\" src=\"../upload/logoimg.gif\" />MatISS is focused and specialized in the simulation of Materials and Information Service System. Our business includes the design and implementation of calculation and simulation of materials, the implementation and development of information service system, and so on.</p>\r\n<p class=\"style7\">MatISS Co.,Ltd is located in Changsha , developing the talent and technology of Central South University . We will do our best to offering the best service by gathering talents and technology innovation.</p>\r\n<p class=\"style7\">Our core value is &ldquo;Create Value for Partners&rdquo;, and &ldquo;Honesty, allowance, innovation, service&rdquo; is spirit of MatISS. We will make efforts to create value for materials industry and information service industry with the self-directed innovation and collaboration.</p>\r\n<p class=\"style7\"><strong>Materials Science Department </strong></p>\r\n<p class=\"style7\">There are including Materials Science Department and Information Service System Department in our company. By cooperating with Information Service System Department, Materials Science Department is focused and specialized in the fields of material science, and do our best to offering the whole enterprise solution of the simulation of Materials and Information Service for clients.</p>\r\n<p class=\"style7\"><strong>About &ldquo;Create Value for Partners&rdquo; </strong></p>\r\n<p class=\"style7\">MatISS thinks that all organization and persons which have cooperative relation with us are our partners, which include clients, suppliers, shareholders, employee and so on. Only doing our best to creating value for partners, MatISS will embody our value, develop and be successful.</p>\r\n<p class=\"style7\"><strong>About &ldquo;Honesty, Allowance, Innovation, Service&rdquo; </strong></p>\r\n<p class=\"style7\">Honesty is the base of all cooperation. Allowance is the prerequisite of solving problem, Innovation is the edge tool of development causes. Service is the basic of creating value.</p>','米拓信息的主要业务包括：网站系统开发、网站建设、网站推广、空间域名以及网络营销策划与运行。','MatISS Co.,Ltd is located in Changsha , developing the talent and technology of Central South University . We will do our best to offering the best service by gathering talents and technology innovation. ','',0,'',1,'',0);
INSERT INTO `met_column` VALUES (2,'联系我们','Contact','about','contact',1,1,1,'0','2','','','<p>&nbsp;</p>\r\n<p>地址：长沙市天心区赤岭路348号</p>\r\n<p>电话：0731-7133078 13873185250</p>\r\n<p>QQ：426507856</p>\r\n<p>邮编：410076</p>\r\n<p>email：<a href=\"mailto:sales@metinfo.cn\">sales@metinfo.cn</a></p>\r\n<p>网址：<a href=\"http://www.metinfo.cn/\">www.MetInfo.cn</a></p>','<p>&nbsp;</p>\r\n<p>Add:No 348,Chiling Road, Tianxin area, Changsha City</p>\r\n<p>Tel：0731-7133078 13873185250</p>\r\n<p>QQ：426507856</p>\r\n<p>Code：410076</p>\r\n<p>Email：<a href=\"mailto:sales@metinfo.cn\">sales@metinfo.cn</a></p>\r\n<p>Web：<a href=\"http://www.metinfo.cn/\">www.MetInfo.cn</a></p>','','','',0,'',2,'',0);
INSERT INTO `met_column` VALUES (3,'业务范围','Operation','about','operation',1,1,2,'0','0','','','<p>1、网站系统开发、信息系统开发；<br />\r\n2、网站建设、网站设计； <br />\r\n3、网站推广与网络营销；<br />\r\n4、营销策划；<br />\r\n5、空间域名</p>','<p>1、Developing web system and information system；<br />\r\n2、Web building,web design； <br />\r\n3、Web extend and web marketing；<br />\r\n4、Marketing；<br />\r\n5、Domain and IDC；</p>','','','',0,'',2,'',0);
INSERT INTO `met_column` VALUES (4,'新闻中心','News','news','',0,2,2,'0','1','','',NULL,NULL,'','','',1,'',1,'',2);
INSERT INTO `met_column` VALUES (5,'企业新闻','Enterprise News','news','',4,2,1,'0','0','','',NULL,NULL,'','','',1,'',2,'',0);
INSERT INTO `met_column` VALUES (6,'行业新闻','Industry News','news','',4,2,2,'0','0','','',NULL,NULL,'','','',1,'',2,'',0);
INSERT INTO `met_column` VALUES (7,'产品中心','Product','product','',0,3,3,'0','1','','',NULL,NULL,'','','',3,'',1,'',1);
INSERT INTO `met_column` VALUES (8,'家用电器','Household Appliances','product','',7,3,1,'0','0','','',NULL,NULL,'','','',3,'',2,'',0);
INSERT INTO `met_column` VALUES (9,'电视机','TV','product','',8,3,1,'0','0','','',NULL,NULL,'','','',3,'',3,'',0);
INSERT INTO `met_column` VALUES (10,'洗衣机','Washer','product','',8,3,2,'0','0','','',NULL,NULL,'','','',3,'',3,'',0);
INSERT INTO `met_column` VALUES (11,'办公电脑','Transacting Computer','product','',7,3,2,'0','0','','',NULL,NULL,'','','',3,'',2,'',0);
INSERT INTO `met_column` VALUES (12,'数码通讯','Digital Communication','product','',7,3,3,'0','0','','',NULL,NULL,'','','',3,'',2,'',0);
INSERT INTO `met_column` VALUES (13,'下载中心','Download','download','',0,4,4,'0','3','','',NULL,NULL,'','','',1,'',1,'',0);
INSERT INTO `met_column` VALUES (14,'文件下载','File Download','download','',13,4,1,'0','0','','',NULL,NULL,'','','',1,'',2,'',0);
INSERT INTO `met_column` VALUES (15,'软件下载','Software Download','download','',13,4,2,'0','0','','',NULL,NULL,'','','',1,'',2,'',0);
INSERT INTO `met_column` VALUES (16,'图片中心','Image','img','',0,5,6,'0','1','','',NULL,NULL,'','','',1,'',1,'',0);
INSERT INTO `met_column` VALUES (17,'常见问答','FAQ','faq','',0,2,7,'0','3','','','','','','','',1,'',1,'',0);
INSERT INTO `met_column` VALUES (18,'招聘中心','Job','job','',0,6,8,'0','3','','',NULL,NULL,'','','',0,'',1,'',0);
INSERT INTO `met_column` VALUES (19,'在线反馈','Feedback','',NULL,0,0,9,'1','1',NULL,NULL,NULL,NULL,NULL,NULL,'feedback/index.php',0,'',1,'feedback/index.php?en=en',0);
INSERT INTO `met_column` VALUES (20,'网站管理','Administer','',NULL,0,0,20,'1','2',NULL,NULL,NULL,NULL,NULL,NULL,'admin/',0,'target=\'_blank\'',1,'admin/',0);
INSERT INTO `met_column` VALUES (21,'交流论坛','Forum','',NULL,0,0,10,'1','1',NULL,NULL,NULL,NULL,NULL,NULL,'http://bbs.metinfo.cn',0,'target=\'_blank\'',1,'http://bbs.metinfo.cn',0);
INSERT INTO `met_column` VALUES (22,'在线留言','Leave Word','message','',0,7,9,'0','2','','',NULL,NULL,'','','',0,'',1,'',0);
INSERT INTO `met_column` VALUES (23,'友情链接','Friendly Link','',NULL,0,0,10,'1','2',NULL,NULL,NULL,NULL,NULL,NULL,'link/index.php',0,'',1,'link/index.php?en=en',0);
INSERT INTO `met_column` VALUES (24,'站内搜索','Search','',NULL,0,0,11,'1','2',NULL,NULL,NULL,NULL,NULL,NULL,'search/search.php',0,'',1,'search/search.php?en=en',0);

INSERT INTO `met_download` VALUES (1,'Metinfo企业网站管理系统介绍','MetInfo enterprise website manager system ','','','MetInfo企业网站管理系统采用PHP+Mysql架构，全站内置了SEO搜索引擎优化机制，拥有企业网站常用的模块功能（企业简介模块、新闻模块、产品模块、下载模块、图片模块、招聘模块、在线留言、反馈系统、在线交流、友情链接）。强大灵活的后台管理功能、静态页面生成功能、个性化模块添加功能等可为企业打造出大气漂亮且具有营销力的精品网站。','','<p>MetInfo企业网站管理系统采用PHP+Mysql架构，全站内置了SEO搜索引擎优化机制，拥有企业网站常用的模块功能（企业简介模块、新闻模块、产品模块、下载模块、图片模块、招聘模块、在线留言、反馈系统、在线交流、友情链接）。强大灵活的后台管理功能、静态页面生成功能、个性化模块添加功能等可为企业打造出大气漂亮且具有营销力的精品网站。</p>\r\n<p>功能介绍：<br />\r\n1、全站页面SEO信息设置，如关键词、页面描述等；<br />\r\n2、首页、内容页面静态生成功能；<br />\r\n3、三级栏目添加功能；<br />\r\n4、缩略图自动生成、图片文字水印自动添加功能；<br />\r\n5、直接根据后台栏目设置管理员权限功能；<br />\r\n6、热门标签设置功能；<br />\r\n7、模块参数后台设置功能；<br />\r\n8、数据库备份和恢复功能；<br />\r\n9、前台模板与程序分开，模板后台添加和切换功能；<br />\r\n10、中英文内容添加和首页切换功能；<br />\r\n&nbsp;</p>','<p>MetInfo企业网站管理系统采用PHP+Mysql架构，全站内置了SEO搜索引擎优化机制，拥有企业网站常用的模块功能（企业简介模块、新闻模块、产品模块、下载模块、图片模块、招聘模块、在线留言、反馈系统、在线交流、友情链接）。强大灵活的后台管理功能、静态页面生成功能、个性化模块添加功能等可为企业打造出大气漂亮且具有营销力的精品网站。</p>\r\n<p>功能介绍：<br />\r\n1、全站页面SEO信息设置，如关键词、页面描述等；<br />\r\n2、首页、内容页面静态生成功能；<br />\r\n3、三级栏目添加功能；<br />\r\n4、缩略图自动生成、图片文字水印自动添加功能；<br />\r\n5、直接根据后台栏目设置管理员权限功能；<br />\r\n6、热门标签设置功能；<br />\r\n7、模块参数后台设置功能；<br />\r\n8、数据库备份和恢复功能；<br />\r\n9、前台模板与程序分开，模板后台添加和切换功能；<br />\r\n10、中英文内容添加和首页切换功能；</p>',13,14,0,0,'../upload/file/1237385014.txt','2.31',0,4,'2009-03-19 11:32:18','2009-03-18 21:57:41','产品说明书','V1.0','','','','','','','','','Explain','V1.0','','','','','','','','','');
INSERT INTO `met_download` VALUES (2,'metinfo企业网站管理系统','Metinfo CMS','','','','','<p>MetInfo企业网站管理系统采用PHP+Mysql架构，全站内置了SEO搜索引擎优化机制，拥有企业网站常用的模块功能（企业简介模块、新闻模块、产品模块、下载模块、图片模块、招聘模块、在线留言、反馈系统、在线交流、友情链接）。强大灵活的后台管理功能、静态页面生成功能、个性化模块添加功能等可为企业打造出大气漂亮且具有营销力的精品网站。</p>\r\n<p>功能介绍：<br />\r\n1、全站页面SEO信息设置，如关键词、页面描述等；<br />\r\n2、首页、内容页面静态生成功能；<br />\r\n3、三级栏目添加功能；<br />\r\n4、缩略图自动生成、图片文字水印自动添加功能；<br />\r\n5、直接根据后台栏目设置管理员权限功能；<br />\r\n6、热门标签设置功能；<br />\r\n7、模块参数后台设置功能；<br />\r\n8、数据库备份和恢复功能；<br />\r\n9、前台模板与程序分开，模板后台添加和切换功能；<br />\r\n10、中英文内容添加和首页切换功能；</p>','<p>MetInfo企业网站管理系统采用PHP+Mysql架构，全站内置了SEO搜索引擎优化机制，拥有企业网站常用的模块功能（企业简介模块、新闻模块、产品模块、下载模块、图片模块、招聘模块、在线留言、反馈系统、在线交流、友情链接）。强大灵活的后台管理功能、静态页面生成功能、个性化模块添加功能等可为企业打造出大气漂亮且具有营销力的精品网站。</p>',13,15,0,0,'http://www.metinfo.cn','10',0,2,'2009-03-19 11:32:38','2009-03-19 11:32:38','软件','V1.0','','','','','','','','','software','V1.0','','','','','','','','','');

INSERT INTO `met_fdlist` VALUES (1,11,'北京','Beijin',1);
INSERT INTO `met_fdlist` VALUES (2,11,'天津','Tianjin',2);
INSERT INTO `met_fdlist` VALUES (3,11,'河北','Hebei',3);
INSERT INTO `met_fdlist` VALUES (4,11,'内蒙古','Neimenggu',4);
INSERT INTO `met_fdlist` VALUES (5,11,'黑龙江','Heilongjiang',5);
INSERT INTO `met_fdlist` VALUES (6,11,'辽宁','Liaoning',6);
INSERT INTO `met_fdlist` VALUES (7,11,'吉林','Jilin',7);
INSERT INTO `met_fdlist` VALUES (8,11,'山西','Shanxi',8);
INSERT INTO `met_fdlist` VALUES (9,11,'陕西','Shanxi',9);
INSERT INTO `met_fdlist` VALUES (10,11,'甘肃','Gansu',10);
INSERT INTO `met_fdlist` VALUES (11,11,'青海','Qinghai',11);
INSERT INTO `met_fdlist` VALUES (12,11,'宁夏','Ningxia',12);
INSERT INTO `met_fdlist` VALUES (13,11,'新疆','Xinjiang',13);
INSERT INTO `met_fdlist` VALUES (14,11,'西藏','Xizang',14);
INSERT INTO `met_fdlist` VALUES (15,11,'四川','Sichuan',15);
INSERT INTO `met_fdlist` VALUES (16,11,'重庆','Chongqing',16);
INSERT INTO `met_fdlist` VALUES (17,11,'云南','Yunnan',17);
INSERT INTO `met_fdlist` VALUES (18,11,'贵州','Guizhou',18);
INSERT INTO `met_fdlist` VALUES (19,11,'湖南','Hunan',19);
INSERT INTO `met_fdlist` VALUES (20,11,'湖北','Hubei',20);
INSERT INTO `met_fdlist` VALUES (21,11,'河南','Henan',21);
INSERT INTO `met_fdlist` VALUES (22,11,'山东','Shandong',22);
INSERT INTO `met_fdlist` VALUES (23,11,'安徽','Anhui',23);
INSERT INTO `met_fdlist` VALUES (24,11,'江苏','Jiangsu',24);
INSERT INTO `met_fdlist` VALUES (25,11,'上海','Shanghai',25);
INSERT INTO `met_fdlist` VALUES (26,11,'浙江','Zhejiang',26);
INSERT INTO `met_fdlist` VALUES (27,11,'江西','Jiangxi',27);
INSERT INTO `met_fdlist` VALUES (28,11,'福建','Fujian',28);
INSERT INTO `met_fdlist` VALUES (29,11,'广东','Guangdong',29);
INSERT INTO `met_fdlist` VALUES (30,11,'广西','Guangxi',30);
INSERT INTO `met_fdlist` VALUES (31,11,'海南','Hainan',31);
INSERT INTO `met_fdlist` VALUES (32,11,'港澳台','Gangaotai',32);
INSERT INTO `met_fdlist` VALUES (33,12,'索取资料','Get data',1);
INSERT INTO `met_fdlist` VALUES (34,12,'购买产品','Buy Product',2);
INSERT INTO `met_fdlist` VALUES (35,12,'技术咨询','Consultation',3);
INSERT INTO `met_fdlist` VALUES (36,21,'搜索引擎','Search Engine',1);
INSERT INTO `met_fdlist` VALUES (37,21,'网站链接','Web Link',2);
INSERT INTO `met_fdlist` VALUES (38,21,'朋友介绍','Friend Introduce',3);
INSERT INTO `met_fdlist` VALUES (39,21,'电视广告','TV AD',4);
INSERT INTO `met_fdlist` VALUES (40,21,'其他方式','Other way',5);

INSERT INTO `met_fdparameter` VALUES (1,'反馈主题','Subject',2,1,1,1);
INSERT INTO `met_fdparameter` VALUES (2,'姓名','Name',3,1,1,1);
INSERT INTO `met_fdparameter` VALUES (3,'职务','Duty',4,1,0,1);
INSERT INTO `met_fdparameter` VALUES (4,'Email','Email',5,1,1,1);
INSERT INTO `met_fdparameter` VALUES (5,'电话',' Tel',6,1,0,1);
INSERT INTO `met_fdparameter` VALUES (6,'手机','Mobile',7,1,0,1);
INSERT INTO `met_fdparameter` VALUES (7,'传真','Fax',8,1,0,1);
INSERT INTO `met_fdparameter` VALUES (8,'单位名称','Company',9,1,0,1);
INSERT INTO `met_fdparameter` VALUES (9,'详细地址','Add',11,1,0,1);
INSERT INTO `met_fdparameter` VALUES (10,'邮政编码','Postalcode',12,1,0,1);
INSERT INTO `met_fdparameter` VALUES (11,'省份','Province',10,1,0,2);
INSERT INTO `met_fdparameter` VALUES (12,'反馈类型','Type',1,1,1,2);
INSERT INTO `met_fdparameter` VALUES (13,'','',13,0,0,2);
INSERT INTO `met_fdparameter` VALUES (14,'','',14,0,0,2);
INSERT INTO `met_fdparameter` VALUES (15,'','',15,0,0,2);
INSERT INTO `met_fdparameter` VALUES (16,'信息描述','Infomation',16,1,1,3);
INSERT INTO `met_fdparameter` VALUES (17,'','',17,0,0,3);
INSERT INTO `met_fdparameter` VALUES (18,'','',18,0,0,3);
INSERT INTO `met_fdparameter` VALUES (19,'','',19,0,0,3);
INSERT INTO `met_fdparameter` VALUES (20,'','',20,0,0,3);
INSERT INTO `met_fdparameter` VALUES (21,'您是怎么找到我们的','How did you find us',16,1,0,4);
INSERT INTO `met_fdparameter` VALUES (22,'','',22,0,0,4);
INSERT INTO `met_fdparameter` VALUES (23,'','',23,0,0,4);
INSERT INTO `met_fdparameter` VALUES (24,'','',24,0,0,4);

INSERT INTO `met_feedback` VALUES (1,'111','12121','','metinfo@qq.com','','','','','','','湖南','索取资料','','','','ddddd','','','','','关键是变成串的形式以后还能够转化回来--反馈邮件','http://localhost/met/feedback/index.php?title=','127.0.0.1','2009-03-16 13:29:00',0,NULL,'',NULL,NULL,NULL,NULL);

INSERT INTO `met_img` VALUES (1,'演示图片1','Demo image 1','','','','','<p>演示图片1</p>','<p>Demo image 1</p>',16,0,0,0,'../upload/200903/watermark/1237385960.jpg','../upload/200903/thumb/1237385960.jpg',0,1,'2009-03-18 22:02:55','2009-03-18 22:02:55','','','','','','','','','','','','','','','','','','','','','');
INSERT INTO `met_img` VALUES (2,'演示图片2','Demo image 2','','','','','<p>演示图片2</p>','<p>Demo image 2</p>',16,0,0,0,'../upload/200903/watermark/1237385210.jpg','../upload/200903/thumb/1237385210.jpg',0,0,'2009-03-18 22:04:35','2009-03-18 22:04:35','','','','','','','','','','','','','','','','','','','','','');
INSERT INTO `met_img` VALUES (3,'演示图片3','Demo image 3','','','','','<p>演示图片3</p>','<p>Demo image 3</p>',16,0,0,0,'../upload/200903/watermark/1237385774.jpg','../upload/200903/thumb/1237385774.jpg',0,0,'2009-03-19 11:35:51','2009-03-18 22:05:18','','','','','','','','','','','','','','','','','','','','','');

INSERT INTO `met_index` VALUES (1,'<p><img height=\"150\" hspace=\"5\" width=\"200\" align=\"left\" vspace=\"5\" alt=\"\" src=\"upload/hibuilding2_004.jpg\" /><span style=\"font-size: 10.5pt\"><span style=\"font-size: 10.5pt; font-family: \'宋体\'; mso-spacerun: \'yes\'\">米拓信息（MetInfo.cn</span><span style=\"font-size: 10.5pt; font-family: \'宋体\'; mso-spacerun: \'yes\'\">）</span><span style=\"font-size: 10.5pt; font-family: \'宋体\'; mso-spacerun: \'yes\'\">专注于</span><span style=\"font-size: 10.5pt; font-family: \'宋体\'; mso-spacerun: \'yes\'\">网络信息化及</span><span style=\"font-size: 10.5pt; font-family: \'宋体\'; mso-spacerun: \'yes\'\">网络营销领域，通过整合团队专业的市场营销理念与网络技术为客户提供优质的网络营销服务。</span><span style=\"font-size: 10.5pt; font-family: \'宋体\'; mso-spacerun: \'yes\'\"><o:p></o:p></span></span></p>\r\n<p class=\"p17\" style=\"margin-top: 0pt; margin-bottom: 0pt\"><span style=\"font-size: 10.5pt; font-family: \'宋体\'; mso-spacerun: \'yes\'\">米拓信息的主要业务包括：</span><span style=\"font-size: 10.5pt; font-family: \'宋体\'; mso-spacerun: \'yes\'\">网站系统开发、</span><span style=\"font-size: 10.5pt; font-family: \'宋体\'; mso-spacerun: \'yes\'\">网站建设、网站推广、空间域名以及网络营销策划与运行。</span><span style=\"font-size: 10.5pt; font-family: \'宋体\'; mso-spacerun: \'yes\'\"><o:p></o:p></span></p>\r\n<p class=\"p17\" style=\"margin-top: 0pt; margin-bottom: 0pt\">&nbsp;</p>\r\n<p class=\"p17\" style=\"margin-top: 0pt; margin-bottom: 0pt\"><span style=\"font-size: 10.5pt; font-family: \'宋体\'; mso-spacerun: \'yes\'\">米拓信息</span><span style=\"font-size: 10.5pt; font-family: \'宋体\'; mso-spacerun: \'yes\'\">主打产品&mdash;&mdash;</span><span style=\"font-size: 10.5pt; font-family: \'宋体\'; mso-spacerun: \'yes\'\">MetInfo企业网站管理系统采用PHP+Mysql架构，全站内置了SEO搜索引擎优化机制，拥有企业网站常用的模块功能（企业简介模块、新闻模块、产品模块、下载模块、图片模块、招聘模块、在线留言、反馈系统、在线交流、友情链接）。强大灵活的后台管理功能、静态页面生成功能、个性化模块添加功能等可为企业打造出大气漂亮且具有营销力的精品网站。</span><span style=\"font-size: 10.5pt; font-family: \'宋体\'; mso-spacerun: \'yes\'\"><o:p></o:p></span></p>\r\n<!--EndFragment-->','<p><br />\r\n<img height=\"150\" hspace=\"5\" width=\"200\" align=\"left\" vspace=\"5\" alt=\"\" src=\"upload/hibuilding2_004.jpg\" /><span style=\"font-size: 10.5pt\"><span style=\"font-size: 10.5pt; font-family: \'宋体\'; mso-spacerun: \'yes\'\"><font face=\"Arial\">MatISS is focused and specialized in the simulation of Materials and Information Service System. Our business includes the design and implementation of calculation and simulation of materials, the implementation and development of information service system, and so on. </font></span></span></p>\r\n<p><span style=\"font-size: 10.5pt\"><span style=\"font-size: 10.5pt; font-family: \'宋体\'; mso-spacerun: \'yes\'\"><font face=\"Arial\">Our core value is &ldquo;Create Value for Partners&rdquo;, and &ldquo;Honesty, allowance, innovation, service&rdquo; is spirit of MatISS. We will make efforts to create value for materials industry and information service industry with the self-directed innovation and collaboration.</font></span></span></p>',1,8,4,10,10,1,10,20);

INSERT INTO `met_job` VALUES (1,'销售工程师','Sales',5,'长沙','changsha','面议','','2008-11-20',30,'<p>1、本科以上学位</p>\r\n<p>2、市场营销专业</p>','<p>1、本科以上学位</p>\r\n<p>2、市场营销专业</p>');
INSERT INTO `met_job` VALUES (2,'销售经理','sales manager',1,'长沙','changsha','面议','','2009-03-08',0,'<div>1、具有大专学历及以上学历，市场营销专业优先；</div>\r\n<div>2、具有3年以上的汽车行业营销经验，其中至少1年的销售管理经验；有驾驶执照，能熟练驾驶汽车；</div>\r\n<div>3、深入的营销知识和商务车产品知识，基本的财务和法律知识；</div>\r\n<div>4、具有出众的团队领带能力和发展他人能力，良好的关系建立能力、 沟通能力和冲突解决能力，良好的客户服务理念。</div>\r\n<!-- 联系方式 -->','<div>1、具有大专学历及以上学历，市场营销专业优先；</div>\r\n<div>2、具有3年以上的汽车行业营销经验，其中至少1年的销售管理经验；有驾驶执照，能熟练驾驶汽车；</div>\r\n<div>3、深入的营销知识和商务车产品知识，基本的财务和法律知识；</div>\r\n<div>4、具有出众的团队领带能力和发展他人能力，良好的关系建立能力、 沟通能力和冲突解决能力，良好的客户服务理念。</div>\r\n<!-- 联系方式 -->');

INSERT INTO `met_label` VALUES (1,'米拓信息','米拓信息','www.metinfo.com.cn');
INSERT INTO `met_label` VALUES (2,'网站建设','网站建设','http://www.metinfo.cn/');
INSERT INTO `met_label` VALUES (3,'Metinfo','Metinfo','http://www.metinfo.cn/');
INSERT INTO `met_label` VALUES (4,'Web site','Web site','http://www.metinfo.cn/');

INSERT INTO `met_link` VALUES (1,'米拓信息','MetInfo','http://www.metinfo.cn','http://',0,'企业网站管理系统','MetInfo enterprise website manager system','metinfo@metinfo.cn',1000,1,1,'2009-03-09 12:45:16','all');
INSERT INTO `met_link` VALUES (2,'百度','Baidu','http://www.baidu.com','http://www.baidu.com',0,'百度一下','BAIDU','百度',1,1,1,'2009-03-09 16:55:15','all');
INSERT INTO `met_link` VALUES (3,'搜狐','','http://www.sohu.com','http://',0,'搜狐','','搜狐',2,0,0,'2009-03-09 17:08:17','ch');
INSERT INTO `met_link` VALUES (4,'新浪','','http://www.sina.com.cn','',0,'新浪','','新浪',0,0,0,'2009-03-10 14:28:40','ch');
INSERT INTO `met_link` VALUES (5,'米拓信息','Metinfo','http://www.metinfo.cn','http://www.metinfo.cn/upload/200903/1237295542.gif',1,'企业网站系统','','http://www.metinfo.cn',100,1,1,'2009-03-18 22:12:56','all');
INSERT INTO `met_link` VALUES (6,'','MetInfo','http://www.metinfo.cn','http://localhost/met/upload/200811/logo.gif',1,'','MetInfo CMS','MetInfo CMS',0,0,0,'2009-03-10 15:21:42','ch');

INSERT INTO `met_message` VALUES (1,'胡总','12345678','metinfo@qq.com','426507856','用于企业、单位形象展示、网络宣传、产品发布、产品展示、新闻发布、公告发布、在线交流等，包含企业简介、产品中心、新闻中心、客户服务、联系我们等基本栏目。','127.0.0.1','2009-03-07 11:19:06',1,'用于企业、单位形象展示、网络宣传、产品发布、产品展示、新闻发布、公告发布、在线交流等，包含企业简介、产品中心、新闻中心、客户服务、联系我们等基本栏目。','');
INSERT INTO `met_message` VALUES (2,'Hu zong','12345678','metinfo@qq.com','426507856','test ok','127.222.168.111','2009-03-07 11:25:27',1,'审核通过','en');
INSERT INTO `met_message` VALUES (3,'欧小姐','131888888888','metinfo@metinfo.com.cn','426507856','用于企业、单位形象展示、网络宣传、产品发布、产品展示、新闻发布、公告发布、在线交流等，包含企业简介、产品中心、新闻中心、客户服务、联系我们等基本栏目。','127.0.0.1','2009-03-07 18:56:44',0,' ','');

INSERT INTO `met_news` VALUES (1,'选择网站建设提供商需要注意的问题','SNAPSHOT - Financial Crisis - 1000 GMT','选择网站建设提供商','','大多数人在选择网站建设公司（工作室）时看重的是价格与之前的成功案例，其实这忽略了几个非常关键的问题，我们拿一个完整网站的构成来进行讨论。','\"The 2 million mark is one of those significant barriers for a country to cross. We are there now though and the government must deal with it. There is no hiding place and they need to do everything within their power to get the economy moving.\" Rob Pike, head of trading, shortsandlongs.com','<p>大多数人在选择网站建设公司（工作室）时看重的是价格与之前的成功案例，其实这忽略了几个非常关键的问题，我们拿一个完整网站的构成来进行讨论。</p>\r\n<p>网站由&ldquo;网站程序、网站空间、网站域名&rdquo;三部分组成。</p>\r\n<p>1、网站所有权：网站域名是区分网站所有权的唯一标识，因此在建设网站时一定要确保域名是拿所有者(可以是个人或者法人)的真实信息来进行注册的，一般的网站建设公司都是代客户进行注册，因此客户除了在合同上面注明外最好能登陆域名注册网站进行信息确认。<br />\r\n&nbsp;&nbsp; 另外就是一定得要求网络公司在项目完工时交接域名的管理方法及以后续费方式，也就是需要网络公司提供域名、域名管理平台及域名管理密码，并登陆后将密码修改保存。<br />\r\n2、网站空间：网站空间质量直接关系到网站的访问速度与稳定性，网站空间并不是越大越好，空间是用来存放网站程序并支持网站程序运行的，因此客户有权利要求掌握空间的管理方式，只有拥有空间的管理权限，客户才能够真正获取网站程序的使用权，并可在空间到期后选择更换服务提供商。<br />\r\n3、网站程序：网站程序由后台核心程序与前台展示页面组成，很多时候网络公司都是采用商业程序来作后台，但是并没有付版权费，也就是会存在商业版权纠纷风险，因此客户在建站时有必要问清楚网络公司使用的是什么系统，是否会存在版权纠纷等。</p>\r\n<p>除此之外，以下几个方面也是必须要注意的：<br />\r\n1、网站效果：能否很好的被搜索引擎收录？能否方便客户访问？能否方面管理员维护网站？<br />\r\n2、付款方式：网站建设是一个创意型服务项目，因此不同人对同一个问题会有不同观点，客户除降低对细节的关注外，就是要控制网站建设款，预付是肯定有必要的，因为网络公司需要付出劳动，但是客户只有在确保网站质量合格及各种所有权和管理方式清晰的情况下才可以付清全款。<br />\r\n3、技术支持：网站建设好之后难免会出现一些需要修改的细节，客户需要确认网站建设者是否可以提供相应的技术支持，其实这里最关键的还是要获取网站空间的管理方法，因为有空间管理权之后就算网站建设公司没有相应的技术支持，客户也可以找其他专业人士进行维护和更新。</p>\r\n<p>以上是米拓信息结合自己的服务经验总结出来的，希望能对即将建设网站的朋友提供一些启发。</p>\r\n<p>&nbsp;</p>','<p>&quot;The 2 million mark is one of those significant barriers for a country to cross. We are there now though and the government must deal with it. There is no hiding place and they need to do everything within their power to get the economy moving.&quot; Rob Pike, head of trading, shortsandlongs.com</p>\r\n<p>&quot;We will impose on AIG a contractual commitment to pay the Treasury from the operations of the company the amount of the retention awards just paid.&quot; -- U.S. Treasury Secretary Timothy Geithner in a letter to congressional leaders.</p>\r\n<p>&quot;I don\'t think that this is the beginning of a recovery. It\'s the beginning of a much slower pace of decline.&quot; -- Ethan Harris, with Barclays in New York, commenting on recent less-dire economic data. &quot;You\'ve got to walk before you run.&quot;</p>\r\n<p>&quot;We get a sense that consumers are not necessarily cowering in their fox holes like they were in the fourth quarter.&quot; -- Jay Bryson, global economist at Wachovia. &quot;Some of the shock is over. Granted, consumer confidence isn\'t high at all, but the shock is over.&quot;</p>\r\n<p>&quot;We still can\'t really relax, since we won\'t know the full details of this profit until quarterly results come out.&quot; -- Takashi Ushio, of Japan\'s Marusan Securities, on bank earnings.</p>\r\n<p>&quot;The bottom of the recession is likely to be reached this summer. The economic situation is extremely bad, but there are first signs of hope&quot; -- ZEW chief Wolfgang Franz.<br />\r\n&nbsp;</p>',4,5,0,0,'','',0,'admin',1,'2009-03-18 20:48:54','2009-03-18 20:38:28');
INSERT INTO `met_news` VALUES (2,'如何选择合适的网站推广服务','Top 10 Billionaire Cities','网站推广服务','','网站推广的方式有很多，如何选择最佳的网络推广方式是很多站长非常头痛的事情。','','<p>网站推广的方式有很多，如何选择最佳的网络推广方式是很多站长非常头痛的事情。</p>\r\n<p>我们认为选择选择网站推广方式需要从以下几个方面来考虑： <br />\r\n1、目标群体：网站推广的最终目的是要吸引更多的访问者，因此推广方案的制定基础就是分析目标群体的特征，譬如如果你的网站行业特性非常强，那就应该选择相关行业门户网站进行推广；如果你网站是面向年轻人，那就应该选择娱乐休闲的门户网站进行推广；如果你的网站是和房地产有关，那就可以考虑报纸、户外广告等推广方式；<br />\r\n2、推广费用：很多推广方式只需要自己动手便可以免费获取，但是有些推广方式费用却非常高，因此应该根据自己的经费预算选择一组合理的推广方案；<br />\r\n3、可执行性：免费的推广方式需要时间和技巧，譬如某种产品的旺季马上就要到来，如果这时候还期望用免费的手段提高搜索引擎的排名是非常不现实的。</p>\r\n<p>几种常见的网站推广方式：<br />\r\n1、搜索引擎：<br />\r\n&nbsp;&nbsp; 竞价排名或者点击付费：我们首先要承认搜索引擎的价值，由此我们便可以选择搜索引擎的收费服务来推广网站，这种方法的优点是快速高效，缺点是成本较高，而且有可能会造成同行恶性竞争；<br />\r\n&nbsp;&nbsp; SEO优化，搜索引擎排名推广服务：站长可以自己动手进行网站优化，也可以选择相关网络公司或个人的推广服务，这种方法大优点是费用较低，可同时提升百度、GOOGLE等搜索引擎的排名，而且可以使网站内容丰富，更容易被客户接受并留住客户，缺点是排名提升需要一定的时间，网站内容需要经常更新，不确定因素较多；<br />\r\n2、贸易网站、行业网站: 一般可以选择免费注册、服务会员、广告推广等；一般适合特定行业的客户选择。<br />\r\n3、社区论坛：可以发帖宣传，签名宣传等，建议不要大量发广告贴，而是应该通过帮别人解决问题或者是与人交流来进行宣传；<br />\r\n4、电子邮件：适合经常有接受邮件习惯的目标群体；<br />\r\n5、即时聊天工具：如QQ、旺旺等；<br />\r\n&nbsp;</p>','<p>After losing out to Moscow last year, New York is once again the primary residence of more billionaires than anywhere else on Earth. And that\'s after it lost more than a fifth of its billionaires.</p>\r\n<p>Last year the Big Apple had 71 billionaires within its borders. Today there are 55.</p>\r\n<p>Since the collapse of Lehman Brothers (nyse: LEHMQ - news - people ) last September, chaos on Wall Street has wreaked havoc on the fortunes of New York\'s financiers. Private equity billionaire Stephen Schwarzman has lost $4 billion in the past year. KKR\'s Henry Kravis is down $2.5 billion.</p>\r\n<p>In Pictures: Top 10 Billionaire Cities</p>\r\n<p>Maurice (Hank) Greenberg lost his billionaire status as his fortune was wiped out amid the demise of AIG (nyse: AIG - news - people ). Worth $1.9 billion last year, he has a net worth of less than $100 million today. Also gone from our list of the World\'s Billionaires is former Citigroup (nyse: C - news - people ) Chairman Sandy Weill. His Citi shares have lost nearly all of their value.</p>\r\n<p>Other notable New York residents who have lost significant wealth: News Corp. (nyse: NWS - news - people ) Chairman Rupert Murdoch, shareholder activist Carl Icahn and real estate titan Donald Trump.</p>\r\n<p>New York\'s richest resident, Mayor Michael Bloomberg, actually saw his net worth rise. Gotham\'s chief executive bought back a 20% stake in his financial data and news firm, Bloomberg LP, last year from Merrill Lynch, revaluing the company at a much higher price. Today he is worth $16 billion.</p>\r\n<p>Moscow fared far worse. Last year, the Russian capital claimed 74 billionaires. Two-thirds of those are now gone. Today Moscow has only 27 billionaires.</p>\r\n<p>&nbsp;</p>',4,5,0,0,'','',0,'admin',4,'2009-03-18 20:44:46','2009-03-18 20:44:46');
INSERT INTO `met_news` VALUES (3,'如何策划一个优秀的网站？','Save Money With Devices You Own','','','网络公司的主要作用是引导客户策划网站并将客户的策划方案完美实施。因此优秀的网站源于优秀的策划！','','<p>网络公司的主要作用是引导客户策划网站并将客户的策划方案完美实施。因此优秀的网站源于优秀的策划！</p>\r\n<p>米拓信息认为策划一个优秀的网站需要从一下几个方面入手：<br />\r\n1、网站建设目的：也就是建设这个网站需要达到的最终目的，譬如销售更多的产品、为访问者提供交流平台、公司形象选取、使客户能通过互联网方便的找到自己的等等；明确网站建设目的对网站整个建设过程及推广过程都至关重要，因为之后所有的工作都是为网站建设目的服务的。<br />\r\n2、网站业务流程：包含2个方面，即从网站访问者的嵌瘸龇⒑痛油竟芾碚叩慕嵌瘸龇ⅰ?BR&gt;A、访问者业务流程：即访问者浏览网站或购买商品或提交信息的流程，这个其实就是如何引导客户顺利完成这个业务操作，或者说是如何让客户最快捷的找到自己想要的信息并完成操作，其实也是如何引导客户点击网站管理员希望客户访问的页面并达到预期目的。譬如一个企业网站一般都是引导客户去了解公司的最新产品或者是相关的主打业务，一个网上商城肯定是引导客户去购买相关产品，一个旅游网站肯定是让客户了解旅游景点并报名或者预定机票及宾馆。<br />\r\nB、网站管理者业务流程：即根据网站管理者的信息处理方式来添加维护数据，方便的控制网站前台展示。<br />\r\n3、网站风格：网站风格主要是色调、屏宽等一些大的方向，如无特殊需要（如房地产、装饰行业等），建议尽量少采用图片和动画，以提高网站运行速度，网站策划没有必要去关注网站风格细节，以便让网站制作公司去充分发挥。<br />\r\n4、投入预算：网站建设费用+网站资料录入+加推广，很多时候网站策划就是失败在这一步，因为想的都非常好，但是没有办法用有限的资金和资源来运行，因此当整体方案出来后必须根据自己的实际情况进行相应的调整，以更切合实际。<br />\r\n&nbsp;</p>','<p>Sometimes that\'s true, says Armold, a freelance photographer in Dayton, Ohio, who writes books on collectibles. And sometimes you\'re better off figuring out how to use what you already have in a new way.</p>\r\n<p>Here\'s what we found when we went out to talk with consumers about how they are choosing between spending now and saving big in the future, or just hunkering down with the gear they already have.</p>\r\n<p>Talk Time</p>\r\n<p>One of the most talked-about ways to save concerns how you do your talking. Many Americans have already ditched the traditional phone in favor of mobile phones, which offer unlimited evening and weekend calling.</p>\r\n<p>If you\'re still tied to the notion of having a landline, however, there are options. If you buy an Xlink device, Xtreme Technologies offers users the ability to keep your existing home phones and have your mobile phone services automatically routed to your landlines. That can save on your long-distance bill. The catch: you could burn your daytime minutes and end up spending too much if you talk during the day a lot. And there is the one-time price of the Xlink device (about $110).</p>\r\n<p>Voice over Internet Protocol (VoIP) services, which allow you to chat for low rates--sometimes even free--through the computer offer another cost-cutting alternative.</p>\r\n<p>Armold took a different tack. &quot;I purchased a Magic Jack to reduce my telephone costs,&quot; says Armold, who notes that this simple switch has saved him about $360 a year. Now he makes most of his long-distance calls through his high-speed Internet connection instead, and with major savings.</p>\r\n<p>&quot;Because of that little creature I was able to terminate my home telephone account,&quot; he says. &quot;I can call all over the place for nothing, and it also saves me a ton of cell minutes as well.&quot; (MagicJack plugs into a phone and your computer. The device itself costs about $40, and it has a yearly fee of $20.)</p>\r\n<p>&nbsp;</p>',4,5,0,0,'','',0,'admin',0,'2009-03-18 20:49:58','2009-03-18 20:49:58');
INSERT INTO `met_news` VALUES (4,'网站建设需要关注哪些重点方面？','Billionaire Bachelors And Bachelorettes','','','建设一个网站需要考虑和选择的方面非常多，但是究竟哪些是重点哪些可以忽略呢？','Looking for someone who is outgoing, fun--and rich--to snuggle up with during the cold hard winter of economic despair? You\'re in luck. ','<p>建设一个网站需要考虑和选择的方面非常多，但是究竟哪些是重点哪些可以忽略呢？</p>\r\n<p>网站建设的最终目的肯定是吸引访问者并留住访问者，因此米拓信息从营销型网站建设的理念出发，提出以下观点，仅供参考。</p>\r\n<p>重点关注：<br />\r\n1、网站访问速度与网站稳定性，设计非常优秀的网站会因为没有很好的访问速度或网站空间经常不能访问而被客户抛弃，甚至无法吸引新客户，因此网站访问速度和稳定性是优秀网站的基本条件。<br />\r\n&nbsp;&nbsp; 访问速度和稳定性直接由网站空间决定，而一般的网站都会采用虚拟主机，因此我们建议选择高质量（但不是高价格）的虚拟主机，可以考虑登陆<a href=\"http://www.metinfo.cn\">www.metinfo.cn</a>注册试用。<br />\r\n2、能让目标群体快速方便的找到网站，这个最主要的就是通过搜索引擎搜索，也就是网站建设者在设计制作网站的时候就应该做好网站优化，便于之后的网站推广。<br />\r\n&nbsp;&nbsp; 网站的核心是访问量而不是漂亮，因此我们认为网站优化至关重要。<br />\r\n3、界面简单大方，重点突出，能吸引浏览者，满足前面的2个条件后就是要把找到网站浏览者吸引住，让客户愿意停下了浏览你的网页并进行下一步操作，这就需要网站设计者分析目标群体的特点，将网站设计的尽量简洁大方，重点突出，而不是花花绿绿，或者内容繁多，让人不知道往哪里看也不知道往哪里点。<br />\r\n4、功能完善，操作方便。这主要是2个方面，一是网站前台功能，可以方便访问这顺利的进行相关操作（如察看信息、在线报名、在线交流等等）；二是网站后台管理功能，可以方便网站管理维护和控制网站，进行信息添加和网站内容控制。<br />\r\n5、尽量打造知识型网站或者交流型网站，能是客户经常关顾网站，也就是网站需要有相应的栏目和功能。</p>\r\n<p>可以适当忽略：<br />\r\n1、页面细节，网站页面只要不出现错误，如某个按钮图片、颜色，或者是某个字体、边框大小等等，这些问题因为不同的人会有不同的观点，因此我们建议客户没有必要去刻意追求这些认为细节；<br />\r\n2、网页界面风格，不同的人对于同一个网站或者是为了达到目的所采用或者说喜欢的网站界面风格会有很大的区别，而且同一个人在不同的时间也会有不同的想法，因此界面风格只要能实现网站预期的效果就行，而没有必要一定是按照某一个人的想法来不断修改。<br />\r\n&nbsp;</p>','<p>Looking for someone who is outgoing, fun--and rich--to snuggle up with during the cold hard winter of economic despair? You\'re in luck.</p>\r\n<p>This year, there are 72 single moguls on the Forbes list of the World\'s Billionaires. Of those plutocrats, 21 are perennial bachelors while the other 51 are divorc&eacute;es yearning for a new chance at love.</p>\r\n<p>The world\'s billionaire bachelors and bachelorettes have an average net worth of $3.5 billion and hail from 17 different countries across five continents. The greatest concentration of single billionaires is in the U.S., which more than 60% of them call home.</p>\r\n<p>The richest bachelor on the planet is New York City Mayor Michael Bloomberg. The 67-year-old former Salomon Brothers trader struck it rich with his financial data and news outfit Bloomberg LP. Today, he\'s worth $16 billion, and has given away nearly $800 million to charity in the past five years. Divorced since 1993, Bloomberg hopes to stay in the public eye for a while. Last year, New York\'s City Council passed a law allowing him to run for a third term later this year.</p>\r\n<p>BATS Real-Time Market Data by XigniteAmerica\'s most sought-after billionaire bachelorette is the Queen of All Media, Oprah Winfrey. Though she\'s been in a serious relationship with businessman Stedman Graham since 1986, the talk show queen (net worth: $2.7 billion) hasn\'t shown much interest in a trip down the aisle.</p>\r\n<p>&nbsp;</p>',4,5,0,0,'','',0,'admin',0,'2009-03-18 20:53:00','2009-03-18 20:53:00');
INSERT INTO `met_news` VALUES (5,'选择工作室或者个人建设网站会有哪些风险？','UPDATE 3-Russia wants closer links with OPEC','','','','','<p>问：选择工作室或者个人建设网站会有哪些风险？<br />\r\n答：和注册公司比较，由于工作室或个人没有独立法人资格，也就是说万一出现纠纷，委托方很难找到起诉的对象，这就是工作室和网络公司的本质区别。但是现实分析一下便可知道，其实这种情况基本上不会发生，因为工作室承接的项目费用一般会在5万元以内，90%会在1万以内，因此很少有工作室为了这点钱而行骗，也很少有客户为了一点损失去上法庭，所以和网络公司比较，工作室没有相对的必然风险。<br />\r\n&nbsp;&nbsp;&nbsp; 不管是找工作室、个人还是网站建设公司，都有可能存在以下风险：<br />\r\n&nbsp;&nbsp;&nbsp; 1、资金：也就是项目费用的控制，一般都需要客户支付一部分订金，网站制作者才会正式启动项目，因此客户应该和网站制作方签订正式协议，明确预付费用、验收标准与尾款支付等。<br />\r\n&nbsp;&nbsp;&nbsp; 2、技术：即网站能否达到预期的效果，这里就需要客户去综合服务提供商的过往经验或者通过尽量少支付预付款来控制；<br />\r\n&nbsp;&nbsp;&nbsp; 3、所有权：网站域名、网站空间的注册与管理，以及1年到期后的续费费用与方式，这个是必须要求服务上提供相关的文字资料和操作方法；<br />\r\n&nbsp;&nbsp;&nbsp; 4、维护：网站运行过程中的维护，一般的工作室和网络公司都会提供一年的免费维护以保证网站的正常运行，其实如果服务商能提供域名和空间的管理方式，客户可以自己维护或者寻找其他的服务商进行维护。<br />\r\n&nbsp;&nbsp;&nbsp; 因此，不管是选择网络公司还是工作室或者个人建设网站都会存在一定的风险，我们建议客户选择诚信的服务提供商！</p>','<p>* Russia says will cut output to help OPEC</p>\r\n<p>* Russian oil output declining due to under-investment</p>\r\n<p>* Proposes range of technical changes to market</p>\r\n<p><br />\r\nVIENNA, March 15 - Russia, the world\'s leading independent oil exporter, on Sunday proposed a list of measures to support oil prices, calling for lower output from all producers as part of the plan.</p>\r\n<p>Deputy Prime Minister Igor Sechin outlined the wide range of ideas to OPEC oil ministers ahead of their production meeting in Vienna, and pledged to join in any possible output cut agreed by the group.</p>\r\n<p>&quot;We are monitoring OPEC\'s work and our companies will also participate in a cut,&quot; Sechin told reporters on the sidelines of a meeting of the Organization of the Petroleum Exporting Countries. &quot;The volume of that cut will depend on the market situation.&quot;</p>\r\n<p>Greater coordination among producers would cause concern among oil-consuming nations, particularly those in Europe that were affected by disruptions to Russian gas supplies earlier this year.</p>\r\n<p>Russia is the largest non-OPEC crude producer in the world and is second only to OPEC\'s leading exporter Saudi Arabia.</p>\r\n<p>After oil prices fell sharply at the end of 2001 Russia, together with other leading non-OPEC producers Norway and Mexico, pledged to cut back supplies along with OPEC. In the event, non-OPEC\'s contribution was unconvincing.</p>\r\n<p>&nbsp;</p>',4,5,0,0,'','',0,'admin',0,'2009-03-18 20:54:35','2009-03-18 20:54:35');
INSERT INTO `met_news` VALUES (6,'如何评价企业网站建设的专业性','Pfizer discontinues global Phase III trial of Axitinib ','企业网站建设','','企业网站是开展网络营销的综合性工具，网站专业性与否直接影响到网络营销的最终效果，因此对网站进行专业性评价是网络营销管理的重要内容之一。网站专业性评价分析是一项专业性很强的高级网络营销工作，涉及到多方面的专业知识，因此目前尚没有受到企业充分重视，或者仅仅是对一些网站外观、下载速度等外在方面因素的了解，而对于网站的功能、结构、内容、环境关联因素等方面的了解较少。','','<p>企业网站是开展网络营销的综合性工具，网站专业性与否直接影响到网络营销的最终效果，因此对网站进行专业性评价是网络营销管理的重要内容之一。网站专业性评价分析是一项专业性很强的高级网络营销工作，涉及到多方面的专业知识，因此目前尚没有受到企业充分重视，或者仅仅是对一些网站外观、下载速度等外在方面因素的了解，而对于网站的功能、结构、内容、环境关联因素等方面的了解较少。 <br />\r\n网站重点进行5个方面的考核。这5个指标是：</p>\r\n<p>（1）网站信息质量高低</p>\r\n<p>网站提供的信息质量和信息呈现方式：公司业务的介绍情况；是否有关于产品和服务的信息；是否有完整的企业和联系信息；是否有产品说明 <br />\r\n或评估工具，以区别于其他同类产品。</p>\r\n<p>（2）网站导航易用度</p>\r\n<p>网站信息是否组织良好，尤其当公司拥有庞大用户群的时候。是否有站内搜索引擎；网站各部分是否很方便地链接互通。</p>\r\n<p>（3）网站设计美观性</p>\r\n<p>网站设计的美观及愉悦程度；文本是否容易阅读；图片是否使用适当；是否创造性地采用了声频与视频手段增强宣传效果。</p>\r\n<p>（4）网站的电子商务功能</p>\r\n<p>能否实现在线订购、支付。</p>\r\n<p>（5）网站的特色应用</p>\r\n<p>网站是否有社区或论坛；是否有计算器或其它可以增强用户体验的工具；访问者能否注册电子邮件通讯或Email通讯；用户能否通过网站获得适时帮助（如在线拨号或聊天系统）；网站是否有通往相关信息的互补性资源的链接。</p>\r\n<p>&nbsp;</p>','<p>Pfizer Inc recently announced the discontinuation of a Phase III study of its investigational agent Axitinib for the treatment of advanced pancreatic cancer. Based on an interim analysis, an independent data safety monitoring board (DSMB) found no evidence of improvement in the primary endpoint of survival in patients treated with Axitinib as well as Gemcitabine, as compared to Gemcitabine alone, the current standard of care for patients with advanced pancreatic cancer.</p>\r\n<p>&quot;These results were disappointing, given the trend towards prolonged survival seen in a Phase II study of Axitinib in this extremely difficult-to-treat patient population,&quot; said Mace L Rothenberg, senior vice president, Clinical Development and Medical Affairs - Oncology Business Unit, Pfizer Inc. The company has notified all clinical trial investigators involved in the study&reg;ulatory agencies of these interim findings and recommends patients discontinue treatment with Axitinib. Pfizer encourages investigators to determine the best course of action for their patients.<br />\r\n&nbsp;</p>',4,6,0,0,'','',0,'admin',0,'2009-03-18 20:57:56','2009-03-18 20:57:56');
INSERT INTO `met_news` VALUES (7,'企业网站进行SEO搜索引擎优化的七条规则','Fashion Deflation','','','每一个搜索引擎都有自己的规则，合理的SEO可以有效提高网站的排名，从而使得营销更加的容易和简单。掌握搜索引擎的算法更新技术是进行SEO的重要方法。下面是我总结的一些搜索引擎优化的规则。','','<p>核心提示：网页的头部和底部是很重要的，对于搜索引擎来说，尽量的将关键字加到里面。</p>\r\n<p>每一个搜索引擎都有自己的规则，合理的SEO可以有效提高网站的排名，从而使得营销更加的容易和简单。掌握搜索引擎的算法更新技术是进行SEO的重要方法。下面是我总结的一些搜索引擎优化的规则。</p>\r\n<p>1、网页优化的重要的部分就是title部分，这个地方应该是你每次优化的重点。标题与关键字的符合度越高越好。网站建设前一定要认真的分析百度的相关关键字策略，对网站进行详细的关键字筛选。长尾关键词更有利于提高网站流量。</p>\r\n<p>2、网页的头部和底部是很重要的，对于搜索引擎来说，尽量的将关键字加到里面。不要去在乎所谓的关键词密度，只要你的密度不超过50%，只要你提供的内容是符合的，只要你的内容对于你的用户来说是重要的，不可缺少的，适当的加入些关键词在页面里，只是更好的提醒搜索引擎。</p>\r\n<p>3、外链是非常重要的，外链决定了网站在索索引擎中的排名，但是并不是说外链多，排名一定就高，毕竟决定网站排名的因素还有很多，外链只不过是其中的一个重要部分。记住永远不要进行群发，群发的结果是有一天你发现你的网站突然在索索引擎中消失了。</p>\r\n<p>4、内容是网站优化的灵魂。只有有好的内容才会吸引搜索引擎的到来，而且要保持天天更新你的网站，以便蜘蛛来访时候有东西可吃。最好的方法是定时更新网站，每天保持下去。内容最好是原创的，因为搜索引擎是非常的喜欢原创的。网上的千篇一律的东西它是不会去也不喜欢去看的。</p>\r\n<p>5、其实，最终的一个部分应该是服务器和域名的选择。首先，必须选择一个好的域名，最好选择.com的，.cn的个人感觉权重没有.com好，确保域名容易记住，而且没有被搜索引擎惩罚过。</p>\r\n<p>还要选择一个好的服务器，如果你的网站所在的服务器经常的出现问题，导致网站频繁出现不能浏览的问题。那么你的网站就会受到很大的影响。排名会很难提升的。所以服务器的选择是非常重要的一个部分。就像我的这个网站uusee366.cn初期为了便宜在朋友那找了个空间，但是不到一周，服务器被攻击了，我的网站两天打不开，这不就完了吗。后来只好又重新购买了一个好一点的空间。</p>\r\n<p>6、只把网站的首页进行SEO是远远不够的，网站优化最好是全站同时进行，每个内容页都必须有您想优化的关键字，尤其是相关相关关键字，内容页尽量不要采集，尤其是文章开头的100个字最好不要与其它站的页面相同。</p>\r\n<p>7、网站目录和结果是进行网站优化的非常重要的一个部分。优秀的目录排列让他很轻松的找到你的内容，排名自然就高，想象一下，要是你的很多目录结构乱七八糟，目录名称不知所云，百度蜘蛛进了你的网站如同进了迷宫。网上有很多免费的源码和CMS。很多站长都是随便找一些就开始了网站之路，其实这些源码都存在很多错误的地方。对于后期的网站优化是非常的不理想的。所以最好自己找人做一个网站。或者是购买一套网站源码。而且网站的结构要合理才行。</p>\r\n<p>以上就是我个人建站到现在所总结的一些经验。希望可以对站长朋友有所帮助。<br />\r\n&nbsp;</p>','<p>The reason: Fashion producers are trying to anticipate consumers\' tighter budgets and avoid last year\'s drastic markdowns, which can undercut a brand\'s perceived strength. &quot;The 70% discounts we saw during the holiday season are risky not just for brand integrity but brand equity,&quot; says Erwan Rambourg, luxury and sporting goods analyst at HSBC.</p>\r\n<p>Despite all the sales, retailers posted big losses in the second quarter. In March, Neiman Marcus announced a second-quarter loss of $509 million. At J. Crew Group (nyse: JCG - news - people ), the loss was $13.5 million.</p>\r\n<p>As a defensive action, clothing makers are tightening belts, making do with lower profit margins and passing along the cuts to consumers in the form of lower retail prices.</p>\r\n<p>For the fall, Lacoste will offer cable-knit sweaters, normally $145, for $98, says Robert Siegel, chairman and chief executive of the company. In spring 2010, Lacoste plans to lower prices in other categories, including its signature polo shirts. Price cuts do not mean a cut in quality, says Siegel. &quot;We are taking it out of our own margins in our attempt to be more consumer-friendly.&quot;</p>\r\n<p>&nbsp;</p>',4,6,0,0,'','',0,'admin',0,'2009-03-18 21:00:10','2009-03-18 21:00:10');
INSERT INTO `met_news` VALUES (8,'企业网站建设对网络营销的影响','Rio Tinto: China to lead recovery in metals demand','','','信息发布层次。在网页上提供关于企业及其产品特性的一般信息，让用户可以访问站点、浏览信息。交互性体现在企业提供了信息，而顾客通过主动输入域名、搜索或点击看到了企业网站并浏览其页面信息，这是互联网最初级的交互性。','','<p>企业网站建设可以分为三个层次：</p>\r\n<p>　　1、信息发布层次。在网页上提供关于企业及其产品特性的一般信息，让用户可以访问站点、浏览信息。交互性体现在企业提供了信息，而顾客通过主动输入域名、搜索或点击看到了企业网站并浏览其页面信息，这是互联网最初级的交互性。</p>\r\n<p>　　2、培养兴趣层次。网页内容与形式设计尽量考虑潜在客户的特征与需求，提供与企业行业、产品相关的各种信息，使潜在顾客访问页面后，可以通过点击按钮、搜索信息和发现兴趣点，培养起对产品、公司、服务的进一步兴趣。这一层次的交互性体现在企业向顾客提供相关信息，满足顾客的兴趣需求，以吸引顾客、刺激需求；顾客通过必要的参考信息的支持，更充分地认识企业产品并确认自己的需求。</p>\r\n<p>　　3、建立关系层次。企业网站运用各种Web交互性技术，使网站访问者可以通过数据库搜索、发送邮件、网上交谈、定购、实时付款、货物派送等方式，与企业建立起有效的商品交易的信息流与物流关系。</p>\r\n<p>　　不同交互层次的技术与营销效果</p>\r\n<p>　　交互层次的不同，技术上就有层次差异。信息发布层次的交互，要求有基本的网页制作技术和网站宣传手段；培养兴趣层次，要求在网站建设中有效地结合市场调查与网站经营效果分析技术，合理设计网站内容；建立关系层次，不仅要求利用数据库，电子邮件与BBS、网上实时付款等技术，还要求网站的经营机制制度化。</p>\r\n<p>　　交互层次不同，营销效果也不同。从信息沟通上看，网上营销可以给企业带来四个方面收益，即直接、高速、低成本和信息充分，而网站交互层次不同，这些收益大小也就不同。例如：在信息发布层次，网站提供的内容有范围限制，交互性不足，效果也受到局限，比如有利于顾客作出决策的信息就可能不足；而在建立关系层次，企业就可以快速响应顾客的问题，提供较充分的信息，强化企业形象。</p>\r\n<p>　　从实现销售的角度来看，低层次的交互功能只能提供信息上的方便，没有充分减少传统销售方式的整体成本，比如顾客通过网站信息刺激产生购买欲望后，可能会由于要通过汇款或亲自到店铺去的精神成本或时间成本而放弃了这次购买，对于这个企业来说，这个需求被阻碍或被遗失了；而高层次的交互可以立即将顾客的需求转化为购买行为，减少了顾客需求遗失，促进了营销的实现。</p>\r\n<p>　　如何选择交互性层次</p>\r\n<p>　　在交互性层次与企业网上营销的关系上，企业应该有几点认识：1、由于运用互联网交互技术的层次和网站提供内容与形式上的差异，网站的交互性有不同的层次，不同层次的交互对于企业的产品营销有不同的作用与效果；</p>\r\n<p>　　2、不同层次的交互性需要企业在网站建设上进行不同程度的投入；</p>\r\n<p>　　3、同一层次的交互性，由于企业所属行业特性、企业的产品特性和企业的目标市场的不同，其营销效果会有很大的差异。</p>\r\n<p>　　国内现有很多上网的企业没有认识到不同交互层次的网上营销对于企业或产品在作用上有差异，建立了网站后效果并不明显，投入没有得到预期的回报。其中，有的网站建立的层次过低，对于其产品的营销根本不会有大的影响；有的网站对于交互性所要求的人员、制度保障和资金投入没有正确的估计，也没有正式的计划和预算，结果不能正常的运行；有的网站对于相同层次──即使是较低层次上的交互性技术也利用不足，没有达到应有的效果；更多的企业在建立网站时，对于网络特性理解不足，没有对企业建立网站所应达到的交互层次进行必要的研究和咨询，没有完整的营销方案和计划，因此也就没有对未来企业网上营销交互性层次的走向制定较为合理的步骤和时间表，未能有效地利用互联网的交互特性。<br />\r\n&nbsp;</p>','<p>SYDNEY (Reuters) - Rio Tinto Ltd/Plc (RIO.L) (RIO.AX) sees demand for metals and minerals picking up rapidly once economic activity recovers, driven by a sharp recovery in Chinese demand.</p>\r\n<p>In the company\'s annual report, released on Tuesday, Chairman Paul Skinner also said a need to rebuild stockpiles of minerals after cutbacks by many miners due to the economic slowdown would help lift demand.</p>\r\n<p>&quot;China particularly may surprise the market. It is the rate of deceleration and acceleration of the Chinese economy which drives metal demand and prices, given its major share of total global demand,&quot; Skinner said in the report.</p>\r\n<p>&quot;Just as China decelerated sharply, with a strong impact on metals demand, it will also work powerfully in the upswing.&quot;</p>\r\n<p>Rio Tinto, seeking to reduce debt, has signed a $19.5 billion deal with Chinese aluminum producer Chinalco that will give the Chinese stakes in some Rio mining assets as well as an 18 percent stake in Rio itself.</p>\r\n<p>Two weeks ago Rio Tinto chief economist Vivek Tulpukle told Reuters that 2009 would be a &quot;very rough year for both prices and volumes&quot; and economic recovery would take time.</p>\r\n<p>Rio is also selling assets to reduce debt that stood at $38.7 billion at December 31. It hopes to reduce net debt by $10 billion this year, and Chief Executive Tom Albanese said in the report that more assets will be divested than those already earmarked for sale.</p>\r\n<p>&nbsp;</p>',4,6,0,0,'','',0,'admin',0,'2009-03-18 21:02:13','2009-03-18 21:02:13');
INSERT INTO `met_news` VALUES (9,'反向链接对企业网站SEO的影响','Dark Chocolate\'s Cancer Prevention Powers','','','','','<p>一个网站内部的链接构架、关键词布局、URL、内容建设等方面都网站优化工作完成之后，并不能直接SEO效果，因为这只是打好了SEO的基础，要想获得较好的排名，还必须开展增加网站关键词网页的反向链接，因为反向链接的质量和数量直接影响这关键词的排名，所以今天重点给大家解析一下反向链接对SEO的影响。 <br />\r\n　　一、什么是反向链接</p>\r\n<p>　　A网页中有一个链接指向B网页，那么A网页就是B网页的反向链接!</p>\r\n<p>　　特别强调：</p>\r\n<p>　　反向链接是网页和网页之间的关系，不是网站与网站之间的关系。网站内部各个网页之间的链接叫内部链接，其他网站阃镜耐匙龅姆聪蛄唇樱型獠苛唇印２还芡獠苛唇踊故悄诓苛唇樱际欠聪蛄唇樱运阉髋琶际怯杏跋斓摹?/P&gt;</p>\r\n<p>　　二、反向链接对PR值的影响</p>\r\n<p>　　按照Google的说法，PR值的计算有着非常复杂的算法，但是不用质疑的是，反向链接的数量和质量对PR值起着决定性的影响。</p>\r\n<p>　　如果你想获得比较高的PR值，一定要拥有一定数量的高质量的反向链接，或者足够量大的反向链接。</p>\r\n<p>　　查看网页的PR值，可以下载Google工具栏安装到你的浏览器上，这样的话，浏览任何网页，都可以直接看到它的PR值，同时Google工具栏还有翻译等功能，非常好用。</p>\r\n<p>　　三、什么样的链接只高质量的反向链接</p>\r\n<p>　　什么样的反向来年节是高质量的反向链接呢?</p>\r\n<p>　　1、权威网站</p>\r\n<p>　　例如政府机构网站、非赢利机构网站等等，这些网站首页的PR值一般都非常高，如果这类网站能够给你一个链接，对你的帮助会非常大的。</p>\r\n<p>　　2、相关网站：</p>\r\n<p>　　交换链接，仅可能与那些和你的网站用户比较接近的网站进行交换，这样的反向链接也是质量不错的。</p>\r\n<p>　　3、知名网站</p>\r\n<p>　　例如一些有名的新闻资讯类网站，各大搜索引擎每天都对这些网站更新N次，如果这些网站的重要网页给你一个链接的话，每天搜索引擎来更新这个网站的时候，顺着链接就爬行到了你的网站，也会打打提高搜索引擎对你的网站的更新频率，从而对你的网站排名有着非常大的帮助。</p>\r\n<p>　　四、如何增加反向链接</p>\r\n<p>　　1、内部链接优化</p>\r\n<p>　　对于很多大型网站，由于网站自身都拥有几百万个网页，所以对网站内部链接进行重新优化构架之后，就可以让自身的网页给自己的众多关键词网页制造反向链接。这些反向链接虽然质量不高，但是由于数量庞大，所以也可以很快起到很好的效果。</p>\r\n<p>　　以前过SEO过的许多大型网站，仅仅把这个策略做了之后，很多热门关键词都在一个月内获得了百度谷歌都迅速提升到第一页的效果。</p>\r\n<p>　　2、友情链接交换</p>\r\n<p>　　这个是最重要的手段之一，因为友情链接交换一般都交换首页，而首页的权重又是最高的，所以网站内容优化做好之后，坚持交换一两个月链接，只要能坚持的，都可以获得较好的排名。</p>\r\n<p>　　注意：避免与那些被搜索引擎主罚过的，或者质量差的垃圾站交换链接。记住这句老话：物以类聚，人以群分，网页之间的链接，同样如此，所以对于反向链接而言，搜索引擎也在根据你的反向网页的质量来判断你的网页的好与坏。</p>\r\n<p>　　3、其他增加反向链接手段</p>\r\n<p>　　增加反向链接的手段非常多，例如利用软文、博客等等，方面非常多，选择适合自己的方法就OK</p>\r\n<p>　　4、增加反向链接的关键词</p>\r\n<p>　　关键是什么呢?</p>\r\n<p>　　答曰：耐心!</p>\r\n<p>　　就拿友情链接交换来说吧，一天交换5个链接，一个月就可以交换150个友情链接，有这么多的友情链接，一般的关键词都会排上去，但是绝大部分人都是缺乏耐心的人，做事总是三天打鱼，两天晒网，所以很难做出比较好的效果。</p>\r\n<p>　　本文版权所有，欢迎转摘，转摘请注明作者和出处!</p>\r\n<p>　　作者：王通<br />\r\n&nbsp;</p>','<p>RECENT RESEARCH INDICATES that dark chocolate\'s chemicals, which act as antioxidants, have been shown to play a role in reducing cancer risks by helping to combat cell damage that can lead to tumor growth. These antioxidants occur naturally in the plant-based cacao bean, the base of all chocolate products. Cacao beans are, in fact, one of the most concentrated natural sources of antioxidants that exist.<br />\r\n&nbsp;</p>\r\n<p>&quot;The great news is that in addition to being decadent and delicious, moderate amounts of dark chocolate may play a role in cancer prevention,&quot; said Sally Scroggs, M.S., R.D., L.D., health education manager at The University of Texas M. D. Anderson Cancer Center\'s Cancer Prevention Center.</p>\r\n<p>&quot;Dark chocolate has a higher percentage of healthy antioxidants, without the increased sugar and saturated fats added to milk chocolate,&quot; Scroggs said.</p>\r\n<p>Darker Chocolate Packs a Punch</p>\r\n<p>Chocolate has been a favorite food for centuries, according to the American Dietetic Association. &quot;It has become a symbol for love, indulgence, temptation and now, we can justify it for its health attributes,&quot; Scroggs said.</p>\r\n<p>&quot;The main reason that eating dark chocolate, versus milk or white chocolate, reduces cancer risks is because it has a higher percentage of cacao, and thus antioxidants,&quot; she said.</p>\r\n<p>&nbsp;</p>',4,6,0,0,'','',0,'admin',1,'2009-03-19 11:30:48','2009-03-18 21:03:49');

INSERT INTO `met_online` VALUES (1,'在线销售','Sales',1,'426507856','navyok@hotmail.com','navylin','','');
INSERT INTO `met_online` VALUES (2,'技术支持','surpport',2,'426507856','','','','');

INSERT INTO `met_otherinfo` VALUES (1,'','','','','','','','','','','','','','','','','','','','','','','','','fad7a48cbe5e4699c1260318373223d2','在未经授权前，请不要尝试去掉[Powered by MetInfo]版权标识！','','','');

INSERT INTO `met_parameter` VALUES (1,'para1','编号','Number',0,1,3,'200');
INSERT INTO `met_parameter` VALUES (2,'para2','品牌','Brand',1,2,3,'200');
INSERT INTO `met_parameter` VALUES (3,'para3','单位','Unit',1,3,3,'200');
INSERT INTO `met_parameter` VALUES (4,'para4','价格','Price',1,4,3,'200');
INSERT INTO `met_parameter` VALUES (5,'para5','','',0,5,3,'200');
INSERT INTO `met_parameter` VALUES (6,'para6','','',0,6,3,'200');
INSERT INTO `met_parameter` VALUES (7,'para7','','',0,7,3,'200');
INSERT INTO `met_parameter` VALUES (8,'para8','','',0,8,3,'200');
INSERT INTO `met_parameter` VALUES (9,'para9','','',0,9,3,'不限');
INSERT INTO `met_parameter` VALUES (10,'para10','','',0,10,3,'不限');
INSERT INTO `met_parameter` VALUES (11,'para1','文件类型','File Type',1,1,4,'200');
INSERT INTO `met_parameter` VALUES (12,'para2','文件版本','Version',1,2,4,'200');
INSERT INTO `met_parameter` VALUES (13,'para3','','',0,3,4,'200');
INSERT INTO `met_parameter` VALUES (14,'para4','','',0,4,4,'200');
INSERT INTO `met_parameter` VALUES (15,'para5','','',0,5,4,'200');
INSERT INTO `met_parameter` VALUES (16,'para6','','',0,6,4,'200');
INSERT INTO `met_parameter` VALUES (17,'para7','','',0,7,4,'200');
INSERT INTO `met_parameter` VALUES (18,'para8','','',0,8,4,'200');
INSERT INTO `met_parameter` VALUES (19,'para9','','',0,9,4,'不限');
INSERT INTO `met_parameter` VALUES (20,'para10','','',0,10,4,'不限');
INSERT INTO `met_parameter` VALUES (21,'para1','','',0,1,5,'200');
INSERT INTO `met_parameter` VALUES (22,'para2','','',0,2,5,'200');
INSERT INTO `met_parameter` VALUES (23,'para3','','',0,3,5,'200');
INSERT INTO `met_parameter` VALUES (24,'para4','','',0,4,5,'200');
INSERT INTO `met_parameter` VALUES (25,'para5','','',0,5,5,'200');
INSERT INTO `met_parameter` VALUES (26,'para6','','',0,6,5,'200');
INSERT INTO `met_parameter` VALUES (27,'para7','','',0,7,5,'200');
INSERT INTO `met_parameter` VALUES (28,'para8','','',0,8,5,'200');
INSERT INTO `met_parameter` VALUES (29,'para9','','',0,9,5,'不限');
INSERT INTO `met_parameter` VALUES (30,'para10','','',0,10,5,'不限');

INSERT INTO `met_product` VALUES (1,'夏普彩电LCD-46A63','XP LCD-46A63','夏普彩电LCD-46A63','','','','<p>&nbsp;<a target=\"_blank\" href=\"http://www.shjdq.com/brand_show.aspx?id1=2&amp;brandname=夏普\"><font color=\"#000000\">夏普</font></a><font color=\"#000000\"> </font><a target=\"_blank\" href=\"http://www.shjdq.com/tv_show_2069.aspx\"><font color=\"#000000\"><strong>LCD-46A63</strong></font></a><font color=\"#000000\"> 技术参数</font><font color=\"#000000\"> </font></p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p><dt><font color=\"#000000\">屏幕尺寸(英寸) 46 </font><dl><dt><font color=\"#000000\">屏幕比例 16:9 </font></dt><dt><font color=\"#000000\">分辨率 1920&times;1080 </font></dt><dt><font color=\"#000000\">背光寿命(小时) 60000 </font></dt><dt></dt><dt></dt><dt><a target=\"_blank\" href=\"http://www.shjdq.com/brand_show.aspx?id1=2&amp;brandname=夏普\"><font color=\"#000000\">夏普液晶电视</font></a><font color=\"#000000\"> LCD-46A63输入输出</font><font color=\"#000000\"> </font></dt><dt><font color=\"#000000\">接收制式PAL/NTSC/SECAM </font></dt><dt><font color=\"#000000\">声音输出功率10W&times;2 </font></dt><dt><font color=\"#000000\">输入HDMI接口，S端子，AV接口，VGA接口，分量视频接口，TV输入 </font></dt><dt><font color=\"#000000\">输出AV输出，3.5mm耳机 </font></dt><dt></dt></dl>\r\n<div class=\"zhtitle2\">&nbsp;</div>\r\n</dt><dt><font color=\"#000000\">夏普 </font><a target=\"_blank\" href=\"http://www.shjdq.com/tv_show_2069.aspx\"><font color=\"#000000\">LCD-46A63</font></a><font color=\"#000000\">电气规格</font><font color=\"#000000\"> </font></dt><dt><font color=\"#000000\">功耗(W)255 </font></dt><dt></dt><dt>\r\n<div>&nbsp;</div>\r\n<div class=\"zhtitle2\">&nbsp;</div>\r\n</dt><dt><a target=\"_blank\" href=\"http://www.shjdq.com/brand_show.aspx?id1=2&amp;brandname=夏普\"><font color=\"#000000\">夏普液晶电视</font></a><font color=\"#000000\"> LCD-46A63外观参数</font><font color=\"#000000\"> </font></dt><dt><font color=\"#000000\">外观尺寸宽110.1cm&times;深32.5cm&times;高75.9cm&nbsp;</font><dl><dt><font color=\"#000000\">重量含底座约27.2kg，不含底座约22kg </font></dt><dt></dt><dt></dt></dl>\r\n<div class=\"clear\">&nbsp;</div>\r\n</dt><dt><font color=\"#000000\">夏普 </font><a target=\"_blank\" href=\"http://www.shjdq.com/tv_show_2069.aspx\"><font color=\"#000000\">LCD-46A63</font></a><font color=\"#000000\">其他参数</font><font color=\"#000000\"> </font></dt><dt><font color=\"#000000\">其他特性高级超视觉Black TFT液晶显示屏（ASV），智能亮度调节</font>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n</dt></p>','<p>&nbsp;<a target=\"_blank\" href=\"http://www.shjdq.com/brand_show.aspx?id1=2&amp;brandname=夏普\"><font color=\"#000000\">夏普</font></a><font color=\"#000000\"> </font><a target=\"_blank\" href=\"http://www.shjdq.com/tv_show_2069.aspx\"><font color=\"#000000\"><strong>LCD-46A63</strong></font></a><font color=\"#000000\"> 技术参数</font><font color=\"#000000\"> </font></p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p><dt><font color=\"#000000\">屏幕尺寸(英寸) 46 </font><dl><dt><font color=\"#000000\">屏幕比例 16:9 </font></dt><dt><font color=\"#000000\">分辨率 1920&times;1080 </font></dt><dt><font color=\"#000000\">背光寿命(小时) 60000 </font></dt><dt></dt><dt></dt><dt><a target=\"_blank\" href=\"http://www.shjdq.com/brand_show.aspx?id1=2&amp;brandname=夏普\"><font color=\"#000000\">夏普液晶电视</font></a><font color=\"#000000\"> LCD-46A63输入输出</font><font color=\"#000000\"> </font></dt><dt><font color=\"#000000\">接收制式PAL/NTSC/SECAM </font></dt><dt><font color=\"#000000\">声音输出功率10W&times;2 </font></dt><dt><font color=\"#000000\">输入HDMI接口，S端子，AV接口，VGA接口，分量视频接口，TV输入 </font></dt><dt><font color=\"#000000\">输出AV输出，3.5mm耳机 </font></dt><dt></dt></dl>\r\n<div class=\"zhtitle2\">&nbsp;</div>\r\n</dt><dt><font color=\"#000000\">夏普 </font><a target=\"_blank\" href=\"http://www.shjdq.com/tv_show_2069.aspx\"><font color=\"#000000\">LCD-46A63</font></a><font color=\"#000000\">电气规格</font><font color=\"#000000\"> </font></dt><dt><font color=\"#000000\">功耗(W)255 </font></dt><dt></dt><dt>\r\n<div>&nbsp;</div>\r\n<div class=\"zhtitle2\">&nbsp;</div>\r\n</dt><dt><a target=\"_blank\" href=\"http://www.shjdq.com/brand_show.aspx?id1=2&amp;brandname=夏普\"><font color=\"#000000\">夏普液晶电视</font></a><font color=\"#000000\"> LCD-46A63外观参数</font><font color=\"#000000\"> </font></dt><dt><font color=\"#000000\">外观尺寸宽110.1cm&times;深32.5cm&times;高75.9cm&nbsp;</font> <dl><dt><font color=\"#000000\">重量含底座约27.2kg，不含底座约22kg </font></dt><dt></dt><dt></dt></dl>\r\n<div class=\"clear\">&nbsp;</div>\r\n</dt><dt><font color=\"#000000\">夏普 </font><a target=\"_blank\" href=\"http://www.shjdq.com/tv_show_2069.aspx\"><font color=\"#000000\">LCD-46A63</font></a><font color=\"#000000\">其他参数</font><font color=\"#000000\"> </font></dt><dt><font color=\"#000000\">其他特性高级超视觉Black TFT液晶显示屏（ASV），智能亮度调节</font>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n</dt></p>',7,8,9,0,'../upload/200903/watermark/1237383118.jpg','../upload/200903/thumb/1237383118.jpg',1,4,'2009-03-18 21:46:06','2009-03-18 21:24:41','','夏普','台','￥7979.00 ','','','','','','','','XP','Platform','￥7979.00 ','','','','','','','');
INSERT INTO `met_product` VALUES (2,'海尔电视LU42K1','Haier LU42K1','￥5130.00','','','','<p>倍清 护眼 防眩光<br />\r\n广色域真色彩A+屏 <br />\r\n专利防眩光技术 <br />\r\n全能流媒体技术<br />\r\n内置流媒体卡槽 <br />\r\nMaxxBass数字重低音 <br />\r\nDSM超强睿驰3核芯引擎 <br />\r\n养眼调色板， 九段色彩调节 <br />\r\n魅蓝光影Fashion Menu <br />\r\n&nbsp;</p>','<p>倍清 护眼 防眩光<br />\r\n广色域真色彩A+屏 <br />\r\n专利防眩光技术 <br />\r\n全能流媒体技术<br />\r\n内置流媒体卡槽 <br />\r\nMaxxBass数字重低音 <br />\r\nDSM超强睿驰3核芯引擎 <br />\r\n养眼调色板， 九段色彩调节 <br />\r\n魅蓝光影Fashion Menu <br />\r\n&nbsp;</p>',7,8,9,0,'../upload/200903/watermark/1237384090.jpg','../upload/200903/thumb/1237384090.jpg',1,0,'2009-03-18 21:46:43','2009-03-18 21:33:18','','海尔','台','LU42K1','','','','','','','','Haier','Platform','￥5130.00','','','','','','','');
INSERT INTO `met_product` VALUES (3,'夏普电视LCD-65AE5A','XP LCD-65AE5A','夏普电视LCD-65AE5A','','','','<p>ASV低反向TFT液晶屏<br />\r\n超宽视角+MPD技术<br />\r\n智能光控(OPC)<br />\r\nCCFL冷阴极萤光灯管<br />\r\n搭载Bass Enhancer技术 <br />\r\n&nbsp;</p>','<p>ASV低反向TFT液晶屏<br />\r\n超宽视角+MPD技术<br />\r\n智能光控(OPC)<br />\r\nCCFL冷阴极萤光灯管<br />\r\n搭载Bass Enhancer技术 <br />\r\n&nbsp;</p>',7,8,9,0,'../upload/200903/watermark/1237384063.jpg','../upload/200903/thumb/1237384063.jpg',1,1,'2009-03-18 21:46:30','2009-03-18 21:36:43','','夏普','台','￥47500.00','','','','','','','','XP','Platform','￥47500.00','','','','','','','');
INSERT INTO `met_product` VALUES (4,'飞利浦彩电42PFL5403/93','Phlips 42PFL5403/93','','','','','<p>逐点晶晰技术，可获得出众的细节、层次和清晰度</p>\r\n<p>HD Ready 可显示高品质的高清信号</p>\r\n<p>具有超宽环绕声的隐形扬声器</p>\r\n<p>EasyLink：通过 HDMI CEC 轻松控制电视和所连接设备</p>\r\n<p>灵智模式可为您所观看的节目选择理想模式</p>\r\n<p>289 亿色带来鲜艳自然的影像<br />\r\n通过一根电缆实现全数字高清连接的 3 路 HDMI 输入</p>\r\n<p>PC 输入使您可以将电视机用作电脑显示器</p>\r\n<p>您可以通过肤色选项选择最佳的肤色设置<br />\r\n&nbsp;</p>','<p>逐点晶晰技术，可获得出众的细节、层次和清晰度</p>\r\n<p>HD Ready 可显示高品质的高清信号</p>\r\n<p>具有超宽环绕声的隐形扬声器</p>\r\n<p>EasyLink：通过 HDMI CEC 轻松控制电视和所连接设备</p>\r\n<p>灵智模式可为您所观看的节目选择理想模式</p>\r\n<p>289 亿色带来鲜艳自然的影像<br />\r\n通过一根电缆实现全数字高清连接的 3 路 HDMI 输入</p>\r\n<p>PC 输入使您可以将电视机用作电脑显示器</p>\r\n<p>您可以通过肤色选项选择最佳的肤色设置<br />\r\n&nbsp;</p>',7,8,9,0,'../upload/200903/watermark/1237383931.jpg','../upload/200903/thumb/1237383931.jpg',1,0,'2009-03-18 21:46:56','2009-03-18 21:38:53','','飞利浦','台','￥5979.00 ','','','','','','','','Phlips','Platform','￥5979.00 ','','','','','','','');
INSERT INTO `met_product` VALUES (5,'海尔洗衣机XQS50-0566H','Haier XQS50-0566H','','','','','<p>5公斤、随心洗涤、全自动波轮洗衣机 * 双动力技术<br />\r\n* 独特的搅拌叶<br />\r\n* 盆型大波轮<br />\r\n* 15分钟快速洗<br />\r\n* 漂甩二合一功能<br />\r\n* 随心洗技术<br />\r\n* 抗菌材料<br />\r\n* 童锁功能<br />\r\n* 桶自洁功能<br />\r\n* 24小时预约功能<br />\r\n* 智能模糊技术</p>','<p>5公斤、随心洗涤、全自动波轮洗衣机 * 双动力技术<br />\r\n* 独特的搅拌叶<br />\r\n* 盆型大波轮<br />\r\n* 15分钟快速洗<br />\r\n* 漂甩二合一功能<br />\r\n* 随心洗技术<br />\r\n* 抗菌材料<br />\r\n* 童锁功能<br />\r\n* 桶自洁功能<br />\r\n* 24小时预约功能<br />\r\n* 智能模糊技术</p>',7,8,10,0,'../upload/200903/watermark/1237384330.jpg','../upload/200903/thumb/1237384330.jpg',0,1,'2009-03-19 11:41:01','2009-03-18 21:47:48','','海尔洗','台','￥2080.00','','','','','','','','Haier','Platform','￥2080.00','','','','','','','');

INSERT INTO `met_skin_table` VALUES (1,'红色双语','red','默认模板');
INSERT INTO `met_skin_table` VALUES (2,'蓝色中文','metinfo','米拓官方模板');
INSERT INTO `met_skin_table` VALUES (3,'绿色双语','metgreen','绿色双语');
INSERT INTO `met_skin_table` VALUES (4,'浅红双语','metred','浅红双语');
INSERT INTO `met_skin_table` VALUES (5,'草绿双语','metcaolv','草绿双语');
INSERT INTO `met_skin_table` VALUES (6,'橘红双语','metjacinth','橘红双语');
INSERT INTO `met_skin_table` VALUES (7,'紫色双语','metpurple','紫色双语');
INSERT INTO `met_skin_table` VALUES (8,'浅蓝双语','metseablue','浅蓝双语');
INSERT INTO `met_skin_table` VALUES (9,'暗红双语','met009','适合文章模块较多的企业网站');
