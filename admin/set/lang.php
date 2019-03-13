<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 
require_once '../login/login_check.php';
if($action=="modify"){
	$thisurl = 'lang.php?lang='.$lang;
	$langmark=trim($langmark);
	$langorder=trim($langorder);
	$langoname=trim($langname);
	$langoflag=trim($langflag);
	$langolink=trim($langlink);
	$config_save =  "<?php\n";
	$config_save .=  "# MetInfo Enterprise Content Management System \n";
	$config_save .=  "# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. \n";
	switch($langsetaction){
		//setting
		case 'set':  
			$config_save .=  "$"."met_ch_lang='$met_ch_lang1';\n";
			$config_save .=  "$"."met_ch_mark='$met_ch_mark1';\n";
			$config_save .=  "$"."met_index_type='$met_index_type1';\n";
			$config_save .=  "$"."met_admin_type='$met_admin_type1';\n";
			$config_save .=  "$"."met_admin_type_ok='$met_admin_type_ok1';\n";
			$config_save .=  "$"."met_url_type='$met_url_type1';\n";
			$config_save .=  "$"."met_lang_mark='$met_lang_mark1';\n";
			$config_save .=  "$"."met_lang_editor='$met_lang_editor';\n";
			$config_save .=  "$"."met_langok=array();\n";
			foreach($met_langok as $key=>$val){
				$config_save .="$"."met_langok[$val[mark]]=array(name=>'$val[name]',useok=>'$val[useok]',order=>'$val[order]',mark=>'$val[mark]',flag=>'$val[flag]',link=>'$val[link]',newwindows=>'$val[newwindows]');\n";
			}
			$config_save .=  "$"."met_langadmin=array();\n";
			foreach($met_langadmin as $key=>$val){
				$config_save .="$"."met_langadmin[$val[mark]]=array(name=>'$val[name]',useok=>'$val[useok]',order=>'$val[order]',mark=>'$val[mark]');\n";
			}
		break;
		//add a new language
		case 'add':
			if($langname=='')okinfox($thisurl.'&langaction=add',$lang_langnamenull);
			$config_save .=  "$"."met_ch_lang='$met_ch_lang';\n";
			$config_save .=  "$"."met_ch_mark='$met_ch_mark';\n";
			$config_save .=  "$"."met_index_type='$met_index_type';\n";
			$config_save .=  "$"."met_admin_type='$met_admin_type';\n";
			$config_save .=  "$"."met_admin_type_ok='$met_admin_type_ok';\n";
			$config_save .=  "$"."met_url_type='$met_url_type';\n";
			$config_save .=  "$"."met_lang_mark='$met_lang_mark';\n";
			$config_save .=  "$"."met_lang_editor='$met_lang_editor';\n";
			$config_save .=  "$"."met_langok=array();\n";
			$met_langok2=$met_langok;
			$met_langok[0]=array(
							'name'		=>$langname,
							'useok'		=>$languseok,
							'order'		=>$langorder,
							'mark'		=>$langmark,
							'flag'		=>$langflag,
							'link'		=>$langlink,
							'newwindows'=>$langnewwindows);
			foreach($met_langok as $key=>$val){
				if($key){
					if($langmark==$val['mark'])okinfox($thisurl.'&langaction=add',$lang_langnamerepeat);
					if($val['order'] == $langorder)okinfox($thisurl.'&langaction=add',$lang_langnameorder);
				}
				$sortnow[$key] = $val['order'];
				$met_langok1[]=$val;
			}
			array_multisort($sortnow, SORT_ASC, $met_langok1);
			foreach($met_langok1 as $key=>$val){
				$config_save .="$"."met_langok[$val[mark]]=array(name=>'$val[name]',useok=>'$val[useok]',order=>'$val[order]',mark=>'$val[mark]',flag=>'$val[flag]',link=>'$val[link]',newwindows=>'$val[newwindows]');\n";
			}
			$config_save .=  "$"."met_langadmin=array();\n";
			foreach($met_langadmin as $key=>$val){
				$config_save .="$"."met_langadmin[$val[mark]]=array(name=>'$val[name]',useok=>'$val[useok]',order=>'$val[order]',mark=>'$val[mark]');\n";
			}
			$met_langok2[count($met_langok2)]['mark']=$langmark;
			if(isset($met_langok2[$langfile]['met_webhtm']))$met_langok2[$langmark]['met_webhtm']=$met_langok[$langfile]['met_webhtm'];
			if(isset($met_langok2[$langfile]['met_htmtype']))$met_langok2[$langmark]['met_htmtype']=$met_langok[$langfile]['met_htmtype'];
			if(isset($met_langok2[$langfile]['met_weburl']))$met_langok2[$langmark]['met_weburl']=$met_langok[$langfile]['met_weburl'];
			//admin_type
			$metinfo_admin = $db->get_one("SELECT * FROM $met_admin_table where admin_id='$metinfo_admin_name' ");
			if(!strstr(admin_poplang($metinfo_admin['admin_type'],$lang),'1601') && !strstr(admin_poplang($metinfo_admin['admin_type'],$lang),'metinfo')){	
				$newadmin_type = $metinfo_admin['admin_type'].','.$langmark.'-1001-1002-1003-1004-1005-1006-1007-1101-1102-1103-1104-1105-1201-1202-1203-1204-1205-1301-1401-1402-1403-1404-1405-1602-1603-13-12-63';
			}else{
				$newadmin_type = $metinfo_admin['admin_type'].','.$langmark.'-metinfo';
			}
			$query = "update $met_admin_table SET admin_type = '$newadmin_type' where admin_id='$metinfo_admin_name'";
			$db->query($query);
			//copy file
			$oldfile      ="../../lang/language_$langfile.ini";   
			$newfile      ="../../lang/language_$langmark.ini";  
			if(!file_exists($newfile)){  
				if (!copy($oldfile,   $newfile))okinfox($thisurl.'&langaction=add',$lang_langcopyfile);
			}
			$oldfile      ="../../config/config_$langincfile.inc.php";   
			$newfile      ="../../config/config_$langmark.inc.php";  
			if(!file_exists($newfile)){  
				if (!copy($oldfile,   $newfile))okinfox($thisurl.'&langaction=add',$lang_langcopyfile);
			}
			$oldfile      ="../../feedback/config_$langincfile.inc.php";   
			$newfile      ="../../feedback/config_$langmark.inc.php"; 
			if(!file_exists($newfile)){  
				if (!copy($oldfile,   $newfile))okinfox($thisurl.'&langaction=add',$lang_langcopyfile);
			}
			$oldfile      ="../../job/config_$langincfile.inc.php";   
			$newfile      ="../../job/config_$langmark.inc.php"; 
			if(!file_exists($newfile)){  
				if (!copy($oldfile,   $newfile))okinfox($thisurl.'&langaction=add',$lang_langcopyfile);
			}
			$oldfile      ="../../message/config_$langincfile.inc.php";   
			$newfile      ="../../message/config_$langmark.inc.php";  
			if(!file_exists($newfile)){  
				if (!copy($oldfile,   $newfile))okinfox($thisurl.'&langaction=add',$lang_langcopyfile);
			}
			$oldfile      ="../../config/flash_$langincfile.inc.php";   
			$newfile      ="../../config/flash_$langmark.inc.php";  
			if(!file_exists($newfile)){  
				if (!copy($oldfile,   $newfile))okinfox($thisurl.'&langaction=add',$lang_langcopyfile);
			}
			$oldfile      ="../../config/str_$langincfile.inc.php";   
			$newfile      ="../../config/str_$langmark.inc.php";  
			if(!file_exists($newfile)){  
				if (!copy($oldfile,   $newfile))okinfox($thisurl.'&langaction=add',$lang_langcopyfile);
			}
			$oldfile      ="../../templates/$met_skin_user/lang/language_$langfile.ini";   
			$newfile      ="../../templates/$met_skin_user/lang/language_$langmark.ini"; 
			if(!is_writable("../../templates/".$met_skin_user."/lang/"))@chmod("../../templates/".$met_skin_user."/lang/", 0777); 
			if(!file_exists($newfile)){  
				if (!copy($oldfile,   $newfile))okinfox($thisurl.'&langaction=add',$lang_langcopyfile);
			}
		break;
		case 'edit':
			if($langname=='')okinfox($thisurl.'&langaction=edit&langeditor='.$langmark,$lang_langnamenull);
			$config_save .=  "$"."met_ch_lang='$met_ch_lang';\n";
			$config_save .=  "$"."met_ch_mark='$met_ch_mark';\n";
			$config_save .=  "$"."met_index_type='$met_index_type';\n";
			$config_save .=  "$"."met_admin_type='$met_admin_type';\n";
			$config_save .=  "$"."met_admin_type_ok='$met_admin_type_ok';\n";
			$config_save .=  "$"."met_url_type='$met_url_type';\n";
			$config_save .=  "$"."met_lang_mark='$met_lang_mark';\n";
			$config_save .=  "$"."met_lang_editor='$met_lang_editor';\n";
			$config_save .=  "$"."met_langok=array();\n";
			$met_langok2=$met_langok;
			$met_langok[$langmark]=array(
									'name'	=>$langname,
									'useok'	=>$languseok,
									'order'	=>$langorder,
									'mark'	=>$langmark,
									'flag'	=>$langflag,
									'link'	=>$langlink,
									'newwindows'=>$langnewwindows);
			$i=0;
			foreach($met_langok as $key=>$val){
			$i++;
				if($val['mark']!=$langmark && $val['order'] == $langorder)okinfox($thisurl.'&langaction=edit&langeditor='.$langmark,$lang_langnameorder);
				$sortnow[$key] = $val['order'];
				$met_langok1[]=$val;
			}
			array_multisort($sortnow, SORT_ASC, $met_langok1);
			foreach($met_langok1 as $key=>$val){
				$config_save .="$"."met_langok[$val[mark]]=array(name=>'$val[name]',useok=>'$val[useok]',order=>'$val[order]',mark=>'$val[mark]',flag=>'$val[flag]',link=>'$val[link]',newwindows=>'$val[newwindows]');\n";
			}
			$config_save .=  "$"."met_langadmin=array();\n";
			foreach($met_langadmin as $key=>$val){
				$config_save .="$"."met_langadmin[$val[mark]]=array(name=>'$val[name]',useok=>'$val[useok]',order=>'$val[order]',mark=>'$val[mark]');\n";
			}
		break;
		case 'delete':
			$metinfolangmark=1;
			if(count($met_langok)==1)okinfox($thisurl,$lang_langone);
			$config_save .=  "$"."met_ch_lang='$met_ch_lang';\n";
			$config_save .=  "$"."met_ch_mark='$met_ch_mark';\n";
			$config_save .=  "$"."met_index_type='$met_index_type';\n";
			$config_save .=  "$"."met_admin_type='$met_admin_type';\n";
			$config_save .=  "$"."met_admin_type_ok='$met_admin_type_ok';\n";
			$config_save .=  "$"."met_url_type='$met_url_type';\n";
			$config_save .=  "$"."met_lang_mark='$met_lang_mark';\n";
			$config_save .=  "$"."met_lang_editor='$met_lang_editor';\n";
			$config_save .=  "$"."met_langok=array();\n";
$query = "select * from $met_admin_table where usertype='3'";
$result = $db->query($query);
while($list = $db->fetch_array($result)){
	$met_poplist[]=$list;
}
$k=count($met_poplist);
foreach($met_poplist as $key=>$val){
	$vallist = explode(',',$val['admin_type']);
	$p=count($vallist);
	for($i=0;$i<$p;$i++){
		if($i==0){
			$newpop[$val['admin_id']]=$vallist[$i];
		}else{
			if(!strstr($vallist[$i],$langeditor.'-'))$newpop[$val['admin_id']]=$newpop[$val['admin_id']].','.$vallist[$i];
		}
	}
	$query = "update $met_admin_table SET admin_type = '{$newpop[$val[admin_id]]}' where admin_id='{$val[admin_id]}'";
	$db->query($query);
}

			foreach($met_langok as $key=>$val){
				if($val['mark']==$langeditor){
					if(file_exists("../../lang/language_".$langeditor.".ini"))@unlink("../../lang/language_".$langeditor.".ini");
					if(file_exists("../../config/config_".$langeditor.".inc.php"))@unlink("../../config/config_".$langeditor.".inc.php");
					if(file_exists("../../feedback/config_".$langeditor.".inc.php"))@unlink("../../feedback/config_".$langeditor.".inc.php");
					if(file_exists("../../message/config_".$langeditor.".inc.php"))@unlink("../../message/config_".$langeditor.".inc.php");
					if(file_exists("../../job/config_".$langeditor.".inc.php"))@unlink("../../job/config_".$langeditor.".inc.php");
					if(file_exists("../../config/flash_".$langeditor.".inc.php"))@unlink("../../config/flash_".$langeditor.".inc.php");
					if(file_exists("../../config/str_".$langeditor.".inc.php"))@unlink("../../config/str_".$langeditor.".inc.php");
					if(file_exists("../../templates/".$met_skin_user."/lang/language_".$langeditor.".ini"))@unlink("../../templates/".$met_skin_user."/lang/language_".$langeditor.".ini");
				}
				//if($val['order']>$met_langok[$langeditor]['order'])$val['order']=$val['order']-1;
				if($val['mark']!=$langeditor)$config_save .="$"."met_langok[$val[mark]]=array(name=>'$val[name]',useok=>'$val[useok]',order=>'$val[order]',mark=>'$val[mark]',flag=>'$val[flag]',link=>'$val[link]',newwindows=>'$val[newwindows]');\n";
			}
			$config_save .=  "$"."met_langadmin=array();\n";
			foreach($met_langadmin as $key=>$val){
				$config_save .="$"."met_langadmin[$val[mark]]=array(name=>'$val[name]',useok=>'$val[useok]',order=>'$val[order]',mark=>'$val[mark]');\n";
			}
		break;
		//add a new admin language
		case 'addadmin':
			if($langname=="")okinfox($thisurl.'&langaction=addadmin',$lang_langnamenull);
			$config_save .=  "$"."met_ch_lang='$met_ch_lang';\n";
			$config_save .=  "$"."met_ch_mark='$met_ch_mark';\n";
			$config_save .=  "$"."met_index_type='$met_index_type';\n";
			$config_save .=  "$"."met_admin_type='$met_admin_type';\n";
			$config_save .=  "$"."met_admin_type_ok='$met_admin_type_ok';\n";
			$config_save .=  "$"."met_url_type='$met_url_type';\n";
			$config_save .=  "$"."met_lang_mark='$met_lang_mark';\n";
			$config_save .=  "$"."met_lang_editor='$met_lang_editor';\n";
			$config_save .=  "$"."met_langok=array();\n";
			foreach($met_langok as $key=>$val){
				$config_save .="$"."met_langok[$val[mark]]=array(name=>'$val[name]',useok=>'$val[useok]',order=>'$val[order]',mark=>'$val[mark]',flag=>'$val[flag]',link=>'$val[link]',newwindows=>'$val[newwindows]');\n";
			}
			$met_langadmin[0]=array(
							'name'	=>$langname,
							'useok'	=>$languseok,
							'order'	=>$langorder,
							'mark'	=>$langmark);
			foreach($met_langadmin as $key=>$val){
				if($key){
					if($langmark==$val['mark'])okinfox($thisurl.'&langaction=addadmin',$lang_langnamerepeat);
					if($val['order'] == $langorder)okinfox($thisurl.'&langaction=addadmin',$lang_langnameorder);
				}
				$sortnow[$key] = $val['order'];
				$met_langadmin1[]=$val;
			}
			array_multisort($sortnow, SORT_ASC, $met_langadmin1);
			$config_save .=  "$"."met_langadmin=array();\n";
			foreach($met_langadmin1 as $key=>$val){
				$config_save .="$"."met_langadmin[$val[mark]]=array(name=>'$val[name]',useok=>'$val[useok]',order=>'$val[order]',mark=>'$val[mark]');\n";
			}
			//copy file
			$oldfile      ="../language/language_$langfile.ini";   
			$newfile      ="../language/language_$langmark.ini";  
			if(!file_exists($newfile)){  
				if (!copy($oldfile,   $newfile))okinfox($thisurl.'&langaction=addadmin',$lang_langcopyfile);
			}
		break;
		case 'editadmin':
			if($langname=="")okinfox($thisurl.'&langaction=editadmin',$lang_langnamenull);
			$config_save .=  "$"."met_ch_lang='$met_ch_lang';\n";
			$config_save .=  "$"."met_ch_mark='$met_ch_mark';\n";
			$config_save .=  "$"."met_index_type='$met_index_type';\n";
			$config_save .=  "$"."met_admin_type='$met_admin_type';\n";
			$config_save .=  "$"."met_admin_type_ok='$met_admin_type_ok';\n";
			$config_save .=  "$"."met_url_type='$met_url_type';\n";
			$config_save .=  "$"."met_lang_mark='$met_lang_mark';\n";
			$config_save .=  "$"."met_lang_editor='$met_lang_editor';\n";
			$config_save .=  "$"."met_langok=array();\n";
			foreach($met_langok as $key=>$val){
				$config_save .="$"."met_langok[$val[mark]]=array(name=>'$val[name]',useok=>'$val[useok]',order=>'$val[order]',mark=>'$val[mark]',flag=>'$val[flag]',link=>'$val[link]',newwindows=>'$val[newwindows]');\n";
			}
			$met_langadmin[$langmark]=array('name'=>$langname,'useok'=>$languseok,'order'=>$langorder,'mark'=>$langmark);
			$i=0;
			foreach($met_langadmin as $key=>$val){
			$i++;
				if($val['mark']!=$langmark && $val['order'] == $langorder)okinfox($thisurl.'&langaction=editadmin&langeditor='.$langmark,$lang_langnameorder);
				$sortnow[$key] = $val['order'];
				$met_langadmin1[]=$val;
			}
			array_multisort($sortnow, SORT_ASC, $met_langadmin1);
			$config_save .=  "$"."met_langadmin=array();\n";
			foreach($met_langadmin1 as $key=>$val){
				$config_save .="$"."met_langadmin[$val[mark]]=array(name=>'$val[name]',useok=>'$val[useok]',order=>'$val[order]',mark=>'$val[mark]');\n";
			}
		break;
		case 'deleteadmin':
			if(count($met_langadmin)==1)okinfox($thisurl,$lang_langone);
			$config_save .=  "$"."met_ch_lang='$met_ch_lang';\n";
			$config_save .=  "$"."met_ch_mark='$met_ch_mark';\n";
			$config_save .=  "$"."met_index_type='$met_index_type';\n";
			$config_save .=  "$"."met_admin_type='$met_admin_type';\n";
			$config_save .=  "$"."met_admin_type_ok='$met_admin_type_ok';\n";
			$config_save .=  "$"."met_url_type='$met_url_type';\n";
			$config_save .=  "$"."met_lang_mark='$met_lang_mark';\n";
			$config_save .=  "$"."met_lang_editor='$met_lang_editor';\n";
			$config_save .=  "$"."met_langok=array();\n";
			foreach($met_langok as $key=>$val){
				$config_save .="$"."met_langok[$val[mark]]=array(name=>'$val[name]',useok=>'$val[useok]',order=>'$val[order]',mark=>'$val[mark]',flag=>'$val[flag]',link=>'$val[link]',newwindows=>'$val[newwindows]');\n";
			}
			$config_save .=  "$"."met_langadmin=array();\n";
			foreach($met_langadmin as $key=>$val){
				if($val['mark']==$langeditor){
					if(file_exists("../language/language_".$langeditor.".ini"))@unlink("../language/language_".$langeditor.".ini");
				}
				if($val['order']>$met_langadmin[$langeditor]['order'])$val['order']=$val['order']-1;
				if($val['mark']!=$langeditor)$config_save .="$"."met_langadmin[$val[mark]]=array(name=>'$val[name]',useok=>'$val[useok]',order=>'$val[order]',mark=>'$val[mark]');\n";
			}
		break;
	}
	$met_langok=($langsetaction=='add' or $langsetaction=='edit')?$met_langok2:$met_langok;
	foreach($met_langok as $key=>$val){
		if(!($langsetaction=='delete' and $val['mark']==$langeditor)){
			if(isset($met_langok[$val['mark']]['met_webhtm']))$config_save.="$"."met_langok[$val[mark]][met_webhtm]='".$met_langok[$val['mark']]['met_webhtm']."';\n";
			if(isset($met_langok[$val['mark']]['met_htmtype']))$config_save.="$"."met_langok[$val[mark]][met_htmtype]='".$met_langok[$val['mark']]['met_htmtype']."';\n";
			if(isset($met_langok[$val['mark']]['met_weburl']))$config_save.="$"."met_langok[$val[mark]][met_weburl]='".$met_langok[$val['mark']]['met_weburl']."';\n";
		}
	}
	$config_save       .="# This program is an open source system, commercial use, please consciously to purchase commercial license.\n";
	$config_save       .="# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.\n";
	$config_save       .="?>";
	if(!is_writable("../../config/lang.inc.php"))@chmod("../../config/lang.inc.php",0777);
	$fp = fopen("../../config/lang.inc.php",w);
	fputs($fp, $config_save);
	fclose($fp);
	okinfo('lang.php?lang='.$lang,2);
}elseif($action=='flag'){
    $dir = '../../public/images/flag';
    $handle = opendir($dir);
    while(false !== $file=(readdir($handle))){
        if($file !== '.' && $file != '..'){
		    $flags[] = $file;
		}
	}
    closedir($handle);
	$k=count($flags);
	for($i=0;$i<$k;$i++){
	    $data.='<img src="'.$dir.'/'.$flags[$i].'" />';
	}
    echo $data;
}else{
	if($met_ch_lang==1)$met_ch_lang1="checked='checked'";
	if($met_ch_lang==0)$met_ch_lang2="checked='checked'";
	if($met_admin_type_ok==1)$met_admin_type_yes="checked='checked'";
	if($met_admin_type_ok==0)$met_admin_type_no="checked='checked'";
	if($met_url_type==1)$met_url_type_yes="checked='checked'";
	if($met_url_type==0)$met_url_type_no="checked='checked'";
	if($met_lang_mark==1)$met_lang_mark_yes="checked='checked'";
	if($met_lang_mark==0)$met_lang_mark_no="checked='checked'";
	if($met_lang_editor==1)$met_lang_editor_yes="checked='checked'";
	if($met_lang_editor==0)$met_lang_editor_no="checked='checked'";
	$css_url="../templates/".$met_skin."/css";
	$img_url="../templates/".$met_skin."/images";
	include template('lang');
	footer();
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>