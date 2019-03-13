<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.

defined('IN_MET') or exit('No permission');

class ui_compile
{
    /**
     * 当前模板根目录
     */
	public $tem_path;

    /**
     * UI管理工具的ui文件夹目录
     */

    public $cache_path;

	public $ui_path;

    /**
     * 需要可视化的字段
     */
    public $fields = array('name','value','title','keywords','description','content','valueinfo','defaultvalue','imgurl','uip_default','uip_value','img_path','columnimg','icon','imgurls','info','content1','content2','content3','content4','position','img_title','img_des','namemark','weblogo');
    /**
     * 需要可视化的表
     */
    public $tables = array('news','column','product','img','job','templates','ui_config','config','flash','column','language','download','parameter','plist','link');

    // 返回信息
    public $response = array('status'=>0);

    public $template_type = 'ui';
    public function __construct(){
        global $_M;
        $this->tem_path = PATH_WEB.'templates/'.$_M['config']['met_skin_user'].'/';
        $this->ui_path  = PATH_ALL_APP."met_ui/admin/ui/";
        $this->skin_name = $_M['config']['met_skin_user'];
        $this->cache_path = PATH_WEB.'cache/templates';
        if(!file_exists($this->cache_path)){
            mkdir($this->cache_path,0777,true);
        }
        $inc = $this->tem_path.'metinfo.inc.php';
        if(file_exists($inc)){
            require $inc;
            $this->template_type = $template_type;
        }

    }

    /**
     * 解析页面
     * @DateTime 2017-12-20
     * @param    string     $page 当前页面
     * @return   null
     */
    public function parse_page($page = ''){
    	global $_M;
    	if($page == ''){
    		return false;
    	}

        if(!$_M['form']['pageset'] && file_exists($this->tem_path.'cache/'.$page.'.css')){
            return false;
        }
    	$temp_page = $this->tem_path . $page.'.php';
    	$ignore = array('404','metinfo.inc');

    	if(in_array($page,$ignore)){
    		return false;
    	}

    	if(!is_file($temp_page)){
    		return false;
    	}

        // 得到模板文件内容
    	$content = file_get_contents($temp_page);

        //提取当前页面使用到的UI
    	preg_match_all("/<ui\s+name=\"(.*)\"\s+style=\"(.*)\"\s+id=\"(\d+)\"\s+?\/>/", $content, $match);

    	if(strpos($content, 'head.php')!==false && strpos($content, 'foot.php')!==false){
            $head_match = self::parse_page('head');
            $foot_match = self::parse_page('foot');

            $all = array();
            foreach ($head_match[1] as $k => $v) {
                $all[] = $v.'|'.$head_match[2][$k].'|'.$head_match[3][$k];
            }

            foreach ($foot_match[1] as $k => $v) {
                $all[] = $v.'|'.$foot_match[2][$k].'|'.$foot_match[3][$k];
            }

            foreach ($match[1] as $k => $v) {
                $all[] = $v.'|'.$match[2][$k].'|'.$match[3][$k];
            }

            $info = array_unique($all);
        }else{


            return $match;
        }

        foreach ($info as $key => $v) {
            list($parent_name,$ui_name,$pid) = explode('|', $v);
            $ui_path  = $this->ui_path.$parent_name.'/'.$ui_name;
            $tem_ui = $this->tem_path.'ui/'.$parent_name.'/'.$ui_name;
            $config_path = $tem_ui.'/config.json';
            if(!file_exists($config_path)){
                $config_path = $ui_path.'/config.json';
                $tem_ui = $ui_path;
            }

            if(file_exists($config_path)){
                $config = json_decode(file_get_contents($config_path),true);
                if(!$config){
                    echo "{$config_path}'配置文件有问题'<br>";
                }
                foreach ($config['css'] as $k => $val) {

                    if(strpos($val, 'ui/css') !== false){
                        $ui_info[$key]['css'][] =  $tem_ui.'/'.str_replace('ui/css/', '', $val);

                        $ui_info[$key]['parent_name'] = $parent_name;
                        $ui_info[$key]['ui_name'] = $ui_name;
                        $ui_info[$key]['pid'] = $pid;
                    }else{
                        $css[] = $this->replace_public($val);
                    }
                }

                foreach ($config['js'] as $k => $val) {

                    if(strpos($val, 'ui/js') !== false){

                        $ui_info[$key]['js'][] =  $tem_ui.'/'.str_replace('ui/js/', '', $val);
                        $ui_info[$key]['parent_name'] = $parent_name;
                        $ui_info[$key]['ui_name'] = $ui_name;
                        $ui_info[$key]['pid'] = $pid;
                    }else{
                        $js[] = $this->replace_public($val);

                    }
                }
            }
        }

        $unique_css = array_unique($css);
        $unique_js = array_unique($js);
        $js_content = "";
        $css_content = "";

        foreach ($unique_css as $key => $c) {
        	$css_content .= $this->replace_url($c);

        }
        foreach ($unique_js as $key => $c) {
            $js_content.= "\n".file_get_contents($c);
        }

        foreach ($ui_info as $k => $v) {
        	$_css = $this->replace_css($v);
        	$css_content.=$_css;

            $_js = $this->replace_js($v);
            $js_content.= $_js;
        }

        if(!file_exists($this->tem_path.'cache/')){
            mkdir($this->tem_path.'cache/',0777,true);
        }

        file_put_contents($this->tem_path.'cache/'.$page.'_'.$_M['lang'].'.css', $css_content);
        file_put_contents($this->tem_path.'cache/'.$page.'_'.$_M['lang'].'.js', $js_content);
	}


    public function list_public_config()
    {
        global $_M;
        $cache = $this->cache_path."/public_config_{$_M['lang']}.php";
        if(file_exists($cache) && !$_M['form']['pageset']){
            return self::get_cache($cache);
        }
        if($this->template_type == 'tag'){
            $public_config = $this->list_templates_config();
        }else{
            $public_config = $this->list_global_config();
        }
        self::set_cache($cache,$public_config);

        return $public_config;
    }
    /**
     * 标签模式下替换metinfocss中的变量
     */
    public function parse_tag_static($type='css')
    {
        global $_M;

        $res = $this->tem_path.'static/metinfo.'.$type;
        $new = $this->tem_path.'cache/common.'.$type;
        if(!file_exists(dirname($new)) && !IN_ADMIN){
            mkdir(dirname($new),0777,true);
        }

        $has = file_exists($new);
        if(($_M['form']['pageset'] && !IN_ADMIN) || !$has){
            if(file_exists($res)){
                $content = file_get_contents($res);
                $tem_config = $this->list_templates_config();
                foreach ($tem_config as $name => $value) {
                    $content = str_replace("\${$name}\$", $value, $content);
                }

                $add_content = $this->parse_tag_path($type);
                file_put_contents($new, $add_content."\n".$content);
            }
        }
    }

    public function parse_tag_path($type='css')
    {
        global $_M;
        $config = json_decode(file_get_contents($this->tem_path.'config.json'),true);
        $new_content = "";
        foreach ($config[$type] as $res) {
            $path = $this->replace_public($res);

            $content = file_get_contents($path);

            $file_path = str_replace(PATH_WEB, '', $path);
            if($type == 'css'){
                $dir = str_replace(PATH_WEB, '', dirname($path)).'/';
                $new_content .= "\n/*{$file_path}*/\n".$this->replace_url($path);
            }else{
                $new_content.= "\n/*{$file_path}*/\n".$content;
            }


        }
        return $new_content;
    }
    /**
     * 替换UI带的css中的Url
     */
	public function replace_css($data)
    {
    	global $_M;

        $css_content = "";
        foreach ($data['css'] as $c) {

            // 替换配置
            $css = file_get_contents($c);
            // 模板公共色调参数
            $global = $this->list_global_config($this->skin_name);

            foreach ($global as $name => $value) {
                // 替换公共参数
                $css = str_replace("\${$name}\$", $value, $css);
            }
            $css = str_replace('$uicss', '.'.$data['parent_name'].'_'.$data['ui_name'], $css);
            $img_url = 'templates/'.$this->skin_name.'/ui/'.$data['parent_name'].'/'.$data['ui_name'].'/img';

            if(file_exists(PATH_WEB.$img_url)){
                $img_url = $_M['url']['site'].$img_url;
            }else{
                $img_url = $_M['url']['app'].'met_ui/admin/ui/'.$data['parent_name'].'/'.$data['ui_name'].'/img';
            }
            $css = str_replace('$ui_url', $img_url, $css);
            preg_match_all('/\$(\w+)\$/', $css, $match);
            $variable = array_unique($match[1]);
            foreach ($variable as $v) {
                $config =  $this->get_config_by_pid($data['pid'],$v);

                $css = str_replace("\${$v}\$", $config, $css);
            }

            $css_content.= "\n".$css;
        }

    	return $css_content."\n";
    }

    /**
     * UI带的js中的变量替换
     */
    public function replace_js($data)
    {
        global $_M;

        $global = $this->list_global_config($this->skin_name);
        $js_content = "";
        foreach ($data['js'] as $j) {
            $js = file_get_contents($j);
            $js = str_replace('$uicss', $data['parent_name'].'_'.$data['ui_name'], $js);
            $js_content.= "\n".$js;
        }

        return $js_content."\n";
    }

    /**
     * UI中config.json文件的变量替换
     * @DateTime 2017-12-15
     * @param    string 带变量的路径
     * @return   string 替换后的路径
     */
    public function replace_public($path)
    {
        global $_M;
        $replace = array(
            '{$metui_url1}' => PATH_WEB.'app/system/include/static/',
            '{$metui_url2}' =>PATH_WEB.'app/system/include/static2/',
            '{$metui_url3}' =>PATH_WEB.'public/ui/v2/static/',
            '{$metui_url4}' =>PATH_WEB.'app/app/shop/web/templates/met/'
        );

        $path = str_replace(array_keys($replace), array_values($replace), $path);
        return $path;
    }

    /**
     * UI中的css js路径替换为url
     */
    public function replace_url($path)
    {
        global $_M;
        $http_path = str_replace(PATH_WEB, '', $path);
        $info = pathinfo($http_path);
        $http_dir = $info['dirname'];
        $content = file_get_contents($path);
        $content = preg_replace_callback('/url\(["\']*([\.\/]*)([^:]*?)["\']*\)/', function($match) use ($http_dir){

            return "url('../../../".$http_dir.'/'.$match[1].$match[2]."')";
        }, $content);
        return $content;
    }


    public function replace_common($metinfo_css)
    {
        global $_M;
        if(file_exists($this->tem_path.'/cache/common.css')){
            $content = file_get_contents($this->tem_path.'/cache/common.css');
            $global = $this->list_global_config();
            foreach ($global as $name => $value) {
                $content = str_replace("\${$name}\$", $value, $content);
            }
            return $metinfo_css.$content;
        }
    }

    public function list_global_config($skin_name='')
    {
    	global $_M;

        if($skin_name == ''){
            $skin_name = $this->skin_name;
        }
        $query = "SELECT * FROM {$_M['table']['ui_config']} WHERE pid = 0 AND skin_name = '{$this->skin_name}' AND lang = '{$_M['lang']}'";

        $global = DB::get_all($query);

        $config = array();
        foreach ($global as $v) {

            // 如果是背景图片，直接去掉标签
            if($v['uip_key'] == 'bodybgimg' || $v['uip_key'] == 'met_font'){

                $val = str_replace('../', '', $this->replace_m($v['uip_value']));
                    if($v['uip_key'] != 'met_font' && $val){
                        $val = $_M['url']['site'].$val;
                    }

            }else{
                $val = $this->replace_tag($v['uip_value'],$v['uip_default'],$v['uip_type']);
            }

            $config[$v['uip_name']] = $val;
        }

        return $config;
    }

     public function list_local_config($pid,$skin_name=''){
        global $_M;
        if($skin_name == ''){
            $skin_name = $this->skin_name;
        }

        $cache = $this->cache_path.'/'."{$skin_name}_{$pid}_{$_M['lang']}.php";

        if(file_exists($cache) && !$_M['form']['pageset']){
            return self::get_cache($cache);
        }
        $query = "SELECT * FROM {$_M['table']['ui_config']} WHERE pid = {$pid} AND skin_name = '{$skin_name}' AND lang = '{$_M['lang']}'";
        $config = DB::get_all($query);

        $ui = array();
        $ui['mid'] = $pid;
        foreach ($config as $key => $value) {
            $val = $this->replace_tag($value['uip_value'],$value['uip_default'],$value['uip_type'],$value['id']);
            $ui[$value['uip_name']] = $val;
        }

        self::set_cache($cache,$ui);

        return $ui;
    }


    public function list_page_config($page)
    {
        global $_M;
        $config = json_decode(file_get_contents($this->tem_path.'ui.json'),true);
        $data = array();
        foreach ($config['page'][$page] as $key => $val) {
            $ui_config = $this->list_local_config($val['installid']);
            $data[$val['parent_name']] = $ui_config['ui_show'];
        }

        return $data;
    }


    public function get_config_by_pid($pid,$name)
    {
        global $_M;
        $query = "SELECT * FROM {$_M['table']['ui_config']} WHERE pid = {$pid} AND skin_name = '{$this->skin_name}' AND uip_name='{$name}' AND lang = '{$_M['lang']}'";

        $config = DB::get_one($query);

        $value =  $this->replace_tag($config['uip_value'],$config['uip_default'],$config['uip_type']);
        return $value;
    }

    public function get_config_by_name($parent_name,$ui_name,$uip_name){
        global $_M;
        $query = "SELECT * FROM {$_M['table']['ui_config']} WHERE parent_name = '{$parent_name}' AND ui_name='{$ui_name}' AND uip_name = '{$uip_name}' AND skin_name = '{$this->skin_name}' AND lang = '{$_M['lang']}'";
        $config = DB::get_one($query);
        return $this->replace_tag($config['uip_value'],$config['uip_default'],$config['uip_type']);
    }

    public function replace_sys_config(){
        global $_M;
        $config = $_M['config'];

        $config['met_logo'] = str_replace(array('../','./'), '', $config['met_logo']);
        if(!strstr($config['met_logo'], 'http')){
            $config['met_logo'] = $_M['url']['site']. $config['met_logo'];
        }

        $config['met_weburl'] = $_M['url']['site'];
        $query = "SELECT id FROM {$_M['table']['config']} WHERE name = 'met_logo' AND lang = '{$_M['lang']}'";
        $logo = DB::get_one($query);

        if($_M['form']['pageset']){
            $config['met_logo'] = $config['met_logo']."?met-id={$logo['id']}&met-table=config&met-field=value";
        }

        if($_M['config']['met_agents_switch']){
            $config['met_agents_copyright_foot'] = $_M['config']['met_agents_index_footer'];
        }

        $config['met_agents_copyright_foot'] = str_replace(array('$metcms_v','$m_now_year'), array($config['metcms_v'],date('Y',time())), $config['met_agents_copyright_foot']);
        $config['met_agents_copyright_foot'] = $this->replace_m($config['met_agents_copyright_foot']);

        if($_M['config']['met_index_type'] == $_M['lang']){
            $config['index_url'] = $config['met_weburl'];
        }else{
            if($_M['config']['met_pseudo'] && !$_M['form']['pageset']){
                $config['index_url'] = $config['met_weburl'].'index-'.$_M['lang'].'.html';
            }else{
                $config['index_url'] = $config['met_weburl'].'index.php?lang='.$_M['lang'];
            }
        }

        if(($_M['form']['pageset'] && !strstr($config['index_url'],'?'))){
            $config['index_url'].= 'index.php?lang='.$_M['lang'];
        }

        return $config;
    }


    public function list_templates_config(){
        global $_M;

        $cache = $this->cache_path."/tem_config_{$_M['lang']}.php";
        if(file_exists($cache) && !$_M['form']['pageset']){
            return self::get_cache($cache);
        }
        $query = "SELECT * FROM {$_M['table']['templates']} WHERE lang = '{$_M['lang']}' AND no = '{$_M['config']['met_skin_user']}' AND type != 1";
        $templates = DB::get_all($query);
        $tem_config = array();
        foreach ($templates as $key => $value) {
            $tem_config[$value['name']] = $this->replace_tag($value['value'],$value['defaultvalue'],$value['type'],$value['id']);
       }

       if($_M['form']['pageset']){
            $query = "SELECT * FROM {$_M['table']['templates']} WHERE lang = '{$_M['lang']}' AND no = '{$_M['config']['met_skin_user']}' AND name like 'tagshow_%'";
            $tagshow = DB::get_all($query);
            foreach ($tagshow as $t) {
                $tem_config[$t['name']] = 1;
            }
       }

        self::set_cache($cache,$tem_config);

       return $tem_config;
    }



    public function replace_tag($value,$default,$type,$id=0)
    {
        global $_M;

        $defaultvalue = $this->replace_m($default);

        $realvalue = $this->replace_m($value);

        if(trim($realvalue) == ''){
            if(is_numeric($defaultvalue) || trim($defaultvalue) == '' || in_array($type, array(4,6,9))){
                $val = $defaultvalue;
            }else{
                $val = $default;
            }
        }else{
            if(in_array($type, array(4,6,9)) || is_numeric($realvalue)){
                $val = $realvalue;
            }else{
                $val = $value;
            }
        }
        if($type == 7){
            if($_M['form']['pageset']){
                if($this->template_type == 'ui'){
                    $para = "?met-id={$id}&met-table=ui_config&met-field=uip_value";
                }else{
                    $para = "?met-id={$id}&met-table=templates&met-field=value";
                }
            }else{
                $para = '';
            }
            $realval = $this->replace_m($val);
            if(!$realval){
                $val = $para;
            }else{
                // 如果是外部图片，不增加网站url
                $val = str_replace('../', '', $realval).$para;
                if(!strstr($val, 'http')){
                    $val = $_M['config']['met_weburl'].$val;
                }
            }

        }

        return $val;
    }


    public function replace_sql_one($sql,$rs)
    {
        global $_M;
        if($table = self::getTable($sql)){
            if($tableName = self::checkTable($table)){
                foreach ($rs as $key => $v) {
                    if(self::checkField($key)){

                        if(self::checkImg($key)){
                            if(!$v){
                                $v = $_M['config']['site'].$_M['config']['met_agents_img'];
                            }
                            $rs[$key]=$v."?met-id={$rs['id']}&met-table={$tableName}&met-field={$key}";
                        }else{

                            $rs[$key]=$v."<m met-id={$rs['id']} met-table={$tableName} met-field={$key}></m>";
                        }

                    }
                }
            }
        }
        return $rs;
    }

    public function replace_sql_all($sql,$rs)
    {
        global $_M;
        if($table = self::getTable($sql)){
            if($tableName = self::checkTable($table)){
                foreach ($rs as $k => $v) {
                    foreach ($v as $key => $val) {

                        if(self::checkField($key)){
                            if(self::checkImg($key)){
                                if(!$val){
                                    $val = $_M['config']['site'].$_M['config']['met_agents_img'];
                                }
                                // 图片
                                $rs[$k][$key] = $val."?met-id={$rs[$k]['id']}&met-table={$tableName}&met-field={$key}";
                            }else{
                                $rs[$k][$key]= $this->add_tag($val,$tableName,$key,$rs[$k]['id']);
                            }
                        }
                    }
                }
            }
        }
        return $rs;
    }

    //去掉数据中的m标签
    public function replace_m($value)
    {
        global $_M;
        return preg_replace_callback("/<m[\s_a-zA-Z=\d->]+<\/m>/", function($match){
                return;
            }, $value);
    }

      // 标签里的属性不添加m标签
    public function replace_attr($output)
    {
        global $_M;
        $that = $this;

        $new_output =  preg_replace_callback("/(alt|value|title|placeholder|data-name|data-title|data-fv-message)=['\"]?([\S]+)?(<m[\s_a-zA-Z=\d>-]+<\/m>)['\"]?/isu", function($match) use ($that){

           return $that->replace_m(trim($match[0]));
        }, $output);
        if($new_output){
            return $new_output;
        }else{
            return $output;
        }
    }


    //给值加上m标签
    public function add_tag($val,$table,$field,$id)
    {
        global $_M;
        $number = "/[0-9_a-zA-Z<\x{4e00}-\x{9fa5}>]+/u";
        $string = "/[_a-zA-Z<\x{4e00}-\x{9fa5}>]+/u";
        $chinese = "/[<\x{4e00}-\x{9fa5}>]+/u";

        if($table == 'column' && $field == 'content'){
            return $val;
        }
        // 产品参数
        if($table == 'plist' && $field == 'info'){
            if(preg_match($number, $val) && !is_numeric($val)){
                return $val."<m met-id={$id} met-table={$table} met-field={$field}></m>";
            }
        }

        if($table == 'templates' || $table == 'config' || $table == 'language'){

            if($field == 'name'){
                return $val;
            }else{
                if(preg_match($chinese, $val)){

                    return $val."<m met-id={$id} met-table={$table} met-field={$field}></m>";
                }

                if($table == 'language'){
                    return $val."<m met-id={$id} met-table={$table} met-field={$field}></m>";
                }

                return $val;
            }
        }


        if($field == 'icon'){
            // 分类栏目标识
            return $val." met-icon|{$id}|{$table}|{$field}";
        }
        // 其他字段碰到数字类型的值不添加m标签
        if(preg_match($string, $val) || strlen($val) >= 7){
            return $val."<m met-id={$id} met-table={$table} met-field={$field}></m>";
        }
        return $val;
    }

    // 要处理的表
    public function checkTable($table){
        if(!file_exists(PATH_WEB.'config/config_db.php')){
            return false;
        }

        @extract(parse_ini_file(PATH_WEB.'config/config_db.php'));

        if(strpos($table, $tablepre) === false){
            return false;
        }

        $table = str_replace($tablepre, '', $table);

        if(!in_array($table, $this->tables)){
            return false;
        }

        return $table;
    }

    // 要处理的字段
    public function checkField($field){

        if(in_array($field, $this->fields)){
            return true;
        }else{
            return false;
        }
    }

    // 图片字段处理方式不一样
   public function checkImg($filed){
        $img_fields = array('img_path','imgurl','columnimg','imgurls','weblogo');
        return in_array($filed, $img_fields);
    }

    // 从语句中提取表名
    public function getTable($sql){
        preg_match("/(from|FROM)\s+(\w+)/", $sql,$match);
        return isset($match[2]) ? $match[2] : false;
    }


   /*----------------- 前台可视化操作---------------------*/

    public function get_field_text($table, $field, $id){
        global $_M;

        $query = "SELECT * FROM {$_M['table'][$table]} WHERE id = {$id}";
        $res = DB::get_one($query);
        if(!$res){
            return false;
        }
        $this->response['status'] = 1;
        $this->response['text'] = $res[$field];
        if($table == 'templates'){
            $this->response['type'] = $res['type'];
        }

        return $this->response;
    }


    public function set_field_text($table, $field, $id, $text){
        global $_M;

        if($field == 'defaultvalue'){
            $field = 'value';
        }

        if($field == 'uip_default'){
            $field = 'uip_value';
        }
        $query = "UPDATE {$_M['table'][$table]} SET $field = '{$text}' WHERE id = {$id}";
        $row = DB::query($query);
        if(!$row){
            $this->response['msg'] = $_M['word']['templateseditfalse'];
            return $this->response;
        }
        $this->response['status'] = 1;
        return $this->response;
    }

    public function save_img_field($table,$field,$mid,$path)
    {
        global $_M;
        $query = "UPDATE {$_M['table'][$table]} SET {$field} = '{$path}' WHERE id = {$mid} AND lang = '{$_M['lang']}'";
        return DB::query($query);
    }

    public function set_cache($file,$data)
    {
        global $_M;
        if($_M['form']['pageset']){
            if(file_exists($file)){
                @unlink($file);
            }
            return;
        }
        $string = "<?php defined('IN_MET') or exit('No permission'); ?>";
        $string  .= json_encode($data);
        $str = file_put_contents($file, $string);
        if(!$str){
            die($this->cache_path.$_M['word']['templatefilewritno']);
        }
    }

    public function get_cache($file)
    {
        global $_M;
        $string = file_get_contents($file);
        $string = str_replace("<?php defined('IN_MET') or exit('No permission'); ?>", '', $string);
        return json_decode($string,true);
    }

}