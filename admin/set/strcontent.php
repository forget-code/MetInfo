<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.
require_once '../login/login_check.php';
if($action=="modify"){
$label_m=$db->get_one("SELECT * FROM $met_label WHERE id='$id'");
$css_url="../templates/".$met_skin."/css";
$img_url="../templates/".$met_skin."/images";
include template('label');
footer();
}elseif($action=="editor"){
	$allidlist=explode(',',$allid);
	$adnum = count($allidlist)-1;
	//okinfox($allid,'strcontent.php?lang='.$lang);
	for($i=0;$i<$adnum;$i++){
		$oldwords = 'oldwords_'.$allidlist[$i];
		$oldwords = $$oldwords;
		$newwords = 'newwords_'.$allidlist[$i];
		$newwords = $$newwords;
		$newtitle = 'newtitle_'.$allidlist[$i];
		$newtitle = $$newtitle;
		$url = 'url_'.$allidlist[$i];
		$url = $$url;
		$tpif = is_numeric($allidlist[$i])?1:0;
		$sql = $tpif?"id='$allidlist[$i]'":"oldwords='$oldwords' and lang='$lang'";
		$skin_m=$db->get_one("SELECT * FROM $met_label WHERE $sql");
		if($oldwords=='')okinfox('strcontent.php?lang='.$lang,$lang_labelnonull);
		if($tpif){
			if(!$skin_m){okinfox('strcontent.php?lang='.$lang,$lang_dataerror);}
			$skin_m1=$db->get_one("SELECT * FROM $met_label WHERE oldwords='$oldwords' and lang='$lang'");
			if($skin_m1[id] && $skin_m1[id]!=$skin_m[id])okinfox('strcontent.php?lang='.$lang,$lang_labelnonull);
		}else{
			if($skin_m){okinfox('strcontent.php?lang='.$lang,$lang_loginOldwords);}
		}
		$uptp = $tpif?"update":"insert into";
		$upbp = $tpif?"where id='$allidlist[$i]'":",lang='$lang'";
		$query="$uptp $met_label set
			oldwords='$oldwords',
			newwords='$newwords',
			newtitle='$newtitle',
			url='$url'
			$upbp";
		$db->query($query);
	}
	require_once 'strsave.php';	
	okinfo('strcontent.php?lang='.$lang);
}elseif($action=="add"){
$img_url="../templates/".$met_skin."/images";
	$newslit = "<tr class='mouse click newlist'>\n";
	$newslit.= "<td class='list-text'><input name='id' type='checkbox' id='id' value='new$lp' checked='checked' /></td>\n";
	$newslit.= "<td class='list-text'></td>\n";
	$newslit.= "<td class='list-text'><input type='text' name='oldwords_new$lp' class='text max' /></td>\n";
	$newslit.= "<td class='list-text'><input type='text' name='newwords_new$lp' class='text max' /></td>\n";
	$newslit.= "<td class='list-text'><input type='text' name='newtitle_new$lp' class='text max' /></td>\n";
	$newslit.= "<td class='list-text'><input type='text' name='url_new$lp' class='text max' /></td>\n";
	$newslit.= "<td class='list-text'><a href='javascript:;' style='padding:0px 5px;' onclick='delettr($(this));'><img src='$img_url/12.png' /><span class='none'>$lang_js49</span></a></td>\n";
	$newslit.= "</tr>";
	echo $newslit;
}elseif($action=="delete"){
	if($action_type=="del"){
		$allidlist=explode(',',$allid);
		foreach($allidlist as $key=>$val){
			$query = "delete from $met_label where id='$val'";
			$db->query($query);
		}
		require_once 'strsave.php';
		okinfo('strcontent.php?lang='.$lang);
	}
	else{
		$skin_m=$db->get_one("SELECT * FROM $met_label WHERE id='$id'");
		if(!$skin_m){okinfox('strcontent.php?lang='.$lang,$lang_dataerror);}
		$query="delete from $met_label where id='$id'";
		$db->query($query);
		require_once 'strsave.php';
		okinfo('strcontent.php?lang='.$lang);
	}
}else{
    $total_count = $db->counter($met_label, " where lang='$lang'", "*");
    require_once 'include/pager.class.php';
    $page = (int)$page;
	if($page_input){$page=$page_input;}
    $list_num = 16;
    $rowset = new Pager($total_count,$list_num,$page);
    $from_record = $rowset->_offset();
    $query = "SELECT * FROM $met_label where lang='$lang' order BY id LIMIT $from_record, $list_num";
    $result = $db->query($query);
	while($list = $db->fetch_array($result)) {
		$skin_list[]=$list;
    }
	$page_list = $rowset->link("strcontent.php?page=");
	$css_url="../templates/".$met_skin."/css";
	$img_url="../templates/".$met_skin."/images";
	include template('label');
	footer();
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>