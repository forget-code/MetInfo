<?php
if(!defined('IN_MET'))require_once substr(dirname(__FILE__), 0, -6).'common.inc.php';//应用修改带代码
require_once '../include/global/pseudo.php';
if($dbname!=$met_download&&$dbname!=$met_img&&$dbname!=$met_news&&$dbname!=$met_product){okinfo('../404.html');exit();}
if($class_list[$class1]['module']>=100||($class1==0&&$class2==0&&$class3==0)||$class1==10001){
	if($search=="search"){
		$search_module=$imgproduct=='product'?3:5;
		if($searchtype)$search_module=$searchtype;
		$query="select * from $met_column where module='$search_module' and (classtype=1 or releclass!=0) and lang='$lang' order by no_order ASC,id ASC";
		$search_coloumn=$db->get_all($query);
		$class1=$search_coloumn[0]['id'];
	}else{
		if($imgproduct){
			$ipmd = $imgproduct=='product'?100:101;
			if($imgproduct=='product'){$class1=$productlistid;}
			else{$class1=$imglistid;}
		}
	}
}
else{
	if(!$class1){
		if(!$class2){$class2=$class_list[$class3]['bigclass'];}
		$class1=$class_list[$class2]['bigclass'];
	}
}
if($met_member_use){
	$classaccess=$class3?$class3:($class2?$class2:$class1);
	$classaccess= $db->get_one("SELECT * FROM $met_column WHERE id='$classaccess'");
	$metaccess=$classaccess['access'];
}
require_once '../include/head.php';
if($class1){if(!is_array($class_list[$class1]))okinfo('../404.html');}
$pseudos=$db->get_one("select * from $met_column where filename='$class2' and lang='$lang'");
if($pseudos){
$class2=$pseudos[id];
}
if($class2){
	if(!is_array($class_list[$class2])){
			okinfo('../404.html');
	}
	else{
		if($class_list[$class2]['bigclass']!=$class1){
			okinfo('../404.html');
		}
	}
}
if($class3){
	if(!is_array($class_list[$class3])){
		okinfo('../404.html');
	}
	else{
		if($class_list[$class3]['bigclass']!=$class2){
			okinfo('../404.html');
		}
	}
}
$class1_info=$class_list[$class1]['releclass']?$class_list[$class_list[$class1]['releclass']]:$class_list[$class1];
$class2_info=$class_list[$class1]['releclass']?$class_list[$class1]:$class_list[$class2];
$class3_info=$class_list[$class1]['releclass']?$class_list[$class2]:$class_list[$class3];
if(!is_array($class1_info))okinfo('../404.html');
$class1sql=" class1='$class1' ";
if($class1&&!$class2&&!$class3){
	foreach($module_list2[$class_list[$class1]['module']] as $key=>$val){
		if($val['releclass']==$class1){
			$class1re.=" or class1='$val[id]' ";
		}
	}
	if($class1re){
		$class1sql='('.$class1sql.$class1re.')';
	}
}
$serch_sql = '';
if($imgproduct){
	$ipcom = $imgproduct=='product'?$productcom:$imgcom;
	$serch_sql .=" where lang='$lang' {$mobilesql} and (recycle='0' or recycle='-1')";
	if($ipcom=='com')$serch_sql .= " and com_ok=1";
    if($class1 && $class_list[$class1]['module']<>$ipmd&&$class1!=10001){
		$serch_sql .= ' and (('.$class1sql;
	}else{
		$serch_sql .= ' and ((1=1';
	}
}else{
	$serch_sql=" where lang='$lang' {$mobilesql} and (recycle='0' or recycle='-1')  and (( $class1sql ";
}
if($class2)$serch_sql .= " and class2='$class2'";
if($class3)$serch_sql .= " and class3='$class3'";
$serch_sql .= " )"; 

if($imgproduct=='product'){
$serch_sql .= " or ("; 
$serch_sql .= " classother REGEXP '/|-{$class1}-"; 
$serch_sql .= $class2?"{$class2}-":"[0-9]*-";
$serch_sql .= $class3?"{$class3}-|/'":"[0-9]*-|/'";
$serch_sql .= " )"; 
}
$serch_sql .= " )"; 

if($search=="search" && $mdmendy){ 
	$dbparaname = $mdname=='product'?$product_paralist:($mdname=='download'?$download_paralist:$img_paralist);
	if($searchtype){
		if($title<>''){
			$serch_sql .= " and title='".trim($title)."' "; 
			$serchpage .= "&title=".trim($title); 
		}
		foreach($dbparaname as $key=>$val){
			$paratitle=$$val['para'];
			if($val['type']==4 and intval($page<1)){
				$paratitle="";
				foreach($para_select[$val[id]] as $key=>$val1){
					$parasel="para".$val['id']."_".$val1[id];
					if(trim($$parasel)<>'')$paratitle.=$$parasel."-";
				}
				if(trim($paratitle)<>'')$paratitle=substr($paratitle, 0, -1);
			}
			if(trim($paratitle)<>''){
				$serch_sql .= " and exists(select * from $met_plist where module=3 and $met_plist.paraid='$val[id]' and $met_plist.listid='$dbname.id and' $met_plist.info='".trim($paratitle)."') "; 
				$serchpage .= "&".$val['para']."=".trim($paratitle);
			}
		}
	}else{
		if($title<>''){
			$serch_sql .= " and title like '%".trim($title)."%'"; 
			$serchpage .= "&title=".trim($title); 
		}
		if($content<>''){
			if($imgproduct && $metadmin['productother']){
				$serch_sql .= " and ((content like '%".trim($content)."%' or content1 like '%".trim($content)."%' or content2 like '%".trim($content)."%' or content3 like '%".trim($content)."%' or content4 like '%".trim($content)."%' or title like '%".trim($content)."%')"; 
			}else{
				$serch_sql .= " and ((content like '%".trim($content)."%' or title like '%".trim($content)."%') or (title like '%".trim($content)."%') "; 
			}
			$serchpage .= "&content=".trim($content); 
		}
		foreach($dbparaname as $key=>$val){
			$paratitle=$$val['para'];
			if($val['type']==4){
				if(!$paratitle){
					$paratitle="";
					foreach($para_select[$val['id']] as $key=>$val1){
						$parasel="para".$val['id']."_".$val1['id'];
						if(trim($$parasel)<>'')$paratitle.=$$parasel."-";
					}
					if(trim($paratitle)<>'')$paratitle=substr($paratitle, 0, -1);
					if(trim($paratitle)<>''){
						$serch_sql .= " and exists(select * from $met_plist where module=3  and $met_plist.paraid='$val[id]' and $met_plist.listid=$dbname.id and $met_plist.info like'%".trim($paratitle)."%') ";  
						$serchpage .= "&".$val['para']."=".trim($paratitle);
					}
				}else{
					$serch_sql .= " and exists(select * from $met_plist where module=3 and $met_plist.paraid='$val[id]' and $met_plist.listid=$dbname.id and $met_plist.info like'%".trim($paratitle)."%') ";  
					$serchpage .= "&".$val['para']."=".trim($paratitle);
				}
			}else{
				if(trim($paratitle)<>''){
					$serch_sql .= " and exists(select * from $met_plist where module=3 and $met_plist.paraid='$val[id]' and $met_plist.listid=$dbname.id and $met_plist.info like'%".trim($paratitle)."%') "; 
					$serchpage .= "&".$val['para']."=".trim($paratitle);
				}
			}
			
		}
		//5.0.4
		if($content<>'')$serch_sql .= " or exists(select $met_plist.id from $met_plist inner join $met_parameter on $met_plist.paraid=$met_parameter.id where $met_plist.module=3 and $met_parameter.type<>5 and $met_plist.listid=$dbname.id and $met_plist.info like'%".trim($content)."%')) ";
		//价格搜索
		foreach($dbparaname as $key=>$val2){
			$prices1="paraprice_".$val2['id'];
			$prices=$$prices1;
			if($prices){
					if(!strstr($prices, "-")){
						preg_match('/([0-9\.]+)/',$prices,$result);
						$results=$result[0];
						$serch_sql .= " and exists(select * from $met_plist where module=3 and $met_plist.paraid='$val2[id]' and $met_plist.listid=$dbname.id and $met_plist.info > $results) "; 
						$serchpage .= "&".$prices1."=".trim($$prices1);
					}else{
						$prices_sql=explode('-',$prices);
						preg_match('/([0-9\.]+)/',$prices_sql[1],$result);
						$results=$result[0];
						if(!is_numeric($prices_sql[0]))die();
						$serch_sql .= " and exists(select * from $met_plist where module=3 and $met_plist.paraid='$val2[id]' and $met_plist.listid=$dbname.id and $met_plist.info > $prices_sql[0] and $met_plist.info < $results) "; 
						$serchpage .= "&".$prices1."=".trim($$prices1);
					}
				
			}
		}
	}
} 
if($mdmendy)$serchpage .= "&searchtype=".$searchtype;
if($met_member_use==2)$serch_sql .= " and access<=$metinfo_member_type";
$order_sql=$class3?list_order($class_list[$class3]['list_order']):($class2?list_order($class_list[$class2]['list_order']):list_order($class_list[$class1]['list_order']));
$order_sql=($search=="search" && $mdmendy)?" order by top_ok desc,com_ok desc,no_order desc,updatetime desc,id desc":$order_sql;
$order_sql=$order_sql==''?" order by top_ok desc,com_ok desc,no_order desc,updatetime desc,id desc":$order_sql;
if($mdname=='news'||$mdname=='product'||$mdname=='download'||$mdname=='img'||$mdname=='job'){
		$serch_sql .=" and displaytype='1'";
}
$serch_sql .= " and addtime<='{$m_now_date}'";

$tppl = $_M['plugin']['temporary_plugin_product_list'][0];
if($tppl && $dbname==$met_product){
	$applistfile=ROOTPATH.'app/app/'.$tppl.'/plugin/'.'plugin_'.$tppl.'.class.php';
	$_M['url']['own'] = $_M['url']['site'].'app/app/'.$tppl.'/';
	if(file_exists($applistfile)&&!is_dir($applistfile)&&((file_get_contents($applistfile))!='metinfo')){
		require_once $applistfile;
		$app_plugin_name=str_replace('.class.php', '', 'plugin_'.$tppl);
		if (class_exists($app_plugin_name)) {
			$newclass=new $app_plugin_name;
			if(method_exists($newclass, 'temporary_plugin_product_list')){
				$datainfo['dbname'] = $dbname;
				$datainfo['serch_sql'] = $serch_sql;
				$datainfo['order_sql'] = $order_sql;
				$datainfo['from_record'] = $from_record;
				$datainfo['list_num'] = $list_num;
				
				$data = $newclass->temporary_plugin_product_list($datainfo);
				
				if($data['dbname'])$dbname = $data['dbname'];
				if($data['serch_sql'])$serch_sql = $data['serch_sql'];
				if($data['order_sql'])$order_sql = $data['order_sql'];
				if($data['from_record'])$from_record = $data['from_record'];
				if($data['list_num'])$list_num = $data['list_num'];
				$temporary_plugin_product_list = 1;
			}
		}

		
	}
}

if($content<>'')
{
        // 如果是产品模块搜索
    if($search_module==3)
    {
        // 搜索字段表
        $serch_sql = "SELECT listid FROM $met_plist WHERE info like '%$content%' and lang='{$_M['lang']}'";

    $res = $db->query($serch_sql);

    $attr = array();

    while ($row = $db->fetch_array($res)) {
        $attr[] = $row['listid'];
    }

    // 如果字段里有，到产品里继续找
    if(!empty($attr))
    {   
        //去重
        $attr = array_unique($attr);
        $attr = implode(',', $attr);
        // 用字段 id和关键词在产品表里查询
        $serch_sql = " WHERE id in({$attr}) or title like '%{$content}%' or content like '%{$content}%' and lang='{$_M['lang']}'";
    }else{
        $serch_sql = " WHERE (content like '%{$content}%' or title like '%{$content}%') and lang='{$_M['lang']}'";
    }

    }   
}
$total_count = $db->counter($dbname, "$serch_sql", "*");
require_once '../include/pager.class.php';
    $page = (int)$page;
	if($page_input){$page=$page_input;}
    $list_num=$dbname_list;
    $rowset = new Pager($total_count,$list_num,$page);
    $from_record = $rowset->_offset();
	$page = $page?$page:1;
	$query = "SELECT * FROM $dbname $serch_sql $order_sql LIMIT $from_record, $list_num";
	$result = $db->query($query);
	while($list= $db->fetch_array($result)){
		$modlistnow[]=$list;
	}
	if($temporary_plugin_product_list == 1){
		$modlistnow =$newclass->temporary_plugin_product_analysis($modlistnow);
	}
	if(count($modlistnow)==0&&!($search=="search" && $mdmendy)&&$page!=1){okinfo('../404.html');exit();}
	foreach($modlistnow as $key=>$list){
		if($mdmendy){
			$pkgem = $pagemark;
			if($pkgem==100)$pkgem = 3;
			if($pkgem==101)$pkgem = 4;
			if($dataoptimize[$pkgem]['para'][$pkgem]){
				$query1 = "select * from $met_plist where listid='$list[id]' and module='$pkgem' ";
				$result1 = $db->query($query1);
				while($list1 = $db->fetch_array($result1)){
					$nowpara1="para".$list1['paraid'];
					$list[$nowpara1]=$list1['info'];
					$metparaaccess=$metpara[$list1['paraid']]['access'];
					if(intval($metparaaccess)>0&&$met_member_use){
						$paracode=authcode($list[$nowpara1], 'ENCODE', $met_member_force);
						$paracode=codetra($paracode,1); 
						$list[$nowpara1]="<script language='javascript' src='../include/access.php?metmemberforce={$metmemberforce}&metuser=para&metaccess=".$metparaaccess."&lang=".$lang."&listinfo=".$paracode."&paratype=".$metpara[$list1['paraid']]['type']."'></script>";
					}
					$nowparaname="";
					$nowparaname=$nowpara1."name";
					$list[$nowparaname]=($list1['imgname']<>"")?$list1['imgname']:$metpara[$list1['paraid']]['name'];
				}
			}
		}
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
		$list['top']=$list['top_ok']?"<img class='listtop' src='".$img_url."top.gif"."' alt='".$met_alt."' />":"";
		$list['hot']=$list['top_ok']?"":(($list['hits']>=$met_hot)?"<img class='listhot' src='".$img_url."hot.gif"."' alt='".$met_alt."' />":"");
		$list['news']=$list['top_ok']?"":((((strtotime($m_now_date)-strtotime($list['updatetime']))/86400)<$met_newsdays)?"<img class='listnews' src='".$img_url."news.gif"."' alt='".$met_alt."' />":"");
		$pagename1=$list['addtime'];
		$list['updatetime'] = date($met_listtime,strtotime($list['updatetime']));
		$list['imgurls']=($list['imgurls']<>"")?$list['imgurls']:$weburly.$met_agents_img;
		$list['imgurl']=($list['imgurl']<>"")?$list['imgurl']:$weburly.$met_agents_img;
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
		if($list['links']){
			$list['url']=$list['links'];
		}else{
			$list['url']=$met_pseudo?$panyid.'-'.$lang.'.html':($met_webhtm?$htmname.$met_ahtmtype:$phpname);
			if($class_list[$class1]['module']>=100||$search=='search'||$list['class1']!=$class1)$list['url']='../'.$class_list[$list['class1']]['foldername'].'/'.$list['url'];
		}
		if($mdname=='download'){
			if(intval($list['downloadaccess'])>0&&$met_member_use){
				$list['downloadurl']="down.php?id=$list[id]&lang=$lang";
			}
		}
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
		if($list['classother']!=''){
			$total_class=array();
			$list['classother']=trim($list['classother'],'|');
			$total_class=explode('|',$list['classother']);
			foreach($total_class as $key=>$val){
				$val=trim($val,'-');
				$total_classother=explode('-',$val);
				$classother1[$key]=$total_classother[0];
				$classother2[$key]=$total_classother[1];
				$classother3[$key]=$total_classother[2];				
			}
			foreach($classother1 as $val){
				if($val!=0&&!array_key_exists($val,$md_class))$md_class[$val][]=$list;					
			}
			foreach($classother2 as $val){
				if($val!=0&&!array_key_exists($val,$md_class))$md_class[$val][]=$list;
			}
			foreach($classother3 as $val){
				if($val!=0&&!array_key_exists($val,$md_class))$md_class[$val][]=$list;					
			}			
		}
		if($classnow==$class2){
			foreach($md_class as $key=>$val){
				if($key==$class1||$key==$class2){
					$md_class1[$key]=$val;
				}
				foreach($nav_list3[$class2] as $v){
					if($key==$v[id]){
						$md_class1[$key]=$val;
					}
				}
			}
		}else if($classnow==$class3){
			foreach($md_class as $key=>$val){
				if($key==$class1||$key==$class2||$key==$class3){
					$md_class1[$key]=$val;
				}
			}
		}else if($classnow==$class1){
			$md_class1=$md_class;
		}
		$md_class=$md_class1;
		$md_list[]=$list;
	}
if($search=='search' && $mdmendy){
	$pagemor = $mdname.".php?lang={$lang}&class1={$class1}&class2={$class2}&class3={$class3}".$serchpage.'&search=search&page=';
	$page_list = $rowset->link($pagemor);
}else{
	if($met_pseudo){
		$pagemor = ($metadmin['pagename'] and $class_list[$classnow]['filename']<>"")?'list-'.$class_list[$classnow]['filename'].'-':'list-'.$classnow.'-';
		$hz = '-'.$lang.'.html';
		$page_list = $rowset->link($pagemor,$hz);
	}
	else if($met_webhtm==2){
		if($class3<>0){
			$htmclass=$met_listhtmltype?'_'.$class3.'_':'_'.$class1.'_'.$class2.'_'.$class3.'_';
			$met_pagelist=(($metadmin['pagename'] and $class_list[$class3]['filename']<>"")?$class_list[$class3]['filename']:($met_htmlistname?$class_list[$class3]['foldername']:$modulename[$class_list[$class3]['module']][0])).$htmclass;
			$met_pagelist=$class_list[$class3]['filename']<>''?$class_list[$class3]['filename'].'_':$met_pagelist;
			$met_ahtmtype = $class_list[$class3]['filename']<>''?$met_chtmtype:$met_htmtype;
		}elseif($class2<>0){
			$htmclass=$met_listhtmltype?'_'.$class2.'_':'_'.$class1.'_'.$class2.'_';
			$met_pagelist=(($metadmin['pagename'] and $class_list[$class2]['filename']<>"")?$class_list[$class2]['filename']:($met_htmlistname?$class_list[$class2]['foldername']:$modulename[$class_list[$class2]['module']][0])).$htmclass;
			$met_pagelist=$class_list[$class2]['filename']<>''?$class_list[$class2]['filename'].'_':$met_pagelist;
			$met_ahtmtype = $class_list[$class2]['filename']<>''?$met_chtmtype:$met_htmtype;
		}else{
			$met_pagelist=(($metadmin['pagename'] and $class_list[$class1]['filename']<>"")?$class_list[$class1]['filename']:($met_htmlistname?$class_list[$class1]['foldername']:$modulename[$class_list[$class1]['module']][0]))."_".$class1."_";
			$met_pagelist=$class_list[$class1]['filename']<>''?$class_list[$class1]['filename'].'_':$met_pagelist;
			$met_ahtmtype = $class_list[$class1]['filename']<>''?$met_chtmtype:$met_htmtype;
		}
		$page_list = $rowset->link($met_pagelist,$met_ahtmtype);
	}else{
		$pagemor = $mdname.'.php?'.$langmark."&class1=$class1&class2=$class2&class3=$class3&page=";
		$hz = '';
		$page_list = $rowset->link($pagemor,$hz);
	}
	if($temporary_plugin_product_list == 1){
		$pagemor = $newclass->temporary_plugin_product_page();
		if($pagemor){
			$hz = '';
			$page_list = $rowset->link($pagemor,$hz);	
		}
	}
}

if($mdmendy){
	$dbpagename = $mdname=='product'?$met_product_page:($mdname=='download'?$met_download_page:$met_img_page);
	if($dbpagename && $search!='search'){
		if($class2 && count($nav_list3[$class2])&& (!$class3) ){
			$metpageok=1;
		}elseif((!$class2) && count($nav_list2[$class1]) && $class1 && (!$class3)){
			$metpageok=1;
		}elseif($class_list[$class1]['module']==100 || $class_list[$class1]['module']==101){
			$metpageok=1;
		}
		if($metpageok)$page_list='';
	}
}
$class3=$class_list[$class1]['releclass']?$class2:$class3;
$class2=$class_list[$class1]['releclass']?$class1:$class2;
$class1=$class_list[$class1]['releclass']?$class_list[$class1]['releclass']:$class1;
if($class_list[$higher]['releclass']){}
$class_info=$class3?$class3_info:($class2?$class2_info:$class1_info);
if($class2){
	$class_info['name']=$class2_info['name']."-".$class1_info['name'];
}
if($class3){
	$class_info['name']=$class3_info['name']."-".$class2_info['name']."-".$class1_info['name'];
}
$show['description']=$class_info['description']?$class_info['description']:$met_description;
$show['keywords']=$class_info['keywords']?$class_info['keywords']:$met_keywords;
$met_title=$met_title?$class_info['name'].'-'.$met_title:$class_info['name'];
if($class_info['ctitle']!='')$met_title=$class_info['ctitle'];
if($page>1)$met_title.='-'.$lang_Pagenum1.$page.$lang_Pagenum2;
$pageall=$rowset->pages;
if(($met_product_page && $class_list[$class1]['module']==3) || ($class_list[$class1]['module']==5 && $met_img_page) && $search<>'search' && ($metinfover=='v1' || $metinfover=='v2')){// 增加判断值（新模板框架v2）
	$product_listp=array();
	if($class2 && count($nav_list3[$class2]) && !$class3){
		$product_listp=$nav_list3[$class2];
	}
	if(!$class2 && count($nav_list2[$class1]) && $class1 && !$class3){
		$product_listp=$nav_list2[$class1];
	}
	if($product_listp){
		foreach($product_listp as $key=>$val){
			$val['title']=$val['name'];
			$val['imgurl']=$val['columnimg']==''?$weburly.$met_agents_img:$val['columnimg'];
			$val['imgurls']=$val['imgurl'];
			$show_listp[] = $val;
		}
		$md_list = $show_listp;
	}
}
require_once '../public/php/methtml.inc.php';
?>