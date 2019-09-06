<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.

defined('IN_MET') or exit('No permission');

define ('TEM_INSTALL_VER', '1.000');

class install {
	function dosql(){
		global $_M;		
		
$sql = array (
  0 => 'pos =\'2\',no_order=\'1\',type=\'1\',style=\'3\',selectd=\'\',name =\'met_download\',value=\'\',defaultvalue=\'\',valueinfo =\'下载模块\',tips=\'\',bigclass =\'0\'',
  1 => 'pos =\'3\',no_order=\'1\',type=\'1\',style=\'3\',selectd=\'\',name =\'news_bar\',value=\'\',defaultvalue=\'\',valueinfo =\'文章模块\',tips=\'\',bigclass =\'0\'',
  2 => 'pos =\'0\',no_order=\'1\',type=\'1\',style=\'3\',selectd=\'\',name =\'met_head\',value=\'\',defaultvalue=\'\',valueinfo =\'顶部设置\',tips=\'\',bigclass =\'0\'',
  3 => 'pos =\'1\',no_order=\'1\',type=\'1\',style=\'3\',selectd=\'\',name =\'met_index_product\',value=\'\',defaultvalue=\'\',valueinfo =\'首页产品区块\',tips=\'\',bigclass =\'0\'',
  4 => 'pos =\'2\',no_order=\'2\',type=\'2\',style=\'3\',selectd=\'\',name =\'download\',value=\'立即下载\',defaultvalue=\'立即下载\',valueinfo =\'按钮文字\',tips=\'\',bigclass =\'131\'',
  5 => 'pos =\'3\',no_order=\'2\',type=\'4\',style=\'3\',selectd=\'$M$开启$T$1$M$关闭$T$0\',name =\'bar_column3_open\',value=\'1\',defaultvalue=\'1\',valueinfo =\'三级栏目开关\',tips=\'除开产品模块以外的侧栏\',bigclass =\'133\'',
  6 => 'pos =\'0\',no_order=\'2\',type=\'4\',style=\'3\',selectd=\'$M$开启$T$1$M$关闭$T$0\',name =\'navbarok\',value=\'1\',defaultvalue=\'1\',valueinfo =\'下拉菜单\',tips=\'\',bigclass =\'183\'',
  7 => 'pos =\'1\',no_order=\'2\',type=\'2\',style=\'3\',selectd=\'\',name =\'index_product_title\',value=\'标题\',defaultvalue=\'标题\',valueinfo =\'区块标题\',tips=\'\',bigclass =\'201\'',
  8 => 'pos =\'3\',no_order=\'3\',type=\'4\',style=\'3\',selectd=\'$M$开启$T$1$M$关闭$T$0\',name =\'bar_column_open\',value=\'1\',defaultvalue=\'1\',valueinfo =\'侧栏栏目开关\',tips=\'除开产品模块以外的侧栏\',bigclass =\'133\'',
  9 => 'pos =\'2\',no_order=\'3\',type=\'1\',style=\'3\',selectd=\'\',name =\'met_img\',value=\'\',defaultvalue=\'\',valueinfo =\'图片模块\',tips=\'\',bigclass =\'0\'',
  10 => 'pos =\'0\',no_order=\'3\',type=\'2\',style=\'3\',selectd=\'\',name =\'nav_ml\',value=\'10\',defaultvalue=\'10\',valueinfo =\'导航间距\',tips=\'默认是0，仅支持5的倍数（0/5/10/15/20...最大50）<br/>不同网站的导航数量不同，根据需求适当调整间距，让网站更协调。\',bigclass =\'183\'',
  11 => 'pos =\'1\',no_order=\'3\',type=\'3\',style=\'3\',selectd=\'\',name =\'index_product_desc\',value=\'描述\',defaultvalue=\'描述\',valueinfo =\'区块描述\',tips=\'\',bigclass =\'201\'',
  12 => 'pos =\'3\',no_order=\'4\',type=\'4\',style=\'3\',selectd=\'$M$开启$T$1$M$关闭$T$0\',name =\'news_bar_list_open\',value=\'1\',defaultvalue=\'1\',valueinfo =\'侧栏文章列表开关\',tips=\'\',bigclass =\'133\'',
  13 => 'pos =\'2\',no_order=\'4\',type=\'4\',style=\'3\',selectd=\'$M$浏览模式$T$1$M$详情模式$T$0\',name =\'img_listlook_style\',value=\'1\',defaultvalue=\'1\',valueinfo =\'查看模式\',tips=\'浏览模式为在列表页浏览图片，详情模式为点击进入详情页\',bigclass =\'154\'',
  14 => 'pos =\'0\',no_order=\'4\',type=\'4\',style=\'3\',selectd=\'$M$开启$T$1$M$关闭$T$0\',name =\'navbullet_ok\',value=\'1\',defaultvalue=\'1\',valueinfo =\'下拉动画\',tips=\'\',bigclass =\'183\'',
  15 => 'pos =\'1\',no_order=\'4\',type=\'6\',style=\'3\',selectd=\'\',name =\'index_product_id\',value=\'\',defaultvalue=\'\',valueinfo =\'调用栏目\',tips=\'\',bigclass =\'201\'',
  16 => 'pos =\'3\',no_order=\'5\',type=\'2\',style=\'3\',selectd=\'\',name =\'news_bar_list_title\',value=\'为您推荐\',defaultvalue=\'为您推荐\',valueinfo =\'侧栏文章列表标题\',tips=\'\',bigclass =\'133\'',
  17 => 'pos =\'0\',no_order=\'5\',type=\'2\',style=\'3\',selectd=\'\',name =\'all\',value=\'全部\',defaultvalue=\'全部\',valueinfo =\'下拉菜单全部\',tips=\'仅在手机端显示\',bigclass =\'183\'',
  18 => 'pos =\'2\',no_order=\'5\',type=\'1\',style=\'3\',selectd=\'\',name =\'met_job\',value=\'\',defaultvalue=\'\',valueinfo =\'招聘模块\',tips=\'\',bigclass =\'0\'',
  19 => 'pos =\'1\',no_order=\'5\',type=\'2\',style=\'3\',selectd=\'\',name =\'index_product_all\',value=\'全部\',defaultvalue=\'全部\',valueinfo =\'栏目列表代表文字\',tips=\'\',bigclass =\'201\'',
  20 => 'pos =\'3\',no_order=\'6\',type=\'2\',style=\'3\',selectd=\'\',name =\'news_bar_list_num\',value=\'5\',defaultvalue=\'5\',valueinfo =\'侧栏列表文章数量\',tips=\'\',bigclass =\'133\'',
  21 => 'pos =\'0\',no_order=\'6\',type=\'4\',style=\'3\',selectd=\'$M$鼠标经过$T$1$M$点击展开$T$0\',name =\'navhoverok\',value=\'1\',defaultvalue=\'1\',valueinfo =\'下拉方式\',tips=\'\',bigclass =\'183\'',
  22 => 'pos =\'2\',no_order=\'6\',type=\'2\',style=\'3\',selectd=\'\',name =\'cvtitle\',value=\'在线应聘\',defaultvalue=\'在线应聘\',valueinfo =\'按钮文字\',tips=\'\',bigclass =\'199\'',
  23 => 'pos =\'1\',no_order=\'6\',type=\'2\',style=\'3\',selectd=\'\',name =\'index_product_column_xxl\',value=\'4\',defaultvalue=\'4\',valueinfo =\'大尺寸电脑显示列数\',tips=\'浏览器宽度大于1600像素时\',bigclass =\'201\'',
  24 => 'pos =\'3\',no_order=\'7\',type=\'4\',style=\'3\',selectd=\'$M$全部$T$all$M$推荐$T$com\',name =\'news_bar_list_type\',value=\'com\',defaultvalue=\'com\',valueinfo =\'侧栏列表文章类型\',tips=\'\',bigclass =\'133\'',
  25 => 'pos =\'2\',no_order=\'7\',type=\'1\',style=\'3\',selectd=\'\',name =\'subcolumn_nav\',value=\'\',defaultvalue=\'\',valueinfo =\'子栏目设置\',tips=\'\',bigclass =\'0\'',
  26 => 'pos =\'0\',no_order=\'7\',type=\'4\',style=\'3\',selectd=\'$M$头部$T$1$M$底部$T$0\',name =\'langlist_position\',value=\'1\',defaultvalue=\'1\',valueinfo =\'多语言位置\',tips=\'\',bigclass =\'183\'',
  27 => 'pos =\'1\',no_order=\'7\',type=\'2\',style=\'3\',selectd=\'\',name =\'index_product_column_lg\',value=\'4\',defaultvalue=\'4\',valueinfo =\'普通电脑显示列数\',tips=\'浏览器宽度大于992像素小于1600像素时\',bigclass =\'201\'',
  28 => 'pos =\'3\',no_order=\'8\',type=\'1\',style=\'3\',selectd=\'\',name =\'downlaod_bar\',value=\'\',defaultvalue=\'\',valueinfo =\'下载模块\',tips=\'\',bigclass =\'0\'',
  29 => 'pos =\'2\',no_order=\'8\',type=\'4\',style=\'3\',selectd=\'$M$开启$T$1$M$关闭$T$0\',name =\'tagshow_2\',value=\'1\',defaultvalue=\'1\',valueinfo =\'区块开关\',tips=\'\',bigclass =\'156\'',
  30 => 'pos =\'0\',no_order=\'8\',type=\'4\',style=\'3\',selectd=\'$M$开启$T$1$M$关闭$T$0\',name =\'langlist1_icon_ok\',value=\'1\',defaultvalue=\'1\',valueinfo =\'语言国旗开关\',tips=\'\',bigclass =\'183\'',
  31 => 'pos =\'1\',no_order=\'8\',type=\'2\',style=\'3\',selectd=\'\',name =\'index_product_column_md\',value=\'2\',defaultvalue=\'2\',valueinfo =\'平板显示列数\',tips=\'浏览器宽度大于768像素小于992像素时\',bigclass =\'201\'',
  32 => 'pos =\'2\',no_order=\'9\',type=\'1\',style=\'3\',selectd=\'\',name =\'met_news\',value=\'\',defaultvalue=\'\',valueinfo =\'文章模块\',tips=\'\',bigclass =\'0\'',
  33 => 'pos =\'3\',no_order=\'9\',type=\'2\',style=\'3\',selectd=\'\',name =\'download_bar_list_title\',value=\'为你推荐\',defaultvalue=\'为你推荐\',valueinfo =\'侧栏下载列表标题\',tips=\'\',bigclass =\'147\'',
  34 => 'pos =\'0\',no_order=\'9\',type=\'1\',style=\'3\',selectd=\'\',name =\'met_position\',value=\'\',defaultvalue=\'\',valueinfo =\'当前位置\',tips=\'\',bigclass =\'0\'',
  35 => 'pos =\'1\',no_order=\'9\',type=\'2\',style=\'3\',selectd=\'\',name =\'index_product_column_xs\',value=\'2\',defaultvalue=\'2\',valueinfo =\'手机显示列数\',tips=\'浏览器宽度小于768像素时\',bigclass =\'201\'',
  36 => 'pos =\'2\',no_order=\'10\',type=\'4\',style=\'3\',selectd=\'$M$开启$T$1$M$关闭$T$0\',name =\'news_imgok\',value=\'1\',defaultvalue=\'1\',valueinfo =\'图片开关\',tips=\'\',bigclass =\'145\'',
  37 => 'pos =\'3\',no_order=\'10\',type=\'2\',style=\'3\',selectd=\'\',name =\'sidebar_downloadlist_num\',value=\'5\',defaultvalue=\'5\',valueinfo =\'侧栏下载列表数量\',tips=\'\',bigclass =\'147\'',
  38 => 'pos =\'0\',no_order=\'10\',type=\'2\',style=\'3\',selectd=\'\',name =\'position_text\',value=\'你的位置\',defaultvalue=\'你的位置\',valueinfo =\'当前位置标题\',tips=\'\',bigclass =\'158\'',
  39 => 'pos =\'1\',no_order=\'10\',type=\'2\',style=\'3\',selectd=\'\',name =\'index_product_allnum\',value=\'8\',defaultvalue=\'8\',valueinfo =\'调用条数\',tips=\'每个列表调用信息最多条数\',bigclass =\'201\'',
  40 => 'pos =\'3\',no_order=\'11\',type=\'4\',style=\'3\',selectd=\'$M$全部$T$all$M$推荐$T$com\',name =\'download_bar_list_type\',value=\'com\',defaultvalue=\'com\',valueinfo =\'侧栏列表下载类型\',tips=\'\',bigclass =\'147\'',
  41 => 'pos =\'0\',no_order=\'11\',type=\'4\',style=\'3\',selectd=\'$M$开启$T$1$M$关闭$T$0\',name =\'tagshow_1\',value=\'1\',defaultvalue=\'1\',valueinfo =\'区域开关\',tips=\'\',bigclass =\'158\'',
  42 => 'pos =\'1\',no_order=\'11\',type=\'4\',style=\'3\',selectd=\'全部$T$all$M$推荐$T$com\',name =\'index_product_type\',value=\'all\',defaultvalue=\'all\',valueinfo =\'调用类型\',tips=\'列表信息调用类型，【推荐】可以在添加或管理文章列表时设置。\',bigclass =\'201\'',
  43 => 'pos =\'0\',no_order=\'12\',type=\'1\',style=\'3\',selectd=\'\',name =\'met_foot\',value=\'\',defaultvalue=\'\',valueinfo =\'底部设置\',tips=\'\',bigclass =\'0\'',
  44 => 'pos =\'3\',no_order=\'12\',type=\'4\',style=\'3\',selectd=\'$M$开启$T$1$M$关闭$T$0\',name =\'download_column3_ok\',value=\'1\',defaultvalue=\'1\',valueinfo =\'三级栏目开关\',tips=\'\',bigclass =\'147\'',
  45 => 'pos =\'1\',no_order=\'12\',type=\'4\',style=\'3\',selectd=\'切换卡$T$1$M$链接$T$0\',name =\'index_product_style_type\',value=\'1\',defaultvalue=\'1\',valueinfo =\'展示样式\',tips=\'\',bigclass =\'201\'',
  46 => 'pos =\'0\',no_order=\'13\',type=\'4\',style=\'3\',selectd=\'$M$开启$T$1$M$关闭$T$0\',name =\'link_ok\',value=\'1\',defaultvalue=\'1\',valueinfo =\'友情链接开关\',tips=\'\',bigclass =\'140\'',
  47 => 'pos =\'3\',no_order=\'13\',type=\'4\',style=\'3\',selectd=\'$M$开启$T$1$M$关闭$T$0\',name =\'downloadsidebar_column_ok\',value=\'1\',defaultvalue=\'1\',valueinfo =\'侧栏栏目开关\',tips=\'\',bigclass =\'147\'',
  48 => 'pos =\'0\',no_order=\'14\',type=\'2\',style=\'3\',selectd=\'\',name =\'footlink_title\',value=\'友情链接\',defaultvalue=\'友情链接\',valueinfo =\'友情链接标题\',tips=\'\',bigclass =\'140\'',
  49 => 'pos =\'3\',no_order=\'14\',type=\'4\',style=\'3\',selectd=\'$M$开启$T$1$M$关闭$T$0\',name =\'sidebar_downloadlist_ok\',value=\'1\',defaultvalue=\'1\',valueinfo =\'侧栏文章列表开关\',tips=\'\',bigclass =\'147\'',
  50 => 'pos =\'0\',no_order=\'15\',type=\'4\',style=\'3\',selectd=\'$M$底部$T$0$M$顶部$T$1\',name =\'cn1_position\',value=\'0\',defaultvalue=\'0\',valueinfo =\'简繁体切换按钮位置\',tips=\'\',bigclass =\'140\'',
  51 => 'pos =\'3\',no_order=\'15\',type=\'1\',style=\'3\',selectd=\'\',name =\'img_bar\',value=\'\',defaultvalue=\'\',valueinfo =\'图片模块\',tips=\'\',bigclass =\'0\'',
  52 => 'pos =\'0\',no_order=\'16\',type=\'4\',style=\'3\',selectd=\'$M$开启$T$1$M$关闭$T$0\',name =\'cn1_ok\',value=\'1\',defaultvalue=\'1\',valueinfo =\'简繁体切换开关\',tips=\'\',bigclass =\'140\'',
  53 => 'pos =\'3\',no_order=\'16\',type=\'4\',style=\'3\',selectd=\'$M$开启$T$1$M$关闭$T$0\',name =\'img_bar_list_open\',value=\'1\',defaultvalue=\'1\',valueinfo =\'侧栏图片列表开关\',tips=\'\',bigclass =\'161\'',
  54 => 'pos =\'3\',no_order=\'17\',type=\'2\',style=\'3\',selectd=\'\',name =\'img_bar_list_title\',value=\'为您推荐\',defaultvalue=\'为您推荐\',valueinfo =\'侧栏图片列表标题\',tips=\'\',bigclass =\'161\'',
  55 => 'pos =\'0\',no_order=\'17\',type=\'1\',style=\'3\',selectd=\'\',name =\'global\',value=\'\',defaultvalue=\'\',valueinfo =\'全局参数\',tips=\'\',bigclass =\'0\'',
  56 => 'pos =\'1\',no_order=\'17\',type=\'2\',style=\'3\',selectd=\'\',name =\'index_product_img_w\',value=\'300\',defaultvalue=\'300\',valueinfo =\'缩略图宽\',tips=\'默认为300px\',bigclass =\'201\'',
  57 => 'pos =\'3\',no_order=\'18\',type=\'4\',style=\'3\',selectd=\'$M$全部$T$all$M$推荐$T$com\',name =\'img_bar_list_type\',value=\'com\',defaultvalue=\'com\',valueinfo =\'侧栏列表图片类型\',tips=\'\',bigclass =\'161\'',
  58 => 'pos =\'0\',no_order=\'18\',type=\'2\',style=\'3\',selectd=\'\',name =\'sub_all\',value=\'全部\',defaultvalue=\'全部\',valueinfo =\'页面文字\',tips=\'\',bigclass =\'191\'',
  59 => 'pos =\'1\',no_order=\'18\',type=\'2\',style=\'3\',selectd=\'\',name =\'index_product_img_h\',value=\'300\',defaultvalue=\'300\',valueinfo =\'缩略图高\',tips=\'默认为300px\',bigclass =\'201\'',
  60 => 'pos =\'3\',no_order=\'19\',type=\'2\',style=\'3\',selectd=\'\',name =\'img_bar_list_num\',value=\'5\',defaultvalue=\'5\',valueinfo =\'侧栏列表图片数量\',tips=\'\',bigclass =\'161\'',
  61 => 'pos =\'0\',no_order=\'19\',type=\'2\',style=\'3\',selectd=\'\',name =\'page_ajax_next\',value=\'加载更多\',defaultvalue=\'加载更多\',valueinfo =\'分页文字\',tips=\'无刷新分页默认文字\',bigclass =\'191\'',
  62 => 'pos =\'3\',no_order=\'20\',type=\'4\',style=\'3\',selectd=\'$M$开启$T$1$M$关闭$T$0\',name =\'imgbar_column_open\',value=\'1\',defaultvalue=\'1\',valueinfo =\'侧栏栏目开关\',tips=\'\',bigclass =\'161\'',
  63 => 'pos =\'0\',no_order=\'20\',type=\'2\',style=\'3\',selectd=\'\',name =\'nodata\',value=\'没有数据了\',defaultvalue=\'没有数据了\',valueinfo =\'无数据提示\',tips=\'\',bigclass =\'191\'',
  64 => 'pos =\'3\',no_order=\'21\',type=\'4\',style=\'3\',selectd=\'$M$开启$T$1$M$关闭$T$0\',name =\'img_column3_ok\',value=\'1\',defaultvalue=\'1\',valueinfo =\'三级栏目开关\',tips=\'\',bigclass =\'161\'',
  65 => 'pos =\'0\',no_order=\'21\',type=\'2\',style=\'3\',selectd=\'\',name =\'search_placeholder\',value=\'请输入内容关键词\',defaultvalue=\'请输入内容关键词\',valueinfo =\'搜索文字\',tips=\'\',bigclass =\'191\'',
  66 => 'pos =\'3\',no_order=\'22\',type=\'1\',style=\'3\',selectd=\'\',name =\'product_bar\',value=\'\',defaultvalue=\'\',valueinfo =\'产品模块侧边栏\',tips=\'\',bigclass =\'0\'',
  67 => 'pos =\'0\',no_order=\'22\',type=\'9\',style=\'3\',selectd=\'\',name =\'first_color\',value=\'#000000\',defaultvalue=\'#000000\',valueinfo =\'模板主色调\',tips=\'\',bigclass =\'191\'',
  68 => 'pos =\'3\',no_order=\'23\',type=\'2\',style=\'3\',selectd=\'\',name =\'product_sidebar_piclist_title\',value=\'热门推荐\',defaultvalue=\'热门推荐\',valueinfo =\'区块标题\',tips=\'\',bigclass =\'168\'',
  69 => 'pos =\'0\',no_order=\'23\',type=\'4\',style=\'3\',selectd=\'当前窗口打开$T$_self$M$新窗口打开$T$_blank$M$\',name =\'met_listurlblank\',value=\'_self\',defaultvalue=\'_self\',valueinfo =\'页面链接\',tips=\'\',bigclass =\'191\'',
  70 => 'pos =\'3\',no_order=\'24\',type=\'2\',style=\'3\',selectd=\'\',name =\'product_sidebar_piclist_num\',value=\'5\',defaultvalue=\'5\',valueinfo =\'调用条数\',tips=\'\',bigclass =\'168\'',
  71 => 'pos =\'0\',no_order=\'24\',type=\'1\',style=\'3\',selectd=\'\',name =\'banner\',value=\'\',defaultvalue=\'\',valueinfo =\'banner设置\',tips=\'\',bigclass =\'0\'',
  72 => 'pos =\'0\',no_order=\'24\',type=\'2\',style=\'3\',selectd=\'\',name =\'met_font\',value=\'\',defaultvalue=\'\',valueinfo =\'页面字体\',tips=\'非特殊语种，建议留空使用模板默认字体\',bigclass =\'191\'',
  73 => 'pos =\'3\',no_order=\'25\',type=\'4\',style=\'3\',selectd=\'$M$全部$T$all$M$推荐$T$com\',name =\'product_sidebar_piclist_type\',value=\'com\',defaultvalue=\'com\',valueinfo =\'调用类型\',tips=\'\',bigclass =\'168\'',
  74 => 'pos =\'0\',no_order=\'25\',type=\'4\',style=\'3\',selectd=\'$M$提示$T$1\',name =\'info\',value=\'1\',defaultvalue=\'1\',valueinfo =\'提示\',tips=\'此banner是图片不适合设置高度，如果觉得banner尺寸不合适请更换banner尺寸\',bigclass =\'172\'',
  75 => 'pos =\'1\',no_order=\'25\',type=\'1\',style=\'3\',selectd=\'\',name =\'met_index_news\',value=\'\',defaultvalue=\'\',valueinfo =\'首页新闻区块\',tips=\'\',bigclass =\'0\'',
  76 => 'pos =\'0\',no_order=\'26\',type=\'9\',style=\'3\',selectd=\'\',name =\'page_top_bgcolor\',value=\'#ccc\',defaultvalue=\'#ccc\',valueinfo =\'内页无banner背景色\',tips=\'\',bigclass =\'172\'',
  77 => 'pos =\'1\',no_order=\'26\',type=\'2\',style=\'3\',selectd=\'\',name =\'index_news_title\',value=\'标题\',defaultvalue=\'标题\',valueinfo =\'区块标题\',tips=\'\',bigclass =\'176\'',
  78 => 'pos =\'0\',no_order=\'27\',type=\'9\',style=\'3\',selectd=\'\',name =\'bannersub_color\',value=\'#fff\',defaultvalue=\'#fff\',valueinfo =\'内页无banner字体色\',tips=\'\',bigclass =\'172\'',
  79 => 'pos =\'1\',no_order=\'27\',type=\'3\',style=\'3\',selectd=\'\',name =\'index_news_desc\',value=\'描述\',defaultvalue=\'描述\',valueinfo =\'区块描述\',tips=\'\',bigclass =\'176\'',
  80 => 'pos =\'0\',no_order=\'28\',type=\'1\',style=\'3\',selectd=\'\',name =\'met_contact\',value=\'\',defaultvalue=\'\',valueinfo =\'底部联系信息设置\',tips=\'\',bigclass =\'0\'',
  81 => 'pos =\'1\',no_order=\'28\',type=\'6\',style=\'3\',selectd=\'\',name =\'home_news1\',value=\'4\',defaultvalue=\'4\',valueinfo =\'新闻区块一\',tips=\'调用当前栏目的内容列表\',bigclass =\'176\'',
  82 => 'pos =\'0\',no_order=\'29\',type=\'2\',style=\'3\',selectd=\'\',name =\'footinfo_tel\',value=\'\',defaultvalue=\'\',valueinfo =\'服务热线\',tips=\'\',bigclass =\'113\'',
  83 => 'pos =\'1\',no_order=\'29\',type=\'6\',style=\'3\',selectd=\'\',name =\'home_news2\',value=\'5\',defaultvalue=\'5\',valueinfo =\'新闻区块二\',tips=\'调用当前栏目的内容列表\',bigclass =\'176\'',
  84 => 'pos =\'0\',no_order=\'30\',type=\'2\',style=\'3\',selectd=\'\',name =\'footinfo_dsc\',value=\'\',defaultvalue=\'\',valueinfo =\'描述文字\',tips=\'\',bigclass =\'113\'',
  85 => 'pos =\'1\',no_order=\'30\',type=\'6\',style=\'3\',selectd=\'\',name =\'home_news3\',value=\'3\',defaultvalue=\'3\',valueinfo =\'新闻区块三\',tips=\'调用当前栏目的内容列表\',bigclass =\'176\'',
  86 => 'pos =\'0\',no_order=\'31\',type=\'4\',style=\'3\',selectd=\'$M$开启$T$1$M$关闭$T$0\',name =\'footinfo_wx_ok\',value=\'1\',defaultvalue=\'1\',valueinfo =\'微信\',tips=\'\',bigclass =\'113\'',
  87 => 'pos =\'1\',no_order=\'31\',type=\'2\',style=\'3\',selectd=\'\',name =\'home_news_num\',value=\'5\',defaultvalue=\'5\',valueinfo =\'调用条数\',tips=\'\',bigclass =\'176\'',
  88 => 'pos =\'0\',no_order=\'32\',type=\'7\',style=\'3\',selectd=\'\',name =\'footinfo_wx\',value=\'\',defaultvalue=\'\',valueinfo =\'微信二维码\',tips=\'\',bigclass =\'113\'',
  89 => 'pos =\'1\',no_order=\'32\',type=\'4\',style=\'3\',selectd=\'$M$全部$T$all$M$推荐$T$com\',name =\'home_news_type\',value=\'all\',defaultvalue=\'all\',valueinfo =\'调用类型\',tips=\'\',bigclass =\'176\'',
  90 => 'pos =\'0\',no_order=\'33\',type=\'4\',style=\'3\',selectd=\'$M$开启$T$1$M$关闭$T$0\',name =\'footinfo_qq_ok\',value=\'1\',defaultvalue=\'1\',valueinfo =\'QQ\',tips=\'\',bigclass =\'113\'',
  91 => 'pos =\'1\',no_order=\'33\',type=\'2\',style=\'3\',selectd=\'\',name =\'home_news_more\',value=\'MORE\',defaultvalue=\'MORE\',valueinfo =\'更多文字\',tips=\'\',bigclass =\'176\'',
  92 => 'pos =\'0\',no_order=\'34\',type=\'4\',style=\'3\',selectd=\'$M$个人QQ$T$1$M$企业营销QQ$T$2\',name =\'foot_info_qqtype\',value=\'1\',defaultvalue=\'1\',valueinfo =\'QQ类型\',tips=\'个人QQ和企业营销QQ超链接结构不一样，因此请务必选择正确。\',bigclass =\'113\'',
  93 => 'pos =\'0\',no_order=\'35\',type=\'2\',style=\'3\',selectd=\'\',name =\'footinfo_qq\',value=\'\',defaultvalue=\'\',valueinfo =\'QQ号码\',tips=\'点击QQ链接可直接对话，需要先到 shang.qq.com 免费开通。<br/>企业营销QQ 无需开通\',bigclass =\'113\'',
  94 => 'pos =\'0\',no_order=\'36\',type=\'4\',style=\'3\',selectd=\'$M$开启$T$1$M$关闭$T$0\',name =\'footinfo_sina_ok\',value=\'1\',defaultvalue=\'1\',valueinfo =\'新浪微博\',tips=\'\',bigclass =\'113\'',
  95 => 'pos =\'0\',no_order=\'37\',type=\'2\',style=\'3\',selectd=\'\',name =\'footinfo_sina\',value=\'\',defaultvalue=\'\',valueinfo =\'新浪微博网址\',tips=\'请输入微博网址\',bigclass =\'113\'',
  96 => 'pos =\'0\',no_order=\'38\',type=\'4\',style=\'3\',selectd=\'$M$开启$T$1$M$关闭$T$0\',name =\'footinfo_twitterok\',value=\'0\',defaultvalue=\'0\',valueinfo =\'twitter（推特）\',tips=\'\',bigclass =\'113\'',
  97 => 'pos =\'0\',no_order=\'39\',type=\'2\',style=\'3\',selectd=\'\',name =\'footinfo_twitter\',value=\'\',defaultvalue=\'\',valueinfo =\'twitter网址\',tips=\'\',bigclass =\'113\'',
  98 => 'pos =\'0\',no_order=\'40\',type=\'4\',style=\'3\',selectd=\'$M$开启$T$1$M$关闭$T$0\',name =\'footinfo_googleok\',value=\'0\',defaultvalue=\'0\',valueinfo =\'google+\',tips=\'\',bigclass =\'113\'',
  99 => 'pos =\'0\',no_order=\'41\',type=\'2\',style=\'3\',selectd=\'\',name =\'footinfo_google\',value=\'\',defaultvalue=\'\',valueinfo =\'google+网址\',tips=\'\',bigclass =\'113\'',
  100 => 'pos =\'0\',no_order=\'42\',type=\'4\',style=\'3\',selectd=\'$M$开启$T$1$M$关闭$T$0\',name =\'footinfo_facebookok\',value=\'0\',defaultvalue=\'0\',valueinfo =\'Facebook\',tips=\'\',bigclass =\'113\'',
  101 => 'pos =\'0\',no_order=\'43\',type=\'2\',style=\'3\',selectd=\'\',name =\'footinfo_facebook\',value=\'\',defaultvalue=\'\',valueinfo =\'Facebook网址\',tips=\'\',bigclass =\'113\'',
  102 => 'pos =\'0\',no_order=\'44\',type=\'4\',style=\'3\',selectd=\'$M$开启$T$1$M$关闭$T$0\',name =\'footinfo_emailok\',value=\'0\',defaultvalue=\'0\',valueinfo =\'邮箱\',tips=\'\',bigclass =\'113\'',
  103 => 'pos =\'0\',no_order=\'45\',type=\'2\',style=\'3\',selectd=\'\',name =\'footinfo_email\',value=\'\',defaultvalue=\'\',valueinfo =\'邮箱地址\',tips=\'\',bigclass =\'113\'',
);
$no='metv6s';
$devices='0';
		$re['sql'] = $sql;
		$re['no'] = $no;
		$re['devices'] = $devices;
		return $re;
	}
}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>