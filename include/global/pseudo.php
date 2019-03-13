<?php
	    $modname   = $modulename[$list['module']][0];
		$psid      = $list['id'];
		$list['foldername'] = ereg_replace(" ","",$list['foldername']);
		$list['filename'] = ereg_replace(" ","",$list['filename']);
		if($list['filename'] && $list['filename']!=''){
			$met_ahtmtype=$met_chtmtype;
		}else{
			$met_ahtmtype=$met_htmtype;
		}
		$pudo_column = $list['foldername'].'/';
		if($met_pseudo && $list['filename']!='')$psid=$list['filename'];
		if($metadmin['categorymarkimage']){
			$list['indeximgarray']=explode("../",$list['indeximg']);
			$list['indeximg']=($index=="index")?$list['indeximgarray'][1]:$list['indeximg'];
		}
		if($metadmin['categorymage']){
			$list['columnimgarray']=explode("../",$list['columnimg']);
			$list['columnimg']=($index=="index")?$list['columnimgarray'][1]:$list['columnimg'];
		}
//3.0
		$folderone=$db->get_one("SELECT * FROM $met_column WHERE foldername='$list[foldername]' and id !='$list[id]' and classtype='1' and lang='$lang'");
		if($folderone)$langnums=2;
//
		if($list['releclass']){
			$urllast=$modulename[$list[module]][0].".php"."?".$langmark."&class1=".$list['id'];
			if($met_pseudo)$urllast = $pudo_column.'list-'.$psid.'-'.$lang.'.html';
			if($langnums==1)$urllast='';
			$htmlistpre="_";
		}else{
		    $urltop = $modname.'.php?'.$langmark;
			switch($list['classtype']){
				case 1:
					$urllast   = $langnums>1?$urltop.'&class1='.$list['id']:'';
					$htmlistpre= "_";
					if($met_pseudo)$urllast = $pudo_column.'list-'.$psid.'-'.$lang.'.html';
					if($langnums==1)$urllast='';
				break;
				case 2:
					$urllast   = $urltop."&class2=".$list['id'];
					$htmlistpre= "_".$list['bigclass']."_";
					if($met_pseudo)$urllast = $pudo_column.'list-'.$psid.'-'.$lang.'.html';
				break;
				case 3:
					$urlclass1 = $db->get_one("SELECT * FROM $met_column where id='$list[bigclass]'");
					$urllast   = $urltop."&class3=".$list['id'];
					$htmlistpre="_".$urlclass1['bigclass']."_".$list['bigclass']."_";
					if($met_pseudo)$urllast = $pudo_column.'list-'.$psid.'-'.$lang.'.html';
				break;
			}
		}
		switch($list['module']){
			default:
				if($list['filename']<>"" and $metadmin['pagename']){
					$htmlng=$list['filename']."_1".$met_ahtmtype;
					if($list['classtype']==1&&$met_index_type==$lang)$htmlng='';
					$list['url'] = $met_webhtm==2?$htmlng:$urllast;
					if($met_pseudo)$list['url']=$urllast;
				}else{
					$field       = !$met_htmlistname?$modname:$list['foldername'];
					$htmlng=$field.$htmlistpre.$list['id']."_1".$met_ahtmtype;
					if($list['classtype']==1&&$met_index_type==$lang)$htmlng='';
					$list['url'] = $met_webhtm==2?$htmlng:$urllast;
					if($met_pseudo)$list['url']=$urllast;
				}
				break;
			case 0:	
				$list['url'] = (strstr($list['out_url'],"http://"))?$list['out_url']:$navurl.$list['out_url'];
				break;
			case 1:
				if($list['isshow']!=1 && $list['classtype']==1){
					$list['urllabel'] = 'metinfo_url';
					$metinfo_about = 'metinfo';
				}elseif($list['isshow']!=1&&$list['classtype']==2){
					$list['urllabel2'] = 'metinfo_url2';
					$metinfo_about2 = 'metinfo2';
				}else{
				    $urlpy ='show.php?'.$langmark.'&id='.$list['id'];
					$list['url']=$met_webhtm?($list['filename']!=''?$list['filename'].$met_ahtmtype:$list['foldername'].$list['id'].$met_ahtmtype):$urlpy;
					if($met_pseudo)$list['url'] = $pudo_column.$psid.'-'.$lang.'.html';
					if(($list['classtype']==1 || $list['releclass'])&& $list['isshow']==1 && $langnums==1)$list['url']='';
				}
				break;
			case 6:
				if($met_pseudo){
					$list['url'] = $pudo_column.'list-'.$psid.'-'.$lang.'.html';
					if($langnums==1)$list['url']='';
				}elseif($list['filename']<>"" and $metadmin['pagename']){
					$list['url']=$langnums>1?($met_webhtm==2?$list['filename']."_1".$met_ahtmtype:"job.php?".$langmark):'';
				}else{
				    $field =!$met_htmlistname?"job":$list['foldername'];
					$list['url']=$langnums>1?($met_webhtm==2?$field."_".$list['id'].'_1'.$met_ahtmtype:'job.php?'.$langmark):'';
				}
				break;
			case 7:
			    if($met_pseudo){
					$list['url'] = $pudo_column.'index-'.$lang.'.html';
					$addmessage_url='message-'.$lang.'.html';
					if($langnums==1)$list['url']='';
				}else{
					$field =!$met_htmlistname?"index":$list['foldername'];
					$field1=!$met_htmlistname?"message":$list['foldername'];
					$fieldurl=$field.'_list_1';
					if($list['filename']!='')$fieldurl = $list['filename'].'_1';
					$list['url']=$langnums>1?($met_webhtm==2?$fieldurl.$met_ahtmtype:'index.php?'.$langmark):'';
					$addmessage_url=$met_webhtm?$field1.$met_htmtype:"message.php?".$langmark;
					$addmessage_url=$navurl.$list['foldername']."/".$addmessage_url;
				}
				break;
			case 8:
				if($met_pseudo){
					$list['url'] = $pudo_column.'index-'.$lang.'.html';
					$addfeedback_url = $list['url'];
					if($langnums==1)$list['url']='';
				}else{
					$feedfname = $list['filename']!=''?$list['filename']:'index';
					$list['url']=$langnums>1?($met_webhtm?$feedfname.$met_ahtmtype:"index.php?".$langmark.'&id='.$list['id']):'';
					$addfeedback_url=$navurl.$list['foldername']."/".$list[url];
				}
				break;
			case 9:
				$list['url']=$langnums>1?($met_webhtm?"index".$met_ahtmtype:"index.php?".$langmark):'';
				if($met_pseudo)$list['url'] = $pudo_column.'index-'.$lang.'.html';
				if($langnums==1)$list['url']='';
				break;
			case 10:
				$list['url']=$langnums>1?($met_webhtm?"index".$met_ahtmtype:"index.php?".$langmark):'';
				if($met_pseudo)$list['url'] =$pudo_column.'index-'.$lang.'.html';
				if($langnums==1)$list['url']='';
				break;
			case 11:
				$list['url']=$langnums>1?"search.php?".$langmark:'';
				if($met_pseudo)$list['url'] =$pudo_column.'search-'.$lang.'.html';
				if($langnums==1)$list['url']='';
				break;
			case 12:
				$list['url']=$langnums>1?($met_webhtm?"sitemap".$met_ahtmtype:"sitemap.php?".$langmark):'';
				if($met_pseudo)$list['url'] =$pudo_column.'sitemap-'.$lang.'.html';
				if($langnums==1)$list['url']='';
				break;
			case 100:
				if($list['filename']<>"" and $metadmin['pagename']){
					$list['url']=$met_webhtm==2?$list['filename']."_".$list['id']."_1".$met_ahtmtype:"product.php?".$langmark;
				}else{
					$list['url']=$met_webhtm==2?"product_".$list['id']."_1".$met_ahtmtype:"product.php?".$langmark;
				}
				if($met_pseudo)$list['url'] =$pudo_column.'product-list-'.$lang.'.html';
				break;
			case 101:
				if($list['filename']<>"" and $metadmin['pagename']){
					$list['url']=$met_webhtm==2?$list['filename']."_".$list['id']."_1".$met_ahtmtype:"img.php?".$langmark;
				}else{
					$list['url']=$met_webhtm==2?"img_".$list['id']."_1".$met_ahtmtype:"img.php?".$langmark;
				}
				if($met_pseudo)$list['url'] =$pudo_column.'img-list-'.$lang.'.html';
				break;
		}
		if($met_pseudo && $langnums>1){
			$list['url'] = $weburly.$list['url'];
		}else{
			$list['url'] = $list['module']?$navurl.$list['foldername']."/".$list['url']:$list['url'];
		}
?>