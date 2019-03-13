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
	   $new_lang=$_M['form']['langautor'];
	   $base_lang =$_M['form']['langfile'];
	   $config_lang = $_M['form']['langconfig'];
       if($new_lang!=''){
				$synchronous=$new_lang;
				$lang=$new_lang;
			}else{
				$synchronous=$base_lang;
				$lang=$langmark;
			}
		$newlangmark=$new_lang;
     	if($langdlok=='1'){
		$post=array('newlangmark'=>$newlangmark,'metcms_v'=>$metcms_v);
		$file_basicname=$depth.'../update/lang/lang_'.$newlangmark.'.ini';
		$sun_re=$this->syn_lang($post,$file_basicname,$new_lang,0,1);
	    }else{
        if($base_lang){
        	$query = "select * from {$_M['table']['language']} where site='0' and lang='{$base_lang}'";
        	$languages = DB::get_all($query);
			foreach($languages as $key=>$val){
				$val[value] = str_replace("'","''",$val[value]);
				$val[value] = str_replace("\\","\\\\",$val[value]);
				$val['lang'] = $lang;
				unset($val['id']);
				$sql = get_sql($val);
				$query = "INSERT INTO {$_M['table']['language']} SET {$sql}";
				DB::query($query);
			}
        }
		$sun_re=1;
	    }


        if($config_lang){
        	$query="select * from {$_M[table][config]} where (flashid ='10000' or flashid ='10001') and lang ='{$config_lang}'";
        	$defaultflash=DB::get_all($query);
        	foreach ($defaultflash as $key => $value) {
        		$query="insert into {$_M[table][config]} set name='$value[name]',value='$value[value]',mobile_value='$value[mobile_value]',columnid='$value[columnid]',flashid='$value[flashid]',lang='$lang'";
        		DB::query($query);
        	}
        	self::copy_lang('app_config',$config_lang,$lang);
        	self::copy_lang('ifmember_left',$config_lang,$lang);
        	self::copy_lang('other_info',$config_lang,$lang);
        	self::copy_lang('online',$config_lang,$lang);
        	self::copy_lang('pay_config',$config_lang,$lang);

        }
        if($_M[form][langcontent]){
        	$columnlist=load::mod_class('column/column_label','new')->get_column_by_classtype($_M[form][langcontent],'1');
			 	foreach ($columnlist as $key => $val) {
			 	   load::mod_class('column/column_op', 'new')->copy_column($val[id],$lang,1);
			 	}
		}


      if($_M[form][langcontent]){
       $query="select * from {$_M[table][flash]} where (module ='metinfo' or module=',10001,') and lang ='{$_M[form][langcontent]}'";
       $flashval=DB::get_all($query);
	       foreach ($flashval as $key => $val) {
	       	$val['lang'] = $lang;
	       	unset($val['id']);
	       	$sql = get_sql($val);
	        $query = "INSERT INTO {$_M[table][flash]} SET {$sql}";
	        DB::query($query);
	        }
       }

	    if($config_lang){
	    	$query="select * from {$_M[table][config]} where lang='{$config_lang}' and columnid= 0 and flashid= 0";
	    }else{
            $query="select * from {$_M[table][config]} where lang='cn' and columnid= 0 and flashid= 0";
	    }
		$configs=DB::get_all($query);
		foreach($configs as $key=>$val){
			$val[value] = str_replace("'","''",$val[value]);
			$val[value] = str_replace("\\","\\\\",$val[value]);
			if($config_lang){
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
				$val['lang'] = $lang;
				unset($val['id']);
				$sql = get_sql($val);
				$query = "INSERT INTO {$_M['table']['ui_config']} SET {$sql}";
				DB::query($query);

				}
		}else{
				// 6.1修改复制标签模板的配置
				$skin_name = $ui['value'];
				$from_lang = $_M['form']['langui'];
				load::mod_class('ui_set/class/config_tem.class.php');
				$tem = new config_tem($skin_name, $from_lang);

				$tem->copy_tempates($skin_name,$from_lang,$lang);
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
				   $query="update {$_M[table][language]} set value='$value' where name='$name' and site='$site' and lang='$langmark'";
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

    /**
     * 复制内容到其他语言
     * @DateTime 2018-07-18
     * @param    [type]     $table     表名，不要加前缀
     * @param    [type]     $from_lang 从哪个语言复制
     * @param    [type]     $to_lang   复制到哪个语言
     */
    public function copy_lang($table,$from_lang,$to_lang)
    {
    	global $_M;
    	$query = "SELECT * FROM {$_M['table'][$table]} WHERE lang = '{$from_lang}'";
    	$from = DB::get_all($query);
    	foreach ($from as $f) {
    		$new = $f;
    		unset($new['id']);
    		$new['lang'] = $to_lang;
    		$sql = get_sql($new);
    		$query = "INSERT INTO {$_M['table'][$table]} SET {$sql}";
    		DB::query($query);
    	}
    }
}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>
