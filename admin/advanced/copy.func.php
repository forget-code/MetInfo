<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 
require_once '../login/login_check.php';
require_once '../include/global.func.php';
//分模块参数写入数据库
function plist($copylang,$copypart,$parameter,$id,$mod,$lang){
        global $db,$met_plist;
            $paranum =$db->get_one("select * from $copypart where lang='$copylang' and id=(select max(id) from $copypart)");
			$parare=array('0'=>$id,'1'=>$paranum[id]);//ID与复制后的ID
            $query  = "select * from $met_plist where lang='$lang' and module='$mod'";
            $result = $db->query($query);
	        while($list= $db->fetch_array($result)){
	            $copyplist[]=$list;
	        }
			$copyplist=daddslashes($copyplist,'1');	
			foreach($copyplist as $key=>$vab){
				if($parare[0]==$vab[listid]){
				        foreach($parameter as $key=>$vac){ if($vab[paraid]==$vac[pn])$vab[paraid]=$vac[dn]; }
				    $vab[listid]=$parare[1];
                    $query = "INSERT INTO $met_plist SET
                        listid           = '$vab[listid]',
                        paraid           = '$vab[paraid]',
                        info             = '$vab[info]',
                        imgname          = '$vab[imgname]',
                        module           = '$vab[module]',
					    lang             = '$copylang'";
			        $db->query($query);
				}
			}
}
//文件夹判断
function copyfnameok($fname,$cylang){
	global $db,$met_column;
	$foldername_ok = $db->get_one("SELECT * FROM $met_column WHERE foldername='$fname' and lang='$cylang'");
	if($foldername_ok){
		$fname = $fname.$cylang;
		$foldername_ok1 = $db->get_one("SELECT * FROM $met_column WHERE foldername='$fname' and lang='$cylang'");
		if($foldername_ok1){
			return copyfnameok($fname,$cylang);
		}else{
			return $fname;
		}
	}else{
		return $fname;
	}
}
//分模块内容信息写入数据库
function copycontent($mod,$copymin,$parameter,$copylang,$lang,$chce,$chce1,$chce2){
        global $db,$met_news,$met_product,$met_download,$met_img,$met_job,$met_link;
            $modulename[2]=array(0=>$met_news);
            $modulename[3]=array(0=>$met_product);
            $modulename[4]=array(0=>$met_download);
            $modulename[5]=array(0=>$met_img);
            $modulename[6]=array(0=>$met_job);		
            $modulename[9]=array(0=>$met_link);
			$copypart=$modulename[$mod][0];
				foreach($copymin as $key=>$vaa){
				      $id=$vaa[id];
				      switch($copypart){
                      case $met_news:   //文章模块
					      if(is_array($chce)){
                              foreach($chce as $key=>$vao){ if($vaa[class1]==$vao[pn])$vaa[class1]=$vao[dn]; }
			                  if($vaa[class2]){foreach($chce1 as $key=>$vao){ if($vaa[class2]==$vao[pn])$vaa[class2]=$vao[dn]; }}
			                  if($vaa[class3]){foreach($chce2 as $key=>$vao){ if($vaa[class3]==$vao[pn])$vaa[class3]=$vao[dn]; }}
						  }else{ $vaa[class1]=$chce; $vaa[class2]=$chce1; $vaa[class3]=$chce2; $vaa[access]=$access;}
                          $query = "INSERT INTO $copypart SET
                                title              = '$vaa[title]',
					            keywords           = '$vaa[keywords]',
					            description        = '$vaa[description]',
					            content            = '$vaa[content]',
					            class1             = '$vaa[class1]',
					            class2             = '$vaa[class2]',
					            class3             = '$vaa[class3]',
					            img_ok             = '$vaa[img_ok]',
					            imgurl             = '$vaa[imgurl]',
					            imgurls            = '$vaa[imgurls]',
					            com_ok             = '$vaa[com_ok]',
					            issue              = '$vaa[issue]',
					            hits               = '$vaa[hits]',
					            updatetime         = '$vaa[updatetime]',
					            addtime            = '$vaa[addtime]',
					            access             = '$vaa[access]', 
					            top_ok             = '$vaa[top_ok]',
					            wap_ok             = '$vaa[wap_ok]',
					            no_order           = '$vaa[no_order]',
					            filename           = '',
					            lang       		   = '$copylang'";
			              $db->query($query);
	                    break;
                        case $met_product:    //产品模块
                        case $met_img:        //图片模块
					      if(is_array($chce)){
                              foreach($chce as $key=>$vao){ if($vaa[class1]==$vao[pn])$vaa[class1]=$vao[dn]; }
			                  if($vaa[class2]){foreach($chce1 as $key=>$vao){ if($vaa[class2]==$vao[pn])$vaa[class2]=$vao[dn]; }}
			                  if($vaa[class3]){foreach($chce2 as $key=>$vao){ if($vaa[class3]==$vao[pn])$vaa[class3]=$vao[dn]; }}
						  }else{ $vaa[class1]=$chce; $vaa[class2]=$chce1; $vaa[class3]=$chce2; $vaa[access]=$access;}
                            $query = "INSERT INTO $copypart SET
                                title              = '$vaa[title]',
					            keywords           = '$vaa[keywords]',
					            description        = '$vaa[description]',
					            content            = '$vaa[content]',
					            class1             = '$vaa[class1]',
					            class2             = '$vaa[class2]',
					            class3             = '$vaa[class3]',
					            new_ok             = '$vaa[new_ok]',
					            imgurl             = '$vaa[imgurl]',
					            imgurls            = '$vaa[imgurls]',
					            displayimg         = '$vaa[displayimg]',
					            com_ok             = '$vaa[com_ok]',
					            hits               = '$vaa[hits]',
					            updatetime         = '$vaa[updatetime]',
					            addtime            = '$vaa[addtime]',
					            issue              = '$vaa[issue]',
					            access             = '$vaa[access]', 
					            top_ok             = '$vaa[top_ok]',
					            wap_ok             = '$vaa[wap_ok]',
								no_order           = '$vaa[no_order]',
					            filename           = '',
					            lang               = '$copylang',
					            content1           = '$vaa[content1]',
					            content2           = '$vaa[content2]',
					            content3           = '$vaa[content3]',
					            content4           = '$vaa[content4]',
					            contentinfo        = '$vaa[contentinfo]',
					            contentinfo1       = '$vaa[contentinfo1]',
					            contentinfo2       = '$vaa[contentinfo2]',
					            contentinfo3       = '$vaa[contentinfo3]',
					            contentinfo4       = '$vaa[contentinfo4]'";
			                $db->query($query);
                                if($parameter!='')plist($copylang,$copypart,$parameter,$id,$mod,$lang);
	                        break;
                        case $met_download:    //下载模块
					      if(is_array($chce)){
                              foreach($chce as $key=>$vao){ if($vaa[class1]==$vao[pn])$vaa[class1]=$vao[dn]; }
			                  if($vaa[class2]){foreach($chce1 as $key=>$vao){ if($vaa[class2]==$vao[pn])$vaa[class2]=$vao[dn]; }}
			                  if($vaa[class3]){foreach($chce2 as $key=>$vao){ if($vaa[class3]==$vao[pn])$vaa[class3]=$vao[dn]; }}
						  }else{ $vaa[class1]=$chce; $vaa[class2]=$chce1; $vaa[class3]=$chce2; $vaa[access]=$access;}
                            $query = "INSERT INTO $copypart SET
                                title              = '$vaa[title]',
					            keywords           = '$vaa[keywords]',
					            description        = '$vaa[description]',
					            content            = '$vaa[content]',
					            class1             = '$vaa[class1]',
					            class2             = '$vaa[class2]',
					            class3             = '$vaa[class3]',
					            new_ok             = '$vaa[new_ok]',
					            com_ok             = '$vaa[com_ok]',
					            hits               = '$vaa[hits]',
					            downloadurl        = '$vaa[downloadurl]',
					            filesize           = '$vaa[filesize]',
					            updatetime         = '$vaa[updatetime]',
					            addtime            = '$vaa[addtime]',
					            issue              = '$vaa[issue]',
					            access             = '$vaa[access]', 
					            top_ok             = '$vaa[top_ok]',
					            wap_ok             = '$vaa[wap_ok]',
								no_order           = '$vaa[no_order]',
					            downloadaccess     = '$vaa[downloadaccess]',
					            filename           = '',
					            lang       		   = '$copylang'";
			                $db->query($query);
                                if($parameter!='')plist($copylang,$copypart,$parameter,$id,$mod,$lang);
	                        break;
                        case $met_job:    //招聘模块
                            $query = "INSERT INTO $copypart SET
					            position           = '$vaa[position]',
					            count              = '$vaa[count]',
					            place              = '$vaa[place]',
					            deal               = '$vaa[deal]',
					            addtime            = '$vaa[addtime]',
					            useful_life        = '$vaa[useful_life]',
					            content            = '$vaa[content]',
					            access             = '$vaa[access]', 
					            top_ok             = '$vaa[top_ok]',
					            wap_ok             = '$vaa[wap_ok]',
					            filename           = '',
					            email              = '$vaa[email]',
					            no_order           = '$vaa[no_order]',
					            lang               = '$copylang'";
			                $db->query($query);
	                        break;
                        case $met_link:    //友情链接
                            $query = "INSERT INTO $copypart SET
					            webname            = '$vaa[webname]',
					            weburl             = '$vaa[weburl]',
					            weblogo            = '$vaa[weblogo]',
					            link_type          = '$vaa[link_type]',
					            info               = '$vaa[info]',
					            contact            = '$vaa[contact]',
					            orderno            = '$vaa[orderno]', 
					            com_ok             = '$vaa[com_ok]',
					            show_ok            = '$vaa[show_ok]',
					            addtime            = '$vaa[addtime]',
					            ip                 = '$vaa[ip]',
					            lang               = '$copylang'";
			                $db->query($query);
	                        break;
				      }  
				  }
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>