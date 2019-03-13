<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.

defined('IN_MET') or exit('No permission');

define ('TEM_INSTALL_VER', '1.000');

class install {
	function dosql(){
		global $_M;		
		
$sql = array (
  0 => 'pos =\'1\',no_order=\'1\',type=\'1\',style=\'3\',selectd=\'\',name =\'\',value=\'\',defaultvalue=\'\',valueinfo =\'关于我们\',tips=\'\'',
  1 => 'pos =\'2\',no_order=\'1\',type=\'1\',style=\'3\',selectd=\'\',name =\'\',value=\'\',defaultvalue=\'\',valueinfo =\'文章模块\',tips=\'\'',
  2 => 'pos =\'3\',no_order=\'1\',type=\'1\',style=\'3\',selectd=\'\',name =\'\',value=\'\',defaultvalue=\'\',valueinfo =\'产品模块相关产品\',tips=\'\'',
  3 => 'pos =\'0\',no_order=\'1\',type=\'1\',style=\'3\',selectd=\'\',name =\'\',value=\'\',defaultvalue=\'\',valueinfo =\'顶部设置\',tips=\'\'',
  4 => 'pos =\'1\',no_order=\'2\',type=\'2\',style=\'3\',selectd=\'\',name =\'about_title\',value=\'关于我们\',defaultvalue=\'关于我们\',valueinfo =\'标题2\',tips=\'\'',
  5 => 'pos =\'2\',no_order=\'2\',type=\'4\',style=\'3\',selectd=\'$M$标题+更新时间$T$1$M$标题+描述+更新时间$T$2$M$缩略图+标题+描述+更新时间$T$3\',name =\'met_module2_type\',value=\'1\',defaultvalue=\'1\',valueinfo =\'展示方式\',tips=\'\'',
  6 => 'pos =\'3\',no_order=\'2\',type=\'2\',style=\'3\',selectd=\'\',name =\'product_related_title\',value=\'您可能喜欢\',defaultvalue=\'您可能喜欢\',valueinfo =\'相关产品标题\',tips=\'\'',
  7 => 'pos =\'0\',no_order=\'2\',type=\'4\',style=\'3\',selectd=\'$M$开启$T$1$M$关闭$T$0\',name =\'mobiletopnavtype\',value=\'1\',defaultvalue=\'1\',valueinfo =\'顶部固定\',tips=\'往下滚动内容时可以让LOGO部分固定在顶部显示\'',
  8 => 'pos =\'1\',no_order=\'2\',type=\'1\',style=\'3\',selectd=\'\',name =\'\',value=\'\',defaultvalue=\'\',valueinfo =\'产品展示\',tips=\'\'',
  9 => 'pos =\'1\',no_order=\'3\',type=\'8\',style=\'3\',selectd=\'\',name =\'about_content\',value=\'\',defaultvalue=\'\',valueinfo =\'简介内容\',tips=\'\'',
  10 => 'pos =\'2\',no_order=\'3\',type=\'1\',style=\'3\',selectd=\'\',name =\'\',value=\'\',defaultvalue=\'\',valueinfo =\'产品模块\',tips=\'\'',
  11 => 'pos =\'3\',no_order=\'3\',type=\'2\',style=\'3\',selectd=\'\',name =\'product_related_num\',value=\'10\',defaultvalue=\'10\',valueinfo =\'相关产品调用条数\',tips=\'调用同栏目分类下的产品\'',
  12 => 'pos =\'1\',no_order=\'4\',type=\'2\',style=\'3\',selectd=\'\',name =\'about_more\',value=\'了解更多\',defaultvalue=\'了解更多\',valueinfo =\'链接文字\',tips=\'内容下面的按钮链接文字\'',
  13 => 'pos =\'2\',no_order=\'4\',type=\'4\',style=\'3\',selectd=\'缩略图+产品名称$T$1$M$缩略图+产品名称+描述$T$2$M$\',name =\'met_module3_type\',value=\'1\',defaultvalue=\'1\',valueinfo =\'展示方式\',tips=\'\'',
  14 => 'pos =\'1\',no_order=\'5\',type=\'6\',style=\'4\',selectd=\'\',name =\'about_id\',value=\'\',defaultvalue=\'\',valueinfo =\'链接地址\',tips=\'更多按钮链接的地址，一般会设置为链接到公司简介。\'',
  15 => 'pos =\'2\',no_order=\'5\',type=\'1\',style=\'3\',selectd=\'\',name =\'\',value=\'\',defaultvalue=\'\',valueinfo =\'图片模块\',tips=\'\'',
  16 => 'pos =\'2\',no_order=\'6\',type=\'4\',style=\'3\',selectd=\'$M$缩略图+名称$T$1$M$缩略图+名称+描述$T$2\',name =\'met_module5_type\',value=\'2\',defaultvalue=\'2\',valueinfo =\'展示方式\',tips=\'\'',
  17 => 'pos =\'1\',no_order=\'6\',type=\'4\',style=\'3\',selectd=\'$M$显示区块$T$1$M$隐藏区块$T$0\',name =\'about_open\',value=\'1\',defaultvalue=\'1\',valueinfo =\'区块开关\',tips=\'\'',
  18 => 'pos =\'1\',no_order=\'8\',type=\'6\',style=\'3\',selectd=\'\',name =\'product_id\',value=\'\',defaultvalue=\'\',valueinfo =\'调用内容\',tips=\'\'',
  19 => 'pos =\'1\',no_order=\'9\',type=\'2\',style=\'3\',selectd=\'\',name =\'product_title\',value=\'推荐产品\',defaultvalue=\'推荐产品\',valueinfo =\'自定义标题\',tips=\'为空则采用内容所属栏目名称\'',
  20 => 'pos =\'1\',no_order=\'10\',type=\'2\',style=\'3\',selectd=\'\',name =\'product_num\',value=\'8\',defaultvalue=\'8\',valueinfo =\'显示条数\',tips=\'\'',
  21 => 'pos =\'1\',no_order=\'11\',type=\'4\',style=\'3\',selectd=\'$M$推荐产品$T$com$M$全部产品$T$\',name =\'product_type\',value=\'\',defaultvalue=\'\',valueinfo =\'调用类型\',tips=\'产品调用类型，【推荐产品】可以在添加或管理产品时设置。\'',
  22 => 'pos =\'1\',no_order=\'12\',type=\'4\',style=\'3\',selectd=\'$M$显示区块$T$1$M$隐藏区块$T$0\',name =\'product_open\',value=\'1\',defaultvalue=\'1\',valueinfo =\'区块开关\',tips=\'\'',
  23 => 'pos =\'1\',no_order=\'13\',type=\'2\',style=\'3\',selectd=\'\',name =\'product_more\',value=\'浏览更多产品\',defaultvalue=\'浏览更多产品\',valueinfo =\'更多链接文字\',tips=\'\'',
  24 => 'pos =\'1\',no_order=\'14\',type=\'1\',style=\'3\',selectd=\'\',name =\'\',value=\'\',defaultvalue=\'\',valueinfo =\'文章列表设置\',tips=\'\'',
  25 => 'pos =\'1\',no_order=\'15\',type=\'2\',style=\'3\',selectd=\'\',name =\'news_title\',value=\'文章列表\',defaultvalue=\'文章列表\',valueinfo =\'大标题\',tips=\'\'',
  26 => 'pos =\'1\',no_order=\'16\',type=\'2\',style=\'3\',selectd=\'\',name =\'news_num\',value=\'8\',defaultvalue=\'8\',valueinfo =\'显示条数\',tips=\'文章列表显示条数\'',
  27 => 'pos =\'1\',no_order=\'17\',type=\'2\',style=\'3\',selectd=\'\',name =\'news_more\',value=\'浏览更多文章\',defaultvalue=\'浏览更多文章\',valueinfo =\'更多链接文字\',tips=\'链接到对应栏目的列表页\'',
  28 => 'pos =\'1\',no_order=\'18\',type=\'4\',style=\'3\',selectd=\'显示区块$T$1$M$隐藏区块$T$0$M$\',name =\'news_open\',value=\'1\',defaultvalue=\'1\',valueinfo =\'区块开关\',tips=\'\'',
  29 => 'pos =\'1\',no_order=\'19\',type=\'1\',style=\'3\',selectd=\'\',name =\'\',value=\'\',defaultvalue=\'\',valueinfo =\'文章列表一\',tips=\'\'',
  30 => 'pos =\'1\',no_order=\'20\',type=\'6\',style=\'3\',selectd=\'\',name =\'news_list1_id\',value=\'\',defaultvalue=\'\',valueinfo =\'调用内容\',tips=\'\'',
  31 => 'pos =\'1\',no_order=\'21\',type=\'2\',style=\'3\',selectd=\'\',name =\'news_list1_title\',value=\'新闻动态\',defaultvalue=\'新闻动态\',valueinfo =\'自定义标题\',tips=\'为空则采用内容所属栏目名称\'',
  32 => 'pos =\'1\',no_order=\'22\',type=\'4\',style=\'3\',selectd=\'$M$推荐文章$T$com$M$全部文章$T$\',name =\'news_list1_type\',value=\'\',defaultvalue=\'\',valueinfo =\'调用类型\',tips=\'文章调用类型，【推荐文章】可以在添加或管理文章时设置。\'',
  33 => 'pos =\'1\',no_order=\'23\',type=\'4\',style=\'3\',selectd=\'$M$显示列表$T$1$M$隐藏列表$T$0\',name =\'news_list1_open\',value=\'1\',defaultvalue=\'1\',valueinfo =\'列表开关\',tips=\'\'',
  34 => 'pos =\'1\',no_order=\'24\',type=\'1\',style=\'3\',selectd=\'\',name =\'\',value=\'\',defaultvalue=\'\',valueinfo =\'文章列表二\',tips=\'\'',
  35 => 'pos =\'1\',no_order=\'25\',type=\'6\',style=\'3\',selectd=\'\',name =\'news_list2_id\',value=\'\',defaultvalue=\'\',valueinfo =\'调用内容\',tips=\'\'',
  36 => 'pos =\'1\',no_order=\'26\',type=\'2\',style=\'3\',selectd=\'\',name =\'news_list2_title\',value=\'行业资讯\',defaultvalue=\'行业资讯\',valueinfo =\'自定义标题\',tips=\'为空则采用内容所属栏目名称\'',
  37 => 'pos =\'1\',no_order=\'27\',type=\'4\',style=\'3\',selectd=\'$M$推荐文章$T$com$M$全部文章$T$\',name =\'news_list2_type\',value=\'\',defaultvalue=\'\',valueinfo =\'调用类型\',tips=\'文章调用类型，【推荐文章】可以在添加或管理文章时设置。\'',
  38 => 'pos =\'1\',no_order=\'28\',type=\'4\',style=\'3\',selectd=\'$M$显示列表$T$1$M$隐藏列表$T$0\',name =\'news_list2_open\',value=\'1\',defaultvalue=\'1\',valueinfo =\'列表开关\',tips=\'\'',
  39 => 'pos =\'1\',no_order=\'29\',type=\'1\',style=\'3\',selectd=\'\',name =\'\',value=\'\',defaultvalue=\'\',valueinfo =\'图片滚动区\',tips=\'\'',
  40 => 'pos =\'1\',no_order=\'30\',type=\'6\',style=\'3\',selectd=\'\',name =\'case_id\',value=\'\',defaultvalue=\'\',valueinfo =\'调用内容\',tips=\'\'',
  41 => 'pos =\'1\',no_order=\'31\',type=\'2\',style=\'3\',selectd=\'\',name =\'case_title\',value=\'案例展示\',defaultvalue=\'案例展示\',valueinfo =\'自定义标题\',tips=\'为空则采用内容所属栏目名称\'',
  42 => 'pos =\'1\',no_order=\'32\',type=\'4\',style=\'3\',selectd=\'推荐信息$T$com$M$所有信息$T$$M$\',name =\'case_type\',value=\'\',defaultvalue=\'\',valueinfo =\'调用类型\',tips=\'调用类型，【推荐】可以在添加或管理内容时设置。\'',
  43 => 'pos =\'1\',no_order=\'33\',type=\'2\',style=\'3\',selectd=\'\',name =\'case_num\',value=\'16\',defaultvalue=\'16\',valueinfo =\'显示条数\',tips=\'\'',
  44 => 'pos =\'1\',no_order=\'34\',type=\'2\',style=\'3\',selectd=\'\',name =\'case_more\',value=\'浏览更多案例\',defaultvalue=\'浏览更多案例\',valueinfo =\'更多链接文字\',tips=\'\'',
  45 => 'pos =\'1\',no_order=\'35\',type=\'4\',style=\'3\',selectd=\'$M$显示区块$T$1$M$隐藏区块$T$0\',name =\'case_open\',value=\'1\',defaultvalue=\'1\',valueinfo =\'区块开关\',tips=\'\'',
  46 => 'pos =\'1\',no_order=\'36\',type=\'1\',style=\'3\',selectd=\'\',name =\'\',value=\'\',defaultvalue=\'\',valueinfo =\'联系我们\',tips=\'\'',
  47 => 'pos =\'1\',no_order=\'37\',type=\'2\',style=\'3\',selectd=\'\',name =\'indexfooter_contact\',value=\'联系我们\',defaultvalue=\'联系我们\',valueinfo =\'标题文字\',tips=\'\'',
  48 => 'pos =\'1\',no_order=\'38\',type=\'2\',style=\'3\',selectd=\'\',name =\'contact_position\',value=\'\',defaultvalue=\'\',valueinfo =\'地址\',tips=\'\'',
  49 => 'pos =\'1\',no_order=\'39\',type=\'2\',style=\'3\',selectd=\'\',name =\'contact_phone\',value=\'\',defaultvalue=\'\',valueinfo =\'电话\',tips=\'\'',
  50 => 'pos =\'1\',no_order=\'40\',type=\'2\',style=\'3\',selectd=\'\',name =\'contact_email\',value=\'\',defaultvalue=\'\',valueinfo =\'邮箱\',tips=\'\'',
  51 => 'pos =\'1\',no_order=\'41\',type=\'4\',style=\'3\',selectd=\'$M$显示区块$T$1$M$隐藏区块$T$0\',name =\'footer_open\',value=\'1\',defaultvalue=\'1\',valueinfo =\'区块开关\',tips=\'联系我们、关注我们、友情链接三个区块\'',
  52 => 'pos =\'1\',no_order=\'42\',type=\'1\',style=\'3\',selectd=\'\',name =\'\',value=\'\',defaultvalue=\'\',valueinfo =\'关注我们\',tips=\'\'',
  53 => 'pos =\'1\',no_order=\'43\',type=\'2\',style=\'3\',selectd=\'\',name =\'weibo_sina\',value=\'\',defaultvalue=\'\',valueinfo =\'新浪微博网址\',tips=\'\'',
  54 => 'pos =\'1\',no_order=\'44\',type=\'2\',style=\'3\',selectd=\'\',name =\'weibo_tqq\',value=\'\',defaultvalue=\'\',valueinfo =\'腾讯微博网址\',tips=\'\'',
  55 => 'pos =\'1\',no_order=\'45\',type=\'2\',style=\'3\',selectd=\'\',name =\'weibo_qq\',value=\'\',defaultvalue=\'\',valueinfo =\'客服QQ\',tips=\'只支持填写一个QQ号码，支持企业QQ。\'',
  56 => 'pos =\'1\',no_order=\'46\',type=\'7\',style=\'3\',selectd=\'\',name =\'weixin_img\',value=\'\',defaultvalue=\'\',valueinfo =\'微信二维码\',tips=\'请上传微信二维码图片\'',
  57 => 'pos =\'1\',no_order=\'47\',type=\'1\',style=\'3\',selectd=\'\',name =\'\',value=\'\',defaultvalue=\'\',valueinfo =\'页面部分文字\',tips=\'\'',
  58 => 'pos =\'1\',no_order=\'48\',type=\'2\',style=\'3\',selectd=\'\',name =\'indexfooter_attention\',value=\'关注我们\',defaultvalue=\'关注我们\',valueinfo =\'标题文字\',tips=\'\'',
  59 => 'pos =\'1\',no_order=\'49\',type=\'2\',style=\'3\',selectd=\'\',name =\'attention_weibo\',value=\'关注微博：\',defaultvalue=\'关注微博：\',valueinfo =\'页面文字\',tips=\'关注类型\'',
  60 => 'pos =\'1\',no_order=\'50\',type=\'2\',style=\'3\',selectd=\'\',name =\'weibo_sina_title\',value=\'关注新浪微博\',defaultvalue=\'关注新浪微博\',valueinfo =\'页面文字\',tips=\'关注新浪微博title文字\'',
  61 => 'pos =\'1\',no_order=\'51\',type=\'2\',style=\'3\',selectd=\'\',name =\'weibo_tqq_title\',value=\'关注腾讯微博\',defaultvalue=\'关注腾讯微博\',valueinfo =\'页面文字\',tips=\'关注腾讯微博title文字\'',
  62 => 'pos =\'1\',no_order=\'52\',type=\'2\',style=\'3\',selectd=\'\',name =\'weibo_qq_title\',value=\'联系QQ客服\',defaultvalue=\'联系QQ客服\',valueinfo =\'页面文字\',tips=\'联系QQ客服title文字\'',
  63 => 'pos =\'1\',no_order=\'53\',type=\'2\',style=\'3\',selectd=\'\',name =\'attention_weixin\',value=\'微信公众号：\',defaultvalue=\'微信公众号：\',valueinfo =\'页面文字\',tips=\'关注类型\'',
  64 => 'pos =\'1\',no_order=\'54\',type=\'2\',style=\'3\',selectd=\'\',name =\'linkstitle\',value=\'友情链接\',defaultvalue=\'友情链接\',valueinfo =\'页面文字\',tips=\'友情链接区块标题\'',
);
$no='metx5_mobile';
$devices='1';
		$re['sql'] = $sql;
		$re['no'] = $no;
		$re['devices'] = $devices;
		return $re;
	}
}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>