<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.

defined('IN_MET') or exit('No permission');

load::sys_func('common');
load::sys_func('power');
load::sys_func('array');
load::sys_class('mysql');
load::sys_class('cache');
load::sys_class('buffer');
load::sys_class('logs');
//定义ip
define('IP', getip());

/**
 * 系统一级基类
 */
class common
{
    /*
     * 错误信息
     */
    public $error;

    /**
     * 初始化
     */
    public function __construct()
    {
        global $_M; //全局数组$_M
         if(!file_exists(PATH_WEB.'config/install.lock')){
            if(file_exists(PATH_WEB.'install/index.php')){
                header("location:install/index.php");exit;
            }
            else{
                header("Content-type: text/html;charset=utf-8");
                echo "安装文件不存在，请上传安装文件。如已安装过，请新建config/install.lock文件。";
                die();
            }
        }
        ob_start(); //开启缓存
        $this->error = array(); //错误信息

        $this->load_mysql(); //数据库连接
        $this->load_form(); //表单过滤
        $this->load_lang(); //加载语言配置
        $this->init_config(); //初始化配置
        $this->load_url_site();
        $this->load_config_lang(); //加载当前语言配置数据
        $this->load_url(); //加载url数据
        $_M['config']['met_api'] = 'https://u.mituo.cn/api/client';
        $this->jump_url();
    }

    //301跳转
    protected function jump_url()
    {
        //是否开启301跳转
        global $_M;
        if ($_SERVER['SERVER_PORT'] == 443 || $_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1 || $_SERVER['HTTP_X_CLIENT_SCHEME'] == 'https' || $_SERVER['HTTP_FROM_HTTPS'] == 'on' || $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {
            $http = 'https://';
        } else {
            $http = 'http://';
        }
        if ($_M['config']['met_301jump'] == 1) {
            if ($_M['url']['web_site'] && strpos($_M['url']['web_site'], 'www.') === false) {
                $jump_url = $http . HTTP_HOST . $_SERVER['REQUEST_URI'];
                $jump_url = str_replace('https://', 'https://www.', $jump_url);
                $jump_url = str_replace('http://', 'http://www.', $jump_url);
                header("Location:{$jump_url}");die;
            }
        }
    }

    /**
     * 链接数据库
     */
    protected function load_mysql()
    {
        global $_M;
        $db_settings = parse_ini_file(PATH_CONFIG . 'config_db.php');
        @extract($db_settings);
        DB::dbconn($con_db_host, $con_db_id, $con_db_pass, $con_db_name, $con_db_port);
        $_M['config']['tablepre'] = $tablepre;
        return true;
    }

    /**
     * 获取GET,POST,COOKIE，存放在$_M['form']，系统表单提交变量数组
     */
    protected function load_form()
    {
        global $_M;
        $_M['form'] = array();
        isset($_REQUEST['GLOBALS']) && exit('Access Error');

        if (!$_COOKIE['met_auth']){
            $_COOKIE['met_auth'] =$_SERVER['HTTP_MET_AUTH'];
        }
        $_COOKIE['met_auth'] = str_replace(' ','+',$_COOKIE['met_auth']);
        if (!$_COOKIE['met_key']){
            $_COOKIE['met_key'] = $_SERVER['HTTP_MET_KEY'];
        }
        foreach ($_COOKIE as $_key => $_value) {
            $_key{0} != '_' && $_M['form'][$_key] = daddslashes($_value);
        }
        foreach ($_POST as $_key => $_value) {
            $_key{0} != '_' && $_M['form'][$_key] = daddslashes($_value);
        }
        foreach ($_GET as $_key => $_value) {
            $_key{0} != '_' && $_M['form'][$_key] = daddslashes($_value);
        }
        if (is_numeric($_M['form']['lang'])) { //伪静态兼容
            $_M['form']['page'] = $_M['form']['lang'];
            $_M['form']['lang'] = '';
        }
        if ($_M['form']['metid'] == 'list') {
            $_M['form']['list'] = 1;
            $_M['form']['metid'] = $_M['form']['page'];
            $_M['form']['page'] = 1;
        }

        if (!preg_match('/^[0-9A-Za-z]+$/', $_M['form']['lang']) && $_M['form']['lang']) {
            halt("Language identification error");
        }
    }

    /**
     * 获取网站的语言设置，存放在$_M['langlist']，语言设置数组
     */
    protected function load_lang()
    {
        global $_M;
        $query = "SELECT * FROM {$_M['config']['tablepre']}lang ORDER BY no_order";
        $result = DB::get_all($query);
        foreach ($result as $list_config) {
            $list_config['order'] = $list_config['no_order'];
            if ($list_config['lang'] == 'metinfo') {
                $_M['langlist']['admin'][$list_config['mark']] = $list_config;
            } else {
                $_M['langlist']['web'][$list_config['mark']] = $list_config;
            }
        }

        $query = "SELECT * FROM {$_M['config']['tablepre']}lang_admin ORDER BY no_order";
        $result = DB::get_all($query);
        foreach ($result as $list_config) {
            $list_config['order'] = $list_config['no_order'];
            $_M['langlist']['admin'][$list_config['mark']] = $list_config;
        }
    }

    /**
     * 获取网站的当前语言的网站设置，存放在$_M['config']，网站设置数组
     */
    protected function load_config_lang()
    {
        global $_M;

        $_M['lang'] = $_M['form']['lang'] ? $_M['form']['lang'] : $_M['config']['met_index_type'];
        if (M_MODULE == 'admin' || M_MODULE == 'include') {
            if ($_M['form']['lang']) {
                if ($_M['form']['lang'] != $_M['form']['admin_lang']) {
                    setcookie('admin_lang', $_M['form']['lang'], null, '/');
                }
            } else if ($_M['form']['admin_lang']) {
                $_M['lang'] = $_M['form']['admin_lang'];
            }
        }

        if (!$_M['langlist']['web'][$_M['lang']]) {
            halt("No current language identifier");
        }
        $this->load_config($_M['lang']);

    }

    protected function init_config()
    {
        global $_M;
        // 加载全局配置
        $this->load_config('metinfo');

        if (defined('IN_ADMIN')) {
            // 加载语言配置
            foreach ($_M['langlist']['web'] as $key => $val) {
                $this->load_config($val['lang']);
            }
        }
        // 获取后台目录
        $_M['config']['met_adminfile'] = getAdminDir();

        $tables = buffer::getTables();
        if (!$tables) {
            $_M['table'] = array();
            foreach (explode('|', $_M['config']['met_tablename']) as $key => $val) {
                $_M['table'][$val] = $_M['config']['tablepre'] . $val;
            }
            buffer::setTables($_M['table']);
        } else {
            $_M['table'] = $tables;
        }

        $_M['config']['met_webkeys'] = trim(file_get_contents(PATH_WEB . '/config/config_safe.php'));
        $_M['config']['met_webkeys'] = str_replace(' ', '', $_M['config']['met_webkeys']);
        $_M['config']['met_webkeys'] = str_replace('<?php/*', '', $_M['config']['met_webkeys']);
        $_M['config']['met_webkeys'] = str_replace('*/?>', '', $_M['config']['met_webkeys']);
        if (!preg_match('/^[0-9A-Za-z]{32}$/', $_M['config']['met_webkeys'])) {
            $_M['config']['met_webkeys'] = random(32);
            file_put_contents(PATH_WEB . '/config/config_safe.php', "<?php/*{$_M['config']['met_webkeys']}*/?>");
        }

        // 获取接口地址
        $_M['config']['met_host'] = $_M['config']['met_host_new'];

    }

    /**
     * 根据语言获取配置信息
     */
    protected function load_config($lang)
    {
        global $_M;
        $result = buffer::getConfig($lang);

        if (!$result) {
            $query = "SELECT * FROM {$_M['config']['tablepre']}config WHERE lang='{$lang}'";
            $result = DB::get_all($query);
            buffer::setConfig($lang, $result);
        }
        foreach ($result as $value) {
            if ($value['name'] == 'met_weburl') {
                continue;
            }
            $_M['config'][$value['name']] = $this->filter_config($value['value']);
        }

        if (!$_M['config']['data_cache_time']) {
            $_M['config']['data_cache_time'] = 600;
        }

        if (!$_M['met_logo_keyword']) {
            $_M['config']['met_logo_keyword'] = $_M['config']['met_keywords'];
        }

        if (!$_M['met_mobile_logo']) {
            $_M['config']['met_mobile_logo'] = $_M['config']['met_logo'];
        }

        if ($_M['form']['pageset']) {
            $_M['config']['debug'] = true;
        }

        $app = buffer::getAppConfig($lang);

        if (!$app) {
            $query = "SELECT * FROM {$_M['config']['tablepre']}app_config WHERE lang='{$lang}'";
            $app = DB::get_all($query);
            buffer::setAppConfig($lang, $app);
        }

        foreach ($app as $value) {
            $_M['config'][$value['name']] = $this->filter_config($value['value']);
        }
    }

    /**
     * 配置变量过滤
     * @param string $value 配置变量
     */
    protected function filter_config($value)
    {
        $value = str_replace('&#34;', '"', str_replace("&#39;", "'", $value));
        return $value;
    }

    /**
     * 获取$_M['url']，系统URL网址数组
     */
    protected function load_url()
    {
        global $_M;
        //来源页面
        define('HTTP_REFERER', sqlinsert($_SERVER['HTTP_REFERER']));
        $this->load_url_other();
        $this->load_url_unique();
        // 如果是后台，路径不影响，是前台就就成相对路径
        $_M['url']['web_site'] = $_M['url']['site'];
        if (!defined("IN_ADMIN")) {//相对路径
            $_M['url']['site'] = '../';
            if(($_M['form']['search'] == 'tag' || @$_GET['search'] == 'tag') && $_M['config']['met_pseudo']){
                $_M['url']['site'] = '../../';
            }
        }
    }

    /**
     * 获取前台网址与后台网址
     */
    protected function load_url_site()
    {
        global $_M;
        if ($_SERVER['SERVER_PORT'] == 443 || $_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1 || $_SERVER['HTTP_X_CLIENT_SCHEME'] == 'https' || $_SERVER['HTTP_FROM_HTTPS'] == 'on' || $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {
            $http = 'https://';
        } else {
            $http = 'http://';
        }

        if (strstr(PHP_SELF, 'entrance.php')) { //直接从入口文件访问，如验证码，字段前台显示权限功能
            $_M['config']['met_weburl'] = $http . HTTP_HOST . preg_replace("/\w+\/\w+\/\w+\.php$/", '', PHP_SELF);
        } else {
            if (M_NAME == "index") {
                $_M['config']['met_weburl'] = str_ireplace('/index.php', '', $http . HTTP_HOST . PHP_SELF . '/');
            } else {
                $_M['config']['met_weburl'] = $http . HTTP_HOST . preg_replace("/[0-9A-Za-z-_]+\/\w+\.php$/", '', PHP_SELF);

            }
        }

        $_M['config']['met_weburl'] = sqlinsert($_M['config']['met_weburl']);
        $_M['url']['site'] = $_M['config']['met_weburl'];
        $query = "SELECT * FROM {$_M['table']['lang']} WHERE link = '{$_M['url']['site']}'";
        $lang = DB::get_one($query);
        if ($lang && !$_M['form']['pageset']) {
            // 如果绑定的域名强制访问语言，http://www.a.com/index.php?lang=en,强制整站语言显示英文
            if ($_M['form']['lang'] && $_M['form']['lang'] != $lang['mark']) {
                $_M['lang'] = $_M['form']['lang'];
            } else {
                $_M['lang'] = $lang['mark'];
            }
            $_M['config']['met_index_type'] = $_M['lang'];
        }
        $_M['url']['site_admin'] = $_M['url']['site'] . $_M['config']['met_adminfile'] . '/';
    }

    /**
     * 获取其他网址，web与admin公用
     */
    protected function load_url_other()
    {
        global $_M;
        $_M['url']['entrance'] = $_M['url']['site'] . 'app/system/entrance.php';
        $_M['url']['own'] = $_M['url']['site'] . 'app/' . M_TYPE . '/' . M_NAME . '/' . M_MODULE . '/';
        $_M['url']['own_tem'] = $_M['url']['own'] . 'templates/';
        $_M['url']['app'] = $_M['url']['site'] . 'app/app/';
        $_M['url']['pub'] = $_M['url']['site'] . 'app/system/include/public/';
        $_M['url']['pub_new'] = $_M['url']['site'] . 'app/system/include/templates/' . M_MODULE . '/';
        $_M['url']['static'] = $_M['url']['site'] . 'app/system/include/static/';
        $_M['url']['static2'] = $_M['url']['site'] . 'app/system/include/static2/';
        $_M['url']['static_new'] = $_M['url']['site'] . 'app/static/';
        $_M['url']['ui_v2'] = $_M['url']['site'] . 'public/ui/v2/';
        $_M['url']['api'] = 'https://' . $_M['config']['met_host'] . '/' . "index.php?lang=" . $_M['lang'] . '&';
        $_M['url']['app_api'] = $_M['url']['api'] . 'n=platform&c=platform&';
    }

    /**
     * 用于web与admin类加载不同的网址
     */
    protected function load_url_unique()
    {
    }

    // /**
    //  * 获取网站的flash设置，存放在$_M['flashset']，flash设置数组
    //  */
    // protected function load_flashset_data($lang = '')
    // {
    //     global $_M;
    //     $lang = $lang ? $lang : $_M['lang'];
    //     $query = "SELECT * FROM {$_M['config']['tablepre']}config WHERE flashid!='0' and lang='{$lang}'";
    //     $result = DB::query($query);
    //     while ($list_config = DB::fetch_array($result)) {
    //         $list_config['value'] = str_replace('"', '&#34;', str_replace("'", '&#39;', $list_config['value']));
    //         $list_config['value'] = explode('|', $list_config['value']);
    //         $falshval['type'] = $list_config['value'][0];
    //         $falshval['x'] = $list_config['value'][1];
    //         $falshval['y'] = $list_config['value'][2];
    //         $falshval['imgtype'] = $list_config['value'][3];
    //         $list_config['mobile_value'] = explode('|', $list_config['mobile_value']);
    //         $falshval['wap_type'] = $list_config['mobile_value'][0];
    //         $falshval['wap_y'] = $list_config['mobile_value'][1];
    //         $_M['flashset'][$list_config['flashid']] = $falshval;
    //     }
    // }

    /**
     * 获取语言参数，存放在$_M['word']，网站设置数组
     * @param string $lang 需要获取语言参数的语言
     * @param int $site 获取语言参数位置，1:后台语言，2:前台语言
     */
    protected function load_word($lang, $site)
    {
        global $_M;
        $langtype = $site ? 'admin_' : '';

        //设置后台语言为管理员默认语言
        if ($site == 1) {
            $lang = $_M['langset'];
        }

        $_M['word'] = buffer::getLang($langtype, $lang);
        if (!$_M['word']) {
            $query = "SELECT * FROM {$_M['table']['language']} WHERE lang='{$lang}' AND site='{$site}'";
            $result = DB::get_all($query);
            foreach ($result as $val) {
                $_M['word'][$val['name']] = trim($val['value']);
            }
            buffer::setLang($langtype, $lang, $_M['word']);
        }
        //生成js语言文件  app或者array字段为1则为js语言
        $langtype = $site ? 'admin_' : '';
        $js_lang_cache = PATH_CACHE . 'lang_json_' . $langtype . $lang . '.js';

        if (!file_exists($js_lang_cache)) {
            if ($site) {
                $query = "SELECT * FROM {$_M['table']['language']} WHERE lang='{$lang}' AND site='{$site}'";
            } else {
                $query = "SELECT * FROM {$_M['table']['language']} WHERE lang='{$lang}' AND (app=1 OR array=1) AND site='{$site}'";
            }
            $result = DB::query($query);
            while ($listlang = DB::fetch_array($result)) {
                $_M['jsword'][$listlang['name']] = trim($listlang['value']);
            }
            $jslang = 'window.METLANG = ';
            $jslang .= jsonencode($_M['jsword']);
            file_put_contents($js_lang_cache, $jslang);
        }
    }

    /**
     * 包含模板文件
     * @param string $path 要包含的模板文件地址，已“模板文件类型/模板文件名称”方式输入
     * @模板文件类型：own:应用自己的模板文件，ui:系统UI模板文件，tem:模板文件
     * @除前台模板文件外，其他包含的文件一定是php格式
     */
    protected function template($path)
    {
        global $_M;
        // 前缀、路径转换优化（新模板框架v2）
        $dir = explode('/', $path);
        $postion = $dir[0];
        $file = substr(strstr($path, '/'), 1);

        if ($postion == 'own') {
            return PATH_OWN_FILE . "templates/{$file}.php";
        }
        if ($postion == 'ui') {
            if (M_MODULE == 'admin') {
                $ui = 'admin';
            } else {
                $ui = 'web';
            }
            return PATH_SYS . "include/public/ui/{$ui}/{$file}.php";
        }
        if ($postion == 'tem') {
            if (M_MODULE == 'admin') {
                if (file_exists(PATH_SYS . '/' . M_NAME . "/admin/templates/{$file}.php")) {
                    return PATH_SYS . '/' . M_NAME . "/admin/templates/{$file}.php";
                } else {
                    return PATH_SYS . "index/templates/{$file}.php";
                }
            } else {
                if ($_M['config']['metinfover']) {
                    $tem_ver = $_M['config']['metinfover'];
                    $tem_w = 'php';
                } else {
                    $tem_ver = 'met';
                    $tem_w = 'html';
                }
                if ($_M['form']['ajax'] == 1) {
                    $file_ajax = 'ajax/' . $file;
                    if (file_exists(PATH_TEM . "{$file_ajax}.php")) {
                        return PATH_TEM . "{$file_ajax}.php";
                    }
                    if (file_exists(PATH_TEM . "{$file_ajax}.html")) {
                        return PATH_TEM . "{$file_ajax}.html";
                    }
                    if (file_exists(PATH_TEM . "{$file_ajax}.htm")) {
                        return PATH_TEM . "{$file_ajax}.htm";
                    }
                    if (file_exists(PATH_WEB . "public/ui/{$tem_ver}/{$file_ajax}.{$tem_w}")) {
                        return PATH_WEB . "public/ui/{$tem_ver}/{$file_ajax}.{$tem_w}";
                    }
                }
                if (file_exists(PATH_TEM . "{$file}.php")) {
                    return PATH_TEM . "{$file}.php";
                }
                if (file_exists(PATH_TEM . "{$file}.html")) {
                    return PATH_TEM . "{$file}.html";
                }
                if (file_exists(PATH_TEM . "{$file}.htm")) {
                    return PATH_TEM . "{$file}.htm";
                }
                return PATH_WEB . "public/ui/{$tem_ver}/{$file}.{$tem_w}";
            }
        }
    }

    /**
     * Ajax方式返回数据到客户端
     * @access protected
     * @param mixed $data 要返回的数据
     * @param String $type AJAX返回数据格式
     * @param int $json_option 传递给json_encode的option参数
     * @return void
     */
    protected function ajaxReturn($data, $type = '', $json_option = 0, $callback = 'callback')
    {
        if (empty($type)) {
            $type = 'JSON';
        }

        switch (strtoupper($type)) {
            case 'JSON':
                // 返回JSON数据格式到客户端 包含状态信息
                header('Content-Type:application/json; charset=utf-8');
                $data = json_encode($data, $json_option);
                break;
            case 'JSONP':
                // 返回JSON数据格式到客户端 包含状态信息
                header('Content-Type:application/json; charset=utf-8');
                $handler = $callback;
                $data = $handler . '(' . json_encode($data, $json_option) . ');';
                break;
            case 'EVAL':
                // 返回可执行的js脚本
                header('Content-Type:text/html; charset=utf-8');
                break;
        }
        exit($data);
    }

    /** 错误返回
     * @param string $msg 提示信息
     * @param int $status 状态码
     * @param string $data 返回数据
     * @param int $json_option json附加
     */
    protected function error($msg = '', $status = 0, $data = '', $json_option = 0)
    {
        header('Content-Type:application/json; charset=utf-8');
        $error['msg'] = $msg;
        $error['status'] = $status;
        if ($data) {
            $error['data'] = $data;
        }
        $return_data = json_encode($error, $json_option);
        exit($return_data);
    }

    /** 成功返回
     * @param string $msg 提示信息
     * @param int $status 状态码
     * @param string $data 返回数据
     * @param int $json_option json附加
     */
    protected function success($data = '', $msg = '', $status = 1, $json_option = 0)
    {
        header('Content-Type:application/json; charset=utf-8');
        $success['msg'] = $msg;
        $success['status'] = $status;
        if ($data) {
            $success['data'] = $data;
        }
        $return_data = json_encode($success, $json_option);
        exit($return_data);
    }

    /**
     * 模板解析
     * @param string $file 模板文件
     */
    protected function view($file, $data)
    {
        global $_M;
        $view = load::sys_class('engine', 'new');
        if (!defined("IN_ADMIN")) {//相对路径
            if ($data['classnow'] == 10001) {
                $_M['url']['site'] = '';
            } else {
                $_M['url']['site'] = '../';
                if(($_M['form']['search'] == 'tag' || @$_GET['search'] == 'tag') && $_M['config']['met_pseudo']  && $data['module'] != 11){
                    $_M['url']['site'] = '../../';
                }
            }
        }

        $view->dodisplay($file, $data);
    }

    /**
     * 销毁
     */
    public function __destruct()
    {
        global $_M;
        //读取缓冲区数据
        ##$admin_url = $_M['url']['site_admin'];
        $output = str_replace(array('<!--<!---->', '<!---->', '<!--fck-->', '<!--fck', 'fck-->', '', "\r", substr($admin_url, 0, -1)), '', ob_get_contents());
        ob_end_clean(); //清空缓冲区
        echo $output; //输出内容
        DB::close(); //关闭数据库连接
        exit;
    }
}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
