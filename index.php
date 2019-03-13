<?php
if(!file_exists('config/install.lock')){
 header("location:install/index.php");exit;
}
require_once 'include/common.inc.php';
$css_url="templates/".$met_skin_user."/css/";
$img_url="templates/".$met_skin_user."/images";
$navurl=($rooturl=="..")?$rooturl."/":"";
$index="index";
require_once 'include/head.php';

    foreach($nav_list_1 as $key=>$val){
	switch($val[module]){
	case 0;
	$val[c_url]=$val[c_out_url];
	$val[e_url]=$val[e_out_url];
	break;
	case 1;
	$val[c_url]=$met_webhtm?$navurl.$val[foldername]."/".$val[filename].".htm":$navurl.$val[foldername]."/show.php?id=".$val[id];
	$val[e_url]=$met_webhtm?$navurl.$val[foldername]."/".$val[filename]."_en.htm":$navurl.$val[foldername]."/show.php?en=en&id=".$val[id];
	break;
	case 2;
	$val[c_url]=$navurl.$val[foldername]."/news.php?class1=".$val[id];
	$val[e_url]=$navurl.$val[foldername]."/news.php?en=en&class1=".$val[id];
	break;
	case 3;
	$val[c_url]=$navurl.$val[foldername]."/product.php?class1=".$val[id];
	$val[e_url]=$navurl.$val[foldername]."/product.php?en=en&class1=".$val[id];
	break;
	case 4;
	$val[c_url]=$navurl.$val[foldername]."/download.php?class1=".$val[id];
	$val[e_url]=$navurl.$val[foldername]."/download.php?en=en&class1=".$val[id];
	break;
	case 5;
	$val[c_url]=$navurl.$val[foldername]."/img.php?class1=".$val[id];
	$val[e_url]=$navurl.$val[foldername]."/img.php?en=en&class1=".$val[id];
	break;
	case 6;
	$val[c_url]=$navurl.$val[foldername]."/job.php";
	$val[e_url]=$navurl.$val[foldername]."/job.php?en=en";
	break;
	case 7;
	$val[c_url]=$navurl.$val[foldername]."/message.php";
	$val[e_url]=$navurl.$val[foldername]."/message.php?en=en";
	break;
	}
	$class1_list[$val[id]]=$val;
	  if($val[index_num]!="" and $val[index_num]!=0){
	   $val[classtype]="class".$val[classtype];
	   $class_index[$val[index_num]]=$val;
	   }
    }
	foreach($nav_list_2 as $key=>$val){
	switch($val[module]){
	case 0;
	$val[c_url]=$val[c_out_url];
	$val[e_url]=$val[e_out_url];
	break;
	case 1;
	$val[c_url]=$met_webhtm?$navurl.$val[foldername]."/".$val[filename].".htm":$navurl.$val[foldername]."/show.php?id=".$val[id];
	$val[e_url]=$met_webhtm?$navurl.$val[foldername]."/".$val[filename]."_en.htm":$navurl.$val[foldername]."/show.php?en=en&id=".$val[id];
	break;
	case 2;
	$val[c_url]=$navurl.$val[foldername]."/news.php?class1=".$val[bigclass]."&class2=".$val[id];
	$val[e_url]=$navurl.$val[foldername]."/news.php?en=en&class1=".$val[bigclass]."&class2=".$val[id];
	break;
	case 3;
	$val[c_url]=$navurl.$val[foldername]."/product.php?class1=".$val[bigclass]."&class2=".$val[id];
	$val[e_url]=$navurl.$val[foldername]."/product.php?en=en&class1=".$val[bigclass]."&class2=".$val[id];
	break;
	case 4;
	$val[c_url]=$navurl.$val[foldername]."/download.php?class1=".$val[bigclass]."&class2=".$val[id];
	$val[e_url]=$navurl.$val[foldername]."/download.php?en=en&class1=".$val[bigclass]."&class2=".$val[id];
	break;
	case 5;
	$val[c_url]=$navurl.$val[foldername]."/img.php?class1=".$val[bigclass]."&class2=".$val[id];
	$val[e_url]=$navurl.$val[foldername]."/img.php?en=en&class1=".$val[bigclass]."&class2=".$val[id];
	break;
	case 6;
	$val[c_url]=$navurl.$val[foldername]."/job.php";
	$val[e_url]=$navurl.$val[foldername]."/job.php?en=en";
	break;
	case 7;
	$val[c_url]=$navurl.$val[foldername]."/message.php";
	$val[e_url]=$navurl.$val[foldername]."/message.php?en=en";
	break;
	}
	$class2_list[$val[id]]=$val;
	  if($val[index_num]!="" and $val[index_num]!=0){
	   $val[classtype]="class".$val[classtype];
	   $class_index[$val[index_num]]=$val;
	   }
    }

	foreach($nav_list_3 as $key=>$val){
	switch($val[module]){
	case 0;
	$val[c_url]=$val[c_out_url];
	$val[e_url]=$val[e_out_url];
	break;
	case 1;
	$val[c_url]=$met_webhtm?$navurl.$val[foldername]."/".$val[filename].".htm":$navurl.$val[foldername]."/show.php?id=".$val[id];
	$val[e_url]=$met_webhtm?$navurl.$val[foldername]."/".$val[filename]."_en.htm":$navurl.$val[foldername]."/show.php?en=en&id=".$val[id];
	break;
	case 2;
	$val[c_url]=$navurl.$val[foldername]."/news.php?class1=".$val[bigclass]."&class2=".$val[id];
	$val[e_url]=$navurl.$val[foldername]."/news.php?en=en&class1=".$val[bigclass]."&class2=".$val[id];
	break;
	case 3;
	$val[c_url]=$navurl.$val[foldername]."/product.php?class1=".$val[bigclass]."&class2=".$val[id];
	$val[e_url]=$navurl.$val[foldername]."/product.php?en=en&class1=".$val[bigclass]."&class2=".$val[id];
	break;
	case 4;
	$val[c_url]=$navurl.$val[foldername]."/download.php?class1=".$val[bigclass]."&class2=".$val[id];
	$val[e_url]=$navurl.$val[foldername]."/download.php?en=en&class1=".$val[bigclass]."&class2=".$val[id];
	break;
	case 5;
	$val[c_url]=$navurl.$val[foldername]."/img.php?class1=".$val[bigclass]."&class2=".$val[id];
	$val[e_url]=$navurl.$val[foldername]."/img.php?en=en&class1=".$val[bigclass]."&class2=".$val[id];
	break;
	case 6;
	$val[c_url]=$navurl.$val[foldername]."/job.php";
	$val[e_url]=$navurl.$val[foldername]."/job.php?en=en";
	break;
	case 7;
	$val[c_url]=$navurl.$val[foldername]."/message.php";
	$val[e_url]=$navurl.$val[foldername]."/message.php?en=en";
	break;
	}
	$class3_list[$val[id]]=$val;
	  if($val[index_num]!="" and $val[index_num]!=0){
	   $val[classtype]="class".$val[classtype];
	   $class_index[$val[index_num]]=$val;
	   }
    }	
    $query = "SELECT * FROM $met_news order by updatetime desc";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$filename=$class1_list[$list[class1]][foldername];
	$url1_c=$filename."/shownews.php?id=".$list[id];
	$url2_c=$filename."/shownews".$list[id].".htm";
	$url1_e=$filename."/shownews.php?en=en&id=".$list[id];
	$url2_e=$filename."/shownews".$list[id]."_en.htm";	
	$list[c_url]=$met_webhtm?$url2_c:$url1_c;
	$list[e_url]=$met_webhtm?$url2_e:$url1_e;
	$listarray[imgurls]=explode("../",$list[imgurls]);
    $list[imgurls]=$listarray[imgurls][1];
	$listarray[imgurl]=explode("../",$list[imgurl]);
    $list[imgurl]=$listarray[imgurl][1];
	$list[updatetime] = date('Y-m-d',strtotime($list[updatetime]));
	if($list[new_ok] == 1)$news_list_new[]=$list;
	if($list[com_ok] == 1)$news_list_com[]=$list;
    $news_list[]=$list;
     }

    $query = "SELECT * FROM $met_news order by hits desc";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$filename=$class1_list[$list[class1]][foldername];
	$url1_c=$filename."/shownews.php?id=".$list[id];
	$url2_c=$filename."/shownews".$list[id].".htm";
	$url1_e=$filename."/shownews.php?en=en&id=".$list[id];
	$url2_e=$filename."/shownews".$list[id]."_en.htm";	
	$list[c_url]=$met_webhtm?$url2_c:$url1_c;
	$list[e_url]=$met_webhtm?$url2_e:$url1_e;
	$listarray[imgurls]=explode("../",$list[imgurls]);
    $list[imgurls]=$listarray[imgurls][1];
	$listarray[imgurl]=explode("../",$list[imgurl]);
    $list[imgurl]=$listarray[imgurl][1];
	$list[updatetime] = date('Y-m-d',strtotime($list[updatetime]));
	if($list[new_ok] == 1)$news_listhits_new[]=$list;
	if($list[com_ok] == 1)$news_listhits_com[]=$list;
    $news_listhits[]=$list;
    }
	
	$query = "SELECT * FROM $met_product order by updatetime desc";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$filename=$class1_list[$list[class1]][foldername];
	$url1_c=$filename."/showproduct.php?id=".$list[id];
	$url2_c=$filename."/showproduct".$list[id].".htm";
	$url1_e=$filename."/showproduct.php?en=en&id=".$list[id];
	$url2_e=$filename."/showproduct".$list[id]."_en.htm";	
	$list[c_url]=$met_webhtm?$url2_c:$url1_c;
	$list[e_url]=$met_webhtm?$url2_e:$url1_e;
	$listarray[imgurls]=explode("../",$list[imgurls]);
    $list[imgurls]=$listarray[imgurls][1];
	$listarray[imgurl]=explode("../",$list[imgurl]);
    $list[imgurl]=$listarray[imgurl][1];
	$list[updatetime] = date('Y-m-d',strtotime($list[updatetime]));
	if($list[new_ok] == 1)$product_list_new[]=$list;
	if($list[com_ok] == 1)$product_list_com[]=$list;
    $product_list[]=$list;
    }

	$query = "SELECT * FROM $met_product order by hits desc";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$filename=$class1_list[$list[class1]][foldername];
	$url1_c=$filename."/showproduct.php?id=".$list[id];
	$url2_c=$filename."/showproduct".$list[id].".htm";
	$url1_e=$filename."/showproduct.php?en=en&id=".$list[id];
	$url2_e=$filename."/showproduct".$list[id]."_en.htm";	
	$list[c_url]=$met_webhtm?$url2_c:$url1_c;
	$list[e_url]=$met_webhtm?$url2_e:$url1_e;
	$listarray[imgurls]=explode("../",$list[imgurls]);
    $list[imgurls]=$listarray[imgurls][1];
	$listarray[imgurl]=explode("../",$list[imgurl]);
    $list[imgurl]=$listarray[imgurl][1];
	$list[updatetime] = date('Y-m-d',strtotime($list[updatetime]));
	if($list[new_ok] == 1)$product_listhits_new[]=$list;
	if($list[com_ok] == 1)$product_listhits_com[]=$list;
    $product_listhits[]=$list;
    }

    $query = "SELECT * FROM $met_download order by updatetime desc";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$filename=$class1_list[$list[class1]][foldername];
	$url1_c=$filename."/showdownload.php?id=".$list[id];
	$url2_c=$filename."/showdownload".$list[id].".htm";
	$url1_e=$filename."/showdownload.php?en=en&id=".$list[id];
	$url2_e=$filename."/showdownload".$list[id]."_en.htm";	
	$list[c_url]=$met_webhtm?$url2_c:$url1_c;
	$list[e_url]=$met_webhtm?$url2_e:$url1_e;
	$listarray[downloadurl]=explode("../",$list[downloadurl]);
    $list[downloadurl]=$listarray[downloadurl][1];
	$list[updatetime] = date('Y-m-d',strtotime($list[updatetime]));
	if($list[new_ok] == 1)$download_list_new[]=$list;
	if($list[com_ok] == 1)$download_list_com[]=$list;
    $download_list[]=$list;
     }

    $query = "SELECT * FROM $met_download order by hits desc";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$filename=$class1_list[$list[class1]][foldername];
	$url1_c=$filename."/showdownload.php?id=".$list[id];
	$url2_c=$filename."/showdownload".$list[id].".htm";
	$url1_e=$filename."/showdownload.php?en=en&id=".$list[id];
	$url2_e=$filename."/showdownload".$list[id]."_en.htm";	
	$list[c_url]=$met_webhtm?$url2_c:$url1_c;
	$list[e_url]=$met_webhtm?$url2_e:$url1_e;
	$listarray[downloadurl]=explode("../",$list[downloadurl]);
    $list[downloadurl]=$listarray[downloadurl][1];
	$list[updatetime] = date('Y-m-d',strtotime($list[updatetime]));
	if($list[new_ok] == 1)$download_listhits_new[]=$list;
	if($list[com_ok] == 1)$download_listhits_com[]=$list;
    $download_listhits[]=$list;
	}
	
	$query = "SELECT * FROM $met_img order by updatetime desc";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$filename=$class1_list[$list[class1]][foldername];
	$url1_c=$filename."/showimg.php?id=".$list[id];
	$url2_c=$filename."/showimg".$list[id].".htm";
	$url1_e=$filename."/showimg.php?en=en&id=".$list[id];
	$url2_e=$filename."/showimg".$list[id]."_en.htm";	
	$list[c_url]=$met_webhtm?$url2_c:$url1_c;
	$list[e_url]=$met_webhtm?$url2_e:$url1_e;
	$listarray[imgurls]=explode("../",$list[imgurls]);
    $list[imgurls]=$listarray[imgurls][1];
	$listarray[imgurl]=explode("../",$list[imgurl]);
    $list[imgurl]=$listarray[imgurl][1];
	$list[updatetime] = date('Y-m-d',strtotime($list[updatetime]));
	if($list[new_ok] == 1)$img_list_new[]=$list;
	if($list[com_ok] == 1)$img_list_com[]=$list;
    $img_list[]=$list;
     }
	 
	$query = "SELECT * FROM $met_img order by hits desc";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$filename=$class1_list[$list[class1]][foldername];
	$url1_c=$filename."/showimg.php?id=".$list[id];
	$url2_c=$filename."/showimg".$list[id].".htm";
	$url1_e=$filename."/showimg.php?en=en&id=".$list[id];
	$url2_e=$filename."/showimg".$list[id]."_en.htm";	
	$list[c_url]=$met_webhtm?$url2_c:$url1_c;
	$list[e_url]=$met_webhtm?$url2_e:$url1_e;
	$listarray[imgurls]=explode("../",$list[imgurls]);
    $list[imgurls]=$listarray[imgurls][1];
	$listarray[imgurl]=explode("../",$list[imgurl]);
    $list[imgurl]=$listarray[imgurl][1];
	$list[updatetime] = date('Y-m-d',strtotime($list[updatetime]));
	if($list[new_ok] == 1)$img_listhits_new[]=$list;
	if($list[com_ok] == 1)$img_listhits_com[]=$list;
    $img_listhits[]=$list;
    }
		
$index = $db->get_one("SELECT * FROM $met_index order by id desc");
if($index[online_type]=="1" and $met_online_type=="0" )$met_online_type=2;
if($index[online_type]=="0" )$met_online_type=3;
	
if($met_index_type)$en="en";
if($ch=="ch")$en="";
    
	if($en=="en"){
    $query = "SELECT * FROM $met_link where link_lang!='ch' and show_ok='1' order by orderno desc";
	}else{
	$query = "SELECT * FROM $met_link where link_lang!='en' and show_ok='1' order by orderno desc";
	}
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	if($list[link_type]=="0"){
	if($list[com_ok]=="1")$link_text_com[]=$list;
	$link_text[]=$list;
	}
	
	if($list[link_type]=="1"){
	if($list[com_ok]=="1")$link_img_com[]=$list;
	$link_img[]=$list;
	}
	if($list[com_ok]=="1")$link_com[]=$list;
	$link[]=$list;
	}
if($en=="en"){
$show[e_description]=$met_e_description;
$show[e_keywords]=$met_e_keywords;
include template('e_index');
}
else{
$show[c_description]=$met_c_description;
$show[c_keywords]=$met_c_keywords;
include template('index');
}

footer();
?>