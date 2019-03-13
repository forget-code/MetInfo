<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.  
require_once '../login/login_check.php';
$column_list = $db->get_one("SELECT * FROM $met_column WHERE id='$id'");
$modulename[2]=array(0=>$met_news);
$modulename[3]=array(0=>$met_product);
$modulename[4]=array(0=>$met_download);
$modulename[5]=array(0=>$met_img);
if($action=='shift'){
$modulenum=$modulename[$module][0];
$bigtype=$classtype;
$shifttype=$shiftclass1?'1':($shiftclass2?'2':'');
if($shift_columntype=='1')$shifttype='0';
switch($shifttype){
    case '0':
	$classtype='1';
	$bigclass='0';
	break;
    case '1':
	$classtype='2';
	$bigclass=$shiftclass1;
	break;
	case '2':
	$classtype='3';
	$bigclass=$shiftclass2;
	break;
}
//
switch($bigtype){
    case '1':
/*
	    $shiftc2=count($met_class2[$id])>0?true:false;
		if($shiftc2){
		    if($shifttype=='1'){
            for($i=0;$i<=count($met_class2[$id]);$i++){
                if(count($met_class3[$met_class2[$id][$i][id]])>0){
                    okinfo('index.php?lang='.$lang,$lang_js34);
	                break;
                }
				$classa=$met_class2[$id][$i][id];
	            $query = "update $modulenum SET";
	            $query = $query."
                    class1 = '$bigclass',
					class2 = '$id',
					class3 = '$classa'";
	            $query = $query."where class1='$id'";
	            $db->query($query);
            }
	            $query1 = "update $met_column SET";
	            $query1 = $query1."
				          classtype = '3'";
	            $query1 = $query1."where bigclass='$id'";
	            $db->query($query1);
			}else{
                    okinfo('index.php?lang='.$lang,$lang_js34);
	                break;
			}
		}
*/
    switch($shifttype){
        case '1':
		if(count($met_class2[$id])>0){
            for($i=0;$i<=count($met_class2[$id]);$i++){
                if(count($met_class3[$met_class2[$id][$i][id]])>0){
                    okinfo('index.php?lang='.$lang,$lang_js34);
	                break;
                }
				$classa=$met_class2[$id][$i][id];
	            $query = "update $modulenum SET";
	            $query = $query."
                    class1 = '$bigclass',
					class2 = '$id',
					class3 = '$classa'";
	            $query = $query."where class1='$id'";
	            $db->query($query);
            }
	            $query1 = "update $met_column SET";
	            $query1 = $query1."
				          classtype = '3'";
	            $query1 = $query1."where bigclass='$id'";
	            $db->query($query1);
        }else{
	        $query = "update $modulenum SET";
	        $query = $query."
                    class1 = '$bigclass',
					class2 = '$id'";
	        $query = $query."where class1='$id'";
	        $db->query($query);
		}
	    break;
	    case '2':
                if(count($met_class2[$id])>0){
                    okinfo('index.php?lang='.$lang,$lang_js34);
	                break;
                }
		        $classa=$met_class2a[$bigclass][bigclass];
	            $query = "update $modulenum SET";
	            $query = $query."
                    class1 = '$classa',
					class2 = '$bigclass',
					class3 = '$id'";
	            $query = $query."where class1='$id'";
	            $db->query($query);
	    break;
    }
	break;
	case '2':
	    switch($shifttype){
		    case '0':
		if(count($met_class3[$id])>0){
            for($i=0;$i<=count($met_class3[$id]);$i++){
				$classa=$met_class3[$id][$i][id];
	            $query = "update $modulenum SET";
	            $query = $query."
                    class1 = '$id',
					class2 = '$classa',
					class3 = '0'";
	            $query = $query."where class2='$id'";
	            $db->query($query);
            }
	            $query1 = "update $met_column SET";
	            $query1 = $query1."
				          classtype = '2'";
	            $query1 = $query1."where bigclass='$id'";
	            $db->query($query1);
        }else{
	        $query = "update $modulenum SET";
	        $query = $query."
                    class1 = '$id',
					class2 = '0'";
	        $query = $query."where class2='$id'";
	        $db->query($query);
		}
			break;
			case '1':
	        $query = "update $modulenum SET";
	        $query = $query."
                    class1 = '$bigclass'";
	        $query = $query."where class2='$id'";
	        $db->query($query);
			break;
			case '2':
		if(count($met_class3[$id])>0){
                    okinfo('index.php?lang='.$lang,$lang_js34);
	                break;
        }else{
		    $classa=$met_class2a[$bigclass][bigclass];
	        $query = "update $modulenum SET";
	        $query = $query."
                    class1 = '$classa',
					class2 = '$bigclass',
					class3 = '$id'";
	        $query = $query."where class2='$id'";
	        $db->query($query);
		}
			break;
		}
	break;
	case '3':
	    $classa=$met_class2a[$bigclass][bigclass];
	    $class1=$shifttype==0?$id:($shifttype==1?$bigclass:($shifttype==2?$classa:''));
	    $class2=$shifttype==0?'0':($shifttype==1?$id:($shifttype==2?$bigclass:''));
	    $class3=$shifttype==0?'0':($shifttype==1?'0':($shifttype==2?$id:''));
	        $query = "update $modulenum SET";
	        $query = $query."
                    class1 = '$class1',
					class2 = '$class2',
					class3 = '$class3'";
	        $query = $query."where class3='$id'";
	        $db->query($query);
	break;
}
//
$query = "update $met_column SET
					  bigclass           = '$bigclass',					  
					  classtype          = '$classtype'
					  where id='$id'"; 
 $db->query($query);
okinfo('index.php?lang='.$lang,$lang_jsok);
}
include template('column_shift');
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>
