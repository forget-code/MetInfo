<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.
/*if($pcok){
	if(strlen($pcok)>3){
		header("location:404.html");die;
	}
}
if($met_mobileok){
	$pattern='/^[1-9]?\d$/';
	if(!preg_match($pattern,$met_mobileok)){
		header("location:404.html");die;
	}
}*/
if($met_mobileok ==1 ){
    if($uid!=null){
        $pattern='/^[1-9]?\d$/';
        if(preg_match($pattern,$uid)){
            $query = "SELECT * FROM $met_wapmenu where lang='$lang' and id=$uid";
            $result = $db->query($query);
            while($list = $db->fetch_array($result)) {
                $list_array2[]=$list;
                $is=$list;
            }
            if(!$is||$is[type]!=3){
                header("location:404.html");die();
            }
        }else{
            header("location:404.html");die();
        }

        foreach($list_array2 as $key=>$val){
            if($val[type]==3){
                $mapcan=explode("[!]",$val['value']);
                $met_maplng=$mapcan[1];
                $met_maplat=$mapcan[2];
                $met_mapzoom=$mapcan[3];
                $met_maptitle=$mapcan[4];
                $met_mapcontents=$mapcan[5];
            }
        }
    }else if($map==1&&!$uid){
        header("location:404.html");die();
    }
}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>