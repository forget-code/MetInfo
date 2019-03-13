<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.

defined('IN_MET') or exit('No permission');

load::sys_class('admin');
load::sys_func('file');

class language_admin extends admin {
	public $iniclass;
	function __construct() {
		global $_M;
		parent::__construct();
		$this->handle=load::mod_class('language/class/language_handle','new');
		$this->syn=load::mod_class('language/class/language_database','new');
		$this->column=load::mod_class('column/column_label', 'new');
        nav::set_nav(1,$_M[word][langwebmanage], "{$_M[url][own_form]}a=doindex");
        nav::set_nav(2, $_M[word]['langadmin'], "{$_M[url][own_form]}a=dodaminlangset");
        #nav::set_nav(3, $_M[word]['langapp'].'applang', "{$_M[url][own_form]}a=doapplangset");
        nav::set_nav(3, $_M[word][indexlang], "{$_M[url][own_form]}a=dolangset");
	}


	public function doindex() {
	 	global $_M;
        nav::select_nav(1);
        $query = "SELECT * FROM {$_M[table][lang]} order by no_order";
        $result =DB::get_all($query);
        foreach ($result as $list_config) {
        	$list_config['order']=$list_config['no_order'];
			if($list_config['lang']=='metinfo'){
				$met_langadmin[$list_config['mark']]=$list_config;
				$_M[langlist][admin][$list_config['mark']]=$list_config;
			}else{
				$met_langok[$list_config['mark']]=$list_config;
				$_M[langlist][web][$list_config['mark']]=$list_config;
			}
        }
	 	$met_index_type = DB::get_one("SELECT * FROM {$_M[table][config]} WHERE name='met_index_type' and lang='metinfo'");
	   	$met_index_type = $met_index_type['value'];
	   	$_M['url']['help_tutorials_helpid']='114';
		require $this->template('own/index');
	}

     /*语言设置*/
	 public function dolangset() {
	 	global $_M;
         nav::select_nav(3);
        if($_M['config']['met_admin_type_ok']==1)$met_admin_type_yes="checked";
		if($_M['config']['met_admin_type_ok']==0)$met_admin_type_no="checked";
		if($_M['config']['met_lang_mark']==1)$met_lang_mark_yes="checked";
		if($_M['config']['met_lang_mark']==0)$met_lang_mark_no="checked";
		if($_M['config']['met_ch_lang']==1)$met_ch_lang1="checked";
		if($_M['config']['met_ch_lang']==0)$met_ch_lang2="checked";
	    $met_langok=DB::get_all("select * from {$_M[table][lang]} where lang !='metinfo'");
	    $_M['url']['help_tutorials_helpid']='114#如何管理多语言网站';
	    require $this->template('own/langset');

	 }


      /*语言数据更新*/
	 public function doupdate(){
         global $_M;
         $query="UPDATE {$_M['table']['config']} SET value='{$_M[form]['met_admin_type_ok']}' where name='met_admin_type_ok'";
         DB::query($query);
         $query="UPDATE {$_M['table']['config']} SET value='{$_M['form']['met_lang_mark']}' where name='met_lang_mark'";
         DB::query($query);
         $query="UPDATE {$_M['table']['config']} SET value='{$_M['form']['met_ch_lang']}' where name='met_ch_lang'";\
         DB::query($query);
         turnover("{$_M[url][own_form]}a=dolangset",$_M[word][savesuccess]);
	 }

    /*语言编辑*/
	  public function dolangeditor(){
         global $_M;
         nav::select_nav(1);
         $query = "SELECT * FROM {$_M[table][lang]} order by no_order";
         $result =DB::query($query);
         while($list_config=DB::fetch_array($result)){
	           $list_config['order']=$list_config['no_order'];
			if($list_config['lang']=='metinfo'){
				$met_langadmin[$list_config['mark']]=$list_config;
				$_M[langlist][admin][$list_config['mark']]=$list_config;
			}else{
				$met_langok[$list_config['mark']]=$list_config;
				$_M[langlist][web][$list_config['mark']]=$list_config;
			}
        }
                $met_index_type = DB::get_one("SELECT * FROM {$_M[table][config]} WHERE name='met_index_type' and lang='metinfo'");
			   	$met_index_type = $met_index_type['value'];
        $_M['url']['help_tutorials_helpid']='114#点击网站语言—新增多语言';
        require $this->template('own/langeditor');

	}

     /*语言删除*/
	 public function dolangdelete(){
	 	    global $_M;
			$langeditor = $_M['form']['langeditor'];
			if($langeditor == $_M['form']['lang']){
				turnover("{$_M['url']['own_form']}a=doindex",$_M['word']['langadderr2']);
			}
			if($langeditor==$_M['config']['met_index_type']){
				turnover("{$_M['url']['own_form']}a=doindex",$_M['word']['langadderr5']);
			}
            $tables= DB::get_all('show tables');
            foreach ($tables as $key => $value) {
            	 foreach ($value as $key => $tablename) {
            	 	$fields=DB::get_all("desc ".$tablename);
            	 	foreach ($fields as $key => $val) {
            	 		if($val[Field]=='lang'){
                           $query="delete from $tablename where lang ='$langeditor'" ;
                           if(strstr($tablename,'language')){
            	 		   	$query.=" and site ='0'";
            	 		   }
                           DB::query($query);
            	 		}
            	 	}
            	 }
            }
			$query = "SELECT * FROM {$_M[table][lang]} order by no_order where lang!='metinfo'";
            $result =DB::get_all($query);
			if(count($result)==1)turnover("{$_M[url][own_form]}a=doindex",$_M[word][langone]);

			$query = "select * from {$_M[table][column]} where lang='$langeditor'";
			$result = DB::query($query);
			while($list = DB::fetch_array($result)){
				$this->handle->delcolumn($list);
			}
			turnover("{$_M[url][own_form]}a=doindex",$_M[word][physicaldelok]);
	 }


    /*语言添加*/
    public function dolangadd(){
  	    global $_M;
        nav::select_nav(1);
	    $query = "SELECT * FROM {$_M[table][lang]} order by no_order";
        $result =DB::query($query);
        while($list_config=DB::fetch_array($result)){
	          $list_config['order']=$list_config['no_order'];
			if($list_config['lang']=='metinfo'){
				$met_langadmin[$list_config['mark']]=$list_config;
				$_M[langlist][admin][$list_config['mark']]=$list_config;
			}else{
				$met_langok[$list_config['mark']]=$list_config;
				$_M[langlist][web][$list_config['mark']]=$list_config;
			}
        }
                $met_index_type = DB::get_one("SELECT * FROM {$_M[table][config]} WHERE name='met_index_type' and lang='metinfo'");
			 	$met_index_type = $met_index_type['value'];
			 	$_M['url']['help_tutorials_helpid']='114#点击网站语言—新增多语言';
  	       require $this->template('own/langadd');
    }

   /*语言参数编辑*/
    public function doparaeditor(){
      global $_M;
      nav::select_nav(1);
      $langeditor=$_M[form][langeditor];
      $query="select * from {$_M[table][language]} where site='0' and app='0' and lang='{$langeditor}' ORDER BY no_order";
	  $result=DB::query($query);
	  while($list= DB::fetch_array($result)){
		$list['value']=str_replace('"', '&#34;', str_replace("'", '&#39;',$list['value']));
		$langtext_b[]=$list;
		$langtext[$list['array']][]=$list;
		$langtext_a[$list['name']]=$list;
	    }
	    $_M['url']['help_tutorials_helpid']='114#点击网站语言—新增多语言';
          require $this->template('own/paraeditor');
  }


	public function domodify(){
        global $_M;
        $langeditor=$_M[form][langeditor];
        $query="select * from {$_M[table][language]} where site='0' and app='0' and lang='{$langeditor}' ORDER BY no_order";
		$result=DB::query($query);
		while($list= DB::fetch_array($result)){
			$list['value']=str_replace('"', '&#34;', str_replace("'", '&#39;',$list['value']));
			$langtext_b[]=$list;
			$langtext[$list['array']][]=$list;
			$langtext_a[$list['name']]=$list;
		}
       !defined('MAGIC_QUOTES_GPC') && define('MAGIC_QUOTES_GPC', get_magic_quotes_gpc());
	   foreach($langtext_b as $key=>$val){
		$name=$val['name'].'_metinfo';
		$metino_name=$_M['form'][$name];
		if(isset($metino_name)&&$val['value']!=$metino_name){
			$metino_name = stripslashes($metino_name);
			$metino_name = str_replace("'","''",$metino_name);
			$metino_name = str_replace("\\","\\\\",$metino_name);
			$query="update {$_M[table][language]} set value='$metino_name' where id='$val[id]'";
			DB::query($query);
		}
	}

		$file=file_exists(PATH_WEB.'cache/lang_'.$langeditor.'.php');
		if(unlink(PATH_WEB.'cache/lang_'.$langeditor.'.php')||!$file){
			$relang=$_M[word][jsok];
			$relang.=$met_webhtm==0?'':$_M[word][otherinfocache1];
			turnover("{$_M[url][own_form]}a=doparaeditor&langeditor={$langeditor}",$relang,$depth);
		}else{
			turnover("{$_M[url][own_form]}a=doparaeditor&langeditor={$langeditor}",$_M[word][otherinfocache2],$depth);
	    }

}
    /*编辑保存*/
    public function dosave(){
    	 global $_M;
    	 $langname=$_M['form']['langname'];
		 $languseok=$_M['form']['languseok'];
		 $langorder=$_M['form']['langorder'];
		 $langmark=$_M['form']['langmark'];
		 $langflag=$_M['form']['langflag'];
		 $langlink= $_M['form']['langlink'] ? trim($_M['form']['langlink'],'/').'/' : '';
		 $langnewwindows=$_M['form']['langnewwindows'];
		 $langautor=$_M['form']['langautor'];
		 $langfile=$_M['form']['langfile'];
		 $langdlok=$_M['form']['langdlok'];
		 $langeditor=$_M['form']['langeditor'];
		 $met_index_type1=$_M['form']['met_index_type1'];
		 $query = "SELECT * FROM {$_M[table][lang]} order by no_order";
         $result =DB::query($query);
         while($list_config=DB::fetch_array($result)){
			if($list_config['lang']!='metinfo'){
				$met_langok[$list_config['mark']]=$list_config;
			}
        }
    	 if($langname=='')turnover("{$_M[url][own_form]}a=doindex",$_M[word][langnamenull]);
			$met_langok[$langmark]=array(
									'name'	=>$langname,
									'useok'	=>$languseok,
									'order'	=>$langorder,
									'mark'	=>$langmark,
									'flag'	=>$langflag,
									'link'	=>$langlink,
									'newwindows'=>$langnewwindows);
			$i=0;
			$useoknow=0;
			foreach($met_langok as $key=>$val){
				$i++;
				if($val['mark']!=$langmark && $val['order'] == $langorder)turnover("{$_M[url][own_form]}a=doindex",$_M[word][langnameorder]);
				if($val['useok']==1)$useoknow++;
			}
			if($useoknow==0&&$languseok==0)turnover("{$_M[url][own_form]}a=doindex",$_M[word][langclose1]);
			if($met_index_type==$langmark&&$languseok==0)turnover("{$_M[url][own_form]}a=doindex",$_M[word][langclose2]);
			$query = "update {$_M[table][lang]} SET
				name          = '$langname',
				useok         = '$languseok',
				no_order      = '$langorder',
				mark          = '$langmark',
				flag          = '$langflag',
				link          = '$langlink',
				newwindows    = '$langnewwindows'
			    where lang='$langmark'";
			 DB::query($query);
			 if($met_index_type1){
				if($languseok){
					$met_index_type=$langmark;
					$query = "update {$_M[table][config]} set value = '{$_M[form][langmark]}' where name='met_index_type'";
					DB::query($query);
					$query = "SELECT * FROM {$_M[table][config]} WHERE lang='{$_M[form][lang]}' or lang='metinfo'";
					$result = DB::query($query);
					while($list_config= DB::fetch_array($result)){
						$settings_arr[]=$list_config;
						$_M[config][$list_config['name']]=$list_config['value'];
						if($metinfoadminok)$list_config['value']=str_replace('"', '&#34;', str_replace("'", '&#39;',$list_config['value']));
					}
                        $columnid=$columnid?$columnid:0;
						!defined('MAGIC_QUOTES_GPC') && define('MAGIC_QUOTES_GPC', get_magic_quotes_gpc());

						foreach($settings_arr as $key=>$val){
							if($val['columnid']==$columnid){
								$name = $val['name'];
								$newvalue1 = stripslashes($_M[config][$name]);
								$newvalue1 = str_replace("'","''",$newvalue1);
								$newvalue = str_replace("\\","\\\\",$newvalue1);
								if($val['value']!=$newvalue1){
									$query1 = $columnid?"and columnid='$columnid'":'';
									$query = "update {$_M[table][config]} SET value = '$newvalue' where id ='$val[id]' $query1";
									DB::query($query);
								}
							}
						}
				}else{
					$retxt=$_M[word][jsok].$_M[word][langexplain12];
				}
			}
			unlink(PATH_WEB.'cache/lang_json_'.$_M[form][lang].'.php');
			turnover("{$_M[url][own_form]}a=doindex",$_M[word][success]);
    }

    /*同步系统语言数据*/
    public function dosys(){
        global $_M;
        $langeditor=$_M['form']['langeditor'];
        $newlangtype=$_M['form']['langsite'];
        $back = $_M['form']['langsite'] == 'web' ? 'doindex' : 'dodaminlangset';
        $post=array('newlangmark'=>$langeditor,'metcms_v'=>$_M['config']['metcms_v'],'newlangtype'=>$newlangtype);
        $site=$newlangtype=='admin'?1:0;
        $file_basicname=PATH_WEB.$_M['config']['met_adminfile'].'/update/lang/lang_'.$newlangtype.'_'.$langeditor.'.ini';
        $re=$this->syn->syn_lang($post,$file_basicname,$langeditor,$site,0);
        $this->clear_lang_cache();
        if($re==1){
            turnover("{$_M[url][own_form]}a={$back}",$_M[word][success]);
        }else{
            turnover("{$_M[url][own_form]}a={$back}",$_M[word][langadderr4]);
        }

    }


	/*国旗标志*/
	public function doflag(){
		 global $_M;
		 $dir=PATH_WEB.'/app/system/language/admin/templates/images/flag';
	     $handle = opendir($dir);
	     $url=$_M[url][own_tem].'/images/flag';
	     while(false !== $file=(readdir($handle))){
	        if($file !== '.' && $file != '..'){
			    $flags[] = $file;
			}
		}
	    closedir($handle);
		$k=count($flags);
		for($i=0;$i<$k;$i++){
		    $data.='<img src="'.$url.'/'.$flags[$i].'" />';
		}
	    echo $data;
	}

	/*语言数据保存*/
	public function dolangsave(){
		global $_M;
		$langname=$_M['form']['langname'];
		$languseok=$_M['form']['languseok'];
		$langorder=$_M['form']['langorder'];
		$langmark=$_M['form']['langmark'];
		$langflag=$_M['form']['langflag'];
		$langlink=$_M['form']['langlink'];
		$langnewwindows=$_M['form']['langnewwindows'];
		$langautor=$_M['form']['langautor'];
		$langfile=$_M['form']['langfile'];
		$langdlok=$_M['form']['langdlok'];
		$langeditor=$_M['form']['langeditor'];
		$met_index_type1=$_M['form']['met_index_type1'];
        $query = "SELECT * FROM {$_M[table][lang]} order by no_order";
        $result =DB::query($query);
        while($list_config=DB::fetch_array($result)){
	          $list_config['order']=$list_config['no_order'];
			if($list_config['lang']=='metinfo'){
				$met_langadmin[$list_config['mark']]=$list_config;
				$_M[langlist][admin][$list_config['mark']]=$list_config;
			}else{
				$met_langok[$list_config['mark']]=$list_config;
				$_M[langlist][web][$list_config['mark']]=$list_config;
			}
        }
			 	$met_index_type = DB::get_one("SELECT * FROM {$_M[table][config]} WHERE name='met_index_type' and lang='metinfo'");
			   	$met_index_type = $met_index_type['value'];
	            if($langname=='')okinfo('-1',$_M[word][langnamenull],$depth);
				if($langautor!='')$langmark=$langautor;
				if($langautor!=''){
					$synchronous=$langautor;
					$lang=$langautor;
				}else{
					$synchronous=$langfile;
					$lang=$langmark;
				}
				if(!$langdlok)$synchronous=$langfile;
				$lancount=count($met_langok);
				$isaddlang=1;
				$langoflag=trim($langflag);
				$met_langok[0]=array(
								'name'		=>$langname,
								'useok'		=>$languseok,
								'order'		=>$langorder,
								'mark'		=>$langmark,
								'flag'		=>$langoflag,
								'link'		=>$langlink,
								'newwindows'=>$langnewwindows);

				foreach($met_langok as $key=>$val){
					if($key){
						if($langmark==$val['mark'])okinfo('-1',$_M[word][langnamerepeat],$depth);
						if($val['order'] == $langorder)okinfo('-1',$_M[word][langnameorder],$depth);
					}
				}
				$met_webhtm =$met_langok[$langfile]['met_webhtm'];
				$met_htmtype=$met_langok[$langfile]['met_htmtype'];
				$met_weburl =$met_langok[$langfile]['met_weburl'];

				$re=$this->syn->copyconfig();
				if($re!=1){
					$langdlok=0;
					$langfile=$met_index_type;
					$this->syn->copyconfig();
					$retxt=$_M[word][jsok].'<br/>'.$_M[word][langadderr6];
				}
				if($_M[form][langui]){
				$query="select * from {$_M[table][config]} where name ='met_skin_user' and lang ='{$_M[form][langui]}'";
				 $met_skin_user=DB::get_one($query);
                 $query="update {$_M[table][config]} set value='$met_skin_user[value]' where name ='met_skin_user' and lang ='$lang'";
				 DB::query($query);
				}else{
					$query="update {$_M[table][config]} set value='' where name ='met_skin_user' and lang ='$lang'";
				 	DB::query($query);
				}
				$query = "INSERT INTO {$_M['table']['lang']} SET
					name          = '$langname',
					useok         = '$languseok',
					no_order      = '$langorder',
					mark          = '$langmark',
					synchronous   = '$synchronous',
					flag          = '$langflag',
					link          = '$langlink',
					newwindows    = '$langnewwindows',
					met_webhtm    = '$met_webhtm',
					met_htmtype   = '$met_htmtype',
					met_weburl    = '$met_weburl',
					lang          = '$langmark'
				";
                DB::query($query);
                if($_M[form][langconfig]){
                	$query="select * from {$_M[table][user_group]} where lang='{$_M[form][langconfig]}'";
                	$adminlist=DB::get_all($query);
                    foreach ($adminlist as $key => $value) {
	                	$query="INSERT INTO {$_M[table][user_group]} set name='$value[name]',access='$value[access]',lang='$langautor'";
					    DB::query($query);
                    }

                    $query = "SELECT * FROM {$_M['table']['app_config']} WHERE lang = {$_M['form']['langconfig']}";
                    $app_config = DB::get_all($query);
                    foreach ($app_config as $c) {
                    	$new_app_config = $c;
                    	$new_app_config['lang'] = $langmark;
                    	unset($new_app_config['id']);
                    	$sql = get_sql($new_app_config);
                    	$query = "INSERT INTO {$_M['table']['app_config']} SET {$sql}";
                    	DB::query($query);
                    }

                }

				if($met_index_type1){
					if($languseok){
						$met_index_type=$langmark ? $langmark : $langautor;

						$query = "update {$_M[table][config]} set value = '{$met_index_type}' where name='met_index_type'";
					    DB::query($query);
					}else{
						$retxt=$retxt?$retxt.'<br/>'.$_M[word][langexplain12]:$_M[word][jsok].$_M[word][langexplain12];
					}
				}
				unlink(PATH_WEB.'cache/lang_json_'.$langeditor.'.php');
				turnover("{$_M[url][own_form]}a=doindex",$_M[word][success]);

	    }

    /*批量更新语言数据*/
    public function domengenedit() {
        global $_M;
        $navno = $_M['form']['langsite'] == 'web' ? 1 : 2;
        $site = $_M['form']['langsite'];
        $appno = $_M['form']['appno'];
        $appname = urldecode($_M['form']['appname']);
        nav::select_nav($navno);
        require_once $this->template('own/mengenedit');
    }


 /*更新语言数据*/
public function doupdatelang(){
    global $_M;
    //$languagelist=explode('\\\\',str_replace("\r\n","",$_M['form']['langupdate']));
    $_M['form']['langupdate'] = preg_replace("/\'/", "''", $_M['form']['langupdate']);
    $languagelist=explode(PHP_EOL,$_M['form']['langupdate']);
    $site = $_M['form']['langsite'] == 'admin' ? '1' : '0';
    $appno = $_M['form']['appno'] ? $_M['form']['appno'] : '';
    $sql = $appno ? " AND app = {$appno} " : '';
    $insert_sql = $appno ? " , app = {$appno} " : '';

    foreach ($languagelist as $key => $value) {
        $languagedata=explode('=',$value);
        $query="select * from {$_M[table][language]} where name='{$languagedata[0]}' and lang='{$_M[form][langeditor]}' and site ='{$site}' {$sql}";
        if(DB::get_one($query)){
            $query="update {$_M[table][language]} set value='{$languagedata[1]}' where name='{$languagedata[0]}' and lang='{$_M[form][langeditor]}' and site ='{$site}' {$sql}";
        }else{
            $query="insert into {$_M[table][language]} set value='{$languagedata[1]}',site='{$site}',name='{$languagedata[0]}',lang='{$_M[form][langeditor]}' {$insert_sql}";
        }
        DB::query($query);
    }
    turnover("{$_M[url][own_form]}a=doindex",$_M[word][success]);
}


   /*获取后台语言包*/
   public function doget_adminlangpack(){
       global $_M;
       $appno = $_M['form']['appno'] ? $_M['form']['appno'] : '';
       $sql = $appno ? "AND app = {$appno}" : '';

       if ($_M['form']['langsite']=='admin') {
           $query="SELECT * FROM {$_M[table][language]} WHERE lang='{$_M[form][langeditor]}' AND site ='1' $sql";
           $res=DB::get_all($query);
           $langpackurl=PATH_WEB.'cache/language_admin_'.$_M[form][langeditor].'.ini';
       }else if($_M['form']['langsite']=='web'){
           $query="SELECT * FROM {$_M[table][language]} WHERE lang='{$_M[form][langeditor]}' AND site ='0' $sql";
           $res=DB::get_all($query);
           $langpackurl=PATH_WEB.'cache/language_web_'.$_M[form][langeditor].'.ini';
       }
       if(file_exists($langpackurl)){
           chmod($langpackurl,0777);
           unlink($langpackurl);
       }
       foreach ($res as $key => $val) {

           file_put_contents($langpackurl, $val[name].'='.$val[value].PHP_EOL,FILE_APPEND);

       }
    }
  /*导出语言包*/
   public function doexportpack(){
       global $_M;
       $this->doget_adminlangpack();
       $subname = $_M['form']['appno']?"app_".$_M['form']['appno'].'_':'';
       $site = $_M['form']['langsite'] ? $_M['form']['langsite'] : 'web';
       $filename=PATH_WEB.'cache/language_'.$site.'_'.$_M[form][langeditor].'.ini';
       $filename=realpath($filename); //文件名
       Header( "Content-type:  application/octet-stream ");
       Header( "Accept-Ranges:  bytes ");
       Header( "Accept-Length: " .filesize($filename));
       header( "Content-Disposition:  attachment;  filename=language_{$site}_".$subname.$_M[form][langeditor].".ini");
       // echo file_get_contents($filename);
       readfile($filename);
   }

    /**
     * 后台多语言管理
     */
    public function dodaminlangset(){
        global $_M;
        nav::select_nav(2);
        require $this->template('own/adminlangset');
    }

    public function doadmin_lang_list(){
        global $_M;

        $table = load::sys_class('tabledata', 'new');
        $order = "no_order ASC";
        $where = "lang != 'metinfo'";
        $langlist = $table->getdata($_M['table']['lang_admin'], '*', $where, $order);

        foreach($langlist as $key=>$val){
            if(!$val['login_time'])$val['login_time'] = $val['register_time'];
            $valid = $val['valid']?$_M[word][memberChecked]:$_M[word][memberUnChecked];
            $list = array();
            $list[] = $val['no_order'];
            $list[] = $val['name'];
            $list[] = $val['useok'] == 1 ? $_M['word']['yes']:$_M['word']['no'];
            $list[] = $val['moren']= $_M['config']['met_admin_type']==$val['mark']?$_M['word']['yes']:$_M['word']['no'];
            $operate = "<a href=\"{$_M['url']['own_form']}a=doadminlangeditor&langeditor={$val['lang']}\" title=\"{$_M['word']['editor']}\">{$_M['word']['editor']}</a>
			&nbsp;
			<a href=\"{$_M['url']['own_form']}a=doadminlangdelete&langeditor={$val['lang']}\" onClick=\"return linkSmit($(this),1,'{$_M['word']['delete_information']}');\" title=\"{$_M['word']['delete']}\">{$_M['word']['delete']}</a>
			&nbsp;
			<a href=\"{$_M['url']['own_form']}a=doexportpack&langsite=admin&langeditor={$val['lang']}\" title=\"{$_M['word']['delete']}\">{$_M['word']['language_outputlang_v6']}</a>
			&nbsp;
			<a href=\"{$_M['url']['own_form']}a=domengenedit&langsite=admin&langeditor={$val['lang']}\" title=\"{$_M['word']['language_batchreplace_v6']}\">{$_M['word']['language_batchreplace_v6']}</a>
			&nbsp;
			<a href=\"{$_M[url][own_form]}a=dopadminaraeditor&langsite=admin&langeditor={$val['lang']}\" title=\"{$_M[word][langwebeditor]}\" style=\"margin - bottom:5px;\">{$_M['word']['langwebeditor']}</a>
            &nbsp;
			";
            if ($val['mark'] == 'cn' || $val['mark'] == 'en') {
                $operate .= "<a href=\"{$_M['url']['own_form']}a=dosys&langsite=admin&langeditor={$val[lang]}\" title=\"\" onclick=\"return syn('$val[synchronous]');\">{$_M[word][unitytxt_9]}</a>";
            }
            $list[] = $operate;
            $list[] = "<a href=\"{$_M[url][own_form]}a=doapplangset&langsite=admin&langeditor={$val['lang']}\" title=\"{$_M[word][langwebeditor]}\" style=\"margin-bottom:5px;\">{$_M['word']['edit_app_lang']}</a>";

            $rarray[] = $list;
        }

        $table->rdata($rarray);
    }

    public function doadminlangadd(){
        global $_M;
        nav::select_nav(2);
        $met_langok=DB::get_all("select * from {$_M['table']['lang_admin']} where lang !='metinfo'");
        //$arr = array_column($met_langok, 'no_order');
        $arr = array();
        foreach ($met_langok as $val) {
            $arr[] = $val['no_order'];
        }
        $new_no_order = max($arr)+1;
        require $this->template('own/amdinlangadd');
    }

    /**
     * 保存后台语言配置
     */
    public function doadminlangsave(){
        global $_M;

        $query="select * from {$_M['table']['lang_admin']} where mark = '{$_M['form']['langmark']}' OR lang = '{$_M['form']['langmark']}'";
        if (DB::get_one($query)) {
            turnover("{$_M[url][own_form]}a=doadminlangadd",$_M['word']['langexisted']);
            die();
        };

        //复制本地后台语言
        if($_M['form']['langdlok'] == 0){
            $query = "SELECT * FROM {$_M['table']['language']} WHERE `lang`='{$_M['form']['ftype_select']}' AND `site`=1 AND `app`=0";
            $langlist = DB::get_all($query);
            foreach ($langlist as $value) {
                $query="select * from {$_M['table']['language']} where name='{$value['name']}' and lang='{$_M['form']['langmark']}' and site ='1'";
                $result=DB::get_one($query);
                if($result){
                    $query="update {$_M['table']['language']} set value='{$value['value']}' where name='{$value['name']}' and lang='{$_M['form']['langmark']}' and site ='1'";
                }else{
                    $query="insert into {$_M['table']['language']} set value='{$value['value']}',site='1',name='{$value['name']}',no_order='0',array='{$value['array']}',app='{$value['app']}',lang='{$_M['form']['langmark']}'";
                }
                DB::query($query);
            }
        }else{
            //在线复制语言
            $newlangtype = "admin";
            $site = 1;
            $post=array('newlangmark'=>$_M['form']['langmark'],'metcms_v'=>$_M['config']['metcms_v'],'newlangtype'=>$newlangtype);
            $file_basicname=PATH_WEB.$_M['config']['met_adminfile'].'/update/lang/lang_'.$newlangtype.'_'.$_M['form']['langmark'].'.ini';
            $res=$this->syn->syn_lang($post,$file_basicname,$_M['form']['langmark'],$site,0);
            if($res != 1){
                turnover("{$_M[url][own_form]}a=doadminlangadd",$_M[word][langadderr4]);
            }
        }

        //添加后台语言
        $query="insert into {$_M['table']['lang_admin']} set `name`='{$_M['form']['langname']}',`useok`='{$_M['form']['languseok']}',`mark`='{$_M['form']['langmark']}',`no_order`='{$_M['form']['order']}',`synchronous`='{$_M['form']['langmark']}',`lang`='{$_M['form']['langmark']}'";
        DB::query($query);

        //默认语言
        if ($_M['form']['met_admin_type'] == 1 && $_M['form']['langmark']) {
            $query="update {$_M['table']['config']} set value = '{$_M['form']['langmark']}' where name ='met_admin_type'";
            DB::query($query);
        }else{
            $query="update {$_M['table']['config']} set value = 'cn' where name ='met_admin_type'";
            DB::query($query);
        }

        $this->clear_lang_cache();
        turnover("{$_M[url][own_form]}a=dodaminlangset", $_M['word']['success']);
    }

    public function dopadminaraeditor(){
        global $_M;
        nav::select_nav(2);
        require $this->template('own/langparaeditor');
    }

    public function dosearchadmin(){
        global $_M;
        if(!$_M['form']['word']){
            echo json_encode(array('msg'=>'empty'));
            die();
        }
        $query = "SELECT * FROM {$_M['table']['language']} WHERE `value` like '%{$_M['form']['word']}%' AND `app`=0 AND `site`=1 AND `lang`='{$_M['form']['langeditor']}'";
        $res = DB::get_all($query);
        $langlist = array();
        foreach ($res as $val){
            $langlist[$val['name']]  = $val['value'];
        }
        echo json_encode(array('msg'=>'showlist','langlist'=>$langlist));
        die();
    }

    /**
     * 修改后台语言文字
     */
    public function domodifyadmin(){
        global $_M;
        foreach ($_M['form'] as $name=>$val){
            if(strstr($name, 'change_')){
                $name = str_replace('change_', '', $name);
                $query = "SELECT * FROM {$_M['table']['language']} WHERE `name`='{$name}' AND `app`=0 AND `site`=1 AND `lang`='{$_M['form']['langeditor']}'";
                $row = DB::get_one($query);
                if ($row['value'] != $val) {
                    $query="update {$_M['table']['language']} set value='{$val}' where name='{$name}'  AND `site` ='1' and lang='{$_M['form']['langeditor']}'";
                    DB::query($query);
                }
            }
        }
        $this->clear_lang_cache();
        turnover("{$_M[url][own_form]}a=dodaminlangset", $_M['word']['success']);
    }

    public function doadminlangdelete(){
        global $_M;
        if($_M['form']['langeditor'] == $_M['config']['met_admin_type']){
        	turnover("{$_M[url][own_form]}a=dodaminlangset&", $_M['word']['langadderr5']);
        }

            //删除后台语言
        $query = "DELETE FROM {$_M['table']['lang_admin']} WHERE lang='{$_M['form']['langeditor']}';";
        DB::query($query);
        $query = "DELETE FROM {$_M['table']['language']} WHERE lang='{$_M['form']['langeditor']}' AND site = 1 AND app = 0;";
        DB::query($query);
        turnover("{$_M[url][own_form]}a=dodaminlangset", $_M['word']['physicaldelok']);
    }

    public function doadminlangeditor(){
        global $_M;
        nav::select_nav(2);
        $edlang = DB::get_one("select * from {$_M['table']['lang_admin']} where lang ='{$_M['form']['langeditor']}'");
        $default = $_M['config']['met_admin_type'] == $edlang['mark'] ? 1 : 0;
        require $this->template('own/adminlangeditor');
    }

    public function doadminlangeditorsave(){
        global $_M;

        //修改后台语言设置
        $query = "SELECT * FROM {$_M['table']['lang_admin']} WHERE (`name`='{$_M['form']['langname']}' OR `no_order`='{$_M['form']['order']}') AND lang != '{$_M['form']['langeditor']}'";
        if (DB::get_one($query)) {
            turnover("{$_M[url][own_form]}a=dodaminlangset&", $_M['word']['loginFail']);
        }
        $query="update {$_M['table']['lang_admin']} set `name`='{$_M['form']['langname']}',`useok`='{$_M['form']['languseok']}',`no_order`='{$_M['form']['order']}' WHERE lang = '{$_M['form']['langeditor']}'";
        DB::query($query);

        //默认语言
        if ($_M['form']['met_admin_type'] == 1 && $_M['form']['langeditor']) {
            $query="update {$_M['table']['config']} set value = '{$_M['form']['langeditor']}' where name ='met_admin_type'";
            DB::query($query);
        }else{
            $query="update {$_M['table']['config']} set value = 'cn' where name ='met_admin_type'";
            DB::query($query);
        }
        turnover("{$_M[url][own_form]}a=dodaminlangset&", $_M['word']['opfailed']);
    }


    //修改应用语言
    public function doapplangset()
    {
        global $_M;
        $site = $_M['form']['langsite'] ? 1 : 0;
        $langeditor = $_M['form']['langeditor'];
        if ($site) {
            nav::select_nav(2);
        }else{
            nav::select_nav(1);
        }
        require $this->template('own/applangset');
    }

    public function dogetapplist()
    {
        global $_M;
        $site = $_M['form']['langsite'] ? 1 : 0;
        $langsitestr = $_M['form']['langsite'] ? 'admin' : 'web';
        $langeditor = $_M['form']['langeditor'];

        $table = load::sys_class('tabledata', 'new');
        $where = "`no` > 0 AND `mlangok`=1 ";
        $order = "id";
        $applist = $table->getdata($_M['table']['applist'], '*', $where ,$order);

        foreach($applist as $key=>$val){
            $appname = urlencode($val['appname']);
            $list = array();
            #$list[] = $val['no'];
            $list[] = $val['appname'].' / ' .$val['no'];
            $list[] = "
			<a href=\"{$_M['url']['own_form']}a=doexportpack&langsite={$langsitestr}&langeditor={$langeditor}&appno={$val['no']}&appname={$appname}\" title=\"{$_M['word']['delete']}\">{$_M['word']['language_outputlang_v6']}</a>
			&nbsp;
			<a href=\"{$_M['url']['own_form']}a=domengenedit&langsite={$langsitestr}&langeditor={$langeditor}&appno={$val['no']}&appname={$appname}\" title=\"{$_M['word']['language_batchreplace_v6']}\">{$_M['word']['language_batchreplace_v6']}</a>
			&nbsp;
			<a href=\"{$_M[url][own_form]}a=dopapparaeditor&langsite={$site}&langeditor={$langeditor}&appno={$val['no']}&appname={$appname}\" title=\"{$_M[word][langwebeditor]}\" style=\"margin - bottom:5px;\">{$_M['word']['langwebeditor']}</a>";
            $rarray[] = $list;
        }
        $table->rdata($rarray);
    }

    public function dopapparaeditor(){
        global $_M;
        $site = $_M['form']['langsite'] ? 1 : 0;
        $appno = $_M['form']['appno'];
        $langeditor = $_M['form']['langeditor'];
        $appname = urldecode($_M['form']['appname']);
        if ($site) {
            nav::select_nav(2);
        }else{
            nav::select_nav(1);
        }
        require $this->template('own/langappditor');
    }

    public function dosearchapp (){
        global $_M;
        if(!$_M['form']['word']){
            echo json_encode(array('msg'=>'empty'));
            die();
        }
        $site = $_M['form']['langsite'] ? 1 : 0;
        $appno = $_M['form']['appno'];
        $langeditor = $_M['form']['langeditor'];
        $word = $_M['form']['word'];

        $query = "SELECT * FROM {$_M['table']['language']} WHERE `value` like '%{$word}%' AND `app`={$appno} AND `site`='{$site}' AND `lang`='{$langeditor}'";
        $res = DB::get_all($query);
        $langlist = array();
        foreach ($res as $val){
            $langlist[$val['name']]  = $val['value'];
        }
        echo json_encode(array('msg'=>'showlist','langlist'=>$langlist));
        die();
    }

    public function domodifyapp()
    {
        global $_M;
        $site = $_M['form']['langsite'] ? 1 : 0;
        $appno = $_M['form']['appno'];
        $langeditor = $_M['form']['langeditor'];

        foreach ($_M['form'] as $name=>$val){
            if(strstr($name, 'change_')){
                $name = str_replace('change_', '', $name);
                $query = "SELECT * FROM {$_M['table']['language']} WHERE `name`='{$name}' AND `app`='{$appno}' AND `site`='{$site}' AND `lang`='{$langeditor}'";
                $row = DB::get_one($query);
                if ($row['value'] != $val) {
                    $query="update {$_M['table']['language']} set value='{$val}' where name='{$name}' and site ='{$site}' and app ='{$appno}' and lang='{$langeditor}'";
                    DB::query($query);
                }
            }
        }
        $this->clear_lang_cache();
        turnover("{$_M[url][own_form]}a=doapplangset&lang={$_M['lang']}&langsite={$site}&langeditor={$langeditor}", $_M['word']['success']);
    }

    /**
     * 清除语言缓存
     */
    public function clear_lang_cache(){
        global $_M;
        if(file_exists(PATH_WEB.'cache')){
            $files = scandir(PATH_WEB . 'cache');
            foreach ($files as $val) {
                if (strstr($val,"lang")) {
                    delfile(PATH_WEB . 'cache/' . $val);
                }
            }
        }
    }


    /**
     * 生成安装语言包  app  site  elang  type
     */
    public function dotool(){
        global $_M;
        die();
        $site = $_M['form']['site'] ? $_M['form']['site'] : 0;
        $sitename = $_M['form']['site'] ? 'admin' : 'web';

        $appno = $_M['form']['app'] ? $_M['form']['app'] : 0;

        $lang = $_M['form']['elang'];

        $type = $_M['form']['type']=="sql" ? "sql" : "json";

        $query = "SELECT `name`,`value`,`site`,`array`,`app`,`lang` FROM {$_M['table']['language']} WHERE lang='{$lang}' AND app='{$appno}' AND site='{$site}' ORDER BY id ";
        $langlsit = DB::get_all($query);


        if ($type == 'json') {
            $langlsit = json_encode($langlsit, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
            file_put_contents(__DIR__."/lang_{$sitename}_{$appno}_{$lang}.json",$langlsit);
        }

        if ($type == 'sql') {
            $langstr = "";
            foreach ($langlsit as $value) {
                $value['value'] = addslashes($value['value']);
                $langstr .= "INSERT INTO {$_M['table']['language']} VALUES (null, '{$value['name']}', \"{$value['value']}\", {$value['site']}, '{$value['no_order']}', {$value['array']}, {$value['app']}, '{$value['lang']}'); \n";
            }
            file_put_contents(__DIR__ . "/_lang_{$sitename}_{$lang}.sql",$langstr);
        }

        dump("complete $type");
    }

}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>