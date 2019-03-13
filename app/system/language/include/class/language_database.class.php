<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.

defined('IN_MET') or exit('No permission');

/**
 * 系统标签类
 */

class language_database {
  /**
	 * 为字段赋值
	 * @param  string  $lang  语言
	 * @return array          栏目数组
	 */
	  public function copyconfig(){
       global $_M;
	   $langmark=$_M['form']['langmark'];
	   $langdlok=$_M['form']['langdlok'];
	   $langautor=$_M['form']['langautor'];
	   $langfile=$_M['form']['langfile'];
       if($langautor!=''){
				$synchronous=$langautor;
				$lang=$langautor;
			}else{
				$synchronous=$langfile;
				$lang=$langmark;
			}
		$newlangmark=$langautor;
     	if($langdlok=='1'){
		$post=array('newlangmark'=>$newlangmark,'metcms_v'=>$metcms_v);
		$file_basicname=$depth.'../update/lang/lang_'.$newlangmark.'.ini';
		$sun_re=$this->syn_lang($post,$file_basicname,$langautor,0,1);
	    }else{
        if($_M[form][langfile]){
        	$query="select * from {$_M[table][language]} where site='0' and app='0' and lang='{$_M[form][langfile]}'";
        	$languages=DB::get_all($query);
			foreach($languages as $key=>$val){
				$val[value] = str_replace("'","''",$val[value]);
				$val[value] = str_replace("\\","\\\\",$val[value]);
				$query = "insert into {$_M[table][language]} set name='$val[name]',value='$val[value]',site='0',no_order='$val[no_order]',array='$val[array]',lang='$lang'";
				DB::query($query);
			}
        }
		$sun_re=1;
	    }
        if($_M[form][langconfig]){
	    	$query="select * from {$_M[table][otherinfo]} where lang='{$_M[form][langconfig]}'";
	    }else{
            $query="select * from {$_M[table][otherinfo]} where lang='cn'";
	    }
        if($_M[form][langconfig]){
        	$query="select * from {$_M[table][config]} where (flashid ='10000' or flashid ='10001') and lang ='{$_M[form][langconfig]}'";
        	$defaultflash=DB::get_all($query);
        	foreach ($defaultflash as $key => $value) {
        		$query="insert into {$_M[table][config]} set name='$value[name]',value='$value[value]',mobile_value='$value[mobile_value]',columnid='$value[columnid]',flashid='$value[flashid]',lang='$lang'";
        		DB::query($query);
        	}
        }
        if($_M[form][langcontent]){
        	$columnlist=load::mod_class('column/column_label','new')->get_column_by_classtype($_M[form][langcontent],'1');
			 	foreach ($columnlist as $key => $val) {
			 	   load::mod_class('column/column_op', 'new')->copy_column($val[id],$lang,1);
			 	}
		}
        $infolist=DB::get_all($query);
        foreach ($infolist as $key => $val) {
        	if($_M[form][langconfig]){
               	$query = "insert into {$_M[table][otherinfo]} set info1='$val[info1]',info2='$val[info2]',info3='$val[info3]',info4='$val[info4]',info5='$val[info5]',info6='$val[info6]',info7='$val[info7]',info8='$val[info8]',info9='$val[info9]',info10='$val[info10]',imgurl1='$val[imgurl1]',imgurl2='$val[imgurl2]',rightmd5='$val[rightmd5]',righttext='$val[righttext]',authcode='$val[authcode]',authpass='$val[authpass]',data='$val[data]',lang='$lang'";
			}else{
				$query = "insert into {$_M[table][otherinfo]} set info1='',info2='',info3='',info4='',info5='',info6='',info7='',info8='$val[info8]',info9='$val[info9]',info10='',imgurl1='',imgurl2='',rightmd5='',righttext='',authcode='',authpass='',data='',lang='$lang'";
			}
			DB::query($query);
        }

      if($_M[form][langcontent]){
       $query="select * from {$_M[table][flash]} where (module ='metinfo' or module=',10001,') and lang ='{$_M[form][langcontent]}'";
       $flashval=DB::get_all($query);
	       foreach ($flashval as $key => $val) {
	        $query = "insert into {$_M[table][flash]} set module='$val[module]',img_title='$val[img_title]',img_path='$val[img_path]',img_link='$val[img_link]',flash_path='$val[flash_path]',flash_back='$val[flash_back]',no_order='$val[no_order]',width='$val[width]',height='$val[height]',wap_ok='$val[wap_ok]',img_title_color='$val[img_title_color]',img_des='$val[img_des]',img_des_color='$val[img_des_color]',img_text_position='$val[img_text_position]',height_m='$val[height_m]',height_t='$val[height_t]',lang='$lang'";
	        DB::query($query);
	        }
       }

        if($_M[form][langconfig]){
	    	$query="select * from {$_M[table][online]} where lang='{$_M[form][langconfig]}'";
	    }else{
            $query="select * from {$_M[table][online]} where lang='cn'";
	    }
        $onlinelist=DB::get_all($query);
        foreach ($onlinelist as $key => $val) {
        	if($_M[form][langconfig]){
               	$query = "insert into {$_M[table][online]} set name='$val[name]',no_order='$val[no_order]',qq='$val[qq]',msn='$val[msn]',taobao='$val[taobao]',alibaba='$val[alibaba]',skype='$val[skype]',lang='$lang'";
			}else{
				$query = "insert into {$_M[table][online]} set name='',no_order='',qq='',msn='',taobao='',alibaba='',skype='',lang='$lang'";
			}
			DB::query($query);
        }
	    if($_M[form][langconfig]){
	    	$query="select * from {$_M[table][config]} where lang='{$_M[form][langconfig]}' and columnid= 0 and flashid= 0";
	    }else{
            $query="select * from {$_M[table][config]} where lang='cn' and columnid= 0 and flashid= 0";
	    }
		$configs=DB::get_all($query);
		foreach($configs as $key=>$val){
			$val[value] = str_replace("'","''",$val[value]);
			$val[value] = str_replace("\\","\\\\",$val[value]);
			if($_M[form][langconfig]){
               	$query = "insert into {$_M[table][config]} set name='$val[name]',value='$val[value]',columnid='$val[columnid]',flashid='$val[flashid]',lang='$lang'";
			}else{
				$query = "insert into {$_M[table][config]} set name='$val[name]',value='',columnid='$val[columnid]',flashid='$val[flashid]',lang='$lang'";
			}
			DB::query($query);
		}
		if($_M[form][langui]){
		$query="select * from {$_M[table][config]} where name='met_skin_user' and lang ='{$_M[form][langui]}'";
		$ui=DB::get_one($query);
		$query="select * from {$_M[table][ui_config]} where skin_name ='{$ui[value]}' and lang ='{$_M[form][langui]}'";
		$uilist=DB::get_all($query);
        if($uilist){
			foreach($uilist as $key=>$val){
	           $query = "insert into {$_M[table][ui_config]} set pid='$val[pid]',parent_name='$val[parent_name]',ui_name='$val[ui_name]',skin_name='$val[skin_name]',uip_type='$val[uip_type]',uip_style='$val[uip_style]',uip_select='$val[uip_select]',uip_name='$val[uip_name]',uip_key='$val[uip_key]',uip_value='$val[uip_value]',uip_default='$val[uip_default]',uip_title='$val[uip_title]',uip_description='$val[uip_description]',uip_order='$val[uip_order]',lang='$lang'";
	            	DB::query($query);
				}
		}else{
			$query="select skin_name from {$_M[table][skin_table]}";
            $res=DB::get_all($query);
            foreach ($res as $key => $value) {
            $met_skin_user= $value['skin_name'];
            $query="select * from {$_M[table][templates]} where lang='{$_M[form][langui]}' and no='$met_skin_user'";
            $configs=DB::get_all($query);
            foreach($configs as $key=>$val){
             $val[value] = str_replace("'","''",$val[value]);
             $val[value] = str_replace("\\","\\\\",$val[value]);
             $val[no]=$value['skin_name'];

	            if($_M[form][langui]){
	            	if($_M[form][langcontent]){
	                  $query= "insert into {$_M[table][templates]} set no='$val[no]',pos='$val[pos]',no_order='$val[no_order]',type='$val[type]',style='$val[style]',selectd='$val[selectd]',name='$val[name]',value='$val[value]',defaultvalue='$val[defaultvalue]',valueinfo='$val[valueinfo]',tips='$val[tips]',lang='$lang'";
	            	}else{
	             	  $query= "insert into {$_M[table][templates]} set no='$val[no]',pos='$val[pos]',no_order='$val[no_order]',type='$val[type]',style='$val[style]',selectd='$val[selectd]',name='$val[name]',value='',defaultvalue='$val[defaultvalue]',valueinfo='$val[valueinfo]',tips='$val[tips]',lang='$lang'";
	               }
	               DB::query($query);
	            }

            }

        }
			}
		}

        return $sun_re;
    }


	function syn_lang($post,$filename,$langmark,$site,$type){
		 global $_M;
		$restr=$this->curl_post($post,30);
		$link=$this->link_error($restr);
		if($link!=1){
			return $link;
		}
		$this->filetest($filename);
		file_put_contents($filename,$restr);
		$array=0;
		$no_order=0;
		$array_l=0;
		$no_order_l=0;
		$array_s=0;
		$no_order_s=0;
		if(file_exists($filename)){
			//if($type!=1){
				// $query="delete from {$_M[table][language]} where site='$site' and app='0' and lang='$langmark'";
				// DB::query($query);
			//}
			$fp = @fopen($filename, "r");
			while ($conf_line = @fgets($fp, 1024)){
				if(substr($conf_line,0,1)=="#"){
					$no_order_l++;
					$array_l=0;
					$no_order_s=0;
					$array=$array_l;
					$no_order=$no_order_l;
					$line = preg_replace("/^#/", "", $conf_line);
					$flag=1;
				}else{
					$no_order_s++;
					$array_s=$no_order_l;
					$line = $conf_line;
					$array=$array_s;
					$no_order=$no_order_s;
					$flag=0;
				}
				if (trim($line) == "") continue;
				$linearray=explode ('=', $line);
				$linenum=count($linearray);
				if($linenum==2){
				list($name, $value) = explode ('=', $line);
				}else{

				  for($i=0;$i<$linenum;$i++){

					 $linetra=$i?$linetra."=".$linearray[$i]:$linearray[$i].'metinfo_';
				   }
				list($name, $value) = explode ('metinfo_=', $linetra);
				}
				$value=str_replace("\"","&quot;",$value);
				list($value, $valueinfo)=explode ('/*', $value);
				$name = str_replace('\\','',daddslashes(trim($name),1,'metinfo'));
				$value=str_replace("'","''",$value);
				$value=str_replace("\\","\\\\",$value);
				$value=trim($value,"\n");
				$value=trim($value,"\r");
				$value=trim($value,"\n");
				$value=trim($value,"\r");
				$value=str_replace('\\n',',',$value);
				$query1="select * from {$_M[table][language]} where name='$name' and site='$site' and lang='$langmark'";
				$result=DB::get_one($query1);
				if($result){
				   $query="update {$_M[table][language]} set value='$value' where name='$name' and site='$site'";
				}else{
                   $query="insert into {$_M[table][language]} set name='$name',value='$value',site='$site',no_order='{$no_order}',array='$array',lang='$langmark'";
				}
				DB::query($query);
			}
			fclose($fp);
		}
		unlink($filename);
		return 1;
	}


	 function curl_post($post, $timeout = 30){
			global $_M;
			if(get_extension_funcs('curl') && function_exists('curl_init') && function_exists('curl_setopt') && function_exists('curl_exec') && function_exists('curl_close')){
				$curlHandle = curl_init();
				curl_setopt($curlHandle, CURLOPT_URL, 'http://app.metinfo.cn/file/lang/lang.php');
				curl_setopt($curlHandle, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
				curl_setopt($curlHandle, CURLOPT_REFERER, $_M['config']['met_weburl']);
				curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($curlHandle, CURLOPT_CONNECTTIMEOUT, $timeout);
				curl_setopt($curlHandle, CURLOPT_TIMEOUT, $timeout);
				curl_setopt($curlHandle, CURLOPT_POST, 1);
				curl_setopt($curlHandle, CURLOPT_POSTFIELDS, $post);
				$result = curl_exec($curlHandle);
				curl_close($curlHandle);
				if(substr($result, 0, 7) == 'metinfo'){
				   return substr($result, 7);
			   }else{
			       return $result;
			   }

			}
		}

	function filetest($dir){
		@clearstatcache();
		if(file_exists($dir)){
			//@chmod($dir,0777);
			$str=file_get_contents($dir);
			if(strlen($str)==0)return 0;
			$return=file_put_contents($dir,$str);
		}
		else{
			$filedir='';
			$filedir=explode('/',dirname($dir));
			$flag=0;
			foreach($filedir as $key=>$val){
				if($val=='..'){
					$fileexist.="../";
				}
				else{
					if($flag){
						$fileexist.='/'.$val;
					}
					else{
						$fileexist.=$val;
						$flag=1;
					}
					if(!file_exists($fileexist)){
							@mkdir ($fileexist, 0777);
					}
				}
			}
			$filename=$fileexist.'/'.basename($dir);
			if(strstr(basename($dir),'.')){
				$fp=@fopen($filename, "w+");
				@fclose($fp);
				//@chmod($filename,0777);
			}
			else{
				@mkdir ($filename, 0777);
			}
			$return=file_put_contents($dir,'metinfo');
		}
		return $return;
	}

   function get_ui_by_lang($lang){
   	   global $_M;
       $query="select * from {$_M[table][ui_config]} where lang ='$lang'";
       return DB::get_all($query);
   }

   function del_ui_by_lang($lang){
   	   global $_M;
       $query="delete from {$_M[table][ui_config]} where lang ='$lang'";
       DB::query($query);
   }

	function link_error($str){
		switch($str){
			case 'Timeout' :
				return -6;
			break;
			case 'NO File' :
				return -5;
			break;
			case 'Please update' :
				return -4;
			break;
			case 'No Permissions' :
				return -3;
			break;
			case 'No filepower' :
				return -2;
			break;
			case 'nohost' :
				return -1;
			break;
			Default;
				return 1;
			break;
		}
	}
}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>
