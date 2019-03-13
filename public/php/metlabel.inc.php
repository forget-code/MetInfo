<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 
//顶部导航函数
function metlabel_nav($type=1,$label=''){
	global $index_url,$lang_home,$nav_list,$nav_list2,$nav_list3,$lang;
	switch($type){
		case 1:
			$metinfo ='<ul class="list-none">';
			$metinfo.='<li id="nav_10001">';
			$metinfo.="<a href='{$index_url}' title='{$lang_home}' class='nav'><span>{$lang_home}</span></a>";
			$metinfo.="</li>";
			foreach($nav_list as $key=>$val){
			$metinfo.=$label;
			$metinfo.="<li id='nav_{$val[id]}'>";
			$metinfo.="<a href='{$val[url]}' {$val[new_windows]} title='{$val[name]}' class='hover-none nav'><span>{$val[name]}</span></a>";
			$metinfo.="</li>";
			}
			$metinfo.="</ul>";
			return $metinfo;
			break;
	}
}
//侧边导航函数
function metlabel_navnow($type=1,$label='',$indexnum,$listyy=0,$listmax=8){
	global $index_url,$nav_list,$nav_list2,$nav_list3,$class1,$class_list,$module_list1,$class_index,$classlistall,$lang;
			$class=$indexnum?$class_index[$indexnum]['id']:$class1;
			$mod=$class_index[$indexnum]['module'];
			if($class_list[$class1]['module']>99 && !$indexnum){
				$mod=$class_list[$class1]['module']==100?3:5;
				$type=3;
			}
			$module=metmodname($mod);
	switch($type){
		case 1:
			$metinfo ='<ul class="list-none navnow">';
			$i=0;
			foreach($nav_list2[$class] as $key=>$val){
			$i++;
   if($i!=1)$metinfo.=$label;
            $metinfo.="<li id='navnow1_{$val[id]}'>";
			$metinfo.="<a href='{$val[url]}' {$val[new_windows]} title='{$val[name]}' class='nav'><span>{$val[name]}</span></a>";
			$metinfo.="</li>";
			}
			$metinfo.="</ul>";
			return $metinfo;
			break;
		case 2:
			$i=0;
			foreach($nav_list2[$class] as $key=>$val){
			$metinfo.='<dl class="list-none navnow">';
			$i++;
   if($i!=1)$metinfo.=$label;
            $metinfo.="<dt id='part2_{$val[id]}'>";
			$metinfo.="<a href='{$val[url]}' {$val[new_windows]} title='{$val[name]}'><span>{$val[name]}</span></a>";
			$metinfo.="</dt>";
if(count($nav_list3[$val['id']])){
			$metinfo.='<dd class="sub">';
			foreach($nav_list3[$val['id']] as $key=>$val2){
            $metinfo.="<h4 id='part3_{$val2[id]}'>";
			$metinfo.="<a href='{$val2[url]}' {$val2[new_windows]} title='{$val2[name]}' class='nav'><span>{$val2[name]}</span></a>";
if(count($classlistall[$module][$val2['id']]) && $listyy && $listmax){
			$metinfo.="<p>";
			$i=0;
			foreach($classlistall[$module][$val2['id']] as $key=>$val3){
			$i++;
			$metinfo.="<a href='{$val3[url]}' target='_blank' title='{$val3[title]}'><span>{$val3[title]}</span></a>";	
			if($i>=$listmax)break;
			}
			$metinfo.="</p>";
}
			$metinfo.="</h4>";
			}
			$metinfo.="</dd>";
}elseif($listyy && $listmax && count($classlistall[$module][$val['id']])>0){
			$metinfo.="<dd class='sub'>";
			$metinfo.="<p>";
			$i=0;
			foreach($classlistall[$module][$val['id']] as $key=>$val3){
			$i++;
			$metinfo.="<a href='{$val3[url]}' target='_blank' title='{$val3[title]}'><span>{$val3[title]}</span></a>";	
			if($i>=$listmax)break;
			}
			$metinfo.="</p>";
			$metinfo.="</dd>";
}
			$metinfo.="</dl>";
			}
			return $metinfo;
			break;
		case 3:
			foreach($module_list1[$mod] as $key=>$val0){
			$class=$val0[id];
			$metinfo.="<h2><a href='{$val0[url]}' title='{$val0[name]}' {$val0[new_windows]}>{$val0[name]}</a></h2>";
			$i=0;
			foreach($nav_list2[$class] as $key=>$val){
			$metinfo.='<dl class="list-none navnow">';
			$i++;
   if($i!=1)$metinfo.=$label;
            $metinfo.="<dt id='part2_{$val[id]}'>";
			$metinfo.="<a href='{$val[url]}' {$val[new_windows]} title='{$val[name]}' class='nav'><span>{$val[name]}</span></a>";
			$metinfo.="</dt>";
if(count($nav_list3[$val['id']])){
			$metinfo.='<dd class="sub">';
			foreach($nav_list3[$val['id']] as $key=>$val2){
            $metinfo.="<h4 id='part3_{$val2[id]}'>";
			$metinfo.="<a href='{$val2[url]}' {$val2[new_windows]} title='{$val2[name]}' class='nav'><span>{$val2[name]}</span></a>";
if(count($classlistall[$module][$val2['id']]) && $listyy && $listmax){
			$metinfo.="<p>";
			$i=0;
			foreach($classlistall[$module][$val2['id']] as $key=>$val3){
			$i++;
			$metinfo.="<a href='{$val3[url]}' target='_blank' title='{$val3[title]}'><span>{$val3[title]}</span></a>";	
			if($i>=$listmax)break;
			}
			$metinfo.="</p>";
}
			$metinfo.="</h4>";
			}
			$metinfo.="</dd>";
}elseif($listyy && $listmax){
			$metinfo.="<dd class='sub'>";
			$metinfo.="<p>";
			$i=0;
			foreach($classlistall[$module][$val['id']] as $key=>$val3){
			$i++;
			$metinfo.="<a href='{$val3[url]}' target='_blank' title='{$val3[title]}'><span>{$val3[title]}</span></a>";	
			if($i>=$listmax)break;
			}
			$metinfo.="</p>";
			$metinfo.="</dd>";
}
			$metinfo.="</dl>";
			}
			}
			return $metinfo;
			break;
	}
}
//模块列表信息调用函数
function metlabel_list($listtype='text',$mark,$type,$order,$module,$time=0,$titleok=1){
	global $listall,$listcom,$class_index,$index;
	global $index_news_no,$index_product_no,$index_download_no,$index_img_no,$index_job_no;
	global $met_img_style,$met_img_x,$met_img_y,$metblank;
	$listarray=methtml_getarray($mark,$type,$order,$module);
	if($mark)$modules=$class_index[$mark]['module'];
	$module=$module?$module:metmodname($class_index[$mark]['module']);
	$met_img_x=$met_img_style?met_imgxy(1,$module):$met_img_x;
	$met_img_y=$met_img_style?met_imgxy(2,$module):$met_img_y;
	switch($module){
		case 'news':
			$listmx=$index_news_no;
			break;
		case 'product':
			$listmx=$index_product_no;
		    break;
		case 'downlaod':
			$listmx=$index_download_no;
		    break;
		case 'img':
			$listmx=$index_img_no;
		    break;
		case 'job':
			$listmx=$index_job_no;
		    break;
	}
	switch($listtype){
		case 'img':
			$metinfo.="<ol class='list-none metlist'>";
			$i=0;
			foreach($listarray as $key=>$val){
			$i++;
			$metinfo.="<li class='list'>";
			$metinfo.="<a href='{$val[url]}' title='{$val[title]}' {$metblank} class='img'><img src='{$val[imgurls]}' alt='{$val[title]}' title='{$val[title]}' width='{$met_img_x}' height='{$met_img_y}' /></a>";
if($titleok)$metinfo.="<h3><a href='{$val[url]}' title='{$val[title]}' {$metblank}>{$val[title]}</a></h3>";
			$metinfo.="</li>";
			if($i>=$listmx)break;
			}
			$metinfo.="</ol>";
			break;
		case 'text':
			$metinfo.="<ol class='list-none metlist'>";
			$i=0;
			if($modules==6)$listarray=$listall[job];
			foreach($listarray as $key=>$val){
			$i++;$top='';
			if($i==1)$top='top';
			if($modules==6){
				$val['title']=$val['position'];
				$val['updatetime']=$val['addtime'];
			}
			$metinfo.="<li class='list {$top}'>";
   if($time)$metinfo.="<span class='time'>[{$val[updatetime]}]</span>";
			$metinfo.="<a href='{$val[url]}' title='{$val[title]}' {$metblank}>{$val[title]}</a>{$val[hot]}{$val[news]}{$val[top]}";
			$metinfo.="</li>";
			if($i>=$listmx)break;
			}
			if($modules==1)$metinfo.=$class_index[$mark]['description'];
			$metinfo.="</ol>";
		    break;
	}
	return $metinfo;
}
//会员侧导航
function membernavlist(){
	global $lang,$lang_memberIndex3,$lang_memberIndex4,$lang_memberIndex5,$lang_memberIndex6,$lang_memberIndex7,$lang_memberIndex10;
	$metinfo.="<ul class='membernavlist'>";
    $metinfo.="<li><a target='main' href='basic.php?lang={$lang}' title='{$lang_memberIndex3}'>{$lang_memberIndex3}</a></li>";
    $metinfo.="<li><a target='main' href='editor.php?lang={$lang}' title='{$lang_memberIndex4}'>{$lang_memberIndex4}</a></li>";
    $metinfo.="<li><a target='main' href='feedback.php?lang={$lang}' title='{$lang_memberIndex5}'>{$lang_memberIndex5}</a></li>";
    $metinfo.="<li><a target='main' href='message.php?lang={$lang}' title='{$lang_memberIndex6}'>{$lang_memberIndex6}</a></li>";
    $metinfo.="<li><a target='main' href='cv.php?lang={$lang}' title='{$lang_memberIndex7}'>{$lang_memberIndex7}</a></li>";
    $metinfo.="<li><a href='login_out.php?lang={$lang}' title='{$lang_memberIndex10}'>{$lang_memberIndex10}</a></li>";
    $metinfo.="</ul>";
	return $metinfo;
}
//文章模块列表函数
function metlabel_news($time=1){
	global $news_list,$metblank;
	$metinfo.="<ul class='list-none metlist'>";
	$i=0;
	foreach($news_list as $key=>$val){
	$i++;$top='';
	if($i==1)$top='top';
		$metinfo.="<li class='list {$top}'>";	
		if($time)$metinfo.="<span>[{$val[updatetime]}]</span>";
		$metinfo.="<a href='{$val[url]}' title='{$val[title]}' {$metblank}>{$val[title]}</a>{$val[hot]}{$val[news]}{$val[top]}";	
		$metinfo.="</li>";	
	}
	$metinfo.="</ul>";
	return $metinfo;
}
//产品模块列表函数
function metlabel_product(){
	global $product_list,$metblank,$met_img_style,$met_img_x,$met_img_y,$met_product_page,$class1,$class2,$class3,$search,$nav_list2,$nav_list3,$weburly;
	$met_img_x=$met_img_style?met_imgxy(1,'product'):$met_img_x;
	$met_img_y=$met_img_style?met_imgxy(2,'product'):$met_img_y;
	$metinfo.="<ul class='list-none metlist'>";
	$listarray=$product_list;
	$metok=0;
	if($met_product_page && $search<>'search'){
		if($class2 && count($nav_list3[$class2]) && !$class3){
			$listarray=$nav_list3[$class2];
			$metok=1;
		}
		if(!$class2 && count($nav_list2[$class1]) && $class1 && !$class3){
			$listarray=$nav_list2[$class1];
			$metok=1;
		}
	}
	foreach($listarray as $key=>$val){
		if($metok){
			$val['title']=$val['name'];
			$val['imgurls']=$val['columnimg']==''?$weburly.'public/images/metinfo.gif':$val['columnimg'];
		}
		$metinfo.="<li class='list'>";
		$metinfo.="<a href='{$val[url]}' title='{$val[title]}' {$metblank} class='img'><img src='{$val[imgurls]}' alt='{$val[title]}' title='{$val[title]}' width='{$met_img_x}' height='{$met_img_y}' /></a>";
		$metinfo.="<h3><a href='{$val[url]}' title='{$val[title]}' {$metblank}>{$val[title]}</a></h3>";
		$metinfo.="</li>";
	}
	$metinfo.="</ul>";
	return $metinfo;
}
//图片模块列表函数
function metlabel_img(){
	global $img_list,$metblank,$met_img_style,$met_img_x,$met_img_y,$met_img_page,$class1,$class2,$class3,$search,$nav_list2,$nav_list3,$weburly;
	$met_img_x=$met_img_style?met_imgxy(1,'img'):$met_img_x;
	$met_img_y=$met_img_style?met_imgxy(2,'img'):$met_img_y;
	$metinfo.="<ul class='list-none metlist'>";
	$listarray=$img_list;
	$metok=0;
	if($met_img_page && $search<>'search'){
		if($class2 && count($nav_list3[$class2]) && !$class3){
			$listarray=$nav_list3[$class2];
			$metok=1;
		}
		if(!$class2 && count($nav_list2[$class1]) && $class1 && !$class3){
			$listarray=$nav_list2[$class1];
			$metok=1;
		}
	}
	foreach($listarray as $key=>$val){
		if($metok){
			$val['title']=$val['name'];
			$val['imgurls']=$val['columnimg']==''?$weburly.'public/images/metinfo.gif':$val['columnimg'];
		}
		$metinfo.="<li class='list'>";
		$metinfo.="<a href='{$val[url]}' title='{$val[title]}' {$metblank} class='img'><img src='{$val[imgurls]}' alt='{$val[title]}' title='{$val[title]}' width='{$met_img_x}' height='{$met_img_y}' /></a>";
		$metinfo.="<h3><a href='{$val[url]}' title='{$val[title]}' {$metblank}>{$val[title]}</a></h3>";
		$metinfo.="</li>";
	}
	$metinfo.="</ul>";
	return $metinfo;
}
//下载模块列表函数
function metlabel_download(){
	global $download_list,$metblank,$lang_Detail,$lang_Download,$lang_FileSize,$lang_Hits,$lang_UpdateTime;
	$i=0;
	foreach($download_list as $key=>$val){
	$i++;$top='';
	if($i==1)$top='top';
		$metinfo.="<dl class='list-none metlist {$top}'>";
		$metinfo.="<dt>";
		$metinfo.="<a href='{$val[url]}' title='{$val[title]}' {$metblank}>{$val[title]}</a>";
		$metinfo.="</dt>";
		$metinfo.="<dd>";
		$metinfo.="<div>";
		$metinfo.="<a href='{$val[url]}' {$metblank} title='{$lang_Detail}'>{$lang_Detail}</a> | ";
		$metinfo.="<a href='{$val[downloadurl]}' class='down' {$metblank} title='{$lang_Download}'>{$lang_Download}</a>";
		$metinfo.="</div>";
		$metinfo.="<span><b>{$lang_FileSize}</b>: {$val[filesize]}KB</span>";
		$metinfo.="<span><b>{$lang_Hits}</b>: {$val[hits]}</span>";
		$metinfo.="<span><b>{$lang_UpdateTime}</b>: {$val[updatetime]}</span>";
		$metinfo.="</dd>";
		$metinfo.="</dl>";
	}
	return $metinfo;
}
//招聘模块列表函数
function metlabel_job(){
	global $job_list,$metblank,$lang_cvtitle,$lang_Detail,$lang_AddDate,$lang_WorkPlace,$lang_PersonNumber,$lang_Position,$lang_several;
	$metinfo.="<dl class='list-none metlist'>";
	$metinfo.="<dt>";
	$metinfo.="<span>{$lang_cvtitle}</span>";
	$metinfo.="<span>{$lang_Detail}</span>";
	$metinfo.="<span>{$lang_AddDate}</span>";
	$metinfo.="<span>{$lang_WorkPlace}</span>";
	$metinfo.="<span>{$lang_PersonNumber}</span>";
	$metinfo.="{$lang_Position}";
	$metinfo.="</dt>";
	$i=0;
	foreach($job_list as $key=>$val){
	$i++;$top='';
	if($i==1)$top='top';
	$val['count']=$val['count']?$val['count']:$lang_several;
		$metinfo.="<dd class='list {$top}'>";
		$metinfo.="<span><a href='{$val[cv]}' title='{$lang_cvtitle}' {$metblank}>{$lang_cvtitle}</a></span>";
		$metinfo.="<span><a href='{$val[url]}' title='{$lang_Detail}' {$metblank}>{$lang_Detail}</a></span>";
		$metinfo.="<span>{$val[addtime]}</span>";
		$metinfo.="<span>{$val[place]}</span>";
		$metinfo.="<span>{$val[count]}</span>";
		$metinfo.="<a href='{$val[url]}' title='{$val[position]}' {$metblank}>{$val[position]}</a>";
	}
	$metinfo.="</dl>";
	return $metinfo;
}
//留言提交表单函数
function messagelabel_table(){
	global $lang,$fdjs,$lang_Name,$lang_Phone,$lang_Email,$lang_OtherContact,$lang_Info5,$lang_SubmitContent,$fromurl,$ip,$lang_SubmitInfo,$lang_Reset,$lang_MessageInfo3,$lang_MessageInfo4;
	$metinfo.="<form method='POST' name='myform' onSubmit='return metmessagesubmit(\"{$lang_MessageInfo3}\",\"{$lang_MessageInfo4}\");' action='message.php?action=add' target='_self'>\n";
	$metinfo.="<table class='message_table'>\n";
	$metinfo.="<tr>\n";
	$metinfo.="<td class='text'>".$lang_Name."</td>\n";
	$metinfo.="<td class='input'><input name='pname' type='text' class='input-text' /><span class='info'>*</span></td>\n";
	$metinfo.="</tr>\n";
	$metinfo.="<tr>\n";
	$metinfo.="<td class='text'>".$lang_Phone."</td>\n";
	$metinfo.="<td class='input'><input name='tel' type='text' class='input-text' /></td>\n";
	$metinfo.="</tr>\n";
	$metinfo.="<tr>\n";
	$metinfo.="<td class='text'>".$lang_Email."</td>\n";
	$metinfo.="<td class='input'><input name='email' type='text' class='input-text' /></td>\n";
	$metinfo.="</tr>\n";
	$metinfo.="<tr>\n";
	$metinfo.="<td class='text'>".$lang_OtherContact."</td>\n";
	$metinfo.="<td class='input'><input name='contact' type='text' class='input-text' />".$lang_Info5."</td>\n";
	$metinfo.="</tr>\n";
	$metinfo.="<tr>\n";
	$metinfo.="<td class='text'>".$lang_SubmitContent."</td>\n";
	$metinfo.="<td class='input'><textarea name='info' cols='50' rows='6' class='textarea-text'></textarea><span class='info'>*</span></td>\n";
	$metinfo.="</tr>\n";
	$metinfo.="<tr><td class='text'></td><td class='submint'>\n";
	$metinfo.="<input type='hidden' name='fromurl' value='".$fromurl."' />\n";
	$metinfo.="<input type='hidden' name='ip' value='".$ip."' />\n";
	$metinfo.="<input type='hidden' name='lang' value='".$lang."' />\n";
	$metinfo.="<input type='submit' name='Submit' value='".$lang_SubmitInfo."' class='submit'>\n";
	$metinfo.="<input type='reset' name='Submit' value='".$lang_Reset."' class='reset'></td></tr>\n";
	$metinfo.="</table>\n";
	$metinfo.="</form>\n";
	return $metinfo;
}
//留言列表函数
function metlabel_messagelist(){
	global $lang,$message_list,$lang_SubmitContent,$lang_Reply;
	foreach($message_list as $key=>$val){
	$metinfo.="<dl class='list-none metlist'>\n";
	$metinfo.="<dt class='title'><span class='tt'>{$val[id]}<sup>#</sup></span><span class='name'>{$val[name]}</span><span class='time'>{$lang_Publish} {$val[addtime]}</span></dt>\n";
	$metinfo.="<dd class='info'><span class='tt'>{$lang_SubmitContent}</span><span class='text'>{$val[info]}</span></dd>\n";
	$metinfo.="<dd class='reinfo'><span class='tt'>{$lang_Reply}</span><span class='text'>{$val[useinfo]}</span></dd>\n";
	$metinfo.="</dl>\n";
	}
	return $metinfo;
}
//反馈提交表单函数
function metlabel_feedback(){
	global $lang,$fdjs,$fd_para,$message_list,$lang_Submit,$lang_Reset,$lang_Publish,$lang_Reply,$fromurl,$ip,$id,$title;
     $metinfo =$fdjs;
     $metinfo.="<form enctype='multipart/form-data' method='POST' name='myform' onSubmit='return Checkfeedback();' action='index.php?action=add&lang=".$_GET[lang]."' target='_self'>\n";
     $metinfo.="<table class='feedback_table' >\n";
    foreach($fd_para as $key=>$val){
     $metinfo.="<tr>\n";
     $metinfo.="<td class='text'>".$val[name]."</td>\n";
     $metinfo.="<td class='input'>".$val[input]."<span class='info'>{$val[wr_must]}</span></td>\n";
     $metinfo.="</tr>\n";
    }
     $metinfo.="<tr><td class='text'></td>\n";
	 $metinfo.="<td class='submint'>\n";
     $metinfo.="<input type='hidden' name='fdtitle' value='".$title."' />\n";
     $metinfo.="<input type='hidden' name='fromurl' value='".$fromurl."' />\n";
     $metinfo.="<input type='hidden' name='lang' value='".$lang."' />\n";
     $metinfo.="<input type='hidden' name='ip' value='".$ip."' />\n";
	 $metinfo.="<input type='hidden' name='totnum' value='".count($fd_para)."' />\n";
	 $metinfo.="<input type='hidden' name='id' value='".$id."' />\n";
     $metinfo.="<input type='submit' name='Submit' value='".$lang_Submit."' class='submit'>\n";
     $metinfo.="<input type='reset' name='Submit' value='".$lang_Reset."' class='reset'></td></tr>\n";
     $metinfo.="</table>\n";
     $metinfo.="</form>\n";
	return $metinfo;
}
//友情链接提交表单函数
function metlabel_addlink(){
	global $lang_Info4,$lang_LinkInfo2,$lang_LinkInfo3,$lang_OurWebName,$met_linkname,$lang_OurWebUrl,$met_weburl,$lang_OurWebLOGO,$met_logo,$lang_OurWebKeywords,$met_title_keywords,$lang_YourWebName,$lang_YourWebUrl,$lang_LinkType,$lang_TextLink,$lang_PictureLink,$lang_YourWebLOGO,$lang_YourWebKeywords,$lang_Contact,$lang_Submit,$lang_Reset,$lang;
	$metinfo.="<form method='POST' name='myform' onSubmit='return addlinksubmit(\"{$lang_LinkInfo2}\",\"{$lang_LinkInfo3}\");' action='addlink.php?action=add' target='_self'>\n";
	$metinfo.="<table class='addlink_table'>\n";
	$metinfo.="<tr><td class='title' colspan='2'>{$lang_Info4}</td></tr>\n";
	$metinfo.="<tr><td class='text'>{$lang_OurWebName}</td>\n";
	$metinfo.="<td class='input'>{$met_linkname}</td></tr>\n";
	$metinfo.="<tr><td class='text'>{$lang_OurWebUrl}</td>\n";
	$metinfo.="<td class='input'>{$met_weburl}</td></tr>\n";
	$metinfo.="<tr><td class='text'>{$lang_OurWebLOGO}</td>\n";
	$metinfo.="<td class='input'><img src='{$met_logo}' alt='{$lang_OurWebName}' title='{$lang_OurWebName}' /></td></tr>\n";
	$metinfo.="<tr><td class='text'>{$lang_OurWebKeywords}</td>\n";
	$metinfo.="<td class='input'>{$met_title_keywords}</td></tr>\n";
	$metinfo.="<tr><td class='text'>{$lang_YourWebName}</td>\n";
	$metinfo.="<td class='input'><input name='webname' type='text' class='input-text' size='30' /><span class='info'>*</span></td></tr>\n";
	$metinfo.="<tr><td class='text'>{$lang_YourWebUrl}</td>\n";
	$metinfo.="<td class='input'><input name='weburl' type='text' class='input-text' size='30' value='http://' /><span class='info'>*</span></td></tr>\n";
	$metinfo.="<tr><td class='text'>{$lang_LinkType}</td>\n";
	$metinfo.="<td class='input'><input name='link_type' type='radio' value='0' id='textlinkradio' checked='checked' /><label for='textlinkradio'>{$lang_TextLink}</label>  <input name='link_type' type='radio' value='1' id='imglinkradio' /><label for='imglinkradio'>{$lang_PictureLink}</label><span class='info'>*</span></td></tr>\n";
	$metinfo.="<tr><td class='text'>{$lang_YourWebLOGO}</td>\n";
	$metinfo.="<td class='input'><input name='weblogo' type='text' class='input-text' size='30' value='http://'/></td></tr>\n";
	$metinfo.="<tr><td class='text'>{$lang_YourWebKeywords}</td>\n";
	$metinfo.="<td class='input'><input name='info' type='text' class='input-text' size='30' /></td></tr>\n";
	$metinfo.="<tr><td class='text'>{$lang_Contact}</td>\n";
	$metinfo.="<td class='input'><textarea name='contact' cols='50' class='textarea-text' rows='6'></textarea></td></tr>\n";
	$metinfo.="<tr><td class='text'></td>\n";
	$metinfo.="<td class='submint'>\n";
	$metinfo.="<input type='submit' name='Submit' value='".$lang_Submit."' class='submit'>\n";
	$metinfo.="<input type='hidden' name='lang' value='".$lang."'>\n";
	$metinfo.="<input type='reset' name='Submit' value='".$lang_Reset."' class='reset'></td></tr>\n";
	$metinfo.="</table>\n";
	$metinfo.="</form>\n";
	return $metinfo;
}
//在线应聘提交表单函数
function metlabel_cv(){
	global $fdjs,$lang,$lang_Nolimit,$lang_memberPosition,$selectjob,$cv_para,$paravalue,$met_memberlogin_code,$lang_memberImgCode,$lang_memberTip1,$lang_Submit,$lang_Reset;
     $metinfo.=$fdjs;
     $metinfo.="<form  enctype='multipart/form-data' method='POST' onSubmit='return Checkcv();' name='myform' action='save.php?action=add' target='_self'>\n";
     $metinfo.="<input type='hidden' name='lang' value='".$lang."' />\n";
     $metinfo.="<table class='cv_table'>\n";
     $metinfo.="<tr><td class='text'>".$lang_memberPosition."</td>\n";
     $metinfo.="<td class='input'><select name='jobid' id='jobid'>".$selectjob."</select><span class='info'>*</span></td></tr>\n";
    foreach($cv_para as $key=>$val){
     switch($val[type]){
	 case 1:;
     $metinfo.="<tr><td class='text'>".$val[name]."</td>\n";
     $metinfo.="<td class='input'><input name='".$val[para]."' type='text' class='input-text' size='40'><span class='info'>".$val[wr_must]."</span></td></tr>\n";
	 break;
	 case 2:
	 $tmp="<select name='para$val[id]'>";
     $tmp=$tmp."<option value=''>{$lang_Nolimit}</option>";
     foreach($paravalue[$val[id]] as $key=>$val1){
      $tmp=$tmp."<option value='$val1[info]' $selected >$val1[info]</option>";
      }
     $tmp=$tmp."</select>";;
     $metinfo.="<tr><td class='text'>".$val[name]."</td>\n";
     $metinfo.="<td class='input'>".$tmp."<span class='info'>".$val[wr_must]."</span></td></tr>\n";
	 break;
	 case 3:
     $metinfo.="<tr><td class='text'>".$val[name]."</td>\n";
     $metinfo.="<td class='input'><textarea name='".$val[para]."' class='textarea-text' cols='60' rows='5'></textarea><span class='info'>".$val[wr_must]."</span></td></tr>\n";
     break;
	 case 4:
	 $tmp1="";
     $i=0;
     foreach($paravalue[$val[id]] as $key=>$val1){
     $i++;
     $tmp1=$tmp1."<input name='para$val[id]_$i' type='checkbox' id='para$val[id]_$i' value='$val1[info]' ><label for='para$val[id]_$i'>{$val1[info]}</label>  ";
     }
     $metinfo.="<tr><td class='text'>".$val[name]."</td>\n";
     $metinfo.="<td class='input'>".$tmp1."<span class='info'>".$val[wr_must]."</span></td></tr>\n";
     break;
	 case 5:
     $metinfo.="<tr><td class='text'>".$val[name]."</td>\n";
     $metinfo.="<td class='input'><input name='".$val[para]."' type='file' class='input-file' size='20' /><span class='info'>".$val[wr_must]."</span></td></tr>\n";
	 break;
	 case 6:
	 $tmp2="";
     $i=0;
     foreach($paravalue[$val[id]] as $key=>$val2){
     $checked='';
     $i++;
     if($i==1)$checked="checked='checked'";
     $tmp2=$tmp2."<input name='para$val[id]' type='radio' id='para$val[id]_$i' value='$val2[info]' $checked /><label for='para$val[id]_$i'>$val2[info]</label>  ";
     }
     $metinfo.="<tr><td class='text'>".$val[name]."</td>\n";
     $metinfo.="<td class='input'>".$tmp2."<span class='info'>".$val[wr_must]."</span></td></tr>\n";
	 break;
    }
   }
if($met_memberlogin_code==1){  
     $metinfo.="<tr><td class='text'>".$lang_memberImgCode."</td>\n";
     $metinfo.="<td class='input'><input name='code' onKeyUp='pressCaptcha(this)' type='text' class='code' id='code' size='6' maxlength='8' style='width:50px' />";
     $metinfo.="<img align='absbottom' src='ajax.php?action=code'  onclick=this.src='ajax.php?action=code&'+Math.random() style='cursor: pointer;' title='".$lang_memberTip1."'/>";
     $metinfo.="</td>\n";
     $metinfo.="</tr>\n";
}	  
     $metinfo.="<tr><td class='text'></td>\n";
     $metinfo.="<td class='submint'><input type='submit' name='Submit' value='".$lang_Submit."' class='submit' />&nbsp;&nbsp;<input type='reset' name='Submit' value='".$lang_Reset."' class='reset' /></td>\n";
     $metinfo.="</tr>";		
     $metinfo.="</table>";
     $metinfo.="</form>";
	 return $metinfo;
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>