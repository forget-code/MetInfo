<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.

defined('IN_MET') or exit('No permission');


//数据库
$db = new DB();
//表单提交
foreach($_M['form'] as $key => $val){
	$k="{$key}";
	$$k=$val;

}
//变量，常量定义
global $methtml_flash,$met_flasharray,$classnow,$met_flashimg,$navurl,$product,$news,$service,$about,$team,$partner,$hot,$service_home_column,$case,$ad,$coupon,$theme,$newpd,$quick,$notice,$theme1,$theme2,$theme3,$work,$column_column,$lang_inner_newlm,$inner_newlm,$cases,$tuandui,$footabout,$footimg,$inner_prolm,$item1,$item2,$item3,$item4,$user,$newsLeft,$newsRight,$home_procan,$jion,$special1_id,$special2_id,$special3_id,$img_txt,$client,$inews,$about_url,$ipro_lm,$ipro_lm2,$ipro_lm3,$imglist,$imgshow,$list,$linkyq,$case_column,$info_column,$picture_column,$video_column,$hotnews,$bottomcontact,$info_column,$about_column,$four_column,$servic_home_column,$team_home_column,$info_home_column,$image_home_column,$about_home_column,$product_home_column,$footimg,$footnews,$footabout,$down;



//设置左边和中间内容页面显示的页面
$control['content']=$_M['custom_template']['content'];
$control['left']=$_M['custom_template']['left'];

define('ROOTPATH', PATH_WEB);
$class1    = $this->input['class1'];
$class2    = $this->input['class2'];
$class3    = $this->input['class3'];
$classnow  = $this->input['classnow'];
$id        = $this->input['id'];
$lang      = $_M['lang'];
$index_url = $_M['url']['site'];
$met_langok= load::sys_class('label', 'new')->get('language')->get_lang();
$index = $classnow == 10001 ? 'index' : false;

// $title = $this->input['title'];
// $keywords = $this->input['keywords'];
// $description = $this->input['description'];

$met_title = $this->input['page_title'];
$show['keywords'] = $this->input['page_keywords'];
$show['description'] = $this->input['page_description'];


$navurl    = M_CLASS == 'index' ? '' : '../';
//应用兼容
$navurl    = M_NAME == 'xquery' ? '../' : $navurl;
$navurl    = M_NAME == 'branchmap' ? '../' : $navurl;
//
$weburly   = $navurl;
$thumb_src = $navurl.'include/thumb.php?';



$skinurl   = 'templates/'.$_M['config']['met_skin_user'];
$css_url   = $weburly.$skinurl.'/css/';
$img_url   = $weburly.$skinurl.'/images/';
$met_url   = $weburly.'public/';
$metweburl = ROOTPATH;

$m_now_time     = time();
$m_now_date     = date('Y-m-d H:i:s',$m_now_time);
$m_now_counter  = date('Ymd',$m_now_time);
$m_now_month    = date('Ym',$m_now_time);
$m_now_year     = date('Y',$m_now_time);

//数据表
foreach($_M['table'] as $key => $val){
	$k="met_{$key}";
	$$k=$val;
}

//config
foreach($_M['config'] as $key => $val){
	$$key=$val;
}
$met_logo = $index_url.str_replace('../', '', $_M['config']['met_logo'])
;
//语言
foreach($_M['word'] as $key => $val){
	$k="lang_{$key}";
	$$k=$val;
}




//模板配置数据
$tmpincfile = PATH_WEB."templates/{$_M[config][met_skin_user]}/metinfo.inc.php";
if(file_exists($tmpincfile)){
	require $tmpincfile;
}
//栏目兼容
$cache_column = load::sys_class('label', 'new')->get('column')->get_cache_column();
foreach ($cache_column as $key => $val) {
	$k="{$key}";
	$$k=$val;
}

if($_M['form']['met_mobileok']){
	require_once ROOTPATH.'include/mobile.php';
}

//url
$met_chtmtype=".".$_M['config']['met_htmtype'];
$met_htmtype=($_M['lang']==$_M['config']['met_index_type'])?".".$_M['config']['met_htmtype']:"_".$_M['lang'].".".$_M['config']['met_htmtype'];
$langmark='lang='.$_M['lang'];

//banner
$met_flasharray = load::sys_class('label', 'new')->get('banner')->get_config();
$tmp_imgs = load::sys_class('label', 'new')->get('banner')->get_column_banner($classnow);

$met_flasharray[$classnow] = $tmp_imgs['config'];
//老bannenr数据转发形式
foreach ($tmp_imgs['img'] as $list) {

	$met_flashall[]=$list;
	$listmodule_x=explode(",",$list['module']);
	$flash_mx = count($listmodule_x);

	if($list['flash_path']!=""){
		$met_flashflashall[]=$list;
		if($list['module']=='metinfo'){
			if(!$flash_flash_module[$classnow])$flash_flash_module[$classnow]=$list;
		}else{
			for($i=0;$i<$flash_mx;$i++){
				if(!$flash_flash_module[$listmodule_x[$i]] && $listmodule_x[$i]!='')$flash_flash_module[$listmodule_x[$i]]=$list;
			}
		}
	}else{
		$met_flashimgall[]=$list;

		if($list['module']=='metinfo'){
			if(!$flash_img_module[$classnow])$flash_img_module[$classnow]=$list;
		}else{
			for($i=0;$i<$flash_mx;$i++){
				if((!$flash_img_module[$listmodule_x[$i]]) && $listmodule_x[$i]!='')$flash_img_module[$listmodule_x[$i]]=$list;
			}
		}
	}
}


if($met_flasharray[$classnow]['type']==3){
	foreach($met_flashall as $key=>$val){
		$val['nowmod']=','.$classnow.',';
		if($val['module']==$val['nowmod'])$flash_img_module[$classnow]=$val;
		$val['nowmod']=','.$superior.',';
		if($val['module']==$val['nowmod'])$flash_img_module[$classnow]=$val;
	}
}
if($met_flasharray[$classnow]['type']==2){
	if(count($flash_flash_module[$classnow])==0){
		if($class3<>0){
			if($class2<>0&&count($flash_flash_module[$class2])<>0){
				$flash_nowarray=$flash_flash_module[$class2];
				$met_flash_x=$met_flasharray[$class2]['x'];
				$met_flash_y=$met_flasharray[$class2]['y'];
			}elseif($class1<>0&&count($flash_flash_module[$class1])<>0){
				$flash_nowarray=$flash_flash_module[$class1];
				$met_flash_x=$met_flasharray[$class1]['x'];
				$met_flash_y=$met_flasharray[$class1]['y'];
			}else{
				$flash_nowarray=$flash_flash_module[10000];
				$met_flash_x=$met_flasharray[10000]['x'];
				$met_flash_y=$met_flasharray[10000]['y'];
			}
		}elseif($class2<>0){
			if($class1<>0&&count($flash_flash_module[$class1])<>0){
				$flash_nowarray=$flash_flash_module[$class1];
				$met_flash_x=$met_flasharray[$class1]['x'];
				$met_flash_y=$met_flasharray[$class1]['y'];
			}else{
				$flash_nowarray=$flash_flash_module[10000];
				$met_flash_x=$met_flasharray[10000]['x'];
				$met_flash_y=$met_flasharray[10000]['y'];
			}
		}else{
			$flash_nowarray=$flash_flash_module[10000];
			$met_flash_x=$met_flasharray[10000]['x'];
			$met_flash_y=$met_flasharray[10000]['y'];
		}
	}else{
		$flash_nowarray=$flash_flash_module[$classnow];
		$met_flash_x=$met_flasharray[$classnow]['x'];
		$met_flash_y=$met_flasharray[$classnow]['y'];
	}

	if(count($flash_nowarray)<>0){
		$met_flash_ok=1;
		$met_flash_type=1;
		$met_flash_url=$flash_nowarray['flash_path'];
		$met_e_flash_url=$flash_nowarray['e_flash_path'];
		$met_flash_back=$flash_nowarray['flash_back'];
		$met_e_flash_back=$flash_nowarray['e_flash_back'];
	}
}elseif($met_flasharray[$classnow][type]==1){
	$met_flash_ok=1;
	$met_flash_type=0;
	foreach($met_flashimgall as $key=>$val){

		if($val['img_path']!=""){
				$met_flash_img=$met_flash_img.$val['img_path']."|";
				$met_flash_imglink=$met_flash_imglink.$val['img_link']."|";
				$met_flash_imgtitle=$met_flash_imgtitle.$val['img_title']."|";
				// 添加banner属性（新模板框架v2）
				$met_flash_imgtitle_color=$met_flash_imgtitle_color.$val['img_title_color']."|";
				$met_flash_imgdes=$met_flash_imgdes.$val['img_des']."|";
				$met_flash_imgdes_color=$met_flash_imgdes_color.$val['img_des_color']."|";
				$met_flash_imgtext_position=$met_flash_imgtext_position.$val['img_text_position']."|";
				$met_flashimg[]=$val;
				$met_flasharray[$classnow]['y'] = $val['height'];
		}
	}
	$met_flash_x=$met_flasharray[$classnow]['x'];
	$met_flash_y=$met_flasharray[$classnow]['y'];

}elseif($met_flasharray[$classnow]['type']==3){
	if(count($flash_img_module[$classnow])){
		$flash_imgone_img=$flash_img_module[$classnow]['img_path'];
		$flash_imgone_url=$flash_img_module[$classnow]['img_link'];
		$flash_imgone_title=$flash_img_module[$classnow]['img_title'];
	}else{
		if($flash_imgone_img==""){
			$flash_imgone_img=$flash_img_module[$class2]['img_path'];
			$flash_imgone_url=$flash_img_module[$class2]['img_link'];
			$flash_imgone_title=$flash_img_module[$class2]['img_title'];
		}
		if($flash_imgone_img==""){
			$flash_imgone_img=$flash_img_module[$class1]['img_path'];
			$flash_imgone_url=$flash_img_module[$class1]['img_link'];
			$flash_imgone_title=$flash_img_module[$class1]['img_title'];
		}
		if($flash_imgone_img==""){
			$flash_imgone_img=$flash_img_module[10000]['img_path'];
			$flash_imgone_url=$flash_img_module[10000]['img_link'];
			$flash_imgone_title=$flash_img_module[10000]['img_title'];
		}
	}
    $met_flash_x=$met_flasharray[$classnow]['x'];
    $met_flash_y=$met_flasharray[$classnow]['y'];
}elseif($met_flasharray[$classnow]['type']==0){
	$met_flash_ok=0;
}

$met_flash_img=substr($met_flash_img, 0, -1);
$met_flash_imglink=substr($met_flash_imglink, 0, -1);
$met_flash_imgtitle=substr($met_flash_imgtitle, 0, -1);
$met_flashurl=$met_flash_imglink;
$met_flash_xpx=$met_flash_x."px";
$met_flash_ypx=$met_flash_y."px";
//老模板数据转发方式结束
$met_flashimg = $met_flashimgall;
//兼容函数
require_once PATH_WEB.'app/system/include/compatible/metv5_top.php';
//兼容标签库
require_once PATH_WEB."public/php/methtml.inc.php";

$columnnow = load::sys_class('label', 'new')->get('column')->get_column_id($classnow);

//字段共用数组
$p = load::sys_class('label', 'new')->get('parameter')->get_para('product');
foreach ($p as $key =>$val) {
	$apppara[] = $val;
}
$p = load::sys_class('label', 'new')->get('parameter')->get_para('download');
foreach ($p as $key =>$val) {
	$apppara[] = $val;
}
$p = load::sys_class('label', 'new')->get('parameter')->get_para('img');
foreach ($p as $key =>$val) {
	$apppara[] = $val;
}



foreach ($apppara as $list){
	$list['para']="para".$list['id'];
	$list['paraname']="para".$list['id']."name";
	$metpara[$list['id']]=$list;
	if(($list['class1']==0) or ($list['class1']==$class1 and $list['class2']==0 and $list['class3']==0) or ($list['class1']==$class1 and $list['class2']==$class2 and $list['class3']==0) or ($list['class1']==$class1 and $list['class2']==$class2 and $list['class3']==$class3) or $index=='index'){
		switch($list['module']){
			case 3:
				$product_para[]=$list;
				$productpara[$list['type']][]=$list;
				$product_paralist[]=$list;
				/*2.0*/
				if($list[type]==1 or $list[type]==2)$product_para200[]=$list;
				if($list[type]==5)$product_paraimg[]=$list;
				if($list[type]==2)$product_paraselect[]=$list;
				/*2.0*/
				break;
			case 4:
				$download_para[]=$list;
				$downloadpara[$list['type']][]=$list;
				$download_paralist[]=$list;
				/*2.0*/
				if($list[type]==1)$download_para200[]=$list;
				/*2.0*/
				break;
			case 5:
				$img_para[]=$list;
				$imgpara[$list['type']][]=$list;
				$img_paralist[]=$list;
				/*2.0*/
				if($list[type]==1)$img_para200[]=$list;
				if($list[type]==5)$img_paraimg[]=$list;
				if($list[type]==2)$img_paraselect[]=$list;
				/*2.0.*/
				break;
		}
	}
}
//友情链接
$tmp_link = load::sys_class('label', 'new')->get('link')->get_link_list();
foreach ($tmp_link as $list) {
	// if($index=='index' && strstr($list['weblogo'],"../")){
	// 	$linkweblogo=explode('../',$list['weblogo']);
	// 	$list['weblogo']=$linkweblogo[1];
	// }
	if($list['link_type']=="0"){
		if($list['com_ok']=="1")$link_text_com[]=$list;
		$link_text[]=$list;
	}
	if($list['link_type']=="1"){
		if($list['com_ok']=="1")$link_img_com[]=$list;
		$link_img[]=$list;
	}
	if($list['com_ok']=="1")$link_com[]=$list;
	$link[]=$list;
}

// 案例详情页
require_once PATH_WEB.'public/php/imgdisplayhtml.inc.php';

//内页面包屑导航
$nav_x = array();

$class123 = load::sys_class('label', 'new')->get('column')->get_class123_no_reclass($classnow);

foreach ($class123 as $key => $val) {
	if($key != 'class1' && $val)$nav_x[name].= " > ";
	if($val)$nav_x[name].="<a href=\"{$val[url]}\" target=\"{$val[new_windows]}\">{$val[name]}</a>";
}

$class1_info = $class123['class1'];
$class2_info = $class123['class2'];
//简介模块
if($columnnow['module'] == 1){
	$show = $this->input;
} else if($columnnow['module']>=2 && $columnnow['module']<=7) {
	if ($this->input['list'] == 1) {
		$page = $_M['form']['page'] ? $_M['form']['page'] : 1;
		//列表页面
		switch ($columnnow['module']) {
			case '2':
				$news_list = load::sys_class('label', 'new')->get('news')->get_list_page($classnow, $_M['form']['page']);
				$mod_str = 'news';
			break;
			case '3':
				if($met_product_page){
					$sub_column = load::sys_class('label','new')->get('column')->get_column_son($classnow);
					foreach ($sub_column as $key => $val) {
						$product_list[$key] = $val;
						$product_list[$key]['title'] = $val['name'];
						$product_list[$key]['imgurl'] = $val['columnimg'];
					}
				}else{
					$product_list = load::sys_class('label', 'new')->get('product')->get_list_page($classnow, $_M['form']['page']);

				}

                //商品筛选app
                foreach ($_M['plugin']['doweb'] as $val) {
                    if($val == 'productatt'){
                        #dump($_M['form']);
                        $paras = array();
                        $flag = false;
                        foreach ($_M['form'] as $key => $val) {
                            if(strstr($key, "para")){
                                $flag = true;
                                $pno = str_replace('para', '', $key);
                                //赛选属性值
                                $paras[$pno] = $val;
                            }
                        }

                        if($flag){
                            $pdt_list = array();
                            foreach ($product_list as $product) {
                                foreach ($product['para'] as $para) {
                                    if(in_array($para['id'],array_keys($paras))){
                                        if(in_array($para['value'], array_values($paras))){
                                            $pdt_list[] = $product;

                                        }
                                    }
                                }
                            }
                            $product_list = $pdt_list;
                        }
                    }
                }

				$mod_str = 'product';
				$search = $_M['form']['search'];
				$title = $_M['form']['title'];
				$content = $_M['form']['content'];
			break;
			case '4':
				$download_list = load::sys_class('label', 'new')->get('download')->get_list_page($classnow, $_M['form']['page']);
				$mod_str = 'download';
			break;
			case '5':
				if($met_img_page){
					$sub_column = load::sys_class('label','new')->get('column')->get_column_son($classnow);
					foreach ($sub_column as $key => $val) {
						$img_list[$key] = $val;
						$img_list[$key]['title'] = $val['name'];
						$img_list[$key]['imgurl'] = $val['columnimg'];
					}
				}else{
					$img_list = load::sys_class('label', 'new')->get('img')->get_list_page($classnow, $_M['form']['page']);
				}
				$mod_str = 'img';
			break;
			case '6':
				$job_list = load::sys_class('label', 'new')->get('job')->get_list_page($classnow, $_M['form']['page']);
				$mod_str = 'job';
			break;
			case '7':
				$message_list = load::sys_class('label', 'new')->get('message')->get_list_page($classnow, $_M['form']['page']);
				$mod_str = 'message';
			break;
		}
		//分页代码
		$page_list = load::sys_class('label', 'new')->get('tag')->get_page_html($classnow, $_M['form']['page']);
	} else {
		//内容页面
		$show_contents = $this->input;
		$show_contents['content'] .= $show_contents['tagstr'];
		foreach ($show_contents['para'] as $val) {
			$show_contents['para'.$val['id']] = $val['value'];
		}

		switch ($columnnow['module']) {
			case '2':
				$news = $show_contents;
				// metx5内容详情用到了news_list
				$news_list = load::sys_class('label', 'new')->get('news')->get_list_page($classnow, $_M['form']['page']);
			break;
			case '3':
				$product = $show_contents;
				$product_list = load::sys_class('label', 'new')->get('product')->get_list_page($classnow, $_M['form']['page']);
				$displaylist = array();
				foreach ($product['displayimgs'] as $key => $val) {
					$displaylist[$key] = $val;
					$displaylist[$key]['imgurl'] = $val['img'];
					if(!$_M['config']['shopv2_open']){
						unset($displaylist[0]);
					}
				}
				$met_productdetail_x = $_M['config']['met_productdetail_x'];
				$met_productdetail_y = $_M['config']['met_productdetail_y'];
			break;
			case '4':
				$download = $show_contents;
				$download_list = load::sys_class('label', 'new')->get('download')->get_list_page($classnow, $_M['form']['page']);
			break;
			case '5':
				$img = $show_contents;
				$img_list = load::sys_class('label', 'new')->get('img')->get_list_page($classnow, $_M['form']['page']);
				$img_list = array();
				foreach ($img['displayimgs'] as $key => $val) {
					$displaylist[$key] = $val;
					$displaylist[$key]['imgurl'] = $val['img'];
					if(!$_M['config']['shopv2_open']){
						unset($displaylist[0]);
					}
				}
				$met_productdetail_x = $_M['config']['met_productdetail_x'];
				$met_productdetail_y = $_M['config']['met_productdetail_y'];
			break;
			case '6':
				$job = $show_contents;
				$job_list = load::sys_class('label', 'new')->get('job')->get_list_page($classnow, $_M['form']['page']);
			break;
		}
		//上一篇／下一篇
		$preinfo = $show_contents['preinfo'];
		if ($preinfo['disable']) {
			$preinfo['url'] = '#';
		}

		$nextinfo = $show_contents['nextinfo'];
		if ($nextinfo['disable']) {
			$nextinfo['url'] = '#';
		}

		//相反了
		$tmp = $preinfo;
		$preinfo = $nextinfo;
		$nextinfo = $tmp;
	}
	if($columnnow['module'] == 6){
		//在线招聘左侧导航
		if($_M['confg']['metinfover']){
			$jobcv = load::sys_class('handle', 'new')->url_transform('job/cv.php?lang='.$_M['lang']);
			if(count($nav_list2[$class1])){
				$k=count($nav_list2[$class1]);
				$nav_list2[$class1][$k]=array('id'=>10004,'url'=>$jobcv,'name'=>$_M['word']['cvtitle']);
			}else{
				$nav_list2[$class1][0]=$class_list[$classnow];
				$nav_list2[$class1][1]=array('id'=>10004,'url'=>$jobcv,'name'=>$_M['word']['cvtitle']);
			}
		}
		//招聘字段
		$cv_para_tmp = load::sys_class('label', 'new')->get('job')->get_module_form($classnow);
		$cv_para = $cv_para_tmp['para'];

		$j = load::sys_class('label', 'new')->get('job')->get_module_list($classnow, $num);

		foreach ($j as $list) {
			$selectok=$this->input['selectedjob']==$list['id']?"selected='selected'":"";
			$selectjob.="<option value='$list[id]' $selectok>{$list['position']}</option>";
		}
		foreach ($cv_para as $key =>$val) {
			$apppara[] = $val;
		}
	}
}else if($columnnow['module'] == '8'){
	$title = $columnnow['name'];
}else if($columnnow['module'] == '11'){
	$search_list = load::sys_class('label', 'new')->get('search')->get_search_list($this->input['searchword']);
	$this->add_input('search_list', $search_list);
	//分页代码
	$page_list = load::sys_class('label', 'new')->get('tag')->get_page_html($classnow, $_M['form']['page']);
}
//
if($columnnow['releclass']){
	$nav_list2[$class1] = $nav_list2[$columnnow['bigclass']];
	$lang_all = '';
}

//字段选项
foreach ($apppara as $key => $val) {
	$paravalue[$val['id']] = $val['para_list'];
}
//导航选中
$navdown=$class1;
$sidedwon2=$class2;
$sidedwon3=$class3;
if($class_list[$classnow]['nav'] == 1 || $class_list[$classnow]['nav'] == 2)$sidedwon2=$classnow;
if($class1 == 0 || $class_list[$class1]['na'] == 2 || $class_list[$class1][nav] == 0)$navdown="10001";
if($class_list[$classnow]['nav'] == 1 || $class_list[$classnow]['nav'] == 3)$navdown=$classnow;
if($class_list[$classnow]['nav'] == 0 || $class_list[$classnow]['nav'] == 2){
	if($class_list[$classnow]['releclass'])$navdown=$class_list[$classnow]['releclass'];
	$higher=$class_list[$classnow]['bigclass'];
	if($class_list[$higher]['releclass'])$navdown=$class_list[$higher]['releclass'];
	if($class_list[$higher]['nav']==1||$class_list[$higher]['nav']==3)$navdown=$higher;
}
if(!$navdown)$navdown=10001;
if(!$sidedwon2)$sidedwon2=10001;
if(!$sidedwon3)$sidedwon3=10001;
$metblank=$met_urlblank?"target='_blank'":"target='_self'";
$onlinex=$met_online_type<2?$met_onlineleft_left:$met_onlineright_right;
$onliney=$met_online_type<2?$met_onlineleft_top:$met_onlineright_top;
//搜索数组
function methtml_searchlist($content=1,$time=1,$detail=1,$img=0){
	global $search_list,$met_img_x,$met_img_y,$lang_Detail;
	$methtml_searchlist.="<ul>\n";
	foreach($search_list as $key=>$val){
		if($img)$methtml_searchlist.="<span class='search_img'><a href='".$val[url]."' target='_blank'><img src='".$val[imgurls]."' width=".$met_img_x." height=".$met_img_y." /></span>";
		$methtml_searchlist.="<li><span class='search_title'><a href='".$val[url]."' target='_blank'>".$val[title]."</a></span>";
		if($content)$methtml_searchlist.="<span class='search_content'>".$val[content]."</span>";
		if($time)$methtml_searchlist.="<span class='search_updatetime'>".$val[updatetime]."</span>";
	}
	$methtml_searchlist.="</li>\n";
	$methtml_searchlist.="</ul>\n";
	return $methtml_searchlist;
}
// 	if($class1=="" || $class1==10000 || $class1==10001 || $class1==0 || $searchword=='' ){
// 	$nav_x[name]="<a href='$class_info[url]'>{$class_info[name]}</a> > {$lang_SearchInfo2}";
// 	}
// 	if($searchword<>''){
// 	$nav_x[name]=$nav_x[name]."&nbsp&nbsp<font color=red>'".$lang_Keywords.":&nbsp".$searchword."'</font>";
// }
// dump($show);
// dump('121221');
//把上面赋值的变量与数组转成全局数组

$vars2=array_keys(get_defined_vars());
$a2=get_defined_vars();
foreach($vars2 as $key => $val){
	global $$val;
	$$val=$a2[$val];
}

// 手机导航不显示的栏目
if(is_mobile() && $_M['config']['met_wap']){
	foreach ($nav_list as $key => $val) {
		if(!$met_wapshowtype){
			continue;
		}else{
			if(!$val['wap_ok']){
				unset($nav_list[$key]);
			}
		}
	}
}



# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>
