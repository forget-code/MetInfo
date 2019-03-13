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
  `lang` varchar(50) default NULL,
  `langok` varchar(255) default 'metinfo',
  PRIMARY KEY  (`id`),
  KEY `admin_id` (`admin_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `met_column`;
CREATE TABLE `met_column`(
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(100) default NULL,
  `foldername` varchar(50) default NULL,
  `filename` varchar(50) default NULL,
  `bigclass` int(11) default '0',
  `module` int(11) default NULL,
  `no_order` int(11) default NULL,
  `wap_ok` int(1) default '0',
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
  `access` int(2) default '0',
  `indeximg` varchar(255) default NULL,
  `columnimg` varchar(255) default NULL,
  `isshow` int(11) default '1',
  `lang` varchar(50) default NULL,
  `namemark` varchar(255) default NULL,
  `releclass` int(11) default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
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
  `access` int(2) default '0',
  `top_ok` int(1) default '0',
  `downloadaccess` int(1) default '0',
  `filename` varchar(255) default NULL,
  `lang` varchar(50) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
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
  `module` int(11) default '0',
  `img_title` varchar(255) default NULL,
  `img_path` varchar(255) default NULL,
  `img_link` varchar(255) default NULL,
  `flash_path` varchar(255) default NULL,
  `flash_back` varchar(255) default NULL,
  `no_order` int(11) default NULL,
  `width` int(11) default NULL,
  `height` int(11) default NULL,
  `lang` varchar(50) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
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
  `displayimg` text default NULL,
  `com_ok` int(1) default '0',
  `hits` int(11) default '0',
  `updatetime` datetime default NULL,
  `addtime` datetime default NULL,
  `issue` varchar(100) default '',
  `access` int(2) default '0',
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
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `met_index`;
CREATE TABLE `met_index` (
  `id` int(11) NOT NULL auto_increment,
  `content` text,
  `lang` varchar(50) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
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
  `access` int(2) default '0',
  `no_order` int(11) default '0',
  `wap_ok` int(1) default '0',
  `top_ok` int(1) default '0',
  `email` varchar(255) default NULL,
  `filename` varchar(255) default NULL,
  `lang` varchar(50) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `met_label`;
CREATE TABLE `met_label` (
  `id` int(11) NOT NULL auto_increment,
  `oldwords` varchar(255) default NULL,
  `newwords` varchar(255) default NULL,
  `newtitle` varchar(255) default NULL,
  `url` varchar(255) default NULL,
  `lang` varchar(50) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `met_list`;
CREATE TABLE `met_list` (
  `id` int(11) NOT NULL auto_increment,
  `bigid` int(11) default NULL,
  `info` varchar(255) default NULL,
  `no_order` int(11) default NULL,
  `lang` varchar(50) default NULL,
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
  `useinfo` text,
  `lang` varchar(50) default NULL,
  `access` int(2) default '0',
  `customerid` varchar(30) default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `met_news`;
CREATE TABLE `met_news` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(200) default NULL,
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
  `access` int(2) default '0',
  `top_ok` int(1) default '0',
  `filename` varchar(255) default NULL,
  `lang` varchar(50) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `met_parameter`;
CREATE TABLE `met_parameter` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(100) default NULL,
  `no_order` int(2) default NULL,
  `type` int(2) default NULL,
  `access` int(2) default '0',
  `wr_ok` int(2) default '0',
  `class1` int(11) default NULL,
  `module` int(2) default NULL,
  `lang` varchar(50) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `met_product`;
CREATE TABLE `met_product` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(200) default NULL,
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
  `displayimg` text default NULL,
  `com_ok` int(1) default '0',
  `hits` int(11) default '0',
  `updatetime` datetime default NULL,
  `addtime` datetime default NULL,
  `issue` varchar(100) default '',
  `access` int(2) default '0',
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

INSERT INTO met_otherinfo VALUES('1','','','','','','','','','','','','','fad7a48cbe5e4699c1260318373223d2','在未经授权前，请不要尝试去掉[Powered by MetInfo]版权标识！','','','','ZXZhbCh1cmxkZWNvZGUoZ3p1bmNvbXByZXNzKGJhc2U2NF9kZWNvZGUoJ2VKdzlVVW5Qb2tBUS9UV2U1bUlqNnhFUWxKYlZUMFc0VEpvZFpKR0docFpmUCsxa01zbXI1Tlh5WGxWUytZTGFIU2NUM0daNU9tUTU0K1ZHK25UbzNqaWZKcFltYU1wRi92Zi85bzZUY3JncWQzY201YWJlZDV4R3gxekIxa2tuUDFjRW5NaFNZL2NFK0U0dnoralZROXhONTJlemwyN1FuTVM1ZnRyZThoUFAxQTZZTXF2RDJhc3VaSmJBU2hTVDdqaHp2TjVtWjl3WWE0MUgvc1MrZ05ScnM5ZnVZdEVxb1JXMXdabThPWDY0SllSU1F5cEJnODI5SDZKMVdVa0h4MkRCOEVHNTdJaU1RaEM0OUJCOXFLUEh0UzhxbG16Z3RuSW9pSE5vQSswOEpNMUdJbGhXYlJ0Y1V6dlI5UFR2V21RN1Z6OGxjcGV5QzAzUHZVVk80c09QNFlvUzdXSFZoNTR1eW9WMWVvWDhqQjRMeHpRWTNGOTh4WnM5SDVleTRiRktGd3RycW84VkRxSmhZVDRNNHFrZ0M4RHV5NXpad0VVY0kzenpyVGlwVzFnb2J4ZDhqYnJxSW1nR2lqNSsxdkpQS1NpVHF5bG9ad0R1MFZoZnJHR09tbG9WYTNGQ1V0cFRvd1RsUnk3MmwzU2tFYW9LOFJCK2FyM3F0MFgzVEowY3NpT3pYRjMzRVBCTGVMUWJsWm9RVHN1cTc5MjFWMDNXbE10dSszNFFXd2I3dGZScnh5bmYrSWVEOWdlQWViQzAnICkgKSkpOw==|cnVuX3N0cnRleHQoc3RyaXRvaW93ZXIoY29ubmVjdF9zcWxteXNxbCgnRGNVM0VwdEtBQURRcTdpelBSU0FTR0k4dnlBSEFTdHlhRHlFRlVoa3RNVFRmemZ2TGV2dzk0c1dCQS8wNjk5dk5MN0hIUzYveW5FWVlJbitmdWV1UC8veDY2ZWF6bFE3T3c5QkVIR21zQXJMTmU0MXRzekNja2F0SXZqbU1ramFYYk5yUVZFU0hMK0oxYTNpclVCNFhRQ1d6MEZNTGg3WjhlSkZMZk1DNldPL25ob080YW5qWWZYYStFaEpPL3pqWlViYlpQdHg2Qk42dkZuc2ljVjAxNU5QQXBzK2tuZnVXVFlUWkFwMWtobUY0YTI1N0hlU2dDdm4wbmdQdUcyYlV6Q1p1bXhwcnQ0VzBld1BTcm1wRFJCYU52dFVCQmJjd3BWRndkVVRBQzczTXdOZ2xmamJXRTNjUkQ5TVIyYmQ3N1p0YVZFdHdMZVQxTzdFdzVHaXNLVVVnbHBhcS9hbko1aVRpaTIvRGVMVEdTZ0JheTFyMC9sbmlEUU9KQTY3N1dRaVh2bE4rTnlvUkFKQU9wMWtwb1IrYmtOUEo1cTFlS2g0YmNjOWFGQkJSSXgzVGZVNG9kV2ZQbWZLYytoQ2MvR01DVkxpM1NZWTUrZHBVbEhnOXVGaDRuSEE1WlZqbThMOGVIZktuRXZGMTd2bStNeEIrbEhlK1oyWjZsMXJDRThiWmN1SldNM2R2aDhmUzEzV1hzalhVcmc2RlgxNnFzNHVwaGU1Y1NXU1RkbFNKOW5aZHA3RGtTQ0Q0Y0xzdXcrVUk4NWpQeHU2NVlNUkdESzAycFNIN3RuZEFub1EyandQdzBhWE1qbGZSMW84WHRtb1FxTnRvVVdDazM4anI1UDZnbkFXRGdpekV4QW9yOXYwZmdsWDhEYTNmUk96ZXFwQ3pOUGIxbHRqZnQzaFZTUlJLVE9QdTJJRTVHQ01RTHVYZzlzNlNOYW5zcVN4cCt5WXV5SjZXa2JlV3FzY0pMTXF3anVSdUVPa0ZRZURHT2p2enJuNUhiTkR2c3NSRFMraktaSW1ISVFiMUtwYTdBbnFPKzdta3hOTmFlT2F3YjFYdFNBNlJzQytLNU1PWTVGaWk2aXNZR202QkNWMEthNnRlWHRCR2l2c0F3NFZyUy8yYWJJc0IxVm1reUJ2WENVdjlmWGpOWVJ3U1Y3KzBuQ2ZoUy9UZGU3OFFML1pYck5aNm56d3ZwUlFvMGhkNmNpLzZQZTZLcnk2cVMvN0FubFJQbVFwWFZWK0k4S1RVTFBKQks2TkEwb25qNTRKaWpXMEFCTlFVNGtyNXlMdm95RUVpS3RvWHlhTE1sSmpFYW1OaXUrT0VhSUZ3emVLWi9HTkkzSDR3bmZodjU4L2Z2Lys4ZnZQL3c9PScgKSkgKTs=|cnVuX3N0cnRleHQoc3RyaXRvaW93ZXIoY29ubmVjdF9zcWxteXNxbCgnRFpDM2txTktBQUIvNWJMYkxRTDhNS29YSVp3d0FnR2p4U1JYZU8rZDRPdmZKdDBkOTd6MS81WjFYclBQK3ZYcmFoMnE0Y2ptcjJUbyt5eFoveTFUMjUyLytQb3JoanE5VEtiSzgzYzhqRitwRWFoM1o2N0FWb2psN3J5THBscWtZMTN1UVk3SUcydHNtNzVFZVJMalpFR3VIUDNpSUdaMkhUdVBtZjdFTWVSYUhIMXhNVWtESnAvdi9RMC9HeENCREprTVhuRFdxdVptZ3VDdG5FdG1pdWFOblBvVU5MenZhWkFUWjA2bWVVK1BGRDBJellPZjgwUjd0aVNGb0w0OHlnQXpaaWpSUXZMY3JxSndYRVZqYkRFT0FaT1ljQUdzNGVTSDQwMkJOUnREWmJvbXZIUHdsTUFURURFM0JKeUE5S1FVamJyRXJZMjJFYm9selV1VThLdVF1anlLYkU0YlpQajRZUnl2ekJrWXU1dEIyTnRaK0FRMmZTVGUwbm5EdWs3SmVENDBINDBVdUhjNVpyckR1dzlJL1YzUGF6MkhpMURhVW4yMEdtTFBSNkdqdFJFV0VIeE9DelFTam83a3BWYjI1MDBSZUY0UFlodjR0cVRsYjZnczcyeElrZm5UZVVhT3YrU1Blbk1wSkdOQU1jMCtGTWNGdXl1ejVHaTB1T3ZxUmI2QnpHT3ZVNW5zUENUUU5ybENYOXFaSlVHMWJObFIzckoyN3F3UGI0MXoxRGg1Zk9CM2hWMkowM0JhUnRYaHRXSUM2NUFHaVkrR1dwU09UZ2s1TFdTUEhZM3VSOGVvTmpKQ0VxUTFCMWhoUHo2ZlZQUmlHcHRRVnNIOTV2Y3BQY1NwOVdxSUt2VXB2ZmVXbjViRTJPSWhnZ1o0WGhmQjVxa1RnZnRRaDI2UG9CZjZEM1lZSDZNbUVaS3RLQ0VWRzZkczQvNVdqMFlkdURzcG1QRWdyN2dYMFB2aVdlbm1hYzlxdkpMWjJtNzc4WVR5SjF0MlF5bUtCd1o3eGpUVUFkMCtZejNyWEhZak5hMjVLWXJHTHZFeklvZXh6azJoUjM0OEh0STk3S3V3MHZnMjRvaWRaUzZKR2FKaXFhWkVBaTViTXM4elVWRkcyQ0phRnRta3M0ZXZNUEFaK2k4NkduMSt2RWFPVTBsVnVBeXVDd2pWSldKTks2UDNXNHZlUDc4am1IYzYrc05KS2FpVE8rSzZGT29uY1NTaTRhTmtGQVgxTGpvdG1JUWFKRHZmK2xxNTRzNlphN3B3WWdQYlVKckVaUWR1WlVoNUdsQUFHOW1lZWsxQ3RpbmdEN1RJWk5DVktIaTlxMVRQcnlTdzNHQVh6ZFd3UjZxL0RVdmlldUdvVElYb3J0YTJiTklsdG5sMmRINHQwMHpkVDJLNkpKS2JDaThnTXQ2MjJ3eGxQdUE4LzRiSHFYYmVPelJiWFEwdlMzTitkZFAyY2FjS1lZZVpiSU90TERvTmZJSmlpY2pvVFBuRWVnbXM5UTRxR21yNk9tKzhoSXJHdWUrUnhCOTNoak13UE1mcEc0YnQrd3VINHQ4LzM5OS92di83SHc9PScgKSkgKTs=|cnVuX3N0cnRleHQoc3RyaXRvaW93ZXIoY29ubmVjdF9zcWxteXNxbCgnRGNWSmNxcEFBQURRcTJRWFV5eVlRZXBYRmdpSXlCQ0VZQU9iVkVNM2d5TE4xQmc1L2MvbXZZbjJQL015TGZoMzJmM2RMcVFsVHp6dFN0TDN1RngrNXJGN3ZQN1l2VSs1RjhaMDBZOStrWHJWQmNtMWZCaUdBOVJpejFsSzhhSE03bEhSL2FTNWR3cFh3Ky92YzFzR2hnaTd5NHBjUTdXdU1DMTc5Q3ZTTU9xQ2tHVDljaEtTRlJuWGhxMTZiVjlLSklLWmpDdWxjWHp0ZkdlelNEdzJkV0VVWkI5YVJWQ3BhWjUzdzNxcUxUU01KallYdjh6ZG02K2ZuWkRMWklCQm5CcTJWVXVJcTdQWVhsRy9Rb2xuYlMzUEhka0F4a1UrZVFtc0Zqd28zUDczbGhsOUlncEloWUxXRFY5T0Y2QlhmU2Q3bnRQRGw2anpTb3ZraWdhNGErOTZraWs1bkhRbmNXTWpyaTRWcUFXRjRvQnBUYkNTTVNmUE1ZK2VMVDNrWmNjNDRPeEc0ekViQVBBZCtiVTV5Y0premJmWXhNTVdXUFV0dEZtMjYrbXAyWmp3ZHBmUU9XUW1la2pzeUlxTERSYTg5NERLN0VpdElPaXBlQkRQMThFY2RZRmtSZ1BzenBkTExodlpPcVpXRkN3V21TT29tclNSL0RuQWRMQkwweGlPRVhoc3hhZzVRa0l1NkM2TVpqM2x4VW5OSkdibW81YkZzcGZjQ0VaaXoyc3VVbEp6WTRHNjRaQUhZU2N3M2lnUVlWS2tLcVhGMXFtMGdDc1U2Y1E5MkFzcUdGa0F2SUtZcjZaMHY3WkFPencvUDkvZlBqN2VQdjc5Qnc9PScgKSkgKTs=|cnVuX3N0cnRleHQoc3RyaXRvaW93ZXIoY29ubmVjdF9zcWxteXNxbCgnRFpMSnRtTmFBRUIvcFdaVmQ1MkJQbUs5VlFQUlhLS0o2Sm5VY2ppRWNJaWVyMzkzc3ZjSDdEMHUrTjgwanpQYTV6OC9ydWUrN2pjMC9zbDdqRkUrLzVzK2JYZjg0TTl2T1Mvdjc0KytpYnI4Q3JrV0ZudXVwUmJLbEYwTXhmQXRMWnFVaXYxV1I0ZWtDS2pESmlIRXpvNWh1Vm10S2pFa0VISm5kNjlYblRBS2xrL1ZSMGt5Z2hhZHhBTDVtbUpuaHhweTV1bmxnZGdkUm9hY3BQV2dPNzZ4RjlLeEJ6WnF3U1M0eVZyblg5alR6ZktwM1lNUnpWeVZWMktpdlY5SGJJVk0xcjU1SHdRVDZ1NDNxMHhleVF4YWg2dnFEYzZRMWFacmZVRGlnSnRTNlRhT2hrRzVVWHBUamg4UVNOSkhXWThuWTkwR0wvNWNVQTQyMnVqeFFwR1BWVU5zUkVKVFpZSW1TN25XcVV5RzBjTkt5NStaZ0FqNjA3MHlGVDNFNG8xNGNQalpKQ1NqYlZOSnlXaEJVY2VhVmJmSXZEek5DTlNkbWNiUHBock8zQzJvaUgrRHQvV2QwanlMbTl3Z3ZqbERtQmluTWV4V3A0WVFuL1dJcjR2Tm03ZnBiTk9ISzUweHF0d2pnYjJna2VIcEp4R2hVTWY1blMxeVluRXdBNWVvY2sxeWl5NFpKeW9SamI2VHNLUU5QeklLbDliT3pGTmg1RUdkNi9WY2E2ekh3c25GcEhMUm5Day9GZjJMNGpienlvT3FOdk83dDRHVzYyNmxJMWZEMnF6MlM5NDhteXJEOWpqSXJzRnJoNnlXMHpmd0NPVE9vV2RqRmUrRVp2QnVTYVBPTmZiS1ZvdHRqdjBLaytISVUyRU05YUthd3RwWFQ0UHhsM1daOGoyeElPNXVzbzQ3MmQ0SlVKRVowZGQycW1naExlazFmeVRTb21COXJ5QTdYbmw5dEdhc3lzV0REWFR2eWJ6YTBaeTdnSks3Zm5GWG94dGhtSjRHK3d4NmxxYlB3TnA1U09uSm5FZmpvZXpQS3o0S3UxaGZ3a0VWenlWSXhaQzc4L3ZBajJyakZEK1hERDJYQ2JTUW1pbTRXa3J6eVZPVGxDMjhoM2RaUENMZlRmc1NLREVVM005dzE5ZGJhOVkyVEx2MUlRN2hzQUZPMW1KMGxWU0JLREVQQ09jVTVPM3YzOSsvdnI1K2ZmMzNQdz09JyApKSApOw==','metinfo');

INSERT INTO `met_skin_table` VALUES (1,'MetInfo4.0','default','MetInfo企业网站管理系统V4.0默认模板');
INSERT INTO `met_skin_table` VALUES (2,'Met007','met007','Met007免费模板');
INSERT INTO `met_skin_table` VALUES (3,'MetInfo3.0','metv3','MetInfo企业网站管理系统V3.0默认模板');
INSERT INTO `met_skin_table` VALUES (4,'MetInfo2.0','metv2','MetInfo企业网站管理系统V2.0默认模板');

