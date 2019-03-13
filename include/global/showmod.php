<?php
$news=$db->get_one("select * from $dbname where id='$id'");
if(!$news)okinfo('../',$lang_error);
$news['updatetime'] = date($met_contenttime,strtotime($news['updatetime']));
$news['imgurls']=($news['imgurls']<>"")?$news['imgurls']:'../public/images/metinfo.gif';
$news['imgurl']=($news['imgurl']<>"")?$news['imgurl']:'../public/images/metinfo.gif';
$class1=$news['class1'];
$class2=$news['class2'];
$class3=$news['class3'];	
$metaccess=$news['access'];
if($imgproduct=='download'){
	if(intval($news['downloadaccess'])>0&&$met_member_use){
		$news['downloadurl']="down.php?id=$news[id]&lang=$lang";
	}
}
require_once '../include/head.php';
$news['content']=contentshow($news['content']);
$class1_info=$class_list[$class1]['releclass']?$class_list[$class_list[$class1]['releclass']]:$class_list[$class1];
$class2_info=$class_list[$class1]['releclass']?$class_list[$class1]:$class_list[$class2];
$class3_info=$class_list[$class3];
if($pagemark>2 && $pagemark<6)$mdmendy=1;
if($mdmendy){
	$query1 = "select * from $met_plist where module='$pagemark' and listid='$id'";
	$result1 = $db->query($query1);
	while($list1 = $db->fetch_array($result1)){
		$nowpara1="para".$list1['paraid'];
		$news[$nowpara1]=$list1['info'];
		$metparaaccess=$metpara[$list1['paraid']]['access'];
		if(intval($metparaaccess)>0&&$met_member_use){
			$paracode=authcode($news[$nowpara1], 'ENCODE', $met_memberforce);
			$paracode=codetra($paracode,1); 
			$news[$nowpara1]="<script language='javascript' src='../include/access.php?metuser=para&metaccess=".$metparaaccess."&lang=".$lang."&listinfo=".$paracode."&paratype=".$metpara[$list1['paraid']]['type']."'></script>";
		}
		$nowparaname="";
		$nowparaname=$nowpara1."name";
		$news[$nowparaname]=($list1['imgname']<>"")?$list1['imgname']:$metpara[$list1['paraid']]['name'];
	}
}

if($dataoptimize[$pagemark]['nextlist']){
	if($met_member_use==2){
		$prenews=$db->get_one("select $listitem[$mdname] from $dbname where  class1=$class1 and class2=$class2 and class3=$class3 and lang='$lang' and (access<=$metinfo_member_type) and (id > $id) limit 0,1");
		$nextnews=$db->get_one("select $listitem[$mdname] from $dbname where class1=$class1 and class2=$class2 and class3=$class3 and lang='$lang' and (access<=$metinfo_member_type) and (id < $id) order by id desc limit 0,1");
	}else{
		$prenews=$db->get_one("select $listitem[$mdname] from $dbname where  class1=$class1 and class2=$class2 and class3=$class3 and lang='$lang' and (id > $id) limit 0,1");
		$nextnews=$db->get_one("select $listitem[$mdname] from $dbname where class1=$class1 and class2=$class2 and class3=$class3 and lang='$lang' and (id < $id) order by id desc limit 0,1");
	}
}
if($dataoptimize[$pagemark]['otherlist']){	
	$serch_sql=" where lang='$lang' and class1=$class1 ";
	if($class2)$serch_sql .= " and class2=$class2";
	if($class3)$serch_sql .= " and class3=$class3"; 
	if($met_member_use==2)$serch_sql .= " and access<=$metinfo_member_type";
	$order_sql=$class3?list_order($class_list[$class3]['list_order']):($class2?list_order($class_list[$class2]['list_order']):list_order($class_list[$class1]['list_order']));
    $query = "SELECT $listitem[$mdname] FROM $dbname $serch_sql $order_sql LIMIT 0, $listnum";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
		if($dataoptimize[$pagemark]['classname']){
			$list['class1_name']=$class_list[$list['class1']]['name'];
			$list['class1_url']=$class_list[$list['class1']]['url'];
			$list['class2_name']=$list['class2']?$class_list[$list['class2']]['name']:$list['class1_name'];
			$list['class2_url']=$list['class2']?$class_list[$list['class2']]['url']:$list['class1_url'];
			$list['class3_name']=$list['class3']?$class_list[$list['class3']]['name']:($list['class2']?$class_list[$list['class2']]['name']:$list['class1_name']);
			$list['class3_url']=$list['class3']?$class_list[$list['class3']]['url']:($list['class2']?$class_list[$list['class2']]['url']:$list['class1_url']);
			$list['classname']=$class2?$list['class3_name']:$list['class2_name'];
			$list['classurl']=$class2?$list['class3_url']:$list['class2_url'];
		}
		$list['top']=$list['top_ok']?"<img class='listtop' src='".$img_url."top.gif"."' />":"";
		$list['hot']=$list['top_ok']?"":(($list['hits']>=$met_hot)?"<img class='listhot' src='".$img_url."hot.gif"."' />":"");
		$list['news']=$list['top_ok']?"":((((strtotime($m_now_date)-strtotime($list['updatetime']))/86400)<$met_newsdays)?"<img class='listnews' src='".$img_url."news.gif"."' />":"");
		$pagename1=$list['updatetime'];
		$list['updatetime'] = date($met_listtime,strtotime($list['updatetime']));
		$list['imgurls']=($list['imgurls']<>"")?$list['imgurls']:'../public/images/metinfo.gif';
		$list['imgurl']=($list['imgurl']<>"")?$list['imgurl']:'../public/images/metinfo.gif';
		if($dataoptimize[$pagemark]['para'][$pagemark]){
			$query1 = "select * from $met_plist where module='$pagemark' and listid='$list[id]'";
			$result1 = $db->query($query1);
			while($list1 = $db->fetch_array($result1)){
				$nowpara1="para".$list1['paraid'];
				$list[$nowpara1]=$list1['info'];
				$metparaaccess=$metpara[$list1['paraid']]['access'];
				if(intval($metparaaccess)>0&&$met_member_use){
					$paracode=authcode($list[$nowpara1], 'ENCODE', $met_memberforce);
					$paracode=codetra($paracode,1); 
					$list[$nowpara1]="<script language='javascript' src='../include/access.php?metuser=para&metaccess=".$metparaaccess."&lang=".$lang."&listinfo=".$paracode."&paratype=".$metpara[$list1['paraid']]['type']."'></script>";
				}
				$nowparaname="";
				$nowparaname=$nowpara1."name";
				$list[$nowparaname]=($list1['imgname']<>"")?$list1['imgname']:$metpara[$list1['paraid']]['name'];
			}
		}
		if($met_webhtm){
			switch($met_htmpagename){
				case 0:
					$htmname=$showname.$list[id];	
					break;
				case 1:
					$list['updatetime1'] = date('Ymd',strtotime($pagename1));
					$htmname=$list['updatetime1'].$list['id'];	
					break;
				case 2:
					$htmname=$class_list[$list['class1']]['foldername'].$list['id'];	
					break;
			}
			$htmname=($list['filename']<>"" and $metadmin['pagename'])?$list['filename']:$htmname;	
		}	
		$phpname=$showname.'.php?'.$langmark."&id=".$list['id'];
		$panyid = $list['filename']!=''?$list['filename']:$list['id'];
		$met_ahtmtype = $list['filename']<>''?$met_chtmtype:$met_htmtype;
		$list['url']=$met_pseudo?$panyid.'-'.$lang.'.html':($met_webhtm?$htmname.$met_ahtmtype:$phpname);
		if($prenews['id']==$list['id'])$preinfo=$list;  
		if($nextnews['id']==$list['id'])$nextinfo=$list;
		if($list['img_ok'] == 1){
			$md_list_new[]=$list;
			if($list['class1']!=0)$md_class_new[$list['class1']][]=$list;
			if($list['class2']!=0)$md_class_new[$list['class2']][]=$list;
			if($list['class3']!=0)$md_class_new[$list['class3']][]=$list;
		}
		if($list['com_ok'] == 1){
			$md_list_com[]=$list;
			if($list['class1']!=0)$md_class_com[$list['class1']][]=$list;
			if($list['class2']!=0)$md_class_com[$list['class2']][]=$list;
			if($list['class3']!=0)$md_class_com[$list['class3']][]=$list;
		}
		if($list['class1']!=0)$md_class[$list['class1']][]=$list;
		if($list['class2']!=0)$md_class[$list['class2']][]=$list;
		if($list['class3']!=0)$md_class[$list['class3']][]=$list;
		$md_list[]=$list;
	}
}
if($dataoptimize[$pagemark]['nextlist']){
    switch($met_htmpagename){
		case 0:
			$prehtmname=$showname;	
			$nexthtmname=$showname;
			break;
		case 1:
			$prehtmname = date('Ymd',strtotime($prenews['updatetime']));	
			$nexthtmname = date('Ymd',strtotime($nextnews['updatetime']));
			break;
		case 2:
			$prehtmname=$class_list[$prenews['class1']]['foldername'];
			$nexthtmname=$class_list[$nextnews['class1']]['foldername'];		
			break;
	}
	$preid = $prenews['filename']!=''?$prenews['filename']:$prenews['id'];
	$nextid = $nextnews['filename']!=''?$nextnews['filename']:$nextnews['id'];
	$phpname=$showname.'.php?'.$langmark."&id=";
	$met_ahtmtypep = $prenews['filename']<>''?$met_chtmtype:$met_htmtype;
	$met_ahtmtypen = $nextnews['filename']<>''?$met_chtmtype:$met_htmtype;
	if($prenews)$prenews['url']=$met_pseudo?$preid.'-'.$lang.'.html':($met_webhtm?($prenews['filename']?$preid.$met_ahtmtypep:$prehtmname.$prenews['id'].$met_ahtmtypep):$phpname.$prenews['id']);
    if($nextnews)$nextnews['url']=$met_pseudo?$nextid.'-'.$lang.'.html':($met_webhtm?($nextnews['filename']?$nextid.$met_ahtmtypep:$nexthtmname.$nextnews['id'].$met_ahtmtypen):$phpname.$nextnews['id']);
	$preinfo=$prenews;
	$nextinfo=$nextnews;
}
$class2=$class_list[$class1]['releclass']?$class1:$class2;
$class1=$class_list[$class1]['releclass']?$class_list[$class1]['releclass']:$class1;	
$show['description']= $news['description']?$news['description']:$met_keywords;
$show['keywords']   = $news['keywords']?$news['keywords']:$met_keywords;
$met_title          = $met_title?$news['title'].'-'.$met_title:$news['title'];
$nav_x['name']      = $nav_x['name']." > ".$news['title'];
require_once '../public/php/methtml.inc.php';
?>